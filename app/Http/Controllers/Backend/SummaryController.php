<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //query builder in here
use App\Models\Branch;
use App\Models\CollectionCentre;
use Illuminate\Support\Facades\Auth;
use App\Models\Farmer;
use Carbon\Carbon;

class SummaryController extends Controller
{  

    public function __construct(){
      
      $this->middleware('auth');

    }
    
    public function getVegData(){

    $current_month = date("Y-m");
    //dd($current_month);
    $current_year = date("Y");

    $farmer = DB::table('users')
              ->whereIn('usertype',['Farmer','Farmer-Buyer'])
              ->select(DB::raw('COUNT(id) as value'))->get();
    $maxValue=json_decode($farmer,true);
    $farmercount=$maxValue[0]["value"];

    $buyer = DB::table('users')
              ->whereIn('usertype',['Buyer','Farmer-Buyer'])
              ->select(DB::raw('COUNT(id) as value'))->get();
    $maxValue=json_decode($buyer,true);
    $buyercount=$maxValue[0]["value"];

    $staff = DB::table('users')->where('usertype','Admin')
              ->select(DB::raw('COUNT(id) as value'))->get();
    $maxValue=json_decode($staff,true);
    $staffcount=$maxValue[0]["value"];

    $vegitable = DB::table('vegitables')->count();

    $message = DB::table('contact_forms')->count();

    $ecentre = DB::table('economic_centres')->count();

    $ccentre = DB::table('collection_centres')->count();
    /*********************farmer summary*************************/

    if (Auth::user()->role == 'Farmer') {
    
    $farmer_income_month = DB::table('inventories')
                        ->where('inventories.user_id',Auth::user()->id)
                        ->where('inventories.date','LIKE','%'.$current_month.'%')
                        ->whereIn('inventories.status',[0,3])
                        ->select(DB::raw('SUM(inventories.price)*0.97 as count'))
                        ->groupBy('inventories.user_id')
                        ->get();
    $farmer_income_month=json_decode($farmer_income_month,true);
    $farmer_income_month=$farmer_income_month[0]["count"];

   $farmer_income_year = DB::table('inventories')
                        ->where('inventories.user_id',Auth::user()->id)
                        ->where('inventories.date','LIKE','%'.$current_year.'%')
                        ->whereIn('inventories.status',[0,3])
                        ->select(DB::raw('SUM(inventories.price)*0.97 as count'))
                        ->groupBy('inventories.user_id')
                        ->get();
    $farmer_income_year=json_decode($farmer_income_year,true);
    $farmer_income_year=$farmer_income_year[0]["count"];

    $farmer_vegetable_month = DB::table('inventories')
                        ->where('inventories.user_id',Auth::user()->id)
                        ->where('inventories.date','LIKE','%'.$current_month.'%')
                        ->whereIn('inventories.status',[0,3])
                        ->select(DB::raw('SUM(inventories.quntity) as total'))
                        ->groupBy('inventories.user_id')
                        ->get();
    $farmer_vegetable_month=json_decode($farmer_vegetable_month,true);
    $farmer_vegetable_month=$farmer_vegetable_month[0]["total"];

    }
    

    /********************buyer summary******************************/
   if (Auth::user()->role == 'Buyer') {

    $buyer_payment_month = DB::table('inventories')
                        ->where('inventories.user_id',Auth::user()->id)
                        ->where('inventories.date','LIKE','%'.$current_month.'%')
                        ->where('inventories.status',1)
                        ->select(DB::raw('SUM(inventories.price)*1.01 as count'))
                        ->groupBy('inventories.user_id')
                        ->get();
    $buyer_payment_month=json_decode($buyer_payment_month,true);
    $buyer_payment_month=$buyer_payment_month[0]["count"];

   $buyer_payment_year = DB::table('inventories')
                        ->where('inventories.user_id',Auth::user()->id)
                        ->where('inventories.date','LIKE','%'.$current_year.'%')
                        ->where('inventories.status',1)
                        ->select(DB::raw('SUM(inventories.price)*1.01 as count'))
                        ->groupBy('inventories.user_id')
                        ->get();
    $buyer_payment_year=json_decode($buyer_payment_year,true);
    $buyer_payment_year=$buyer_payment_year[0]["count"];

    $buyer_vegetable_month = DB::table('inventories')
                        ->where('inventories.user_id',Auth::user()->id)
                        ->where('inventories.date','LIKE','%'.$current_month.'%')
                        ->where('inventories.status',1)
                        ->select(DB::raw('SUM(inventories.quntity) as total'))
                        ->groupBy('inventories.user_id')
                        ->get();
    $buyer_vegetable_month=json_decode($buyer_vegetable_month,true);
    $buyer_vegetable_month=$buyer_vegetable_month[0]["total"];

   }

   /***********************collection centre**************************/

      if (Auth::user()->role == 'RC-Officer') {

    $ccentre_register_payment = DB::table('inventories')
                        ->where('inventories.ccentre_id',Auth::user()->ccentre_id)
                        ->where('inventories.date','LIKE','%'.$current_month.'%')
                        ->where('inventories.user_id','!=',0)
                        ->whereIn('inventories.status',[0,3])
                        ->select(DB::raw('SUM(inventories.price)*0.97 as pay'))
                        ->get();
    $ccentre_register_payment=json_decode($ccentre_register_payment,true);
    $ccentre_register_payment=$ccentre_register_payment[0]["pay"]; 



    $ccentre_normal_payment = DB::table('inventories')
                        ->where('inventories.ccentre_id',Auth::user()->ccentre_id)
                        ->where('inventories.date','LIKE','%'.$current_month.'%')
                        ->where('inventories.user_id','=',0)
                        ->whereIn('inventories.status',[0,3])
                        ->select(DB::raw('SUM(inventories.price)*0.95 as pay'))
                        ->get();
    $ccentre_normal_payment=json_decode($ccentre_normal_payment,true);
    $ccentre_normal_payment=$ccentre_normal_payment[0]["pay"];



    $ccentre_transfer_payment = DB::table('inventories')
                        ->where('inventories.ccentre_id',Auth::user()->ccentre_id)
                        ->where('inventories.date','LIKE','%'.$current_month.'%')
                        ->where('inventories.status',2)
                        ->select(DB::raw('SUM(inventories.price) as pay'))
                        ->get();
    $ccentre_transfer_payment=json_decode($ccentre_transfer_payment,true);
    $ccentre_transfer_payment=$ccentre_transfer_payment[0]["pay"];


    $ccentre_vegetable_month = DB::table('inventories')
                        ->where('inventories.ccentre_id',Auth::user()->ccentre_id)
                        ->where('inventories.date','LIKE','%'.$current_month.'%')
                        ->whereIn('inventories.status',[0,3])
                        ->select(DB::raw('SUM(inventories.quntity) as total'))
                        ->groupBy('inventories.ccentre_id')
                        ->get();
    $ccentre_vegetable_month=json_decode($ccentre_vegetable_month,true);
    $ccentre_vegetable_month=$ccentre_vegetable_month[0]["total"];

    $ccentre_payment = $ccentre_register_payment + $ccentre_normal_payment;

    $ccentre_profit = $ccentre_transfer_payment - $ccentre_payment;

   }

   /**********************economic centre***************************/

         if (Auth::user()->role == 'EC-Officer') {

    $ecentre_register_income = DB::table('inventories')
                        ->where('inventories.ecentre_id',Auth::user()->ecentre_id)
                        ->where('inventories.date','LIKE','%'.$current_month.'%')
                        ->where('inventories.user_id','!=',0)
                        ->where('inventories.status',1)
                        ->select(DB::raw('SUM(inventories.price)*1.01 as pay'))
                        ->get();
    $ecentre_register_income=json_decode($ecentre_register_income,true);
    $ecentre_register_income=$ecentre_register_income[0]["pay"]; 



    $ecentre_normal_income = DB::table('inventories')
                        ->where('inventories.ecentre_id',Auth::user()->ecentre_id)
                        ->where('inventories.date','LIKE','%'.$current_month.'%')
                        ->where('inventories.user_id','=',0)
                        ->where('inventories.status',1)
                        ->select(DB::raw('SUM(inventories.price)*1.05 as pay'))
                        ->get();
    $ecentre_normal_income=json_decode($ecentre_normal_income,true);
    $ecentre_normal_income=$ecentre_normal_income[0]["pay"];


    $ecentre_transfer_payment = DB::table('inventories')
                        ->where('inventories.ecentre_id',Auth::user()->ecentre_id)
                        ->where('inventories.date','LIKE','%'.$current_month.'%')
                        ->where('inventories.status',4)
                        ->select(DB::raw('SUM(inventories.price) as pay'))
                        ->get();
    $ecentre_transfer_payment=json_decode($ecentre_transfer_payment,true);
    $ecentre_transfer_payment=$ecentre_transfer_payment[0]["pay"];


    $ecentre_vegetable_month = DB::table('inventories')
                        ->where('inventories.ecentre_id',Auth::user()->ecentre_id)
                        ->where('inventories.date','LIKE','%'.$current_month.'%')
                        ->whereIn('inventories.status',[1,4])
                        ->select(DB::raw('SUM(inventories.quntity) as total'))
                        ->groupBy('inventories.ccentre_id')
                        ->get();
    $ecentre_vegetable_month=json_decode($ecentre_vegetable_month,true);
    $ecentre_vegetable_month=$ecentre_vegetable_month[0]["total"];

     $ecentre_income = $ecentre_register_income + $ecentre_normal_income + $ecentre_transfer_payment;

    // $ecentre_profit = $ecentre_transfer_payment - $ecentre_income;

   }

    /****************************************************************/

        $messages = DB::table('contact_forms')
                       ->where('contact_forms.status',0)
                       ->select(DB::raw('COUNT(id) as value'))->get();
    
        $messages = json_decode($messages,true);
           
        $messages = $messages[0]["value"];


        $todaybooking = DB::table('bookings')
                    ->where('bookings.ccentre_id', Auth::user()->ccentre_id)
                    ->where('bookings.date',date('Y-m-d'))
                    ->where('bookings.status',0)
                    ->select(DB::raw('COUNT(id) as value'))
                    ->get();
        $todaybooking = json_decode($todaybooking,true);
           
        $todaybooking = $todaybooking[0]["value"];


        $todaybuyerbooking = DB::table('buyer_bookings')
                    ->where('buyer_bookings.ecentre_id', Auth::user()->ecentre_id)
                    ->where('buyer_bookings.date',date('Y-m-d'))
                    ->where('buyer_bookings.status',0)
                    ->select(DB::raw('COUNT(id) as value'))
                    ->get();
        $todaybuyerbooking = json_decode($todaybuyerbooking,true);
           
        $todaybuyerbooking = $todaybuyerbooking[0]["value"];

        $todaybuyerbookingaccept = DB::table('buyer_bookings')
                    ->where('buyer_bookings.ecentre_id', Auth::user()->ecentre_id)
                    ->where('buyer_bookings.date',date('Y-m-d'))
                    ->where('buyer_bookings.status',1)
                    ->select(DB::raw('COUNT(id) as value'))
                    ->get();
        $todaybuyerbookingaccept = json_decode($todaybuyerbookingaccept,true);
           
        $todaybuyerbookingaccept = $todaybuyerbookingaccept[0]["value"];


        $todaybookingaccept  = DB::table('bookings')
                    ->where('bookings.ccentre_id', Auth::user()->ccentre_id)
                    ->where('bookings.date',date('Y-m-d'))
                    ->where('bookings.status',1)
                    ->select(DB::raw('COUNT(id) as value'))
                    ->get();
        $todaybookingaccept = json_decode($todaybookingaccept,true);
           
        $todaybookingaccept = $todaybookingaccept[0]["value"];

    /*******************************************************************/

    	$vagArray=array();

        $vegitables_data = DB::table('vegitables')
                        ->select('vegitables.id','vegitables.name','vegitables.image','vegitables.catagory')
                        ->get();

        foreach ($vegitables_data as $veg) {

        	$vegID=$veg->id;
        	$yesterdayMarketPrice=$this->yesterdayMarketPrice($vegID);
        	$todayMarketPrice=$this->todayMarketPrice($vegID);
            $averageMarketPrice=$this->averageMarketPrice($vegID);

        	$vagArray[]=array(
                        'id' => $veg->id,
        				'name' =>$veg->name, 
        				'image' =>$veg->image, 
        				'catagory' =>$veg->catagory, 
        				'todayPrice' =>$todayMarketPrice, 
        				'yesterdayPrice' =>$yesterdayMarketPrice, 
        				'avg' => $averageMarketPrice
        			);
        	
         }

        $vegitables_summary = json_encode($vagArray);

        if (Auth::user()->role == 'Farmer') {

         return view('admin.index',compact('farmercount','buyercount','staffcount','vegitable','message','ecentre','ccentre','farmer_income_month','farmer_income_year','farmer_vegetable_month','vegitables_summary','messages','todaybooking','todaybuyerbooking','todaybuyerbookingaccept','todaybookingaccept'));

        }else if (Auth::user()->role == 'Buyer') {
            
        return view('admin.index',compact('farmercount','buyercount','staffcount','vegitable','message','ecentre','ccentre','buyer_payment_month','buyer_payment_year','buyer_vegetable_month','vegitables_summary','messages','todaybooking','todaybuyerbooking','todaybuyerbookingaccept','todaybookingaccept'));

        }else if (Auth::user()->role == 'RC-Officer') {

        return view('admin.index',compact('farmercount','buyercount','staffcount','vegitable','message','ecentre','ccentre','ccentre_payment','ccentre_transfer_payment','ccentre_profit','ccentre_vegetable_month','vegitables_summary','messages','todaybooking','todaybuyerbooking','todaybuyerbookingaccept','todaybookingaccept'));

        }else if (Auth::user()->role == 'EC-Officer') {

           return view('admin.index',compact('farmercount','buyercount','staffcount','vegitable','message','ecentre','ccentre','ecentre_register_income','ecentre_transfer_payment','ecentre_normal_income','ecentre_income','ecentre_vegetable_month','vegitables_summary','messages','todaybooking','todaybuyerbooking','todaybuyerbookingaccept','todaybookingaccept')); 
        }else{

           return view('admin.index',compact('farmercount','buyercount','staffcount','vegitable','message','ecentre','ccentre','vegitables_summary','messages','todaybooking','todaybuyerbooking','todaybuyerbookingaccept','todaybookingaccept'));
        }
    }

