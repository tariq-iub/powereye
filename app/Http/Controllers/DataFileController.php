<?php

namespace App\Http\Controllers;

use App\Models\DataFile;
use App\Models\Device;
use App\Models\Factory;
use App\Models\Inspection;
use App\Models\SensorData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use DataTables;
use League\Csv\Reader;

class DataFileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return DataFile::with('data')->get();

        if ($request->ajax())
        {
            $data = DataFile::select('*');

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('inspection', function($row) {
                    return view('admin.data.partial.inspection', compact('row'));
                })
                ->addColumn('device', function ($row) {
                    return $row->device->serial_number;
                })
                ->addColumn('component', function ($row) {
                    return ($row->component) ? $row->component->title : "";
                })
                ->addColumn('site', function ($row) {
                    return $row->site->title;
                })
                ->addColumn('factory', function ($row) {
                    return $row->site->factory->title;
                })
                ->addColumn('uploaded_at', function ($row) {
                    return view('admin.data.partial.uploaded_at', compact('row'));
                })
                ->addColumn('action', function($row) {
                    return view('admin.data.partial.action', compact('row'));
                })
                ->rawColumns(['inspection', 'uploaded_at', 'action'])
                ->make(true);
        }

        $factories = Factory::all();
        $devices = Device::all();
        $inspections = Inspection::where('taken_up', false)->get();
        return view('admin.data.index', compact('factories', 'devices', 'inspections'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataFile $dataFile)
    {
        $factories = Factory::all();
        $devices = Device::all();
        $inspections = Inspection::all();
        return view('admin.data.edit', compact('dataFile', 'factories', 'devices', 'inspections'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataFile $dataFile)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:csv,txt|max:2048',
            'site_id' => 'required|exists:sites,id',
            'device_serial' => 'required|string|exists:devices,serial_number', // Ensure device is registered
            'inspection_id' => 'required|exists:inspections,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $device = Device::where('serial_number', $request->input('device_serial'))->first();

        if ($request->file('file')->isValid()) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('data_files', $fileName, 'public');

            $dataFile->file_name = $fileName;
            $dataFile->file_path = $filePath;
            $dataFile->component_id = $request->input('component_id');
            $dataFile->site_id = $request->input('site_id');
            $dataFile->device_id = $device->id;
            $dataFile->inspection_id = $request->input('inspection_id');

            $dataFile->save();

            return redirect(route('data.index'))->with('success', 'Data updated successfully.');
        }
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

    public function download(DataFile $dataFile)
    {
        $filePath = $dataFile->file_path;

        // Check if the file exists
        if (Storage::disk('public')->exists($filePath))
        {
            // Return the file as a download response
            return Storage::disk('public')->download($filePath, $dataFile->file_name);
        }
        else {
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

        if (Storage::disk('public')->exists($filePath)) {
            $csv = Reader::createFromPath(Storage::disk('public')->path($filePath), 'r');
            $csv->setHeaderOffset(0);
            $rows = $csv->getRecords();

            foreach ($rows as $row) {
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
        }
        else {
            return response()->json(['message' => 'Invalid file upload.'], 400);
        }
    }
}
