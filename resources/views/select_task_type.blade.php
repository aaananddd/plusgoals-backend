<!DOCTYPE html>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css"rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
<html lang="en" dir="ltr">

<head>
    @include('layouts.head')
</head>

<body class="layout-sticky-subnav layout-learnly ">

<!-- Header  -->
    @include('layouts.header')
<!-- End Header -->

    <div class="mdk-header-layout__content page-content ">
        <div class="page-section bg-alt border-bottom-2">
            <div class="container page__container">    
                <div class="d-flex flex-column flex-lg-row align-items-center">
                    <div class="flex d-flex flex-column align-items-center align-items-lg-start mb-16pt mb-lg-0 text-center text-lg-left">
                       
                       <!-- <button class="tab-button" onclick="window.location.href='{{ route('selectTaskType', [$task_id, $limit]) }}'" style="background-color: none; border: #6495ED; color: black; width:200px;">
    Select task type
</button> -->

                        <ul class="nav nav-pills flex-column flex-md-row mb-3">
                            <li class="nav-item custom-box  active">
                                <a class="nav-link" href="{{ route('selectTaskType', [$task_id, $limit]) }}">
                                    <i class="bx bx-user me-1"></i>Select Task Type
                                </a>
                            </li>
                            &nbsp;&nbsp;
                            <!-- <li class="nav-item custom-box">
                                <a class="nav-link" href="{{ route('setSequentialOrder',[$task_id, $limit]) }}">
                                    <i class="bx bx-user me-1"></i>Set Sequential Order
                                </a>
                            </li> -->
                        </ul>


                    
                    &nbsp;&nbsp;
                    <div class="ml-lg-16pt">
                    </div>
                </div>
            </div>
        </div>
        <div class="container page__container">
            <div class="mdk-header-layout__content page-content ">
                <div class="page-section">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="container">
                                <div class="box div1">  <a href="{{ route('addQuestion', [$task_id, $limit]) }}">Objective type</a></div>
                                <div class="box div2"> <a href = "{{ route('AddQuestionforShort', [$task_id, $limit]) }}"> Short Answer</a></div>
                                <div class="box div3"> <a href = "{{ route('DescriptiveQuestion', [$task_id, $limit]) }}"> Descriptive </a></div>
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
            margin-bottom: 10px; 
            padding: 10px; 
            border-radius: 5px; 
            background-color: #f9f9f9;
        }

        
        .nav-item.active .nav-link {
             
            color:black; 
        }
</style>

</html>