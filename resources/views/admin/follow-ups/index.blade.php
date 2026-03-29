@extends('admin.master')

@section('title', 'Follow-ups')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Follow-ups</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Follow-ups</li>
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
                                <h5 class="card-title">All Follow-ups</h5>
                                <a href="{{ route('admin.follow-ups.create') }}" class="btn btn-primary">
                                    <i class="bi bi-plus-circle"></i> New Follow-up
                                </a>
                            </div>

                            <form method="GET" action="{{ route('admin.follow-ups.index') }}" class="row g-3 mb-4 align-items-end">
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
                                    <label class="form-label">Status</label>
                                    <select name="completed" class="form-select">
                                        <option value="">All</option>
                                        <option value="0" {{ request('completed') === '0' ? 'selected' : '' }}>Pending</option>
                                        <option value="1" {{ request('completed') === '1' ? 'selected' : '' }}>Completed</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary w-100"><i class="bi bi-funnel"></i> Filter</button>
                                </div>
                                <div class="col-md-2">
                                    <a href="{{ route('admin.follow-ups.index') }}" class="btn btn-secondary w-100">Reset</a>
                                </div>
                            </form>

                            <div class="table-responsive">
                                <table class="table table-striped align-middle">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Job Application</th>
                                            <th>Date</th>
                                            <th>Type</th>
                                            <th>Subject</th>
                                            <th>Completed</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($followUps as $followUp)
                                            <tr>
                                                <td>{{ $loop->iteration + ($followUps->currentPage() - 1) * $followUps->perPage() }}</td>
                                                <td>
                                                    @if($followUp->jobApplication)
                                                        <a href="{{ route('admin.job-applications.show', $followUp->jobApplication) }}">{{ $followUp->jobApplication->job_title }}</a>
                                                        @if($followUp->jobApplication->company)
                                                            <br><small class="text-muted">{{ $followUp->jobApplication->company->name }}</small>
                                                        @endif
                                                    @else
                                                        —
                                                    @endif
                                                </td>
                                                <td>{{ $followUp->follow_up_date?->format('M d, Y') }}</td>
                                                <td>{{ $followUp->follow_up_type ?? '—' }}</td>
                                                <td>{{ Str::limit($followUp->subject, 40) ?? '—' }}</td>
                                                <td>{{ $followUp->completed ? 'Yes' : 'No' }}</td>
                                                <td class="text-nowrap">
                                                    <div class="table-action-btns">
                                                        <a href="{{ route('admin.follow-ups.show', $followUp) }}"
                                                            class="btn btn-sm btn-outline-primary btn-icon"
                                                            title="View"
                                                            aria-label="View follow-up"><i class="bi bi-eye-fill"
                                                                aria-hidden="true"></i></a>
                                                        <a href="{{ route('admin.follow-ups.edit', $followUp) }}"
                                                            class="btn btn-sm btn-outline-warning btn-icon"
                                                            title="Edit"
                                                            aria-label="Edit follow-up"><i class="bi bi-pencil-square"
                                                                aria-hidden="true"></i></a>
                                                        <form action="{{ route('admin.follow-ups.destroy', $followUp) }}"
                                                            method="POST" class="d-inline m-0 align-middle"
                                                            onsubmit="return confirm('Delete this follow-up?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-outline-danger btn-icon"
                                                                title="Delete"
                                                                aria-label="Delete follow-up"><i class="bi bi-trash-fill"
                                                                    aria-hidden="true"></i></button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">No follow-ups found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center">{{ $followUps->links('pagination::bootstrap-4') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
