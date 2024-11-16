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

    public function getLatestSummary($siteId, $jsonResponse = true)
    {
        return app(SiteSummaryService::class)->getLatestSummary($siteId, $jsonResponse);
    }
}
