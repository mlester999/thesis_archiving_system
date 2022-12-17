@extends('master')
@section('user')

@php
if (count($errors) > 0) {
  RealRashid\SweetAlert\Facades\Alert::warning("Fields is Required", "You need to fill in the input fields.")->showConfirmButton('Okay', '#2678c5')->autoClose(6000);
}
@endphp

<div class="bg-white shadow-xl rounded-lg max-w-xl md:max-w-2xl lg:max-w-4xl xl:max-w-7xl mx-8 sm:mx-auto my-8 relative">
<div class="px-4 py-8 sm:px-6">
    <h3 class="text-2xl font-bold leading-6 text-gray-900 inline-block">Submit Thesis / Capstone</h3>
    <p class="mt-1 max-w-2xl text-sm text-gray-500">Please submit your thesis file along with its e-signature verification.</p>
</div>
<div class="border-t border-gray-200">
<dl>
<form x-data="{ buttonDisabled: false }" x-on:submit="buttonDisabled = true" action="{{ route('store.thesis') }}" method="post" enctype="multipart/form-data">
@csrf
<div class="bg-gray px-4 pt-8 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
        <div class="relative px-8">
            <label for="title" class="text-sm font-semibold text-gray-900">Project Title:</label>
        <input type="text" name="title" id="title" placeholder="Project Title" value="{{ old('title') }}" class="w-full text-black h-10 mt-2 bg-white focus:ring-green-500 focus:border-green-500 rounded-md px-3 focus:outline-none" autofocus>
        </div>
        <div class="relative px-8 pt-8 sm:pt-0">
            <label for="year" class="text-sm font-semibold text-gray-900">Year:</label>
            <select id="year" name="year" class="w-full text-black h-10 mt-2 bg-white focus:ring-green-500 focus:border-green-500 rounded-md px-3 focus:outline-none">
                <option value="0" hidden>~ Select Year ~</option>
                @for ($year=date('Y'); $year >= 2000; $year--)
                <option value="{{ $year }}" {{ old('year') == $year ? 'selected' : '' }}> {{ $year }} </option>
                @endfor
                </select>
        </div>
        <div class="relative px-8 pt-8 sm:pt-0">
            <label for="year" class="text-sm font-semibold text-gray-900">Research Agenda:</label>
            <select name="research_agenda" id="research_agenda" class="border mt-2 mb-8 px-3 border-gray-500 text-gray-900 rounded-md focus:ring-1 focus:ring-green-500 focus:border-green-500 placeholder:font-sans placeholder:font-light focus:outline-none block w-full">
                <option value="0" hidden>~ Select Research Agenda ~</option>
                @foreach ($agendaData as $agenda)
                <option value="{{ $agenda->agenda_name }}" {{ old('research_agenda') == $agenda->agenda_name ? 'selected' : '' }}> {{ $agenda->agenda_name }} </option>
                @endforeach
                </select>
        </div>
</div>

<div class="bg-gray px-4 py-5 sm:grid sm:grid-cols-1 sm:gap-4 sm:px-6">
    <div class="relative px-8 space-y-2">
        <label for="abstract" class="text-sm font-semibold text-gray-900">Abstract:</label>
    <textarea name="abstract" id="abstract">{{ old('abstract') }}</textarea>
    </div>
</div>

<div class="bg-gray px-4 py-5 sm:grid sm:grid-cols-1 sm:gap-4 sm:px-6">
    <div class="relative px-8 space-y-2">
        <label for="members" class="text-sm font-semibold text-gray-900">Project Members:</label>
    <textarea name="members" id="members">{{ old('members') }}</textarea>
    </div>
</div>

<div class="bg-gray px-4 py-5 sm:grid sm:grid-cols-1 sm:gap-4 sm:px-6">
    <div class="relative px-8 space-y-2">
        <label for="keywords" class="text-sm font-semibold text-gray-900">Keywords:</label>
        <input type="text" name="keywords" id="keywords" placeholder="Keywords" value="{{ old('keywords') }}" class="w-full text-black h-10 mt-2 bg-white focus:ring-green-500 focus:border-green-500 rounded-md px-3 focus:outline-none">
    </div>
