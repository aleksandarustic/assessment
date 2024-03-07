<?php

namespace App\Http\Requests\TickerStockPrice;

use App\Http\Requests\Eloquent\IndexEloquentRequest;

/**
 * Class IndexRequest
 * @package App\Http\Requests\Order
 */
class IndexRequest extends IndexEloquentRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * GetRequest the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'ticker_id' => 'numeric',
            'open' => 'string',
            'high' => 'string',
            'low' => 'string',
            'volume' => 'string',
            'close' => 'string',
            'date' => 'string',
            '__relations__' => 'array'
        ];
    }
}
