<?php

namespace App\Http\Controllers;

use App\Services\FactorySensorDataService;
use Illuminate\Http\Request;

class FactorySensorDataController extends Controller
{
    protected FactorySensorDataService $FactorySensorDataService;

    public function __construct(FactorySensorDataService $FactorySensorDataService)
    {
        $this->FactorySensorDataService = $FactorySensorDataService;
    }

    public function fetch(Request $request, int $id, bool $jsonResponse = true)
    {
        return app(FactorySensorDataService::class)->fetch($request, $id, $jsonResponse);
    }
}
