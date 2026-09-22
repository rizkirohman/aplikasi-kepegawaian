<?php

namespace App\Providers;

use App\Models\Pegawai;
use App\Observers\AuditLogObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Pegawai::observe(AuditLogObserver::class);
        Paginator::useBootstrapFive();
    }
}