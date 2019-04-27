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
            'name' => "KaMisia",
            'email'=> "KaMisia",
            'EmployeeId' => '1',
            'password'=> bcrypt('qwerty1234'),
        ]);

        DB::table('Employees')->insert([
            'Name' => "Natasha",
            'Surname' => "Bison",
            'Rank' => "Dyrektor",
            'BirthDate' => "1985-10-15",
            'PhoneNumber' => "292229",
        ]);
    }
}
