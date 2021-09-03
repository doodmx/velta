<?php

namespace App\Providers;


use App\Repositories\EnrollRepository;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\Partner\EnrollInterface;
use App\Repositories\Course\ChapterRepository;
use App\Interfaces\Partner\PaymentMethodInterface;
use App\Repositories\Partner\PaymentMethodRepository;
use App\Interfaces\Partner\PartnerQuizScoreInterface;
use App\Repositorie\Partner\PartnerQuizScoreRepository;
use App\Interfaces\Partner\PartnerPaymentGatewayInterface;
use App\Repositories\Partner\PartnerPaymentGatewayRepository;


class PartnerServiceProvider extends ServiceProvider
{


    /**
     * Bootstrap any application services.
     * @return void
     */
    public function boot()
    {
        $this->app->bind(PartnerPaymentGatewayInterface::class, PartnerPaymentGatewayRepository::class);
        $this->app->bind(PaymentMethodInterface::class, PaymentMethodRepository::class);
        $this->app->bind(PartnerQuizScoreInterface::class, PartnerQuizScoreRepository ::class);

        $this->app->bind(EnrollInterface::class, function ($app) {
            return new EnrollRepository(new ChapterRepository());
        });


    }
}
