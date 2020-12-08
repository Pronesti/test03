<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaveController extends Controller
{
    public function store(\App\Post $post){
        $res = \App\Save::where('user_id', Auth::id())->where('post_id', $post->id);
        return $res->count() > 0 ? $res->delete() : \App\Save::create(['user_id' => Auth::id(), 'post_id' => $post->id]);
    }


}
