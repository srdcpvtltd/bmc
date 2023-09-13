<?php

use App\Http\Controllers\ZDC\ZdcController;



 Route::group(['prefix' => 'zdc', 'as'=>'zdc.','middleware' => 'auth:user','Zdc'], function () {

    Route::get('dashboard',[ZdcController::class,'index'])->name('dashboard.index');


    Route::get('/zone/establishment/{id}',[ZdcController::class,'ZoneEstablishmentReport'])->name('zone.estableshment');

    Route::get('report/zone/establishment/report/{id}',[ZdcController::class,'zoneEstablishmentShopReports'])->name('zone.estableshment.reports');
    Route::get('report/establisments/{id}',[ZdcController::class,'establismentReports'])->name('report.establisments');


});
?>
