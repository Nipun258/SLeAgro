<?php

namespace App\Http\Controllers\Backend\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use PDF;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CollectionCentreReportController extends Controller
{
    
    public function __construct(){
      
      $this->middleware('auth');

    }

    public function CcentreReportView(){
          
       return view('backend.report.creport.index');
    }

    public function CcentreFarmerList()
    {   
        $farmers = DB::table('users')
                   ->Join('farmers','users.id','=','farmers.user_id')
                   ->where('users.role', '=', 'Farmer')
                   ->where('users.ccentre_id',Auth::user()->ccentre_id)
                   ->get();

        $ccenter = DB::table('users')
                  ->Join('collection_centres','collection_centres.id','=','users.ccentre_id')
                  ->where('users.id',Auth::user()->id)
                  ->select('users.name','users.mobile','users.email','users.address','collection_centres.centre_name')
                  ->get();


        $pdf = PDF::loadView('backend.report.creport.farmer_list', compact('farmers','ccenter'),[], 
        [ 
          'format' => 'A4-L',
          'orientation' => 'L'
        ]);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('Farmer List Summary.pdf');
    }

    public function CcentreUserList()
    {   
        $users = DB::table('users')
                   ->where('users.usertype', '=', 'Admin')
                   ->where('users.ccentre_id',Auth::user()->ccentre_id)
                   ->get();

        $ccenter = DB::table('users')
                  ->Join('collection_centres','collection_centres.id','=','users.ccentre_id')
                  ->where('users.id',Auth::user()->id)
                  ->select('users.name','users.mobile','users.email','users.address','collection_centres.centre_name')
                  ->get();


        $pdf = PDF::loadView('backend.report.creport.user_list', compact('users','ccenter'),[], 
        [ 
          'format' => 'A4-L',
          'orientation' => 'L'
        ]);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('System user List Summary.pdf');
    }

    public function CcentreAppointment(Request $request)
    {   
        $validatedData = $request->validate([
            'date' => 'required'
        ],[
            'date.required' => 'You Must select valid date'
        ]);

        if ($request->date) {
            
            $mybookings  = DB::table('bookings')
                        ->Join('users','bookings.user_id','=','users.id')
                        ->Join('collection_centres','bookings.ccentre_id','=','collection_centres.id')
                        ->where('bookings.ccentre_id', Auth::user()->ccentre_id)
                        ->where('bookings.date',$request->date)
                        ->select('users.name','collection_centres.centre_name','bookings.date','bookings.time','bookings.created_at','bookings.status','users.email','users.image','users.mobile','bookings.id')
                        ->orderBy('date', 'desc')
                        ->get();

        $req_date = $request->date;

        $ccenter = DB::table('users')
                  ->Join('collection_centres','collection_centres.id','=','users.ccentre_id')
                  ->where('users.id',Auth::user()->id)
                  ->select('users.name','users.mobile','users.email','users.address','collection_centres.centre_name')
                  ->get();


        $pdf = PDF::loadView('backend.report.creport.appointment', compact('ccenter','mybookings','req_date'),[], 
        [ 
          'format' => 'A4-L',
          'orientation' => 'L'
        ]);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('Appointment List Summary.pdf');
    }

  }

  public function CcentreProductTransfer()
    {   
        $products = DB::table('inventories')
                   ->Join('vegitables','inventories.veg_id','=','vegitables.id')
                   ->where('inventories.ccentre_id',Auth::user()->ccentre_id)
                   ->where('inventories.date','LIKE','%'.Carbon::now()->format('Y-m').'%')
                   ->where('inventories.status',2)
                   ->select('vegitables.name','vegitables.image',DB::raw('SUM(inventories.quntity) as total'))
                   ->groupBy('inventories.veg_id','vegitables.name','vegitables.image')
                   ->get();

        $month = date('M Y');

        $ccenter = DB::table('users')
                  ->Join('collection_centres','collection_centres.id','=','users.ccentre_id')
                  ->where('users.id',Auth::user()->id)
                  ->select('users.name','users.mobile','users.email','users.address','collection_centres.centre_name')
                  ->get();

        $pdf = PDF::loadView('backend.report.creport.product_transfer', compact('ccenter','products','month'),[], 
        [ 
          'format' => 'A4-L',
          'orientation' => 'L'
        ]);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('Transfer Product Sum Summary.pdf');
    }


    public function CcentrePaymentRegister(Request $request)
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
                        ->where('payments.status', 1)
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

        $ccenter = DB::table('users')
                  ->Join('collection_centres','collection_centres.id','=','users.ccentre_id')
                  ->where('users.id',Auth::user()->id)
                  ->select('users.name','users.mobile','users.email','users.address','collection_centres.centre_name')
                  ->get();


