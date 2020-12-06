<?php

use Illuminate\Database\Seeder;

class MyUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name' => 'Diego Pronesti',
            'username' => 'diegodieh',
            'email' => 'dieh.diego@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$YSoEYBiirKDcftwqqMIYDOTueCXFk4TvJg9FS37Hc8i.sDsCfn44m', // password
            'remember_token' => Str::random(10),
        ]);
    }
}
