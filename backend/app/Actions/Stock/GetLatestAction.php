<?php

namespace App\Actions\Stock;

use App\Actions\Eloquent\GetAction;
use App\Services\StockPriceService;

class GetLatestAction
{
    public function __construct(protected StockPriceService $stockPriceService) {}

    public function handle()
    {
        return $this->stockPriceService->getLatestStockPrices();
    }

}
