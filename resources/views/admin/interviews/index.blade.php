@extends('admin.master')

@section('title', 'Interviews')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Interviews</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Interviews</li>
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
                                <h5 class="card-title">All Interviews</h5>
                                <a href="{{ route('admin.interviews.create') }}" class="btn btn-primary">
                                    <i class="bi bi-plus-circle"></i> New Interview
                                </a>
                            </div>

                            <form method="GET" action="{{ route('admin.interviews.index') }}" class="row g-3 mb-4 align-items-end">
                                <div class="col-md-4">
                                    <label class="form-label">Job Application</label>
                                    <select name="job_application_id" class="form-select">
                                        <option value="">All</option>
                                        @foreach ($jobApplications as $ja)
                                            <option value="{{ $ja->id }}" {{ request('job_application_id') == $ja->id ? 'selected' : '' }}>
                                                {{ $ja->job_title }} @ {{ $ja->company?->name ?? '—' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Outcome</label>
                                    <select name="outcome" class="form-select">
                                        <option value="">All</option>
                                        @foreach (['Pending', 'Passed', 'Failed', 'Rescheduled'] as $o)
                                            <option value="{{ $o }}" {{ request('outcome') == $o ? 'selected' : '' }}>{{ $o }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary w-100"><i class="bi bi-funnel"></i> Filter</button>
                                </div>
                                <div class="col-md-2">
                                    <a href="{{ route('admin.interviews.index') }}" class="btn btn-secondary w-100">Reset</a>
                                </div>
                            </form>

                            <div class="table-responsive">
                                <table class="table table-striped align-middle">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Job Application</th>
                                            <th>Round</th>
                                            <th>Type</th>
                                            <th>Scheduled</th>
                                            <th>Outcome</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($interviews as $interview)
                                            <tr>
                                                <td>{{ $loop->iteration + ($interviews->currentPage() - 1) * $interviews->perPage() }}</td>
                                                <td>
                                                    @if($interview->jobApplication)
                                                        <a href="{{ route('admin.job-applications.show', $interview->jobApplication) }}">{{ $interview->jobApplication->job_title }}</a>
                                                        @if($interview->jobApplication->company)
                                                            <br><small class="text-muted">{{ $interview->jobApplication->company->name }}</small>
                                                        @endif
                                                    @else
                                                        —
                                                    @endif
                                                </td>
                                                <td>{{ $interview->interview_round ?? '—' }}</td>
                                                <td>{{ $interview->interview_type ?? '—' }}</td>
                                                <td>{{ $interview->scheduled_date ? $interview->scheduled_date->format('M d, Y H:i') : '—' }}</td>
                                                <td>
                                                    @if($interview->outcome)
                                                        <span class="badge bg-{{ $interview->outcome === 'Passed' ? 'success' : ($interview->outcome === 'Failed' ? 'danger' : 'secondary') }}">{{ $interview->outcome }}</span>
                                                    @else
                                                        —
                                                    @endif
                                                </td>
                                                <td class="text-nowrap">
                                                    <div class="table-action-btns">
                                                        <a href="{{ route('admin.interviews.show', $interview) }}"
                                                            class="btn btn-sm btn-outline-primary btn-icon"
                                                            title="View"
                                                            aria-label="View interview"><i class="bi bi-eye-fill"
                                                                aria-hidden="true"></i></a>
                                                        <a href="{{ route('admin.interviews.edit', $interview) }}"
                                                            class="btn btn-sm btn-outline-warning btn-icon"
                                                            title="Edit"
                                                            aria-label="Edit interview"><i class="bi bi-pencil-square"
                                                                aria-hidden="true"></i></a>
                                                        <form action="{{ route('admin.interviews.destroy', $interview) }}"
                                                            method="POST" class="d-inline m-0 align-middle"
                                                            onsubmit="return confirm('Delete this interview?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-outline-danger btn-icon"
                                                                title="Delete"
                                                                aria-label="Delete interview"><i class="bi bi-trash-fill"
                                                                    aria-hidden="true"></i></button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">No interviews found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center">{{ $interviews->links('pagination::bootstrap-4') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
