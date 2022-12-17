@extends('admin.admin-master')
@section('admin')

<div class="bg-slate-100 h-screen w-full overflow-y-auto">
    <div class="px-8 py-4">
        <p class="pb-6 pt-3 font-bold uppercase text-sm leading-7 tracking-wider text-gray-600"><span class="flex items-center gap-1"> <x-ri-home-3-fill class="w-4 h-4" /> Home<x-heroicon-o-arrow-long-right class="w-5 h-6" />Profile<x-heroicon-o-arrow-long-right class="w-5 h-6" />View Profile</span></p>

        {{-- First Container --}}
        <div x-data="{ buttonDisabled: false }" class="p-6 bg-white max-w-2xl mx-auto rounded-lg flex items-center h-full shadow-md">
            
            <div x-show="buttonDisabled">
                <x-normal-loading />
            </div>
            
            <div class="w-full flex flex-col justify-start">

                <ul class="py-4 px-4">
                    <li class="font-bold text-sm md:text-md text-gray-900">Name:</li>
                    <li class="font-base text-md md:text-lg text-slate-800">{{ $adminData->name }}</li>
                </ul>
                <hr class="border-gray-600 ml-4">

                <ul class="py-4 px-4">
                    <li class="font-bold text-sm md:text-md text-gray-900">Username:</li>
                    <li class="font-base text-md md:text-lg text-slate-800">{{ $adminData->username }}</li>
                </ul>

                <hr class="border-gray-600 ml-4">

                <ul class="py-4 px-4">
                    <li class="font-bold text-sm md:text-md text-gray-900">Email:</li>
                    <li class="font-base text-md md:text-lg text-slate-800">{{ $adminData->email }}</li>
                </ul>

                <hr class="border-gray-600 ml-4">

                <div class="flex justify-center mt-6 mx-6 md:mx-0">
                <a href="{{ route('admin.edit.profile') }}" @click="buttonDisabled = true" class="w-full md:w-auto flex justify-center items-center p-2 space-x-4 font-sans font-bold text-white rounded-md shadow-lg px-8 bg-green-500 shadow-cyan-100 hover:bg-opacity-90 shadow-sm hover:shadow-lg border transition hover:-translate-y-0.5 duration-150 mt-2">Edit Profile</a>
                </div>

            </div>
        </div>

        @include('admin.body.footer')
    </div>
</div>
@endsection