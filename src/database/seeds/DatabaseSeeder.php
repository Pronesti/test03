<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(MyUserSeeder::class);
        $USERS_NUMBER = 10;
        $POSTS_PER_USER = 5;
        $STORIES_PER_USER = 5;
        $FOLLOWS_PER_USER = 10;

        $faker = Faker\Factory::create();
        $faker->addProvider(new \Faker\Provider\en_US\Address($faker));
        factory(App\User::class, $USERS_NUMBER)->create()->each(function ($user) use($faker, $POSTS_PER_USER, $USERS_NUMBER,$FOLLOWS_PER_USER,$STORIES_PER_USER){
            $user->profile->update(factory(\App\Profile::class)->raw());
            $user->posts()->saveMany(
                factory(App\Post::class,$POSTS_PER_USER)->make(['user_id' => $user->id])
            );
            $user->stories()->saveMany(
                factory(App\Story::class,$STORIES_PER_USER)->make(['user_id' => $user->id])
            );
            for($i=0;$i < $FOLLOWS_PER_USER;$i++){
                $user->following()->toggle(\App\Profile::find($faker->numberBetween(0,$USERS_NUMBER)));
            }
        });
    }
}
