<?php 
/****************** ADMIN MIDDLEWARE PAGES ROUTES START****************/

use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\EstablishmentCategoryController;
use App\Http\Controllers\Admin\EstablishmentController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\ShopController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WardController;
use App\Http\Controllers\Admin\ZoneController;

Route::group(['prefix' => 'admin', 'as'=>'admin.','middleware' => 'auth:user','admin'], function () { 
    /*******************DASHBOARD ROUTE START*************/       
    Route::view('dashboard','admin.dashboard.index')->name('dashboard.index');
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
    /*******************AREA ROUTE START*************/       
    Route::resource('area',AreaController::class);
    /*******************AREA ROUTE END*************/               
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
    /*******************Shop ROUTE START*************/       
    Route::resource('shop',ShopController::class);
    /*******************Shop ROUTE END*************/        
});
/****************** ADMIN MIDDLEWARE PAGES ROUTES END****************/
?>