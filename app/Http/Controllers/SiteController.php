<?php

namespace App\Http\Controllers;

use App\Models\DataFile;
use App\Models\Device;
use App\Models\Factory;
use App\Models\SensorData;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sites = Site::with('factory')->get();
        return view('admin.sites.index', compact('sites'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $factories = Factory::all();
        return view('admin.sites.create', compact('factories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'factory_id' => 'required|exists:factories,id',
        ]);

        Site::create($request->all());

        return redirect()->route('sites.index')->with('success', 'Site created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Site $site)
    {
        if (in_array(Auth::user()->role->id, [1, 2])) {
            return view( 'admin.sites.show', compact('site'));
        }

        $data = [];

        $sensors = SensorData::with('data_file')->get();


        $deviceIds = $site->data_file ? $site->data_file->pluck('device_id')->unique() : [];

        $devices = Device::whereIn('id', $deviceIds)->get()->keyBy('id');

        $totalsByDevice = $sensors->groupBy('data_file.device_id')->map(function ($sensorGroup) {
            return $sensorGroup->sum(function ($sensor) {
                return $sensor->P1 + $sensor->P2 + $sensor->P3;
            });
        });

        foreach ($devices as $device) {
            $deviceId = $device->id;
            $total = $totalsByDevice->get($deviceId, 0);
            $data[] = [
                'title' => $device->serial_number,
                'total' => $total,
            ];
        }

        return view( 'client.sites.show', compact('site', 'data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Site $site)
    {
        $factories = Factory::all();
        return view('admin.sites.edit', compact('site', 'factories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Site $site)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'factory_id' => 'required|exists:factories,id',
        ]);

        $site->update($request->all());

        return redirect()->route('sites.index')->with('success', 'Site updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Site $site)
    {
        $site->delete();
        return redirect()->route('sites.index')->with('success', 'Site deleted successfully.');
    }

    public function fetch(Request $request)
    {
        if ($request->input('id')) {
            $data = Site::where('id', $request->input('id'))
                ->with(['components'])
                ->first();

            if ($data) return response()->json($data, 200);
            else return response()->json(['message' => 'Site is not registered in the system.'], 404);
        } else {
            $data = Site::with(['components'])
                ->get();

            if ($data) return response()->json($data, 200);
            else return response()->json(['message' => 'No sites registered in the system.'], 404);
        }
    }
}
