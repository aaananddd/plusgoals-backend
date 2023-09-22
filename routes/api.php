<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\TaskController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    });
Route::post('update_profile',[AdminController::class, 'updateProfile']);
Route::post('get_users', [AdminController::class, 'GetUsers']);
Route::post('get_user_byId', [AdminController::class, 'GetUserbyId']);

//Levels
Route::post('insert_level', [LevelController::class, 'InsertLevel']);
Route::post('update_level', [LevelController::class, 'UpdateLevel']);
Route::post('delete_level', [LevelController::class, 'DeleteLevel']);
Route::post('get_level', [LevelController::class, 'GetLevels']);
Route::post('get_level_byId', [LevelController::class, 'GetLevelbyId']);

//Task 
Route::post('insert_task', [TaskController::class, 'InsertTask']);
Route::post('update_task', [TaskController::class, 'UpdateTask']);
Route::post('delete_task', [TaskController::class, 'DeleteTask']);
Route::post('get_task', [TaskController::class, 'GetTask']);
Route::post('get_task_byId', [TaskController::class, 'GetTaskbyId']);