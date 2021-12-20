<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VegitablePrice;
use App\Models\OldVegPrice;
use App\Models\Vegitable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;//use query builder in here
use Illuminate\Support\Facades\Log;

class VegitablePriceController extends Controller
{
    public function VegitablePriceView()
    {
    	$data['vegitable_prices'] = DB::table('vegitable_prices')
                        ->Join('vegitables','vegitable_prices.veg_id','=','vegitables.id')
                        ->select('vegitable_prices.id','vegitable_prices.price_wholesale','vegitable_prices.price_location','vegitable_prices.price_retial','vegitables.name','vegitable_prices.price_date')
                        ->get();
                        
        Log::info('Vegitable price list ->get VegitablePriceView');
        log::info('Vegitable price list ->vegitable price count -' .$data['vegitable_prices']->count());
        log::info('Vegitable price list ->get VegitablePriceView Ended');
        return view('backend.product.vegitable_price.index',$data);
    }

     public function VegitablePriceAdd()
    {   
    	$data['vegitable'] = Vegitable::get(["name", "id"]);
    	//$data['ecenter'] = EconomicCentre::get(["centre_name", "id"]);
    	return view('backend.product.vegitable_price.add',$data);
    }

    public function VegitablePriceStore(Request $request){

        $validatedData = $request->validate([
            'veg_id' => 'required|unique:vegitable_prices',
            'price_wholesale' => 'required',
            'price_retial' => 'required',
            'price_location' => 'required',
        ],[

            'veg_id.unique' => 'This Vegetable Product Price Already Add to System'
        ]);
 
        VegitablePrice::insert([
            'veg_id' => $request->veg_id,
            'price_wholesale' => $request->price_wholesale,
            'price_retial' => $request->price_retial,
            'price_location' => $request->price_location,
            'price_date' => Carbon::today(),
            'created_at' => Carbon::now()
        ]);

        OldVegPrice::insert([
            'veg_id' => $request->veg_id,
            'price_wholesale' => $request->price_wholesale,
            'price_retial' => $request->price_retial,
            'price_location' => $request->price_location,
            'price_date' => Carbon::today(),
            'created_at' => Carbon::now()
        ]);
         
        $notification = array(
           'message' => 'New Vegitable Price Set Successfully',
           'alert-type' => 'success'
        );

        return redirect()->route('vegitable.price.view')->with($notification);

    }

    public function VegitablePriceEdit($id)
    {
        $editData = VegitablePrice::find($id);
        $vegitable = Vegitable::get(["name", "id"]);
        return view('backend.product.vegitable_price.edit',compact('editData','vegitable'));
    }

    public function VegitablePriceUpdate(Request $request,$id){
       
        $validatedData = $request->validate([
            'price_wholesale' => 'required',
            'price_retial' => 'required',
        ]);

        OldVegPrice::insert([
            'veg_id' => $request->veg_id,
            'price_wholesale' => $request->price_wholesale,
            'price_retial' => $request->price_retial,
            'price_location' => $request->price_location,
            'price_date' => Carbon::today(),
            'created_at' => Carbon::now()
        ]);

        VegitablePrice::find($id)->update([
            'veg_id' => $request->veg_id,
            'price_wholesale' => $request->price_wholesale,
            'price_retial' => $request->price_retial,
            'price_location' => $request->price_location,
            'price_date' => Carbon::today(),
            'created_at' => Carbon::now()

            ]);
        
        $notification = array(
           'message' => 'New vegitable Price Set Successfully',
           'alert-type' => 'info'
        );

        return redirect()->route('vegitable.price.view')->with($notification);
    }

    public function VegitablePriceDelete($id){

        $vegitableprice = VegitablePrice::find($id);
        $vegitableprice->delete();

        $notification = array(
           'message' => 'Vegitable Price Details Deleted Successfully',
           'alert-type' => 'error'
        );

        return redirect()->route('vegitable.price.view')->with($notification);
    }
}
