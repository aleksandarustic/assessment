<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ReportResource
 * @package App\Http\Resources
 */
class ReportResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return array_merge(parent::toArray($request), [
            'ticker' => TickerResource::make($this->whenLoaded('ticker')),
            'previous_price' => $this->previous_price ?? 0,
            'percentage_change' => ($this->percentage_change ?? 0) . '%',
        ]);
    }
}
