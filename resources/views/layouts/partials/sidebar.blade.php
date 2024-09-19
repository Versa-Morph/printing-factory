<div class="vertical-menu">


    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="#!" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('assets/images/logo-polimer.jpg') }}" alt="" height="26">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('assets/images/logo-polimer.jpg') }}" alt="" height="80"> <span class="logo-txt"></span>
            </span>
        </a>

        <a href="#!" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('assets/images/logo-polimer.jpg') }}" alt="" height="26">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('assets/images/logo-polimer.jpg') }}" alt="" height="56"> <span class="logo-txt"></span>
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
                        <li><a href="{{ route('hr-work-schedule-list') }}" data-key="t-inbox">Work Schedule</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('payroll.list') }}">
                        <i class="uil-users-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">Payroll</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('attendance-list') }}" class="nav-icon"></i>
                        <i class="bx bx-home-circle nav-icon"></i>
                        <span class="menu-item" data-key="t-email">Absence Management</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('absence-list') }}" data-key="t-inbox">Absence</a></li>
                        <li><a href="{{ route('absence-list-queue') }}" data-key="t-inbox">Queue</a></li>
                        <li><a href="{{ route('absence-list-history') }}" data-key="t-inbox">History</a></li>
                    </ul>
                </li>

                @if(Auth::user()->hasRole('Human Resource') || Auth::user()->hasRole('Human Resource Manager') || Auth::user()->hasRole('Human Resource Staff') || Auth::user()->dashboard_view == 'hr')
                    @include('layouts.partials.role-sidebar.sidebar-hr')
                @endif
                @if(Auth::user()->hasRole('Sales') || Auth::user()->hasRole('Sales Manager') || Auth::user()->hasRole('Sales Staff') || Auth::user()->dashboard_view == 'sales')
                    @include('layouts.partials.role-sidebar.sidebar-sales')
                @endif
                @if(Auth::user()->hasRole('Accounting') || Auth::user()->hasRole('Accounting Manager') || Auth::user()->hasRole('Accounting Staff') || Auth::user()->dashboard_view == 'accounting')
                    @include('layouts.partials.role-sidebar.sidebar-accounting')
                @endif

                @can('settings')
                    <li class="menu-title" data-key="t-menu">SETTINGS</li>
                @endcan
                @can('user-preferences')
                <li>
                    <a href="#">
                        <i class="uil-users-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">User Preferences</span>
                    </a>
                </li>
                @endcan
                @can('role-specific-settings')
                <li>
                    <a href="#">
                        <i class="uil-users-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">Role Specific Settings</span>
                    </a>
                </li>
                @endcan

                @can('logout')
                <li>
                    <a href="#" onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();" >
                        <i class="uil-users-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">Logout</span>
                    </a>
                </li>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                @endcan

                
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
                @endif
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
