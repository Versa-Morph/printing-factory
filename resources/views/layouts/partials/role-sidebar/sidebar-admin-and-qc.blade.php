@can('menu-manager')
    <li class="menu-title" data-key="t-menu">ROLE MENU : MANAGER</li>
@endcan

@can('dashboard-manager-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Dashboard</span>
        </a>
    </li>
@endcan

@can('dashboard-manager-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Production Management</span>
        </a>
    </li>
@endcan
@can('dashboard-manager-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Quality Control</span>
        </a>
    </li>
@endcan
@can('dashboard-manager-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Reporting</span>
        </a>
    </li>
@endcan
@can('dashboard-manager-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Compliance Management</span>
        </a>
    </li>
@endcan



@can('menu-staff')
    <li class="menu-title" data-key="t-menu">ROLE MENU : STAFF</li>
@endcan
@can('dashboard-staff-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Dashboard</span>
        </a>
    </li>
@endcan
@can('dashboard-staff-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Production Tasks</span>
        </a>
    </li>
@endcan
@can('dashboard-staff-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Quality Control Tasks</span>
        </a>
    </li>
@endcan
@can('dashboard-staff-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Reporting</span>
        </a>
    </li>
@endcan

@can('menu-analytics-manager')
<li class="menu-title" data-key="t-menu">ANALYTICS MENU : MANAGER</li>
@endcan
@can('dashboard-staff-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Production Analysis</span>
        </a>
    </li>
@endcan
@can('dashboard-staff-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Quality Control Analysis</span>
        </a>
    </li>
@endcan
@can('dashboard-staff-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Compliance Analysis</span>
        </a>
    </li>
@endcan


@can('menu-analytics-staff')
<li class="menu-title" data-key="t-menu">ANALYTICS MENU : STAFF</li>
@endcan

@can('dashboard-staff-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Task Performance</span>
        </a>
    </li>
@endcan

@can('dashboard-staff-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">QC Performance Reports</span>
        </a>
    </li>
@endcan
