<div class="w-full px-6 pb-6 h-screen overflow-y-auto">
	<div
	  class="lg:px-2 py-4 lg:py-7"
	>
	<div class="flex-1 min-w-0 py-2">
	  <h2
		class="font-bold leading-7 text-gray-900 text-2xl lg:truncate uppercase"
	  >
		Report Logs
	  </h2>
	</div>
	  <div class="lg:flex lg:items-center lg:justify-end">
		<div class="mt-4 flex justify-end lg:mt-0 z-0 space-x-2">
			<div class="flex flex-col">
			<label class="d-block md:text-sm text-xs">
				<input type="radio" name="topics" wire:model="showTopics" value="Available Topics" /> Available Topics
			</label>
			<label class="d-block md:text-sm text-xs">
				<input type="radio" name="topics" wire:model="showTopics" value="Not Available Topics" /> Not Available Topics
			</label>
		</div>
			<button wire:loading.attr="disabled" wire:loading.class="cursor-not-allowed active:ring-0 active:ring-offset-0" wire:click="view()" class="inline-flex bg-white px-4 py-2 items-center border border-gray-300 text-gray-900 rounded-md active:ring-1 active:ring-green-500 placeholder:font-sans placeholder:font-light focus:outline-none text-xs md:text-sm">
				Most Searched Thesis
			</button>
			<select name="show_results" wire:model="showResults" id="show_results" name="show_results" class="pr-6 inline-flex items-center border border-gray-300 text-gray-900 rounded-md focus:ring-1 focus:ring-green-500 focus:border-green-500 placeholder:font-sans placeholder:font-light focus:outline-none text-xs md:text-sm">
				<option value="5" selected>Show 5 Results</option>
				<option value="25">Show 25 Results</option>
				<option value="50">Show 50 Results</option>
				</select>
			<label class="relative block">
				<span class="sr-only">Search</span>
				<span class="absolute inset-y-0 left-0 flex items-center pl-2">
					<i class="fa-solid fa-magnifying-glass ml-1"></i>
				</span>
				<input wire:model="search" class="placeholder:italic placeholder:text-slate-700 bg-white w-48 border border-slate-300 rounded-md py-2 pl-9 pr-3 shadow-sm focus:outline-none focus:border-green-500 focus:ring-green-500 focus:ring-1 text-xs md:text-sm" placeholder="Search for student id..." type="text" name="search"/>
			  </label>
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
	  class="overflow-x-auto sm:rounded-lg space-y-8"
	>
	  <table class="min-w-full whitespace-nowrap divide-y divide-gray-200 border-b-2">
		<thead class="bg-gray-50">
		  <tr
			tabindex="0"
			class="focus:outline-none h-16 w-full text-sm leading-none text-gray-800"
		  >
			<th class="font-semibold text-left pl-12 text-gray-700 uppercase tracking-normal">Log Name 
				<span wire:click="sortBy('student_id')" class="cursor-pointer ml-2">
					<i class="fa-solid fa-arrow-{{ $sortField === 'student_id' && $sortDirection === 'asc' ? 'up' : 'down' }} fa-xs"></i>	
				</span>
			</th>
			<th class="font-semibold text-left pl-12 text-gray-700 uppercase tracking-normal">Description
				<span wire:click="sortBy('name')" class="cursor-pointer ml-2">
					<i class="fa-solid fa-arrow-{{ $sortField === 'name' && $sortDirection === 'asc' ? 'up' : 'down' }} fa-xs"></i>
				</span>
			</th>
			<th class="font-semibold text-left pl-12 text-gray-700 uppercase tracking-normal">Event
				<span wire:click="sortBy('created_at')" class="cursor-pointer ml-2">
					<i class="fa-solid fa-arrow-{{ $sortField === 'created_at' && $sortDirection === 'asc' ? 'up' : 'down' }} fa-xs"></i>
				</span>
			</th>
			<th class="font-semibold text-left pl-12 text-gray-700 uppercase tracking-normal">Student ID </th>
			<th class="font-semibold text-left pl-12 text-gray-700 uppercase tracking-normal">IP Address </th>
			<th class="font-semibold text-left pl-12 pr-4 text-gray-700 uppercase tracking-normal">Action</th>
		  </tr>
		</thead>
		<tbody class="w-full" id="main-table-body">
			@forelse($activities as $key => $activity)

		  <tr
		  	wire:loading.class="opacity-50"
			tabindex="{{ $activity->id }}"
			class="odd:bg-white even:bg-slate-50 focus:outline-none h-20 text-sm leading-none text-gray-800 bg-white border-b border-t border-gray-100"
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
					<button wire:loading.attr="disabled" wire:loading.class="cursor-not-allowed" wire:click="delete({{ $activity->id }})" class="mr-4 cursor-pointer bg-red-500 shadow-sm rounded-md p-2 hover:bg-opacity-70 duration-150"><i class="fa-solid fa-trash text-white fa-md md:fa-lg"></i><span class="px-2 text-white text-semibold text-sm">Delete</span></button>
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
				<p class="text-xl py-8 font-medium leading-none text-gray-400">No report logs found...</p>
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

	   {{-- Show View Modal --}}

		<x-dialog-modal wire:model.defer="showViewModal">
		  <x-slot name="title"><i class="fa-solid fa-magnifying-glass fa-md pr-4 text-gray-500"></i>{{ $logTitle }}</x-slot>
	  
		  <x-slot name="content">
			  <!--Body-->
			  <table class="min-w-full whitespace-nowrap divide-y divide-gray-200 border-b-2 shadow">
				<thead class="bg-gray-50">
				  <tr
					tabindex="0"
					class="focus:outline-none h-16 w-full text-sm leading-none text-gray-800"
				  >
				  <th class="font-semibold text-left pl-8 text-gray-700 uppercase tracking-normal"># 
					</th>
					<th class="font-semibold text-left pl-12 text-gray-700 uppercase tracking-normal">Top Search
					</th>
					<th class="font-semibold text-left pl-12 text-gray-700 uppercase tracking-normal">Total Searches
					</th>
				  </tr>
				</thead>
				<tbody class="w-full" id="main-table-body">
					@forelse($searches as $key => $search)
		
				  <tr
				  	wire:loading.class="opacity-50"
					tabindex="{{ $search->id }}"
					class="odd:bg-white even:bg-slate-50 focus:outline-none h-20 text-sm leading-none text-gray-800 bg-white border-b border-t border-gray-100"
				  >
				  <td class="pl-8">
					<div class="flex items-center">
					  <div>
						<p class="text-md font-medium leading-none text-gray-800">{{ $key + 1 }}</p>
					  </div>
					</div>
				  </td>
					<td class="pl-12">
					  <p class="text-md font-medium leading-none text-gray-800">{{ $sortedArrKeys[$key] }}</p>
					</td>
					<td class="pl-12">
						<p class="text-md font-medium leading-none text-gray-800">{{ $sortedArr[$sortedArrKeys[$key]] }} {{$sortedArr[$sortedArrKeys[$key]] == 1 ? ' search for this.' : ' searches for this.'}}</p>
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
						<p class="text-xl py-8 font-medium leading-none text-gray-400">No top search found...</p>
					  </div>
					</div>
				  </td>
				</tr>
				  @endforelse
				</tbody>
			  </table>
		  </x-slot>
		  
			  <x-slot name="footer">
				  <x-secondary-button wire:loading.attr="disabled" wire:loading.class="cursor-not-allowed" wire:click="$set('showViewModal', false)" class="mx-2">Cancel</x-secondary-button>
			  </x-slot>
			  </x-dialog-modal>	
	  

	  {{-- Show Delete Modal --}}
	  <form wire:submit.prevent="deleteLog">

		<x-confirmation-modal wire:model.defer="showDeleteModal">
		  <x-slot name="title"><i class="fa-solid fa-triangle-exclamation fa-md pr-4 text-red-500"></i>{{ $logTitle }}</x-slot>
	  
		  <x-slot name="content">
			<h1 class="text-md md:text-lg lg:text-xl xl:text-2xl font-semibold text-center mt-16">Are you sure you want to delete this report log?</h1> 
			<p class="text-center mt-4 mb-16">This action is irreversible.</p> 
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


