<?php

namespace App\Actions\Eloquent;

use Illuminate\Database\Eloquent\Model;

/**
 * Interface ShowActionInterface
 * @package App\Actions\Eloquent
 */
interface ShowActionInterface
{

    /**
     * @param Model $model
     * @param int|null $id
     * @param array $relations
     * @param array $appends
     * @return Model
     */
    public function handle(
        Model $model,
        ?int $id = null,
        array $relations = [],
        array $appends = []
    ): Model;
}
