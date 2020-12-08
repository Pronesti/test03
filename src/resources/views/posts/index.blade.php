@extends('layouts.app')

@section('content')
<div class="container-fluid">
@foreach($posts as $post)
<div class="col-lg-8 offset-lg-2 mb-4">
    <div class="row">
        <div class="col-10 offset-1 col-lg-8 offset-lg-2 pb-2 bg-white border border-bottom-0 rounded-top">
            <div class="d-flex align-items-center pt-2 px-2"> 
                <div class="pr-3">
                    <img class="w-100 rounded-circle boder border-secondary" style="max-width: 2rem;" src="{{ $post->user->profile->profileImage() }}"   alt="" />
                </div>
                <div>
                    <div class="font-weight-bold">
                        <a class="text-dark" href="/{{$post->user->username}}">{{$post->user->username}}</a>
                    </div>
                    <div class="text-muted">{{$post->location}}</div>
                </div>
                <img src="/img/options.svg" style="max-width: 1.5rem;" class="ml-auto" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-10 offset-1 col-lg-8 offset-lg-2 bg-white border border-bottom-0 border-top-0">
            <img class="w-100" src="/storage/{{$post->image}}" alt="{{$post->caption}}">
        </div>
    </div>
    <div class="row">   
        <div class="col-10 offset-1 col-lg-8 offset-lg-2 bg-white pt-2 border border-top-0 rounded-bottom">
            <div>
                <div class="row">
                    <div class="col-12">
                        
                        <div class="d-flex">
                            <div class="mr-auto w-100 d-flex">
                                <div class="mr-3"><like-button post-id="{{$post->id}}" likes="{{ $post->likes->contains(Auth::user()->id) }}"></like-button></div>
                                <img src="/img/comment.svg" style="max-width: 1.5rem;" class="mr-3" />
                                <img src="/img/message.svg" style="max-width: 1.5rem;" class="mr-3" />
                            </div>
                            <div class="ml-auto"><bookmark-button post-id="{{$post->id}}" saved="{{ \App\Save::where('user_id', Auth::id())->where('post_id', $post->id)->count() > 0 }}"></bookmark-button></div>
                        </div>
                        <a data-toggle="modal" data-target="#likesModalPost{{$post->id}}"><strong>{{$post->likes()->count()}} likes</strong></a>
                        <div class="d-flex align-items-center">
                            <span><span class="font-weight-bolder mr-1"><a class="text-dark" href="/{{$post->user->username}}">{{$post->user->username}}</a> </span>
                             {{$post->caption }} </span>
                        </div>
                        @if($post->comments->count() > 2)
                        <a href="/p/{{$post->id}}" class="text-muted">View all {{$post->comments->count()}} comments</a>
                        @endif
                        @foreach ($post->comments->take(-2) as $comment)
                            <div class="d-flex bd-highlight">
                                <span class="font-weight-bolder mr-1"><a class="text-dark" href="/{{$comment->user->username}}">{{$comment->user->username}}</a> </span>
                                <div> {{$comment->comment_text }} </div>
                                <div class="ml-auto"><like-comment comment-id="{{$comment->id}}" likes="{{$comment->likes->contains(Auth::id())}}"></like-comment></div>
                            </div>
                        @endforeach

                    <div class="mt-2 text-muted"><a class="text-muted" href="/p/{{$post->id}}"> {{$post->created_at->diffForHumans()}} </a></div>
                    <hr>
                    <form action="/comment/{{$post->id}}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="input-group">
                        <textarea
                            class="form-control"
                            name="comment_text" 
                            type='text'
                            placeholder="Add a comment..."
                            style="resize: none;border:none;height:3rem;box-shadow: none !important;">
                        </textarea>
                        <div class="input-group-append">
                        <button class="btn btn-sm text-primary font-weight-bolder mb-3" style="float: left;" type="submit">Post</button>
                        </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="likesModalPost{{$post->id}}" tabindex="-1" aria-labelledby="likesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title ml-auto" id="exampleModalLabel">likes</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="font-size:  2rem">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          @foreach ($post->likes as $like)
        <div class="container d-flex  mx-0 px-0 pb-2">
        <div class="col-2 px-0">
            <a class="text-decoration-none text-reset" href="/{{$like->username}}">
                <img class="rounded-circle mr-2" src="{{$like->profile->profileImage()}}" style="width: 3rem" /></div>
            </a>
        <div class="col-8 ml-n4">
            <a class="text-decoration-none text-reset" href="/{{$like->username}}">
                <strong>{{$like->username}}</strong>
                <div class="text-muted">{{$like->name}}</div>
            </a>
        </div>
        <div class="col-2">
            @if($like->id == Auth::id())
            @else
            <follow-button user-id={{$like->id}} follows={{Auth::user()->following->contains($like->profile)}}></follow-button>
            @endif
        </div>
        </div>
        @endforeach
        </div>
      </div>
    </div>
  </div>
@endforeach
</div>
<div class="row">
    <div class="col-8 offset-2 d-flex justify-content-center">
        {{ $posts->links()}}
    </div>
</div>
</div>
@endsection
