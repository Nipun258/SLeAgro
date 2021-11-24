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
use App\Mail\ProductTransferMail;
use App\Mail\PaymentTransferMail;
use Illuminate\Support\Facades\Mail;

class ProductiTransferController extends Controller
{
    public function __construct(){
      
      $this->middleware('auth');

    }

    public function ProductTransferEcenterView()
    {   

        $orders = DB::table('inventories')
                ->Join('vegitables','vegitables.id','=','inventories.veg_id')
                ->Join('collection_centres','collection_centres.id','=','inventories.ccentre_id')
                ->where('inventories.status',0)
                ->where('inventories.ccentre_id',Auth::user()->ccentre_id)
                ->select('vegitables.name','vegitables.id',DB::raw('SUM(inventories.quntity) as count'),DB::raw('SUM(inventories.price) as total'))
                ->groupBy('inventories.veg_id','vegitables.name','vegitables.id')
                ->get();
        //dd($orders);
        return view('backend.inventory.ccentre.transfer',compact('orders'));
    }

    public function ProductTransferEcenterStore(Request $request){

        Session::forget('order_id');
        Session::forget('invoice_id');

        $vegitable_list = count($request->veg_id);
        if ($vegitable_list != NULL) {

            $code= rand(1000,9999);

          for($i=0; $i < $vegitable_list; $i++) {

            $vegitable_inventory = new Inventory();
            $vegitable_inventory->order_id = 'NTO'.str_pad($code , 6, "0", STR_PAD_LEFT);
            $vegitable_inventory->invoice_id = '#INTO'.str_pad($code , 6, "0", STR_PAD_LEFT);
            $vegitable_inventory->user_id = Auth::user()->id;
            $vegitable_inventory->ccentre_id = Auth::user()->ccentre_id;
            $vegitable_inventory->ecentre_id = Auth::user()->ecentre_id;
            $vegitable_inventory->date = date('Y-m-d');
            $vegitable_inventory->veg_id = $request->veg_id[$i];
            $vegitable_inventory->quntity = $request->quntity[$i];
            $vegitable_inventory->price = $request->price[$i];
            $vegitable_inventory->status = 2;
            $vegitable_inventory->save();

          }
        }

        $order_id = 'NTO'.str_pad($code , 6, "0", STR_PAD_LEFT);
        Session::put('order_id', $order_id);

        $invoice_id = '#INTO'.str_pad($code , 6, "0", STR_PAD_LEFT);
        Session::put('invoice_id', $invoice_id);

        Inventory::where('ccentre_id',Auth::user()->ccentre_id)
              ->where('status',0)
              ->update(['status'=> 3]);
/**********************************************************************/
        $ecenter = DB::table('users')
                  ->Join('economic_centres','economic_centres.id','=','users.ecentre_id')
                  ->where('users.ecentre_id',Auth::user()->ecentre_id)
                  ->where('users.role','=','EC-Officer')
                  ->select('users.email')
                  ->get();

        $ecenter =json_decode($ecenter,true);
        $ecenter_mail=$ecenter[0]["email"];
/**********************************************************************/
        $ecenter = DB::table('users')
                  ->Join('economic_centres','economic_centres.id','=','users.ecentre_id')
                  ->where('users.ecentre_id',Auth::user()->ecentre_id)
                  ->where('users.role','=','EC-Officer')
                  ->select('economic_centres.centre_name')
                  ->get();

        $ecenter =json_decode($ecenter,true);
        $ecenter_name=$ecenter[0]["centre_name"];
/**********************************************************************/
       $ccenter = DB::table('users')
                  ->Join('collection_centres','collection_centres.id','=','users.ccentre_id')
                  ->where('users.id',Auth::user()->id)
                  ->select('collection_centres.centre_name')
                  ->get();
        $ccenter =json_decode($ccenter,true);
        $ccenter_name=$ccenter[0]["centre_name"];

        $data1 = [
               'from' => $ccenter_name,
               'to' => $ecenter_name,
               'date' => date('Y-m-d')
            ];
        
       $mail = new ProductTransferMail($data1);
    
       Mail::to($ecenter_mail)->send($mail);
         
        $notification = array(
           'message' => 'New Vegitable transfer record added successfully',
           'alert-type' => 'success'
        );

        return redirect()->route('transfer.invoice')->with($notification);

    }

    public function TransferInvoiceGen()
    {   

        $ccenter = DB::table('users')
                  ->Join('collection_centres','collection_centres.id','=','users.ccentre_id')
                  ->where('users.id',Auth::user()->id)
                  ->select('users.name','users.mobile','users.email','users.address','collection_centres.centre_name','users.id')
                  ->get();

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

        return view('backend.inventory.ccentre.invoice_transfer',compact('ccenter','ecenter','orders','order_id','invoice_id','total_price'));
    }

    public function TransferPaymentStore(Request $request){
 
        Payment::insert([
            'order_id' => $request->order_id,
            'invoice_id' => $request->invoice_id,
            'total_payment' => $request->total_payment,
            'net_payment' => $request->net_payment,
            'payment_type' => 0,
            'date' => date('Y-m-d'),
            'from' => $request->from,
            'to' => $request->to,
            'status' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        $data = [

            'order_id' => $request->order_id,
            'invoice_id' => $request->invoice_id,
            'net_payment' => $request->net_payment,
            'date' => date('Y-m-d'),
            'ecentre' => $request->ecentre,
            'ccentre' => $request->ccentre,
        ];
    
       $mail = new PaymentTransferMail($data);
    
       Mail::to($request->email)->send($mail);
         
        $notification = array(
           'message' => 'New payment completed Successfully',
           'alert-type' => 'success'
        );

        return redirect()->route('product.summary')->with($notification);

    }

}
