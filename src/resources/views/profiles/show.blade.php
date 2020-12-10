@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="mx-auto">
        <img class="rounded-circle p-2 p-md-5 w-100" 
             src="{{ $user->profile->profileImage() }}"
             style="max-width: 15rem"      
        />
        </div>
        <div class="pt-1 pt-md-5 mx-auto">
        <div class="d-block d-md-flex mb-4">
            <h3 class="pr-4 text-md-left text-center">{{ $user->username }}</h3>
            <div class="text-md-left text-center">
            @can('update', $user->profile)
            <a href="/profile/{{$user->id}}/edit" class="btn btn-outline-secondary text-nowrap editProfileButton mr-4">Edit profile</a>
            <a href="/p/create" class="btn btn-outline-secondary text-nowrap editProfileButton mr-4">Add new Post</a>
            @else
            @if($waiting)
              <button class="btn btn-outline-secondary">Pending</button>
            @else
            <div class="d-block d-md-flex">
              <follow-button user-id="{{$user->id}}" follows="{{ $follows }}" ></follow-button> 
              <img src="/img/options.svg" style="max-width: 1.5rem;" class="ml-md-5"/>
            </div>
            @endif
            @endcan
            </div>
        </div>
        <div class="d-flex justify-content-around">
            <div class="pr-4"><strong>{{$user->posts->count()}}</strong> posts</div>
            <div class="pr-4"><a data-toggle="modal" data-target="#followersModal"><strong>{{$user->profile->followers()->where('accepted',1)->count()}}</strong> followers </a></div>
            <div class="pr-4"><a data-toggle="modal" data-target="#followingModal"><strong>{{$user->following()->where('accepted',1)->count()}}</strong> following </a></div>
        </div>
            <div class="pt-4 font-weight-bold">{{ $user->profile->title }}</div>
            <div>{{ $user->profile->description }}</div>
            <div><a href="https://{{ $user->profile->url}}">{{ $user->profile->url}}</a></div>
        </div>
    </div>
    @if ($willShow && !$waiting)
    <hr>
      @postCategory(['isMine' => Auth::user()->id == $user->id,'category' => $category, 'username' => $user->username])
      @endpostCategory
        <div class="row p-4">
            @showPosts(['posts' => $posts])
            @endshowPosts
        </div>
          @modal(['id'=> 'followersModal', 'title' => 'Followers'])
                @foreach ($user->profile->followers()->where('accepted',1)->get() as $follower)
                  @modalUserLine(['authUser' => $authUser,'relation' => $follower])
                  @endmodalUserLine
                @endforeach
          @endmodal
          @modal(['id'=> 'followingModal', 'title' => 'Following'])
                @foreach ($user->following()->where('accepted',1)->get() as $following)
                  @modalUserLine(['authUser' => $authUser,'relation' => $following->user])
                  @endmodalUserLine
                @endforeach
          @endmodal
    @else
        <div class="row d-block py-5">
            <div class="text-center d-block w-100 bg-white p-5 border" style="box-shadow: inset 0 2px 3px -3px rgba(0,0,0,0.4);">
              <h6 class="font-weight-bold mb-4">This Account is Private</h6>
              <span>Follow to see their photos and videos.</span>
            </div>
        </div>
    @endif
        
    
</div>
@endsection
