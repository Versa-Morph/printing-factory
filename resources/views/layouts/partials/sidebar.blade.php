<div class="vertical-menu">


    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="#!" class="logo logo-dark">
            <span class="logo-sm">
                <img src="assets/images/logo-sm.svg" alt="" height="26">
            </span>
            <span class="logo-lg">
                <img src="assets/images/logo-sm.svg" alt="" height="26"> <span class="logo-txt">Vuesy</span>
            </span>
        </a>

        <a href="#!" class="logo logo-light">
            <span class="logo-sm">
                <img src="assets/images/logo-sm.svg" alt="" height="26">
            </span>
            <span class="logo-lg">
                <img src="assets/images/logo-sm.svg" alt="" height="26"> <span class="logo-txt">Vuesy</span>
            </span>
        </a>
    </div>

    <button type="button" class="btn btn-sm px-3 font-size-16 header-item vertical-menu-btn">
        <i class="fa fa-fw fa-bars"></i>
    </button>

    <div data-simplebar class="sidebar-menu-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">General Menu</li>
                <li>
                    <a href="{{ route('attendance-list') }}" class="nav-icon"></i>
                        <i class="bx bx-home-circle nav-icon"></i>
                        <span class="menu-item" data-key="t-email">Attendance</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('attendance-list') }}" data-key="t-inbox">Dashboard</a></li>
                        <li><a href="{{ route('overtime-list') }}" data-key="t-inbox">Overtime</a></li>
                        <li><a href="{{ route('absence-list') }}" data-key="t-inbox">Absence</a></li>
                        <li><a href="{{ route('work-schedule-list') }}" data-key="t-inbox">Work Schedule</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('payroll.list') }}">
                        <i class="uil-users-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">Payroll</span>
                    </a>
                </li>

                <li class="menu-title" data-key="t-menu">ROLE MENU : MANAGER</li>

                @can('dashboard-manager')
                <li>
                    <a href="#">
                        <i class="uil-users-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">Dashboard</span>
                    </a>
                </li>
                @endcan

                @can('employee-management')
                <li>
                    <a href="#" class="nav-icon"></i>
                        <i class="bx bx-home-circle nav-icon"></i>
                        <span class="menu-item" data-key="t-email">Employee Management</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @can('list-employe')
                            <li><a href="{{ route('employe-list') }}" data-key="t-inbox">Employe List</a></li>
                        @endcan

                        @can('list-employee-salary')
                        <li><a href="{{ route('employee-salary-list') }}" data-key="t-inbox">Employee Salary</a></li>
                        @endcan

                        <li><a href="{{ route('hr-work-schedule-list') }}" data-key="t-inbox">Work Schedule</a></li>
                    </ul>
                </li>
                @endcan

                <li>
                    <a href="#">
                        <i class="uil-users-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">Absence Management</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="uil-users-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">Payroll Management</span>
                    </a>
                </li>

                <li class="menu-title" data-key="t-menu">ROLE MENU : STAFF</li>

                <li>
                    <a href="#">
                        <i class="uil-users-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="uil-users-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">Employee Records</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="uil-users-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">Absence Requests</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="uil-users-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">Payroll Access</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="uil-users-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">Self-Service</span>
                    </a>
                </li>
                <li class="menu-title" data-key="t-menu">ANALYTICS MENU : MANAGER</li>

                <li>
                    <a href="#">
                        <i class="uil-users-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">Attendance Analysis</span>
                    </a>
                </li>

                
                @if(Auth::user()->hasRole('Sales'))
                <li class="menu-title" data-key="t-menu">Menu</li>

                <li>
                    <a href="{{ route('dashboard.sales') }}">
                        <i class="bx bx-home-circle nav-icon"></i>
                        <span class="menu-item" data-key="t-dashboard">Dashboard Sales</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('leads-customer-list') }}">
                        <i class="uil-users-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">Leads</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('customer-list') }}">
                        <i class="uil-users-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">Customer</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('quotation-list') }}">
                        <i class="uil-users-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">Quotation</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('receive-order-list') }}">
                        <i class="uil-users-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">Receive Order</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('shift-list') }}">
                        <i class="uil-users-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">Shift</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('hr-work-schedule-list') }}">
                        <i class="uil-users-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">Work Schedule</span>
                    </a>
                </li>
                @endif
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
