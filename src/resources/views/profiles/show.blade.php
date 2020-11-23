@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3">
        <img class="rounded-circle p-5 w-100" 
             src="{{ $user->profile->profileImage() }}"      
        />
        </div>
        <div class="col-9 pt-5">
        <div class="d-flex mb-4">
            <h3 class="pr-4">{{ $user->username }}</h3> 
            @can('update', $user->profile)
            <a href="/profile/{{$user->id}}/edit" class="btn btn-outline-secondary text-nowrap editProfileButton mr-4">Editar perfil</a>
            <a href="/p/create" class="btn btn-outline-secondary text-nowrap editProfileButton mr-4">Add new Post</a>
            @endcan

        <follow-button user-id="{{$user->id}}" follows="{{ $follows }}" ></follow-button>
            
        </div>
        <div class="d-flex">
            <div class="pr-4"><strong>{{$user->posts->count()}}</strong> publicaciones</div>
            <div class="pr-4"><strong>{{$user->profile->followers->count()}}</strong> seguidores</div>
            <div class="pr-4"><strong>{{$user->following->count()}}</strong> seguidos</div>
        </div>
            <div class="pt-4 font-weight-bold">{{ $user->profile->title }}</div>
            <div>{{ $user->profile->description }}</div>
            <div><a href="https://{{ $user->profile->url}}">{{ $user->profile->url}}</a></div>
        </div>
    </div>
    <div class="row p-4">
        @foreach ($user->posts as $post)
        <div class="col-4 pb-4">
        <a href="/p/{{$post->id}}"><img class="w-100" src="/storage/{{ $post->image }}" /></a>
        </div>
        @endforeach
    </div>
</div>
@endsection
