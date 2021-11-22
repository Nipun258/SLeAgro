<?php

namespace App\Http\Controllers\Backend\Booking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Booking;
use App\Models\EconomicCentre;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Mail\FarmerBookingMail;
use Illuminate\Support\Facades\Mail;

class BuyerBookingController extends Controller
{
    public function __construct(){
      
      $this->middleware('auth');

    }

    public function BuyerBookingView(){

        
        $mybooking  = DB::table('appointments')
                        ->Join('users','appointments.user_id','=','users.id')
                        ->Join('economic_centres','appointments.ecentre_id','=','economic_centres.id')
                        ->where('appointments.ecentre_id', Auth::user()->ecentre_id)
                        ->where('appointments.status',1)
                        ->where('appointments.date','>=', date('Y-m-d'))
                        ->select('users.name','economic_centres.centre_name','appointments.date','appointments.id')
                        ->orderBy('date', 'desc')
                        ->get();

        return view('backend.booking.buyer_book.index',compact('mybooking'));
    }

    public function BookingProductView($id)
    {   
        $orders = DB::table('inventories')
                ->Join('vegitables','vegitables.id','=','inventories.veg_id')
                ->Join('economic_centres','economic_centres.id','=','inventories.ecentre_id')
                ->where('inventories.status',0)
                ->where('inventories.ecentre_id',Auth::user()->ecentre_id)
                ->select('vegitables.name','vegitables.id',DB::raw('SUM(inventories.quntity) as count'),DB::raw('SUM(inventories.price) as total'))
                ->groupBy('inventories.veg_id','vegitables.name','vegitables.id')
                ->get();

        $date = DB::table('appointments')
                ->where('id', $id)
                ->select('appointments.date')
                ->get();
        $date=json_decode($date,true);
        $date=$date[0]["date"];

        $app_id = $id;
        //dd($app_id);

        return view('backend.booking.buyer_book.check',compact('orders','date','app_id'));
    }

}
