<div class="d-flex">
    <div class="mr-auto w-100 d-flex">
        <div class="mr-2" style="min-width: 2rem"><like-button post-id="{{$post->id}}" likes="{{ $post->likes->contains(Auth::user()->id) }}"></like-button></div>
        <img src="/img/comment.svg" style="max-width: 1.5rem;" class="mr-3" />
        <img src="/img/message.svg" style="max-width: 1.5rem;" class="mr-3" />
    </div>
    <div class="ml-auto"><bookmark-button post-id="{{$post->id}}" saved="{{ \App\Save::where('user_id', Auth::id())->where('post_id', $post->id)->count() > 0 }}"></bookmark-button></div>
</div>