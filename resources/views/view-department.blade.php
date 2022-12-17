@extends('master')
@section('user')

<div class="overflow-hidden bg-white shadow-xl rounded-lg max-w-xl md:max-w-2xl lg:max-w-4xl xl:max-w-7xl mx-8 sm:mx-auto my-8 relative">
    <div class="px-8 pt-5 sm:px-8">
        <p class="py-2 text-sm md:text-lg font-medium flex justify-between">
            Archive Code: {{ $viewDepartmentData->archive_code }}
            <span><a href="{{ route('department', strtolower($viewDepartmentData->department->dept_name)) }}" class="text-blue-500 hover:text-blue-400 duration-150 text-sm md:text-lg">Back </a></span>
        </p>
        <div x-data="{
            bookmark: {{ $hasBookmark }}, 
        }" class="py-8 border-t border-gray-300 space-y-4">
        <h3 class="text-lg md:text-xl lg:text-2xl max-w-3xl font-bold leading-6 text-gray-900 inline-block">{{ $viewDepartmentData->title }}</h3>
        <p class="text-xs sm:text-sm md:text-base">Submitted by
            <span class="font-bold">{{ $viewDepartmentData->user->first_name . " " . $viewDepartmentData->user->last_name }}</span>
            <span> on {{ $viewDepartmentData->created_at->format('M d, Y H:i A') }}</span>
        </p>
        @can('Bookmark Thesis')
            @if($viewDepartmentData->user_id !== $user->id)
                <form action="{{ route('bookmark.department', $viewDepartmentData->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <button x-cloak :class="bookmark ? 'bg-green-400' : 'bg-white'" class="px-14 py-3 hover:bg-green-300 rounded-lg border border-1 border-black duration-150 text-sm md:text-base">
                    <i :class="bookmark ? 'fa-solid' : 'fa-regular'" class="fa-regular fa-bookmark fa-xl pr-2"></i> 
                    {{ $hasBookmark ? 'Bookmarked' : 'Bookmark' }}
                </button>
                </form>
            @endif
        @endcan
        </div>
        <div class="pt-4 pb-10 border-t border-gray-300 space-y-3">
            <h3 class="text-sm md:text-lg max-w-3xl font-bold leading-6 text-gray-900 inline-block">Project Year:</h3>
            <p class="text-sm md:text-lg">{{ $viewDepartmentData->year }}</p>
            <h3 class="text-sm md:text-lg max-w-3xl font-bold leading-6 text-gray-900 inline-block pt-4">Research Agenda:</h3>
            <p class="text-sm md:text-lg">{{ $viewDepartmentData->research_agenda->agenda_name }}</p>
            <h3 class="text-sm md:text-lg max-w-3xl font-bold leading-6 text-gray-900 inline-block pt-4">Abstract:</h3>
            <p class="text-sm md:text-lg">{!! $viewDepartmentData->abstract !!}</p>
            <h3 class="text-sm md:text-lg max-w-3xl font-bold leading-6 text-gray-900 inline-block pt-4">Project Members:</h3>
            <p class="text-sm md:text-lg">{!! $viewDepartmentData->members !!}</p>
            <h3 class="text-sm md:text-lg max-w-3xl font-bold leading-6 text-gray-900 inline-block">Keywords:</h3>
            <p class="text-sm md:text-lg">{{ $viewDepartmentData->keywords }}</p>
            <div class="space-y-2 py-6 relative flex flex-col lg:block lg:space-x-2 lg:space-y-0 md:w-max">
                <form class="inline-block" action="{{ route('download.thesis', $viewDepartmentData->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <button name="fullThesis" class="w-full my-1 lg:my-0 md:w-auto py-3 px-4 bg-gray-500 hover:bg-opacity-80 duration-200 text-white text-xs md:text-base text-center md:text-left"><i class="fa-solid fa-download mr-1"></i> Download Thesis File</button>
                    {{-- <button name="imradThesis" class="w-full my-1 lg:my-0 md:w-auto py-3 px-4 bg-gray-500 hover:bg-opacity-80 duration-200 text-white text-xs md:text-base text-center md:text-left"><i class="fa-solid fa-download mr-1"></i> Download IMRAD File</button> --}}
                </form>

                <form class="inline-block" action="{{ route('download.imrad', $viewDepartmentData->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{-- <button name="fullThesis" class="w-full my-1 lg:my-0 md:w-auto py-3 px-4 bg-gray-500 hover:bg-opacity-80 duration-200 text-white text-xs md:text-base text-center md:text-left"><i class="fa-solid fa-download mr-1"></i> Download Thesis File</button> --}}
                    <button name="imradThesis" class="w-full my-1 lg:my-0 md:w-auto py-3 px-4 bg-gray-500 hover:bg-opacity-80 duration-200 text-white text-xs md:text-base text-center md:text-left"><i class="fa-solid fa-download mr-1"></i> Download IMRAD File</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection