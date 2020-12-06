<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'caption' => $faker->sentence(6, true),
        'image' => \Faker\Provider\Image::image(public_path("storage/"),600,600,null,false),
        'location' => $faker->city(),
    ];
});
