
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Course List</title>

<meta name="robots" content="noindex">
<link href="https://fonts.googleapis.com/css?family=Lato:400,700%7CRoboto:400,500%7CExo+2:600&display=swap" rel="stylesheet">


<link href="{{asset('vendor/spinkit.css')}}" rel="stylesheet" type="text/css">


<link href="{{asset('vendor/perfect-scrollbar.css')}}" rel="stylesheet" type="text/css">


<link href="{{asset('css/material-icons.css')}}" rel="stylesheet" type="text/css">


<link href="{{asset('css/fontawesome.css')}}" rel="stylesheet" type="text/css">


<link href="{{asset('css/preloader.css')}}" rel="stylesheet" type="text/css">


<link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
<style>
   button{
      width : 40px;
      height :30px;
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

<div id="header" class="mdk-header js-mdk-header mb-0" data-fixed data-effects="waterfall">
<div class="mdk-header__content">
<div class="navbar navbar-expand navbar-light bg-white border-bottom" id="default-navbar" data-primary>
<div class="container page__container">

<a href="index.html" class="navbar-brand mr-16pt">
<span><img src="{{asset('images/plus-goal-logo.svg')}}" width="150" height="100"></span>

</a>


<ul class="nav navbar-nav d-none d-sm-flex flex justify-content-start ml-8pt">
<li class="nav-item">
<a href="{{ route('home') }}" class="nav-link">Home</a>
</li>
<li class="nav-item">
<a href="{{ route('taskDetails') }}" class="nav-link">Task</a>
</li>
<li class="nav-item dropdown">
<a href="{{ route('courselist') }}" class="nav-link">
Course</a>


</li>


<li class="nav-item dropdown ">
       @if(Session::get('role') == 1)
<a href="{{ route('teachers') }}" class="nav-link">
Teachers</a>
@endif



</li>
<li class="nav-item dropdown ">
       @if(Session::get('role') == 1)
<a href="{{ route('students') }}" class="nav-link">
Students</a>
@endif






</li>
<li class="nav-item dropdown" data-toggle="tooltip" data-title="Community" data-placement="bottom" data-boundary="window">

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
@csrf
<div class="mdk-header-layout__content page-content ">
<div class="page-section bg-alt border-bottom-2">
<div class="container page__container">
<div class="d-flex flex-column flex-lg-row align-items-center">
<div class="d-flex flex-column flex-md-row align-items-center flex mb-16pt mb-lg-0 text-center text-md-left">
<div class="mb-16pt mb-md-0 mr-md-24pt">
</div>
<div class="col-lg-8">
<h1 class="h2 mb-0">Course List</h1><br>
</div>
<form class="search-form form-control-rounded navbar-search d-none d-lg-flex mr-16pt" style="max-width: 230px">
<button class="btn" type="submit"><i class="material-icons">search</i></button>
<input type="text" class="form-control" id="input" placeholder="Search ...">
</form>
</div>
<div class="ml-lg-16pt">
<a href="{{route('courseLevel')}}" class="btn btn-light">Add New Course</a>
</div>
</div>
</div>
</div>
<div class="page-section">
<div class="container page__container">
<div class="row">
<div class="col-lg-12">
<table class="table align-middle table-nowrap" id="customerTable">
<thead class="table-light">
<tr>
<th>Sl.No</th>
<th>Course Name</th>
<th>Level</th>
<th>Mode</th>
<th>View</th>

</tr>
</thead>
<tbody class="list form-check-all" id="myTable">
@foreach($data as $course)
@for ($i = 0; $i < count($course); $i++)
<tr>
<td>{{ $course[$i]->id }}</td>
<td>{{ $course[$i]->course_name }}</td>
<td>{{ $course[$i]->level_name }}</td>
<td>{{ $course[$i]->mode }}</td>
<td> <button onClick="window.location.href = 'https://ayurware.in/plusgoals/course_view/<?php echo $course[$i]->id; ?>'"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
<path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
</svg>
</button></td>

</tr>
@endfor
@endforeach
</tbody>
</table>
</div>
</div>
</div>
</div>

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

</div>
<div class="mdk-drawer js-mdk-drawer" id="default-drawer">
<div class="mdk-drawer__content">
<div class="sidebar sidebar-light sidebar-light-dodger-blue sidebar-left" data-perfect-scrollbar>
<a href="index.html" class="sidebar-brand ">
<span class="avatar avatar-xl sidebar-brand-icon h-auto">
<span class="avatar-title rounded bg-primary"><img src="images/white.svg" class="img-fluid" alt="logo" /></span>
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
<span class="sidebar-menu-badge badge badge-accent badge-notifications ml-auto">PRO</span>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $("#input").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
});
</script>

</html>