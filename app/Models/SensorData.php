<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SensorData extends Model
{
    use HasFactory;

    protected $fillable = [
        'data_file_id', 'timestamp',
        'V1', 'I1', 'P1', 'Q1', 'E1',
        'V2', 'I2', 'P2', 'Q2', 'E2',
        'V3', 'I3', 'P3', 'Q3', 'E3',
        'total_power', 'total_energy',
        'temperature'
    ];
    protected $dates = ['timestamp'];

    public function data_file()
    {
        return $this->belongsTo(DataFile::class);
    }
}
