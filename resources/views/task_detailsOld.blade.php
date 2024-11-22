<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Task Details</title>
    <!-- Prevent the demo from appearing in search engines -->
    <meta name="robots" content="noindex">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700%7CRoboto:400,500%7CExo+2:600&display=swap"
        rel="stylesheet"><!-- Preloader -->
    <!-- ?link type=?text/css? href=?../../public/vendor/spinkit.css? rel="stylesheet"> -->
    <link href="{{asset('vendor/spinkit.css')}}" rel="stylesheet" type="text/css">
    <!-- Perfect Scrollbar -->
    <!-- <link type="text/css" href=?../../public/vendor/perfect-scrollbar.css? rel=?stylesheet?? -->
    <link href="{{asset('vendor/perfect-scrollbar.css')}}" rel="stylesheet" type="text/css">
    <!-- Material Design Icons -->
    <!-- <link type="text/css" href=?../../public/css/material-icons.css? rel=?stylesheet?? -->
    <link href="{{asset('css/material-icons.css')}}" rel="stylesheet" type="text/css">
    <!-- Font Awesome Icons -->
    <!-- <link type="text/css"
href=?../../public/css/fontawesome.css?
rel=?stylesheet?? -->
    <link href="{{asset('css/fontawesome.css')}}" rel="stylesheet" type="text/css">
    <!-- Preloader -->
    <!-- <link type="text/css"
                            href=?../../public/css/preloader.css?
                            rel=?stylesheet?? -->
    <link href="{{asset('css/preloader.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
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
    <!-- ?div class=?sk-bounce??
                        ?div class=?sk-bounce-dot???/div?
                        <div class="sk-bounce-dot"></div>
                    </div? -->
    <!-- More spinner examples at https://github.com/tobiasahlin/SpinKit/blob/master/examples.html -->

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
                            <!-- ?span class=?d-none d-lg-block??Plus Goals?/span? -->
                        </a>
                        <!-- Navbar toggler -->

                        <ul class="nav navbar-nav d-none d-sm-flex flex justify-content-start ml-8pt">
                            <li class="nav-item">
                                <a href="{{ route('home') }}" class="nav-link">Home</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('taskDetails') }}" class="nav-link">Task</a>
                            </li>
                            <li class="nav-item ">

                                @if(Session::get('role') == 1)
                                <a href="{{ route('teachers') }}" class="nav-link">
                                    @endif
                                    Instructors</a>




                            <li class="nav-item dropdown ">

                                <a href="{{ route('students') }}" class="nav-link">
                                    Interns</a>

                                <!-- <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"
                        data-caret="false">Students</a>
                        <div class="dropdown-menu"> -->
                                <!-- <a href="{{ route('paidStudents') }}" -->
                                <!-- <a href="{{ route('students') }}" class="dropdown-item active">Student list</a> -->
                                <!-- <a href="{{ route('unpaidStudents') }}"
                                                                                class="dropdown-item">Unpaid Students</a> -->
                                <!-- </div> -->
                            </li>
                       
                            <li class="nav-item dropdown ">
                                @if(Session::get('role') == 1)
                                <a href="{{ route('tasksPendingForApproval') }}" class="nav-link">Pending Approval</a>

                                @endif
                           
                            </li>
                      
                            <li class="nav-item dropdown ">
                                
                                <a href="{{ route('CountAssignedTasks') }}" class="nav-link">Frequent Tasks</a>
                           
                            </li>
                           
                            <li class="nav-item dropdown" data-toggle="tooltip" data-title="Community"
                                data-placement="bottom" data-boundary="window">
                                <!-- <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" data-caret="false">
                                                <i class="material-icons">people_outline</i>
                                            </a> -->
                                <div class="dropdown-menu">
                                    <a href="teachers.html" class="dropdown-item">Browse Teachers</a>
                                    <a href="student-profile.html" class="dropdown-item">Student Profile</a>
                                    <a href="teacher-profile.html" class="dropdown-item">Instructor Profile</a>
                                    <a href="blog.html" class="dropdown-item">Blog</a>
                                    <a href="blog-post.html" class="dropdown-item">Blog Post</a>
                                    <a href="faq.html" class="dropdown-item">FAQ</a>
                                    <a href="help-center.html" class="dropdown-item">Help Center</a>
                                    <a href="discussions.html" class="dropdown-item">Discussions</a>
                                    <a href="discussion.html" class="dropdown-item">Discussion Details</a>
                                    <a href="discussions-ask.html" class="dropdown-item">Ask Question</a>
                                </div>
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
                                <div class="dropdown-header"><strong>Account</strong></div>
                                <!--<a class="dropdown-item" href="edit-account.html">Edit Account</a>-->
                                <!--<a class="dropdown-item" href="billing.html">Billing</a>-->
                                <!--<a class="dropdown-item" href="billing-history.html">Payments</a>-->
                                <a class="dropdown-item" href="{{route('logout')}}">Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- // END Header -->
        <!-- Header Layout Content -->
        <div class="mdk-header-layout__content page-content ">
            <!-- <div class="page-section bg-alt border-bottom-2"> -->
            <!-- <div class="container page__container"> -->
            <!-- <div class="d-flex flex-column flex-lg-row align-items-center">
                <div
                    class="d-flex flex-column flex-md-row align-items-center flex mb-16pt mb-lg-0 text-center text-md-left"> -->
            <!-- <div class="mb-16pt mb-md-0 mr-md-24pt">
                      
                    </div> -->
            <!-- <div class="col-lg-8"> -->
            <!-- <h1 class="h2 mb-0"> Task</h1><br> -->
            <!-- <div></div> -->
            <!-- <div class="rating mb-16pt d-inline-flex">
                                                                    <div class="rating__item"><i class="material-icons">star</i></div>
                                                                    <div class="rating__item"><i class="material-icons">star</i></div>
                                                                    <div class="rating__item"><i class="material-icons">star</i></div>
                                                                    <div class="rating__item"><i class="material-icons">star</i></div>
                                                                    <div class="rating__item"><i class="material-icons">star_border</i></div>
                                                                </div> -->
            <!-- <div>
                                                                    <span class="chip chip-outline-secondary d-inline-flex align-items-center"
                                                                        data-toggle="tooltip"
                                                                        data-title="Experience IQ"
                                                                        data-placement="bottom">
                                                                        <i class="material-icons icon--left">opacity</i> 2,300 points
                                                                    </span>
                                                                </div> -->
            <!-- </div> -->
            <!-- </div> -->
            <!-- <div class="col-mg-4">
                                                            <h6 class="h6 mb-0">Email : lazabogdan@gmail.com</h6><br>
                                                            <h6 class="h6 mb-0">Contact : 8907653421</h6> -->
            <!-- <a href=""
                                                                class="btn btn-light">Follow</a> -->
            <!-- </div> -->
            <!-- </div> -->
            <!-- <div class="col-lg-4">
                                                                        <a href=""
                                                                    class="btn btn-light">Follow</a>
                                                                </div> -->
            <!-- </div> -->
            <!-- </div> -->
            @foreach($data as $task)
            <div class="page-section">
                <div class="container page__container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row card-group-row mb-8pt">
                            </div>
                            <div class="card">
                                <form method="POST" action="{{ url('addTask')}}">
                                    <!-- < class="card-body"> -->
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <div class="card-body ">
                                            <div class="form-group ">
                                                <div class="form-row align-items-center">
                                                    <!-- <label id="label-title" for="task_name"
                                                                                class="col-md-3 col-form-label form-label">Task name</label>
                                                                            <div class="col-md-9">
                                                                                <input type="text" class="form-control" id="task_name"
                                                                                    value="{{ $task->task_name }}" name="task_name"> -->
                                                    <div class="col-md-2">
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
                                                    <div class="col-md-2">
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
                                                    <div class="col-md-2">
                                                        <span
                                                            style="font-family: 'Arial', sans-serif; font-size: 16px; font-weight: bold; color: #333;">
                                                            Attachments : </span>
                                                    </div>
                                                    <div class="col-md-8">
                                                        @foreach($attachment as $file)
                                                        <div style="font-family: 'Arial', sans-serif; font-size: 16px; color: #333;">
                                                            <span>{{ $file['file_name'] }}</span> <!-- Displaying filename -->
                                                            <a href="{{ asset($file['download_link']) }}" download> <!-- Download link -->
                                                                <i class="fa fa-download"></i> Download <!-- File icon and download text -->
                                                            </a>
                                                        </div>

                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div><br>
                                            
                                        

                                            <div class="form-group m-0" role="group" aria-labelledby="label-title">
    <div class="form-row align-items-center">
        @foreach($question as $questions)
        <div class="container page__container">
            @if (is_null($questions))
            <p style="color:red;font-size:20px;">No questions available for this task.</p>
            @else
            @if($questions->task_type == 1)
            <div class="page-section border-bottom-2" style="background-color:white;">
                <div class="container page__container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row" style="font-family: 'Arial', sans-serif; font-size: 16px; color: #333;">
                                <i class="fas fa-dot-circle"></i> &nbsp; &nbsp; {!! $questions->question !!}
                            </div>
                            <div class="form-group">
                                <div class="custom-control">
                                    <label> a. {{ $questions->a }}</label>
                                </div>
                            </div>
