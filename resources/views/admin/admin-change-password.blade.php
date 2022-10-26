@extends('admin.admin-master')
@section('admin')

        @php
            if (count($errors) > 0) {
                RealRashid\SweetAlert\Facades\Alert::warning("Fields is Required", "You need to fill in the input fields.")->showConfirmButton('Okay', '#2678c5')->autoClose(6000);
            }
        @endphp

<div class="bg-slate-200 h-screen w-full overflow-y-auto">
    <div class="px-8 py-4">
        <h5 class="pb-6 pt-3 font-bold uppercase">Admin Change Password</h5>

        {{-- First Container --}}
        <div class="p-6 bg-white rounded-lg flex items-center h-full shadow-md">
            <div class="w-3/5 flex flex-col justify-start">
                <form action="{{ route('admin.update.password') }}" method="post">
                    @csrf

                <ul class="py-4 px-4">
                    <label id="currentPassword" class="font-medium text-gray-600">Current Password:</label>
                    <input type="password" name="currentPassword" id="currentPassword" class="w-full text-black h-10 mt-2 bg-white rounded-md px-3 focus:outline-none" value="" autofocus>
                    {{-- <x-input-error :messages="$errors->get('currentPassword')" class="mt-2" /> --}}
                </ul>

                <ul class="py-4 px-4">
                    <label id="newPassword" class="font-medium text-gray-600">New Password:</label>
                    <input type="password" name="newPassword" id="newPassword" class="w-full text-black h-10 mt-2 bg-white  rounded-md px-3 focus:outline-none" value="">
                    {{-- <x-input-error :messages="$errors->get('newPassword')" class="mt-2" /> --}}
                </ul>

                <ul class="py-4 px-4">
                    <label id="confirmNewPassword" class="font-medium text-gray-600">Confirm New Password:</lab>
                    <input type="password" name="confirmNewPassword" id="confirmNewPassword" class="w-full text-black h-10 mt-2 bg-white rounded-md px-3 focus:outline-none" value="">
                    {{-- <x-input-error :messages="$errors->get('confirmNewPassword')" class="mt-2" /> --}}
                </ul>

                <div class="flex justify-center mt-2">
                    <x-primary-button class="px-6 py-4">Change Password</x-primary-button>
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