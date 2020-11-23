@extends('layouts.app')

@section('content')
<div class="container-fluid">
@foreach($posts as $post)
<div class="mb-4">
<div class="row">
    <div class="col-8 offset-2 pb-2 bg-white">
        <div class="d-flex align-items-center"> 
            <div class="pr-3">
                <img class="w-100 rounded-circle" style="max-width: 2rem;" src="{{ $post->user->profile->profileImage() }}"   alt="" />
            </div>
            <div>
                <div class="font-weight-bold">
                    <a class="text-dark" href="/profile/{{$post->user->id}}">{{$post->user->username}}</a>
                </div>
                <div class="text-muted">location</div>
            </div>
        </div>
    </div>
    <hr>
</div>
<div class="row">
    <div class="col-8 offset-2 bg-white">
        <img class="w-100" src="/storage/{{$post->image}}" alt="{{$post->caption}}">
    </div>
</div>
<div class="row">   
    <div class="col-8 offset-2 bg-white pt-2">
        <div>
            <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center">
                        <span class="font-weight-bold mr-1"><a class="text-dark" href="/profile/{{$post->user->id}}">{{$post->user->username}}</a> </span>
                        <div> {{$post->caption }} </div>
                    </div>
                <div class="mt-2 text-muted"> {{$post->created_at}} </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
</div>
@endforeach
<div class="row">
    <div class="col-8 offset-2 d-flex justify-content-center">
        {{ $posts->links() }}
    </div>
</div>
</div>
@endsection
