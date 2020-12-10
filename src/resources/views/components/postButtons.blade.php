<div class="d-flex">
    <div class="mr-auto w-100 d-flex">
        <div class="mr-2" style="min-width: 2rem"><like-button post-id="{{$post->id}}" likes="{{ $authUser ? $post->likes->contains($authUser->id) : false }}"></like-button></div>
        <img src="/img/comment.svg" style="max-width: 1.5rem;" class="mr-3" />
        <img src="/img/message.svg" style="max-width: 1.5rem;" class="mr-3" />
    </div>
    <div class="ml-auto"><bookmark-button post-id="{{$post->id}}" saved="{{$authUser ? $post->saves->contains($authUser->id) : false }}"></bookmark-button></div>
</div>