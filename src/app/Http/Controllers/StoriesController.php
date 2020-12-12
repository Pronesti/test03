<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoriesController extends Controller
{
    public function store(){

        $data = request()->validate([
            'image' => ['required', 'file', 'mimes:jpeg,bmp,png,jpg'],
            ]);

        $path = $data['image']->store('uploads', 'public');
        $image = \Intervention\Image\Facades\Image::make(public_path("storage/{$path}"))->fit(1200,1200);
        $image->save();

        Auth::user()->stories()->create([
            'image' => $path,
        ]);
        return redirect('/' . Auth::user()->username);
    }
}
