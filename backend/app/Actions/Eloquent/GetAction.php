<?php


namespace App\Actions\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class GetAction
 * @package App\Actions\Eloquent
 */
class GetAction implements GetActionInterface
{
    /**
     * @param Model $model
     * @param array $filters
     * @param bool $paginate
     * @param array|string[] $columns
     * @param array $relations
     * @return Collection|LengthAwarePaginator
     */
    public function handle(
        Model $model,
        array $filters = [],
        array $relations = [],
        bool $paginate = false,
        array $columns = ['*'],
    ): Collection|LengthAwarePaginator {

        $query = $model->where($filters)->with($relations)->select($columns);

        return $paginate ? $query->paginate() : $query->get();
    }
}
