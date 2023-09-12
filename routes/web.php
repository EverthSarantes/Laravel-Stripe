<?php

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
Route::get('/', [\App\Http\Controllers\IndexController::class, 'index']);
Route::get('/purcheases', [\App\Http\Controllers\IndexController::class, 'purcheases'])->middleware('auth')->name('purcheases');

Auth::routes();

Route::get('/prueba', [\App\Http\Controllers\StripeController::class, 'index'])->name('index');
Route::post('/checkout', [\App\Http\Controllers\StripeController::class, 'checkout'])->name('checkout')->middleware('auth');
Route::get('/succes', [\App\Http\Controllers\StripeController::class, 'succes'])->name('succes');


