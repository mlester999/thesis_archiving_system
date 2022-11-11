@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="px-6 py-4">
        <div class="text-md md:text-lg lg:text-xl xl:text-2xl font-semibold border-b-2 border-gray-900 py-4">
            {{ $title }}
        </div>

        <div class="mt-4">
            {{ $content }}
        </div>
    </div>

    <div class="flex flex-row justify-end px-6 py-4 bg-gray-100 text-right">
        {{ $footer }}
    </div>
</x-modal>