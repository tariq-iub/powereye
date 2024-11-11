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
        if (!$factoryId) {
            return abort(404);
        }

        $summary = $this->summaryService->getLatestSummary($factoryId);

        if (!$summary) {
            return abort(404);
        }

        return $jsonResponse ? response()->json($summary) : $summary;
    }
}
