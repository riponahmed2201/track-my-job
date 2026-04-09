<aside id="sidebar" class="sidebar">
    @php
        $isDashboard = request()->routeIs('admin.dashboard');
        $isCompanies = request()->routeIs('admin.companies.*');
        $isJobApplications = request()->routeIs('admin.job-applications.*');
        $isContacts = request()->routeIs('admin.contacts.*');
        $isInterviews = request()->routeIs('admin.interviews.*');
        $isFollowUps = request()->routeIs('admin.follow-ups.*');
        $isUsers = request()->routeIs('admin.users.*');
        $isBackups = request()->routeIs('admin.database-backups.*');
    @endphp

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ $isDashboard ? '' : 'collapsed' }}" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-heading">Management</li>
        <li class="nav-item">
            <a class="nav-link {{ $isCompanies ? '' : 'collapsed' }}" href="{{ route('admin.companies.index') }}">
                <i class="bi bi-building"></i><span>Companies</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $isJobApplications ? '' : 'collapsed' }}"
                href="{{ route('admin.job-applications.index') }}">
                <i class="bi bi-briefcase"></i><span>Job Applications</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $isContacts ? '' : 'collapsed' }}" href="{{ route('admin.contacts.index') }}">
                <i class="bi bi-person-lines-fill"></i><span>Contacts</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $isInterviews ? '' : 'collapsed' }}" href="{{ route('admin.interviews.index') }}">
                <i class="bi bi-person-video2"></i><span>Interviews</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $isFollowUps ? '' : 'collapsed' }}" href="{{ route('admin.follow-ups.index') }}">
                <i class="bi bi-arrow-repeat"></i><span>Follow-ups</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $isUsers ? '' : 'collapsed' }}" href="{{ route('admin.users.index') }}">
                <i class="bi bi-people"></i><span>Users</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $isBackups ? '' : 'collapsed' }}" href="{{ route('admin.database-backups.index') }}">
                <i class="bi bi-database-down"></i><span>Database Backup</span>
            </a>
        </li>

    </ul>
</aside>
