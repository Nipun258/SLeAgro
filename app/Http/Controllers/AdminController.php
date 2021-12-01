<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{   

    public function Logout()
    {  
       Log::info('AdminController -> index started');
       Session::flush();
       Auth::logout();
       Log::info('AdminController -> user logout the system');
       return Redirect()->route('login');
       Log::info('AdminController -> user redirect to login form');
    }
}