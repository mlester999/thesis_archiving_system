@extends('master')
@section('user')

    @php 
        $userInfo = App\Models\User::find($viewArchiveData->user_id);
    @endphp

<div class="overflow-hidden bg-white shadow-xl rounded-lg max-w-md sm:max-w-xl md:max-w-2xl lg:max-w-4xl xl:max-w-7xl mx-auto my-8 relative">
    <div class="px-8 pt-5 sm:px-8">
        <p class="py-2 text-lg font-medium flex justify-between">
            Archive Code: {{ $viewArchiveData->archive_code }}
            <span><a href="{{ route('archives') }}" class="text-blue-500 hover:text-blue-400 duration-150">Back </a></span>
        </p>
        <div class="py-10 border-t border-gray-300 space-y-4">
            <h3 class="text-2xl max-w-3xl font-bold leading-6 text-gray-900 inline-block">{{ $viewArchiveData->title }}</h3>
            <p class="text-sm">Submitted by
                <span class="font-bold">{{ $userInfo->first_name . " " . $userInfo->last_name }}</span>
                <span> on {{ $viewArchiveData->created_at->format('M d, Y H:i A') }}</span>
            </p>
            <div class="space-x-2 pt-2">
            @if($viewArchiveData->archive_status > 0)
            <a href="{{ route('edit.archives', $viewArchiveData->archive_code) }}" class="py-3 px-4 bg-red-500 hover:bg-opacity-80 duration-150 text-white"><i class="fa-solid fa-trash mr-1"></i> Delete</a>
            @else
            <a href="{{ route('edit.archives', $viewArchiveData->archive_code) }}" class="py-3 px-4 bg-blue-500 hover:bg-opacity-80 duration-150 text-white"><i class="fa-solid fa-pen-to-square mr-1"></i> Edit</a>
            @endif
            </div>
        </div>
        <div class="pt-4 pb-10 border-t border-gray-300 space-y-4">
            <h3 class="text-lg max-w-3xl font-bold leading-6 text-gray-900 inline-block">Project Year:</h3>
            <p>{{ $viewArchiveData->year }}</p>
            <h3 class="text-lg max-w-3xl font-bold leading-6 text-gray-900 inline-block pt-4">Abstract:</h3>
            <p>{!! $viewArchiveData->abstract !!}</p>
            <h3 class="text-lg max-w-3xl font-bold leading-6 text-gray-900 inline-block pt-4">Project Members:</h3>
            <p>{!! $viewArchiveData->members !!}</p>
            <div class="space-x-2 py-6 relative">
                @if($viewArchiveData->archive_status < 2)
                <a href="{{ $viewArchiveData->document_path }}" target="_blank" class="py-3 px-4 bg-gray-500 hover:bg-opacity-80 duration-200 text-white"><i class="fa-solid fa-download mr-1"></i> Download File</a>
                @endif
                
                @if($viewArchiveData->admin_comment)
                <div class="inline-flex absolute right-10 top-0 flex-col px-5 py-1.5 rounded-full bg-gray-200 text-black tracking-[-0.4px]">
                    <p class="font-bold text-md">Admin Comment:</p>
                    <p class="text-sm font-medium">{{ $viewArchiveData->admin_comment }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection