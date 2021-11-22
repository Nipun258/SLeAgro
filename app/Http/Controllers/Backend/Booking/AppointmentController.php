<?php

namespace App\Http\Controllers\Backend\Booking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Time;
use Auth;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    public function __construct(){
      
      $this->middleware('auth');

    }
    public function AppCheckView(){
        
        $myappointment  = DB::table('appointments')
                        ->Join('users','appointments.user_id','=','users.id')
                        ->Join('collection_centres','appointments.ccentre_id','=','collection_centres.id')
                        ->where('user_id', Auth::user()->id)
                        ->where('appointments.status',0)
                        ->select('users.name','collection_centres.centre_name','appointments.date','appointments.id')
                        ->orderBy('date', 'desc')
                        ->get();

        return view('backend.booking.appointment.index',compact('myappointment'));
    }

     public function AppSetup()
    { 

      return view('backend.booking.appointment.add');
    }

    public function AppStore(Request $request){

        // dd($request->all());

        $validatedData = $request->validate([
            'date' => 'required|unique:appointments,date,NULL,id,user_id,'.\Auth::id(),
        ],[
               
            'date.unique' => 'All ready setup appointment'

        ]);

        $appointment = Appointment::create([
             'user_id' => auth()->user()->id,
             'ccentre_id' => auth()->user()->ccentre_id,
             'date' => $request->date
         ]);

        foreach ($request->time as $time) {
            Time::create([
             'appointment_id' => $appointment->id,
             'time' => $time,
             //'status' => 0
            ]);
        }

         
        $notification = array(
           'message' => 'New appointment data setup for '.$request->date. ' Successfully',
           'alert-type' => 'success'
        );

        return redirect()->route('app.setup')->with($notification);

    }

        public function AppCheck(Request $request){

        $validatedData = $request->validate([
            'date' => 'required',
        ]);

        $date = $request->date;
        $appointment = Appointment::where('date',$date)
                       ->where('user_id',auth()->user()->id)
                       ->first();
        
        if(empty($appointment)){
          
               $notification = array(
                  'message' => 'appointment record data in '.$date.' not found',
                  'alert-type' => 'info'
               );

           return redirect()->route('app.check.view')->with($notification);

         }else{

            $appointmentId = $appointment->id;
            $times = Time::where('appointment_id',$appointmentId)
                    ->get();
            //return $time;
            return view('backend.booking.appointment.index',compact('times','appointmentId','date'));
         }
         
        

    }
    public function AppTimeUpdate(Request $request){

        $appointmentId = $request->appointmentId;
        $appointment = Time::where('appointment_id' ,$appointmentId)
                       ->delete();
        foreach($request->time as $time){

            Time::create([
                'appointment_id' => $appointmentId,
                'time' => $time,
                'status' => 0
            ]);
        }

    $notification = array(
           'message' => 'Appointment data has been updated Successfully',
           'alert-type' => 'success'
        );

        return redirect()->route('app.setup')->with($notification);

    }

}
