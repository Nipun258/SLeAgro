<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OldVegPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'fruit_id',
        'price_wholesale',
        'price_location',
        'price_retial',
        'price_date',
    ];
}
