<?php

namespace App\Http\Requests\File;

use App\Http\Requests\Eloquent\IndexEloquentRequest;
use Illuminate\Validation\Rule;

/**
 * Class FilterFiles
 * @package App\Http\Requests\Order
 */
class FilterFiles extends IndexEloquentRequest
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
            'parent_id' => [
                'nullable',
                'integer',
                Rule::exists('files', 'id')
                    ->where('type', 'folder')
            ]
        ];
    }
}
