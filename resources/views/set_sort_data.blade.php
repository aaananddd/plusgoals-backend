<!DOCTYPE html>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css"rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

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
        
            <!-- Second Row: Form -->
        <form id="taskForm" method="POST" action="{{ route('GetTasksForSorting') }}">
         @csrf
            <div class="container page__container">
                <div class="row mb-4">
                    <div class="col-md-4">
                        <label for="task_level" class="col-form-label form-label">Task Level</label>
                        <select class="form-control custom-select" name="task_level" id="task_level">
                            <option value="option_select" disabled selected>Task Level</option>
                            @foreach($level as $taskLevel)
                                <option value="{{ $taskLevel->id }}" {{ old('task_level') == $taskLevel->id ? 'selected' : '' }}>{{ $taskLevel->level_name }}</option>
                            @endforeach
                        </select>
                        <span id="task_level-error" class="error text-danger" style="display:none;">Level is required.</span>
                    </div>
                    <div class="col-md-4">
                        <label for="difficulty_level" class="col-form-label form-label">Difficulty Level</label>
                        <select class="form-control custom-select" name="difficulty_level" id="difficulty_level">
                            <option value="option_select" disabled selected>Difficulty Level</option>
                            @foreach($difficulty_level as $difficultyLevel)
                                <option value="{{ $difficultyLevel->difficulty_id }}" {{ old('difficulty_level') == $difficultyLevel->difficulty_id ? 'selected' : '' }}>{{ $difficultyLevel->difficulty }}</option>
                            @endforeach
                        </select>
                        <span id="difficulty_level-error" class="error text-danger" style="display:none;">Difficulty Level is required.</span>
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

 <!-- Toastr JS -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>

document.addEventListener('DOMContentLoaded', function() {
    // Handle form submission
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
            console.log(data.data);
            const container = document.querySelector('.page-content');
            const tableContainer = container.querySelector('.table-container');

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
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody id="taskTableBody">
                        </tbody>
                    </table>
                    <button type="button" id="updateOrderBtn" class="btn btn-primary" style="width:200px;">Update Order</button>
                `;
                container.appendChild(newTableContainer);
            }

            const tbody = document.getElementById('taskTableBody');
            tbody.innerHTML = ''; // Clear existing data

            data.data.data.forEach(task => {
                const row = document.createElement('tr');
                row.dataset.id = task.task_id; // Use task_id for ordering
                row.innerHTML = `
                    <td>${task.task_name}</td>
                    <td>${task.task_desc}</td>
                    <td>${task.first_name} ${task.last_name}</td>
                    <td>${task.NoOfQuestns}</td>
                    <td>${task.time}</td>
                    <td> <button style="border-color: white; border: none; color:#1E90FF" onClick="window.location.href = '{{ env('APP_URL') }}taskdetails/${task.task_id}'">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </button>
                    </td>
                `;
                tbody.appendChild(row);
            });

            // Initialize SortableJS
            new Sortable(tbody, {
                animation: 150,
                onEnd: function(event) {
                    // You might want to do something on end, but we will handle order on button click
                }
            });

            // Attach event listener for the Update Order button
            document.getElementById('updateOrderBtn').addEventListener('click', function() {
                // alert('Update Order button clicked');
                const tbody = document.getElementById('taskTableBody');
                const orderedIDs = Array.from(tbody.querySelectorAll('tr')).map(row => row.dataset.id);
                saveOrder(orderedIDs); // Call function to save new order
            });
        })
        .catch(error => console.error('Error:', error));
    });

    // Function to save the new order to the server
    function saveOrder(order) {
        // alert('Saving order: ' + JSON.stringify(order));
        fetch('/updateTaskOrder', { // Adjust the URL to your backend endpoint
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ order })
        })
        .then(response => response.json())
        .then(data => {
                toastr.success('Updated sequential order', 'Success');
                console.log('Order saved:', data);
        })
        .catch(error => {
                console.error('Error saving order:', error);
                toastr.error('Failed to update order', 'Error');
        });
    }
});

   // Optional: Configure Toastr options
   toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
</script>
<style>
body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .toast-success {
            background-color: #51A351 !important; /* To ensure green background for success */
            color: white !important; /* Ensure text color is white */
        }
        .toast-error {
            background-color: #BD362F !important; /* To ensure red background for error */
            color: white !important; /* Ensure text color is white */
        }
</style>
</html>