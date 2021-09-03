<?php

namespace App\Billing;

use Stripe\Stripe;
use Stripe\Customer;
use App\Exceptions\Payment\PaymentException;
use App\Interfaces\Payment\PaymentGatewayCustomerInterface;


class StripeCustomer implements PaymentGatewayCustomerInterface
{


    public function __construct()
    {
        $stripeSecret = env('APP_ENV') === 'local' ? env('STRIPE_TEST_SECRET') : env('STRIPE_SECRET');
        Stripe::setApiKey($stripeSecret);

    }


    public function save($customer)
    {



        try {

            $stripeCustomer = Customer::create([
                'name'  => $customer["name"],
                'email' => $customer["email"]
            ]);

            return $stripeCustomer->id;

        } catch (\Exception $e) {
            throw new PaymentException('Hubo un error al registrar sus datos de pago');
        }


    }


    public function show($email)
    {
        $customer = Customer::retrieve(['email' => $email]);

        return $customer;

    }

}
