<?php

namespace App\Http\Controllers;

use App\Models\DataFile;
use App\Models\SensorData;
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
    public function index()
    {
        if(Auth::user())
        {
            if(in_array(Auth::user()->role->id, [1, 2])) {
                $now = Carbon::now();
                $yesterday = Carbon::now()->subDay();

                $sensorsData = SensorData::with('data_file.site')->whereBetween('timestamp', [$yesterday, $now])
                    ->orderBy('timestamp', 'desc')
                    ->get();

                $latestSensorsData = $sensorsData->take(10);

                return view('dashboard.admin', compact('sensorsData', 'latestSensorsData'));
            }
            else return view('dashboard.client');
        }
        else {
            redirect()->route('login');
        }
    }
}
