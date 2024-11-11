<?php

namespace App\Http\Controllers;

use App\Services\SiteSummaryService;

class SiteSummaryController extends Controller
{
    protected SiteSummaryService $summaryService;

    public function __construct(SiteSummaryService $summaryService)
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
