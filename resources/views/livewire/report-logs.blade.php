	<div class="w-full px-6 pb-6 h-screen overflow-y-auto">
		<x-loading-indicator />
		<div
		class="xl:px-2 py-4 xl:py-7"
		>
		<div class="flex-1 min-w-0 py-2">
			<p class="pb-6 pt-3 font-bold uppercase text-sm leading-7 tracking-wider text-gray-600"><span class="flex items-center gap-1"> <x-ri-home-3-fill class="w-4 h-4" /> Home<x-heroicon-o-arrow-long-right class="w-5 h-6" />Logs<x-heroicon-o-arrow-long-right class="w-5 h-6" />Report Logs</span></p>
		</div>
		<div class="xl:flex xl:items-center xl:justify-end">
			<div class="mt-4 flex flex-col xl:flex-row justify-end z-0 xl:space-x-4">
				<div class="flex flex-row xl:flex-col justify-between mb-4 xl:mb-0">
					<div class="flex flex-col space-y-1 xl:space-y-0">
						<label class="d-block md:text-sm text-xs">
							<input type="radio" name="topics" wire:model="showTopics" value="Available Topics" /> Available Topics
						</label>
						<label class="d-block md:text-sm text-xs">
							<input type="radio" name="topics" wire:model="showTopics" value="Not Available Topics" /> Not Available Topics
						</label>
					</div>
				<button wire:loading.attr="disabled" wire:loading.class="cursor-not-allowed active:ring-0 active:ring-offset-0" wire:click="view()" class="inline-flex bg-blue-500 hover:bg-opacity-80 duration-150 px-4 py-2 items-center text-white rounded-md active:ring-1 active:ring-blue-500 placeholder:font-sans placeholder:font-light focus:outline-none text-xs md:text-sm">
					Most Searched Thesis
				</button>
			</div>
			<div class="flex flex-row xl:flex-col-reverse justify-between">
				<x-dropdown-list label="Bulk Actions">
					<x-dropdown.item @click="open = false" type="button" wire:click="beforeExportSelected" class="flex items-center space-x-2 text-xs md:text-sm">
						<x-icon.download class="text-cool-gray-400"/> <span>Export</span>
					</x-dropdown.item>
					
					<x-dropdown.item @click="open = false" type="button" wire:click="beforeDeleteSelected" class="flex items-center space-x-2 text-xs md:text-sm">
						<x-icon.trash class="text-cool-gray-400"/> <span>Delete</span>
					</x-dropdown.item>
				</x-dropdown-list>
				<x-dropdown-list label="Sort Department">
					@foreach($department_list as $department)
					<x-dropdown.item @click="open = false" type="button" wire:click="sortDepartment('{{ $department->dept_name }}')" class="flex items-center space-x-2 text-xs md:text-sm">
						<x-icon.department class="text-cool-gray-400"/> <span>{{ $department->dept_name }}</span>
					</x-dropdown.item>
					@endforeach
				</x-dropdown-list>
			</div>
			<div class="flex flex-row xl:flex-col justify-between mt-4 xl:mt-0 xl:space-y-4">
				<select name="show_results" wire:model="showResults" id="show_results" name="show_results" class="inline-flex w-36 sm:w-auto items-center border border-gray-300 text-gray-900 rounded-md focus:ring-1 focus:ring-green-500 focus:border-green-500 placeholder:font-sans placeholder:font-light focus:outline-none text-xs md:text-sm transition duration-150">
					<option value="5" selected>Show 5 Results</option>
					<option value="25">Show 25 Results</option>
					<option value="50">Show 50 Results</option>
					</select>
				<label class="relative block">
					<span class="sr-only">Search</span>
					<span class="absolute inset-y-0 left-0 flex items-center pl-2">
						<i class="fa-solid fa-magnifying-glass lg:ml-1"></i>
					</span>
					<input wire:model="search" class="placeholder:italic placeholder:text-slate-700 bg-white w-32 sm:w-40 md:w-48 border border-slate-300 rounded-md pl-7 lg:pl-9 pr-3 shadow-sm focus:outline-none focus:border-green-500 focus:ring-green-500 focus:ring-1 text-xs md:text-sm" placeholder="Search for student id..." type="text" name="search"/>
				</label>
				</div>
			</div>
		</div>
		</div>

		<div class="overflow-x-auto sm:rounded-lg space-y-8"
		>
		<table class="min-w-full border-separate whitespace-nowrap divide-y divide-gray-200 border-b-2">
			<thead class="bg-gray-50">
			<tr
				tabindex="0"
				class="focus:outline-none h-16 w-full text-xs md:text-sm leading-none text-gray-800"
			>
			<th class="font-semibold text-left px-6 text-gray-700 uppercase tracking-normal"> 
				<x-input.checkbox wire:model="selectPage" />
				</th>
				<th class="font-semibold text-left px-4 text-gray-700 uppercase tracking-normal">Log Name 
					<span wire:click="sortBy('log_name')" class="cursor-pointer ml-2">
						<i class="fa-solid fa-arrow-{{ $sortField === 'log_name' && $sortDirection === 'asc' ? 'up' : 'down' }} fa-xs"></i>	
					</span>
				</th>
				<th class="font-semibold text-left px-6 text-gray-700 uppercase tracking-normal">Topics
					<span wire:click="sortBy('description')" class="cursor-pointer ml-2">
						<i class="fa-solid fa-arrow-{{ $sortField === 'description' && $sortDirection === 'asc' ? 'up' : 'down' }} fa-xs"></i>
					</span>
				</th>
				<th class="font-semibold text-left px-6 text-gray-700 uppercase tracking-normal">Department
					<span wire:click="sortBy('event')" class="cursor-pointer ml-2">
						<i class="fa-solid fa-arrow-{{ $sortField === 'event' && $sortDirection === 'asc' ? 'up' : 'down' }} fa-xs"></i>
					</span>
				</th>
				<th class="font-semibold text-left px-6 text-gray-700 uppercase tracking-normal">Student ID
					<span wire:click="sortBy('student_id')" class="cursor-pointer ml-2">
						<i class="fa-solid fa-arrow-{{ $sortField === 'student_id' && $sortDirection === 'asc' ? 'up' : 'down' }} fa-xs"></i>
					</span>
				</th>
				<th class="font-semibold text-left px-6 text-gray-700 uppercase tracking-normal">IP Address
					<span wire:click="sortBy('properties')" class="cursor-pointer ml-2">
						<i class="fa-solid fa-arrow-{{ $sortField === 'properties' && $sortDirection === 'asc' ? 'up' : 'down' }} fa-xs"></i>
					</span>
				</th>
				<th class="font-semibold text-left px-6 pr-4 text-gray-700 uppercase tracking-normal">Action</th>
			</tr>
			</thead>
			<tbody class="w-full" id="main-table-body">
				@if ($selectPage)
				<x-table.row
				wire:key="row-message"
				class="bg-gray-200"
			>
					<x-table.cell colspan="8">
						@unless ($selectAll)
						<div class="text-xs md:text-sm">
							<span>You selected <strong>{{ $activities->count() }}</strong> report logs, do you want to select all <strong>{{ $activities->total() }}</strong>?</span>
							<x-button.link wire:click="selectAll" class="ml-1 text-blue-600 text-xs md:text-sm">Select All</x-button.link>
						</div>
						@else
						<span class="text-xs md:text-sm">You are currently selecting all <strong>{{ $activities->total() }}</strong> report logs.</span>
						@endif
					</x-table.cell>
				</x-table.row>
				@endif

				@forelse($activities as $key => $activity)

			<tr
				wire:loading.class="opacity-50"
				wire:key="row-{{ $activity->id }}"
				tabindex="{{ $activity->id }}"
				class="odd:bg-white even:bg-slate-50 focus:outline-none h-16 text-xs md:text-sm leading-none text-gray-800 bg-white border-b border-t border-gray-100"
			>
			<td class="px-6">
				<x-input.checkbox wire:model="selected" value="{{ $activity->id }}" />
			</td>
				<td class="px-4">
				<p class="text-md font-medium leading-none text-gray-800">
					{{ $activity->log_name }}
				</p>
				</td>
				<td class="px-6">
				<p class="text-md font-medium leading-none text-gray-800">{{ $activity->description }}</p>
				</td>
				<td class="px-6">
					<p class="text-md font-medium leading-none text-gray-800">{{ $activity->dept_name }}</p>
				</td>
				<td class="px-6">
				<p class="text-md font-medium leading-none text-gray-800">{{ $activity->student_id }}</p>
				</td>
				<td class="px-6">
					<p class="text-md font-medium leading-none text-gray-800">{{ $activity->properties->first() }}</p>
					</td>
					<td class="px-6">
						<button wire:loading.attr="disabled" wire:loading.class="cursor-not-allowed" wire:click="delete({{ $activity->id }})" class="mr-8 cursor-pointer bg-red-500 shadow-sm rounded-md p-2 hover:bg-opacity-70 duration-150"><i class="fa-solid fa-trash text-white fa-sm md:fa-md lg:fa-lg"></i><span class="px-1 md:px-2 text-white text-semibold text-xs md:text-sm">Delete</span></button>
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
					<p class="text-md sm:text-lg py-8 font-medium leading-none text-gray-400">No report logs found...</p>
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

		{{-- Show Bulk Delete Modal --}}
		<form wire:submit.prevent="deleteSelected">

			<x-confirmation-modal wire:model.defer="showBulkDeleteModal">
			<x-slot name="title"><i class="fa-solid fa-triangle-exclamation fa-lg pr-4 text-red-500"></i>{{ $logTitle }}</x-slot>
		
			<x-slot name="content">
				<h1 class="text-md md:text-lg lg:text-xl xl:text-2xl font-semibold text-center mt-16">Are you sure you want to delete these report logs?</h1> 
				<p class="text-center mt-4 mb-16 text-sm lg:text-base">This action is irreversible.</p> 
			</x-slot>
			
				<x-slot name="footer">
					<x-secondary-button wire:loading.attr="disabled" wire:loading.class="cursor-not-allowed" wire:click="$set('showBulkDeleteModal', false)" class="mx-2">Close</x-secondary-button>
					<x-delete-button wire:loading.attr="disabled" wire:loading.class="cursor-not-allowed" class="mx-2 bg-red-500">Delete</x-delete-button>
				</x-slot>
				</x-confirmation-modal>
			</form>

				{{-- Show Bulk Export Modal --}}

			<x-dialog-modal wire:model.defer="showBulkViewModal">
				<x-slot name="title"><i class="fa-solid fa-circle-info fa-lg pr-4 text-gray-500"></i>{{ $logTitle }}</x-slot>
			
				<x-slot name="content">
					<!--Body-->
			
						<div class="grid grid-cols-1 md:grid-cols-3 py-2">
	
						<!-- First Col -->
						<div class="px-4 mx-auto">
							<x-delete-button wire:click="exportToCsv" wire:loading.attr="disabled" wire:loading.class="cursor-not-allowed" class="mx-2 bg-blue-500">Export as CSV</x-delete-button>
						</div>
			
						<!-- First Col -->
						<div class="px-4 mx-auto">
							<x-delete-button wire:click="exportToXls" wire:loading.attr="disabled" wire:loading.class="cursor-not-allowed" class="mx-2 bg-green-500">Export as XLSX</x-delete-button>
						</div>
	
						<!-- Second COl -->
						<div class="px-4 mx-auto">
							<x-delete-button wire:click="exportToPdf" wire:loading.attr="disabled" wire:loading.class="cursor-not-allowed" class="mx-2 bg-yellow-500">Export as PDF</x-delete-button>
						</div>
					</div>
				</x-slot>
				
					<x-slot name="footer">
						<x-secondary-button wire:loading.attr="disabled" wire:loading.class="cursor-not-allowed" wire:click="$set('showBulkViewModal', false)" class="mx-2">Close</x-secondary-button>
					</x-slot>
			</x-dialog-modal>	

		{{-- Show View Modal --}}

			<x-dialog-modal wire:model.defer="showViewModal">
			<x-slot name="title"><i class="fa-solid fa-magnifying-glass fa-md pr-4 text-gray-500"></i>{{ $logTitle }}</x-slot>
		
			<x-slot name="content">
				<div class="overflow-x-auto sm:rounded-lg space-y-8">
				<!--Body-->
				<table class="min-w-full border-separate whitespace-nowrap divide-y divide-gray-200 border-b-2 shadow">
					<thead class="bg-gray-50">
					<tr
						tabindex="0"
						class="focus:outline-none h-16 w-full text-xs md:text-sm leading-none text-gray-800"
					>
					<th class="font-semibold text-left px-6 text-gray-700 uppercase tracking-normal"># 
						</th>
						<th class="font-semibold text-left px-6 text-gray-700 uppercase tracking-normal">Top Search
						</th>
						<th class="font-semibold text-left px-6 text-gray-700 uppercase tracking-normal">Total Searches
						</th>
						<th class="font-semibold text-left px-6 text-gray-700 uppercase tracking-normal">Availability
						</th>
					</tr>
					</thead>
					<tbody class="w-full" id="main-table-body">
						@forelse($searches as $key => $search)
			
					<tr
						wire:loading.class="opacity-50"
						tabindex="{{ $search->id }}"
						class="odd:bg-white even:bg-slate-50 focus:outline-none h-16 text-xs md:text-sm leading-none text-gray-800 bg-white border-b border-t border-gray-100"
					>
					<td class="px-6">
						<div class="flex items-center">
						<div>
							<p class="text-md font-medium leading-none text-gray-800">{{ $key + 1 }}</p>
						</div>
						</div>
					</td>
						<td class="px-6">
						<p class="text-md font-medium leading-none text-gray-800">{{ $sortedArrKeys[$key] }}</p>
						</td>
						<td class="px-6">
							<p class="text-md font-medium leading-none text-gray-800">{{ $sortedArr[$sortedArrKeys[$key]] }} {{$sortedArr[$sortedArrKeys[$key]] == 1 ? ' search.' : ' searches.'}}</p>
						</td>
						<td class="px-6">
							@if($topicsAvailability->contains($sortedArrKeys[$key]))
							<span class="px-2 mr-6 lg:mr-0 inline-flex text-xs leading-5 font-semibold rounded-full bg-gradient-to-r from-green-300 to-green-400 text-green-800">
								Available
							</span>
							@else
							<span class="px-2 mr-6 lg:mr-0 inline-flex text-xs leading-5 font-semibold rounded-full bg-gradient-to-r from-red-300 to-red-400 text-red-800">
								Not Available
							</span>
							@endif
						</td>
					</tr>
			
					@empty
					<tr
					wire:loading.class="opacity-50"
					class="odd:bg-white even:bg-slate-50 focus:outline-none h-26 text-sm leading-none text-gray-800 bg-white border-b border-t border-gray-100"
					>
					<td colspan="7" class="px-4">
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
				</div>
			</x-slot>
			
				<x-slot name="footer">
					<x-secondary-button wire:loading.attr="disabled" wire:loading.class="cursor-not-allowed" wire:click="$set('showViewModal', false)" class="mx-2">Close</x-secondary-button>
				</x-slot>
				</x-dialog-modal>	
		

		{{-- Show Delete Modal --}}
		<form wire:submit.prevent="deleteLog">

			<x-confirmation-modal wire:model.defer="showDeleteModal">
			<x-slot name="title"><i class="fa-solid fa-triangle-exclamation fa-lg pr-4 text-red-500"></i>{{ $logTitle }}</x-slot>
		
			<x-slot name="content">
				<h1 class="text-md md:text-lg lg:text-xl xl:text-2xl font-semibold text-center mt-16">Are you sure you want to delete this report log?</h1> 
				<p class="text-center mt-4 mb-16 text-sm lg:text-base">This action is irreversible.</p> 
			</x-slot>
			
				<x-slot name="footer">
					<x-secondary-button wire:loading.attr="disabled" wire:loading.class="cursor-not-allowed" wire:click="$set('showDeleteModal', false)" class="mx-2">Close</x-secondary-button>
					<x-delete-button wire:loading.attr="disabled" wire:loading.class="cursor-not-allowed" class="mx-2 bg-red-500">Delete</x-delete-button>
				</x-slot>
				</x-confirmation-modal>
			</form>		
		</div>
		@include('admin.body.footer')
	</div>


