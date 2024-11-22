<!DOCTYPE html> <html lang="en" dir="ltr"> <head> <meta charset="utf-8"> <meta http-equiv="X-UA-Compatible"
    content="IE=edge"> <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <title>
    Edit Profile</title>

<!-- Prevent the demo from appearing in search engines -->
<meta name="robots" content="noindex"> <link
    href="https://fonts.googleapis.com/css?family=Lato:400,700%7CRoboto:400,500%7CExo+2:600&display=swap"
    rel="stylesheet"><!-- Preloader -->

<link href="{{asset('vendor/spinkit.css')}}" rel="stylesheet" type="text/css">

<link href="{{asset('vendor/perfect-scrollbar.css')}}" rel="stylesheet" type="text/css">

<link href="{{asset('css/material-icons.css')}}" rel="stylesheet" type="text/css">

<link href="{{asset('css/fontawesome.css')}}" rel="stylesheet" type="text/css">

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
<style>
       .nav-item .nav-link.active-tab {
        color:#1E90FF;
      }
</style>
          
</div>

<!-- Header Layout -->
<div class="mdk-header-layout js-mdk-header-layout">

<!-- Header -->

<div id="header" class="mdk-header js-mdk-header mb-0" data-fixed data-effects="waterfall"> <div
    class="mdk-header__content">

    <div class="navbar navbar-expand navbar-light bg-white border-bottom"
    id="default-navbar"
    data-primary>
    <div class="container page__container">

    <!-- Navbar Brand -->
    <a href="index.html"
    class="navbar-brand mr-16pt">

    <span ><img src="{{asset('images/plus-goal-logo.svg')}}"
    width="150" height="100"></span>

    <!-- ?span class=?d-none d-lg-block??Plus Goals?/span? -->
    </a>

    <!-- Navbar toggler -->
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
                            <a href="{{ route('Others') }}" class="nav-link {{ Request::route()->getName() == 'Others' ? 'active' : '' }}">Others</a>
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

<!-- // END Header -->

