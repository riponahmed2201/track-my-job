@extends('admin.master')

@section('title', 'View Follow-up')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Follow-up Details</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.follow-ups.index') }}">Follow-ups</a></li>
                    <li class="breadcrumb-item active">View</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title mb-0">{{ $follow_up->subject ?: 'Follow-up #' . $follow_up->id }}</h5>
                                <div>
                                    <a href="{{ route('admin.follow-ups.edit', $follow_up) }}" class="btn btn-outline-warning btn-sm"><i class="bi bi-pencil-square me-1" aria-hidden="true"></i> Edit</a>
                                    <a href="{{ route('admin.follow-ups.index') }}" class="btn btn-secondary btn-sm"><i class="bi bi-arrow-left"></i> Back</a>
                                </div>
                            </div>
                            @if($follow_up->jobApplication)
                                <p class="text-muted mb-3">
                                    <a href="{{ route('admin.job-applications.show', $follow_up->jobApplication) }}">{{ $follow_up->jobApplication->job_title }}</a>
                                    @if($follow_up->jobApplication->company)
                                        · {{ $follow_up->jobApplication->company->name }}
                                    @endif
                                </p>
                            @endif
                            <div class="row g-3 mb-4">
                                <div class="col-md-6"><strong>Date:</strong> {{ $follow_up->follow_up_date?->format('M d, Y') }}</div>
                                <div class="col-md-6"><strong>Type:</strong> {{ $follow_up->follow_up_type ?? '—' }}</div>
                                <div class="col-md-6"><strong>Contact Person:</strong> {{ $follow_up->contact_person ?? '—' }}</div>
                                <div class="col-md-6"><strong>Sentiment:</strong> {{ $follow_up->sentiment ?? '—' }}</div>
                                <div class="col-md-6"><strong>Response Time:</strong> {{ $follow_up->response_time_hours ? $follow_up->response_time_hours . ' hours' : '—' }}</div>
                                <div class="col-md-6"><strong>Completed:</strong> {{ $follow_up->completed ? 'Yes' : 'No' }}</div>
                                @if($follow_up->reminder_date)<div class="col-md-6"><strong>Reminder:</strong> {{ $follow_up->reminder_date->format('M d, Y') }}</div>@endif
                                @if($follow_up->next_action)<div class="col-12"><strong>Next Action:</strong> {{ $follow_up->next_action }}</div>@endif
                            </div>
                            @if($follow_up->message_sent)
                                <div class="mb-3">
                                    <h6 class="fw-semibold">Message Sent</h6>
                                    <p class="text-muted">{!! nl2br(e($follow_up->message_sent)) !!}</p>
                                </div>
                            @endif
                            @if($follow_up->response_received)
                                <div class="mb-3">
                                    <h6 class="fw-semibold">Response Received</h6>
                                    <p class="text-muted">{!! nl2br(e($follow_up->response_received)) !!}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
