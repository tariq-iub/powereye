<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\DataFile;
use App\Models\Device;
use App\Models\Factory;
use App\Models\SensorData;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view( 'client.sites.show', compact('site'));
    }

    public function fetchData(Request $request, Site $site)
    {
        $timeFrame = $request->query('time_frame', '1');
        $type = $request->query('type', 'power');
        $today = now();

        switch ($timeFrame) {
            case '7':
                $startDate = $today->subDays(7);
                break;
            case '30':
                $startDate = $today->subDays(30);
                break;
            case '90':
                $startDate = $today->subDays(90);
                break;
            case '365':
                $startDate = $today->subDays(365);
                break;
            case 'all':
                $startDate = null;
                break;
            default:
                $startDate = $today->subDay();
                break;
        }

        $dataFileIds = $site->data_file->pluck('id');

        $query = SensorData::whereIn('data_file_id', $dataFileIds);

        if ($startDate) {
            $query->where('timestamp', '>=', $startDate);
        }

        $powerData = $query
            ->selectRaw(
                "DATE_FORMAT(timestamp, '%Y-%m-%d') as period,
            SUM(P1 + P2 + P3) as total_power,
            SUM(E1 + E2 + E3) as total_energy"
            )
            ->groupBy('period')
            ->orderBy('period')
            ->get();

        $formattedData = $powerData->map(function ($item) use ($type) {
            return [
                'timestamp' => $item->period,
                'total_value' => $type === 'power' ? $item->total_power : $item->total_energy,
            ];
        });

        return response()->json($formattedData);
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