<!-- Header Layout Content -->
<div class="mdk-header-layout__content page-content ">

    <div class="page-section bg-alt border-bottom-2">
        <div class="container page__container">

            <div class="d-flex flex-column flex-lg-row align-items-center">
                <div
                    class="d-flex flex-column flex-md-row align-items-center flex mb-16pt mb-lg-0 text-center text-md-left">
                    <div class="mb-16pt mb-md-0 mr-md-24pt">
                  
                    </div>
                    <div class="col-lg-8">
                        <h1 class="h2 mb-0">User Details</h1><br>

                        <div>

                        </div>
                       
                    </div>
                </div>
                
            </div>
            
        </div>
    </div>
    @foreach($data as $user)

    <div class="page-section">
        <div class="container page__container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row card-group-row mb-8pt">
                    </div>
                    <div class="card">
                        <form method="POST" action="{{  url('updateprofile/'. $user[0]->id) }}">
                            <!-- < class="card-body"> -->
                            {{ csrf_field() }}
                          
                            <div class="form-group">
                                <div class="card-body table--elevated">
                                    <div class="form-group m-0" role="group" aria-labelledby="label-title">
                                        <div class="form-row align-items-center">
                                            <label id="label-title" for="task_name"
                                                class="col-md-3 col-form-label form-label">First Name</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="first_name"
                                                    name="course_name" value="{{$user[0]->first_name }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="card-body table--elevated">
                                    <div class="form-group m-0" role="group" aria-labelledby="label-title">
                                        <div class="form-row align-items-center">
                                            <label id="label-title" for="task_name"
                                                class="col-md-3 col-form-label form-label">Last Name</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="last_name"
                                                    name="course_name" value="{{$user[0]->last_name }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="form-group">
                                <div class="card-body table--elevated">
                                    <div class="form-group m-0" role="group" aria-labelledby="label-title">
                                        <div class="form-row align-items-center">
                                            <label id="label-title" for="task_name"
                                                class="col-md-3 col-form-label form-label">Email ID</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="email"
                                                    name="email" value="{{$user[0]->email }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="card-body table--elevated">
                                    <div class="form-group m-0" role="group" aria-labelledby="label-title">
                                        <div class="form-row align-items-center">
                                            <label id="label-title" for="task_name"
                                                class="col-md-3 col-form-label form-label">Phone</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="phone"
                                                    name="phone" value="{{$user[0]->phone }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="card-body table--elevated">
                                    <div role="group" aria-labelledby="label-question" class="m-0 form-group">
                                        <div class="form-row">
                                            <label id="label-question" for="course_desc"
                                                class="col-md-3 col-form-label form-label">Address 1</label>
                                            <div class="col-md-9">
                                                <!-- <script src="https://cdn.ckeditor.com/ckeditor5/24.0.0/classic/ckeditor.js"></script> -->
                                                <textarea id="course_desc" rows="4" class="form-control"
                                                    name="address1"> {{$user[0]->address1 }}</textarea>
                                                  
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="card-body table--elevated">
                                    <div role="group" aria-labelledby="label-question" class="m-0 form-group">
                                        <div class="form-row">
                                            <label id="label-question" for="course_desc"
                                                class="col-md-3 col-form-label form-label">Address 2</label>
                                            <div class="col-md-9">
                                                <!-- <script src="https://cdn.ckeditor.com/ckeditor5/24.0.0/classic/ckeditor.js"></script> -->
                                                <textarea id="course_desc" rows="4" class="form-control"
                                                    name="address2"> {{$user[0]->address2 }} </textarea>
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
                                                    class="col-md-3 col-form-label form-label">City</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" id="city"
                                                         name="city" value="{{$user[0]->city }}">
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
                                                    class="col-md-3 col-form-label form-label">District </label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" id="district"
                                                         name="district" value="{{$user[0]->district }}">
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
                                                    class="col-md-3 col-form-label form-label">State </label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" id="state"
                                                         name="state" value="{{$user[0]->state }}">
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
                                                    class="col-md-3 col-form-label form-label">Country </label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" id="country"
                                                         name="country" value="{{$user[0]->country }}">
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
                                                    class="col-md-3 col-form-label form-label">Pincode </label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" id="pincode"
                                                         name="pincode" value="{{$user[0]->pincode }}">
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
                                                    class="col-md-3 col-form-label form-label">Joining Date</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" id="created_at"
                                                         name="created_at" value="{{ Carbon\Carbon::parse($user[0]->created_at)->format('Y-m-d')  }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="list-group-item">
                                        <div class="text-right">
                                        <button type="submit" style="cursor:pointer" class="btn btn-primary"
                                                onClick="window.location.href = 'https://admin.plusgoals.com/updateprofile/<?php echo $user[0]->id; ?>'">Update</button>
                                         
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
    <!-- // END Header Layout Content -->



            <!-- // END Footer -->

</div>
<!-- // END Header Layout -->

<!-- Drawer -->
   <!-- Footer -->

   <div class="bg-dark border-top-2 mt-auto">
<div class="container page__container page-section d-flex flex-column">
<p class="text-white-70 brand mb-24pt">

<img class="brand-icon" src="{{asset('images/plus-goal-logo.svg')}}" width="150" alt="Plus Goals" style="margin-top:20px;">
</p>
<p class="measure-lead-max text-white-50 small mr-8pt">Plus Goals is a beautifully crafted user interface for modern Education Platforms, including Courses & Tutorials, Video Lessons, Student and Teacher Dashboard, Curriculum Management, Earnings and Reporting, ERP, HR, CMS, Tasks, Projects, eCommerce and more.</p>
<p class="mb-8pt d-flex">
<a href class="text-white-70 text-underline mr-8pt small">Terms</a>
<a href class="text-white-70 text-underline small">Privacy policy</a>
</p>
<p class="text-white-50 small mt-n1 mb-0">Copyright 2019 &copy; All rights reserved.</p>
</div>
</div>

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
                    <a class="sidebar-menu-button js-sidebar-collapse" data-toggle="collapse" href="#instructor_menu">
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
                    <a class="sidebar-menu-button" data-toggle="collapse" href="#community_menu">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">people_outline</span>
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
        .create(document.querySelector('#course_desc'), {})
        
        .catch(error => {
            console.log(error);
        });
</script>


</html>