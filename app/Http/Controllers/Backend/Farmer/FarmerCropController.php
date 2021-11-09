<?php

namespace App\Http\Controllers\Backend\Farmer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FarmerCrop;
use App\Models\Vegitable;
use Illuminate\Support\Carbon;
use Auth;
use Illuminate\Support\Facades\DB;

class FarmerCropController extends Controller
{
    public function __construct(){
      
      $this->middleware('auth');

    }

    public function FarmerLandView()
    {    

        $farmer_lands   = DB::table('farmer_crops')
                        ->Join('vegitables','farmer_crops.product','=','vegitables.id')
                        ->where('farmer_id', Auth::user()->id)
                        ->select('farmer_crops.id','farmer_crops.area','vegitables.name')
                        ->get();

        //$farmer_lands = FarmerCrop::where('farmer_id', '=', Auth::user()->id)->get();
        return view('backend.farmer.crop.index', compact('farmer_lands'));
    }

    public function FarmerLandAdd()
    {
      $data['vegitable'] = Vegitable::get(["name", "id"]);
      return view('backend.farmer.crop.add',$data);
    }

    public function FarmerLandStore(Request $request){

        $validatedData = $request->validate([
            'veg_id' => 'required',
            'land_perch' => 'required',
        ]);
 
        FarmerCrop::insert([
            'farmer_id' => Auth::user()->id,
            'product' => $request->veg_id,
            'area' => $request->land_perch + $request->land_acre*160,
            'created_at' => Carbon::now()
        ]);
         
        $notification = array(
           'message' => 'New Farmer Crop Land Added Successfully',
           'alert-type' => 'success'
        );

        return redirect()->route('farmer.land.view')->with($notification);

    }
     
     public function FarmerLandEdit($id){

        $farmer_lands = FarmerCrop::find($id);
        $vegitable = Vegitable::get(["name", "id"]);
        return view('backend.farmer.crop.edit',compact('farmer_lands','vegitable'));

    }

    public function FarmerLandUpdate(Request $request, $id){
        
      $validatedData = $request->validate([
            'veg_id' => 'required',
            //'land_perch' => 'required',
        ]);

      FarmerCrop::find($id)->update([

            'farmer_id' => Auth::user()->id,
            'product' => $request->veg_id,
            'area' => $request->land_perch + $request->land_acre*160,
            'created_at' => Carbon::now()
      ]);

            $notification = array(
                'message' => 'Farmer Crop Land data Updated Successfully',
                'alert-type' => 'info'
            );    
             
             return redirect()->route('farmer.land.view')->with($notification);

    } 

    public function FarmerLandDelete($id){

        $crop_lands = FarmerCrop::find($id);
        $crop_lands->delete();

        $notification = array(
           'message' => 'Farmer Crop Land data Deleted Successfully',
           'alert-type' => 'error'
        );

        return redirect()->route('farmer.land.view')->with($notification);
    }
}
