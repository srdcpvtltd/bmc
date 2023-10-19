<?php

use App\Http\Controllers\ZDC\CollectionController;
use App\Http\Controllers\ZDC\PendingPaymentController;
use App\Http\Controllers\ZDC\ShopController;
use App\Http\Controllers\ZDC\ZdcController;
use App\Models\PendingPayment;

 Route::group(['prefix' => 'zdc', 'as'=>'zdc.','middleware' => 'auth:user','Zdc'], function () {

    Route::get('dashboard',[ZdcController::class,'index'])->name('dashboard.index');


    Route::get('/zone/establishment/{id}',[ZdcController::class,'ZoneEstablishmentReport'])->name('zone.estableshment');

    Route::get('report/zone/establishment/report/{id}',[ZdcController::class,'zoneEstablishmentShopReports'])->name('zone.estableshment.reports');
    Route::get('report/establisments/{id}',[ZdcController::class,'establismentReports'])->name('report.establisments');

    Route::get('collection/daily',[CollectionController::class,'getDailyCollection'])->name('collection.daily');
    Route::get('collection/monthly',[CollectionController::class,'getMonthlyCollection'])->name('collection.monthly');
    Route::get('collection/monthly_detail/{id}',[CollectionController::class,'getMonthlyCollectionDetail'])->name('collection.monthly_detail');
   
    Route::resource('shop',ShopController::class);
    Route::resource('pending_payment',PendingPaymentController::class);
});
?>
