@extends('master')
@section('user')

    @php 
        $userInfo = App\Models\User::find($viewDepartmentData->user_id);
        $departmentData = App\Models\Department::find($viewDepartmentData->department_id);
    @endphp

<div class="overflow-hidden bg-white shadow-xl rounded-lg max-w-md sm:max-w-xl md:max-w-2xl lg:max-w-4xl xl:max-w-7xl mx-auto my-8 relative">
    <div class="px-8 pt-5 sm:px-8">
        <p class="py-2 text-lg font-medium flex justify-between">
            Archive Code: {{ $viewDepartmentData->archive_code }}
            <span><a href="{{ url()->previous() }}" class="text-blue-500 hover:text-blue-400 duration-150">Back </a></span>
        </p>
        <div x-data="{
            bookmark: {{ $hasBookmark }}, 
            }" class="py-8 border-t border-gray-300 space-y-4">
            <h3 class="text-2xl max-w-3xl font-bold leading-6 text-gray-900 inline-block">{{ $viewDepartmentData->title }}</h3>
            <p class="text-sm">Submitted by
                <span class="font-bold">{{ $userInfo->first_name . " " . $userInfo->last_name }}</span>
                <span> on {{ $viewDepartmentData->created_at->format('M d, Y H:i A') }}</span>
            </p>
            <form action="{{ route('bookmark.department', $viewDepartmentData->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <button x-cloak :class="bookmark ? 'bg-slate-300' : 'bg-white'" class="px-14 py-3 hover:bg-slate-200 rounded-lg border border-1 border-black duration-150">
                <i :class="bookmark ? 'fa-solid' : 'fa-regular'" class="fa-regular fa-bookmark fa-xl pr-2"></i> 
                {{ $hasBookmark ? 'Bookmarked' : 'Bookmark' }}
            </button>
        </div>
        <div class="pt-4 pb-10 border-t border-gray-300 space-y-4">
            <h3 class="text-lg max-w-3xl font-bold leading-6 text-gray-900 inline-block">Project Year:</h3>
            <p>{{ $viewDepartmentData->year }}</p>
            <h3 class="text-lg max-w-3xl font-bold leading-6 text-gray-900 inline-block pt-4">Abstract:</h3>
            <p>{!! $viewDepartmentData->abstract !!}</p>
            <h3 class="text-lg max-w-3xl font-bold leading-6 text-gray-900 inline-block pt-4">Project Members:</h3>
            <p>{!! $viewDepartmentData->members !!}</p>
            <div class="space-x-2 py-6 relative">
                <a href="{{ $viewDepartmentData->document_path }}" target="_blank" class="py-3 px-4 bg-gray-500 hover:bg-opacity-80 duration-200 text-white"><i class="fa-solid fa-download mr-1"></i> Download File</a>
            </div>
        </div>
    </div>
</div>

@endsection