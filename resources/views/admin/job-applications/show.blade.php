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
                                <a href="{{ route('admin.job-applications.edit', $jobApplication) }}" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil"></i> Edit
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

                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
