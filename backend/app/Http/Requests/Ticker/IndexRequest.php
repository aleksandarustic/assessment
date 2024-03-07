<?php

namespace App\Http\Requests\Ticker;

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
            'symbol' => 'string',
            'name' => 'string',
            'type' => 'string',
            'region' => 'string',
            'currency' => 'string',
            '__relations__' => 'array'
        ];
    }
}
