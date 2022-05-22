<?php

namespace App\Providers;

use App\Services\CompanyServiceInterface;
use App\Services\CompanyService;
use App\Services\MailServiceInterface;
use App\Services\MailService;
use App\Services\StockServiceInterface;
use App\Services\StockService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CompanyServiceInterface::class,CompanyService::class);
        $this->app->bind(StockServiceInterface::class,StockService::class);
        $this->app->bind(MailServiceInterface::class,MailService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
