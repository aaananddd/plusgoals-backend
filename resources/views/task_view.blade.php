<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        Edit Task</title>
    <meta name="robots" content="noindex">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700%7CRoboto:400,500%7CExo+2:600&display=swap"
        rel="stylesheet">
    <link href="{{asset('vendor/spinkit.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('vendor/perfect-scrollbar.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/material-icons.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/fontawesome.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/preloader.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
</head>

<style>
      .nav-item .nav-link.active-tab {
        color:#1E90FF;
      }
</style>
<body class="layout-sticky-subnav layout-learnly ">
    <div class="preloader">
        <div class="sk-chase">
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
        </div>
    </div>
    <div class="mdk-header-layout js-mdk-header-layout">
        <div id="header" class="mdk-header js-mdk-header mb-0" data-fixed data-effects="waterfall">
            <div class="mdk-header__content">
                <div class="navbar navbar-expand navbar-light bg-white border-bottom" id="default-navbar" data-primary>
                    <div class="container page__container">
                        <a href="index.html" class="navbar-brand mr-16pt">
                            <span><img src="{{asset('images/plus-goal-logo.svg')}}" width="150" height="100"></span>
                        </a>
                       
                        <ul class="nav navbar-nav d-none d-sm-flex flex justify-content-start ml-8pt">
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link {{ Request::route()->getName() == 'home' ? 'active' : '' }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('taskDetails') }}" class="nav-link {{ Request::route()->getName() == 'taskDetails' ? 'active-tab' : '' }}">Task</a>
                        </li>
                        <li class="nav-item dropdown ">
                            @if(Session::get('role') == 1)
                            <a href="{{ route('teachers') }}" class="nav-link {{ Request::route()->getName() == 'teachers' ? 'active' : '' }}">Instructors</a>
                            @endif
                        </li>
                        <li class="nav-item dropdown ">
                        
                            <a href="{{ route('students') }}" class="nav-link {{ Request::route()->getName() == 'students' ? 'active' : '' }}">Interns</a>
                       
                        </li>
                        <li class="nav-item dropdown ">
                            @if(Session::get('role') == 1)
                            <a href="{{ route('tasksPendingForApproval') }}" class="nav-link {{ Request::route()->getName() == 'tasksPendingForApproval' ? 'active' : '' }}">Pending Approval</a>
                            @endif
                        </li>
                        <li class="nav-item dropdown ">
                            <a href="{{ route('CountAssignedTasks') }}" class="nav-link {{ Request::route()->getName() == 'CountAssignedTasks' ? 'active' : '' }}">Frequent Tasks</a>
                        </li>
                    </ul>
                        <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown"
                    data-caret="false">

                    <span class="avatar avatar-sm mr-8pt2">

                        <span class="avatar-title rounded-circle bg-primary"><i
                                class="material-icons">account_box</i></span>

                    </span>

                </a>
                <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="{{route('profileView')}}"> <strong>{{ Session::get('user.first_name') }}</strong></a>
                 
                     <a class="dropdown-item" href="{{route('logout')}}">Logout</a>
                </div>
            </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mdk-header-layout__content page-content ">
            <div class="page-section bg-alt border-bottom-2">
                <div class="container page__container">
                    <div class="d-flex flex-column flex-lg-row align-items-center">
                        <div
                            class="d-flex flex-column flex-md-row align-items-center flex mb-16pt mb-lg-0 text-center text-md-left">
                            <div class="mb-16pt mb-md-0 mr-md-24pt">
                            </div>
                            <div class="col-lg-8">
                                <h1 class="h2 mb-0">Add New Task</h1><br>
                                <div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @foreach($data as $task)
            <div class="page-section">
                <div class="container page__container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row card-group-row mb-8pt">
                            </div>
                            <div class="card">
                                <form method="POST" action="{{ url('update_task/'. $task->task_id )}}">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <div class="card-body table--elevated">
                                            <div class="form-group m-0" role="group" aria-labelledby="label-title">
                                                <div class="form-row align-items-center">
                                                    <label id="label-title" for="task_name"
                                                        class="col-md-3 col-form-label form-label">Task name</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" id="task_name"
                                                            value="{{ $task->task_name }}" name="task_name">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="card-body table--elevated">
                                            <div role="group" aria-labelledby="label-question" class="m-0 form-group">
                                                <div class="form-row">
                                                    <label id="label-question" for="task_desc"
                                                        class="col-md-3 col-form-label form-label">Task
                                                        Description</label>
                                                    <div class="col-md-9">
                                                        <script
                                                            src="https://cdn.ckeditor.com/ckeditor5/24.0.0/classic/ckeditor.js"></script>
                                                        <textarea id="task_desc" rows="4" class="form-control"
                                                            name="task_desc">{ !! $task->task_desc !! } </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                        <div class="form-group">
                                            <div class="list-group-item">
                                                <div class="form-group m-0" role="group" aria-labelledby="label-topic">
                                                    <div class="form-row align-items-center">
                                                        <label id="label-topic" for="task_level"
                                                            class="col-md-3 col-form-label form-label">Level</label>
                                                        <div class="col-md-9">
                                                            <select class="form-control custom-select w-auto"
                                                                name="task_level" id="task_level">
                                                                <option value="option_select" disabled selected>Task
                                                                    level
                                                                </option>
                                                                @foreach($level as $taskLevel)
                                                                <option value="{{ $taskLevel->id }}" {{
                                                                    old('task_level', $task->task_level) ==
                                                                    $taskLevel->id ? 'selected' : '' }}>
                                                                    {{ $taskLevel->level_name }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="list-group-item">
                                                <div class="form-group m-0" role="group" aria-labelledby="label-topic">
                                                    <div class="form-row align-items-center">
                                                        <label id="label-topic" for="difficulty_level"
                                                            class="col-md-3 col-form-label form-label">Difficulty
                                                            Level</label>
                                                        <div class="col-md-9">
                                                            <select class="form-control custom-select w-auto"
                                                                name="difficulty_level" id="difficulty_level">
                                                                <option value="option_select" disabled>Task level
                                                                </option>
                                                                @foreach($difficultylevel as $task_level)
                                                                <option value="{{ $task_level->id }}" {{
                                                                    old('difficulty_level', $task->difficulty_level) ==
                                                                    $task_level->id ? 'selected' :
                                                                    '' }}>
                                                                    {{ $task_level->level_name }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="card-body table--elevated">
                                                <div class="form-group m-0" role="group" aria-labelledby="label-title">
                                                    <div class="form-row align-items-center">
                                                        <label id="label-title" for="NoOfQuestns"
                                                            class="col-md-3 col-form-label form-label">No of
                                                            Questions</label>
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control" id="NoOfQuestns"
                                                                value="{{ $task->NoOfQuestns }}" name="NoOfQuestns">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="card-body table--elevated">
                                                <div class="form-group m-0" role="group" aria-labelledby="label-title">
                                                    <div class="form-row align-items-center">
                                                        <label id="label-title" for="NofQstnsAns"
                                                            class="col-md-3 col-form-label form-label">No of Questions
                                                            to be
                                                            Answered</label>
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control" id="NofQstnsAns"
                                                                value="{{ $task->NofQstnsAns }}" name="NofQstnsAns">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="card-body table--elevated">
                                                <div role="group" aria-labelledby="label-question"
                                                    class="m-0 form-group">
                                                    <div class="form-row align-items-center">
                                                        <label id="label-question" for="file-upload"
                                                            class="col-md-3 col-form-label form-label">File
                                                            Upload</label>
                                                        <div class="col-md-9">
                                                            <input type="file" id="file-upload" name="file"
                                                                class="form-control-file">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                        <div class="card-body table--elevated">
                                            <div class="form-group m-0" role="group" aria-labelledby="label-title">
                                                <div class="form-row align-items-center">
                                                <label id="label-title" for="timelimit" class="col-md-3 col-form-label form-label">Time Limit</label>
                                                    <div class="col-md-9">
                                                        <input type="time" class="form-control" id="time" value="{{ $task->time }}" name="time"> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>   
                                </div> 

                                        <div class="form-group">
                                            <div class="list-group-item">
                                                <div class="text-right">
                                                    <button type="submit" style="cursor:pointer" class="btn btn-accent"
                                                        onClick="window.location.href = '{{ env('APP_URL') }}update_task/<?php echo $task->task_id; ?>'">Update</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            </form>
                            <div class="card">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="bg-dark border-top-2 mt-auto">
                <div class="container page__container page-section d-flex flex-column">
                    <p class="text-white-70 brand mb-24pt">
                        <img class="brand-icon" src="{{asset('images/plus-goal-logo.svg')}}" width="150"
                            alt="Plus Goals" style="margin-top:20px;">
                    </p>
                    <p class="measure-lead-max text-white-50 small mr-8pt">Plus Goals is a beautifully crafted user
                        interface for modern Education Platforms, including Courses & Tutorials, Video Lessons, Student
                        and Teacher Dashboard, Curriculum Management, Earnings and Reporting, ERP, HR, CMS, Tasks,
                        Projects, eCommerce and more.</p>
                    <p class="mb-8pt d-flex">
                        <a href class="text-white-70 text-underline mr-8pt small">Terms</a>
                        <a href class="text-white-70 text-underline small">Privacy policy</a>
                    </p>
                    <p class="text-white-50 small mt-n1 mb-0">Copyright 2019 &copy; All rights reserved.</p>
                </div>
            </div>
        </div>
        <div class="mdk-drawer js-mdk-drawer" id="default-drawer">
            <div class="mdk-drawer__content">
                <div class="sidebar sidebar-light sidebar-light-dodger-blue sidebar-left" data-perfect-scrollbar>
                    <a href="index.html" class="sidebar-brand ">
                        <span class="avatar avatar-xl sidebar-brand-icon h-auto">
                            <span class="avatar-title rounded bg-primary"><img src="images/white.svg" class="img-fluid"
                                    alt="logo" /></span>
                        </span>
                        <span>Luma</span>
                    </a>
                    <div class="sidebar-heading">Applications</div>
                    <ul class="sidebar-menu">
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button js-sidebar-collapse" data-toggle="collapse"
                                href="#student_menu">
                                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">school</span>
                                Student
                                <span class="ml-auto sidebar-menu-toggle-icon"></span>
                            </a>
                            <ul class="sidebar-submenu collapse sm-indent" id="student_menu">
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="index.html">
                                        <span class="sidebar-menu-text">Home</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="courses.html">
                                        <span class="sidebar-menu-text">Browse Courses</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="paths.html">
                                        <span class="sidebar-menu-text">Browse Paths</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="student-dashboard.html">
                                        <span class="sidebar-menu-text">Student Dashboard</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="student-my-courses.html">
                                        <span class="sidebar-menu-text">My Courses</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="student-paths.html">
                                        <span class="sidebar-menu-text">My Paths</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="student-path.html">
                                        <span class="sidebar-menu-text">Path Details</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="student-course.html">
                                        <span class="sidebar-menu-text">Course Preview</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="student-lesson.html">
                                        <span class="sidebar-menu-text">Lesson Preview</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="student-take-course.html">
                                        <span class="sidebar-menu-text">Take Course</span>
                                        <span
                                            class="sidebar-menu-badge badge badge-accent badge-notifications ml-auto">PRO</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="student-take-lesson.html">
                                        <span class="sidebar-menu-text">Take Lesson</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="student-take-quiz.html">
                                        <span class="sidebar-menu-text">Take Quiz</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="student-quiz-results.html">
                                        <span class="sidebar-menu-text">My Quizzes</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="student-quiz-result-details.html">
                                        <span class="sidebar-menu-text">Quiz Result</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="student-path-assessment.html">
                                        <span class="sidebar-menu-text">Skill Assessment</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="student-path-assessment-result.html">
                                        <span class="sidebar-menu-text">Skill Result</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button js-sidebar-collapse" data-toggle="collapse"
                                href="#instructor_menu">
                                <span
                                    class="material-icons sidebar-menu-icon sidebar-menu-icon--left">format_shapes</span>
                                Instructor
                                <span class="ml-auto sidebar-menu-toggle-icon"></span>
                            </a>
                            <ul class="sidebar-submenu collapse sm-indent" id="instructor_menu">
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="instructor-dashboard.html">
                                        <span class="sidebar-menu-text">Instructor Dashboard</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="instructor-courses.html">
                                        <span class="sidebar-menu-text">Manage Courses</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="instructor-quizzes.html">
                                        <span class="sidebar-menu-text">Manage Quizzes</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="instructor-earnings.html">
                                        <span class="sidebar-menu-text">Earnings</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="instructor-statement.html">
                                        <span class="sidebar-menu-text">Statement</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="instructor-edit-course.html">
                                        <span class="sidebar-menu-text">Edit Course</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="instructor-edit-quiz.html">
                                        <span class="sidebar-menu-text">Edit Quiz</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-menu-item active open">
                            <a class="sidebar-menu-button" data-toggle="collapse" href="#community_menu">
                                <span
                                    class="material-icons sidebar-menu-icon sidebar-menu-icon--left">people_outline</span>
                                Community
                                <span class="ml-auto sidebar-menu-toggle-icon"></span>
                            </a>
                            <ul class="sidebar-submenu collapse show sm-indent" id="community_menu">
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="teachers.html">
                                        <span class="sidebar-menu-text">Browse Teachers</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="student-profile.html">
                                        <span class="sidebar-menu-text">Student Profile</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item active">
                                    <a class="sidebar-menu-button" href="teacher-profile.html">
                                        <span class="sidebar-menu-text">Teacher Profile</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="blog.html">
                                        <span class="sidebar-menu-text">Blog</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="blog-post.html">
                                        <span class="sidebar-menu-text">Blog Post</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="faq.html">
                                        <span class="sidebar-menu-text">FAQ</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="help-center.html">
                                        <span class="sidebar-menu-text">Help Center</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="discussions.html">
                                        <span class="sidebar-menu-text">Discussions</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="discussion.html">
                                        <span class="sidebar-menu-text">Discussion Details</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="discussions-ask.html">
                                        <span class="sidebar-menu-text">Ask Question</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <script src="{{asset('vendor/jquery.min.js')}}"></script>
        <script src="{{asset('vendor/popper.min.js')}}"></script>
        <script src="{{asset('vendor/bootstrap.min.js')}}"></script>
        <script src="{{asset('vendor/perfect-scrollbar.min.js')}}"></script>
        <script src="{{asset('vendor/dom-factory.js')}}"></script>
        <script src="{{asset('vendor/material-design-kit.js')}}"></script>
        <script src="{{asset('js/app.js')}}"></script>
        <script src="{{asset('js/preloader.js')}}"></script>
</body>
<link href="assets/css/jquery.cleditor.css" rel="stylesheet" type="text/css">
<script src="assets/js/plugins/jquery.cleditor.js" type="text/javascript"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#task_desc'), {})
        .then(editor => {
            editor.setData('{!! $task->task_desc !!}'); // Use Blade templating to echo the variable
        })
        .catch(error => {
            console.log(error);
        });
</script>

</html>