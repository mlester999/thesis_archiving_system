@php
$id = Auth::guard('admin')->user()->id;
$adminData = App\Models\Admin::find($id);
@endphp
 
 <!-- Sidebar -->
    <div class="relative flex-shrink-0 h-screen hidden w-64 overflow-y-auto bg-white shadow-2xl md:block">

    <div class="flex flex-col p-4 text-gray-500 text-md space-y-2 font-medium">
            <p class="uppercase text-gray-400 tracking-wider">Menu</p>
            <a href="{{ route('admin.dashboard') }}" class="{{ Route::is('admin.dashboard') ? 'bg-revert bg-gray-300 flex text-gray-700 hover:text-gray-700 space-x-2 p-2 hover:bg-gray-200 rounded-md' : 'bg-revert bg-white flex hover:text-gray-700 space-x-2 p-2 hover:bg-gray-200 rounded-md' }}"> <x-ri-dashboard-line class="w-5 mr-3" /> Dashboard</a>
            <a href="{{ route('admin.archive-list') }}" class="{{ Route::is('admin.archive-list') ? 'bg-revert bg-gray-300 flex text-gray-700 hover:text-gray-700 space-x-2 p-2 hover:bg-gray-200 rounded-md' : 'bg-revert bg-white flex hover:text-gray-700 space-x-2 p-2 hover:bg-gray-200 rounded-md' }}"> <x-ri-inbox-archive-fill class="w-5 mr-3" /> Archive List</a>
            <a href="{{ route('admin.access-list') }}" class="{{ Route::is('admin.access-list') ? 'bg-revert bg-gray-300 flex text-gray-700 hover:text-gray-700 space-x-2 p-2 hover:bg-gray-200 rounded-md' : 'bg-revert bg-white flex hover:text-gray-700 space-x-2 p-2 hover:bg-gray-200 rounded-md' }}"> <x-ri-mac-line class="w-5 mr-3" /> Access List</a>
            <a href="{{ route('admin.student-list') }}" class="{{ Route::is('admin.student-list') ? 'bg-revert bg-gray-300 flex text-gray-700 hover:text-gray-700 space-x-2 p-2 hover:bg-gray-200 rounded-md' : 'bg-revert bg-white flex hover:text-gray-700 space-x-2 p-2 hover:bg-gray-200 rounded-md' }}"> <x-ri-account-circle-line class="w-5 mr-3" /> Student List</a>
            
            <hr>

            <p class="uppercase text-gray-400 tracking-wider">Maintenance</p>
            <a href="{{ route('admin.department-list') }}" class="{{ Route::is('admin.department-list') ? 'bg-revert bg-gray-300 flex text-gray-700 hover:text-gray-700 space-x-2 p-2 hover:bg-gray-200 rounded-md' : 'bg-revert bg-white flex hover:text-gray-700 space-x-2 p-2 hover:bg-gray-200 rounded-md' }}"> <x-ri-list-check-2 class="w-5 mr-3" /> Department List</a>
            <a href="{{ route('admin.curriculum-list') }}" class="{{ Route::is('admin.curriculum-list') ? 'bg-revert bg-gray-300 flex text-gray-700 hover:text-gray-700 space-x-2 p-2 hover:bg-gray-200 rounded-md' : 'bg-revert bg-white flex hover:text-gray-700 space-x-2 p-2 hover:bg-gray-200 rounded-md' }}"> <x-ri-file-list-3-line class="w-5 mr-3" /> Curriculum List</a>
            <a href="{{ route('admin.research-agendas') }}" class="{{ Route::is('admin.research-agendas') ? 'bg-revert bg-gray-300 flex text-gray-700 hover:text-gray-700 space-x-2 p-2 hover:bg-gray-200 rounded-md' : 'bg-revert bg-white flex hover:text-gray-700 space-x-2 p-2 hover:bg-gray-200 rounded-md' }}"> <x-ri-survey-line class="w-5 mr-3" /> Research Agenda List</a>
            <a href="{{ route('admin.user-list') }}" class="{{ Route::is('admin.user-list') ? 'bg-revert bg-gray-300 flex text-gray-700 hover:text-gray-700 space-x-2 p-2 hover:bg-gray-200 rounded-md' : 'bg-revert bg-white flex hover:text-gray-700 space-x-2 p-2 hover:bg-gray-200 rounded-md' }}"> <x-ri-profile-line class="w-5 mr-3" /> Admin Users List</a>
            <hr>

            <p class="uppercase text-gray-400 tracking-wider">Logs</p>
            <a href="{{ route('admin.activity-logs') }}" class="{{ Route::is('admin.activity-logs') ? 'bg-revert bg-gray-300 flex text-gray-700 hover:text-gray-700 space-x-2 p-2 hover:bg-gray-200 rounded-md' : 'bg-revert bg-white flex hover:text-gray-700 space-x-2 p-2 hover:bg-gray-200 rounded-md' }}"> <x-radix-activity-log class="w-5 mr-3" /> Activity Logs</a>
            <a href="{{ route('admin.report-logs') }}" class="{{ Route::is('admin.report-logs') ? 'bg-revert bg-gray-300 flex text-gray-700 hover:text-gray-700 space-x-2 p-2 hover:bg-gray-200 rounded-md' : 'bg-revert bg-white flex hover:text-gray-700 space-x-2 p-2 hover:bg-gray-200 rounded-md' }}"> <x-ri-search-eye-line class="w-5 mr-3" /> Report Logs</a>
            <a href="{{ route('admin.download-logs') }}" class="{{ Route::is('admin.download-logs') ? 'bg-revert bg-gray-300 flex text-gray-700 hover:text-gray-700 space-x-2 p-2 hover:bg-gray-200 rounded-md' : 'bg-revert bg-white flex hover:text-gray-700 space-x-2 p-2 hover:bg-gray-200 rounded-md' }}"> <x-ri-file-download-line class="w-5 mr-3" /> Download Logs</a>
        </div>
    </div>