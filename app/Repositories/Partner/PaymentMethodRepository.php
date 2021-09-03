<?php

namespace App\Repositories\Partner;

use App\Models\Partner\PaymentMethod;
use App\Interfaces\Partner\PaymentMethodInterface;

class PaymentMethodRepository implements PaymentMethodInterface
{
    protected $paymentMethod;

    public function __construct()
    {
        $this->paymentMethod = app(PaymentMethod::class)->make();

    }

    public function save($partnerPaymentGatewayId, $uuid)
    {
        return $this->paymentMethod->create([
            'partner_payment_gateway_id' => $partnerPaymentGatewayId,
            'uuid'                       => $uuid
        ]);
    }

    public function show($id)
    {
        // TODO: Implement show() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }
}

