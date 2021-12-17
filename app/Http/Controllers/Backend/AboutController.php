<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutUs;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class AboutController extends Controller
{       
    public function __construct(){
      
      $this->middleware('auth');

    }
    public function AboutView()
    {   
        Log::info('AboutUsController -> getAll started');
    	$abouts = AboutUs::latest()->get();
        Log::info('AboutUsController -> AboutUs Count - ' . $abouts->count());
        Log::info('AboutUsController -> getAll ended');
        return view('backend.setup.about.index', compact('abouts'));
    }

    public function AboutEdit($id){
        Log::info('AboutUsController -> getAll started');
        $about = AboutUs::find($id);
         Log::info('AboutUsController -> edit Adout us id - ' . $about->id);
         Log::info('AboutUsController -> getAll ended');
        return view('backend.setup.about.edit',compact('about'));
        
    }

    public function AboutUpdate(Request $request,$id){
       
       Log::info('AboutUsController -> updateAboutus started');

        $validatedData = $request->validate([
            'discription' => 'required',
            'vision' => 'required',
            'mision' => 'required',
        ]);

        $data = AboutUs::find($id);
        $data->discription = $request->discription;
        $data->vision = $request->vision;
        $data->mision = $request->mision;
        $data->save();
        
        $notification = array(
           'message' => 'Home About Content Updated Successfully',
           'alert-type' => 'info'
        );

       Log::info('AboutUsController -> About Us data update id - ' . $id);
       Log::info('AboutUsController -> About us Content Update ended');

        return redirect()->route('about.view')->with($notification);
    }
}
