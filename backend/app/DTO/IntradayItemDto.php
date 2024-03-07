<?php

namespace App\DTO;

/**
 *
 */
class IntradayItemDto implements AlphaVantageDtoInterface
{
    /**
     * @param string $open
     * @param string $high
     * @param string $low
     * @param string $close
     * @param string $volume
     * @param string $date
     * @param string $price
     */
    public function __construct(
        public string $open,
        public string $high,
        public string $low,
        public string $close,
        public string $volume,
        public string $date,
        public string $price
    ) {
    }

    /**
     * @param array $data
     * @return self
     */
    public static function fromArray(array $data = []) : self
    {
        return new self(
            open:$data['1. open'],
            high: $data['2. high'],
            low: $data['3. low'],
            close: $data['4. close'],
            volume: $data['5. volume'],
            price: $data['4. close'],
            date: data_get($data, 'date'),
        );
    }

    /**
     * @return array
     */
    public function toArray() : array
    {
        return [
            'open' => $this->open,
            'high' => $this->high,
            'low' => $this->low,
            'close' => $this->close,
            'volume' => $this->volume,
            'date' => $this->date,
            'price' => $this->price
        ];
    }
}
