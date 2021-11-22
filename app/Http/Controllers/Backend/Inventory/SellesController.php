<?php

namespace App\Http\Controllers\Backend\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vegitable;
use App\Models\Inventory;
use Auth;
use Session;
use PDF;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class SellesController extends Controller
{   
    public function __construct(){
      
      $this->middleware('auth');

    }

    public function ProductSellNormalView()
    {   

        $vegitablelist01 = Vegitable::get(["name", "id"]);
        $vegitablelist02 = Vegitable::get(["name", "id"]);
        return view('backend.inventory.ecentre.sell_product_normal',compact('vegitablelist01','vegitablelist02'));
    }

    public function NormalSellStore(Request $request){

        $validatedData = $request->validate([
            
            'veg_id' => 'required',
            'quntity'=> 'required'
        ]);

        Session::forget('order_id');
        Session::forget('invoice_id');

        $vegitable_list = count($request->veg_id);
        if ($vegitable_list != NULL) {
            $code= rand(1000,9999);
          for ($i=0; $i < $vegitable_list; $i++) { 
            $vegitable_inventory = new Inventory();
            $vegitable_inventory->order_id = 'NO'.str_pad($code , 6, "0", STR_PAD_LEFT);
            $vegitable_inventory->invoice_id = '#INO'.str_pad($code , 6, "0", STR_PAD_LEFT);
            $vegitable_inventory->user_id = 0;
            $vegitable_inventory->ecentre_id = Auth::user()->ecentre_id;
            $vegitable_inventory->date = date('Y-m-d');
            $vegitable_inventory->veg_id = $request->veg_id[$i];
            $vegitable_inventory->quntity = $request->quntity[$i];
            $vegitable_inventory->price = $this->todayMarketPrice($request->veg_id[$i])*$request->quntity[$i];
            $vegitable_inventory->status = 1;
            $vegitable_inventory->save();
          }
        }

        $order_id = 'NO'.str_pad($code , 6, "0", STR_PAD_LEFT);
        Session::put('order_id', $order_id);

        $invoice_id = '#INO'.str_pad($code , 6, "0", STR_PAD_LEFT);
        Session::put('invoice_id', $invoice_id);
         
        $notification = array(
           'message' => 'New Vegitable selles record added successfully',
           'alert-type' => 'success'
        );

        return redirect()->route('normal.ecentre.invoice')->with($notification);

    }

    public function todayMarketPrice($vegID){
        
        $vegitables_data = DB::table('vegitable_prices')
                        ->select('vegitable_prices.price_wholesale')
                        ->where('vegitable_prices.veg_id','=',$vegID)
                        ->get();

        
            foreach ($vegitables_data as  $veg) 
            {

              $todayVegPrice=$veg->price_wholesale;
             
            }

        return $todayVegPrice;
    }

    public function NormalSellInvoiceGen()
    {   

        $ccenter = DB::table('users')
                  ->Join('economic_centres','economic_centres.id','=','users.ecentre_id')
                  ->where('users.id',Auth::user()->id)
                  ->select('users.name','users.mobile','users.email','users.address','economic_centres.centre_name')
                  ->get();

        $order_id = Session::get('order_id');

        $invoice_id = Session::get('invoice_id');

        $orders = DB::table('inventories')
                ->Join('vegitables','vegitables.id','=','inventories.veg_id')
                ->Join('vegitable_prices','vegitable_prices.veg_id','=','vegitables.id')
                ->where('inventories.order_id',$order_id)
                ->select('vegitables.name','inventories.quntity','vegitable_prices.price_wholesale','inventories.price')
                ->get();

        $total_price = DB::table('inventories')
                       ->where('inventories.order_id',$order_id)
                       ->select(DB::raw('SUM(inventories.price) as total'))
                       ->get();

        return view('backend.inventory.ecentre.invoice_normal',compact('ccenter','orders','order_id','invoice_id','total_price'));
    }

    public function ProductSummaryEcentre()
    {   
        $products = DB::table('inventories')
                   ->Join('vegitables','inventories.veg_id','=','vegitables.id')
                   ->where('inventories.ecentre_id',Auth::user()->ecentre_id)
                   //->where('inventories.date','LIKE','%'.Carbon::now()->format('Y-m').'%')
                   ->select('vegitables.name','vegitables.image',DB::raw('SUM(inventories.quntity) as total'))
                   ->groupBy('inventories.veg_id','vegitables.name','vegitables.image')
                   ->get();

        return view('backend.inventory.ecentre.summary',compact('products'));
    }

    public function ProductListFilterEcentre(Request $request){
        
        $validatedData = $request->validate([
            'month' => 'required'
        ],[
            'date.required' => 'You Must select valid month'
        ]);

        if ($request->month) {
            
            $products = DB::table('inventories')
                   ->Join('vegitables','inventories.veg_id','=','vegitables.id')
                   ->where('inventories.ecentre_id',Auth::user()->ecentre_id)
                   ->where('inventories.date','LIKE','%'.$request->month.'%')
                   ->select('vegitables.name','vegitables.image',DB::raw('SUM(inventories.quntity) as total'))
                   ->groupBy('inventories.veg_id','vegitables.name','vegitables.image')
                   ->get();

            return view('backend.inventory.ecentre.summary',compact('products'));
        }
    }

    public function ProductSummaryReportEcentre()
    {   
        $products = DB::table('inventories')
                   ->Join('vegitables','inventories.veg_id','=','vegitables.id')
                   ->where('inventories.ecentre_id',Auth::user()->ecentre_id)
                   //->where('inventories.date','LIKE','%'.Carbon::now()->format('Y-m').'%')
                   ->select('vegitables.name','vegitables.image',DB::raw('SUM(inventories.quntity) as total'))
                   ->groupBy('inventories.veg_id','vegitables.name','vegitables.image')
                   ->get();

        $ccenter = DB::table('users')
                  ->Join('collection_centres','collection_centres.id','=','users.ccentre_id')
                  ->where('users.id',Auth::user()->id)
                  ->select('users.name','users.mobile','users.email','users.address','collection_centres.centre_name')
                  ->get();

        $pdf = PDF::loadView('backend.inventory.ecentre.current_month_summary', compact('products','ccenter'));
        //$pdf->SetWatermarkText('DRAFT');
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        //$pdf->SetDisplayMode('fullpage');
        return $pdf->stream('collection Centre Summary.pdf');
    }
}
