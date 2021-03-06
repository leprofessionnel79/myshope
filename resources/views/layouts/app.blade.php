<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <script src="https://kit.fontawesome.com/497760f0f8.js" crossorigin="anonymous"></script>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <a class="nav-link" href="{{ route('units') }}">{{ __('Unit') }}</a>
                        <a class="nav-link" href="{{ route('products') }}">{{ __('Products') }}</a>
                        <a class="nav-link" href="{{ route('reviews') }}">{{ __('Reviews') }}</a>
                        <a class="nav-link" href="{{ route('tickets') }}">{{ __('Tickets') }}</a>
                        <a class="nav-link" href="{{ route('tags') }}">{{ __('Tags') }}</a>
                        <a class="nav-link" href="{{ route('categories') }}">{{ __('Categories') }}</a>
                        <a class="nav-link" href="{{ route('countries') }}">{{ __('Countries') }}</a>
                        <a class="nav-link" href="{{ route('cities') }}">{{ __('Cities') }}</a>
                        <a class="nav-link" href="{{ route('states') }}">{{ __('States') }}</a>
                        <a class="nav-link" href="{{ route('roles') }}">{{ __('Roles') }}</a>
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
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="{{ route('tags') }}">

                                        {{ __('Tags') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('products') }}">

                                        {{ __('Products') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('reviews') }}">

                                        {{ __('Reviews') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('tickets') }}">

                                        {{ __('Tickets') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('categories') }}">

                                        {{ __('Categories') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('units') }}">

                                     {{ __('Units') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('countries') }}">

                                        {{ __('Countries') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('cities') }}">

                                        {{ __('Cities') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('states') }}">

                                        {{ __('States') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('roles') }}">

                                        {{ __('Roles') }}
                                    </a>


                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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


    {{-- <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> --}}

    <script src="{{ asset('js/app.js') }}"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    @yield('scripts')
</body>
</html>
