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
        <a href="{{ route('leads-customer-list') }}">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Customer Support</span>
        </a>
    </li>
@endcan

@can('dashboard-manager-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Complaint Management</span>
        </a>
    </li>
@endcan

@can('dashboard-manager-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Customer Feedback</span>
        </a>
    </li>
@endcan

@can('dashboard-manager-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Repair & Reclaim</span>
        </a>
    </li>
@endcan

@can('dashboard-manager-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Knowledge Base Management</span>
        </a>
    </li>
@endcan

@can('dashboard-manager-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Employee Self-Service</span>
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

@can('dashboard-manager-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Customer Support</span>
        </a>
    </li>
@endcan

@can('dashboard-manager-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Complaint Management</span>
        </a>
    </li>
@endcan

@can('dashboard-manager-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Customer Feedback</span>
        </a>
    </li>
@endcan

@can('dashboard-manager-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Repair & Reclaim</span>
        </a>
    </li>
@endcan

@can('dashboard-manager-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Knowledge Base Access</span>
        </a>
    </li>
@endcan


@can('menu-analytics-manager')
    <li class="menu-title" data-key="t-menu">ANALYTICS MENU : MANAGER</li>
@endcan

@can('dashboard-manager-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Customer Interaction Analysis</span>
        </a>
    </li>
@endcan

@can('dashboard-manager-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Complaint Analysis</span>
        </a>
    </li>
@endcan
@can('dashboard-manager-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Support Ticket Analysis</span>
        </a>
    </li>
@endcan
@can('dashboard-manager-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Customer Feedback Analysis</span>
        </a>
    </li>
@endcan



@can('menu-analytics-staff')
    <li class="menu-title" data-key="t-menu">ANALYTICS MENU : STAFF</li>
@endcan

@can('dashboard-manager-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Ticket Reports</span>
        </a>
    </li>
@endcan

@can('dashboard-manager-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Customer Feedback Reports</span>
        </a>
    </li>
@endcan
