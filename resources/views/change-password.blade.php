@extends('master')
@section('user')

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

<div class="overflow-hidden bg-white shadow-xl rounded-lg max-w-xl md:max-w-2xl lg:max-w-4xl xl:max-w-7xl mx-8 sm:mx-auto my-8 relative">
    <div class="px-4 py-8 sm:px-6">
      <h3 class="text-xl md:text-2xl font-bold leading-6 text-gray-900 inline-block">Change Password</h3>
      <p class="mt-1 max-w-2xl text-sm text-gray-500">Password must be at least 8 characters.</p>
    </div>
    <div class="border-t border-gray-200">
      <dl>
        <form x-data="{ buttonDisabled: false }" x-on:submit="buttonDisabled = true" action="{{ route('update.password') }}" method="post">
            @csrf
        <div class="bg-white px-4 py-8 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500">Current Password</dt>
          <div class="relative">
          <input type="password" name="currentPassword" id="currentPassword" class="w-full text-black h-10 mt-2 bg-white focus:ring-green-500 focus:border-green-500 rounded-md px-3 focus:outline-none" autofocus>
        </div>
        </div>
        <div class="bg-white px-4 py-8 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500">New Password</dt>
          <div class="relative">
          <input type="password" name="newPassword" id="newPassword" class="w-full text-black h-10 mt-2 bg-white focus:ring-green-500 focus:border-green-500 rounded-md px-3 focus:outline-none">
            </div>
        </div>
        <div class="bg-white px-4 py-8 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500">Confirm New Password</dt>
          <div class="relative">
          <input type="password" name="confirmNewPassword" id="confirmNewPassword" class="w-full text-black h-10 mt-2 bg-white focus:ring-green-500 focus:border-green-500 rounded-md px-3 focus:outline-none">
            </div>
        </div>
        <div class="bg-white px-4 mx-6 xl:mx-32 py-8 grid grid-cols-2 gap-4 sm:px-6 float-center">
            <a href="{{ route('home') }}" x-bind:class="buttonDisabled ? 'cursor-not-allowed pointer-events-none' : 'cursor-pointer' " class="text-sm md:text-base w-full md:w-auto flex justify-center items-center space-x-4 font-sans font-bold text-slate-800 rounded-md px-8 p-2 border-gray-700 bg-transparent shadow-cyan-100 hover:bg-slate-50 shadow-sm hover:shadow-lg border transition hover:-translate-y-0.5 duration-150">Cancel</a>
            <x-primary-button x-bind:disabled="buttonDisabled" x-bind:class="buttonDisabled ? 'cursor-not-allowed' : 'cursor-pointer' " class="text-sm md:text-base">Update</x-primary-button>
        </div>
        </form>
      </dl>
    </div>
  </div>

@endsection