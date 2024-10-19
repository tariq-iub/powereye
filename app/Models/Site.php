<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Site extends Model
{
    use HasFactory;
    use Loggable;
    use SoftDeletes;

    protected $fillable = ['title', 'factory_id'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    public function factory()
    {
        return $this->belongsTo(Factory::class);
    }

    public function components()
    {
        return $this->hasMany(Component::class);
    }

    public function data_file()
    {
        return $this->hasMany(DataFile::class);
    }

    public function data()
    {
        return $this->hasManyThrough(SensorData::class, DataFile::class);
    }

    public function getTotalPower(int $precision = 2): float
    {
        return round($this->data()->sum(DB::raw('P1 + P2 + P3')), $precision);
    }

    public function getTotalEnergy(int $precision = 4): float
    {
        return round($this->data()->sum(DB::raw('E1 + E2 + E3')), $precision);
    }

    public function getLastTimestamp(bool $relative = true): string
    {
        $lastData = $this->data()->orderBy('timestamp', 'desc')->first();

        if ($lastData && $lastData->timestamp) {
            $timestamp = Carbon::parse($lastData->timestamp);

            return $relative ? $timestamp->diffForHumans() : $timestamp->toDateTimeString();
        }

        return $relative ? 'No data available' : '0000-00-00 00:00:00';
    }


    public function getLastEnergy(int $precision=4): float
    {
        $lastData = $this->data()->orderBy('timestamp', 'desc')->first();

        if ($lastData) {
            return round($lastData->E1 + $lastData->E2 + $lastData->E3, $precision);
        }

        return 0.0;
    }
}
