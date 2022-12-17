@extends('admin.admin-master')
@section('admin')

        @php
            if (count($errors) > 0) {
              RealRashid\SweetAlert\Facades\Alert::warning("Fields is Required", "You need to fill in the input fields.")->showConfirmButton('Okay', '#2678c5')->autoClose(6000);
            }
        @endphp

    <div class="bg-slate-100 h-screen w-full overflow-y-auto">
    <div class="px-8 py-4">
        <p class="pb-6 pt-3 font-bold uppercase text-sm leading-7 tracking-wider text-gray-600"><span class="flex items-center gap-1"> <x-ri-home-3-fill class="w-4 h-4" /> Home<x-heroicon-o-arrow-long-right class="w-5 h-6" />Menu<x-heroicon-o-arrow-long-right class="w-5 h-6" />View Profile<x-heroicon-o-arrow-long-right class="w-5 h-6" />Edit Profile</span></p>

        {{-- First Container --}}
        <div x-data="{ buttonDisabled: false }" class="p-6 bg-white max-w-2xl mx-auto rounded-lg flex items-center h-full shadow-md">
            
            <div x-show="buttonDisabled">
                <x-normal-loading />
            </div>

            <div class="w-full flex flex-col justify-start">
                <form x-on:submit="buttonDisabled = true" action="{{ route('admin.store.profile') }}" method="post">
                    @csrf

                <ul class="py-4 px-4">
                    <label id="name" class="font-bold text-sm md:text-md text-gray-900">Name:</label>
                    <input type="text" name="name" id="name" class="w-full text-black h-10 mt-2 bg-white rounded-md px-3 focus:outline-none focus:ring-1 focus:ring-green-500 focus:border-green-500" value="{{ $editAdminData->name }}" autofocus>
                    {{-- <x-input-error :messages="$errors->get('first_name')" class="mt-2" /> --}}
                </ul>

                <ul class="py-4 px-4">
                    <label id="username" class="font-bold text-sm md:text-md text-gray-900">Username:</label>
                    <input type="text" name="username" id="username" class="w-full text-black h-10 mt-2 bg-white rounded-md px-3 focus:outline-none focus:ring-1 focus:ring-green-500 focus:border-green-500" value="{{ $editAdminData->username }}">
                    {{-- <x-input-error :messages="$errors->get('username')" class="mt-2" /> --}}
                </ul>

                <ul class="py-4 px-4">
                    <label id="email" class="font-bold text-sm md:text-md text-gray-900">Email:</label>
                    <input type="text" name="email" id="email" class="w-full text-black h-10 mt-2 bg-white rounded-md px-3 focus:outline-none focus:ring-1 focus:ring-green-500 focus:border-green-500" value="{{ $editAdminData->email }}">
                    {{-- <x-input-error :messages="$errors->get('email')" class="mt-2" /> --}}
                </ul>

                <div class="flex justify-center mt-4 mx-6 md:mx-0">
                    <x-primary-button x-bind:disabled="buttonDisabled" x-bind:class="buttonDisabled ? 'cursor-not-allowed' : 'cursor-pointer' " class="mt-2">Update Profile</x-primary-button>
                </div>

            </form>
            </div>
        </div>

        @include('admin.body.footer')
    </div>
</div>
@endsection