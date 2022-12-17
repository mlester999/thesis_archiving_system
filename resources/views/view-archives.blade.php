@extends('master')
@section('user')

<div class="overflow-hidden bg-white shadow-xl rounded-lg max-w-xl md:max-w-2xl lg:max-w-4xl xl:max-w-7xl mx-8 sm:mx-auto my-8 relative">
    <div class="px-8 pt-5 sm:px-8">
        <p class="py-2 text-sm md:text-lg font-medium flex justify-between">
            Archive Code: {{ $viewArchiveData->archive_code }}
            <span><a href="{{ route('archives') }}" class="text-sm md:text-lg text-blue-500 hover:text-blue-400 duration-150">Back </a></span>
        </p>
        <div class="py-10 border-t border-gray-300 space-y-4">
            <h3 class="text-lg md:text-xl lg:text-2xl max-w-3xl font-bold leading-6 text-gray-900 inline-block">{{ $viewArchiveData->title }}</h3>
            <p class="text-xs sm:text-sm md:text-base">Submitted by
                <span class="font-bold">{{ $viewArchiveData->user->first_name . " " . $viewArchiveData->user->middle_name[0] . ". " . $viewArchiveData->user->last_name }}</span>
                <span> on {{ $viewArchiveData->created_at->format('M d, Y H:i A') }}</span>
            </p>
            @if($viewArchiveData->archive_status == 0)
            <div class="space-x-2 pt-2">
                <a href="{{ route('edit.archives', $viewArchiveData->archive_code) }}" class="py-3 px-4 text-xs md:text-base bg-blue-500 hover:bg-opacity-80 duration-150 text-white"><i class="fa-solid fa-pen-to-square mr-1"></i> Edit</a>
            </div>
            @endif
        </div>
        <div class="pt-4 pb-10 border-t border-gray-300 space-y-3">
            <h3 class="text-sm md:text-lg max-w-3xl font-bold leading-6 text-gray-900 inline-block">Project Year:</h3>
            <p class="text-sm md:text-lg">{{ $viewArchiveData->year }}</p>
            <h3 class="text-sm md:text-lg max-w-3xl font-bold leading-6 text-gray-900 inline-block pt-4">Research Agenda:</h3>
            <p class="text-sm md:text-lg">{{ $viewArchiveData->research_agenda->agenda_name }}</p>
            <h3 class="text-sm md:text-lg max-w-3xl font-bold leading-6 text-gray-900 inline-block pt-4">Abstract:</h3>
            <p class="text-sm md:text-lg">{!! $viewArchiveData->abstract !!}</p>
            <h3 class="text-sm md:text-lg max-w-3xl font-bold leading-6 text-gray-900 inline-block pt-4">Project Members:</h3>
            <p class="text-sm md:text-lg">{!! $viewArchiveData->members !!}</p>
            <h3 class="text-sm md:text-lg max-w-3xl font-bold leading-6 text-gray-900 inline-block pt-4">Keywords:</h3>
            <p class="text-sm md:text-lg">{{ $viewArchiveData->keywords }}</p>
            <div class="space-y-2 py-6 relative flex flex-col lg:block lg:space-x-2 lg:space-y-0 md:w-max">
                @if($viewArchiveData->archive_status < 2)
                <a href="{{ $viewArchiveData->document_path }}" target="_blank" class="py-3 px-4 bg-gray-500 hover:bg-opacity-80 duration-200 text-white text-sm md:text-base text-center md:text-left"><i class="fa-solid fa-download mr-1"></i> Download Full Thesis File</a>
                <a href="{{ $viewArchiveData->imrad_path }}" target="_blank" class="py-3 px-4 bg-gray-500 hover:bg-opacity-80 duration-200 text-white text-sm md:text-base text-center md:text-left"><i class="fa-solid fa-download mr-1"></i> Download IMRAD File</a>
                <a href="{{ $viewArchiveData->signature_path }}" target="_blank" class="py-3 px-4 bg-gray-500 hover:bg-opacity-80 duration-200 text-white text-sm md:text-base text-center md:text-left"><i class="fa-solid fa-download mr-1"></i> Download E-Signature File</a>
                @endif
                
                @if($viewArchiveData->admin_comment)
                <div class="inline-flex absolute right-10 top-0 flex-col px-5 py-1.5 rounded-full bg-gray-200 text-black tracking-[-0.4px]">
                    <p class="font-bold text-sm md:text-md">Admin Comment:</p>
                    <p class="text-sm md:text-md font-medium">{{ $viewArchiveData->admin_comment }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection