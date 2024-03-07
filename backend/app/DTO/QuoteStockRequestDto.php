<?php

namespace App\DTO;

use App\Enums\AlphaVantageFunction;
use App\Models\Ticker;

class QuoteStockRequestDto implements AlphaVantageDtoInterface
{
    public function __construct(
        public string $symbol,
        public AlphaVantageFunction $function
    ) {
    }

    public static function fromModel(Ticker $ticker, array $data = []) : self
    {
        return new self(
            symbol: data_get($ticker, 'symbol'),
            function: data_get($data, 'function', AlphaVantageFunction::QUOTE)
        );
    }

    public function toArray() : array
    {
        return ['symbol' => $this->symbol, 'function' => $this->function->value];
    }
}
