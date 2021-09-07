<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->group('/dashboard', function () {
    Route::get('/dashboard',[StarsController::class,'index'])->name('dashboard');

    Route::get('/star',[StarsController::class,'add']);
    Route::post('/star',[StarsController::class,'create']);

    Route::get('/star/{star}',[StarsController::class,'edit']);
    Route::post('/star/{star}',[StarsController::class,'update']);

});
