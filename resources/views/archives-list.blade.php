@extends('master')
@section('user')

<div class="overflow-hidden bg-white shadow-xl sm:rounded-lg max-w-7xl mx-auto mt-8 relative">
    <div class="px-4 py-5 sm:px-6">
      <h3 class="text-2xl font-bold leading-6 text-gray-900 inline-block">My Archives Projects</h3>
        <div x-data="{ 
            open: false,
            toggle() {
                this.open = this.open ? this.close() : true
            },
            close() {
                this.open = false
            }
        }" class="pt-4 pb-10">
            <table class="min-w-full whitespace-nowrap divide-y divide-gray-200 border-b-2 shadow">
                <thead class="bg-gray-50">
                  <tr
                    tabindex="0"
                    class="focus:outline-none h-16 w-full text-sm leading-none text-gray-800"
                  >
                    <th class="font-semibold text-left pl-8 text-gray-700 uppercase tracking-normal"># 
                    </th>
                    <th class="font-semibold text-left pl-12 text-gray-700 uppercase tracking-normal">Archive Code
                    </th>
                    <th class="font-semibold text-left pl-12 text-gray-700 uppercase tracking-normal">Topic
                    </th>
                    <th class="font-semibold text-left pl-12 text-gray-700 uppercase tracking-normal">Department 
                    </th>
                    <th class="font-semibold text-left pl-12 text-gray-700 uppercase tracking-normal">Curriculum
                    </th>
                    <th class="font-semibold text-left pl-12 text-gray-700 uppercase tracking-normal">Status </th>
                    <th class="font-semibold text-left pl-12 text-gray-700 uppercase tracking-normal">Action</th>
                  </tr>
                </thead>
                <tbody class="w-full" id="main-table-body">
                    @forelse($archiveData as $key => $user)
                  <tr
                    tabindex="{{ $user->id }}"
                    class="odd:bg-white even:bg-slate-50 focus:outline-none h-20 text-sm leading-none text-gray-800 bg-white border-b border-t border-gray-100"
                  >
                    <td class="pl-8 cursor-pointer">
                      <div class="flex items-center">
                        <div>
                          <p class="text-md font-medium leading-none text-gray-800">{{ $user->id }}</p>
                        </div>
                      </div>
                    </td>
                    <td class="pl-12">
                      <p class="text-md font-medium leading-none text-gray-800">
                        {{ $user->archive_code }}
                      </p>
                    </td>
                    <td class="pl-12">
                      <p class="text-md font-medium leading-none text-gray-800">{{ \Illuminate\Support\Str::limit($user->title, 30, '...') }}</p>
                    </td>

                    @php 
                        $departmentInfo = App\Models\Department::find($user->department_id);
                    @endphp

                    <td class="pl-12">
                      <p class="text-md font-medium leading-none text-gray-800">{{ $departmentInfo->dept_name }}</p>
                    </td>

                    @php 
                        $curriculumInfo = App\Models\Curriculum::find($user->curriculum_id);
                    @endphp

                    <td class="pl-12">
                        <p class="text-md font-medium leading-none text-gray-800">{{ $curriculumInfo->curr_name }}</p>
                      </td>
                      <td class="pl-12">
                        @if($user->status)
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-300 text-green-800">
                            Published
                        </span>
                        @else
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-300 text-red-800">
                            Unpublished
                        </span>
                        @endif
                      </td>
                    <td class="pl-12">
                      <a href="{{ route('view.archives', $user->id) }}" class="mr-2"> <i class="fa-solid fa-eye fa-xl"></i> </a>
                      <a href="{{ route('view.archives', $user->id) }}" class="mx-2"> <i class="fa-solid text-red-500 fa-trash fa-xl"></i> </a>  
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
                        <p class="text-xl py-8 font-medium leading-none text-gray-400">No archives found...</p>
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

@endsection