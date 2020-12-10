@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 col-lg-8 px-0 border border-right-0 rounded-top">
            <div class="bg-dark h-100 d-flex align-items-center">
                @if(count($post->images) > 1)
                @carousel(['id' => $post->id, 'images'=> $post->images])
                @endcarousel
                @else
                <img class="w-100" src="/storage/{{$post->images[0]}}" alt="{{$post->caption}}">
                @endif
            </div>
        </div>
        <div class="col-12 col-lg-4 bg-white p-3 border border-left-0 rounded-top">
            <div class="container ">
                <div class="row d-flex">
                        <div class="col-3">
                            <img class="w-100 rounded-circle" style="max-width: 3rem;" src="{{$post->user->profile->profileImage()}}" alt="" />
                        </div>
                        <div class="col-7">
                            <div class="font-weight-bold">
                                <div class="d-flex">
                                    <a class="text-dark" href="/{{$post->user->username}}">{{$post->user->username}} </a>
                                    @can('update', $post->user->profile)
                                    @else
                                    <span class="px-1"> •</span> 
                                    <div class="mt-n1">
                                        <follow-button user-id="{{$post->user->id}}" follows="{{ $follows }}" ></follow-button>
                                    </div>
                                    @endcan
                                </div>
                            </div>
                            <div class="text-muted">{{$post->location}}</div>
                        </div>
                        <div class="col-1"><img src="/img/options.svg" style="max-width: 1.5rem;" class="ml-auto" /></div>
                    </div>
                <hr>
                <div class="row">
                    <div class="col-3">
                        <img class="w-100 rounded-circle" style="max-width: 3rem;" src="{{$post->user->profile->profileImage()}}" alt="" />
                    </div>
                    <div class="col-9">
                        <div class="d-flex">
                            <span>
                                <span class="font-weight-bold h-100 mr-1"><a class="text-dark" href="/{{$post->user->username}}">{{$post->user->username}}</a> </span>
                             {{$post->caption }}
                            </span>
                        </div>
                        <div class="mt-2 text-muted"> {{$post->created_at->diffForHumans(null,true)}} </div>
                    </div>
                </div>
                <div style="overflow-y: auto;overflow-x:hidden; height: 23rem;">
                @foreach ($comments as $comment)
                    @comment(['comment' => $comment])
                    @endcomment
                @endforeach
                </div>
                <hr>
                @postButtons(['post'=>$post])
                @endpostButtons 
                <div class="row d-block pl-3">
                    <a data-toggle="modal" data-target="#likesModal"><strong>{{$post->likes()->count()}} likes</strong></a>
                    <div class="mt-2 text-muted"> {{$ago}} </div>
                </div>
                <hr>
                <div class="row d-flex pl-3">
                    @addComment(['id' => $post->id])
                    @endaddComment
                </div>
            </div>
        </div>
    </div>
    @modal(['id'=> 'likesModal', 'title'=>'Likes'])
        @foreach ($post->likes as $like)
            <div class="container d-flex  mx-0 px-0 pb-2">
            <div class="col-2 px-0">
                <a class="text-decoration-none text-reset" href="/{{$like->username}}">
                    <img class="rounded-circle mr-2" src="{{$like->profile->profileImage()}}" style="width: 3rem" /></div>
                </a>
            <div class="col-7 ml-n4">
                <a class="text-decoration-none text-reset" href="/{{$like->username}}">
                    <strong>{{$like->username}}</strong>
                    <div class="text-muted">{{$like->name}}</div>
                </a>
            </div>
            <div class="col-3">
                @if($like->id == Auth::id())
                @else
                <follow-button user-id={{$like->id}} follows={{Auth::user()->following()->where('accepted',1)->get()->contains($like->profile)}}></follow-button>
                @endif
            </div>
            </div>
            @endforeach
    @endmodal
</div>
@endsection
