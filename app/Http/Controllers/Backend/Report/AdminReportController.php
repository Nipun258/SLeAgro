<?php

namespace App\Http\Controllers\Backend\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use PDF;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AdminReportController extends Controller
{
    public function __construct(){
      
      $this->middleware('auth');

    }

    public function AdminAdministrativeReportView(){

       $economic_centres = DB::table('economic_centres')
                            ->select('economic_centres.id','economic_centres.centre_name')
                            ->get();

        return view('backend.report.areport.index',compact('economic_centres'));
    }

    public function AdminUserList()
    {   
        $ecentre_users = DB::table('users')
                   //->Join('collection_centres','collection_centres.id','=','users.ccentre_id')
                   ->Join('economic_centres','economic_centres.id','=','users.ecentre_id')
                   ->where('users.usertype', '=', 'Admin')
                   ->where('users.role','=','EC-Officer')
                   ->select('users.name','users.email','users.mobile','users.address','economic_centres.centre_name as ename')
                   ->get();

        $ccentre_users = DB::table('users')
                   ->Join('collection_centres','collection_centres.id','=','users.ccentre_id')
                   ->Join('economic_centres','economic_centres.id','=','users.ecentre_id')
                   ->where('users.usertype', '=', 'Admin')
                   ->where('users.role','=','RC-Officer')
                   ->select('users.name','users.email','users.mobile','users.address','economic_centres.centre_name as ename','collection_centres.centre_name as cname')
                   ->get();

        $ccentre_fd_users = DB::table('users')
                   ->Join('collection_centres','collection_centres.id','=','users.ccentre_id')
                   ->Join('economic_centres','economic_centres.id','=','users.ecentre_id')
                   ->where('users.usertype', '=', 'Admin')
                   ->where('users.role','=','FD-Officer')
                   ->select('users.name','users.email','users.mobile','users.address','economic_centres.centre_name as ename','collection_centres.centre_name as cname')
                   ->get();

        //dd($ccentre_fd_users);

        $admin = DB::table('users')
                  ->where('users.id',Auth::user()->id)
                  ->select('users.name','users.mobile','users.email','users.address')
                  ->get();


        $pdf = PDF::loadView('backend.report.areport.user_list', compact('ecentre_users','ccentre_users','ccentre_fd_users','admin'),[], 
        [ 
          'format' => 'A4-L',
          'orientation' => 'L'
        ]);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('Admin System user List Summary.pdf');
    }
    public function AdminCentreList()
    {   
        
        $ecentres = DB::table('economic_centres')
                   ->Join('provices','economic_centres.province_id','=','provices.id')
                   ->Join('districts','economic_centres.district_id','=','districts.id')
                    ->Join('cities','economic_centres.city_id','=','cities.id')
                   //->where('collection_centres.economic_centre_id',Auth::user()->ecentre_id)
                   ->select('economic_centres.centre_name','provices.name_en AS pname','districts.name_en AS dname','cities.name_en AS cname')
                   ->get();

        $ccentres = DB::table('collection_centres')
                   ->Join('provices','collection_centres.province_id','=','provices.id')
                   ->Join('districts','collection_centres.district_id','=','districts.id')
                    ->Join('cities','collection_centres.city_id','=','cities.id')
                   //->where('collection_centres.economic_centre_id',Auth::user()->ecentre_id)
                   ->select('collection_centres.centre_name','provices.name_en AS pname','districts.name_en AS dname','cities.name_en AS cname')
                   ->get();
       //dd($ecentres);
        
        $admin = DB::table('users')
                  ->where('users.id',Auth::user()->id)
                  ->select('users.name','users.mobile','users.email','users.address')
                  ->get();

        $pdf = PDF::loadView('backend.report.areport.centre_list', compact('admin','ccentres','ecentres'),[], 
        [ 
          'format' => 'A4-L',
          'orientation' => 'L'
        ]);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('Centre Detils Summary.pdf');
    }

