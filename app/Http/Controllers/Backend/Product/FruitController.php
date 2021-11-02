<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fruit;
use Illuminate\Support\Carbon;
use Image;

class FruitController extends Controller
{
       public function FruitView()
    {
    	$fruits = Fruit::latest()->get();
        return view('backend.product.fruit_list.index', compact('fruits'));
    }

    public function FruitAdd()
    {
    	return view('backend.product.fruit_list.add');
    }

    public function FruitStore(Request $request){

        $validatedData = $request->validate([
            'name' => 'required',
            'total_area' => 'required',
            'total_producation' => 'required',
            'annual_crop_count' => 'required',
        ]);


        $fruit_image =  $request->file('image');

       
        $name_gen = hexdec(uniqid()).'.'.$fruit_image->getClientOriginalExtension();
        Image::make($fruit_image)->resize(240,150)->save('upload/fruit_images/'.$name_gen);

        $last_img = 'upload/fruit_images/'.$name_gen;
 
        Fruit::insert([
            'name' => $request->name,
            'total_area' => $request->total_area,
            'total_producation' => $request->total_producation,
            'annual_crop_count' => $request->annual_crop_count,
            'image' => $last_img,
            'short_dis' => $request->short_dis,
            'created_at' => Carbon::now()
        ]);
         
        $notification = array(
           'message' => 'New Fruit Added Successfully',
           'alert-type' => 'success'
        );

        return redirect()->route('fruit.view')->with($notification);

    }

    public function FruitEdit($id){
        $fruits = Fruit::find($id);
        return view('backend.product.fruit_list.edit',compact('fruits'));

    }

    public function FruitUpdate(Request $request, $id){

        $old_image = $request->old_image;

        $image =  $request->file('image');

        if($image){
        
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($image->getClientOriginalExtension());
        $img_name = $name_gen.'.'.$img_ext;
        $up_location = 'upload/fruit_images/';
        $last_img = $up_location.$img_name;
        $image->move($up_location,$img_name);

        unlink($old_image);
        Fruit::find($id)->update([
            'name' => $request->name,
            'total_area' => $request->total_area,
            'total_producation' => $request->total_producation,
            'annual_crop_count' => $request->annual_crop_count,
            'image' => $last_img,
            'short_dis' => $request->short_dis,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Fruit Details Updated Successfully',
            'alert-type' => 'info'
        );         
         return redirect()->route('fruit.view')->with($notification);

        }else{
            Fruit::find($id)->update([
            'name' => $request->name,
            'total_area' => $request->total_area,
            'total_producation' => $request->total_producation,
            'annual_crop_count' => $request->annual_crop_count,
            'short_dis' => $request->short_dis,
            'created_at' => Carbon::now()

            ]);

            $notification = array(
                'message' => 'Fruit Details Updated Successfully',
                'alert-type' => 'warning'
            );    
             
             return redirect()->route('fruit.view')->with($notification);

        } 
    }

    public function FruitDelete($id){

        $fruits = Fruit::find($id);
        $fruits->delete();

        $notification = array(
           'message' => 'Fruit Details Deleted Successfully',
           'alert-type' => 'error'
        );

        return redirect()->route('fruit.view')->with($notification);
    }

}
