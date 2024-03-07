<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\MissingValue;

/**
 * Class TickerStockPriceResource
 * @package App\Http\Resources
 */
class TickerStockPriceResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return array_merge(parent::toArray($request), [
            'ticker' => TickerResource::make($this->whenLoaded('ticker')),
            'previous_price' => isset($this->previous_price) ? $this->previous_price : new MissingValue(),
            'percentage_change' => isset($this->percentage_change) ? $this->percentage_change : new MissingValue(),
        ]);
    }
}