<div class="form-group">
                                <div class="custom-control">
                                    <label> b. {{ $questions->b }}</label>
                                </div>
                            </div>

<div class="form-group">
                                <div class="custom-control">
                                    <label> c. {{ $questions->c }}</label>
                                </div>
                            </div>

<div class="form-group">
                                <div class="custom-control">
                                    <label> d. {{ $questions->d }}</label>
                                </div>
                            </div>

<div class="form-group">
                                <div class="custom-control">
                                    <label> e. {{ $questions->e }}</label>
                                </div>
                            </div>

                            <!-- Repeat for options b, c, d, e -->
                            <div class="form-group">
                                <div class="custom-control">
                                    <label> <span style="font-family: 'Arial', sans-serif; font-size: 16px; font-weight: bold; color: #333;">answer. {{ $questions->answer }}</span></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @elseif($questions->task_type == 2)
            <div class="page-section border-bottom-2" style="background-color:white;">
                <div class="container page__container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row" style="font-family: 'Arial', sans-serif; font-size: 16px; color: #333;">
                                <i class="fas fa-dot-circle"></i> &nbsp; &nbsp; {!! $questions->question !!}
                            </div>
                            <label>
                                <span style="font-family: 'Arial', sans-serif; font-size: 14px; font-weight: bold; color: #333;">Possible Answers</span>
                            </label>
                            <div class="form-group">
                                <div class="custom-control">
                                    <label> <span style="font-family: 'Arial', sans-serif; font-size: 16px; font-weight: light; color: #333;">1. {{ $questions->a }}</span></label>
                                </div>
                            </div>
 <div class="form-group">
                                <div class="custom-control">
                                    <label> <span style="font-family: 'Arial', sans-serif; font-size: 16px; font-weight: light; color: #333;">2. {{ $questions->b }}</span></label>
                                </div>
                            </div>

 <div class="form-group">
                                <div class="custom-control">
                                    <label> <span style="font-family: 'Arial', sans-serif; font-size: 16px; font-weight: light; color: #333;">3. {{ $questions->c }}</span></label>
                                </div>
                            </div>

 <div class="form-group">
                                <div class="custom-control">
                                    <label> <span style="font-family: 'Arial', sans-serif; font-size: 16px; font-weight: light; color: #333;">4. {{ $questions->d }}</span></label>
                                </div>
                            </div>

                            <!-- Repeat for options b, c, d -->
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endif
        </div>
        @endforeach
    </div>
