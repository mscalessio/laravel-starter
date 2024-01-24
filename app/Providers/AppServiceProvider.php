<?php

namespace App\Providers;

// use App\Models\User;
// use Illuminate\Support\Lottery;
use Illuminate\Support\ServiceProvider;
// use Laravel\Pennant\Feature;

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
        // Feature::define('new-api', fn (User $user) => match (true) {
        //     $user->isInternalTeamMember() => true,
        //     $user->isHighTrafficCustomer() => false,
        //     default => Lottery::odds(1 / 100),
        // });
    }
}
