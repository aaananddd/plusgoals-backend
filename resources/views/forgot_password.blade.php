<link href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>

<!DOCTYPE html>
<html lang="en"
      dir="ltr">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible"
              content="IE=edge">
        <meta name="viewport"
              content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Forgot Password</title>

        <!-- Prevent the demo from appearing in search engines -->
        <meta name="robots"
              content="noindex">

        <link href="https://fonts.googleapis.com/css?family=Lato:400,700%7CRoboto:400,500%7CExo+2:600&display=swap"
              rel="stylesheet">

        <link href="{{asset('vendor/spinkit.css')}}" rel="stylesheet" type="text/css">
    
        <link href="{{asset('vendor/perfect-scrollbar.css')}}" rel="stylesheet" type="text/css">
      
        <link href="{{asset('css/material-icons.css')}}" rel="stylesheet" type="text/css">
    
        <link href="{{asset('css/fontawesome.css')}}" rel="stylesheet" type="text/css">
      
        <link href="{{asset('css/preloader.css')}}" rel="stylesheet" type="text/css">
      
        <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">

    </head>

    <body class="layout-default layout-login-centered-boxed">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <style>
        .alert {
    padding: 15px;
    margin-bottom: 20px;
    border: 1px solid transparent;
    border-radius: 4px;
}

.alert-success {
    color: #3c763d;
    background-color: #dff0d8;
    border-color: #d6e9c6;
}
</style>
        <div class="layout-login-centered-boxed__form card">
            <div class="d-flex flex-column justify-content-center align-items-center mt-2 mb-4 navbar-light">
                <a href="index.html"
                   class="navbar-brand flex-column mb-2 align-items-center mr-0"
                   style="min-width: 0">
                       <img src="{{asset('images/plus-goal-logo.svg')}}" class="img-fluid" />
                </a>
                <h5 class="m-0 mt-5 text-center">Enter your registered email</h5>
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
                           for="password_2">New Password:</label>
                    <div class="input-group input-group-merge">
                        <input id="password"
                               type="password"
                               required=""
                               name="password"
                               class="form-control form-control-prepended"
                               placeholder="Enter your password">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="fa fa-key">
                                @if ($errors->has('password'))
                                      <span class="text-danger">{{ $errors->first('password') }}</span>
                                  @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="text-label"
                           for="password_2">Confirm Password:</label>
                    <div class="input-group input-group-merge">
                        <input id="c_password"
                               type="password"
                               required=""
                               name="c_password"
                               class="form-control form-control-prepended"
                               placeholder="Enter your password">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="fa fa-key">
                                @if ($errors->has('password'))
                                      <span class="text-danger">{{ $errors->first('password') }}</span>
                                  @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-block btn-primary mt-3 mb-3 "
                            type="submit">Submit</button>
                </div>
            
                <div class="form-group text-center">
                    <a href="{{url('/')}}">Back to login page</a> 
                
                </div>
            </form>
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