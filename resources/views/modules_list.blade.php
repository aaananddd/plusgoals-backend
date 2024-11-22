<!DOCTYPE html>
<html lang="en"
      dir="ltr">

    <head>
<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible"
content="IE=edge">
<meta name="viewport"
content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Module List </title>
<!-- Prevent the demo from appearing in search engines -->
<meta name="robots"
              content="noindex">

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

      .small-btn {
            padding: 0;
            width: 30px;
            height: 30px;
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
    <a href="index.html" class="navbar-brand mr-16pt">

    <span ><img src="{{asset('images/plus-goal-logo.svg')}}" width="150" height="100"></span>

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

       
        <div class="nav navbar-nav ml-auto mr-0 flex-nowrap d-flex">
            <!-- Notifications dropdown -->
          
            <div class="nav-item dropdown dropdown-notifications dropdown-xs-down-full" data-toggle="tooltip"
                data-placement="bottom" data-boundary="window">

                <div class="dropdown">
              

                    <div class="dropdown-menu" aria-labelledby="notificationDropdownButton" id="notificationList" >
                        <!-- Notifications will be appended here -->
                    </div>
                </div>
        
          
                <div class="dropdown-menu dropdown-menu-right">
               
                    <div data-perfect-scrollbar class="position-relative">
                        <div class="dropdown-header"></div>
                        <div class="list-group list-group-flush mb-0"  >

                        
                      
                        </div>
                    </div>
                </div>
            </div>
       
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        
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
</div>

        <!-- // END Header -->
      
        <!-- Header Layout Content -->
        <div class="mdk-header-layout__content page-content">
                <div class="page-section bg-alt border-bottom-2">
                    <div class="container page__container">
                  
                        <div class="d-flex flex-column flex-lg-row align-items-center">
                            <div class="row align-items-center w-100">
                          
                                <div class="ml-lg-4pt" > 
                                    <a href="{{ route('addNewModule') }}" class="btn btn-light ml-lg-2" style="color:#1E90FF;">Add new module</a> 
                                </div>
                                <form class="search-form form-control-rounded navbar-search d-none d-lg-flex mr-6pt ml-auto"
                                    style="max-width: 150px;">
                                    <button class="btn" type="submit"><i class="material-icons">search</i></button>
                                    <input type="text" class="form-control" id="input" placeholder="Search ...">
                                </form>
                            </div>
                           
                        </div>
                        
                    </div>
     
                </div>
                <br>
                <div class="mdk-header-layout__content page-content ">
            <div class="page-section">
               <div class="container page__container">
                  <div class="row">

                     <div class="col-lg-12">
    <table class="table align-middle table-nowrap" id="customerTable">
        <thead class="table-light">
            <tr>
                <th>Sl.No</th>
                <th>Module Name</th>
                <th>Topic</th>
                <th>Created By</th>
                <th>Created at</th>
                <th>View</th>
                <th>Edit</th>
                <th>Delete</th>
            
            </tr>
        </thead>
        <tbody class="list form-check-all" id="myTable">
        @foreach($data as $index => $module)
    
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $module->module_name }}</td>
                <td>{{ $module->topic }}</td>
                <td>{{ $module->first_name }} {{ $module->last_name }}</td>
                <td>{{ Carbon\Carbon::parse($module->created_at)->format('d-m-Y') }}</td>
                <td><button style="border-color: white; border: none; color:#1E90FF"  onClick="window.location.href = '{{ env('APP_URL') }}get_module/{{ $module->id }}'">
                        <i class="fa fa-eye" style="font-size:24px"></i>
                    </button>
                </td>
                <td class="text-center"> 
                <button style="border-color: white; border: none; color:#1E90FF" onClick="window.location.href = '{{ env('APP_URL') }}update_modules/{{ $module->id }}'">
                    <i class="fa fa-edit" style="font-size:20px"></i>
                </button>

                </td>
                <td>
                <button style="border-color: white; border: none; color:#1E90FF" onClick="window.location.href = '{{ env('APP_URL') }}remove_module/{{ $module->id }}'">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" width="20" height="20" align="center" color="#1E90FF">
                        <path d="M3 2a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H3Z" />
                        <path fill-rule="evenodd" d="M3 6h10v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6Zm3 2.75A.75.75 0 0 1 6.75 8h2.5a.75.75 0 0 1 0 1.5h-2.5A.75.75 0 0 1 6 8.75Z" clip-rule="evenodd" />
                    </svg>
                </button>

                </td>
            </tr>
      
            @endforeach
        </tbody>
    </table>
    </div>
    </div>
    </div>
                </div>
           
