@extends('master')
@section('user')

    @php 
        $userInfo = App\Models\User::find($viewArchiveData->user_id);
    @endphp

<div class="overflow-hidden bg-white shadow-xl sm:rounded-lg max-w-6xl mx-auto mt-8 relative">
    <div class="px-4 pt-5 sm:px-6">
        <p class="py-2 font-medium">Archive Code: {{ $viewArchiveData->archive_code }}</p>
        <div class="py-10 border-t border-gray-300 space-y-4">
            <h3 class="text-2xl max-w-3xl font-bold leading-6 text-gray-900 inline-block">{{ $viewArchiveData->title }}</h3>
            <p class="text-sm">Submitted by
                <span class="font-bold">{{ $userInfo->first_name . " " . $userInfo->last_name }}</span>
                <span> on {{ $viewArchiveData->created_at->format('M d, Y H:i A') }}</span>
            </p>
            <div class="space-x-2 pt-2">
            <a href="{{ route('edit.archives', $viewArchiveData->id) }}" class="py-3 px-4 bg-green-500 text-white"><i class="fa-solid fa-pen-to-square mr-1"></i> Edit</a>
            <a href="{{ route('edit.archives', $viewArchiveData->id) }}" class="py-3 px-4 bg-red-500 text-white"><i class="fa-solid fa-trash mr-1"></i> Delete</a>
            </div>
        </div>
        <div class="pt-4 pb-10 border-t border-gray-300 space-y-4">
            <h3 class="text-lg max-w-3xl font-bold leading-6 text-gray-900 inline-block">Project Year:</h3>
            <p>{{ $viewArchiveData->year }}</p>
            <h3 class="text-lg max-w-3xl font-bold leading-6 text-gray-900 inline-block">Abstract:</h3>
            <p>{!! $viewArchiveData->abstract !!}</p>
            <h3 class="text-lg max-w-3xl font-bold leading-6 text-gray-900 inline-block">Project Members:</h3>
            <p>{!! $viewArchiveData->members !!}</p>
            <div class="space-x-2 pt-2">
                <a href="{{ $viewArchiveData->document_path }}" class="py-3 px-4 bg-gray-500 text-white"><i class="fa-solid fa-download mr-1"></i> Download File</a>
                </div>
        </div>
    </div>
</div>

@endsection