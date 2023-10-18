
<!DOCTYPE html>
<html lang="en"
      dir="ltr">

      <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible"
              content="IE=edge">
        <meta name="viewport"
              content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Task </title>

        <!-- Prevent the demo from appearing in search engines -->
        <meta name="robots"
              content="noindex">

        <link href="https://fonts.googleapis.com/css?family=Lato:400,700%7CRoboto:400,500%7CExo+2:600&display=swap"
              rel="stylesheet">

        <!-- Preloader -->
        <!-- <link type="text/css"
              href="../../public/vendor/spinkit.css"
              rel="stylesheet"> -->
              <link href="{{asset('vendor/spinkit.css')}}" rel="stylesheet" type="text/css">
        <!-- Perfect Scrollbar -->
        <!-- <link type="text/css"
              href="../../public/vendor/perfect-scrollbar.css"
              rel="stylesheet"> -->
              <link href="{{asset('vendor/perfect-scrollbar.css')}}" rel="stylesheet" type="text/css">

        <!-- Material Design Icons -->
        <!-- <link type="text/css"
              href="../../public/css/material-icons.css"
              rel="stylesheet"> -->
              <link href="{{asset('css/material-icons.css')}}" rel="stylesheet" type="text/css">

        <!-- Font Awesome Icons -->
        <!-- <link type="text/css"
              href="../../public/css/fontawesome.css"
              rel="stylesheet"> -->
              <link href="{{asset('css/fontawesome.css')}}" rel="stylesheet" type="text/css">

        <!-- Preloader -->
        <!-- <link type="text/css"
              href="../../public/css/preloader.css"
              rel="stylesheet"> -->
              <link href="{{asset('css/preloader.css')}}" rel="stylesheet" type="text/css">

        <!-- App CSS -->
        <!-- <link type="text/css"
              href="../../public/css/app.css"
              rel="stylesheet"> -->
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

            <!-- <div class="sk-bounce">
    <div class="sk-bounce-dot"></div>
    <div class="sk-bounce-dot"></div>
  </div> -->

            <!-- More spinner examples at https://github.com/tobiasahlin/SpinKit/blob/master/examples.html -->
        </div>

        <!-- Header Layout -->
        <div class="mdk-header-layout js-mdk-header-layout">

            <!-- Header -->

            <div id="header"
                 class="mdk-header js-mdk-header mb-0"
                 data-fixed
                 data-effects="waterfall">
                <div class="mdk-header__content">

                    <div class="navbar navbar-expand navbar-light bg-white border-bottom"
                         id="default-navbar"
                         data-primary>
                        <div class="container page__container">

                            <!-- Navbar Brand -->
                            <a href="index.html"
                               class="navbar-brand mr-16pt">

                                <span class="avatar avatar-sm navbar-brand-icon mr-0 mr-lg-8pt">

                                    <span class="avatar-title rounded bg-primary"><img src="images/white.svg"
                                             alt="logo"
                                             class="img-fluid" /></span>

                                </span>

                                <span class="d-none d-lg-block">Plus Goals</span>
                            </a>

                            <!-- Navbar toggler -->
                            <button class="navbar-toggler w-auto mr-16pt d-block rounded-0"
                                    type="button"
                                    data-toggle="sidebar">
                                <span class="material-icons">short_text</span>
                            </button>

                            <ul class="nav navbar-nav d-none d-sm-flex flex justify-content-start ml-8pt">
                                <li class="nav-item">
                                    <a href="{{ route('home') }}"
                                       class="nav-link">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('taskDetails') }}"
                                       class="nav-link">Task</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a href="#"
                                       class="nav-link dropdown-toggle"
                                       data-toggle="dropdown"
                                       data-caret="false">Courses</a>
                                    <div class="dropdown-menu">
                                        <a href="{{ route('courselist') }}"
                                           class="dropdown-item">Browse Courses</a>
                                        <a href="{{ route('courselist') }}"
                                           class="dropdown-item">Preview Course</a>
                                        <a href="student-lesson.html"
                                           class="dropdown-item">Preview Lesson</a>
                                        <a href="student-take-course.html"
                                           class="dropdown-item"><span class="mr-16pt">Take Course</span> <span class="badge badge-notifications badge-accent text-uppercase ml-auto">Pro</span></a>
                                        <a href="student-take-lesson.html"
                                           class="dropdown-item">Take Lesson</a>
                                        <a href="student-take-quiz.html"
                                           class="dropdown-item">Take Quiz</a>
                                        <a href="student-quiz-result-details.html"
                                           class="dropdown-item">Quiz Result</a>
                                        <a href="student-dashboard.html"
                                           class="dropdown-item">Student Dashboard</a>
                                        <a href="student-my-courses.html"
                                           class="dropdown-item">My Courses</a>
                                        <a href="student-quiz-results.html"
                                           class="dropdown-item">My Quizzes</a>
                                        <a href="help-center.html"
                                           class="dropdown-item">Help Center</a>
                                    </div>
                                </li>
                                <!-- <li class="nav-item dropdown">
                                    <a href="#"
                                       class="nav-link dropdown-toggle"
                                       data-toggle="dropdown"
                                       data-caret="false">Paths</a>
                                    <div class="dropdown-menu">
                                        <a href="paths.html"
                                           class="dropdown-item">Browse Paths</a>
                                        <a href="student-path.html"
                                           class="dropdown-item">Path Details</a>
                                        <a href="student-path-assessment.html"
                                           class="dropdown-item">Skill Assessment</a>
                                        <a href="student-path-assessment-result.html"
                                           class="dropdown-item">Skill Result</a>
                                        <a href="student-paths.html"
                                           class="dropdown-item">My Paths</a>
                                    </div>
                                </li> -->
                                <!-- <li class="nav-item">
                                    <a href="pricing.html"
                                       class="nav-link">Pricing</a>
                                </li> -->
                                <li class="nav-item dropdown active">
                                    <a href="#"
                                       class="nav-link dropdown-toggle"
                                       data-toggle="dropdown"
                                       data-caret="false">Teachers</a>
                                    <div class="dropdown-menu">
                                        <a href="{{ route('teachers') }}"
                                           class="dropdown-item active">Teachers list</a>
                                        <a href="instructor-courses.html"
                                           class="dropdown-item">Manage Courses</a>
                                        <a href="instructor-quizzes.html"
                                           class="dropdown-item">Manage Quizzes</a>
                                        <a href="instructor-earnings.html"
                                           class="dropdown-item">Earnings</a>
                                        <a href="instructor-statement.html"
                                           class="dropdown-item">Statement</a>
                                        <a href="instructor-edit-course.html"
                                           class="dropdown-item">Edit Course</a>
                                        <a href="instructor-edit-quiz.html"
                                           class="dropdown-item">Edit Quiz</a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown active">
                                    <a href="#"
                                       class="nav-link dropdown-toggle"
                                       data-toggle="dropdown"
                                       data-caret="false">Students</a>
                                    <div class="dropdown-menu">
                                        <a href="{{ route('paidStudents') }}"
                                           class="dropdown-item active">Paid Students</a>
                                        <a href="{{ route('unpaidStudents') }}"
                                           class="dropdown-item">Unpaid Students</a>
                                       
                                    </div>
                                </li>
                                <li class="nav-item dropdown"
                                    data-toggle="tooltip"
                                    data-title="Community"
                                    data-placement="bottom"
                                    data-boundary="window">
                                    <a href="#"
                                       class="nav-link dropdown-toggle"
                                       data-toggle="dropdown"
                                       data-caret="false">
                                        <i class="material-icons">people_outline</i>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a href="teachers.html"
                                           class="dropdown-item">Browse Teachers</a>
                                        <a href="student-profile.html"
                                           class="dropdown-item">Student Profile</a>
                                        <a href="teacher-profile.html"
                                           class="dropdown-item">Instructor Profile</a>
                                        <a href="blog.html"
                                           class="dropdown-item">Blog</a>
                                        <a href="blog-post.html"
                                           class="dropdown-item">Blog Post</a>
                                        <a href="faq.html"
                                           class="dropdown-item">FAQ</a>
                                        <a href="help-center.html"
                                           class="dropdown-item">Help Center</a>
                                        <a href="discussions.html"
                                           class="dropdown-item">Discussions</a>
                                        <a href="discussion.html"
                                           class="dropdown-item">Discussion Details</a>
                                        <a href="discussions-ask.html"
                                           class="dropdown-item">Ask Question</a>
                                    </div>
                                </li>
                            </ul>

                            <form class="search-form form-control-rounded navbar-search d-none d-lg-flex mr-16pt"
                                  action="index.html"
                                  style="max-width: 230px">
                                <button class="btn"
                                        type="submit"><i class="material-icons">search</i></button>
                                <input type="text"
                                       class="form-control"
                                       placeholder="Search ...">
                            </form>

                            <div class="nav navbar-nav ml-auto mr-0 flex-nowrap d-flex">

                                <!-- Notifications dropdown -->
                                <div class="nav-item dropdown dropdown-notifications dropdown-xs-down-full"
                                     data-toggle="tooltip"
                                     data-title="Messages"
                                     data-placement="bottom"
                                     data-boundary="window">
                                    <button class="nav-link btn-flush dropdown-toggle"
                                            type="button"
                                            data-toggle="dropdown"
                                            data-caret="false">
                                        <i class="material-icons icon-24pt">mail_outline</i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <div data-perfect-scrollbar
                                             class="position-relative">
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
                                                                 alt="people"
                                                                 class="avatar-img rounded-circle">
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
                                                                 alt="people"
                                                                 class="avatar-img rounded-circle">
                                                        </span>
                                                        <span class="flex d-flex flex-column">
                                                            <strong class="text-black-100">Michelle</strong>
                                                            <span class="text-black-70">🔥 Superb job..</span>
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
                                     data-toggle="tooltip"
                                     data-title="Notifications"
                                     data-placement="bottom"
                                     data-boundary="window">
                                    <button class="nav-link btn-flush dropdown-toggle"
                                            type="button"
                                            data-toggle="dropdown"
                                            data-caret="false">
                                        <i class="material-icons">notifications_none</i>
                                        <span class="badge badge-notifications badge-accent">2</span>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <div data-perfect-scrollbar
                                             class="position-relative">
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
                                                                <i class="material-icons font-size-16pt text-accent">account_circle</i>
                                                            </span>
                                                        </span>
                                                        <span class="flex d-flex flex-column">

                                                            <span class="text-black-70">Your profile information has not been synced correctly.</span>
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
                                                                <i class="material-icons font-size-16pt text-primary">group_add</i>
                                                            </span>
                                                        </span>
                                                        <span class="flex d-flex flex-column">
                                                            <strong class="text-black-100">Adrian. D</strong>
                                                            <span class="text-black-70">Wants to join your private group.</span>
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
                                                                <i class="material-icons font-size-16pt text-warning">storage</i>
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
                                    <a href="#"
                                       class="nav-link d-flex align-items-center dropdown-toggle"
                                       data-toggle="dropdown"
                                       data-caret="false">

                                        <span class="avatar avatar-sm mr-8pt2">

                                            <span class="avatar-title rounded-circle bg-primary"><i class="material-icons">account_box</i></span>

                                        </span>

                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <div class="dropdown-header"><strong>Account</strong></div>
                                        <a class="dropdown-item"
                                           href="edit-account.html">Edit Account</a>
                                        <a class="dropdown-item"
                                           href="billing.html">Billing</a>
                                        <a class="dropdown-item"
                                           href="billing-history.html">Payments</a>
                                        <a class="dropdown-item"
                                           href="login.html">Logout</a>
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

                <div class="page-section bg-alt border-bottom-2">
                    <div class="container page__container">

                        <div class="d-flex flex-column flex-lg-row align-items-center">
                            <div class="flex d-flex flex-column align-items-center align-items-lg-start mb-16pt mb-lg-0 text-center text-lg-left">
                                <h1 class="h2 mb-8pt">Tasks</h1>
                        
                            </div>
                            <div class="ml-lg-16pt">
                            
                                <a href="{{ route('taskLevel') }}"
                                   class="btn btn-light">New task</a>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="page-section">
                    <div class="container page__container">

                        <div class="row">
                            <div class="col-lg-8">

                            
                                @foreach($result as $task)
                               
                                <div class="page-separator">
                                    <div class="page-separator__text">Task {{$task->task_id}} </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-left mr-24pt">
                                                <!-- <a href="#"
                                                   class="avatar avatar-sm"> -->
                                                    <!-- <img src="../../public/images/people/110/guy-9.jpg" alt="Guy" class="avatar-img rounded-circle"> -->
                                                    <!-- <span class="avatar-title rounded-circle">LB</span>
                                                </a> -->
                                            </div>
                                            <div class="media-body d-flex flex-column">
                                                <div class="d-flex align-items-center">
                                                    <!-- <a href="profile.html"
                                                       class="card-title">Laza Bogdan</a>
                                                    <small class="ml-auto text-muted">27 min ago</small><br> -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="media-left mr-12pt">
                                                <!-- <a href="#"
                                                   class="avatar avatar-sm">
                                                    <img src="../../public/images/people/110/guy-6.jpg" alt="Guy" class="avatar-img rounded-circle">
                                                    <span class="avatar-title rounded-circle"></span>
                                                </a> -->
                                                <!-- <div class="d-flex align-items-center"> -->
                                                    <a href="{{ url('taskdetails')}}/{{ $task->task_id }}"
                                                       class="card-title">{{ $task->task_name}}</a>
                                                    <small class="ml-auto text-muted"></small>
                                                 <!-- </div> -->
                                        </div>
                                      <br>
                                        <div class="media ml-sm-32pt mt-8 border">
                                         
                                            <div class="media-body">
                                             
                                            <div  style=" font-weight:bold;"> Task Description :
                                            <span style="font: size 15px;">
                                                {{ $task->task_desc }}
                                            </span>
                                            </div>
                                            <div  style="font-weight:bold;"> Number of questions :
                                            <span style="font: size 15px;">
                                                {{ $task->NoOfQuestns }}
                                            </span>
                                            </div>
                                            <div  style="font-weight:bold;"> Level :
                                            <span>
                                                {{ $task->level_name }}
                                            </span>
                                            </div>
                                                <!-- <a href="#class="text-underline"></a>  -->
                                                
                                            </div>
                                        </div>
                                    </div>
                                  
                                </div>
                                
                                @endforeach

                            </div>
                         
                        </div>

                    </div>
                </div>

            </div>
            <!-- // END Header Layout Content -->

        <!-- // END Header Layout -->

        <!-- // END Drawer -->
        
            <!-- Footer -->

            <div class="bg-dark border-top-2 mt-auto">
