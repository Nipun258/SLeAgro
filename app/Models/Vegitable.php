<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vegitable extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'catagory',
        'total_area',
        'total_producation',
        'annual_crop_count',
        'short_dis',
    ];
}
