@extends('master')
@section('user')

<div class="overflow-hidden bg-white shadow-xl sm:rounded-lg max-w-6xl mx-auto my-8 relative">
    <div class="px-4 pt-5 sm:px-8">
        <p class="py-2 text-lg font-medium flex justify-between">
            Archive Code: {{ $viewProjectData->archive_code }}
            <span><a href="{{ route('projects') }}" class="text-blue-500 hover:text-blue-400 duration-150">Back </a></span>
        </p>
        <div class="py-10 border-t border-gray-300 space-y-4">
            <h3 class="text-2xl max-w-3xl font-bold leading-6 text-gray-900 inline-block">{{ $viewProjectData->title }}</h3>
            <p class="text-sm">Submitted by
                <span class="font-bold">{{ $viewProjectData->user->first_name . " " . $viewProjectData->user->last_name }}</span>
                <span> on {{ $viewProjectData->created_at->format('M d, Y H:i A') }}</span>
            </p>
            <div class="space-x-2 pt-2">
            <a href="{{ route('edit.project', $viewProjectData->archive_code) }}" class="py-3 px-4 bg-blue-500 hover:bg-opacity-80 duration-150 text-white"><i class="fa-solid fa-pen-to-square mr-1"></i> Edit</a>
            </div>
        </div>
        <div class="pt-4 pb-10 border-t border-gray-300 space-y-4">
            <h3 class="text-lg max-w-3xl font-bold leading-6 text-gray-900 inline-block">Project Year:</h3>
            <p>{{ $viewProjectData->year }}</p>
            <h3 class="text-lg max-w-3xl font-bold leading-6 text-gray-900 inline-block pt-4">Abstract:</h3>
            <p>{!! $viewProjectData->abstract !!}</p>
            <h3 class="text-lg max-w-3xl font-bold leading-6 text-gray-900 inline-block pt-4">Project Members:</h3>
            <p>{!! $viewProjectData->members !!}</p>
            <div class="space-x-2 py-6 relative">
                <a href="{{ $viewProjectData->document_path }}" target="_blank" class="py-3 px-4 bg-gray-500 hover:bg-opacity-80 duration-200 text-white"><i class="fa-solid fa-download mr-1"></i> Download File</a>
                @if($viewProjectData->admin_comment)
                <div class="inline-flex absolute right-10 top-0 flex-col px-5 py-1.5 rounded-full bg-gray-200 text-black tracking-[-0.4px]">
                    <p class="font-bold text-md">Admin Comment:</p>
                    <p class="text-sm font-medium">{{ $viewProjectData->admin_comment }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection