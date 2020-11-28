@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/profile/{{ $user->id }}/update" enctype="multipart/form-data" method="POST">
        @csrf
        @method('PATCH')
<div class="row">
    <div class="col-8 offset-2">
        <div class="row">
            <h3>Edit profile</h3>
        </div>
        <div class="form-group row">
            <label for="title" class="col-md-4 col-form-label">Profile title</label>
                <input id="title" 
                       name="title"
                       type="text" 
                       class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                       value="{{ old('title') ?? $user->profile->title}}"
                       autocomplete="title"
                       autofocus
                />
                @if ($errors->has('title'))
                    <strong> {{ $errors->first('title') }}</strong>
                @endif
        </div>

        <div class="form-group row">
            <label for="description" class="col-md-4 col-form-label">Profile description</label>
                <input id="description" 
                       name="description"
                       type="text" 
                       class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                       value="{{ old('description') ?? $user->profile->description }}"
                       autocomplete="description"
                       autofocus
                />
                @if ($errors->has('description'))
                    <strong> {{ $errors->first('description') }}</strong>
                @endif
        </div>

        <div class="form-group row">
            <label for="url" class="col-md-4 col-form-label">Profile url</label>
                <input id="url" 
                       name="url"
                       type="text" 
                       class="form-control {{ $errors->has('url') ? 'is-invalid' : '' }}"
                       value="{{ old('url') ?? $user->profile->url}}"
                       autocomplete="url"
                       autofocus
                />
                @if ($errors->has('url'))
                    <strong> {{ $errors->first('url') }}</strong>
                @endif
        </div>

        <div class="row py-3">
            <div class="custom-file">
                <label for="profileImg" class=" custom-file-label">Profile image</label>
            <input type="file" class="custom-file-input" id="profileImg" name="profileImg">
            @if ($errors->has('profileImg'))                
                    <strong> {{ $errors->first('profileImg') }}</strong>
                @endif
            </div>
        </div>

        <div class="row">
            <label for="protected" class="col-md-4 col-form-label">Private Account </label>
            <input type="checkbox" class="" id="protected" name="protected" value="1" {{ $user->profile->protected ? 'checked' : ''}}>
            
            @if ($errors->has('protected'))                
                    <strong> {{ $errors->first('protected') }}</strong>
                @endif
        </div>

        <div class="row pt-4">
            <button type="submit" class="btn btn-primary">Save Profile</button>
        </div>
    </div>
</div>
    </form>
</div>
@endsection
