<?php

namespace App\Http\Controllers;

use App\Models\Factory;
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

        $userId = Auth::id();

        $factories = getAuthFactories();
        $factorySummaries = $factories->mapWithKeys(function ($factory) {
            return $factory->summary()->toArray();
        });

        $siteSummaries = $factories->mapWithKeys(function ($factory) {
            return [
                $factory->id => $factory->sites->map(function ($site) {
                    return $site->summary();
                })
            ];
        });

        $timeframeOptions = getTimeframeOption();
        return view('dashboard.client', compact('factories', 'timeframeOptions', 'userId', 'siteSummaries', 'factorySummaries'));
    }
}
