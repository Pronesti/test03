<?php

use Illuminate\Database\Seeder;

class OneUserManyPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $NUMBER_OF_POSTS = 50;
            $user = factory(\App\User::class)->make();
            $user->save();
            $user->profile->update(factory(\App\Profile::class)->raw());
            $user->posts()->saveMany(
                factory(App\Post::class,$NUMBER_OF_POSTS)->make(['user_id' => $user->id])
            );
    }
}
