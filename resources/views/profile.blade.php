@extends('master')
@section('user')

<div class="bg-white shadow-xl rounded-lg max-w-xl md:max-w-4xl lg:max-w-5xl xl:max-w-6xl mx-8 sm:mx-auto my-8 relative">
    <div class="px-4 py-5 sm:px-6 flex flex-col md:flex-row justify-between">
      <div>
        <h3 class="text-xl md:text-2xl lg:text-3xl font-bold md:leading-6 text-gray-900 inline-block">Student Information</h3>
        <p class="mt-2 mb-6 max-w-3xl text-sm text-gray-500">Personal details.</p>
      </div>
      <div class="flex flex-col md:flex-row md:items-center">
      @can('Bookmark Thesis')
        <a href="{{ route('bookmarks.list') }}" class="px-4 text-center my-2 md:mx-2 py-3 text-sm lg:text-base bg-yellow-500 hover:bg-opacity-80 duration-150 text-white"><i class="fa-solid fa-bookmark fa-md lg:fa-lg text-white duration-200 mr-1"></i> My Bookmarks</a>
      @endcan
        <a href="{{ route('archives') }}" class="px-4 text-center my-2 md:mx-2 py-3 text-sm lg:text-base bg-gray-500 hover:bg-opacity-80 duration-150 text-white"><i class="fa-solid fa-box-archive fa-md lg:fa-lg text-white duration-200 mr-1"></i> My Archives</a>
        <a href="{{ route('edit.profile') }}" class="px-4 text-center my-2 md:mx-2 py-3 text-sm lg:text-base bg-green-500 hover:bg-opacity-80 duration-150 text-white"><i class="fa-solid fa-pen-to-square fa-md lg:fa-lg text-white duration-200 mr-1"></i> Edit Profile</a>
      </div>
    </div>
    <div class="border-t border-gray-200">
      <dl>
        <div class="bg-gray-50 px-4 py-12 grid grid-cols-1 md:grid-cols-3 md:gap-4 px-6">
          <div class="md:p-8 md:ml-8 text-center md:text-left col-start-1">
            <dt class="text-md xl:text-lg font-semibold text-black col-start-2">First Name:</dt>
            <dd class="mt-1 mb-8 text-sm xl:text-md text-gray-900 sm:col-span-1 sm:mt-0">{{ $userData->first_name }}</dd>
            <dt class="text-md xl:text-lg font-semibold text-black col-start-2">Middle Name:</dt>
            <dd class="mt-1 mb-8 text-sm xl:text-md text-gray-900 sm:col-span-1 sm:mt-0">{{ $userData->middle_name }}</dd>
            <dt class="text-md xl:text-lg font-semibold text-black col-start-2">Last Name:</dt>
            <dd class="mt-1 mb-8 text-sm xl:text-md text-gray-900 sm:col-span-2 sm:mt-0">{{ $userData->last_name }}</dd>
           </div>

           <div class="md:p-8 md:ml-8 text-center md:text-left">
            <dt class="text-md xl:text-lg font-semibold text-black col-start-2">Gender:</dt>
            <dd class="mt-1 mb-8 text-sm xl:text-md text-gray-900 sm:col-span-2 sm:mt-0">{{ $userData->gender }}</dd>
            <dt class="text-md xl:text-lg font-semibold text-black col-start-2">Student Id:</dt>
            <dd class="mt-1 mb-8 text-sm xl:text-md text-gray-900 sm:col-span-2 sm:mt-0">{{ $userData->student_id }}</dd>
            <dt class="text-md xl:text-lg font-semibold text-black col-start-2">Email Address:</dt>
            <dd class="mt-1 mb-8 text-sm xl:text-md text-gray-900 sm:col-span-2 sm:mt-0">{{ $userData->email }}</dd>
          </div>

          <div class="md:py-8 text-center md:text-left">
            <dt class="text-md xl:text-lg font-semibold text-black col-start-2">Year Level:</dt>
            <dd class="mt-1 mb-8 text-sm xl:text-md text-gray-900 sm:col-span-2 sm:mt-0">{{ $userData->year_level}}</dd>
            <dt class="text-md xl:text-lg font-semibold text-black col-start-2">Department:</dt>
            <dd class="mt-1 mb-8 text-sm xl:text-md text-gray-900 sm:col-span-2 sm:mt-0">{{ $userData->department->dept_description }}</dd>
            <dt class="text-md xl:text-lg font-semibold text-black col-start-2">Curriculum:</dt>
            <dd class="mt-1 mb-8 text-sm xl:text-md text-gray-900 sm:col-span-2 sm:mt-0">{{ $userData->curriculum->curr_description }}</dd>
          </div>
        </div>
      </dl>
    </div>
  </div>
@endsection