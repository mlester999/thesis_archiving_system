@extends('master')
@section('user')

    @php 
        $userInfo = App\Models\User::find($viewDepartmentData->user_id);
        $departmentData = App\Models\Department::find($viewDepartmentData->department_id);
    @endphp

<div class="overflow-hidden bg-white shadow-xl sm:rounded-lg max-w-6xl mx-auto my-8 relative">
    <div class="px-4 pt-5 sm:px-8">
        <p class="py-2 text-lg font-medium flex justify-between">
            Archive Code: {{ $viewDepartmentData->archive_code }}
            <span><a href="{{ route('department', strtolower($departmentData->dept_name)) }}" class="text-blue-500 hover:text-blue-400 duration-150">Back </a></span>
        </p>
        <div class="py-10 border-t border-gray-300 space-y-4">
            <h3 class="text-2xl max-w-3xl font-bold leading-6 text-gray-900 inline-block">{{ $viewDepartmentData->title }}</h3>
            <p class="text-sm">Submitted by
                <span class="font-bold">{{ $userInfo->first_name . " " . $userInfo->last_name }}</span>
                <span> on {{ $viewDepartmentData->created_at->format('M d, Y H:i A') }}</span>
            </p>
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