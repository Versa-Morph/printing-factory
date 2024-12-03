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
            <span class="menu-item" data-key="t-authentication">Order Management</span>
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
            <span class="menu-item" data-key="t-authentication">Pre-Production Management</span>
        </a>
    </li>
@endcan
@can('dashboard-manager-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">System Integration</span>
        </a>
    </li>
@endcan
@can('dashboard-manager-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Data Management</span>
        </a>
    </li>
@endcan
@can('dashboard-manager-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Technology Management</span>
        </a>
    </li>
@endcan
@can('dashboard-manager-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Support Management</span>
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
            <span class="menu-item" data-key="t-authentication">Order Management</span>
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
            <span class="menu-item" data-key="t-authentication">Pre-Production Tasks</span>
        </a>
    </li>
@endcan
@can('dashboard-staff-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Support Tickets</span>
        </a>
    </li>
@endcan
@can('dashboard-staff-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Data Collection</span>
        </a>
    </li>
@endcan
@can('dashboard-staff-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Technology Assistance</span>
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
            <span class="menu-item" data-key="t-authentication">Pre-Production Analysis</span>
        </a>
    </li>
@endcan
@can('dashboard-staff-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">System Integration Analysis</span>
        </a>
    </li>
@endcan
@can('dashboard-staff-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Data Analysis</span>
        </a>
    </li>
@endcan
@can('dashboard-staff-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Support Ticket Analysis</span>
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
            <span class="menu-item" data-key="t-authentication">Task Reports</span>
        </a>
    </li>
@endcan
    
@can('dashboard-staff-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Support Ticket Summary</span>
        </a>
    </li>
@endcan --}}