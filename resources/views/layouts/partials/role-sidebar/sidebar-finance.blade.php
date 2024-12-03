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
@can('customer-management')
    <li>
        <a href="{{ route('leads-customer-list') }}">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Customer Management</span>
        </a>
    </li>
@endcan
@can('quotation-management')
    <li>
        <a href="{{ route('quotation-list') }}">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Quotation Management</span>
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
            <span class="menu-item" data-key="t-authentication">Financial Planning</span>
        </a>
    </li>
@endcan
@can('dashboard-manager-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Cash Management</span>
        </a>
    </li>
@endcan
@can('dashboard-manager-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Investment & Financing</span>
        </a>
    </li>
@endcan
@can('dashboard-manager-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Cost Management</span>
        </a>
    </li>
@endcan
@can('dashboard-manager-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">General Ledger</span>
        </a>
    </li>
@endcan
@can('dashboard-manager-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Financial Reporting</span>
        </a>
    </li>
@endcan --}}


@can('menu-staff')
    <li class="menu-title" data-key="t-menu">ROLE MENU : STAFF</li>
@endcan

@can('quotation-management')
    <li>
        <a href="{{ route('quotation-list') }}">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Quotation Management</span>
        </a>
    </li>
@endcan
@can('customer-management')
    <li>
        <a href="{{ route('leads-customer-list') }}">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Customer Management</span>
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
{{-- @can('dashboard-staff-accounting')
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
            <span class="menu-item" data-key="t-authentication">Financial Planning</span>
        </a>
    </li>
@endcan
@can('dashboard-staff-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Cash Management</span>
        </a>
    </li>
@endcan
@can('dashboard-staff-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Cost Management</span>
        </a>
    </li>
@endcan
@can('dashboard-staff-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">General Ledger</span>
        </a>
    </li>
@endcan
@can('dashboard-staff-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Financial Reporting</span>
        </a>
    </li>
@endcan --}}


{{-- @can('menu-analytics-manager')
    <li class="menu-title" data-key="t-menu">ANALYTICS MENU : MANAGER</li>
@endcan
@can('dashboard-staff-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Financial Analysis</span>
        </a>
    </li>
@endcan
@can('dashboard-staff-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Cash Flow Analysis</span>
        </a>
    </li>
@endcan
@can('dashboard-staff-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Budget Analysis</span>
        </a>
    </li>
@endcan
@can('dashboard-staff-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Investment & Financing Analysis</span>
        </a>
    </li>
@endcan
@can('dashboard-staff-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Cost Analysis</span>
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
            <span class="menu-item" data-key="t-authentication">Transaction Reports</span>
        </a>
    </li>
@endcan
@can('dashboard-staff-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Cash Flow Reports</span>
        </a>
    </li>
@endcan
@can('dashboard-staff-accounting')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Cost Reports</span>
        </a>
    </li>
@endcan --}}
