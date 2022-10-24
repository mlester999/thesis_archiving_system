@extends('master')
@section('user')

<div class="overflow-hidden bg-white shadow-xl sm:rounded-lg max-w-5xl mx-auto mt-8 relative">
    <div class="px-4 py-5 sm:px-6">
      <h3 class="text-2xl font-bold leading-6 text-gray-900 inline-block">Change Student Password</h3>
      {{-- <a href="#"><i class="fa-solid fa-pen-to-square fa-2xl text-green-500 hover:text-green-600 duration-200 absolute right-6 top-8"></i></a> --}}
    </div>
    <div class="border-t border-gray-200">
      <dl>
        <form action="{{ route('update.password') }}" method="post">
            @csrf
        <div class="bg-white px-4 py-8 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500">Current Password</dt>
          <div class="relative">
          <input type="password" name="currentPassword" id="currentPassword" class="w-full text-black h-10 mt-2 bg-white focus:ring-green-500 focus:border-green-500 rounded-md px-3 focus:outline-none" autofocus>
          <x-input-error :messages="$errors->get('currentPassword')" class="mt-2"/>
        </div>
        </div>
        <div class="bg-white px-4 py-8 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500">New Password</dt>
          <div class="relative">
          <input type="password" name="newPassword" id="newPassword" class="w-full text-black h-10 mt-2 bg-white focus:ring-green-500 focus:border-green-500 rounded-md px-3 focus:outline-none">
            <x-input-error :messages="$errors->get('newPassword')" class="mt-2" />
            </div>
        </div>
        <div class="bg-white px-4 py-8 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500">Confirm New Password</dt>
          <div class="relative">
          <input type="password" name="confirmNewPassword" id="confirmNewPassword" class="w-full text-black h-10 mt-2 bg-white focus:ring-green-500 focus:border-green-500 rounded-md px-3 focus:outline-none">
            <x-input-error :messages="$errors->get('confirmNewPassword')" class="mt-2" />
            </div>
        </div>
        <div class="bg-white px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <a href="{{ route('home') }}" class="cursor-pointer w-full md:w-auto flex justify-center items-center space-x-4 font-sans font-bold text-slate-800 rounded-md px-8 p-2 border-gray-700 bg-transparent shadow-cyan-100 hover:bg-slate-50 shadow-sm hover:shadow-lg border transition hover:-translate-y-0.5 duration-150">Cancel</a>
            <x-primary-button class="mx-2 py-2">Change Password</x-primary-button>
        </div>
        </form>
      </dl>
    </div>
  </div>

@endsection