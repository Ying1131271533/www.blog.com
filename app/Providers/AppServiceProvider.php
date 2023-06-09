<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Schema;
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
    public function boot()
    {
        // Schema::defaultStringLength(191);

        // 将分页默认视图修改为bootstrap
        Paginator::useBootstrapFour(); // Bootstrap4
        // Paginator::useBootstrapFive(); // Bootstrap5
        Paginator::defaultView('vendor.pagination.my-page');
        Paginator::defaultSimpleView('vendor.pagination.my-page');
    }
}
