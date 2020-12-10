<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaveController extends Controller
{
    public function store(\App\Post $post){
        return Auth::user()->saves()->toggle($post);
    }


}
