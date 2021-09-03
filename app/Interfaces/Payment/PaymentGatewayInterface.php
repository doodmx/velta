<?php

namespace App\Interfaces\Payment;

interface PaymentGatewayInterface
{



    public function charge($customer, $paymentData);


}
