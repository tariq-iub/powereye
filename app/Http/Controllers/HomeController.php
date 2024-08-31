<?php

namespace App\Http\Controllers;

use App\Services\FactoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    protected FactoryService  $factoryService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(FactoryService $factoryService)
    {
        $this->middleware('auth');
        $this->factoryService = $factoryService;

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
                $factories = $this->factoryService->load($request, $userID);
                $timeframeOptions = getTimeframeOption();
                return view('dashboard.client', compact('factories', 'timeframeOptions'));
            }
        } else {
            redirect()->route('login');
        }
    }
}
