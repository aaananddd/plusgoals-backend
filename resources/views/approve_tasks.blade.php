<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Task waiting for approval</title>
    <!-- Prevent the demo from appearing in search engines -->
    <meta name="robots" content="noindex">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700%7CRoboto:400,500%7CExo+2:600&display=swap"
        rel="stylesheet"><!-- Preloader -->
  
    <link href="{{asset('vendor/spinkit.css')}}" rel="stylesheet" type="text/css">
   
    <link href="{{asset('vendor/perfect-scrollbar.css')}}" rel="stylesheet" type="text/css">
  
    <link href="{{asset('css/material-icons.css')}}" rel="stylesheet" type="text/css">

    <link href="{{asset('css/fontawesome.css')}}" rel="stylesheet" type="text/css">
 
    <link href="{{asset('css/preloader.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
</head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="path/to/jquery.min.js"></script>
<!-- Include SweetAlert from CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
  

    <!-- Header Layout -->
    <div class="mdk-header-layout js-mdk-header-layout">
        <!-- Header -->
        <div id="header" class="mdk-header js-mdk-header mb-0" data-fixed data-effects="waterfall">
            <div class="mdk-header__content">

                <div class="navbar navbar-expand navbar-light bg-white border-bottom" id="default-navbar" data-primary>
                    <div class="container page__container">

                        <!-- Navbar Brand -->
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
                            <a href="{{ route('GetEmployersList') }}" class="nav-link {{ Request::route()->getName() == 'GetEmployersList' ? 'active' : '' }}">Employers</a>
                        </li>
                        <li class="nav-item dropdown ">
                            @if(Session::get('role') == 1)
                            <a href="{{ route('tasksPendingForApproval') }}" class="nav-link {{ Request::route()->getName() == 'tasksPendingForApproval' ? 'active' : '' }}">Pending Approval</a>
                            @endif
                        </li>
                        <li class="nav-item dropdown ">
                            <a href="{{ route('CountAssignedTasks') }}" class="nav-link {{ Request::route()->getName() == 'CountAssignedTasks' ? 'active' : '' }}">Frequent Tasks</a>
                        </li>
                        <li class="nav-item dropdown ">
                            
                            <a href="{{ route('GetDescriptiveAnswer') }}" title="Descriptive task evaluation" class="nav-link {{ Request::route()->getName() == 'GetDescriptiveAnswer' ? 'active' : '' }}">Descriptive </a>
                          
                        </li>
                    </ul>


                        <div class="nav navbar-nav ml-auto mr-0 flex-nowrap d-flex">

                            <!-- Notifications dropdown -->
                            <div class="nav-item dropdown dropdown-notifications dropdown-xs-down-full"
                                data-toggle="tooltip" data-title="Messages" data-placement="bottom"
                                data-boundary="window">
                            
                                <div class="dropdown-menu dropdown-menu-right">
                                    <div data-perfect-scrollbar class="position-relative">
                                        <div class="dropdown-header"><strong>Messages</strong></div>
                                        <div class="list-group list-group-flush mb-0">

                                            <a href="javascript:void(0);"
                                                class="list-group-item list-group-item-action unread">
                                                <span class="d-flex align-items-center mb-1">
                                                    <small class="text-black-50">5 minutes ago</small>

                                                    <span class="ml-auto unread-indicator bg-accent"></span>

                                                </span>
                                                <span class="d-flex">
                                                    <span class="avatar avatar-xs mr-2">
                                                        <img src="../../public/images/people/110/woman-5.jpg"
                                                            alt="people" class="avatar-img rounded-circle">
                                                    </span>
                                                    <span class="flex d-flex flex-column">
                                                        <strong class="text-black-100">Michelle</strong>
                                                        <span class="text-black-70">Clients loved the new design.</span>
                                                    </span>
                                                </span>
                                            </a>

                                            <a href="javascript:void(0);"
                                                class="list-group-item list-group-item-action">
                                                <span class="d-flex align-items-center mb-1">
                                                    <small class="text-black-50">5 minutes ago</small>

                                                </span>
                                                <span class="d-flex">
                                                    <span class="avatar avatar-xs mr-2">
                                                        <img src="../../public/images/people/110/woman-5.jpg"
                                                            alt="people" class="avatar-img rounded-circle">
                                                    </span>
                                                    <span class="flex d-flex flex-column">
                                                        <strong class="text-black-100">Michelle</strong>
                                                        <span class="text-black-70">?? Superb job..</span>
                                                    </span>
                                                </span>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- // END Notifications dropdown -->

                            <!-- Notifications dropdown -->
                            <div class="nav-item ml-16pt dropdown dropdown-notifications dropdown-xs-down-full"
                                data-toggle="tooltip" data-title="Notifications" data-placement="bottom"
                                data-boundary="window">
                            
                                <div class="dropdown-menu dropdown-menu-right">
                                    <div data-perfect-scrollbar class="position-relative">
                                        <div class="dropdown-header"><strong>System notifications</strong></div>
                                        <div class="list-group list-group-flush mb-0">

                                            <a href="javascript:void(0);"
                                                class="list-group-item list-group-item-action unread">
                                                <span class="d-flex align-items-center mb-1">
                                                    <small class="text-black-50">3 minutes ago</small>

                                                    <span class="ml-auto unread-indicator bg-accent"></span>

                                                </span>
                                                <span class="d-flex">
                                                    <span class="avatar avatar-xs mr-2">
                                                        <span class="avatar-title rounded-circle bg-light">
                                                            <i
                                                                class="material-icons font-size-16pt text-accent">account_circle</i>
                                                        </span>
                                                    </span>
                                                    <span class="flex d-flex flex-column">

                                                        <span class="text-black-70">Your profile information has not
                                                            been synced correctly.</span>
                                                    </span>
                                                </span>
                                            </a>

                                            <a href="javascript:void(0);"
                                                class="list-group-item list-group-item-action">
                                                <span class="d-flex align-items-center mb-1">
                                                    <small class="text-black-50">5 hours ago</small>

                                                </span>
                                                <span class="d-flex">
                                                    <span class="avatar avatar-xs mr-2">
                                                        <span class="avatar-title rounded-circle bg-light">
                                                            <i
                                                                class="material-icons font-size-16pt text-primary">group_add</i>
                                                        </span>
                                                    </span>
                                                    <span class="flex d-flex flex-column">
                                                        <strong class="text-black-100">Adrian. D</strong>
                                                        <span class="text-black-70">Wants to join your private
                                                            group.</span>
                                                    </span>
                                                </span>
                                            </a>

                                            <a href="javascript:void(0);"
                                                class="list-group-item list-group-item-action">
                                                <span class="d-flex align-items-center mb-1">
                                                    <small class="text-black-50">1 day ago</small>

                                                </span>
                                                <span class="d-flex">
                                                    <span class="avatar avatar-xs mr-2">
                                                        <span class="avatar-title rounded-circle bg-light">
                                                            <i
                                                                class="material-icons font-size-16pt text-warning">storage</i>
                                                        </span>
                                                    </span>
                                                    <span class="flex d-flex flex-column">

                                                        <span class="text-black-70">Your deploy was successful.</span>
                                                    </span>
                                                </span>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- // END Notifications dropdown -->

                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link d-flex align-items-center dropdown-toggle"
                                    data-toggle="dropdown" data-caret="false">

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
        </div>
        <!-- // END Header -->
        <!-- Header Layout Content -->
        <div class="mdk-header-layout__content page-content ">
        
            @foreach($data as $task)
            <div class="page-section">
                <div class="container page__container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row card-group-row mb-8pt">
                            </div>
                            <div class="card">
                            <form method="POST" action="{{ route('approveTask', ['task_id' => $task->task_id]) }}">
                                    <!-- < class="card-body"> -->
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <div class="card-body ">
                                            <div class="form-group ">
                                                <div class="form-row align-items-center">
                                                  
                                                    <div class="col-md-4">
                                                        <span
                                                            style="font-family: 'Arial', sans-serif; font-size: 16px; font-weight: bold; color: #333;">
                                                            Task Name : </span>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <span
                                                            style="font-family: 'Arial', sans-serif; font-size: 16px; font-weight: light;color: #333;">
                                                            {{ $task->task_name }}</span>
                                                    </div>

                                                </div>
                                            </div>
                                            <br>
                                            <!-- <div class="card-body "> -->
                                            <div class="form-group m-0" role="group" aria-labelledby="label-title">
                                                <div class="form-row align-items-center">
                                                    <div class="col-md-4">
                                                        <span
                                                            style="font-family: 'Arial', sans-serif; font-size: 16px; font-weight: bold; color: #333;">
                                                            Task Description : </span>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <span
                                                            style="font-family: 'Arial', sans-serif; font-size: 16px; color: #333;">{!!
                                                            $task->task_desc !!}</span>
                                                    </div>
                                                </div>
                                            </div><br>
                                            <div class="form-group m-0" role="group" aria-labelledby="label-title">
                                                <div class="form-row align-items-center">
                                                    @foreach($question as $questions)
                                                    @if (is_null($questions) )
                                                    <div class="container page__container">
                                                        <p style="color:red;font-size:20px;">No questions available for
                                                            this
                                                            task.</p>
                                                    </div>
                                                    @else
                                                    @if($task->task_type == 3)
                                                    <div class="page-section border-bottom-2"
                                                        style="background-color:white;">
                                                        <div class="container page__container">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="row"
                                                                        style="font-family: 'Arial', sans-serif; font-size: 16px; color: #333;">
                                                                        <i class="fas fa-dot-circle"></i> &nbsp; &nbsp; {!! $questions->question !!}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>                            
                                                    @else
                                                    <div class="page-section border-bottom-2"
                                                        style="background-color:white;">
                                                        <div class="container page__container">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="row"
                                                                        style="font-family: 'Arial', sans-serif; font-size: 16px; color: #333;">
                                                                        <i class="fas fa-dot-circle"></i> &nbsp; &nbsp;
                                                                         {!! $questions->question !!}
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="custom-control ">
                                                                            <label> a. {{ $questions->a }}</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="custom-control ">
                                                                            <label> b. {{ $questions->b }}</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="custom-control ">
                                                                            <label> c. {{ $questions->c }}</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="custom-control ">
                                                                            <label> d. {{ $questions->d }}</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="custom-control ">
                                                                            <label> e. {{ $questions->e }}</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="custom-control ">
                                                                            <label>
                                                                                <span
                                                                                    style="font-family: 'Arial', sans-serif; font-size: 16px; font-weight: bold; color: #333;">answer.
                                                                                    {{ $questions->answer }} </span>
                                                                            </label>
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif
                                                </div>
                                                @endif

                                                @endforeach
                                                @endforeach

                                            </div>

                                            <div class="custom-control" style="text-align: center;">
                                            <label>
                                                <!-- <button class="button" onclick="Approve('{{ $task->task_id }}')" type="submit" id="{{ $task->task_id }}">
                                                    Approve
                                                </button> -->
                                             <button type="button" data-approve="1" data-id="{{$task->task_id}}" name="submit" id="submit" class="btn btn-primary me-sm-3 me-1 data-submit" style='margin-left:25%' >Approve</button>
                                            </label>
                                            </div>

                                    
                            </div>
                        </div>

                    <style>
                        .button {
                                    background-color: #04AA6D; /* Green */
                                    border: none;
                                    color: white;
                                    padding: 15px 32px;
                                    text-align: center;
                                    text-decoration: none;
                                    display: inline-block;
                                    font-size: 16px;
                                }
                    </style>
                    <script>
                       jQuery(document).ready(function($) {
                            $("#submit").click(function(e) {
                                
                                var task_id =  $('#submit').attr('data-id'); 
                                var is_approved = $('#submit').attr('data-approve'); 


                                $.ajax({
                                        type: "POST",
                                        url: "https://admin.plusgoals.com/approve_task/" + task_id, 
                                    
                                        data: {
                                        'task_id' : task_id,
                                        'is_approved' :  is_approved,
                                        '_token': '{{ csrf_token() }}'
                                        
                                        },
                                       
                                    success: function(data) {
                                        
                                        if(data.status === true){
                                            Swal.fire("Task Approved", "", "success").then((result) => {
                                            if (result.isConfirmed) {
                                                window.location.href = '/tasksPendingApproval';
                                            }
                                            });

                                        } else {
                                            Swal.fire("Task Approved", "", "success").then((result) => {
                                            if (result.isConfirmed) {
                                                window.location.href = '/tasksPendingApproval';
                                            } else {
                                                window.location.href = '/tasks_to_be_approved/' + '{{ $task->task_id}}';
                                            }
                                           });
                                        }   
                                    },
                                    error: function(xhr, status, error) {
                                        var errorMessage = xhr.responseText;
                                        Swal.fire("Error", errorMessage, "error");
                                        }
                                    });
                                });
                       });

                    </script>
                       </div>
                </div>
                </form>


                <div class="card">


                </div>

            </div>
            
        </div>
    </div>
    </div>


    <!-- // END Header Layout Content -->

    <!-- Footer -->

    <div class="bg-dark border-top-2 mt-auto">
        <div class="container page__container page-section d-flex flex-column">
            <p class="text-white-70 brand mb-24pt">

                <img class="brand-icon" src="{{asset('images/plus-goal-logo.svg')}}" width="150" alt="Plus Goals"
                    style="margin-top:20px;">
            </p>
            <p class="measure-lead-max text-white-50 small mr-8pt">Plus Goals is a beautifully crafted user interface
                for modern Education Platforms, including Courses & Tutorials, Video Lessons, Student and Teacher
                Dashboard, Curriculum Management, Earnings and Reporting, ERP, HR, CMS, Tasks, Projects, eCommerce and
                more.</p>
            <p class="mb-8pt d-flex">
                <a href class="text-white-70 text-underline mr-8pt small">Terms</a>
                <a href class="text-white-70 text-underline small">Privacy policy</a>
            </p>
            <p class="text-white-50 small mt-n1 mb-0">Copyright 2019 &copy; All rights reserved.</p>
        </div>
    </div>

    <!-- // END Footer -->

    </div>
    <!-- // END Header Layout -->

    <!-- Drawer -->

    <div class="mdk-drawer js-mdk-drawer" id="default-drawer">
        <div class="mdk-drawer__content">
            <div class="sidebar sidebar-light sidebar-light-dodger-blue sidebar-left" data-perfect-scrollbar>

                <!-- Sidebar Content -->

                <a href="index.html" class="sidebar-brand ">
                    <!-- <img class="sidebar-brand-icon" src="../../public/images/illustration/student/128/white.svg" alt="Luma"> -->

                    <span class="avatar avatar-xl sidebar-brand-icon h-auto">

                        <span class="avatar-title rounded bg-primary"><img src="images/white.svg" class="img-fluid"
                                alt="logo" /></span>

                    </span>

                    <span>Luma</span>
                </a>

                <div class="sidebar-heading">Applications</div>
                <ul class="sidebar-menu">

                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button js-sidebar-collapse" data-toggle="collapse" href="#student_menu">
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
                            <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">format_shapes</span>
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
                        <!-- <a class="sidebar-menu-button" data-toggle="collapse" href="#community_menu">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">people_outline</span>
                        Community
                        <span class="ml-auto sidebar-menu-toggle-icon"></span>
                    </a> -->
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
                                    <!--  -->
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

                <!-- // END Sidebar Content -->

            </div>
        </div>
    </div>

    <!-- // END Drawer -->

    <!-- jQuery -->
    <!-- <script src="../../public/vendor/jquery.min.js"></script> -->
    <script src="{{asset('vendor/jquery.min.js')}}"></script>

    <!-- Bootstrap -->
    <!-- <script src="../../public/vendor/popper.min.js"></script>
        <script src="../../public/vendor/bootstrap.min.js"></script> -->
    <script src="{{asset('vendor/popper.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap.min.js')}}"></script>

    <!-- Perfect Scrollbar -->
    <!-- <script src="../../public/vendor/perfect-scrollbar.min.js"></script> -->
    <script src="{{asset('vendor/perfect-scrollbar.min.js')}}"></script>


    <!-- DOM Factory -->
    <!-- <script src="../../public/vendor/dom-factory.js"></script> -->
    <script src="{{asset('vendor/dom-factory.js')}}"></script>


    <!-- MDK -->
    <!-- <script src="../../public/vendor/material-design-kit.js"></script> -->
    <script src="{{asset('vendor/material-design-kit.js')}}"></script>


    <!-- App JS -->
    <!-- <script src="../../public/js/app.js"></script> -->
    <script src="{{asset('js/app.js')}}"></script>


    <!-- Preloader -->
    <!-- <script src="../../public/js/preloader.js"></script> -->
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