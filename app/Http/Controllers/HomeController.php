<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\SensorData;
use App\Models\Site;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if (Auth::user()) {
            if (in_array(Auth::user()->role->id, [1, 2])) {
                $timeframeOptions = Helpers::getTimeFrameOptions();

                $now = Carbon::now();

                $start = Helpers::getTimeFrame($request);

                $sensorsData = SensorData::with('data_file.site')->whereBetween('timestamp', [$start, $now])
                    ->orderBy('timestamp', 'desc')
                    ->get();

                $latestSensorsData = $sensorsData;

                $sitesPower = Helpers::getSitesPower($request, 'array');
                $sitesEnergy = Helpers::getSitesEnergy($request, 'array');

                return view('dashboard.admin', compact('sensorsData', 'latestSensorsData', 'timeframeOptions', 'sitesEnergy', 'sitesPower'));
            } else return view('dashboard.client');
        } else {
            redirect()->route('login');
        }
    }

    public function getSitesPower(Request $request, string $returnType='json'): JsonResponse|array
    {
        return Helpers::getSitesPower($request, $returnType);
    }

    public function getSitesEnergy(Request $request, string $returnType='json'): JsonResponse|array
    {
        return Helpers::getSitesEnergy($request, $returnType);
    }

    public function getLatestSensorData(Request $request): JsonResponse
    {
        $now = Carbon::now();
        $start = Helpers::getTimeFrame($request);

        $sensorsData = SensorData::with('data_file.site')
            ->whereBetween('timestamp', [$start, $now])
            ->orderBy('timestamp', 'desc')
            ->select('p1', 'p2', 'p3', 'E1', 'E2', 'E3', 'data_file_id', 'timestamp')
            ->get();

        return response()->json($sensorsData);
    }
}

