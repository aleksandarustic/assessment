<?php

namespace App\Actions;

use App\Actions\Stock\GetInitialPricesAction;
use App\Models\Ticker;
use App\Models\TickerStockPrice;

class AppInstallAction
{
    public function __construct(protected GetInitialPricesAction $getInitialPrices)
    {
    }

    public function handle()
    {
        $tickers = Ticker::all()->keyBy('symbol');

        $response = $this->getInitialPrices->handle($tickers);

        $items = [];

        foreach ($response as $item) {
            foreach ($item->toArray()['prices'] as $price) {
                $items[] = $price;
            }
        }

        TickerStockPrice::upsert($items, ['ticker_ids', 'date']);
    }
}
