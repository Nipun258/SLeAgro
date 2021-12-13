<?php

namespace App\Http\Controllers\Backend\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use PDF;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class FarmerReportController extends Controller
{
    public function __construct(){
      
      $this->middleware('auth');

    }

    public function FarmerReportView(){
          
       return view('backend.report.freport.index');
    }

        public function FarmerAppointment(Request $request)
    {   
        $validatedData = $request->validate([
            'month' => 'required'
        ],[
            'month.required' => 'You Must select valid month'
        ]);

        if ($request->month) {
            
        $mybookings  = DB::table('bookings')
                        ->Join('users','bookings.user_id','=','users.id')
                        ->Join('collection_centres','bookings.ccentre_id','=','collection_centres.id')
                        ->where('users.id', Auth::user()->id)
                        ->where('bookings.date','LIKE','%'.$request->month.'%')
                        ->select('collection_centres.centre_name','bookings.date','bookings.time','bookings.created_at','bookings.status','bookings.id')
                        ->orderBy('date', 'desc')
                        ->get();
        //dd($mybookings);
        $req_month = $request->month;

        $farmer = DB::table('users')
                  ->Join('collection_centres','collection_centres.id','=','users.ccentre_id')
                  ->where('users.id',Auth::user()->id)
                  ->select('users.name','users.mobile','users.email','users.address','collection_centres.centre_name')
                  ->get();


        $pdf = PDF::loadView('backend.report.freport.booking_list', compact('farmer','mybookings','req_month'),[], 
        [ 
          'format' => 'A4-L',
          'orientation' => 'L'
        ]);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('Booking List Summary.pdf');
    }

  }

  public function FarmerPaymentRegister(Request $request)
    {   
        $validatedData = $request->validate([
            'month' => 'required'
        ],[
            'month.required' => 'You Must select valid month'
        ]);

        if ($request->month) {

        $payments = DB::table('payments')
                        ->where('payments.to', Auth::user()->id)
                        ->where('payments.date','LIKE','%'.$request->month.'%')
                        ->where('payments.status', 1)
                        ->select('payments.date','payments.order_id','payments.invoice_id','payments.total_payment','payments.net_payment','payments.payment_type','payments.account_number','payments.from','payments.to')
                        ->orderBy('date', 'desc')
                        ->get();
        //dd($payments);
        $req_month = $request->month;

        $farmer = DB::table('users')
                  ->Join('collection_centres','collection_centres.id','=','users.ccentre_id')
                  ->where('users.id',Auth::user()->id)
                  ->select('users.name','users.mobile','users.email','users.address','collection_centres.centre_name')
                  ->get();

        $pdf = PDF::loadView('backend.report.freport.payment', compact('farmer','payments','req_month'),[], 
        [ 
          'format' => 'A4-L',
          'orientation' => 'L'
        ]);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('Farmer Payment Summary.pdf');
    }

  }

