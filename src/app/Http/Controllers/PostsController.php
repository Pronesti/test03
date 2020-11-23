<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $users = auth()->user()->following()->pluck('profiles.user_id');
        $users[]= auth()->user()->id;
        $posts = \App\Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5);
        return view('posts.index',compact('posts'));
    }

    public function create(){
        return view('posts.create');
    }
    public function store(){
        $data = request()->validate([
            'caption' => 'required',
            'image' => ['required', 'image'],
        ]);

        $imagePath = request('image')->store('uploads', 'public');

        $image = \Intervention\Image\Facades\Image::make(public_path("storage/{$imagePath}"))->fit(1200,1200);
        $image->save();

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath
        ]);
        return redirect('/profile/' . auth()->user()->id);
    }
    public function show(\App\Post $post){
        $ago = $post['created_at']->diffForHumans();
        $likes = (auth()->user()) ? auth()->user()->liking->contains($post->id) : false;
        $follows = (auth()->user()) ? auth()->user()->following->contains($post->user->id) : false;
        return view('posts.show', ['post' => $post, 'likes' => $likes, 'follows' => $follows, 'ago' => $ago]);
    }
}
