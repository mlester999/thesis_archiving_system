@extends('admin.admin-master')
@section('admin')

    @php
        if (count($errors) > 0) {
          $passwordError = collect($errors->default)->sortBy('key');
          $passwordKeys = $passwordError->keys();

          if(array_key_exists("newPassword", $passwordError->toArray())) {
                if($passwordError['newPassword'][0] == "The new password must be at least 8 characters.") {
                  RealRashid\SweetAlert\Facades\Alert::warning("Password Reset Failed", "The new password must be at least 8 characters. Please try again.")->showConfirmButton('OK', '#2678c5')->autoClose(5000);
                } else {
                  RealRashid\SweetAlert\Facades\Alert::warning("Password Reset Failed", "Please check the input fields carefully.")->showConfirmButton('OK', '#2678c5')->autoClose(5000);
                }
          } else if(array_key_exists("confirmNewPassword", $passwordError->toArray())) {
                if($passwordError['confirmNewPassword'][0] == "The confirm new password must be at least 8 characters.") {
                  RealRashid\SweetAlert\Facades\Alert::warning("Password Reset Failed", "The confirm new password must be at least 8 characters. Please try again.")->showConfirmButton('OK', '#2678c5')->autoClose(5000);
                } else if($passwordError['confirmNewPassword'][0] == "The confirm new password and new password must match.") {
                  RealRashid\SweetAlert\Facades\Alert::warning("Password Reset Failed", "The confirm new password and new password must match. Please try again.")->showConfirmButton('OK', '#2678c5')->autoClose(5000);
                } else {
                  RealRashid\SweetAlert\Facades\Alert::warning("Password Reset Failed", "Please check the input fields carefully.")->showConfirmButton('OK', '#2678c5')->autoClose(5000);
                }
              } else {
                RealRashid\SweetAlert\Facades\Alert::warning("Password Reset Failed", "Please check the input fields carefully.")->showConfirmButton('OK', '#2678c5')->autoClose(5000);
            }
        }
    @endphp

<div class="bg-slate-50 h-screen w-full overflow-y-auto">
    <div class="px-8 py-4">
        <p class="pb-6 pt-3 font-bold uppercase text-sm leading-7 tracking-wider text-gray-600"><span class="flex items-center gap-1"> <x-ri-home-3-fill class="w-4 h-4" /> Home<x-heroicon-o-arrow-long-right class="w-5 h-6" />Profile<x-heroicon-o-arrow-long-right class="w-5 h-6" />Change Password</span></p>

        {{-- First Container --}}
        <div x-data="{ buttonDisabled: false }" class="p-6 bg-white rounded-lg flex items-center h-full shadow-md">
            
            <div x-show="buttonDisabled">
                <x-normal-loading />
            </div>
            
            <div class="w-full lg:w-3/5 flex flex-col justify-start">
                <form x-on:submit="buttonDisabled = true" action="{{ route('admin.update.password') }}" method="post">
                    @csrf

                <ul class="py-4 px-4">
                    
                    <label id="currentPassword" class="font-semibold text-sm md:text-md text-gray-900">Current Password:</label>
                    <input type="password" name="currentPassword" id="currentPassword" class="w-full text-black h-10 mt-2 bg-white rounded-md px-3 focus:outline-none focus:ring-1 focus:ring-green-500 focus:border-green-500" value="" autofocus>
                    {{-- <x-input-error :messages="$errors->get('currentPassword')" class="mt-2" /> --}}
                </ul>

                <ul class="py-4 px-4">
                    <label id="newPassword" class="font-semibold text-sm md:text-md text-gray-900">New Password:</label>
                    <input type="password" name="newPassword" id="newPassword" class="w-full text-black h-10 mt-2 bg-white  rounded-md px-3 focus:outline-none focus:ring-1 focus:ring-green-500 focus:border-green-500" value="">
                    {{-- <x-input-error :messages="$errors->get('newPassword')" class="mt-2" /> --}}
                </ul>

                <ul class="py-4 px-4">
                    <label id="confirmNewPassword" class="font-semibold text-sm md:text-md text-gray-900">Confirm New Password:</lab>
                    <input type="password" name="confirmNewPassword" id="confirmNewPassword" class="w-full text-black h-10 mt-2 bg-white rounded-md px-3 focus:outline-none focus:ring-1 focus:ring-green-500 focus:border-green-500" value="">
                    {{-- <x-input-error :messages="$errors->get('confirmNewPassword')" class="mt-2" /> --}}
                </ul>

                <div class="flex justify-center mt-4 mx-6 md:mx-0">
                    <x-primary-button x-bind:disabled="buttonDisabled" x-bind:class="buttonDisabled ? 'cursor-not-allowed' : 'cursor-pointer' " class="mt-2">
                        Change Password
                    </x-primary-button>
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