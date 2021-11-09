<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmerCrop extends Model
{
    use HasFactory;

    //protected $table = 'farmer_crops';

    protected $fillable = [
        'farmer_id',
        'product',
        'total_area'
    ];
}
