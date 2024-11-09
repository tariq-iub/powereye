<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SensorDataWindowedSite extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_id',
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

    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}
