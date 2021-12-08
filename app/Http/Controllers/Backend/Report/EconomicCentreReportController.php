<?php

namespace App\Http\Controllers\Backend\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use PDF;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class EconomicCentreReportController extends Controller
{
    public function __construct(){
      
      $this->middleware('auth');

    }

    public function EcentreReportView(){
          
       return view('backend.report.ereport.index');
    }

    public function EcentreBuyerList()
    {   
        $buyers = DB::table('users')
                   ->Join('buyers','users.id','=','buyers.user_id')
                   ->where('users.role', '=', 'Buyer')
                   ->where('users.ecentre_id',Auth::user()->ecentre_id)
                   ->get();

        $ecenter = DB::table('users')
                  ->Join('economic_centres','economic_centres.id','=','users.ecentre_id')
                  ->where('users.id',Auth::user()->id)
                  ->select('users.name','users.mobile','users.email','users.address','economic_centres.centre_name')
                  ->get();


        $pdf = PDF::loadView('backend.report.ereport.buyer_list', compact('buyers','ecenter'),[], 
        [ 
          'format' => 'A4-L',
          'orientation' => 'L'
        ]);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('Buyer List Summary.pdf');
    }

        public function EcentreUserList()
    {   
        $users = DB::table('users')
                   ->Join('collection_centres','collection_centres.id','=','users.ccentre_id')
                   ->where('users.usertype', '=', 'Admin')
                   ->where('users.ecentre_id',Auth::user()->ecentre_id)
                   ->get();
        //dd($users);
        $ecenter = DB::table('users')
                  ->Join('economic_centres','economic_centres.id','=','users.ecentre_id')
                  ->where('users.id',Auth::user()->id)
                  ->select('users.name','users.mobile','users.email','users.address','economic_centres.centre_name')
                  ->get();


        $pdf = PDF::loadView('backend.report.ereport.user_list', compact('users','ecenter'),[], 
        [ 
          'format' => 'A4-L',
          'orientation' => 'L'
        ]);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('Economic centre System user List Summary.pdf');
    }

    public function EcentreAppointment(Request $request)
    {   
        $validatedData = $request->validate([
            'date' => 'required'
        ],[
            'date.required' => 'You Must select valid date'
        ]);

        if ($request->date) {
            
            $mybookings  = DB::table('buyer_bookings')
                        ->Join('users','buyer_bookings.user_id','=','users.id')
                        ->Join('economic_centres','buyer_bookings.ecentre_id','=','economic_centres.id')
                        ->where('buyer_bookings.ecentre_id', Auth::user()->ecentre_id)
                        ->where('buyer_bookings.date',$request->date)
                        ->select('users.name','economic_centres.centre_name','buyer_bookings.date','buyer_bookings.created_at','buyer_bookings.status','users.email','users.image','users.mobile','buyer_bookings.id')
                        ->orderBy('date', 'desc')
                        ->get();

        $req_date = $request->date;

        $ecenter = DB::table('users')
                  ->Join('economic_centres','economic_centres.id','=','users.ecentre_id')
                  ->where('users.id',Auth::user()->id)
                  ->select('users.name','users.mobile','users.email','users.address','economic_centres.centre_name')
                  ->get();


        $pdf = PDF::loadView('backend.report.ereport.appointment', compact('ecenter','mybookings','req_date'),[], 
        [ 
          'format' => 'A4-L',
          'orientation' => 'L'
        ]);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('Appointment List Summary.pdf');
    }

  }
    public function EcentreCcentreList()
    {   
        $ccentres = DB::table('collection_centres')
                   ->Join('provices','collection_centres.province_id','=','provices.id')
                   ->Join('districts','collection_centres.district_id','=','districts.id')
                    ->Join('cities','collection_centres.city_id','=','cities.id')
                   ->where('collection_centres.economic_centre_id',Auth::user()->ecentre_id)
                   ->select('collection_centres.centre_name','provices.name_en AS pname','districts.name_en AS dname','cities.name_en AS cname')
                   ->get();
       //dd($ccentres);
        
        $ecenter = DB::table('users')
                  ->Join('economic_centres','economic_centres.id','=','users.ecentre_id')
                  ->where('users.id',Auth::user()->id)
                  ->select('users.name','users.mobile','users.email','users.address','economic_centres.centre_name')
                  ->get();

        $pdf = PDF::loadView('backend.report.ereport.ccentre_list', compact('ecenter','ccentres'),[], 
        [ 
          'format' => 'A4-L',
          'orientation' => 'L'
        ]);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('Transfer Product Sum Summary.pdf');
    }

}