    public function todayMarketPrice($vegID){
    	$today=date("Y-m-d");
    	
    	$vegitables_data = DB::table('old_veg_prices')
                        ->select('old_veg_prices.price_wholesale')
                        ->where('old_veg_prices.price_date','=',$today)
                        ->where('old_veg_prices.veg_id','=',$vegID)
                        ->orderBy('old_veg_prices.id', 'DESC')
                        ->limit(1)
                        ->get();

          
        if ($vegitables_data->count() == 0)  {
        	
        	$todayVegPrice = 'No Data';

        }
        else
        {
        	foreach ($vegitables_data as  $veg) 
        	{

        	  $todayVegPrice=$veg->price_wholesale;
             
             }
        }

        return $todayVegPrice;
    }

    public function yesterdayMarketPrice($vegID){
    	
    	$yesterday = date("Y-m-d", strtotime("yesterday"));

    	$vegitables_data = DB::table('old_veg_prices')
                        ->select('old_veg_prices.price_wholesale')
                        ->where('old_veg_prices.price_date','=',$yesterday)
                        ->where('old_veg_prices.veg_id','=',$vegID)
                        ->orderBy('old_veg_prices.id', 'DESC')
                        ->limit(1)
                        ->get();

        if ($vegitables_data->count() == 0)  {
        	
        	$todayVegPrice = 'No Data';

        }
        else
        {
        	foreach ($vegitables_data as  $veg) 
        	{

        	  $todayVegPrice=$veg->price_wholesale;
             
             }
        }

        return $todayVegPrice;
    }


