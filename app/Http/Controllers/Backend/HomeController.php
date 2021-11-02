<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Carbon;
use Image;
use Auth;

class HomeController extends Controller
{   
    public function __construct(){
      
      $this->middleware('auth');

    }
    
    public function SliderView()
    {
    	$sliders = Slider::latest()->get();
        return view('backend.setup.slider.index', compact('sliders'));
    }

     public function SliderAdd()
    {
    	return view('backend.setup.slider.add');
    }

    public function SliderStore(Request $request){

        $slider_image =  $request->file('image');

       
        $name_gen = hexdec(uniqid()).'.'.$slider_image->getClientOriginalExtension();
        Image::make($slider_image)->resize(1920,884)->save('upload/slider_images/'.$name_gen);

        $last_img = 'upload/slider_images/'.$name_gen;
 
        Slider::insert([
            'spectext' => $request->spectext,
            'text1' => $request->text1,
            'text2' => $request->text2,
            'image' => $last_img,
            'created_at' => Carbon::now()
        ]);
         
        $notification = array(
           'message' => 'Home Slider Added Successfully',
           'alert-type' => 'success'
        );

        return redirect()->route('slider.view')->with($notification);

    }

     public function SliderEdit($id){
        $sliders = Slider::find($id);
        return view('backend.setup.slider.edit',compact('sliders'));

    }

    public function SliderUpdate(Request $request, $id){

        $old_image = $request->old_image;

        $image =  $request->file('image');

        if($image){
        
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($image->getClientOriginalExtension());
        $img_name = $name_gen.'.'.$img_ext;
        $up_location = 'upload/slider_images/';
        $last_img = $up_location.$img_name;
        $image->move($up_location,$img_name);

        unlink($old_image);
        Slider::find($id)->update([
            'spectext' => $request->spectext,
            'text1' => $request->text1,
            'text2' => $request->text2,
            'image' => $last_img,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Slider Updated Successfully',
            'alert-type' => 'info'
        );         
         return redirect()->route('slider.view')->with($notification);

        }else{
            Slider::find($id)->update([
                'spectext' => $request->spectext,
                'text1' => $request->text1,
                'text2' => $request->text2,
                'created_at' => Carbon::now()
            ]);
            $notification = array(
                'message' => 'Slider Updated Successfully',
                'alert-type' => 'warning'
            );    
             
             return redirect()->route('slider.view')->with($notification);

        } 
    }

    public function SliderDelete($id){

        $sliders = Slider::find($id);
        $sliders->delete();

        $notification = array(
           'message' => 'Home Slider Deleted Successfully',
           'alert-type' => 'error'
        );

        return redirect()->route('slider.view')->with($notification);
    }
}


// Fresh vegetables & fruits
// Freshly grown for customers

// Farmer can sell
// vegetable & fruit Product
// directly from the farm