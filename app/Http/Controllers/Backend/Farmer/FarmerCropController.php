<?php

namespace App\Http\Controllers\Backend\Farmer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FarmerCropController extends Controller
{
    public function __construct(){
      
      $this->middleware('auth');

    }
}
