@extends('master')
@section('user')

@php

$departmentData = App\Models\Department::find($userData->department_id);
$curriculumData = App\Models\Curriculum::find($userData->curriculum_id);

@endphp

<div class="overflow-hidden bg-white shadow-xl sm:rounded-lg max-w-5xl mx-auto mt-16 relative">
    <div class="px-4 py-5 sm:px-6">
      <h3 class="text-2xl font-bold leading-6 text-gray-900 inline-block">Student Information</h3>
      <a href="{{ route('edit.profile') }}"><i class="fa-solid fa-pen-to-square fa-2xl text-green-500 hover:text-green-600 duration-200 absolute right-6 top-8"></i></a>
      <p class="mt-1 max-w-2xl text-sm text-gray-500">Personal details.</p>
    </div>
    <div class="border-t border-gray-200">
      <dl>
        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500">First Name</dt>
          <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ $userData->first_name }}</dd>
        </div>
        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500">Last Name</dt>
          <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ $userData->last_name }}</dd>
        </div>
        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500">Department</dt>
          <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ $departmentData->name }}</dd>
        </div>
        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500">Curriculum</dt>
          <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ $curriculumData->name }}</dd>
        </div>
        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500">Student Id</dt>
          <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ $userData->student_id }}</dd>
        </div>
        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500">Email Address</dt>
          <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ $userData->email }}</dd>
        </div>
      </dl>
    </div>
  </div>
@endsection