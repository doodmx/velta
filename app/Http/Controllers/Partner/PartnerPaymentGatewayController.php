<?php

namespace App\Http\Controllers\Partner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\Partner\PartnerPaymentGatewayInterface;

class PartnerPaymentGatewayController extends Controller
{

    private $gateways;

    public function __construct(PartnerPaymentGatewayInterface $customerPayment)
    {
        $this->gateways = $customerPayment;
    }

    public function store()
    {

        $this->gateways->save();

    }

    public function show($email)
    {

        $customer = $this->gateways->show($email);

    }
}
