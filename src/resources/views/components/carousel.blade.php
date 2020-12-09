<div id="carousel{{$id}}" class="carousel slide w-100" data-ride="carousel" data-interval="false" data-wrap="false">
    <ol class="carousel-indicators">
        @foreach($images as $image)
        @if($loop->first)
        <li data-target="#carousel{{$id}}" data-slide-to="{{$loop->index}}" class="active"></li>
        @else
        <li data-target="#carousel{{$id}}" data-slide-to="{{$loop->index}}" ></li>
        @endif
        @endforeach
    </ol>
    <div class="carousel-inner">
        @foreach($images as $image)
        @if($loop->first)
            <div class="carousel-item active">
        @else
            <div class="carousel-item">
        @endif    
            <img class="d-block w-100" src="/storage/{{$image}}" alt="">
            </div>
        @endforeach
    </div>

    <a class="carousel-control-prev" href="#carousel{{$id}}" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel{{$id}}" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>