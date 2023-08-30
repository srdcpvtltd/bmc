<?php 
/****************** ADMIN MIDDLEWARE PAGES ROUTES START****************/

use App\Http\Controllers\Admin\CollectionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EstablishmentCategoryController;
use App\Http\Controllers\Admin\EstablishmentController;
use App\Http\Controllers\Admin\EstablishmentShopController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\QrCodeController;
use App\Http\Controllers\Admin\QrCodePaymentController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ShopController;
use App\Http\Controllers\Admin\StructureController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WardController;
use App\Http\Controllers\Admin\ZoneController;

Route::group(['prefix' => 'admin', 'as'=>'admin.','middleware' => 'auth:user','admin'], function () { 
    /*******************DASHBOARD ROUTE START*************/   
    Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard.index');    
    /*******************DASHBOARD ROUTE END*************/       
    /*******************USER ROUTE START*************/       
    Route::view('user/project_manager','admin.user.project_manager')->name('user.project_manager');
    Route::get('user/verified/{id}',[UserController::class,'verified'])->name('user.verified');
    Route::get('user/revert_verification/{id}',[UserController::class,'revert_verification'])->name('user.revert_verification');
    Route::get('user/active/{id}',[UserController::class,'active'])->name('user.active');
    Route::get('user/in_active/{id}',[UserController::class,'in_active'])->name('user.in_active');
    Route::resource('user',UserController::class);
    /*******************USER ROUTE END*************/          
    /*******************ZONE ROUTE START*************/       
    Route::resource('zone',ZoneController::class);
    /*******************ZONE ROUTE END*************/             
    /*******************STRUCUTURE ROUTE START*************/       
    Route::resource('structure',StructureController::class);
    /*******************STRUCUTURE ROUTE END*************/               
    /*******************LOCATION ROUTE START*************/       
    Route::resource('location',LocationController::class);
    /*******************LOCATION ROUTE END*************/             
    /*******************WARD ROUTE START*************/       
    Route::resource('ward',WardController::class);
    /*******************WARD ROUTE END*************/            
    /*******************Establishment Category ROUTE START*************/       
    Route::resource('establishment_category',EstablishmentCategoryController::class);
    /*******************Establishment Category ROUTE END*************/ 
    /*******************Establishment ROUTE START*************/       
    Route::resource('establishment',EstablishmentController::class);
    /*******************Establishment ROUTE END*************/  
    /*******************Establishment Shop ROUTE START*************/       
    Route::resource('establishment_shop',EstablishmentShopController::class);
    /*******************Establishment Shop ROUTE END*************/  
    /*******************Shop ROUTE START*************/      
    Route::get('shop/create_shop_profile/{id}',[ShopController::class,'createShopProfile'])->name('shop.create_shop_profile'); 
    Route::get('shop/generate_qr_code/{id}',[ShopController::class,'generateQrCode'])->name('shop.generate_qr_code'); 
    Route::get('shop/detail/{id}',[ShopController::class,'getShopDetail'])->name('shop.detail'); 
    Route::post('shop/get_wards',[ShopController::class,'getWards'])->name('shop.get_wards'); 
    Route::post('shop/get_establishments',[ShopController::class,'getEstablishments'])->name('shop.get_establishments'); 
    Route::post('shop/get_establishment_shops',[ShopController::class,'getEstablishmentShops'])->name('shop.get_establishment_shops'); 
    Route::post('shop/get_establishment_shop',[ShopController::class,'getEstablishmentShop'])->name('shop.get_establishment_shop'); 
    Route::resource('shop',ShopController::class);
    Route::resource('qr_code',QrCodeController::class);
    Route::resource('qr_code_payment',QrCodePaymentController::class);
    /*******************Shop ROUTE END*************/  
    Route::get('collection/daily',[CollectionController::class,'getDailyCollection'])->name('collection.daily');       
    Route::get('collection/monthly',[CollectionController::class,'getMonthlyCollection'])->name('collection.monthly');       
    Route::get('collection/show_daily/{id}',[CollectionController::class,'showDailyCollection'])->name('collection.show_daily');       
    /*******************REPORT ROUTE START*************/  
    Route::get('report/shops',[ReportController::class,'shopReports'])->name('report.shops');       
    Route::get('report/establisments',[ReportController::class,'establismentReports'])->name('report.establisments');       
    /*******************REPORT ROUTE END*************/  
});
/****************** ADMIN MIDDLEWARE PAGES ROUTES END****************/
?>