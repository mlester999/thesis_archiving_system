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
				<input wire:model="search" class="placeholder:italic placeholder:text-slate-700 block bg-white w-full border border-slate-300 rounded-md py-2 pl-9 pr-3 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" placeholder="Search for anything..." type="text" name="search"/>
			  </label>
		  <button
			wire:click="create"
			type="button"
			class="ml-3 inline-flex items-center px-4 py-2 border duration-200 border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 active:outline-none active:ring-2 active:ring-offset-2 active:ring-green-500"
		  ><i class="fa-solid fa-plus mr-2"></i>
			New User
		  </button>
		</div>
	  </div>
	</div>

	<div
	  class="overflow-hidden sm:rounded-lg space-y-8 "
	>
	  <table class="min-w-full whitespace-nowrap divide-y divide-gray-200 border-b-2 shadow">
		<thead class="bg-gray-50">
		  <tr
			tabindex="0"
			class="focus:outline-none h-16 w-full text-sm leading-none text-gray-800"
		  >
			<th class="font-semibold text-left pl-8 text-gray-700 uppercase tracking-normal"># 
			</th>
			<th class="font-semibold text-left pl-12 text-gray-700 uppercase tracking-normal">Student ID 
				<span wire:click="sortBy('student_id')" class="cursor-pointer ml-2">
					<i class="fa-solid fa-arrow-{{ $sortField === 'student_id' && $sortDirection === 'asc' ? 'up' : 'down' }} fa-xs"></i>	
				</span>
			</th>
			<th class="font-semibold text-left pl-12 text-gray-700 uppercase tracking-normal">Student Name 
				<span wire:click="sortBy('last_name')" class="cursor-pointer ml-2">
					<i class="fa-solid fa-arrow-{{ $sortField === 'last_name' && $sortDirection === 'asc' ? 'up' : 'down' }} fa-xs"></i>
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
			<th class="font-semibold text-left pl-12 text-gray-700 uppercase tracking-normal">Status </th>
			<th class="font-semibold text-left pl-12 text-gray-700 uppercase tracking-normal">Action</th>
		  </tr>
		</thead>
		<tbody class="w-full" id="main-table-body">
			@forelse($users as $key => $user)
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
			<td class="pl-12">
			  <p class="text-md font-medium leading-none text-gray-800">{{ $user->last_name . ', ' . $user->first_name }}</p>
			</td>
			<td class="pl-12">
			  <p class="text-md font-medium leading-none text-gray-800">{{ $user->email }}</p>
			</td>
			<td class="pl-12">
				<p class="text-md font-medium leading-none text-gray-800">{{ $user->created_at->format('M d, Y') }}</p>
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
				<button onclick="toggleDD('myDropdown')" class="relative flex justify-center items-center bg-white border focus:outline-none shadow text-gray-600 rounded focus:ring ring-gray-200 group">
					<p class="px-4">Action</p>
					<span class="border-1 p-2 hover:bg-gray-100">
						<i class="fa-solid fa-caret-down"></i>	
					</span>
					<div class="absolute hidden group-focus:block z-50 top-full min-w-full w-max bg-white shadow-md mt-1 rounded">
						<ul class="text-left border rounded">
							<li class="px-4 py-2.5 hover:bg-gray-100 border-b"><i class="fa-solid fa-eye mr-1"></i> View</li>
							<li wire:click="edit({{ $user->id }})" class="px-4 py-2.5 hover:bg-gray-100 border-b"><i class="fa-solid fa-pen-to-square mr-2 text-blue-600"></i> Edit</li>
							<li class="px-4 py-2.5 hover:bg-gray-100"><i class="fa-solid fa-trash mr-2 text-red-600"></i> Delete</li>
						</ul>
					</div>
				</button>
			  </td>
		  </tr>
		  @empty
		  <tr
		  wire:loading.class.delay="opacity-50"
		  class="odd:bg-white even:bg-slate-50 focus:outline-none h-26 text-sm leading-none text-gray-800 bg-white hover:bg-gray-100 border-b border-t border-gray-100"
		>
		  <td colspan="7" class="pl-8 cursor-pointer">
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
	  <div
		class="flex flex-col xs:flex-row xs:justify-between"
		>	
		{{ $users->links() }}
	  </div>

	  <form wire:submit.prevent="save" class="py-4">

	  <x-dialog-modal wire:model.defer="showEditModal">
		<x-slot name="title">Edit User</x-slot>
	
		<x-slot name="content">
			<!--Body-->
	
				<div class="grid grid-cols-2 py-2">

				<!-- First Name -->
				<div class="px-4">
					<x-input-label for="first_name" :value="__('First Name')" />
	
					<x-text-input wire:model="editing.first_name" id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" autofocus />
	
					<x-input-error :messages="$errors->get('editing.first_name')" class="mt-2" />
				</div>
	
				<!-- Last Name -->
				<div class="px-4">
					<x-input-label for="last_name" :value="__('Last Name')" />
	
					<x-text-input wire:model="editing.last_name" id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')"/>
	
					<x-input-error :messages="$errors->get('editing.last_name')" class="mt-2" />
				</div>
	
				<!-- Student ID -->
				<div class="mt-4 px-4">
				<x-input-label for="student_id" :value="__('Student ID')" />
	
				<x-text-input wire:model="editing.student_id" id="student_id" class="block mt-1 w-full" type="text" name="student_id" :value="old('student_id')" />
	
				<x-input-error :messages="$errors->get('editing.student_id')" class="mt-2" />
			</div>
	
				<!-- Email Address -->
				<div class="mt-4 px-4">
					<x-input-label for="email" :value="__('Email Address')" />
	
					<x-text-input wire:model="editing.email" id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"/>
	
					<x-input-error :messages="$errors->get('editing.email')" class="mt-2" />
				</div>

				<!-- Email Address -->
				<div class="mt-4 px-4">
					<x-input-label for="password" :value="__('Email Address')" />
	
					<x-text-input wire:model="editing.password" id="password" class="block mt-1 w-full" type="text" name="password" :value="old('password')"/>
	
					<x-input-error :messages="$errors->get('editing.password')" class="mt-2" />
				</div>
			</div>
		</x-slot>
		
			<x-slot name="footer">
				<x-secondary-button wire:click="$set('showEditModal', 'false')" class="mx-2">Cancel</x-secondary-button>
				<x-primary-button class="mx-2">Save</x-primary-button>
			</x-slot>
			</x-dialog-modal>
		</form>		
	</div>
	@include('admin.body.footer')
</div>


