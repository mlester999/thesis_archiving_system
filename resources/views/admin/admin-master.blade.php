{{-- <x-admin-layout>
</x-admin-layout> --}}
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="">
	<meta name="keywords" content="">
    <link
      rel="shortcut icon"
      type="image/png"
      href="images/favicon-32x32.png"
    />

    <link rel="shortcut icon" href="{{ asset('library_icon.ico') }}">

    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.3/dist/flowbite.min.css" />

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Alata&family=Poppins:wght@400;500;700&display=swap"
      rel="stylesheet"
    />

    <!-- Scripts -->
    @vite(['resources/css/adminApp.css', 'resources/js/adminApp.js'])

    <title>PNC Library Dashboard</title>
  </head>
  <body class="bg-slate-100">
    <!-- Begin page -->
      @include('admin.body.header')

      <div class="flex">
          @include('admin.body.sidebar')

          @yield('admin')
          
      </div>
      <!-- end main content-->
      @include('sweetalert::alert')
</div>

<script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>

</body>
</html>
