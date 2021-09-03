<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Models\Investment\Transaction;

$factory->define(Transaction::class, function (Faker $faker) {
    return [
        'amount'     => 50000,
        'balance'    => 50000,
        'start_date' => null,
        'end_date'   => null,
        'type'       => 'deposit',
        'status'     => 'applied',
        'created_at' => now()
    ];
});