</div>
                                                      
                  </div>

                                        </div>
                                    </div>
                            </div>
                        </div>
                        @endforeach
                        <!-- </div>  -->
                        <!-- <div class="form-group">
                                <div class="card-body table--elevated">
                                    <div role="group" aria-labelledby="label-question" class="m-0 form-group">
                                        <div class="form-row">
                                            <label id="label-question" for="task_desc"
                                                class="col-md-3 col-form-label form-label">Task Description</label>
                                            <div class="col-md-9">
                                                <script
                                                    src="https://cdn.ckeditor.com/ckeditor5/24.0.0/classic/ckeditor.js"></script>
                                                <textarea id="task_desc" rows="4" class="form-control"
                                                    name="task_desc"></textarea>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div> -->

                        <!-- <div class="form-group">
                                <div class="list-group-item">
                                    <div class="form-group m-0" role="group" aria-labelledby="label-topic">
                                        <div class="form-row align-items-center">
                                            <label id="label-topic" for="course_id"
                                                class="col-md-3 col-form-label form-label">Course</label>
                                            <div class="col-md-9">

                                                
                                                        

                                            </div>
                                        </div>
                                    </div>
                                </div> -->

                        <!-- <div class="form-group">
                                    <div class="list-group-item">
                                        <div class="form-group m-0" role="group" aria-labelledby="label-topic">
                                            <div class="form-row align-items-center">
                                                <label id="label-topic" for="task_level"
                                                    class="col-md-3 col-form-label form-label">Level</label>
                                                <div class="col-md-9">

                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                        <!-- <div class="form-group">
                                    <div class="list-group-item">
                                        <div class="form-group m-0" role="group" aria-labelledby="label-topic">
                                            <div class="form-row align-items-center">
                                                <label id="label-topic" for="difficulty_level"
                                                    class="col-md-3 col-form-label form-label">Difficulty Level</label>
                                                <div class="col-md-9">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                        <!-- <div class="form-group">
                                    <div class="card-body table--elevated">
                                        <div class="form-group m-0" role="group" aria-labelledby="label-title">
                                            <div class="form-row align-items-center">
                                                <label id="label-title" for="NoOfQuestns"
                                                    class="col-md-3 col-form-label form-label">No of Questions</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" id="NoOfQuestns"
                                                        value="{{ $task->NoOfQuestns }}" name="NoOfQuestns">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                        <!-- <div class="form-group">
                                    <div class="card-body table--elevated">
                                        <div class="form-group m-0" role="group" aria-labelledby="label-title">
                                            <div class="form-row align-items-center">
                                                <label id="label-title" for="NofQstnsAns"
                                                    class="col-md-3 col-form-label form-label">No of Questions to be
                                                    Answered</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" id="NofQstnsAns"
                                                        value="{{ $task->NofQstnsAns }}" name="NofQstnsAns">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                        <!-- <div class="form-group">
                                    <div class="card-body table--elevated">
                                        <div role="group" aria-labelledby="label-question" class="m-0 form-group">
                                            <div class="form-row align-items-center">
                                                <label id="label-question" for="file-upload"
                                                    class="col-md-3 col-form-label form-label">File Upload</label>
                                                <div class="col-md-9">
                                                    <input type="file" id="file-upload" name="file"
                                                        class="form-control-file">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                        <!-- <div class="form-group">
                                    <div class="list-group-item">
                                        <div class="text-right">
                                            <button type="submit" style="cursor:pointer" class="btn btn-accent"
                                                onClick="window.location.href = 'https://admin.plusgoals.com/update_task/<?php echo $task->task_id; ?>'">Update</button> -->
                        <!-- <button  type="submit" class="btn btn-primary">Submit</button>  -->
                        <!-- <button type="button" class="btn btn-accent">Next</button> -->
                        <!-- </div>
                                    </div>
                                </div> -->
                    </div>
                </div>
                </form>


                <div class="card">


                    <!--    
                                        <div class="list-group-item">
                                            <div class="text-right">
                                                <button type="button" class="btn btn-accent">Save</button>&nbsp;&nbsp;&nbsp;&nbsp;
                                                <button type="button" class="btn btn-accent">Next</button>
                                            </div>
                                        </div> -->

                </div>

            </div>


            <!-- <ul class="pagination justify-content-start pagination-xsm m-0">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" aria-label="Previous">
                                            <span aria-hidden="true" class="material-icons">chevron_left</span>                         
                                                <span>Prev</span>                           
                                        </a>                           
                                    </li>                          
                                    <li class="page-item">
                                        <a class="page-link" href="#"  aria-label="Page 1">
                                            <span>1</span>                          
                                        </a>                          
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link"  href="#" aria-label="Page 2">                            
                                            <span>2</span>
                                        </a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link"  href="#" aria-label="Next">
                                            <span>Next</span>
                                                <span aria-hidden="true" class="material-icons">chevron_right</span>
                                        </a>
                                    </li>
                                </ul>                         -->
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