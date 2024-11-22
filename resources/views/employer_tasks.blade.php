<!DOCTYPE html>
<html lang="en"
      dir="ltr">

<head>
    <title>Employer Task</title>
    @include('layouts.head')

</head>

    <!-- header -->
    @include('layouts.header')
        <!-- // END Header -->
      
        <!-- Header Layout Content -->
        <div class="mdk-header-layout__content page-content">
                <br>
            <div class="mdk-header-layout__content page-content ">
            <div class="page-section">
               <div class="container page__container">
                  <div class="row">

                     <div class="col-lg-12">
    <table class="table align-middle table-nowrap" id="customerTable">
        <thead class="table-light">
            <tr>
                <th>Sl.No</th>
                <th>Task Name</th>
                <th>Task Description</th>
                <th>Created at</th>
                <th>Assigned Interns</th>
            </tr>
        </thead>
        <tbody class="list form-check-all" id="myTable">
        @foreach($data as $index => $task)
    
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $task->task_name }}</td>
                <td>{!! $task->task_desc !!}</td>
                <td>{{ Carbon\Carbon::parse($task->created_at)->format('d-m-Y') }}</td>
                <td>
                    <button style="border-color: white; border: none; color: #1E90FF"
                            onclick="window.location.href='{{ url('assigned_intern_task/' . $task->created_by . '/' . $task->task_id) }}'">
                        <i class="fa fa-eye" style="font-size: 24px;"></i>
                    </button>
                </td>

               
            </tr>
      
            @endforeach
        </tbody>
    </table>
    </div>
    </div>
    </div>
                </div>
           
</div>
            </div>


<style>
    .scrollit {
        overflow: scroll;
        height: 100px;
    }
    
    .modal-backdrop {
    opacity: 1 !important; /* Ensure backdrop is fully opaque */
    transition: none !important; /* Disable any transitions */
}
</style>
          
  
                <!-- // END Header Layout Content -->

                <!-- // END Header Layout -->

                <!-- // END Drawer -->
                <!-- Footer -->

             @include('layouts.footer')
</body>

</html>