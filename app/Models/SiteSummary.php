<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSummary extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_id',
        'time_frame',
        'power',
        'energy',
        'min_power',
        'max_power',
        'min_energy',
        'max_energy',
        'start_time',
        'end_time',
    ];

    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}
