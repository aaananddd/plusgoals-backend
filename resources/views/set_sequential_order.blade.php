<!DOCTYPE html>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css"rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
<html lang="en" dir="ltr">

<head>
    @include('layouts.head')
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body class="layout-sticky-subnav layout-learnly ">

<!-- Header  -->
    @include('layouts.header')
<!-- End Header -->
<div class="mdk-header-layout__content page-content">
    <div class="page-section bg-alt border-bottom-2">
        <div class="container page__container">
            <!-- First Row: Navigation -->
            <div class="row mb-12">
                <div class="col-12">
                    <ul class="nav nav-pills flex-column flex-md-row">
                        <li class="nav-item custom-box">
                            <a class="nav-link" href="{{ route('selectTaskType', [$task_id, $limit]) }}">
                                <i class="bx bx-user me-1"></i>Select Task Type
                            </a>
                        </li>
                        &nbsp; &nbsp;
                        <li class="nav-item custom-box active">
                            <a class="nav-link" href="{{ route('setSequentialOrder', [$task_id, $limit]) }}">
                                <i class="bx bx-user me-1"></i>Set Sequential Order
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
            <!-- Second Row: Form -->
        <form id="taskForm" method="POST" action="{{ route('GetSequentialTasks') }}">
         @csrf
            <div class="container page__container">
                <div class="row mb-4">
                    <div class="col-md-2">
                        <label for="task_level" class="col-form-label form-label">Task Level</label>
                        <select class="form-control custom-select" name="task_level" id="task_level">
                            <option value="option_select" disabled selected>Task Level</option>
                            @foreach($level as $taskLevel)
                                <option value="{{ $taskLevel->id }}" {{ old('task_level') == $taskLevel->id ? 'selected' : '' }}>{{ $taskLevel->level_name }}</option>
                            @endforeach
                        </select>
                        <span id="task_level-error" class="error text-danger" style="display:none;">Level is required.</span>
                    </div>
                    <div class="col-md-2">
                        <label for="difficulty_level" class="col-form-label form-label">Difficulty Level</label>
                        <select class="form-control custom-select" name="difficulty_level" id="difficulty_level">
                            <option value="option_select" disabled selected>Difficulty Level</option>
                            @foreach($difficulty_level as $difficultyLevel)
                                <option value="{{ $difficultyLevel->difficulty_id }}" {{ old('difficulty_level') == $difficultyLevel->difficulty_id ? 'selected' : '' }}>{{ $difficultyLevel->difficulty }}</option>
                            @endforeach
                        </select>
                        <span id="difficulty_level-error" class="error text-danger" style="display:none;">Difficulty Level is required.</span>
                    </div>
                    <div class="col-md-2">
                        <label for="task_category" class="col-form-label form-label">Task Category</label>
                        <select class="form-control custom-select" name="task_category" id="task_category">
                            <option value="option_select" disabled selected>Task Category</option>
                            @foreach($task_category as $taskCategory)
                                <option value="{{ $taskCategory->category_id }}" {{ old('task_category') == $taskCategory->category_id ? 'selected' : '' }}>{{ $taskCategory->category_name }}</option>
                            @endforeach
                        </select>
                        <span id="task_category-error" class="error text-danger" style="display:none;">Task Category is required.</span>
                    </div>
                    <div class="col-md-2">
                        <label for="module" class="col-form-label form-label">Module</label>
                        <select class="form-control custom-select" name="module" id="module">
                            <option value="option_select" disabled selected>Module</option>
                            @foreach($module as $modules)
                                <option value="{{ $modules->module_id }}" {{ old('module') == $modules->module_id ? 'selected' : '' }}>{{ $modules->module_name }}</option>
                            @endforeach
                        </select>
                        <span id="module-error" class="error text-danger" style="display:none;">Module is required.</span>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button id="submit" type="submit" class="btn btn-primary" style="width:100px;">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

    <!-- Additional Content -->
    <div class="container page__container">
        <div class="mdk-header-layout__content page-content">
            <div class="page-section">
                <div class="row mb-4">
                    <div class="col-lg-12">
                        <div class="container">
                            <!-- Content goes here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')
</body>

<style>
.scrollit {
    overflow: scroll;
    height: 100px;
}
             
.container {
    display: flex;
    justify-content: 70px;
}
.box {
    width: 400px; 
    height: 20px;
    padding: 40px; 
    border-radius: 10px;
    background-color: #6495ED; 
    border: none;
    color: white;
    text-align: center;
    text-decoration: none;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    margin: 50px;
    cursor: pointer;
}

.custom-box {
    border: 2px solid #6495ED; 
    margin-bottom: 6px; 
    padding: 10px; 
    border-radius: 5px; 
    background-color: #f9f9f9;
}

.nav-item.active .nav-link {
    color:black; 
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('taskForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        const formData = new FormData(this); // Get form data

        fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            // Assuming the response data is in the format of an array of tasks
            const container = document.querySelector('.page-content');
            const tableContainer = container.querySelector('.table-container');

            // If there's no table yet, create one
            if (!tableContainer) {
                const newTableContainer = document.createElement('div');
                newTableContainer.className = 'table-container';
                newTableContainer.innerHTML = `
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Task Name</th>
                                <th>Description</th>
                                <th>Created By</th>
                                <th>No. of Questions</th>
                                <th>Time</th>
                                <th>Parent Task</th>
                            </tr>
                        </thead>
                        <tbody id="taskTableBody">
                        </tbody>
                    </table>
                `;
                container.appendChild(newTableContainer);
            }

            // Populate the table with data
            const tbody = document.getElementById('taskTableBody');
            tbody.innerHTML = ''; // Clear existing data

            data.data.forEach(task => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${task.task_name}</td>
                    <td>${task.task_desc}</td>
                    <td>${task.created_by}</td>
                    <td>${task.NoOfQuestns}</td>
                    <td>${task.time}</td>
                    <td><button class="btn btn-primary" onclick="setSequentialTask('${task.task_id}')">Set</button></td>
                `;
                tbody.appendChild(row);
            });
        })
        .catch(error => console.error('Error:', error));
    });
});

function setSequentialTask(task_id){
  
    var intial_url = window.location.href;
    var split = intial_url.split('/');
    var child_task = split[4];
  
    $.ajax({
        url :"{{ env('WEB_URL') }}/set_sequential_parent/" + task_id,
        method : "POST",
        data : {
            'task_id': task_id,
            'child_task' : child_task,
        },
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success : function(response){
            console.log(response.message);
        },
        error: function(xhr, status, error) {
            console.error('AJAX error:', status, error);
        }
    });
}

</script>

</html>