
<!DOCTYPE html>
<html lang="en"
      dir="ltr">

    <head>
<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible"
content="IE=edge">
<meta name="viewport"
content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Dashboard</title>

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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
                            
                            <a href="{{ route('GetDescriptiveAnswer') }}" title="Descriptive task evaluation" class="nav-link {{ Request::route()->getName() == 'CountAssignedTasks' ? 'active' : '' }}">Descriptive </a>
                          
                        </li>
                        <li class="nav-item dropdown ">
                            <a href="{{ route('Others') }}" class="nav-link {{ Request::route()->getName() == 'Others' ? 'active' : '' }}">Others</a>
                        </li>
                    </ul>

       
        <div class="nav navbar-nav ml-auto mr-0 flex-nowrap d-flex">
            <!-- Notifications dropdown -->
          
            <div class="nav-item dropdown dropdown-notifications dropdown-xs-down-full" data-toggle="tooltip"
                data-placement="bottom" data-boundary="window">
                @if(Session::get('role') == 1)
                <div class="dropdown">
              
                <button class="btn btn-icon" id="notificationDropdownButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onClick="fetchNotifications()" style="background: none; border: none; width:60px; padding-right:20px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100" height="25" viewBox="0 0 512 512" id="notification">
                   
                        <path style="-inkscape-stroke:none" fill="#ffca28" fill-rule="evenodd" d="m 182.48956,416.5 a 11.001073,11.0012 0 0 0 -10.99987,11 c 6.3e-4,46.53775 37.9622,84.5 84.49903,84.5 46.5368,0 84.50033,-37.96225 84.50097,-84.5 a 11.001073,11.0012 0 0 0 -11.00182,-11 z" clip-rule="evenodd" color="#000"></path>
                        <path fill="#ffc107" fill-rule="evenodd" d="m 307.48773,416.5 a 11.001073,11.0012 0 0 1 11.00196,11 c -5.9e-4,42.80805 -32.1305,78.3343 -73.5,83.75782 3.60368,0.47235 7.27108,0.74218 11,0.74218 46.53675,0 84.49936,-37.96229 84.5,-84.5 a 11.001073,11.0012 0 0 0 -11.00196,-11 z" clip-rule="evenodd" color="#000"></path><g>
                        <path style="-inkscape-stroke:none" fill="#ffca28" fill-rule="evenodd" d="m 255.98969,1.5e-6 c -19.47674,0 -35.5,16.0232565 -35.5,35.4999995 V 49.554689 C 151.98011,55.128404 97.902354,112.59002 97.940864,182.50586 l 0.0488,97.9961 c 0.005,13.80509 -4.07863,27.30054 -11.73633,38.78711 l -5.25977,7.89062 a 11.0012,11.0012 0 0 0 -0.004,0.004 c -17.402071,26.13522 1.9687,62.31178 33.367176,62.3164 a 11.0012,11.0012 0 0 0 0.002,0 h 283.28134 c 31.40201,3.4e-4 50.77542,-36.18123 33.36718,-62.3164 a 11.0012,11.0012 0 0 0 -0.002,-0.004 l -5.26172,-7.89062 a 11.0012,11.0012 0 0 0 0,-0.002 c -7.66021,-11.48572 -11.7452,-24.98131 -11.74219,-38.78711 v -0.002 l 0.0391,-97.99219 a 11.0012,11.0012 0 0 0 0,-0.002 C 414.06581,112.58894 359.99521,55.12843 291.49164,49.552736 V 35.500001 c 0,-19.476743 -16.02327,-35.4999995 -35.5,-35.4999995 z" clip-rule="evenodd" color="#000"></path>
                        <path fill="#ffc107" fill-rule="evenodd" d="m 255.98969,1.5e-6 c -3.83591,0 -7.52803,0.6420459 -11,1.7890629 14.15776,4.676399 24.50195,18.0694836 24.50195,33.7109366 v 14.052735 c 68.50351,5.575684 122.57419,63.036414 122.54883,132.951174 a 11.0012,11.0012 0 0 0 0,0.002 l -0.0391,97.99219 v 0.002 c -0.003,13.80579 4.08199,27.3014 11.74219,38.78711 a 11.0012,11.0012 0 0 0 0,0.002 l 5.26172,7.89062 a 11.0012,11.0012 0 0 1 0.002,0.004 c 17.40823,26.13514 -1.9652,62.31674 -33.36718,62.3164 h 22 c 31.40198,3.4e-4 50.77541,-36.18126 33.36718,-62.3164 a 11.0012,11.0012 0 0 0 -0.002,-0.004 l -5.26172,-7.89062 a 11.0012,11.0012 0 0 0 0,-0.002 c -7.6602,-11.48571 -11.74519,-24.98132 -11.74219,-38.78711 v -0.002 l 0.0391,-97.99219 a 11.0012,11.0012 0 0 0 0,-0.002 C 414.06583,112.58915 359.99514,55.128424 291.49164,49.552736 V 35.500001 c 0,-19.476723 -16.02329,-35.4999995 -35.5,-35.4999995 z" clip-rule="evenodd" color="#000"></path>
                        <path style="-inkscape-stroke:none" fill="#fff8e1" fill-rule="evenodd" d="m 307.19301,99.419928 a 11.00017,11.000108 0 0 0 -12.97871,8.574302 11.00017,11.000108 0 0 0 8.57435,12.98059 c 19.77086,4.04122 35.15691,19.44266 39.17834,39.21914 a 11.00017,11.000108 0 0 0 12.9709,8.58797 11.00017,11.000108 0 0 0 8.58803,-12.97083 c -5.76719,-28.36169 -27.97785,-50.59532 -56.33291,-56.391172 z" clip-rule="evenodd" color="#000"></path></g>
                    </svg>
                </button> 

                    <div class="dropdown-menu" aria-labelledby="notificationDropdownButton" id="notificationList" >
                        <!-- Notifications will be appended here -->
                    </div>
                </div>
                @endif
           
          
                <div class="dropdown-menu dropdown-menu-right">
               
                    <div data-perfect-scrollbar class="position-relative">
                        <div class="dropdown-header"></div>
                        <div class="list-group list-group-flush mb-0"  >

                        
                      
                        </div>
                    </div>
                </div>
            </div>
       
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

            <script>
 $(document).ready(function() {
    // Fetch notifications when the document is ready
    fetchNotifications();
});

