@extends('master')
@section('user')

        @php
            if (count($errors) > 0) {
              $studentIdError = collect($errors->default)->sortBy('key');
              $studentIdKeys = $studentIdError->keys();

              if(array_key_exists("student_id", $studentIdError->toArray())) {
                if($studentIdError['student_id'][0] == "The student id has already been taken.") {
                  RealRashid\SweetAlert\Facades\Alert::warning("Something went wrong", "This student id is already taken. Please try another.")->showConfirmButton('OK', '#2678c5')->autoClose(5000);
                } else {
                  RealRashid\SweetAlert\Facades\Alert::warning("Fields is required", "You need to fill in the input fields.")->showConfirmButton('OK', '#2678c5')->autoClose(5000);
                }
              } else if(array_key_exists("email", $studentIdError->toArray())) {
                if($studentIdError['email'][0] == "The email has already been taken.") {
                  RealRashid\SweetAlert\Facades\Alert::warning("Something went wrong", "This email address is already taken. Please try another.")->showConfirmButton('OK', '#2678c5')->autoClose(5000);
                } else {
                  RealRashid\SweetAlert\Facades\Alert::warning("Fields is required", "You need to fill in the input fields.")->showConfirmButton('OK', '#2678c5')->autoClose(5000);
                }
              }
              else {
                RealRashid\SweetAlert\Facades\Alert::warning("Fields is required", "You need to fill in the input fields.")->showConfirmButton('OK', '#2678c5')->autoClose(5000);
              }
          }
        @endphp

<div class="overflow-hidden bg-white shadow-xl rounded-lg max-w-md sm:max-w-xl md:max-w-2xl lg:max-w-4xl xl:max-w-7xl mx-auto my-8 relative">
    <div class="px-4 py-8 sm:px-6">
      <h3 class="text-2xl font-bold leading-6 text-gray-900 inline-block">Edit Student Information</h3>
    </div>
    <div class="border-t border-gray-200">
      <dl>
        <form x-data="{ buttonDisabled: false }" x-on:submit="buttonDisabled = true" action="{{ route('store.profile') }}" method="post">
            @csrf
        <div class="bg-gray px-4 py-5 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6">

           <div class="px-8 pt-8 relative">
            <dt class="text-sm font-medium text-gray-500">First Name</dt>
            <input type="text" name="first_name" id="first_name" class="mb-8 w-full text-black h-10 mt-2 bg-white focus:ring-green-500 focus:border-green-500 rounded-md px-3 focus:outline-none" value="{{ $editUserData->first_name }}" autofocus>
            <dt class="text-sm font-medium text-gray-500">Middle Name</dt>
            <input type="text" name="middle_name" id="middle_name" class="mb-8 w-full text-black h-10 mt-2 bg-white focus:ring-green-500 focus:border-green-500 rounded-md px-3 focus:outline-none" value="{{ $editUserData->middle_name }}">
            <dt class="text-sm font-medium text-gray-500">Last Name</dt>
            <input type="text" name="last_name" id="last_name" class="mb-16 w-full text-black h-10 mt-2 bg-white focus:ring-green-500 focus:border-green-500 rounded-md px-3 focus:outline-none" value="{{ $editUserData->last_name }}">
          </div>

          <div class="px-8 sm:pt-8 relative">
            <dt class="text-sm font-medium text-gray-500">Gender</dt>
            <select name="gender" id="gender" class="border mt-2 mb-8 px-3 border-gray-500 text-gray-900 rounded-md focus:ring-1 focus:ring-green-500 focus:border-green-500 placeholder:font-sans placeholder:font-light focus:outline-none block w-full">
              <option value="0" hidden>~ Select Gender ~</option>
              <option value="Male"
              @if($editUserData->gender == 'Male')
              selected
              @endif>
              Male
              </option>
              <option value="Female"
              @if($editUserData->gender == 'Female')
              selected
              @endif>
              Female
              </option>
              </select>
            <dt class="text-sm font-medium text-gray-500">Student Id</dt>
            <input type="text" name="student_id" id="student_id" class="mb-8 w-full text-black h-10 mt-2 bg-white focus:ring-green-500 focus:border-green-500 rounded-md px-3 focus:outline-none" value="{{ $editUserData->student_id }}">
            <dt class="text-sm font-medium text-gray-500">Email Address</dt>
            <input type="text" name="email" id="email" class="mb-16 w-full text-black h-10 mt-2 bg-white focus:ring-green-500 focus:border-green-500 rounded-md px-3 focus:outline-none" value="{{ $editUserData->email }}">
          </div>
        </div>
        <div class="bg-white px-4 mx-6 pb-8 grid grid-cols-2 gap-4 sm:px-6 sm:float-right">
          <a href="{{ route('profile') }}" x-bind:class="buttonDisabled ? 'cursor-not-allowed pointer-events-none' : 'cursor-pointer' " class="w-full md:w-auto flex justify-center items-center space-x-4 font-sans font-bold text-slate-800 rounded-md px-8 p-2 border-gray-700 bg-transparent shadow-cyan-100 hover:bg-slate-50 shadow-sm hover:shadow-lg border transition hover:-translate-y-0.5 duration-150">Cancel</a>
          <x-primary-button x-bind:disabled="buttonDisabled" x-bind:class="buttonDisabled ? 'cursor-not-allowed' : 'cursor-pointer' " class="mx-2 py-2">Update</x-primary-button>
        </div>
        </form>
      </dl>
    </div>
  </div>

@endsection