<?php

namespace App\DTO;

use Illuminate\Support\Collection;

/**
 *
 */
class OutputIntradayDto implements AlphaVantageDtoInterface
{
    /**
     * @param string $symbol
     * @param Collection $prices
     */
    public function __construct(
        public string $symbol,
        public Collection $prices
    ) {
    }

    /**
     * @param array $data
     * @return self
     */
    public static function fromArray(array $data = []) : self
    {
        return new self(
            symbol: $data['Meta Data']['2. Symbol'],
            prices: collect(data_get($data, 'Time Series (1min)'))->map(fn($item, $key) => IntradayItemDto::fromArray($item + ['date' => $key])),
        );
    }

    /**
     * @param int $tickerId
     * @return array
     */
    public function toArray(int $tickerId) : array
    {
        return [
            'symbol' => $this->symbol,
            'prices' => $this->prices->map(fn($item) => $item->toArray()+ ['ticker_id' => $tickerId])->toArray()
        ];
    }

}
