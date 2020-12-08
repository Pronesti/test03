<form action="/comment/{{$id}}" enctype="multipart/form-data" method="POST">
    @csrf
    <div class="input-group">
    <textarea
        id="textarea"
        class="form-control"
        name="comment_text" 
        type='text'
        placeholder="Add a comment..."
        style="resize: none;border:none;height:3rem;box-shadow: none !important;">
    </textarea>
    <div class="input-group-append">
    <button class="btn text-primary font-weight-bolder mb-3" style="float: left;" type="submit">Post</button>
    </div>
    </div>
</form>