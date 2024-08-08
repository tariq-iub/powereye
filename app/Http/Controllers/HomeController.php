<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\SensorData;
use App\Models\Site;
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

                $sites = Site::with(['data_file.data' => function ($query) use ($start) {
                    $query->select('data_file_id', 'P1', 'P2', 'P3', 'E1', 'E2', 'E3', 'timestamp')->where('timestamp', '>=', $start);
                }])->get();

                $sitesPower = [];
                $sitesEnergy = [];

                foreach ($sites as $site) {
                    $totalP1 = $totalP2 = $totalP3 = 0;
                    $totalE1 = $totalE2 = $totalE3 = 0;

                    foreach ($site->data_file as $dataFile) {
                        foreach ($dataFile->data as $data) {
                            $totalP1 += $data->P1 ?? 0;
                            $totalP2 += $data->P2 ?? 0;
                            $totalP3 += $data->P3 ?? 0;

                            $totalE1 += $data->E1 ?? 0;
                            $totalE2 += $data->E2 ?? 0;
                            $totalE3 += $data->E3 ?? 0;
                        }
                    }

                    $totalPower = $totalP1 + $totalP2 + $totalP3;
                    $totalEnergy = $totalE1 + $totalE2 + $totalE3;

                    if ($totalPower > 0) {
                        $sitesPower[] = [
                            'title' => $site->title,
                            'power' => $totalPower,
                        ];
                    }

                    if ($totalEnergy > 0) {
                        $sitesEnergy[] = [
                            'title' => $site->title,
                            'energy' => $totalEnergy,
                        ];
                    }
                }
                $latestSensorsData = $sensorsData;

                return view('dashboard.admin', compact('sensorsData', 'latestSensorsData', 'timeframeOptions', 'sitesEnergy', 'sitesPower'));
            } else return view('dashboard.client');
        } else {
            redirect()->route('login');
        }
    }

    public function getSitesPower(Request $request)
    {
        $start = Helpers::getTimeFrame($request);

        $sites = Site::with(['data_file.data' => function ($query) use ($start) {
            $query->select('data_file_id', 'P1', 'P2', 'P3', 'timestamp')
                ->where('timestamp', '>=', $start);
        }])->get();

        $sitesPower = [];

        foreach ($sites as $site) {
            $totalP1 = $totalP2 = $totalP3 = 0;

            foreach ($site->data_file as $dataFile) {
                foreach ($dataFile->data as $data) {
                    $totalP1 += $data->P1 ?? 0;
                    $totalP2 += $data->P2 ?? 0;
                    $totalP3 += $data->P3 ?? 0;
                }
            }

            $totalPower = $totalP1 + $totalP2 + $totalP3;

            if ($totalPower > 0) {
                $sitesPower[] = [
                    'title' => $site->title,
                    'power' => $totalPower,
                ];
            }
        }

        return response()->json($sitesPower);
    }

    public function getSitesEnergy(Request $request)
    {
        $start = Helpers::getTimeFrame($request);

        $sites = Site::with(['data_file.data' => function ($query) use ($start) {
            $query->select('data_file_id', 'E1', 'E2', 'E3', 'timestamp')
                ->where('timestamp', '>=', $start);
        }])->get();

        $sitesEnergy = [];

        foreach ($sites as $site) {
            $totalEnergy = 0;

            foreach ($site->data_file as $dataFile) {
                foreach ($dataFile->data as $data) {
                    $totalEnergy += ($data->E1 ?? 0) + ($data->E2 ?? 0) + ($data->E3 ?? 0);
                }
            }

            if ($totalEnergy > 0) {
                $sitesEnergy[] = [
                    'title' => $site->title,
                    'energy' => $totalEnergy,
                ];
            }
        }

        return response()->json($sitesEnergy);
    }

    public function getLatestSensorData(Request $request)
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

