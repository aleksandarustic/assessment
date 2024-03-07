<?php


namespace App\Actions\Eloquent;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ShowAction
 * @package App\Actions\Eloquent
 */
class ShowAction implements ShowActionInterface
{
    /**
     * @param Model $model
     * @param int|null $id
     * @param array $relations
     * @param array $appends
     * @return Model
     * @throws \Exception
     */
    public function handle(
        Model $model,
        ?int $id = null,
        array $relations = [],
        array $appends = []
    ): Model {

        if (!$model->exists && !$id) {
            throw new \Exception("Model can't be updated");
        }

        if (!$model->exists) {
           $model =  $model->findOrFail($id);
        }

        return $model->load($relations)->append($appends);
    }
}
