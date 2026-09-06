<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'logo',
        'site_name',
        'contact_no',
        'company_email',
        'gst',
        'address',
        'usd_price',
        'created_by',
        'modified_by',
    ];
}