    public function averageMarketPrice($vegID){
    	
    	$vegitables_data = DB::table('old_veg_prices')
                           ->select(DB::raw('round(AVG(price_wholesale),0) as average'))
                           ->where('old_veg_prices.veg_id',$vegID)
                           ->get();

       foreach ($vegitables_data as  $veg) {

        	  $todayVegPrice=$veg->average;
         }

        return $todayVegPrice;
    }


    public function VegPriceAnalysis($id){
       
        $vagArray=array();

        $vegitables_data = DB::table('vegitables')
                        ->select('vegitables.id','vegitables.name','vegitables.image','vegitables.catagory')
                        ->where('vegitables.id',$id)
                        ->get();

        foreach ($vegitables_data as $veg) {

            $vegID=$veg->id;
            $yesterdayMarketPrice=$this->yesterdayMarketPrice($vegID);
            $todayMarketPrice=$this->todayMarketPrice($vegID);
            $averageMarketPrice=$this->averageMarketPrice($vegID);

            $vagArray[]=array(
                        'id' => $veg->id,
                        'name' =>$veg->name, 
                        'image' =>$veg->image, 
                        'catagory' =>$veg->catagory, 
                        'todayPrice' =>$todayMarketPrice, 
                        'yesterdayPrice' =>$yesterdayMarketPrice, 
                        'avg' => $averageMarketPrice
                    );
            
         }

        $vegitables_summary = json_encode($vagArray);

        $date = Carbon::now()->subDays(9);
        
        $veg_price_date = DB::table('old_veg_prices')
                     ->where('old_veg_prices.veg_id',$id)
                     ->where('old_veg_prices.price_date', '>=', $date)
                     ->select('old_veg_prices.price_date')
                     ->get();

        $veg_price_date = json_decode($veg_price_date,true);
           
         $simple_array = array(); //simple array

        foreach($veg_price_date as $veg_price_date)
        {
            $simple_array[] = $veg_price_date['price_date'];   
        }

         $veg_price = DB::table('old_veg_prices')
                     ->where('old_veg_prices.veg_id',$id)
                     ->where('old_veg_prices.price_date', '>=', $date)
                     ->select('old_veg_prices.price_wholesale')
                     ->get();

        $veg_price = json_decode($veg_price,true);
           
         $simple_array2 = array(); //simple array

        foreach($veg_price as $veg_price)
        {
            $simple_array2[] = $veg_price['price_wholesale'];   
        }

        $vegitables_data = DB::table('old_veg_prices')
                           ->select(DB::raw('round(AVG(price_wholesale),0) as average'))
                           ->where('old_veg_prices.price_date', '>=', $date)
                           ->where('old_veg_prices.veg_id',$id)
                           ->get();

       foreach ($vegitables_data as  $veg) {

              $VegPriceAverage =$veg->average;
         }

         //dd($VegPriceAverage);

        return view('backend.product.vegitable_price_analysis.index',compact('vegitables_summary','simple_array','simple_array2','VegPriceAverage'));
    }


    public function test(){
        
        $data = DB::table('vegitables')
    ->Join('old_veg_prices', 'old_veg_prices.veg_id', '=', 'vegitables.id')
    ->whereRaw('old_veg_prices.price_date IN (CURRENT_DATE - INTERVAL 1 DAY, CURRENT_DATE)')
    ->select(
        'vegitables.name',
        'vegitables.image',
        'vegitables.catagory',
        DB::raw('AVG(old_veg_prices.price_wholesale) AS avgwholesale'),
        DB::raw('SUM(CASE WHEN old_veg_prices.price_date = CURRENT_DATE - INTERVAL 1 DAY THEN old_veg_prices.price_wholesale END) AS yesterday'),
        DB::raw('SUM(CASE WHEN old_veg_prices.price_date = CURRENT_DATE THEN old_veg_prices.price_wholesale END) AS today')
    )
    ->groupBy('vegitables.id','vegitables.name','vegitables.image','vegitables.catagory')
    ->get();

    
        return $data;
    }
}
