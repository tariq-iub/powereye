<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SensorDataWindowedFactory extends Model
{
    use HasFactory;

    protected $fillable = [
        'factory_id',
        'timeframe',
        'window_start',
        'window_end',
        'P1',
        'P2',
        'P3',
        'E1',
        'E2',
        'E3',
    ];

    protected $casts = [
        'window_start' => 'datetime',
        'window_end' => 'datetime',
    ];

    public function factory()
    {
        return $this->belongsTo(Factory::class);
    }
}
