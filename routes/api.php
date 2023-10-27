<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\API\LevelController;
use App\Http\Controllers\API\TaskController;
use App\Http\Controllers\API\CourseController;
use App\Http\Controllers\API\StudentController;
use App\Http\Controllers\HomeController;
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
    Route::get('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    });

Route::post('/users', [AdminController::class, 'AddUser']);
Route::put('/users/{id}',[AdminController::class, 'updateProfile']);
Route::get('/users', [AdminController::class, 'GetUsers']);
Route::get('/users/{id}', [AdminController::class, 'GetUserbyId']);
Route::delete('/users/{id}', [AdminController::class, 'DeleteUser']);

//Roles
Route::post('/role', [AdminController::class, 'InsertRoles']);
Route::put('/role/{id}', [AdminController::class, 'UpdateRole']);
Route::delete('/role/{id}', [AdminController::class, 'DeleteRole']);
Route::patch('/role/{id}', [AdminController::class, 'ActivateRole']);

//Levels
Route::post('/level', [LevelController::class, 'InsertLevel']);
Route::put('/level/{id}', [LevelController::class, 'UpdateLevel']);
Route::delete('/level/{id}', [LevelController::class, 'DeleteLevel']);
Route::get('/level', [LevelController::class, 'GetLevels']);
Route::get('/level/{id}', [LevelController::class, 'GetLevelbyId']);

//Task 
Route::post('/task', [TaskController::class, 'InsertTask']);
Route::put('/task/{id}', [TaskController::class, 'UpdateTask']);
Route::delete('/task/{id}', [TaskController::class, 'DeleteTask']);
Route::get('/task', [TaskController::class, 'GetTask']);
Route::get('/task/{id}', [TaskController::class, 'GetTaskbyId']);
Route::get('/assignTask/{id}', [TaskController::class, 'assignTask']);

//Questions
Route::post('/questions/{id}', [TaskController::class, 'AddQuestions']);
Route::post('/answer/id', [TaskController::class, 'AddAnswers']);


//Courses
Route::post('/course', [CourseController::class, 'AddCourse']);
Route::get('/course', [CourseController::class, 'GetCourse']);
Route::get('/course/{id}', [CourseController::class, 'getCoursesById']);

// teachers
Route::get('/teachers', [AdminController::class, 'ListTeachers']);

//Students
Route::post('/student_register', [StudentController::class, 'register']);
Route::get('/student_login', [StudentController::class, 'login']);
Route::post('/student_profile/{id}', [StudentController::class, 'updateProfile']);
Route::post('/student/{id}', [StudentController::class, 'insertStudentProfile']);
Route::put('/student/{id}', [StudentController::class, 'updateStudentProfile']);
Route::post('/applyCourse/{id}', [StudentController::class, 'applyCourse']);
Route::post('/updateDetails/{id}', [StudentController::class, 'updateStudentDetails']);
Route::get('/student', [StudentController::class, 'getStudentDetails']);
Route::get('/student/{id}', [StudentController::class, 'getStudentDetailById']);
Route::get('/paidStudents', [StudentController::class, 'getPaidStudents']);
Route::get('/unpaidStudents', [StudentController::class, 'getUnPaidStudents']);
Route::get('/studentDetails/{id}', [StudentController::class, 'studentProfile']);
Route::get('/studentEductaional/{id}', [StudentController::class, 'studentEducationalDetails']);

// Dahsboard
Route::get('/dashboard', [HomeController::class, 'dashboard']);


//Difficulty level
Route::post('/insertdiffiultylevel', [LevelController::class, 'InsertDiffciultyLevel']);
Route::get('/difficultylevels', [LevelController::class, 'GetDifficultyLevels']);
