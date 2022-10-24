<div class="w-full sm:px-6 sm:pb-6 h-screen overflow-y-auto">
	<div
	  class="px-4 md:px-2 py-4 md:py-7"
	>
	  <div class="md:flex md:items-center md:justify-between">
		<div class="flex-1 min-w-0">
		  <h2
			class="text-lg font-bold leading-7 text-gray-900 sm:text-2xl sm:truncate uppercase"
		  >
			Curriculum List
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
			New Curriculum
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
			<th class="font-semibold text-left pl-8 text-gray-700 uppercase tracking-normal">Department
				<span wire:click="sortBy('department_id')" class="cursor-pointer ml-2">
					<i class="fa-solid fa-arrow-{{ $sortField === 'department_id' && $sortDirection === 'asc' ? 'up' : 'down' }} fa-xs"></i>	
				</span>
			</th>
			<th class="font-semibold text-left text-gray-700 uppercase tracking-normal">Curriculum Name
				<span wire:click="sortBy('name')" class="cursor-pointer ml-2">
					<i class="fa-solid fa-arrow-{{ $sortField === 'name' && $sortDirection === 'asc' ? 'up' : 'down' }} fa-xs"></i>
				</span>
			</th>
			<th class="font-semibold text-left pl-8 text-gray-700 uppercase tracking-normal">Status
				<span wire:click="sortBy('status')" class="cursor-pointer ml-2">
					<i class="fa-solid fa-arrow-{{ $sortField === 'status' && $sortDirection === 'asc' ? 'up' : 'down' }} fa-xs"></i>
				</span>
			</th>
			<th class="font-semibold text-left pl-8 text-gray-700 uppercase tracking-normal">Created at 
				<span wire:click="sortBy('created_at')" class="cursor-pointer ml-2">
					<i class="fa-solid fa-arrow-{{ $sortField === 'created_at' && $sortDirection === 'asc' ? 'up' : 'down' }} fa-xs"></i>
				</span>
			</th>
			{{-- <th class="font-semibold text-left pl-12 text-gray-700 uppercase tracking-normal">Status </th> --}}
			<th class="font-semibold text-left pl-12 text-gray-700 uppercase tracking-normal">Action</th>
		  </tr>
		</thead>
		<tbody class="w-full" id="main-table-body">
			@forelse($curricula as $key => $curriculum)
		  <tr
			tabindex="{{ $curriculum->id }}"
			class="odd:bg-white even:bg-slate-50 focus:outline-none h-20 text-sm leading-none text-gray-800 bg-white border-b border-t border-gray-100"
		  >
			<td class="pl-8">
			  <div class="flex items-center">
				<div>
				  <p class="text-md font-medium leading-none text-gray-800">{{ $curriculum->id }}</p>
				</div>
			  </div>
			</td>
			<td class="pl-8">
			  <p class="text-md font-medium leading-none text-gray-800">
				@php
					$department = App\Models\Department::find($curriculum->department_id);
				@endphp
				{{ $department->name }}
			  </p>
			</td>
			<td>
			  <p class="text-md font-medium leading-none text-gray-800">{{ $curriculum->name }}</p>
			</td>
			<td class="pl-8">
                @if($curriculum->status)
				<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-300 text-green-800">
                    Active
                </span>
				@else
				<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-300 text-red-800">
                    Inactive
                </span>
				@endif
			</td>
			<td class="pl-8">
				<p class="text-md font-medium leading-none text-gray-800">{{ $curriculum->created_at->format('M d, Y') }}</p>
			  </td>
			<td class="pl-8">
				<button @click="toggle()" class="relative flex justify-center items-center bg-white border focus:outline-none shadow text-gray-600 rounded focus:ring ring-gray-200 group">
					<p class="px-4">Action</p>
					<span class="border-1 p-2 hover:bg-gray-100">
						<i class="fa-solid fa-caret-down"></i>	
					</span>
					<div x-show="open" x-transition class="absolute group-focus:block hidden z-50 top-full min-w-full w-max bg-white shadow-md mt-1 rounded">
						<ul class="text-left border rounded">
							<li wire:click="view({{ $curriculum->id }})" class="px-4 py-2.5 hover:bg-gray-100 border-b"><i class="fa-solid fa-eye mr-1"></i> View</li>
							<li wire:click="edit({{ $curriculum->id }})" class="px-4 py-2.5 hover:bg-gray-100 border-b"><i class="fa-solid fa-pen-to-square mr-2 text-blue-600"></i> Edit</li>
							<li wire:click="delete({{ $curriculum->id }})" class="px-4 py-2.5 hover:bg-gray-100"><i class="fa-solid fa-trash mr-2 text-red-600"></i> Delete</li>
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
				<p class="text-xl py-8 font-medium leading-none text-gray-400">No curricula found...</p>
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
		{{ $curricula->links() }}
	  </div>

	   {{-- Show View Modal --}}

		<x-dialog-modal wire:model.defer="showViewModal">
		  <x-slot name="title">{{ $curriculumTitle }}</x-slot>
	  
		  <x-slot name="content">
			  <!--Body-->
	  
				  <div class="grid grid-cols-2 py-6">
  
				  <!-- First Name -->
				  <div class="px-4">
					 <img src="{{ asset('/images/pncLogo.png') }}" class="w-80">
				  </div>
	  
				  <!-- Last Name -->
				  <div class="px-4">
					<h1 class="text-lg font-semibold text-left">Curriculum ID:</h1> 
					<p class="text-left mt-2 mb-2">{{ $curriculumId }}</p>
					<h1 class="text-lg mt-2 font-semibold text-left">Department:</h1> 
					@php
					$departmentInfo = App\Models\Department::find($departmentId);
					@endphp
					<p class="text-left mt-2 mb-2">{{ $departmentInfo->name ?? 'Department Not Found' }}</p>
					<h1 class="text-lg mt-2 font-semibold text-left">Curriculum:</h1> 
					<p class="text-left mt-2 mb-2">{{ $name }}</p>
					<h1 class="text-lg mt-2 font-semibold text-left">Status:</h1> 
                    @if($status)
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-300 text-green-800">
                        Active
                    </span>
                    @else
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-300 text-red-800">
                        Inactive
                    </span>
                    @endif
					{{-- <p class="text-left mt-2 mb-2">{{ $status }}</p> --}}
				  </div>
			  </div>
		  </x-slot>
		  
			  <x-slot name="footer">
				  <x-secondary-button wire:click="$set('showViewModal', false)" class="mx-2">Cancel</x-secondary-button>
			  </x-slot>
			  </x-dialog-modal>	
	  

	  {{-- Show Delete Modal --}}
	  <form wire:submit.prevent="deleteCurriculum">

		<x-confirmation-modal wire:model.defer="showDeleteModal">
		  <x-slot name="title">{{ $curriculumTitle }}</x-slot>
	  
		  <x-slot name="content">
			<h1 class="text-2xl font-semibold text-center mt-16">Are you sure you want to delete curriculum?</h1> 
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
		<x-slot name="title">{{ $curriculumTitle }}</x-slot>
	
		<x-slot name="content">
			<!--Body-->
	
				<!-- Department Name -->
				<div class="py-3">
					<x-input-label class="pt-3" for="department_id" :value="__('Department')" />
	
					<select wire:model.defer="editing.department_id" id="department_id" name="department_id" class="border mt-1 border-gray-300 p-2 text-gray-900 text-sm rounded-md focus:ring-1 focus:ring-green-500 focus:border-green-500 placeholder:font-sans placeholder:font-light focus:outline-none block w-full">
						<option value="" hidden>~ Select Department ~</option>
						@foreach($departments as $key => $department)
						<option value="{{ $department->id }}" selected >{{ $department->name }}</option>
						@endforeach()
						</select>
	
					<x-input-error :messages="$errors->get('editing.department_id')" />
				</div>
	
				<!-- Curriculum Name -->
				<div class="py-3">
					<x-input-label for="name" :value="__('Curriculum')" />
	
                    <x-text-input wire:model.defer="editing.name" id="name" class="block mt-1 w-full" type="text" name="name" placeholder="Curriculum" :value="old('name')" autofocus />
	
					<x-input-error :messages="$errors->get('editing.name')" />
				</div>
	
				<!-- Status -->
				<div class="py-3">
				<x-input-label class="pt-3" for="status" :value="__('Status')" />
                <select wire:model.defer="editing.status" id="status" name="status" class="border mt-1 border-gray-300 p-2 text-gray-900 text-sm rounded-md focus:ring-1 focus:ring-green-500 focus:border-green-500 placeholder:font-sans placeholder:font-light focus:outline-none block w-full">
                <option hidden selected>~ Select the Status ~</option>
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


