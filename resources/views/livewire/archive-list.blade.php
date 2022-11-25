<div class="w-full px-6 pb-6 h-screen overflow-y-auto">
	<div
	  class="py-4 lg:py-7 lg:px-2"
	>
	<div class="flex-1 min-w-0 py-2">
	  <h2
		class="font-bold leading-7 text-gray-900 text-2xl lg:truncate uppercase"
	  >
		Archive List
	  </h2>
	</div>
	  <div class="lg:flex lg:items-center lg:justify-end">
		<div class="mt-4 flex justify-end lg:mt-0 lg:ml-4 z-0">
			<div class="flex flex-col items-end lg:flex-row space-y-4 space-x-4 lg:space-y-0">
				<div class="flex flex-row">
				<select name="show_results" wire:model="showResults" id="show_results" name="show_results" class="inline-flex items-center border border-gray-300 text-gray-900 rounded-md focus:ring-1 focus:ring-green-500 focus:border-green-500 placeholder:font-sans placeholder:font-light focus:outline-none text-xs md:text-sm">
				<option value="5" selected>Show 5 Results</option>
				<option value="25">Show 25 Results</option>
				<option value="50">Show 50 Results</option>
				</select>
			<label class="relative block ml-3">
				<span class="sr-only">Search</span>
				<span class="absolute inset-y-0 left-0 flex items-center pl-2">
					<i class="fa-solid fa-magnifying-glass ml-1"></i>
				</span>
				<input wire:model="search" class="placeholder:italic placeholder:text-slate-700 block bg-white w-full border border-slate-300 rounded-md py-2 pl-9 pr-3 shadow-sm focus:outline-none focus:border-green-500 focus:ring-green-500 focus:ring-1 text-xs md:text-sm" placeholder="Search for anything..." type="text" name="search"/>
			  </label>
			</div>
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
			<th class="font-semibold text-left pl-8 text-gray-700 uppercase tracking-normal">Archive Code
				<span wire:click="sortBy('archive_code')" class="cursor-pointer ml-2">
					<i class="fa-solid fa-arrow-{{ $sortField === 'archive_code' && $sortDirection === 'asc' ? 'up' : 'down' }} fa-xs"></i>	
				</span>
			</th>
			<th class="font-semibold text-left pl-6 text-gray-700 uppercase tracking-normal">Project Title
				<span wire:click="sortBy('title')" class="cursor-pointer ml-2">
					<i class="fa-solid fa-arrow-{{ $sortField === 'title' && $sortDirection === 'asc' ? 'up' : 'down' }} fa-xs"></i>
				</span>
			</th>
			<th class="font-semibold text-left pl-6 text-gray-700 uppercase tracking-normal">Department
				<span wire:click="sortBy('dept_name')" class="cursor-pointer ml-2">
					<i class="fa-solid fa-arrow-{{ $sortField === 'dept_name' && $sortDirection === 'asc' ? 'up' : 'down' }} fa-xs"></i>
				</span>
			</th>
			<th class="font-semibold text-left pl-6 text-gray-700 uppercase tracking-normal">Curriculum
				<span wire:click="sortBy('curr_name')" class="cursor-pointer ml-2">
					<i class="fa-solid fa-arrow-{{ $sortField === 'curr_name' && $sortDirection === 'asc' ? 'up' : 'down' }} fa-xs"></i>
				</span>
			</th>
			<th class="font-semibold text-left pl-6 text-gray-700 uppercase tracking-normal">Year
				<span wire:click="sortBy('year')" class="cursor-pointer ml-2">
					<i class="fa-solid fa-arrow-{{ $sortField === 'year' && $sortDirection === 'asc' ? 'up' : 'down' }} fa-xs"></i>
				</span>
			</th>
			<th class="font-semibold text-left pl-6 text-gray-700 uppercase tracking-normal">Status
				<span wire:click="sortBy('archive_status')" class="cursor-pointer ml-2">
					<i class="fa-solid fa-arrow-{{ $sortField === 'archive_status' && $sortDirection === 'asc' ? 'up' : 'down' }} fa-xs"></i>
				</span>
			</th>
			<th class="font-semibold text-left pl-6 pr-8 md:pr-4 text-gray-700 uppercase tracking-normal">Action</th>
		  </tr>
		</thead>
		<tbody class="w-full" id="main-table-body">
			@forelse($archives as $key => $archive)
		  <tr
		  	wire:loading.class="opacity-50"
			tabindex="{{ $archive->id }}"
			class="odd:bg-white even:bg-slate-50 focus:outline-none h-16 text-xs md:text-sm leading-none text-gray-800 bg-white border-b border-t border-gray-100"
		  >
			<td class="pl-8">
			  <div class="flex items-center">
				<div>
				  <p class="text-md font-medium leading-none text-gray-800">{{ $archive->id }}</p>
				</div>
			  </div>
			</td>
			<td class="pl-8">
			  <p class="text-md font-medium leading-none text-gray-800">{{ $archive->archive_code }}</p>
			</td>
			<td class="pl-6">
			  <p class="text-md font-medium leading-none text-gray-800">{{ \Illuminate\Support\Str::limit($archive->title, 20, '...') }}</p>
			</td>
			<td class="pl-6">
			<p class="text-md font-medium leading-none text-gray-800">{{ $archive->dept_name ?? 'Department Not Found' }}</p>
			</td>
			<td class="pl-6">
			<p class="text-md font-medium leading-none text-gray-800">{{ $archive->curr_name ?? 'Curriculum Not Found' }}</p>
			</td>
			<td class="pl-6">
			<p class="text-md font-medium leading-none text-gray-800">{{ $archive->year }}</p>
			</td>
			  <td class="pl-6">
				@if($archive->archive_status == 1)
				<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gradient-to-r from-green-300 to-green-400 text-green-800">
                    Published
                </span>
				@elseif($archive->archive_status == 2)
				<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gradient-to-r from-red-300 to-red-400 text-red-800">
                    Unpublished
                </span>
				@else
				<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gradient-to-r from-gray-300 to-gray-400 text-gray-800">
                    Pending
                </span>
				@endif
			  </td>
			<td class="pl-6">
				<a wire:loading.attr="disabled" wire:loading.class="cursor-not-allowed" href="{{ route('admin.view.archive-list', $archive->archive_code) }}" class="mx-auto"> <i class="hover:text-opacity-70 duration-150 text-slate-900 fa-solid fa-eye fa-xl"></i> </a>
				@if($archive->archive_status == 0)
					<button wire:loading.attr="disabled" wire:loading.class="cursor-not-allowed" wire:click="edit({{ $archive->id }})" class="ml-2 mr-8"> <i class="hover:text-opacity-70 duration-150 text-slate-900 fa-solid fa-pen-to-square fa-xl"></i> </button>
				@endif
			</td>
		  </tr>
		  @empty
		  <tr
		  wire:loading.class="opacity-50"
		  class="odd:bg-white even:bg-slate-50 focus:outline-none h-26 text-sm leading-none text-gray-800 bg-white border-b border-t border-gray-100"
		>
		  <td colspan="9" class="pl-8">
			<div class="flex items-center justify-center">
			  <div>
				<p class="text-xl py-8 font-medium leading-none text-gray-400">No archives found...</p>
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
		{{ $archives->links() }}
	  </div>
			
	  {{-- Show Edit Modal --}}
	  <form wire:submit.prevent="save">

		<x-dialog-modal wire:model.defer="showPublishModal">
		  <x-slot name="title"><i class="fa-solid fa-upload fa-md pr-4 text-gray-500"></i>{{ $archiveTitle }}</x-slot>
	  
		  <x-slot name="content">
			  <!--Body-->
  
				  <!-- Status -->
				  <div class="py-3">
				  <x-input-label for="archive_status" :value="__('Status')" />
				  <select wire:model.defer="publishing.archive_status" id="archive_status" name="archive_status" class="border mt-1 border-gray-300 p-2 text-gray-900 text-sm rounded-md focus:ring-1 focus:ring-green-500 focus:border-green-500 placeholder:font-sans placeholder:font-light focus:outline-none block w-full">
				  <option value="" hidden>~ Select the Status ~</option>
				  <option value="1" selected>Published</option> 
				  <option value="2">Unpublished</option>
				  </select>
	  
				  <x-input-error :messages="$errors->get('publishing.archive_status')" />
			  	  </div>

				<!-- Comments -->
				<div class="py-3">
					<x-input-label for="admin_comment" :value="__('Comments (Optional)')" />
	
					<textarea wire:model.defer="publishing.admin_comment" id="admin_comment" class="block mt-1 w-full p-2 border border-gray-300 rounded-md placeholder:font-sans placeholder:font-light focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none" type="text" name="admin_comment" placeholder="Leave empty if no comments..."> </textarea>
	
					<x-input-error :messages="$errors->get('publishing.admin_comment')" />
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


