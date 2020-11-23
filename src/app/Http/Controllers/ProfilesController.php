<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    public function show(\App\User $user)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
        if(!$user->exists){
            $user = auth()->user();
        }
        return view('profiles.show', compact('user', 'follows'));
    }

    public function edit(\App\User $user){
        $this->authorize('update', $user->profile);
        return view('profiles.edit', compact('user'));
    }

    public function update(\App\User $user){
        $this->authorize('update', $user->profile);
        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'required',
            'profileImg' => '',
        ]);

        $imagePath = null;
        
        if(request('profileImg')){
            $imagePath = request('profileImg')->store('profile', 'public');
            $image = \Intervention\Image\Facades\Image::make(public_path("storage/{$imagePath}"))->fit(1000,1000);
            $image->save();
        }
        
        auth()->user()->profile->update(array_merge($data,['profileImg' => $imagePath]));

        return redirect('/profile/' . auth()->user()->id);
    }
}
