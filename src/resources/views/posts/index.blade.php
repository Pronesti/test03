@extends('layouts.app')

@section('content')
    
    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-8">
            @stories(['authUser' => $authUser])
            @endstories
        @foreach($posts as $post)
            @post(['authUser' => $authUser,'post' => $post])
            @endpost
        @endforeach
        </div>

        <div class="col-lg-3">
            @sidebar(['authUser' => $authUser])
            @endsidebar
            </div>
    </div>
        @pagination(['content' => $posts])
        @endpagination
@endsection
