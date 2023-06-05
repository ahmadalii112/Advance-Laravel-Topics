<?php

use App\Postcard;
use App\PostcardSendingService;
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


Route::get('/postcards', function () {
    // Long way of doing it
    $postcardService = new PostcardSendingService('us', 4, 6);
    $postcardService->hello('Hello Ahmad', 'ahmad@mailinator.com');
});

// Facade way of doing it
Route::get('/facades', function () {
    Postcard::hello('Hello Aiman', 'aiman@mailinator.com');
});
