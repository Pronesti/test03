<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentLikesController extends Controller
{
    public function store(\App\Comment $comment){
        if(Auth::check()) return Auth::user()->likingComments()->toggle($comment);
    }
}
