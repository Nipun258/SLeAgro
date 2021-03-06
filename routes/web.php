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
use App\Http\Controllers\Backend\CalenderController;
use App\Http\Controllers\Backend\Booking\AppointmentController;
use App\Http\Controllers\Backend\Booking\BookingController;
use App\Http\Controllers\Backend\Booking\BuyerListController;
use App\Http\Controllers\Backend\Booking\FarmerListController;
use App\Http\Controllers\Backend\Booking\BuyerBookingController;
use App\Http\Controllers\Backend\Booking\BuyerAppointmentController;
use App\Http\Controllers\Backend\Inventory\ProductAddController;
use App\Http\Controllers\Backend\Inventory\SellesController;
use App\Http\Controllers\Backend\Inventory\ProductiTransferController;
use App\Http\Controllers\Backend\Inventory\EcentreProductTransferController;
use App\Http\Controllers\Backend\Report\CollectionCentreReportController;
use App\Http\Controllers\Backend\Report\EconomicCentreReportController;
use App\Http\Controllers\Backend\Report\AdminReportController;
use App\Http\Controllers\Backend\Report\FarmerReportController;
use App\Http\Controllers\Backend\Report\BuyerReportController;
use Illuminate\Support\Facades\DB; //query builder in here
use App\Mail\registerMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
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

//Welcome Page Route
Route::get('/', function () {

	$abouts = DB::table('about_us')->first();
	$contacts = DB::table('contact_us')->first();
	$message = "Welcome SLeAgro System";

        //Log::emergency($message);
        //Log::alert($message    );
        //Log::critical($message);
        //Log::error($message);
        //Log::warning($message);
        //Log::notice($message);
        Log::info($message);
        //Log::debug($message);

    return view('layouts.master_home',compact('abouts','contacts'));

})->name('home');

//Authotication Check Route
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {

     return view('admin.index');

})->name('dashboard');


//Testing Fuction Route
Route::get('/test',[SummaryController::class, 'test'])->name('test');

//Contact Message Store 
Route::post('/contact/message/store',[ContactFormController::class, 'ContactMessageStore'])->name('contact.message.store');
//This Middleware check user Login or Not
Route::group(['middleware' => 'auth'],function(){

//Admin logout 
Route::get('/admin/logout',[ AdminController::class, 'Logout'])->name('admin.logout');
//Collect all dynamic data in Admin Dashboard
Route::get('/dashboard',[SummaryController::class, 'getVegData'])->name('dashboard');
//Price Analysis by each vegetable product weekly
Route::get('/price/analysis/{id}',[SummaryController::class, 'VegPriceAnalysis'])->name('vegetable.price.analysis');

/*************************************Event Management unit*****************************************/

Route::get('/calendar', [CalenderController::class, 'calendarIndex'])->name('calendar');

Route::post('/calendar/create', [CalenderController::class, 'calendarCreate'])->name('calendar.create');

Route::post('/calendar/create/normal', [CalenderController::class, 'calendarCreateNormal'])->name('calendar.create.normal');

Route::post('/calendar/update', [CalenderController::class, 'calendarUpdate'])->name('calendar.update');

Route::post('/calendar/delete', [CalenderController::class, 'calendarDelete'])->name('calendar.destroy');

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

});//This route only Access in Admistrative Users only
/*****************************user profile and change the password***********************/

Route::prefix('profile')->group(function(){

	Route::get('/view',[ProfileController::class, 'ProfileView'])->name('profile.view');

	Route::get('/edit',[ProfileController::class, 'ProfileEdit'])->name('profile.edit');

	Route::post('/store',[ProfileController::class, 'ProfileStore'])->name('profile.store');

	Route::get('/password/view',[ProfileController::class, 'PasswordView'])->name('password.view');
	
	Route::post('/password/update',[ProfileController::class, 'PasswordUpdate'])->name('password.update');

});//user profule controller route list

