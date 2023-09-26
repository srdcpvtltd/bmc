<?php
/****************** COLLECTION STAFF MIDDLEWARE PAGES ROUTES START****************/

use App\Http\Controllers\CollectionStaff\PaymentController;
use App\Http\Controllers\CollectionStaff\ShopController;

Route::group(['prefix' => 'collection_staff', 'as'=>'collection_staff.','middleware' => 'auth:user','collection_staff'], function () {

    // Route::group(['middleware' => ['collection_staff'], 'prefix' => 'collection_staff'], function (){


    /*******************DASHBOARD ROUTE START*************/
    Route::view('dashboard','collection_staff.dashboard.index')->name('dashboard.index');
    /*******************DASHBOARD ROUTE END*************/
    /*******************SHOP ROUTE START*************/
    Route::post('shop/get_wards',[ShopController::class,'getWards'])->name('shop.get_wards');
    Route::post('shop/get_establishments',[ShopController::class,'getEstablishments'])->name('shop.get_establishments');
    Route::post('shop/get_establishment_shops',[ShopController::class,'getEstablishmentShops'])->name('shop.get_establishment_shops');
    Route::post('shop/get_establishment_shop',[ShopController::class,'getEstablishmentShop'])->name('shop.get_establishment_shop');
    Route::resource('shop',ShopController::class);
    /*******************SHOP ROUTE END*************/
    /*******************PAYMENT ROUTE START*************/
    Route::resource('payment',PaymentController::class);
    /*******************PAYMENT ROUTE END*************/
});
/****************** COLLECTION STAFF MIDDLEWARE PAGES ROUTES END****************/
?>
