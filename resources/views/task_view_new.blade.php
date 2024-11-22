
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Task view</title>

    <meta name="robots" content="noindex">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700%7CRoboto:400,500%7CExo+2:600&display=swap"
        rel="stylesheet">


    <link href="{{ asset('vendor/spinkit.css') }}" rel="stylesheet" type="text/css">


    <link href="{{ asset('vendor/perfect-scrollbar.css') }}" rel="stylesheet" type="text/css">


    <link href="{{ asset('css/material-icons.css') }}" rel="stylesheet" type="text/css">


    <link href="{{ asset('css/fontawesome.css') }}" rel="stylesheet" type="text/css">


    <link href="{{ asset('css/preloader.css') }}" rel="stylesheet" type="text/css">


    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    <style>
        button {
            width: 40px;
            height: 30px;
        }

        .nav-item .nav-link.active-tab {
        color:#1E90FF;
        }
    </style>
</head>

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
                            <span><img src="{{ asset('images/plus-goal-logo.svg') }}" width="150" height="100"></span>

                        </a>

                        <ul class="nav navbar-nav d-none d-sm-flex flex justify-content-start ml-8pt">
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link {{ Request::route()->getName() == 'home' ? 'active' : '' }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('taskDetails') }}" class="nav-link {{ Request::route()->getName() == 'taskDetails' ? 'active' : '' }}">Task</a>
                        </li>
                        <li class="nav-item dropdown ">
                            @if(Session::get('role') == 1)
                            <a href="{{ route('teachers') }}" class="nav-link {{ Request::route()->getName() == 'teachers' ? 'active-tab' : '' }}">Instructors</a>
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
                            <a href="{{ route('Others') }}" class="nav-link {{ Request::route()->getName() == 'Others' ? 'active' : '' }}">Others</a>
                        </li>
                    </ul>
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
            <!-- // END Header -->

            <!-- Header Layout Content -->
            @foreach($data as $task)
    <div class="mdk-header-layout__content page-content">
        <div class="page-section bg-alt border-bottom-2">
            <div class="container page__container">
                <div class="d-flex flex-column flex-lg-row align-items-center">
                    <div class="d-flex flex-column flex-md-row align-items-center flex mb-16pt mb-lg-0 text-center text-md-left">
                        <div class="mb-16pt mb-md-0 mr-md-24pt">
                          
                        </div>
                        <div class="flex">
                            <h1 class="h2 mb-0">{{ $task->task_name }}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-section">
            <div class="container page__container">
                <div class="row">
                    <div class="col-lg-10">
                        <div class="row card-group-row mb-12pt">
                            <div class="col-sm-12 card-group-row__col">
                                <div class="card card-sm card-group-row__card">
                                    <div class="card-body d-flex align-items-center">
                                        <div class="flex">
                                            <span class="card-title mb-4pt">Level:</span>
                                            <span style="font-family: 'Arial', sans-serif; font-size: 16px; color: #333;">{{ $task->level_name }}</span>
                                        </div>
                                        <div class="flex">
                                            <span class="card-title mb-4pt">Difficulty:</span>
                                            <span style="font-family: 'Arial', sans-serif; font-size: 16px; color: #333;">{{ $task->difficulty }}</span>
                                        </div>
                                        <div class="flex">
                                            <span class="card-title mb-4pt">Task Category:</span>
                                            <span style="font-family: 'Arial', sans-serif; font-size: 16px; color: #333;">{{ $task->category_name }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                         
                            <div class="col-sm-12 card-group-row__col">
                                <div class="card card-sm card-group-row__card">
                                    <div class="card-body d-flex align-items-center">
                                        <div class="flex">
                                            <span class="card-title mb-4pt">Task Description:</span>
                                       
                                            <span style="font-family: 'Arial', sans-serif; font-size: 16px; color: #333;">{!! $task->task_desc !!}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 card-group-row__col">
                                <div class="card card-sm card-group-row__card">
                                    <div class="card-body d-flex align-items-center">
                                        <div class="flex">
                                            <span class="card-title mb-4pt">Attachments:</span>
                                        </div>
                                        <div class="col-md-12">
                                            @foreach($attachment as $file)
                                                <div style="font-family: 'Arial', sans-serif; font-size: 16px; color: #333;">
                                                    <span>{{ $file['file_name'] }}</span>
                                                    <a href="{{ asset($file['download_link']) }}" download>
                                                        <i class="fa fa-download"></i> Download
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex mb-1">
                                    <div class="flex">
                                        <div class="d-flex align-items-center mb-1">
                                            <div class="container page__container">
                                                @if ($question->isEmpty())
                                                    <p style="color:red;font-size:20px;">No questions available for this task.</p>
                                                @else
                                                    <div class="row">
                                                        <span style="font-family: 'Arial', sans-serif; font-size: 16px; color: #333; font-weight:bold;">Questions:</span>
                                                    </div>
                                                    @foreach($question as $index => $questions)
                                                        <div class="row">
                                                        <div class="col-lg-12" style="display: flex; align-items: center;">
                                                            <span style="font-family: 'Arial', sans-serif; font-size: 16px; color: #1aa3ff; margin-right: 5px;">{{ $index + 1 }}.</span>
                                                            <span style="font-family: 'Arial', sans-serif; font-size: 16px; color: #1aa3ff;" class="normal-text">{!! strip_tags($questions->question, '<b><i><u><a>') !!}
                                                            </span>
                                                        </div>

                                                          
                                                        </div>
                                                        @if($questions->task_type == 1)
                                                            <div class="row mt-3">
                                                                <div class="col-lg-12">
                                                                    <div class="form-group">
                                                                        <div class="custom-control">
                                                                            <label>a. {{ $questions->a }}</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="custom-control">
                                                                            <label>b. {{ $questions->b }}</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="custom-control">
                                                                            <label>c. {{ $questions->c }}</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="custom-control">
                                                                            <label>d. {{ $questions->d }}</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="custom-control">
                                                                            <label>e. {{ $questions->e }}</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group mt-3">
                                                                        <div class="custom-control">
                                                                            <label><span style="font-family: 'Arial', sans-serif; font-size: 16px; font-weight: light; color: #228B22;">Answer: {{ $questions->answer }}</span></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @elseif($questions->task_type == 2)
                                                            <div class="row mt-3">
                                                                <div class="col-lg-12">
                                                                    <label>
                                                                        <span style="font-family: 'Arial', sans-serif; font-size: 14px; font-weight: bold; color: #333;">Possible Answers</span>
                                                                    </label>
                                                                    <div class="form-group">
                                                                        <div class="custom-control">
                                                                            <label><span style="font-family: 'Arial', sans-serif; font-size: 16px; font-weight: light; color: #333;">1. {{ $questions->a }}</span></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="custom-control">
                                                                            <label><span style="font-family: 'Arial', sans-serif; font-size: 16px; font-weight: light; color: #333;">2. {{ $questions->b }}</span></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="custom-control">
                                                                            <label><span style="font-family: 'Arial', sans-serif; font-size: 16px; font-weight: light; color: #333;">3. {{ $questions->c }}</span></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="custom-control">
                                                                            <label><span style="font-family: 'Arial', sans-serif; font-size: 16px; font-weight: light; color: #333;">4. {{ $questions->d }}</span></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @elseif($questions->task_type == 3)
                                                            <div class="row mt-3">
                                                                <div class="col-lg-12">
                                                                    <div class="page-section border-bottom-2" style="background-color:white;">
                                                                        <span style="font-family: 'Arial', sans-serif; font-size: 16px; color: #333; font-weight:bold;">Question:</span>
                                                                        <span style="font-family: 'Arial', sans-serif; font-size: 16px; color: #333;">{!! nl2br(e($questions->question)) !!}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-2">
                        <h4>Module</h4>
                        
                        <div style="font-size: 14px; line-height: 1.2;">
                         
                            @if (!empty($task['parent']))
                                <ul class="list-unstyled">
                                    @php
                                        $parents = collect($task['parent'])->sortBy('id')->values()->all();
                                    @endphp
                                    @foreach ($parents as $parent)
                                        <li>
                                            <span style="color:black; font-style: italic; border: 1px solid #1E90FF; padding: 5px; display: inline-block; border-radius: 5px; background-color: #f0f8ff;">
                                                {{ $parent['category_name'] }}
                                            </span>
                                            @if (!$loop->last)
                                                <ul class="list-unstyled">
                                                    <li style="color:#1E90FF;">&nbsp;&nbsp;&nbsp;&nbsp; &#8659; </li>
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                   
                                    <li style="color:#1E90FF;">&nbsp;&nbsp;&nbsp;&nbsp; &#8659; </li>
                                    <span style="color:black; font-style: italic; border: 1px solid #1E90FF; padding: 5px; display: inline-block; border-radius: 5px; background-color: #f0f8ff;">
                                        {{ $task->student_category }}
                                    </span>
                            
                                </ul>
                            @else
                                None
                            @endif
                        </div>

                    </div>

                    <div class="col-lg-4">
                        <h4>Sequential task fetching order</h4>
                        <div style="font-size: 14px; line-height: 1.2;">
                            @if (!empty($task['sequential']))
                                <ul class="list-unstyled">
                                    @php
                                        $sortedTasks = collect($task['sequential'])->sortBy('sort_order')->values()->all();
                                    @endphp
                                    @foreach ($sortedTasks as $tasks)
                                        <li>
                                            <span style="color:black; font-style: italic; border: 1px solid #1E90FF; padding: 5px; display: inline-block; border-radius: 5px; background-color: #f0f8ff;">
                                                {{ $tasks['task_name'] }}
                                            </span>
                                            @if (!$loop->last)
                                                <ul class="list-unstyled">
                                                    <li style="color:#1E90FF;">&nbsp;&nbsp;&nbsp;&nbsp; &#8659; </li>
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                None
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endforeach

            <!-- // END Header Layout Content -->

            <!-- Footer -->

            <div class="bg-dark border-top-2 mt-auto">
                    <div class="container page__container page-section d-flex flex-column">
                        <p class="text-white-70 brand mb-24pt">
                            <img class="brand-icon" src="{{ asset('images/plus-goal-logo.svg') }}" width="150"
                                alt="Plus Goals" style="margin-top:20px;">
                        </p>
                        <p class="measure-lead-max text-white-50 small mr-8pt">Plus Goals is a beautifully crafted user
                            interface for modern Education Platforms, including Courses & Tutorials, Video Lessons,
                            Student and Teacher Dashboard, Curriculum Management, Earnings and Reporting, ERP, HR, CMS,
                            Tasks, Projects, eCommerce and more.</p>
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
                                <span class="avatar-title rounded bg-primary"><img src="images/white.svg"
                                        class="img-fluid" alt="logo" /></span>
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



            <script src="{{ asset('vendor/jquery.min.js') }}"></script>
            <script src="{{ asset('vendor/popper.min.js') }}"></script>
            <script src="{{ asset('vendor/bootstrap.min.js') }}"></script>
            <script src="{{ asset('vendor/perfect-scrollbar.min.js') }}"></script>
            <script src="{{ asset('vendor/dom-factory.js') }}"></script>
            <script src="{{ asset('vendor/material-design-kit.js') }}"></script>
            <script src="{{ asset('js/app.js') }}"></script>
            <script src="{{ asset('js/preloader.js') }}"></script>
</body>
<link href="assets/css/jquery.cleditor.css" rel="stylesheet" type="text/css">
<script src="assets/js/plugins/jquery.cleditor.js" type="text/javascript"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'), {})
        .catch(error => {
            console.log(error);
        });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $("#input").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });
    });
</script>

</html>