Route::group(['middleware' => 'admin'],function(){

Route::prefix('centres')->group(function(){

	/*******************************Economic Centre Unit****************************/

	Route::get('economic/centre/view',[EconomicCenterController::class, 'EconomicCentreView'])->name('ecomomic.centre.view');

	 Route::get('economic/centre/add',[EconomicCenterController::class, 'EconomicCentreAdd'])->name('ecomomic.centre.add');

	Route::post('economic/centre/store',[EconomicCenterController::class, 'EconomicCentreStore'])->name('ecomomic.centre.store');

	Route::get('economic/centre/edit/{id}',[EconomicCenterController::class, 'EconomicCentreEdit'])->name('ecomomic.centre.edit');

	Route::post('economic/centre/update/{id}',[EconomicCenterController::class, 'EconomicCentreUpdate'])->name('ecomomic.centre.update');

	Route::get('economic/centre/soft/delete/{id}',[EconomicCenterController::class, 'EconomicCentreSoftDelete'])->name('ecomomic.centre.soft.delete');

	Route::get('economic/centre/restore/{id}',[EconomicCenterController::class, 'EconomicCentreRestore'])->name('ecomomic.centre.restore');

	Route::get('economic/centre/delete/{id}',[EconomicCenterController::class, 'EconomicCentreDelete'])->name('ecomomic.centre.delete');

	/*******************************Collection Centre Unit****************************/

	Route::get('collection/centre/view',[CollectionCentreController::class, 'CollectionCentreView'])->name('collection.centre.view');

	 Route::get('collection/centre/add',[CollectionCentreController::class, 'CollectionCentreAdd'])->name('collection.centre.add');

	Route::post('collection/centre/store',[CollectionCentreController::class, 'CollectionCentreStore'])->name('collection.centre.store');

	Route::get('collection/centre/edit/{id}',[CollectionCentreController::class, 'CollectionCentreEdit'])->name('collection.centre.edit');

	Route::post('collection/centre/update/{id}',[CollectionCentreController::class, 'CollectionCentreUpdate'])->name('collection.centre.update');

	Route::get('collection/centre/delete/{id}',[CollectionCentreController::class, 'CollectionCentreDelete'])->name('collection.centre.delete');

   });//economic centre and collection centre routes

});//This route only Access in Admistrative Users only
     /******************************Dynamic drop down data fetch***********************************/
	 Route::post('api/fetch-districts', [EconomicCenterController::class, 'fetchDistrict']);

     Route::post('api/fetch-cities', [EconomicCenterController::class, 'fetchCity']);

     Route::post('api/fetch-collection_centres', [FarmerUpadateController::class, 'fetchCollectionCentre']);

     Route::post('api/fetch-bank_branches', [FarmerUpadateController::class, 'fetchBankBranch']);

     
Route::group(['middleware' => 'admin'],function(){

   Route::prefix('setups')->group(function(){

   /***********************************Home Page Website controlling Unit****************************/

   /***************************Home Slider Management Modual***************************/ 

	Route::get('/slider/view',[HomeController::class, 'SliderView'])->name('slider.view');

	Route::get('/slider/add',[HomeController::class, 'SliderAdd'])->name('slider.add');

	Route::post('/slider/store',[HomeController::class, 'SliderStore'])->name('slider.store');

	Route::get('/slider/edit/{id}',[HomeController::class, 'SliderEdit'])->name('slider.edit');

	Route::post('/slider/update/{id}',[HomeController::class, 'SliderUpdate'])->name('slider.update');

	Route::get('/slider/delete/{id}',[HomeController::class, 'SliderDelete'])->name('slider.delete');

    /****************************About Us Detial's Managemant Modual******************************/

    Route::get('/about/view',[AboutController::class, 'AboutView'])->name('about.view');

	Route::get('/about/edit/{id}',[AboutController::class, 'AboutEdit'])->name('about.edit');

	Route::post('/about/update/{id}',[AboutController::class, 'AboutUpdate'])->name('about.update');

	/*****************************Contact Us Detial's Management Modual**************************/

	Route::get('/contact/view',[ContactController::class, 'ContactView'])->name('contact.view');

	Route::get('/contact/edit/{id}',[ContactController::class, 'ContactEdit'])->name('contact.edit');

	Route::post('/contact/update/{id}',[ContactController::class, 'ContactUpdate'])->name('contact.update');
    
    /*******************************F&Q Section Management Modual*******************************/

    Route::get('/question/view',[QuestionController::class, 'QuestionView'])->name('question.view');

	Route::get('/question/add',[QuestionController::class, 'QuestionAdd'])->name('question.add');

	Route::post('/question/store',[QuestionController::class, 'QuestionStore'])->name('question.store');

	Route::get('/question/edit/{id}',[QuestionController::class, 'QuestionEdit'])->name('question.edit');

	Route::post('/question/update/{id}',[QuestionController::class, 'QuestionUpdate'])->name('question.update');

	Route::get('/question/delete/{id}',[QuestionController::class, 'QuestionDelete'])->name('question.delete');

     });//font end setting controlling route list

});//This route only Access in Admistrative Users only

