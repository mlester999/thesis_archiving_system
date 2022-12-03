@php
  $departmentData = App\Models\Department::all();

  $id = Auth::user()->id;
  $adminData = App\Models\User::find($id);
  $adminDataDisplay = explode(" ", $adminData->first_name);
@endphp

<!-- Nav Container -->
<nav class="relative container mx-auto p-2 bg-gradient-to-r from-green-500 to-green-600 border-yellow-300 max-w-full border-b-8">
    <!-- Flex Container For All Items -->
    <div class="flex items-center justify-between md:mx-6">
      <div x-cloak x-data="sidebar()" class="relative items-start flex md:hidden">
        <div class="relative top-0 transition-all duration-300">
          <div class="flex justify-end">
            <button @click="sidebarOpen = !sidebarOpen" class="transition-all duration-300 w-8 p-1 mx-3 my-2 rounded-full focus:outline-none">
              <x-ri-menu-fill class="h-7 text-white hover:text-opacity-80 duration-150" />
            </button>
          </div>
        </div>

        <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 h-full w-full z-10 bg-gray-900 bg-opacity-60" x-transition.opacity></div>
      
        <div x-cloak wire:ignore :class="{'w-56': sidebarOpen, 'w-0': !sidebarOpen}" class="fixed top-0 bottom-0 left-0 z-30 block w-56 h-full min-h-screen overflow-y-auto text-gray-400 transition-all duration-300 ease-in-out bg-slate-50 shadow-lg overflow-x-hidden">
          <div class="flex flex-col items-stretch justify-between h-full">
            <div class="flex flex-col flex-shrink-0 w-full">
              <div class="flex items-center justify-center w-full py-5 text-center" :class="{'opacity-1': sidebarOpen, 'opacity-0': !sidebarOpen}">
                <p class="text-lg font-bold leading-normal text-gray-900 focus:outline-none focus:ring">Hello, {{ $adminDataDisplay[0] }}</p>
              </div>
      
              <nav>
                <div class="flex-grow md:block md:overflow-y-auto overflow-x-hidden" :class="{'opacity-1': sidebarOpen, 'opacity-0': !sidebarOpen}">
                  <a class="flex justify-start items-center px-4 py-3 text-gray-700 hover:bg-green-600 duration-150 hover:text-gray-100 focus:outline-none" href="{{ route('home') }}">
                    <x-ri-home-2-fill class="h-5" />
                    <span class="mx-4">Home</span>
                  </a>
      
                  <a class="flex justify-start items-center px-4 py-3 text-gray-700 hover:bg-green-600 duration-150 hover:text-gray-100 focus:outline-none" href="{{ route('projects') }}">
                    <x-ri-file-list-3-fill class="h-5" />
                    <span class="mx-4">Projects</span>
                  </a>
      
                  <button @click="departmentOpen = !departmentOpen" class="flex justify-start w-full items-center px-4 py-3 text-gray-700 hover:bg-green-600 duration-150 hover:text-gray-100 focus:outline-none">
                    <x-ri-stack-fill class="h-5" />
                    <span class="ml-4 mr-2">Department</span>
                    <x-ri-arrow-drop-down-fill class="h-8" />
                  </button>

                  <div 
                  x-cloak 
                  x-show="departmentOpen"
                  x-transition:enter="transition origin-top ease-out duration-300"
                  x-transition:enter-start="transform -translate-y-12 opacity-0"
                  x-transition:enter-end="transform translate-y-0 opacity-100"
                  x-transition:leave="transition origin-top ease-out duration-300"
                  x-transition:leave-start="opacity-100"
                  x-transition:leave-end="opacity-0"
                  >
                    @foreach($departmentData as $department)
                      <a class="flex justify-start items-center text-xs px-6 py-2 text-gray-700 hover:bg-green-600 duration-150 hover:text-gray-100 focus:outline-none" href="{{ route('department', strtolower($department->dept_name)) }}">
                        <span class="flex gap-2 items-center">
                            <span><x-ri-file-paper-2-fill class="h-4" /></span>
                            <span>{{ $department->dept_description }}</span>
                        </span>
                      </a>
                    @endforeach
                  </div>

                  <a class="flex justify-start items-center px-4 py-3 text-gray-700 hover:bg-green-600 duration-150 hover:text-gray-100 focus:outline-none" href="{{ route('submit') }}">
                    <x-ri-file-upload-fill class="h-5" />
                    <span class="mx-4">Submit Thesis</span>
                  </a>

                  <a class="flex justify-start items-center px-4 py-3 text-gray-700 hover:bg-green-600 duration-150 hover:text-gray-100 focus:outline-none" href="{{ route('about') }}">
                    <x-ri-information-fill class="h-5" />
                    <span class="mx-4">About</span>
                  </a>
      
                </div>
      
              </nav>
      
            </div>
            <div :class="{'opacity-1': sidebarOpen, 'opacity-0': !sidebarOpen}">
              <a class="flex justify-start items-center px-4 py-3 text-gray-700 hover:bg-green-600 hover:text-gray-100 duration-150 focus:outline-none" href="{{ route('profile') }}">
                <x-ri-user-3-fill class="h-5" />
                <span class="mx-4">Profile</span>
              </a>
              <a class="flex justify-start items-center px-4 py-3 text-gray-700 hover:bg-green-600 hover:text-gray-100 duration-150 focus:outline-none" href="{{ route('change.password') }}">
                <x-ri-lock-password-fill class="h-5" />
                <span class="mx-4">Change Password</span>
              </a>
              <form action="{{ route('logout') }}" method="POST">
                @csrf
              <button title="Logout" class="flex justify-start items-center w-full px-4 py-3 hover:bg-green-600 text-red-500 hover:text-red-400 duration-150 focus:outline-none" />
              <x-ri-logout-box-r-fill class="h-5" />
              <span class="mx-4">Logout</span>
              </button>
              </form>
            </div>
          </div>
      
          <script>
            function sidebar() {
              return {
                sidebarOpen: false,
                departmentOpen: false,
                openSidebar() {
                  this.sidebarOpen = true
                },
                closeSidebar() {
                  this.sidebarOpen = false
                },
              }
            }
          </script>
        </div>
      </div>
      <!-- Flex Container For Logo/Menu -->
      <div class="flex items-center space-x-20 ml-2 md:ml-12">
        <!-- Logo -->
        <a href="{{ route('home') }}"><img class="w-56 sm:w-64 md:w-80" src="{{ asset('images/Logo.png') }}" alt="" /></a>
      </div>

      <div class="block md:hidden transition-all duration-300 w-8 p-1 mx-3 my-2 rounded-full focus:outline-none">
        <a href="{{ route('about') }}"> <x-ri-information-line class="h-7 text-white hover:text-opacity-80 duration-150" /> </a>
      </div>

      <!-- Right Buttons Menu -->
      <div x-cloak x-data="{ dropdownOpenProfile: false }" class="space-x-8 mr-2 md:mr-12 tracking-wider font-bold hidden md:block">
        <button
          @click="dropdownOpenProfile = !dropdownOpenProfile"
          class="relative z-10 max-w-lg bg-transparent tracking-wide p-2 text-white rounded-lg text-sm py-3 overflow-hidden focus:outline-none focus:border-white"
        >
        <img src="{{ asset('images/R.png') }}" class="w-6 h-6 sm:w-10 sm:h-10 rounded-full object-cover inline-block mx-1" src="/docs/images/people/profile-picture-5.jpg" alt="Rounded avatar">
            <span class="text-xs sm:text-base">{{ $adminDataDisplay[0] }}</span>
            <span class="mx-1"><i class="fa-solid fa-chevron-down"></i></span>
        </button>

        <div
          x-show="dropdownOpenProfile"
          @click="dropdownOpenProfile = ! dropdownOpenProfile"
          class="fixed inset-0 h-full w-full z-10"
        ></div>

        <div
          x-show="dropdownOpenProfile"
          class="absolute right-8 mt-2 py-4 w-52 bg-white rounded-md shadow-2xl z-20"
          x-transition
        >
          <a
            href="{{ route('profile') }}"
            class="block p-4 text-xs md:text-sm capitalize duration-150 text-gray-800 hover:bg-green-500 hover:text-white"
          >
          <i class="fas fa-user fa-lg px-2"></i> Profile
          </a>
          <a
            href="{{ route('change.password') }}"
            class="block p-4 text-xs md:text-sm capitalize duration-150 text-gray-800 hover:bg-green-500 hover:text-white"
          >
          <i class="fa-solid fa-lg fa-lock px-2"></i> Change Password
          </a>
          <form action="{{ route('logout') }}" method="POST">
            @csrf
          <button class="block w-full p-4 duration-150 text-xs md:text-sm text-left capitalize text-red-600 hover:bg-green-500 hover:text-white">
            <i class="fas fa-lg fa-sign-out-alt px-2"></i> Logout</button>
          </form>
        </div>
      </div>
    </div>
  </nav>

  <div x-cloak x-data="{ dropdownOpenDept: false }" class="hidden md:block relative container mx-auto pt-1 px-2 pb-2 bg-white shadow-lg max-w-full">
    <ul class="flex flex-wrap justify-between -mb-px text-xxs sm:text-xs md:text-sm lg:text-md xl:text-lg xl:mx-64 lg:mx-24 md:mx-16 sm:mx-6">
      <li class="">
          <a href="{{ route('home') }}" class="{{ $currentPage=='home' ? 'font-bold inline-block p-4 text-green-600 rounded-t-lg border-b-2 border-green-600 active dark:text-green-500 dark:border-green-500' : 'font-bold inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-400 hover:border-gray-300 duration-150' }}">Home</a>
      </li>
      @can('View Thesis')
      <li class="">
          <a href="{{ route('projects') }}" class="{{ $currentPage=='projects' ? 'font-bold inline-block p-4 text-green-600 rounded-t-lg border-b-2 border-green-600 active dark:text-green-500 dark:border-green-500' : 'font-bold inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-400 hover:border-gray-300 duration-150' }}">Projects</a>
      </li>
      <li class="">
        <div class="relative">
          <button @click="dropdownOpenDept = !dropdownOpenDept" class="{{ $currentPage=='department' ? 'font-bold inline-block p-4 text-green-600 rounded-t-lg border-b-2 border-green-600 active dark:text-green-500 dark:border-green-500' : 'font-bold inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-400 hover:border-gray-300 duration-150' }}">Department <i class="fa-solid fa-chevron-down ml-1"></i></button>
          <div
          x-show="dropdownOpenDept"
          @click.outside="dropdownOpenDept = false"
          class="absolute -left-16 md:-left-20 mt-2 py-4 w-64 md:w-80 bg-white rounded-md shadow-2xl z-20"
          x-transition
        >
        @foreach($departmentData as $department)
          <a
            href="{{ route('department', strtolower($department->dept_name)) }}"
            class="block p-4 text-xs md:text-sm capitalize text-gray-800 hover:bg-green-500 duration-150 hover:text-white"
          >
          {{ $department->dept_description }}
          </a>
        @endforeach
        </div>
      </div>
      </li>
      @endcan

      @can('View Submission of Thesis')
      <li class="">
          <a href="{{ route('submit') }}" class="{{ $currentPage=='submit' ? 'font-bold inline-block p-4 text-green-600 rounded-t-lg border-b-2 border-green-600 active dark:text-green-500 dark:border-green-500' : 'font-bold inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-400 hover:border-gray-300 duration-150' }}">Submit Thesis / Capstone</a>
      </li>
      @endcan
      <li class="">
        <a href="{{ route('about') }}" class="{{ $currentPage=='about' ? 'font-bold inline-block p-4 text-green-600 rounded-t-lg border-b-2 border-green-600 active dark:text-green-500 dark:border-green-500' : 'font-bold inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-400 hover:border-gray-300 duration-150' }}">About</a>
    </li>
  </ul>
  </div>
