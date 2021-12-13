<?php

namespace App\Http\Controllers\Backend\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vegitable;
use App\Models\Inventory;
use App\Models\BuyerBooking;
use App\Models\Payment;
use Auth;
use Session;
use PDF;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Mail\PaymentSellMail;
use Illuminate\Support\Facades\Mail;

class SellesController extends Controller
{   
    public function __construct(){
      
      $this->middleware('auth');

    }

    public function BuyerBookingList()
    {
        $mybooking  = DB::table('buyer_bookings')
                        ->Join('users','buyer_bookings.user_id','=','users.id')
                        ->Join('economic_centres','buyer_bookings.ecentre_id','=','economic_centres.id')
                        ->where('buyer_bookings.ecentre_id', Auth::user()->ecentre_id)
                        ->where('buyer_bookings.date',date('Y-m-d'))
                        ->where('buyer_bookings.status',1)
                        ->select('users.name','economic_centres.centre_name','buyer_bookings.date','buyer_bookings.created_at','buyer_bookings.status','users.email','users.image','users.mobile','buyer_bookings.id')
                        ->orderBy('date', 'desc')
                        ->get();
        //dd($mybooking);

        return view('backend.inventory.ecentre.index',compact('mybooking'));
    }

    public function BuyerProductAddView($id)
    {   
        $booking = DB::table('buyer_bookings')
                        ->Join('users','buyer_bookings.user_id','=','users.id')
                        ->Join('economic_centres','buyer_bookings.ecentre_id','=','economic_centres.id')
                        ->where('buyer_bookings.id',$id)
                        ->select('users.name','economic_centres.centre_name','buyer_bookings.date','users.email','buyer_bookings.id','buyer_bookings.ccentre_id','buyer_bookings.user_id','buyer_bookings.id')
                        ->get();

        $booking_id = DB::table('buyer_bookings')
                      ->where('buyer_bookings.id',$id)
                      ->select('buyer_bookings.id')
                      ->get();

        $booking_id =json_decode($booking_id,true);
        $booking_id=$booking_id[0]["id"];

        $orders = DB::table('vegitable_book_lists')
                  ->Join('vegitables','vegitables.id','=','vegitable_book_lists.veg_id')
                  ->where('vegitable_book_lists.booking_id',$booking_id)
                  ->get();

        //dd($orders);
        return view('backend.inventory.ecentre.add_product',compact('booking','orders'));
    }

    public function BuyerBookingProductStore(Request $request){

        $validatedData = $request->validate([

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
            $vegitable_inventory->ecentre_id = Auth::user()->ecentre_id;
            $vegitable_inventory->date = $request->date;
            $vegitable_inventory->veg_id = $request->veg_id[$i];
            $vegitable_inventory->quntity = $request->quntity[$i];
            $vegitable_inventory->price = $this->todayMarketPrice($request->veg_id[$i])*$request->quntity[$i];
            $vegitable_inventory->status = 1;
            $vegitable_inventory->save();
          }
        }

        $order_id = 'BO'.str_pad($request->booking_id , 6, "0", STR_PAD_LEFT);
        Session::put('order_id', $order_id);
        $invoice_id = '#IBO'.str_pad($request->booking_id , 6, "0", STR_PAD_LEFT);
        Session::put('invoice_id', $invoice_id);
       
        $data = BuyerBooking::find($request->booking_id);
        $data->status = 2;
        $data->save();
         
        $notification = array(
           'message' => 'New Vegitable sell detials record added successfully',
           'alert-type' => 'success'
        );

        return redirect()->route('buyer.booking.invoice')->with($notification);

    }

