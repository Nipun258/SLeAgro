<?php

namespace App\Http\Controllers\Backend\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BuyerProduct;
use App\Models\Vegitable;
use Illuminate\Support\Carbon;
use Auth;
use Illuminate\Support\Facades\DB;

class BuyerProductController extends Controller
{
   
   public function __construct(){
      
      $this->middleware('auth');

    }

    public function BuyerProductView()
    {    

        $buyer_products   = DB::table('buyer_products')
                        ->Join('vegitables','buyer_products.product','=','vegitables.id')
                        ->where('buyer_id', Auth::user()->id)
                        ->select('buyer_products.id','buyer_products.quantity','vegitables.name','buyer_products.type_id')
                        ->get();

        return view('backend.buyer.product.index', compact('buyer_products'));
    }

    public function BuyerProductAdd()
    {
      $data['vegitable'] = Vegitable::get(["name", "id"]);
      return view('backend.buyer.product.add',$data);
    }

    public function BuyerProductStore(Request $request){

        $validatedData = $request->validate([
            'veg_id' => 'required',
            'quantity' => 'required|numeric|min:10',
            'type_id' => 'required',
        ],[
            'quantity.min' => 'Request need at least 10kg of each Product'

        ]);
 
        BuyerProduct::insert([
            'buyer_id' => Auth::user()->id,
            'product' => $request->veg_id,
            'quantity' => $request->quantity,
            'type_id' => $request->type_id,
            'created_at' => Carbon::now()
        ]);
         
        $notification = array(
           'message' => 'New Buyer product Request Added Successfully',
           'alert-type' => 'success'
        );

        return redirect()->route('buyer.product.view')->with($notification);

    }

    public function BuyerProductEdit($id){

        $buyer_products = BuyerProduct::find($id);
        $vegitable = Vegitable::get(["name", "id"]);
        return view('backend.buyer.product.edit',compact('buyer_products','vegitable'));

    }

    public function BuyerProductUpdate(Request $request, $id){
        
      $validatedData = $request->validate([
            'veg_id' => 'required',
            'quantity' => 'required|numeric|min:10',
            'type_id' => 'required',
        ],[
            'quantity.min' => 'Request need at least 10kg of each Product'

        ]);

      BuyerProduct::find($id)->update([

            'buyer_id' => Auth::user()->id,
            'product' => $request->veg_id,
            'quantity' => $request->quantity,
            'type_id' => $request->type_id,
            'created_at' => Carbon::now()
      ]);

            $notification = array(
                'message' => 'Buyer product Request data Updated Successfully',
                'alert-type' => 'info'
            );    
             
             return redirect()->route('buyer.product.view')->with($notification);

    }

    public function BuyerProductDelete($id){

        $buyer_products = BuyerProduct::find($id);
        $buyer_products->delete();

        $notification = array(
           'message' => 'FBuyer product Request data Deleted Successfully',
           'alert-type' => 'error'
        );

        return redirect()->route('buyer.product.view')->with($notification);
    } 
}
