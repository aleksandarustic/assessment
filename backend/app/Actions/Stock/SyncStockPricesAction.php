<?php

namespace App\Actions\Stock;

use App\Jobs\ImportTickers;
use App\Models\Ticker;
use App\Models\TickerStockPrice;
use App\Services\StockPriceService;

/**
 *
 */
class SyncStockPricesAction
{
    /**
     * @return void
     */
    public function handle()
    {
        $tickers = Ticker::all();
        $chunkedTickers = $tickers->chunk(10);

        foreach ($chunkedTickers as $tickers) {
            ImportTickers::dispatch($tickers);
        }
    }
}
