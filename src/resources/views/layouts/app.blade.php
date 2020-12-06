<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Instagram</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-sm navbar-light bg-white d-none d-sm-flex border border-top-0 py-0">
            <a class="navbar-brand instaFont ml-5 py-0" href="{{ url('/') }}">
                Instagram
            </a>
              <ul class="nav navbar-nav ml-auto" style="margin-right: 10rem">
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
                <a class="nav-link dropdown-toggle py-0" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="w-100 mr-3 py-1" src="/img/heart-off.svg" alt="notifications" />
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <div class="dropdown-item">
                        test
                    </div>
                </div>
              </li>

                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle py-0" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="w-100 rounded-circle" style="max-width: 2rem;" src={{ Auth::user()->profile->profileImage() }} alt={{ Auth::user()->username }} />
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="/{{ Auth::user()->username }}">
                        Profile
                    </a>
                    <a class="dropdown-item" href="/like/p/all">
                        Likes
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
          </nav>

          <!-- SMALLER SCREENS -->

          <nav class="navbar navbar-light bg-white d-sm-none px-1 mt-n3  border border-top-0" style="height: 3.8rem">
            <a class="navbar-brand instaFont mx-auto" href="{{ url('/') }}">
                Instagram
            </a>
          </nav>

          <nav class="fixed-bottom navbar-light bg-white d-sm-none border border-bottom-0">
            <ul class="nav navbar-nav mx-auto">
                @guest
                <div class="btn-group mx-auto">
                <li class="nav-item mr-3">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
                </div>
            @else
            <div class="btn-group">
            <li class="nav-item dropup mr-auto pl-3">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="" style="width: 1.5rem" src="/img/heart-off.svg" alt="notifications" />
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <div class="dropdown-item">
                        test
                    </div>
                </div>
              </li>

                <li class="nav-item dropup ml-auto pr-3">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle" style="max-width: 2rem;" src={{ Auth::user()->profile->profileImage() }} alt={{ Auth::user()->username }} />
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="/{{ Auth::user()->username }}">
                        Profile
                    </a>
                    <a class="dropdown-item" href="/like/p/all">
                        Likes
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
            </div>
            @endguest
              </ul>
          </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
