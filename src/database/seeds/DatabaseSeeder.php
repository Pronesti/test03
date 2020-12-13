<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(MyUserSeeder::class);
        DB::beginTransaction();
        factory('App\User',10)->states('with_profile','with_posts','with_stories','with_follows','with_likes','with_saves')->create();
        factory('App\User',1)->states('my_user','with_profile','with_posts','with_stories','with_follows','with_likes','with_saves')->create();
        DB::commit();
    }
}