        $pdf = PDF::loadView('backend.report.creport.payment_register', compact('ccenter','payments','req_month'),[], 
        [ 
          'format' => 'A4-L',
          'orientation' => 'L'
        ]);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('Register User Payment Summary.pdf');
    }

  }

      public function CcentrePaymentNormal(Request $request)
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
                        ->where('payments.status', 2)
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

        $ccenter = DB::table('users')
                  ->Join('collection_centres','collection_centres.id','=','users.ccentre_id')
                  ->where('users.id',Auth::user()->id)
                  ->select('users.name','users.mobile','users.email','users.address','collection_centres.centre_name')
                  ->get();


        $pdf = PDF::loadView('backend.report.creport.payment_normal', compact('ccenter','payments','req_month'),[], 
        [ 
          'format' => 'A4-L',
          'orientation' => 'L'
        ]);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('Normal User Payment Summary.pdf');
    }

  }

        public function CcentrePaymentTransfer(Request $request)
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
                        ->where('payments.status', 3)
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

        $ccenter = DB::table('users')
                  ->Join('collection_centres','collection_centres.id','=','users.ccentre_id')
                  ->where('users.id',Auth::user()->id)
                  ->select('users.name','users.mobile','users.email','users.address','collection_centres.centre_name')
                  ->get();


        $pdf = PDF::loadView('backend.report.creport.payment_transfer', compact('ccenter','payments','req_month'),[], 
        [ 
          'format' => 'A4-L',
          'orientation' => 'L'
        ]);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('Economic Centre Transfer Payment Summary.pdf');
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


        public function CcentreInventoryDaily(Request $request)
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
                        ->where('inventories.ccentre_id', Auth::user()->ccentre_id)
                        ->where('inventories.date',$request->date)
                        ->whereIn('inventories.status', [0,3])
                        ->select('users.name','collection_centres.centre_name','inventories.date','inventories.created_at','vegitables.name as vegname','inventories.quntity','inventories.price','inventories.status','inventories.order_id','inventories.invoice_id')
                        ->orderBy('inventories.created_at', 'desc')
                        ->get();

           $normal_inventories  = DB::table('inventories')
                        ->join('vegitables','inventories.veg_id','=','vegitables.id')
                        ->Join('collection_centres','inventories.ccentre_id','=','collection_centres.id')
                        ->where('inventories.ccentre_id', Auth::user()->ccentre_id)
                        ->where('inventories.date',$request->date)
                        ->where('inventories.user_id',0)
                        ->whereIn('inventories.status', [0,3])
                        ->select('collection_centres.centre_name','inventories.date','inventories.created_at','vegitables.name as vegname','inventories.quntity','inventories.price','inventories.status','inventories.order_id','inventories.invoice_id')
                        ->orderBy('inventories.created_at', 'desc')
                        ->get();
            

            $trans_inventories  = DB::table('inventories')
                        ->join('vegitables','inventories.veg_id','=','vegitables.id')
                        ->Join('collection_centres','inventories.ccentre_id','=','collection_centres.id')
                        ->where('inventories.ccentre_id', Auth::user()->ccentre_id)
                        ->where('inventories.date',$request->date)
                        ->where('inventories.status',2)
                        ->select('collection_centres.centre_name','inventories.date','inventories.created_at','vegitables.name as vegname','inventories.quntity','inventories.price','inventories.status','inventories.order_id','inventories.invoice_id')
                        ->orderBy('inventories.created_at', 'desc')
                        ->get();

        $req_date = $request->date;

        $ccenter = DB::table('users')
                  ->Join('collection_centres','collection_centres.id','=','users.ccentre_id')
                  ->where('users.id',Auth::user()->id)
                  ->select('users.name','users.mobile','users.email','users.address','collection_centres.centre_name')
                  ->get();


        $pdf = PDF::loadView('backend.report.creport.inventory_daily', compact('ccenter','book_inventories','normal_inventories','trans_inventories','req_date'),[], 
        [ 
          'format' => 'A4-L',
          'orientation' => 'L'
        ]);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('Daily Inventory Summary.pdf');
    }

  }

  public function CcentreInventoryMonth(Request $request)
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
                        ->where('inventories.ccentre_id', Auth::user()->ccentre_id)
                        ->where('inventories.date','LIKE','%'.$request->month.'%')
                        ->whereIn('inventories.status', [0,3])
                        ->select('users.name','collection_centres.centre_name','inventories.date','inventories.created_at','vegitables.name as vegname','inventories.quntity','inventories.price','inventories.status','inventories.order_id','inventories.invoice_id')
                        ->orderBy('inventories.created_at', 'desc')
                        ->get();

           $normal_inventories  = DB::table('inventories')
                        ->join('vegitables','inventories.veg_id','=','vegitables.id')
                        ->Join('collection_centres','inventories.ccentre_id','=','collection_centres.id')
                        ->where('inventories.ccentre_id', Auth::user()->ccentre_id)
                        ->where('inventories.date','LIKE','%'.$request->month.'%')
                        ->where('inventories.user_id',0)
                        ->whereIn('inventories.status', [0,3])
                        ->select('collection_centres.centre_name','inventories.date','inventories.created_at','vegitables.name as vegname','inventories.quntity','inventories.price','inventories.status','inventories.order_id','inventories.invoice_id')
                        ->orderBy('inventories.created_at', 'desc')
                        ->get();
            

            $trans_inventories  = DB::table('inventories')
                        ->join('vegitables','inventories.veg_id','=','vegitables.id')
                        ->Join('collection_centres','inventories.ccentre_id','=','collection_centres.id')
                        ->where('inventories.ccentre_id', Auth::user()->ccentre_id)
                        ->where('inventories.date','LIKE','%'.$request->month.'%')
                        ->where('inventories.status',2)
                        ->select('collection_centres.centre_name','inventories.date','inventories.created_at','vegitables.name as vegname','inventories.quntity','inventories.price','inventories.status','inventories.order_id','inventories.invoice_id')
                        ->orderBy('inventories.created_at', 'desc')
                        ->get();

            //dd($trans_inventories);

        $req_month = $request->month;

        $ccenter = DB::table('users')
                  ->Join('collection_centres','collection_centres.id','=','users.ccentre_id')
                  ->where('users.id',Auth::user()->id)
                  ->select('users.name','users.mobile','users.email','users.address','collection_centres.centre_name')
                  ->get();


        $pdf = PDF::loadView('backend.report.creport.inventory_monthly', compact('ccenter','book_inventories','normal_inventories','trans_inventories','req_month'),[], 
        [ 
          'format' => 'A4-L',
          'orientation' => 'L'
        ]);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('Monthly Inventory Summary.pdf');
    }

  }

}
