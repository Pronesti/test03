<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Story;
use Faker\Generator as Faker;

$factory->define(Story::class, function (Faker $faker) {
    return [
        'image' => \Faker\Provider\Image::image(public_path("storage/"),600,600,null,false)
    ];
});
