<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoriesController extends Controller
{
    public function index($array_pos){
        $authUser = Auth::User();
        $ids = $authUser->following()->pluck('profiles.id');
        $stories = \App\Story::whereIn('user_id', $ids)->where('created_at', ">" , \Carbon\Carbon::now()->subDays(1))->get();
        $users = $stories->pluck('user_id');
        $users = \App\User::whereIn('id', $users)->get();
        $from = $users[$array_pos]->id;
        $from = $stories->search(function($story)use($from){
            return $story->user_id == $from;
        });
        $stories = $stories->slice($from);
        return view('stories.index', compact('stories'));
    }

    public function store(){

        $data = request()->validate([
            'image' => ['required', 'file', 'mimes:jpeg,bmp,png,jpg'],
            ]);

        $path = $data['image']->store('uploads', 'public');
        $image = \Intervention\Image\Facades\Image::make(public_path("storage/{$path}"))->fit(300,600);
        $image->save();

        Auth::user()->stories()->create([
            'image' => $path,
        ]);
        return redirect('/' . Auth::user()->username);
    }
}
