@extends('master')
@section('user')

@php
if (count($errors) > 0) {
  RealRashid\SweetAlert\Facades\Alert::warning("Fields is Required", "You need to fill in the input fields.")->showConfirmButton('Okay', '#2678c5')->autoClose(6000);
}
@endphp

<div class="bg-white shadow-xl sm:rounded-lg max-w-5xl mx-auto my-8 relative">
<div class="px-4 py-5 sm:px-6">
<h3 class="text-2xl font-bold leading-6 text-gray-900 inline-block">Submit Thesis / Capstone</h3>
{{-- <a href="#"><i class="fa-solid fa-pen-to-square fa-2xl text-green-500 hover:text-green-600 duration-200 absolute right-6 top-8"></i></a> --}}
<p class="mt-1 max-w-2xl text-sm text-gray-500">Submit thesis projects.</p>
</div>
<div class="border-t border-gray-200">
<dl>
<form action="{{ route('store.profile') }}" method="post">
@csrf
<div class="bg-gray px-4 py-5 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6">
        <div class="relative px-8">
            <label for="title" class="text-sm font-semibold text-gray-900">Project Title:</label>
        <input type="text" name="title" id="title" placeholder="Project Title" class="w-full text-black h-10 mt-2 bg-white focus:ring-green-500 focus:border-green-500 rounded-md px-3 focus:outline-none" autofocus>
        {{-- <x-input-error :messages="$errors->get('first_name')" class="mt-2"/> --}}
        </div>
        <div class="relative px-8">
            <label for="year" class="text-sm font-semibold text-gray-900">Year:</label>
        <input type="text" name="year" id="year" placeholder="Project Year" class="w-full text-black h-10 mt-2 bg-white focus:ring-green-500 focus:border-green-500 rounded-md px-3 focus:outline-none">
        {{-- <x-input-error :messages="$errors->get('first_name')" class="mt-2"/> --}}
        </div>
</div>

<div class="bg-gray px-4 py-5 sm:grid sm:grid-cols-1 sm:gap-4 sm:px-6">
    <div class="relative px-8 space-y-2">
        <label for="abstract" class="text-sm font-semibold text-gray-900">Abstract:</label>
    <input type="text" name="abstract" id="abstractEditor">
    {{-- <x-input-error :messages="$errors->get('first_name')" class="mt-2"/> --}}
    </div>
</div>

<div class="bg-gray px-4 py-5 sm:grid sm:grid-cols-1 sm:gap-4 sm:px-6">
    <div class="relative px-8 space-y-2">
        <label for="members" class="text-sm font-semibold text-gray-900">Project Members:</label>
    <input type="text" name="members" id="membersEditor">
    {{-- <x-input-error :messages="$errors->get('first_name')" class="mt-2"/> --}}
    </div>
</div>

{{-- Banner Path --}}
<div class="bg-gray px-4 py-5 sm:grid sm:grid-cols-1 sm:gap-4 sm:px-6">
    <label for="banner_path" class="text-sm font-semibold text-gray-900 ml-8 -mb-2">Project Image / Banner Image</label>
    <div class="flex justify-center items-center w-full">
        <label for="banner_path" class="flex flex-col justify-center items-center w-full h-64 bg-gray-100 mx-8 focus:outline-none rounded-lg border-2 border-gray-400 border-dashed cursor-pointer">
            <div class="flex flex-col justify-center items-center pt-5 pb-6">
                <svg aria-hidden="true" class="mb-3 w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
            </div>
            <input id="banner_path" name="banner_path" type="file" class="hidden" />
        </label>
    </div> 
</div>

<div class="bg-gray px-4 py-5 sm:grid sm:grid-cols-1 sm:gap-4 sm:px-6">
    <div class="relative px-8 space-y-2">
    <label for="document_path" class="text-sm font-semibold text-gray-900">Project Document (PDF File only)</label>
    <input id="document_path" name="document_path" class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer focus:outline-none" type="file">
    </div>
</div>

<div class="bg-white px-4 mx-32 py-6 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6">
<a href="{{ route('home') }}" class="cursor-pointer w-full md:w-auto flex justify-center items-center space-x-4 font-sans font-bold text-slate-800 rounded-md p-2 border-gray-700 bg-transparent shadow-cyan-100 hover:bg-slate-50 shadow-sm hover:shadow-lg border transition hover:-translate-y-0.5 duration-150">Cancel</a>
<x-primary-button class="mx-2 py-3">Submit Thesis</x-primary-button>
</div>
</form>
</dl>
</div>
</div>

@endsection

@section('editor')
<script>
    ClassicEditor
        .create( document.querySelector( '#abstractEditor' ) )
        .catch( error => {
            console.error( error );
        } );

        ClassicEditor
        .create( document.querySelector( '#membersEditor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
@endsection