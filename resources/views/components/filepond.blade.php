@props([
    'baseurl' => false,
    'filename' => false,
])

<div 
    wire:ignore
    x-data
    x-on:remove-images.window="Pone.removeFiles();" 
    x-init="
        FilePond.registerPlugin(FilePondPluginImagePreview);
        FilePond.setOptions({
            server: {
                process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                    @this.upload('{{ $attributes['wire:model'] }}', file, load, error, progress)
                },
                revert: (filename, load) => {
                    @this.removeUpload('{{ $attributes['wire:model'] }}', filename, load)
                },
                load: (uniqueFileId, load, error, progress, abort, headers) => {
                    fetch(`{{ route('admin.settings', ['course', $filename]) }}`).then((res) => {
                        return res.blob();
                     }).then(load);
                },
            },
            @if($baseurl && $filename)
            files: [
                {
                    source: '{{ $filename }}',

                    options: {
                        type: 'local',
                    },
                }
            ],

            onremovefile: (error, file) => {
                @this.set('{{ $attributes['wire:model'] }}', null);
            }
        @endif
        });
    Pone = FilePond.create($refs.input);
    "
>
    <input type="file" {{ $attributes->only('accept') }} x-ref="input">
</div>