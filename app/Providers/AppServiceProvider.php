<?php

namespace App\Providers;

use App\Models\Customer;
use App\Models\Movie;
use App\Models\Rental;
use App\Observers\CustomerObserver;
use App\Observers\MovieObserver;
use App\Observers\RentalObserver;
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
        $this->observers();
    }

    public function observers(): void
    {
        Movie::observe(MovieObserver::class);
        Customer::observe(CustomerObserver::class);
        Rental::observe(RentalObserver::class);
    }
}
