<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FactorySummary extends Model
{
    use HasFactory;

    protected $fillable = [
        'factory_id',
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

    public function factory()
    {
        return $this->belongsTo(Factory::class);
    }
}
