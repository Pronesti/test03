<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    $images = [];
    for($i = 0;$i<$faker->numberBetween(1,5);$i++){
        $images []= \Faker\Provider\Image::image(public_path("storage/"),600,600,null,false);
    }
    return [
        'caption' => $faker->sentence(12, true),
        'images' => $images,
        'location' => $faker->city(),
    ];
});
