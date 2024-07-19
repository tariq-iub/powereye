<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Device extends Model
{
    use HasFactory;
    use Loggable;
    use SoftDeletes;

    public function getSerial(): string
    {
//        // Retrieve the highest serial number currently in the database
//        $latestDevice = Device::orderBy('id', 'desc')->first();
//        $nextId = $latestDevice ? intval(substr($latestDevice->serial_number, 2)) + 1 : 1;
//
//        // Generate a new serial number
//        return 'MC' . str_pad($nextId, 6, '0', STR_PAD_LEFT);

        do {
            $serial = 'MC' . str_pad(rand(1, 999999), 6, '0', STR_PAD_LEFT);
        } while (Device::where('serial_number', $serial)->exists());

        return $serial;
    }
}
