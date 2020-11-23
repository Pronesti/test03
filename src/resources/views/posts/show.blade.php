@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
    <div class="col-8">
        <img class="w-100" src="/storage/{{$post->image}}" alt="{{$post->caption}}">
    </div>
    <div class="col-4">
        <div>
            <div class="row">
                <div class="d-flex align-items-center"> 
                    <div class="pr-3">
                        <img class="w-100 rounded-circle" style="max-width: 4rem;" src="/storage/{{$post->user->profile->profileImg}}" alt="" />
                    </div>
                    <div>
                        <div class="font-weight-bold">
                            <a class="text-dark" href="/profile/{{$post->user->id}}">{{$post->user->username}}</a>
                            <a href="#" class="pl-2"> Follow </a>
                        </div>
                        <div class="text-muted">location</div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-4">
                    <img class="w-100 rounded-circle" style="max-width: 5rem;" src="/storage/{{$post->user->profile->profileImg}}" alt="" />
                </div>
                <div class="col-8">
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
@endsection
