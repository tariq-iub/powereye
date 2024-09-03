<?php

namespace App\Http\Controllers;

use App\Models\SensorData;
use App\Services\SensorDataService;
use Illuminate\Http\Request;

class SensorDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SensorData $sensorData)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SensorData $sensorData)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SensorData $sensorData)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SensorData $sensorData)
    {
        //
    }

    public function fetch(Request $request, string $entityType, int $entityId, bool $json = true)
    {
        return app(SensorDataService::class)->fetchSensorData($request, $entityId, $entityType, $json);
    }

    public function fetchEnergyData(Request $request, string $entityType, int $entityId, bool $json = true)
    {
        return app(SensorDataService::class)->fetchEnergyData($request, $entityId, $entityType, $json);
    }
}
