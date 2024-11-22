<!DOCTYPE html> <html lang="en"> <head> <meta charset="UTF-8"> <meta name="viewport" content="width=device-width,
  initial-scale=1.0"> <!-- Google Fonts --> <link
  href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet"> <!-- Bootstrap
  CSS --> <link rel='stylesheet'
  href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
<!-- Font Awesome CSS -->
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css'> <link
  href="https://fonts.googleapis.com/css?family=Lato:400,700%7CRoboto:400,500%7CExo+2:600&display=swap"
  rel="stylesheet"> <title>Document</title>
<link href="{{asset('vendor/spinkit.css')}}" rel="stylesheet" type="text/css"> <link
  href="{{asset('vendor/perfect-scrollbar.css')}}" rel="stylesheet" type="text/css"> <link
  href="{{asset('css/material-icons.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('css/fontawesome.css')}}" rel="stylesheet" type="text/css"> <link
  href="{{asset('css/preloader.css')}}" rel="stylesheet" type="text/css"> <link href="{{asset('css/app.css')}}"
  rel="stylesheet" type="text/css">
<style> .student-profile .card { border-radius: 10px; } .student-profile .card .card-header .profile_img { width: 150px;
  height: 150px; object-fit: cover; margin: 10px auto; border: 10px solid #ccc; border-radius: 50%; } .student-profile
  .card h3 { font-size: 20px; font-weight: 700; } .student-profile .card p { font-size: 16px; color: #000; }
  .student-profile .table th, .student-profile .table td { font-size: 14px; padding: 5px 10px; color: #000; } 
  /* button{
  width : 40px; height :30px; } */
   </style>

  </head>

  <body>

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
    <button class="navbar-toggler w-auto mr-16pt d-block rounded-0" type="button" data-toggle="sidebar"> <span
        class="material-icons">short_text</span>
</button>

        <ul class="nav navbar-nav d-none d-sm-flex flex justify-content-start ml-8pt">
            <li class="nav-item">
            <a href="{{ route('home') }}"
            class="nav-link">Home</a>
</li>
            <li class="nav-item">
            <a href="{{ route('taskDetails') }}" class="nav-link">Task</a>
            </li>
            <li class="nav-item dropdown">
            <a href="{{ route('courselist') }}" class="nav-link">
                                Course</a>
              
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
      <li class="nav-item dropdown ">
      <a href="{{ route('teachers') }}" class="nav-link">
                                Teachers</a>
        <!-- <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" data-caret="false">Teachers</a>
        <div class="dropdown-menu">
          <a href="{{ route('teachers') }}" class="dropdown-item active">Teachers list</a>
          <a href="instructor-courses.html" class="dropdown-item">Manage Courses</a>
          <a href="instructor-quizzes.html" class="dropdown-item">Manage Quizzes</a>
          <a href="instructor-earnings.html" class="dropdown-item">Earnings</a>
          <a href="instructor-statement.html" class="dropdown-item">Statement</a>
          <a href="instructor-edit-course.html" class="dropdown-item">Edit Course</a>
          <a href="instructor-edit-quiz.html" class="dropdown-item">Edit Quiz</a>
        </div> -->
      </li>
      <li class="nav-item dropdown ">
      <a href="{{ route('students') }}" class="nav-link">
                                    Internss</a>
        <!-- <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" data-caret="false">Students</a>
        <div class="dropdown-menu"> -->
          <!-- <a href="{{ route('paidStudents') }}" -->
          <!-- <a href="{{ route('students') }}" class="dropdown-item active">Student list</a> -->
          <!-- <a href="{{ route('unpaidStudents') }}"
                                           class="dropdown-item">Unpaid Students</a> -->

        <!-- </div> -->
      </li>
      <li class="nav-item dropdown" data-toggle="tooltip" data-title="Community" data-placement="bottom"
        data-boundary="window">
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

    </div>
    </div>

    </div>
    </div>

    @foreach($data as $user)

    <div class="page-section">
        <div class="container page__container" style="top-margin:20px;">
            <div class="row">
                <div class="col-lg-12">
                   
                    <div class="card">
                        <form method="POST" action="{{url ('updateprofile/'. $user[0]->id) }}">
                            <div class="card-body">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <div class="card-body table--elevated">
                                    <div class="form-group m-0" role="group" aria-labelledby="label-title">
                                        <div class="form-row align-items-center">
                                            <label id="label-title" for="task_name"
                                                class="col-md-3 col-form-label form-label">User Id</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="id"
                                                    name="id" value="{{ $user[0]->id }}">
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
                                                         name="created_at" value="{{$user[0]->created_at }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                
                                <!-- <div class="form-group"> -->
                                    <!-- <div class="list-group-item"> -->
                                        <div class="text-right">
                                            <button type="submit" style="cursor:pointer" class="btn btn-primary"
                                                onClick="window.location.href = 'http://localhost:8000/updateprofile/<?php echo $user[0]->id; ?>'">Update</button>
                                            <!-- <button  type="submit" class="btn btn-primary">Submit</button>  -->
                                            <!-- <button type="button" class="btn btn-accent">Next</button> -->
                                        </div>
                                    <!-- </div> -->
                                <!-- </div> -->
                            </div>
                    </div>
                    </form>


                  

                    </div>

                </div>
            </div>
        </div>
    </div>
  
    @endforeach
    <!-- <div class="bg-dark border-top-2 mt-auto">
        <div class="container page__container page-section d-flex flex-column">
            <p class="text-white-70 brand mb-24pt">
                <img class="brand-icon" src="images/plus-goal-logo.svg" width="150" alt="Luma">
            </p>
            <p class="measure-lead-max text-white-50 small mr-8pt">Luma is a beautifully crafted user interface for
                modern Education Platforms, including Courses & Tutorials, Video Lessons, Student and Teacher Dashboard,
                Curriculum Management, Earnings and Reporting, ERP, HR, CMS, Tasks, Projects, eCommerce and more.</p>
            <p class="mb-8pt d-flex">
                <a href class="text-white-70 text-underline mr-8pt small">Terms</a>
                <a href class="text-white-70 text-underline small">Privacy policy</a>
            </p>
            <p class="text-white-50 small mt-n1 mb-0">Copyright 2019 &copy; All rights reserved.</p>
        </div>
    </div> -->
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