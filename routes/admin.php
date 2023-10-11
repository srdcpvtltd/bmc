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
    /*******************Shop ROUTE START*************/
    Route::post('shop/get_wards',[ShopController::class,'getWards'])->name('shop.get_wards');
    // Route::resource('qr_code',QrCodeController::class);
    // Route::resource('qr_code_payment',QrCodePaymentController::class);
    /*******************Shop ROUTE END*************/
    Route::get('collection/daily',[CollectionController::class,'getDailyCollection'])->name('collection.daily');
    Route::get('collection/monthly',[CollectionController::class,'getMonthlyCollection'])->name('collection.monthly');
    Route::get('collection/show_daily/{id}',[CollectionController::class,'showDailyCollection'])->name('collection.show_daily');
    /*******************REPORT ROUTE START*************/
    Route::get('report/zone',[ReportController::class,'zoneReports'])->name('report.shops');

    Route::get('report/zone/establishment/{id}',[ReportController::class,'zoneEstablishment'])->name('zone.estableshment');

    Route::get('report/zone/establishment/report/{id}',[ReportController::class,'zoneEstablishmentShopReports'])->name('zone.estableshment.reports');



    // Route::get('report/shops',[ReportController::class,'shopReports'])->name('report.shops');
    Route::get('shop/detail/{id}',[ShopController::class,'getShopDetail'])->name('shop.detail');
    Route::get('report/establisments',[ReportController::class,'establismentReports'])->name('report.establisments');
    /*******************REPORT ROUTE END*************/
});
/****************** ADMIN MIDDLEWARE PAGES ROUTES END****************/
?>
