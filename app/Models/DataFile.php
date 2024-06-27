<?php

namespace App\Models;

use App\Events\DataFileInserted;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class DataFile extends Model
{
    use HasFactory;
    use Loggable;

    protected $fillable = ['file_name', 'file_path', 'site_id', 'device_id'];

//    protected $dispatchesEvents = [
//        'created' => DataFileInserted::class,
//    ];

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function data()
    {
        return $this->hasMany(SensorData::class);
    }
}
