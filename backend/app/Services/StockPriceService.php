<?php

namespace App\Services;

use App\DTO\IntradayRequestDto;
use App\DTO\OutputIntradayDto;
use App\DTO\QuoteStockRequestDto;
use App\DTO\QuoteStockResponseDto;
use App\Models\Ticker;
use App\Models\TickerStockPrice;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

/**
 *
 */
class StockPriceService
{
    /**
     * @param ExternalStockServiceInterface $service
     */
    public function __construct(protected ExternalStockServiceInterface $service)
    {
    }

    /**
     *
     */
    public const LATEST_CACHE_TIME = 60;

    /**
     * @param Ticker $ticker
     * @return QuoteStockResponseDto
     */
    public function getLatestStockPricesFromServer(Ticker $ticker): QuoteStockResponseDto
    {
        $input = QuoteStockRequestDto::fromModel($ticker);

        //$latestPrice = $this->service->call($input);

        $latestPrice = [
            "Global Quote" => [
                "01. symbol" => "IBM",
                "02. open" => "193.5000",
                "03. high" => "5555.1300",
                "04. low" => "192.9600",
                "05. price" => "534535353",
                "06. volume" => "6945818",
                "07. latest trading day" => "2024-03-06",
                "08. previous close" => "191.9500",
                "09. change" => "4.2100",
                "10. change percent" => "2.1933%"
            ]
        ];

        return QuoteStockResponseDto::fromArray($latestPrice);
    }

    /**
     * @param int|null $tickerId
     * @return int|string
     */
    public function latestCacheKey(?int $tickerId = null)
    {
        return $tickerId ?? '' . 'latest_price';
    }

    /**
     * @param TickerStockPrice $tickerStockPrice
     * @return void
     */
    public function addSinglePriceToCache(TickerStockPrice $tickerStockPrice)
    {
        Cache::put($this->latestCacheKey($tickerStockPrice->ticker_id),
            $tickerStockPrice->toArray(), self::LATEST_CACHE_TIME);
    }

    /**
     * @param array $tickerStockPrices
     * @return void
     */
    public function addPricesToCache(array $tickerStockPrices)
    {
        Cache::put($this->latestCacheKey(),
            $tickerStockPrices, self::LATEST_CACHE_TIME);
    }

    /**
     * @param Ticker $ticker
     * @param QuoteStockResponseDto $params
     * @return TickerStockPrice
     */
    public function createOrUpdateStockPrice(Ticker $ticker, QuoteStockResponseDto $params): TickerStockPrice
    {
        $tickerPrice = $ticker->stockPrices()->updateOrCreate(['date' => $params->date], $params->toArray());

        $this->addSinglePriceToCache($tickerPrice);

        return $tickerPrice;
    }

    /**
     * @return mixed
     */
    public function getLatestStockPrices()
    {
        return Cache::remember($this->latestCacheKey(), self::LATEST_CACHE_TIME, fn() => $this->getLatestFromDb());
    }

    /**
     * @return mixed
     */
    protected function getLatestFromDb()
    {
        return TickerStockPrice::orderBy('date', 'DESC')->groupBy('ticker_id')->get();
    }

    /**
     * @param Collection $data
     * @return array
     */
    public function getMultipleFromExternal(Collection $data) : array
    {
        $data = $data->map(fn($ticker) => IntradayRequestDto::fromModel($ticker))->toArray();

        $poolResponse = $this->service->callAsPool($data);

        return array_map(fn($res) => OutputIntradayDto::fromArray($res), $poolResponse);
    }

    /**
     * @return Collection
     */
    public function getReport() : Collection
    {
        return TickerStockPrice::select(DB::raw('*, lag(price, 1,0) over (PARTITION BY ticker_id ORDER BY date ASC) as previous_price'))->orderBy('date', 'DESC')->get();
    }

}
