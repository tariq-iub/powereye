<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\Factory;
use App\Models\FactoryUser;
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
                $factories->each(function($factory) {
                    $factory->sitesPower = $this->getSitesPower($factory);
                });
                return view('dashboard.client', compact('factories'));
            }
        } else {
            redirect()->route('login');
        }
    }

    private function getSitesPower($factory)
    {
        return $factory->sites->map(function($site) {
            $totalPower = $site->data_file->flatMap->data->sum(function ($data) {
                return round($data->P1 + $data->P2 + $data->P3, 2);
            });

            if ($totalPower > 0) {
                return ['name' => $site->title, 'value' => $totalPower];
            }
        })->filter()->toArray();
    }


}

