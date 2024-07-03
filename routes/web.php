<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\HotelController; // jangan lupa di use
use App\Http\Controllers\ordercontroller;
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


// view only and can be guess
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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/home', function () {
    return view('welcome');
})->name('home');


Route::middleware(['auth'])->group(function () {


    Route::get('/admin', function () {
        return view('admin');
    })->name('admin')->middleware('RoleChecker:owner');

    Route::resource('hotel', HotelController::class);

    Route::resource('product', ProductController::class);

    Route::resource('transaction', TransactionController::class);

    Route::resource('customer', CustomerController::class);

    Route::resource('cart', CartController::class);




    Route::get('/laralux', [FrontEndController::class, 'index'])->name('laralux.index');

    Route::get('laralux/user/cart', function () {
        return view('frontend.cart');
    })->name('cart');


    Route::get('/laralux/{laralux}', [
        FrontEndController::class,
        'show'
    ])->name('laralux.show');
    Route::get('laralux/hotel/{id}', [FrontEndController::class, 'hotel'])->name('laralux.hotel');
    Route::get('laralux/cart/add/{id}', [FrontEndController::class, 'addToCart'])->name('addCart');
    Route::get('laralux/cart/shop/{id}', [FrontEndController::class, 'shop'])->name('shop');
    Route::get('laralux/cart/delete/{id}', [FrontEndController::class, 'deleteFromCart'])->name('delFromCart');
    Route::post('laralux/cart/changeQuantity', [FrontEndController::class, 'changeQuantity'])->name('changeQuantity');
    // Route::post('laralux/cart/addQty', [FrontEndController::class, 'addQuantity'])->name('addQty');
    // Route::post('laralux/cart/reduceQty', [FrontEndController::class, 'reduceQuantity'])->name('redQty');
    Route::post('laralux/cart/editCheckIn', [FrontEndController::class, 'editCheckIn'])->name('editCheckIn');
    Route::post('laralux/cart/editPoints', [FrontEndController::class, 'editPoints'])->name('editPoints');
    Route::get('laralux/cart/checkout', [FrontEndController::class, 'checkout'])->name('laralux.checkout');
    Route::post('transaction/checkout', [TransactionController::class, 'checkout'])->name('checkout');
});

Route::resource('type', TypeController::class)->middleware('auth');

Route::post('transaction/showDataAjax/', [TransactionController::class, 'showAjax'])->name('transaction.showAjax');

Route::get('/report/availableHotelRooms', [HotelController::class, 'availableHotelRoom'])->name('reportShowHotel');

Route::get('/report/hotel/avgPriceByHotelType', [HotelController::class, 'avgPriceByHotelType'])->name('reportShowAvgPrice');

Route::view('ajaxExample', 'hotel.ajax');

Route::post("/hotel/showInfo", [HotelController::class, 'showInfo'])->name("hotels.showInfo");

Route::post('/hotel/showProducts', [HotelController::class, 'showProducts'])->name('hotel.showProducts');

Route::post('type/getEditForm', [TypeController::class, 'getEditForm'])->name('type.getEditForm');

Route::post('type/getEditFormB', [TypeController::class, 'getEditFormB'])->name('type.getEditFormB');

Route::post('type/saveDataTD', [TypeController::class, 'saveDataTD'])->name('type.saveDataTD');

Route::post('type/deleteData', [TypeController::class, 'deleteData'])->name('type.deleteData');

Route::post('customer/getEditForm', [CustomerController::class, 'getEditForm'])->name('customer.getEditForm');

Route::post('customer/deleteData', [CustomerController::class, 'deleteData'])->name('customer.deleteData');

Route::post('product/getEditForm', [ProductController::class, 'getEditForm'])->name('product.getEditForm');

Route::post('product/deleteData', [ProductController::class, 'deleteData'])->name('product.deleteData');

Route::post('transaction/getEditForm', [TransactionController::class, 'getEditForm'])->name('transaction.getEditForm');

Route::post('transaction/deleteData', [TransactionController::class, 'deleteData'])->name('transaction.deleteData');

Route::post('cart/getAddForm', [CartController::class, 'getAddForm'])->name('cart.getAddForm');

Route::post('cart/getEditForm', [CartController::class, 'getEditForm'])->name('cart.getEditForm');

Route::post('cart/saveDataTD', [CartController::class, 'saveDataTD'])->name('cart.saveDataTD');

Route::post('cart/deleteData', [CartController::class, 'deleteData'])->name('cart.deleteData');
Route::get('/product/price/{id}', [TransactionController::class, 'getPrice'])->name('product.price');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('hotel/uploadLogo/{hotel_id}', [HotelController::class, 'uploadLogo'])->name('hotel.uploadLogo');

Route::post('hotel/simpanLogo', [HotelController::class, 'simpanLogo'])->name('hotel.simpanLogo');

Route::get('hotel/uploadPhoto/{hotel_id}', [HotelController::class, 'uploadPhoto'])->name('hotel.uploadPhoto');

Route::post('hotel/simpanPhoto', [HotelController::class, 'simpanPhoto'])->name('hotel.simpanPhoto');

Route::get('product/uploadPhoto/{product_id}', [ProductController::class, 'uploadPhoto'])->name('product.uploadPhoto');

Route::post('product/simpanPhoto', [ProductController::class, 'simpanPhoto'])->name('product.simpanPhoto');

Route::post('product/delPhoto', [ProductController::class, 'delPhoto']);






Route::get('/laralux', [FrontEndController::class, 'index'])->name('laralux.index');

Route::get('/laralux/{laralux}', [FrontEndController::class, 'show'])->name('laralux.show');

Route::get('/laralux/user/Receipt', [FrontEndController::class, 'receipt'])->name('laralux.receipt');

Route::get('/laralux/user/DeleteAllCart', [FrontEndController::class, 'deleteAllCart'])->name('laralux.deleteAllCart');
