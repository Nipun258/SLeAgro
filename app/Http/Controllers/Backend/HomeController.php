<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Carbon;
use Image;
use Auth;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{   
    public function __construct(){
      
      $this->middleware('auth');

    }
    
    public function SliderView()
    {   
        Log::info('HomeController -> SliderView started');
    	$sliders = Slider::latest()->get();
        Log::info('HomeController -> SliderView Count - ' . $sliders->count());
        Log::info('HomeController -> SliderView ended');
        return view('backend.setup.slider.index', compact('sliders'));
    }

     public function SliderAdd()
    {   
        Log::info('HomeController -> SliderAdd started');
    	return view('backend.setup.slider.add');
        Log::info('HomeController -> SliderAdd ended');
    }

    public function SliderStore(Request $request){
        
        Log::info('HomeController -> SliderStore started');
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

        Log::info('HomeController -> Craete New Home Slider created_at - ' . Carbon::now());
        Log::info('HomeController -> SliderStore ended');

        return redirect()->route('slider.view')->with($notification);

    }

     public function SliderEdit($id){

        Log::info('HomeController -> SliderEdit started');
        $sliders = Slider::find($id);
        Log::info('HomeController -> Slider edit with id - ' . $id);
        Log::info('HomeController -> SliderEdit ended');
        return view('backend.setup.slider.edit',compact('sliders'));

    }

 public function SliderUpdate(Request $request, $id){
        
        Log::info('HomeController -> SliderUpdate started');
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

        Log::info('HomeController -> Slider edit with image with id - ' .$id);
        Log::info('HomeController -> SliderUpdate ended');

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

            Log::info('HomeController -> Slider edit without image with id - ' .$id);
            Log::info('HomeController -> SliderUpdate ended');    
             
             return redirect()->route('slider.view')->with($notification);

        } 
    }

    public function SliderDelete($id){
        
        Log::info('HomeController -> SliderDelete started');
        $sliders = Slider::find($id);
        $sliders->delete();

        $notification = array(
           'message' => 'Home Slider Deleted Successfully',
           'alert-type' => 'error'
        );
        Log::alert('HomeController -> Delete Slider Id With - ' .$id);
        Log::info('HomeController -> SliderDelete ended');

        return redirect()->route('slider.view')->with($notification);
    }
}
