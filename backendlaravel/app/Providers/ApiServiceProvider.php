<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\ExternalService\ApiService;
use App\ExternalService\Events\DataGet;
use App\ExternalService\Listeners\LogDataGet;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Route;


class ApiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ApiService::class, function ($app) {
            return new ApiService(config('services.api.url'));
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Route::get("api/posts", function(ApiService $apiService){
            return response()->json($apiService->getData());
        });

        Event::listen(DataGet::class, LogDataGet::class);
    }
}
