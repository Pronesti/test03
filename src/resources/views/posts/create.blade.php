@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/p/store" enctype="multipart/form-data" method="POST">
        @csrf
<div class="row">
    <div class="col-8 offset-2">
        <div class="row">
            <h3>Add new post</h3>
        </div>

        <div class="row">
            <label for="images" class="col-md-4 col-form-label">Post Images</label>
            <input type="file" class="form-control-file" id="file" name="file[]" multiple>
            @if ($errors->has('file'))                
                <strong> {{ $errors->first('file') }}</strong>
            @endif
            <ul class="list-unstyled mt-3">
            @foreach($errors->get('file.*') as $message)
                    <li class="alert alert-danger" role="alert"> {{$message[0]}}</li>
            @endforeach
            </ul>
        </div>

        <div class="form-group row">
            <label for="caption" class="col-md-4 col-form-label">Post Caption</label>
                <input id="caption" 
                       name="caption"
                       type="text" 
                       class="form-control {{ $errors->has('caption') ? 'is-invalid' : '' }}"
                       value="{{ old('caption') }}"
                       autocomplete="caption"
                       autofocus
                />
                @if ($errors->has('caption'))
                    <strong> {{ $errors->first('caption') }}</strong>
                @endif
        </div>

        <div class="form-group row">
            <label for="location" class="col-md-4 col-form-label">Post location</label>
                <input id="location" 
                       name="location"
                       type="text" 
                       class="form-control {{ $errors->has('location') ? 'is-invalid' : '' }}"
                       value="{{ old('location') }}"
                       autocomplete="location"
                       autofocus
                />
                @if ($errors->has('location'))
                    <strong> {{ $errors->first('location') }}</strong>
                @endif
        </div>
        

        <div class="row pt-4">
            <button type="submit" class="btn btn-primary">Add new Post</button>
        </div>
    </div>
</div>
    </form>
</div>
@endsection
