<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\AboutController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\QuestionController;
use App\Http\Controllers\Backend\ContactFormController;
use App\Http\Controllers\Backend\SummaryController;
use App\Http\Controllers\Backend\Centre\EconomicCenterController;
use App\Http\Controllers\Backend\Centre\CollectionCentreController;
use App\Http\Controllers\Backend\Product\VegitableController;
use App\Http\Controllers\Backend\Product\VegitablePriceController;
use App\Http\Controllers\Backend\Product\FruitController;
use App\Http\Controllers\Backend\Product\FruitPriceController;
use App\Http\Controllers\Backend\Product\CalculaorController;
use App\Http\Controllers\Backend\Farmer\FarmerUpadateController;
use App\Http\Controllers\Backend\Farmer\FarmerCropController;
use App\Http\Controllers\Backend\Buyer\BuyerUpdateController;
use App\Http\Controllers\Backend\Buyer\BuyerProductController;
use Illuminate\Support\Facades\DB; //query builder in here
use App\Mail\registerMail;
use Illuminate\Support\Facades\Mail;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'prevent-back-history'],function(){


Route::get('/', function () {

	$abouts = DB::table('about_us')->first();
	$contacts = DB::table('contact_us')->first();
    return view('layouts.master_home',compact('abouts','contacts'));

})->name('home');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {

     return view('admin.index');

})->name('dashboard');


//test query 
Route::get('/test',[SummaryController::class, 'test'])->name('test');

