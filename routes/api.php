<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\API\LevelController;
use App\Http\Controllers\API\TaskController;
use App\Http\Controllers\API\StudentController;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ModuleController;
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
    Route::get('logout', 'logout');
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
Route::post('/add_tasktype', [TaskController::class, 'addTaskType']);
Route::post('/remove_tasktype/{id}', [TaskController::class, 'removeTaskType']);


//Questions
Route::post('/questions/{id}', [TaskController::class, 'AddQuestions']);
Route::post('/answer/id', [TaskController::class, 'AddAnswers']);
Route::post('/delete_file/{id}', [TaskController::class, 'deleteFile'])->name('deleteFile');


//Courses
Route::post('/course', [CourseController::class, 'AddCourse']);
Route::get('/course', [CourseController::class, 'GetCourse']);
Route::get('/course/{id}', [CourseController::class, 'getCoursesById']);
Route::put('/course/{id}', [CourseController::class, 'updateCoursebyId']);
Route::post('/course_topics', [CourseController::class, 'addTopicIntoCourse']);

// teachers
Route::get('/teachers', [AdminController::class, 'ListTeachers']);

//Qualification
Route::post('/add_qualifications', [AdminController::class, 'AddQualifications'])->name('AddQualifications');
Route::get('/list_qualifications', [AdminController::class, 'GetQualifications'])->name('GetQualifications');


//Students
Route::post('/student_register', [StudentController::class, 'register']);
Route::post('/student_login', [StudentController::class, 'login']);
Route::get('/student_logout/{id}', [StudentController::class, 'logout']);
Route::put('/student_profile/{id}', [StudentController::class, 'updateProfile']);
Route::post('/student/{id}', [StudentController::class, 'insertStudentProfile']);
Route::put('/student/{id}', [StudentController::class, 'updateStudentProfile']);
Route::post('/applyCourse/{id}', [StudentController::class, 'applyCourse']);
Route::post('/updateDetails/{id}', [StudentController::class, 'updateStudentDetails']);
Route::get('/student', [StudentController::class, 'getStudentDetails']);
Route::get('/student/{id}', [StudentController::class, 'getStudentDetailById']);
Route::get('/paidStudents', [StudentController::class, 'getPaidStudents']);
Route::get('/unpaidStudents', [StudentController::class, 'getUnPaidStudents']);
Route::get('/studentDetails/{id}', [StudentController::class, 'studentProfile']);
Route::get('/studentEducational/{id}', [StudentController::class, 'studentEducationalDetails']);
Route::post('/upload_student_photo/{id}', [StudentController::class,'uploadProfilePhoto']);
Route::get('/student_profile_photo/{id}', [StudentController::class, 'InternProfilePhoto']);
Route::patch('/updateEducationalDetails/{id}', [StudentController::class, 'UpdateEducationalDetails']);
Route::post('/student_reset_password', [StudentController::class, 'resetPassword']);
Route::get('/get_resume/{intern_id}', [StudentController::class, 'getInternsResume']);

// Dahsboard
Route::get('/dashboard', [HomeController::class, 'dashboard']);

//Dashboard for Students
Route::get('/student_dashboard/{id}',[StudentController::class, 'StudentDashboard']);
Route::get('/completeLevelDetails', [LevelController::class, 'GetCompleteLevelDetails']);
Route::get('/completeLevelDetails/{id}', [LevelController::class, 'GetCompleteLevelDetailsbyID']);


//Difficulty level
Route::post('/diffiultylevel', [LevelController::class, 'InsertDiffciultyLevel']);
Route::get('/difficultylevel', [LevelController::class, 'GetDifficultyLevels']);
Route::put('/difficultylevel/{id}', [LevelController::class, 'UpdateDifficultyLevel']);
Route::get('/difficultylevel/{id}', [LevelController::class, 'GetDifficultyLevelbyId']);
Route::delete('/difficultylevel/{id}', [LevelController::class, 'DeleteDifficultyLevel']);


