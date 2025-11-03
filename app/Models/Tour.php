<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;

    public function images()
    {
        return $this->hasMany(TourImages::class);
    }

    public function additional()
    {
        return $this->hasMany(TourAdditional::class);
    }

    public function hours()
    {
        return $this->hasMany(Hour::class);
    }
}