/*************************************************************************************/
Route::group(['middleware' => 'admin'],function(){

   Route::prefix('messages')->group(function(){

    Route::get('/contact/message/view',[ContactFormController::class, 'ContactMessageView'])->name('contact.message.view');

    Route::get('/contact/message/reply/{id}',[ContactFormController::class, 'ContactMessageReplay'])->name('contact.message.reply');

    Route::post('contact/message/email',[ContactFormController::class, 'ContactMessageEmail'])->name('contact.message.email');

    Route::get('/contact/message/{id}',[ContactFormController::class, 'ContactMessageDelete'])->name('contact.message.delete');

   });//contact message controlling route

});//This route only Access in Admistrative Users only

   /*************************************************************************************/
Route::group(['middleware' => 'admin'],function(){

    Route::prefix('products')->group(function(){

   /**************************Vegetable Product Management Modual****************************************/

    Route::get('/vegitable/view',[VegitableController::class, 'VegitableView'])->name('vegitable.view');

	Route::get('/vegitable/add',[VegitableController::class, 'VegitableAdd'])->name('vegitable.add');

	Route::post('vegitable/store',[VegitableController::class, 'VegitableStore'])->name('vegitable.store');

	Route::get('/vegitable/edit/{id}',[VegitableController::class, 'VegitableEdit'])->name('vegitable.edit');

	Route::post('/vegitable/update/{id}',[VegitableController::class, 'VegitableUpdate'])->name('vegitable.update');

	Route::get('/vegitable/delete/{id}',[VegitableController::class, 'VegitableDelete'])->name('vegitable.delete');

	/**************************Vegetable Price Controlling Modual****************************************/
    Route::get('/vegitable/price/view',[VegitablePriceController::class, 'VegitablePriceView'])->name('vegitable.price.view');

	Route::get('/vegitable/price/add',[VegitablePriceController::class, 'VegitablePriceAdd'])->name('vegitable.price.add');

	Route::post('vegitable/price/store',[VegitablePriceController::class, 'VegitablePriceStore'])->name('vegitable.price.store');

	Route::get('/vegitable/price/edit/{id}',[VegitablePriceController::class, 'VegitablePriceEdit'])->name('vegitable.price.edit');

	Route::post('/vegitable/price/update/{id}',[VegitablePriceController::class, 'VegitablePriceUpdate'])->name('vegitable.price.update');

	Route::get('/vegitable/price/delete/{id}',[VegitablePriceController::class, 'VegitablePriceDelete'])->name('vegitable.price.delete');

	/****************************Fruits Product Management Modual***********************************/

	Route::get('/fruit/view',[FruitController::class, 'FruitView'])->name('fruit.view');

	Route::get('/fruit/add',[FruitController::class, 'FruitAdd'])->name('fruit.add');

	Route::post('fruit/store',[FruitController::class, 'FruitStore'])->name('fruit.store');

	Route::get('/fruit/edit/{id}',[FruitController::class, 'FruitEdit'])->name('fruit.edit');

    Route::post('/fruit/update/{id}',[FruitController::class, 'FruitUpdate'])->name('fruit.update');

	Route::get('/fruit/delete/{id}',[FruitController::class, 'FruitDelete'])->name('fruit.delete');


	/***********************************Fruits Price Controlling Modual***********************************/
   
    Route::get('/fruit/price/view',[FruitPriceController::class, 'FruitPriceView'])->name('fruit.price.view');

	Route::get('/fruit/price/add',[FruitPriceController::class, 'FruitPriceAdd'])->name('fruit.price.add');

	Route::post('fruit/price/store',[FruitPriceController::class, 'FruitPriceStore'])->name('fruit.price.store');

	Route::get('/fruit/price/edit/{id}',[FruitPriceController::class, 'FruitPriceEdit'])->name('fruit.price.edit');

	Route::post('fruite/price/update/{id}',[FruitPriceController::class, 'FruitPriceUpdate'])->name('fruit.price.update');

	Route::get('/fruit/price/delete/{id}',[FruitPriceController::class, 'FruitPriceDelete'])->name('fruit.price.delete');

   });//vegitable and fruits detials and price controlling route list

});//This route only Access in Admistrative Users only

   Route::prefix('calculator')->group(function(){

	/*****************************Price Calculator Modual******************************************/

	/*****************************Harvest Predictor Calculator Modual***********************************/
    
    Route::get('harvast/calculator',[CalculaorController::class, 'CalculatorView'])->name('calculator.view');

    Route::post('harvast/calculator/result',[CalculaorController::class, 'CalculatorResult'])->name('calculator.result');

    /*****************************Harvest Normal Calculator Modual***********************************/

    Route::get('price/calculator',[CalculaorController::class, 'PriceCalculatorView'])->name('price.calculator.view');

    Route::post('price/calculator/result',[CalculaorController::class, 'PriceCalculatorResult'])->name('price.calculator.result');

   });//Calculator Controller Route List

