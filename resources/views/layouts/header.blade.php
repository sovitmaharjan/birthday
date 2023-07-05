<div class="topbar">

    <div class="topbar-left">
        <a href="{{ route('dashboard') }}" class="logo">Test<i class="mdi mdi-layers"></i></a>
    </div>

    <div class="navbar navbar-default" role="navigation">
        <div class="container-fluid">

            <div class="clearfix">
                <!-- Navbar-left -->
                <ul class="nav navbar-left">
                    <li>
                        <button class="button-menu-mobile open-left waves-effect">
                            <i class="mdi mdi-menu"></i>
                        </button>
                    </li>
                </ul>

                <!-- Right(Notification) -->
                <ul class="nav navbar-right">
                    <li class="dropdown user-box">
                        <a href="" class="dropdown-toggle waves-effect user-link" data-toggle="dropdown"
                            aria-expanded="true">
                            <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt="user-img"
                                class="rounded-circle user-img">
                        </a>

                        <ul
                            class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right user-list notify-list">
                            <li>
                                <h5>Hi, John</h5>
                            </li>
                            <li><a href="javascript:void(0)" class="dropdown-item"><i class="ti-user m-r-5"></i>
                                    Profile</a></li>
                            <li><a href="javascript:void(0)" class="dropdown-item"><i class="ti-settings m-r-5"></i>
                                    Settings</a></li>
                            <li><a href="javascript:void(0)" class="dropdown-item"><i class="ti-lock m-r-5"></i> Lock
                                    screen</a></li>
                            <li><a href="javascript:void(0)" class="dropdown-item"><i class="ti-power-off m-r-5"></i>
                                    Logout</a></li>
                        </ul>
                    </li>

                </ul> <!-- end navbar-right -->
            </div>

        </div>
    </div>
</div>
