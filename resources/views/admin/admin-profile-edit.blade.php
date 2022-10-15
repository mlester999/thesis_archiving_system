@extends('admin.admin-master')
@section('admin')

<div class="bg-slate-200 h-screen w-full overflow-y-auto">
    <div class="px-8 py-4">
        <h5 class="pb-6 pt-3 font-bold uppercase">Admin Edit Profile</h5>

        {{-- First Container --}}
        <div class="p-6 bg-white rounded-lg flex items-center h-full shadow-md">
            <div class="w-3/5 flex flex-col justify-start">
                <form action="{{ route('admin.store.profile') }}" method="post">
                    @csrf

                <ul class="py-4 px-4">
                    <label id="first_name" class="font-medium text-gray-600">First Name:</label>
                    <input type="text" name="first_name" id="first_name" class="w-full text-black h-10 mt-2 bg-gray-100 rounded-md px-3 focus:outline-none" value="{{ $editAdminData->first_name }}" autofocus>
                    <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                </ul>

                <ul class="py-4 px-4">
                    <label id="last_name" class="font-medium text-gray-600">Last Name:</label>
                    <input type="text" name="last_name" id="last_name" class="w-full text-black h-10 mt-2 bg-gray-100 rounded-md px-3 focus:outline-none" value="{{ $editAdminData->last_name }}">
                    <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                </ul>

                <ul class="py-4 px-4">
                    <label id="username" class="font-medium text-gray-600">Username:</lab>
                    <input type="text" name="username" id="username" class="w-full text-black h-10 mt-2 bg-gray-100 rounded-md px-3 focus:outline-none" value="{{ $editAdminData->username }}">
                    <x-input-error :messages="$errors->get('username')" class="mt-2" />
                </ul>

                <ul class="py-4 px-4">
                    <label id="email" class="font-medium text-gray-600">Email:</label>
                    <input type="text" name="email" id="email" class="w-full text-black h-10 mt-2 bg-gray-100 rounded-md px-3 focus:outline-none" value="{{ $editAdminData->email }}">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </ul>

                <div class="flex justify-center mt-2">
                <input type="submit" class="text-white text-center bg-green-600 py-4 px-6 rounded-md hover:bg-green-500 duration-200" value="Update Profile" style="cursor: pointer;"></input>
                </div>

            </form>
            </div>

            <div class="w-2/5 flex justify-center">
                
                <img src="{{ asset('images/library_logo.png') }}" alt="" class="w-3/5">
            </div>
        </div>

        @include('admin.body.footer')
    </div>
</div>
@endsection