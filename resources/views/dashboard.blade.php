
<!DOCTYPE html>
<html lang="en"
      dir="ltr">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible"
              content="IE=edge">
        <meta name="viewport"
              content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Dashboard</title>

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
                                <!-- <li class="nav-item dropdown">
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
                                </li> -->
                                <!-- <li class="nav-item">
                                    <a href="pricing.html"
                                       class="nav-link">Pricing</a>
                                </li> -->
                                <li class="nav-item dropdown active">
                                    <a href="#"
                                       class="nav-link dropdown-toggle"
                                       data-toggle="dropdown"
                                       data-caret="false">Teachers</a>
                                    <div class="dropdown-menu">
                                        <a href="instructor-dashboard.html"
                                           class="dropdown-item active">Instructor Dashboard</a>
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
                                <li class="nav-item dropdown"
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
                                           class="dropdown-item">Instructor Profile</a>
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

                            <div class="nav navbar-nav ml-auto mr-0 flex-nowrap d-flex">

                                <!-- Notifications dropdown -->
                                <div class="nav-item dropdown dropdown-notifications dropdown-xs-down-full"
                                     data-toggle="tooltip"
                                     data-title="Messages"
                                     data-placement="bottom"
                                     data-boundary="window">
                                    <button class="nav-link btn-flush dropdown-toggle"
                                            type="button"
                                            data-toggle="dropdown"
                                            data-caret="false">
                                        <i class="material-icons icon-24pt">mail_outline</i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <div data-perfect-scrollbar
                                             class="position-relative">
                                            <div class="dropdown-header"><strong>Messages</strong></div>
                                            <div class="list-group list-group-flush mb-0">

                                                <a href="javascript:void(0);"
                                                   class="list-group-item list-group-item-action unread">
                                                    <span class="d-flex align-items-center mb-1">
                                                        <small class="text-black-50">5 minutes ago</small>

                                                        <span class="ml-auto unread-indicator bg-accent"></span>

                                                    </span>
                                                    <span class="d-flex">
                                                        <span class="avatar avatar-xs mr-2">
                                                            <img src="../../public/images/people/110/woman-5.jpg"
                                                                 alt="people"
                                                                 class="avatar-img rounded-circle">
                                                        </span>
                                                        <span class="flex d-flex flex-column">
                                                            <strong class="text-black-100">Michelle</strong>
                                                            <span class="text-black-70">Clients loved the new design.</span>
                                                        </span>
                                                    </span>
                                                </a>

                                                <a href="javascript:void(0);"
                                                   class="list-group-item list-group-item-action">
                                                    <span class="d-flex align-items-center mb-1">
                                                        <small class="text-black-50">5 minutes ago</small>

                                                    </span>
                                                    <span class="d-flex">
                                                        <span class="avatar avatar-xs mr-2">
                                                            <img src="../../public/images/people/110/woman-5.jpg"
                                                                 alt="people"
                                                                 class="avatar-img rounded-circle">
                                                        </span>
                                                        <span class="flex d-flex flex-column">
                                                            <strong class="text-black-100">Michelle</strong>
                                                            <span class="text-black-70">🔥 Superb job..</span>
                                                        </span>
                                                    </span>
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- // END Notifications dropdown -->

                                <!-- Notifications dropdown -->
                                <div class="nav-item ml-16pt dropdown dropdown-notifications dropdown-xs-down-full"
                                     data-toggle="tooltip"
                                     data-title="Notifications"
                                     data-placement="bottom"
                                     data-boundary="window">
                                    <button class="nav-link btn-flush dropdown-toggle"
                                            type="button"
                                            data-toggle="dropdown"
                                            data-caret="false">
                                        <i class="material-icons">notifications_none</i>
                                        <span class="badge badge-notifications badge-accent">2</span>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <div data-perfect-scrollbar
                                             class="position-relative">
                                            <div class="dropdown-header"><strong>System notifications</strong></div>
                                            <div class="list-group list-group-flush mb-0">

                                                <a href="javascript:void(0);"
                                                   class="list-group-item list-group-item-action unread">
                                                    <span class="d-flex align-items-center mb-1">
                                                        <small class="text-black-50">3 minutes ago</small>

                                                        <span class="ml-auto unread-indicator bg-accent"></span>

                                                    </span>
                                                    <span class="d-flex">
                                                        <span class="avatar avatar-xs mr-2">
                                                            <span class="avatar-title rounded-circle bg-light">
                                                                <i class="material-icons font-size-16pt text-accent">account_circle</i>
                                                            </span>
                                                        </span>
                                                        <span class="flex d-flex flex-column">

                                                            <span class="text-black-70">Your profile information has not been synced correctly.</span>
                                                        </span>
                                                    </span>
                                                </a>

                                                <a href="javascript:void(0);"
                                                   class="list-group-item list-group-item-action">
                                                    <span class="d-flex align-items-center mb-1">
                                                        <small class="text-black-50">5 hours ago</small>

                                                    </span>
                                                    <span class="d-flex">
                                                        <span class="avatar avatar-xs mr-2">
                                                            <span class="avatar-title rounded-circle bg-light">
                                                                <i class="material-icons font-size-16pt text-primary">group_add</i>
                                                            </span>
                                                        </span>
                                                        <span class="flex d-flex flex-column">
                                                            <strong class="text-black-100">Adrian. D</strong>
                                                            <span class="text-black-70">Wants to join your private group.</span>
                                                        </span>
                                                    </span>
                                                </a>

                                                <a href="javascript:void(0);"
                                                   class="list-group-item list-group-item-action">
                                                    <span class="d-flex align-items-center mb-1">
                                                        <small class="text-black-50">1 day ago</small>

                                                    </span>
                                                    <span class="d-flex">
                                                        <span class="avatar avatar-xs mr-2">
                                                            <span class="avatar-title rounded-circle bg-light">
                                                                <i class="material-icons font-size-16pt text-warning">storage</i>
                                                            </span>
                                                        </span>
                                                        <span class="flex d-flex flex-column">

                                                            <span class="text-black-70">Your deploy was successful.</span>
                                                        </span>
                                                    </span>
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- // END Notifications dropdown -->

                                <div class="nav-item dropdown">
                                    <a href="#"
                                       class="nav-link d-flex align-items-center dropdown-toggle"
                                       data-toggle="dropdown"
                                       data-caret="false">

                                        <span class="avatar avatar-sm mr-8pt2">

                                            <span class="avatar-title rounded-circle bg-primary"><i class="material-icons">account_box</i></span>

                                        </span>

                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <div class="dropdown-header"><strong>Account</strong></div>
                                        <a class="dropdown-item"
                                           href="edit-account.html">Edit Account</a>
                                        <a class="dropdown-item"
                                           href="billing.html">Billing</a>
                                        <a class="dropdown-item"
                                           href="billing-history.html">Payments</a>
                                        <a class="dropdown-item"
                                           href="login.html">Logout</a>
                                    </div>
                                </div>
                            </div>

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
                            <div class="flex d-flex flex-column align-items-center align-items-lg-start mb-16pt mb-lg-0 text-center text-lg-left">
                                <h1 class="h2 mb-8pt">Dashboard</h1>
                                <!-- <div>

                                    <span class="chip chip-outline-secondary d-inline-flex align-items-center"
                                          data-toggle="tooltip"
                                          data-title="Earnings"
                                          data-placement="bottom">
                                        <i class="material-icons icon--left">trending_up</i> &dollar;12.3k
                                    </span>
                                    <span class="chip chip-outline-secondary d-inline-flex align-items-center"
                                          data-toggle="tooltip"
                                          data-title="Sales"
                                          data-placement="bottom">
                                        <i class="material-icons icon--left">receipt</i> 264
                                    </span>

                                </div> -->
                            </div>
                            <div class="ml-lg-16pt">
                                <a href="teacher-profile.html"
                                   class="btn btn-light">My Profile</a>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="page-section">
                    <div class="container page__container">

                        <div class="row">
                            <div class="col-lg-8">

                                <!-- <div class="mb-24pt">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="card border-1 border-left-3 border-left-accent text-center mb-lg-0">
                                                <div class="card-body">
                                                    <h4 class="h2 mb-0">&dollar;1,569.00</h4>
                                                    <div>Earnings this month</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="card text-center mb-lg-0">
                                                <div class="card-body">
                                                    <h4 class="h2 mb-0">&dollar;3,917.80</h4>
                                                    <div>Account Balance</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="card text-center mb-lg-0">
                                                <div class="card-body">
                                                    <h4 class="h2 mb-0">&dollar;10,211.50</h4>
                                                    <div>Total Sales</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->

                                <div class="page-separator">
                                    <div class="page-separator__text">Earnings</div>
                                </div>
                                <div class="card card-body mb-32pt">
                                    <!-- <div id="legend"
                                         class="chart-legend mt-0 mb-24pt justify-content-start"></div>
                                    <div class="chart"
                                         style="height: 320px;">
                                        <canvas id="earningsChart"
                                                class="chart-canvas js-update-chart-bar"
                                                data-chart-legend="#legend"
                                                data-chart-line-background-color="gradient:primary,gray"
                                                data-chart-prefix="$"
                                                data-chart-suffix="k"></canvas>
                                    </div> -->
                                </div>

                                <div class="page-separator">
                                    <div class="page-separator__text">Transactions</div>
                                </div>
                                <div class="card">
                                    <div data-toggle="lists"
                                         data-lists-values='[
                                            "js-lists-values-course", 
                                            "js-lists-values-document",
                                            "js-lists-values-amount",
                                            "js-lists-values-date"
                                            ]'
                                         data-lists-sort-by="js-lists-values-date"
                                         data-lists-sort-desc="true"
                                         class="table-responsive">
                                        <table class="table table-flush table-nowrap">
                                            <!-- <thead>
                                                <tr>
                                                    <th colspan="2">
                                                        <a href="javascript:void(0)"
                                                           class="sort"
                                                           data-sort="js-lists-values-course">Course</a>
                                                        <a href="javascript:void(0)"
                                                           class="sort"
                                                           data-sort="js-lists-values-document">Document</a>
                                                        <a href="javascript:void(0)"
                                                           class="sort"
                                                           data-sort="js-lists-values-amount">Amount</a>
                                                        <a href="javascript:void(0)"
                                                           class="sort"
                                                           data-sort="js-lists-values-date">Date</a>
                                                    </th>
                                                </tr>
                                            </thead> -->
                                            <tbody class="list">

                                                <!-- <tr>
                                                    <td>
                                                        <div class="d-flex flex-nowrap align-items-center">
                                                            <a href="instructor-edit-course.html"
                                                               class="avatar avatar-4by3 overlay overlay--primary mr-12pt">
                                                                <img src="../../public/images/paths/angular_routing_200x168.png"
                                                                     alt="course"
                                                                     class="avatar-img rounded">
                                                                <span class="overlay__content"></span>
                                                            </a>
                                                            <div class="flex">
                                                                <a class="card-title js-lists-values-course"
                                                                   href="instructor-edit-course.html">Angular Routing In-Depth</a>
                                                                <small class="text-muted mr-1">
                                                                    Invoice
                                                                    <a href="invoice.html"
                                                                       style="color: inherit;"
                                                                       class="js-lists-values-document">#8734</a> -
                                                                    &dollar;<span class="js-lists-values-amount">89</span> USD
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-right">
                                                        <small class="text-muted text-uppercase js-lists-values-date">12 Nov 2018</small>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div class="d-flex flex-nowrap align-items-center">
                                                            <a href="instructor-edit-course.html"
                                                               class="avatar avatar-4by3 overlay overlay--primary mr-12pt">
                                                                <img src="../../public/images/paths/angular_testing_200x168.png"
                                                                     alt="course"
                                                                     class="avatar-img rounded">
                                                                <span class="overlay__content"></span>
                                                            </a>
                                                            <div class="flex">
                                                                <a class="card-title js-lists-values-course"
                                                                   href="instructor-edit-course.html">Angular Unit Testing</a>
                                                                <small class="text-muted mr-1">
                                                                    Invoice
                                                                    <a href="invoice.html"
                                                                       style="color: inherit;"
                                                                       class="js-lists-values-document">#8735</a> -
                                                                    &dollar;<span class="js-lists-values-amount">89</span> USD
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-right">
                                                        <small class="text-muted text-uppercase js-lists-values-date">13 Nov 2018</small>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div class="d-flex flex-nowrap align-items-center">
                                                            <a href="instructor-edit-course.html"
                                                               class="avatar avatar-4by3 overlay overlay--primary mr-12pt">
                                                                <img src="../../public/images/paths/typescript_200x168.png"
                                                                     alt="course"
                                                                     class="avatar-img rounded">
                                                                <span class="overlay__content"></span>
                                                            </a>
                                                            <div class="flex">
                                                                <a class="card-title js-lists-values-course"
                                                                   href="instructor-edit-course.html">Introduction to TypeScript</a>
                                                                <small class="text-muted mr-1">
                                                                    Invoice
                                                                    <a href="invoice.html"
                                                                       style="color: inherit;"
                                                                       class="js-lists-values-document">#8736</a> -
                                                                    &dollar;<span class="js-lists-values-amount">89</span> USD
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-right">
                                                        <small class="text-muted text-uppercase js-lists-values-date">14 Nov 2018</small>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div class="d-flex flex-nowrap align-items-center">
                                                            <a href="instructor-edit-course.html"
                                                               class="avatar avatar-4by3 overlay overlay--primary mr-12pt">
                                                                <img src="../../public/images/paths/angular_200x168.png"
                                                                     alt="course"
                                                                     class="avatar-img rounded">
                                                                <span class="overlay__content"></span>
                                                            </a>
                                                            <div class="flex">
                                                                <a class="card-title js-lists-values-course"
                                                                   href="instructor-edit-course.html">Learn Angular Fundamentals</a>
                                                                <small class="text-muted mr-1">
                                                                    Invoice
                                                                    <a href="invoice.html"
                                                                       style="color: inherit;"
                                                                       class="js-lists-values-document">#8737</a> -
                                                                    &dollar;<span class="js-lists-values-amount">89</span> USD
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-right">
                                                        <small class="text-muted text-uppercase js-lists-values-date">15 Nov 2018</small>
                                                    </td>
                                                </tr> -->

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="page-separator">
                                    <div class="page-separator__text">Comments</div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-left mr-12pt">
                                                <!-- <a href="#"
                                                   class="avatar avatar-sm"> -->
                                                    <!-- <img src="../../public/images/people/110/guy-9.jpg" alt="Guy" class="avatar-img rounded-circle"> -->
                                                    <!-- <span class="avatar-title rounded-circle">LB</span>
                                                </a> -->
                                            </div>
                                            <div class="media-body d-flex flex-column">
                                                <div class="d-flex align-items-center">
                                                    <!-- <a href="profile.html"
                                                       class="card-title">Laza Bogdan</a>
                                                    <small class="ml-auto text-muted">27 min ago</small><br> -->
                                                </div>
                                                <span class="text-muted">on <a href="instructor-edit-course.html"
                                                       class="text-50"
                                                       style="text-decoration: underline;">Data Visualization With Chart.js</a></span>
                                                <p class="mt-1 mb-0 text-70">How can I load Charts on a page?</p>
                                            </div>
                                        </div>
                                        <div class="media ml-sm-32pt mt-3 border rounded p-3 card mb-0 d-inline-flex measure-paragraph-max">
                                            <div class="media-left mr-12pt">
                                                <a href="#"
                                                   class="avatar avatar-sm">
                                                    <!-- <img src="../../public/images/people/110/guy-6.jpg" alt="Guy" class="avatar-img rounded-circle"> -->
                                                    <span class="avatar-title rounded-circle">FM</span>
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <div class="d-flex align-items-center">
                                                    <a href="profile.html"
                                                       class="card-title">FrontendMatter</a>
                                                    <small class="ml-auto text-muted">just now</small>
                                                </div>
                                                <p class="mt-1 mb-0 text-70">Hi Bogdan,<br> Thank you for purchasing our course! <br><br>Please have a look at the charts library documentation <a href="#"
                                                       class="text-underline">here</a> and follow the instructions.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <form action="#"
                                              id="message-reply">
                                            <div class="input-group input-group-merge">
                                                <input type="text"
                                                       class="form-control form-control-appended"
                                                       required=""
                                                       placeholder="Quick Reply">
                                                <div class="input-group-append">
                                                    <div class="input-group-text pr-2">
                                                        <button class="btn btn-flush"
                                                                type="button"><i class="material-icons">tag_faces</i></button>
                                                    </div>
                                                    <div class="input-group-text pl-0">
                                                        <div class="custom-file custom-file-naked d-flex"
                                                             style="width: 24px; overflow: hidden;">
                                                            <input type="file"
                                                                   class="custom-file-input"
                                                                   id="customFile">
                                                            <label class="custom-file-label"
                                                                   style="color: inherit;"
                                                                   for="customFile">
                                                                <i class="material-icons">attach_file</i>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="input-group-text pl-0">
                                                        <button class="btn btn-flush"
                                                                type="button"><i class="material-icons">send</i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-4">

                                <!-- <div class="accordion js-accordion accordion--boxed mb-24pt"
                                     id="instructor-accordion">
                                    <div class="accordion__item">
                                        <a href="#"
                                           class="accordion__toggle collapsed"
                                           data-toggle="collapse"
                                           data-target="#instructor-accordion-menu"
                                           data-parent="#instructor-accordion">
                                            <span class="flex">My Account</span>
                                            <span class="accordion__toggle-icon material-icons">keyboard_arrow_down</span>
                                        </a>
                                        <div class="accordion__menu collapse"
                                             id="instructor-accordion-menu">
                                            <div class="accordion__menu-link active">
                                                <span class="icon-holder icon-holder--small icon-holder--light rounded-circle d-inline-flex icon--left">
                                                    <i class="material-icons icon-16pt">school</i>
                                                </span>
                                                <a class="flex"
                                                   href="instructor-dashboard.html">Dashboard</a>
                                            </div>
                                            <div class="accordion__menu-link">
                                                <span class="icon-holder icon-holder--small icon-holder--light rounded-circle d-inline-flex icon--left">
                                                    <i class="material-icons icon-16pt">import_contacts</i>
                                                </span>
                                                <a class="flex"
                                                   href="instructor-courses.html">Manage Courses</a>
                                            </div>
                                            <div class="accordion__menu-link">
                                                <span class="icon-holder icon-holder--small icon-holder--light rounded-circle d-inline-flex icon--left">
                                                    <i class="material-icons icon-16pt">help</i>
                                                </span>
                                                <a class="flex"
                                                   href="instructor-quizzes.html">Manage Quizzes</a>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->

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
                             src="../../public/images/logo/white-100@2x.png"
                             width="30"
                             alt="Luma"> Luma
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
                        <!-- <img class="sidebar-brand-icon" src="../../public/images/illustration/teacher/128/white.svg" alt="Luma"> -->

                        <span class="avatar avatar-xl sidebar-brand-icon h-auto">

                            <span class="avatar-title rounded bg-primary"><img src="../../public/images/illustration/teacher/128/white.svg"
                                     class="img-fluid"
                                     alt="logo" /></span>

                        </span>

                        <span>Luma</span>
                    </a>

                    <div class="sidebar-heading">Instructor</div>
                    <ul class="sidebar-menu">

                        <li class="sidebar-menu-item active">
                            <a class="sidebar-menu-button"
                               href="instructor-dashboard.html">
                                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">school</span>
                                <span class="sidebar-menu-text">Instructor Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button"
                               href="instructor-courses.html">
                                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">import_contacts</span>
                                <span class="sidebar-menu-text">Manage Courses</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button"
                               href="instructor-quizzes.html">
                                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">help</span>
                                <span class="sidebar-menu-text">Manage Quizzes</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button"
                               href="instructor-earnings.html">
                                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">trending_up</span>
                                <span class="sidebar-menu-text">Earnings</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button"
                               href="instructor-statement.html">
                                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">receipt</span>
                                <span class="sidebar-menu-text">Statement</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button"
                               href="instructor-edit-course.html">
                                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">post_add</span>
                                <span class="sidebar-menu-text">Edit Course</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button"
                               href="instructor-edit-quiz.html">
                                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">format_shapes</span>
                                <span class="sidebar-menu-text">Edit Quiz</span>
                            </a>
                        </li>

                    </ul>
                    <div class="sidebar-heading">Student</div>
                    <ul class="sidebar-menu">

                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button"
                               href="index.html">
                                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">home</span>
                                <span class="sidebar-menu-text">Home</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button"
                               href="courses.html">
                                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">local_library</span>
                                <span class="sidebar-menu-text">Browse Courses</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button"
                               href="paths.html">
                                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">style</span>
                                <span class="sidebar-menu-text">Browse Paths</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button"
                               href="student-dashboard.html">
                                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">account_box</span>
                                <span class="sidebar-menu-text">Student Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button"
                               href="student-my-courses.html">
                                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">search</span>
                                <span class="sidebar-menu-text">My Courses</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button"
                               href="student-paths.html">
                                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">timeline</span>
                                <span class="sidebar-menu-text">My Paths</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button"
                               href="student-path.html">
                                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">change_history</span>
                                <span class="sidebar-menu-text">Path Details</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button"
                               href="student-course.html">
                                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">face</span>
                                <span class="sidebar-menu-text">Course Preview</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button"
                               href="student-lesson.html">
                                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">panorama_fish_eye</span>
                                <span class="sidebar-menu-text">Lesson Preview</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button"
                               href="student-take-course.html">
                                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">class</span>
                                <span class="sidebar-menu-text">Take Course</span>
                                <span class="sidebar-menu-badge badge badge-accent badge-notifications ml-auto">PRO</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button"
                               href="student-take-lesson.html">
                                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">import_contacts</span>
                                <span class="sidebar-menu-text">Take Lesson</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button"
                               href="student-take-quiz.html">
                                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">dvr</span>
                                <span class="sidebar-menu-text">Take Quiz</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button"
                               href="student-quiz-results.html">
                                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">poll</span>
                                <span class="sidebar-menu-text">My Quizzes</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button"
                               href="student-quiz-result-details.html">
                                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">live_help</span>
                                <span class="sidebar-menu-text">Quiz Result</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button"
                               href="student-path-assessment.html">
                                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">layers</span>
                                <span class="sidebar-menu-text">Skill Assessment</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button"
                               href="student-path-assessment-result.html">
                                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">assignment_turned_in</span>
                                <span class="sidebar-menu-text">Skill Result</span>
                            </a>
                        </li>

                    </ul>

                    <div class="sidebar-heading">Applications</div>
                    <ul class="sidebar-menu">

                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button"
                               data-toggle="collapse"
                               href="#community_menu">
                                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">people_outline</span>
                                Community
                                <span class="ml-auto sidebar-menu-toggle-icon"></span>
                            </a>
                            <ul class="sidebar-submenu collapse sm-indent"
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
                                <li class="sidebar-menu-item">
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

        <!-- Global Settings -->
        <!-- <script src="../../public/js/settings.js"></script> -->
        <script src="{{asset('js/settings.js')}}"></script>

        <!-- Moment.js -->
        <!-- <script src="../../public/vendor/moment.min.js"></script>
        <script src="../../public/vendor/moment-range.js"></script> -->
        <script src="{{asset('vendor/moment.min.js')}}"></script>
        <script src="{{asset('vendor/moment-range.js')}}"></script>

        <!-- Chart.js -->
        <!-- <script src="../../public/vendor/Chart.min.js"></script> -->
        <script src="{{asset('vendor/Chart.min.js')}}"></script>

        <!-- UI Charts Page JS -->
        <!-- <script src="../../public/js/chartjs-rounded-bar.js"></script>
        <script src="../../public/js/chartjs.js"></script> -->
        <script src="{{asset('js/chartjs-rounded-bar.js')}}"></script>
        <script src="{{asset('js/chartjs.js')}}"></script>

        <!-- Chart.js Samples -->
        <!-- <script src="../../public/js/page.instructor-dashboard.js"></script> -->
        <script src="{{asset('js/page.instructor-dashboard.js')}}"></script>

        <!-- List.js -->
        <!-- <script src="../../public/vendor/list.min.js"></script>
        <script src="../../public/js/list.js"></script> -->
        <script src="{{asset('vendor/list.min.js')}}"></script>
        <script src="{{asset('js/list.js')}}"></script>

    </body>

</html>