@extends('master')
@section('user')

  @php
      $showEmptyMessage = 0;
  @endphp

<div class="bg-white shadow-xl sm:rounded-lg max-w-7xl mx-auto my-8 relative">
    <div class="border-t border-gray-200">
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
                            class="p-4 text-left text-lg font-medium text-slate-800"
                          >
                            Projects
                          </th>
                          <th
                            scope="col"
                            class="hidden md:table-cell p-4 text-lg font-medium text-slate-800"
                          >
                            Department
                          </th>
                          <th
                            scope="col"
                            class="hidden md:table-cell p-4 text-lg font-medium text-slate-800"
                          >
                            Curriculum
                          </th>
                          <th
                            scope="col"
                            class="hidden md:table-cell p-4 text-lg font-medium text-slate-800"
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
                        <tr>
                          <td
                            class="whitespace-normal md:whitespace-nowrap py-4 lg:py-7 px-8 text-sm"
                          >
                          @php
                                $departmentData = App\Models\Department::find($archive->department_id);
                          @endphp
                            <div class="flex items-center">
                              <div>
                                <a href="{{ route('view.department', [strtolower($departmentData->dept_name),  $archive->archive_code]) }}"
                                  class="hover:text-opacity-70 duration-150 text-lg text-left font-semibold text-slate-800 mb-2 tracking-[-0.4px]"
                                >
                                  {{ \Illuminate\Support\Str::limit($archive->title, 60, '...') }}
                                </a>
                                <div
                                  class="flex flex-wrap flex-col md:flex-row gap-2 md:gap-4"
                                >
                                  <div class="flex items-center gap-4">


                                    @php 
                                        $userInfo = App\Models\User::find($archive->user_id);
                                    @endphp

                                    <div
                                      class="text-sm text-slate-800 tracking-[-0.4px]"
                                    >
                                      By: {{ $userInfo->first_name . " " . $userInfo->last_name }}
                                    </div>
                                    <div
                                      class="text-sm text-slate-500 tracking-[-0.4px]"
                                    >
                                      {{ $archive->year }}
                                    </div>
                                  </div>
                                  <div
                                    class="flex flex-wrap items-center gap-2 md:gap-4 text-gray-500 ml-10 md:ml-0"
                                  >
                                    <button type="button">
                                      <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-200 text-black tracking-[-0.4px]"
                                        >General</span
                                      >
                                    </button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </td>

                          @php 
                            $departmentInfo = App\Models\Department::find($archive->department_id);
                          @endphp

                          <td
                            class="hidden md:table-cell whitespace-nowrap p-3 text-center text-sm font-medium tracking-[-0.4px] text-slate-800"
                          >
                            {{ $departmentInfo->dept_name }}
                          </td>

                          @php 
                            $curriculumInfo = App\Models\Curriculum::find($archive->curriculum_id);
                          @endphp

                          <td
                            class="hidden md:table-cell whitespace-nowrap p-3 text-center text-sm font-medium tracking-[-0.4px] text-slate-800"
                          >
                            {{ $curriculumInfo->curr_name }}
                          </td>

                          <td
                            class="hidden md:table-cell whitespace-nowrap p-3 text-center text-sm font-medium tracking-[-0.4px] text-slate-800"
                          >
                            {{ $archive->created_at->format('M d, Y') }}
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
                                    <p class="text-xl py-8 font-medium leading-none text-gray-400">No projects found...</p>
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
      {{ $archiveData->links() }}
      </div>
@endsection