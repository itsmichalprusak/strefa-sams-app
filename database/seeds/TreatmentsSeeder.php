<?php

use Illuminate\Database\Seeder;

class TreatmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Treatments')->insert([
            'Id' => 1,
            'TreatmentCategory' => "NWK",
            'UnInsurancePriceMin'=> "300",
            'UnInsurancePriceMax'=> "300",
            'InsurancePriceMin'=> "300",
            'InsurancePriceMax'=> "300",
            'Description'=> "Nieuzasadnione wezwanie karetki",
        ]);

        DB::table('Treatments')->insert([
            'Id' => 2,
            'TreatmentCategory' => "NWH",
            'UnInsurancePriceMin'=> "2000",
            'UnInsurancePriceMax'=> "2000",
            'InsurancePriceMin'=> "2000",
            'InsurancePriceMax'=> "2000",
            'Description'=> "Nieuzasadnione wezwanie helikoptera",
        ]);

        DB::table('Treatments')->insert([
            'Id' => 3,
            'TreatmentCategory' => "WH",
            'UnInsurancePriceMin'=> "500",
            'UnInsurancePriceMax'=> "500",
            'InsurancePriceMin'=> "0",
            'InsurancePriceMax'=> "0",
            'Description'=> "Wylot Helikoptera",
        ]);

        DB::table('Treatments')->insert([
            'Id' => 4,
            'TreatmentCategory' => "WK",
            'UnInsurancePriceMin'=> "50",
            'UnInsurancePriceMax'=> "50",
            'InsurancePriceMin'=> "0",
            'InsurancePriceMax'=> "0",
            'Description'=> "Wyjazd karetki",
        ]);

        DB::table('Treatments')->insert([
            'Id' => 5,
            'TreatmentCategory' => "I",
            'UnInsurancePriceMin'=> "50",
            'UnInsurancePriceMax'=> "250",
            'InsurancePriceMin'=> "0",
            'InsurancePriceMax'=> "0",
            'Description'=> "Opatrunki, otarcia, gipsy, maści",
        ]);

        DB::table('Treatments')->insert([
            'Id' => 6,
            'TreatmentCategory' => "II",
            'UnInsurancePriceMin'=> "250",
            'UnInsurancePriceMax'=> "600",
            'InsurancePriceMin'=> "0",
            'InsurancePriceMax'=> "0",
            'Description'=> "Szwy, oparzenia, złamania",
        ]);

        DB::table('Treatments')->insert([
            'Id' => 7,
            'TreatmentCategory' => "III",
            'UnInsurancePriceMin'=> "600",
            'UnInsurancePriceMax'=> "1200",
            'InsurancePriceMin'=> "60",
            'InsurancePriceMax'=> "120",
            'Description'=> "Operacje bezpośrednio ratujące życie",
        ]);

        DB::table('Treatments')->insert([
            'Id' => 8,
            'TreatmentCategory' => "IV",
            'UnInsurancePriceMin'=> "99999",
            'UnInsurancePriceMax'=> "99999",
            'InsurancePriceMin'=> "120",
            'InsurancePriceMax'=> "1200",
            'Description'=> "Operacje zaplanowane",
        ]);

        DB::table('Treatments')->insert([
            'Id' => 9,
            'TreatmentCategory' => "W.P",
            'UnInsurancePriceMin'=> "250",
            'UnInsurancePriceMax'=> "1000",
            'InsurancePriceMin'=> "250",
            'InsurancePriceMax'=> "1000",
            'Description'=> "Wizyty prywatne",
        ]);

        DB::table('Treatments')->insert([
            'Id' => 10,
            'TreatmentCategory' => "D.O",
            'UnInsurancePriceMin'=> "300",
            'UnInsurancePriceMax'=> "300",
            'InsurancePriceMin'=> "0",
            'InsurancePriceMax'=> "0",
            'Description'=> "Dzień opieki nad pacjentem",
        ]);

        DB::table('Treatments')->insert([
            'Id' => 11,
            'TreatmentCategory' => "U.T",
            'UnInsurancePriceMin'=> "5000",
            'UnInsurancePriceMax'=> "5000",
            'InsurancePriceMin'=> "5000",
            'InsurancePriceMax'=> "5000",
            'Description'=> "Usunięcie Tatuażu",
        ]);
    }
}
