@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 col-lg-8 px-0 border border-right-0 rounded-top">
            <div class="bg-dark h-100 d-flex align-items-center">
                <img class="w-100" src="/storage/{{$post->image}}" alt="{{$post->caption}}">
            </div>
        </div>
        <div class="col-12 col-lg-4 bg-white p-3 border border-left-0 rounded-top">
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
                <div class="" style="overflow-y: auto;overflow-x:hidden; height: 23rem;">
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
                            <div class="mt-2 text-muted"> {{$comment->created_at->diffForHumans(null,true)}} -  <a data-toggle="modal" data-target="#likesModalComment{{$comment->id}}">{{$comment->likes->count()}} Me gusta</a> </div>
                    </div>
                    <div class="col-1"><like-comment comment-id="{{$comment->id}}" likes="{{$comment->likes->contains(Auth::id())}}"></like-comment></div>
                </div>
                <div class="modal fade" id="likesModalComment{{$comment->id}}" tabindex="-1" aria-labelledby="likesModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title ml-auto" id="exampleModalLabel">Me gusta</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="font-size:  2rem">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          @foreach ($comment->likes as $like)
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

                <hr>
                <div class="row d-block pl-3">
                    <like-button post-id="{{$post->id}}" likes="{{ $likes }}"></like-button>
                    <a data-toggle="modal" data-target="#likesModal"><strong>{{$post->likes()->count()}} Me gusta</strong></a>
                    <div class="mt-2 text-muted"> {{$ago}} </div>
                </div>
                <hr>
                <div class="row d-flex pl-3">
                    <form action="/comment/{{$post->id}}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                        <textarea
                            class="form-control pt-3"
                            name="comment_text" 
                            type='text'
                            placeholder="Agrega un comentario..."
                            style="resize: none;border:none;height:3rem;box-shadow: none !important;">
                        </textarea>
                        <div class="input-group-append">
                        <button class="btn text-primary font-weight-bolder" style="float: left;" type="submit">Publicar</button>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="likesModal" tabindex="-1" aria-labelledby="likesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title ml-auto" id="exampleModalLabel">Me gusta</h5>
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
</div>
@endsection
