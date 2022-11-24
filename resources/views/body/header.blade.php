<!-- Nav Container -->
<nav class="relative container mx-auto p-2 bg-gradient-to-r from-green-500 to-green-600 border-yellow-300 max-w-full border-b-8">
    <!-- Flex Container For All Items -->
    <div class="flex items-center justify-between mx-6">
      <!-- Flex Container For Logo/Menu -->
      <div class="flex items-center space-x-20">
        <!-- Logo -->
        <a href="/dashboard"><img class="w-48 sm:w-64 md:w-80" src="{{ asset('images/Logo.png') }}" alt="" /></a>
      </div>

      @php

        $id = Auth::user()->id;
        $adminData = App\Models\User::find($id);
        $adminDataDisplay = explode(" ", $adminData->first_name);
        
      @endphp

      <!-- Right Buttons Menu -->
      <div x-cloak x-data="{ dropdownOpenProfile: false }" class="space-x-8 tracking-wider font-bold">
        <button
          @click="dropdownOpenProfile = !dropdownOpenProfile"
          class="relative z-10 max-w-lg bg-transparent tracking-wide p-2 text-white rounded-lg text-sm py-3 overflow-hidden focus:outline-none focus:border-white"
        >
        <img src="{{ asset('images/R.png') }}" class="w-6 h-6 sm:w-10 sm:h-10 rounded-full object-cover inline-block mx-2" src="/docs/images/people/profile-picture-5.jpg" alt="Rounded avatar">
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

  <div x-cloak x-data="{ dropdownOpenDept: false }" class="relative container mx-auto pt-1 px-2 pb-2 bg-white shadow-lg max-w-full">
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
          @php
            $departmentData = App\Models\Department::all();
          @endphp
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
