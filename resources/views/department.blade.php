@extends('master')
@section('user')

  @php
      $showEmptyMessage = 0;
  @endphp

<div class="rounded-lg max-w-md sm:max-w-xl md:max-w-2xl lg:max-w-4xl xl:max-w-7xl mx-auto my-8 relative">
  <label for="search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
  <div class="flex justify-between">
    <div>
      <h1 class="inline-block text-2xl md:text-3xl font-bold mb-4">{{ strtoupper($currentPage) }} Projects / Thesis / Capstone </h1> 
      @if(count($searches) >= 5)
        @livewire('suggest-topics')
      @endif
    </div>
    <form action="{{ url('department', strtolower($currentPage)) }}" method="get">   
    <div class="relative mb-8 max-w-xl ml-auto">
        @livewire('title-search-bar', ['currentPage' => $currentPage])
      </div>
    </div>
</form>
    <div class="border-t border-gray-200 shadow-xl rounded-lg">
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
                        @foreach($archives as $archive)

                        @if($archive->archive_status == 1)
                          @php
                              $showEmptyMessage = 1;
                          @endphp
                        <tr>
                          <td
                            class="whitespace-nowrap p-3 text-center text-lg font-medium tracking-wider text-slate-800"
                          >
                            <div class="flex items-center">
                              <div>
                                <a href="{{ route('view.department', [strtolower($archive->department->dept_name),  $archive->archive_code]) }}"
                                  class="hover:text-opacity-70 duration-150 text-sm md:text-md lg:text-lg text-left font-semibold text-blue-500 mb-2 tracking-normal"
                                >
                                  {{ \Illuminate\Support\Str::limit($archive->title, 60, '...') }}
                                </a>
                                <div
                                  class="flex flex-wrap md:flex-row md:gap-4"
                                >
                                  <div class="flex items-center gap-4">
                                    <div
                                      class="text-sm text-slate-800 tracking-[-0.4px]"
                                    >
                                      By: {{ $archive->user->first_name . " " . $archive->user->last_name }}
                                    </div>
                                    <div
                                      class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gradient-to-r from-gray-300 to-gray-400 text-gray-800 tracking-[-0.4px]"
                                    >
                                      {{ $archive->year }}
                                    </div>
                                    <div
                                      class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gradient-to-r from-green-300 to-green-400 text-green-800 tracking-[-0.4px]"
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
                            class="whitespace-nowrap p-3 text-center text-sm font-medium tracking-wider text-slate-800"
                          >
                            {{ $archive->department->dept_name }}
                          </td>

                          <td
                            class="whitespace-nowrap p-3 text-center text-sm font-medium tracking-wider text-slate-800"
                          >
                            {{ $archive->curriculum->curr_name }}
                          </td>

                          <td
                            class="whitespace-nowrap p-3 text-center text-sm font-medium tracking-wider text-slate-800"
                          >
                            {{ $archive->created_at->format('m/d/Y') }}
                          </td>
                        </tr>
                        @endif
                        
                        @endforeach

                        @if($showEmptyMessage == 0)
                        <tr class="odd:bg-white even:bg-slate-50 focus:outline-none h-26 text-sm leading-none text-gray-800 bg-white border-b border-t border-gray-100"
                            >
                            <td colspan="4">
                                <div class="flex items-center justify-center">
                                <div>
                                    <p class="text-lg sm:text-xl py-8 font-medium leading-none text-gray-400">No projects found...</p>
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
      </div>
      <div
      class="flex flex-col xs:flex-row xs:justify-between px-32 pb-8"
      >	
      {{ $archives->links() }}
      </div>
@endsection