function fetchNotifications() {
    $.ajax({
        url: "{{ env('APP_URL') }}notifications",
        type: 'GET',
        dataType: 'json'
    }).done(function(response) {
        if (response.status == true) {
            // Notification count
            if (response.count > 0) {
                $('#notificationDropdownButton').append('<sup id="notificationCount" style="color: red; font-size: 12px;"> <strong>' + response.count + '</strong></sup>');
            }
        } else {
            // Error handling if status is not true
            alert("Failed to fetch notifications");
        }
    }).fail(function(jqXHR, textStatus, errorThrown) {
        // Error handling for AJAX request failure
        console.error("AJAX request failed:", textStatus, errorThrown);
    });
}

$('#notificationDropdownButton').click(function() {
    // Remove notification count when the button is clicked
    $('#notificationCount').remove();
    
    // Fetch and display notifications when the button is clicked
    $.ajax({
        url: "{{ env('APP_URL') }}notifications",
        type: 'GET',
        dataType: 'json'
    }).done(function(response) {
        if (response.status == true) {
            $('#notificationList').empty();
            // Check if notifications exist
            if (response.data && response.data.length > 0) {
                // Iterate over notifications and create list items
                response.data.forEach(function(notification) {
                    // Construct notification message
                    var message = `<i class="fas fa-dot-circle"></i><strong>${notification.notification_text}</strong> for task <strong>${notification.task_name ?? ''}</strong> by ${notification.first_name ?? ''} `;
                    // Create list item
                    var listItem = $('<a href="{{ env('APP_URL') }}request_for_edit/' + notification.task_id + '" class="list-group-item list-group-item-action"></a>').html(message); // Use html() instead of text() to render HTML tags
                    $('#notificationList').append(listItem);
                });
            } else {
                // No notifications found
                $('#notificationList').append('<div class="list-group-item">No notifications</div>');
            }
        } else {
            // Error handling if status is not true
            alert("Failed to fetch notifications");
        }
    }).fail(function(jqXHR, textStatus, errorThrown) {
        // Error handling for AJAX request failure
        console.error("AJAX request failed:", textStatus, errorThrown);
    });
});

</script>


