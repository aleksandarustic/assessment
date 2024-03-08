<?php

namespace Feature;

use App\Models\Ticker;
use Tests\TestCase;

/**
 * Class TickersFetchTest
 * @package Tests\Feature
 */
class TickersFetchTest extends TestCase
{
    /**
     *
     */
    public function testIndexTickers()
    {
        $count = Ticker::count();

        $response = $this->get("/api/tickers");
        $response->assertOk();
        $response->assertJsonStructure([
            '*' => [
                "id",
                "symbol",
                "name",
                "type",
                "region",
                "currency"
            ]
        ]);

        $response->assertJsonCount($count);
    }


    /**
     *
     */
    public function testShowTicker()
    {
        $ticker = Ticker::firstOrFail();

        $response = $this->get("/api/tickers/{$ticker->id}");
        $response->assertOk();
        $response->assertJsonFragment([
            'symbol' => $ticker->symbol,
            'name' => $ticker->name,
            'id' => $ticker->id,
            'type' => $ticker->type,
            'region' => $ticker->region,
        ]);

        $response = $this->get("/api/currencies/23232323");
        $response->assertNotFound();

    }

}
