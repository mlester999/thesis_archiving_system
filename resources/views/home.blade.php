<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="shortcut icon"
      type="image/png"
      href="images/favicon-32x32.png"
    />

    <link rel="shortcut icon" href="{{ asset('library_icon.ico') }}">

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Alata&family=Poppins:wght@400;500;700&display=swap"
      rel="stylesheet"
    />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>PNC Library</title>
  </head>
  <body>
    <!-- Nav Container -->
    <nav class="relative container mx-auto p-6 bg-green-600 border-yellow-300 max-w-full border-b-8">
      <!-- Flex Container For All Items -->
      <div class="flex items-center justify-between mx-12">
        <!-- Flex Container For Logo/Menu -->
        <div class="flex items-center space-x-20">
          <!-- Logo -->
          <a href="/dashboard"><img class="w-80" src="images/Logo.png" alt="" /></a>
        </div>

        @php

          $id = Auth::user()->id;
          $adminData = App\Models\User::find($id);
          $adminDataDisplay = explode(" ", $adminData->first_name);

        @endphp

        <!-- Right Buttons Menu -->
        <div class="profile-menu space-x-8 tracking-wider font-bold lg:flex">
          <ul>
            <li>
            <button
            class="z-20 flex h-11 items-center justify-center rounded-full bg-white px-2 text-slate-600 hover:bg-slate-100 duration:200"
          >
            <img
              src="{{ asset('images/R.png') }}"
              alt=""
              class="h-8 w-8 rounded-full object-cover"
            />
            <span class="pl-2 text-sm">{{ $adminDataDisplay[0] }}</span>
            <i class="fa-solid fa-chevron-down mx-2"></i>
          </button>

          <div class="dropdown shadow-2xl">
            <ul>
              <li class="pb-4 hover:text-slate-500 duration-200">
                <a href="#" class="text-xs"><i class="fas fa-user fa-xl"></i> Profile</a>
              </li>
              <li class="pb-4 hover:text-slate-500 duration-200">
                <a href="#" class="text-xs"><i class="fas fa-sliders-h"></i>Settings</a>
              </li>
              <li class="pb-4 hover:text-slate-500 duration-200">
                <form action="{{ route('logout') }}" method="POST">
                  @csrf
                <button class="text-xs"><i class="fas fa-sign-out-alt"></i> Logout</button>
                </form>
              </li>
            </ul>
          </div>
        </li>
        </ul>
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
      
            <div class="slider">
              <div class="slide">
                <img class="brightness-50" src="images/pnc1.jpg" alt="Photo 1" />
                <h1 class="absolute font-bold mt-40 text-white text-lg text-center md:text-xl lg:text-3xl xl:text-7xl tracking-wider mb-4" style="text-shadow: 2px 1px #000; line-height: 80px;">Theses and Capstone <span class="block">Projects Archiving</span> System</h1>
            </div>
              <div class="slide">
                <img class="brightness-50" src="images/pnc2.jpg" alt="Photo 2" />
                <h1 class="absolute font-bold mt-40 text-white text-lg text-center md:text-xl lg:text-3xl xl:text-7xl tracking-wider mb-4" style="text-shadow: 2px 1px #000; line-height: 80px;">Theses and Capstone <span class="block">Projects Archiving</span> System</h1>
                </div>
              <div class="slide">
                <img class="brightness-50" src="images/pnc3.jpg" alt="Photo 3" />
                <h1 class="absolute font-bold mt-40 text-white text-lg text-center md:text-xl lg:text-3xl xl:text-7xl tracking-wider mb-4" style="text-shadow: 2px 1px #000; line-height: 80px;">Theses and Capstone <span class="block">Projects Archiving</span> System</h1>
                </div>
              <div class="slide">
                <img class="brightness-50" src="images/pnc4.jpg" alt="Photo 4" />
                <h1 class="absolute font-bold mt-40 text-white text-lg text-center md:text-xl lg:text-3xl xl:text-7xl tracking-wider mb-4" style="text-shadow: 2px 1px #000; line-height: 80px;">Theses and Capstone <span class="block">Projects Archiving</span> System</h1>
                </div>
              <button class="slider__btn slider__btn--left"><i class="fa-solid fa-chevron-left fa-sm"></i></button>
              <button class="slider__btn slider__btn--right"><i class="fa-solid fa-chevron-right fa-sm"></i></button>
              <div class="dots"></div>
            </div>


    {{-- <!-- Hero Section -->
    <section id="hero">
      <!-- Hero Container -->
      <div class="container flex flex-col-reverse mx-auto p-6 lg:flex-row max-w-7xl mt-20">
        <!-- Content Container -->
        <div class="flex flex-col space-y-10 mb-44 lg:mt-16 lg:w-1/2 xl:mb-52">
          <h1
            class="text-5xl font-bold text-center lg:text-6xl lg:max-w-md lg:text-left"
          >
            More than just shorter links
          </h1>
          <p
            class="text-2xl text-center text-gray-400 lg:max-w-md lg:text-left"
          >
            Build your brand's recognition and get detailed insights on how your
            links are performing.
          </p>
          <div class="mx-auto lg:mx-0">
            <a
              href="#"
              class="py-5 px-10 text-2xl font-bold text-white bg-cyan rounded-full lg:py-4 hover:opacity-70"
              >Get Started</a
            >
          </div>
        </div>

        <!-- Image -->
        <div class="mb-24 mx-auto md:w-180 lg:mb-0 lg:w-1/2">
          <img src="images/illustration-working.svg" alt="" />
        </div> --}}
  </body>
</html>
