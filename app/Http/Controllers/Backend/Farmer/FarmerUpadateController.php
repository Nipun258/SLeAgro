<?php

namespace App\Http\Controllers\Backend\Farmer;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Branch;
use App\Models\CollectionCentre;
use App\Models\EconomicCentre;
use App\Models\Farmer;
use App\Models\Provice;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;


class FarmerUpadateController extends Controller {
	
	public function __construct() {

		$this->middleware('auth');

	}

	public function FarmerSetup() {

		$id = Auth::user()->id;
		$ecenter = EconomicCentre::get(["centre_name", "id"]);
		$province = Provice::get(["name_en", "id"]);
		$bank = Bank::get(["strBankCode", "strBankName"]);
		$editData = User::find($id);

		return view('backend.farmer.profile.setup', compact('editData', 'ecenter', 'province', 'bank'));
	}

	public function FarmerEdit() {

		$id = Auth::user()->id;
		$ecenter = EconomicCentre::get(["centre_name", "id"]);
		$province = Provice::get(["name_en", "id"]);
		$bank = Bank::get(["strBankCode", "strBankName"]);
		$farmer = Farmer::where('user_id', '=', $id)->first();
		$editData = User::find($id);

		return view('backend.farmer.profile.edit', compact('editData', 'ecenter', 'province', 'bank','farmer'));
	}

	public function fetchCollectionCentre(Request $request) {
		$data['collection_centres'] = CollectionCentre::where("economic_centre_id", $request->economic_centre_id)->get(["centre_name", "id"]);

		return response()->json($data);
	}

	public function fetchBankBranch(Request $request) {
		$data['bank_branches'] = Branch::where("strBankCode", $request->bank_code)->get(["strBranchLocation", "strBranchCode"]);

		return response()->json($data);
	}

	public function FarmerStore(Request $request) {
		$validatedData = $request->validate([

			'mobile' => 'required|min:10',
			'address' => 'required|string|max:255',
			'gender' => 'required',
			'nic' => 'required|min:9|max:12',
			'ecentre' => 'required',
			'ccentre' => 'required',
			'province' => 'required',
			'district' => 'required',
			'city' => 'required',
			'pass_name' => 'required',
			'account_number' => 'required',
			'bank' => 'required',
			'branch' => 'required',

		]);

		$data = User::find(Auth::user()->id);
		$data->mobile = $request->mobile;
		$data->address = $request->address;
		$data->gender = $request->gender;
		$data->ccentre_id = $request->ccentre;
		$data->ecentre_id = $request->ecentre;
		$data->save();

		/*******************************************/

		
		$farmer1 = Farmer::where('user_id', '=', Auth::user()->id)->first();

		if (empty($farmer1)) {
            
			$farmer = new Farmer();
			$farmer->user_id = Auth::user()->id;
			$farmer->nic = $request->nic;
			$farmer->province_id = $request->province;
			$farmer->district_id = $request->district;
			$farmer->city_id = $request->city;
			$farmer->pass_name = $request->pass_name;
			$farmer->account_number = $request->account_number;
			$farmer->bank_id = $request->bank;
			$farmer->branch_id = $request->branch;
	
			if ($request->file('image')) {
	
				$file = $request->file('image');
				@unlink(public_path('upload/bank_pass_book' . $farmer->image));
				$filename = date('YmdHi') . $file->getClientOriginalName();
				$file->move(public_path('upload/bank_pass_book'), $filename);
				$farmer->image = $filename;
	
			}
	
			$farmer->save();

		}else{

			$farmer = Farmer::where('user_id', '=', Auth::user()->id)->first();
			$farmer->nic = $request->nic;
			$farmer->province_id = $request->province;
			$farmer->district_id = $request->district;
			$farmer->city_id = $request->city;
			$farmer->pass_name = $request->pass_name;
			$farmer->account_number = $request->account_number;
			$farmer->bank_id = $request->bank;
			$farmer->branch_id = $request->branch;
	
			if ($request->file('image')) {
	
				$file = $request->file('image');
				@unlink(public_path('upload/bank_pass_book' . $farmer->image));
				$filename = date('YmdHi') . $file->getClientOriginalName();
				$file->move(public_path('upload/bank_pass_book'), $filename);
				$farmer->image = $filename;
	
			}
	
			$farmer->save();
		}



		$notification = array(
			'message' => 'Farmer Detials Setup Successfully',
			'alert-type' => 'success',
		);

		return redirect()->route('profile.view')->with($notification);
	}

	public function FarmerUpdate(Request $request) {
		
		$validatedData = $request->validate([

			'mobile' => 'required|min:10',
			'address' => 'required|string|max:255',
			'gender' => 'required',
			'nic' => 'required|min:9|max:12',
			'ecentre' => 'required',
			'ccentre' => 'required',
			'province' => 'required',
			'district' => 'required',
			'city' => 'required',
			'pass_name' => 'required',
			'account_number' => 'required',
			'bank' => 'required',
			'branch' => 'required',

		]);

		$data = User::find(Auth::user()->id);
		$data->mobile = $request->mobile;
		$data->address = $request->address;
		$data->gender = $request->gender;
		$data->ccentre_id = $request->ccentre;
		$data->ecentre_id = $request->ecentre;

		$data->save();

		/*******************************************/

			$farmer = Farmer::where('user_id', '=', Auth::user()->id)->first();
			$farmer->nic = $request->nic;
			$farmer->province_id = $request->province;
			$farmer->district_id = $request->district;
			$farmer->city_id = $request->city;
			$farmer->pass_name = $request->pass_name;
			$farmer->account_number = $request->account_number;
			$farmer->bank_id = $request->bank;
			$farmer->branch_id = $request->branch;
	
			if ($request->file('image')) {
	
				$file = $request->file('image');
				@unlink(public_path('upload/bank_pass_book' . $farmer->image));
				$filename = date('YmdHi') . $file->getClientOriginalName();
				$file->move(public_path('upload/bank_pass_book'), $filename);
				$farmer->image = $filename;
	
			}
	
			$farmer->save();



		$notification = array(
			'message' => 'Farmer Detials Update Successfully',
			'alert-type' => 'info',
		);

		return redirect()->route('profile.view')->with($notification);
	}


}
