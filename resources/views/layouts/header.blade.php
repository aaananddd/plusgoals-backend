<!-- Header Contents-->

<div class="preloader">
        <div class="sk-chase">
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
        </div>

    </div>


<div class="mdk-header-layout js-mdk-header-layout">

<!-- Header -->

<div id="header" class="mdk-header js-mdk-header mb-0" data-fixed data-effects="waterfall">
    <div class="mdk-header__content">

        <div class="navbar navbar-expand navbar-light bg-white border-bottom" id="default-navbar" data-primary>
            <div class="container page__container">

                <!-- Navbar Brand -->
                <a href="index.html" class="navbar-brand mr-16pt">

                    <span><img src="{{asset('images/plus-goal-logo.svg')}}" width="150" height="100"></span>

                </a>

                <ul class="nav navbar-nav d-none d-sm-flex flex justify-content-start ml-8pt">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ Request::route()->getName() == 'home' ? 'active-tab' : '' }}">Home</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('taskDetails') }}" class="nav-link {{ Request::route()->getName() == 'taskDetails' ? 'active' : '' }}">Task</a>
                </li>
                <li class="nav-item dropdown ">
                    @if(Session::get('role') == 1)
                    <a href="{{ route('teachers') }}" class="nav-link {{ Request::route()->getName() == 'teachers' ? 'active' : '' }}">Instructors</a>
                    @endif
                </li>
                <li class="nav-item dropdown ">
               
                    <a href="{{ route('students') }}" class="nav-link {{ Request::route()->getName() == 'students' ? 'active' : '' }}">Interns</a>
               
                </li>
                <li class="nav-item dropdown ">
                    <a href="{{ route('GetEmployersList') }}" class="nav-link {{ Request::route()->getName() == 'GetEmployersList' ? 'active' : '' }}">Employers</a>
                </li>
                <li class="nav-item dropdown ">
                    @if(Session::get('role') == 1)
                    <a href="{{ route('tasksPendingForApproval') }}" class="nav-link {{ Request::route()->getName() == 'tasksPendingForApproval' ? 'active' : '' }}">Pending Approval</a>
                    @endif
                </li>
                <li class="nav-item dropdown ">
                    <a href="{{ route('CountAssignedTasks') }}" class="nav-link {{ Request::route()->getName() == 'CountAssignedTasks' ? 'active' : '' }}">Frequent Tasks</a>
                </li>
                <li class="nav-item dropdown ">
                    <a href="{{ route('Others') }}" class="nav-link {{ Request::route()->getName() == 'Others' ? 'active' : '' }}">Others</a>
                </li>
            </ul>



                <div class="nav navbar-nav ml-auto mr-0 flex-nowrap d-flex">

                    <!-- Notifications dropdown -->
                    <div class="nav-item dropdown dropdown-notifications dropdown-xs-down-full"
                        data-toggle="tooltip" data-title="Messages" data-placement="bottom"
                        data-boundary="window">
                  
                        <div class="dropdown-menu dropdown-menu-right">
                            <div data-perfect-scrollbar class="position-relative">
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
                                                    alt="people" class="avatar-img rounded-circle">
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
                                                    alt="people" class="avatar-img rounded-circle">
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
                        data-toggle="tooltip" data-title="Notifications" data-placement="bottom"
                        data-boundary="window">
                       
                        <div class="dropdown-menu dropdown-menu-right">
                            <div data-perfect-scrollbar class="position-relative">
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
                                                    <i
                                                        class="material-icons font-size-16pt text-accent">account_circle</i>
                                                </span>
                                            </span>
                                            <span class="flex d-flex flex-column">

                                                <span class="text-black-70">Your profile information has not
                                                    been synced correctly.</span>
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
                                                    <i
                                                        class="material-icons font-size-16pt text-primary">group_add</i>
                                                </span>
                                            </span>
                                            <span class="flex d-flex flex-column">
                                                <strong class="text-black-100">Adrian. D</strong>
                                                <span class="text-black-70">Wants to join your private
                                                    group.</span>
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
                                                    <i
                                                        class="material-icons font-size-16pt text-warning">storage</i>
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
                        <a href="#" class="nav-link d-flex align-items-center dropdown-toggle"
                            data-toggle="dropdown" data-caret="false">

                            <span class="avatar avatar-sm mr-8pt2">

                                <span class="avatar-title rounded-circle bg-primary"><i
                                        class="material-icons">account_box</i></span>

                            </span>

                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{route('profileView')}}"> <strong>{{ Session::get('user.first_name') }}</strong></a>
                            <a class="dropdown-item" href="{{route('logout')}}">Logout</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>