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
    <style>
ol.carousel-indicators {
  position: absolute;
  top: 0.5rem;
  margin: 0;
  left: 0;
  right: 0;
  width: auto;
  z-index: 1;
}

ol.carousel-indicators li,
ol.carousel-indicators li.active {
  border-radius: 0;
  width: 100%;
  height: 0.1rem;
  margin: 0;
  border: 0;
  background: transparent;
}

ol.carousel-indicators li {
  background: rgba(255,255,255,0.39);
  margin-left: .2rem;
  margin-right: .2rem;
}

ol.carousel-indicators li.active {
  background: white;
  margin-left: .2rem;
  margin-right: .2rem;
}
</style>
</head>
<body style="background-color: black;overflow: hidden;">
<div class="row">
    <div class="col-12 col-md-8 offset-md-2 col-lg-4 offset-lg-4">
        <div id="carousel" class="carousel slide" data-ride="carousel" data-interval="6000" data-wrap="false">
            <ol class="carousel-indicators">
                @foreach($stories as $story)
                @if($loop->first)
                <li data-target="#carousel" data-slide-to="{{$loop->index}}" class="active"></li>
                @else
                <li data-target="#carousel" data-slide-to="{{$loop->index}}" ></li>
                @endif
                @endforeach
            </ol>
            <div class="carousel-inner">
                @foreach($stories as $story)
                @if($loop->first)
                    <div class="carousel-item active">
                @else
                    <div class="carousel-item">
                @endif    
                    <img class="d-block w-100" style="height: 100vh;" src="/storage/{{$story->image}}" alt="">
                    </div>
                @endforeach
            </div>
        
            <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <a class="text-white text-decoration-none font-weight-bolder" style="position: absolute;top: 0px;right: 30px; font-size: 2rem;" href="/"> x </a>
</div>
</body>
</html>