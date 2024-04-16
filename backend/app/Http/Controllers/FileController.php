<?php

namespace App\Http\Controllers;

use App\Actions\Eloquent\GetActionInterface;
use App\Actions\Eloquent\ShowActionInterface;
use App\Http\Requests\Eloquent\ShowEloquentRequest;
use App\Http\Requests\File\IndexRequest;
use App\Http\Resources\FileResource;
use App\Models\File;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class FileController extends Controller
{
    /**
     * @param GetActionInterface $getAction
     * @param File $file
     * @param IndexRequest $request
     * @return AnonymousResourceCollection
     */
    public function index(GetActionInterface $getAction, File $file, IndexRequest $request): AnonymousResourceCollection
    {
        return FileResource::collection($getAction->handle($file, $request->getFilters(), $request->getRelations()));
    }

    /**
     * @param File $file
     * @param ShowActionInterface $showAction
     * @param ShowEloquentRequest $request
     * @return FileResource
     */
    public function show(File $file, ShowActionInterface $showAction, ShowEloquentRequest $request): FileResource
    {
        $file = $showAction->handle($file, null, $request->getRelations(), $request->getAppends());

        return FileResource::make($file);
    }

}
