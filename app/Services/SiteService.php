<?php

namespace App\Services;

use App\Models\Site;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SiteService
{
    public function fetchData(Request $request, int $siteId, string $type, string $timeframe = 'all', bool $json = true, int $precisionVal = 2): array|float|JsonResponse
    {
        $validationResult = validateAndPrepareData($type, $request, $precisionVal);
        if ($validationResult instanceof JsonResponse) {
            return $validationResult;
        }

        $columns = $validationResult['columns'];
        $precision = $validationResult['precision'];

        try {

            $startDate = mapTimeframe($timeframe);

            $site = Site::with(['data_file.data' => function ($query) use ($columns, $startDate, $timeframe) {
                $query->select(array_merge($columns, ['data_file_id']))
                    ->when($timeframe !== 'all', function ($query) use ($startDate) {
                        $query->where('timestamp', '>=', $startDate);
                    });
            }])
                ->find($siteId);


            if (!$site) {
                $errorResponse = ['error' => 'Site not found'];
                return $json ? response()->json($errorResponse, 404) : $errorResponse;
            }

            $totalValue = $site->data_file->flatMap(function ($dataFile) {
                return $dataFile->data;
            })->sum(function ($data) use ($columns) {
                return array_sum(array_map(fn($col) => $data->$col, $columns));
            });

            $result = round($totalValue, $precision);

            return $json ? response()->json($result) : $result;
        } catch (\Exception $e) {
            \Log::error('Site data processing error: ' . $e->getMessage());
            $errorResponse = ['error' => 'Data processing error'];
            return $json ? response()->json($errorResponse, 500) : $errorResponse;
        }
    }
}
