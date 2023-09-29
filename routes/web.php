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

// Route::get('/', function () {
//     return view('login');
// });

Auth::routes();

Route::get('/login', [App\Http\Controllers\LoginController::class, 'index'])->name('login');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('loginCheck', [App\Http\Controllers\LoginController::class, 'loginCheck'])->name('loginCheck');

Route::get('/', function () {
        return view('profile');
    });