<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $POSTS_NUMBER = 50;
        factory(App\Post::class, $POSTS_NUMBER)->create(['user_id' => factory('App\User')->create()->id]);
    }
}
