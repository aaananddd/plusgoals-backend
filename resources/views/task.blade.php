<!DOCTYPE html>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css"
    rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Task </title>

    <!-- Prevent the demo from appearing in search engines -->
    <meta name="robots" content="noindex">

    <link href="https://fonts.googleapis.com/css?family=Lato:400,700%7CRoboto:400,500%7CExo+2:600&display=swap"
        rel="stylesheet">

    <link href="{{asset('vendor/spinkit.css')}}" rel="stylesheet" type="text/css">
   
    <link href="{{asset('vendor/perfect-scrollbar.css')}}" rel="stylesheet" type="text/css">

    <link href="{{asset('css/material-icons.css')}}" rel="stylesheet" type="text/css">

    <link href="{{asset('css/fontawesome.css')}}" rel="stylesheet" type="text/css">

    <link href="{{asset('css/preloader.css')}}" rel="stylesheet" type="text/css">
  
    <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
@if(session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif
   <!-- Header -->
    @include('layouts.header')
   <!-- END Header -->
      
        <!-- Header Layout Content -->
        <div class="mdk-header-layout__content page-content">
                <div class="page-section bg-alt border-bottom-2">
                    <div class="container page__container">
                    <!-- <div class="col-lg-12" >
                                <h1 class="h2 mb-0" >Tasks</h1>
                            </div>
                            <br> -->
                        <div class="d-flex flex-column flex-lg-row align-items-center">
                            <div class="row align-items-center w-100">
                          
                                <form action="{{ url('task_date_filter') }}" method="get" class="col-md-6 form-inline">
                                    <div class="form-group mr-md-2">
                                        <label for="">Date From</label>
                                        <input type="date" name="date_from" class="form-control">
                                    </div>
                                    <div class="form-group mr-md-2">
                                        <label for="">Date To</label>
                                        <input type="date" name="date_to" class="form-control">
                                    </div>
                                    <button type="submit" class="btn btn-primary" style="width: 100px;">Search</button>
                                </form>
                                <form class="search-form form-control-rounded navbar-search d-none d-lg-flex mr-6pt ml-auto"
                                    style="max-width: 150px;">
                                    <button class="btn" type="submit"><i class="material-icons">search</i></button>
                                    <input type="text" class="form-control" id="input" placeholder="Search ...">
                                </form>
                            </div>
                           
                        </div>
                    </div>
                    <br>
                    <div class="container page__container">
                        <div class="d-flex flex-column flex-lg-row align-items-center">
                            <div class="row align-items-center w-100">
                                <div>
                                    <a href="{{ route('taskLevel') }}" class="btn btn-light ml-lg-2" style="color:#1E90FF;">New Task</a> 
                                    <a href="{{ route('setSortOrder') }}" class="btn btn-light ml-lg-2" style="color:#1E90FF;">Set SortOrder</a> 
                                </div>
                                <!-- <form class="search-form form-control-rounded navbar-search d-none d-lg-flex mr-2pt ml-auto" style="max-width: 150px;" id="filterForm">
                                    <input type="text" class="form-control" id="filter_text">
                                    <div class="col-md-9">
                                        <select class="form-control custom-select w-auto" name="filter_order" id="filter_order">
                                            <option value="option_select" disabled selected>Filter order</option>
                                            @foreach($order as $orders)
                                                <option value="{{ $orders->id }}">{{ $orders->order }}</option>
                                            @endforeach
                                        </select>
                                        <span id="title-error" class="error text-danger" style="display:none; font-size: 16px;">Order is required.</span>
                                    </div>
                                </form> -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>

           
            <div class="container page__container">

                <div class="mdk-header-layout__content page-content ">

                    <div class="page-section">

                        <div class="row">

                            <div class="col-lg-12">
                            
    @foreach($result as $task)
 
    <table class="table align-middle table-nowrap" id="customerTable">
        <thead class="table-light">
            <tr>
                <th>Sl.No</th>
                <th>Task Name</th>
                <th>Level</th>
                <th>Difficulty level</th>
                <th>Order</th>
                <th>Approved</th>
                <th>Created By</th>
                <th>Created Date</th>
                <th>View</th>
                @if( $user == 1 )
                    <th>Edit</th>
                @else
                    <th>Request to edit</th>
                @endif
                <th style="text-align: center;">Delete</th>
                @if($user == 1)
                    <th>Enable</th>
                @endif
            </tr>
        </thead>
        <tbody class="list form-check-all" id="myTable">
            @foreach($task as $index => $t)
            @php
                $currentPage = $task->currentPage(); 
                $perPage = $task->perPage(); 
                $startingIndex = ($currentPage - 1) * $perPage; 
            @endphp
            <tr>
                <td>{{ $startingIndex + $index + 1 }}</td>
                <td>{{ $t->task_name }}</td>
                <td>{{ $t->level_name }}</td>
                <td>{{ $t->difficulty }}</td>
                <td>{{ $t->order }}</td>
                <td style="align:center">
                    @if( $t->is_admin_approved == 1 )
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="green">
                            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/>
                        </svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="red">
                            <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"/>
                        </svg>
                    @endif
                </td>
                <td>{{ $t->first_name }} {{ $t->last_name }}</td>
                <td>{{ Carbon\Carbon::parse($t->created_at)->format('Y-m-d') }}</td>
                <td>
                    <button style="border-color: white; border: none; color:#1E90FF" onClick="window.location.href = '{{ env('APP_URL') }}taskdetails/<?php echo $t->task_id; ?>'">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </button>
                </td>
                <td class="text-center"> 
                    @if( $user == 1 )
                            <button style="border-color: white; border: none; color:#1E90FF" onClick="window.location.href = '{{ env('APP_URL') }}task_edit/<?php echo $t->task_id; ?>'">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>
                            </button>
                    @else
		     @if($t->is_admin_approved == 0)
			   <button style="border-color: white; border: none; color:#1E90FF" onClick="window.location.href = '{{ env('APP_URL') }}task_edit/<?php echo $t->task_id; ?>'">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>
                            </button>
		     @else
                        @if($t->request_sent == 0)
                            <button type="button" data-user-id="{{ $t->created_by }}" data-id="{{ $t->task_id }}" name="submit" id="submit" onClick="sendRequest('{{ $t->task_id }}', '{{ $t->created_by }}')" class="btn btn-primary me-sm-3 me-1 data-submit" style=" width: 100px;">Send request</button>
                        @elseif($t->request_sent == 1) 
                            @if($t->is_request_approved == 0)
                                <button type="button"  class="btn btn-success me-sm-3 me-1 data-submit" style=" width: 100px;">Request sent</button>
                            @else
                                <button type="button"  class="btn btn-success me-sm-3 me-1 data-submit" onClick="window.location.href = '{{ env('APP_URL') }}task_edit/<?php echo $t->task_id; ?>'" style=" width: 130px;">Request approved</button>
                            @endif
                        @else
                        @if($t->is_request_approved == 0)
                                <button type="button"  class="btn btn-success me-sm-3 me-1 data-submit" style=" width: 100px;">Request sent</button>
                            @else
                                <button type="button"  class="btn btn-success me-sm-3 me-1 data-submit" onClick="window.location.href = '{{ env('APP_URL') }}task_edit/<?php echo $t->task_id; ?>'" style=" width: 130px;">Request approved</button>
                            @endif
                        @endif   
                      @endif  
                    @endif
                </td>
                <td>
                    <button style="border-color: white; border: none; color:#1E90FF" onClick="window.location.href = '{{ env('APP_URL') }}delete_task/<?php echo $t->task_id; ?>'">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" width="20" height="20" align="center" color="#1E90FF">
                            <path d="M3 2a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H3Z" />
                            <path fill-rule="evenodd" d="M3 6h10v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6Zm3 2.75A.75.75 0 0 1 6.75 8h2.5a.75.75 0 0 1 0 1.5h-2.5A.75.75 0 0 1 6 8.75Z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </td>
                <td>
                @if($user == 1)
                @if($t->is_active == 1)
                    <button title="click to disable task" style="border-color: white; border: none; color:#1E90FF" onClick="window.location.href = '{{ env('APP_URL') }}toggle_task/<?php echo $t->task_id; ?>'">
                    <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24" id="toggle"><circle cx="16.5" cy="12" r="2.5" fill="#b2b1ff"></circle>
                        <path fill="#6563ff" d="M16.5 6.5h-9a5.5 5.5 0 0 0 0 11h9a5.5 5.5 0 0 0 0-11zm0 8a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5z">
                        </path>
                    </svg>
                    </button>
                @else 
                <button title="click to enable task" style="border-color: white; border: none; color:#1E90FF" onClick="window.location.href = '{{ env('APP_URL') }}toggle_task/<?php echo $t->task_id; ?>'">
                    <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24" id="toggle">
                        <path fill="#b2b1ff" d="M16.5 17.5h-9a5.5 5.5 0 1 1 0-11h9a5.5 5.5 0 1 1 0 11z"></path><circle cx="7.5" cy="12" r="2.5" fill="#6563ff"></circle>
                    </svg>
                    </button>

                @endif
                @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endforeach
</div>
{!! $task->withQueryString()->links('pagination::bootstrap-5') !!}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- </div> -->

                <style>
                    .scrollit {
                        overflow: scroll;
                        height: 100px;
                    }
                </style>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                        
                        $(document).ready(function() {
                        $('#filter_order').change(function() {
                            var filter = $(this).val();

                            $.ajax({
                                url: '/taskDetails', // Update with the correct URL if necessary
                                type: 'GET',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data: {
                                    'filter': filter
                                },
                                success: function(data) {
                                    console.log(data);
                                    if(data){
                                        
                                    }
                                },
                                error: function(xhr, status, error) {
                                    Swal.fire("Error", "An error occurred while processing your request", "error");
                                    console.error(xhr.responseText);
                                }
                            });
                        });
                    });


                   
                    </script>
                <!-- // END Header Layout Content -->

@include('layouts.footer')
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
   ClassicEditor
      .create(document.querySelector('#editor'), {})
      .catch(error => {
         console.log(error);
      });
</script>
<script>
    $(document).ready(function () {
        $("#input").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });
    });
</script>

</html>