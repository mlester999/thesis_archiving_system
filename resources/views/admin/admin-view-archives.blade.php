@extends('admin.admin-master')
@section('admin')

<div class="overflow-y-auto h-screen bg-white shadow-xl w-full mx-8 md:mx-16 relative">
<div class="px-8 pt-5 sm:px-8">
<p class="py-2 text-sm md:text-lg font-medium flex justify-between">
    Archive Code: {{ $viewArchiveData->archive_code }}
    <span><a href="{{ url('admin/archive-list') }}" class="text-sm md:text-lg text-blue-500 hover:text-blue-400 duration-150">Back </a></span>
</p>

<div class="py-10 border-t border-gray-300 space-y-4">
    <h3 class="text-lg md:text-xl lg:text-2xl max-w-3xl font-bold leading-6 text-gray-900 inline-block">{{ $viewArchiveData->title }}</h3>
    <p class="text-xs sm:text-sm md:text-base">Submitted by
        <span class="font-bold">{{ $viewArchiveData->user->first_name . " " . $viewArchiveData->user->middle_name[0] . ". " . $viewArchiveData->user->last_name }}</span>
        <span> on {{ $viewArchiveData->created_at->format('M d, Y H:i A') }}</span>
    </p>
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
    <h3 class="text-sm md:text-lg max-w-3xl font-bold leading-6 text-gray-900 inline-block">Keywords:</h3>
    <p class="text-sm md:text-lg">{{ $viewArchiveData->keywords }}</p>

    @if($viewArchiveData->archive_status < 2)
    <div class="space-y-2 md:space-y-0 md:space-x-2 py-6 relative flex flex-col md:block">
        <a href="{{ $viewArchiveData->document_path }}" target="_blank" class="py-3 px-4 bg-gray-500 hover:bg-opacity-80 duration-200 text-white text-xs md:text-base text-center md:text-left"><i class="fa-solid fa-download mr-1"></i> Download Thesis File</a>
        <a href="{{ $viewArchiveData->signature_path }}" target="_blank" class="py-3 px-4 bg-gray-500 hover:bg-opacity-80 duration-200 text-white text-xs md:text-base text-center md:text-left"><i class="fa-solid fa-download mr-1"></i> Download E-Signature File</a>
    </div>
    @endif
</div>
</div>
</div>

@endsection