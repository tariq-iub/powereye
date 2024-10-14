<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeviceManagementController extends Controller
{
    //

    public function getDateTime()
    {
        $now = now();

        return response()->json([
            "year" => $now->year,
            "month" => $now->month,
            "day" => $now->day,
            "hour" => $now->hour,
            "minute" => $now->minute,
            "second" => $now->second,
        ], 200);
    }
}
