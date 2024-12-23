<?php

namespace App\Http\Controllers;

use App\Services\SiteSensorDataService;
use Illuminate\Http\Request;

class SiteSensorDataController extends Controller
{
    protected SiteSensorDataService $siteSensorDataService;

    public function fetch(Request $request, $id, $jsonResponse = true)
    {
        return app(SiteSensorDataService::class)->fetch($request, $id, $jsonResponse);
    }
}
