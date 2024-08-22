<?php

namespace App\Http\Controllers;

use App\Models\Factory;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
                return view('dashboard.admin');
            } else {
                $userID = Auth::id();
                $factories = Factory::with('sites.data_file.data')->get();
                $this->getSensorsPower(1);
                return view('dashboard.client', compact('factories'));
            }
        } else {
            redirect()->route('login');
        }
    }

    public function getSitesPower($factoryID)
    {
        $factory = Factory::with('sites.data_file.data')
        ->where('id', $factoryID)
        ->first();

        if ($factory) {
            $data = $factory->sites->map(function($site) {
                $totalPower = $site->data_file->flatMap->data->sum(function ($data) {
                    return round($data->P1 + $data->P2 + $data->P3, 2);
                });

                if ($totalPower > 0) {
                    return ['name' => $site->title, 'value' => $totalPower];
                }
            })->filter();
            return response()->json($data);
        } else {
            return response()->json(['message' => 'Factory not found'], 404);
        }
    }

    public function getSitesEnergy($factoryID)
    {
        $factory = Factory::with('sites.data_file.data')
            ->where('id', $factoryID)
            ->first();

        if ($factory) {
            $data = $factory->sites->map(function($site) {
                $totalEnergy = $site->data_file->flatMap->data->sum(function ($data) {
                    return round($data->E1 + $data->E2 + $data->E3, 8);
                });

                if ($totalEnergy > 0) {
                    return ['name' => $site->title, 'value' => $totalEnergy];
                }
            })->filter();
            return response()->json($data);
        } else {
            return response()->json(['message' => 'Factory not found'], 404);
        }
    }

    public function getSensorsPower($factoryID, $startDate = null, $endDate = 'now')
    {
        // Set default startDate to 1 day before endDate if not provided
        if ($startDate === null) {
            $startDate = Carbon::now()->subDay()->toDateString();
        }

        // Set endDate to now if 'now' is passed
        if ($endDate === 'now') {
            $endDate = Carbon::now()->toDateString();
        }

        // Fetch the factory and its related data
        $factory = Factory::with('sites.data_file.data')
            ->where('id', $factoryID)
            ->first();

        if (!$factory) {
            return response()->json(['message' => 'Factory not found'], 404);
        }

        // Process and return individual records
        $data = $factory->sites->flatMap(function ($site) use ($startDate, $endDate) {
            return $site->data_file->flatMap(function ($dataFile) use ($startDate, $endDate) {
                return $dataFile->data->filter(function ($data) use ($startDate, $endDate) {
                    $dataDate = Carbon::parse($data->timestamp)->toDateString();
                    return $dataDate >= $startDate && $dataDate <= $endDate;
                })->map(function ($data) {
                    return [
                        'timestamp' => Carbon::parse($data->timestamp)->format('H:i'),
                        'total_power' => round($data->P1 + $data->P2 + $data->P3, 2),
                    ];
                });
            });
        })->sortBy('timestamp');

        return response()->json($data->values());
    }


}

