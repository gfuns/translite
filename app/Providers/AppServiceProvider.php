<?php
namespace App\Providers;

use App\Http\Controllers\PermissionController;
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
        $this->app->singleton('Menu', function ($app) {
            return new PermissionController();
        });
    }
}
