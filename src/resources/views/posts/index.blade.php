@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        @foreach($posts as $post)
            @post(['post' => $post])
            @endpost
        @endforeach
    </div>
        @pagination(['content' => $posts])
        @endpagination
@endsection
