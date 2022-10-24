@extends('admin.admin-master')
@section('admin')

<div class="bg-slate-100 h-screen w-full overflow-y-auto">
    <div class="px-8 py-4">
        <h5 class="pb-6 pt-3 font-bold leading-7 text-lg sm:text-2xl sm:truncate uppercase">Admin Profile</h5>

        {{-- First Container --}}
        <div class="p-6 bg-white rounded-lg flex items-center h-full shadow-md">
            <div class="w-3/5 flex flex-col justify-start">

                <ul class="py-4 px-4">
                    <li class="font-medium text-gray-600">First Name:</li>
                    <li class="font-base text-slate-800 text-xl">{{ $adminData->first_name }}</li>
                </ul>
                <hr class="border-gray-600 ml-4">


                <ul class="py-4 px-4">
                    <li class="font-medium text-gray-600">Last Name:</li>
                    <li class="font-base text-slate-800 text-xl">{{ $adminData->last_name }}</li>
                </ul>

                <hr class="border-gray-600 ml-4">

                <ul class="py-4 px-4">
                    <li class="font-medium text-gray-600">Username:</li>
                    <li class="font-base text-slate-800 text-xl">{{ $adminData->username }}</li>
                </ul>

                <hr class="border-gray-600 ml-4">

                <ul class="py-4 px-4">
                    <li class="font-medium text-gray-600">Email:</li>
                    <li class="font-base text-slate-800 text-xl">{{ $adminData->email }}</li>
                </ul>

                <hr class="border-gray-600 ml-4">

                <div class="flex mx-auto mt-6">
                <a href="{{ route('admin.edit.profile') }}" class="text-white text-center bg-green-600 py-4 px-6 rounded-md hover:bg-green-500 duration-200">Edit Profile</a>
                </div>

            </div>

            <div class="w-2/5 flex justify-center">
                
                <img src="{{ asset('images/library_logo.png') }}" alt="" class="w-3/5">
            </div>
        </div>

        @include('admin.body.footer')
    </div>
</div>
@endsection