<?php

namespace App\Http\Controllers;


use App\Actions\Stock\CreateReportAction;
use App\Http\Resources\ReportResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 *
 */
class ReportingController extends Controller
{
    /**
     * @param CreateReportAction $createReportAction
     * @return AnonymousResourceCollection
     */
    public function report(CreateReportAction $createReportAction): AnonymousResourceCollection
    {
        return ReportResource::collection($createReportAction->handle());
    }
}
