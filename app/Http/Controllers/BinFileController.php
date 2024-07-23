<?php

namespace App\Http\Controllers;

use App\Models\BinFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BinFileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $files = BinFile::all();

        return response()->json($files, 200);
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
    public function show(BinFile $binFile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BinFile $binFile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $file = BinFile::find($id);
        if (!$file) {
            return response()->json(['message' => 'File not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:bin|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if ($request->file('file')->isValid()) {
            $newFile = $request->file('file');
            $fileName = time() . '_' . $newFile->getClientOriginalName();
            $filePath = $newFile->storeAs('files', $fileName, 'public');

            // Update file metadata in the database
            $file->update([
                'file_name' => $fileName,
                'file_path' => $filePath,
            ]);

            return response()->json(['message' => 'File updated successfully', 'data' => $file], 200);
        }

        return response()->json(['message' => 'Invalid file upload'], 400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $file = BinFile::find($id);
        if (!$file) {
            return response()->json(['message' => 'File not found'], 404);
        }

        $filePath = $file->file_path;

        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }

        $file->delete();
        return response()->json(['message' => 'File deleted successfully'], 200);
    }

    // Upload a new file
    public function upload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:bin|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if ($request->file('file')->isValid()) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('files', $fileName, 'public');

            // Store file metadata in the database
            $fileRecord = BinFile::create([
                'file_name' => $fileName,
                'file_path' => $filePath,
            ]);

            return response()->json(['message' => 'File uploaded successfully', 'data' => $fileRecord], 201);
        }

        return response()->json(['message' => 'Invalid file upload'], 400);
    }

    // Download a file
    public function download($id)
    {
        $file = BinFile::find($id);

        if (!$file) {
            return response()->json(['message' => 'File not found'], 404);
        }

        $filePath = $file->file_path;

        if (Storage::disk('public')->exists($filePath)) {
            return Storage::disk('public')->download($filePath, $file->file_name);
        } else {
            return response()->json(['message' => 'File not found'], 404);
        }
    }

    // Replace an existing file
    public function replace(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:bin_files,id',
            'file' => 'required|mimes:bin|max:2048',
        ]);

        $file = BinFile::find($request->input('id'));
        $oldFile = $file->file_path;

        if ($request->file('file')->isValid()) {
            $newFile = $request->file('file');
            $fileName = time() . '_' . $newFile->getClientOriginalName();
            $filePath = $newFile->storeAs('files', $fileName, 'public');

            $file->update([
                'file_name' => $fileName,
                'file_path' => $filePath,
            ]);

            if (Storage::disk('public')->exists($oldFile)) {
                Storage::disk('public')->delete($oldFile);
            }

            return response()->json(['message' => 'File replaced successfully', 'data' => $file], 201);
        } else {
            return response()->json(['message' => 'Invalid file upload'], 400);
        }
    }
}
