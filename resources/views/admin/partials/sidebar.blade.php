<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-heading">Company Management</li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('admin.companies.index') }}">
                <i class="bi bi-car-front"></i><span>Companies</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('admin.job-applications.index') }}">
                <i class="bi bi-car-front"></i><span>Job Applications</span>
            </a>
        </li>

    </ul>
</aside>
