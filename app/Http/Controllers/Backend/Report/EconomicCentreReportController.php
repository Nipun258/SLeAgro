<?php

namespace App\Http\Controllers\Backend\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use PDF;
//use App\Models\CollectionCentre;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class EconomicCentreReportController extends Controller
{
    public function __construct(){
      
      $this->middleware('auth');

    }

    public function EcentreReportView(){

        $collection_centre = DB::table('collection_centres')
                            ->where('collection_centres.economic_centre_id',Auth::user()->ecentre_id)
                            ->select('collection_centres.id','collection_centres.centre_name')
                            ->get();

        return view('backend.report.ereport.index',compact('collection_centre'));
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

    public function EcentrePaymentRegister(Request $request)
    {   
        $validatedData = $request->validate([
            'month' => 'required'
        ],[
            'month.required' => 'You Must select valid month'
        ]);

        if ($request->month) {


        $regPayment=array();

        $payment_data = DB::table('payments')
                        ->where('payments.to', Auth::user()->id)
                        ->where('payments.date','LIKE','%'.$request->month.'%')
                        ->where('payments.status', 4)
                        ->select('payments.date','payments.order_id','payments.invoice_id','payments.total_payment','payments.net_payment','payments.payment_type','payments.account_number','payments.from','payments.to')
                        ->orderBy('date', 'desc')
                        ->get();

        foreach ($payment_data as $payment) {

            $ResId = $payment->to;
            $SenId = $payment->from;
            $reciverName =$this->PaymentReciver($ResId);
            $senderName =$this->PaymentSender($SenId);

            $regPayment[]=array(
                        'rname' => $reciverName, 
                        'date' =>$payment->date, 
                        'order_id' =>$payment->order_id, 
                        'invoice_id' =>$payment->invoice_id, 
                        'total_payment' =>$payment->total_payment,
                        'net_payment' =>$payment->net_payment,
                        'payment_type' =>$payment->payment_type,
                        'account_number' =>$payment->account_number,
                        'sname' => $senderName
                    );
            
         }

        $payments = json_encode($regPayment);

        $req_month = $request->month;

        $ecenter = DB::table('users')
                  ->Join('economic_centres','economic_centres.id','=','users.ecentre_id')
                  ->where('users.id',Auth::user()->id)
                  ->select('users.name','users.mobile','users.email','users.address','economic_centres.centre_name')
                  ->get();


        $pdf = PDF::loadView('backend.report.ereport.payment_register', compact('ecenter','payments','req_month'),[], 
        [ 
          'format' => 'A4-L',
          'orientation' => 'L'
        ]);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('Register Buyer Payment Summary.pdf');
    }

  }

  public function EcentrePaymentNormal(Request $request)
    {   
        $validatedData = $request->validate([
            'month' => 'required'
        ],[
            'month.required' => 'You Must select valid month'
        ]);

        if ($request->month) {


        $regPayment=array();

        $payment_data = DB::table('payments')
                        ->where('payments.to', Auth::user()->id)
                        ->where('payments.date','LIKE','%'.$request->month.'%')
                        ->where('payments.status', 5)
                        ->select('payments.date','payments.order_id','payments.invoice_id','payments.total_payment','payments.net_payment','payments.payment_type','payments.account_number','payments.from','payments.to')
                        ->orderBy('date', 'desc')
                        ->get();

        foreach ($payment_data as $payment) {

            $ResId = $payment->to;
            $SenId = $payment->from;
            $reciverName =$this->PaymentReciver($ResId);
            //$senderName =$this->PaymentSender($SenId);

            $regPayment[]=array(
                        //'rname' => $reciverName, 
                        'date' =>$payment->date, 
                        'order_id' =>$payment->order_id, 
                        'invoice_id' =>$payment->invoice_id, 
                        'total_payment' =>$payment->total_payment,
                        'net_payment' =>$payment->net_payment,
                        'payment_type' =>$payment->payment_type,
                        'account_number' =>$payment->account_number,
                        'rname' => $reciverName
                    );
            
         }

        $payments = json_encode($regPayment);

        $req_month = $request->month;

        $ecenter = DB::table('users')
                  ->Join('economic_centres','economic_centres.id','=','users.ecentre_id')
                  ->where('users.id',Auth::user()->id)
                  ->select('users.name','users.mobile','users.email','users.address','economic_centres.centre_name')
                  ->get();


        $pdf = PDF::loadView('backend.report.ereport.payment_normal', compact('ecenter','payments','req_month'),[], 
        [ 
          'format' => 'A4-L',
          'orientation' => 'L'
        ]);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('Normal Buyers Payment Summary.pdf');
    }

  }

  public function EcentrePaymentTransfer(Request $request)
    {   
        $validatedData = $request->validate([
            'month' => 'required'
        ],[
            'month.required' => 'You Must select valid month'
        ]);

        if ($request->month) {


        $regPayment=array();

        $payment_data = DB::table('payments')
                        ->where('payments.from', Auth::user()->id)
                        ->where('payments.date','LIKE','%'.$request->month.'%')
                        ->where('payments.status', 6)
                        ->select('payments.date','payments.order_id','payments.invoice_id','payments.total_payment','payments.net_payment','payments.payment_type','payments.account_number','payments.from','payments.to')
                        ->orderBy('date', 'desc')
                        ->get();

        foreach ($payment_data as $payment) {

            $ResId = $payment->to;
            $SenId = $payment->from;
            //$reciverName =$this->PaymentReciver($ResId);
            $senderName =$this->PaymentSender($SenId);

            $regPayment[]=array(
                        //'rname' => $reciverName, 
                        'date' =>$payment->date, 
                        'order_id' =>$payment->order_id, 
                        'invoice_id' =>$payment->invoice_id, 
                        'total_payment' =>$payment->total_payment,
                        'net_payment' =>$payment->net_payment,
                        'payment_type' =>$payment->payment_type,
                        'account_number' =>$payment->account_number,
                        'sname' => $senderName
                    );
            
         }

        $payments = json_encode($regPayment);

        $req_month = $request->month;

        $ecenter = DB::table('users')
                  ->Join('economic_centres','economic_centres.id','=','users.ecentre_id')
                  ->where('users.id',Auth::user()->id)
                  ->select('users.name','users.mobile','users.email','users.address','economic_centres.centre_name')
                  ->get();


        $pdf = PDF::loadView('backend.report.ereport.payment_transfer', compact('ecenter','payments','req_month'),[], 
        [ 
          'format' => 'A4-L',
          'orientation' => 'L'
        ]);

        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('Retial Distribution Transfer Payment Summary.pdf');
    }

  }

  public function PaymentReciver($ResId){
        
        
        $reciver_data = DB::table('users')
                        ->select('users.name as rname')
                        ->where('users.id','=',$ResId)
                        ->get();

            foreach ($reciver_data as  $reciver) 
            {

              $paymentReciver = $reciver->rname;
             
            }

        return $paymentReciver;
    }

    public function PaymentSender($SenId){
        
        
        $sender_data = DB::table('users')
                        ->select('users.name as sname')
                        ->where('users.id','=',$SenId)
                        ->get();

            foreach ($sender_data as  $sender) 
            {

              $paymentSender = $sender->sname;
             
            }

        return $paymentSender;
    }

    public function EcentreInventoryDaily(Request $request)
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
                        ->where('inventories.ecentre_id', Auth::user()->ecentre_id)
                        ->where('inventories.date',$request->date)
                        ->where('inventories.status',1)
                        ->select('users.name','economic_centres.centre_name','inventories.date','inventories.created_at','vegitables.name as vegname','inventories.quntity','inventories.price','inventories.status','inventories.order_id','inventories.invoice_id')
                        ->orderBy('inventories.created_at', 'desc')
                        ->get();

           $normal_inventories  = DB::table('inventories')
                        ->join('vegitables','inventories.veg_id','=','vegitables.id')
                        ->Join('economic_centres','inventories.ecentre_id','=','economic_centres.id')
                        ->where('inventories.ecentre_id', Auth::user()->ecentre_id)
                        ->where('inventories.date',$request->date)
                        ->where('inventories.user_id',0)
                        ->where('inventories.status',1)
                        ->select('economic_centres.centre_name','inventories.date','inventories.created_at','vegitables.name as vegname','inventories.quntity','inventories.price','inventories.status','inventories.order_id','inventories.invoice_id')
                        ->orderBy('inventories.created_at', 'desc')
                        ->get();
            

            $trans_inventories  = DB::table('inventories')
                        ->join('vegitables','inventories.veg_id','=','vegitables.id')
                        ->Join('economic_centres','inventories.ecentre_id','=','economic_centres.id')
                        ->where('inventories.ecentre_id', Auth::user()->ecentre_id)
                        ->where('inventories.date',$request->date)
                        ->where('inventories.status',4)
                        ->select('economic_centres.centre_name','inventories.date','inventories.created_at','vegitables.name as vegname','inventories.quntity','inventories.price','inventories.status','inventories.order_id','inventories.invoice_id')
                        ->orderBy('inventories.created_at', 'desc')
                        ->get();

        $req_date = $request->date;

        $ecenter = DB::table('users')
                  ->Join('economic_centres','economic_centres.id','=','users.ecentre_id')
                  ->where('users.id',Auth::user()->id)
                  ->select('users.name','users.mobile','users.email','users.address','economic_centres.centre_name')
                  ->get();


        $pdf = PDF::loadView('backend.report.ereport.inventory_daily', compact('ecenter','book_inventories','normal_inventories','trans_inventories','req_date'),[], 
        [ 
          'format' => 'A4-L',
          'orientation' => 'L'
        ]);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('Daily Inventory Summary.pdf');
    }

  }

  public function EcentreInventoryMonth(Request $request)
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
                        ->where('inventories.ecentre_id', Auth::user()->ecentre_id)
                        ->where('inventories.date','LIKE','%'.$request->month.'%')
                        ->where('inventories.status',1)
                        ->select('users.name','economic_centres.centre_name','inventories.date','inventories.created_at','vegitables.name as vegname','inventories.quntity','inventories.price','inventories.status','inventories.order_id','inventories.invoice_id')
                        ->orderBy('inventories.created_at', 'desc')
                        ->get();

           $normal_inventories  = DB::table('inventories')
                        ->join('vegitables','inventories.veg_id','=','vegitables.id')
                        ->Join('economic_centres','inventories.ecentre_id','=','economic_centres.id')
                        ->where('inventories.ecentre_id', Auth::user()->ecentre_id)
                        ->where('inventories.date','LIKE','%'.$request->month.'%')
                        ->where('inventories.user_id',0)
                        ->where('inventories.status',1)
                        ->select('economic_centres.centre_name','inventories.date','inventories.created_at','vegitables.name as vegname','inventories.quntity','inventories.price','inventories.status','inventories.order_id','inventories.invoice_id')
                        ->orderBy('inventories.created_at', 'desc')
                        ->get();
            

            $trans_inventories  = DB::table('inventories')
                        ->join('vegitables','inventories.veg_id','=','vegitables.id')
                        ->Join('economic_centres','inventories.ecentre_id','=','economic_centres.id')
                        ->where('inventories.ecentre_id', Auth::user()->ecentre_id)
                        ->where('inventories.date','LIKE','%'.$request->month.'%')
                        ->where('inventories.status',4)
                        ->select('economic_centres.centre_name','inventories.date','inventories.created_at','vegitables.name as vegname','inventories.quntity','inventories.price','inventories.status','inventories.order_id','inventories.invoice_id')
                        ->orderBy('inventories.created_at', 'desc')
                        ->get();

            //dd($trans_inventories);

        $req_month = $request->month;

        $ecenter = DB::table('users')
                  ->Join('economic_centres','economic_centres.id','=','users.ecentre_id')
                  ->where('users.id',Auth::user()->id)
                  ->select('users.name','users.mobile','users.email','users.address','economic_centres.centre_name')
                  ->get();


        $pdf = PDF::loadView('backend.report.ereport.inventory_monthly', compact('ecenter','book_inventories','normal_inventories','trans_inventories','req_month'),[], 
        [ 
          'format' => 'A4-L',
          'orientation' => 'L'
        ]);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('Monthly Inventory Summary.pdf');
    }

  }

    public function EcentreCcentreStockCheck(Request $request)
    {   
        $validatedData = $request->validate([
            'month' => 'required',
            'ccentre' => 'required'
        ],[
            'month.required' => 'You Must select valid month'
        ]);

        if ($request->month && $request->ccentre) {
            
            $current_stock  = DB::table('inventories')
                             ->Join('vegitables','inventories.veg_id','=','vegitables.id')
                             ->where('inventories.ecentre_id',Auth::user()->ecentre_id)
                             ->where('inventories.ccentre_id',$request->ccentre)
                             ->where('inventories.status',0)
                             ->select('vegitables.name','vegitables.image',DB::raw('SUM(inventories.quntity) as total'))
                             ->groupBy('inventories.veg_id','vegitables.name','vegitables.image')
                             ->get();

            //dd($current_stock);

        $req_month = $request->month;
        $req_centre = DB::table('collection_centres')
                      ->where('collection_centres.id',$request->ccentre)
                      ->select('collection_centres.centre_name')
                      ->get();
       $req_centre=json_decode($req_centre,true);
       $req_centre=$req_centre[0]["centre_name"];

        $ecenter = DB::table('users')
                  ->Join('economic_centres','economic_centres.id','=','users.ecentre_id')
                  ->where('users.id',Auth::user()->id)
                  ->select('users.name','users.mobile','users.email','users.address','economic_centres.centre_name')
                  ->get();


        $pdf = PDF::loadView('backend.report.ereport.ccentre_stock_check', compact('ecenter','current_stock','req_month','req_centre'),[], 
        [ 
          'format' => 'A4-L',
          'orientation' => 'L'
        ]);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('Collection Centre Inventory Summary.pdf');
    }

  }

  public function EcentrePaymentSummaryRegister(Request $request)
    {   
        $validatedData = $request->validate([
            'month' => 'required'
        ],[
            'month.required' => 'You Must select valid month'
        ]);

        if ($request->month) {

        $payments = DB::table('inventories')
                   ->Join('vegitables','inventories.veg_id','=','vegitables.id')
                   ->where('inventories.ecentre_id',Auth::user()->ecentre_id)
                   ->where('inventories.date','LIKE','%'.$request->month.'%')
                   ->where('inventories.user_id','!=',0)
                   ->where('inventories.status',1)
                   ->select('vegitables.name','vegitables.image',DB::raw('SUM(inventories.quntity) as total'),DB::raw('SUM(inventories.price)*1.01 as count'))
                   ->groupBy('inventories.veg_id','vegitables.name','vegitables.image')
                   ->get();

        $payment_buyers = DB::table('inventories')
                        ->Join('users','users.id','=','inventories.user_id')
                        ->where('inventories.ecentre_id',Auth::user()->ecentre_id)
                        ->where('inventories.date','LIKE','%'.$request->month.'%')
                        ->where('inventories.user_id','!=',0)
                        ->where('inventories.status',1)
                        ->select('inventories.user_id',DB::raw('SUM(inventories.price)*1.01 as pay'),'users.name')
                        ->groupBy('inventories.user_id','users.name')
                        ->get();

        $total_payments = DB::table('inventories')
                        ->where('inventories.ecentre_id',Auth::user()->ecentre_id)
                        ->where('inventories.date','LIKE','%'.$request->month.'%')
                        ->where('inventories.user_id','!=',0)
                        ->where('inventories.status',1)
                        ->select(DB::raw('SUM(inventories.price)*1.01 as pay'))
                        ->get();

        $total_payments=json_decode($total_payments,true);
        $total_payments=$total_payments[0]["pay"];

        //dd($total_payments);
        $req_month = $request->month;

        $ecenter = DB::table('users')
                  ->Join('economic_centres','economic_centres.id','=','users.ecentre_id')
                  ->where('users.id',Auth::user()->id)
                  ->select('users.name','users.mobile','users.email','users.address','economic_centres.centre_name')
                  ->get();

        $pdf = PDF::loadView('backend.report.ereport.payment_summary_register', compact('ecenter','payments','req_month','total_payments','payment_buyers'),[], 
        [ 
          'format' => 'A4-L',
          'orientation' => 'L'
        ]);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('Economic Centre Register Payment Summary.pdf');
    }

  }

  public function EcentrePaymentSummaryNormal(Request $request)
    {   
        $validatedData = $request->validate([
            'month' => 'required'
        ],[
            'month.required' => 'You Must select valid month'
        ]);

        if ($request->month) {

        $payments = DB::table('inventories')
                   ->Join('vegitables','inventories.veg_id','=','vegitables.id')
                   ->where('inventories.ecentre_id',Auth::user()->ecentre_id)
                   ->where('inventories.date','LIKE','%'.$request->month.'%')
                   ->where('inventories.user_id','=',0)
                   ->where('inventories.status',1)
                   ->select('vegitables.name','vegitables.image',DB::raw('SUM(inventories.quntity) as total'),DB::raw('SUM(inventories.price)*0.95 as count'))
                   ->groupBy('inventories.veg_id','vegitables.name','vegitables.image')
                   ->get();

        $total_payments = DB::table('inventories')
                        ->where('inventories.ecentre_id',Auth::user()->ecentre_id)
                        ->where('inventories.date','LIKE','%'.$request->month.'%')
                        ->where('inventories.user_id','=',0)
                        ->where('inventories.status',1)
                        ->select(DB::raw('SUM(inventories.price)*1.05 as pay'))
                        ->get();

        $total_payments=json_decode($total_payments,true);
        $total_payments=$total_payments[0]["pay"];

        //dd($payments);
        $req_month = $request->month;

        $ecenter = DB::table('users')
                  ->Join('economic_centres','economic_centres.id','=','users.ecentre_id')
                  ->where('users.id',Auth::user()->id)
                  ->select('users.name','users.mobile','users.email','users.address','economic_centres.centre_name')
                  ->get();

        $pdf = PDF::loadView('backend.report.ereport.payment_summary_normal', compact('ecenter','payments','req_month','total_payments'),[], 
        [ 
          'format' => 'A4-L',
          'orientation' => 'L'
        ]);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('Economic Centre NormaL Payment Summary.pdf');
    }

  }

  public function EcentrePaymentSummaryTransfer(Request $request)
    {   
        $validatedData = $request->validate([
            'month' => 'required'
        ],[
            'month.required' => 'You Must select valid month'
        ]);

        if ($request->month) {

        $payments = DB::table('inventories')
                   ->Join('vegitables','inventories.veg_id','=','vegitables.id')
                   ->where('inventories.ecentre_id',Auth::user()->ecentre_id)
                   ->where('inventories.date','LIKE','%'.$request->month.'%')
                   ->where('inventories.status',4)
                   ->select('vegitables.name','vegitables.image',DB::raw('SUM(inventories.quntity) as total'),DB::raw('SUM(inventories.price) as count'))
                   ->groupBy('inventories.veg_id','vegitables.name','vegitables.image')
                   ->get();

        $total_payments = DB::table('inventories')
                        ->where('inventories.ecentre_id',Auth::user()->ecentre_id)
                        ->where('inventories.date','LIKE','%'.$request->month.'%')
                        ->where('inventories.status',4)
                        ->select(DB::raw('SUM(inventories.price) as pay'))
                        ->get();

        $total_payments=json_decode($total_payments,true);
        $total_payments=$total_payments[0]["pay"];

        //dd($payments);
        $req_month = $request->month;

        $ecenter = DB::table('users')
                  ->Join('economic_centres','economic_centres.id','=','users.ecentre_id')
                  ->where('users.id',Auth::user()->id)
                  ->select('users.name','users.mobile','users.email','users.address','economic_centres.centre_name')
                  ->get();

        $pdf = PDF::loadView('backend.report.ereport.payment_summary_transfer', compact('ecenter','payments','req_month','total_payments'),[], 
        [ 
          'format' => 'A4-L',
          'orientation' => 'L'
        ]);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('Economic Centre Transfer Payment Summary.pdf');
    }

  }

}
