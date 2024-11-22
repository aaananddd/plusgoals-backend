<!DOCTYPE html> <html lang="en"> <head> <meta charset="UTF-8"> <meta name="viewport" content="width=device-width,
  initial-scale=1.0"> <!-- Google Fonts --> <link
  href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet"> <!-- Bootstrap
  CSS --> <link rel='stylesheet'
  href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
<!-- Font Awesome CSS -->
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css'> <link
  href="https://fonts.googleapis.com/css?family=Lato:400,700%7CRoboto:400,500%7CExo+2:600&display=swap"
  rel="stylesheet"> <title> Profile</title>
<link href="{{asset('vendor/spinkit.css')}}" rel="stylesheet" type="text/css"> <link
  href="{{asset('vendor/perfect-scrollbar.css')}}" rel="stylesheet" type="text/css"> <link
  href="{{asset('css/material-icons.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('css/fontawesome.css')}}" rel="stylesheet" type="text/css"> <link
  href="{{asset('css/preloader.css')}}" rel="stylesheet" type="text/css"> <link href="{{asset('css/app.css')}}"
  rel="stylesheet" type="text/css">
<style> .student-profile .card { border-radius: 10px; } .student-profile .card .card-header .profile_img { width: 150px;
  height: 150px; object-fit: cover; margin: 10px auto; border: 10px solid #ccc; border-radius: 50%; } .student-profile
  .card h3 { font-size: 20px; font-weight: 700; } .student-profile .card p { font-size: 16px; color: #000; }
  .student-profile .table th, .student-profile .table td { font-size: 14px; padding: 5px 10px; color: #000; } button{
  width : 40px; height :30px; } </style>

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
   <style>
       .nav-item .nav-link.active-tab {
        color:#1E90FF;
      }
  </style>

    <ul class="nav navbar-nav d-none d-sm-flex flex justify-content-start ml-8pt">
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link {{ Request::route()->getName() == 'home' ? 'active' : '' }}">Home</a>
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

    @foreach($data as $user)

    <div class="student-profile py-4">
      <div class="container">
             <div class="row">
            <div class="col-lg-4">
            <form method="POST" action="{{ url('editprofile/'. $user[0]->id) }}">
              @csrf
              <div class="card shadow-sm">
                <div class="card-header bg-transparent text-center">
                  <img class="profile_img" src="{{asset('images/256_rsz_james-gillespie-714755-unsplash.jpg')}}">
                  <h3>{{ $user[0]->first_name }} {{ $user[0]->last_name }}</h3>
                </div>
                <div class="card-body">
                  <!-- <p class="mb-0"><strong class="pr-1">User ID
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</strong>{{ $user[0]->id }}</p> -->
                  <p class="mb-0"><strong class="pr-1">Email ID
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;</strong>{{$user[0]->email }}</p>
                  <p class="mb-0"><strong
                      class="pr-1">Phone&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;</strong>{{$user[0]->phone}}</p>
                </div>
              </div>
            </div>
            <div class="col-lg-8">
              <div class="card shadow-sm">
                <!-- <div class="card-header bg-transparent border-0"> -->
                <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center">
                  <h3 class="mb-0"><i class="far fa-clone pr-1"></i>General Information</h3>

                  <button style="border-color: white; border: none; color:#1E90FF" 
                                                    onClick="window.location.href = 'https://admin.plusgoals.com/profile_edit/<?php echo $user[0]->id; ?>'"><svg
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                    </svg>

                                                </button>
                </div>

                <div class="card-body pt-0">
                  <table class="table table-bordered">
                    <tr>
                      <th width="30%">Address 1</th>
                      <td width="2%">:</td>
                      <td>{{ $user[0]->address1 }}</td>
                    </tr>
                    <tr>
                      <th width="30%">Address 2 </th>
                      <td width="2%">:</td>
                      <td>{{ $user[0]->address2 }}</td>
                    </tr>
                    <tr>
                      <th width="30%">District</th>
                      <td width="2%">:</td>
                      <td>{{ $user[0]->district }}</td>
                    </tr>
                    <tr>
                      <th width="30%">City</th>
                      <td width="2%">:</td>
                      <td>{{ $user[0]->city}}</td>
                    </tr>
                    <tr>
                      <th width="30%">State</th>
                      <td width="2%">:</td>
                      <td>{{ $user[0]->state }}</td>
                    </tr>
                    <tr>
                      <th width="30%">Country</th>
                      <td width="2%">:</td>
                      <td>{{ $user[0]->country }}</td>
                    </tr>
                    <tr>
                      <th width="30%">Pincode</th>
                      <td width="2%">:</td>
                      <td>{{ $user[0]->pincode }}</td>
                    </tr>
                    <tr>
                      <th width="30%">Joining Date</th>
                      <td width="2%">:</td>
                      <td>{{  Carbon\Carbon::parse($user[0]->created_at)->format('Y-m-d')  }}</td>
                    </tr>
                  </table>
                </div>
              </div>
              <div style="height: 26px"></div>
             
            </div>
          </form>
        </div>
      </div>
    </div>

    @endforeach
    <!-- Footer -->

<div class="bg-dark border-top-2 mt-auto">
    <div class="container page__container page-section d-flex flex-column">
        <p class="text-white-70 brand mb-24pt">
            <img class="brand-icon" src="{{asset('images/plus-goal-logo.svg')}}" width="150" alt="PlusGoals" style="margin-top:20px;">
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