Route::group(['middleware' => 'farmer'],function(){

   Route::prefix('farmers')->group(function(){
     
     /**************************Farmer Profile Update Modual********************************/

	Route::get('/farmer/setup',[FarmerUpadateController::class, 'FarmerSetup'])->name('farmer.setup');

     Route::get('/farmer/edit',[FarmerUpadateController::class, 'FarmerEdit'])->name('farmer.edit');

	Route::post('farmer/store',[FarmerUpadateController::class, 'FarmerStore'])->name('farmer.store');

     Route::post('/farmer/update/',[FarmerUpadateController::class, 'FarmerUpdate'])->name('farmer.update');

     /************************Farmer Harvest Area Management Modual****************************/ 
    
    Route::get('/farmer/land/view',[FarmerCropController::class, 'FarmerLandView'])->name('farmer.land.view');

	Route::get('/farmer/land/add',[FarmerCropController::class, 'FarmerLandAdd'])->name('farmer.land.add');

	Route::post('farmer/land/store',[FarmerCropController::class, 'FarmerLandStore'])->name('farmer.land.store');

	Route::get('/farmer/land/edit/{id}',[FarmerCropController::class, 'FarmerLandEdit'])->name('farmer.land.edit');

    Route::post('/farmer/land/update/{id}',[FarmerCropController::class, 'FarmerLandUpdate'])->name('farmer.land.update');

	Route::get('/farmer/land/delete/{id}',[FarmerCropController::class, 'FarmerLandDelete'])->name('farmer.land.delete');


   });//farmer accout setup and update /crop data update controlling route list

});//This route only Access in Farmers only

Route::group(['middleware' => 'buyer'],function(){

   Route::prefix('buyers')->group(function(){
     
     /***************************Buyer Profile Update Modual********************************/

	Route::get('/buyers/setup',[BuyerUpdateController::class, 'BuyerSetup'])->name('buyer.setup');

     Route::get('/buyers/edit',[BuyerUpdateController::class, 'BuyerEdit'])->name('buyer.edit');

	Route::post('buyers/store',[BuyerUpdateController::class, 'BuyerStore'])->name('buyer.store');

     Route::post('/buyers/update/',[BuyerUpdateController::class, 'BuyerUpdate'])->name('buyer.update');

     /********************Buyer Product Requrnment Management Modual*************************/ 
    
    Route::get('/buyer/product/view',[BuyerProductController::class, 'BuyerProductView'])->name('buyer.product.view');

	Route::get('/buyer/product/add',[BuyerProductController::class, 'BuyerProductAdd'])->name('buyer.product.add');

	Route::post('buyer/product/store',[BuyerProductController::class, 'BuyerProductStore'])->name('buyer.product.store');

	Route::get('/buyer/product/edit/{id}',[BuyerProductController::class, 'BuyerProductEdit'])->name('buyer.product.edit');

    Route::post('/buyer/product/update/{id}',[BuyerProductController::class, 'BuyerProductUpdate'])->name('buyer.product.update');

	Route::get('/buyer/product/delete/{id}',[BuyerProductController::class, 'BuyerProductDelete'])->name('buyer.product.delete');


   });//buyer account setup update and product requirement data controlling route list

});//This route only Access in Buyers only

Route::group(['middleware' => 'admin'],function(){

   Route::prefix('appointments')->group(function(){
     
     /*******************Farmer's Appointment Setup Modual(Collection Centre) ************/

	Route::get('/appointment/setup',[AppointmentController::class, 'AppSetup'])->name('app.setup');

	Route::post('appointment/store',[AppointmentController::class, 'AppStore'])->name('app.store');

	Route::get('/appointment/check/view',[AppointmentController::class, 'AppCheckView'])->name('app.check.view');

   Route::post('appointment/check',[AppointmentController::class, 'AppCheck'])->name('app.check');

   Route::post('appointment/update',[AppointmentController::class, 'AppTimeUpdate'])->name('app.time.update');


   });//regional center officer appointment setup data controlling route list

});//This route only Access in Admistrative Users only(Collection Centre Officer Only)


