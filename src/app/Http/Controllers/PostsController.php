<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function __construct()
    {

    }

    public function index(){
        $users = Auth::user()->following()->pluck('profiles.user_id');
        $users[]= Auth::id();
        $posts = \App\Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5);
        return view('posts.index',compact('posts'));
    }

    public function create(){
        return view('posts.create');
    }

    public function store(){

        $data = request()->validate([
            'caption' => 'required',
            'image' => ['required', 'mimes:jpeg,bmp,png,jpg'],
            'location' => ''
        ]);

        $imagePath = request('image')->store('uploads', 'public');

        $image = \Intervention\Image\Facades\Image::make(public_path("storage/{$imagePath}"))->fit(1200,1200);
        $image->save();

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,
            'location' => $data['location'],

        ]);
        return redirect('/' . Auth::user()->username);
    }
    public function show(\App\Post $post){
        if($post->user->profile->protected){
            if(!Auth::check() || !Auth::user()->following->contains($post->user->id)){
                return redirect('/'. $post->user->username);
            }
        }
        $ago = $post['created_at']->diffForHumans();
        $likes = (Auth::check()) ? Auth::user()->likingPosts->contains($post->id) : false;
        $follows = (Auth::check()) ? Auth::user()->following->contains($post->user->id) : false;
        $comments = \App\Comment::where('post_id',$post->id)->with('likes')->get();
        return view('posts.show', ['post' => $post, 'likes' => $likes, 'follows' => $follows, 'ago' => $ago, 'comments' => $comments]);
    }
}
