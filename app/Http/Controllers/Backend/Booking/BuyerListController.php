<?php

namespace App\Http\Controllers\Backend\Booking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BuyerBooking;
use Auth;
use Illuminate\Support\Facades\DB;

class BuyerListController extends Controller
{
    public function __construct(){
      
      $this->middleware('auth');

    }
    public function ProductReqList()
    {
        $mybooking  = DB::table('buyer_bookings')
                        ->Join('users','buyer_bookings.user_id','=','users.id')
                        ->Join('economic_centres','buyer_bookings.ecentre_id','=','economic_centres.id')
                        ->where('buyer_bookings.ecentre_id', Auth::user()->ecentre_id)
                        ->select('users.name','economic_centres.centre_name','buyer_bookings.date','buyer_bookings.created_at','buyer_bookings.status','users.email','users.image','users.mobile','buyer_bookings.id')
                        ->orderBy('date', 'desc')
                        ->get();

        return view('backend.booking.buyer_list.list',compact('mybooking'));
    }

    public function ProductReqListToday()
    {
        $mybooking  = DB::table('buyer_bookings')
                        ->Join('users','buyer_bookings.user_id','=','users.id')
                        ->Join('economic_centres','buyer_bookings.ecentre_id','=','economic_centres.id')
                        ->where('buyer_bookings.ecentre_id', Auth::user()->ecentre_id)
                        ->where('buyer_bookings.date',date('Y-m-d'))
                        ->select('users.name','economic_centres.centre_name','buyer_bookings.date','buyer_bookings.created_at','buyer_bookings.status','users.email','users.image','users.mobile','buyer_bookings.id')
                        ->orderBy('date', 'desc')
                        ->get();

        return view('backend.booking.buyer_list.today_list',compact('mybooking'));
    }

    public function ProductReqFilter(Request $request){
        
        $validatedData = $request->validate([
            
            'date' => 'required'
        ],[
            'date.required' => 'You Must select valid date'
        ]);

        if ($request->date) {
            
            $mybooking  = DB::table('buyer_bookings')
                        ->Join('users','buyer_bookings.user_id','=','users.id')
                        ->Join('economic_centres','buyer_bookings.ecentre_id','=','economic_centres.id')
                        ->where('buyer_bookings.ecentre_id', Auth::user()->ecentre_id)
                        ->where('buyer_bookings.date',$request->date)
                        ->select('users.name','economic_centres.centre_name','buyer_bookings.date','buyer_bookings.created_at','buyer_bookings.status','users.email','users.image','users.mobile','buyer_bookings.id')
                        ->orderBy('date', 'desc')
                        ->get();

         //dd($mybooking);

           return view('backend.booking.buyer_list.today_list',compact('mybooking'));
        }
    }

    public function ProductReqToggleStatus($id){

        $booking = BuyerBooking::find($id);
        //dd($booking);
        $booking->status =! $booking->status;
        $booking->save();

        return redirect()->back();
    }
}
