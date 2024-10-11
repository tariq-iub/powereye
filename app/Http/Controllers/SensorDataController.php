<?php

namespace App\Http\Controllers;

use App\Models\DataFile;
use App\Models\Device;
use App\Models\SensorData;
use App\Services\SensorDataService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    /**
     * Store multiple sensor data records directly into the database via an API.
     */
    public function storeSensorData(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'site_id' => 'required|exists:sites,id',
            'device_serial' => 'required|string|exists:devices,serial_number',
            'data' => 'required|array',
            'data.*.timestamp' => 'required|date',
            'data.*.V1' => 'nullable|numeric',
            'data.*.I1' => 'nullable|numeric',
            'data.*.P1' => 'nullable|numeric',
            'data.*.Q1' => 'nullable|numeric',
            'data.*.E1' => 'nullable|numeric',
            'data.*.V2' => 'nullable|numeric',
            'data.*.I2' => 'nullable|numeric',
            'data.*.P2' => 'nullable|numeric',
            'data.*.Q2' => 'nullable|numeric',
            'data.*.E2' => 'nullable|numeric',
            'data.*.V3' => 'nullable|numeric',
            'data.*.I3' => 'nullable|numeric',
            'data.*.P3' => 'nullable|numeric',
            'data.*.Q3' => 'nullable|numeric',
            'data.*.E3' => 'nullable|numeric',
            'data.*.temperature' => 'nullable|numeric',
            'data.*.misc1' => 'nullable|numeric',
            'data.*.misc2' => 'nullable|numeric',
            'data.*.misc3' => 'nullable|numeric',
            'data.*.misc4' => 'nullable|string',
            'data.*.misc5' => 'nullable|string',
        ]);

        $device = Device::where('serial_number', $request->input('device_serial'))->first();
        if (!$device) {
            return response()->json(['message' => 'Device is not registered at system.'], 404);
        }

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Store file metadata in the database
        $dataFile = DataFile::create([
            'file_name' => "fileName",
            'file_path' => "filePath",
            'site_id' => $request->input('site_id'),
            'device_id' => $device->id,
        ]);

        // Loop through each row of data and insert it into the database
        $sensorData = [];
        foreach ($request->input('data') as $row) {
            $sensorData[] = [
                'data_file_id' => $dataFile->id,
                'timestamp' => $row['timestamp'],
                'V1' => $row['V1'] ?? 0,
                'I1' => $row['I1'] ?? 0,
                'P1' => $row['P1'] ?? 0,
                'Q1' => $row['Q1'] ?? 0,
                'E1' => $row['E1'] ?? 0,
                'V2' => $row['V2'] ?? null,
                'I2' => $row['I2'] ?? null,
                'P2' => $row['P2'] ?? null,
                'Q2' => $row['Q2'] ?? null,
                'E2' => $row['E2'] ?? null,
                'V3' => $row['V3'] ?? null,
                'I3' => $row['I3'] ?? null,
                'P3' => $row['P3'] ?? null,
                'Q3' => $row['Q3'] ?? null,
                'E3' => $row['E3'] ?? null,
                'temperature' => $row['temperature'] ?? 0,
                'misc1' => $row['misc1'] ?? null,
                'misc2' => $row['misc2'] ?? null,
                'misc3' => $row['misc3'] ?? null,
                'misc4' => $row['misc4'] ?? null,
                'misc5' => $row['misc5'] ?? null,
            ];
        }

        // Insert all data at once
        SensorData::insert($sensorData);

        return response()->json(['message' => 'Sensor data stored successfully'], 201);
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
