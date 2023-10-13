<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\AdminController;
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
Route::get('/add_questions/{id}', function() {return view('add_Questions');});
Route::get('/task', function() {return view('task');});
Route::get('/assigntask', function() {return view('assign_task');});

Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/profileView', [ProfileController::class, 'index'])->name('profileView');
Route::post('/loginCheck', [LoginController::class, 'loginCheck'])->name('loginCheck');
Route::post('/forgotPassword',[LoginController::class, 'forgotPassword'])->name('forgotPassword');
Route::get('/taskDetails',[TaskController::class, 'GetTask'])->name('taskDetails');
Route::post('/addTask', [TaskController::class, 'InsertTask'])->name('addTask');
Route::get('/taskLevel', [LevelController::class, 'GetLevels'])->name('taskLevel');
Route::get('/addQuestion/{id}/{limit}', [TaskController::class, 'AddQuestion'])->name('addQuestion');
Route::post('/saveQuestions/{task_id}', [TaskController::class, 'SaveQuestions'])->name('saveQuestions');
Route::get('/teachers', [AdminController::class, 'teachersList'])->name('teachers');
Route::get('/courselist', [CourseController::class, 'index'])->name('courselist');