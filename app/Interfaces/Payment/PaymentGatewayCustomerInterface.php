<?php

namespace App\Interfaces\Payment;

interface PaymentGatewayCustomerInterface
{

    public function save($customer);

    public function show($email);


}
