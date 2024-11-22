<!DOCTYPE html>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css"
    rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Task </title>

    <!-- Prevent the demo from appearing in search engines -->
    <meta name="robots" content="noindex">

    <link href="https://fonts.googleapis.com/css?family=Lato:400,700%7CRoboto:400,500%7CExo+2:600&display=swap"
        rel="stylesheet">

    <link href="{{asset('vendor/spinkit.css')}}" rel="stylesheet" type="text/css">
  
    <link href="{{asset('vendor/perfect-scrollbar.css')}}" rel="stylesheet" type="text/css">

    <link href="{{asset('css/material-icons.css')}}" rel="stylesheet" type="text/css">

    <link href="{{asset('css/fontawesome.css')}}" rel="stylesheet" type="text/css">

    <link href="{{asset('css/preloader.css')}}" rel="stylesheet" type="text/css">

    <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
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

                            <!-- <span class="d-none d-lg-block">Plus Goals</span> -->
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
                            <a href="{{ route('CountAssignedTasks') }}" class="nav-link {{ Request::route()->getName() == 'CountAssignedTasks' ? 'active-tab' : '' }}">Frequent Tasks</a>
                        </li>
                        <li class="nav-item dropdown ">
                            <a href="{{ url('Others') }}" class="nav-link {{ Request::route()->getName() == 'Others' ? 'active' : '' }}">Others</a>
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

            <div class="page-section bg-alt border-bottom-2">
                <div class="container page__container">

                    <div class="d-flex flex-column flex-lg-row align-items-center">
                        <div
                            class="flex d-flex flex-column align-items-center align-items-lg-start mb-16pt mb-lg-0 text-center text-lg-left">
                            <h1 class="h2 mb-8pt">Tasks assigned frequently</h1>

                        </div>
                
                        &nbsp;&nbsp;
                    
                        <div class="ml-lg-16pt">

                        </div>
                    </div>


                </div>
            </div>
            <div class="container page__container">

                <div class="mdk-header-layout__content page-content ">

                    <div class="page-section">

                        <div class="row">

                            <div class="col-lg-12">
                                <!-- <div class="scrollit"> -->
                                <table class="table align-middle table-nowrap" id="customerTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Task name</th>
                                            <th>Count</th>
                                            <!-- <th>Course</th>  -->
                                            <th>Level</th>
                                            <th>Difficulty level</th>
                                            <th>Created By</th>
                                           
                                            <th>View</th>
                                            <!-- <th>Edit</th> -->
                                        </tr>
                                    </thead>
                                    <tbody class="list form-check-all" id="myTable">
                                        @foreach($result as $task)
                                        @for ($i = 0; $i < count($task); $i++) <tr>
                                            <!-- <td colspan="2"> -->

                                            <td>{{ $task[$i]->task_name }}</td>
                                            <td>{{ $task[$i]->task_count }}</td>
                                            <!-- <td>{{ $task[$i]->course_name }}</td>  -->
                                            <td>{{ $task[$i]->level_name }}</td>
                                            <td>{{ $task[$i]->difficulty_level }}</td>
                                            <td>{{ $task[$i]->first_name }} </td>
                                         
                                           <td>
                                           <button style="border-color: white; border: none; color:#1E90FF" 
                                           onClick="window.location.href = '{{ env('APP_URL') }}taskdetails/<?php echo $task[$i]->task_id; ?>'"><svg
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    </svg>

                                                </button>
                                    
                                            </td>  
                                     
                                            </tr>
                                            @endfor
                                            @endforeach
                                    </tbody>
                                </table>
                              
                            </div>
                        </div>
                    </div>
                </div>
                <!-- </div> -->

                <style>
                    .scrollit {
                        overflow: scroll;
                        height: 100px;
                    }
                </style>
                <!-- // END Header Layout Content -->

                <!-- // END Header Layout -->

                <!-- // END Drawer -->
                <!-- Footer -->

                <div class="bg-dark border-top-2 mt-auto">
                    <div class="container page__container page-section d-flex flex-column">
                        <p class="text-white-70 brand mb-24pt">
                            <img class="brand-icon" src="{{asset('images/plus-goal-logo.svg')}}" width="150"
                                alt="PlusGoals" style="margin-top:20px;">
                        </p>
                        <p class="measure-lead-max text-white-50 small mr-8pt">Plus Goals is a beautifully crafted user
                            interface for modern
                            Education Platforms, including Courses & Tutorials, Video Lessons, Student and Teacher
                            Dashboard, Curriculum
                            Management, Earnings and Reporting, ERP, HR, CMS, Tasks, Projects, eCommerce and more.</p>
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