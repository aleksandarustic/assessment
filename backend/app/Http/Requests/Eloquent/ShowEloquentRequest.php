<?php

namespace App\Http\Requests\Eloquent;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ShowEloquentRequest
 * @package App\Http\Requests\Eloquent
 */
class ShowEloquentRequest extends FormRequest
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
            '__relations__' => 'array',
            '__appends__' => 'array',
        ];
    }

    public function getRelations(): array
    {
        return $this->validated('__relations__', []);
    }

    public function getAppends(): array
    {
        return $this->validated('__appends__', []);
    }
}
