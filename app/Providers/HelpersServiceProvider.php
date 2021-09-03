<?php

namespace App\Providers;



use Illuminate\Support\ServiceProvider;
use App\Interfaces\Helpers\StorageInterface;
use App\Interfaces\Helpers\EncryptionInterface;
use App\Repositories\Helpers\StorageRepository;
use App\Repositories\Helpers\EncryptionRepository;



class HelpersServiceProvider extends ServiceProvider
{


    /**
     * Bootstrap any application services.
     * @return void
     */
    public function boot()
    {

        $this->app->bind(StorageInterface::class, StorageRepository::class);
        $this->app->bind(EncryptionInterface::class, EncryptionRepository::class);


    }
}
