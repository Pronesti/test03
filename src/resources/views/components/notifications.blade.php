@php
    $requests = DB::select('select * from profile_user where profile_id = :profileid and accepted = 0',['profileid' => Auth::user()->profile->id]);
@endphp
@foreach($requests as $request)
    @php
        $user = \App\User::find($request->user_id);    
    @endphp
    <div class="container d-flex  mx-0 px-0 pb-2" style="width: 30rem;">
        <div class="col-2 px-0">
            <a class="text-decoration-none text-reset" href="/{{$user->username}}">
                <img class="rounded-circle mr-2" src="{{$user->profile->profileImage()}}" style="width: 3rem" /></div>
            </a>
        <div class="col-5 ml-n4">
            <a class="text-decoration-none text-reset" href="/{{$user->username}}">
                <a class="text-dark" href="/{{$user->username}}/"><strong>{{$user->username}}</strong></a> ha solicitado seguirte<br>
            </a>
        </div>
        <div class="col-5 d-flex">
            <form method="POST" action="/follow/confirm/{{$request->user_id}}" enctype="multipart/form-data">
                @csrf
                <button class="btn btn-primary mr-1" type="submit">Aceptar</button>
            </form>
            <form method="POST" action="/follow/delete/{{$request->user_id}}" enctype="multipart/form-data">
                @csrf
                <button class="btn btn-danger mr-1" type="submit">Cancelar</button>
            </form>
        </div>
        </div>
@endforeach