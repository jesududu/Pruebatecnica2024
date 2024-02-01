<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
  
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel='stylesheet' href='https://unpkg.com/js-year-calendar@latest/dist/js-year-calendar.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://unpkg.com/bootstrap-datepicker@1.8.0/dist/css/bootstrap-datepicker.standalone.min.css'>
    
    <!-- Styles -->
    <link href="{{ asset('css/global.css') }}" rel="stylesheet">
    <script src='https://unpkg.com/js-year-calendar@latest/dist/js-year-calendar.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
    <script src='https://unpkg.com/popper.js@1.14.7/dist/umd/popper.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js'></script>
    <script src="https://unpkg.com/js-year-calendar@latest/locales/js-year-calendar.es.js"></script>
</head>
<body>
<nav class="navbar navbar-midnight-blue">
        <ul >
            <li class="nav-item "><img style="width:127px"  src="{{URL::asset('images/02-v1-blanco.png')}}" alt=""></li>
            <li class="nav-item">
                <a href="#" class="sidebar-icon" id="btn-sidebars">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </a>
            </li>
        </ul>
        <ul>
            <!-- Authentication Links -->
            @guest
                @if (Route::has('login'))
                    <li class="nav-item ml-auto">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @endif

                @if (Route::has('register'))
                    <li class="nav-item ml-auto">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown ml-auto">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul> 
    </body>
   
        
    </nav>
    <!--end nav -->
    <!--start main sidebar-->
    <div id="sidebar" class="main-sidebar navbar-midnight-blue show-sidebar">

        <ul class="navbar">
            <li class="active">
                <span>PRUEBA TECNICA 2024</span>
            </li>
            <li><a href="{{ route('index') }}"><i class="fa fa-id-card" aria-hidden="true"></i> Inicio</a></li>
            <li><a href="{{ route('users.index') }}"><i class="fa fa-id-card" aria-hidden="true"></i> Gestion Usuarios</a></li>
            <li><a href="{{ route('holidays.index') }}"><i class="fa fa-id-card" aria-hidden="true"></i> Gestion Dias Festivos</a></li>

           
        </ul>
    </div>
    <!--end  main sidebar-->
    <!--HERE CONTENT -->
    <div class="container-fluid">
        <div class="content" id="content">
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                        </ol>
                    </nav>
        <script>
        /**
 * index.js
 * - All our useful JS goes here, awesome!
 */
 (function ($) {

var a = 0;
$('#btn-sidebars').on('click', function (e) {
    e.preventDefault();
    if (a == 0){
        a = 1;
        $('#content').removeClass('content')
        $('.main-sidebar').removeClass('show-sidebar').addClass('hide-sidebar');
    }else if (a  == 1) {
        a = 0;
        $('#content').addClass('content')
        $('.main-sidebar').removeClass('hide-sidebar').addClass('show-sidebar');
    }
});

}(jQuery))
            
        </script>
            @yield('content')
        </main>
    </div>
</body>
</html>