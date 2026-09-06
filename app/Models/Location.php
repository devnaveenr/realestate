<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = ['location_name', 'city_slug', 'location_slug', 'city_id'];

    public function cityRelation()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function properties()
    {
        return $this->hasMany(Property::class, 'location');
    }
}
