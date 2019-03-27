<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Flux') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('../js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="../js/ajax.js"></script>
    
    <script>    
        // this is for search bar functionality
        $(document).on('keyup', '#search', function() {
            $value = $(this).val();
            $search  = '{{URL('search')}}';
            setRequest($search,$value).done(function(data){
                $('#table tbody').html(data);    
            })
        })
        $(document).click(function(){
            $('#table tbody').html('');
        })
           
    </script>

    <style>
        #table {
            position: fixed;
            background-color: white;
            z-index: 99;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
        }

        #table tbody tr:hover {
            background-color: #f7f7f7;
            cursor: pointer;
        }

        #container {
            margin: 0px auto;
            width: 500px;
            height: 375px;
            border: 10px #333 solid;
        }

        #videoElement {
            width: 500px;
            height: 375px;
            background-color: #666;
        }

        .image-input {
            max-width: 80%;
            font-weight: 700;
            text-overflow: ellipsis;
            white-space: nowrap;
            cursor: pointer;
            display: inline-block;
            color: #d3394c;
            border: 2px solid #2073b8;
            color: #2176bd;
            overflow: hidden;
            padding: 0.3rem 1rem;
        }
    </style>

    <title>PhotoShow</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.5.3/css/foundation.css">

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <u1 class="menu">
                    @if(Request::is('register') || Request::is('login'))
                      <li class="menu-text">Flux</li>
                      <li><a href="/">Home</a></li>
                    @else
                      <li class="menu-text">Flux</li>
                      <li><a href="/home">Home</a></li>
                      <li><a href="/home/show">Photo</a></li>
                    @endif
                </u1>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif @else
                        <li class="nav-item">
                            <input type="text" class="form-control" id="search" name="search" autocomplete="off">
                            <table id="table">
                                <tbody>
                                </tbody>
                            </table>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                </form>
                                <form id="profile-form" action="{{ route('home') }}" method="GET">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

</body>

</html>