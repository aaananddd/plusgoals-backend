
<!DOCTYPE html>
<html lang="en"
      dir="ltr">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible"
              content="IE=edge">
        <meta name="viewport"
              content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Teacher Profile</title>

        <!-- Prevent the demo from appearing in search engines -->
        <meta name="robots"
              content="noindex">

        <link href="https://fonts.googleapis.com/css?family=Lato:400,700%7CRoboto:400,500%7CExo+2:600&display=swap"
              rel="stylesheet">

        <!-- Preloader -->
        <!-- <link type="text/css"
              href="../../public/vendor/spinkit.css"
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
              href="../../public/css/app.css"
              rel="stylesheet"> -->
              <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
    </head>

    <body class="layout-sticky-subnav layout-learnly ">

        <div class="preloader">
            <div class="sk-chase">
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
            </div>

            <!-- <div class="sk-bounce">
    <div class="sk-bounce-dot"></div>
    <div class="sk-bounce-dot"></div>
  </div> -->

            <!-- More spinner examples at https://github.com/tobiasahlin/SpinKit/blob/master/examples.html -->
        </div>

        <!-- Header Layout -->
        <div class="mdk-header-layout js-mdk-header-layout">

            <!-- Header -->

            <div id="header"
                 class="mdk-header js-mdk-header mb-0"
                 data-fixed
                 data-effects="waterfall">
                <div class="mdk-header__content">

                    <div class="navbar navbar-expand navbar-light bg-white border-bottom"
                         id="default-navbar"
                         data-primary>
                        <div class="container page__container">

                            <!-- Navbar Brand -->
                            <a href="index.html"
                               class="navbar-brand mr-16pt">

                                <span class="avatar avatar-sm navbar-brand-icon mr-0 mr-lg-8pt">

                                    <span class="avatar-title rounded bg-primary"><img src="images/white.svg"
                                             alt="logo"
                                             class="img-fluid" /></span>

                                </span>

                                <span class="d-none d-lg-block">Plus Goals</span>
                            </a>

                            <!-- Navbar toggler -->
                            <button class="navbar-toggler w-auto mr-16pt d-block rounded-0"
                                    type="button"
                                    data-toggle="sidebar">
                                <span class="material-icons">short_text</span>
                            </button>

                            <ul class="nav navbar-nav d-none d-sm-flex flex justify-content-start ml-8pt">
                                <li class="nav-item">
                                    <a href="index.html"
                                       class="nav-link">Home</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a href="#"
                                       class="nav-link dropdown-toggle"
                                       data-toggle="dropdown"
                                       data-caret="false">Courses</a>
                                    <div class="dropdown-menu">
                                        <a href="courses.html"
                                           class="dropdown-item">Browse Courses</a>
                                        <a href="student-course.html"
                                           class="dropdown-item">Preview Course</a>
                                        <a href="student-lesson.html"
                                           class="dropdown-item">Preview Lesson</a>
                                        <a href="student-take-course.html"
                                           class="dropdown-item"><span class="mr-16pt">Take Course</span> <span class="badge badge-notifications badge-accent text-uppercase ml-auto">Pro</span></a>
                                        <a href="student-take-lesson.html"
                                           class="dropdown-item">Take Lesson</a>
                                        <a href="student-take-quiz.html"
                                           class="dropdown-item">Take Quiz</a>
                                        <a href="student-quiz-result-details.html"
                                           class="dropdown-item">Quiz Result</a>
                                        <a href="student-dashboard.html"
                                           class="dropdown-item">Student Dashboard</a>
                                        <a href="student-my-courses.html"
                                           class="dropdown-item">My Courses</a>
                                        <a href="student-quiz-results.html"
                                           class="dropdown-item">My Quizzes</a>
                                        <a href="help-center.html"
                                           class="dropdown-item">Help Center</a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a href="#"
                                       class="nav-link dropdown-toggle"
                                       data-toggle="dropdown"
                                       data-caret="false">Paths</a>
                                    <div class="dropdown-menu">
                                        <a href="paths.html"
                                           class="dropdown-item">Browse Paths</a>
                                        <a href="student-path.html"
                                           class="dropdown-item">Path Details</a>
                                        <a href="student-path-assessment.html"
                                           class="dropdown-item">Skill Assessment</a>
                                        <a href="student-path-assessment-result.html"
                                           class="dropdown-item">Skill Result</a>
                                        <a href="student-paths.html"
                                           class="dropdown-item">My Paths</a>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <a href="pricing.html"
                                       class="nav-link">Pricing</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a href="#"
                                       class="nav-link dropdown-toggle"
                                       data-toggle="dropdown"
                                       data-caret="false">Teachers</a>
                                    <div class="dropdown-menu">
                                        <a href="instructor-dashboard.html"
                                           class="dropdown-item">Instructor Dashboard</a>
                                        <a href="instructor-courses.html"
                                           class="dropdown-item">Manage Courses</a>
                                        <a href="instructor-quizzes.html"
                                           class="dropdown-item">Manage Quizzes</a>
                                        <a href="instructor-earnings.html"
                                           class="dropdown-item">Earnings</a>
                                        <a href="instructor-statement.html"
                                           class="dropdown-item">Statement</a>
                                        <a href="instructor-edit-course.html"
                                           class="dropdown-item">Edit Course</a>
                                        <a href="instructor-edit-quiz.html"
                                           class="dropdown-item">Edit Quiz</a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown active"
                                    data-toggle="tooltip"
                                    data-title="Community"
                                    data-placement="bottom"
                                    data-boundary="window">
                                    <a href="#"
                                       class="nav-link dropdown-toggle"
                                       data-toggle="dropdown"
                                       data-caret="false">
                                        <i class="material-icons">people_outline</i>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a href="teachers.html"
                                           class="dropdown-item">Browse Teachers</a>
                                        <a href="student-profile.html"
                                           class="dropdown-item">Student Profile</a>
                                        <a href="teacher-profile.html"
                                           class="dropdown-item active">Instructor Profile</a>
                                        <a href="blog.html"
                                           class="dropdown-item">Blog</a>
                                        <a href="blog-post.html"
                                           class="dropdown-item">Blog Post</a>
                                        <a href="faq.html"
                                           class="dropdown-item">FAQ</a>
                                        <a href="help-center.html"
                                           class="dropdown-item">Help Center</a>
                                        <a href="discussions.html"
                                           class="dropdown-item">Discussions</a>
                                        <a href="discussion.html"
                                           class="dropdown-item">Discussion Details</a>
                                        <a href="discussions-ask.html"
                                           class="dropdown-item">Ask Question</a>
                                    </div>
                                </li>
                            </ul>

                            <form class="search-form form-control-rounded navbar-search d-none d-lg-flex mr-16pt"
                                  action="index.html"
                                  style="max-width: 230px">
                                <button class="btn"
                                        type="submit"><i class="material-icons">search</i></button>
                                <input type="text"
                                       class="form-control"
                                       placeholder="Search ...">
                            </form>

                            <ul class="nav navbar-nav ml-auto mr-0">
                                <li class="nav-item">
                                    <a href="login.html"
                                       class="nav-link"
                                       data-toggle="tooltip"
                                       data-title="Login"
                                       data-placement="bottom"
                                       data-boundary="window"><i class="material-icons">lock_open</i></a>
                                </li>
                                <li class="nav-item">
                                    <a href="signup.html"
                                       class="btn btn-outline-secondary">Get Started</a>
                                </li>
                            </ul>

                        </div>
                    </div>

                </div>
            </div>

            <!-- // END Header -->

            <!-- Header Layout Content -->
            <div class="mdk-header-layout__content page-content ">

                <div class="page-section bg-alt border-bottom-2">
                    <div class="container page__container">

                        <div class="d-flex flex-column flex-lg-row align-items-center">
                            <div class="d-flex flex-column flex-md-row align-items-center flex mb-16pt mb-lg-0 text-center text-md-left">
                                <div class="mb-16pt mb-md-0 mr-md-24pt">
                                    <img src="images/black.svg"
                                         width="104"
                                         alt="teacher">
                                </div>
                                <div class="flex">
                                    <h1 class="h2 mb-0">Laza Bogdan</h1>
                                    <div class="rating mb-16pt d-inline-flex">
                                        <div class="rating__item"><i class="material-icons">star</i></div>
                                        <div class="rating__item"><i class="material-icons">star</i></div>
                                        <div class="rating__item"><i class="material-icons">star</i></div>
                                        <div class="rating__item"><i class="material-icons">star</i></div>
                                        <div class="rating__item"><i class="material-icons">star_border</i></div>
                                    </div>
                                    <div>
                                        <span class="chip chip-outline-secondary d-inline-flex align-items-center"
                                              data-toggle="tooltip"
                                              data-title="Experience IQ"
                                              data-placement="bottom">
                                            <i class="material-icons icon--left">opacity</i> 2,300 points
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="ml-lg-16pt">
                                <a href=""
                                   class="btn btn-light">Follow</a>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="page-section">
                    <div class="container page__container">

                        <div class="row">
                            <div class="col-lg-8">

                                <div class="row card-group-row mb-8pt">

                                    <div class="col-sm-6 card-group-row__col">
                                        <div class="card card-sm card-group-row__card">
                                            <div class="card-body d-flex align-items-center">
                                                <a href="course.html"
                                                   class="avatar avatar-4by3 overlay overlay--primary mr-12pt">
                                                    <img src="public/images/paths/angular_routing_200x168.png"
                                                         alt="Angular Routing In-Depth"
                                                         class="avatar-img rounded">
                                                    <span class="overlay__content"></span>
                                                </a>
                                                <div class="flex">
                                                    <a class="card-title mb-4pt"
                                                       href="course.html">Angular Routing In-Depth</a>
                                                    <div class="d-flex align-items-center">
                                                        <div class="rating mr-8pt">

                                                            <span class="rating__item"><span class="material-icons">star</span></span>

                                                            <span class="rating__item"><span class="material-icons">star</span></span>

                                                            <span class="rating__item"><span class="material-icons">star</span></span>

                                                            <span class="rating__item"><span class="material-icons">star_border</span></span>

                                                            <span class="rating__item"><span class="material-icons">star_border</span></span>

                                                        </div>
                                                        <small class="text-muted">3/5</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 card-group-row__col">
                                        <div class="card card-sm card-group-row__card">
                                            <div class="card-body d-flex align-items-center">
                                                <a href="course.html"
                                                   class="avatar avatar-4by3 overlay overlay--primary mr-12pt">
                                                    <img src="public/images/paths/angular_testing_200x168.png"
                                                         alt="Angular Unit Testing"
                                                         class="avatar-img rounded">
                                                    <span class="overlay__content"></span>
                                                </a>
                                                <div class="flex">
                                                    <a class="card-title mb-4pt"
                                                       href="course.html">Angular Unit Testing</a>
                                                    <div class="d-flex align-items-center">
                                                        <div class="rating mr-8pt">

                                                            <span class="rating__item"><span class="material-icons">star</span></span>

                                                            <span class="rating__item"><span class="material-icons">star</span></span>

                                                            <span class="rating__item"><span class="material-icons">star</span></span>

                                                            <span class="rating__item"><span class="material-icons">star</span></span>

                                                            <span class="rating__item"><span class="material-icons">star_border</span></span>

                                                        </div>
                                                        <small class="text-muted">4/5</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 card-group-row__col">
                                        <div class="card card-sm card-group-row__card">
                                            <div class="card-body d-flex align-items-center">
                                                <a href="course.html"
                                                   class="avatar avatar-4by3 overlay overlay--primary mr-12pt">
                                                    <img src="public/images/paths/typescript_200x168.png"
                                                         alt="Introduction to TypeScript"
                                                         class="avatar-img rounded">
                                                    <span class="overlay__content"></span>
                                                </a>
                                                <div class="flex">
                                                    <a class="card-title mb-4pt"
                                                       href="course.html">Introduction to TypeScript</a>
                                                    <div class="d-flex align-items-center">
                                                        <div class="rating mr-8pt">

                                                            <span class="rating__item"><span class="material-icons">star</span></span>

                                                            <span class="rating__item"><span class="material-icons">star</span></span>

                                                            <span class="rating__item"><span class="material-icons">star</span></span>

                                                            <span class="rating__item"><span class="material-icons">star</span></span>

                                                            <span class="rating__item"><span class="material-icons">star</span></span>

                                                        </div>
                                                        <small class="text-muted">5/5</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 card-group-row__col">
                                        <div class="card card-sm card-group-row__card">
                                            <div class="card-body d-flex align-items-center">
                                                <a href="course.html"
                                                   class="avatar avatar-4by3 overlay overlay--primary mr-12pt">
                                                    <img src="public/images/paths/angular_200x168.png"
                                                         alt="Learn Angular Fundamentals"
                                                         class="avatar-img rounded">
                                                    <span class="overlay__content"></span>
                                                </a>
                                                <div class="flex">
                                                    <a class="card-title mb-4pt"
                                                       href="course.html">Learn Angular Fundamentals</a>
                                                    <div class="d-flex align-items-center">
                                                        <div class="rating mr-8pt">

                                                            <span class="rating__item"><span class="material-icons">star</span></span>

                                                            <span class="rating__item"><span class="material-icons">star</span></span>

                                                            <span class="rating__item"><span class="material-icons">star</span></span>

                                                            <span class="rating__item"><span class="material-icons">star</span></span>

                                                            <span class="rating__item"><span class="material-icons">star</span></span>

                                                        </div>
                                                        <small class="text-muted">5/5</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex mb-1">
                                            <div class="avatar avatar-sm mr-3">
                                                <!-- <img src="../../public/images/people/50/guy-2.jpg" alt="Avatar" class="avatar-img rounded-circle"> -->
                                                <span class="avatar-title rounded-circle">LB</span>
                                            </div>
                                            <div class="flex">
                                                <div class="d-flex align-items-center mb-1">
                                                    <strong class="card-title">Laza Bogdan</strong>
                                                    <small class="ml-auto text-muted">3 days ago</small>
                                                </div>
                                                <div>
                                                    <p class="measure-lead">Thanks for contributing to the release of LearnPlus - Learning Management Template <a href="">https://www.frontendmatter.com/themes/learnpl...</a> 🔥</p>
                                                    <p><a href="">#themeforest</a> <a href="">#EnvatoMarket</a></p>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <a href=""
                                               class="text-muted d-flex align-items-center text-decoration-0"><i class="material-icons mr-1"
                                                   style="font-size: inherit;">favorite_border</i> 26</a>
                                            <a href=""
                                               class="text-muted d-flex align-items-center text-decoration-0 ml-3"><i class="material-icons mr-1"
                                                   style="font-size: inherit;">thumb_up</i> 123</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex mb-1">
                                            <div class="avatar avatar-sm mr-3">
                                                <!-- <img src="../../public/images/people/50/woman-5.jpg" alt="Avatar" class="avatar-img rounded-circle"> -->
                                                <span class="avatar-title rounded-circle">LB</span>
                                            </div>
                                            <div class="flex">
                                                <div class="d-flex align-items-center mb-1">
                                                    <strong class="card-title">Laza Bogdan</strong>
                                                    <small class="ml-auto text-muted">4 days ago</small>
                                                </div>
                                                <div>
                                                    <p class="measure-lead">Checkout our new JVC camera course on <a href="">https://t.co/Wh7jE0yz4h</a> 😉
                                                </div>

                                                <a href=""
                                                   class="card my-3 text-body text-decoration-0 measure-lead">
                                                    <img src="images/256_rsz_phil-hearing-769014-unsplash.jpg"
                                                         alt="image"
                                                         class="card-img-top">
                                                    <span class="card-footer d-flex flex-column">
                                                        <strong>Learn How To Operate a JVC Camera</strong>
                                                        <span class="text-70">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span>
                                                        <span class="text-muted">frontendmatter.com</span>
                                                    </span>
                                                </a>

                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <a href=""
                                               class="text-muted d-flex align-items-center text-decoration-0"><i class="material-icons mr-1"
                                                   style="font-size: inherit;">favorite_border</i> 156</a>
                                            <a href=""
                                               class="text-muted d-flex align-items-center text-decoration-0 ml-3"><i class="material-icons mr-1"
                                                   style="font-size: inherit;">thumb_up</i> 351</a>
                                        </div>
                                    </div>
                                </div>

                                <a href=""
                                   class="btn btn-block btn-light mb-32pt">Load more ...</a>

                            </div>
                            <div class="col-lg-4">

                                <h4>About me</h4>
                                <p class="text-70 mb-24pt">Fueled by my passion for understanding the nuances of cross-cultural advertising, I consider myself a forever student, eager to both build on my academic foundations in psychology and sociology and stay in tune with the latest digital marketing strategies through continued coursework.</p>

                                <h4>Connect</h4>
                                <p class="text-70">I’m currently working as a freelance marketing director and always interested in a challenge. Here’s how to reach out and connect.</p>
                                <div class="d-flex align-items-center mb-24pt">
                                    <a href=""
                                       class="text-accent fab fa-facebook-square font-size-24pt mr-8pt"></a>
                                    <a href=""
                                       class="text-accent fab fa-twitter-square font-size-24pt"></a>
                                </div>

                                <div class="page-separator">
                                    <div class="page-separator__text">Recommended</div>
                                </div>

                                <div class="mb-8pt d-flex align-items-center">
                                    <a href="student-course.html"
                                       class="avatar avatar-4by3 overlay overlay--primary mr-12pt">
                                        <img src="../../public/images/paths/angular_routing_200x168.png"
                                             alt="Angular Routing In-Depth"
                                             class="avatar-img rounded">
                                        <span class="overlay__content"></span>
                                    </a>
                                    <div class="flex">
                                        <a class="card-title mb-4pt"
                                           href="student-course.html">Angular Routing In-Depth</a>
                                        <div class="d-flex align-items-center">
                                            <div class="rating mr-8pt">

                                                <span class="rating__item"><span class="material-icons">star</span></span>

                                                <span class="rating__item"><span class="material-icons">star</span></span>

                                                <span class="rating__item"><span class="material-icons">star</span></span>

                                                <span class="rating__item"><span class="material-icons">star_border</span></span>

                                                <span class="rating__item"><span class="material-icons">star_border</span></span>

                                            </div>
                                            <small class="text-muted">3/5</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-16pt d-flex align-items-center">
                                    <a href="student-course.html"
                                       class="avatar avatar-4by3 overlay overlay--primary mr-12pt">
                                        <img src="../../public/images/paths/angular_testing_200x168.png"
                                             alt="Angular Unit Testing"
                                             class="avatar-img rounded">
                                        <span class="overlay__content"></span>
                                    </a>
                                    <div class="flex">
                                        <a class="card-title mb-4pt"
                                           href="student-course.html">Angular Unit Testing</a>
                                        <div class="d-flex align-items-center">
                                            <div class="rating mr-8pt">

                                                <span class="rating__item"><span class="material-icons">star</span></span>

                                                <span class="rating__item"><span class="material-icons">star</span></span>

                                                <span class="rating__item"><span class="material-icons">star</span></span>

                                                <span class="rating__item"><span class="material-icons">star</span></span>

                                                <span class="rating__item"><span class="material-icons">star_border</span></span>

                                            </div>
                                            <small class="text-muted">4/5</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="list-group list-group-flush">
                                    <div class="list-group-item px-0">
                                        <a href="student-course.html"
                                           class="card-title mb-4pt">Angular Best Practices</a>
                                        <p class="lh-1 mb-0">
                                            <small class="text-muted mr-8pt">6h 40m</small>
                                            <small class="text-muted mr-8pt">13,876 Views</small>
                                            <small class="text-muted">13 May 2018</small>
                                        </p>
                                    </div>
                                    <div class="list-group-item px-0">
                                        <a href="student-course.html"
                                           class="card-title mb-4pt">Unit Testing in Angular</a>
                                        <p class="lh-1 mb-0">
                                            <small class="text-muted mr-8pt">6h 40m</small>
                                            <small class="text-muted mr-8pt">13,876 Views</small>
                                            <small class="text-muted">13 May 2018</small>
                                        </p>
                                    </div>
                                    <div class="list-group-item px-0">
                                        <a href="student-course.html"
                                           class="card-title mb-4pt">Migrating Applications from AngularJS to Angular</a>
                                        <p class="lh-1 mb-0">
                                            <small class="text-muted mr-8pt">6h 40m</small>
                                            <small class="text-muted mr-8pt">13,876 Views</small>
                                            <small class="text-muted">13 May 2018</small>
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <!-- // END Header Layout Content -->

            <!-- Footer -->

            <div class="bg-dark border-top-2 mt-auto">
                <div class="container page__container page-section d-flex flex-column">
                    <p class="text-white-70 brand mb-24pt">
                        <img class="brand-icon"
                             src="images/plus-goal-logo.svg"
                             width="150"
                             alt="Luma"> 
                    </p>
                    <p class="measure-lead-max text-white-50 small mr-8pt">Luma is a beautifully crafted user interface for modern Education Platforms, including Courses & Tutorials, Video Lessons, Student and Teacher Dashboard, Curriculum Management, Earnings and Reporting, ERP, HR, CMS, Tasks, Projects, eCommerce and more.</p>
                    <p class="mb-8pt d-flex">
                        <a href=""
                           class="text-white-70 text-underline mr-8pt small">Terms</a>
                        <a href=""
                           class="text-white-70 text-underline small">Privacy policy</a>
                    </p>
                    <p class="text-white-50 small mt-n1 mb-0">Copyright 2019 &copy; All rights reserved.</p>
                </div>
            </div>

            <!-- // END Footer -->

        </div>
        <!-- // END Header Layout -->

        <!-- Drawer -->

        <div class="mdk-drawer js-mdk-drawer"
             id="default-drawer">
            <div class="mdk-drawer__content">
                <div class="sidebar sidebar-light sidebar-light-dodger-blue sidebar-left"
                     data-perfect-scrollbar>

                    <!-- Sidebar Content -->

                    <a href="index.html"
                       class="sidebar-brand ">
                        <!-- <img class="sidebar-brand-icon" src="../../public/images/illustration/student/128/white.svg" alt="Luma"> -->

                        <span class="avatar avatar-xl sidebar-brand-icon h-auto">

                            <span class="avatar-title rounded bg-primary"><img src="images/white.svg"
                                     class="img-fluid"
                                     alt="logo" /></span>

                        </span>

                        <span>Luma</span>
                    </a>

                    <div class="sidebar-heading">Applications</div>
                    <ul class="sidebar-menu">

                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button js-sidebar-collapse"
                               data-toggle="collapse"
                               href="#student_menu">
                                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">school</span>
                                Student
                                <span class="ml-auto sidebar-menu-toggle-icon"></span>
                            </a>
                            <ul class="sidebar-submenu collapse sm-indent"
                                id="student_menu">

                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="index.html">

                                        <span class="sidebar-menu-text">Home</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="courses.html">

                                        <span class="sidebar-menu-text">Browse Courses</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="paths.html">

                                        <span class="sidebar-menu-text">Browse Paths</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="student-dashboard.html">

                                        <span class="sidebar-menu-text">Student Dashboard</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="student-my-courses.html">

                                        <span class="sidebar-menu-text">My Courses</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="student-paths.html">

                                        <span class="sidebar-menu-text">My Paths</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="student-path.html">

                                        <span class="sidebar-menu-text">Path Details</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="student-course.html">

                                        <span class="sidebar-menu-text">Course Preview</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="student-lesson.html">

                                        <span class="sidebar-menu-text">Lesson Preview</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="student-take-course.html">

                                        <span class="sidebar-menu-text">Take Course</span>
                                        <span class="sidebar-menu-badge badge badge-accent badge-notifications ml-auto">PRO</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="student-take-lesson.html">

                                        <span class="sidebar-menu-text">Take Lesson</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="student-take-quiz.html">

                                        <span class="sidebar-menu-text">Take Quiz</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="student-quiz-results.html">

                                        <span class="sidebar-menu-text">My Quizzes</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="student-quiz-result-details.html">

                                        <span class="sidebar-menu-text">Quiz Result</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="student-path-assessment.html">

                                        <span class="sidebar-menu-text">Skill Assessment</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="student-path-assessment-result.html">

                                        <span class="sidebar-menu-text">Skill Result</span>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button js-sidebar-collapse"
                               data-toggle="collapse"
                               href="#instructor_menu">
                                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">format_shapes</span>
                                Instructor
                                <span class="ml-auto sidebar-menu-toggle-icon"></span>
                            </a>
                            <ul class="sidebar-submenu collapse sm-indent"
                                id="instructor_menu">

                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="instructor-dashboard.html">

                                        <span class="sidebar-menu-text">Instructor Dashboard</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="instructor-courses.html">

                                        <span class="sidebar-menu-text">Manage Courses</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="instructor-quizzes.html">

                                        <span class="sidebar-menu-text">Manage Quizzes</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="instructor-earnings.html">

                                        <span class="sidebar-menu-text">Earnings</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="instructor-statement.html">

                                        <span class="sidebar-menu-text">Statement</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="instructor-edit-course.html">

                                        <span class="sidebar-menu-text">Edit Course</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="instructor-edit-quiz.html">

                                        <span class="sidebar-menu-text">Edit Quiz</span>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <li class="sidebar-menu-item active open">
                            <a class="sidebar-menu-button"
                               data-toggle="collapse"
                               href="#community_menu">
                                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">people_outline</span>
                                Community
                                <span class="ml-auto sidebar-menu-toggle-icon"></span>
                            </a>
                            <ul class="sidebar-submenu collapse show sm-indent"
                                id="community_menu">
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="teachers.html">

                                        <span class="sidebar-menu-text">Browse Teachers</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="student-profile.html">

                                        <span class="sidebar-menu-text">Student Profile</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item active">
                                    <a class="sidebar-menu-button"
                                       href="teacher-profile.html">

                                        <span class="sidebar-menu-text">Teacher Profile</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="blog.html">

                                        <span class="sidebar-menu-text">Blog</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="blog-post.html">

                                        <span class="sidebar-menu-text">Blog Post</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="faq.html">
                                        <span class="sidebar-menu-text">FAQ</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="help-center.html">
                                        <!--  -->
                                        <span class="sidebar-menu-text">Help Center</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="discussions.html">
                                        <span class="sidebar-menu-text">Discussions</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="discussion.html">
                                        <span class="sidebar-menu-text">Discussion Details</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="discussions-ask.html">
                                        <span class="sidebar-menu-text">Ask Question</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>

                    <!-- // END Sidebar Content -->

                </div>
            </div>
        </div>

        <!-- // END Drawer -->

        <!-- jQuery -->
        <!-- <script src="../../public/vendor/jquery.min.js"></script> -->
        <script src="{{asset('vendor/jquery.min.js')}}"></script>

        <!-- Bootstrap -->
        <!-- <script src="../../public/vendor/popper.min.js"></script>
        <script src="../../public/vendor/bootstrap.min.js"></script> -->
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