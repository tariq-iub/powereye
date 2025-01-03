<?php

namespace App\Http\Controllers;

use App\Models\DataFile;
use App\Models\Device;
use App\Models\Factory;
use App\Models\SensorData;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use League\Csv\Reader;
use Yajra\DataTables\DataTables;

class DataFileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $files = DataFile::orderBy('id', 'asc')->paginate(10);
        $factories = Factory::all();
        $devices = Device::all();
        return view('admin.files.index', compact('files', 'factories', 'devices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $factories = Factory::all();
        $sites = Site::all();
        $devices = Device::all();
        return view('admin.files.create', compact('factories', 'devices', 'sites'));
    }

    /**
     * Store the specified resource.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:csv,txt|max:2048',
            'site_id' => 'required|exists:sites,id',
            'device_serial' => 'required|string|exists:devices,serial_number',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $device = Device::where('serial_number', $request->input('device_serial'))->first();
        if (!$device) {
            return response()->json(['message' => 'Device is not registered at system.'], 404);
        }

        if ($request->file('file')->isValid()) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('data_files', $fileName, 'public');

            // Store file metadata in the database
            $dataFile = DataFile::create([
                'file_name' => $fileName,
                'file_path' => $filePath,
                'site_id' => $request->input('site_id'),
                'device_id' => $device->id,
            ]);

            // update event

            $this->process_file($dataFile);

            return response()->json(['message' => 'File uploaded successfully'], 200);
        }

        return response()->json(['message' => 'Invalid file upload'], 400);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataFile $dataFile)
    {
        $factories = Factory::all();
        $devices = Device::all();
        $sites = Site::all();

        return view('admin.files.edit', compact('dataFile', 'factories', 'devices', 'sites',));
    }

    /**
     * Fetch a single resource.
     */
    public function show($id)
    {
        $dataFile = DataFile::find($id);

        if (!$dataFile) {
            return response()->json(['error' => 'File not found'], 404);
        }

        return response()->json([
            'factory_id' => $dataFile->site->factory_id,
            'site_id' => $dataFile->site_id,
            'component_id' => $dataFile->component_id,
            'device_serial' => $dataFile->device->serial_number,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataFile $dataFile)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
//            'file' => 'required|mimes:csv,txt|max:2048',
            'site_id' => 'required|exists:sites,id',
            'device_serial' => 'required|string|exists:devices,serial_number', // Ensure device is registered
//            'inspection_id' => 'required|exists:inspections,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $device = Device::where('serial_number', $request->input('device_serial'))->first();

//        if ($request->file('file')->isValid()) {
//            $file = $request->file('file');
//            $fileName = time() . '_' . $file->getClientOriginalName();
//            $filePath = $file->storeAs('data_files', $fileName, 'public');
//
//            $dataFile->file_name = $fileName;
///           $dataFile->file_path = $filePath;
//            $dataFile->component_id = $request->input('component_id');
//            $dataFile->site_id = $request->input('site_id');
//            $dataFile->device_id = $device->id;
//            $dataFile->inspection_id = $request->input('inspection_id');
//
//            $dataFile->save();
//
//            return redirect(route('files.index'))->with('success', 'Data updated successfully.');
//        }

        $dataFile->site_id = $request->input('site_id');
        $dataFile->device_id = $device->id;
        $dataFile->save();

        return redirect(route('files.index'))->with('success', 'Data updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataFile $dataFile)
    {
        $filePath = $dataFile->file_path;

        // Check if the file exists and delete it
        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }

        // Delete the database record
        $dataFile->delete();

        // Return a response indicating the file was deleted
        return response()->json(['message' => 'File deleted successfully.'], 200);
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = DataFile::with(['device', 'site.factory'])->select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('device', function ($row) {
                    return $row->device->serial_number;
                })
                ->addColumn('site', function ($row) {
                    return $row->site->title;
                })
                ->addColumn('factory', function ($row) {
                    return $row->site->factory->title;
                })
                ->addColumn('created_at', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('action', function ($row) {
                    return view('admin.files.partial.action', compact('row'))->render();
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function download(DataFile $dataFile)
    {
        $filePath = $dataFile->file_path;

        // Check if the file exists
        if (Storage::disk('public')->exists($filePath)) {
            // Return the file as a download response
            return Storage::disk('public')->download($filePath, $dataFile->file_name);
        } else {
            // Return an error response if the file does not exist
            return response()->json(['message' => 'File not found.'], 404);
        }
    }

    public function upload(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:csv,txt|max:2048',
            'site_id' => 'required|exists:sites,id',
            'device_serial' => 'required|string|exists:devices,serial_number',
        ]);

        $device = Device::where('serial_number', $request->input('device_serial'))->first();
        if (!$device) {
            return response()->json(['message' => 'Device is not registered at system.'], 404);
        }

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if ($request->file('file')->isValid()) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('data_files', $fileName, 'public');

            // Store file metadata in the database
            $dataFile = DataFile::create([
                'file_name' => $fileName,
                'file_path' => $filePath,
                'site_id' => $request->input('site_id'),
                'device_id' => $device->id,
            ]);

            $this->process_file($dataFile);

            return response()->json(['message' => 'File uploaded successfully'], 200);
        }

        return response()->json(['message' => 'Invalid file upload'], 400);
    }

    private function process_file(DataFile $dataFile)
    {
        $filePath = $dataFile->file_path;

        // Check if the file exists
        if (Storage::disk('public')->exists($filePath)) {
            $csv = Reader::createFromPath(Storage::disk('public')->path($filePath), 'r');
            $csv->setHeaderOffset(0);
            $rows = $csv->getRecords();

            foreach ($rows as $row) {
                // Calculate the sum of powers and energies from the CSV row
                $power_sum = ($row['P1'] ?? 0) + ($row['P2'] ?? 0) + ($row['P3'] ?? 0);
                $energy_sum = ($row['E1'] ?? 0) + ($row['E2'] ?? 0) + ($row['E3'] ?? 0);

                // Create the new SensorData record
                SensorData::create([
                    'data_file_id' => $dataFile->id,
                    'timestamp' => $row['timestamp'],
                    'V1' => $row['V1'],
                    'I1' => $row['I1'],
                    'P1' => $row['P1'],
                    'Q1' => $row['Q1'],
                    'E1' => $row['E1'],
                    'V2' => $row['V2'],
                    'I2' => $row['I2'],
                    'P2' => $row['P2'],
                    'Q2' => $row['Q2'],
                    'E2' => $row['E2'],
                    'V3' => $row['V3'],
                    'I3' => $row['I3'],
                    'P3' => $row['P3'],
                    'Q3' => $row['Q3'],
                    'E3' => $row['E3'],
                    'total_power' => $power_sum,
                    'total_energy' => $energy_sum,
                    'temperature' => $row['temperature'],
                    'misc1' => $row['misc1'],
                    'misc2' => $row['misc2'],
                    'misc3' => $row['misc3'],
                    'misc4' => $row['misc4'],
                    'misc5' => $row['misc5'],
                ]);
            }
        }
    }

    public function replace(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:data_files,id',
            'file' => 'required|mimes:csv,txt|max:2048',
        ]);

        $dataFile = DataFile::find($request->input('id'));
        $oldFile = $dataFile->file_path;

        if ($request->file('file')->isValid()) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('data_files', $fileName, 'public');

            $dataFile->update([
                'file_name' => $fileName,
                'file_path' => $filePath,
            ]);

            // Check if the old file exists and delete it
            if (Storage::disk('public')->exists($oldFile)) {
                Storage::disk('public')->delete($oldFile);
            }

            return response()->json(['message' => 'File replaced successfully.', 'data' => $dataFile], 201);
        } else {
            return response()->json(['message' => 'Invalid file upload.'], 400);
        }
    }
}
