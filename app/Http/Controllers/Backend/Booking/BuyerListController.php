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

        $todaybuyerbookingaccept = DB::table('buyer_bookings')
                    ->where('buyer_bookings.ecentre_id', Auth::user()->ecentre_id)
                    ->where('buyer_bookings.date',date('Y-m-d'))
                    ->where('buyer_bookings.status',1)
                    ->select(DB::raw('COUNT(id) as value'))
                    ->get();
        $todaybuyerbookingaccept = json_decode($todaybuyerbookingaccept,true);
           
        $todaybuyerbookingaccept = $todaybuyerbookingaccept[0]["value"];

        return view('backend.booking.buyer_list.today_list',compact('mybooking','todaybuyerbookingaccept'));
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

        public function BuyerBookingProductView($id){

        $product_list = DB::table('vegitable_book_lists')
                     ->Join('buyer_bookings','buyer_bookings.id','=','vegitable_book_lists.booking_id')
                     ->join('vegitables','vegitables.id','=','vegitable_book_lists.veg_id')
                     ->where('vegitable_book_lists.booking_id',$id)
                     ->select('vegitables.name','vegitable_book_lists.quntity','buyer_bookings.status')
                     ->get();
        //dd($product_list);

        $date = DB::table('buyer_bookings')
               ->where('buyer_bookings.id',$id)
               ->select('buyer_bookings.date')
               ->get();

        $date = json_decode($date,true);
        $bdate=$date[0]["date"];

         //dd($bdate);
         return view('backend.booking.buyer_book.book_product',compact('product_list','bdate')); 
    }
}
