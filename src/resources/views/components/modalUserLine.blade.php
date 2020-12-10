 <div class="container d-flex  mx-0 px-0 pb-2">
    <div class="col-2 px-0">
        <a class="text-decoration-none text-reset" href="/{{$relation->username}}">
            <img class="rounded-circle mr-2" src="{{$relation->profile->profileImage()}}" style="width: 3rem" />
        </a>
    </div>
    <div class="col-7 ml-n4">
        <a class="text-decoration-none text-reset" href="/{{$relation->username}}">
        <strong>{{$relation->username}}</strong>
        <div class="text-muted">{{$relation->name}}</div>
        </a>
    </div>
    <div class="col-3">
        @if($relation->id == $authUser->id)
        @elseif($authUser)
            <follow-button user-id={{$relation->id}} follows={{$authUser ? $authUser->following()->where('accepted',1)->get()->contains($relation->profile) : false}}></follow-button>
        @endif
    </div>
</div>