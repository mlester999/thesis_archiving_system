<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="cache-control" content="private, max-age=0, no-cache">
        <meta http-equiv="pragma" content="no-cache">
        <meta http-equiv="expires" content="0">

        <title>PNC Library</title>

        <link rel="shortcut icon" href="{{ asset('images/library_pnc.ico') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Oxygen:wght@300;400;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

        <!-- Font Awesome CDN -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="body-bg h-screen bg-slate-600 overflow-hidden antialiased">

            <img src="./images/background.jpg" alt="" class="h-screen brightness-50 absolute z-0">

            <div class="w-full min-h-screen px-6 flex flex-col justify-center items-center absolute z-20">
                
                <div class="outline outline-white outline-1 flex flex-col backdrop-blur-md bg-white/30 rounded-lg md:px-20 md:py-8 py-4 px-8">

                    <img class="w-24 sm:w-24 md:w-32 mx-auto mb-4 mt-1 md:mt-0 md:mb-8" src="{{ asset('images/library_logo.png') }}" alt="" />
                    
                    <h1 class="font-bold text-white text-lg sm:text-2xl text-center md:text-3xl lg:text-4xl tracking-wider" style="text-shadow: 2px 1px #000;">Theses and Capstone Projects Archiving System</h1>
                
                    {{-- Cards Container --}}
                    <div class="flex flex-wrap justify-center md:mt-10">
        
                        <div class="flex flex-col bg-white rounded-lg shadow-md w-full my-4 mx-6 lg:mx-8 overflow-hidden md:w-56 lg:w-72 xl:w-72">
    
                            <x-ri-admin-fill class="h-16 md:h-24 mt-4 mb-3" />
            
                            <h2 class="text-center px-2 pb-5">Log in as Admin</h2>  
                            
                            @if (Route::has('admin.login'))

                                @auth('admin')
                                    <a href="{{ url('admin/dashboard') }}" class="bg-green-600 text-white p-2 md:p-3 text-center hover:bg-opacity-90 transition-all duration-150">Dashboard</a>
                                @else
                                    <a href="{{ route('admin.login') }}" class="bg-green-600 text-white p-2 md:p-3 text-center hover:bg-opacity-90 transition-all duration-150">Login</a>
                                @endauth
                            @endif
            
                        </div>
            
                        <div class="flex flex-col bg-white rounded-lg shadow-md w-full my-4 mx-6 lg:mx-8 overflow-hidden md:w-56 lg:w-72 xl:w-72">
            
                            <x-ri-user-3-fill class="h-16 md:h-24 mt-4 mb-3" />

                            <h2 class="text-center px-2 pb-5">Log in as Student</h2>  

                            @if (Route::has('login'))

                                @auth
                                    <a href="{{ url('/home') }}" class="bg-green-600 text-white p-2 md:p-3 text-center hover:bg-opacity-90 transition-all duration-150">Dashboard</a>
                                @else
                                    <a href="{{ route('login') }}" class="bg-green-600 text-white p-2 md:p-3 text-center hover:bg-opacity-90 transition-all duration-150">Login</a>
                                @endauth
                            @endif

                        </div>
                    </div>
                </div>
            </div>
    </body>
</html>
