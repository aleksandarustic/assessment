<?php

namespace App\Actions\Stock;

use App\Services\StockPriceService;
use Illuminate\Support\Collection;

/**
 *
 */
class CreateReportAction
{
    /**
     * @param StockPriceService $stockPriceService
     */
    public function __construct(protected StockPriceService $stockPriceService) {}

    /**
     * @return Collection
     */
    public function handle() : Collection
    {
        return $this->stockPriceService->getReport();
    }

}
