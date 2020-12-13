<li class="nav-item {{$drop}} px-3">
    <a class="btn btn-primary btn-lg py-0 px-2" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        +
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
        <div class="dropdown-item">
            <form class="form-group" action="/story/store" enctype="multipart/form-data" method="POST">
                @csrf
                <label class="d-block text-center">Upload Story</label>
                <input class="form-control-file" type="file" name="image">
                <button class="btn btn-primary btn-block mt-1" type="submit">Upload</button>
                @if ($errors->has('image'))                
                    <strong> {{ $errors->first('image') }}</strong>
                @endif
            </form>
        </div>
    </div>
  </li>