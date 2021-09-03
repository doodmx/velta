<?php

namespace App\Repositories\Partner;

use App\Exceptions\Partner\PartnerPaymentGatewayNotFoundException;
use App\Models\Partner\PartnerPaymentGateway;
use App\Interfaces\Partner\PartnerPaymentGatewayInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PartnerPaymentGatewayRepository implements PartnerPaymentGatewayInterface
{
    protected $gateway;

    public function __construct()
    {
        $this->gateway = app(PartnerPaymentGateway::class)->make();

    }

    public function save($partnerId, $gateway, $uuid)
    {
        $partnerPaymentGateway = $this->gateway->create([
            'partner_id' => $partnerId,
            'gateway'    => $gateway,
            'uuid'       => $uuid
        ]);

        return $partnerPaymentGateway;


    }

    public function showById($id)
    {

        try {

            $partnerPaymentGateway = $this->gateway->findOrFail($id);
            return $partnerPaymentGateway;

        } catch (ModelNotFoundException $e) {
            throw new PartnerPaymentGatewayNotFoundException();
        }

    }

    public function showByGateway($partnerId, $gateway)
    {

        $partnerPaymentGateway = $this->gateway
            ->where('gateway', $gateway)
            ->where('partner_id', $partnerId)
            ->first();

        return $partnerPaymentGateway;

    }
}
