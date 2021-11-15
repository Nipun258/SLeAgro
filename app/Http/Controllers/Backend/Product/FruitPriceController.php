<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FruitPrice;
use App\Models\Fruit;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;//use query builder in here
use Illuminate\Support\Facades\Notification;
use App\Notifications\PriceSet;

class FruitPriceController extends Controller
{
        public function FruitPriceView()
    {
    	$data['fruit_prices'] = DB::table('fruit_prices')
                        ->Join('fruits','fruit_prices.fruit_id','=','fruits.id')
                        ->select('fruit_prices.id','fruit_prices.price_wholesale','fruit_prices.price_location','fruit_prices.price_retial','fruits.name')
                        ->get();

        return view('backend.product.fruit_price.index',$data);
    }

    public function FruitPriceAdd()
    {   
    	$data['fruit'] = Fruit::get(["name", "id"]);
    	// $data['ecenter'] = EconomicCentre::get(["centre_name", "id"]);
    	return view('backend.product.fruit_price.add',$data);
    }

    public function FruitPriceStore(Request $request){

        $validatedData = $request->validate([
            'fruit_id' => 'required|unique:fruit_prices',
            'price_wholesale' => 'required',
            'price_retial' => 'required',
            'price_location' => 'required',
        ]);
 
        FruitPrice::insert([
            'fruit_id' => $request->fruit_id,
            'price_wholesale' => $request->price_wholesale,
            'price_retial' => $request->price_retial,
            'price_location' => $request->price_location,
            'price_date' => Carbon::today(),
            'created_at' => Carbon::now()
        ]);

        /**************************************************/

        $farmer = User::where('usertype','Farmer')->get();

        $priceData = 
              [
                'body' => 'New Vegitable added to system',
                'discription' => 'you can sell your vegitable product using SleAgro platform',
                'url' => url('/')
              ];
         //$farmer->notify(new PriceSet($priceData));
        Notification::send($farmer, new PriceSet($priceData));
         
         /******************************************************************/
        $notification = array(
           'message' => 'New Fruit Price Set Successfully',
           'alert-type' => 'success'
        );

        return redirect()->route('fruit.price.view')->with($notification);

    }

        public function FruitPriceEdit($id)
    {
        $editData = FruitPrice::find($id);
        $fruit = Fruit::get(["name", "id"]);
        return view('backend.product.fruit_price.edit',compact('editData','fruit'));
    }

    public function FruitPriceUpdate(Request $request,$id){
       
        $validatedData = $request->validate([
            'price_wholesale' => 'required',
            'price_retial' => 'required',
        ]);

        FruitPrice::find($id)->update([
            'fruit_id' => $request->fruit_id,
            'price_wholesale' => $request->price_wholesale,
            'price_retial' => $request->price_retial,
            'price_location' => $request->price_location,
            'price_date' => Carbon::today(),
            'created_at' => Carbon::now()

            ]);
        
        $notification = array(
           'message' => 'New fruit Price Set Successfully',
           'alert-type' => 'info'
        );

        return redirect()->route('fruit.price.view')->with($notification);
    }

    public function FruitPriceDelete($id){

        $fruitprice = FruitPrice::find($id);
        $fruitprice->delete();

        $notification = array(
           'message' => 'fruit Price Details Deleted Successfully',
           'alert-type' => 'error'
        );

        return redirect()->route('fruit.price.view')->with($notification);
    }

}
