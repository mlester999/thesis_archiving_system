@extends('master')
@section('user')

@php

$departmentData = App\Models\Department::find($userData->department_id);
$curriculumData = App\Models\Curriculum::find($userData->curriculum_id);

@endphp

<div class="overflow-hidden bg-white shadow-xl sm:rounded-lg max-w-6xl mx-auto mt-8 relative">
    <div class="px-4 py-5 sm:px-6">
      <h3 class="text-2xl font-bold leading-6 text-gray-900 inline-block">Student Information</h3>
      <a href="{{ route('bookmarks.list') }}" class="px-4 py-3 bg-yellow-500 hover:bg-opacity-80 duration-150 text-white absolute right-96 top-4"><i class="fa-solid fa-bookmark fa-lg text-white duration-200 mr-1"></i> My Bookmarks</a>
      <a href="{{ route('archives') }}" class="px-4 py-3 bg-gray-500 hover:bg-opacity-80 duration-150 text-white absolute right-52 top-4"><i class="fa-solid fa-box-archive fa-lg text-white duration-200 mr-1"></i> My Archives</a>
      <a href="{{ route('edit.profile') }}" class="px-4 py-3 bg-green-500 hover:bg-opacity-80 duration-150 text-white absolute right-11 top-4"><i class="fa-solid fa-pen-to-square fa-lg text-white duration-200 mr-1"></i> Edit Profile</a>
      <p class="mt-1 max-w-2xl text-sm text-gray-500">Personal details.</p>
    </div>
    <div class="border-t border-gray-200">
      <dl>
        <div class="bg-gray-50 px-4 py-12 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <div class="px-4 col-start-1">
            <img src="{{ asset('/images/library_logo.png') }}" class="max-w-xs object-cover object-center h-80 rounded-md">     
           </div>

           <div class="p-8 ml-8">
            <dt class="text-lg font-semibold text-black col-start-2">First Name</dt>
            <dd class="mt-1 mb-8 text-md text-gray-900 sm:col-span-1 sm:mt-0">{{ $userData->first_name }}</dd>
            <dt class="text-lg font-semibold text-black col-start-2">Last Name</dt>
            <dd class="mt-1 mb-8 text-md text-gray-900 sm:col-span-2 sm:mt-0">{{ $userData->last_name }}</dd>
            <dt class="text-lg font-semibold text-black col-start-2">Student Id</dt>
            <dd class="mt-1 mb-8 text-md text-gray-900 sm:col-span-2 sm:mt-0">{{ $userData->student_id }}</dd>
          </div>

          <div class="py-8">
            <dt class="text-lg font-semibold text-black col-start-2">Department</dt>
            <dd class="mt-1 mb-8 text-md text-gray-900 sm:col-span-2 sm:mt-0">{{ $departmentData->dept_description }}</dd>
            <dt class="text-lg font-semibold text-black col-start-2">Curriculum</dt>
            <dd class="mt-1 mb-8 text-md text-gray-900 sm:col-span-2 sm:mt-0">{{ $curriculumData->curr_description }}</dd>
            <dt class="text-lg font-semibold text-black col-start-2">Email Address</dt>
            <dd class="mt-1 mb-8 text-md text-gray-900 sm:col-span-2 sm:mt-0">{{ $userData->email }}</dd>
          </div>
        </div>
      </dl>
    </div>
  </div>
@endsection