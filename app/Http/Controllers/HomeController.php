<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (!Auth::user()) {
            return redirect()->route('login');
        }

        if (in_array(Auth::user()->role->id, [1, 2])) {
            return view('dashboard.admin');
        }

        $factories = getAuthFactories();

        foreach ($factories as $factory) {
            $this->initializeFactoryData($factory);
        }

        $timeframeOptions = getTimeframeOption();
        return view('dashboard.client', compact('factories', 'timeframeOptions'));
    }

    protected function initializeFactoryData($factory): void
    {
        $factory->totalPower = 0;
        $factory->totalEnergy = 0;
        $factory->energyDistribution = [];

        foreach ($factory->sites as $site) {
            $this->calculateSiteData($site, $factory);
        }
    }

    protected function calculateSiteData($site, $factory): void
    {
        $site->lastEnergy = $site->getLastEnergy();
        $site->totalPower = $site->getTotalPower();
        $site->totalEnergy = $site->getTotalEnergy();
        $factory->totalPower += $site->getTotalPower();
        $factory->totalEnergy += $site->getTotalEnergy();
    }
}
