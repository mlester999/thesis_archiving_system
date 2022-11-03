@extends('admin.admin-master')
@section('admin')
 
 <!-- Content -->
 <div class="h-screen w-full overflow-y-auto">
    <div class="px-8 py-4">
        <h5 class="pb-6 pt-3 font-bold uppercase text-2xl leading-7">Dashboard</h5>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-8">

            {{-- First Container --}}
            <div class="p-6 bg-white rounded-lg flex items-center h-32 shadow-md">
                <div class="w-3/5 flex justify-start">

                    <ul>
                        <li class="font-bold text-gray-400">Department List</li>
                        <li class="font-extrabold text-slate-800 text-xl">{{ App\Models\Department::count() }}</li>
                    </ul>

                </div>

                <div class="w-2/5 flex justify-end">
                    <x-ri-file-list-3-fill class="bg-blue-400 rounded-lg p-2 w-12" />
                </div>
            </div>

            {{-- Second Container --}}
            <div class="p-6 bg-white rounded-lg flex items-center h-32 shadow-md">
                <div class="w-3/5 flex justify-start">

                    <ul>
                        <li class="font-bold text-gray-400">Curriculum List</li>
                        <li class="font-extrabold text-slate-800 text-xl">{{ App\Models\Curriculum::count() }}</li>
                    </ul>

                </div>

                <div class="w-2/5 flex justify-end">
                    <x-ri-list-check-2 class="bg-blue-400 rounded-lg p-2 w-12" />
                </div>
            </div>

            {{-- Third Container --}}
            <div class="p-6 bg-white rounded-lg flex items-center h-32 shadow-md">
                <div class="w-3/5 flex justify-start">

                    <ul>
                        <li class="font-bold text-gray-400">Verified Students</li>
                        <li class="font-extrabold text-slate-800 text-xl">{{ App\Models\User::where('status', 1)->count() }}</li>
                    </ul>

                </div>

                <div class="w-2/5 flex justify-end">
                    <x-ri-user-follow-fill class="bg-green-400 rounded-lg p-2 w-12" />
                </div>
            </div>

            {{-- Fourth Container --}}
            <div class="p-6 bg-white rounded-lg flex items-center h-32 shadow-md">
                <div class="w-3/5 flex justify-start">

                    <ul>
                        <li class="font-bold text-gray-400">Not Verified Students</li>
                        <li class="font-extrabold text-slate-800 text-xl">{{ App\Models\User::where('status', 0)->count() }}</li>
                    </ul>

                </div>

                <div class="w-2/5 flex justify-end">
                    <x-ri-user-unfollow-fill class="bg-red-400 rounded-lg p-2 w-12" />
                </div>
            </div>

            {{-- Fifth Container --}}
            <div class="p-6 bg-white rounded-lg flex items-center h-32 shadow-md">
                <div class="w-3/5 flex justify-start">

                    <ul>
                        <li class="font-bold text-gray-400">Approved Archives</li>
                        <li class="font-extrabold text-slate-800 text-xl">{{ App\Models\Archive::where('archive_status', 1)->count() }}</li>
                    </ul>

                </div>

                <div class="w-2/5 flex justify-end">
                    <x-ri-inbox-archive-fill class="bg-green-400 rounded-lg p-2 w-12" />
                </div>
            </div>

            {{-- Sixth Container --}}
            <div class="p-6 bg-white rounded-lg flex items-center h-32 shadow-md">
                <div class="w-3/5 flex justify-start">

                    <ul>
                        <li class="font-bold text-gray-400">Pending Archives</li>
                        <li class="font-extrabold text-slate-800 text-xl">{{ App\Models\Archive::where('archive_status', 0)->count() }}</li>
                    </ul>

                </div>

                <div class="w-2/5 flex justify-end">
                    <x-ri-inbox-unarchive-fill class="bg-yellow-400 rounded-lg p-2 w-12" />
                </div>
            </div>

            <div class="rounded-lg shadow-md bg-white md:col-span-2 lg:col-span-3">
                <div class="overflow-x-auto relative sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                            <h5 class="p-4 font-bold text-gray-400">Latest Thesis File Uploaded</h5>
                            <tr>
                                <th class="py-3 pl-6">Uploader's Name</th>
                                <th class="py-3">Title Name</th>
                                <th class="py-3">Department</th>
                                <th class="py-3">Curriculum</th>
                                <th class="py-3">Status</th>
                                <th class="py-3">Upload Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($uploadedArchive as $archive)
                            <tr class="bg-white border-b">
                                @php
                                    $archiveUser = App\Models\User::find($archive->user_id);
                                    $archiveDept = App\Models\Department::find($archive->department_id);
                                    $archiveCurr = App\Models\Curriculum::find($archive->curriculum_id);
                                @endphp
                                <th scope="row" class="py-4 pl-6 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $archiveUser->last_name . ", " . $archiveUser->first_name }}
                                </th>
                                <td class="py-4">
                                    {{ \Illuminate\Support\Str::limit($archive->title, 60, '...') }}
                                </td>
                                <td class="py-4">
                                    {{ $archiveDept->dept_name }}
                                </td>
                                <td class="py-4">
                                    {{ $archiveCurr->curr_name }}
                                </td>
                                <td class="py-4">
                                    @if($archive->archive_status == 1)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-300 text-green-800">
                                        Published
                                    </span>
                                    @elseif($archive->archive_status == 2)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-300 text-red-800">
                                        Unpublished
                                    </span>
                                    @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-300 text-gray-800">
                                        Publishing...
                                    </span>
                                    @endif
                                </td>
                                <td class="py-4">
                                    14/10/2022
                                </td>
                            </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @include('admin.body.footer')
    </div>
</div>

@endsection