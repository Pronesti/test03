<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowsController extends Controller
{
    public function store(\App\User $user){
        return Auth::user()->following()->toggle($user->profile);
    }
}
