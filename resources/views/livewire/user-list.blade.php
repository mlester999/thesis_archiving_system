<div class="w-full px-6 pb-6 h-screen overflow-y-auto">
	<div
	  class="lg:px-2 py-4 lg:py-7"
	>
	<div class="flex-1 min-w-0 py-2">
	  <h2
		class="font-bold leading-7 text-gray-900 text-2xl lg:truncate uppercase"
	  >
		Admin Users List
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
			New User
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
			<th class="font-semibold text-left pl-12 text-gray-700 uppercase tracking-normal">Username 
				<span wire:click="sortBy('student_id')" class="cursor-pointer ml-2">
					<i class="fa-solid fa-arrow-{{ $sortField === 'student_id' && $sortDirection === 'asc' ? 'up' : 'down' }} fa-xs"></i>	
				</span>
			</th>
			<th class="font-semibold text-left pl-12 text-gray-700 uppercase tracking-normal">Admin Name 
				<span wire:click="sortBy('name')" class="cursor-pointer ml-2">
					<i class="fa-solid fa-arrow-{{ $sortField === 'name' && $sortDirection === 'asc' ? 'up' : 'down' }} fa-xs"></i>
				</span>
			</th>
			<th class="font-semibold text-left pl-12 text-gray-700 uppercase tracking-normal">Email Address 
				<span wire:click="sortBy('email')" class="cursor-pointer ml-2">
					<i class="fa-solid fa-arrow-{{ $sortField === 'email' && $sortDirection === 'asc' ? 'up' : 'down' }} fa-xs"></i>
				</span>
			</th>
			<th class="font-semibold text-left pl-12 text-gray-700 uppercase tracking-normal">Created at 
				<span wire:click="sortBy('created_at')" class="cursor-pointer ml-2">
					<i class="fa-solid fa-arrow-{{ $sortField === 'created_at' && $sortDirection === 'asc' ? 'up' : 'down' }} fa-xs"></i>
				</span>
			</th>
			<th class="font-semibold text-left pl-12 text-gray-700 uppercase tracking-normal">Email Status
				<span wire:click="sortBy('acc_status')" class="cursor-pointer ml-2">
					<i class="fa-solid fa-arrow-{{ $sortField === 'acc_status' && $sortDirection === 'asc' ? 'up' : 'down' }} fa-xs"></i>
				</span>
			</th>
			<th class="font-semibold text-left pl-12 pr-4 text-gray-700 uppercase tracking-normal">Action</th>
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
			  <p class="text-md font-medium leading-none text-gray-800">
				{{ $user->username }}
			  </p>
			</td>
			<td class="pl-12">
			  <p class="text-md font-medium leading-none text-gray-800">{{ $user->name }}</p>
			</td>
			<td class="pl-12">
			  <p class="text-md font-medium leading-none text-gray-800">{{ $user->email }}</p>
			</td>
			<td class="pl-12">
				<p class="text-md font-medium leading-none text-gray-800">{{ $user->created_at->format('m/d/Y') }}</p>
			  </td>
			  <td class="pl-12">
				@if($user->email_verified_at)
				<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gradient-to-r from-green-300 to-green-400 text-green-800">
                    Verified
                </span>
				@else
				<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gradient-to-r from-red-300 to-red-400 text-red-800">
                    Not Verified
                </span>
				@endif
			  </td>
			<td class="pl-12">
				<button wire:loading.attr="disabled" wire:loading.class="cursor-not-allowed" wire:click="view({{ $user->id }})" class="cursor-pointer px-1 fa-solid fa-eye text-slate-900 hover:text-opacity-70 duration-150 fa-xl"></button>
					<button wire:loading.attr="disabled" wire:loading.class="cursor-not-allowed" wire:click="edit({{ $user->id }})" class="cursor-pointer px-1 fa-solid fa-pen-to-square text-blue-500 hover:text-opacity-70 duration-150 fa-xl"></button>
					<button wire:loading.attr="disabled" wire:loading.class="cursor-not-allowed" wire:click="disable({{ $user->id }})" class="cursor-pointer pl-1 pr-8 fa-solid {{ $user->acc_status ? 'fa-user-slash text-red-600' : 'fa-user-check text-green-600' }} hover:text-opacity-70 duration-150 fa-xl"></button>
			  </td>
		  </tr>
		  @empty
		  <tr
		  wire:loading.class="opacity-50"
		  class="odd:bg-white even:bg-slate-50 focus:outline-none h-26 text-sm leading-none text-gray-800 bg-white border-b border-t border-gray-100"
		>
		  <td colspan="7" class="pl-8">
			<div class="flex items-center justify-center">
			  <div>
				<p class="text-xl py-8 font-medium leading-none text-gray-400">No users found...</p>
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
		  <x-slot name="title"><i class="fa-solid fa-circle-info fa-lg pr-4 text-gray-500"></i>{{ $userTitle }}</x-slot>
	  
		  <x-slot name="content">
			  <!--Body-->
	  
				  <div class="grid grid-cols-1 md:grid-cols-3 py-2">

					<!-- First Col -->
					<div class="px-4">
						<h1 class="text-xs md:text-sm lg:text-base font-semibold text-left">Id:</h1> 
						<p class="text-xs md:text-sm lg:text-base text-left my-2">{{ $userId }}</p>
						<h1 class="text-xs md:text-sm lg:text-base font-semibold text-left mt-3 md:mt-6">Name:</h1> 
						<p class="text-xs md:text-sm lg:text-base text-left my-2">{{ $name }}</p>
					</div>
	  
				  <!-- First Col -->
				  <div class="px-4">
						<h1 class="text-xs md:text-sm lg:text-base font-semibold text-left mt-3 md:mt-0">Username:</h1> 
						<p class="text-xs md:text-sm lg:text-base text-left my-2">{{ $username }}</p>
						<h1 class="text-xs md:text-sm lg:text-base font-semibold text-left mt-3 md:mt-6">Email Address:</h1> 
						<p class="text-xs md:text-sm lg:text-base text-left my-2">{{ $email }}</p>
				  </div>

				  <!-- Second COl -->
				  <div class="px-4">
					<h1 class="text-xs md:text-sm lg:text-base font-semibold text-left mt-3 md:mt-0">Created At:</h1> 
					<p class="text-xs md:text-sm lg:text-base text-left my-2">{{ date('m/d/Y', strtotime($createdAt)) }}</p>
					<h1 class="text-xs md:text-sm lg:text-base font-semibold text-left mt-3 md:mt-6">Email Status:</h1> 
					@if($email_verified_at)
					<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gradient-to-r from-green-300 to-green-400 text-green-800"">Verified</p>
					@else
					<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gradient-to-r from-red-300 to-red-400 text-red-800"">Not Verified</p>
					@endif
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
				<h1 class="text-md md:text-lg lg:text-xl xl:text-2xl font-semibold text-center mt-16">Are you sure you want to deactivate this user?</h1> 
				<p class="text-center mt-4 mb-16">This account will be deactivated immediately.</p> 
				@else
				<h1 class="text-md md:text-lg lg:text-xl xl:text-2xl font-semibold text-center mt-16">Are you sure you want to activate this user?</h1> 
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
	
				<div class="grid grid-cols-2 py-2">

				<!-- Full Name -->
				<div class="px-4 col-span-2">
					<x-input-label for="name" :value="__('Full Name')" />
	
					<x-text-input wire:model.defer="editing.name" id="name" class="block mt-1 w-full" type="text" name="name" placeholder="Full Name" :value="old('name')" autofocus />
	
					<x-input-error :messages="$errors->get('editing.name')" />
				</div>
	
				<!-- Username -->
				<div class="mt-8 mb-4 px-4">
				<x-input-label for="username" :value="__('Username')" />
	
				<x-text-input wire:model.defer="editing.username" id="username" class="block mt-1 w-full" type="text" name="username" placeholder="Username" :value="old('username')" />
	
				<x-input-error :messages="$errors->get('editing.username')" />
			</div>
	
				<!-- Email Address -->
				<div class="mt-8 mb-4 px-4">
					<x-input-label for="email" :value="__('Email Address')" />
	
					<x-text-input wire:model.defer="editing.email" id="email" class="block mt-1 w-full" type="email" name="email" placeholder="someone@example.com" :value="old('email')"/>
	
					<x-input-error :messages="$errors->get('editing.email')" />
				</div>
			</div>
		</x-slot>
		
			<x-slot name="footer">
				<x-secondary-button wire:loading.attr="disabled" wire:loading.class="cursor-not-allowed" wire:click="closeModal" class="mx-2">Cancel</x-secondary-button>
				<x-primary-button wire:loading.attr="disabled" wire:loading.class="cursor-not-allowed" class="mx-2">Save</x-primary-button>
			</x-slot>
			</x-dialog-modal>
		</form>		
	</div>
	@include('admin.body.footer')
</div>