//Task for frontend
Route::get('/task_list/{student_id}', [TaskController::class, 'TaskList']);
Route::get('/fetch_task/{student_id}', [TaskController::class, 'fetchTasks']);
Route::post('/attempt_task/{student_id}', [TaskController::class, 'taskAttempt']);
Route::post('/task_attachments/{student_id}', [TaskController::class, 'taskAttachments']);
Route::post('/complete_task/{student_id}/{task_id}/{level_id}/{difficulty}', [TaskController::class, 'taskComplete']);
Route::get('/getQuestions/{student_id}', [TaskController::class, 'fetchQuestions']);
Route::post('/checkAnswer/{student_id}', [TaskController::class, 'checkAnswer']);
Route::get('/get_task/{student_id}', [TaskController::class, 'GetTasks']);
Route::get('/taskview/{student_id}', [TaskController::class, 'TaskView']);
Route::get('/download/{id}', [TaskController::class, 'download']);
Route::get('/progress_bar/{id}', [TaskController::class, 'progressBar']);
Route::get('/task_file_download/{id}', [TaskController::class, 'downloadFile']);
Route::get('/get_pending_level_details/{student_id}', [StudentController::class,'getPendingLevelsDetails']);
Route::get('/reattempt/{task_id}',[TaskController::class,'ReattemptTask']);


//Employee
Route::post('/employee_register',[EmployeeController::class, 'EmployeeRegistration']);
Route::post('/employee_login', [EmployeeController::class, 'login']);
Route::post('/reset_password', [EmployeeController::class, 'resetPassword']);
Route::patch('/update_profile/{employee_id}', [EmployeeController::class,'updateProfile']);
Route::post('/employee_professional_details/{employee_id}', [EmployeeController::class, 'EmployeeProfessionalDetails']);
Route::get('/interns-list/{employee_id}', [EmployeeController::class, 'GetInternsList']);
Route::get('/employee_logout/{employee_id}', [EmployeeController::class, 'Logout']);
Route::get('/employee_profile/{employee_id}', [EmployeeController::class, 'GetPersonalInfo']);
Route::get('/employee_interns_by_id/{employee_id}', [EmployeeController::class, 'getInternsResume']);
Route::post('/upload_employer_photo/{id}', [EmployeeController::class,'uploadProfilePhoto']);
Route::get('/employee_professional_details/{employee_id}', [EmployeeController::class, 'GetProfessionalDetails']);
Route::get('/employee_profile_photo/{employee_id}', [EmployeeController::class, 'getEmployeeProfilePhoto']);
Route::patch('/update_employee_company_details/{employee_id}', [EmployeeController::class, 'UpdateEmployeeProfessionalDetails']);
Route::post('/employee_add_task/{employee_id}', [EmployeeController::class, 'CreateTask']);
Route::get('/task-categories', [TaskCategoryController::class, 'index'])->name('taskCategories');
Route::get('/employee_company_details/{employee_id}', [EmployeeController::class, 'GetProfessionalDetails']);
Route::get('/request_intern_contact/{employee_id}', [EmployeeController::class, 'requestInternContact']);
Route::get('/dashboard/{employee_id}', [EmployeeController::class, 'dashboard']);
Route::get('/list_tasks/{employee_id}', [EmployeeController::class, 'ListTasks']);
Route::get('/get_task_by_id/{employee_id}', [EmployeeController::class, 'getTasksById']);
Route::post('/assign_employer_task/{employer_id}', [EmployeeController::class, 'AssignTaskToIntern']);
Route::get('/list_assigned_tasks/{employer_id}', [EmployeeController::class, 'ListTaskAssigned']);
Route::get('/view_assigned_tasks/{employer_id}', [EmployeeController::class, 'ViewTaskAssigned']);
Route::post('/approve_reject/{employer_id}', [EmployeeController::class, 'ApproveOrRejectTask']);
Route::post('/select_intern/{employer_id}', [EmployeeController::class, 'SelectIntern']);
Route::get('/list_select_interns/{employer_id}', [EmployeeController::class, 'ListSelectedInterns']);
Route::get('/approved_interns/{employee_id}', [EmployeeController::class, 'ListApprovedInterns']);

