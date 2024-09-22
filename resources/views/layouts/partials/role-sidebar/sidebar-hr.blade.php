@can('menu-manager')
    <li class="menu-title" data-key="t-menu">ROLE MENU : MANAGER</li>
@endcan

@can('dashboard-manager-hr')
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
                <li><a href="{{ route('employe-list') }}" data-key="t-inbox">List</a></li>
            @endcan

            @can('list-employee-salary')
                <li><a href="{{ route('employee-salary-list') }}" data-key="t-inbox">Salary</a></li>
            @endcan

            @can('list-work-schedule')
                <li><a href="{{ route('work-schedule-list') }}" data-key="t-inbox">Work Schedule</a></li>
            @endcan

        </ul>
    </li>
@endcan

@can('absence-management')
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
@endcan

@can('payroll-management')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Payroll Management</span>
        </a>
    </li>
@endcan

@can('menu-staff')
    <li class="menu-title" data-key="t-menu">ROLE MENU : STAFF</li>
@endcan

@can('dashboard-staff-hr')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Dashboard</span>
        </a>
    </li>
@endcan

@can('employee-records')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Employee Records</span>
        </a>
    </li>
@endcan

@can('absence-requests')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Absence Requests</span>
        </a>
    </li>
@endcan

@can('payroll-access')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Payroll Access</span>
        </a>
    </li>
@endcan
{{-- 
@can('self-service')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Self-Service</span>
        </a>
    </li>
@endcan --}}

@can('menu-analytics-manager')
    <li class="menu-title" data-key="t-menu">ANALYTICS MENU : MANAGER</li>
@endcan

@can('attendance-analysis')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Attendance Analysis</span>
        </a>
    </li>
@endcan
@can('payroll-analysis')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Payroll Analysis</span>
        </a>
    </li>
@endcan
@can('employee-performance')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Employee Performance</span>
        </a>
    </li>
@endcan

@can('menu-analytics-staff')
    <li class="menu-title" data-key="t-menu">ANALYTICS MENU : STAFF</li>
@endcan
@can('task-performance')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Task Performance</span>
        </a>
    </li>
@endcan
@can('absence-reports')
    <li>
        <a href="#">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Absence Reports</span>
        </a>
    </li>
@endcan

@can('master-data')
    <li class="menu-title" data-key="t-menu">MASTER DATA</li>
@endcan

@can('list-shift')
    <li>
        <a href="{{ route('shift-list') }}">
            <i class="uil-users-alt nav-icon"></i>
            <span class="menu-item" data-key="t-authentication">Shift</span>
        </a>
    </li>
@endcan

