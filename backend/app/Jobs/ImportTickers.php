<?php

namespace App\Jobs;

use App\Models\Ticker;
use App\Models\TickerStockPrice;
use App\Services\StockPriceService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\Middleware\RateLimited;


/**
 *
 */
class ImportTickers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(protected Collection $tickers) {}

    /**
     * Execute the job.
     */
    public function handle(StockPriceService $stockPriceService): void
    {
        $results = [];

        foreach ($this->tickers as $ticker){
            $tickerPrice = $this->updatePrice($stockPriceService, $ticker);
            $results[] = $tickerPrice;
        }

        $stockPriceService->addPricesToCache($results);
    }

    /**
     * @param StockPriceService $stockPriceService
     * @param Ticker $ticker
     * @return TickerStockPrice
     */
    protected function updatePrice(StockPriceService $stockPriceService,Ticker $ticker): TickerStockPrice
    {
        $tickerPrice = $stockPriceService->getLatestStockPricesFromServer($ticker);

        return $stockPriceService->createOrUpdateStockPrice($ticker, $tickerPrice);
    }

    /**
     * @return array
     */
    public function middleware(): array
    {
        return [(new RateLimited('import-prices'))->dontRelease()];
    }
}
