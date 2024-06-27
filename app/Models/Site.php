<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class Site extends Model
{
    use HasFactory;
    use Loggable;

    protected $fillable = ['title', 'factory_id'];

    public function factory()
    {
        return $this->belongsTo(Factory::class);
    }

    public function components()
    {
        return $this->hasMany(Component::class);
    }
}
