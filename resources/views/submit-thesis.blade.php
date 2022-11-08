@extends('master')
@section('user')

@php
if (count($errors) > 0) {
  RealRashid\SweetAlert\Facades\Alert::warning("Fields is Required", "You need to fill in the input fields.")->showConfirmButton('Okay', '#2678c5')->autoClose(6000);
}
@endphp

<div class="bg-white shadow-xl rounded-lg max-w-md sm:max-w-xl md:max-w-2xl lg:max-w-4xl xl:max-w-7xl mx-auto my-8 relative">
<div class="px-4 py-8 sm:px-6">
<h3 class="text-2xl font-bold leading-6 text-gray-900 inline-block">Submit Thesis / Capstone</h3>
{{-- <a href="#"><i class="fa-solid fa-pen-to-square fa-2xl text-green-500 hover:text-green-600 duration-200 absolute right-6 top-8"></i></a> --}}
{{-- <p class="mt-1 max-w-2xl text-sm text-gray-500">Submit thesis projects.</p> --}}
</div>
<div class="border-t border-gray-200">
<dl>
<form action="{{ route('store.thesis') }}" method="post" enctype="multipart/form-data">
@csrf
<div class="bg-gray px-4 py-8 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6">
        <div class="relative px-8">
            <label for="title" class="text-sm font-semibold text-gray-900">Project Title:</label>
        <input type="text" name="title" id="title" placeholder="Project Title" class="w-full text-black h-10 mt-2 bg-white focus:ring-green-500 focus:border-green-500 rounded-md px-3 focus:outline-none" autofocus>
        {{-- <x-input-error :messages="$errors->get('first_name')" class="mt-2"/> --}}
        </div>
        <div class="relative px-8 pt-8 sm:pt-0">
            <label for="year" class="text-sm font-semibold text-gray-900">Year:</label>
        <input type="text" name="year" id="year" placeholder="Project Year" class="w-full text-black h-10 mt-2 bg-white focus:ring-green-500 focus:border-green-500 rounded-md px-3 focus:outline-none">
        {{-- <x-input-error :messages="$errors->get('first_name')" class="mt-2"/> --}}
        </div>
</div>

<div class="bg-gray px-4 py-5 sm:grid sm:grid-cols-1 sm:gap-4 sm:px-6">
    <div class="relative px-8 space-y-2">
        <label for="abstract" class="text-sm font-semibold text-gray-900">Abstract:</label>
    <textarea name="abstract" id="abstract"> </textarea>
    {{-- <x-input-error :messages="$errors->get('first_name')" class="mt-2"/> --}}
    </div>
</div>

<div class="bg-gray px-4 py-5 sm:grid sm:grid-cols-1 sm:gap-4 sm:px-6">
    <div class="relative px-8 space-y-2">
        <label for="members" class="text-sm font-semibold text-gray-900">Project Members:</label>
    <textarea name="members" id="members"> </textarea>
    {{-- <x-input-error :messages="$errors->get('first_name')" class="mt-2"/> --}}
    </div>
</div>

<div class="bg-gray px-4 py-5 sm:grid sm:grid-cols-1 sm:gap-4 sm:px-6">
    <div class="relative px-8 space-y-2">
    <label for="document_path" class="text-sm font-semibold text-gray-900">Project Document (PDF File only)</label>
    <input id="document_path" name="document_path" class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer focus:outline-none" type="file">
    </div>
</div>

<div class="bg-white px-4 mx-6 xl:mx-32 py-6 grid grid-cols-2 gap-4 sm:px-6">
<a href="{{ route('home') }}" class="cursor-pointer text-xs sm:text-sm md:text-base w-full md:w-auto flex justify-center items-center space-x-4 font-sans font-bold text-slate-800 rounded-md p-2 border-gray-700 bg-transparent shadow-cyan-100 hover:bg-slate-50 shadow-sm hover:shadow-lg border transition hover:-translate-y-0.5 duration-150">Cancel</a>
<x-primary-button class="mx-2 py-3 text-xs sm:text-sm md:text-base">Submit Thesis</x-primary-button>
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