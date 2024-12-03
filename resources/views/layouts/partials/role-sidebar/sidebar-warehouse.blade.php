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

@can('order-management')
    <li>
        <a href="{{ route('order-management-list') }}">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Procurement Management</span>
        </a>
    </li>
@endcan
@can('sales-team-management')
    <li>
        <a href="{{ route('sales-task-management-list') }}">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Task Management</span>
        </a>
    </li>
@endcan

{{-- @can('dashboard-manager-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Stock Management</span>
        </a>
    </li>
@endcan

@can('dashboard-manager-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Goods Receipt & Issue</span>
        </a>
    </li>
@endcan

@can('dashboard-manager-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Inventory Reporting</span>
        </a>
    </li>
@endcan

@can('dashboard-manager-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Warehouse Space Management</span>
        </a>
    </li>
@endcan --}}

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
@can('order-management')
    <li>
        <a href="{{ route('order-management-list') }}">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Procurement Management</span>
        </a>
    </li>
@endcan
@can('sales-team-management')
    <li>
        <a href="{{ route('sales-task-management-list') }}">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Design Task</span>
        </a>
    </li>
@endcan
{{-- @can('dashboard-staff-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Stock Tasks</span>
        </a>
    </li>
@endcan
@can('dashboard-staff-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Goods Handling</span>
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
            <span class="menu-item" data-key="t-authentication">Inventory Analysis</span>
        </a>
    </li>
@endcan
@can('dashboard-staff-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Warehouse Efficiency</span>
        </a>
    </li>
@endcan
@can('dashboard-staff-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Goods Movement Analysis</span>
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
            <span class="menu-item" data-key="t-authentication">Stock Reports</span>
        </a>
    </li>
@endcan --}}


