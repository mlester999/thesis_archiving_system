<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

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

            <div class="w-full min-h-screen p-6 absolute z-20">
                
                <div class="outline outline-white outline-1 w-11/12 md:w-5/6 2xl:w-5/6 absolute top-1/3 mt-32 left-1/2 transform -translate-x-1/2 -translate-y-1/2 backdrop-blur-md bg-white/30 rounded-lg md:p-20 p-10">
                    
                    <h1 class="font-bold text-white text-lg text-center md:text-xl lg:text-3xl xl:text-4xl tracking-wider mb-4" style="text-shadow: 2px 1px #000;">Theses and Capstone Projects Archiving System</h1>
                
                    {{-- Cards Container --}}
                    <div class="flex flex-wrap justify-center md:mt-10">
        
                        <div class="flex flex-col bg-white rounded-lg shadow-md w-full m-6 overflow-hidden sm:w-48 md:w-48 lg:w-72 xl:w-72">
    
                            <i class="fa-solid fa-user-shield fa-5x font-size-24 h-20 m-6 text-center"></i>
            
                            <h2 class="text-center px-2 pb-5">Log in as Admin</h2>  
                            
                            @if (Route::has('admin.login'))

                                @auth('admin')
                                    <a href="{{ url('admin/dashboard') }}" class="bg-green-600 text-white p-3 text-center hover:bg-opacity-90 transition-all duration-150">Dashboard</a>
                                @else
                                    <a href="{{ route('admin.login') }}" class="bg-green-600 text-white p-3 text-center hover:bg-opacity-90 transition-all duration-150">Login</a>
                                @endauth
                            @endif
            
                        </div>
            
                        <div class="flex flex-col bg-white rounded-lg shadow-md w-full m-6 overflow-hidden sm:w-48 md:w-48 lg:w-72 xl:w-72">
            
                            <i class="fa-solid fa-user fa-5x font-size-24 h-20 m-6 text-center"></i>

                            <h2 class="text-center px-2 pb-5">Log in as Student</h2>  

                            @if (Route::has('login'))

                                @auth
                                    <a href="{{ url('/home') }}" class="bg-green-600 text-white p-3 text-center hover:bg-opacity-90 transition-all duration-150">Dashboard</a>
                                @else
                                    <a href="{{ route('login') }}" class="bg-green-600 text-white p-3 text-center hover:bg-opacity-90 transition-all duration-150">Login</a>
                                @endauth
                            @endif

                        </div>
                    </div>
                </div>
            </div>
    </body>
</html>
