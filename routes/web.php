<?php

use App\Http\Controllers\HotelController; // jangan lupa di use
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\Customer;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Transaction;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Auth;
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

Route::middleware(['auth'])->group(function () {
    Route::resource('hotel', HotelController::class);

    Route::resource('product', ProductController::class);

    Route::resource('transaction', TransactionController::class);

    Route::resource('customer', CustomerController::class);
});

Route::resource('type', TypeController::class)->middleware('auth');

Route::post('transaction/showDataAjax/', [TransactionController::class, 'showAjax'])->name('transaction.showAjax');

Route::get('/report/availableHotelRooms', [HotelController::class, 'availableHotelRoom'])->name('reportShowHotel');

Route::get('/report/hotel/avgPriceByHotelType', [HotelController::class, 'avgPriceByHotelType'])->name('reportShowAvgPrice');

Route::view('ajaxExample', 'hotel.ajax');

Route::post("/hotel/showInfo", [HotelController::class, 'showInfo'])->name("hotels.showInfo");

Route::post('/hotel/showProducts', [HotelController::class, 'showProducts'])->name('hotel.showProducts');

Route::post('customtype/getEditForm', [TypeController::class, 'getEditForm'])->name('type.getEditForm');

Route::post('customtype/getEditFormB', [TypeController::class, 'getEditFormB'])->name('type.getEditFormB');

Route::post('customtype/saveDataTD', [TypeController::class, 'saveDataTD'])->name('type.saveDataTD');

Route::post('customtype/deleteData', [TypeController::class, 'deleteData'])->name('type.deleteData');

Route::post('customcustomer/getEditForm', [CustomerController::class, 'getEditForm'])->name('customer.getEditForm');

Route::post('customcustomer/deleteData', [CustomerController::class, 'deleteData'])->name('customer.deleteData');

Route::post('customproduct/getEditForm', [ProductController::class, 'getEditForm'])->name('product.getEditForm');

Route::post('customproduct/deleteData', [ProductController::class, 'deleteData'])->name('product.deleteData');

Route::post('customtransaction/getEditForm', [TransactionController::class, 'getEditForm'])->name('transaction.getEditForm');

Route::post('customtransaction/deleteData', [TransactionController::class, 'deleteData'])->name('transaction.deleteData');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
