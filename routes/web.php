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

Route::get('/', function () {return view('login');});
Route::get('/reset_password', function() {return view('password');});
Route::get('/dashboard', function() {return view('dashboard');});
Route::get('/profile', function() {return view('profile');});

//Auth::routes();
//API
Route::post('/loginCheck', [App\Http\Controllers\LoginController::class, 'loginCheck'])->name('loginCheck');
Route::post('/forgotPassword',[App\Http\Controllers\LoginController::class, 'forgotPassword'])->name('forgotPassword');

