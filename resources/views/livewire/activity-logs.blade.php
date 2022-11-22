<div class="w-full px-6 pb-6 h-screen overflow-y-auto">
	<div
	  class="lg:px-2 py-4 lg:py-7"
	>
	<div class="flex-1 min-w-0 py-2">
	  <h2
		class="font-bold leading-7 text-gray-900 text-2xl lg:truncate uppercase"
	  >
		Activity Logs
	  </h2>
	</div>
	  <div class="lg:flex lg:items-center lg:justify-end">
		<div class="mt-4 flex justify-end lg:mt-0 lg:ml-4 z-0">
			<select name="show_results" wire:model="showResults" id="show_results" name="show_results" class="inline-flex items-center border border-gray-300 text-gray-900 rounded-md focus:ring-1 focus:ring-green-500 focus:border-green-500 placeholder:font-sans placeholder:font-light focus:outline-none text-xs md:text-sm">
				<option value="5" selected>Show 5 Results</option>
				<option value="25">Show 25 Results</option>
				<option value="50">Show 50 Results</option>
				</select>
			<label class="relative block ml-3">
				<span class="sr-only">Search</span>
				<span class="absolute inset-y-0 left-0 flex items-center pl-2">
					<i class="fa-solid fa-magnifying-glass lg:ml-1"></i>
				</span>
				<input wire:model="search" class="placeholder:italic placeholder:text-slate-700 block bg-white w-40 md:w-48 border border-slate-300 rounded-md pl-7 lg:pl-9 pr-3 shadow-sm focus:outline-none focus:border-green-500 focus:ring-green-500 focus:ring-1 text-xs md:text-sm" placeholder="Search for student id..." type="text" name="search"/>
			  </label>
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
			<th class="font-semibold text-left pl-12 text-gray-700 uppercase tracking-normal">Log Name 
				<span wire:click="sortBy('log_name')" class="cursor-pointer ml-2">
					<i class="fa-solid fa-arrow-{{ $sortField === 'log_name' && $sortDirection === 'asc' ? 'up' : 'down' }} fa-xs"></i>	
				</span>
			</th>
			<th class="font-semibold text-left pl-12 text-gray-700 uppercase tracking-normal">Description
				<span wire:click="sortBy('description')" class="cursor-pointer ml-2">
					<i class="fa-solid fa-arrow-{{ $sortField === 'description' && $sortDirection === 'asc' ? 'up' : 'down' }} fa-xs"></i>
				</span>
			</th>
			<th class="font-semibold text-left pl-12 text-gray-700 uppercase tracking-normal">Event
				<span wire:click="sortBy('log')" class="cursor-pointer ml-2">
					<i class="fa-solid fa-arrow-{{ $sortField === 'event' && $sortDirection === 'asc' ? 'up' : 'down' }} fa-xs"></i>
				</span>
			</th>
			<th class="font-semibold text-left pl-12 text-gray-700 uppercase tracking-normal">Student ID
				<span wire:click="sortBy('student_id')" class="cursor-pointer ml-2">
					<i class="fa-solid fa-arrow-{{ $sortField === 'student_id' && $sortDirection === 'asc' ? 'up' : 'down' }} fa-xs"></i>
				</span>
			</th>
			<th class="font-semibold text-left pl-12 text-gray-700 uppercase tracking-normal">IP Address
				<span wire:click="sortBy('properties')" class="cursor-pointer ml-2">
					<i class="fa-solid fa-arrow-{{ $sortField === 'properties' && $sortDirection === 'asc' ? 'up' : 'down' }} fa-xs"></i>
				</span>
			</th>
			<th class="font-semibold text-left pl-12 pr-4 text-gray-700 uppercase tracking-normal">Action</th>
		  </tr>
		</thead>
		<tbody class="w-full" id="main-table-body">
			@forelse($activities as $key => $activity)
		  <tr
		  	wire:loading.class="opacity-50"
			tabindex="{{ $activity->id }}"
			class="odd:bg-white even:bg-slate-50 focus:outline-none h-16 text-xs md:text-sm leading-none text-gray-800 bg-white border-b border-t border-gray-100"
		  >
			<td class="pl-12">
			  <p class="text-md font-medium leading-none text-gray-800">
				{{ $activity->log_name }}
			  </p>
			</td>
			<td class="pl-12">
			  <p class="text-md font-medium leading-none text-gray-800">{{ $activity->description }}</p>
			</td>
			<td class="pl-12">
				<p class="text-md font-medium leading-none text-gray-800">{{ $activity->event }}</p>
			  </td>
            <td class="pl-12">
            <p class="text-md font-medium leading-none text-gray-800">{{ $activity->student_id }}</p>
            </td>
			<td class="pl-12">
				<p class="text-md font-medium leading-none text-gray-800">{{ $activity->properties->first() }}</p>
				</td>
			<td class="pl-12">
				<button wire:loading.attr="disabled" wire:loading.class="cursor-not-allowed" wire:click="delete({{ $activity->id }})" class="mr-8 cursor-pointer bg-red-500 shadow-sm rounded-md p-2 hover:bg-opacity-70 duration-150"><i class="fa-solid fa-trash text-white fa-sm md:fa-md lg:fa-lg"></i><span class="px-1 md:px-2 text-white text-semibold text-xs md:text-sm">Delete</span></button>
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
				<p class="text-xl py-8 font-medium leading-none text-gray-400">No activity logs found...</p>
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
		{{ $activities->links() }}
	  </div>
	  
	  {{-- Show Delete Modal --}}
	  <form wire:submit.prevent="deleteLog">

		<x-confirmation-modal wire:model.defer="showDeleteModal">
		  <x-slot name="title"><i class="fa-solid fa-triangle-exclamation fa-lg pr-4 text-red-500"></i>{{ $logTitle }}</x-slot>
	  
		  <x-slot name="content">
			<h1 class="text-md md:text-lg lg:text-xl xl:text-2xl font-semibold text-center mt-16">Are you sure you want to delete this activity log?</h1> 
			<p class="text-center mt-4 mb-16 text-sm lg:text-base">This action is irreversible.</p> 
		  </x-slot>
		  
			  <x-slot name="footer">
				  <x-secondary-button wire:loading.attr="disabled" wire:loading.class="cursor-not-allowed" wire:click="$set('showDeleteModal', false)" class="mx-2">Cancel</x-secondary-button>
				  <x-delete-button wire:loading.attr="disabled" wire:loading.class="cursor-not-allowed" class="mx-2 bg-red-500">Delete</x-delete-button>
			  </x-slot>
			  </x-confirmation-modal>
		  </form>		
	</div>
	@include('admin.body.footer')
</div>


