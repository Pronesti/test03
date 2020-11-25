<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store($postId){
        $data = request()->validate([
            'comment_text' => 'required',
            ]);
        $post = \App\Post::find($postId);
        $post->comments()->create([
            'post_id' => $postId,
            'user_id' => auth()->user()->id,
            'comment_text' => $data['comment_text'],
        ]);   
        return redirect('/p/' . $postId);
    }
}
