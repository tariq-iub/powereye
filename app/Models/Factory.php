<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class Factory extends Model
{
    use HasFactory;
    use Loggable;

    protected $fillable = ['title', 'address', 'owner_name', 'email'];

    public function sites()
    {
        return $this->hasMany(Site::class);
    }
}
