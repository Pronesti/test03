<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LikesController extends Controller
{
    public function index(){
        $user = \App\User::find(auth()->user()->id);
        $postsId = $user->liking()->pluck('posts.id');
        $posts = \App\Post::whereIn('id', $postsId)->latest()->paginate(5);
        return view('posts.index',compact('posts'));
    }

    public function store(\App\Post $post){
        return (auth()->user()) ? auth()->user()->liking()->toggle($post) : 'NotLogged';
    }
}
