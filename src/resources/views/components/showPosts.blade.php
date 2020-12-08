@foreach ($posts as $post)
    <div class="col-4 p-1 p-md-2 p-lg-3">
    <a href="/p/{{$post->id}}"><img class="w-100" src="/storage/{{ $post->image }}" /></a>
    </div>
@endforeach 