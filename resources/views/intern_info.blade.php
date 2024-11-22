<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Details</title>
  
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900|Roboto:400,500|Exo+2:600&display=swap" rel="stylesheet">
  
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
  
  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
  
  <!-- Local CSS -->
  <link href="{{ asset('vendor/spinkit.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('vendor/perfect-scrollbar.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('css/material-icons.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('css/fontawesome.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('css/preloader.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">

  <style>
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
  
    .nav-item .nav-link.active-tab {
      color: #1E90FF;
    }
  </style>
</head>

<body>

  <div id="header" class="mdk-header js-mdk-header mb-0" data-fixed data-effects="waterfall">
    <div class="mdk-header__content">
      <div class="navbar navbar-expand navbar-light bg-white border-bottom" id="default-navbar" data-primary>
        <div class="container page__container">
          <!-- Navbar Brand -->
          <a href="index.html" class="navbar-brand mr-16pt">
            <img src="{{ asset('images/plus-goal-logo.svg') }}" width="150" height="100" alt="Plus Goals Logo">
          </a>

          <!-- Navbar Toggler -->
          <ul class="nav navbar-nav d-none d-sm-flex flex justify-content-start ml-8pt">
            <li class="nav-item">
              <a href="{{ route('home') }}" class="nav-link {{ Request::route()->getName() == 'home' ? 'active-tab' : '' }}">Home</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('taskDetails') }}" class="nav-link {{ Request::route()->getName() == 'taskDetails' ? 'active' : '' }}">Task</a>
            </li>
            <li class="nav-item">
              @if(Session::get('role') == 1)
                <a href="{{ route('teachers') }}" class="nav-link {{ Request::route()->getName() == 'teachers' ? 'active' : '' }}">Instructors</a>
              @endif
            </li>
            <li class="nav-item">
              <a href="{{ route('students') }}" class="nav-link {{ Request::route()->getName() == 'students' ? 'active' : '' }}">Interns</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('GetEmployersList') }}" class="nav-link {{ Request::route()->getName() == 'GetEmployersList' ? 'active' : '' }}">Employers</a>
            </li>
            <li class="nav-item">
              @if(Session::get('role') == 1)
                <a href="{{ route('tasksPendingForApproval') }}" class="nav-link {{ Request::route()->getName() == 'tasksPendingForApproval' ? 'active' : '' }}">Pending Approval</a>
              @endif
            </li>
            <li class="nav-item">
              <a href="{{ route('CountAssignedTasks') }}" class="nav-link {{ Request::route()->getName() == 'CountAssignedTasks' ? 'active' : '' }}">Frequent Tasks</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('Others') }}" class="nav-link {{ Request::route()->getName() == 'Others' ? 'active' : '' }}">Others</a>
            </li>
          </ul>

          <div class="nav-item dropdown">
            <a href="#" class="nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown" data-caret="false">
              <span class="avatar avatar-sm mr-8pt2">
                <span class="avatar-title rounded-circle bg-primary"><i class="material-icons">account_box</i></span>
              </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <a class="dropdown-item" href="{{ route('profileView') }}"> <strong>{{ Session::get('user.first_name') }}</strong></a>
              <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
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
              <img class="profile_img" src="{{ asset('images/256_rsz_james-gillespie-714755-unsplash.jpg') }}" alt="Student Profile Image">
              <h3>{{ $student->first_name }} {{ $student->last_name }}</h3>
            </div>
            <div class="card-body">
              <p class="mb-0"><strong class="pr-1">Email ID:</strong> {{ $student->email_id }}</p>
              <p class="mb-0"><strong class="pr-1">Phone:</strong> {{ $student->phone }}</p>
              <p class="mb-0"><strong class="pr-1">Mode:</strong> {{ $student->mode }}</p>
              <p class="mb-0"><strong class="pr-1">Level Name:</strong> {{ $student->level_name }}</p>
              <p class="mb-0"><strong class="pr-1">Difficulty Level:</strong> {{ $student->difficulty }}</p>
            </div>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="card shadow-sm">
            <div class="card-header bg-transparent border-0">
              <h3 class="mb-0"><i class="far fa-clone pr-1"></i>General Information</h3>
            </div>
            <div class="card-body pt-0">
              <table class="table table-bordered">
                <tr>
                  <th width="30%">Address 1</th>
                  <td width="2%">:</td>
                  <td>{{ $student->address1 }}</td>
                </tr>
                <tr>
                  <th width="30%">Address 2</th>
                  <td width="2%">:</td>
                  <td>{{ $student->address2 }}</td>
                </tr>
                <tr>
                  <th width="30%">District</th>
                  <td width="2%">:</td>
                  <td>{{ $student->district }}</td>
                </tr>
                <tr>
                  <th width="30%">City</th>
                  <td width="2%">:</td>
                  <td>{{ $student->city }}</td>
                </tr>
                <tr>
                  <th width="30%">State</th>
                  <td width="2%">:</td>
                  <td>{{ $student->state }}</td>
                </tr>
                <tr>
                  <th width="30%">Country</th>
                  <td width="2%">:</td>
                  <td>{{ $student->country }}</td>
                </tr>
                <tr>
                  <th width="30%">Pincode</th>
                  <td width="2%">:</td>
                  <td>{{ $student->pincode }}</td>
                </tr>
                <tr>
                  <th width="30%">Registered Date</th>
                  <td width="2%">:</td>
                  <td>{{ Carbon\Carbon::parse($student->created_at)->format('Y-m-d') }}</td>
                </tr>
              </table>
            </div>
          </div>
	  <div style="height: 26px; "></div>
          	<button id="approveRejectButton"
        style="display: block; margin: 0 auto; background-color:#6495ED;"
        onclick="handleButtonClick()">
    @if($student->approval === 1)
        Reject
    @else
        Approve
    @endif