Route::group(['middleware' => 'admin'],function(){

   Route::prefix('bappointments')->group(function(){
     
     /*******************Buyer's Appointment Setup Modual(Economic Centre) *******************/

	Route::get('/buyer/appointment/setup',[BuyerAppointmentController::class, 'BuyerAppSetup'])->name('buyer.app.setup');

	Route::post('buyer/appointment/store',[BuyerAppointmentController::class, 'BuyerAppStore'])->name('buyer.app.store');

	Route::get('/buyer/appointment/check/view',[BuyerAppointmentController::class, 'BuyerAppCheckView'])->name('buyer.app.check.view');

	Route::get('/buyer/appointment/delete/{id}',[BuyerAppointmentController::class, 'BuyerAppDelete'])->name('buyer.app.delete');


   });//regional center officer appointment setup data controlling route list

});//This route only Access in Admistrative Users only(Economic Centre Officer Only)

Route::group(['middleware' => 'farmer'],function(){

   Route::prefix('bookings')->group(function(){
     
   /*******************Farmer's Booking Creation to Collection Centre*******************/

 Route::get('booking/view',[BookingController::class, 'BookingView'])->name('booking.view');

 Route::get('/booking/time/{id}',[BookingController::class, 'BookingTimeView'])->name('booking.time.view');

 Route::post('book/appointment',[BookingController::class, 'BookingApp'])->name('booking.app');

 Route::get('/mybooking',[BookingController::class, 'BookingList'])->name('booking.list');

 Route::get('/mybooking/invoice',[BookingController::class, 'BookingInvoice'])->name('farmer.booking.invoice');

 Route::get('/booking/invoice/generate/{id}',[BookingController::class, 'BookingInvoiceGenerate'])->name('farmer.booking.invoice.generate');

   });//Farmer booking managment and controlling route list

});//This route only Access in Farmers only

Route::group(['middleware' => 'buyer'],function(){

   Route::prefix('bbookings')->group(function(){
     
     /*******************Buyer's Booking Creation to Economic Centre*******************/

  Route::get('buyer/booking/view',[BuyerBookingController::class, 'BuyerBookingView'])->name('buyer.booking.view');

  Route::get('/booking/product/{id}',[BuyerBookingController::class, 'BookingProductView'])->name('booking.product.view');

  Route::post('book/buyer/appointment',[BuyerBookingController::class, 'BookingBuyerApp'])->name('booking.buyer.app');

  Route::get('/mybooking/buyer',[BuyerBookingController::class, 'BuyerBookingList'])->name('buyer.booking.list');

  Route::get('/buyer/book/product/{id}',[BuyerBookingController::class, 'BuyerBookingProduct'])->name('buyer.booking.product');

  Route::get('/mybooking/invoice',[BuyerBookingController::class, 'BuyerBookingInvoice'])->name('buyer.booking.invoices');

  Route::get('/booking/invoice/generate/{id}',[BuyerBookingController::class, 'BuyerBookingInvoiceGenerate'])->name('buyer.booking.invoice.generate');


   });//Buyer's Booking Creation to Economic Centre Controlling Route List

});//This route only Access in Buyers only

