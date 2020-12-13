@php
    $ids = $authUser->following()->pluck('profiles.id');
    $users = \App\Story::whereIn('user_id', $ids)->where('created_at', ">" , \Carbon\Carbon::now()->subDays(1))->pluck('user_id');
    $users = \App\User::whereIn('id', $users)->get();
@endphp
<div class="row">
    <div class="col-10 offset-1 mb-4 px-0">
        <div class="d-flex bg-white border rounded">
            @foreach($users as $user)
                <div>
                    <a href="/stories/">
                        <img class="rounded-circle w-100 mx-3 mt-3 d-block" style="max-width: 3rem;box-shadow: white 0px 0px 0px 0.1rem,red 0px 0px 0px 0.2rem;" src="{{$user->profile->profileImage()}}" alt="{{$user->username}}" />
                        <span class="text-decoration-none text-dark d-block ml-3 mb-3">{{$user->username}}</span>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
