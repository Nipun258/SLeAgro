<?php

namespace App\Http\Controllers\Backend\Booking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\BuyerBooking;
use App\Models\VegitableBookList;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Mail\BuyerBookingMail;
use Illuminate\Support\Facades\Mail;
use App\Rules\ArrayAtLeastOneRequired;

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

        return view('backend.booking.buyer_book.check',compact('orders','date','app_id'));
    }

    public function BookingBuyerApp(Request $request){
       
        $validatedData = $request->validate([
            'cus_order' => new ArrayAtLeastOneRequired(),
        ]);

        $check = $this->CheckBookingTimeInterval();

        if($check){
            $notification = array(
           'message' => 'You already made an appointment.please wait to make next appointmentss',
           'alert-type' => 'warning'
        );

        return redirect()->route('buyer.booking.view')->with($notification);
        }

        $booking = BuyerBooking::create([
             'user_id' => auth()->user()->id,
             'booking_id' => $request->appointmentId,
             'ccentre_id' => auth()->user()->ccentre_id,
             'ecentre_id' => auth()->user()->ecentre_id,
             'date' => $request->date,
         ]);

        $vegitable_list = count($request->cus_order);

          for($i=0; $i < $vegitable_list; $i++) {
            //dd($request->cus_order[$i])."<br>";
            if($request->cus_order[$i]!='0' && $request->cus_order[$i]!='null' && $request->cus_order[$i]!=''){
            $vegitable_inventory = new VegitableBookList();
            $vegitable_inventory->booking_id = $request->appointmentId;
            $vegitable_inventory->veg_id = $request->veg_id[$i];
            $vegitable_inventory->quntity = $request->cus_order[$i];
            $vegitable_inventory->save();
            }
          }

        $ename = DB::table('economic_centres')
                ->where('id', auth()->user()->ecentre_id)
                ->select('economic_centres.centre_name')
                ->get();
        $ename=json_decode($cname,true);
        $ename=$ename[0]["centre_name"];
        
        $data1 = [
               'name' => auth()->user()->name,
               'date' => $request->date,
               'location' => $cname
            ];
    
       $mail = new BuyerBookingMail($data1);
    
       Mail::to(auth()->user()->email)->send($mail);

         
        $notification = array(
           'message' => 'Vegitable booking added successfully',
           'alert-type' => 'success'
        );

        return redirect()->route('buyer.booking.view')->with($notification);

    }

    public function CheckBookingTimeInterval()
    {
        return BuyerBooking::orderby('id','desc')
               ->where('user_id',auth()->user()->id)
               ->whereDate('created_at',date('Y-m-d'))
               ->exists(); 
    }

    public function BuyerBookingList()
    {
           $mybooking  = DB::table('buyer_bookings')
                        ->Join('users','buyer_bookings.user_id','=','users.id')
                        ->Join('economic_centres','buyer_bookings.ecentre_id','=','economic_centres.id')
                        ->where('buyer_bookings.ecentre_id', Auth::user()->ecentre_id)
                        ->select('users.name','economic_centres.centre_name','buyer_bookings.date','buyer_bookings.created_at','buyer_bookings.status')
                        ->orderBy('date', 'desc')
                        ->get();

        return view('backend.booking.buyer_book.list',compact('mybooking'));
    }

}
