<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Users\DriverController;
use App\Http\Controllers\Users\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;

//Home Routes
Route::get('/', [HomeController::class, 'index']);

// Auth Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/profile', [HomeController::class, 'myProfile']);
Route::post('/updateProfile/{id}', [HomeController::class, 'updateProfile']);

//Driver Routes
Route::get('/driverList', [DriverController::class, 'index']);
Route::post('/addNewDriver', [DriverController::class, 'addDriver'])->name('createDriver');
Route::get('/viewDriver/{id}', [DriverController::class, 'viewDriverDetails']);
Route::get('/driver/{id}/{status}', [DriverController::class, 'updateStatus'])->name('driver.status.update');
Route::post('/driverUpdate/{id}', [DriverController::class, 'updateDriver']);
Route::post('/createDelivery/{id}', [DriverController::class, 'createDelivery'])->name('createDelivery');
Route::get('/getDeliveryDetails/{id}', [DriverController::class, 'getDeliveryDetails']);
Route::post('/updateDelivery', [DriverController::class, 'updateDelivery']);

//Customer Routes
Route::get('/customerList', [CustomerController::class, 'index']);
Route::post('/addNewCustomer', [CustomerController::class, 'addCustomer'])->name('createCustomer');
Route::get('/viewCustomer/{id}', [CustomerController::class, 'viewCustomerDetails']);
Route::get('/customer/{id}/{status}', [CustomerController::class, 'updateStatus'])->name('customer.status.update');
Route::post('/customerUpdate/{id}', [CustomerController::class, 'updateCustomer']);
Route::get('/viewReceipt/{id}/{customerID}', [CustomerController::class, 'viewReceipt']);
Route::get('/printReceipt/{id}/{customerID}', [CustomerController::class, 'printReceipt']);

//Warehouse Routes
Route::get('/itemList', [ProductController::class, 'index']);
Route::post('/addNewItem', [ProductController::class, 'addItem'])->name('createItem');
Route::get('/viewItem/{id}', [ProductController::class, 'viewItemDetails']);
Route::get('/item/{id}/{status}', [ProductController::class, 'updateStatus'])->name('item.status.update');
Route::post('/itemUpdate/{id}', [ProductController::class, 'updateItem']);
Route::post('/addCustomPrice/{id}', [ProductController::class, 'addCustomPrice']);
Route::get('/getCustomPriceDetails/{id}', [ProductController::class, 'getCustomPriceDetails']);
Route::post('/updateCustomPrice', [ProductController::class, 'updateCustomPrice']);


