<?php
/**
 * Created by PhpStorm.
 * User: josejesus
 * Date: 2020-05-27
 * Time: 13:55
 */

namespace App\Billing;


use App\Interfaces\Payment\PaymentIntentInterface;
use Stripe\SetupIntent;
use Stripe\Stripe;

class StripeIntent implements  PaymentIntentInterface
{


    public function __construct()
    {
        $stripeSecret = env('APP_ENV') === 'local' ? env('STRIPE_TEST_SECRET') : env('STRIPE_SECRET');
        Stripe::setApiKey($stripeSecret);
    }

    public function makeIntent()
    {
        $intent = SetupIntent::create();

        return $intent;
    }
}

