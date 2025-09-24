@extends('admin.master')

@section('title', 'Job Applications')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Job Applications</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Job Applications</li>
                </ol>
            </nav>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title">All Job Applications</h5>
                                <a href="{{ route('admin.job-applications.create') }}" class="btn btn-primary">
                                    <i class="bi bi-plus-circle"></i> New Application
                                </a>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped align-middle">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Job Title</th>
                                            <th>Company</th>
                                            <th>Applicant</th>
                                            <th>Status</th>
                                            <th>Priority</th>
                                            <th>Applied On</th>
                                            <th>Next Follow-Up</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($applications as $application)
                                            <tr>
                                                <td>{{ $application->id }}</td>
                                                <td>{{ $application->job_title }}</td>
                                                <td>{{ $application->company->name ?? '-' }}</td>
                                                <td>{{ $application->user->name ?? '-' }}</td>
                                                <td>
                                                    @php
                                                        $statusClasses = [
                                                            'applied' => 'bg-primary',
                                                            'under_review' => 'bg-info',
                                                            'interview' => 'bg-warning',
                                                            'offer' => 'bg-success',
                                                            'rejected' => 'bg-danger',
                                                        ];

                                                        $statusClass =
                                                            $statusClasses[$application->application_status] ??
                                                            'bg-secondary';
                                                    @endphp

                                                    <span class="badge {{ $statusClass }}">
                                                        {{ ucfirst(str_replace('_', ' ', $application->application_status)) }}
                                                    </span>

                                                </td>
                                                <td>
                                                    <span
                                                        class="badge
                                                    {{ $application->priority == 'high' ? 'bg-danger' : '' }}
                                                    {{ $application->priority == 'medium' ? 'bg-warning' : '' }}
                                                    {{ $application->priority == 'low' ? 'bg-secondary' : '' }}">
                                                        {{ ucfirst($application->priority) }}
                                                    </span>
                                                </td>
                                                <td>{{ optional($application->application_date)->format('M d, Y') ?? '-' }}
                                                </td>
                                                <td>{{ optional($application->next_follow_up_date)->format('M d, Y') ?? '-' }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.job-applications.show', $application) }}"
                                                        class="btn btn-sm btn-info">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.job-applications.edit', $application) }}"
                                                        class="btn btn-sm btn-warning">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <form
                                                        action="{{ route('admin.job-applications.destroy', $application) }}"
                                                        method="POST" class="d-inline"
                                                        onsubmit="return confirm('Delete this application?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" class="text-center">No job applications found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-flex justify-content-center">
                                {{ $applications->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
