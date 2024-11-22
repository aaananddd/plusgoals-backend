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
                <th>Intern Name</th>
                <th>Assigned date</th>
                <th>Status</th>
                <th>Answered</th>
            </tr>
        </thead>
        <tbody class="list form-check-all" id="myTable">
        @foreach($data as $index => $intern)
    
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $intern->first_name }} {{ $intern->last_name }}</td>
                <td>{{ Carbon\Carbon::parse($intern->assigned_date)->format('d-m-Y') }}</td>
                <td>
                    @if($intern->status == -1)
                        Not Approved
                    @else 
                        Approved
		    @endif
                </td>               
		<td>
                    @if ($intern->is_answered == 0)
                        Not Answered
                    @else
                        Answered
                    @endif
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