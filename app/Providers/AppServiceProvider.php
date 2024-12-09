<?php

namespace App\Providers;

use App\Models\Direction;
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
    public function boot() {        
        view()->composer('layouts.main', function ($view) {
            $directions = Direction::all(); // Fetch directions from the database
            $view->with('directions', $directions);
        });
    }
}
