<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot(){
        parent::boot();
        static::created(function($user){
            $user->profile()->create([
                'title' => $user->name,
                'protected' => false
            ]);
        });
    }

    public function profile(){
        return $this->hasOne(Profile::class);
    }

    public function posts(){
        return $this->hasMany(Post::class)->orderBy('created_at', 'DESC');
    }

    public function stories(){
        return $this->hasMany(Story::class)->orderBy('created_at', 'DESC');
    }

    public function commented(){
        return $this->belongsToMany(Comment::class);
    }

    public function following(){
        return $this->belongsToMany(Profile::class)->withTimestamps()->withPivot('accepted');
    }

    public function likedPosts(){
        return $this->belongsToMany(Post::class)->withTimestamps();
    }

    public function saves(){
        return $this->belongsToMany(Post::class,'saves')->withTimestamps()->orderBy('created_at', 'DESC');
    }

    public function likingComments(){
        return $this->belongsToMany(Comment::class)->withTimestamps();
    }

}
