<?php

namespace App\Http\Controllers\Backend\Booking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Booking;
use App\Models\CollectionCentre;
use App\Models\Time;
use App\Models\Events;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Mail\FarmerBookingMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Nexmo;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function __construct(){
      
      $this->middleware('auth');

    }

    public function BookingView(){

        
        $mybooking  = DB::table('appointments')
                        ->Join('users','appointments.user_id','=','users.id')
                        ->Join('collection_centres','appointments.ccentre_id','=','collection_centres.id')
                        ->where('appointments.ccentre_id', Auth::user()->ccentre_id)
                        ->where('appointments.status',0)
                        ->where('appointments.date','>=', date('Y-m-d'))
                        ->select('users.name','collection_centres.centre_name','appointments.date','appointments.id')
                        ->orderBy('date', 'desc')
                        ->get();

        return view('backend.booking.book.index',compact('mybooking'));
    }

    public function BookingTimeView($id)
    {   
        $times = DB::table('times')
                ->where('appointment_id', $id)
                ->where('status',0)
                ->get();

        $date = DB::table('appointments')
                ->where('id', $id)
                ->select('appointments.date')
                ->get();

        $date=json_decode($date,true);
        $date=$date[0]["date"];

        //dd($date);

        $current_time = Carbon::now()->format('H:i');
        $today_date = Carbon::now()->format('Y-m-d');

        //dd($current_time);

        return view('backend.booking.book.check',compact('times','date','current_time','today_date'));
    }

    public function BookingApp(Request $request){

        $validatedData = $request->validate([
            'time' => 'required'
        ],[
            'time.required' => 'You Must select sutiable time for selling your product'
        ]);
        $check = $this->CheckBookingTimeInterval();

        if($check){
            $notification = array(
           'message' => 'You already made an appointment.please wait to make next appointmentss',
           'alert-type' => 'warning'
        );

        return redirect()->route('booking.list')->with($notification);
        }
        $booking = Booking::create([
             'user_id' => auth()->user()->id,
             'ccentre_id' => auth()->user()->ccentre_id,
             'date' => $request->date,
             'time' => $request->time
         ]);

        $cname = DB::table('collection_centres')
                ->where('id', auth()->user()->ccentre_id)
                ->select('collection_centres.centre_name')
                ->get();
        $cname=json_decode($cname,true);
        $cname=$cname[0]["centre_name"];
        
        $data1 = [
               'name' => auth()->user()->name,
               'date' => $request->date,
               'time' => $request->time,
               'location' => $cname
            ];

       $booking_Start = date('Y-m-d H:i:s', strtotime("$request->date $request->time"));

       $booking_End = date("Y-m-d H:i:s", strtotime($booking_Start . "+30 minutes"));
    
       $mail = new FarmerBookingMail($data1);

       //dd($booking_End);
    
       Mail::to(auth()->user()->email)->send($mail);

       Time::where('appointment_id',$request->appointmentId)
              ->where('time',$request->time)
              ->update(['status'=> 1]);

        Events::insert([
            'user_id' => Auth::user()->id,
            'title' => 'Vegetable selling Book',
            'start' => $booking_Start,
            'end' => $booking_End,
            'event_type' => 2,
            'created_at' => Carbon::now()
        ]);
         
        $notification = array(
           'message' => 'New appointment booking make Successfully',
           'alert-type' => 'success'
        );

        return redirect()->route('booking.list')->with($notification);

    }
    public function CheckBookingTimeInterval()
    {
        return Booking::orderby('id','desc')
               ->where('user_id',auth()->user()->id)
               ->whereDate('created_at',date('Y-m-d'))
               ->exists(); 
    }

    public function BookingList(){

        
        $mybooking  = DB::table('bookings')
                        ->Join('users','bookings.user_id','=','users.id')
                        ->Join('collection_centres','bookings.ccentre_id','=','collection_centres.id')
                         ->where('users.id', Auth::user()->id)
                        ->select('users.name','collection_centres.centre_name','bookings.date','bookings.time','bookings.created_at','bookings.status')
                        ->orderBy('date', 'desc')
                        ->get();
        //dd($mybooking);
        return view('backend.booking.book.list',compact('mybooking'));
    }

        public function BookingInvoice(){

        $mybooking  = DB::table('bookings')
                        ->Join('users','bookings.user_id','=','users.id')
                        ->Join('collection_centres','bookings.ccentre_id','=','collection_centres.id')
                         ->where('users.id', Auth::user()->id)
                         ->where('bookings.status',2)
                        ->select('users.name','collection_centres.centre_name','bookings.date','bookings.time','bookings.created_at','bookings.status','bookings.id')
                        ->orderBy('date', 'desc')
                        ->get();

        return view('backend.booking.book.invoice',compact('mybooking'));
    } 

    public function BookingInvoiceGenerate($id){

        $order_id = 'BO'.str_pad($id , 6, "0", STR_PAD_LEFT);

        $invoice_id = '#IBO'.str_pad($id , 6, "0", STR_PAD_LEFT);

        $date = DB::table('inventories')
                ->where('inventories.order_id',$order_id)
                ->whereIn('inventories.status',[0,3])
                ->select('inventories.date')
                ->limit(1)
                ->get();

        $date = json_decode($date,true);
        $bdate=$date[0]["date"];

        $ccenter = DB::table('users')
                  ->Join('collection_centres','collection_centres.id','=','users.ccentre_id')
                  ->where('users.id',Auth::user()->id)
                  ->select('users.name','users.mobile','users.email','users.address','collection_centres.centre_name','users.id')
                  ->get();

        $user = DB::table('inventories')
                  ->Join('users','users.id','=','inventories.user_id')
                  ->Join('farmers','farmers.user_id','=','users.id')
                  ->where('inventories.order_id',$order_id)
                  ->whereIn('inventories.status',[0,3])
                  ->select('users.name','users.mobile','users.email','users.address','farmers.account_number','inventories.order_id','inventories.invoice_id','users.id')
                  ->orderBy('inventories.order_id', 'desc')
                  ->limit(1)
                  ->get();

        $orders = DB::table('inventories')
                ->Join('vegitables','vegitables.id','=','inventories.veg_id')
                ->Join('old_veg_prices','old_veg_prices.veg_id','=','vegitables.id')
                ->where('inventories.order_id',$order_id)
                ->whereIn('inventories.status',[0,3])
                ->where('old_veg_prices.price_date',$bdate)
                ->select('vegitables.name','inventories.quntity','old_veg_prices.price_wholesale','inventories.price')
                ->get();

        $total_price = DB::table('inventories')
                       ->where('inventories.order_id',$order_id)
                       ->whereIn('inventories.status',[0,3])
                       ->select(DB::raw('SUM(inventories.price) as total'))
                       ->get();
        
        return view('backend.inventory.ccentre.invoice',compact('ccenter','user','orders','total_price','bdate'));
    }
}