Route::group(['middleware' => 'admin'],function(){

   Route::prefix('farmerapps')->group(function(){
     
     /***************Farmer's Booking Check and confirmation of Farmer Praticipation ************/

	Route::get('/appointment/list',[FarmerListController::class, 'AppList'])->name('app.list');

	Route::get('/appointment/list/today',[FarmerListController::class, 'AppListToday'])->name('app.list.today');

	Route::get('/appointment/filter',[FarmerListController::class, 'AppFilter'])->name('app.filter');

	Route::get('/status/update/{id}',[FarmerListController::class, 'ToggleStatus'])->name('update.status');


   });//Farmer's Booking Check and confirmation of Farmer Praticipation contolling route list

   Route::prefix('cinventory')->group(function(){
     
     /*******************Inventory Mangement Modual in Collection Centre*******************/
   
	Route::get('/booking/today/list',[ProductAddController::class, 'BookingList'])->name('booking.lists');

   Route::get('/product/add/view/{id}',[ProductAddController::class, 'ProductAddView'])->name('product.add.view');
	
	Route::post('booking/product/store',[ProductAddController::class, 'BookingProductStore'])->name('booking.product.store');

	Route::get('/product/add/view/normal/user',[ProductAddController::class, 'ProductAddNormalView'])->name('product.add.normal.view');

	Route::post('normal/product/store',[ProductAddController::class, 'NormalProductStore'])->name('normal.product.store');
    
   Route::get('/normal/invoice',[ProductAddController::class, 'NormalInvoiceGen'])->name('normal.invoice');

   Route::get('/booking/invoice',[ProductAddController::class, 'BookingInvoiceGen'])->name('booking.invoice');

   Route::post('booking/payment/store',[ProductAddController::class, 'BookingPaymentStore'])->name('booking.payment.store');

   Route::post('normal/payment/store',[ProductAddController::class, 'NormalPaymentStore'])->name('normal.payment.store');

   Route::get('/product/summary',[ProductAddController::class, 'ProductSummary'])->name('product.summary');

   Route::get('/product/list/filter',[ProductAddController::class, 'ProductListFilter'])->name('product.list.filter');

   Route::get('/product/summary/report',[ProductAddController::class, 'ProductSummaryReport'])->name('product.summary.report');

   Route::get('/product/month/summary/report',[ProductAddController::class, 'ProductMonthSummaryReport'])->name('product.month.summary.report');

     /****************Collection Centre Inventory Transfer to Economic Centre*****************/
     
     Route::get('/product/transfer/ecentre/view',[ProductiTransferController::class, 'ProductTransferEcenterView'])->name('product.transfer.ecenter.view');

     Route::post('normal/transfer/ecenter/store',[ProductiTransferController::class, 'ProductTransferEcenterStore'])->name('product.transfer.ecenter.store');

     Route::get('/transfer/invoice',[ProductiTransferController::class, 'TransferInvoiceGen'])->name('transfer.invoice');

     Route::post('transfer/payment/store',[ProductiTransferController::class, 'TransferPaymentStore'])->name('transfer.payment.store');

   });//Collection Centre Inventory Controlling Route List(Access Only Collection Centre)

    Route::prefix('buyerreqs')->group(function(){
     
     /****Buyer's Booking Check and confirmation of Farmer Praticipation and Booking Product View *****/

	Route::get('/product/request/list',[BuyerListController::class, 'ProductReqList'])->name('product.request.list');

	Route::get('/product/request/list/today',[BuyerListController::class, 'ProductReqListToday'])->name('product.request.list.today');

	Route::get('/product/request/filter',[BuyerListController::class, 'ProductReqFilter'])->name('product.request.filter');

	Route::get('/product/request/status/update/{id}',[BuyerListController::class, 'ProductReqToggleStatus'])->name('product.request.update.status');

	Route::get('/buyer/book/product/{id}',[BuyerListController::class, 'BuyerBookingProductView'])->name('buyer.booking.product.view');

   });//Buyer's Booking Check and confirmation of Farmer Praticipation and Booking Product View(Access Only Economic Centre)

    Route::prefix('einventory')->group(function(){
     
     /*******************Inventory Mangement Modual in Economic Centre*******************/

     Route::get('/buyer/booking/today/list',[SellesController::class, 'BuyerBookingList'])->name('booking.buyer.lists');

     Route::get('/buyer/product/add/view/{id}',[SellesController::class, 'BuyerProductAddView'])->name('product.sell.view');

     Route::post('buyer/booking/product/store',[SellesController::class, 'BuyerBookingProductStore'])->name('buyer.booking.product.store');

      Route::get('/normal/buyer/invoice',[SellesController::class, 'BuyerBookingInvoiceGen'])->name('buyer.booking.invoice');

     Route::get('/product/sell/normal/view',[SellesController::class, 'ProductSellNormalView'])->name('product.sell.normal.view');

     Route::post('normal/sell/store',[SellesController::class, 'NormalSellStore'])->name('normal.sell.store');

     Route::get('/normal/sell/invoice',[SellesController::class, 'NormalSellInvoiceGen'])->name('normal.sell.invoice');

     Route::post('buyer/booking/payment/store',[SellesController::class, 'BuyerBookingPaymentStore'])->name('buyer.booking.payment.store');

     Route::post('buyer/normal/payment/store',[SellesController::class, 'BuyerNormalPaymentStore'])->name('buyer.normal.payment.store');

     Route::get('/product/summary',[SellesController::class, 'ProductSummaryEcentre'])->name('product.summary.ecentre');

     Route::get('/product/list/filter',[SellesController::class, 'ProductListFilterEcentre'])->name('product.list.ecentre.filter');

      Route::get('/product/summary/report',[SellesController::class, 'ProductSummaryReportEcentre'])->name('product.summary.ecenre.report');
     
      Route::get('/product/summary/month/report',[SellesController::class, 'ProductSummaryMonthReportEcentre'])->name('product.summary.month.ecenre.report');


      /******************Economic Centre Inventory Transfer to Reteils Market********************/
     
     Route::get('/product/transfer/market/view',[EcentreProductTransferController::class, 'ProductTransferMarketView'])->name('product.transfer.market.view');

     Route::post('normal/transfer/market/store',[EcentreProductTransferController::class, 'ProductTransferMarketStore'])->name('product.transfer.market.store');

     Route::get('/transfer/market/invoice',[EcentreProductTransferController::class, 'TransferMarketInvoiceGen'])->name('transfer.market.invoice');

     Route::post('transfer/market/payment/store',[EcentreProductTransferController::class, 'TransferMarketPaymentStore'])->name('transfer.market.payment.store');
   });//Economic Centre Inventory Controlling Route List 

});//This route only Access in Admistrative Users only


