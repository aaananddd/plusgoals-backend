<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\API\StudentController;
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
Route::get('/profile_view', function() {return view('profile_view');});
Route::get('/add_task', function() {return view('add_task');});
Route::get('/assign_task', function() {return view('assign_task');});
Route::get('/add_questions/{id}', function() {return view('add_Questions');});
Route::get('/task', function() {return view('task');});
Route::get('/taskview/{task_id}', function() {return view('task_view');});
Route::get('/student_view/{id}', function() {return view('student_view');});
Route::get('/teachers_view/{id}', function() {return view('teachers_view');});
Route::get('/course_view/{id}', function() {return view('course_view');});
Route::get('/task_details/{task_id}', function() {return view('taskdetails');});
Route::get('/course_edit/{id}', function() {return view('course_edit');});
Route::get('/profile_edit', function() {return view('profile_edit');});
Route::get('/create_user', function() {return view('create_user');});
Route::get('/create_course', function() {return view('create_course');});
Route::get('/edit_questions', function() {return view('edit_questions');});
Route::get('/student_status/{id}', function() {return view('student_status');});
Route::get('/edit_users', function() {return view('edit_users');});
Route::get('/taskPendingApproval', function() {return view('tasks_pending_approval');});
Route::get('/approve_tasks/{task_id}', function() {return view('approve_tasks');});
Route::get('/frequent_tasks', function() {return view('frequent_tasks');});
Route::get('/completed_task_view', function() {return view('completed_task_view');});
Route::get('/selecttasktype', function() { return view('select_task_type');});
Route::get('/short_answer', function() { return view('short_answer');});
Route::get('/short_task_view', function() { return view('short_task_view');});
Route::get('/no_task', function() { return view('no_task');});
Route::get('/descriptive/{task_id}', function() { return view('descriptive');});
Route::get('/forgot_password', function() { return view('forgot_password');});
Route::get('/Others', function() { return view('others');});
Route::get('/add_new_category',function() { return view('add_new_category');});
Route::get('/add_new_module', function() { return view('add_new_module');});
Route::get('/module_view/{module_id}', function() { return view('module_view');});
Route::get('/add_new_task_category', function() { return view('add_new_task_category');});
Route::get('/set_sort_data', function() { return view('set_sort_data');});
Route::get('/descriptive_tasks', function() { return view('manual_correction');});

Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/profileView', [ProfileController::class, 'index'])->name('profileView');
Route::post('/loginCheck', [LoginController::class, 'loginCheck'])->name('loginCheck');
//Route::get('/loginCheck', [AuthController::class, 'login'])->name('loginCheck');
// Route::post('/forgotPassword',[LoginController::class, 'forgotPassword'])->name('forgotPassword');
Route::get('/taskDetails',[TaskController::class, 'GetTask'])->name('taskDetails');
Route::post('/addTask', [TaskController::class, 'InsertTask'])->name('addTask');
Route::get('/taskLevel', [LevelController::class, 'GetLevels'])->name('taskLevel');
Route::get('/addQuestion/{id}/{limit}', [TaskController::class, 'AddQuestion'])->name('addQuestion');
Route::get('/addQuestionforShortTask/{id}/{limit}', [TaskController::class, 'AddQuestionforShort'])->name('AddQuestionforShort');
Route::post('/saveQuestions/{task_id}', [TaskController::class, 'SaveQuestions'])->name('saveQuestions');
Route::post('/SaveShortQuestions/{task_id}', [TaskController::class, 'SaveShortQuestions'])->name('SaveShortQuestions');
Route::get('/teachers', [AdminController::class, 'teachersList'])->name('teachers');
Route::get('/courselist', [CourseController::class, 'index'])->name('courselist');
Route::get('/students', [StudentController::class, 'getStudentDetails'])->name('students');
Route::get('/paidStudents', [StudentController::class, 'getPaidStudents'])->name('paidStudents');
Route::get('/unpaidStudents', [StudentController::class, 'getUnPaidStudents'])->name('unpaidStudents');
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
Route::get('/logout', [HomeController::class, 'logout'])->name('logout');
Route::get('/taskdetails/{id}',[TaskController::class, 'GetTaskView'])->name('taskdetails'); 
Route::get('/difficultylevels', [LevelController::class, 'GetDifficultyLevels'])->name('difficultylevels');
Route::post('/insertdifficultylevels', [LevelController::class, 'InsertDiffciultyLevel'])->name('insertdifficultylevels');
Route::get('/task/{id}',[TaskController::class, 'GetTaskbyId'])->name('task'); 
Route::get('/student_view/{id}', [StudentController::class, 'getStudentDetailAdminById'])->name('student_view');
Route::get('/intern_info/{intern_id}/{employer_id}', [StudentController::class, 'getInternInfoAdminById'])->name('intern_info');
Route::get('/teachersView/{id}', [AdminController::class, 'GetTeacherbyId'])->name('teachers_view');
Route::get('/course_view/{id}', [CourseController::class, 'getCoursesById'])->name('course_view');
Route::post('/update_task/{id}',[TaskController::class, 'UpdateTask'])->name('update_task'); 
Route::post('/updatecourse/{id}',[CourseController::class, 'updateCoursebyId'])->name('updatecourse');
Route::get('/courseedit/{id}',[CourseController::class, 'CoursesById'])->name('courseedit'); 
Route::post('/editprofile/{id}', [ProfileController::class, 'EditProfile'])->name('editprofile');
Route::post('/updateprofile/{id}', [ProfileController::class, 'UpdateProfile'])->name('updateprofile');
Route::post('/addUser', [ProfileController::class, 'AddUser'])->name('addUser');
Route::post('/create_user', [ProfileController::class, 'CreateUser'])->name('CreateUser');
Route::post('/add_course', [CourseController::class, 'AddCourse'])->name('add_course');
Route::get('/editQuestion/{id}/{limit}/{currentQuestion}', [TaskController::class, 'EditQuestions'])->name('editQuestion');
Route::post('/SaveEditQuestions/{id}/{currentlimit}/{currentQuestionId}', [TaskController::class, 'SaveEditQuestions'])->name('SaveEditQuestions');
Route::get('/courseLevel', [CourseController::class, 'CourseLevels'])->name('courseLevel');
Route::get('/student_status/{id}', [StudentController::class, 'getStudentStatusById'])->name('student_status');
Route::get('/student_date_filter', [StudentController::class, 'datefilter'])->name('student_date_filter');
Route::get('/teachersLevel', [AdminController::class, 'Levels'])->name('teachersLevel');
Route::get('/edit_teachers/{id}', [AdminController::class, 'EditTeacher'])->name('edit_teachers');
Route::post('/updateTeacher/{id}', [AdminController::class, 'updateTeacher'])->name('updateTeacher');
Route::get('/deleteTeacher/{id}', [AdminController::class, 'DeleteTeacher'])->name('deleteTeacher');
Route::get('/get_students/{id}', [AdminController::class, 'Getstudents'])->name('get_students');
Route::get('/tasksPendingApproval', [TaskController::class,'TasksPendingForAdminApproval'])->name('tasksPendingForApproval');
Route::get('/tasks_to_be_approved/{id}', [TaskController::class, 'TaskTobeapproved'])->name('taskstobeapproved');
Route::post('/approve_task/{task_id}', [TaskController::class, 'ApproveTask'])->name('approveTask');
Route::get('/count_assigned_tasks', [TaskController::class, 'CountAssignedTasks'])->name('CountAssignedTasks');
Route::get('/completed_task_view/{task_id}/{student_id}', [TaskController::class, 'completed_task_view'])->name('CompletedTaskView');
Route::get('/download/{id}', [TaskController::class, 'download'])->name('DownloadFile');
Route::get('/get_levels_for_short_task', [LevelController::class, 'GetLevelsforShortAnswer'])->name('GetLevelsforShortAnswer');
Route::post('/add_short_task', [TaskController::class, 'insertShortTask'])->name('addShortTask');
Route::get('/select_task_type/{task_id}/{limit}', [TaskController::class, 'selectTaskType'])->name('selectTaskType');
Route::post('/edit_task/{id}',[TaskController::class, 'editTask'])->name('edit_task'); 
Route::get('/task_edit/{id}', [TaskController::class, 'GetTaskbyIdForEdit'])->name('GetTaskbyIdForEdit');
Route::post('/save_edit_short_questions/{id}/{currentlimit}/{currentQuestionId}', [TaskController::class, 'SaveEditShortQuestions'])->name('SaveEditShortQuestions');
Route::get('/delete_task/{task_id}', [TaskController::class, 'DeleteTask'])->name('DeleteTask');
Route::get('/deactivate_instructor/{instructor_id}', [AdminController::class, 'DeactivateInstructor']);
Route::post('/request_to_edit/{task_id}/{user_id}', [TaskController::class, 'RequestToEdit']);
Route::get('/notifications', [AdminController::class,'getAllNotification']);
Route::get('/request_for_edit/{task_id}', [TaskController::class,'RequestForEdit']);
Route::post('/approve_request_for_edit/{request_id}', [TaskController::class, 'ApproveRequestForEdit']);
Route::get('/toggle_task/{id}', [TaskController::class, 'Toggle']);
Route::get('/student_edit/{id}', [StudentController::class, 'studentEdit']);
Route::post('/assign_instructor/{intern_id}',[AdminController::class,'AssignInstructor']);
Route::post('/assign_level/{intern_id}',[AdminController::class,'AssignLevel']);
Route::get('/descriptive_question/{id}/{limit}', [TaskController::class, 'DescriptiveQuestion'])->name('DescriptiveQuestion');
Route::post('/save_descriptive/{task_id}', [TaskController::class, 'saveDescriptive']);
Route::post('/save_edit_descriptive/{id}/{currentlimit}/{currentQuestionId}', [TaskController::class, 'SaveEditDescriptives'])->name('saveEditDescriptive');
Route::get('/notification_count', [AdminController::class, 'NotificationCount']);
Route::get('/task_date_filter', [TaskController::class, 'datefilter'])->name('task_date_filter');
Route::post('/forgot_password', [LoginController::class, 'ForgotPassword'])->name('forgotPassword');
Route::get('/others', [AdminController::class, 'Others'])->name('Others');
Route::get('/set_sequential_order/{task_id}/{limit}',[TaskController::class,'setSequentialOrder'])->name('setSequentialOrder');
Route::post('/get_sequential_tasks', [TaskController::class, 'getSequentialTasks'])->name('GetSequentialTasks');
Route::post('/set_sequential_parent/{task_id}', [TaskController::class, 'setSequentialParent'])->name('SetSequentialParent');
Route::get('/set_sort_order', [TaskController::class, 'setSortOrder'])->name('setSortOrder');
Route::post('/get_sort_order', [TaskController::class, 'GetTasksForSorting'])->name('GetTasksForSorting');
Route::post('/updateTaskOrder', [TaskController::class, 'updateOrder'])->name('updateOrder');
Route::get('/admin_intern_resume/{student_id}', [StudentController::class, 'AdminInternResume'])->name('AdminInternResume');

