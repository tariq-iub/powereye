<?php

namespace App\Http\Controllers;

use App\Models\Factory;
use App\Services\FactorySummaryService;
use App\Services\SiteSummaryService;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    protected FactorySummaryService $factorySummaryService;
    protected SiteSummaryService $siteSummaryService;

    public function __construct()
    {
        $this->middleware('auth');
        $this->factorySummaryService = app(FactorySummaryService::class);
        $this->siteSummaryService = app(SiteSummaryService::class);
    }

    public function index()
    {
        if (!Auth::user()) {
            return redirect()->route('login');
        }

        if (in_array(Auth::user()->role->id, [1, 2])) {
            return view('dashboard.admin');
        }

        $userId = Auth::id();

        $factories = getAuthFactories();

        foreach ($factories as $factory) {
            $factory->summary = $this->factorySummaryService->getLatestSummary($factory->id, false);

            foreach ($factory->sites as $site) {
                $site->summary = $this->siteSummaryService->getLatestSummary($site->id, false);
            }
        }

        $timeframeOptions = getTimeframeOption();
        return view('dashboard.client', compact('factories', 'timeframeOptions', 'userId'));
    }
}
