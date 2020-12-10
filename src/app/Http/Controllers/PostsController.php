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
        $users = Auth::user()->following()->where('accepted',1)->get()->pluck('profiles.user_id');
        $users[]= Auth::id();
        $posts = \App\Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5);
        return view('posts.index',compact('posts'));
    }

    public function create(){
        return view('posts.create');
    }

    public function store(){
        $imagesPath = [];
        $data = request()->validate([
            'caption' => 'required',
            'file' => ['required','array'],
            'file.*' => ['file', 'mimes:jpeg,bmp,png,jpg'],
            'location' => ''
            ]);
            foreach(request()->file as $image){
                $path = $image->store('uploads', 'public');
                $imagesPath []= $path;
                $image = \Intervention\Image\Facades\Image::make(public_path("storage/{$path}"))->fit(1200,1200);
                $image->save();
            }


        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'images' => $imagesPath,
            'location' => $data['location'],

        ]);
        return redirect('/' . Auth::user()->username);
    }
    public function show(\App\Post $post){
        if($post->user->profile->protected){
            if(!Auth::check() || !(Auth::user()->following()->where('accepted',1)->get()->contains($post->user->id)) && Auth::id() !== $post->user->id){
                return redirect('/'. $post->user->username);
            }
        }
        $ago = $post['created_at']->diffForHumans();
        $likes = (Auth::check()) ? Auth::user()->likedPosts->contains($post->id) : false;
        $isSaved = (Auth::check()) ? $post->saves->contains(Auth::id()) : false;
        $follows = (Auth::check()) ? Auth::user()->following()->where('accepted',1)->get()->contains($post->user->id) : false;
        $comments = \App\Comment::where('post_id',$post->id)->with('likes')->get();
        return view('posts.show', compact('post','likes','follows','ago','comments','isSaved'));
    }
}