<div class="container page__container page-section d-flex flex-column">
<p class="text-white-70 brand mb-24pt">
<img class="brand-icon" src="images/plus-goal-logo.svg" width="150" alt="Luma">
</p>
<p class="measure-lead-max text-white-50 small mr-8pt">Luma is a beautifully crafted user interface for modern Education Platforms, including Courses & Tutorials, Video Lessons, Student and Teacher Dashboard, Curriculum Management, Earnings and Reporting, ERP, HR, CMS, Tasks, Projects, eCommerce and more.</p>
<p class="mb-8pt d-flex">
<a href class="text-white-70 text-underline mr-8pt small">Terms</a>
<a href class="text-white-70 text-underline small">Privacy policy</a>
</p>
<p class="text-white-50 small mt-n1 mb-0">Copyright 2019 &copy; All rights reserved.</p>
</div>
</div>
            <!-- // END Footer -->

        </div>
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

        <!-- Global Settings -->
        <!-- <script src="../../public/js/settings.js"></script> -->
        <script src="{{asset('js/settings.js')}}"></script>

        <!-- Moment.js -->
        <!-- <script src="../../public/vendor/moment.min.js"></script>
        <script src="../../public/vendor/moment-range.js"></script> -->
        <script src="{{asset('vendor/moment.min.js')}}"></script>
        <script src="{{asset('vendor/moment-range.js')}}"></script>

        <!-- Chart.js -->
        <!-- <script src="../../public/vendor/Chart.min.js"></script> -->
        <script src="{{asset('vendor/Chart.min.js')}}"></script>

        <!-- UI Charts Page JS -->
        <!-- <script src="../../public/js/chartjs-rounded-bar.js"></script>
        <script src="../../public/js/chartjs.js"></script> -->
        <script src="{{asset('js/chartjs-rounded-bar.js')}}"></script>
        <script src="{{asset('js/chartjs.js')}}"></script>

        <!-- Chart.js Samples -->
        <!-- <script src="../../public/js/page.instructor-dashboard.js"></script> -->
        <script src="{{asset('js/page.instructor-dashboard.js')}}"></script>

        <!-- List.js -->
        <!-- <script src="../../public/vendor/list.min.js"></script>
        <script src="../../public/js/list.js"></script> -->
        <script src="{{asset('vendor/list.min.js')}}"></script>
        <script src="{{asset('js/list.js')}}"></script>

    </body>

</html>