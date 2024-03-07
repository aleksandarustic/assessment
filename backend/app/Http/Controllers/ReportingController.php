<?php

namespace App\Http\Controllers;

use App\Actions\Eloquent\GetActionInterface;
use App\Actions\Eloquent\ShowActionInterface;
use App\Actions\Stock\CreateReportAction;
use App\Http\Requests\Eloquent\ShowEloquentRequest;
use App\Http\Requests\Ticker\IndexRequest;
use App\Http\Resources\TickerResource;
use App\Http\Resources\TickerStockPriceResource;
use App\Models\Ticker;
use Illuminate\Http\Request;

class ReportingController extends Controller
{
    public function report(CreateReportAction $createReportAction)
    {
        return TickerStockPriceResource::collection($createReportAction->handle());
    }
}
