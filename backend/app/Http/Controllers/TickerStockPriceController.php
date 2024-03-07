<?php

namespace App\Http\Controllers;

use App\Actions\Eloquent\GetActionInterface;
use App\Actions\Stock\GetLatestAction;
use App\Http\Requests\TickerStockPrice\IndexRequest;
use App\Http\Resources\TickerStockPriceResource;
use App\Models\TickerStockPrice;
use Illuminate\Http\Request;

class TickerStockPriceController extends Controller
{
    /**
     * @param GetActionInterface $getAction
     * @param TickerStockPrice $tickerStockPrice
     * @param IndexRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(GetActionInterface $getAction, TickerStockPrice $tickerStockPrice, IndexRequest $request)
    {
        return TickerStockPriceResource::collection($getAction->handle($tickerStockPrice, $request->getFilters(), $request->getRelations()));
    }

    public function latest(GetLatestAction $getLatestAction)
    {
        return TickerStockPriceResource::collection($getLatestAction->handle());
    }

    /**
     * @param TickerStockPrice $tickerStockPrice
     * @param ShowActionInterface $showAction
     * @param ShowEloquentRequest $request
     * @return TickerStockPriceResource
     */
    public function show(TickerStockPrice $tickerStockPrice, ShowActionInterface $showAction, ShowEloquentRequest $request)
    {
        $tickerStockPrice = $showAction->handle($tickerStockPrice, null, $request->getRelations(), $request->getAppends());

        return TickerStockPriceResource::make($tickerStockPrice);
    }
}
