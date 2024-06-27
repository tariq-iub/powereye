<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Support\Facades\DB;

class Device extends Model
{
    use HasFactory;
    use Loggable;

    public function getSerial(): string
    {
        $query = DB::select("SHOW TABLE STATUS LIKE 'devices'");
        $nextId = $query[0]->Auto_increment;

        // Use the nextId to generate a custom serial number
        return 'MC' . str_pad($nextId, 6, '0', STR_PAD_LEFT);
    }
}
