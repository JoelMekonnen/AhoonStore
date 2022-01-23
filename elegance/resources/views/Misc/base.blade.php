<!DOCTYPE html>
<html>
     <head>
         <meta charset="utf-8">
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <title>Elegance: Shop in style and luxory</title>
         <link rel="stylesheet" href="{{asset("assets/css/adminlte.css")}}">
         <link rel="stylesheet" href="{{asset("assets/css/alt/adminlte.components.css")}}">
         <link rel = "stylesheet" href = "{{asset('assets/css/bootstrap.min.css')}}">
         <link rel = "stylesheet" href = "{{asset('assets/css/mdb.min.css')}}">
         <link rel = "stylesheet" href = "{{asset('assets/css/Config.css')}}">
         <link rel = "stylesheet" href = "{{asset('assets/css/all.min.css')}}">
         <link rel = "stylesheet" href = "{{asset('assets/css/fontawesome.min.css')}}">
         {{--       <link rel = "stylesheet" href = "{{asset('assets/css/fontawesome.css')}}">--}}
         <link rel = "stylesheet" href = "{{asset('assets/css/material-icons.css')}}">
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
         <link rel="preconnect" href="https://fonts.googleapis.com">
         <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
               rel="stylesheet">
         <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
         <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;400&family=Montserrat&family=Roboto:wght@100;400&family=Source+Sans+Pro:ital,wght@0,300;0,400;1,400&display=swap" rel="stylesheet">
         <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
         <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;700&display=swap" rel="stylesheet">
         <link href="https://fonts.googleapis.com/css2?family=Waterfall&display=swap" rel="stylesheet">
         <link href="https://fonts.googleapis.com/css2?family=Twinkle+Star&display=swap" rel="stylesheet">
         <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
     </head>
     <body>
     <nav class="navbar navbar-expand-lg  navbar-light" id="myNav">
         <a class="nav-brand nav-link myBrand mx-auto" href="#"><img src="{{asset('assets/Images/Ahoon_v.png')}}" alt="logo" width="100px" height="100px"/></a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarNav">
             <ul class="navbar-nav ml-auto" id="navContainer">
                 <li class="nav-item navList">
                     <a class="nav-link" href="{{ route('index') }}">Home</a>
                 </li>
                 <li class="nav-item navList">
                     <a class="nav-link" href="#">Products</a>
                 </li>
                 @guest
                     <li class="nav-item navList">
                         <a class="nav-link" href="{{ route('login') }}">Log In</a>
                     </li>
                 @endguest
                 <li class="nav-item navList">
                     <a class="nav-link" href="#">About us</a>
                 </li>
                 @auth
                     <li class="nav-item navList">
                         <form id="frm-logout" action="{{ route('logout') }}" method="POST">
                             @csrf
                             <button type="submit" class="btn btn-orange">logout</button>
                         </form>
                     </li>
                 @endauth
             </ul>
         </div>
     </nav>
     <div class="container-fluid" style="padding:0% !important;">
         @yield('body')
     </div>
     <script src="{{asset('assets/js/jquery-3.4.1.min.js')}}"></script>
     <script src="{{asset('assets/js/popper.min.js')}}"></script>
     <script src="{{asset('assets/js/Config.js')}}"></script>
     <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
     <script src="{{asset('assets/js/jquery.aniview.js')}}"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
     <script src="{{asset('assets/js/adminlte.js')}}"></script>
     <script>
         var options = {
             animateClass: 'animate__animated', // for v3 or 'animate__animated' for v4
             animateThreshold: 100,
             scrollPollInterval: 20
         }
         $('.aniview').AniView(options);
     </script>
      </body>
</html>
