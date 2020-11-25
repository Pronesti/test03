@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 col-md-8 px-0"><img class="w-100" src="/storage/{{$post->image}}" alt="{{$post->caption}}"></div>
        <div class="col-12 col-md-4 bg-white p-3">
            <div class="container ">
                <div class="row d-flex">
                        <div class="col-3">
                            <img class="w-100 rounded-circle" style="max-width: 3rem;" src="{{$post->user->profile->profileImage()}}" alt="" />
                        </div>
                        <div class="col-9">
                            <div class="font-weight-bold">
                                <div class="d-flex">
                                    <a class="text-dark pr-4" href="/profile/{{$post->user->id}}">{{$post->user->username}}</a>
                                    @can('update', $post->user->profile)
                                    @else
                                    <follow-button user-id="{{$post->user->id}}" follows="{{ $follows }}" ></follow-button>
                                    @endcan
                                </div>
                            </div>
                            <div class="text-muted">location</div>
                        </div>
                    </div>
                <hr>
                <div class="row">
                    <div class="col-3">
                        <img class="w-100 rounded-circle" style="max-width: 3rem;" src="{{$post->user->profile->profileImage()}}" alt="" />
                    </div>
                    <div class="col-9">
                        <div class="d-flex align-items-center">
                            <span class="font-weight-bold mr-1"><a class="text-dark" href="/profile/{{$post->user->id}}">{{$post->user->username}}</a> </span>
                            <div> {{$post->caption }} </div>
                        </div>
                        <div class="mt-2 text-muted"> {{$post->created_at->diffForHumans()}} </div>
                    </div>
                </div>
                @foreach ($comments as $comment)
                <div class="row">
                    <div class="col-3">
                        <img class="w-100 rounded-circle" style="max-width: 3rem;" src="{{$comment->user->profile->profileImage()}}" alt="" />
                    </div>
                    <div class="col-9">
                        <div class="d-flex align-items-center">
                            <span class="font-weight-bold mr-1"><a class="text-dark" href="/profile/{{$comment->user->id}}">{{$comment->user->username}}</a> </span>
                            <div> {{$comment->comment_text }} </div>
                        </div>
                        <div class="mt-2 text-muted"> {{$comment->created_at->diffForHumans()}} </div>
                    </div>
                </div>
                    @endforeach
                <hr>
                <div class="row d-block">
                    <like-button post-id="{{$post->id}}" likes="{{ $likes }}"></like-button>
                    <strong>{{$post->likes()->count()}} Me gusta</strong>
                    <div class="mt-2 text-muted"> {{$ago}} </div>
                </div>
                <hr>
                <div class="row d-flex">
                    <form action="/comment/{{$post->id}}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <textarea
                            class="form-control"
                            name="comment_text" 
                            type='text'
                            style="resize: none">
                        </textarea>
                        <button class="btn btn-primary"type="submit">Publicar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
