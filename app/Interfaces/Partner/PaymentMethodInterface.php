<?php

namespace App\Interfaces\Partner;

interface PaymentMethodInterface
{

    public function save($partnerPaymentGatewayId, $uuid);

    public function show($id);

    public function delete($id);


}
