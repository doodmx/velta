<?php

namespace App\Interfaces\Payment;

interface PaymentInterface
{


    public function paginate($filter);

    public function store($cart, $payment);

    public function show($id);

}
