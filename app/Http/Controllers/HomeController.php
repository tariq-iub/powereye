<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\SensorData;
use App\Models\Site;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
                $factoryID = 1;
                $powerData = $this->getFactoryPower($request, $factoryID, false);

                $data = $this->getSitesPower($request, false);

                return view('dashboard.admin', compact('timeframeOptions', 'powerData', 'data'));
            } else {
                return view('dashboard.client');
            }
        } else {
            redirect()->route('login');
        }
    }

    public function getSitesPower(Request $request, bool $json=true): JsonResponse|array
    {
        return Helpers::getSitesPower($request, $json);
    }

    public function getSitesEnergy(Request $request, bool $json=true): JsonResponse|array
    {
        return Helpers::getSitesEnergy($request, $json);
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

    public function getFactoryPower(Request $request, int $factoryID, bool $json=true): JsonResponse|Collection
    {
        return Helpers::getFactoryPower($request, $factoryID, $json);
    }
}

