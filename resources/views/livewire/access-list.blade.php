<div class="w-full px-6 pb-6 h-screen overflow-y-auto">
	<div
	  class="px-4 md:px-2 py-4 md:py-7"
	>
	  <div class="md:flex md:items-center md:justify-between">
		<div class="flex-1 min-w-0">
		  <h2
			class="text-lg font-bold leading-7 text-gray-900 sm:text-2xl sm:truncate uppercase"
		  >
			Access List
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
			class="ml-3 inline-flex items-center px-4 py-2 border duration-200 border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-500 hover:bg-opacity-80 active:outline-none active:ring-2 active:ring-offset-2 active:ring-green-500"
		  ><i class="fa-solid fa-plus mr-2"></i>
			New Access
		  </button>
		</div>
	  </div>
	</div>

	<div
	x-data="{ 
		open: false,
		toggle() {
			this.open = this.open ? this.close() : true
		},
		close() {
			this.open = false
		}
	}"
	  class="overflow-x-auto sm:rounded-lg space-y-8 "
	>
	  <table class="min-w-full whitespace-nowrap divide-y divide-gray-200 border-b-2 shadow">
		<thead class="bg-gray-50">
		  <tr
			tabindex="0"
			class="focus:outline-none h-16 w-full text-sm leading-none text-gray-800"
		  >
			<th class="font-semibold text-left pl-8 text-gray-700 uppercase tracking-normal"># 
			</th>
			<th class="font-semibold text-left pl-12 text-gray-700 uppercase tracking-normal">Roles
				<span wire:click="sortBy('roles')" class="cursor-pointer ml-2">
					<i class="fa-solid fa-arrow-{{ $sortField === 'roles' && $sortDirection === 'asc' ? 'up' : 'down' }} fa-xs"></i>	
				</span>
			</th>
			<th class="font-semibold text-left pl-12 text-gray-700 uppercase tracking-normal">Features 
				<span wire:click="sortBy('features')" class="cursor-pointer ml-2">
					<i class="fa-solid fa-arrow-{{ $sortField === 'features' && $sortDirection === 'asc' ? 'up' : 'down' }} fa-xs"></i>
				</span>
			</th>
            <th class="font-semibold text-left pl-12 text-gray-700 uppercase tracking-normal">Description 
				<span wire:click="sortBy('description')" class="cursor-pointer ml-2">
					<i class="fa-solid fa-arrow-{{ $sortField === 'description' && $sortDirection === 'asc' ? 'up' : 'down' }} fa-xs"></i>
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
			@forelse($accesses as $key => $access)
		  <tr
			tabindex="{{ $access->id }}"
			class="odd:bg-white even:bg-slate-50 focus:outline-none h-20 text-sm leading-none text-gray-800 bg-white border-b border-t border-gray-100"
		  >
			<td class="pl-8 cursor-pointer">
			  <div class="flex items-center">
				<div>
				  <p class="text-md font-medium leading-none text-gray-800">{{ $access->id }}</p>
				</div>
			  </div>
			</td>
			<td class="pl-12">
			  <p class="text-md font-medium leading-none text-gray-800">
				{{ $access->role_name }}
			  </p>
			</td>
			<td class="pl-12">
			  <p class="text-md font-medium leading-none text-gray-800">{{ $access->permission_name }}</p>
			</td>
			<td class="pl-12">
			  <p class="text-md font-medium leading-none text-gray-800">{{ \Illuminate\Support\Str::limit($access->description, 30, '...') }}</p>
			</td>
			<td class="pl-12">
				<p class="text-md font-medium leading-none text-gray-800">{{ $access->created_at->format('m/d/Y') }}</p>
			  </td>
			  <td class="pl-12">
				@if($access->status)
				<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gradient-to-r from-green-300 to-green-400 text-green-800">
                    Active
                </span>
				@else
				<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gradient-to-r from-red-300 to-red-400 text-red-800">
                    Inactive
                </span>
				@endif
			  </td>
			<td class="pl-12">
				<button @click="toggle()" class="relative flex justify-center items-center bg-white border focus:outline-none shadow text-gray-600 rounded focus:ring ring-gray-200 group">
					<p class="px-4">Action</p>
					<span class="border-1 p-2 hover:bg-gray-100">
						<i class="fa-solid fa-caret-down"></i>	
					</span>
					<div x-show="open" x-transition class="absolute group-focus:block hidden z-50 top-full min-w-full w-max bg-white shadow-md mt-1 rounded">
						<ul class="text-left border rounded">
							<li wire:click="view({{ $access->id }})" class="px-4 py-2.5 hover:bg-gray-100 border-b"><i class="fa-solid fa-eye mr-1"></i> View</li>
							<li wire:click="edit({{ $access->id }})" class="px-4 py-2.5 hover:bg-gray-100 border-b"><i class="fa-solid fa-pen-to-square mr-2 text-blue-600"></i> Edit</li>
							<li wire:click="delete({{ $access->id }})" class="px-4 py-2.5 hover:bg-gray-100"><i class="fa-solid fa-trash mr-2 text-red-600"></i> Delete</li>
						</ul>
					</div>
				</button>
			  </td>
		  </tr>
		  @empty
		  <tr
		  {{-- wire:loading.class.delay="opacity-50" --}}
		  class="odd:bg-white even:bg-slate-50 focus:outline-none h-26 text-sm leading-none text-gray-800 bg-white border-b border-t border-gray-100"
		>
		  <td colspan="7" class="pl-8">
			<div class="flex items-center justify-center">
			  <div>
				<p class="text-xl py-8 font-medium leading-none text-gray-400">No access found...</p>
			  </div>
			</div>
		  </td>
		</tr>
		  @endforelse
		</tbody>
	  </table>
	  <div
		class="flex flex-col xs:flex-row xs:justify-between py-8"
		>	
		{{ $accesses->links() }}
	  </div>

	   {{-- Show View Modal --}}

		<x-dialog-modal wire:model.defer="showViewModal">
		  <x-slot name="title"><i class="fa-solid fa-circle-info fa-xl pr-4 text-gray-500"></i>{{ $accessTitle }}</x-slot>
	  
		  <x-slot name="content">
			  <!--Body-->
	  
				  <div class="grid grid-cols-2 py-6">
	  
				  <!-- First Col -->
				  <div class="px-4">
					<h1 class="text-lg font-semibold text-left">Id:</h1> 
					<p class="text-left mt-2 mb-2">{{ $accessId }}</p>
					<h1 class="text-lg font-semibold text-left">Role:</h1> 
					<p class="text-left mt-2 mb-2">{{ $roleId }}</p>
                    <h1 class="text-lg font-semibold text-left">Features:</h1> 
					<p class="text-left mt-2 mb-2">{{ $permissionId }}</p>
				  </div>

				  <!-- Second COl -->
				  <div class="px-4">
                    <h1 class="text-lg font-semibold text-left">Description:</h1> 
					<p class="text-left mt-2 mb-2">{{ $description }}</p>
					<h1 class="text-lg font-semibold text-left">Status:</h1> 
					@if($status)
					<p class="text-left mt-2 mb-2">Verified</p>
					@else
					<p class="text-left mt-2 mb-2">Not Verified</p>
					@endif

				  </div>
			  </div>
		  </x-slot>
		  
			  <x-slot name="footer">
				  <x-secondary-button wire:click="$set('showViewModal', false)" class="mx-2">Cancel</x-secondary-button>
			  </x-slot>
			  </x-dialog-modal>	
	  

	  {{-- Show Delete Modal --}}
	  <form wire:submit.prevent="deleteAccess">

		<x-confirmation-modal wire:model.defer="showDeleteModal">
		  <x-slot name="title"><i class="fa-solid fa-triangle-exclamation fa-xl pr-4 text-red-500"></i>{{ $accessTitle }}</x-slot>
	  
		  <x-slot name="content">
			<h1 class="text-2xl font-semibold text-center mt-16">Are you sure you want to delete this access?</h1> 
			<p class="text-center mt-4 mb-16">This action is irreversible.</p> 
		  </x-slot>
		  
			  <x-slot name="footer">
				  <x-secondary-button wire:click="$set('showDeleteModal', false)" class="mx-2">Cancel</x-secondary-button>
				  <x-delete-button class="mx-2">Delete</x-delete-button>
			  </x-slot>
			  </x-confirmation-modal>
		  </form>		


	  {{-- Show Edit Modal --}}
	  <form wire:submit.prevent="save">

	  <x-dialog-modal wire:model.defer="showEditModal">
		<x-slot name="title"><i class="fa-solid fa-circle-plus fa-xl pr-4 text-gray-500"></i>{{ $accessTitle }}</x-slot>
	
		<x-slot name="content">
			<!--Body-->
	
            <!-- Student -->
            <div class="py-3">
                <x-input-label for="role_id" :value="__('Student Role')" />
                <select wire:model.defer="editing.role_id" id="role_id" name="role_id" class="border mt-1 border-gray-300 p-2 text-gray-900 text-sm rounded-md focus:ring-1 focus:ring-green-500 focus:border-green-500 placeholder:font-sans placeholder:font-light focus:outline-none block w-full">
                <option value="" hidden>~ Select Student Role ~</option>
                @foreach($roles as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
                </select>
    
                <x-input-error :messages="$errors->get('editing.role_id')" />
            </div>

            <!-- Features -->
            <div class="py-3">
                <x-input-label for="permission_id" :value="__('Features')" />
                <select wire:model.defer="editing.permission_id" id="permission_id" name="permission_id" class="border mt-1 border-gray-300 p-2 text-gray-900 text-sm rounded-md focus:ring-1 focus:ring-green-500 focus:border-green-500 placeholder:font-sans placeholder:font-light focus:outline-none block w-full">
                <option value="" hidden>~ Select Access Features ~</option>
                @foreach($permissions as $permission)
                <option value="{{ $permission->id }}">{{ $permission->name }}</option> 
                @endforeach
                </select>
    
                <x-input-error :messages="$errors->get('editing.permission_id')" />
            </div>

            <!-- Description -->
            <div class="py-3">
                <x-input-label for="description" :value="__('Description')" />
                <textarea wire:model.defer="editing.description" id="description" name="description" class="border mt-1 border-gray-300 p-2 text-gray-900 text-sm rounded-md focus:ring-1 focus:ring-green-500 focus:border-green-500 placeholder:font-sans placeholder:font-light focus:outline-none block w-full"> </textarea>
            
                <x-input-error :messages="$errors->get('editing.description')" />
            </div>

            <!-- Status -->
            <div class="py-3">
            <x-input-label for="status" :value="__('Status')" />
            <select wire:model.defer="editing.status" id="status" name="status" class="border mt-1 border-gray-300 p-2 text-gray-900 text-sm rounded-md focus:ring-1 focus:ring-green-500 focus:border-green-500 placeholder:font-sans placeholder:font-light focus:outline-none block w-full">
            <option value="" hidden>~ Select Status ~</option>
            <option value="0">Inactive</option>
            <option value="1">Active</option> 
            </select>

            <x-input-error :messages="$errors->get('editing.status')" />
                </div>
	
		</x-slot>
		
			<x-slot name="footer">
				<x-secondary-button wire:click="closeModal" class="mx-2">Cancel</x-secondary-button>
				<x-primary-button class="mx-2">Save</x-primary-button>
			</x-slot>
			</x-dialog-modal>
		</form>		
	</div>
	@include('admin.body.footer')
</div>


