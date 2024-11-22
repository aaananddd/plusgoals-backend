<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Students Status</title>
    <!-- Prevent the demo from appearing in search engines -->
    <meta name="robots" content="noindex">

    <link href="https://fonts.googleapis.com/css?family=Lato:400,700%7CRoboto:400,500%7CExo+2:600&display=swap"
        rel="stylesheet">

    <!-- Preloader -->
    <link href="{{asset('vendor/spinkit.css')}}" rel="stylesheet" type="text/css">
    <!-- Perfect Scrollbar -->
    <link href="{{asset('vendor/perfect-scrollbar.css')}}" rel="stylesheet" type="text/css">

    <!-- Material Design Icons -->
    <link href="{{asset('css/material-icons.css')}}" rel="stylesheet" type="text/css">

    <!-- Font Awesome Icons -->
    <link href="{{asset('css/fontawesome.css')}}" rel="stylesheet" type="text/css">

    <!-- Preloader -->
    <link href="{{asset('css/preloader.css')}}" rel="stylesheet" type="text/css">

    <!-- App CSS -->
    <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">

    <style>
  
      .nav-item .nav-link.active-tab {
        color:#1E90FF;
      }

        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px;
            padding: 8px;
            text-align: left;
            background-color: #fff;
            /* Set background color to white */
        }

        th {
            background-color: #f2f2f2;
        }

        button {
            width: 40px;
            height: 30px;
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
                            <a href="{{ route('home') }}" class="nav-link {{ Request::route()->getName() == 'home' ? 'active-tab' : '' }}">Home</a>
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
        @foreach($data as $students)

        <div class="mdk-header-layout__content page-content ">
            <div class="page-section bg-alt border-bottom-2">
                <div class="container page__container">
                    <div class="d-flex flex-column flex-lg-row align-items-center">
                        {{ csrf_field() }}
                        <div
                            class="d-flex flex-column flex-md-row align-items-center flex mb-16pt mb-lg-0 text-center text-md-left">
                            <div class="mb-16pt mb-md-0 mr-md-24pt">
                            </div>
                            <div class="col-lg-8">
                            <h3>{{ $students[0]->first_name }} {{ $students[0]->last_name }}</h3>
                                <table>
    <tbody>  
        <tr>
            <!-- <td style="text-align: left;">Task </td> -->
            <!-- <td>
               @if( $students[0]->task_name != null)
		{{ $students[0]->task_name }}
               @else
		 Task
	       @endif
	</td>    -->
        </tr>
        <tr>
            <td >Level</td>
            <td > {{ $students[0]->level_name }}</td>    
        </tr>
        <tr>
            <td >Difficulty Level</td>
            <td>{{ $students[0]->difficulty }}</td>   
        </tr>
        <!-- <tr>
	 @if($students[0]->task_status == 1)
            <td style="text-align: left;">Completed Tasks</td>
            <td>{{$students[0]->task_status}}</td>
	@else
		Task not completed
	@endif
        </tr> -->
         </tbody>
</table>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>

            <div class="mdk-header-layout__content page-content ">
                <div class="page-section">
                    <div class="container page__container">
                        <div class="row">

                            <div class="col-lg-12">
                                <table class="table align-middle table-nowrap" id="customerTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Sl.No</th>
                                            <th>Task Name</th>
                                            <th>Level</th>
                                            <th>Difficulty Level</th>
                                            <th>Status</th>
                                            <th>View</th> 
                                        </tr>
                                    </thead>
                                    <tbody class="list form-check-all" id="myTable">
                                        @for( $i = 0; $i < count($students); $i++) 
					 @if($students[$i]->task_id != null)
                                            <tr>
                                                <td>{{ $i + 1 }}</td>
                                                <td>@if( $students[$i]->task_name != null)
                                                    {{ $students[$i]->task_name }}
                                                            @else
                                                    Task
                                                        @endif
                                                </td>
                                                <td>{{ $students[$i]->level_name }}</td>
                                                <td>{{ $students[$i]->difficulty }}</td>
                                                <td>
                                            @if ($students[$i]->task_completion == 1)
                                                Passed
                                            @else
                                                Failed
                                            @endif
                                        </td>
                                        <td> 
                                        
                                        <button style="border-color: white; border: none; color:#1E90FF" 
                                        onClick="window.location.href = '{{ env('APP_URL') }}completed_task_view/<?php echo $students[$i]->task_id; ?>/<?php echo $students[$i]->id; ?>'"><svg
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    </svg>

                                                </button> </td>
                                                           </tr>
						 @else 
                                    <span style="color: red;"> No tasks attempted </span> 
                                @endif
                                            @endfor
                                @endforeach
                                    </tbody>
                                </table>
                               
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->

                <div class="bg-dark border-top-2 mt-auto">
                    <div class="container page__container page-section d-flex flex-column">
                        <p class="text-white-70 brand mb-24pt">
                            <img class="brand-icon" src="{{asset('images/plus-goal-logo.svg')}}" width="150"
                                alt="Plus Goals" style="margin-top:20px;">
                        </p>
                        <p class="measure-lead-max text-white-50 small mr-8pt">Plus Goals is a beautifully crafted user
                            interface for modern Education Platforms, including Courses & Tutorials, Video Lessons,
                            Student and
                            Teacher Dashboard, Curriculum Management, Earnings and Reporting, ERP, HR, CMS, Tasks,
                            Projects,
                            eCommerce and more.</p>
                        <p class="mb-8pt d-flex">
                            <a href class="text-white-70 text-underline mr-8pt small">Terms</a>
                            <a href class="text-white-70 text-underline small">Privacy policy</a>
                        </p>
                        <p class="text-white-50 small mt-n1 mb-0">Copyright 2019 &copy; All rights reserved.</p>
                    </div>
                </div>

                <!-- // END Footer -->
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