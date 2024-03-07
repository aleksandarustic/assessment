<?php

namespace App\Http\Controllers;

use App\Actions\Eloquent\GetActionInterface;
use App\Actions\Eloquent\ShowActionInterface;
use App\Http\Requests\Eloquent\ShowEloquentRequest;
use App\Http\Requests\Ticker\IndexRequest;
use App\Http\Resources\TickerResource;
use App\Models\Ticker;
use Illuminate\Http\Request;

class TickerController extends Controller
{
    /**
     * @param GetActionInterface $getAction
     * @param Ticker $ticker
     * @param IndexRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(GetActionInterface $getAction, Ticker $ticker, IndexRequest $request)
    {
        return TickerResource::collection($getAction->handle($ticker, $request->getFilters(), $request->getRelations()));
    }

    /**
     * @param Ticker $ticker
     * @param ShowActionInterface $showAction
     * @param ShowEloquentRequest $request
     * @return TickerResource
     */
    public function show(Ticker $ticker, ShowActionInterface $showAction, ShowEloquentRequest $request)
    {
        $ticker = $showAction->handle($ticker, null, $request->getRelations(), $request->getAppends());

        return TickerResource::make($ticker);
    }
}
