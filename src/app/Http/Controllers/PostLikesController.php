<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostLikesController extends Controller
{
    public function index(){
        $user = \App\User::find(auth()->user()->id);
        $postsId = $user->likingPosts()->pluck('posts.id');
        $posts = \App\Post::whereIn('id', $postsId)->latest()->paginate(5);
        return view('posts.index',compact('posts'));
    }

    public function store(\App\Post $post){
        return Auth::user()->likingPosts()->toggle($post);
    }
}