</button>
        </div>
        </div>
      </div>
    </div>
  </div>
  @endforeach

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script>
	function handleButtonClick() {
  var button = document.getElementById('approveRejectButton');
  var internId = "{{ $student->id }}";
  var employerId = "{{ $student->employer_id }}";
  var action = button.innerText.trim().toLowerCase();

  // Determine the API endpoint based on the button's current state
  var url = action === 'approve' ? `{{ url('approve_request') }}` : `{{ url('reject_request') }}`;

  fetch(url, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': '{{ csrf_token() }}'
    },
    body: JSON.stringify({
      intern_id: internId,
      employer_id: employerId
    })
  })
  .then(response => {
    if (!response.ok) {
      throw new Error('Network response was not ok');
    }
    return response.json();
  })
  .then(data => {
    console.log(data);
    if (data.status === true) {
      // Toggle button text based on the action
      button.innerText = action === 'approve' ? 'Reject' : 'Approve';
    } else {
      alert('Failed to update status: ' + data.message);
    }
  })
  .catch(error => {
    console.error('Error:', error);
    alert('An error occurred: ' + error.message);
  });
}
</script>
  <!-- Footer -->
  <div class="bg-dark border-top-2 mt-auto">
    <div class="container page__container page-section d-flex flex-column">
      <p class="text-white-70 brand mb-24pt">
        <img class="brand-icon" src="{{ asset('images/plus-goal-logo.svg') }}" width="150" alt="Plus Goals" style="margin-top:20px;">
      </p>
      <p class="measure-lead-max text-white-50 small mr-8pt">Plus Goals is a beautifully crafted user interface for modern Education Platforms, including Courses & Tutorials, Video Lessons, Student and Teacher Dashboard, Curriculum Management, Earnings and Reporting, ERP, HR, CMS, Tasks, Projects, eCommerce and more.</p>
      <p class="mb-8pt d-flex">
        <a href="#" class="text-white-70 text-underline mr-8pt small">Terms</a>
        <a href="#" class="text-white-70 text-underline small">Privacy policy</a>
      </p>
      <p class="text-white-50 small mt-n1 mb-0">Copyright 2019 &copy; All rights reserved.</p>
    </div>
  </div>

  <!-- JavaScript -->
  <script src="{{ asset('vendor/jquery.min.js') }}"></script>
  <script src="{{ asset('vendor/popper.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap.min.js') }}"></script>
  <script src="{{ asset('vendor/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('vendor/dom-factory.js') }}"></script>
  <script src="{{ asset('vendor/material-design-kit.js') }}"></script>
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{ asset('js/preloader.js') }}"></script>
</body>
</html>