</div>
            </div>

           
        
                <!-- </div> -->
                 


<!-- <script>
    $(document).ready(function() {
        $('#updateModal').modal('show');
    });
</script> -->

<style>
    .scrollit {
        overflow: scroll;
        height: 100px;
    }
    
    .modal-backdrop {
    opacity: 1 !important; /* Ensure backdrop is fully opaque */
    transition: none !important; /* Disable any transitions */
}
</style>
          
            <script>

                    //Delete task 
                         $(document).ready(function() {
                            $('.delete-file').click(function(event) {
                                event.preventDefault(); // Prevent default form submission
        
                            var fileId = $(this).data('file-id');
      
                            $.ajax({
                                url: '/delete_task/' + fileId,
                                type: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(data) {
                                    console.log(data);
                                    if(data.status === true) {
                                        Swal.fire("File deleted", "", "success").then((result) => {
                                           
                                            document.getElementById("redirectForm").submit();
                                        });
                                    } else {
                                        Swal.fire("Failed to delete file", "", "error");
                                    }   
                                },
                                error: function(xhr, status, error) {
                                    Swal.fire("Failed to delete file", "", "error");
                                    console.error(xhr.responseText);
                                }
                            });
                        });
                    });

                    // Request to edit
			        function sendRequest(task_id, created_by){
                                 
                                $.ajax({
                                        type: "POST",
                                        url: "{{ env('APP_URL') }}request_to_edit/" + task_id + "/" + created_by, 
                                    
                                        data: {
                                        'task_id' : task_id,
                                        'user_id' : created_by,
                                        '_token': '{{ csrf_token() }}'
                                        
                                        },
                                       
                                    success: function(data) {
                                        
                                        if(data.status === true){
                                            Swal.fire("Request sent successfully", "", "success").then((result) => {
                                                if (result.isConfirmed) {
                                                window.location.href="{{ route('taskDetails')}}";
                                            } else {
                                                window.location.href="{{ route('taskDetails')}}";
                                            }
                                        });

                                        } else {
                                            Swal.fire("Failed to sent request", "", "danger").then((result) => {
                                            if (result.isConfirmed) {
                                                window.location.href="{{ route('taskDetails')}}";
                                            } else {
                                                window.location.href="{{ route('taskDetails')}}";
                                            }
                                           });
                                        }   
                                    },
                                    error: function(xhr, status, error) {
                                        var errorMessage = xhr.responseText;
                                        Swal.fire("Error", errorMessage, "error");
                                        }
                                    });
				        }
                   
                    </script>
                <!-- // END Header Layout Content -->

                <!-- // END Header Layout -->

                <!-- // END Drawer -->
                <!-- Footer -->

                <div class="bg-dark border-top-2 mt-auto">
    <div class="container page__container page-section d-flex flex-column">
        <p class="text-white-70 brand mb-24pt">
            <img class="brand-icon" src="{{asset('images/plus-goal-logo.svg')}}" width="150" alt="Luma">
        </p>
        <p class="measure-lead-max text-white-50 small mr-8pt">Plus Goals is a beautifully crafted user interface for modern
            Education Platforms, including Courses & Tutorials, Video Lessons, Student and Teacher Dashboard, Curriculum
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
<!-- // END Header Layout -->

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