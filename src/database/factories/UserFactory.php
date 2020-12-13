<?php

use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'username' => $faker->userName,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->state(\App\User::class, 'my_user',
    [
        'name' => 'Diego Pronesti',
        'username' => 'diegodieh',
        'email' => 'dieh.diego@gmail.com',
        'email_verified_at' => now(),
        'password' => '$2y$10$YSoEYBiirKDcftwqqMIYDOTueCXFk4TvJg9FS37Hc8i.sDsCfn44m', // password
        'remember_token' => Str::random(10),
    ]);
    

$factory->state(\App\User::class, 'with_profile',[])
        ->afterCreatingState(\App\User::class, 'with_profile', function ($user,Faker $faker){
            $user->profile->update(factory(\App\Profile::class)->raw());
        });

$factory->state(\App\User::class, 'with_posts',[])
        ->afterCreatingState(\App\User::class, 'with_posts', function ($user,Faker $faker){
            factory(\App\Post::class, 5)->create(['user_id' => $user->id]);
        });

$factory->state(\App\User::class, 'with_stories',[])
        ->afterCreatingState(\App\User::class, 'with_stories', function ($user,Faker $faker){
            factory(\App\Story::class, 5)->create(['user_id' => $user->id]);
});

$factory->state(\App\User::class, 'with_follow',[])
        ->afterCreatingState(\App\User::class, 'with_follows', function ($user,Faker $faker){
            $FOLLOWS_PER_USER = 10;
            for($i=0;$i < $FOLLOWS_PER_USER;$i++){
                 $user->following()->toggle(\App\Profile::find($faker->numberBetween(0,\App\User::count())));
             }
});

$factory->state(\App\User::class, 'with_likes',[])
        ->afterCreatingState(\App\User::class, 'with_likes', function ($user,Faker $faker){
            $LIKES_PER_USER = 10;
            for($i=0;$i < $LIKES_PER_USER;$i++){
                 $post = \App\Post::inRandomOrder()->whereIn('user_id',$user->following->pluck('id'))->limit(1)->get();
                 $user->likedPosts()->toggle($post);
             }
});

$factory->state(\App\User::class, 'with_saves',[])
        ->afterCreatingState(\App\User::class, 'with_saves', function ($user,Faker $faker){
            $SAVES_PER_USER = 10;
            for($i=0;$i < $SAVES_PER_USER;$i++){
                 $post = \App\Post::inRandomOrder()->whereIn('user_id',$user->following->pluck('id'))->limit(1)->get();
                 $user->saves()->toggle($post);
             }
});