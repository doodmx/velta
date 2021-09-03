<?php

use App\Models\Investment\Plan;
use Illuminate\Database\Seeder;
use App\Models\Investment\Currency;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currency = Currency::where('iso_code', 'MXN')->first();

        $plans = [
            [
                'currency_id'       => $currency->id,
                'name'              => 'Inmueble virtual 9%',
                'min_amount'        => 50000,
                'profit_percentage' => 9,
                'liquidity'         => 'monthly_yearly',
            ],
            [
                'currency_id'       => $currency->id,
                'name'              => 'Inmueble virtual 12%',
                'min_amount'        => 50000,
                'profit_percentage' => 12,
                'liquidity'         => 'monthly_yearly',
            ],
            [
                'currency_id'       => $currency->id,
                'name'              => 'Inmueble virtual 15%',
                'min_amount'        => 50000,
                'profit_percentage' => 15,
                'liquidity'         => 'monthly_yearly',
            ]
        ];

        foreach ($plans as $plan) {
            Plan::create($plan);
        }
    }
}
