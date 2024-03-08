<?php

namespace Tests\Feature;

use App\Actions\AppInstallAction;
use App\Actions\Stock\SyncStockPricesAction;
use App\Jobs\ImportTickers;
use App\Models\Ticker;
use App\Models\TickerStockPrice;
use App\Services\StockPriceService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;
use Illuminate\Support\Facades\Http;

/**
 * Class TickerPricesTest
 * @package Tests\Feature
 */
class TickersPricesTest extends TestCase
{
    /**
     *
     */
    public function testIndexTickersStockPrices()
    {
        $response = $this->get("/api/tickers-stock-prices");
        $response->assertOk();
        $response->assertJsonStructure([
            '*' => [
                "id",
                "date",
                "ticker_id",
                "open",
                "high",
                "low",
                "price"
            ]
        ]);
    }


    /**
     *
     */
    public function testLatestStockPrices()
    {
        $response = $this->get("/api/tickers-stock-prices/latest");
        $response->assertJsonStructure([
            '*' => [
                "id",
                "date",
                "ticker_id",
                "open",
                "high",
                "low",
                "price"
            ]
        ]);
    }


    public function testSyncPricesJobPushed()
    {
        Queue::fake();

        $syncAction = app()->make(SyncStockPricesAction::class);

        $syncAction->handle();

        Queue::assertPushed(ImportTickers::class, 1);

    }

    public function testSyncPricesExecution()
    {
        Http::preventStrayRequests();

        $tickers = Ticker::all()->take(10);

        TickerStockPrice::query()->delete();

        $sequence = Http::sequence();

        foreach ($tickers as $ticker) {
            $sequence->push([
                'Global Quote' => [
                    "01. symbol" => $ticker->symbol,
                    "02. open" => "197.5800",
                    "03. high" => "198.7300",
                    "04. low" => "196.1400",
                    "05. price" => "196.5400",
                    "06. volume" => "4604458",
                    "07. latest trading day" => "2024-03-07",
                    "08. previous close" => "196.1600",
                    "09. change" => "0.3800",
                    "10. change percent" => "0.1937%"
                ]
            ]);
        }

        Http::fake([
            env('ALPHA_VANTAGE_BASE_URL') . '*' => $sequence
        ]);


        $stockPriceService = app()->make(StockPriceService::class);

        $job = new ImportTickers($tickers);

        $job->handle($stockPriceService);

        foreach ($tickers as $ticker) {
            $this->assertDatabaseHas('ticker_stock_prices',
                ['ticker_id' => $ticker->id, 'open' => '197.5800', 'high' => '198.7300', 'low' => '196.1400']);
        }

        Cache::shouldReceive('put')->with('latest_prices');
    }

    public function testInitialPricesImport()
    {
        Http::preventStrayRequests();

        $tickers = Ticker::all();

        TickerStockPrice::query()->delete();

        $sequence = Http::sequence();

        foreach ($tickers as $ticker) {
            $sequence->push([
                "Meta Data" => [
                    "1. Information" => "Intraday (5min) open, high, low, close prices and volume",
                    "2. Symbol" => $ticker->symbol,
                    "3. Last Refreshed" => "2024-03-07 19:55:00",
                    "4. Interval" => "5min",
                    "5. Output Size" => "Compact",
                    "6. Time Zone" => "US/Eastern"
                ],
                "Time Series (5min)" => [
                    '2024-03-07 19:55:00' => [
                        "1. open" => "196.9000",
                        "2. high" => "196.9000",
                        "3. low" => "196.9000",
                        "4. close" => "196.9000",
                        "5. volume" => "65"
                    ]
                ]
            ]);
        }

        Http::fake([
            env('ALPHA_VANTAGE_BASE_URL') . '*' => $sequence
        ]);


        $appInstallAction = app()->make(AppInstallAction::class);
        $appInstallAction->handle();

        foreach ($tickers as $ticker) {
            $this->assertDatabaseHas('ticker_stock_prices',
                ['ticker_id' => $ticker->id, 'open' => '196.9000', 'high' => '196.9000', 'low' => '196.9000']);
        }

    }


}
