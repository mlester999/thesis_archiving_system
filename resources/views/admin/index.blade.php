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
                        <li class="font-extrabold text-slate-800 text-xl">12</li>
                    </ul>

                </div>

                <div class="w-2/5 flex justify-end">
                    <x-ri-file-list-3-fill class="bg-gray-300 rounded-lg p-2 w-12" />
                </div>
            </div>

            {{-- Second Container --}}
            <div class="p-6 bg-white rounded-lg flex items-center h-32 shadow-md">
                <div class="w-3/5 flex justify-start">

                    <ul>
                        <li class="font-bold text-gray-400">Curriculum List</li>
                        <li class="font-extrabold text-slate-800 text-xl">12</li>
                    </ul>

                </div>

                <div class="w-2/5 flex justify-end">
                    <x-ri-list-check-2 class="bg-gray-300 rounded-lg p-2 w-12" />
                </div>
            </div>

            {{-- Third Container --}}
            <div class="p-6 bg-white rounded-lg flex items-center h-32 shadow-md">
                <div class="w-3/5 flex justify-start">

                    <ul>
                        <li class="font-bold text-gray-400">Verified Students</li>
                        <li class="font-extrabold text-slate-800 text-xl">1698</li>
                    </ul>

                </div>

                <div class="w-2/5 flex justify-end">
                    <x-ri-user-follow-fill class="bg-gray-300 rounded-lg p-2 w-12" />
                </div>
            </div>

            {{-- Fourth Container --}}
            <div class="p-6 bg-white rounded-lg flex items-center h-32 shadow-md">
                <div class="w-3/5 flex justify-start">

                    <ul>
                        <li class="font-bold text-gray-400">Not Verified Students</li>
                        <li class="font-extrabold text-slate-800 text-xl">521</li>
                    </ul>

                </div>

                <div class="w-2/5 flex justify-end">
                    <x-ri-user-unfollow-fill class="bg-gray-300 rounded-lg p-2 w-12" />
                </div>
            </div>

            {{-- Fifth Container --}}
            <div class="p-6 bg-white rounded-lg flex items-center h-32 shadow-md">
                <div class="w-3/5 flex justify-start">

                    <ul>
                        <li class="font-bold text-gray-400">Approved Archives</li>
                        <li class="font-extrabold text-slate-800 text-xl">22</li>
                    </ul>

                </div>

                <div class="w-2/5 flex justify-end">
                    <x-ri-inbox-archive-fill class="bg-gray-300 rounded-lg p-2 w-12" />
                </div>
            </div>

            {{-- Sixth Container --}}
            <div class="p-6 bg-white rounded-lg flex items-center h-32 shadow-md">
                <div class="w-3/5 flex justify-start">

                    <ul>
                        <li class="font-bold text-gray-400">Pending Archives</li>
                        <li class="font-extrabold text-slate-800 text-xl">16</li>
                    </ul>

                </div>

                <div class="w-2/5 flex justify-end">
                    <x-ri-inbox-unarchive-fill class="bg-gray-300 rounded-lg p-2 w-12" />
                </div>
            </div>

            <div class="rounded-lg shadow-md bg-white md:col-span-2 lg:col-span-3">
                <div class="overflow-x-auto relative sm:rounded-lg">
                    <table class="w-screen text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                            <h5 class="p-4 font-bold">Latest Thesis File Uploaded</h5>
                            <tr>
                                <th class="py-3 px-6">Uploader's Name</th>
                                <th class="py-3 px-6">Title Name</th>
                                <th class="py-3 px-6">Status</th>
                                <th class="py-3 px-6">Curriculum</th>
                                <th class="py-3 px-6">Upload Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white border-b">
                                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                    Marc Rommel Briones
                                </th>
                                <td class="py-4 px-6">
                                    Web-Based Inventory Management System With Data Analytics and Visualization For Lola Wheng Transfi Online Store
                                </td>
                                <td class="py-4 px-6">
                                    Active
                                </td>
                                <td class="py-4 px-6">
                                    BSIT
                                </td>
                                <td class="py-4 px-6">
                                    14/10/2022
                                </td>
                            </tr>
                            <tr class="bg-white border-b">
                                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                    Marc Rommel Briones
                                </th>
                                <td class="py-4 px-6">
                                    Web-Based Inventory Management System With Data Analytics and Visualization For Lola Wheng Transfi Online Store
                                </td>
                                <td class="py-4 px-6">
                                    Active
                                </td>
                                <td class="py-4 px-6">
                                    BSIT
                                </td>
                                <td class="py-4 px-6">
                                    14/10/2022
                                </td>
                            </tr>
                            <tr class="bg-white border-b">
                                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                    Marc Rommel Briones
                                </th>
                                <td class="py-4 px-6">
                                    Web-Based Inventory Management System With Data Analytics and Visualization For Lola Wheng Transfi Online Store
                                </td>
                                <td class="py-4 px-6">
                                    Active
                                </td>
                                <td class="py-4 px-6">
                                    BSIT
                                </td>
                                <td class="py-4 px-6">
                                    14/10/2022
                                </td>
                            </tr>
                            <tr class="bg-white border-b">
                                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                    Marc Rommel Briones
                                </th>
                                <td class="py-4 px-6">
                                    Web-Based Inventory Management System With Data Analytics and Visualization For Lola Wheng Transfi Online Store
                                </td>
                                <td class="py-4 px-6">
                                    Active
                                </td>
                                <td class="py-4 px-6">
                                    BSIT
                                </td>
                                <td class="py-4 px-6">
                                    14/10/2022
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @include('admin.body.footer')
    </div>
</div>

@endsection