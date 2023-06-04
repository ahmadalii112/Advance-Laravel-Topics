<?php


use App\Http\Controllers\PayOrderController;
use App\Http\Controllers\ProductController;
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
    return view('welcome');
});


Route::get('pay', [PayOrderController::class, 'store']);

Route::controller(ProductController::class)->group(function () {
    Route::get('products', 'index')->name('products.index');
    Route::post('checkout', 'checkout')->name('checkout');
    Route::get('success', 'success')->name('checkout.success');
    Route::get('cancel', 'cancel')->name('checkout.cancel');
    Route::post('webhook', 'webhook')->name('checkout.webhook');
});

