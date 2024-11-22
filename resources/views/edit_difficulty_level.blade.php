<!DOCTYPE html>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css"
    rel="stylesheet">
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>


<html lang="en" dir="ltr">

<head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Update Difficulty Level</title>

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
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
@if(session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif
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
                            <a href="{{ route('home') }}" class="nav-link {{ Request::route()->getName() == 'home' ? '' : '' }}">Home</a>
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
                        <li class="nav-item dropdown ">
                            
                            <a href="{{ route('GetDescriptiveAnswer') }}" title="Descriptive task evaluation" class="nav-link {{ Request::route()->getName() == 'CountAssignedTasks' ? 'active' : '' }}">Descriptive </a>
                          
                        </li>
                        <li class="nav-item dropdown ">
                            <a href="{{ route('Others') }}" class="nav-link {{ Request::route()->getName() == 'Others' ? 'active' : '' }}">Others</a>
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
 @foreach($data as $level)
 
    <div class="mdk-header-layout__content page-content">
        <div class="page-section bg-alt border-bottom-2">
            <div class="container page__container">
                <div class="d-flex flex-column flex-lg-row align-items-center">
                    <!-- Content if any -->
                </div>
            </div>
        </div>

        <div class="page-section">
            <div class="container page__container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-body mb-48pt">
                        <form method="POST" action="{{ url('update_difficulty_level') }}/{{ $level->id }}" enctype="multipart/form-data">
                    
                                {{ csrf_field() }}
                                
                                <div class="form-group row">
                                    <label for="old_level_name" class="col-md-3 col-form-label form-label">Old Level Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="old_level_name" value="{{ $level->level_name }}" name="old_level_name">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="level_name" class="col-md-3 col-form-label form-label">New Level Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="level_name" placeholder="Enter new level name ..." name="level_name" required>
                                        <span id="title-error" class="error text-danger" style="display:none;">New level name is required.</span> 
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="mode" class="col-md-3 col-form-label form-label">Mode</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="mode" placeholder="{{ $level->mode }}" name="mode" required>
                                        <span id="title-error" class="error text-danger" style="display:none;">Mode is required.</span> 
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="no_of_questions" class="col-md-3 col-form-label form-label">No of questions</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="mode" placeholder="{{ $level->no_of_questions }}" name="no_of_questions" required>
                                        <span id="title-error" class="error text-danger" style="display:none;">No of questions is required.</span> 
                                    </div>
                                </div>

                                
                                <!-- Submit Button -->
                                <div class="form-group">
                                    <div class="list-group-item">
                                        <div class="text-right">
                                            <button type="submit" style="cursor:pointer" class="btn btn-accent">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

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
          
            <script src="{{asset('vendor/jquery.min.js')}}"></script>

            <script src="{{asset('vendor/popper.min.js')}}"></script>
            <script src="{{asset('vendor/bootstrap.min.js')}}"></script>
            <script src="{{asset('vendor/perfect-scrollbar.min.js')}}"></script>
            <script src="{{asset('vendor/dom-factory.js')}}"></script>
            <script src="{{asset('vendor/material-design-kit.js')}}"></script>
            <script src="{{asset('js/app.js')}}"></script>
            <script src="{{asset('js/preloader.js')}}"></script>
            <script src="{{asset('js/settings.js')}}"></script>
            <script src="{{asset('vendor/moment.min.js')}}"></script>
            <script src="{{asset('vendor/moment-range.js')}}"></script>
            <script src="{{asset('vendor/Chart.min.js')}}"></script>
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
   ClassicEditor
      .create(document.querySelector('#editor'), {})
      .catch(error => {
         console.log(error);
      });
</script>
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