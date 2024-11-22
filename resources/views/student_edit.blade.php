<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet"> <!-- Bootstrap
  CSS -->
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
  <!-- Font Awesome CSS -->
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css'>
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700%7CRoboto:400,500%7CExo+2:600&display=swap"
    rel="stylesheet">
  <title>Student Details</title>
  <link href="{{asset('vendor/spinkit.css')}}" rel="stylesheet" type="text/css">
  <link href="{{asset('vendor/perfect-scrollbar.css')}}" rel="stylesheet" type="text/css">
  <link href="{{asset('css/material-icons.css')}}" rel="stylesheet" type="text/css">
  <link href="{{asset('css/fontawesome.css')}}" rel="stylesheet" type="text/css">
  <link href="{{asset('css/preloader.css')}}" rel="stylesheet" type="text/css">
  <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
  <style>

      .nav-item .nav-link.active-tab {
        color:#1E90FF;
      }

    .student-profile .card {
      border-radius: 10px;
    }

    .student-profile .card .card-header .profile_img {
      width: 150px;
      height: 150px;
      object-fit: cover;
      margin: 10px auto;
      border: 10px solid #ccc;
      border-radius: 50%;
    }

    .student-profile .card h3 {
      font-size: 20px;
      font-weight: 700;
    }

    .student-profile .card p {
      font-size: 16px;
      color: #000;
    }

    .student-profile .table th,
    .student-profile .table td {
      font-size: 14px;
      padding: 5px 10px;
      color: #000;
    }
  </style>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

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
            <a href="#" class="nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown"
              data-caret="false">

              <span class="avatar avatar-sm mr-8pt2">

                <span class="avatar-title rounded-circle bg-primary"><i class="material-icons">account_box</i></span>

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

  @foreach($data as $student)
