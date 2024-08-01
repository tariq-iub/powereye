<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SensorData extends Model
{
    use HasFactory;

    protected $fillable = ['data_file_id', 'timestamp', 'V1', 'I1', 'P1', 'Q1', 'E1', 'temperature'];
    protected $dates = ['timestamp'];

    public function data_file()
    {
        return $this->belongsTo(DataFile::class);
    }
}
