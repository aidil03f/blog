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
        \App\User::create([
            'name' => 'maiev',
            'username' => 'username_maiev',
            'password' => bcrypt('password'),
            'email'    => 'maiev@gmail.com',
        ]);
    }
}
