@if($authUser)
@php
 $recommendations = \App\User::inRandomOrder()->limit(5)->get();
@endphp
    <div class="d-none d-lg-block mt-3">
        <div class="row">
            <div class="col-3 mb-3">
                <img class="w-100 rounded-circle" style="max-width: 5rem;" src="{{$authUser->profile->profileImage()}}" alt="" />
            </div>
            <div class="col-7">
                <div class="font-weight-bold">
                    <div class="d-flex">
                        <a class="text-dark" href="/{{$authUser->username}}">{{$authUser->username}} </a>
                    </div>
                </div>
                <div class="text-muted">{{$authUser->name}}</div>
            </div>
        </div>
        <div class="row d-block mb-4">
            <h6 class="text-black-50 font-weight-bold">Sugerencias para ti</h6>
            @foreach($recommendations as $recommendation)
            <div class="d-block my-3">
                <a class="text-decoration-none text-dark" href="/{{$recommendation->username}}">
                    <img class="w-100 rounded-circle" style="max-width: 2rem;" src="{{$recommendation->profile->profileImage()}}" alt="{{$recommendation->username}}" /> 
                    <strong>{{$recommendation->username}}</strong>
                </a>
            </div>
            @endforeach
        </div>
        <div class="row mb-3 pr-4" style="font-size: 0.8rem">
            <span class="text-black-50">Información • </span> 
            <span class="text-black-50"> Ayuda • </span> 
            <span class="text-black-50"> Prensa • </span> 
            <span class="text-black-50"> API • </span> 
            <span class="text-black-50"> Empleo • </span> 
            <span class="text-black-50"> Privacidad • </span> 
            <span class="text-black-50"> Condiciones • </span> 
            <span class="text-black-50"> Ubicaciones • </span> 
            <span class="text-black-50"> Cuentas destacadas • </span> 
            <span class="text-black-50"> Hashtags • </span> 
            <span class="text-black-50"> Idioma</span>   
        </div>
        <div class="row">
            <span class="text-black-50" style="font-size: 0.8rem">© 2020 INSTAGRAM FROM FACEBOOK</span>
        </div>
    </div>
@endif