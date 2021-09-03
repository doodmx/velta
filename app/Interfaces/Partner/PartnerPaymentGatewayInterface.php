<?php

namespace App\Interfaces\Partner;

interface PartnerPaymentGatewayInterface
{

    public function save($partnerId, $gateway, $uuid);

    public function showById($id);

    public function showByGateway($partnerId, $gateway);


}
