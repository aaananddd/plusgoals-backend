
<!DOCTYPE html>
<html lang="en"
      dir="ltr">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible"
              content="IE=edge">
        <meta name="viewport"
              content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Login</title>

        <!-- Prevent the demo from appearing in search engines -->
        <meta name="robots"
              content="noindex">

        <link href="https://fonts.googleapis.com/css?family=Lato:400,700%7CRoboto:400,500%7CExo+2:600&display=swap"
              rel="stylesheet">

        <!-- Preloader -->
        <!-- <link type="text/css"
              href="vendor/spinkit.css"
              rel="stylesheet"> -->
              <link href="{{asset('vendor/spinkit.css')}}" rel="stylesheet" type="text/css">
        <!-- Perfect Scrollbar -->
        <!-- <link type="text/css"
              href="../../public/vendor/perfect-scrollbar.css"
              rel="stylesheet"> -->
              <link href="{{asset('vendor/perfect-scrollbar.css')}}" rel="stylesheet" type="text/css">
        <!-- Material Design Icons -->
        <!-- <link type="text/css"
              href="../../public/css/material-icons.css"
              rel="stylesheet"> -->
              <link href="{{asset('css/material-icons.css')}}" rel="stylesheet" type="text/css">
        <!-- Font Awesome Icons -->
        <!-- <link type="text/css"
              href="../../public/css/fontawesome.css"
              rel="stylesheet"> -->
              <link href="{{asset('css/fontawesome.css')}}" rel="stylesheet" type="text/css">
        <!-- Preloader -->
        <!-- <link type="text/css"
              href="../../public/css/preloader.css"
              rel="stylesheet"> -->
              <link href="{{asset('css/preloader.css')}}" rel="stylesheet" type="text/css">
        <!-- App CSS -->
        <!-- <link type="text/css"
              href="{{asset('css/app.css')}}"
              rel="stylesheet"> -->
              <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">

    </head>

    <body class="layout-default layout-login-centered-boxed">
        <div class="layout-login-centered-boxed__form card">
            <div class="d-flex flex-column justify-content-center align-items-center mt-2 mb-4 navbar-light">
                <a href="index.html"
                   class="navbar-brand flex-column mb-2 align-items-center mr-0"
                   style="min-width: 0">
                       <img src="{{asset('images/plus-goal-logo.svg')}}" class="img-fluid" />
                </a>
                <h5 class="m-0 mt-5 text-center">Login to access your Account </h5>
            </div>           
          
        </div>

        <!-- jQuery -->
        <script src="{{asset('vendor/jquery.min.js')}}"></script>

        <!-- Bootstrap -->
        <script src="{{asset('vendor/popper.min.js')}}"></script>
        <script src="{{asset('vendor/bootstrap.min.js')}}"></script>

        <!-- Perfect Scrollbar -->
        <!-- <script src="../../public/vendor/perfect-scrollbar.min.js"></script> -->
        <script src="{{asset('vendor/perfect-scrollbar.min.js')}}"></script>
        <!-- DOM Factory -->
        <!-- <script src="../../public/vendor/dom-factory.js"></script> -->
        <script src="{{asset('vendor/dom-factory.js')}}"></script>
        <!-- MDK -->
        <!-- <script src="../../public/vendor/material-design-kit.js"></script> -->
        <script src="{{asset('vendor/material-design-kit.js')}}"></script>
        <!-- App JS -->
        <!-- <script src="../../public/js/app.js"></script> -->
        <script src="{{asset('js/app.js')}}"></script>
        <!-- Preloader -->
        <!-- <script src="../../public/js/preloader.js"></script> -->
        <script src="{{asset('js/preloader.js')}}"></script>

    </body>

</html>