        public function AdminVegList()
    {   
        
        $vegetables = DB::table('vegitables')
                   ->get();

       //dd($vegetables);
        
        $admin = DB::table('users')
                  ->where('users.id',Auth::user()->id)
                  ->select('users.name','users.mobile','users.email','users.address')
                  ->get();

        $pdf = PDF::loadView('backend.report.areport.vegetable_list', compact('admin','vegetables'),[], 
        [ 
          'format' => 'A4-L',
          'orientation' => 'L'
        ]);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('vegetables List Detils.pdf');
    }

        public function AdminVegPrice(Request $request)
    {   
        
         $validatedData = $request->validate([
            'date' => 'required'
        ],[
            'date.required' => 'You Must select valid date'
        ]);

        if ($request->date) {
            
            $veg_prices  = DB::table('old_veg_prices')
                           ->Join('vegitables','vegitables.id','=','old_veg_prices.veg_id')
                           ->where('old_veg_prices.price_date',$request->date)
                           ->select('vegitables.name','old_veg_prices.price_wholesale','old_veg_prices.price_retial')
                           ->orderBy('old_veg_prices.price_date','DESC')
                           ->get();
            //dd($veg_prices);

        $req_date = $request->date;

        $admin = DB::table('users')
                  ->where('users.id',Auth::user()->id)
                  ->select('users.name','users.mobile','users.email','users.address')
                  ->get();


        $pdf = PDF::loadView('backend.report.areport.vegetable_price', compact('admin','veg_prices','req_date'),[], 
        [ 
          'format' => 'A4-L',
          'orientation' => 'L'
        ]);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('Vegetable Price Check.pdf');
    }

   }

    public function AdminEcentreSummaryDay(Request $request)
    {   
        
         $validatedData = $request->validate([
            'ecentre' => 'required',
            'date' => 'required'
        ],[
            'date.required' => 'You Must select Relavent Date',
            'ecentre.ecentre' => 'You Must select Relevent Ecomonic Centre'
        ]);

         //dd($request->date);

        if ($request->ecentre && $request->date) {
            
            $ecentre_register_income = DB::table('inventories')
                        ->where('inventories.ecentre_id',$request->ecentre)
                        ->where('inventories.date','LIKE','%'.$request->date.'%')
                        ->where('inventories.user_id','!=',0)
                        ->where('inventories.status',1)
                        ->select(DB::raw('SUM(inventories.price)*1.01 as pay'))
                        ->get();
    $ecentre_register_income=json_decode($ecentre_register_income,true);
    $ecentre_register_income=$ecentre_register_income[0]["pay"]; 

    //dd($ecentre_register_income);

    $ecentre_normal_income = DB::table('inventories')
                        ->where('inventories.ecentre_id',$request->ecentre)
                        ->where('inventories.date','LIKE','%'.$request->date.'%')
                        ->where('inventories.user_id','=',0)
                        ->where('inventories.status',1)
                        ->select(DB::raw('SUM(inventories.price)*1.05 as pay'))
                        ->get();
    $ecentre_normal_income=json_decode($ecentre_normal_income,true);
    $ecentre_normal_income=$ecentre_normal_income[0]["pay"];


    $ecentre_transfer_payment = DB::table('inventories')
                        ->where('inventories.ecentre_id',$request->ecentre)
                        ->where('inventories.date','LIKE','%'.$request->date.'%')
                        ->where('inventories.status',4)
                        ->select(DB::raw('SUM(inventories.price) as pay'))
                        ->get();
    $ecentre_transfer_payment=json_decode($ecentre_transfer_payment,true);
    $ecentre_transfer_payment=$ecentre_transfer_payment[0]["pay"];


    $ecentre_income = $ecentre_register_income + $ecentre_normal_income + $ecentre_transfer_payment;

       $payment_registers = DB::table('inventories')
                   ->Join('vegitables','inventories.veg_id','=','vegitables.id')
                   ->where('inventories.ecentre_id',$request->ecentre)
                   ->where('inventories.date','LIKE','%'.$request->date.'%')
                   ->where('inventories.user_id','!=',0)
                   ->where('inventories.status',1)
                   ->select('vegitables.name','vegitables.image',DB::raw('SUM(inventories.quntity) as total'),DB::raw('SUM(inventories.price)*1.01 as count'))
                   ->groupBy('inventories.veg_id','vegitables.name','vegitables.image')
                   ->get();

        $payment_normals = DB::table('inventories')
                   ->Join('vegitables','inventories.veg_id','=','vegitables.id')
                   ->where('inventories.ecentre_id',$request->ecentre)
                   ->where('inventories.date','LIKE','%'.$request->date.'%')
                   ->where('inventories.user_id','=',0)
                   ->where('inventories.status',1)
                   ->select('vegitables.name','vegitables.image',DB::raw('SUM(inventories.quntity) as total'),DB::raw('SUM(inventories.price)*1.05 as count'))
                   ->groupBy('inventories.veg_id','vegitables.name','vegitables.image')
                   ->get();

        $payment_transfers = DB::table('inventories')
                   ->Join('vegitables','inventories.veg_id','=','vegitables.id')
                   ->where('inventories.ecentre_id',$request->ecentre)
                   ->where('inventories.date','LIKE','%'.$request->date.'%')
                   ->where('inventories.status',4)
                   ->select('vegitables.name','vegitables.image',DB::raw('SUM(inventories.quntity) as total'),DB::raw('SUM(inventories.price) as count'))
                   ->groupBy('inventories.veg_id','vegitables.name','vegitables.image')
                   ->get();

        $req_date = $request->date;
        
        $ecentre = DB::table('economic_centres')
                   ->where('economic_centres.id',$request->ecentre)
                   ->select('economic_centres.centre_name')
                   ->get();

        $ecentre=json_decode($ecentre,true);
        $ecentre=$ecentre[0]["centre_name"];

        $admin = DB::table('users')
                  ->where('users.id',Auth::user()->id)
                  ->select('users.name','users.mobile','users.email','users.address')
                  ->get();

        $pdf = PDF::loadView('backend.report.areport.ecentre_daily', compact('admin','ecentre','req_date','ecentre_income','payment_registers','payment_normals','payment_transfers'),[], 
        [ 
          'format' => 'A4-L',
          'orientation' => 'L'
        ]);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('Economic Centre Daily Summary Report.pdf');
    }

   }

