@php
$id = Auth::guard('admin')->user()->id;
$adminData = App\Models\Admin::find($id);
$adminDataDisplay = explode(" ", $adminData->first_name);

@endphp
 
 <!-- Sidebar -->
    <div class="relative flex-shrink-0 h-screen hidden w-64 overflow-y-auto bg-white shadow-2xl md:block">
        <div class="bg-slate-900 h-20 w-64 py-3 px-5 grid grid-cols-2">
            <div class="flex space-x-4 bg-green-400 p-1 rounded-md h-12 w-12">
            <img src="/images/R.png" class="flex rounded-md" alt="Admin Photo">

            <div class="flex flex-col">
                <h3 class="text-white font-bold text-base">ADMIN</h3>
                <h3 class="text-white font-base text-base">{{ $adminDataDisplay[0] }}</h3>
            </div>
        </div>
    </div>

    <div class="flex flex-col p-4 text-gray-500 text-md space-y-3 font-medium">
            <p class="uppercase text-gray-400 tracking-wider">Menu</p>
            <a href="{{ route('admin.dashboard') }}" class="flex hover:text-gray-700 space-x-2 p-2 hover:bg-gray-200 rounded-md"> <x-ri-dashboard-line class="w-5 mr-3" /> Dashboard</a>
            <a href="" class="flex hover:text-gray-700 space-x-2 p-2 hover:bg-gray-200 rounded-md"> <x-ri-inbox-archive-fill class="w-5 mr-3" /> Archives List</a>
            <a href="" class="flex hover:text-gray-700 space-x-2 p-2 hover:bg-gray-200 rounded-md"> <x-ri-mac-line class="w-5 mr-3" /> Access List</a>
            <a href="" class="flex hover:text-gray-700 space-x-2 p-2 hover:bg-gray-200 rounded-md"> <x-ri-account-circle-line class="w-5 mr-3" /> Student List</a>
            
            <hr>

            <p class="uppercase text-gray-400 tracking-wider">Maintenance</p>
            <a href="" class="flex hover:text-gray-700 space-x-2 p-2 hover:bg-gray-200 rounded-md"> <x-ri-list-check-2 class="w-5 mr-3" /> Department List</a>
            <a href="" class="flex hover:text-gray-700 space-x-2 p-2 hover:bg-gray-200 rounded-md"> <x-ri-file-list-3-line class="w-5 mr-3" /> Curriculum List</a>
            <a href="{{ route('admin.user.list') }}" class="flex hover:text-gray-700 space-x-2 p-2 hover:bg-gray-200 rounded-md"> <x-ri-profile-line class="w-5 mr-3" /> User List</a>
            <li class="list-none">
            <div class="flex hover:text-gray-700 space-x-2 p-2 relative hover:bg-gray-200 rounded-md cursor-pointer" id="settings-btn"> <x-ri-settings-3-line class="w-5 mr-3" /> Settings <span class="fas fa-caret-down fa-lg absolute left-48 bottom-5"></span></div>
            <ul class="px-8 pt-1 text-sm hidden" id="settings-show">
                <li class="py-2"><a href="{{ route('admin.profile') }}" class="flex hover:text-gray-700 rounded-md"> <x-ri-shield-user-line class="w-5 mr-3" />View Profile</a></li>
                <li class="pt-2"><a href="{{ route('admin.change.password') }}" class="flex hover:text-gray-700 rounded-md"> <x-ri-lock-password-line class="w-5 mr-3" />Change Password</a></li>
            </ul>
            </li>
            <a href="{{ route('admin.logout') }}" class="flex text-red-500 hover:text-red-700 space-x-2 p-2 hover:bg-gray-200 rounded-md"> <x-ri-logout-box-r-line class="w-5 mr-3" /> Logout</a>

        </div>
    </div>