<!-- Nav Container -->
<nav class="relative container mx-auto p-2 bg-green-600 border-yellow-300 max-w-full border-b-8">
    <!-- Flex Container For All Items -->
    <div class="flex items-center justify-between mx-12">
      <!-- Flex Container For Logo/Menu -->
      <div class="flex items-center space-x-20">
        <!-- Logo -->
        <a href="/dashboard"><img class="w-80" src="{{ asset('images/Logo.png') }}" alt="" /></a>
      </div>

      @php

        $id = Auth::user()->id;
        $adminData = App\Models\User::find($id);

      @endphp

      <!-- Right Buttons Menu -->
      <div x-cloak x-data="{ dropdownOpenProfile: false }" class="space-x-8 tracking-wider font-bold">
        <button
          @click="dropdownOpenProfile = !dropdownOpenProfile"
          class="relative z-10 max-w-lg bg-transparent tracking-wide p-2 text-white rounded-lg text-sm py-3 overflow-hidden focus:outline-none focus:border-white"
        >
        <img src="{{ asset('images/R.png') }}" class="w-10 h-10 rounded-full object-cover inline-block mx-2" src="/docs/images/people/profile-picture-5.jpg" alt="Rounded avatar">
            <span>{{ $adminData->first_name }}</span>
            <span class="mx-2"><i class="fa-solid fa-chevron-down"></i></span>
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
            class="block p-4 text-sm capitalize text-gray-800 hover:bg-green-500 hover:text-white"
          >
          <i class="fas fa-user fa-lg px-2"></i> Profile
          </a>
          <a
            href="{{ route('change.password') }}"
            class="block p-4 text-sm capitalize text-gray-800 hover:bg-green-500 hover:text-white"
          >
          <i class="fa-solid fa-lg fa-lock px-2"></i> Change Password
          </a>
          <form action="{{ route('logout') }}" method="POST">
            @csrf
          <button class="block w-full p-4 text-sm text-left capitalize text-red-600 hover:bg-green-500 hover:text-white">
            <i class="fas fa-lg fa-sign-out-alt px-2"></i> Logout</button>
          </form>
        </div>
      </div>
    </div>
  </nav>

  <div x-cloak x-data="{ dropdownOpenDept: false }" class="relative container mx-auto p-2 bg-white shadow-lg max-w-full">
    <ul class="flex flex-wrap -mb-px mx-40">
      <li class="mx-8">
          <a href="{{ route('home') }}" class="{{ $currentPage=='home' ? 'font-bold inline-block p-4 text-green-600 rounded-t-lg border-b-2 border-green-600 active dark:text-green-500 dark:border-green-500' : 'font-bold inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' }}">Home</a>
      </li>
      <li class="px-8">
          <a href="{{ route('projects') }}" class="{{ $currentPage=='projects' ? 'font-bold inline-block p-4 text-green-600 rounded-t-lg border-b-2 border-green-600 active dark:text-green-500 dark:border-green-500' : 'font-bold inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' }}">Projects</a>
      </li>
      <li class="px-8">
        <div class="relative">
          @php
            $departmentData = App\Models\Department::all();
            foreach($departmentData as $department) {
              $finalDepartment = strtolower($department->dept_name);
            }
          @endphp
          <button @click="dropdownOpenDept = !dropdownOpenDept" class="{{ $currentPage=='department' ? 'font-bold inline-block p-4 text-green-600 rounded-t-lg border-b-2 border-green-600 active dark:text-green-500 dark:border-green-500' : 'font-bold inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' }}">Department <i class="fa-solid fa-chevron-down mx-2"></i></button>
          
          <div
          x-show="dropdownOpenDept"
          @click.outside="dropdownOpenDept = false"
          class="absolute -left-20 mt-2 py-4 w-80 bg-white rounded-md shadow-2xl z-20"
          x-transition
        >
        @foreach($departmentData as $department)
          <a
            href="{{ route('department' . '.' . $finalDepartment) }}"
            class="block p-4 text-sm capitalize text-gray-800 hover:bg-green-500 hover:text-white"
          >
          {{ $department->dept_description }}
          </a>
        @endforeach
        </div>
      </div>
      </li>
      <li class="px-8">
          <a href="{{ route('submit') }}" class="{{ $currentPage=='submit' ? 'font-bold inline-block p-4 text-green-600 rounded-t-lg border-b-2 border-green-600 active dark:text-green-500 dark:border-green-500' : 'font-bold inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' }}">Submit Thesis / Capstone</a>
      </li>
      <li class="px-8">
        <a href="{{ route('about') }}" class="{{ $currentPage=='about' ? 'font-bold inline-block p-4 text-green-600 rounded-t-lg border-b-2 border-green-600 active dark:text-green-500 dark:border-green-500' : 'font-bold inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' }}">About</a>
    </li>
  </ul>
  </div>
