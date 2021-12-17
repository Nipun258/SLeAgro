<?php

namespace App\Http\Controllers\Backend\Booking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Events;
use Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BuyerAppointmentController extends Controller
{
    public function __construct(){
      
      $this->middleware('auth');

    }

    public function BuyerAppCheckView(){
        
        $myappointment  = DB::table('appointments')
                        ->Join('users','appointments.user_id','=','users.id')
                        ->Join('economic_centres','appointments.ecentre_id','=','economic_centres.id')
                        ->where('user_id', Auth::user()->id)
                        ->where('appointments.status',1)
                        ->select('users.name','economic_centres.centre_name','appointments.date','appointments.id')
                        ->orderBy('date', 'desc')
                        ->get();

        return view('backend.booking.buyer_appointment.index',compact('myappointment'));
    }

    public function BuyerAppSetup()
    { 

      return view('backend.booking.buyer_appointment.add');
    }

    public function BuyerAppStore(Request $request){

        $ststus = 1;

        $validatedData = $request->validate([

            'date' => 'required|after:now|unique:appointments,date,NULL,id,user_id,'.\Auth::id(),
        ],[
               
            'date.unique' => 'All ready setup appointment'

        ]);

        $appointment = Appointment::create([
             'user_id' => auth()->user()->id,
             'ecentre_id' => auth()->user()->ecentre_id,
             'date' => $request->date,
             'status' => $ststus
         ]);

        $booking_Start = date('Y-m-d H:i:s', strtotime("$request->date"));

        $booking_End = date("Y-m-d H:i:s", strtotime($booking_Start . "+1 day"));

        Events::insert([
            'user_id' => Auth::user()->id,
            'title' => 'Buyer Appointment',
            'start' => $booking_Start,
            'end' => $booking_End,
            'event_type' => 2,
            'created_at' => Carbon::now()
        ]);

         
        $notification = array(
           'message' => 'New appointment data setup for '.$request->date. ' Successfully',
           'alert-type' => 'success'
        );

        return redirect()->route('buyer.app.check.view')->with($notification);

    }

    public function BuyerAppDelete($id){

        $my_app = Appointment::find($id);
        $my_app->delete();

        $notification = array(
           'message' => 'Economic Centre Appointment Cancel',
           'alert-type' => 'error'
        );

        return redirect()->route('buyer.app.check.view')->with($notification);
    }

}
