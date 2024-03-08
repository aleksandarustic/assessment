<?php

namespace Tests\Feature;

use App\Models\Ticker;
use App\Models\TickerStockPrice;
use Tests\TestCase;

/**
 * Class ReportTest
 * @package Tests\Feature
 */
class ReportTest extends TestCase
{
    /**
     *
     */
    public function testReport()
    {

        TickerStockPrice::query()->delete();

        $tickers = Ticker::all()->take(2);

        $tickers[0]->stockPrices()->create(
            [
                  "date" => "2024-03-07 16:10:00",
                  "open" => "10",
                  "high" => "10",
                  "low" => "10",
                  "close" => "10",
                  "price" => "10",
                  "volume" => "32323",
            ]
        );
        $tickers[0]->stockPrices()->create(
            [
                "date" => "2024-03-07 16:11:00",
                "open" => "10",
                "high" => "10",
                "low" => "10",
                "close" => "10",
                "price" => "20",
                "volume" => "32323",
            ]
        );

        $tickers[1]->stockPrices()->create(
            [
                "date" => "2024-03-07 16:10:00",
                "open" => "10",
                "high" => "10",
                "low" => "10",
                "close" => "10",
                "price" => "10",
                "volume" => "32323",
            ]
        );

        $tickers[1]->stockPrices()->create(
            [
                "date" => "2024-03-07 16:11:00",
                "open" => "10",
                "high" => "10",
                "low" => "10",
                "close" => "10",
                "price" => "5",
                "volume" => "32323",
            ]
        );

        $response = $this->get("/api/report");
        $response->assertOk();
        $response->assertJsonStructure([
            '*' => [
                "id",
                "date",
                "ticker_id",
                "open",
                "high",
                "low",
                "price",
                "previous_price",
                "percentage_change",
            ]
        ]);

        $response->assertJsonFragment(['ticker_id' => $tickers[0]->id, 'price' => 20, 'previous_price' => 10, 'percentage_change' => '100%']);
        $response->assertJsonFragment(['ticker_id' => $tickers[1]->id, 'price' => 5, 'previous_price' => 10, 'percentage_change' => '-50%']);
    }
}
