<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $faker->addProvider(new \Faker\Provider\en_US\Address($faker));
        factory(App\User::class, 50)->create()->each(function ($user) use($faker){
            $user->profile->update(['profileImg' => \Faker\Provider\Image::image(public_path("storage/"),600,600,'people',false)]);
            $user->posts()->saveMany(
                factory(App\Post::class,5)->make(['user_id' => $user->id])
            );
        });


    }
}
