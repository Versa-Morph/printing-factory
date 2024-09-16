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
                <li class="menu-title" data-key="t-menu">Menu</li>

                {{-- <li>
                    <a href="{{ route('home') }}">
                        <i class="bx bx-home-circle nav-icon"></i>
                        <span class="menu-item" data-key="t-dashboard">Dashboard</span>
                    </a>
                </li> --}}

                @if(Auth::user()->hasRole('Super Admin')||Auth::user()->hasRole('Sales'))

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

                {{-- @if(Auth::user()->hasRole('Super Admin')||Auth::user()->hasRole('Accounting'))
                <li>
                    <a href="{{ route('customer-list') }}">
                        <i class="uil-users-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">Customer</span>
                    </a>
                </li>
                <li>
                    <a href="#!">
                        <i class="uil-users-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">Invoice</span>
                    </a>
                </li>
                <li>
                    <a href="#!">
                        <i class="uil-users-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">Taxes</span>
                    </a>
                </li>
                @endif

                @if(Auth::user()->hasRole('Super Admin')||Auth::user()->hasRole('Finance'))
                <li>
                    <a href="#!">
                        <i class="uil-users-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">Financial Report</span>
                    </a>
                </li>
                <li>
                    <a href="#!">
                        <i class="uil-users-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">Account Receivable</span>
                    </a>
                </li>
                <li>
                    <a href="#!">
                        <i class="uil-users-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">Account Payable</span>
                    </a>
                </li>
                <li>
                    <a href="#!">
                        <i class="uil-users-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">Cost Management</span>
                    </a>
                </li>
                <li>
                    <a href="#!">
                        <i class="uil-users-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">General Ledger</span>
                    </a>
                </li>
                <li>
                    <a href="#!">
                        <i class="uil-users-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">Fixed Assets</span>
                    </a>
                </li>
                <li>
                    <a href="#!">
                        <i class="uil-users-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">Cost Accounting</span>
                    </a>
                </li>
                <li>
                    <a href="#!">
                        <i class="uil-users-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">Budgeting</span>
                    </a>
                </li>
                @endif

                @if(Auth::user()->hasRole('Super Admin')||Auth::user()->hasRole('Customer Care'))
                <li>
                    <a href="#!">
                        <i class="uil-users-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">Customer Care</span>
                    </a>
                </li>
                <li>
                    <a href="#!">
                        <i class="uil-users-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">Receive Order</span>
                    </a>
                </li>
                @endif

                @if(Auth::user()->hasRole('Super Admin')||Auth::user()->hasRole('customer-care'))
                <li>
                    <a href="#!">
                        <i class="uil-users-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">Receive Order</span>
                    </a>
                </li>
                <li>
                    <a href="#!">
                        <i class="uil-users-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">Form Order</span>
                    </a>
                </li>
                <li>
                    <a href="#!">
                        <i class="uil-users-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">Repair & Reclaim</span>
                    </a>
                </li>
                @endif

                @if(Auth::user()->hasRole('Super Admin')||Auth::user()->hasRole('desain-grafis'))
                <li>
                    <a href="#!">
                        <i class="uil-users-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">Receive Design</span>
                    </a>
                </li>
                <li>
                    <a href="#!">
                        <i class="uil-users-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">Report Design</span>
                    </a>
                </li>
                <li>
                    <a href="#!">
                        <i class="uil-users-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">RO Design</span>
                    </a>
                </li>
                @endif

                @if(Auth::user()->hasRole('Super Admin')||Auth::user()->hasRole('dtps'))
                <li>
                    <a href="#!">
                        <i class="uil-users-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">Receive DTP</span>
                    </a>
                </li>
                <li>
                    <a href="#!">
                        <i class="uil-users-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">Report DTP</span>
                    </a>
                </li>
                <li>
                    <a href="#!">
                        <i class="uil-users-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">RO DTP</span>
                    </a>
                </li>
                @endif

                @if(Auth::user()->hasRole('Super Admin')||Auth::user()->hasRole('production'))
                <li>
                    <a href="#!">
                        <i class="uil-users-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">Record Production</span>
                    </a>
                </li>
                @endif

                @if(Auth::user()->hasRole('Super Admin')||Auth::user()->hasRole('quality-control'))
                <li>
                    <a href="#!">
                        <i class="uil-users-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">Report Production</span>
                    </a>
                </li>
                @endif

                @if(Auth::user()->hasRole('Super Admin')||Auth::user()->hasRole('comodity'))
                <li>
                    <a href="#!">
                        <i class="uil-users-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">Catalog Product</span>
                    </a>
                </li>
                @endif

                @if(Auth::user()->hasRole('Super Admin')||Auth::user()->hasRole('warehouse'))
                <li>
                    <a href="#!">
                        <i class="uil-users-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">Material List</span>
                    </a>
                </li>
                <li>
                    <a href="#!">
                        <i class="uil-users-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">Status Stock</span>
                    </a>
                </li>
                @endif

                @if(Auth::user()->hasRole('Super Admin')||Auth::user()->hasRole('delivery'))
                <li>
                    <a href="#!">
                        <i class="uil-users-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">Delivery Order</span>
                    </a>
                </li>
                @endif --}}

                {{-- @can('list-customer')
                <li>
                    <a href="{{ route('customer-list') }}">
                        <i class="uil-users-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">Customer</span>
                    </a>
                </li>
                @endcan

                @can('list-order')
                <li>
                    <a href="{{ route('order-list') }}">
                        <i class="bx bx-file nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">Order</span>
                    </a>
                </li>
                @endcan


                @can('list-desain-product')
                <li>
                    <a href="{{ route('desain-product-list') }}">
                        <i class="bx bx-credit-card nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">Desain Product</span>
                    </a>
                </li>
                @endcan

                @can('list-rencana-produksi')
                <li>
                    <a href="{{ route('rencana-produksi-list') }}">
                        <i class="bx bx-credit-card nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">Rencana Produksi</span>
                    </a>
                </li>
                @endcan


                @can('list-jadwal-produksi')
                <li>
                    <a href="{{ route('jadwal-produksi-list') }}">
                        <i class="bx bx-calendar-alt nav-icon nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">Jadwal Produksi</span>
                    </a>
                </li>
                @endcan

                @can('list-laporan-produksi')
                <li>
                    <a href="{{ route('laporan-produksi-list') }}">
                        <i class="bx bx-book nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">Laporan Produksi</span>
                    </a>
                </li>
                @endcan

                @if(Auth::user()->can('list-karyawan') || Auth::user()->can('list-gaji'))
                    <li class="menu-title" data-key="t-menu">HR Management</li>
                @endif

                @can('list-karyawan')
                <li>
                    <a href="{{ route('karyawan-list') }}">
                        <i class="uil-users-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">Karyawan</span>
                    </a>
                </li>
                @endcan

                @can('list-gaji')
                <li>
                    <a href="{{ route('gaji-list') }}">
                        <i class="bx bx-credit-card nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">Gaji</span>
                    </a>
                </li>
                @endcan --}}

                {{-- <li class="menu-title" data-key="t-menu">Management User</li>

                <li>
                    <a href="{{ url('users') }}">
                        <i class="bx bx-user nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">User</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('roles') }}">
                        <i class="bx bx-cog nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">Role & Permission</span>
                    </a>
                </li> --}}

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
