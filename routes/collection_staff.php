<?php
/****************** COLLECTION STAFF MIDDLEWARE PAGES ROUTES START****************/

use App\Http\Controllers\CollectionStaff\PaymentController;

Route::group(['prefix' => 'collection_staff', 'as'=>'collection_staff.','middleware' => 'auth:user','collection_staff'], function () {

    // Route::group(['middleware' => ['collection_staff'], 'prefix' => 'collection_staff'], function (){


    /*******************DASHBOARD ROUTE START*************/
    Route::view('dashboard','collection_staff.dashboard.index')->name('dashboard.index');
    /*******************DASHBOARD ROUTE END*************/
    /*******************PAYMENT ROUTE START*************/
    Route::resource('payment',PaymentController::class);
    /*******************PAYMENT ROUTE END*************/
});
/****************** COLLECTION STAFF MIDDLEWARE PAGES ROUTES END****************/
?>
