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
        DB::table('users')->insert([
            'name' => "testowe",
            'email'=> "allahaka",
            'password'=> bcrypt('qwerty1234'),
        ]);
    }
}
