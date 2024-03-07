<?php

namespace App\Http\Requests\Eloquent;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class IndexEloquentRequest
 * @package App\Http\Requests\Eloquent
 */
class IndexEloquentRequest extends FormRequest
{
    /**
     * @return array
     */
    public function getRelations(): array
    {
        return $this->validated('__relations__', []);
    }

    /**
     * @return array
     */
    public function getFilters(): array
    {
        return $this->safe()->except('__relations__');
    }
}
