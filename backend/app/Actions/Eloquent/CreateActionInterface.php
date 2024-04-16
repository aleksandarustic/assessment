<?php

namespace App\Actions\Eloquent;

use Illuminate\Database\Eloquent\Model;


/**
 * Interface CreateActionInterface
 * @package App\Contracts\Actions\Eloquent
 */
interface CreateActionInterface
{
    /**
     * @param Model $model
     * @param array $data
     * @return Model
     */
    public function handle(Model $model, array $data): Model;
}
