<?php

namespace App\DTO;

class IntradayItemDto implements AlphaVantageDtoInterface
{
    public function __construct(
        public string $open,
        public string $high,
        public string $low,
        public string $close,
        public string $volume,
        public string $date,
    ) {
    }

    public static function fromArray(array $data = []) : self
    {
        return new self(
            open:$data['1. open'],
            high: $data['2. high'],
            low: $data['3. low'],
            close: $data['4. close'],
            volume: $data['5. volume'],
            date: data_get($data, 'date'),
        );
    }

    public function toArray() : array
    {
        return [
            'open' => $this->open,
            'high' => $this->high,
            'low' => $this->low,
            'close' => $this->close,
            'volume' => $this->volume,
            'date' => $this->date,
        ];
    }
}
