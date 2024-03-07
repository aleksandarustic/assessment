<?php

namespace App\Actions\Stock;


use App\DTO\IntradayRequestDto;
use App\DTO\OutputIntradayDto;
use App\Services\ExternalStockServiceInterface;
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

    public function __construct(protected StockPriceService $service)
    {
    }

    /**
     * @param Collection
     * @throws AuthorizationException
     * @throws RequestException
     * @throws AuthenticationException
     * @throws ValidationException
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
