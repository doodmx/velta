<?php

use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currency')->insert([
            'iso_code'    => 'USD',
            'description' => 'Dólar'
        ]);

        DB::table('currency')->insert([
            'iso_code'    => 'EUR',
            'description' => 'Euro'
        ]);

        DB::table('currency')->insert([
            'iso_code'    => 'MXN',
            'description' => 'Peso mexicano'
        ]);

        DB::table('currency')->insert([
            'iso_code'    => 'CLP',
            'description' => 'Peso chileno'
        ]);
    }
}
