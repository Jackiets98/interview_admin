<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Flutter\DriverController;

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

Route::post('/driverLogin', [DriverController::class, 'driverLogin']);
Route::post('/startDelivery/{id}/{deliveryID}', [DriverController::class, 'startDelivery']);
Route::post('/stopDelivery/{id}/{deliveryID}', [DriverController::class, 'stopDelivery']);
Route::get('/deliveryList/{id}', [DriverController::class, 'driverDeliveryList']);
Route::get('/productList/{id}', [DriverController::class, 'productList']);
Route::post('/addOns/{id}/{customerID}', [DriverController::class, 'addOns']);
Route::get('/getAddOns/{id}/{customerID}', [DriverController::class, 'addOnList']);
Route::post('/cancelAddOn/{id}', [DriverController::class, 'cancelAddOns']);
Route::post('/confirmPayment/{id}', [DriverController::class, 'confirmPayment']);
Route::post('/updateDriver/{id}', [DriverController::class, 'updateDriver']);
Route::get('/getDriverDetails/{id}', [DriverController::class, 'getDriverDetails']);



