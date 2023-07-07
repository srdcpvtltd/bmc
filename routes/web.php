<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CronjobController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

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

/******************LOGIN PAGE ROUTES START****************/
Route::view('/','auth.login');
Route::view('login','auth.login');
Route::post('login',[AuthController::class,'login'])->name('login');
/******************LOGIN PAGE ROUTES END****************/

/*******************REGISTER ROUTE START*************/      
Route::view('register','auth.register');
Route::post('register',[AuthController::class,'register'])->name('register');
/*******************REGISTER ROUTE END*************/     

/*******************CRONJOB ROUTES ROUTE START*************/       
Route::get('get-payments',[CronjobController::class,'getPayments'])->name('logout');
/*******************LOGOUT ROUTE END*************/    
/*******************LOGOUT ROUTE START*************/       
Route::get('logout',[AuthController::class,'logout'])->name('logout');
/*******************LOGOUT ROUTE END*************/     
Route::post('get_city_against_states',[AuthController::class,'getCityAgainstStates'])->name('get_city_against_states');
Route::post('get_state_against_countries',[AuthController::class,'getStateAgainstCountries'])->name('get_state_against_countries');


/*******************ADMIN ROUTE START*************/       
include __DIR__ . '/admin.php';
/*******************ADMIN ROUTE END*************/   
/*******************COLLECTION STAFF ROUTE START*************/       
include __DIR__ . '/collection_staff.php';
/*******************COLLECTION STAFF ROUTE END*************/     

     
/******************FUNCTIONALITY ROUTES****************/
Route::get('cd', function() {
    Artisan::call('config:cache');
    Artisan::call('migrate:refresh');
    Artisan::call('db:seed', [ '--class' => DatabaseSeeder::class]);
    Artisan::call('view:clear');
    return 'DONE';
  });
  Route::get('migrate', function() {
    Artisan::call('config:cache');
    Artisan::call('migrate');
    Artisan::call('view:clear');
    return 'DONE';
  });
  Route::get('cache_clear', function() {
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    return 'DONE';
  });