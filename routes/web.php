<?php

use App\Http\Controllers\AirlineController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('layouts.app');
});

Route::resource('post', PostController::class);
Route::resource('student', StudentController::class);
Route::resource('product', ProductController::class);
Route::resource('client', ClientController::class);
Route::resource('brand', BrandController::class);
Route::resource('car', CarController::class);
Route::resource('airline', AirlineController::class);
Route::resource('flight', FlightController::class);