    public function AdminCcentreSummaryDay(Request $request)
    {   
        
         $validatedData = $request->validate([
            'ccentre' => 'required',
            'date' => 'required'
        ],[
            'date.required' => 'You Must select Relavent Date',
            'ccentre.required' => 'You Must select Relavent Collection Centre'
        ]);

         //dd($request->date);

        if ($request->ccentre && $request->date) {
            
            $ccentre_register_payment = DB::table('inventories')
                        ->where('inventories.ccentre_id',$request->ccentre)
                        ->where('inventories.date','LIKE','%'.$request->date.'%')
                        ->where('inventories.user_id','!=',0)
                        ->whereIn('inventories.status',[0,3])
                        ->select(DB::raw('SUM(inventories.price)*0.97 as pay'))
                        ->get();
    $ccentre_register_payment=json_decode($ccentre_register_payment,true);
    $ccentre_register_payment=$ccentre_register_payment[0]["pay"]; 



    $ccentre_normal_payment = DB::table('inventories')
                        ->where('inventories.ccentre_id',$request->ccentre)
                        ->where('inventories.date','LIKE','%'.$request->date.'%')
                        ->where('inventories.user_id','=',0)
                        ->whereIn('inventories.status',[0,3])
                        ->select(DB::raw('SUM(inventories.price)*0.95 as pay'))
                        ->get();
    $ccentre_normal_payment=json_decode($ccentre_normal_payment,true);
    $ccentre_normal_payment=$ccentre_normal_payment[0]["pay"];



    $ccentre_transfer_payment = DB::table('inventories')
                        ->where('inventories.ccentre_id',$request->ccentre)
                        ->where('inventories.date','LIKE','%'.$request->date.'%')
                        ->where('inventories.status',2)
                        ->select(DB::raw('SUM(inventories.price) as pay'))
                        ->get();
    $ccentre_transfer_payment=json_decode($ccentre_transfer_payment,true);
    $ccentre_transfer_payment=$ccentre_transfer_payment[0]["pay"];

    $ccentre_payment = $ccentre_register_payment + $ccentre_normal_payment;

    $ccentre_profit = $ccentre_transfer_payment - $ccentre_payment;

       $payment_registers = DB::table('inventories')
                   ->Join('vegitables','inventories.veg_id','=','vegitables.id')
                   ->where('inventories.ccentre_id',$request->ccentre)
                   ->where('inventories.date','LIKE','%'.$request->date.'%')
                   ->where('inventories.user_id','!=',0)
                   ->whereIn('inventories.status',[0,3])
                   ->select('vegitables.name','vegitables.image',DB::raw('SUM(inventories.quntity) as total'),DB::raw('SUM(inventories.price)*0.97 as count'))
                   ->groupBy('inventories.veg_id','vegitables.name','vegitables.image')
                   ->get();

        $payment_normals = DB::table('inventories')
                   ->Join('vegitables','inventories.veg_id','=','vegitables.id')
                   ->where('inventories.ccentre_id',$request->ccentre)
                   ->where('inventories.date','LIKE','%'.$request->date.'%')
                   ->where('inventories.user_id','=',0)
                   ->whereIn('inventories.status',[0,3])
                   ->select('vegitables.name','vegitables.image',DB::raw('SUM(inventories.quntity) as total'),DB::raw('SUM(inventories.price)*0.95 as count'))
                   ->groupBy('inventories.veg_id','vegitables.name','vegitables.image')
                   ->get();

        $payment_transfers = DB::table('inventories')
                   ->Join('vegitables','inventories.veg_id','=','vegitables.id')
                   ->where('inventories.ccentre_id',$request->ccentre)
                   ->where('inventories.date','LIKE','%'.$request->date.'%')
                   ->where('inventories.status',2)
                   ->select('vegitables.name','vegitables.image',DB::raw('SUM(inventories.quntity) as total'),DB::raw('SUM(inventories.price) as count'))
                   ->groupBy('inventories.veg_id','vegitables.name','vegitables.image')
                   ->get();

        $req_date = $request->date;
        
        $ccentre = DB::table('collection_centres')
                   ->where('collection_centres.id',$request->ecentre)
                   ->select('collection_centres.centre_name')
                   ->get();

        $ccentre=json_decode($ccentre,true);
        $ccentre=$ccentre[0]["centre_name"];

        $admin = DB::table('users')
                  ->where('users.id',Auth::user()->id)
                  ->select('users.name','users.mobile','users.email','users.address')
                  ->get();

        $pdf = PDF::loadView('backend.report.areport.ccentre_daily', compact('admin','ccentre','req_date','ccentre_payment','ccentre_transfer_payment','ccentre_profit','payment_registers','payment_normals','payment_transfers'),[], 
        [ 
          'format' => 'A4-L',
          'orientation' => 'L'
        ]);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('Collection Centre Daily Summary Report.pdf');
    }

   }

