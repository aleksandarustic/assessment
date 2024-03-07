<?php

namespace App\DTO;

use App\Enums\AlphaVantageFunction;
use App\Models\Ticker;

/**
 *
 */
class IntradayRequestDto implements AlphaVantageDtoInterface
{
    /**
     * @param string $symbol
     * @param AlphaVantageFunction $function
     * @param string $interval
     * @param string $outputsize
     */
    public function __construct(
        public string $symbol,
        public AlphaVantageFunction $function,
        public string $interval,
        public string $outputsize
    ) {
    }

    /**
     * @param Ticker $ticker
     * @param array $data
     * @return self
     */
    public static function fromModel(Ticker $ticker, array $data = []) : self
    {
        return new self(
            symbol: data_get($ticker, 'symbol'),
            function: data_get($data, 'function', AlphaVantageFunction::INTRADAY),
            interval: data_get($data, 'interval', '1min'),
            outputsize: data_get($data, 'outputsize', 'compact'),
        );
    }

    /**
     * @return array
     */
    public function toArray() : array
    {
        return ['symbol' => $this->symbol, 'function' => $this->function->value, 'interval' => $this->interval, 'outputsize' => $this->outputsize];
    }
}
