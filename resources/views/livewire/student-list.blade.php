<div class="w-full px-6 pb-6 h-screen overflow-y-auto">
	<div
	  class="lg:px-2 py-4 lg:py-7"
	>
	<div class="flex-1 min-w-0 py-2">
	  <h2
		class="text-2xl font-bold leading-7 text-gray-900 lg:truncate uppercase"
	  >
		Student List
	  </h2>
	</div>
	  <div class="lg:flex lg:items-center lg:justify-end">
		<div class="mt-4 flex justify-end lg:mt-0 lg:ml-4 z-0">
			<div class="flex flex-col items-end lg:flex-row space-y-4 space-x-4 lg:space-y-0">
				<div class="flex flex-row">
			<select name="show_results" wire:model="showResults" id="show_results" name="show_results" class="order-2 md:order-1 inline-flex items-center border border-gray-300 text-gray-900 rounded-md focus:ring-1 focus:ring-green-500 focus:border-green-500 placeholder:font-sans placeholder:font-light focus:outline-none text-xs md:text-sm">
				<option value="5" selected>Show 5 Results</option>
				<option value="25">Show 25 Results</option>
				<option value="50">Show 50 Results</option>
				</select>
			<label class="relative block ml-3 order-3 md:order-2">
				<span class="sr-only">Search</span>
				<span class="absolute inset-y-0 left-0 flex items-center pl-2">
					<i class="fa-solid fa-magnifying-glass ml-1"></i>
				</span>
				<input wire:model="search" class="placeholder:italic placeholder:text-slate-700 block bg-white w-40 md:w-full border border-slate-300 rounded-md py-2 pl-9 pr-3 shadow-sm focus:outline-none focus:border-green-500 focus:ring-green-500 focus:ring-1 text-xs md:text-sm" placeholder="Search for anything..." type="text" name="search"/>
			  </label>
			</div>
		  <button
			wire:loading.attr="disabled"
			wire:loading.class="cursor-not-allowed active:ring-0 active:ring-offset-0"
			wire:click="create"
			type="button"
			class="order-1 md:order-3 ml-3 inline-flex items-center px-4 py-2 border duration-200 border-transparent rounded-md shadow-sm text-xs md:text-sm font-medium text-white bg-green-500 hover:bg-opacity-80 active:outline-none active:ring-2 active:ring-offset-2 active:ring-green-500"
		  ><i class="fa-solid fa-plus mr-2"></i>
			New Student
		  </button>
		</div>
		</div>
	  </div>
	</div>

	<div class="overflow-x-auto sm:rounded-lg space-y-8"
	>
	  <table class="min-w-full whitespace-nowrap divide-y divide-gray-200 border-b-2 shadow">
		<thead class="bg-gray-50">
		  <tr
			tabindex="0"
			class="focus:outline-none h-16 w-full text-xs md:text-sm leading-none text-gray-800"
		  >
			<th class="font-semibold text-left pl-8 text-gray-700 uppercase tracking-normal"># 
				<span wire:click="sortBy('id')" class="cursor-pointer ml-2">
					<i class="fa-solid fa-arrow-{{ $sortField === 'id' && $sortDirection === 'asc' ? 'up' : 'down' }} fa-xs"></i>	
				</span>
			</th>
			<th class="font-semibold text-left pl-12 text-gray-700 uppercase tracking-normal">Student ID 
				<span wire:click="sortBy('student_id')" class="cursor-pointer ml-2">
					<i class="fa-solid fa-arrow-{{ $sortField === 'student_id' && $sortDirection === 'asc' ? 'up' : 'down' }} fa-xs"></i>	
				</span>
			</th>
			<th class="font-semibold text-left pl-8 text-gray-700 uppercase tracking-normal">Student Name 
				<span wire:click="sortBy('last_name')" class="cursor-pointer ml-2">
					<i class="fa-solid fa-arrow-{{ $sortField === 'last_name' && $sortDirection === 'asc' ? 'up' : 'down' }} fa-xs"></i>
				</span>
			</th>
			<th class="font-semibold text-left pl-8 text-gray-700 uppercase tracking-normal">Year Level
				<span wire:click="sortBy('year_level')" class="cursor-pointer ml-2">
					<i class="fa-solid fa-arrow-{{ $sortField === 'year_level' && $sortDirection === 'asc' ? 'up' : 'down' }} fa-xs"></i>
				</span>
			</th>
			<th class="font-semibold text-left pl-8 text-gray-700 uppercase tracking-normal">Department
				<span wire:click="sortBy('dept_name')" class="cursor-pointer ml-2">
					<i class="fa-solid fa-arrow-{{ $sortField === 'dept_name' && $sortDirection === 'asc' ? 'up' : 'down' }} fa-xs"></i>
				</span>
			</th>
			<th class="font-semibold text-left pl-8 text-gray-700 uppercase tracking-normal">Curriculum
				<span wire:click="sortBy('curr_name')" class="cursor-pointer ml-2">
					<i class="fa-solid fa-arrow-{{ $sortField === 'curr_name' && $sortDirection === 'asc' ? 'up' : 'down' }} fa-xs"></i>
				</span>
			</th>
			<th class="font-semibold text-left pl-8 text-gray-700 uppercase tracking-normal">Status </th>
			<th class="font-semibold text-left pl-8 text-gray-700 uppercase tracking-normal">Action</th>
		  </tr>
		</thead>
		<tbody class="w-full" id="main-table-body">
			@forelse($users as $key => $user)
		  <tr
		  	wire:loading.class="opacity-50"
			tabindex="{{ $user->id }}"
			class="odd:bg-white even:bg-slate-50 focus:outline-none h-16 text-xs md:text-sm leading-none text-gray-800 bg-white border-b border-t border-gray-100"
		  >
			<td class="pl-8">
			  <div class="flex items-center">
				<div>
				  <p class="text-md font-medium leading-none text-gray-800">{{ $user->id }}</p>
				</div>
			  </div>
			</td>
			<td class="pl-12">
			  <p class="text-md font-medium leading-none text-gray-800">{{ $user->student_id }}</p>
			</td>
			<td class="pl-8">
			  <p class="text-md font-medium leading-none text-gray-800">{{ $user->last_name . ', ' . \Illuminate\Support\Str::limit($user->first_name . ' ' . $user->middle_name[0] . '.', 15, '...') }}</p>
			</td>
			<td class="pl-8">
				<p class="text-md font-medium leading-none text-gray-800">{{ $user->year_level }}</p>
			  </td>
			<td class="pl-8">
				<p class="text-md font-medium leading-none text-gray-800">{{ $user->dept_name ?? 'Department Not Found' }}</p>
			  </td>
			  <td class="pl-8">
				<p class="text-md font-medium leading-none text-gray-800">{{ $user->curr_name ?? 'Curriculum Not Found' }}</p>
			  </td>
			  <td class="pl-8">
				@if($user->acc_status)
				<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gradient-to-r from-green-300 to-green-400 text-green-800">
                    Activated
                </span>
				@else
				<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gradient-to-r from-red-300 to-red-400 text-red-800">
                    Deactivated
                </span>
				@endif
			  </td>
			<td class="pl-8">
				<button wire:loading.attr="disabled" wire:loading.class="cursor-not-allowed" wire:click="view({{ $user->id }})" class="cursor-pointer px-1 fa-solid fa-eye text-slate-900 hover:text-opacity-70 duration-150 fa-xl"></button>
					<button wire:loading.attr="disabled" wire:loading.class="cursor-not-allowed" wire:click="edit({{ $user->id }})" class="cursor-pointer px-1 fa-solid fa-pen-to-square text-blue-600 hover:text-opacity-70 duration-150 fa-xl"></button>
					<button wire:loading.attr="disabled" wire:loading.class="cursor-not-allowed" wire:click="disable({{ $user->id }})" class="cursor-pointer pl-1 pr-8 fa-solid {{ $user->acc_status ? 'fa-user-slash text-red-600' : 'fa-user-check text-green-600' }} hover:text-opacity-70 duration-150 fa-xl"></button>
			  </td>
		  </tr>
		  @empty
		  <tr
		  wire:loading.class="opacity-50"
		  class="odd:bg-white even:bg-slate-50 focus:outline-none h-26 text-sm leading-none text-gray-800 bg-white border-b border-t border-gray-100"
		>
		  <td colspan="8" class="pl-8">
			<div class="flex items-center justify-center">
			  <div>
				<p class="text-xl py-8 font-medium leading-none text-gray-400">No students found...</p>
			  </div>
			</div>
		  </td>
		</tr>
		  @endforelse
		</tbody>
	  </table>
	</div>
	  <div
		class="flex flex-col xs:flex-row xs:justify-between py-8"
		>	
		{{ $users->links() }}
	  </div>

	   {{-- Show View Modal --}}

		<x-dialog-modal wire:model.defer="showViewModal">
		  <x-slot name="title"><i class="fa-solid fa-circle-info fa-lg lg:fa-lg pr-4 text-gray-500"></i>{{ $userTitle }}</x-slot>
	  
		  <x-slot name="content">
			  <!--Body-->
	  
				  <div class="grid md:grid-cols-4 grid-cols-2 py-2">
  	  
				  <!-- First Row -->
				  <div class="pl-4">
					<h1 class="text-xs md:text-sm lg:text-base font-semibold text-left">First Name:</h1> 
					<p class="text-xs md:text-sm lg:text-base text-left my-2">{{ $firstName }}</p>
					
					<h1 class="text-xs md:text-sm lg:text-base font-semibold text-left mt-3 md:mt-6">Middle Name:</h1> 
					<p class="text-xs md:text-sm lg:text-base text-left my-2">{{ $middleName }}</p>

					<h1 class="text-xs md:text-sm lg:text-base font-semibold text-left mt-3 md:mt-6">Last Name:</h1> 
					<p class="text-xs md:text-sm lg:text-base text-left mt-2 mb-2">{{ $lastName }}</p>

				  </div>

				  <!-- Second Row -->
				  <div class="pl-4 break-all">
					<h1 class="text-xs md:text-sm lg:text-base font-semibold text-left">Gender:</h1> 
					<p class="text-xs md:text-sm lg:text-base text-left my-2">{{ $gender }}</p>
					
					<h1 class="text-xs md:text-sm lg:text-base font-semibold text-left mt-3 md:mt-6">Student ID:</h1> 
					<p class="text-xs md:text-sm lg:text-base text-left my-2">{{ $studentId }}</p>

					<h1 class="text-xs md:text-sm lg:text-base font-semibold text-left mt-3 md:mt-6">Email Address:</h1> 
					<p class="text-xs md:text-sm lg:text-base text-left my-2">{{ $email }}</p>
				  </div>

				  <!-- Third Row -->
				  <div class="pl-4">
					<h1 class="text-xs md:text-sm lg:text-base font-semibold text-left mt-3 md:mt-0">Year Level:</h1> 
					<p class="text-xs md:text-sm lg:text-base text-left my-2">{{ $yearLevel }}</p>

					<h1 class="text-xs md:text-sm lg:text-base font-semibold text-left mt-3 md:mt-6">Created At:</h1> 
					<p class="text-xs md:text-sm lg:text-base text-left mt-2 mb-2">{{ $createdAt }}</p>

					<h1 class="text-xs md:text-sm lg:text-base font-semibold text-left mt-3 md:mt-6">Department:</h1> 
					@php
					$departmentInfo = App\Models\Department::find($departmentId);
					@endphp
					<p class="text-xs md:text-sm lg:text-base text-left mr-2 my-2">{{ $departmentInfo->dept_description ?? 'Department Not Found' }}</p>
				  </div>

				  <!-- Fourth Row -->
				  <div class="pl-4">
					<h1 class="text-xs md:text-sm lg:text-base font-semibold text-left mt-3 md:mt-0">Account Status:</h1> 
					@if($accStatus)
					<p class="text-xxs md:text-xs px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gradient-to-r from-green-300 to-green-400 text-green-800">Activated</p>
					@else
					<p class="text-xxs md:text-xs text-left px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gradient-to-r from-red-300 to-red-400 text-red-800">Deactivated</p>
					@endif
					<h1 class="text-xs md:text-sm lg:text-base font-semibold text-left mt-3 md:mt-8">Email Status:</h1> 
					@if($emailStatus)
					<p class="text-xxs md:text-xs text-left px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gradient-to-r from-green-300 to-green-400 text-green-800">Verified</p>
					@else
					<p class="text-xxs md:text-xs text-left px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gradient-to-r from-red-300 to-red-400 text-red-800">Not Verified</p>
					@endif
					<h1 class="text-xs md:text-sm lg:text-base font-semibold text-left mt-3 md:mt-8">Curriculum:</h1> 
					@php
					$curriculumInfo = App\Models\Curriculum::find($curriculumId);
					@endphp
					<p class="text-xs md:text-sm lg:text-base text-left mt-2 mb-2">{{ $curriculumInfo->curr_description ?? 'Curriculum Not Found' }}</p>
				</div>
			</div>
		  </x-slot>
		  
			  <x-slot name="footer">
				  <x-secondary-button wire:loading.attr="disabled" wire:loading.class="cursor-not-allowed" wire:click="$set('showViewModal', false)" class="mx-2">Cancel</x-secondary-button>
			  </x-slot>
		</x-dialog-modal>	
	  

	  {{-- Show Delete Modal --}}
	  <form wire:submit.prevent="disableUser">

		<x-confirmation-modal wire:model.defer="showDeleteModal">
		  <x-slot name="title">
			@if($accStatus)
			<i class="fa-solid fa-triangle-exclamation fa-lg pr-4 text-red-500"></i>
			@else
			<i class="fa-solid fa-triangle-exclamation fa-lg pr-4 text-green-500"></i>
			@endif
			{{ $userTitle }}
			</x-slot>
	  
		  <x-slot name="content">
			@if($accStatus)
			<h1 class="text-md md:text-lg lg:text-xl xl:text-2xl font-semibold text-center mt-16">Are you sure you want to deactivate this student?</h1> 
			<p class="text-center mt-4 mb-16">This account will be deactivated immediately.</p> 
			@else
			<h1 class="text-md md:text-lg lg:text-xl xl:text-2xl font-semibold text-center mt-16">Are you sure you want to activate this student?</h1> 
			<p class="text-center mt-4 mb-16">This account will be activated immediately.</p> 
			@endif
		  </x-slot>
		  
			  <x-slot name="footer">
				  <x-secondary-button wire:loading.attr="disabled" wire:loading.class="cursor-not-allowed" wire:click="$set('showDeleteModal', false)" class="mx-2">Cancel</x-secondary-button>
				  @if($accStatus)
				  <x-delete-button wire:loading.attr="disabled" wire:loading.class="cursor-not-allowed" class="mx-2 bg-gradient-to-r from-red-500 to-red-600">Deactivate</x-delete-button>
				  @else
				  <x-delete-button wire:loading.attr="disabled" wire:loading.class="cursor-not-allowed" class="mx-2 bg-gradient-to-r from-green-500 to-green-600">Activate</x-delete-button>
				  @endif
			  </x-slot>
			  </x-confirmation-modal>
		  </form>		


	  {{-- Show Edit Modal --}}
		
	  <form wire:submit.prevent="save">

	  <x-dialog-modal wire:model.defer="showEditModal">
		<x-slot name="title"><i class="fa-solid fa-circle-plus fa-lg pr-4 text-gray-500"></i>{{ $userTitle }}</x-slot>
	
		<x-slot name="content">
			<!--Body-->
	
				<div class="grid grid-cols-2 md:grid-cols-3 py-1 sm:py-2 md:py-4">

				<!-- First Name -->
				<div class="px-4 pb-4 md:pb-0">
					<x-input-label for="first_name" :value="__('First Name')" />
					
					<x-text-input wire:model.defer="editing.first_name" id="first_name" class="block mt-1 w-full" type="text" name="first_name" placeholder="First Name" :value="old('first_name')" autofocus />
	
					<x-input-error :messages="$errors->get('editing.first_name')" />
				</div>

				<!-- Middle Name -->
				<div class="px-4 pb-4 md:pb-0">
					<x-input-label for="middle_name" :value="__('Middle Name')" />
	
					<x-text-input wire:model.defer="editing.middle_name" id="middle_name" class="block mt-1 w-full" type="text" name="middle_name" placeholder="Middle Name" :value="old('middle_name')"/>
	
					<x-input-error :messages="$errors->get('editing.middle_name')" />
				</div>
	
				<!-- Last Name -->
				<div class="px-4 pb-4 md:pb-0">
					<x-input-label for="last_name" :value="__('Last Name')" />
	
					<x-text-input wire:model.defer="editing.last_name" id="last_name" class="block mt-1 w-full" type="text" name="last_name" placeholder="Last Name" :value="old('last_name')"/>
	
					<x-input-error :messages="$errors->get('editing.last_name')" />
				</div>

				<!-- Gender -->
				<div class="md:mt-10 md:mb-6 px-4 pb-4 md:pb-0">
					<x-input-label for="gender" :value="__('Gender')" />
	
					<select name="gender" wire:model.defer="editing.gender" id="gender" name="gender" class="border mt-1 px-3 border-gray-300 text-gray-900  text-xs md:text-sm xl:text-base rounded-md focus:ring-1 focus:ring-green-500 focus:border-green-500 placeholder:font-sans placeholder:font-light focus:outline-none block w-full text-xs md:text-sm xl:text-base">
						<option value="0" hidden>~ Select Gender ~</option>
						<option value="Male" selected>Male</option>
						<option value="Female">Female</option>
						</select>
	
					<x-input-error :messages="$errors->get('editing.gender')" />
				</div>
	
				<!-- Student ID -->
				<div class="md:mt-10 md:mb-6 px-4 pb-4 md:pb-0">
				<x-input-label for="student_id" :value="__('Student ID')" />
	
				<x-text-input wire:model.defer="editing.student_id" id="student_id" class="block mt-1 w-full" type="text" name="student_id" placeholder="7-digits Number" :value="old('student_id')" />
	
				<x-input-error :messages="$errors->get('editing.student_id')" />
			</div>
	
				<!-- Email Address -->
				<div class="md:mt-10 md:mb-6 px-4 pb-4 md:pb-0">
					<x-input-label for="email" :value="__('Email Address')" />
	
					<x-text-input wire:model.defer="editing.email" id="email" class="block mt-1 w-full" type="email" name="email" placeholder="someone@example.com" :value="old('email')"/>
	
					<x-input-error :messages="$errors->get('editing.email')" />
				</div>

				<!-- Year Level -->
				<div class="md:my-6 px-4 pb-4 md:pb-0">
					<x-input-label for="year_level" :value="__('Year Level')" />
	
					<select name="year_level" wire:model.defer="editing.year_level" id="year_level" name="year_level" class="border mt-1 px-3 border-gray-300 text-gray-900 text-xs md:text-sm xl:text-base rounded-md focus:ring-1 focus:ring-green-500 focus:border-green-500 placeholder:font-sans placeholder:font-light focus:outline-none block w-full text-xs md:text-sm xl:text-base">
						<option value="0" hidden>~ Select Year Level ~</option>
						<option value="1st Year" selected>1st Year</option>
						<option value="2nd Year">2nd Year</option>
						<option value="3rd Year">3rd Year</option>
						<option value="4th Year">4th Year</option>
						</select>
	
					<x-input-error :messages="$errors->get('editing.year_level')" />
				</div>

				<!-- Department -->
				<div x-data class="md:my-6 px-4 pb-4 md:pb-0">
					<x-input-label for="department_id" :value="__('Department')" />
	
					<select name="department_id" wire:model="editing.department_id" id="department_id" name="department_id" class="border mt-1 px-3 border-gray-300 text-gray-900 text-xs md:text-sm xl:text-base rounded-md focus:ring-1 focus:ring-green-500 focus:border-green-500 placeholder:font-sans placeholder:font-light focus:outline-none block w-full text-xs md:text-sm xl:text-base">
						<option value="0" hidden>~ Select Department ~</option>
						@foreach($departments as $department)
						<option value="{{ $department->id }}" selected>{{ $department->dept_name }}</option>
						@endforeach()
						</select>
	
					<x-input-error :messages="$errors->get('editing.department_id')" />
				</div>

				<!-- Curriculum -->
				<div x-data class="md:my-6 px-4 pb-4 md:pb-0">
					<x-input-label for="curriculum_id" :value="__('Curriculum')" />
	
					<select {{!count($curriculaOption) ? 'disabled' : ''}} wire:model.defer="editing.curriculum_id" id="curriculum_id" name="curriculum_id" class="border mt-1 px-3 border-gray-300 text-gray-900 text-xs md:text-sm xl:text-base rounded-md focus:ring-1 focus:ring-green-500 focus:border-green-500 placeholder:font-sans placeholder:font-light focus:outline-none block w-full text-xs md:text-sm xl:text-base">
						<option value="0" hidden>~ Select Curriculum ~</option> 
						@foreach($curriculaOption as $curriculums)
						<option value="{{ $curriculums->id }}" selected>{{ $curriculums->curr_name }}</option>
						@endforeach()
						</select>
	
					<x-input-error :messages="$errors->get('editing.curriculum_id')" />
				</div>

			</div>
		</x-slot>
		
			<x-slot name="footer">
				<x-secondary-button wire:loading.attr="disabled" wire:loading.class="cursor-not-allowed" wire:click="closeModal" class="mx-2">Cancel</x-secondary-button>
				<x-primary-button wire:loading.attr="disabled" wire:loading.class="cursor-not-allowed" x-on:click="disabling = true" class="mx-2">Save</x-primary-button>
			</x-slot>
			</x-dialog-modal>
		</form>	
	</div>
	@include('admin.body.footer')
</div>