Route::group(['middleware' => 'auth'],function(){

//Admin logout 
Route::get('/admin/logout',[ AdminController::class, 'Logout'])->name('admin.logout');


Route::get('/dashboard',[SummaryController::class, 'getVegData'])->name('dashboard');

/*****************************user mangement ***********************/


Route::group(['middleware' => 'admin'],function(){

Route::prefix('users')->group(function(){

	Route::get('/view',[UserController::class, 'UserView'])->name('user.view');

	Route::get('/add',[UserController::class, 'UserAdd'])->name('user.add');

	Route::post('/store',[UserController::class, 'UserStore'])->name('user.store');

	Route::get('/edit/{id}',[UserController::class, 'UserEdit'])->name('user.edit');

	Route::post('/update/{id}',[UserController::class, 'UserUpdate'])->name('user.update');

	Route::get('/delete/{id}',[UserController::class, 'UserDelete'])->name('user.delete');

   });//user controller route list

});
/*****************************user profile and change the password***********************/

Route::prefix('profile')->group(function(){

	Route::get('/view',[ProfileController::class, 'ProfileView'])->name('profile.view');

	Route::get('/edit',[ProfileController::class, 'ProfileEdit'])->name('profile.edit');

	Route::post('/store',[ProfileController::class, 'ProfileStore'])->name('profile.store');

	Route::get('/password/view',[ProfileController::class, 'PasswordView'])->name('password.view');
	
	Route::post('/password/update',[ProfileController::class, 'PasswordUpdate'])->name('password.update');

});

Route::group(['middleware' => 'admin'],function(){

Route::prefix('centres')->group(function(){

	Route::get('economic/centre/view',[EconomicCenterController::class, 'EconomicCentreView'])->name('ecomomic.centre.view');

	 Route::get('economic/centre/add',[EconomicCenterController::class, 'EconomicCentreAdd'])->name('ecomomic.centre.add');

	Route::post('economic/centre/store',[EconomicCenterController::class, 'EconomicCentreStore'])->name('ecomomic.centre.store');

	Route::get('economic/centre/edit/{id}',[EconomicCenterController::class, 'EconomicCentreEdit'])->name('ecomomic.centre.edit');

	Route::post('economic/centre/update/{id}',[EconomicCenterController::class, 'EconomicCentreUpdate'])->name('ecomomic.centre.update');

	Route::get('economic/centre/delete/{id}',[EconomicCenterController::class, 'EconomicCentreDelete'])->name('ecomomic.centre.delete');

	/********************************************************************************/

	Route::get('collection/centre/view',[CollectionCentreController::class, 'CollectionCentreView'])->name('collection.centre.view');

	 Route::get('collection/centre/add',[CollectionCentreController::class, 'CollectionCentreAdd'])->name('collection.centre.add');

	Route::post('collection/centre/store',[CollectionCentreController::class, 'CollectionCentreStore'])->name('collection.centre.store');

	Route::get('collection/centre/edit/{id}',[CollectionCentreController::class, 'CollectionCentreEdit'])->name('collection.centre.edit');

	Route::post('collection/centre/update/{id}',[CollectionCentreController::class, 'CollectionCentreUpdate'])->name('collection.centre.update');

	Route::get('collection/centre/delete/{id}',[CollectionCentreController::class, 'CollectionCentreDelete'])->name('collection.centre.delete');

   });//economic centre and collection centre routes

});
     /******************************Dynamic drop down data fetch***********************************/
	 Route::post('api/fetch-districts', [EconomicCenterController::class, 'fetchDistrict']);

     Route::post('api/fetch-cities', [EconomicCenterController::class, 'fetchCity']);

     Route::post('api/fetch-collection_centres', [FarmerUpadateController::class, 'fetchCollectionCentre']);

     Route::post('api/fetch-bank_branches', [FarmerUpadateController::class, 'fetchBankBranch']);

     /**************************************************************************************/
Route::group(['middleware' => 'admin'],function(){

   Route::prefix('setups')->group(function(){

	Route::get('/slider/view',[HomeController::class, 'SliderView'])->name('slider.view');

	Route::get('/slider/add',[HomeController::class, 'SliderAdd'])->name('slider.add');

	Route::post('/slider/store',[HomeController::class, 'SliderStore'])->name('slider.store');

	Route::get('/slider/edit/{id}',[HomeController::class, 'SliderEdit'])->name('slider.edit');

	Route::post('/slider/update/{id}',[HomeController::class, 'SliderUpdate'])->name('slider.update');

	Route::get('/slider/delete/{id}',[HomeController::class, 'SliderDelete'])->name('slider.delete');

    /************************************************************************/

    Route::get('/about/view',[AboutController::class, 'AboutView'])->name('about.view');

	// Route::get('/about/add',[AboutController::class, 'AboutAdd'])->name('about.add');

	// Route::post('/about/store',[AboutController::class, 'AboutStore'])->name('about.store');

	Route::get('/about/edit/{id}',[AboutController::class, 'AboutEdit'])->name('about.edit');

	Route::post('/about/update/{id}',[AboutController::class, 'AboutUpdate'])->name('about.update');

	// Route::get('/about/delete/{id}',[AboutController::class, 'AboutDelete'])->name('about.delete');

	/**********************************************************************************/

	Route::get('/contact/view',[ContactController::class, 'ContactView'])->name('contact.view');

	Route::get('/contact/edit/{id}',[ContactController::class, 'ContactEdit'])->name('contact.edit');

	Route::post('/contact/update/{id}',[ContactController::class, 'ContactUpdate'])->name('contact.update');
    
    /*************************************************************************************/

    Route::get('/question/view',[QuestionController::class, 'QuestionView'])->name('question.view');

	Route::get('/question/add',[QuestionController::class, 'QuestionAdd'])->name('question.add');

	Route::post('/question/store',[QuestionController::class, 'QuestionStore'])->name('question.store');

	Route::get('/question/edit/{id}',[QuestionController::class, 'QuestionEdit'])->name('question.edit');

	Route::post('/question/update/{id}',[QuestionController::class, 'QuestionUpdate'])->name('question.update');

	Route::get('/question/delete/{id}',[QuestionController::class, 'QuestionDelete'])->name('question.delete');

     });//font end setting controlling route list

});
/*************************************************************************************/
Route::group(['middleware' => 'admin'],function(){

   Route::prefix('messages')->group(function(){

    Route::get('/contact/message/view',[ContactFormController::class, 'ContactMessageView'])->name('contact.message.view');

    Route::post('/contact/message/store',[ContactFormController::class, 'ContactMessageStore'])->name('contact.message.store');

    Route::get('/contact/message/{id}',[ContactFormController::class, 'ContactMessageDelete'])->name('contact.message.delete');

   });//contact message controlling route

});
   /*************************************************************************************/
Route::group(['middleware' => 'admin'],function(){

    Route::prefix('products')->group(function(){

    Route::get('/vegitable/view',[VegitableController::class, 'VegitableView'])->name('vegitable.view');

	Route::get('/vegitable/add',[VegitableController::class, 'VegitableAdd'])->name('vegitable.add');

	Route::post('vegitable/store',[VegitableController::class, 'VegitableStore'])->name('vegitable.store');

	Route::get('/vegitable/edit/{id}',[VegitableController::class, 'VegitableEdit'])->name('vegitable.edit');

	Route::post('/vegitable/update/{id}',[VegitableController::class, 'VegitableUpdate'])->name('vegitable.update');

	Route::get('/vegitable/delete/{id}',[VegitableController::class, 'VegitableDelete'])->name('vegitable.delete');

	/*****************************vegitable price******************************************/
    Route::get('/vegitable/price/view',[VegitablePriceController::class, 'VegitablePriceView'])->name('vegitable.price.view');

	Route::get('/vegitable/price/add',[VegitablePriceController::class, 'VegitablePriceAdd'])->name('vegitable.price.add');

	Route::post('vegitable/price/store',[VegitablePriceController::class, 'VegitablePriceStore'])->name('vegitable.price.store');

	Route::get('/vegitable/price/edit/{id}',[VegitablePriceController::class, 'VegitablePriceEdit'])->name('vegitable.price.edit');

	Route::post('/vegitable/price/update/{id}',[VegitablePriceController::class, 'VegitablePriceUpdate'])->name('vegitable.price.update');

	Route::get('/vegitable/price/delete/{id}',[VegitablePriceController::class, 'VegitablePriceDelete'])->name('vegitable.price.delete');

	/****************************************Fruits detials***********************************/

	Route::get('/fruit/view',[FruitController::class, 'FruitView'])->name('fruit.view');

	Route::get('/fruit/add',[FruitController::class, 'FruitAdd'])->name('fruit.add');

	Route::post('fruit/store',[FruitController::class, 'FruitStore'])->name('fruit.store');

	Route::get('/fruit/edit/{id}',[FruitController::class, 'FruitEdit'])->name('fruit.edit');

    Route::post('/fruit/update/{id}',[FruitController::class, 'FruitUpdate'])->name('fruit.update');

	Route::get('/fruit/delete/{id}',[FruitController::class, 'FruitDelete'])->name('fruit.delete');

   });//vegitable and fruits detials and price controlling route list

});
   Route::prefix('calculator')->group(function(){

   	/****************************************Fruit Price***********************************/
   
    Route::get('/fruit/price/view',[FruitPriceController::class, 'FruitPriceView'])->name('fruit.price.view');

	Route::get('/fruit/price/add',[FruitPriceController::class, 'FruitPriceAdd'])->name('fruit.price.add');

	Route::post('fruit/price/store',[FruitPriceController::class, 'FruitPriceStore'])->name('fruit.price.store');

	Route::get('/fruit/price/edit/{id}',[FruitPriceController::class, 'FruitPriceEdit'])->name('fruit.price.edit');

	Route::post('fruite/price/update/{id}',[FruitPriceController::class, 'FruitPriceUpdate'])->name('fruit.price.update');

	Route::get('/fruit/price/delete/{id}',[FruitPriceController::class, 'FruitPriceDelete'])->name('fruit.price.delete');


	/*****************************price calculator***********************************************/
    
    Route::get('harvast/calculator',[CalculaorController::class, 'CalculatorView'])->name('calculator.view');

    Route::post('harvast/calculator/result',[CalculaorController::class, 'CalculatorResult'])->name('calculator.result');

    Route::get('price/calculator',[CalculaorController::class, 'PriceCalculatorView'])->name('price.calculator.view');

    Route::post('price/calculator/result',[CalculaorController::class, 'PriceCalculatorResult'])->name('price.calculator.result');

   });

Route::group(['middleware' => 'farmer'],function(){

   Route::prefix('farmers')->group(function(){
     
     /*****************************************Farmer Profile Update********************************/

	Route::get('/farmer/setup',[FarmerUpadateController::class, 'FarmerSetup'])->name('farmer.setup');

     Route::get('/farmer/edit',[FarmerUpadateController::class, 'FarmerEdit'])->name('farmer.edit');

	Route::post('farmer/store',[FarmerUpadateController::class, 'FarmerStore'])->name('farmer.store');

     Route::post('/farmer/update/',[FarmerUpadateController::class, 'FarmerUpdate'])->name('farmer.update');

     /*****************************************Farmer Crop add**************************************/ 
    
    Route::get('/farmer/land/view',[FarmerCropController::class, 'FarmerLandView'])->name('farmer.land.view');

	Route::get('/farmer/land/add',[FarmerCropController::class, 'FarmerLandAdd'])->name('farmer.land.add');

	Route::post('farmer/land/store',[FarmerCropController::class, 'FarmerLandStore'])->name('farmer.land.store');

	Route::get('/farmer/land/edit/{id}',[FarmerCropController::class, 'FarmerLandEdit'])->name('farmer.land.edit');

    Route::post('/farmer/land/update/{id}',[FarmerCropController::class, 'FarmerLandUpdate'])->name('farmer.land.update');

	Route::get('/farmer/land/delete/{id}',[FarmerCropController::class, 'FarmerLandDelete'])->name('farmer.land.delete');


   });//farmer accout setup and update /crop data update controlling route list

});

Route::group(['middleware' => 'buyer'],function(){

   Route::prefix('buyers')->group(function(){
     
     /*****************************************Buyer Profile Update********************************/

	Route::get('/buyers/setup',[BuyerUpdateController::class, 'BuyerSetup'])->name('buyer.setup');

     Route::get('/buyers/edit',[BuyerUpdateController::class, 'BuyerEdit'])->name('buyer.edit');

	Route::post('buyers/store',[BuyerUpdateController::class, 'BuyerStore'])->name('buyer.store');

     Route::post('/buyers/update/',[BuyerUpdateController::class, 'BuyerUpdate'])->name('buyer.update');

     /*****************************************Buyer Product add**************************************/ 
    
    Route::get('/buyer/product/view',[BuyerProductController::class, 'BuyerProductView'])->name('buyer.product.view');

	Route::get('/buyer/product/add',[BuyerProductController::class, 'BuyerProductAdd'])->name('buyer.product.add');

	Route::post('buyer/product/store',[BuyerProductController::class, 'BuyerProductStore'])->name('buyer.product.store');

	Route::get('/buyer/product/edit/{id}',[BuyerProductController::class, 'BuyerProductEdit'])->name('buyer.product.edit');

    Route::post('/buyer/product/update/{id}',[BuyerProductController::class, 'BuyerProductUpdate'])->name('buyer.product.update');

	Route::get('/buyer/product/delete/{id}',[BuyerProductController::class, 'BuyerProductDelete'])->name('buyer.product.delete');


   });//buyer account setup update and product requirement data controlling route list

});

    });//end auth middeleware check

});//end middelware cheack