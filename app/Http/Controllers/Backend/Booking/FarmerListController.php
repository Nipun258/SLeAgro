<?php

namespace App\Http\Controllers\Backend\Booking;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use Auth;
use Illuminate\Support\Facades\DB;

class FarmerListController extends Controller
{   
    public function __construct(){
      
      $this->middleware('auth');

    }//check auth in controller

    public function AppList()
    {
        $mybooking  = DB::table('bookings')
                        ->Join('users','bookings.user_id','=','users.id')
                        ->Join('collection_centres','bookings.ccentre_id','=','collection_centres.id')
                        ->where('bookings.ccentre_id', Auth::user()->ccentre_id)
                        ->select('users.name','collection_centres.centre_name','bookings.date','bookings.time','bookings.created_at','bookings.status','users.email','users.image','users.mobile','bookings.id')
                        ->orderBy('date', 'desc')
                        ->get();

        return view('backend.booking.farmer_list.list',compact('mybooking'));
    }

    public function AppListToday()
    {
        $mybooking  = DB::table('bookings')
                        ->Join('users','bookings.user_id','=','users.id')
                        ->Join('collection_centres','bookings.ccentre_id','=','collection_centres.id')
                        ->where('bookings.ccentre_id', Auth::user()->ccentre_id)
                        ->where('bookings.date',date('Y-m-d'))
                        ->select('users.name','collection_centres.centre_name','bookings.date','bookings.time','bookings.created_at','bookings.status','users.email','users.image','users.mobile','bookings.id')
                        ->orderBy('date', 'desc')
                        ->get();

       $todaybookingaccept  = DB::table('bookings')
                    ->where('bookings.ccentre_id', Auth::user()->ccentre_id)
                    ->where('bookings.date',date('Y-m-d'))
                    ->where('bookings.status',1)
                    ->select(DB::raw('COUNT(id) as value'))
                    ->get();
        $todaybookingaccept = json_decode($todaybookingaccept,true);
           
        $todaybookingaccept = $todaybookingaccept[0]["value"];

        return view('backend.booking.farmer_list.today_list',compact('mybooking','todaybookingaccept'));
    }

    public function AppFilter(Request $request){
        
        $validatedData = $request->validate([
            'date' => 'required'
        ],[
            'date.required' => 'You Must select valid date'
        ]);

        if ($request->date) {
            
            $mybooking  = DB::table('bookings')
                        ->Join('users','bookings.user_id','=','users.id')
                        ->Join('collection_centres','bookings.ccentre_id','=','collection_centres.id')
                        ->where('bookings.ccentre_id', Auth::user()->ccentre_id)
                        ->where('bookings.date',$request->date)
                        ->select('users.name','collection_centres.centre_name','bookings.date','bookings.time','bookings.created_at','bookings.status','users.email','users.image','users.mobile','bookings.id')
                        ->orderBy('date', 'desc')
                        ->get();

          return view('backend.booking.farmer_list.today_list',compact('mybooking'));
        }
    }

    public function ToggleStatus($id){

        $booking = Booking::find($id);
        $booking->status =! $booking->status;
        $booking->save();

        return redirect()->back();
    }
}
