<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vegitable;
use App\Models\VegitablePrice;
use Illuminate\Support\Facades\DB; //query builder in here

class CalculaorController extends Controller
{
       public function CalculatorView()
    {   
    	$data['vegitable'] = Vegitable::get(["name", "id"]);

    	return view('backend.product.calculator.index',$data);
    }

    public function CalculatorResult(Request $request){

        $validatedData = $request->validate([
            'veg_id' => 'required',
            'area_perch' => 'required|numeric|min:0',
            'area_acre' => 'integer|min:0'
        ]);
 
        $veg_id = $request->veg_id;
        $area_acre = $request->area_acre;
        $area_perch = $request->area_perch;
        $name = Vegitable::where(['id'=> $veg_id])->value('name');
        $image = Vegitable::where(['id'=> $veg_id])->value('image');
        $total_area = Vegitable::where(['id'=> $veg_id])->value('total_area');
        $total_producation = Vegitable::where(['id'=> $veg_id])->value('total_producation');
        $annual_crop_count = Vegitable::where(['id'=> $veg_id])->value('annual_crop_count');
        $price_wholesale = VegitablePrice::where(['veg_id'=> $veg_id])->value('price_wholesale');

        if ($area_acre == 0 && empty($area_acre) && $area_perch != 0) {

        	$area = $area_perch;

        }elseif ($area_perch != 0 && $area_acre != 0 ) {
        	
        	$area = ($area_acre*160) + $area_perch;

        }elseif($area_perch == 0 && $area_acre != 0){

        	$area = $area_acre*160;
        }

        /***********************************************************/
        
        $unit_havest = (($total_producation*1000)/ $annual_crop_count)/($total_area*395.36861);

        $total_havest = round($unit_havest*$area,2);

        $total_price = $total_havest*$price_wholesale;


         
        return view('backend.product.calculator.result',compact('name','image','total_havest','area','total_price'));

    }

     public function PriceCalculatorView()
    {   
    	$data['vegitable'] = Vegitable::get(["name", "id"]);

    	return view('backend.product.price_calculator.index',$data);
    }

    public function PriceCalculatorResult(Request $request){

        $validatedData = $request->validate([
            'veg_id' => 'required',
            'product_harvest' => 'required|numeric|min:0',
        ]);
 
        $veg_id = $request->veg_id;
        $product_harvest = $request->product_harvest;
        $name = Vegitable::where(['id'=> $veg_id])->value('name');
        $image = Vegitable::where(['id'=> $veg_id])->value('image');
        $price_wholesale = VegitablePrice::where(['veg_id'=> $veg_id])->value('price_wholesale');

        /***********************************************************/
        

        $total_price = $product_harvest*$price_wholesale;


         
        return view('backend.product.price_calculator.result',compact('name','image','total_price','product_harvest'));

    }

    
}
