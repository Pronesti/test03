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
                                    <a class="text-dark pr-4" href="/{{$post->user->username}}">{{$post->user->username}}</a>
                                    @can('update', $post->user->profile)
                                    @else
                                    <follow-button user-id="{{$post->user->id}}" follows="{{ $follows }}" ></follow-button>
                                    @endcan
                                </div>
                            </div>
                            <div class="text-muted">{{$post->location}}</div>
                        </div>
                    </div>
                <hr>
                <div class="row">
                    <div class="col-3">
                        <img class="w-100 rounded-circle" style="max-width: 3rem;" src="{{$post->user->profile->profileImage()}}" alt="" />
                    </div>
                    <div class="col-9">
                        <div class="d-flex align-items-center">
                            <span class="font-weight-bold mr-1"><a class="text-dark" href="/{{$post->user->username}}">{{$post->user->username}}</a> </span>
                            <div> {{$post->caption }} </div>
                        </div>
                        <div class="mt-2 text-muted"> {{$post->created_at->diffForHumans(null,true)}} </div>
                    </div>
                </div>

                @foreach ($comments as $comment)
                <div class="row pt-3">
                    <div class="col-3">
                        <img class="w-100 rounded-circle" style="max-width: 3rem;" src="{{$comment->user->profile->profileImage()}}" alt="" />
                    </div>
                    <div class="col-7">
                        <div class="d-flex">
                            <span class="font-weight-bold mr-1"><a class="text-dark" href="/{{$comment->user->username}}">{{$comment->user->username}}</a> </span>
                            <div> {{$comment->comment_text }} </div>
                        </div>
                            <div class="mt-2 text-muted"> {{$comment->created_at->diffForHumans(null,true)}} - {{$comment->likes->count()}} Me gusta  </div>
                    </div>
                    <div class="col-1"><like-comment comment-id="{{$comment->id}}" likes="{{$comment->likes->contains(Auth::id())}}"></like-comment></div>
                </div>
                    @endforeach

                <hr>
                <div class="row d-block pl-3">
                    <like-button post-id="{{$post->id}}" likes="{{ $likes }}"></like-button>
                    <strong>{{$post->likes()->count()}} Me gusta</strong>
                    <div class="mt-2 text-muted"> {{$ago}} </div>
                </div>
                <hr>
                <div class="row d-flex pl-3">
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
