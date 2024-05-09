<?php

use App\Http\Controllers\HotelController; // jangan lupa di use
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\Customer;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Transaction;
use App\Http\Controllers\TransactionController;
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
    return view('home');
})->name('home');

Route::get('/kategori', function () {
    return view('kategori');
})->name('kategori');


Route::get('/kategori/single', function () {
    return view('single');
})->name('single');

Route::get('/kategori/standard-double', function () {
    return view('standard_double');
})->name('double');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');




Route::resource('hotel', HotelController::class);

Route::resource('product', ProductController::class);

Route::resource('transaction', TransactionController::class);

Route::resource('customer', CustomerController::class);

Route::resource('type', TypeController::class);


Route::post('transaction/showDataAjax/', [TransactionController::class, 'showAjax'])->name('transaction.showAjax');

Route::get('/report/availableHotelRooms', [HotelController::class, 'availableHotelRoom'])->name('reportShowHotel');

Route::get('/report/hotel/avgPriceByHotelType', [HotelController::class, 'avgPriceByHotelType'])->name('reportShowAvgPrice');

Route::view('ajaxExample', 'hotel.ajax');

Route::post("/hotel/showInfo", [HotelController::class, 'showInfo'])->name("hotels.showInfo");

Route::post('/hotel/showProducts', [HotelController::class, 'showProducts'])->name('hotel.showProducts');
