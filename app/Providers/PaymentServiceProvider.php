<?php

namespace App\Providers;


use App\Billing\StripeIntent;
use App\Billing\StripeCustomer;
use App\Billing\StripeCreditCard;
use App\Repositories\CartRepository;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\Payment\CartInterface;
use App\Interfaces\Payment\PaymentInterface;
use App\Interfaces\Payment\CurrencyInterface;
use App\Repositories\Payment\PaymentRepository;
use App\Repositories\Payment\CurrencyRepository;
use App\Interfaces\Payment\PaymentIntentInterface;
use App\Interfaces\Payment\PaymentGatewayInterface;
use App\Repositories\Partner\PaymentMethodRepository;
use App\Interfaces\Payment\PaymentGatewayCustomerInterface;


class PaymentServiceProvider extends ServiceProvider
{


    /**
     * Bootstrap any application services.
     * @return void
     */
    public function boot()
    {

        $this->app->bind(CurrencyInterface::class, CurrencyRepository::class);
        $this->app->bind(CartInterface::class, CartRepository::class);
        $this->app->bind(PaymentInterface::class, PaymentRepository::class);
        $this->app->bind(PaymentIntentInterface::class, StripeIntent::class);

        $this->app->bind(PaymentGatewayInterface::class, function () {

            switch (request()->get('payment_method')) {

                case 'stripe_credit_card':
                    return new StripeCreditCard(new PaymentMethodRepository());
                    break;
            }

        });

        $this->app->bind(PaymentGatewayCustomerInterface::class, function () {
            switch (request()->get('payment_method')) {

                case 'stripe_credit_card':
                    return new StripeCustomer();
                    break;
            }
        });


    }
}
