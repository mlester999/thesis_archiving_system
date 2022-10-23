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
      <div x-data="{ dropdownOpen: false }" class="space-x-8 tracking-wider font-bold">
        <button
          @click="dropdownOpen = !dropdownOpen"
          class="relative z-10 max-w-lg bg-transparent tracking-wide p-2 text-white rounded-lg text-sm py-3 overflow-hidden focus:outline-none focus:border-white"
        >
        <img src="{{ asset('images/mitch.jpg') }}" class="w-10 h-10 rounded-full object-cover inline-block mx-2" src="/docs/images/people/profile-picture-5.jpg" alt="Rounded avatar">
            <span>{{ $adminData->first_name }}</span>
            <span class="mx-2"><i class="fa-solid fa-chevron-down"></i></span>
        </button>

        <div
          x-show="dropdownOpen"
          @click="dropdownOpen = ! dropdownOpen"
          class="fixed inset-0 h-full w-full z-10"
        ></div>

        <div
          x-show="dropdownOpen"
          class="absolute right-12 mt-2 py-4 w-48 bg-white rounded-md shadow-2xl z-20"
          x-transition
        >
          <a
            href="{{ route('profile') }}"
            class="block p-4 text-sm capitalize text-gray-800 hover:bg-green-500 hover:text-white"
          >
          <i class="fas fa-user fa-xl pl-8 pr-3"></i> Profile
          </a>
          <a
            href="#"
            class="block p-4 text-sm capitalize text-gray-800 hover:bg-green-500 hover:text-white"
          >
          <i class="fas fa-sliders-h pl-8 pr-3"></i> Settings
          </a>
          <form action="{{ route('logout') }}" method="POST">
            @csrf
          <button class="block w-full p-4 text-sm capitalize text-red-600 hover:bg-green-500 hover:text-white">
            <i class="fas fa-sign-out-alt pr-3"></i> Logout</button>
          </form>
        </div>
      </div>
  </nav>
  
  <div class="relative container mx-auto p-6 bg-white shadow-lg max-w-full">
      <div class="flex items-center mx-40">
          <div class="hidden space-x-8 tracking-wider font-bold lg:flex">
              <a href="#" class="px-6 text-black hover:text-slate-500 duration-200"
                >Home</a
              >
              <a href="#" class="px-6 text-black hover:text-slate-500 duration-200"
                >Projects</a
              >
              <a href="#" class="px-6 text-black hover:text-slate-500 duration-200"
                >Department</a
              >
              <a href="#" class="px-6 text-black hover:text-slate-500 duration-200"
                >Submit Thesis / Capstone</a
              >
              <a href="#" class="px-6 text-black hover:text-slate-500 duration-200"
                >Department</a
              >
            </div>
      </div>
  </div>