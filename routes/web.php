<?php

use App\Http\Controllers\KamarController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenghuniController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Kernel;

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

// Route::get('/login', function () {
//     return view('login');
// });

// Route::get('/dashboard', function(){
//     return view('index');
// });
// Route::namespace('Login')->prefix('login')->name('login.')->group(function () {

//     Route::resource('/login', LoginController::class)->middleware('guest');

// });
Route::resource('/login', LoginController::class, ['names' => 'login'])->middleware('guest');
Route::post('/postlogin', [LoginController::class,'loginn']);
Route::post('/logout', [LoginController::class,'logout']);

Route::resource('/dashboard', DashboardController::class)->middleware('auth');
Route::resource('/kamar', KamarController::class)->middleware('auth');
Route::resource('/penghuni', PenghuniController::class)->middleware('auth');
Route::resource('/pembayaran', PembayaranController::class)->middleware('auth');
Route::get('/selesai', [PembayaranController::class, 'selesai'])->middleware('auth');
Route::post('store', [KamarController::class,'store'])->middleware('auth');
Route::post('editkamar', [KamarController::class,'show'])->middleware('auth');
Route::post('update', [KamarController::class,'update'])->middleware('auth');
Route::post('deletekamar', [KamarController::class,'destroy'])->middleware('auth');
Route::post('storepenghuni', [PenghuniController::class,'store'])->middleware('auth');
Route::post('editPenghuni', [PenghuniController::class,'show'])->middleware('auth');
Route::post('updatePenghuni', [PenghuniController::class,'update'])->middleware('auth');
Route::post('deletePenghuni', [PenghuniController::class,'destroy'])->middleware('auth');
Route::post('bayar', [PembayaranController::class,'update'])->middleware('auth');
