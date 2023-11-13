<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel Portfolio') }}{{isset($page_title) ? ' - ' . $page_title : ''}}</title>

    <!-- Fontawesome 6 cdn -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css'
        integrity='sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=='
        crossorigin='anonymous' referrerpolicy='no-referrer' />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>
    <div id="app">


        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                    <div class="logo">
                        <svg style="width: 60px" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <style>
                                    .cls-1 {
                                        fill: #eee;
                                    }

                                    .cls-2 {
                                        fill: #c1dbdc;
                                    }

                                    .cls-10,
                                    .cls-2,
                                    .cls-3,
                                    .cls-5,
                                    .cls-6,
                                    .cls-7,
                                    .cls-8,
                                    .cls-9 {
                                        stroke: #4c241d;
                                        stroke-linecap: round;
                                        stroke-linejoin: round;
                                        stroke-width: 2px;
                                    }

                                    .cls-3 {
                                        fill: none;
                                    }

                                    .cls-4 {
                                        fill: #4c241d;
                                    }

                                    .cls-5 {
                                        fill: #fff;
                                    }

                                    .cls-6 {
                                        fill: #e2e2e2;
                                    }

                                    .cls-7 {
                                        fill: #9dc1e4;
                                    }

                                    .cls-8 {
                                        fill: #bd53b5;
                                    }

                                    .cls-9 {
                                        fill: #a9ba5a;
                                    }

                                    .cls-10 {
                                        fill: #6b4f5b;
                                    }
                                </style>
                            </defs>
                            <g id="portfolio">
                                <circle class="cls-1" cx="22.5" cy="24.5" r="21.5" />
                                <path class="cls-2" d="M5.5824,15A.5823.5823,0,0,0,5,15.5824V46H52V15Z" />
                                <circle class="cls-3" cx="47" cy="8" r="2" />
                                <circle class="cls-4" cx="25.0992" cy="8.5232" r="1.0691" />
                                <line class="cls-3" x1="8.5509" x2="11.5509" y1="5.0547" y2="8.0547" />
                                <line class="cls-3" x1="11.5509" x2="8.5509" y1="5.0547" y2="8.0547" />
                                <path class="cls-5"
                                    d="M5,46H61a0,0,0,0,1,0,0v6.4176A.5824.5824,0,0,1,60.4176,53H5.5824A.5824.5824,0,0,1,5,52.4176V46A0,0,0,0,1,5,46Z" />
                                <line class="cls-3" x1="23" x2="43" y1="61" y2="61" />
                                <rect class="cls-6" height="8" width="14" x="26" y="53" />
                                <rect class="cls-7" height="12" width="16" x="10" y="22" />
                                <rect class="cls-8" height="8" width="16" x="10" y="38" />
                                <circle class="cls-4" cx="9.0992" cy="18.5232" r="1.0691" />
                                <circle class="cls-4" cx="12.0992" cy="18.5232" r="1.0691" />
                                <circle class="cls-4" cx="15.0992" cy="18.5232" r="1.0691" />
                                <line class="cls-3" x1="31" x2="36" y1="23" y2="23" />
                                <line class="cls-3" x1="31" x2="40" y1="26" y2="26" />
                                <line class="cls-3" x1="31" x2="40" y1="39" y2="39" />
                                <line class="cls-3" x1="31" x2="35" y1="42" y2="42" />
                                <rect class="cls-9" height="4" rx="2" width="14" x="31" y="30" />
                                <line class="cls-3" x1="49" x2="49" y1="22" y2="30" />
                                <path class="cls-10" d="M60.4176,15H52V46h9V15.5824A.5823.5823,0,0,0,60.4176,15Z" />
                            </g>
                        </svg>
                        {{isset($page_title) ? ' ' . $page_title : 'Portfolio'}}
                    </div>
                    {{-- layouts/app --}}
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">{{ __('Home') }}</a>
                        </li>
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
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('admin') }}">{{ __('Dashboard') }}</a>
                                    <a class="dropdown-item" href="{{ url('profile') }}">{{ __('Profile') }}</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="">
            @yield('content')
        </main>
    </div>
</body>

</html>