</div>

<div class="bg-gray px-4 py-5 sm:grid sm:grid-cols-1 sm:gap-4 sm:px-6">
    <div class="relative px-8 space-y-2">
        <label for="document_path" class="text-sm font-semibold text-gray-900">Full Project Document (Max: 10MB | PDF File only)</label>
        <input id="document_path" value="{{ old('document_path') }}" accept="application/pdf" name="document_path" class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer focus:outline-none" type="file">
    </div>
</div>

<div class="bg-gray px-4 py-5 sm:grid sm:grid-cols-1 sm:gap-4 sm:px-6">
    <div class="relative px-8 space-y-2">
        <label for="signature_path" class="text-sm font-semibold text-gray-900">IMRAD Document (Max: 10MB | PDF File only)</label>
        <input id="signature_path" value="{{ old('imrad_path') }}" accept="application/pdf" name="imrad_path" class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer focus:outline-none" type="file">
    </div>
</div>

<div class="bg-gray px-4 py-5 sm:grid sm:grid-cols-1 sm:gap-4 sm:px-6">
    <div class="relative px-8 space-y-2">
        <label for="signature_path" class="text-sm font-semibold text-gray-900">E-Signature Document (Max: 10MB | PDF File only)</label>
        <input id="signature_path" value="{{ old('signature_path') }}" accept="application/pdf" name="signature_path" class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer focus:outline-none" type="file">
    </div>
</div>

<div class="bg-white px-4 mx-6 xl:mx-32 py-6 grid grid-cols-2 gap-4 sm:px-6">
    <a href="{{ route('home') }}" x-bind:class="buttonDisabled ? 'cursor-not-allowed pointer-events-none' : 'cursor-pointer' " class="text-xs sm:text-sm md:text-base w-full md:w-auto flex justify-center items-center space-x-4 font-sans font-bold text-slate-800 rounded-md p-2 border-gray-700 bg-transparent shadow-cyan-100 hover:bg-slate-50 shadow-sm hover:shadow-lg border transition hover:-translate-y-0.5 duration-150">Cancel</a>
    <button 
    type="submit"
    x-cloak
    x-data="{loading: false}"
    x-on:click="loading = true"
    x-html="loading ? `<svg class='inline w-4 h-4 md:w-6 md:h-6 text-gray-200 animate-spin dark:text-gray-600 fill-gray-600 dark:fill-gray-300' viewBox='0 0 100 101' fill='none' xmlns='http://www.w3.org/2000/svg'>
        <path d='M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z' fill='currentColor'/>
        <path d='M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z' fill='currentFill'/>
    </svg>
    <span class='sr-only'>Loading...</span>` : 'Submit'"
    x-bind:disabled="buttonDisabled"
    x-bind:class="buttonDisabled ? 'cursor-not-allowed' : 'cursor-pointer' "
    class="text-xs sm:text-sm md:text-base w-full md:w-auto bg-green-500 bg-opacity-40 md:h-12 flex justify-center items-center p-2 space-x-4 font-sans font-bold text-white rounded-md px-8 border transition duration-150"
    :class="loading ? 'bg-green-500 bg-opacity-100 hover:bg-opacity-90 hover:-translate-y-0.5 shadow-lg hover:shadow-xl' : 'bg-green-500 bg-opacity-100 hover:bg-opacity-90 hover:-translate-y-0.5 shadow-lg hover:shadow-xl' ">
</div>
</form>
</dl>
</div>
</div>

@endsection

@section('editor')
<script>
    ClassicEditor
        .create( document.querySelector( '#abstract' ) )
        .catch( error => {
            console.error( error );
        } );

        ClassicEditor
        .create( document.querySelector( '#members' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
@endsection