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
        $USERS_NUMBER = 50;
        factory(App\User::class, $USERS_NUMBER)->create()->each(function($user){
            $user->profile->update(factory(\App\Profile::class)->raw());
        });
    }
}
