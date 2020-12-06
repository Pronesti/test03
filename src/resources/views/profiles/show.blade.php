@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="mx-auto">
        <img class="rounded-circle p-5 w-100" 
             src="{{ $user->profile->profileImage() }}"
             style="max-width: 15rem"      
        />
        </div>
        <div class="pt-5 mx-auto">
        <div class="d-flex mb-4">
            <h3 class="pr-4">{{ $user->username }}</h3>
            @can('update', $user->profile)
            <a href="/profile/{{$user->id}}/edit" class="btn btn-outline-secondary text-nowrap editProfileButton mr-4">Editar perfil</a>
            <a href="/p/create" class="btn btn-outline-secondary text-nowrap editProfileButton mr-4">Add new Post</a>
            @else
        <follow-button user-id="{{$user->id}}" follows="{{ $follows }}" ></follow-button>
            @endcan
        </div>
        <div class="d-flex justify-content-around">
            <div class="pr-4"><strong>{{$user->posts->count()}}</strong> publicaciones</div>
            <div class="pr-4"><a data-toggle="modal" data-target="#followersModal"><strong>{{$user->profile->followers->count()}}</strong> seguidores </a></div>
            <div class="pr-4"><a data-toggle="modal" data-target="#followingModal"><strong>{{$user->following->count()}}</strong> seguidos </a></div>
        </div>
            <div class="pt-4 font-weight-bold">{{ $user->profile->title }}</div>
            <div>{{ $user->profile->description }}</div>
            <div><a href="https://{{ $user->profile->url}}">{{ $user->profile->url}}</a></div>
        </div>
    </div>
    @if ($willShow)
        <div class="row p-4">
            @foreach ($user->posts as $post)
                <div class="col-4 pb-4">
                <a href="/p/{{$post->id}}"><img class="w-100" src="/storage/{{ $post->image }}" /></a>
                </div>
            @endforeach 
        </div>
        <div class="modal fade" id="followingModal" tabindex="-1" aria-labelledby="followingModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title ml-auto" id="exampleModalLabel">Seguidos</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="font-size:  2rem">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  @foreach ($user->following as $following)
                <div class="container d-flex  mx-0 px-0 pb-2">
                <div class="col-2 px-0">
                    <a class="text-decoration-none text-reset" href="/{{$following->user->username}}">
                        <img class="rounded-circle mr-2" src="{{$following->profileImage()}}" style="width: 3rem" /></div>
                    </a>
                <div class="col-8 ml-n4">
                    <a class="text-decoration-none text-reset" href="/{{$following->user->username}}">
                        <strong>{{$following->user->username}}</strong>
                        <div class="text-muted">{{$following->user->name}}</div>
                    </a>
                </div>
                <div class="col-2">
                    @if($following->user->id == Auth::id())
                    @else
                    <follow-button user-id={{$following->user->id}} follows={{Auth::user()->following->contains($following)}}></follow-button>
                    @endif
                </div>
                </div>
                @endforeach
                </div>
              </div>
            </div>
          </div>
          <div class="modal fade" id="followersModal" tabindex="-1" aria-labelledby="followersModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title ml-auto" id="exampleModalLabel">Seguidores</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="font-size:  2rem">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  @foreach ($user->profile->followers as $follower)
                  <div class="container d-flex  mx-0 px-0 pb-2">
                    <div class="col-2 px-0">
                        <a class="text-decoration-none text-reset" href="/{{$follower->username}}">
                            <img class="rounded-circle mr-2" src="{{$follower->profile->profileImage()}}" style="width: 3rem" /></div>
                        </a>
                    <div class="col-8 ml-n4">
                        <a class="text-decoration-none text-reset" href="/{{$follower->username}}">
                            <strong>{{$follower->username}}</strong>
                            <div class="text-muted">{{$follower->name}}</div>
                        </a>
                    </div>
                    <div class="col-2">
                        @if($follower->id == Auth::id())
                        @else
                        <follow-button user-id={{$follower->id}} follows={{Auth::user()->following->contains($follower->profile)}}></follow-button>
                        @endif
                    </div>
                    </div>
                @endforeach
                </div>
              </div>
            </div>
          </div>
    @else
        <div class="row d-block py-5">
            <div class="text-center d-block w-100"><h4>Esta cuenta es privada</h4></div>
        </div>
    @endif
        
    
</div>
@endsection
