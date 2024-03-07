<?php

namespace App\DTO;

use App\Models\Ticker;

class QuoteStockResponseDto implements AlphaVantageDtoInterface
{
    public function __construct(
        public string $symbol,
        public string $open,
        public string $high,
        public string $low,
        public string $price,
        public string $close,
        public string $volume,
        public string $date
    ) {
    }

    public static function fromArray(array $data) : self
    {
        return new self(
            symbol: $data['Global Quote'] ['01. symbol'],
            open: $data['Global Quote'] ['02. open'],
            high: $data['Global Quote'] ['03. high'],
            low: $data['Global Quote'] ['04. low'],
            price: $data['Global Quote'] ["05. price"],
            volume: $data['Global Quote'] ['06. volume'],
            close: $data['Global Quote'] ['08. previous close'],
            date: $data['Global Quote'][ '07. latest trading day']
        );
    }

    public function toArray() : array
    {
        return [
            'open' => $this->open,
            'high' => $this->high,
            'low' => $this->low,
            'volume' => $this->volume,
            'close' => $this->close,
            'price' => $this->price
        ];
    }
}
