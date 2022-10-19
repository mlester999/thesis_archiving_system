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

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Alata&family=Poppins:wght@400;500;700&display=swap"
      rel="stylesheet"
    />

    <!-- Toaster -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >

    <!-- Scripts -->
    @vite(['resources/css/adminApp.css', 'resources/js/adminApp.js'])

    <title>PNC Library Dashboard</title>

    @livewireStyles
  </head>
  <body class="bg-slate-100">
    <!-- Begin page -->
      @include('admin.body.header')
      
      <div class="flex">
          @include('admin.body.sidebar')

          <livewire:user-list /> 
          
      </div>
      <!-- end main content-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
 @if(Session::has('message'))
 var type = "{{ Session::get('alert-type','info') }}"
 switch(type){
    case 'info':
    toastr.info(" {{ Session::get('message') }} ");
    break;

    case 'success':
    toastr.success(" {{ Session::get('message') }} ");
    break;

    case 'warning':
    toastr.warning(" {{ Session::get('message') }} ");
    break;

    case 'error':
    toastr.error(" {{ Session::get('message') }} ");
    break; 
 }
 @endif 

    $('.settings-btn').click(function(){
        $(this).toggleClass("click");
        $('.sidebar').toggleClass("show");
        });
        $('.feat-btn').click(function(){
            $('nav ul .feat-show').toggleClass("show");
            $('nav ul .first').toggleClass("rotate");
        });
        $('.serv-btn').click(function(){
            $('nav ul .serv-show').toggleClass("show1");
            $('nav ul .second').toggleClass("rotate");
        });
        $('nav ul li').click(function(){
            $(this).addClass("active").siblings().removeClass("active");
        });

    /*Toggle dropdown list*/
    function toggleDD(myDropMenu) {
        document.getElementById(myDropMenu).classList.toggle("invisible");
        }
        /*Filter dropdown options*/
        function filterDD(myDropMenu, myDropMenuSearch) {
        var input, filter, ul, li, a, i;
        input = document.getElementById(myDropMenuSearch);
        filter = input.value.toUpperCase();
        div = document.getElementById(myDropMenu);
        a = div.getElementsByTagName("a");
        for (i = 0; i < a.length; i++) {
            if (a[i].innerHTML.toUpperCase().indexOf(filter) > -1) {
            a[i].style.display = "";
            } else {
            a[i].style.display = "none";
            }
        }
        }
        // Close the dropdown menu if the user clicks outside of it
        window.onclick = function (event) {
        if (
            !event.target.matches(".drop-button") &&
            !event.target.matches(".drop-search")
        ) {
            var dropdowns = document.getElementsByClassName("dropdownlist");
            for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (!openDropdown.classList.contains("invisible")) {
                openDropdown.classList.add("invisible");
            }
            }
        }
        };
</script>
@livewireScripts

</body>
</html>
