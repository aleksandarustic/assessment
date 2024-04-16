<?php

namespace App\Providers;

use App\Actions\Eloquent\CreateAction;
use App\Actions\Eloquent\CreateActionInterface;
use App\Actions\Eloquent\GetAction;
use App\Actions\Eloquent\GetActionInterface;
use App\Actions\Eloquent\ShowAction;
use App\Actions\Eloquent\ShowActionInterface;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        JsonResource::withoutWrapping();

        $this->app->singleton(GetActionInterface::class, GetAction::class);
        $this->app->singleton(ShowActionInterface::class, ShowAction::class);
        $this->app->singleton(CreateActionInterface::class, CreateAction::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }
}