<div class="student-profile py-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-transparent text-center">
                        <img class="profile_img"
                            src="{{asset('images/default-profile.png')}}">
                        <h3>{{ $student[0]->first_name }} {{ $student[0]->last_name }}</h3>
                    </div>
                    <div class="card-body">
                        <p class="mb-0"><strong class="pr-1">Email ID : </strong>{{ $student[0]->email_id }}</p>
                        <p class="mb-0"><strong class="pr-1">Phone : </strong>{{ $student[0]->phone }}</p>
                    </div>
                </div>
            </div>
      
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-transparent border-0">
                        <h3 class="mb-0"><i class="far fa-clone pr-1"></i>Edit Intern</h3>
                    </div>
                    <div class="card-body pt-0">
                        <table class="table table-bordered">
                            <tr>
                                <th width="30%">Mode</th>
                                <td width="2%">:</td>
                                <td>{{ $student[0]->mode }}</td>
                            </tr>
                            <tr>
                                <th width="30%">Level</th>
                                <td width="2%">:</td>
                                <!-- <td>{{ $student[0]->level_name }}</td> -->
                                <td>
                                <select id="levelSelect" class="form-control custom-select w-auto assign_level"
                                        data-id="{{ $student[0]->intern_id}}">
                                    @foreach($level as $levels)
                                    <option value="{{ $levels->id }}"
                                        {{ $student[0]->level_id == $levels->id ? 'selected' : '' }}>
                                        {{ $levels->level_name }} 
                                    </option>
                                    @endforeach
                                </select>

                                </td>
                            </tr>
                            <tr>
                                <th width="30%">Difficulty Level</th>
                                <td width="2%">:</td>
                                <td>{{ $student[0]->difficulty }}</td>
                            </tr>
                            <tr>
                                <th width="30%">Instructor</th>
                                <td width="2%">:</td>
                                <td>
                                    <select id="instructorSelect" class="form-control custom-select w-auto assign_instructor"
                                        data-id="{{ $student[0]->intern_id }}">
                                        @foreach($instructors as $instructor)
                                        <option value="{{ $instructor->id }}"
                                            {{ $student[0]->instructor_id == $instructor->id ? 'selected' : '' }}>
                                            {{ $instructor->instructor_first_name }} {{ $instructor->instructor_last_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th width="30%">Category</th>
                                <td width="2%">:</td>
                                <td>
                                    <select id="categorySelect" class="form-control custom-select w-auto student_category"
                                        data-id="{{ $student[0]->intern_id }}">
                                        @foreach($category as $cat)
                                        <option value="{{ $cat->category_id }}"
                                            {{ $student[0]->student_category_id == $cat->category_id ? 'selected' : '' }}>
                                            {{ $cat->category_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="card-footer bg-transparent border-0">
                        <button type="button" class="btn btn-primary data-submit"
                            data-id="{{ $student[0]->intern_id }}">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // jQuery(document).ready(function($) {
    //     // Function to handle both instructor and category update
    //     $(".data-submit").click(function(e) {
    //         e.preventDefault();

    //         var intern_id = $(this).data('id');
    //         var instructor_id = $(".assign_instructor[data-id='" + intern_id + "']").val();
    //         var category_id = $(".student_category[data-id='" + intern_id + "']").val();

    //         // Initialize variables to track update statuses
    //         var instructorUpdated = false;
    //         var categoryUpdated = false;

    //         // Function to handle success messages
    //         function handleSuccessMessages() {
    //             var messages = [];
    //             if (instructorUpdated) {
    //                 messages.push("Instructor updated");
    //             }
    //             if (categoryUpdated) {
    //                 messages.push("Category updated");
    //             }
    //             Swal.fire(messages.join("<br>"), "", "success");
    //         }

    //         // AJAX to update instructor
    //         $.ajax({
    //             type: "POST",
    //             url: "{{ url('/assign_instructor') }}/" + intern_id,
    //             data: {
    //                 'intern_id': intern_id,
    //                 'instructor_id': instructor_id,
    //                 '_token': '{{ csrf_token() }}'
    //             },
    //             success: function(data) {
    //                 if (data.status === true) {
    //                     instructorUpdated = true;
    //                     // Check if both updates are completed
    //                     if (categoryUpdated) {
    //                         handleSuccessMessages();
    //                     }
    //                 } else {
    //                     // Swal.fire("Error", "Failed to update instructor", "error");
    //                 }
    //             },
    //             error: function(xhr, status, error) {
    //                 // Swal.fire("Error", "Failed to update instructor: " + error, "error");
    //             }
    //         });

    //         // AJAX to update category
    //         $.ajax({
    //             type: "POST",
    //             url: "{{ url('/assign_student_category') }}/" + intern_id,
    //             data: {
    //                 'intern_id': intern_id,
    //                 'category_id': category_id,
    //                 '_token': '{{ csrf_token() }}'
    //             },
    //             success: function(data) {
    //                 if (data.status === true) {
    //                     categoryUpdated = true;
    //                     // Check if both updates are completed
    //                     if (instructorUpdated) {
    //                         handleSuccessMessages();
    //                     }
    //                 } else {
    //                     // Swal.fire("Error", "Failed to update category", "error");
    //                 }
    //             },
    //             error: function(xhr, status, error) {
    //                 // Swal.fire("Error", "Failed to update category: " + error, "error");
    //             }
    //         });

          
    //     });
    // });

      //Assign level
      $(document).ready(function() {
                $('#levelSelect').change(function() {
               
                    var level_id = $(this).val();
                    var intern_id = $(this).data('id'); 

                    $.ajax({
                        type: "POST",
                        url: "{{ url('/assign_level') }}/" + intern_id,
                        data: {
                            'intern_id': intern_id,
                            'level_id': level_id,
                            '_token': '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            if (data.status === true) {
                                // Success handling
                                Swal.fire("Success", "Level updated successfully", "success");
                            } else {
                                // Error handling if update fails
                                Swal.fire("Error", "Failed to update level", "error");
                            }
                        },
                        error: function(xhr, status, error) {
                            // Error handling if AJAX fails
                            Swal.fire("Error", "Failed to update level: " + error, "error");
                        }
                    });
                });
            });

//Assign Instructor
$(document).ready(function() {
                $('#instructorSelect').change(function() {
               
                    var instructor_id = $(this).val();
                    var intern_id = $(this).data('id'); 

                    $.ajax({
                        type: "POST",
                        url: "{{ url('/assign_instructor') }}/" + intern_id,
                        data: {
                            'intern_id': intern_id,
                            'instructor_id': instructor_id,
                            '_token': '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            if (data.status === true) {
                                // Success handling
                                Swal.fire("Success", "Instructor updated successfully", "success");
                            } else {
                                // Error handling if update fails
                                Swal.fire("Error", "Failed to update instructor", "error");
                            }
                        },
                        error: function(xhr, status, error) {
                            // Error handling if AJAX fails
                            Swal.fire("Error", "Failed to update instrcutor: " + error, "error");
                        }
                    });
                });
            });

            //Assign Category
      $(document).ready(function() {
                $('#categorySelect').change(function() {
          
                    var category_id = $(this).val();
                    var intern_id = $(this).data('id'); 

                    $.ajax({
                        type: "POST",
                        url: "{{ url('/assign_student_category') }}/" + intern_id,
                        data: {
                            'intern_id': intern_id,
                            'category_id': category_id,
                            '_token': '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            if (data.status === true) {
                                // Success handling
                                Swal.fire("Success", "Catgeory updated successfully", "success");
                            } else {
                                // Error handling if update fails
                                Swal.fire("Error", "Failed to update category", "error");
                            }
                        },
                        error: function(xhr, status, error) {
                            // Error handling if AJAX fails
                            Swal.fire("Error", "Failed to update category: " + error, "error");
                        }
                    });
                });
            });


</script>


  <!-- Footer -->

  <div class="bg-dark border-top-2 mt-auto">
    <div class="container page__container page-section d-flex flex-column">
      <p class="text-white-70 brand mb-24pt">

        <img class="brand-icon" src="{{asset('images/plus-goal-logo.svg')}}" width="150" alt="Plus Goals"
          style="margin-top:20px;">
      </p>
      <p class="measure-lead-max text-white-50 small mr-8pt">Plus Goals is a beautifully crafted user interface for
        modern Education Platforms, including Courses & Tutorials, Video Lessons, Student and Teacher Dashboard,
        Curriculum Management, Earnings and Reporting, ERP, HR, CMS, Tasks, Projects, eCommerce and more.</p>
      <p class="mb-8pt d-flex">
        <a href class="text-white-70 text-underline mr-8pt small">Terms</a>
        <a href class="text-white-70 text-underline small">Privacy policy</a>
      </p>
      <p class="text-white-50 small mt-n1 mb-0">Copyright 2019 &copy; All rights reserved.</p>
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

</html>