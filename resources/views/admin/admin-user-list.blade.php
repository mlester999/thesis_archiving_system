@extends('admin.admin-master')
@section('admin')

<div class="w-full sm:px-6 sm:pb-6 h-screen overflow-y-auto">
	<div
	  class="px-4 md:px-2 py-4 md:py-7"
	>
	  <div class="md:flex md:items-center md:justify-between">
		<div class="flex-1 min-w-0">
		  <h2
			class="text-lg font-bold leading-7 text-gray-900 sm:text-2xl sm:truncate uppercase"
		  >
			User List
		  </h2>
		</div>
		<div class="mt-4 flex md:mt-0 md:ml-4 z-0">
			<label class="relative block">
				<span class="sr-only">Search</span>
				<span class="absolute inset-y-0 left-0 flex items-center pl-2">
					<i class="fa-solid fa-magnifying-glass ml-1"></i>
				</span>
				<input class="placeholder:italic placeholder:text-slate-700 block bg-white w-full border border-slate-300 rounded-md py-2 pl-9 pr-3 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" placeholder="Search for anything..." type="text" name="search"/>
			  </label>
		  <button
			type="button"
			class="modal-open ml-3 inline-flex items-center px-4 py-2 border duration-200 border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 active:outline-none active:ring-2 active:ring-offset-2 active:ring-green-500"
		  >
			New Student
		  </button>
		</div>
	  </div>
	</div>

	<div
	  class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg"
	>
	  <table class="min-w-full whitespace-nowrap divide-y divide-gray-200">
		<thead class="bg-gray-50">
		  <tr
			tabindex="0"
			class="focus:outline-none h-16 w-full text-md leading-none text-gray-800"
		  >
			<th class="font-semibold text-left pl-8 text-gray-700 uppercase tracking-normal">#</th>
			<th class="font-semibold text-left pl-12 text-gray-700 uppercase tracking-normal">Student ID</th>
			<th class="font-semibold text-left pl-6 text-gray-700 uppercase tracking-normal">Student Name</th>
			<th class="font-semibold text-left pl-6 text-gray-700 uppercase tracking-normal">Email Address</th>
			<th class="font-semibold text-left pl-2 text-gray-700 uppercase tracking-normal">Created at</th>
			<th class="font-semibold text-left pl-12 text-gray-700 uppercase tracking-normal">Status</th>
			<th class="font-semibold text-left pl-12 text-gray-700 uppercase tracking-normal">Action</th>
		  </tr>
		</thead>
		<tbody class="w-full" id="main-table-body">
			@foreach($users as $key => $user)
		  <tr
			tabindex="{{ $user->id }}"
			class="odd:bg-white even:bg-slate-50 focus:outline-none h-26 text-sm leading-none text-gray-800 bg-white hover:bg-gray-100 border-b border-t border-gray-100"
		  >
			<td class="pl-8 cursor-pointer">
			  <div class="flex items-center">
				<div>
				  <p class="text-md font-medium leading-none text-gray-800">{{ $user->id }}</p>
				</div>
			  </div>
			</td>
			<td class="pl-12">
			  <p class="text-md font-medium leading-none text-gray-800">
				{{ $user->student_id }}
			  </p>
			</td>
			<td class="pl-6">
			  <p class="text-md font-medium leading-none text-gray-800">{{ $user->last_name . ', ' . $user->first_name }}</p>
			</td>
			<td class="pl-6">
			  <p class="text-md font-medium leading-none text-gray-800">{{ $user->email }}</p>
			</td>
			<td class="pl-2">
				<p class="text-md font-medium leading-none text-gray-800">{{ $user->created_at }}</p>
			  </td>
			  <td class="pl-12">
				@if($user->email_verified_at)
				<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-300 text-green-800">
                    Verified
                </span>
				@else
				<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-300 text-red-800">
                    Not Verified
                </span>
				@endif
			  </td>
			<td class="pl-12">
				{{-- <a href="#" class="text-green-600 hover:text-green-900">Edit</a> --}}
				
				<button id="dropdownDefault" data-dropdown-toggle="dropdown" class="show-menu text-black border-2 border-green-500 bg-white hover:bg-slate-100 focus:ring-2 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center" type="button">Action <svg class="ml-2 w-4 h-4" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></button>
				<!-- Dropdown menu -->
				<div id="dropdown" class="hidden z-10 w-28 bg-white rounded divide-y divide-gray-100 shadow-xl" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(0px, 510.4px, 0px);" data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="bottom">
					<ul class="py-1 text-sm text-gray-700 " aria-labelledby="dropdownDefault">
					<li>
						<button id="{{ $user->id }}" class="view-modal-open w-full block py-2 px-4 hover:bg-gray-100 border-gray-200 border-b"><i class="fa-solid fa-eye mr-1"></i> View</button>
					</li>
					<li>
						<button class="block py-2 w-full px-4 hover:bg-gray-100 border-gray-200 border-b"><i class="fa-solid fa-pen-to-square mr-2 text-blue-600"></i> Edit</button>
					</li>
					<li>
						<button class="block w-full py-2 px-4 hover:bg-gray-100"><i class="fa-solid fa-trash mr-2 text-red-600"></i> Delete</button>
					</li>
					</ul>
				</div>

			  </td>
		  </tr>
		  @endforeach
		</tbody>
	  </table>
	  <div
		class="px-5 bg-white pt-8 pb-5 flex flex-col xs:flex-row xs:justify-between"
		>	
		{{ $users->links() }}
	  </div>

	  	<!--Modal-->
	<div class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
		<div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
		
		<div class="modal-container bg-white w-11/12 md:max-w-md lg:max-w-2xl mx-auto rounded shadow-lg z-50 overflow-y-auto">
		  
		  <div class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
			<svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
			  <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
			</svg>
			<span class="text-sm">(Esc)</span>
		  </div>
	
		  <!-- Add margin if you want to see some of the overlay behind the modal-->
		  <div class="modal-content py-4 text-left px-6">
			<!--Title-->
			<div class="flex justify-between items-center pb-6">
			  <p class="text-2xl font-bold">Add New Student</p>
			  <div class="modal-close cursor-pointer z-50">
				<svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
				  <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
				</svg>
			  </div>
			</div>
	
			<!--Body-->
			<form method="POST" action="{{ route('admin.user.register') }}">
				@csrf
	
				<div class="grid grid-cols-2 py-2">

				<!-- First Name -->
				<div class="px-4">
					<x-input-label for="first_name" :value="__('First Name')" />
	
					<x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autofocus />
	
					<x-input-error :messages="$errors->get('first_name')" class="mt-2" />
				</div>
	
				<!-- Last Name -->
				<div class="px-4">
					<x-input-label for="last_name" :value="__('Last Name')" />
	
					<x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required autofocus />
	
					<x-input-error :messages="$errors->get('last_name')" class="mt-2" />
				</div>
	
				<!-- Student ID -->
				<div class="mt-4 px-4">
				<x-input-label for="student_id" :value="__('Student ID')" />
	
				<x-text-input id="student_id" class="block mt-1 w-full" type="text" name="student_id" :value="old('student_id')" required autofocus />
	
				<x-input-error :messages="$errors->get('student_id')" class="mt-2" />
			</div>
	
				<!-- Email Address -->
				<div class="mt-4 px-4">
					<x-input-label for="email" :value="__('Email Address')" />
	
					<x-text-input id="email" class="block mt-1 w-full" type="email" name="email" placeholder="you@example.com" :value="old('email')" required />
	
					<x-input-error :messages="$errors->get('email')" class="mt-2" />
				</div>
	
				<!-- Password -->
				<div class="mt-4 px-4">
					<x-input-label for="password" :value="__('Password')" />
	
					<x-text-input id="password" class="block mt-1 w-full"
									type="password"
									name="password"
									required autocomplete="new-password" />
	
					<x-input-error :messages="$errors->get('password')" class="mt-2" />
				</div>
	
				<!-- Confirm Password -->
				<div class="mt-4 px-4">
					<x-input-label for="password_confirmation" :value="__('Confirm Password')" />
	
					<x-text-input id="password_confirmation" class="block mt-1 w-full"
									type="password"
									name="password_confirmation" required />
	
					<x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
				</div>
	
				<div class="flex items-center justify-center mt-10 col-span-2">
	
					<x-primary-button class="ml-4">
						{{ __('Add Student') }}
					</x-primary-button>
				</div>
			</div>
			</form>			
		  </div>
		</div>
	  </div>

	  	<!--View Modal-->
	<div class="view-modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
		<div class="view-modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
		
		<div class="view-modal-container bg-white w-11/12 md:max-w-md lg:max-w-2xl mx-auto rounded shadow-lg z-50 overflow-y-auto">
		  
		  <div class="view-modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
			<svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
			  <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
			</svg>
			<span class="text-sm">(Esc)</span>
		  </div>
	
		  <!-- Add margin if you want to see some of the overlay behind the modal-->
		  <div class="view-modal-content py-4 text-left px-6">
			<!--Title-->
			<div class="flex justify-between items-center pb-6">
			  <p class="text-2xl font-bold">Student Details</p>
			  <div class="view-modal-close cursor-pointer z-50">
				<svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
				  <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
				</svg>
			  </div>
			</div>

			@php
			$userData = App\Models\User::find(2);
			$userDataDisplay = $userData->last_name . ', ' . $userData->first_name;

			@endphp

			<div class="grid grid-cols-2 py-2">
				<div>
					<img src="{{ asset('/images/R.png') }}" alt="">
				</div>
				<div>
					<p>Student Name:</p>
					<p>{{ $userDataDisplay }}</p>
				</div>
			</div>
		  </div>
		</div>
	  </div>


	</div>
	@include('admin.body.footer')
  </div>
@endsection