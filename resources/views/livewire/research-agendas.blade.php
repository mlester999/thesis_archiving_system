<div class="w-full px-6 pb-6 h-screen overflow-y-auto">
	<x-loading-indicator />
	<div
	  class="lg:px-2 py-4 lg:py-7"
	>
	<div class="flex-1 min-w-0 py-2">
		<p class="pb-6 pt-3 font-bold uppercase text-sm leading-7 tracking-wider text-gray-600"><span class="flex items-center gap-1"> <x-ri-home-3-fill class="w-4 h-4" /> Home<x-heroicon-o-arrow-long-right class="w-5 h-6" />Maintenance<x-heroicon-o-arrow-long-right class="w-5 h-6" />Research Agenda List</span></p>
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
			New Research Agenda
		  </button>
		</div>
		</div>
	  </div>
	</div>

	<div class="overflow-x-auto sm:rounded-lg space-y-8"
	>
	  <table class="min-w-full border-separate divide-y divide-gray-200 border-b-2 shadow">
		<thead class="bg-gray-50 whitespace-nowrap ">
		  <tr
			tabindex="0"
			class="focus:outline-none h-16 w-full text-xs md:text-sm leading-none text-gray-800"
		  >
			<th class="font-semibold text-left px-6 text-gray-700 uppercase tracking-normal"># 
				<span wire:click="sortBy('id')" class="cursor-pointer ml-2">
					<i class="fa-solid fa-arrow-{{ $sortField === 'id' && $sortDirection === 'asc' ? 'up' : 'down' }} fa-xs"></i>
				</span>
			</th>
			<th class="font-semibold text-left px-4 text-gray-700 uppercase tracking-normal">College 
				<span wire:click="sortBy('department_id')" class="cursor-pointer ml-2">
					<i class="fa-solid fa-arrow-{{ $sortField === 'created_at' && $sortDirection === 'asc' ? 'up' : 'down' }} fa-xs"></i>
				</span>
			</th>
			<th class="font-semibold text-left px-4 text-gray-700 uppercase tracking-normal">Agenda Name
				<span wire:click="sortBy('agenda_description')" class="cursor-pointer ml-2">
					<i class="fa-solid fa-arrow-{{ $sortField === 'agenda_description' && $sortDirection === 'asc' ? 'up' : 'down' }} fa-xs"></i>
				</span>
			</th>
			<th class="font-semibold text-left px-4 text-gray-700 uppercase tracking-normal">Description
				<span wire:click="sortBy('agenda_name')" class="cursor-pointer ml-2">
					<i class="fa-solid fa-arrow-{{ $sortField === 'agenda_name' && $sortDirection === 'asc' ? 'up' : 'down' }} fa-xs"></i>	
				</span>
			</th>
			<th class="font-semibold text-left px-4 text-gray-700 uppercase tracking-normal">Status
				<span wire:click="sortBy('agenda_status')" class="cursor-pointer ml-2">
					<i class="fa-solid fa-arrow-{{ $sortField === 'agenda_status' && $sortDirection === 'asc' ? 'up' : 'down' }} fa-xs"></i>
				</span>
			</th>
			<th class="font-semibold text-left px-4 text-gray-700 uppercase tracking-normal">Action</th>
		  </tr>
		</thead>
		<tbody class="w-full" id="main-table-body">
			@forelse($agendas as $key => $agenda)
		  <tr
		  	wire:loading.class="opacity-50"
			tabindex="{{ $agenda->id }}"
			class="odd:bg-white even:bg-slate-50 focus:outline-none h-auto text-xs md:text-sm leading-none text-gray-800 bg-white border-b border-t border-gray-100"
		  >
			<td class="px-6 py-6">
			  <div class="flex items-center">
				<div>
				  <p class="text-md font-medium leading-none text-gray-800">{{ $agenda->id }}</p>
				</div>
			  </div>
			</td>
			<td class="px-4 py-6">
				<p class="text-md font-medium leading-normal text-gray-800">{{ $agenda->dept_description }}</p>
			</td>
			<td class="px-4 py-6">
			  <p class="text-md font-medium leading-normal text-gray-800">
				{{ $agenda->agenda_name }}
			  </p>
			</td>
			<td class="px-4 py-6">
				<p class="text-md font-medium leading-normal text-gray-800">
				  {{ $agenda->agenda_description }}
				</p>
			  </td>
			<td class="px-4 py-6">
                @if($agenda->agenda_status)
				<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gradient-to-r from-green-300 to-green-400 text-green-800">
                    Activated
                </span>
				@else
				<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gradient-to-r from-red-300 to-red-400 text-red-800">
                    Deactivated
                </span>
				@endif
			</td>
			<td class="px-4 whitespace-nowrap ">
				<button wire:loading.attr="disabled" wire:loading.class="cursor-not-allowed" wire:click="view({{ $agenda->id }})" class="cursor-pointer px-1 fa-solid fa-eye text-slate-900 hover:text-opacity-70 duration-150 fa-xl"></button>
				<button wire:loading.attr="disabled" wire:loading.class="cursor-not-allowed" wire:click="edit({{ $agenda->id }})" class="cursor-pointer px-1 fa-solid fa-pen-to-square text-blue-500 hover:text-opacity-70 duration-150 fa-xl"></button>
				<button wire:loading.attr="disabled" wire:loading.class="cursor-not-allowed" wire:click="disable({{ $agenda->id }})" class="cursor-pointer pl-1 pr-8 fa-solid {{ $agenda->agenda_status ? 'fa-user-slash text-red-600' : 'fa-user-check text-green-600' }} hover:text-opacity-70 duration-150 fa-xl"></button>
			  </td>
		  </tr>
		  @empty
		  <tr
		  wire:loading.class="opacity-50"
		  class="odd:bg-white even:bg-slate-50 focus:outline-none h-26 text-sm leading-none text-gray-800 bg-white border-b border-t border-gray-100"
		>
		  <td colspan="8" class="px-4">
			<div class="flex items-center justify-center">
			  <div>
				<p class="text-md sm:text-lg py-8 font-medium leading-none text-gray-400">No research agendas found...</p>
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
		{{ $agendas->links() }}
	  </div>

	   {{-- Show View Modal --}}

		<x-dialog-modal wire:model.defer="showViewModal">
		  <x-slot name="title"><i class="fa-solid fa-circle-info fa-xl pr-4 text-gray-500"></i>{{ $agendaTitle }}</x-slot>
	  
		  <x-slot name="content">
			  <!--Body-->
	  
				  <div class="grid grid-cols-1 md:grid-cols-3 py-2">
	  
				  <!-- First Col -->
				  <div class="px-4">
					<h1 class="text-xs md:text-sm lg:text-base font-semibold text-left">Id:</h1> 
					<p class="text-xs md:text-sm lg:text-base text-left my-1">{{ $agendaId }}</p>
					<h1 class="text-xs md:text-sm lg:text-base font-semibold text-left mt-3 md:mt-6">College:</h1> 
					@php
					$departmentInfo = App\Models\Department::find($dept_id);
					@endphp
					<p class="text-xs md:text-sm lg:text-base text-left my-1">{{ $departmentInfo->dept_description ?? 'College Not Found' }}</p>
					
				  </div>

				  <!-- Second Col -->
				  <div class="px-4">
					<h1 class="text-xs md:text-sm lg:text-base font-semibold text-left mt-3 md:mt-0">Status:</h1> 
                    @if($agenda_status)
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gradient-to-r from-green-300 to-green-400 text-green-800">
                        Activated
                    </span>
                    @else
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gradient-to-r from-red-300 to-red-400 text-red-800">
                        Deactivated
                    </span>
                    @endif
					<h1 class="text-xs md:text-sm lg:text-base font-semibold text-left mt-3 md:mt-6">Agenda Name:</h1> 
					<p class="text-xs md:text-sm lg:text-base text-left my-1">{{ $agenda_name }}</p>
				  </div>

				  <div class="px-4">
					<h1 class="text-xs md:text-sm lg:text-base font-semibold text-left mt-3 md:mt-0">Created At:</h1> 
					<p class="text-xs md:text-sm lg:text-base text-left my-1">{{ date('m/d/Y', strtotime($createdAt)) }}</p>
					<h1 class="text-xs md:text-sm lg:text-base font-semibold text-left mt-3 md:mt-6">Description:</h1> 
					<p class="text-xs md:text-sm lg:text-base text-left my-1">{{ $agenda_description }}</p>
				  </div>
			  </div>
		  </x-slot>
		  
			  <x-slot name="footer">
				  <x-secondary-button wire:loading.attr="disabled" wire:loading.class="cursor-not-allowed" wire:click="$set('showViewModal', false)" class="mx-2">Cancel</x-secondary-button>
			  </x-slot>
			  </x-dialog-modal>	
	  

	  {{-- Show Delete Modal --}}
	  <form wire:submit.prevent="disableAgenda">

		<x-confirmation-modal wire:model.defer="showDeleteModal">
			<x-slot name="title">
				@if($agenda_status)
				<i class="fa-solid fa-triangle-exclamation fa-lg pr-4 text-red-500"></i>
				@else
				<i class="fa-solid fa-triangle-exclamation fa-lg pr-4 text-green-500"></i>
				@endif
				{{ $agendaTitle }}
			</x-slot>
	  
			<x-slot name="content">
				@if($agenda_status)
				<h1 class="text-md md:text-lg lg:text-xl xl:text-2xl font-semibold text-center mt-16">Are you sure you want to deactivate this agenda?</h1> 
				<p class="text-center mt-4 mb-16">This agenda will be deactivated immediately.</p> 
				@else
				<h1 class="text-md md:text-lg lg:text-xl xl:text-2xl font-semibold text-center mt-16">Are you sure you want to activate this agenda?</h1> 
				<p class="text-center mt-4 mb-16">This agenda will be activated immediately.</p> 
				@endif
			  </x-slot>
		  
			  <x-slot name="footer">
				<x-secondary-button wire:loading.attr="disabled" wire:loading.class="cursor-not-allowed" wire:click="$set('showDeleteModal', false)" class="mx-2">Cancel</x-secondary-button>
				@if($agenda_status)
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
		<x-slot name="title"><i class="fa-solid fa-circle-plus fa-xl pr-4 text-gray-500"></i>{{ $agendaTitle }}</x-slot>
	
		<x-slot name="content">
			<!--Body-->

				<!-- Department Name -->
				<div class="pt-1 pb-3">
					<x-input-label for="department_id" :value="__('College')" />
	
					<select wire:model.defer="editing.department_id" id="department_id" name="department_id" class="border mt-1 text-xs md:text-sm xl:text-base border-gray-300 p-2 text-gray-900 text-sm rounded-md focus:ring-1 focus:ring-green-500 focus:border-green-500 placeholder:font-sans placeholder:font-light focus:outline-none block w-full">
						<option value="" hidden>~ Select College ~</option>
						@foreach($departments as $key => $department)
						<option value="{{ $department->id }}" selected >{{ $department->dept_description }}</option>
						@endforeach()
						</select>
	
					<x-input-error :messages="$errors->get('editing.department_id')" />
				</div>

				<!-- Agenda Name -->
				<div class="py-3">
					<x-input-label for="agenda_name" :value="__('Agenda Name')" />
	
					<x-text-input wire:model.defer="editing.agenda_name" id="agenda_name" class="block mt-1 w-full" type="text" name="agenda_name" placeholder="Agenda Name" :value="old('agenda_name')" autofocus />
	
					<x-input-error :messages="$errors->get('editing.agenda_name')" />
				</div>
	
				<!-- Agenda Description -->
				<div class="pt-3 pb-6">
					<x-input-label for="agenda_description" :value="__('Agenda Description')" />
	
					<x-text-input wire:model.defer="editing.agenda_description" id="agenda_description" class="block mt-1 w-full" type="text" name="agenda_description" placeholder="Agenda Description" :value="old('agenda_description')" />
	
					<x-input-error :messages="$errors->get('editing.agenda_description')" />
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


