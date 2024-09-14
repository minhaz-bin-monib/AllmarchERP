<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\SalesInvoiceController;
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

Route::get('/',[DashboardController::class, 'index']);


// ------------------------- Product Routes ------------------------

Route::group(['prefix' => 'product'], function () {
    Route::get('list', [ProductController::class, 'show']);
    Route::get('create', [ProductController::class, 'create']);
    Route::post('create', [ProductController::class, 'store']);
    Route::get('delete/{id}', [ProductController::class, 'delete']);
    Route::get('edit/{id}', [ProductController::class, 'edit']);
    Route::post('update/{id}', [ProductController::class, 'update']);

    // APIs
    Route::get('getList', [ProductController::class, 'getList']);
});

// ------------------------- Employee Routes ------------------------

Route::group(['prefix' => 'employee'], function () {
    Route::get('list', [EmployeeController::class, 'show']);
    Route::get('create', [EmployeeController::class, 'create']);
    Route::post('create', [EmployeeController::class, 'store']);
});

// ------------------------- Customer Routes ------------------------

Route::group(['prefix' => 'customer'], function () {
    Route::get('list', [CustomerController::class, 'show']);
    Route::get('create', [CustomerController::class, 'create']);
    Route::post('create', [CustomerController::class, 'store']);
    Route::get('delete/{id}', [CustomerController::class, 'delete']);
    Route::get('edit/{id}', [CustomerController::class, 'edit']);
    Route::post('update/{id}', [CustomerController::class, 'update']);

    //APIs
    Route::get('getList', [CustomerController::class, 'getList']);
});

// ------------------------- Batch Routes ------------------------

Route::group(['prefix' => 'batch'], function () {
    Route::get('list', [BatchController::class, 'show']);
    Route::get('create', [BatchController::class, 'create']);
    Route::post('create', [BatchController::class, 'store']);
    Route::get('delete/{id}', [BatchController::class, 'delete']);
    Route::get('edit/{id}', [BatchController::class, 'edit']);
    Route::post('update/{id}', [BatchController::class, 'update']);

    // APIs
    Route::get('getBatchByProductId/{id}', [BatchController::class, 'getBatchByProductId']);
    Route::get('getBatchByCustomerAndProductId/{cid}/{pid}', [BatchController::class, 'getBatchByCustomerAndProductId']);
});

// ------------------------- SalesInvoice Routes ------------------------

Route::group(['prefix' => 'salesInvoice'], function () {
    Route::get('list', [SalesInvoiceController::class, 'show']);
    Route::get('create', [SalesInvoiceController::class, 'create']);
    Route::post('create', [SalesInvoiceController::class, 'store']);
    Route::get('delete/{id}', [SalesInvoiceController::class, 'delete']);
    Route::get('edit/{id}', [SalesInvoiceController::class, 'edit']);
    Route::post('update/{id}', [SalesInvoiceController::class, 'update']);

    // APIs
    
});