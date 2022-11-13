@extends('admin.admin-master')
@section('admin')

<div class="overflow-y-auto h-screen bg-white shadow-xl w-full mx-4 md:mx-16 relative">
<div class="px-8 pt-5 sm:px-8">
<p class="py-2 text-lg font-medium flex justify-between">
    Archive Code: {{ $viewArchiveData->archive_code }}
    <span><a href="{{ url('admin/archive-list') }}" class="text-blue-500 hover:text-blue-400 duration-150">Back </a></span>
</p>

<div class="py-10 border-t border-gray-300 space-y-4">
    <h3 class="text-2xl max-w-3xl font-bold leading-6 text-gray-900 inline-block">{{ $viewArchiveData->title }}</h3>
    <p class="text-sm">Submitted by
        <span class="font-bold">{{ $viewArchiveData->user->first_name . " " . $viewArchiveData->user->last_name }}</span>
        <span> on {{ $viewArchiveData->created_at->format('M d, Y H:i A') }}</span>
    </p>
</div>
<div class="pt-4 pb-10 border-t border-gray-300 space-y-4">
    <h3 class="text-lg max-w-3xl font-bold leading-6 text-gray-900 inline-block">Project Year:</h3>
    <p>{{ $viewArchiveData->year }}</p>
    <h3 class="text-lg max-w-3xl font-bold leading-6 text-gray-900 inline-block pt-4">Abstract:</h3>
    <p>{!! $viewArchiveData->abstract !!}</p>
    <h3 class="text-lg max-w-3xl font-bold leading-6 text-gray-900 inline-block pt-4">Project Members:</h3>
    <p>{!! $viewArchiveData->members !!}</p>
    <div class="space-x-2 py-6">
        <a href="{{ $viewArchiveData->document_path }}" target="_blank" class="py-3 px-4 bg-gray-500 hover:bg-opacity-80 duration-200 text-white"><i class="fa-solid fa-download mr-1"></i> Download File</a>
    </div>
</div>
</div>
</div>

@endsection