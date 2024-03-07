<?php

namespace App\Actions\Stock;

use App\Actions\Eloquent\GetAction;
use App\Services\StockPriceService;

class CreateReportAction
{
    public function __construct(protected StockPriceService $stockPriceService) {}

    public function handle()
    {
        return $this->stockPriceService->getReport();
    }

}
