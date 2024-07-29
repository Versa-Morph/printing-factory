<div class="vertical-menu">


    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                <img src="assets/images/logo-sm.svg" alt="" height="26">
            </span>
            <span class="logo-lg">
                <img src="assets/images/logo-sm.svg" alt="" height="26"> <span class="logo-txt">Vuesy</span>
            </span>
        </a>

        <a href="index.html" class="logo logo-light">
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
                <li class="menu-title" data-key="t-menu">Menu</li>

                <li>
                    <a href="{{ route('home') }}">
                        <i class="bx bx-home-circle nav-icon"></i>
                        <span class="menu-item" data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>

                @can('pelanggan-list')
                <li>
                    <a href="{{ route('pelanggan-list') }}">
                        <i class="uil-users-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">Pelanggan</span>
                    </a>
                </li>
                @endcan

                @can('create-karyawan')
                <li>
                    <a href="{{ route('karyawan') }}">
                        <i class="uil-users-alt nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">Karyawan</span>
                    </a>
                </li>
                @endcan

                {{-- @dd(Auth::user()->can('list-gaji')) --}}
                @can('list-gaasdsadasji')
                <li>
                    <a href="{{ route('gaji-list') }}">
                        <i class="bx bx-credit-card nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">Gaji</span>
                    </a>
                </li>
                @endcan
                
                <li class="menu-title" data-key="t-menu">Management User</li>

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
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
