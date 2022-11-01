@extends('master')
@section('user')

        @php
            if (count($errors) > 0) {
              RealRashid\SweetAlert\Facades\Alert::warning("Fields is Required", "You need to fill in the input fields.")->showConfirmButton('Okay', '#2678c5')->autoClose(6000);
            }
        @endphp

<div class="overflow-hidden bg-white shadow-xl sm:rounded-lg max-w-5xl mx-auto mt-8 relative">
    <div class="px-4 py-5 sm:px-6">
      <h3 class="text-2xl font-bold leading-6 text-gray-900 inline-block">Edit Student Information</h3>
      {{-- <a href="#"><i class="fa-solid fa-pen-to-square fa-2xl text-green-500 hover:text-green-600 duration-200 absolute right-6 top-8"></i></a> --}}
      <p class="mt-1 max-w-2xl text-sm text-gray-500">Personal details.</p>
    </div>
    <div class="border-t border-gray-200">
      <dl>
        <form action="{{ route('store.profile') }}" method="post">
            @csrf
        <div class="bg-gray px-4 py-5 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6">

           <div class="px-8 pt-8 relative">
            <dt class="text-sm font-medium text-gray-500">First Name</dt>
            <input type="text" name="first_name" id="first_name" class="mb-8 w-full text-black h-10 mt-2 bg-white focus:ring-green-500 focus:border-green-500 rounded-md px-3 focus:outline-none" value="{{ $editUserData->first_name }}" autofocus>
            <dt class="text-sm font-medium text-gray-500">Last Name</dt>
            <input type="text" name="last_name" id="last_name" class="mb-16 w-full text-black h-10 mt-2 bg-white focus:ring-green-500 focus:border-green-500 rounded-md px-3 focus:outline-none" value="{{ $editUserData->last_name }}">
          </div>

          <div class="px-8 pt-8 relative">
            <dt class="text-sm font-medium text-gray-500">Student Id</dt>
            <input type="text" name="student_id" id="student_id" class="mb-8 w-full text-black h-10 mt-2 bg-white focus:ring-green-500 focus:border-green-500 rounded-md px-3 focus:outline-none" value="{{ $editUserData->student_id }}">
            <dt class="text-sm font-medium text-gray-500">Email Address</dt>
            <input type="text" name="email" id="email" class="mb-16 w-full text-black h-10 mt-2 bg-white focus:ring-green-500 focus:border-green-500 rounded-md px-3 focus:outline-none" value="{{ $editUserData->email }}">
          </div>
        </div>
        <div class="bg-white px-4 pb-8 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6 float-right">
          <a href="{{ route('profile') }}" class="cursor-pointer w-full md:w-auto flex justify-center items-center space-x-4 font-sans font-bold text-slate-800 rounded-md px-8 p-2 border-gray-700 bg-transparent shadow-cyan-100 hover:bg-slate-50 shadow-sm hover:shadow-lg border transition hover:-translate-y-0.5 duration-150">Cancel</a>
          <x-primary-button class="mx-2 py-2">Update</x-primary-button>
        </div>
        </form>
      </dl>
    </div>
  </div>

@endsection