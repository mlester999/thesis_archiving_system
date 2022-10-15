<!-- Header -->
<nav class="bg-green-600 shadow-md">
    <div class="mx-auto">
        <div class="flex justify-between py-2 px-8">
            <div class="flex items-center space-x-2 font-bold text-gray-400">
                <img class="max-w-xs" src="/images/Logo.png" alt="">
            </div>

            <div class="hidden md:flex space-x-4">
                <div class="hidden md:flex">
                    <input type="text" class="lg:w-96 sm:w-48 h-10 mt-2 bg-gray-100 rounded-md px-4 focus:outline-none" placeholder="Search">
                </div>
            </div>

             <!-- Hamburger Button -->
        <button
        id="menu-btn"
        class="block hamburger md:hidden focus:outline-none mt-5"
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
        class="absolute md:hidden hidden p-6 rounded-lg bg-darkViolet left-6 right-6 top-20 z-100"
        >
        <div
            class="flex flex-col items-center justify-center w-full space-y-6 font-bold text-white rounded-sm"
        >
        <a href="#" class="w-full text-center">Features</a>
        <a href="#" class="w-full text-center">Pricing</a>
        <a href="#" class="w-full text-center">Resources</a>
        <a href="#" class="w-full pt-6 border-t border-gray-400 text-center"
        >Login</a
        >
        <a href="#" class="w-full py-3 text-center rounded-full bg-cyan"
        >Sign Up</a
        >
        </div>
    </div>
        </div>
    </div>
</nav>

<div class="hidden mobile-menu">
    <ul class="font-bold text-slate-600 items-center">
        <li class="block text-md px-2 py-4 hover:bg-green-500 transition duration-300">Features</li>
        <li class="block text-md px-2 py-4 hover:bg-green-500 transition duration-300">Pricing</li>
        <li class="block text-md px-2 py-4 hover:bg-green-500 transition duration-300">Sign In</li>
        <li class="block text-md px-2 py-4 text-slate-400">or</li>
        <li class="block text-md px-2 py-4 hover:bg-green-500 transition duration-300">Sign Up</li>
    </ul>
</div>
