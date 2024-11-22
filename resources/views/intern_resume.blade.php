<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Details</title>
  <!-- Include required CSS -->
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Print Styles */
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>

</head>

<body >

<!-- Header Section -->
<header>
  @include('layouts.header')
</header>

<!-- Main Content Section -->
<main class="flex-grow">
  <div class="container mx-auto py-6 px-4">
    <button id="printButton" class="bg-black hover:bg-gray-700 text-white font-bold py-2 px-4 mb-4"> Print Resume </button>
    <div class="shadow-md flex overflow-hidden border w-full min-h-[297mm] mx-auto bg-white">
  
      <!-- Flex container with two columns -->
      <div class="flex flex-1">
        <!-- Left Column (4 out of 10) -->
        <div class="flex-none w-[40%] bg-gray-200 p-4">
          <div class="mb-4">
            @if($data->imageLink == null)
              <span> No profile photo </span>
            @else
              <img src="{{ $data->imageLink }}"  class="w-full h-auto rounded-full mb-4" style="width: 100px; height: 100px; object-fit: cover; " align="center">
            @endif
          </div>
          <div class="mb-4">
            <h3 class="text-xl font-semibold mb-2">Contact Details</h3>
            <p class="flex items-center mb-2 truncate">
              <span class="fa fa-phone mr-2"></span> {{ $data->phone }}
            </p>
            <p class="flex items-center mb-2 truncate">
              <span class="fa fa-envelope mr-2"></span> {{ $data->email_id }}
            </p>
            <div class="address">
              <span class="fa fa-map-marker-alt mr-2" ></span>
              <p class="wrap-text">
               <span style="white-space: pre-line"> {{ $data->address1 }} </span><br />
               <span style="white-space: pre-line"> {{ $data->city }}, {{ $data->state }} </span><br />
               <span style="white-space: pre-line"> {{ $data->country }}, {{ $data->pincode }}</span>
              </p>
            </div>
          </div>
          <div class="mb-4">
            <h3 class="text-xl font-semibold mb-2">Skills</h3>
            <ul class="list-disc list-inside" style="white-space: pre-line">
              <li  style="white-space: pre-line">{{ $data->skills }}</li>
            </ul>
          </div>
        </div>
        
        <!-- Right Column (6 out of 10) -->
        <div class="flex-1 p-6">
          <h2 class="uppercase text-center text-2xl font-semibold mb-4 break-words">{{ $data->first_name }} {{ $data->last_name }}</h2>
          <div class="mb-4">
            <h3 class="text-xl font-semibold mb-2">About</h3>
            <p style="white-space: pre-line">{{ $data->about }}</p>
          </div>
          <div class="mb-4">
            <h3 class="text-xl font-semibold mb-2">Educational Details</h3>
            <p><strong>Highest Qualification:</strong> {{ $data->highest_qualification }}</p>
            <p><strong>Institute:</strong> {{ $data->institute }}</p>
            <p><strong>Board:</strong> {{ $data->board }}</p>
            <p><strong>Additional Qualification:</strong> {{ $data->additional_qualification }}</p>
          </div>
          <div class="mb-4">
            <h3 class="text-xl font-semibold mb-2">Experience</h3>
            <p><strong>Years of Experience:</strong> {{ $data->experience }}</p>
            <p><strong>Expected Salary:</strong> {{ $data->expected_salary }}</p>
          </div>
          <div>
            <h3 class="text-xl font-semibold mb-2">PlusGoals Performance</h3>
            <p><strong>Level:</strong> {{ $data->level }}</p>
            <p><strong>Status:</strong> {{ $data->level_status }}</p>
            <p><strong>Tasks Completed:</strong> {{ $data->no_of_tasks_completed }}</p>
            <p><strong>Tasks Pending:</strong> {{ $data->no_of_tasks_pending }}</p>
          </div>
        </div>
      </div>

    </div>
  </div>
</main>

<!-- Footer Section -->
<footer >
  @include('layouts.footer')
</footer>

</body>
<script>
        document.getElementById('printButton').addEventListener('click', function() {
            window.print();
        });
</script>
</html>
