@php
    $ids = $authUser->following()->pluck('profiles.id');
    $users = \App\Story::whereIn('user_id', $ids)->where('created_at', ">" , \Carbon\Carbon::now()->subDays(1))->pluck('user_id');
    $users = \App\User::whereIn('id', $users)->get();
@endphp
<div class="row">
    <div class="col-10 offset-1 col-lg-8 offset-lg-2 mb-4">
        <div class="d-flex bg-white border rounded mx-3">
            @foreach($users as $user)
                <div>
                    <a href="#">
                        <img class="rounded-circle w-100 mx-3 mt-3 d-block border border-danger" style="max-width: 3rem" src="{{$user->profile->profileImage()}}" alt="{{$user->username}}" />
                        <span class="text-decoration-none text-dark d-block ml-3 mb-3">{{$user->username}}</span>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
