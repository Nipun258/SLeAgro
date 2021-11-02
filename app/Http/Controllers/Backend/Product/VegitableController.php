<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vegitable;
use Illuminate\Support\Carbon;
use Image;

class VegitableController extends Controller
{
     public function VegitableView()
    {
    	$vegitables = Vegitable::latest()->get();
        return view('backend.product.vegitable_list.index', compact('vegitables'));
    }

      public function VegitableAdd()
    {
    	return view('backend.product.vegitable_list.add');
    }

    public function VegitableStore(Request $request){

        $validatedData = $request->validate([
            'name' => 'required',
            'catagory' => 'required',
            'total_area' => 'required',
            'total_producation' => 'required',
        ]);


        $vegitable_image =  $request->file('image');

       
        $name_gen = hexdec(uniqid()).'.'.$vegitable_image->getClientOriginalExtension();
        Image::make($vegitable_image)->resize(240,150)->save('upload/vegitable_images/'.$name_gen);

        $last_img = 'upload/vegitable_images/'.$name_gen;
 
        Vegitable::insert([
            'name' => $request->name,
            'catagory' => $request->catagory,
            'total_area' => $request->total_area,
            'total_producation' => $request->total_producation,
            'annual_crop_count' => $request->annual_crop_count,
            'image' => $last_img,
            'short_dis' => $request->short_dis,
            'created_at' => Carbon::now()
        ]);
         
        $notification = array(
           'message' => 'New Vegitable Added Successfully',
           'alert-type' => 'success'
        );

        return redirect()->route('vegitable.view')->with($notification);

    }

    public function VegitableEdit($id){
        $vegitables = Vegitable::find($id);
        return view('backend.product.vegitable_list.edit',compact('vegitables'));

    }

    public function VegitableUpdate(Request $request, $id){

        $old_image = $request->old_image;

        $image =  $request->file('image');

        if($image){
        
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($image->getClientOriginalExtension());
        $img_name = $name_gen.'.'.$img_ext;
        $up_location = 'upload/vegitable_images/';
        $last_img = $up_location.$img_name;
        $image->move($up_location,$img_name);

        unlink($old_image);
        Vegitable::find($id)->update([
            'name' => $request->name,
            'catagory' => $request->catagory,
            'total_area' => $request->total_area,
            'total_producation' => $request->total_producation,
            'annual_crop_count' => $request->annual_crop_count,
            'image' => $last_img,
            'short_dis' => $request->short_dis,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Vegitable Details Updated Successfully',
            'alert-type' => 'info'
        );         
         return redirect()->route('vegitable.view')->with($notification);

        }else{
            Vegitable::find($id)->update([
            'name' => $request->name,
            'catagory' => $request->catagory,
            'total_area' => $request->total_area,
            'total_producation' => $request->total_producation,
            'annual_crop_count' => $request->annual_crop_count,
            'short_dis' => $request->short_dis,
            'created_at' => Carbon::now()

            ]);

            $notification = array(
                'message' => 'Vegitable Details Updated Successfully',
                'alert-type' => 'warning'
            );    
             
             return redirect()->route('vegitable.view')->with($notification);

        } 
    }

    public function VegitableDelete($id){

        $vegitables = Vegitable::find($id);
        $vegitables->delete();

        $notification = array(
           'message' => 'Vegitable Details Deleted Successfully',
           'alert-type' => 'error'
        );

        return redirect()->route('vegitable.view')->with($notification);
    }
}
