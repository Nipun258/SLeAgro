<?php

namespace App\Http\Controllers\Backend\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use PDF;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class BuyerReportController extends Controller
{
    public function __construct(){
      
      $this->middleware('auth');

    }

    public function BuyerReportView(){
          
       return view('backend.report.breport.index');
    }

    public function BuyerAppointment(Request $request)
    {   
        $validatedData = $request->validate([
            'month' => 'required'
        ],[
            'month.required' => 'You Must select valid month'
        ]);

        if ($request->month) {
            
        $mybookings  = DB::table('buyer_bookings')
                        ->Join('users','buyer_bookings.user_id','=','users.id')
                        ->Join('economic_centres','buyer_bookings.ecentre_id','=','economic_centres.id')
                        ->where('users.id', Auth::user()->id)
                        ->where('buyer_bookings.date','LIKE','%'.$request->month.'%')
                        ->select('economic_centres.centre_name','buyer_bookings.date','buyer_bookings.created_at','buyer_bookings.status','buyer_bookings.id')
                        ->orderBy('date', 'desc')
                        ->get();
        //dd($mybookings);
        $req_month = $request->month;

        $buyer = DB::table('users')
                  ->Join('economic_centres','economic_centres.id','=','users.ecentre_id')
                  ->where('users.id',Auth::user()->id)
                  ->select('users.name','users.mobile','users.email','users.address','economic_centres.centre_name')
                  ->get();


        $pdf = PDF::loadView('backend.report.breport.booking', compact('buyer','mybookings','req_month'),[], 
        [ 
          'format' => 'A4-L',
          'orientation' => 'L'
        ]);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('Booking List Summary.pdf');
    }

  }

  public function BuyerPaymentRegister(Request $request)
    {   
        $validatedData = $request->validate([
            'month' => 'required'
        ],[
            'month.required' => 'You Must select valid month'
        ]);

        if ($request->month) {

        $payments = DB::table('payments')
                        ->where('payments.from', Auth::user()->id)
                        ->where('payments.date','LIKE','%'.$request->month.'%')
                        ->where('payments.status', 4)
                        ->select('payments.date','payments.order_id','payments.invoice_id','payments.total_payment','payments.net_payment','payments.payment_type','payments.account_number','payments.from','payments.to')
                        ->orderBy('date', 'desc')
                        ->get();
        //dd($payments);
        $req_month = $request->month;

        $buyer = DB::table('users')
                  ->Join('economic_centres','economic_centres.id','=','users.ecentre_id')
                  ->where('users.id',Auth::user()->id)
                  ->select('users.name','users.mobile','users.email','users.address','economic_centres.centre_name')
                  ->get();

        $pdf = PDF::loadView('backend.report.breport.payment', compact('buyer','payments','req_month'),[], 
        [ 
          'format' => 'A4-L',
          'orientation' => 'L'
        ]);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('Buyer Payment Summary.pdf');
    }

  }
  public function BuyerInventoryDaily(Request $request)
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
                        ->Join('economic_centres','inventories.ecentre_id','=','economic_centres.id')
                        ->where('inventories.user_id', Auth::user()->id)
                        ->where('inventories.date',$request->date)
                        ->where('inventories.status',1)
                        ->select('users.name','economic_centres.centre_name','inventories.date','inventories.created_at','vegitables.name as vegname','inventories.quntity','inventories.price','inventories.status','inventories.order_id','inventories.invoice_id')
                        ->orderBy('inventories.created_at', 'desc')
                        ->get();

        $req_date = $request->date;

        $buyer = DB::table('users')
                  ->Join('economic_centres','economic_centres.id','=','users.ecentre_id')
                  ->where('users.id',Auth::user()->id)
                  ->select('users.name','users.mobile','users.email','users.address','economic_centres.centre_name')
                  ->get();


        $pdf = PDF::loadView('backend.report.breport.inventory_daily', compact('buyer','book_inventories','req_date'),[], 
        [ 
          'format' => 'A4-L',
          'orientation' => 'L'
        ]);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('Daily Inventory Summary.pdf');
    }

  }

  public function BuyerInventoryMonth(Request $request)
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
                        ->Join('economic_centres','inventories.ecentre_id','=','economic_centres.id')
                        ->where('inventories.user_id', Auth::user()->id)
                        ->where('inventories.date','LIKE','%'.$request->month.'%')
                        ->where('inventories.status',1)
                        ->select('users.name','economic_centres.centre_name','inventories.date','inventories.created_at','vegitables.name as vegname','inventories.quntity','inventories.price','inventories.status','inventories.order_id','inventories.invoice_id')
                        ->orderBy('inventories.created_at', 'desc')
                        ->get();

            //dd($trans_inventories);

        $req_month = $request->month;

        $buyer = DB::table('users')
                  ->Join('economic_centres','economic_centres.id','=','users.ecentre_id')
                  ->where('users.id',Auth::user()->id)
                  ->select('users.name','users.mobile','users.email','users.address','economic_centres.centre_name')
                  ->get();


        $pdf = PDF::loadView('backend.report.breport.inventory_monthly', compact('buyer','book_inventories','req_month'),[], 
        [ 
          'format' => 'A4-L',
          'orientation' => 'L'
        ]);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('Monthly Inventory Summary.pdf');
    }

  }

    public function BuyerPaymentSummary(Request $request)
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
                   ->where('inventories.status',1)
                   ->select('vegitables.name','vegitables.image',DB::raw('SUM(inventories.quntity) as total'),DB::raw('SUM(inventories.price)*1.01 as count'))
                   ->groupBy('inventories.veg_id','vegitables.name','vegitables.image')
                   ->get();

        $total_payments = DB::table('inventories')
                        ->where('inventories.user_id',Auth::user()->id)
                        ->where('inventories.date','LIKE','%'.$request->month.'%')
                        ->where('inventories.status',1)
                        ->select(DB::raw('SUM(inventories.price)*1.01 as count'))
                        ->groupBy('inventories.user_id')
                        ->get();
        $total_payments=json_decode($total_payments,true);
        $total_payments=$total_payments[0]["count"];

        //dd($total_payments);
        $req_month = $request->month;

        $buyer = DB::table('users')
                  ->Join('economic_centres','economic_centres.id','=','users.ecentre_id')
                  ->where('users.id',Auth::user()->id)
                  ->select('users.name','users.mobile','users.email','users.address','economic_centres.centre_name')
                  ->get();

        $pdf = PDF::loadView('backend.report.breport.payment_summary', compact('buyer','payments','req_month','total_payments'),[], 
        [ 
          'format' => 'A4-L',
          'orientation' => 'L'
        ]);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('Buyer Payment Summary.pdf');
    }

  }

}