Route::group(['middleware' => 'admin'],function(){

   Route::prefix('creport')->group(function(){
     
     /*******************Administrtive User Report Generation*******************/

     /*******************Collection Centre Summary Report Generation*******************/

  Route::get('/ccentre/report',[CollectionCentreReportController::class, 'CcentreReportView'])->name('ccentre.report.view');

  Route::get('/ccentre/report/farmer_list',[CollectionCentreReportController::class, 'CcentreFarmerList'])->name('ccentre.report.farmer.list');

  Route::get('/ccentre/report/user_list',[CollectionCentreReportController::class, 'CcentreUserList'])->name('ccentre.report.user.list');
 
   Route::post('ccentre/report/appointment',[CollectionCentreReportController::class, 'CcentreAppointment'])->name('ccentre.report.appointment');

   Route::get('ccentre/report/product/transfer',[CollectionCentreReportController::class, 'CcentreProductTransfer'])->name('ccentre.report.product.transfer');

   Route::post('ccentre/report/payment/register',[CollectionCentreReportController::class, 'CcentrePaymentRegister'])->name('ccentre.report.payment.register');

   Route::post('ccentre/report/payment/normal',[CollectionCentreReportController::class, 'CcentrePaymentNormal'])->name('ccentre.report.payment.normal');

   Route::post('ccentre/report/payment/transfer',[CollectionCentreReportController::class, 'CcentrePaymentTransfer'])->name('ccentre.report.payment.transfer');

   Route::post('ccentre/report/inventory/daily',[CollectionCentreReportController::class, 'CcentreInventoryDaily'])->name('ccentre.report.inventory.daily');

   Route::post('ccentre/report/inventory/month',[CollectionCentreReportController::class, 'CcentreInventoryMonth'])->name('ccentre.report.inventory.month');

   Route::post('ccentre/report/payment/summary/register',[CollectionCentreReportController::class, 'CcentrePaymentSummaryRegister'])->name('ccentre.report.payment.summary.register');

   Route::post('ccentre/report/payment/summary/normal',[CollectionCentreReportController::class, 'CcentrePaymentSummaryNormal'])->name('ccentre.report.payment.summary.normal');

   Route::post('ccentre/report/payment/summary/transfer',[CollectionCentreReportController::class, 'CcentrePaymentSummaryTransfer'])->name('ccentre.report.payment.summary.transfer');

   });//Collection Centre Summary Report Generation Controlling Route List


   Route::prefix('ereport')->group(function(){

       /*******************Economic Centre Summary Report Generation*******************/

  Route::get('/ecentre/report',[EconomicCentreReportController::class, 'EcentreReportView'])->name('ecentre.report.view');

  Route::get('/ecentre/report/buyer_list',[EconomicCentreReportController::class, 'EcentreBuyerList'])->name('ecentre.report.buyer.list');

  Route::get('/ecentre/report/user_list',[EconomicCentreReportController::class, 'EcentreUserList'])->name('ecentre.report.user.list');
 
   Route::post('ecentre/report/appointment',[EconomicCentreReportController::class, 'EcentreAppointment'])->name('ecentre.report.appointment');

   Route::get('ecentre/report/ccentre/list',[EconomicCentreReportController::class, 'EcentreCcentreList'])->name('ecentre.report.ccentre.list');

   Route::post('ecentre/report/payment/register',[EconomicCentreReportController::class, 'EcentrePaymentRegister'])->name('ecentre.report.payment.register');

   Route::post('ecentre/report/payment/normal',[EconomicCentreReportController::class, 'EcentrePaymentNormal'])->name('ecentre.report.payment.normal');

   Route::post('ecentre/report/payment/transfer',[EconomicCentreReportController::class, 'EcentrePaymentTransfer'])->name('ecentre.report.payment.transfer');

   Route::post('ecentre/report/inventory/daily',[EconomicCentreReportController::class, 'EcentreInventoryDaily'])->name('ecentre.report.inventory.daily');

   Route::post('ecentre/report/inventory/month',[EconomicCentreReportController::class, 'EcentreInventoryMonth'])->name('ecentre.report.inventory.month');

   Route::post('ecentre/report/ccentre/stock/ckeck',[EconomicCentreReportController::class, 'EcentreCcentreStockCheck'])->name('ecentre.report.ccentre.stock.check');

   Route::post('ecentre/report/payment/summary/register',[EconomicCentreReportController::class, 'EcentrePaymentSummaryRegister'])->name('ecentre.report.payment.summary.register');

   Route::post('ecentre/report/payment/summary/normal',[EconomicCentreReportController::class, 'EcentrePaymentSummaryNormal'])->name('ecentre.report.payment.summary.normal');

   Route::post('ecentre/report/payment/summary/transfer',[EconomicCentreReportController::class, 'EcentrePaymentSummaryTransfer'])->name('ecentre.report.payment.summary.transfer');

   });//Economic Centre Summary Report Generation Controlling Route List

      Route::prefix('areport')->group(function(){

        /*******************System Adminstrator Summary Report Generation*******************/

  Route::get('/admin/report/administrative',[AdminReportController::class, 'AdminAdministrativeReportView'])->name('admin.report.admin.view');

  Route::get('/admin/report/user_list',[AdminReportController::class, 'AdminUserList'])->name('admin.report.user.list');

  Route::get('/admin/report/centre/list',[AdminReportController::class, 'AdminCentreList'])->name('admin.report.centre.list');

  Route::get('/admin/report/vegitable/list',[AdminReportController::class, 'AdminVegList'])->name('admin.report.vegitable.list');

   Route::post('admin/report/vegetables/price',[AdminReportController::class, 'AdminVegPrice'])->name('admin.report.vegitable.price');

   Route::post('admin/report/ecentre/summary/day',[AdminReportController::class, 'AdminEcentreSummaryDay'])->name('admin.report.ecentre.summary.day');

   Route::post('admin/report/ccentre/summary/day',[AdminReportController::class, 'AdminCcentreSummaryDay'])->name('admin.report.ccentre.summary.day');

   Route::post('admin/report/ecentre/summary/month',[AdminReportController::class, 'AdminEcentreSummaryMonth'])->name('admin.report.ecentre.summary.month');

   Route::post('admin/report/ccentre/summary/month',[AdminReportController::class, 'AdminCcentreSummaryMonth'])->name('admin.report.ccentre.summary.month');

   });//System Admin Summary Report Generation Controlling Route List

});//This route only Access in Admistrative Users only

