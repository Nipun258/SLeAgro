<?php

namespace App\Http\Controllers\Backend\Booking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Booking;
use App\Models\CollectionCentre;
use App\Models\Time;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Mail\FarmerBookingMail;
use Illuminate\Support\Facades\Mail;
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
    
       $mail = new FarmerBookingMail($data1);
    
       Mail::to(auth()->user()->email)->send($mail);

        Time::where('appointment_id',$request->appointmentId)
              ->where('time',$request->time)
              ->update(['status'=> 1]);
         
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
                        ->where('bookings.ccentre_id', Auth::user()->ccentre_id)
                        ->select('users.name','collection_centres.centre_name','bookings.date','bookings.time','bookings.created_at','bookings.status')
                        ->orderBy('date', 'desc')
                        ->get();
        return view('backend.booking.book.list',compact('mybooking'));
    }
}