    public function BuyerBookingInvoiceGen()
    {   
        $order_id = Session::get('order_id');

        $invoice_id = Session::get('invoice_id');

        $ecenter = DB::table('users')
                  ->Join('economic_centres','economic_centres.id','=','users.ecentre_id')
                  ->where('users.id',Auth::user()->id)
                  ->select('users.name','users.mobile','users.email','users.address','economic_centres.centre_name','users.id')
                  ->get();

        $user = DB::table('inventories')
                  ->Join('users','users.id','=','inventories.user_id')
                  ->where('inventories.order_id',$order_id)
                  ->where('inventories.status',1)
                  ->select('users.name','users.mobile','users.email','users.address','inventories.order_id','inventories.invoice_id','inventories.user_id')
                  ->orderBy('inventories.order_id', 'desc')
                  ->limit(1)
                  ->get();

        $orders = DB::table('inventories')
                ->Join('vegitables','vegitables.id','=','inventories.veg_id')
                ->Join('vegitable_prices','vegitable_prices.veg_id','=','vegitables.id')
                ->where('inventories.order_id',$order_id)
                ->where('inventories.status',1)
                ->select('vegitables.name','inventories.quntity','vegitable_prices.price_wholesale','inventories.price')
                ->get();

        $total_price = DB::table('inventories')
                       ->where('inventories.order_id',$order_id)
                       ->where('inventories.status',1)
                       ->select(DB::raw('SUM(inventories.price) as total'))
                       ->get();
        
        return view('backend.inventory.ecentre.invoice',compact('ecenter','user','orders','total_price','order_id','invoice_id'));
    }