Route::group(['middleware' => 'farmer'],function(){

   Route::prefix('freport')->group(function(){
     
     /*******************Farmer's Summary Report Generation *******************/

  Route::get('/farmer/report',[FarmerReportController::class, 'FarmerReportView'])->name('farmer.report.view');

  Route::post('farmer/report/appointment',[FarmerReportController::class, 'FarmerAppointment'])->name('farmer.report.appointment');

  Route::post('farmer/report/payment/register',[FarmerReportController::class, 'FarmerPaymentRegister'])->name('farmer.report.payment.register');

  Route::post('farmer/report/inventory/daily',[FarmerReportController::class, 'FarmerInventoryDaily'])->name('farmer.report.inventory.daily');

   Route::post('farmer/report/inventory/month',[FarmerReportController::class, 'FarmerInventoryMonth'])->name('farmer.report.inventory.month');

   Route::post('farmer/report/payment/summary',[FarmerReportController::class, 'FarmerPaymentSummary'])->name('farmer.report.payment.summary');

   });//Farmer's Summary Report Generation Controlling Route List

});//This route only Access in Farmers only


Route::group(['middleware' => 'buyer'],function(){

   Route::prefix('breport')->group(function(){
     
     /*******************Buyer's Summary Report Generation *******************/

  Route::get('/buyer/report',[BuyerReportController::class, 'BuyerReportView'])->name('buyer.report.view');

  Route::post('buyer/report/appointment',[BuyerReportController::class, 'BuyerAppointment'])->name('buyer.report.appointment');

  Route::post('buyer/report/payment/register',[BuyerReportController::class, 'BuyerPaymentRegister'])->name('buyer.report.payment.register');

  Route::post('buyer/report/inventory/daily',[BuyerReportController::class, 'BuyerInventoryDaily'])->name('buyer.report.inventory.daily');

   Route::post('buyer/report/inventory/month',[BuyerReportController::class, 'BuyerInventoryMonth'])->name('buyer.report.inventory.month');

   Route::post('buyer/report/payment/summary',[BuyerReportController::class, 'BuyerPaymentSummary'])->name('buyer.report.payment.summary');

   });//Buyer's Summary Report Generation Controlling Route List

});//This route only Access in Buyer's only


    });//end auth middeleware check

});//end middelware cheack(Issue fix middelware)

