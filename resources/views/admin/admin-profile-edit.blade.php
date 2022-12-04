@extends('admin.admin-master')
@section('admin')

        @php
            if (count($errors) > 0) {
              RealRashid\SweetAlert\Facades\Alert::warning("Fields is Required", "You need to fill in the input fields.")->showConfirmButton('Okay', '#2678c5')->autoClose(6000);
            }
        @endphp

    <div class="bg-slate-100 h-screen w-full overflow-y-auto">
    <div class="px-8 py-4">
        <h5 class="pb-6 pt-3 font-bold leading-7 text-xl md:text-2xl sm:truncate uppercase">Edit Profile</h5>

        {{-- First Container --}}
        <div class="p-6 bg-white rounded-lg flex items-center h-full shadow-md">
            <div class="w-full lg:w-3/5 flex flex-col justify-start">
                <form x-data="{ buttonDisabled: false }" x-on:submit="buttonDisabled = true" action="{{ route('admin.store.profile') }}" method="post">
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

            <div class="w-2/5 hidden lg:flex justify-center">
                
                <img src="{{ asset('images/library_logo.png') }}" alt="" class="w-3/5">
            </div>
        </div>

        @include('admin.body.footer')
    </div>
</div>
@endsection