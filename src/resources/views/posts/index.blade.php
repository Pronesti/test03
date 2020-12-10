@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        @foreach($posts as $post)
            @post(['authUser' => $authUser,'post' => $post])
            @endpost
        @endforeach
    </div>
        @pagination(['content' => $posts])
        @endpagination
@endsection
