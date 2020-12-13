<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Profile;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {
    return [
        'description' => $faker->sentence(6,true),
        'url' => $faker->url,
        'profileImg' => \Faker\Provider\Image::image(public_path("storage/"),600,600,null,false)
        ];
});
