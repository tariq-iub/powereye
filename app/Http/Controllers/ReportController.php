<?php

namespace App\Http\Controllers;

use App\Models\Factory;
use App\Services\SensorDataService;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ReportController extends Controller
{
    protected SensorDataService $sensorDataService;

    public function __construct(SensorDataService $sensorDataService)
    {
        $this->sensorDataService = $sensorDataService;
    }

    public function index(Request $request): View
    {
        $factories = getAuthFactories();
        $sites = getAuthSites();
        $type = $request->get('type', 'factory');
        $entityId = $request->get('entityId');
        $timeRange = $request->get('time_range');
        $startDate = null;
        $endDate = null;
        $reportData = null;

        if ($entityId && $timeRange) {
            [$startDate, $endDate] = explode(' to ', $timeRange);

            $endDate = Carbon::createFromFormat('d/m/y', trim($endDate))->endOfDay();
            $startDate = Carbon::createFromFormat('d/m/y', trim($startDate))->startOfDay();

            $reportData = $this->getReportData($type, $entityId, $startDate, $endDate);
        }

        return view('reports.index', compact('factories', 'sites', 'type', 'entityId', 'startDate', 'endDate', 'reportData'));
    }

    private function getReportData(string $type, int $entityId, $startDate, $endDate)
    {
        return $this->sensorDataService->fetchDataForReport($type, $entityId, $startDate, $endDate);
    }

    public function download(string $type, int $entityId, $startDate, $endDate)
    {
        $creation_date = Carbon::now();
        $user = Auth::user();
        $reportPeriod = $startDate . ' to ' . $endDate;
        $reportData = $this->getReportData($type, $entityId, $startDate, $endDate);

        $entity = $type !== 'site' ? getAuthFactories()->find($entityId) :findAuthSite($entityId);

        $ext = $type === 'site' ? '_' . Factory::where('id', $entity->factory_id)->first()->title : "";

        if (!$entity) return redirect()->back();

        $report = Pdf::loadView('reports.download', compact('entity', 'type', 'entityId', 'user', 'reportPeriod', 'reportData'));

        $filename = "report_" . $entity->title . $ext . "_" . $creation_date->format('YmdHis') . ".pdf";

        return $report->download($filename);
    }

}
