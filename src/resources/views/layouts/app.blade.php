@php
$authUser = Auth::check() ? Auth::user() : false;    
@endphp
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
              <ul class="nav navbar-nav ml-auto" style="margin-right: 5rem">
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
            <li class="nav-item dropdown px-3">
                <a class="btn btn-primary btn-lg py-0 px-2" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    +
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <div class="dropdown-item">
                        <form class="form-group" action="/story/store" enctype="multipart/form-data" method="POST">
                            @csrf
                            <label class="d-block text-center">Upload Story</label>
                            <input class="form-control-file" type="file" name="image">
                            <button class="btn btn-primary btn-block mt-1" type="submit">Upload</button>
                            @if ($errors->has('image'))                
                                <strong> {{ $errors->first('image') }}</strong>
                            @endif
                        </form>
                    </div>
                </div>
              </li>
            <li class="nav-item">
               <a href="/"> <img class="w-100 mr-3 py-1" style="max-width: 1.5rem;" src="/img/home.svg" alt="home" /> </a>
            </li>
            <li class="nav-item">
                <a href="/messages"> <img class="w-100 mr-3 py-1" style="max-width: 1.5rem;" src="/img/message.svg" alt="messages" /> </a>
            </li>
            <li class="nav-item">
                <a href="/explore"> <img class="w-100 mr-3 py-1" style="max-width: 1.5rem;" src="/img/compass.svg" alt="explore" /> </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link py-0" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="w-100 mr-3 py-1" style="max-width: 1.5rem;" src="/img/heart-off.svg" alt="notifications" />
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="right: 0; left: auto;">
                    <div class="dropdown-item">
                        @notifications(['authUser' => $authUser])
                        @endnotifications
                    </div>
                </div>
              </li>

                <li class="nav-item dropdown">
                    @userDropMenu(['authUser' => $authUser])
                    @enduserDropMenu
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
            <div class="d-flex mx-auto px-2 pt-2">
              <li class="nav-item">
                <a href="/"> <img class="w-100 mx-4 py-1" style="max-width: 1.5rem;" src="/img/home.svg" alt="home" /> </a>
             </li>
             <li class="nav-item">
                 <a href="/messages"> <img class="w-100 mx-4 py-1" style="max-width: 1.5rem;" src="/img/message.svg" alt="messages" /> </a>
             </li>
             <li class="nav-item">
                 <a href="/explore"> <img class="w-100 mx-4 py-1" style="max-width: 1.5rem;" src="/img/compass.svg" alt="explore" /> </a>
             </li>

             <li class="nav-item dropup">
                <a class="" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="mx-4 py-1" style="width: 1.5rem" src="/img/heart-off.svg" alt="notifications" />
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <div class="dropdown-item">
                        @notifications(['authUser' => $authUser])
                        @endnotifications
                    </div>
                </div>
              </li>

                <li class="nav-item dropup">
                  @userDropMenu(['authUser' => $authUser])
                  @enduserDropMenu
                </li>
            </div>
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
