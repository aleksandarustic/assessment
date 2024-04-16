<?php


namespace App\Actions\Eloquent;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CreateAction
 * @package App\Actions\Eloquent
 */
class CreateAction implements CreateActionInterface
{
    public function handle(Model $model, array $data): Model
    {
        return $model->create($data);
    }
}
