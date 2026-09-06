<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyImage extends Model
{
    use HasFactory;

    protected $fillable = ['property_id', 'property_image', 'created_date'];

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }
}
