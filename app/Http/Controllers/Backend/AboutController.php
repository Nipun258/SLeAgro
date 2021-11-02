<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutUs;
use Illuminate\Support\Carbon;

class AboutController extends Controller
{       
    public function __construct(){
      
      $this->middleware('auth');

    }
    public function AboutView()
    {
    	$abouts = AboutUs::latest()->get();
        return view('backend.setup.about.index', compact('abouts'));
    }

    public function AboutEdit($id){
        $about = AboutUs::find($id);
        return view('backend.setup.about.edit',compact('about'));

    }

    public function AboutUpdate(Request $request,$id){
       
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

        return redirect()->route('about.view')->with($notification);
    }
}