//Modules
Route::get('/list_modules', [ModuleController::class, 'ListModules'])->name('listModules');
Route::post('/add_module', [ModuleController::class, 'AddModule'])->name('addModule');
Route::post('/update_module/{module_id}', [ModuleController::class, 'UpdateModule'])->name('updateModule');
Route::get('/remove_module/{module_id}', [ModuleController::class, 'RemoveModule'])->name('removeModule');
Route::get('/add_new_module', [ModuleController::class, 'GetTopics'])->name('addNewModule');
Route::get('/update_modules/{module_id}', [ModuleController::class, 'ShowModules'])->name('updateModules');
Route::get('/get_module/{module_id}', [ModuleController::class, 'GetModulesById'])->name('getModule');


//Student Category
Route::post('/add_student_category', [AdminController::class, 'AddStudentCategory'])->name('addStudentCategory');
Route::get('/list_student_category', [AdminController::class, 'ListStudentCategories'])->name('listStudentCategory');
Route::post('/update_student_category/{category_id}', [AdminController::class, 'UpdateStudentCategory'])->name('UpdateStudenCategory');
Route::get('/deactivate_student_category/{category_id}', [AdminController::class, 'DeactivateStudentCategory'])->name('DeactivateStudentCategory');
Route::post('/assign_student_category/{intern_id}', [StudentController::class, 'AssignStudentCategory'])->name('AssignStudentCategory');
Route::get('/show_student_category/{category_id}', [AdminController::class, 'ShowStudentCategory'])->name('ShowStudentCategory');
Route::get('/add_new_category', [AdminController::class, 'GetTopics'])->name('addNewStudentCategory');
Route::get('/view_student_category/{category_id}', [AdminController::class, 'GetModulesById'])->name('viewStudentCategory');

