
<!DOCTYPE html>
<html lang="en"
      dir="ltr">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible"
              content="IE=edge">
        <meta name="viewport"
              content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Reset password</title>

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
                       <img src="images/plus-goal-logo.svg" alt="logo" class="img-fluid" />
                </a>
                <h5 class="m-0 mt-5 text-center">Reset Your Password</h5>
            </div>           
            <form action="{{route('forgotPassword')}}" method="post"
                  novalidate>
                  @csrf
                  <div class="form-group">
                    <label class="text-label"
                           for="email_2">Email Address:</label>
                    <div class="input-group input-group-merge">
                        <input id="email"
                               type="email"
                               required=""
                               name ="email"
                               class="form-control form-control-prepended"
                               placeholder="Enter Your Email Id">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                            <span class="far fa-envelope"> </span>
                                @if ($errors->has('email'))
                                <span class="far fa-envelope">{{ $errors->first('email') }}</span>
                                  @endif
                               
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="text-label"
                           for="password">New Password:</label>
                           <div class="input-group input-group-merge">
                           <input type="password" placeholder="Enter your new password" id="password" class="form-control form-control-prepended" name="password"
                                    required autofocus>
                          <div class="input-group-prepend">
                            <div class="input-group-text">
                                @if ($errors->has('password'))
                                <span class="fa fa-key">{{ $errors->first('password') }}</span>
                                @endif    
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="text-label"
                           for="password_2">Confirm Password:</label>
                    <div class="input-group input-group-merge">
                    <input type="password" placeholder="Enter your new password" id="c_password" class="form-control form-control-prepended" name="c_password"
                                    required autofocus>
                          <div class="input-group-prepend">
                            <div class="input-group-text">
                                @if ($errors->has('c_password'))
                                <span class="fa fa-key">{{ $errors->first('c_password') }}</span>
                                @endif    
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-block btn-primary mt-3 mb-3 "
                            type="submit">Confirm</button>
                </div>
            
            </form>

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