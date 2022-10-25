@php
$id = Auth::guard('admin')->user()->id;
$adminData = App\Models\Admin::find($id);
$adminDataDisplay = explode(" ", $adminData->first_name);

@endphp

<!-- Header -->
<nav class="bg-green-600 shadow-md">
    <div class="mx-auto">
        <div class="flex justify-between py-2 px-12">
            <div class="flex items-center space-x-2 font-bold text-gray-400">
                <img class="max-w-xs" src="/images/Logo.png" alt="">
            </div>

            <li class="flex-1 hidden md:flex md:flex-none md:mt-2 space-x-4 list-none">
                <div x-data="{open: false}" x-on:click.outside="open = false" class="relative inline-block">
                  <button
                    x-on:click="open = !open"
                    class="drop-button text-white py-2 px-2"
                  >
                    <span class="pr-2"><i class="fa-solid fa-user"></i></span>
                    Hello, {{ $adminDataDisplay[0] }}
                    <svg
                      class="h-3 fill-current inline"
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 20 20"
                    >
                      <path
                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
                      />
                    </svg>
                  </button>
                  <div
                    x-show="open"
                    x-cloak
                    class="absolute shadow-lg bg-white rounded text-black right-0 mt-3 w-48 overflow-auto z-30"
                  >

                    <a
                      href="{{ route('admin.profile') }}"
                      class="p-2 hover:bg-slate-300 text-black text-sm no-underline hover:no-underline block"
                      ><i class="fa-solid fa-fw fa-user-gear ml-4 mt-2"></i> View Profile</a
                    >
                    <a
                      href="{{ route('admin.change.password') }}"
                      class="p-2 hover:bg-slate-300 text-black text-sm no-underline hover:no-underline block"
                      ><i class="fa-solid fa-fw fa-lock ml-4 mt-2"></i> Change Password</a
                    >
                    <a
                      href="#"
                      class="p-2 hover:bg-slate-300 text-black text-sm no-underline hover:no-underline block"
                      ><i class="fa fa-cog fa-fw ml-4 mt-2"></i> Settings</a
                    >
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                    <button
                      href="#"
                      class="p-2 w-full text-left hover:bg-slate-300 text-red-500 text-sm no-underline hover:no-underline block"
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
