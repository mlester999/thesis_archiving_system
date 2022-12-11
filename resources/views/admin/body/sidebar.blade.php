@php
$id = Auth::guard('admin')->user()->id;
$adminData = App\Models\Admin::find($id);
@endphp
 
 <!-- Sidebar -->
    <div class="relative flex-shrink-0 h-screen hidden w-64 overflow-y-auto bg-white shadow-2xl md:block">

    <div x-cloak x-data="{ loading: false }" class="flex flex-col p-4 text-gray-500 text-md space-y-2 font-medium">
            
            <div x-show="loading">
                <x-normal-loading />
            </div>

            <p class="uppercase text-gray-400 tracking-wider">Menu</p>
            <a href="{{ route('admin.dashboard') }}" @click="loading = true" class="{{ Route::is('admin.dashboard') ? 'bg-revert bg-gray-300 flex text-gray-700 hover:text-gray-700 space-x-2 p-2 hover:bg-gray-200 rounded-md' : 'bg-revert bg-white flex hover:text-gray-700 space-x-2 p-2 hover:bg-gray-200 rounded-md' }}"> <x-ri-dashboard-line class="w-5 mr-3" /> Dashboard</a>

            @can('Archive List')
            <a href="{{ route('admin.archive-list') }}" @click="loading = true" class="{{ Route::is('admin.archive-list') ? 'bg-revert bg-gray-300 flex text-gray-700 hover:text-gray-700 space-x-2 p-2 hover:bg-gray-200 rounded-md' : 'bg-revert bg-white flex hover:text-gray-700 space-x-2 p-2 hover:bg-gray-200 rounded-md' }}"> <x-ri-inbox-archive-fill class="w-5 mr-3" /> Archive List</a>
            @endcan

            @can('Access List')
            <a href="{{ route('admin.access-list') }}" @click="loading = true" class="{{ Route::is('admin.access-list') ? 'bg-revert bg-gray-300 flex text-gray-700 hover:text-gray-700 space-x-2 p-2 hover:bg-gray-200 rounded-md' : 'bg-revert bg-white flex hover:text-gray-700 space-x-2 p-2 hover:bg-gray-200 rounded-md' }}"> <x-ri-mac-line class="w-5 mr-3" /> Access List</a>
            @endcan

            @can('Student List')
            <a href="{{ route('admin.student-list') }}" @click="loading = true" class="{{ Route::is('admin.student-list') ? 'bg-revert bg-gray-300 flex text-gray-700 hover:text-gray-700 space-x-2 p-2 hover:bg-gray-200 rounded-md' : 'bg-revert bg-white flex hover:text-gray-700 space-x-2 p-2 hover:bg-gray-200 rounded-md' }}"> <x-ri-account-circle-line class="w-5 mr-3" /> Student List</a>
            @endcan

            @if(auth()->user()->can('College List') || auth()->user()->can('Program List') || auth()->user()->can('Research Agenda List') || auth()->user()->can('Admin Users List'))
            <hr>
            <p class="uppercase text-gray-400 tracking-wider">Maintenance</p>
            @endif

            @can('College List')
            <a href="{{ route('admin.department-list') }}" @click="loading = true" class="{{ Route::is('admin.department-list') ? 'bg-revert bg-gray-300 flex text-gray-700 hover:text-gray-700 space-x-2 p-2 hover:bg-gray-200 rounded-md' : 'bg-revert bg-white flex hover:text-gray-700 space-x-2 p-2 hover:bg-gray-200 rounded-md' }}"> <x-ri-list-check-2 class="w-5 mr-3" /> College List</a>
            @endcan
            
            @can('Program List')
            <a href="{{ route('admin.curriculum-list') }}" @click="loading = true" class="{{ Route::is('admin.curriculum-list') ? 'bg-revert bg-gray-300 flex text-gray-700 hover:text-gray-700 space-x-2 p-2 hover:bg-gray-200 rounded-md' : 'bg-revert bg-white flex hover:text-gray-700 space-x-2 p-2 hover:bg-gray-200 rounded-md' }}"> <x-ri-file-list-3-line class="w-5 mr-3" /> Program List</a>
            @endcan

            @can('Research Agenda List')
            <a href="{{ route('admin.research-agendas') }}" @click="loading = true" class="{{ Route::is('admin.research-agendas') ? 'bg-revert bg-gray-300 flex text-gray-700 hover:text-gray-700 space-x-2 p-2 hover:bg-gray-200 rounded-md' : 'bg-revert bg-white flex hover:text-gray-700 space-x-2 p-2 hover:bg-gray-200 rounded-md' }}"> <x-ri-survey-line class="w-5 mr-3" /> Research Agenda List</a>
            @endcan

            @can('Admin Users List')
            <a href="{{ route('admin.user-list') }}" @click="loading = true" class="{{ Route::is('admin.user-list') ? 'bg-revert bg-gray-300 flex text-gray-700 hover:text-gray-700 space-x-2 p-2 hover:bg-gray-200 rounded-md' : 'bg-revert bg-white flex hover:text-gray-700 space-x-2 p-2 hover:bg-gray-200 rounded-md' }}"> <x-ri-profile-line class="w-5 mr-3" /> Admin Users List</a>
            @endcan

            @if(auth()->user()->can('Activity Logs') || auth()->user()->can('Report Logs') || auth()->user()->can('Download Logs'))
            <hr>
            <p class="uppercase text-gray-400 tracking-wider">Logs</p>
            @endif

            @can('Activity Logs')
            <a href="{{ route('admin.activity-logs') }}" @click="loading = true" class="{{ Route::is('admin.activity-logs') ? 'bg-revert bg-gray-300 flex text-gray-700 hover:text-gray-700 space-x-2 p-2 hover:bg-gray-200 rounded-md' : 'bg-revert bg-white flex hover:text-gray-700 space-x-2 p-2 hover:bg-gray-200 rounded-md' }}"> <x-radix-activity-log class="w-5 mr-3" /> Activity Logs</a>
            @endcan
            
            @can('Report Logs')
            <a href="{{ route('admin.report-logs') }}" @click="loading = true" class="{{ Route::is('admin.report-logs') ? 'bg-revert bg-gray-300 flex text-gray-700 hover:text-gray-700 space-x-2 p-2 hover:bg-gray-200 rounded-md' : 'bg-revert bg-white flex hover:text-gray-700 space-x-2 p-2 hover:bg-gray-200 rounded-md' }}"> <x-ri-search-eye-line class="w-5 mr-3" /> Report Logs</a>
            @endcan
            
            @can('Download Logs')
            <a href="{{ route('admin.download-logs') }}" @click="loading = true" class="{{ Route::is('admin.download-logs') ? 'bg-revert bg-gray-300 flex text-gray-700 hover:text-gray-700 space-x-2 p-2 hover:bg-gray-200 rounded-md' : 'bg-revert bg-white flex hover:text-gray-700 space-x-2 p-2 hover:bg-gray-200 rounded-md' }}"> <x-ri-file-download-line class="w-5 mr-3" /> Download Logs</a>
            @endcan
        
        </div>
    </div>