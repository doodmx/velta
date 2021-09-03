<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\Investment\PlanInterface;
use App\Interfaces\Investment\ReportInterface;
use App\Repositories\Investment\PlanRepository;
use App\Repositories\Investment\ReportRepository;
use App\Interfaces\Investment\InvestmentInterface;
use App\Interfaces\Investment\TransactionInterface;
use App\Repositories\Investment\InvestmentRepository;
use App\Repositories\Investment\TransactionRepository;

class InvestmentProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(PlanInterface::class, PlanRepository::class);
        $this->app->bind(InvestmentInterface::class, InvestmentRepository::class);
        $this->app->bind(TransactionInterface::class, TransactionRepository::class);
        $this->app->bind(ReportInterface::class, ReportRepository::class);
    }
}
