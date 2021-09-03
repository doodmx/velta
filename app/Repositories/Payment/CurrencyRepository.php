<?php

namespace App\Repositories\Payment;

use App\Models\Payment\Currency;
use App\Interfaces\Payment\CurrencyInterface;


class CurrencyRepository implements CurrencyInterface
{

    private $currency;

    public function __construct()
    {
        $this->currency = app()->make(Currency::class);
    }

    public function all()
    {

        return $this->currency->orderBy('iso_code')->get();
    }


}
