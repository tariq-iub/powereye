<?php

namespace App\Http\Controllers;

use App\Services\FactorySummaryService;

class FactorySummaryController extends Controller
{
    protected FactorySummaryService $summaryService;

    public function __construct(FactorySummaryService $summaryService)
    {
        $this->summaryService = $summaryService;
    }

    public function getLatestSummary($factoryId, $jsonResponse = true)
    {
        return app(FactorySummaryService::class)->getLatestSummary($factoryId, $jsonResponse);
    }
}
