@extends('master')
@section('user')

<div class="rounded-lg max-w-md sm:max-w-xl md:max-w-2xl lg:max-w-4xl xl:max-w-7xl mx-auto my-8 relative">
  <form action="{{ url('department', strtolower($currentPage)) }}" method="get">   
    <label for="search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
    <div class="flex justify-between">
      <div>
        <h1 class="inline-block text-2xl md:text-3xl xl:text-4xl font-bold mb-8">My Archives </h1> 
      </div>
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
                  <div x-data="{ 
                    open: false,
                    toggle() {
                        this.open = this.open ? this.close() : true
                    },
                    close() {
                        this.open = false
                    }
                }" class="overflow-hidden md:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-300">
                      <thead class="bg-slate-100">
                        <tr>
                          <th
                            scope="col"
                            class="p-4 tracking-widest text-sm font-medium text-slate-800"
                          >
                            Archive Code
                          </th>
                          <th
                            scope="col"
                            class="tracking-widest p-4 text-sm font-medium text-slate-800"
                          >
                            Project Title
                          </th>
                          <th
                            scope="col"
                            class="tracking-widest p-4 text-sm font-medium text-slate-800"
                          >
                            Department
                          </th>
                          <th
                            scope="col"
                            class="tracking-widest p-4 text-sm font-medium text-slate-800"
                          >
                            Curriculum
                          </th>
                          <th
                            scope="col"
                            class="tracking-widest p-4 text-sm font-medium text-slate-800"
                          >
                            Status
                          </th>
                          <th
                            scope="col"
                            class="tracking-widest p-4 text-sm font-medium text-slate-800"
                          >
                            Action
                          </th>
                        </tr>
                      </thead>
                      <tbody class="divide-y divide-gray-200 bg-white" id="main-table-body">
                        @forelse($archiveData as $archive)
                        <tr>
                          <td
                            class="whitespace-nowrap px-3 py-12 text-center text-sm font-medium tracking-wider text-slate-800"
                          >
                            {{ $archive->archive_code }}
                          </td>

                          <td
                            class="whitespace-nowrap p-3 text-center text-sm font-medium tracking-wider text-slate-800"
                          >
                            {{ \Illuminate\Support\Str::limit($archive->title, 60, '...') }}
                          </td>

                          @php 
                            $curriculumInfo = App\Models\Curriculum::find($archive->curriculum_id);
                            $departmentInfo = App\Models\Department::find($archive->department_id);
                          @endphp

                          <td
                            class="whitespace-nowrap p-3 text-center text-sm font-medium tracking-wider text-slate-800"
                          >
                            {{ $departmentInfo->dept_name }}
                          </td>

                          <td
                            class="whitespace-nowrap p-3 text-center text-sm font-medium tracking-wider text-slate-800"
                          >
                            {{ $curriculumInfo->curr_name }}
                          </td>

                          <td
                            class="whitespace-nowrap p-3 text-center text-sm font-medium tracking-wider text-slate-800"
                          >
                          @if($archive->archive_status == 1)
                          <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gradient-to-r from-green-300 to-green-400 text-green-800">
                            Published
                           </span>
                          @elseif ($archive->archive_status == 2)
                          <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gradient-to-r from-red-300 to-red-400 text-red-800">
                          Unpublished
                          </span>
                          @else
                          <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gradient-to-r from-gray-300 to-gray-400 text-gray-800">
                          Pending
                          </span>
                          @endif
                          </td>
                          <td
                            class="whitespace-nowrap p-3 text-center text-sm font-medium tracking-wider text-slate-800"
                          >
                            <a href="{{ route('view.archives', $archive->archive_code) }}" class="mr-2"> <i class="fa-solid fa-eye text-slate-900 hover:text-opacity-80 duration-150 fa-xl"></i> </a>
                            <a href="{{ route('view.archives', $archive->archive_code) }}" class="mx-2"> <i class="fa-solid text-red-500 hover:text-opacity-80 duration-150 fa-trash fa-xl"></i> </a>  
                          </td>
                        </tr>
                        @empty
                        <tr class="odd:bg-white even:bg-slate-50 focus:outline-none h-26 text-sm leading-none text-gray-800 bg-white border-b border-t border-gray-100"
                            >
                            <td colspan="6">
                                <div class="flex items-center justify-center">
                                <div>
                                    <p class="text-lg sm:text-xl py-8 font-medium leading-none text-gray-400">No archives found...</p>
                                </div>
                                </div>
                            </td>
                            </tr>
                        @endforelse
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      {{-- <div
      class="flex flex-col xs:flex-row xs:justify-between px-32 pb-8"
      >	
      {{ $archiveData->links() }}
      </div> --}}
@endsection