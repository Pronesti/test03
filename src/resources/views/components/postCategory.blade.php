@if($isMine)
<div class="d-flex">
@if($category == 'posts')
    <a href="/{{$username}}/" class="text-decoration-none text-dark ml-auto px-5 font-weight-bolder">Posts</a>
    <a href="/{{$username}}/likes" class="text-decoration-none text-dark px-5 text-muted">Likes</a>
    <a href="/{{$username}}/saves" class="text-decoration-none text-dark mr-auto px-5 text-muted">Saves</a>
@elseif($category == 'likes')
    <a href="/{{$username}}/" class="text-decoration-none text-dark ml-auto px-5 text-muted">Posts</a>
    <a href="/{{$username}}/likes" class="text-decoration-none text-dark px-5 font-weight-bolder">Likes</a>
    <a href="/{{$username}}/saves" class="text-decoration-none text-dark mr-auto px-5 text-muted">Saves</a>
@elseif($category == 'saves')
    <a href="/{{$username}}/" class="text-decoration-none text-dark ml-auto px-5 text-muted">Posts</a>
    <a href="/{{$username}}/likes" class="text-decoration-none text-dark px-5 text-muted">Likes</a>
    <a href="/{{$username}}/saves" class="text-decoration-none text-dark mr-auto px-5 font-weight-bolder">Saves</a>
@endif
</div>
@else
    <div class="d-flex"><a href="/{{$username}}/" class="text-decoration-none text-dark mx-auto px-5 font-weight-bolder">Posts</a></div>
@endif