@foreach($data as $user)
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
<div class="mdk-header-layout__content page-content ">

    <div class="page-section bg-alt border-bottom-2">
        <div class="container page__container">

            <div class="d-flex flex-column flex-lg-row align-items-center">
                <div
                    class="flex d-flex flex-column align-items-center align-items-lg-start mb-16pt mb-lg-0 text-center text-lg-left">
                    <h1 class="h2 mb-8pt">Dashboard</h1>
                 
                </div>
                <div class="ml-lg-16pt">

                    <a href="{{route('profileView')}}" class="btn btn-light">My Profile</a>
                </div>
            </div>

        </div>
    </div>

    <div class="page-section">
        <div class="container page__container">

            <div class="row">
                <div class="col-lg-12">             
                 
                    <div class="page-separator">
                        <div class="page-separator__text">Hello {{ $user[0]->first_name }}</div>
                    </div>
                    <div class="card card-body mb-56pt">
                        <div class="mb-36pt">
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="card border-1 border-left-3 border-left-accent text-center mb-lg-0">
                                        <div class="card-body">
                                            <h4 class="h2 mb-0"> {{ $students }}</h4>
                                            <div>Total Interns</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="card text-center mb-lg-0">
                                        <div class="card-body">
                                            <h4 class="h2 mb-0">{{ $teachers }}</h4>
                                            <div>Total Instructors</div>
                                        </div>
                                    </div>
                                </div>
                             
                                <div class="col-lg-2">
                                    <div class="card text-center mb-lg-0">
                                        <div class="card-body">
                                            <h4 class="h2 mb-0">{{ $approved_tasks }}</h4>
                                            <div> Approved Tasks</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="card text-center mb-lg-0">
                                        <div class="card-body">
                                            <h4 class="h2 mb-0">{{ $pending_approval }}</h4>
                                            <div>Total Tasks waiting for approval</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="card text-center mb-lg-0">
                                        <div class="card-body">
                                            <h4 class="h2 mb-0">{{ $selected_interns }}</h4>
                                            <div>Interns Selected by Employers</div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    
                    <!-- <div style="display: flex; align-items: flex-start; justify-content: center;">
                        <div style="width: 60%;">
                            <canvas id="myPieChart"></canvas>
                        </div>
                    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Data from Blade
            var approvedTasks = {{ $approved_tasks }};
            var pendingApproval = {{ $pending_approval }};
            var selectedInterns = {{ $selected_interns }};
            var totalInterns = {{ $students }};
            var totalInstructors = {{ $teachers }};

            // Calculate total
            var total = approvedTasks + pendingApproval + selectedInterns + totalInterns + totalInstructors;
            
            // Calculate percentages
            var approvedTasksPercentage = (approvedTasks / total * 100).toFixed(2);
            var pendingApprovalPercentage = (pendingApproval / total * 100).toFixed(2);
            var selectedInternsPercentage = (selectedInterns / total * 100).toFixed(2);
            var totalInternsPercentage = (totalInterns / total * 100).toFixed(2);
            var totalInstructorsPercentage = (totalInstructors / total * 100).toFixed(2);
            
            var ctx = document.getElementById('myPieChart').getContext('2d');
            var myPieChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: [
                        'Approved Tasks (' + approvedTasksPercentage + '%)',
                        'Pending Approval (' + pendingApprovalPercentage + '%)',
                        'Selected Interns (' + selectedInternsPercentage + '%)',
                        'Total Interns (' + totalInternsPercentage + '%)',
                        'Total Instructors (' + totalInstructorsPercentage + '%)',
                    ],
                    datasets: [{
                        label: 'Task Overview',
                        data: [
                            approvedTasks,
                            pendingApproval,
                            selectedInterns,
                            totalInterns,
                            totalInstructors,
                        ],
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    var dataset = tooltipItem.dataset;
                                    var total = dataset.data.reduce((acc, value) => acc + value, 0);
                                    var value = dataset.data[tooltipItem.dataIndex];
                                    var percentage = (value / total * 100).toFixed(2);
                                    return tooltipItem.label + ': ' + value + ' (' + percentage + '%)';
                                }
                            }
                        }
                    }
                }
            });
        });
    </script> -->
                </div>
            </div>
        </div>
    </div>
</div>
</div>




</div>
<div class="col-lg-4">

  

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

@endforeach
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