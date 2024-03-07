<?php

namespace App\Actions\Stock;

use App\Services\StockPriceService;

/**
 *
 */
class GetLatestAction
{
    /**
     * @param StockPriceService $stockPriceService
     */
    public function __construct(protected StockPriceService $stockPriceService) {}

    /**
     * @return mixed
     */
    public function handle()
    {
        return $this->stockPriceService->getLatestStockPrices();
    }

}
