{{-- <x-admin-layout>
</x-admin-layout> --}}
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

    <script src="https://cdn.jsdelivr.net/npm/chart.js" defer></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- Scripts -->
    @vite(['resources/css/adminApp.css', 'resources/js/adminApp.js'])

    <title>PNC Library Dashboard</title>
  </head>
  <body class="bg-slate-100">
    
    <!-- Navigation -->
    <nav class="bg-slate-900 shadow-md">
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

    <div class="flex">
    <!-- Sidebar -->
    <div class="z-20 flex-shrink-0 h-screen hidden w-64 overflow-y-auto bg-white shadow-2xl md:block">
        <div class="bg-slate-900 h-20 w-64 py-3 px-5">
            <div class="flex space-x-4 bg-green-400 p-1 rounded-md h-12 w-12">
            <img src="/images/R.png" class="flex rounded-md" alt="Admin Photo">

            <div class="flex flex-col">
                <h3 class="text-white font-bold uppercase text-base">Admin</h3>
                <h4 class="text-white text-light">Mark</h4>
            </div>
        </div>
    </div>

    <div class="flex flex-col p-4 text-gray-500 text-md space-y-3 font-medium">
            <p class="uppercase text-gray-400 tracking-wider">Menu</p>
            <a href="" class="flex hover:text-gray-700 space-x-2 p-2 active:text-blue-500"> <x-ri-dashboard-line class="w-5 mr-3" /> Dashboard</a>
            <a href="" class="flex hover:text-gray-700 space-x-2 p-2"> <x-ri-inbox-archive-fill class="w-5 mr-3" /> Archives List</a>
            <a href="" class="flex hover:text-gray-700 space-x-2 p-2"> <x-ri-mac-line class="w-5 mr-3" /> Access List</a>
            <a href="" class="flex hover:text-gray-700 space-x-2 p-2"> <x-ri-account-circle-line class="w-5 mr-3" /> Student List</a>
            
            <hr>

            <p class="uppercase text-gray-400 tracking-wider">Maintenance</p>
            <a href="" class="flex hover:text-gray-700 space-x-2 p-2"> <x-ri-list-check-2 class="w-5 mr-3" /> Department List</a>
            <a href="" class="flex hover:text-gray-700 space-x-2 p-2"> <x-ri-file-list-3-line class="w-5 mr-3" /> Curriculum List</a>
            <a href="" class="flex hover:text-gray-700 space-x-2 p-2"> <x-ri-profile-line class="w-5 mr-3" /> User List</a>
            <a href="" class="flex hover:text-gray-700 space-x-2 p-2"> <x-ri-settings-3-line class="w-5 mr-3" /> Settings</a>
            <a href="{{ route('admin.logout') }}" class="flex hover:text-gray-700 space-x-2 p-2"> <x-ri-logout-box-r-line class="w-5 mr-3" /> Logout</a>

        </div>
    </div>

    <!-- Content -->
    <div class="bg-slate-200 h-screen w-full overflow-y-auto">
        <div class="px-8 py-4">
            <h5 class="pb-6 pt-3 font-bold uppercase">Dashboard</h5>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-8">

                {{-- First Container --}}
                <div class="p-6 bg-white rounded-lg flex items-center h-32 shadow-md">
                    <div class="w-3/5 flex justify-start">

                        <ul>
                            <li class="font-bold text-gray-400">Department List</li>
                            <li class="font-extrabold text-slate-800 text-xl">12</li>
                        </ul>

                    </div>

                    <div class="w-2/5 flex justify-end">
                        <x-ri-file-list-3-fill class="bg-gray-300 rounded-lg p-2 w-12" />
                    </div>
                </div>

                {{-- Second Container --}}
                <div class="p-6 bg-white rounded-lg flex items-center h-32 shadow-md">
                    <div class="w-3/5 flex justify-start">

                        <ul>
                            <li class="font-bold text-gray-400">Curriculum List</li>
                            <li class="font-extrabold text-slate-800 text-xl">12</li>
                        </ul>

                    </div>

                    <div class="w-2/5 flex justify-end">
                        <x-ri-list-check-2 class="bg-gray-300 rounded-lg p-2 w-12" />
                    </div>
                </div>

                {{-- Third Container --}}
                <div class="p-6 bg-white rounded-lg flex items-center h-32 shadow-md">
                    <div class="w-3/5 flex justify-start">

                        <ul>
                            <li class="font-bold text-gray-400">Verified Students</li>
                            <li class="font-extrabold text-slate-800 text-xl">1698</li>
                        </ul>

                    </div>

                    <div class="w-2/5 flex justify-end">
                        <x-ri-user-follow-fill class="bg-gray-300 rounded-lg p-2 w-12" />
                    </div>
                </div>

                {{-- Fourth Container --}}
                <div class="p-6 bg-white rounded-lg flex items-center h-32 shadow-md">
                    <div class="w-3/5 flex justify-start">

                        <ul>
                            <li class="font-bold text-gray-400">Not Verified Students</li>
                            <li class="font-extrabold text-slate-800 text-xl">521</li>
                        </ul>

                    </div>

                    <div class="w-2/5 flex justify-end">
                        <x-ri-user-unfollow-fill class="bg-gray-300 rounded-lg p-2 w-12" />
                    </div>
                </div>

                {{-- Fifth Container --}}
                <div class="p-6 bg-white rounded-lg flex items-center h-32 shadow-md">
                    <div class="w-3/5 flex justify-start">

                        <ul>
                            <li class="font-bold text-gray-400">Approved Archives</li>
                            <li class="font-extrabold text-slate-800 text-xl">22</li>
                        </ul>

                    </div>

                    <div class="w-2/5 flex justify-end">
                        <x-ri-inbox-archive-fill class="bg-gray-300 rounded-lg p-2 w-12" />
                    </div>
                </div>

                {{-- Sixth Container --}}
                <div class="p-6 bg-white rounded-lg flex items-center h-32 shadow-md">
                    <div class="w-3/5 flex justify-start">

                        <ul>
                            <li class="font-bold text-gray-400">Pending Archives</li>
                            <li class="font-extrabold text-slate-800 text-xl">16</li>
                        </ul>

                    </div>

                    <div class="w-2/5 flex justify-end">
                        <x-ri-inbox-unarchive-fill class="bg-gray-300 rounded-lg p-2 w-12" />
                    </div>
                </div>

                <div class="rounded-lg shadow-md bg-white md:col-span-2 lg:col-span-3">
                    <div class="overflow-x-auto relative sm:rounded-lg">
                        <table class="w-screen text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                                <h5 class="p-4 font-bold">Latest Thesis File Uploaded</h5>
                                <tr>
                                    <th class="py-3 px-6">Uploader's Name</th>
                                    <th class="py-3 px-6">Title Name</th>
                                    <th class="py-3 px-6">Status</th>
                                    <th class="py-3 px-6">Curriculum</th>
                                    <th class="py-3 px-6">Upload Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-white border-b">
                                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                        Marc Rommel Briones
                                    </th>
                                    <td class="py-4 px-6">
                                        Web-Based Inventory Management System With Data Analytics and Visualization For Lola Wheng Transfi Online Store
                                    </td>
                                    <td class="py-4 px-6">
                                        Active
                                    </td>
                                    <td class="py-4 px-6">
                                        BSIT
                                    </td>
                                    <td class="py-4 px-6">
                                        14/10/2022
                                    </td>
                                </tr>
                                <tr class="bg-white border-b">
                                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                        Marc Rommel Briones
                                    </th>
                                    <td class="py-4 px-6">
                                        Web-Based Inventory Management System With Data Analytics and Visualization For Lola Wheng Transfi Online Store
                                    </td>
                                    <td class="py-4 px-6">
                                        Active
                                    </td>
                                    <td class="py-4 px-6">
                                        BSIT
                                    </td>
                                    <td class="py-4 px-6">
                                        14/10/2022
                                    </td>
                                </tr>
                                <tr class="bg-white border-b">
                                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                        Marc Rommel Briones
                                    </th>
                                    <td class="py-4 px-6">
                                        Web-Based Inventory Management System With Data Analytics and Visualization For Lola Wheng Transfi Online Store
                                    </td>
                                    <td class="py-4 px-6">
                                        Active
                                    </td>
                                    <td class="py-4 px-6">
                                        BSIT
                                    </td>
                                    <td class="py-4 px-6">
                                        14/10/2022
                                    </td>
                                </tr>
                                <tr class="bg-white border-b">
                                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                        Marc Rommel Briones
                                    </th>
                                    <td class="py-4 px-6">
                                        Web-Based Inventory Management System With Data Analytics and Visualization For Lola Wheng Transfi Online Store
                                    </td>
                                    <td class="py-4 px-6">
                                        Active
                                    </td>
                                    <td class="py-4 px-6">
                                        BSIT
                                    </td>
                                    <td class="py-4 px-6">
                                        14/10/2022
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            {{-- Footer --}}
            <div class="pt-10 flex justify-center">
                <p class="text-gray-400">PNC Library Dashboard 2022</p>
            </div>
        </div>
    </div>
</div>

</body>

</html>
