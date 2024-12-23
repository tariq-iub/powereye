<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\DataFile;
use App\Models\Device;
use App\Models\Factory;
use App\Models\SensorData;
use App\Models\Site;
use App\Services\SensorDataService;
use App\Services\SiteService;
use App\Services\SiteSummaryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    protected SensorDataService $sensorDataService;
    protected SiteSummaryService $siteSummaryService;

    public function __construct(SensorDataService $sensorDataService, SiteSummaryService $siteSummaryService)
    {
        $this->sensorDataService = $sensorDataService;
        $this->siteSummaryService = $siteSummaryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sites = Site::with('factory')->get();
        return view('admin.sites.index', compact('sites'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $factories = Factory::all();
        return view('admin.sites.create', compact('factories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'factory_id' => 'required|exists:factories,id',
        ]);

        Site::create($request->all());

        return redirect()->route('sites.index')->with('success', 'Site created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Site $site)
    {
        if (in_array(Auth::user()->role->id, [1, 2])) {
            return view('admin.sites.show', compact('site'));
        }

        $siteId = $site->id;

        $latest_energy = $this->siteSummaryService->getLatestSummary($siteId, false)->energy;
        $_12h_energy = $this->siteSummaryService->getSummary($siteId, '12-hours', false)->energy;
        $_1w_energy = $this->siteSummaryService->getSummary($siteId, '1-week', false)->energy;
        $_1m_energy = $this->siteSummaryService->getSummary($siteId, '1-month', false)->energy;

        $timeframeOptions = getTimeframeOption();

        return view('client.sites.show', compact('site', 'latest_energy', '_12h_energy', '_1w_energy', '_1m_energy', 'timeframeOptions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Site $site)
    {
        $factories = Factory::all();
        return view('admin.sites.edit', compact('site', 'factories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Site $site)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'factory_id' => 'required|exists:factories,id',
        ]);

        $site->update($request->all());

        return redirect()->route('sites.index')->with('success', 'Site updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Site $site)
    {
        $site->delete();
        return redirect()->route('sites.index')->with('success', 'Site deleted successfully.');
    }

    public function fetch(Request $request)
    {
        if ($request->input('id')) {
            $data = Site::where('id', $request->input('id'))
                ->with(['components'])
                ->first();

            if ($data)
                return response()->json($data, 200);
            else
                return response()->json(['message' => 'Site is not registered in the system.'], 404);
        } else {
            $data = Site::with(['components'])
                ->get();

            if ($data)
                return response()->json($data, 200);
            else
                return response()->json(['message' => 'No sites registered in the system.'], 404);
        }
    }

    public function fetchData(Request $request, int $siteId, string $type, string $timeframe = 'all', bool $json = true, $precisionVal = 2)
    {
        return app(SiteService::class)->fetchData($request, $siteId, $type, $timeframe, $json, $precisionVal);
    }
}
