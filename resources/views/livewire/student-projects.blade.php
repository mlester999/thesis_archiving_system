@php
    $showEmptyMessage = 0;
@endphp

<div x-data="{show: false}" class="rounded-lg max-w-xl md:max-w-2xl lg:max-w-4xl xl:max-w-7xl mx-auto my-8 relative px-8 sm:px-4 md:px-2">
    <label for="search" class="text-sm font-medium text-gray-900 sr-only">Search</label>
    <div class="flex flex-col justify-between">
      <div class="flex flex-col">
        <h1 class="inline-block text-xl md:text-2xl lg:text-2xl mb-4 font-bold">List of Projects / Thesis / Capstone</h1> 

        {{-- Show View Modal --}}
        
        <x-dialog-modal wire:model.defer="showViewModal">
            <x-slot name="title"><i class="fa-solid fa-magnifying-glass fa-md pr-4 text-gray-500"></i>{{ $logTitle }}</x-slot>
        
            <x-slot name="content">
              <div class="overflow-x-auto sm:rounded-lg space-y-8">
                <!--Body-->
                <table class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-slate-100">
                      <tr>
                        <th
                          scope="col"
                          class="tracking-widest py-4 px-8 text-xs sm:text-sm font-medium text-slate-800"
                        >
                          #
                        </th>
                        <th
                          scope="col"
                          class="tracking-widest p-4 text-xs sm:text-sm font-medium text-slate-800"
                        >
                          Topics
                        </th>
                        <th
                          scope="col"
                          class="tracking-widest p-4 text-xs sm:text-sm font-medium text-slate-800"
                        >
                          Searches
                        </th>
                      </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                      @forelse($topicsAvailability as $key => $search)
          
                    <tr
                        wire:loading.class="opacity-50"
                        class="odd:bg-white even:bg-slate-50 focus:outline-none h-16 text-xs md:text-sm leading-none text-gray-800 bg-white border-b border-t border-gray-100"
                    >
                    <td class="whitespace-nowrap p-3 text-center text-xs sm:text-sm font-medium tracking-wider text-slate-800">
                        <p class="text-md font-medium leading-none text-gray-800">{{ $key + 1 }}</p>
                    </td>
                      <td class="whitespace-nowrap p-3 text-center text-xs sm:text-sm font-medium tracking-wider text-slate-800">
                        <p class="text-md font-medium leading-none text-gray-800">{{ $topicsAvailability[$key] }}</p>
                      </td>
                      <td class="whitespace-nowrap p-3 text-center text-xs sm:text-sm font-medium tracking-wider text-slate-800">
                          <p class="text-md font-medium leading-none text-gray-800">{{ $sortedArr[$topicsAvailability[$key]] }} {{$sortedArr[$topicsAvailability[$key]] == 1 ? ' search.' : ' searches.'}}</p>
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
                          <p class="text-md sm:text-lg py-8 font-medium leading-none text-gray-400">No top search found...</p>
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
                    <x-secondary-button wire:loading.attr="disabled" wire:loading.class="cursor-not-allowed" wire:click.prevent="$set('showViewModal', false)" class="mx-2">Cancel</x-secondary-button>
                </x-slot>
                </x-dialog-modal>	

      </div>

      <div class="relative max-w-xl ml-auto mb-4"> 
            <div x-cloak x-data="{ searchTab: true }" class="relative">
                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input 
                        type="text" 
                        x-cloak
                        x-on:click="searchTab = true"
                        x-on:click.outside="searchTab = false"
                        x-on:keydown="searchTab = true"
                        x-on:keydown.escape="searchTab = false"
                        x-on:keydown.tab="searchTab = false"
                        id="search" 
                        name="search" 
                        class="block py-2 sm:py-3 md:py-4 pl-10 pr-20 sm:pr-24 w-56 sm:w-72 md:w-96 lg:w-180 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-green-500 focus:border-green-500 placeholder:text-xs sm:placeholder:text-sm" placeholder="Search for Projects..."
                        wire:model="search"
                        autocomplete="off"
                    />
            
                        <button type="submit" class="text-white duration-200 absolute right-2.5 bottom-1.5 sm:bottom-2 md:bottom-2.5 bg-blue-600 hover:bg-opacity-80 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg px-2 sm:px-4 py-1 md:py-2 text-xs sm:text-sm">Search</button> 
                
                @if(!empty($search))
                    <div x-cloak x-show="searchTab" class="absolute z-50 bg-white w-full rounded-t-none shadow-lg">
                        @if(!empty($titles))
                                @foreach($titles as $i => $title)
                                    @php
                                        $departmentData = App\Models\Department::find($title['department_id']);
                                    @endphp
                                    <a href="{{ route('view.department', [strtolower($departmentData->dept_name),  $title['archive_code']]) }}" class="py-4 px-8 hover:bg-slate-200 hover:text-opacity-70 duration-150 text-sm text-left font-semibold text-blue-500 tracking-normal flex"> {{ $title['title'] }} </a>
                                @endforeach
                        @else
                        <div class="py-4 px-8 text-sm text-left font-semibold text-black tracking-normal flex">No Projects Found...</div>
                        @endif
                    </div>
                @endif  
            </div>
      </div>

      <div class="flex flex-row justify-between md:justify-start">
        <button wire:loading.attr="disabled" wire:loading.class="cursor-not-allowed" wire:click.prevent="viewSuggestedTopics()" class="text-slate-50 text-xs bg-blue-500 hover:bg-opacity-80 duration-150 rounded-full py-2 px-2 md:px-3 mb-3 md:ml-2 md:text-sm lg:text-md">Suggested Topics</button>
        <button x-on:click.prevent="show = !show" class="text-blue-500 hover:text-blue-400 duration-150 mb-3 ml-2 text-xs md:text-sm lg:text-md">
            <template x-if="show">
            <span>Hide </span>
            </template>
            <span>Advanced Search...</span>
        </button>
    </div>

    </div>

    <div x-cloak x-show="show" class="w-full max-h-xl p-4 mt-2 mb-4 rounded-lg bg-slate-200 shadow-sm ring-2 ring-gray-300">
        <div class="bg-gray px-4 py-8 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6">
            <div class="relative px-8 pt-8 sm:pt-0">
                <label for="year" class="text-sm font-semibold text-gray-600">Year:</label>
                <select wire:model.lazy="filters.year" wire:loading.attr="disabled" wire:loading.class="cursor-not-allowed" id="year" class="border-0 shadow-lg mt-2 mb-8 px-3 text-gray-900 rounded-md focus:ring-1 focus:ring-green-500 focus:border-green-500 placeholder:font-sans placeholder:font-light focus:outline-none block w-full">
                    <option value="0" hidden>~ Select Year ~</option>
                    @for ($year=date('Y'); $year >= 2000; $year--)
                    <option value="{{ $year }}"> {{ $year }} </option>
                    @endfor
                    </select>
            </div>
            <div class="relative px-8 pt-8 sm:pt-0">
                <label for="year" class="text-sm font-semibold text-gray-600">Research Agenda:</label>
                <select wire:model.lazy="filters.research_agenda" wire:loading.attr="disabled" wire:loading.class="cursor-not-allowed" id="research_agenda" class="border-0 shadow-lg mt-2 mb-8 px-3 text-gray-900 rounded-md focus:ring-1 focus:ring-green-500 focus:border-green-500 placeholder:font-sans placeholder:font-light focus:outline-none block w-full">
                    <option value="0" hidden>~ Select Research Agenda ~</option>
                    @foreach ($agendaData as $agenda)
                    <option value="{{ $agenda->agenda_name }}"> {{ $agenda->agenda_name }} </option>
                    @endforeach
                    </select>
            </div>
        </div>
        <button wire:click.prevent="resetFilters" class="ml-auto block font-medium hover:text-gray-600 duration-150">Reset Filters</button>
    </div>

      <div class="border-t border-gray -200 shadow-xl rounded-lg">
          <div class="mb-10">
              <div class="flex flex-col">
                <div class="overflow-x-auto">
                  <div class="inline-block min-w-full align-middle">
                    <div class="overflow-hidden md:rounded-lg">
                      <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-slate-100">
                          <tr>
                            <th
                              scope="col"
                              class="py-4 px-8 tracking-widest text-left text-xs sm:text-sm font-medium text-slate-800"
                            >
                              Projects
                            </th>
                            <th
                              scope="col"
                              class="tracking-widest p-4 text-xs sm:text-sm font-medium text-slate-800"
                            >
                              Department
                            </th>
                            <th
                              scope="col"
                              class="tracking-widest p-4 text-xs sm:text-sm font-medium text-slate-800"
                            >
                              Curriculum
                            </th>
                            <th
                              scope="col"
                              class="tracking-widest p-4 text-xs sm:text-sm font-medium text-slate-800"
                            >
                              Published at
                            </th>
                          </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                          @foreach($archiveData as $archive)
                    
                          @if($archive->archive_status == 1)
                            @php
                                $showEmptyMessage = 1;
                            @endphp
                          <tr wire:loading.class="opacity-50">
                            <td
                              class="whitespace-nowrap p-3 text-center text-lg font-medium tracking-wider text-slate-800"
                            >
                              <div class="flex items-center">
                                <div>
                                  <a href="{{ route('view.department', [strtolower($archive->department->dept_name),  $archive->archive_code]) }}"
                                    class="hover:text-opacity-70 duration-150 text-xs sm:text-sm md:text-md lg:text-lg text-left block font-semibold text-blue-500 mb-2 tracking-normal"
                                  >
                                    {{ \Illuminate\Support\Str::limit($archive->title, 60, '...') }}
                                  </a>
                                  <div
                                    class="flex flex-wrap md:flex-row md:gap-4"
                                  >
                                    <div class="flex items-center gap-3">
                                      <div
                                        class="text-xs sm:text-sm text-slate-800 tracking-[-0.4px]"
                                      >
                                        By: {{ $archive->user->first_name . " " . $archive->user->middle_name[0] . ". " . $archive->user->last_name }}
                                      </div>
                                      <div
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gradient-to-r from-gray-300 to-gray-400 text-gray-800 tracking-[-0.4px]"
                                      >
                                        {{ $archive->year }}
                                      </div>
                                      @php 
                                        $colors = ['from-rose-300 to-rose-400 text-rose-800', 'from-fuchsia-300 to-fuchsia-400 text-fuchsia-800', 'from-violet-300 to-violet-400 text-violet-800', 'from-blue-300 to-blue-400 text-blue-800', 'from-cyan-300 to-cyan-400 text-cyan-800', 'from-teal-300 to-teal-400 text-teal-800', 'from-emerald-300 to-emerald-400 text-emerald-800', 'from-green-300 to-green-400 text-green-800', 'from-lime-300 to-lime-400 text-lime-800', 'from-red-300 to-red-400 text-red-800', 'from-pink-300 to-pink-400 text-pink-800', 'from-purple-300 to-purple-400 text-purple-800', 'from-indigo-300 to-indigo-400 text-indigo-800', 'from-sky-300 to-sky-400 text-sky-800', 'from-yellow-300 to-yellow-400 text-yellow-800'];
                                      @endphp
                                      <div
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gradient-to-r {{ $colors[$archive->research_agenda->id] ? $colors[$archive->research_agenda->id]  : 'from-gray-300 to-gray-400 text-gray-800' }} tracking-[-0.4px]"
                                      >
                                        {{ $archive->research_agenda->agenda_name }}
                                      </div>  
                                    </div>
                                    <div
                                      class="flex flex-wrap items-center gap-2 md:gap-4 text-gray-500 ml-10 md:ml-0"
                                    >
                                      <button type="button">
                                        <span
                                          class="inline-flex items-center py-4 rounded-full text-xs font-medium text-black tracking-[-0.4px]"
                                          ></span
                                        >
                                      </button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </td>
                    
                            <td
                              class="whitespace-nowrap p-3 text-center text-xs sm:text-sm font-medium tracking-wider text-slate-800"
                            >
                              {{ $archive->department->dept_name }}
                            </td>
                    
                            <td
                              class="whitespace-nowrap p-3 text-center text-xs sm:text-sm font-medium tracking-wider text-slate-800"
                            >
                              {{ $archive->curriculum->curr_name }}
                            </td>
                    
                            <td
                              class="whitespace-nowrap p-3 text-center text-xs sm:text-sm font-medium tracking-wider text-slate-800"
                            >
                              {{ $archive->created_at->format('m/d/Y') }}
                            </td>
                          </tr>
                          @endif
                          
                          @endforeach
                    
                          @if($showEmptyMessage == 0)
                          <tr wire:loading.class="opacity-50" class="odd:bg-white even:bg-slate-50 focus:outline-none h-26 text-sm leading-none text-gray-800 bg-white border-b border-t border-gray-100"
                              >
                              <td colspan="4">
                                  <div class="flex items-center justify-center">
                                    <div>
                                        <p class="text-md sm:text-lg py-8 font-medium leading-none text-gray-400">No projects found...</p>
                                    </div>
                                  </div>
                              </td>
                              </tr>
                          @endif
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div
          class="flex flex-col xs:flex-row xs:justify-between pb-8"
          >	
          {{ $archiveData->links() }}
          </div>
        </div>