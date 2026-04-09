<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-heading">Management</li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('admin.companies.index') }}">
                <i class="bi bi-building"></i><span>Companies</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('admin.job-applications.index') }}">
                <i class="bi bi-briefcase"></i><span>Job Applications</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('admin.contacts.index') }}">
                <i class="bi bi-person-lines-fill"></i><span>Contacts</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('admin.interviews.index') }}">
                <i class="bi bi-person-video2"></i><span>Interviews</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('admin.follow-ups.index') }}">
                <i class="bi bi-arrow-repeat"></i><span>Follow-ups</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('admin.users.index') }}">
                <i class="bi bi-people"></i><span>Users</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('admin.database-backups.index') }}">
                <i class="bi bi-database-down"></i><span>Database Backup</span>
            </a>
        </li>

    </ul>
</aside>
