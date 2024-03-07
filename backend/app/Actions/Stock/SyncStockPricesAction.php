<?php

namespace App\Actions\Stock;

use App\DTO\QuoteStockRequestDto;
use App\DTO\QuoteStockResponseDto;
use App\Models\Ticker;
use App\Services\CacheService;
use App\Services\StockPriceService;
use App\Services\ExternalStockServiceInterface;
use Illuminate\Support\Facades\Cache;

class SyncStockPricesAction
{

    public function __construct(protected StockPriceService $stockPriceService)
    {
    }

    public function handle()
    {
        $tickers = collect([Ticker::first()]);

        $results = [];

        foreach ($tickers as $ticker){
            $tickerPrice = $this->updatePrice($ticker);
            $results[] = $tickerPrice;
        }

        $this->stockPriceService->addPricesToCache($results);
    }

    protected function updatePrice(Ticker $ticker)
    {
        $tickerPrice = $this->stockPriceService->getLatestStockPricesFromServer($ticker);

        return $this->stockPriceService->createOrUpdateStockPrice($ticker, $tickerPrice);
    }
}