   public function AdminEcentreSummaryMonth(Request $request)
    {   
        
         $validatedData = $request->validate([
            'ecentre' => 'required',
            'month' => 'required'
        ],[
            'month.required' => 'You Must select Relavent Month',
            'ecentre.ecentre' => 'You Must select Relevent Ecomonic Centre'
        ]);

         //dd($request->date);

        if ($request->ecentre && $request->month) {
            
            $ecentre_register_income = DB::table('inventories')
                        ->where('inventories.ecentre_id',$request->ecentre)
                        ->where('inventories.date','LIKE','%'.$request->month.'%')
                        ->where('inventories.user_id','!=',0)
                        ->where('inventories.status',1)
                        ->select(DB::raw('SUM(inventories.price)*1.01 as pay'))
                        ->get();
    $ecentre_register_income=json_decode($ecentre_register_income,true);
    $ecentre_register_income=$ecentre_register_income[0]["pay"]; 

    //dd($ecentre_register_income);

    $ecentre_normal_income = DB::table('inventories')
                        ->where('inventories.ecentre_id',$request->ecentre)
                        ->where('inventories.date','LIKE','%'.$request->month.'%')
                        ->where('inventories.user_id','=',0)
                        ->where('inventories.status',1)
                        ->select(DB::raw('SUM(inventories.price)*1.05 as pay'))
                        ->get();
    $ecentre_normal_income=json_decode($ecentre_normal_income,true);
    $ecentre_normal_income=$ecentre_normal_income[0]["pay"];


    $ecentre_transfer_payment = DB::table('inventories')
                        ->where('inventories.ecentre_id',$request->ecentre)
                        ->where('inventories.date','LIKE','%'.$request->month.'%')
                        ->where('inventories.status',4)
                        ->select(DB::raw('SUM(inventories.price) as pay'))
                        ->get();
    $ecentre_transfer_payment=json_decode($ecentre_transfer_payment,true);
    $ecentre_transfer_payment=$ecentre_transfer_payment[0]["pay"];


    $ecentre_income = $ecentre_register_income + $ecentre_normal_income + $ecentre_transfer_payment;

       $payment_registers = DB::table('inventories')
                   ->Join('vegitables','inventories.veg_id','=','vegitables.id')
                   ->where('inventories.ecentre_id',$request->ecentre)
                   ->where('inventories.date','LIKE','%'.$request->month.'%')
                   ->where('inventories.user_id','!=',0)
                   ->where('inventories.status',1)
                   ->select('vegitables.name','vegitables.image',DB::raw('SUM(inventories.quntity) as total'),DB::raw('SUM(inventories.price)*1.01 as count'))
                   ->groupBy('inventories.veg_id','vegitables.name','vegitables.image')
                   ->get();

        $payment_normals = DB::table('inventories')
                   ->Join('vegitables','inventories.veg_id','=','vegitables.id')
                   ->where('inventories.ecentre_id',$request->ecentre)
                   ->where('inventories.date','LIKE','%'.$request->month.'%')
                   ->where('inventories.user_id','=',0)
                   ->where('inventories.status',1)
                   ->select('vegitables.name','vegitables.image',DB::raw('SUM(inventories.quntity) as total'),DB::raw('SUM(inventories.price)*1.05 as count'))
                   ->groupBy('inventories.veg_id','vegitables.name','vegitables.image')
                   ->get();

        $payment_transfers = DB::table('inventories')
                   ->Join('vegitables','inventories.veg_id','=','vegitables.id')
                   ->where('inventories.ecentre_id',$request->ecentre)
                   ->where('inventories.date','LIKE','%'.$request->month.'%')
                   ->where('inventories.status',4)
                   ->select('vegitables.name','vegitables.image',DB::raw('SUM(inventories.quntity) as total'),DB::raw('SUM(inventories.price) as count'))
                   ->groupBy('inventories.veg_id','vegitables.name','vegitables.image')
                   ->get();

        $req_month = $request->month;
        
        $ecentre = DB::table('economic_centres')
                   ->where('economic_centres.id',$request->ecentre)
                   ->select('economic_centres.centre_name')
                   ->get();

        $ecentre=json_decode($ecentre,true);
        $ecentre=$ecentre[0]["centre_name"];

        $admin = DB::table('users')
                  ->where('users.id',Auth::user()->id)
                  ->select('users.name','users.mobile','users.email','users.address')
                  ->get();

        $pdf = PDF::loadView('backend.report.areport.ecentre_monthly', compact('admin','ecentre','req_month','ecentre_income','payment_registers','payment_normals','payment_transfers'),[], 
        [ 
          'format' => 'A4-L',
          'orientation' => 'L'
        ]);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('Economic Centre Monthly Summary Report.pdf');
    }

   }

