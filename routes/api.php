<?php

use App\Http\Controllers\Api\EstablishmentCategoryController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EstablishmentController;
use App\Http\Controllers\Api\EstablishmentShopController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\ShopController;
use App\Http\Controllers\Api\StructureController;
use App\Http\Controllers\Api\WardController;
use App\Http\Controllers\Api\ZoneController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('login',[AuthController::class,'login'])->name('login');;
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::resource('shops', ShopController::class);
    Route::post('shop/store', [ShopController::class,'store']);
    Route::resource('payments', PaymentController::class);
    Route::post('payment/store', [PaymentController::class,'store']);
    Route::post('get_taken_establishment_shop', [EstablishmentShopController::class,'getTakenEstablishmentShops']);
    Route::resource('establishment_category', EstablishmentCategoryController::class);
    Route::resource('establishment', EstablishmentController::class);
    Route::resource('establishment_shop', EstablishmentShopController::class);
    Route::resource('structure', StructureController::class);
    Route::resource('ward', WardController::class);
    Route::resource('zone', ZoneController::class);
    // Route::post('logout',[AuthController::class,'logout'])->name('logout');;
});
