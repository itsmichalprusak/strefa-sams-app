<?php

use Illuminate\Database\Seeder;

class BloodGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('BloodGroups')->insert([
            'Id' => 1,
            'BloodGroup' => "0 Rh+" ,
        ]);
        DB::table('BloodGroups')->insert([
            'Id' => 2,
            'BloodGroup' => "0 Rh-" ,
        ]);
        DB::table('BloodGroups')->insert([
            'Id' => 3,
            'BloodGroup' => "A Rh+" ,
        ]);
        DB::table('BloodGroups')->insert([
            'Id' => 4,
            'BloodGroup' => "A Rh-" ,
        ]);
        DB::table('BloodGroups')->insert([
            'Id' => 5,
            'BloodGroup' => "B Rh+" ,
        ]);
        DB::table('BloodGroups')->insert([
            'Id' => 6,
            'BloodGroup' => "B Rh-" ,
        ]);
        DB::table('BloodGroups')->insert([
            'Id' => 7,
            'BloodGroup' => "AB Rh+" ,
        ]);
        DB::table('BloodGroups')->insert([
            'Id' => 8,
            'BloodGroup' => "AB Rh-" ,
        ]);
    }
}
