<?php

namespace App\Actions\Stock;


use App\Services\StockPriceService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Client\RequestException;
use Illuminate\Validation\ValidationException;

/**
 *
 */
class GetInitialPricesAction
{

    /**
     * @param StockPriceService $service
     */
    public function __construct(protected StockPriceService $service)
    {
    }

    /**
     * @param Collection $tickers
     * @return array
     */
    public function handle(Collection $tickers) : array
    {
        $chunkedTickers = $tickers->chunk(10);
        $responses = [];

        foreach ($chunkedTickers as $chunk){
            $poolResponse = $this->service->getMultipleFromExternal($chunk);

            foreach ($poolResponse as $key => $response){
                $responses[$key] = $response;
            }
        }

        return $responses;
    }

}
