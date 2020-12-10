<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfilesController extends Controller
{
    public function show($username,$category = 'posts')
    {
        $user = \App\User::where('username', $username)->firstOrFail();

        $loggedUser = Auth::user();

        $follows = false;
        $waiting = false;
        if(Auth::check()){
            $follows = $loggedUser->following->contains($user->profile->id);
            if($follows){
                $accepted = Auth::user()->following()->where('profile_id',$user->profile->id)->firstOrFail()->pivot->accepted;
                $waiting = ($accepted == 0);
            }
        }

        $willShow = true;
        if($user->profile->protected){
            if(!Auth::check() || !$follows && !($loggedUser->id == $user->id)){
                    $willShow = false;
            }
        }

        $posts = [];
        if(Auth::check() && Auth::id() == $user->id){
            switch($category){
                case 'likes':
                    $posts = $user->likedPosts;
                    break;
                case 'saves':
                    $posts = $user->saves;
                    break;
                default:
                    $posts = $user->posts;
            }
        }else{
            $posts = $user->posts;
        }

        return view('profiles.show', compact('user', 'follows', 'willShow', 'waiting', 'category', 'posts'));
    }

    public function edit(\App\User $user){
        $this->authorize('update', $user->profile);
        return view('profiles.edit', compact('user'));
    }

    public function update(\App\User $user){
        $this->authorize('update', $user->profile);

        $data = request()->validate([
            'title' => 'required',
            'description' => '',
            'url' => '',
            'profileImg' => '',
            'protected' => '',
        ]);

        if(!key_exists('protected',$data)){
            $data['protected'] = 0;
        }

        $imagePath = null;
        
        if(request('profileImg')){
            $imagePath = request('profileImg')->store('profile', 'public');
            $image = \Intervention\Image\Facades\Image::make(public_path("storage/{$imagePath}"))->fit(1000,1000);
            $image->save();
            Auth::user()->profile->update(array_merge($data,['profileImg' => $imagePath]));
        }else{
            Auth::user()->profile->update($data);
        }
        

        return redirect('/' . Auth::user()->username);
    }
}
