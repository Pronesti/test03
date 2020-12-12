@extends('layouts.app')

@section('content')
    @stories(['authUser' => $authUser])
    @endstories
    <div class="container-fluid">
        @foreach($posts as $post)
            @post(['authUser' => $authUser,'post' => $post])
            @endpost
        @endforeach
    </div>
        @pagination(['content' => $posts])
        @endpagination
@endsection
