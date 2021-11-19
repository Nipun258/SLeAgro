<?php

namespace App\Http\Controllers\Backend\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Vegitable;
use App\Models\Inventory;
use Auth;
use Session;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ProductAddController extends Controller
{
    public function __construct(){
      
      $this->middleware('auth');

    }

    public function BookingList()
    {
        $mybooking  = DB::table('bookings')
                        ->Join('users','bookings.user_id','=','users.id')
                        ->Join('collection_centres','bookings.ccentre_id','=','collection_centres.id')
                        ->where('bookings.ccentre_id', Auth::user()->ccentre_id)
                        ->where('bookings.date',date('Y-m-d'))
                        ->where('bookings.status',1)
                        ->select('users.name','collection_centres.centre_name','bookings.date','bookings.time','bookings.created_at','bookings.status','users.email','users.image','users.mobile','bookings.id')
                        ->orderBy('date', 'desc')
                        ->get();

        return view('backend.inventory.index',compact('mybooking'));
    }

    public function ProductAddView($id)
    {   
        $booking = DB::table('bookings')
                        ->Join('users','bookings.user_id','=','users.id')
                        ->Join('collection_centres','bookings.ccentre_id','=','collection_centres.id')
                        ->where('bookings.id',$id)
                        ->select('users.name','collection_centres.centre_name','bookings.date','users.email','bookings.id','bookings.ccentre_id','bookings.user_id')
                        ->get();

        $vegitablelist01 = Vegitable::get(["name", "id"]);
        $vegitablelist02 = Vegitable::get(["name", "id"]);
        return view('backend.inventory.add_product',compact('booking','vegitablelist01','vegitablelist02'));
    }


    public function BookingProductStore(Request $request){

        $validatedData = $request->validate([
            
            'veg_id' => 'required',
            'quntity'=> 'required'
        ]);

        Session::forget('order_id');
        Session::forget('invoice_id');

        $vegitable_list = count($request->veg_id);
        if ($vegitable_list != NULL) {
          for ($i=0; $i < $vegitable_list; $i++) { 
            $vegitable_inventory = new Inventory();
            $vegitable_inventory->order_id = 'BO'.str_pad($request->booking_id , 6, "0", STR_PAD_LEFT);
            $vegitable_inventory->invoice_id = '#IBO'.str_pad($request->booking_id , 6, "0", STR_PAD_LEFT);
            $vegitable_inventory->user_id = $request->user_id;
            $vegitable_inventory->ccentre_id = $request->ccentre_id;
            $vegitable_inventory->date = $request->date;
            $vegitable_inventory->veg_id = $request->veg_id[$i];
            $vegitable_inventory->quntity = $request->quntity[$i];
            $vegitable_inventory->price = $this->todayMarketPrice($request->veg_id[$i])*$request->quntity[$i];
            $vegitable_inventory->save();
          }
        }

        $order_id = 'BO'.str_pad($request->booking_id , 6, "0", STR_PAD_LEFT);
        Session::put('order_id', $order_id);
        $invoice_id = '#IBO'.str_pad($request->booking_id , 6, "0", STR_PAD_LEFT);
        Session::put('invoice_id', $invoice_id);
       
        $data = Booking::find($request->booking_id);
        $data->status = 2;
        $data->save();
         
        $notification = array(
           'message' => 'New Vegitable detials record added successfully',
           'alert-type' => 'success'
        );

        return redirect()->route('booking.invoice')->with($notification);

    }

        public function ProductAddNormalView()
    {   

        $vegitablelist01 = Vegitable::get(["name", "id"]);
        $vegitablelist02 = Vegitable::get(["name", "id"]);
        return view('backend.inventory.add_product_normal',compact('vegitablelist01','vegitablelist02'));
    }

    public function NormalProductStore(Request $request){

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
            $vegitable_inventory->ccentre_id = Auth::user()->ccentre_id;
            $vegitable_inventory->date = date('Y-m-d');
            $vegitable_inventory->veg_id = $request->veg_id[$i];
            $vegitable_inventory->quntity = $request->quntity[$i];
            $vegitable_inventory->price = $this->todayMarketPrice($request->veg_id[$i])*$request->quntity[$i];
            $vegitable_inventory->save();
          }
        }

        $order_id = 'NO'.str_pad($code , 6, "0", STR_PAD_LEFT);
        Session::put('order_id', $order_id);

        $invoice_id = '#INO'.str_pad($code , 6, "0", STR_PAD_LEFT);
        Session::put('invoice_id', $invoice_id);
         
        $notification = array(
           'message' => 'New Vegitable detials record added successfully',
           'alert-type' => 'success'
        );

        return redirect()->route('normal.invoice')->with($notification);

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

    public function NormalInvoiceGen()
    {   

        $ccenter = DB::table('users')
                  ->Join('collection_centres','collection_centres.id','=','users.ccentre_id')
                  ->where('users.id',Auth::user()->id)
                  ->select('users.name','users.mobile','users.email','users.address','collection_centres.centre_name')
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

        return view('backend.inventory.invoice_normal',compact('ccenter','orders','order_id','invoice_id','total_price'));
    }

    public function BookingInvoiceGen()
    {   
        $ccenter = DB::table('users')
                  ->Join('collection_centres','collection_centres.id','=','users.ccentre_id')
                  ->where('users.id',Auth::user()->id)
                  ->select('users.name','users.mobile','users.email','users.address','collection_centres.centre_name')
                  ->get();

        $user = DB::table('inventories')
                  ->Join('users','users.id','=','inventories.user_id')
                  ->Join('farmers','farmers.user_id','=','users.id')
                  ->select('users.name','users.mobile','users.email','users.address','farmers.account_number','inventories.order_id','inventories.invoice_id')
                  ->orderBy('inventories.order_id', 'desc')
                  ->limit(1)
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
        
        return view('backend.inventory.invoice',compact('ccenter','user','orders','total_price'));
    }

       public function ProductSummary()
    {   
        $products = DB::table('inventories')
                   ->Join('vegitables','inventories.veg_id','=','vegitables.id')
                   ->where('inventories.ccentre_id',Auth::user()->ccentre_id)
                   ->where('inventories.date','LIKE','%'.Carbon::now()->format('Y-m').'%')
                   ->select('vegitables.name','vegitables.image',DB::raw('SUM(inventories.quntity) as total'))
                   ->groupBy('inventories.veg_id','vegitables.name','vegitables.image')
                   ->get();

        return view('backend.inventory.summary',compact('products'));
    }

    public function ProductListFilter(Request $request){
        
        $validatedData = $request->validate([
            'month' => 'required'
        ],[
            'date.required' => 'You Must select valid month'
        ]);

        if ($request->month) {
            
            $products = DB::table('inventories')
                   ->Join('vegitables','inventories.veg_id','=','vegitables.id')
                   ->where('inventories.ccentre_id',Auth::user()->ccentre_id)
                   ->where('inventories.date','LIKE','%'.$request->month.'%')
                   ->select('vegitables.name','vegitables.image',DB::raw('SUM(inventories.quntity) as total'))
                   ->groupBy('inventories.veg_id','vegitables.name','vegitables.image')
                   ->get();

            return view('backend.inventory.summary',compact('products'));
        }
    }

}