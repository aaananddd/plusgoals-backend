<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;

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
Route::get('/dashboard/{id}', function() {return view('dashboard');});
Route::get('/profile', function() {return view('profile');});
Route::get('/add_task', function() {return view('add_task');});
Route::get('/assign_task', function() {return view('assign_task');});
Route::get('/add_questions', function() {return view('add_Questions');});

Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/profileView', [ProfileController::class, 'index'])->name('profileView');
Route::post('/loginCheck', [LoginController::class, 'loginCheck'])->name('loginCheck');
Route::post('/forgotPassword',[App\Http\Controllers\LoginController::class, 'forgotPassword'])->name('forgotPassword');