  public function FarmerInventoryDaily(Request $request)
    {   
        $validatedData = $request->validate([
            'date' => 'required'
        ],[
            'date.required' => 'You Must select valid date'
        ]);

        if ($request->date) {
            
            $book_inventories  = DB::table('inventories')
                        ->Join('users','inventories.user_id','=','users.id')
                        ->join('vegitables','inventories.veg_id','=','vegitables.id')
                        ->Join('collection_centres','inventories.ccentre_id','=','collection_centres.id')
                        ->where('inventories.user_id', Auth::user()->id)
                        ->where('inventories.date',$request->date)
                        ->whereIn('inventories.status', [0,3])
                        ->select('users.name','collection_centres.centre_name','inventories.date','inventories.created_at','vegitables.name as vegname','inventories.quntity','inventories.price','inventories.status','inventories.order_id','inventories.invoice_id')
                        ->orderBy('inventories.created_at', 'desc')
                        ->get();

        $req_date = $request->date;

        $farmer = DB::table('users')
                  ->Join('collection_centres','collection_centres.id','=','users.ccentre_id')
                  ->where('users.id',Auth::user()->id)
                  ->select('users.name','users.mobile','users.email','users.address','collection_centres.centre_name')
                  ->get();


        $pdf = PDF::loadView('backend.report.freport.inventory_daily', compact('farmer','book_inventories','req_date'),[], 
        [ 
          'format' => 'A4-L',
          'orientation' => 'L'
        ]);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('Daily Inventory Summary.pdf');
    }

  }
public function FarmerInventoryMonth(Request $request)
    {   
        $validatedData = $request->validate([
            'month' => 'required'
        ],[
            'month.required' => 'You Must select valid month'
        ]);

        if ($request->month) {
            
            $book_inventories  = DB::table('inventories')
                        ->Join('users','inventories.user_id','=','users.id')
                        ->join('vegitables','inventories.veg_id','=','vegitables.id')
                        ->Join('collection_centres','inventories.ccentre_id','=','collection_centres.id')
                        ->where('inventories.user_id', Auth::user()->id)
                        ->where('inventories.date','LIKE','%'.$request->month.'%')
                        ->whereIn('inventories.status', [0,3])
                        ->select('users.name','collection_centres.centre_name','inventories.date','inventories.created_at','vegitables.name as vegname','inventories.quntity','inventories.price','inventories.status','inventories.order_id','inventories.invoice_id')
                        ->orderBy('inventories.created_at', 'desc')
                        ->get();

            //dd($trans_inventories);

        $req_month = $request->month;

        $farmer = DB::table('users')
                  ->Join('collection_centres','collection_centres.id','=','users.ccentre_id')
                  ->where('users.id',Auth::user()->id)
                  ->select('users.name','users.mobile','users.email','users.address','collection_centres.centre_name')
                  ->get();


        $pdf = PDF::loadView('backend.report.freport.inventory_monthly', compact('farmer','book_inventories','req_month'),[], 
        [ 
          'format' => 'A4-L',
          'orientation' => 'L'
        ]);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('Monthly Inventory Summary.pdf');
    }

  }

  public function FarmerPaymentSummary(Request $request)
    {   
        $validatedData = $request->validate([
            'month' => 'required'
        ],[
            'month.required' => 'You Must select valid month'
        ]);

        if ($request->month) {

        $payments = DB::table('inventories')
                   ->Join('vegitables','inventories.veg_id','=','vegitables.id')
                   ->where('inventories.user_id',Auth::user()->id)
                   ->where('inventories.date','LIKE','%'.$request->month.'%')
                   ->whereIn('inventories.status',[0,3])
                   ->select('vegitables.name','vegitables.image',DB::raw('SUM(inventories.quntity) as total'),DB::raw('SUM(inventories.price)*0.97 as count'))
                   ->groupBy('inventories.veg_id','vegitables.name','vegitables.image')
                   ->get();

        $total_payments = DB::table('inventories')
                        ->where('inventories.user_id',Auth::user()->id)
                        ->where('inventories.date','LIKE','%'.$request->month.'%')
                        ->whereIn('inventories.status',[0,3])
                        ->select(DB::raw('SUM(inventories.price)*0.97 as count'))
                        ->groupBy('inventories.user_id')
                        ->get();
        $total_payments=json_decode($total_payments,true);
        $total_payments=$total_payments[0]["count"];

        //dd($total_payments);
        $req_month = $request->month;

        $farmer = DB::table('users')
                  ->Join('collection_centres','collection_centres.id','=','users.ccentre_id')
                  ->where('users.id',Auth::user()->id)
                  ->select('users.name','users.mobile','users.email','users.address','collection_centres.centre_name')
                  ->get();

        $pdf = PDF::loadView('backend.report.freport.payment_summary', compact('farmer','payments','req_month','total_payments'),[], 
        [ 
          'format' => 'A4-L',
          'orientation' => 'L'
        ]);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('Farmer Payment Summary.pdf');
    }

  }

}
