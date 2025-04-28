<?php

namespace App\Providers;

use App\Repositories\RoomRepository;
use App\Repositories\BookingRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\RoomRepositoryInterface;
use App\Repositories\Interfaces\BookingRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            RoomRepositoryInterface::class,
            RoomRepository::class
        );

        $this->app->bind(
            BookingRepositoryInterface::class,
            BookingRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }
}