    public function AdminCcentreSummaryMonth(Request $request)
    {   
        
         $validatedData = $request->validate([
            'ccentre' => 'required',
            'month' => 'required'
        ],[
            'month.required' => 'You Must select Relavent Month',
            'ccentre.required' => 'You Must select Relavent Collection Centre'
        ]);

         //dd($request->date);

        if ($request->ccentre && $request->month) {
            
            $ccentre_register_payment = DB::table('inventories')
                        ->where('inventories.ccentre_id',$request->ccentre)
                        ->where('inventories.date','LIKE','%'.$request->month.'%')
                        ->where('inventories.user_id','!=',0)
                        ->whereIn('inventories.status',[0,3])
                        ->select(DB::raw('SUM(inventories.price)*0.97 as pay'))
                        ->get();
    $ccentre_register_payment=json_decode($ccentre_register_payment,true);
    $ccentre_register_payment=$ccentre_register_payment[0]["pay"]; 



    $ccentre_normal_payment = DB::table('inventories')
                        ->where('inventories.ccentre_id',$request->ccentre)
                        ->where('inventories.date','LIKE','%'.$request->month.'%')
                        ->where('inventories.user_id','=',0)
                        ->whereIn('inventories.status',[0,3])
                        ->select(DB::raw('SUM(inventories.price)*0.95 as pay'))
                        ->get();
    $ccentre_normal_payment=json_decode($ccentre_normal_payment,true);
    $ccentre_normal_payment=$ccentre_normal_payment[0]["pay"];



    $ccentre_transfer_payment = DB::table('inventories')
                        ->where('inventories.ccentre_id',$request->ccentre)
                        ->where('inventories.date','LIKE','%'.$request->month.'%')
                        ->where('inventories.status',2)
                        ->select(DB::raw('SUM(inventories.price) as pay'))
                        ->get();
    $ccentre_transfer_payment=json_decode($ccentre_transfer_payment,true);
    $ccentre_transfer_payment=$ccentre_transfer_payment[0]["pay"];

    $ccentre_payment = $ccentre_register_payment + $ccentre_normal_payment;

    $ccentre_profit = $ccentre_transfer_payment - $ccentre_payment;

       $payment_registers = DB::table('inventories')
                   ->Join('vegitables','inventories.veg_id','=','vegitables.id')
                   ->where('inventories.ccentre_id',$request->ccentre)
                   ->where('inventories.date','LIKE','%'.$request->month.'%')
                   ->where('inventories.user_id','!=',0)
                   ->whereIn('inventories.status',[0,3])
                   ->select('vegitables.name','vegitables.image',DB::raw('SUM(inventories.quntity) as total'),DB::raw('SUM(inventories.price)*0.97 as count'))
                   ->groupBy('inventories.veg_id','vegitables.name','vegitables.image')
                   ->get();

        $payment_normals = DB::table('inventories')
                   ->Join('vegitables','inventories.veg_id','=','vegitables.id')
                   ->where('inventories.ccentre_id',$request->ccentre)
                   ->where('inventories.date','LIKE','%'.$request->month.'%')
                   ->where('inventories.user_id','=',0)
                   ->whereIn('inventories.status',[0,3])
                   ->select('vegitables.name','vegitables.image',DB::raw('SUM(inventories.quntity) as total'),DB::raw('SUM(inventories.price)*0.95 as count'))
                   ->groupBy('inventories.veg_id','vegitables.name','vegitables.image')
                   ->get();

        $payment_transfers = DB::table('inventories')
                   ->Join('vegitables','inventories.veg_id','=','vegitables.id')
                   ->where('inventories.ccentre_id',$request->ccentre)
                   ->where('inventories.date','LIKE','%'.$request->month.'%')
                   ->where('inventories.status',2)
                   ->select('vegitables.name','vegitables.image',DB::raw('SUM(inventories.quntity) as total'),DB::raw('SUM(inventories.price) as count'))
                   ->groupBy('inventories.veg_id','vegitables.name','vegitables.image')
                   ->get();

        $req_month = $request->month;
        
        $ccentre = DB::table('collection_centres')
                   ->where('collection_centres.id',$request->ccentre)
                   ->select('collection_centres.centre_name')
                   ->get();

        $ccentre=json_decode($ccentre,true);
        $ccentre=$ccentre[0]["centre_name"];

        $admin = DB::table('users')
                  ->where('users.id',Auth::user()->id)
                  ->select('users.name','users.mobile','users.email','users.address')
                  ->get();

        $pdf = PDF::loadView('backend.report.areport.ccentre_monthly', compact('admin','ccentre','req_month','ccentre_payment','ccentre_transfer_payment','ccentre_profit','payment_registers','payment_normals','payment_transfers'),[], 
        [ 
          'format' => 'A4-L',
          'orientation' => 'L'
        ]);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('Collection Centre Monthly Summary Report.pdf');
    }

   }

}
