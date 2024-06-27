<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sites = Site::with('factory')->get();
        return view('sites.index', compact('sites'));
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
    public function show(Site $site)
    {
        return view('sites.show', compact('site'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Site $site)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Site $site)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Site $site)
    {

    }

    public function fetch(Request $request)
    {
        if($request->input('id'))
        {
            $data = Site::where('id', $request->input('id'))
                ->with(['components'])
                ->first();

            if($data) return response()->json($data, 200);
            else return response()->json(['message' => 'Site is not registered in the system.'], 404);
        }
        else
        {
            $data = Site::with(['components'])
                ->get();

            if($data) return response()->json($data, 200);
            else return response()->json(['message' => 'No sites registered in the system.'], 404);
        }
    }
}
