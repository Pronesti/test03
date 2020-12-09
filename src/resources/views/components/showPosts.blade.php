@foreach ($posts as $post)
    <div class="col-4 p-1 p-md-2 p-lg-3">
    <div>
    @if(count($post->images)>1)
    <img src="/img/gallery.png" style="position: absolute;padding: 5px; z-index: 10000; right:0px; top:10px;" />
    @endif
    <a href="/p/{{$post->id}}"><img class="w-100" src="/storage/{{ $post->images[0] }}" style="position: absolute;padding: 5px;" /></a>
    </div>
    </div>
@endforeach 