<?php

namespace App\Http\Controllers\Backend\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vegitable;
use App\Models\Inventory;
use App\Models\Payment;
use Auth;
use Session;
use PDF;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
//use App\Mail\ProductTransferMail;
//use App\Mail\PaymentTransferMail;
use Illuminate\Support\Facades\Mail;

class EcentreProductTransferController extends Controller
{
    public function __construct(){
      
      $this->middleware('auth');

    }

    public function ProductTransferMarketView()
    {   

        $vagArray=array();

        $vegitables_data = DB::table('vegitables')
                          ->Join('vegitable_prices','vegitable_prices.veg_id','=','vegitables.id')
                          ->select('vegitables.id','vegitables.name','vegitables.image','vegitable_prices.price_wholesale')
                          ->get();
        //dd($vegitables_data);

        foreach ($vegitables_data as $veg) {

            $vegID=$veg->id;
            $totalStock=$this->GetTotalStock($vegID);
            $sellingStock=$this->GetSellingStock($vegID);
            $transferStock=$this->GetBulkTransferStock($vegID);
            $availbleStock = $totalStock - ($sellingStock + $transferStock);
            $totalprice =  $availbleStock*$veg->price_wholesale;

            if($availbleStock > 0){

            $vagArray[]=array(
                        'id' =>$veg->id,
                        'name' =>$veg->name,
                        'image' => $veg->image,  
                        'count' => $availbleStock,
                        'total' => $totalprice
                    );
            }
            
         }

        $products = json_encode($vagArray);
        //dd($products);
        return view('backend.inventory.ecentre.transfer',compact('products'));
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

    public function ProductTransferMarketStore(Request $request){

        Session::forget('order_id');
        Session::forget('invoice_id');

        $vegitable_list = count($request->veg_id);
        if ($vegitable_list != NULL) {

            $code= rand(1000,9999);

          for($i=0; $i < $vegitable_list; $i++) {

            $vegitable_inventory = new Inventory();
            $vegitable_inventory->order_id = 'ETO'.str_pad($code , 6, "0", STR_PAD_LEFT);
            $vegitable_inventory->invoice_id = '#IETO'.str_pad($code , 6, "0", STR_PAD_LEFT);
            $vegitable_inventory->user_id = Auth::user()->id;
            //$vegitable_inventory->ccentre_id = Auth::user()->ccentre_id;
            $vegitable_inventory->ecentre_id = Auth::user()->ecentre_id;
            $vegitable_inventory->date = date('Y-m-d');
            $vegitable_inventory->veg_id = $request->veg_id[$i];
            $vegitable_inventory->quntity = $request->quntity[$i];
            $vegitable_inventory->price = $request->price[$i];
            $vegitable_inventory->status = 4;
            $vegitable_inventory->save();

          }
        }

        $order_id = 'ETO'.str_pad($code , 6, "0", STR_PAD_LEFT);
        Session::put('order_id', $order_id);

        $invoice_id = '#IETO'.str_pad($code , 6, "0", STR_PAD_LEFT);
        Session::put('invoice_id', $invoice_id);

/**********************************************************************/
         
        $notification = array(
           'message' => 'New Vegitable transfer record added successfully',
           'alert-type' => 'success'
        );

        return redirect()->route('transfer.market.invoice')->with($notification);

    }

    public function TransferMarketInvoiceGen()
    {   
        $ecenter = DB::table('users')
                  ->Join('economic_centres','economic_centres.id','=','users.ecentre_id')
                  ->where('users.ecentre_id',Auth::user()->ecentre_id)
                  ->where('users.role','=','EC-Officer')
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

        return view('backend.inventory.ecentre.invoice_transfer',compact('ecenter','orders','order_id','invoice_id','total_price'));
    }


     public function TransferMarketPaymentStore(Request $request){
 
        Payment::insert([
            'order_id' => $request->order_id,
            'invoice_id' => $request->invoice_id,
            'total_payment' => $request->total_payment,
            'net_payment' => $request->net_payment,
            'payment_type' => 0,
            'date' => date('Y-m-d'),
            'from' => $request->from,
            'status' => 6,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

         
        $notification = array(
           'message' => 'New payment completed Successfully',
           'alert-type' => 'success'
        );

        return redirect()->route('product.summary.ecentre')->with($notification);

    }


}
