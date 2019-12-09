<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Wesley Oliveira',
            'email' => 'wesley.ti@gmail.com',
            'password' => bcrypt('123456')
        ]);
    }
}
