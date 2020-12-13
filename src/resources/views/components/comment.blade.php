<div class="row pt-3">
    <div class="col-3">
        <img class="w-100 rounded-circle" style="max-width: 3rem;" src="{{$comment->user->profile->profileImage()}}" alt="" />
    </div>
    <div class="col-7">
        <div class="d-flex">
            <span class="font-weight-bold mr-1"><a class="text-dark" href="/{{$comment->user->username}}">{{$comment->user->username}}</a> </span>
            <div> {{$comment->comment_text }} </div>
        </div>
            <div class="mt-2 text-muted"> {{$comment->created_at->diffForHumans(null,true,true)}}
                @if($comment->likes->count() > 0)
                <a data-toggle="modal" data-target="#likesModalComment{{$comment->id}}">{{$comment->likes->count()}} likes</a> 
                @endif
            </div>
    </div>
    <div class="col-1"><like-comment comment-id="{{$comment->id}}" likes="{{$authUser ? $comment->likes->contains($authUser->id) : false}}"></like-comment></div>
</div>
    @modal(['id'=> 'likesModalComment' . $comment->id, 'title'=>'Likes'])
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
            @if($authUser)
                @if($like->id != $authUser->id )
                    @if($like->profile->followers()->where('accepted',0)->get()->contains($authUser->id))
                        <div class="btn btn-outline-secondary"> Pending </div>
                    @else
                        <follow-button user-id={{$like->id}} follows={{$authUser ? $authUser->following()->where('accepted',1)->get()->contains($like->profile) : false}}></follow-button>
                    @endif
                @endif
            @endif
        </div>
        </div>
        @endforeach
    @endmodal