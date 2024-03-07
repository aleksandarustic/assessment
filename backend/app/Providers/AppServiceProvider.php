<?php

namespace App\Providers;

use App\Actions\Eloquent\GetAction;
use App\Actions\Eloquent\GetActionInterface;
use App\Actions\Eloquent\ShowAction;
use App\Actions\Eloquent\ShowActionInterface;
use App\Actions\Stock\SyncStockPricesAction;
use App\Services\AlphaVantageServiceExternal;
use App\Services\ExternalStockServiceInterface;
use App\Services\StockPriceService;
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

        $this->app->singleton(StockPriceService::class, StockPriceService::class);
        $this->app->singleton(GetActionInterface::class, GetAction::class);
        $this->app->singleton(ShowActionInterface::class, ShowAction::class);
        $this->app->singleton(SyncStockPricesAction::class, SyncStockPricesAction::class);

        $this->app->singleton(
            ExternalStockServiceInterface::class,
            fn() => new AlphaVantageServiceExternal(
                baseUrl: strval(config('services.alpha_vantage.base_url')),
                apiKey: strval(config('services.alpha_vantage.api_key')),
            ),
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->singleton(StockPriceService::class, StockPriceService::class);
    }
}
