@extends('admin.admin-master')
@section('admin')

<div class="w-full sm:px-6 mb-10 overflow-y-auto">
	<div
	  class="px-4 md:px-0 py-4 md:py-7 bg-gray-100 rounded-tl-lg rounded-tr-lg"
	>
	  <div class="md:flex md:items-center md:justify-between">
		<div class="flex-1 min-w-0">
		  <h2
			class="text-lg font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate"
		  >
			User List
		  </h2>
		</div>
		<div class="mt-4 flex md:mt-0 md:ml-4">
		  <button
			type="button"
			class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
		  >
			Delete
		  </button>
		  <button
			type="button"
			class="modal-open ml-3 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
		  >
			New Student
		  </button>
		</div>
	  </div>
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
			<div class="flex justify-between items-center pb-3">
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
					<x-input-label for="email" :value="__('Email')" />
	
					<x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
	
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
	
				<div class="flex items-center justify-center mt-8 col-span-2">
	
					<x-primary-button class="ml-4">
						{{ __('Add Student') }}
					</x-primary-button>
				</div>
			</div>
			</form>			
		  </div>
		</div>
	  </div>

	<div
	  class="bg-white shadow px-4 md:px-10 pt-4 md:pt-7 pb-5 overflow-y-auto"
	>
	  <table class="w-full whitespace-nowrap">
		<thead>
		  <tr
			tabindex="0"
			class="focus:outline-none h-16 w-full text-md leading-none text-gray-800"
		  >
			<th class="font-semibold text-left pl-4">#</th>
			<th class="font-semibold text-left pl-12">Student ID</th>
			<th class="font-semibold text-left pl-12">Student Name</th>
			<th class="font-semibold text-left pl-20">Email Address</th>
			<th class="font-semibold text-left pl-12">Created at</th>
			<th class="font-semibold text-left pl-12">Action</th>
		  </tr>
		</thead>
		<tbody class="w-full">
			@foreach($users as $user)
		  <tr
			tabindex="0"
			class="focus:outline-none h-20 text-sm leading-none text-gray-800 bg-white hover:bg-gray-100 border-b border-t border-gray-100"
		  >
			<td class="pl-4 cursor-pointer">
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
			<td class="pl-12">
			  <p class="text-md font-medium leading-none text-gray-800">{{ $user->last_name . ', ' . $user->first_name }}</p>
			</td>
			<td class="pl-20">
			  <p class="text-md font-medium leading-none text-gray-800">{{ $user->email }}</p>
			</td>
			<td class="pl-12">
				<p class="text-md font-medium leading-none text-gray-800">{{ $user->created_at }}</p>
			  </td>
			<td class="pl-12">
				<a href="#" class="text-green-600 hover:text-green-900">Edit</a>
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
	</div>
  </div>
@endsection