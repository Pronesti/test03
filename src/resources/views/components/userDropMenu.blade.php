<a class="" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <img class="rounded-circle w-100 mx-4 py-1" style="max-width: 1.5rem;" src={{ Auth::user()->profile->profileImage() }} alt={{ Auth::user()->username }} />
  </a>
  <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
    <a class="dropdown-item" href="/{{ Auth::user()->username }}">
        <img class="w-100 mr-1" style="max-width: 1.5rem;" src="/img/profile.svg" alt="explore" /> Profile
    </a>
    <a class="dropdown-item" href="/like/p/all">
        <img class="w-100 mr-1" style="max-width: 1.5rem;" src="/img/heart-off.svg" alt="likes" /> Likes
    </a>
    <a class="dropdown-item" href="/bookmark/all">
        <img class="w-100 mr-1" style="max-width: 1.5rem;" src="/img/bookmark-off.svg" alt="saved" /> Saved
    </a>
    <a class="dropdown-item" href="{{ route('logout') }}"
       onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
    <img class="w-100 mr-1" style="max-width: 1.5rem;" src="/img/logout.svg" alt="logout" />
        {{ __('Logout') }}
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
  </div>