<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>Request for Interns Contact</title>

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

      <!-- More spinner examples at https://github.com/tobiasahlin/SpinKit/blob/master/examples.html -->
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

                  <!-- Navbar toggler -->
                  <button class="navbar-toggler w-auto mr-16pt d-block rounded-0" type="button" data-toggle="sidebar">
                     <span class="material-icons">short_text</span>
                  </button>
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
                       
                            <a href="{{ route('students') }}" class="nav-link {{ Request::route()->getName() == 'students' ? 'active-tab' : '' }}">Interns</a>
                       
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

      <div class="mdk-header-layout__content page-content ">
      
         <div class="page-section bg-alt border-bottom-2">
         <div class="col-lg-12" style="padding-left:130px; ">
              <h1 class="h2 mb-0" >Request for Interns Contact</h1>
         </div>
         <br>
            <div class="container page__container">
           
               <div class="d-flex flex-column flex-lg-row align-items-center">
                  <div
                     class="d-flex flex-column flex-md-row align-items-center flex mb-16pt mb-lg-0 text-center text-md-left">
                     <div class="row align-items-center w-100">
<!--                           
                          <form action="{{ url('student_date_filter') }}" method="get" class="col-md-6 form-inline">
                              <div class="form-group mr-md-2">
                                  <label for="">Date From</label>
                                  <input type="date" name="date_from" class="form-control">
                              </div>
                              <div class="form-group mr-md-2">
                                  <label for="">Date To</label>
                                  <input type="date" name="date_to" class="form-control">
                              </div>
                              <button type="submit" class="btn btn-primary" style="width: 100px;">Search</button>
                          </form> -->
                          <form class="search-form form-control-rounded navbar-search d-none d-lg-flex mr-6pt ml-auto"
                              style="max-width: 150px;">
                              <button class="btn" type="submit"><i class="material-icons">search</i></button>
                              <input type="text" class="form-control" id="input" placeholder="Search ...">
                          </form>
                      </div>
                
               </div>
            </div>
         </div>

         <div class="text-center">
                @if(session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
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
                                 <th>Intern </th>
                                 <th>Employer </th>
                                 <th>Approval</th>
                                 <th>Requested Date</th>
                                 <th>Intern Info</th>
                              </tr>
                           </thead>
                           <tbody class="list form-check-all" id="myTable">
                              @foreach($data as $index => $intern)
                         
                                 <td>{{ $index + 1 }}</td>
                                 <td>{{ $intern->student_first_name }} {{ $intern->student_last_name }}</td>
                                 <td>{{ $intern->employer_first_name }} {{ $intern->employer_last_name }}</td>
                                 <td class="{{ $intern->is_admin_approved ? 'approved' : 'not-approved' }}">
                                        {{ $intern->is_admin_approved ? 'Approved' : 'Not Approved' }}</td>
                                 <td>{{ $intern->created_at->format('d-m-Y') }}</td>
                                 <td> <button style="border-color: white; border: none; color:#1E90FF" 
                                 onClick="window.location.href =  '{{ env('APP_URL') }}intern_info/{{ $intern->student_id }}/{{ $intern->employer_id }}'"><svg
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    </svg>

                                                </button></td>
                                  
                                 </tr>
                             
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

                     <img class="brand-icon" src="{{asset('images/plus-goal-logo.svg')}}" width="150" alt="Plus Goals"
                        style="margin-top:20px;">
                  </p>
                  <p class="measure-lead-max text-white-50 small mr-8pt">Plus Goals is a beautifully crafted user
                     interface for modern Education Platforms, including Courses & Tutorials, Video Lessons, Student and
                     Teacher Dashboard, Curriculum Management, Earnings and Reporting, ERP, HR, CMS, Tasks, Projects,
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


         <div class="mdk-drawer js-mdk-drawer" id="default-drawer">
            <div class="mdk-drawer__content">
               <div class="sidebar sidebar-light sidebar-light-dodger-blue sidebar-left" data-perfect-scrollbar>

                  <a href="index.html" class="sidebar-brand ">

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

               </div>
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

$(document).ready(function(){
    $('[data-toggle="popover"]').popover();
});

</script>

</html>