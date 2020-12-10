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
        $authUser = Auth::check() ? Auth::user() : false;
        $users = $authUser->following()->where('accepted',1)->get()->pluck('profiles.user_id');
        $users[]= $authUser->id;
        $posts = \App\Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5);
        return view('posts.index',compact('posts','authUser'));
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
        $authUser = Auth::check() ? Auth::user() : false;
        if($post->user->profile->protected){
            if(!$authUser || !($authUser->following()->where('accepted',1)->get()->contains($post->user->id)) && Auth::id() !== $post->user->id){
                return redirect('/'. $post->user->username);
            }
        }
        $ago = $post['created_at']->diffForHumans();
        $likes = ($authUser) ? $authUser->likedPosts->contains($post->id) : false;
        $isSaved = ($authUser) ? $post->saves->contains($authUser->id) : false;
        $follows = ($authUser) ? $authUser->following()->where('accepted',1)->get()->contains($post->user->id) : false;
        $comments = \App\Comment::where('post_id',$post->id)->with('likes')->get();
        return view('posts.show', compact('post','likes','follows','ago','comments','isSaved', 'authUser'));
    }
}
