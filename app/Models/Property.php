<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_title',
        'property_type',
        'property_desc',
        'price',
        'property_size',
        'facing',
        'bhk_type',
        'bathrooms',
        'property_status',
        'furnishing_type',
        'parking_type',
        'city',
        'city_slug',
        'location',
        'location_slug',
        'agent_id',
        'property_slug',
        'seo_url',
        'status',
        'title',
        'keywords',
        'description',
        'created_by',
        'modified_by',
    ];

    public function cityRelation()
    {
        return $this->belongsTo(City::class, 'city');
    }

    public function locationRelation()
    {
        return $this->belongsTo(Location::class, 'location');
    }

    public function typeRelation()
    {
        return $this->belongsTo(PropertyType::class, 'property_type');
    }

    public function statusRelation()
    {
        return $this->belongsTo(PropertyStatus::class, 'property_status');
    }

    public function bhkRelation()
    {
        return $this->belongsTo(BhkType::class, 'bhk_type');
    }

    public function facingRelation()
    {
        return $this->belongsTo(Facing::class, 'facing');
    }

    public function furnishingRelation()
    {
        return $this->belongsTo(Furnishing::class, 'furnishing_type');
    }

    public function parkingRelation()
    {
        return $this->belongsTo(Parking::class, 'parking_type');
    }

    public function images()
    {
        return $this->hasMany(PropertyImage::class, 'property_id');
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class, 'property_id');
    }

    public function getFormattedPriceAttribute(): string
    {
        $price = (float) $this->price;
        if ($price <= 0) {
            return '₹ 0';
        }

        if ($price >= 10000000) {
            $crores = $price / 10000000;
            $formatted = (floor($crores) == $crores) ? number_format($crores, 0) : rtrim(rtrim(number_format($crores, 2), '0'), '.');

            return '₹ '.$formatted.' Cr';
        }

        if ($price >= 100000) {
            $lakhs = $price / 100000;
            $formatted = (floor($lakhs) == $lakhs) ? number_format($lakhs, 0) : rtrim(rtrim(number_format($lakhs, 2), '0'), '.');

            return '₹ '.$formatted.' Lacs';
        }

        return '₹ '.number_format($price);
    }
}
