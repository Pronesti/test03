<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FollowsController extends Controller
{
    public function store(\App\User $user){

        $res = Auth::user()->following()->toggle($user->profile);

        if($user->profile->protected){
            DB::update('update profile_user set accepted = 0 where user_id = ? and profile_id = ?', [Auth::id(),$user->profile->id]);
        }    

        return json_encode(['protected' => $user->profile->protected]);
    }

    public function update($id){
        DB::update('update profile_user set accepted = 1 where user_id = ? and profile_id = ?', [$id,Auth::user()->profile->id]);
        return redirect('/');
    }

    public function destroy($id){
        DB::delete('delete from profile_user where user_id = ? and profile_id = ?', [$id,Auth::user()->profile->id]);
        return redirect('/');
    }
}
