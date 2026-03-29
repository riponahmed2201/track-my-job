@extends('admin.master')

@section('title', 'Admin Dashboard')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div>

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <!-- Applied Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">Applied <span>| Total</span></h5>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-file-earmark-text"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $appliedCount }}</h6>
                                            <span class="text-muted small pt-2 ps-1">applications</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Interview Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card revenue-card">
                                <div class="card-body">
                                    <h5 class="card-title">Interview <span>| Total</span></h5>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-person-video2"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $interviewCount }}</h6>
                                            <span class="text-muted small pt-2 ps-1">scheduled</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Offer Card -->
                        <div class="col-xxl-4 col-xl-12">
                            <div class="card info-card customers-card">
                                <div class="card-body">
                                    <h5 class="card-title">Offer <span>| Total</span></h5>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-briefcase"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $offerCount }}</h6>
                                            <span class="text-muted small pt-2 ps-1">received</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Recent Job Applications</h5>
                                    <div class="table-responsive">
                                        <table class="table table-striped align-middle">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Job Title</th>
                                                    <th>Company</th>
                                                    <th>Salary Range</th>
                                                    <th>Location</th>
                                                    <th>Status</th>
                                                    <th>Applied</th>
                                                    <th>Deadline</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($recentApplications as $app)
                                                <tr>
                                                    <td>{{ $app->id }}</td>
                                                    <td>{{ $app->job_title }}</td>
                                                    <td>{{ $app->company?->name ?? '—' }}</td>
                                                    <td>
                                                        @if($app->salary_range_min || $app->salary_range_max)
                                                            {{ $app->currency ?? '' }} {{ $app->salary_range_min ?? '0' }} - {{ $app->salary_range_max ?? '—' }}
                                                        @else
                                                            —
                                                        @endif
                                                    </td>
                                                    <td>{{ $app->location ?? '—' }}</td>
                                                    <td><span class="badge bg-secondary">{{ ucfirst(str_replace('_', ' ', $app->application_status)) }}</span></td>
                                                    <td>{{ $app->application_date ? $app->application_date->format('M d, Y') : '—' }}</td>
                                                    <td>{{ $app->application_deadline ? $app->application_deadline->format('M d, Y') : '—' }}</td>
                                                    <td class="text-nowrap">
                                                        <div class="table-action-btns">
                                                            <a href="{{ route('admin.job-applications.show', $app) }}"
                                                                class="btn btn-sm btn-outline-primary btn-icon"
                                                                title="View"
                                                                aria-label="View application"><i class="bi bi-eye-fill"
                                                                    aria-hidden="true"></i></a>
                                                            <a href="{{ route('admin.job-applications.edit', $app) }}"
                                                                class="btn btn-sm btn-outline-warning btn-icon"
                                                                title="Edit"
                                                                aria-label="Edit application"><i
                                                                    class="bi bi-pencil-square"
                                                                    aria-hidden="true"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="9" class="text-center text-muted py-4">No job applications yet. <a href="{{ route('admin.job-applications.create') }}">Add one</a></td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection
