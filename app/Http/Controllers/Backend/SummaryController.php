<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //query builder in here
use App\Models\Branch;
use App\Models\CollectionCentre;

class SummaryController extends Controller
{  

    public function __construct(){
      
      $this->middleware('auth');

    }
    
    public function getVegData(){


    $farmer = DB::table('users')->where('usertype','Farmer')
              ->select(DB::raw('COUNT(id) as value'))->get();
    $maxValue=json_decode($farmer,true);
    $farmercount=$maxValue[0]["value"];

    $staff = DB::table('users')->where('usertype','Admin')
              ->select(DB::raw('COUNT(id) as value'))->get();
    $maxValue=json_decode($staff,true);
    $staffcount=$maxValue[0]["value"];

    $vegitable = DB::table('vegitables')->count();

    $message = DB::table('contact_forms')->count();

    $ecentre = DB::table('economic_centres')->count();

    $ccentre = DB::table('collection_centres')->count();

    /****************************************************************/

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
        				'name' =>$veg->name, 
        				'image' =>$veg->image, 
        				'catagory' =>$veg->catagory, 
        				'todayPrice' =>$todayMarketPrice, 
        				'yesterdayPrice' =>$yesterdayMarketPrice, 
        				'avg' => $averageMarketPrice
        			);
        	
         }

        $vegitables_summary = json_encode($vagArray);

         return view('admin.index',compact('farmercount','staffcount','vegitable','message','ecentre','ccentre','vegitables_summary'));

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

    function test(){
        
        $data = DB::select('SELECT vegitables.name
     , vegitables.image
     , vegitables.catagory
     , AVG(old_veg_prices.price_wholesale) AS avgwholesale
     , SUM(CASE WHEN old_veg_prices.price_date = CURRENT_DATE - INTERVAL 1 DAY THEN old_veg_prices.price_wholesale END) AS yesterday
     , SUM(CASE WHEN old_veg_prices.price_date = CURRENT_DATE THEN old_veg_prices.price_wholesale END) AS today
FROM vegitables
INNER JOIN old_veg_prices ON vegitables.id = old_veg_prices.veg_id
WHERE old_veg_prices.price_date IN (CURRENT_DATE - INTERVAL 1 DAY, CURRENT_DATE)
GROUP BY vegitables.id');
   

        return $data;
    	
    }
}
