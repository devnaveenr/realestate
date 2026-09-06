<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    use HasFactory;

    protected $fillable = [
        'slide_image',
        'slide_priority',
        'slide_desc',
        'slide_status',
        'created_by',
        'modified_by',
    ];
}
