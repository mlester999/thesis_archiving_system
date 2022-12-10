@php
$id = Auth::guard('admin')->user()->id;
$adminData = App\Models\Admin::find($id);
@endphp

<!-- Header -->
<nav class="bg-gradient-to-r from-green-500 to-green-600 shadow-md">
    <div class="mx-auto">
        <div class="flex justify-between py-2 px-6">
            <div class="flex items-center space-x-2 font-bold text-gray-400">
                <a href="{{ route('admin.dashboard') }}"> <img class="w-56 md:w-64 lg:w-72 xl:w-80 cursor-pointer" src="/images/Logo.png" alt=""> </a>
            </div>

            <li class="flex-1 hidden md:flex md:flex-none md:mt-2 space-x-4 list-none">
                <div x-data="{open: false}" x-on:click.outside="open = false" class="relative inline-block">
                  <button
                    x-on:click="open = !open"
                    class="drop-button text-white py-2 px-2"
                  >
                    <span class="flex items-center gap-2"><x-eos-admin class="h-7" />
                    {{ $adminData->name }}
                    <svg
                      class="h-4 fill-current inline"
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 20 20"
                    >
                      <path
                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
                      />
                    </svg>
                  </span>
                  </button>
                  <div
                    x-show="open"
                    x-cloak
                    class="absolute shadow-lg bg-white rounded text-black right-0 mt-3 w-48 overflow-auto z-30"
                  >

                    <a
                      href="{{ route('admin.profile') }}"
                      class="p-2 hover:bg-gray-100 duration-150 text-black text-sm no-underline hover:no-underline block"
                      ><i class="fa-solid fa-fw fa-user-gear ml-4 mt-2"></i> View Profile</a
                    >
                    <a
                      href="{{ route('admin.change.password') }}"
                      class="p-2 hover:bg-gray-100 duration-150 text-black text-sm no-underline hover:no-underline block"
                      ><i class="fa-solid fa-fw fa-lock ml-4 mt-2"></i> Change Password</a
                    >
                    <a
                      href="{{ route('admin.settings') }}"
                      class="p-2 hover:bg-gray-100 duration-150 text-black text-sm no-underline hover:no-underline block"
                      ><i class="fa fa-cog fa-fw ml-4 mt-2"></i> Settings</a
                    >
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                    <button
                      class="p-2 w-full text-left hover:bg-gray-100 duration-150 text-red-500 text-sm no-underline hover:no-underline block"
                      ><i class="fas fa-sign-out-alt fa-fw ml-4 my-2"></i> Log Out</
                    >
                    </form>
                </div>
              </div>
              </li>
            {{-- <div class="hidden md:flex space-x-4">
                <div class="hidden md:flex">
                    <input type="text" class="lg:w-96 sm:w-48 h-10 mt-2 bg-gray-100 rounded-md px-4 focus:outline-none" placeholder="Search">
                </div>
            </div> --}}

             <!-- Hamburger Button -->
        <button
        id="menu-btn"
        class="block hamburger md:hidden focus:outline-none mt-3"
        type="button"
      >
        <span class="hamburger-top"></span>
        <span class="hamburger-middle"></span>
        <span class="hamburger-bottom"></span>
         </button>
        </div>
        
        <!-- Mobile Menu -->
        <div
        id="menu"
        class="absolute z-50 md:hidden hidden p-6 ring-2 ring-gray-900 rounded-lg bg-slate-50 shadow-2xl left-6 right-6 top-20 z-100"
        >
        <div
            class="flex flex-col items-center justify-center w-full space-y-3 font-semibold text-sm text-white rounded-sm"
        >
        <a href="{{ route('admin.profile') }}" class="w-full text-center text-gray-900 hover:text-opacity-50 duration-150"><i class="fa-solid fa-fw fa-user-gear mr-1"></i> View Profile</a>
        <a href="{{ route('admin.change.password') }}" class="w-full text-center text-gray-900 hover:text-opacity-50 duration-150"><i class="fa-solid fa-fw fa-lock mr-1"></i> Change Password</a>
        <a href="{{ route('admin.settings') }}" class="w-full text-center text-gray-900 hover:text-opacity-50 duration-150"><i class="fa fa-cog fa-fw mr-1"></i> Settings</a>
        <div class="w-full">
          <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button
              class="w-full text-center text-red-500 hover:text-opacity-50 duration-150"><i class="fas fa-sign-out-alt fa-fw mr-1"></i> Logout</
            >
          </form>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="w-full text-gray-900 pt-3 border-t border-gray-400 hover:text-opacity-50 duration-150"
        ><span class="flex flex-row justify-center"><x-ri-dashboard-line class="w-5 mr-2" /> Dashboard</span></a
        >
        <a href="{{ route('admin.archive-list') }}" class="w-full text-gray-900 hover:text-opacity-50 duration-150"
        ><span class="flex flex-row justify-center"><x-ri-inbox-archive-fill class="w-5 mr-2" /> Archive List</span></a
        >
        <a href="{{ route('admin.access-list') }}" class="w-full text-gray-900 hover:text-opacity-50 duration-150"
        ><span class="flex flex-row justify-center"><x-ri-mac-line class="w-5 mr-2" /> Access List</span></a
        >
        <a href="{{ route('admin.student-list') }}" class="w-full text-gray-900 hover:text-opacity-50 duration-150"
        ><span class="flex flex-row justify-center"><x-ri-account-circle-line class="w-5 mr-2" /> Student List</span></a
        >
        <a href="{{ route('admin.department-list') }}" class="w-full pt-3 border-t text-gray-900 border-gray-400 hover:text-opacity-50 duration-150"
        ><span class="flex flex-row justify-center"><x-ri-list-check-2 class="w-5 mr-2" /> College List</span></a
        >
        <a href="{{ route('admin.curriculum-list') }}" class="w-full text-gray-900 hover:text-opacity-50 duration-150"
        ><span class="flex flex-row justify-center"><x-ri-file-list-3-line class="w-5 mr-2" /> Program List</span></a
        >
        <a href="{{ route('admin.research-agendas') }}" class="w-full text-gray-900 hover:text-opacity-50 duration-150"
        ><span class="flex flex-row justify-center"><x-ri-survey-line class="w-5 mr-2" /> Research Agenda List</span></a
        >
        <a href="{{ route('admin.user-list') }}" class="w-full text-gray-900 hover:text-opacity-50 duration-150"
        ><span class="flex flex-row justify-center"><x-ri-profile-line class="w-5 mr-2" /> Admin Users List</span></a
        >
        <a href="{{ route('admin.activity-logs') }}" class="w-full text-gray-900 pt-3 border-t border-gray-400 hover:text-opacity-50 duration-150"
        ><span class="flex flex-row justify-center"><x-radix-activity-log class="w-5 mr-2" /> Activity Logs</span></a
        >
        <a href="{{ route('admin.report-logs') }}" class="w-full text-gray-900 hover:text-opacity-50 duration-150"
        ><span class="flex flex-row justify-center"><x-ri-search-eye-line class="w-5 mr-2" /> Report Logs</span></a
        >
        <a href="{{ route('admin.download-logs') }}" class="w-full text-gray-900 hover:text-opacity-50 duration-150"
        ><span class="flex flex-row justify-center"><x-ri-file-download-line class="w-5 mr-2" /> Download Logs</span></a
        >
        </div>
    </div>
        </div>
    </div>
</nav>
{{-- 
<div class="hidden mobile-menu">
    <ul class="font-bold text-slate-600 items-center">
        <li class="block text-md px-2 py-4 hover:bg-green-500 transition duration-300">Features</li>
        <li class="block text-md px-2 py-4 hover:bg-green-500 transition duration-300">Pricing</li>
        <li class="block text-md px-2 py-4 hover:bg-green-500 transition duration-300">Sign In</li>
        <li class="block text-md px-2 py-4 text-slate-400">or</li>
        <li class="block text-md px-2 py-4 hover:bg-green-500 transition duration-300">Sign Up</li>
    </ul>
</div> --}}
