<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = ['city_name', 'city_slug'];

    public function locations()
    {
        return $this->hasMany(Location::class, 'city_id');
    }

    public function properties()
    {
        return $this->hasMany(Property::class, 'city');
    }
}