//Task Category
Route::post('/add_task_category', [AdminController::class, 'AddTaskCategory'])->name('addTaskCategory');
Route::get('/list_task_category', [AdminController::class, 'ListTaskCategories'])->name('listTaskCategory');
Route::post('/update_task_category/{category_id}', [AdminController::class, 'UpdateTaskCategory'])->name('updateTaskCategory');
Route::get('/deactivate_task_category/{category_id}', [AdminController::class, 'RemoveTaskCategory'])->name('removeTaskCategory');
Route::get('/edit_task_category/{category_id}', [AdminController::class, 'ShowTaskCategory'])->name('editTaskCategory');
Route::get('/get_sequential_order/{task_id}', [TaskController::class, 'showSequentialOrder'])->name('showSequentialOrder');

//Employers
Route::get('/get_employers', [AdminController::class, 'GetEmployersList'])->name('GetEmployersList');
Route::get('/get_employer_by_id/{employer_id}', [AdminController::class, 'GetEmployerById'])->name('GetEmployerById');
Route::get('/request_for_intern_contact/{employer_id}', [AdminController::class, 'RequestForInternContactList'])->name('RequestForInternContactList');
Route::post('/approve_request', [AdminController::class, 'ApproveRequestContact'])->name('approveRequest');
Route::post('/reject_request', [AdminController::class, 'RejectRequestContact'])->name('rejectRequest');
Route::get('/list_employer_tasks/{employer_id}', [AdminController::class, 'ListEmployerTasks'])->name('ListEmployerTasks');
Route::get('/assigned_intern_task/{employer_id}/{task_id}', [AdminController::class, 'Assignedinterns'])->name('Assignedinterns');

//Levels
Route::get('/get_levels', [LevelController::class, 'listLevels'])->name('listLevels');
Route::get('/edit_level/{level_id}', [LevelController::class, 'EditLevel'])->name('EditLevel');
Route::post('/update_level/{level_id}', [LevelController::class, 'UpdateLevel'])->name('UpdateLevel');

//Difficulty level
Route::get('/get_difficulty_levels', [LevelController::class, 'listDifficultyLevels'])->name('listDifficultyLevels');
Route::get('/edit_difficulty_level/{level_id}', [LevelController::class, 'EditDifficultyLevel'])->name('EditDifficultyLevel');
Route::post('/update_difficulty_level/{level_id}', [LevelController::class, 'UpdateDifficultyLevel'])->name('UpdateDifficultyLevel');

//Descriptive
Route::get('/get_descriptive',[TaskController::class, 'GetDescriptiveAnswer'])->name('GetDescriptiveAnswer');
Route::get('/get_descriptive_by_id/{id}',[TaskController::class, 'GetDescriptiveById'])->name('GetDescriptiveById');
Route::post('/approve_descriptive/{id}', [TaskController::class,'ApproveDescritpive'])->name('ApproveDescritpive');

