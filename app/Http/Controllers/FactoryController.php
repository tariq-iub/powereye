<?php

namespace App\Http\Controllers;

use App\Models\Factory;
use App\Models\User;
use App\Services\FactoryService;
use App\Services\FactorySummaryService;
use Illuminate\Http\Request;

class FactoryController extends Controller
{
    protected FactorySummaryService $factorySummaryService;

    public function __construct(FactorySummaryService $factorySummaryService)
    {
        $this->factorySummaryService = $factorySummaryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $factories = Factory::all();
        $users = User::all();

        return view('admin.factories.index', compact('factories', 'users'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.factories.create');
    }

    public function show(Factory $factory)
    {
        $factoryId = $factory->id;

        $latest_energy = $this->factorySummaryService->getLatestSummary($factoryId, false)->energy;
        $_12h_energy = $this->factorySummaryService->getSummary($factoryId, '12-hours', false)->energy;
        $_1w_energy = $this->factorySummaryService->getSummary($factoryId, '1-week', false)->energy;
        $_1m_energy = $this->factorySummaryService->getSummary($factoryId, '1-month', false)->energy;

        $timeframeOptions = getTimeframeOption();

        return view('client.factories.show', compact(
            'factory',
            'latest_energy',
            '_12h_energy',
            '_1w_energy',
            '_1m_energy',
            'timeframeOptions'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'title' => 'required|string',
            'address' => 'required|string',
            'owner_name' => 'required|string',
            'email' => 'required|email',
        ]);

        $factory = new Factory();
        $factory->title = $request->input('title');
        $factory->address = $request->input('address');
        $factory->owner_name = $request->input('owner_name');
        $factory->owner_cnic = $request->input('owner_cnic');
        $factory->email = $request->input('email');
        $factory->contact_no = $request->input('contact_no');
        $factory->fax = $request->input('fax');
        $factory->save();

        return redirect(route('factories.index'))->with('message', 'Factory registration updated successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Factory $factory)
    {
        return view('admin.factories.edit', compact('factory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Factory $factory)
    {
        $this->validate(request(), [
            'title' => 'required|string',
            'address' => 'required|string',
            'owner_name' => 'required|string',
            'email' => 'required|email',
        ]);

        $factory->title = $request->input('title');
        $factory->address = $request->input('address');
        $factory->owner_name = $request->input('owner_name');
        $factory->owner_cnic = $request->input('owner_cnic');
        $factory->email = $request->input('email');
        $factory->contact_no = $request->input('contact_no');
        $factory->fax = $request->input('fax');
        $factory->save();

        return redirect(route('factories.index'))->with('message', 'Factory registration updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Factory $factory)
    {
        $factory->delete();
        return redirect()->route('factories.index')->with('message', 'Factory deleted successfully.');
    }

    public function fetch(Request $request)
    {
        if ($request->input('id')) {
            $data = Factory::where('id', $request->input('id'))
                ->with(['sites'])
                ->first();

            if ($data)
                return response()->json($data, 200);
            else
                return response()->json(['message' => 'Factory is not registered in the system.'], 404);
        } else {
            $data = Factory::with(['sites'])
                ->get();

            if ($data)
                return response()->json($data, 200);
            else
                return response()->json(['message' => 'No factories registered in the system.'], 404);
        }
    }

    public function fetchData(Request $request, int $siteId, string $type, bool $json = true, $precisionVal = 2)
    {
        return app(FactoryService::class)->fetchData($request, $siteId, $type, $json, $precisionVal);
    }

    public function fetchFactoryData(Request $request, Factory $factory)
    {
        return app(FactoryService::class)->fetchFactoryData($request, $factory);
    }

    public function fetchFactories()
    {
        return app(FactoryService::class)->fetchFactories();
    }
}
