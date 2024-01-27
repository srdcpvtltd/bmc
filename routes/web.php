<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CronjobController;
use App\Services\SmsService;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
// use Rap2hpoutre\LaravelLogViewer\LogViewerController;

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
Route::view('success_message','auth.success_message');
Route::post('success',[AuthController::class,'success'])->name('success');
Route::get('payment-for-api',[AuthController::class,'paymentForApi'])->name('payment_for_api');
Route::post('success-for-api',[AuthController::class,'successForApi'])->name('success_for_api');
Route::post('login',[AuthController::class,'login'])->name('login');
Route::get('fix-payment-issue',[AuthController::class,'paymentIssue'])->name('paymment.issue');
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
/*******************SUPER ADMIN ROUTE START*************/
include __DIR__ . '/super_admin.php';
/*******************SUPER ADMIN ROUTE END*************/
/*******************COLLECTION STAFF ROUTE START*************/
include __DIR__ . '/collection_staff.php';
/*******************COLLECTION STAFF ROUTE END*************/


/*******************ZDC STAFF ROUTE START*************/
include __DIR__ . '/zdc.php';
/*******************ZDC STAFF ROUTE END*************/

/******************FUNCTIONALITY ROUTES****************/
Route::get('test_sms', function() {
   $response = (new SmsService())->sendWhatsappSMS('7008124707');
   dd($response);
    return 'DONE';
  });Route::get('cd', function() {
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

  Route::get('testing', function() {
    Artisan::call('create:monthly-payments');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    return 'DONE';
  });
  // Route::get('logs', [LogViewerController::class, 'index']);
// 
  // Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

