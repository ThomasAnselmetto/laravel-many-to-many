<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    // facciamo la paginazione prefissata con bootstrap ma lo facciamo in namespace App\Providers\ServiceProvider
    public function boot()
    {
        Paginator::useBootstrap();
    }
}