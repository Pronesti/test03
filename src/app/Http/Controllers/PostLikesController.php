<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostLikesController extends Controller
{
    public function store(\App\Post $post){
        return Auth::user()->likingPosts()->toggle($post);
    }
}