    public function BuyerBookingPaymentStore(Request $request){

       Payment::insert([
            'order_id' => $request->order_id,
            'invoice_id' => $request->invoice_id,
            'total_payment' => $request->total_payment,
            'net_payment' => $request->net_payment,
            'payment_type' => 0,
            'date' => date('Y-m-d'),
            'from' => $request->from,
            'to' => $request->to,
            'status' => 4,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        $data = [

            'order_id' => $request->order_id,
            'invoice_id' => $request->invoice_id,
            'net_payment' => $request->net_payment,
            'payment_type' => 0,
            'account_number' => $request->account_number,
            'date' => date('Y-m-d'),
            'name' => $request->name,
            'status' => 1,
        ];
    
       $mail = new PaymentSellMail($data);
    
       Mail::to($request->email)->send($mail);

        //Session::forget('order_id');
        //Session::forget('invoice_id');
         
        $notification = array(
           'message' => 'New buyer payment completed Successfully',
           'alert-type' => 'success'
        );

        return redirect()->route('product.summary.ecentre')->with($notification);
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

        return redirect()->route('normal.sell.invoice')->with($notification);

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

        $ecenter = DB::table('users')
                  ->Join('economic_centres','economic_centres.id','=','users.ecentre_id')
                  ->where('users.id',Auth::user()->id)
                  ->select('users.name','users.mobile','users.email','users.address','economic_centres.centre_name','users.id')
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

        return view('backend.inventory.ecentre.invoice_normal',compact('ecenter','orders','order_id','invoice_id','total_price'));
    }

    public function BuyerNormalPaymentStore(Request $request){

       Payment::insert([
            'order_id' => $request->order_id,
            'invoice_id' => $request->invoice_id,
            'total_payment' => $request->total_payment,
            'net_payment' => $request->net_payment,
            'payment_type' => 0,
            'date' => date('Y-m-d'),
            'from' => $request->from,
            'to' => $request->to,
            'status' => 5,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
         
        $notification = array(
           'message' => 'New unregisterd buyer payment completed Successfully',
           'alert-type' => 'success'
        );

        return redirect()->route('product.summary.ecentre')->with($notification);
    }

    public function ProductSummaryEcentre()
    {   
        $vagArray=array();

        $vegitables_data = DB::table('vegitables')
                          ->select('vegitables.id','vegitables.name','vegitables.image')
                          ->get();

        foreach ($vegitables_data as $veg) {

            $vegID=$veg->id;
            $totalStock=$this->GetTotalStock($vegID);
            $sellingStock=$this->GetSellingStock($vegID);
            $transferStock=$this->GetBulkTransferStock($vegID);
            $availbleStock = $totalStock - ($sellingStock + $transferStock);

            $vagArray[]=array(
                        'id' =>$veg->id,
                        'name' =>$veg->name,
                        'image' => $veg->image,  
                        'quntity' =>$availbleStock
                    );
            
         }

        $products = json_encode($vagArray);
        //dd($products);

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
                   ->where('inventories.status',2)
                   ->where('inventories.date','LIKE','%'.$request->month.'%')
                   ->select('vegitables.name','vegitables.image',DB::raw('SUM(inventories.quntity) as quntity'))
                   ->groupBy('inventories.veg_id','vegitables.name','vegitables.image')
                   ->get();

            return view('backend.inventory.ecentre.summary',compact('products'));
        }
    }

    public function ProductSummaryReportEcentre()
    {   
        $vagArray=array();

        $vegitables_data = DB::table('vegitables')
                          ->select('vegitables.id','vegitables.name','vegitables.image')
                          ->get();

        foreach ($vegitables_data as $veg) {

            $vegID=$veg->id;
            $totalStock=$this->GetTotalStock($vegID);
            $sellingStock=$this->GetSellingStock($vegID);
            $transferStock=$this->GetBulkTransferStock($vegID);
            $availbleStock = $totalStock - ($sellingStock + $transferStock);

            $vagArray[]=array(
                        'id' =>$veg->id,
                        'name' =>$veg->name,
                        'image' => $veg->image,  
                        'quntity' =>$availbleStock
                    );
            
         }

        $products = json_encode($vagArray);

        $ecenter = DB::table('users')
                  ->Join('economic_centres','economic_centres.id','=','users.ecentre_id')
                  ->where('users.id',Auth::user()->id)
                  ->select('users.name','users.mobile','users.email','users.address','economic_centres.centre_name')
                  ->get();

        $pdf = PDF::loadView('backend.inventory.ecentre.current_stock_summary', compact('products','ecenter'));
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('Economic Centre Current Stock Summary.pdf');
    }

        public function ProductSummaryMonthReportEcentre()
    {   
        $products = DB::table('inventories')
                   ->Join('vegitables','inventories.veg_id','=','vegitables.id')
                   ->where('inventories.ecentre_id',Auth::user()->ecentre_id)
                   ->where('inventories.status',2)
                   ->where('inventories.date','LIKE','%'.date('Y-m').'%')
                   ->select('vegitables.name','vegitables.image',DB::raw('SUM(inventories.quntity) as total'))
                   ->groupBy('inventories.veg_id','vegitables.name','vegitables.image')
                   ->get();

        $ecenter = DB::table('users')
                  ->Join('economic_centres','economic_centres.id','=','users.ecentre_id')
                  ->where('users.id',Auth::user()->id)
                  ->select('users.name','users.mobile','users.email','users.address','economic_centres.centre_name')
                  ->get();

        $current_month = date('M Y');

        $pdf = PDF::loadView('backend.inventory.ecentre.current_month_summary', compact('products','ecenter','current_month'));
        
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('Economic Centre Month Summary.pdf');
    }

    public function GetTotalStock($vegID){
        

       $products = DB::table('inventories')
                   ->where('inventories.ecentre_id',Auth::user()->ecentre_id)
                   ->where('inventories.status',2)
                   ->where('inventories.date','=', date("Y-m-d", strtotime('yesterday')))
                   ->where('inventories.veg_id','=',$vegID)
                   ->select(DB::raw('SUM(inventories.quntity) as total'))
                   //->groupBy('inventories.veg_id','vegitables.name','vegitables.image')
                   ->get();

            foreach ($products as $product) 
            {

              $totalStock = $product->total;
             
            }

        return $totalStock;
    }

    public function GetSellingStock($vegID){
        

       $products = DB::table('inventories')
                   ->where('inventories.ecentre_id',Auth::user()->ecentre_id)
                   ->where('inventories.status',1)
                   ->where('inventories.date','=', date("Y-m-d"))
                   ->where('inventories.veg_id','=',$vegID)
                   ->select(DB::raw('SUM(inventories.quntity) as total'))
                   //->groupBy('inventories.veg_id','vegitables.name','vegitables.image')
                   ->get();

            foreach ($products as $product) 
            {

              $sellStock = $product->total;
             
            }

        return $sellStock;
    }

    public function GetBulkTransferStock($vegID){
        

       $products = DB::table('inventories')
                   ->where('inventories.ecentre_id',Auth::user()->ecentre_id)
                   ->where('inventories.status',4)
                   ->where('inventories.date','=', date("Y-m-d"))
                   ->where('inventories.veg_id','=',$vegID)
                   ->select(DB::raw('SUM(inventories.quntity) as total'))
                   //->groupBy('inventories.veg_id','vegitables.name','vegitables.image')
                   ->get();

            foreach ($products as $product) 
            {

              $bulktransStock = $product->total;
             
            }

        return $bulktransStock;
    }
  
}
