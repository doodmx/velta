<?php

namespace App\Billing;

use App\Interfaces\Partner\PaymentMethodInterface;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\PaymentIntent;
use Stripe\PaymentMethod;
use App\Exceptions\Payment\PaymentException;
use App\Interfaces\Payment\CreditCardInterface;
use App\Interfaces\Payment\PaymentGatewayInterface;


class StripeCreditCard implements PaymentGatewayInterface, CreditCardInterface
{


    private $paymentMethods;


    public function __construct(PaymentMethodInterface $paymentMethodContract)
    {
        $stripeSecret = env('APP_ENV') === 'local' ? env('STRIPE_TEST_SECRET') : env('STRIPE_SECRET');
        Stripe::setApiKey($stripeSecret);

        $this->paymentMethods = $paymentMethodContract;


    }


    public function saveCard($customerId, $cardId)
    {

        $card = PaymentMethod::retrieve($cardId);
        $card->attach(['customer' => $customerId]);


        return [
            'id'         => $card->id,
            'last4'      => $card->card->last4,
            'expires_at' => $card->card->exp_month . '/' . $card->card->exp_year,
            'holdername' => $card->billing_details->name,
            'brand'      => $card->card->brand,
            'is_default' => false
        ];

    }

    public function updateDefaultCard($customerId, $cardId)
    {

        $card = Customer::update($customerId, [
            'invoice_settings' => [
                'default_payment_method' => $cardId
            ]
        ]);

        return $card;

    }


    public function deleteCard($cardId)
    {

        $card = PaymentMethod::retrieve($cardId);
        $card->detach();
    }


    public function allCards($customerId)
    {

        $cards = PaymentMethod::all([
            'customer' => $customerId,
            'type'     => 'card'
        ]);

        //Getting default card
        $customer = Customer::retrieve($customerId);
        $defaultPayment = $customer['invoice_settings']['default_payment_method'];

        $cards = collect($cards["data"]);
        $cards->transform(function ($card) use ($defaultPayment) {

            return [
                'id'         => $card->id,
                'last4'      => $card->card->last4,
                'expires_at' => $card->card->exp_month . '/' . $card->card->exp_year,
                'holdername' => $card->billing_details->name,
                'brand'      => $card->card->brand,
                'is_default' => $card->id === $defaultPayment
            ];
        });

        return $cards;
    }


    public function charge($customerId, $paymentData)
    {


        try {

            $paymentMethod = $this->saveCard($customerId, $paymentData['paymentToken']);


            $payment = PaymentIntent::create([
                'amount'         => $paymentData['amount'] * 100,
                'currency'       => $paymentData['currency_code'],
                'customer'       => $customerId,
                'payment_method' => $paymentMethod['id'],
                'description'    => $paymentData['description'],
                'off_session'    => false,
                'confirm'        => true
            ]);


            if (isset($paymentData['remember_card'])) {
                $this->paymentMethods->save($customerId, $paymentMethod['id']);
            } else {
                $this->deleteCard($paymentMethod['id']);
            }


            return $payment->id;

        } catch (\Exception $error) {

            throw new PaymentException($error->getMessage(), 500);

        }


    }


}
