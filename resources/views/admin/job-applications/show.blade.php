@extends('admin.master')

@section('title', 'View Job Application')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Job Application Details</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.job-applications.index') }}">Job Applications</a></li>
                <li class="breadcrumb-item active">View</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-sm">
                    <div class="card-body">
                        {{-- Header --}}
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="card-title mb-0">{{ $jobApplication->job_title }}</h4>
                            <div>
                                <a href="{{ route('admin.job-applications.edit', $jobApplication) }}" class="btn btn-outline-warning btn-sm">
                                    <i class="bi bi-pencil-square me-1" aria-hidden="true"></i> Edit
                                </a>
                                <a href="{{ route('admin.job-applications.index') }}" class="btn btn-secondary btn-sm">
                                    <i class="bi bi-arrow-left"></i> Back
                                </a>
                            </div>
                        </div>

                        {{-- Top Info Badges --}}
                        <div class="mb-3">
                            @if ($jobApplication->user)
                                <span class="badge bg-info">User: {{ $jobApplication->user->name }}</span>
                            @endif
                            @if ($jobApplication->company)
                                <span class="badge bg-secondary ms-1">Company: {{ $jobApplication->company->name }}</span>
                            @endif
                            <span class="badge bg-primary ms-1">Status: {{ ucfirst(str_replace('_',' ',$jobApplication->application_status)) }}</span>
                            <span class="badge bg-success ms-1">Priority: {{ ucfirst($jobApplication->priority) }}</span>
                        </div>

                        {{-- Main Info Grid --}}
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                @if($jobApplication->salary_range_min || $jobApplication->salary_range_max)
                                    <p><strong>Salary Range:</strong> {{ $jobApplication->salary_range_min ?? 'N/A' }} - {{ $jobApplication->salary_range_max ?? 'N/A' }} {{ $jobApplication->currency ?? '' }}</p>
                                @endif
                                @if($jobApplication->location)
                                    <p><strong>Location:</strong> {{ $jobApplication->location }}</p>
                                @endif
                                @if($jobApplication->work_type)
                                    <p><strong>Work Type:</strong> {{ $jobApplication->work_type }}</p>
                                @endif
                                @if($jobApplication->employment_type)
                                    <p><strong>Employment Type:</strong> {{ $jobApplication->employment_type }}</p>
                                @endif
                            </div>

                            <div class="col-md-6">
                                @if($jobApplication->application_date)
                                    <p><strong>Application Date:</strong> {{ \Carbon\Carbon::parse($jobApplication->application_date)->format('Y-m-d') }}</p>
                                @endif
                                @if($jobApplication->application_deadline)
                                    <p><strong>Application Deadline:</strong> {{ \Carbon\Carbon::parse($jobApplication->application_deadline)->format('Y-m-d') }}</p>
                                @endif
                                @if($jobApplication->last_follow_up_date)
                                    <p><strong>Last Follow-up:</strong> {{ \Carbon\Carbon::parse($jobApplication->last_follow_up_date)->format('Y-m-d') }}</p>
                                @endif
                                @if($jobApplication->next_follow_up_date)
                                    <p><strong>Next Follow-up:</strong> {{ \Carbon\Carbon::parse($jobApplication->next_follow_up_date)->format('Y-m-d') }}</p>
                                @endif
                            </div>
                        </div>

                        {{-- Additional Details --}}
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                @if($jobApplication->source)
                                    <p><strong>Source:</strong> {{ $jobApplication->source }}</p>
                                @endif
                                @if($jobApplication->referral_contact)
                                    <p><strong>Referral Contact:</strong> {{ $jobApplication->referral_contact }}</p>
                                @endif
                                @if($jobApplication->expected_salary)
                                    <p><strong>Expected Salary:</strong> {{ $jobApplication->expected_salary }}</p>
                                @endif
                                @if($jobApplication->notice_period)
                                    <p><strong>Notice Period:</strong> {{ $jobApplication->notice_period }}</p>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <p><strong>Cover Letter Sent:</strong> {{ $jobApplication->cover_letter_sent ? 'Yes' : 'No' }}</p>
                                <p><strong>Portfolio Sent:</strong> {{ $jobApplication->portfolio_sent ? 'Yes' : 'No' }}</p>
                            </div>
                        </div>

                        {{-- Job Description --}}
                        @if ($jobApplication->job_description)
                            <div class="mb-4">
                                <h6 class="fw-semibold">Job Description</h6>
                                <p class="text-muted">{!! nl2br(e($jobApplication->job_description)) !!}</p>
                            </div>
                        @endif

                        {{-- Notes --}}
                        @if ($jobApplication->notes)
                            <div class="mb-4">
                                <h6 class="fw-semibold">Notes</h6>
                                <p class="text-muted">{!! nl2br(e($jobApplication->notes)) !!}</p>
                            </div>
                        @endif

                        {{-- Job URL --}}
                        @if ($jobApplication->job_url)
                            <div class="mb-3">
                                <h6 class="fw-semibold">Job Link</h6>
                                <a href="{{ $jobApplication->job_url }}" target="_blank">{{ $jobApplication->job_url }}</a>
                            </div>
                        @endif

                        {{-- Status History --}}
                        @if ($jobApplication->applicationStatusHistories && $jobApplication->applicationStatusHistories->isNotEmpty())
                            <div class="mt-4 pt-4 border-top">
                                <h6 class="fw-semibold mb-3">Status History</h6>
                                <ul class="list-group list-group-flush">
                                    @foreach ($jobApplication->applicationStatusHistories as $hist)
                                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                            <span>{{ ucfirst(str_replace('_', ' ', $hist->previous_status)) }} → <strong>{{ ucfirst(str_replace('_', ' ', $hist->new_status)) }}</strong></span>
                                            <small class="text-muted">{{ $hist->created_at->format('M d, Y H:i') }}</small>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- Interviews --}}
                        <div class="mt-4 pt-4 border-top">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="fw-semibold mb-0">Interviews</h6>
                                <a href="{{ route('admin.interviews.create', ['job_application_id' => $jobApplication->id]) }}" class="btn btn-sm btn-primary">Add Interview</a>
                            </div>
                            @if ($jobApplication->interviews && $jobApplication->interviews->isNotEmpty())
                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered">
                                        <thead><tr><th>Round</th><th>Type</th><th>Scheduled</th><th>Outcome</th><th></th></tr></thead>
                                        <tbody>
                                            @foreach ($jobApplication->interviews as $int)
                                                <tr>
                                                    <td>{{ $int->interview_round ?? '—' }}</td>
                                                    <td>{{ $int->interview_type ?? '—' }}</td>
                                                    <td>{{ $int->scheduled_date ? $int->scheduled_date->format('M d, Y') : '—' }}</td>
                                                    <td>{{ $int->outcome ?? '—' }}</td>
                                                    <td class="text-nowrap">
                                                        <a href="{{ route('admin.interviews.show', $int) }}"
                                                            class="btn btn-sm btn-outline-primary btn-icon"
                                                            title="View"
                                                            aria-label="View interview"><i class="bi bi-eye-fill"
                                                                aria-hidden="true"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-muted small mb-0">No interviews yet. <a href="{{ route('admin.interviews.create', ['job_application_id' => $jobApplication->id]) }}">Add one</a></p>
                            @endif
                        </div>

                        {{-- Follow-ups --}}
                        <div class="mt-4 pt-4 border-top">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="fw-semibold mb-0">Follow-ups</h6>
                                <a href="{{ route('admin.follow-ups.create', ['job_application_id' => $jobApplication->id]) }}" class="btn btn-sm btn-primary">Add Follow-up</a>
                            </div>
                            @if ($jobApplication->followUps && $jobApplication->followUps->isNotEmpty())
                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered">
                                        <thead><tr><th>Date</th><th>Type</th><th>Subject</th><th>Completed</th><th></th></tr></thead>
                                        <tbody>
                                            @foreach ($jobApplication->followUps as $fu)
                                                <tr>
                                                    <td>{{ $fu->follow_up_date?->format('M d, Y') }}</td>
                                                    <td>{{ $fu->follow_up_type ?? '—' }}</td>
                                                    <td>{{ Str::limit($fu->subject, 30) ?? '—' }}</td>
                                                    <td>{{ $fu->completed ? 'Yes' : 'No' }}</td>
                                                    <td class="text-nowrap">
                                                        <a href="{{ route('admin.follow-ups.show', $fu) }}"
                                                            class="btn btn-sm btn-outline-primary btn-icon"
                                                            title="View"
                                                            aria-label="View follow-up"><i class="bi bi-eye-fill"
                                                                aria-hidden="true"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-muted small mb-0">No follow-ups yet. <a href="{{ route('admin.follow-ups.create', ['job_application_id' => $jobApplication->id]) }}">Add one</a></p>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
