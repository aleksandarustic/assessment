<?php

namespace App\Http\Requests\File;

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
            'parent_id' => 'integer|exists:files,id',
            'name' => 'string',
            'type' => 'string|in:folder,file',
            '__relations__' => 'array'
        ];
    }
}
