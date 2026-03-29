@extends('admin.master')

@section('title', 'View Interview')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Interview Details</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.interviews.index') }}">Interviews</a></li>
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
                                <h5 class="card-title mb-0">
                                    @if($interview->jobApplication)
                                        <a href="{{ route('admin.job-applications.show', $interview->jobApplication) }}">{{ $interview->jobApplication->job_title }}</a>
                                        @if($interview->jobApplication->company)
                                            <span class="text-muted"> · {{ $interview->jobApplication->company->name }}</span>
                                        @endif
                                    @else
                                        Interview #{{ $interview->id }}
                                    @endif
                                </h5>
                                <div>
                                    <a href="{{ route('admin.interviews.edit', $interview) }}" class="btn btn-outline-warning btn-sm"><i class="bi bi-pencil-square me-1" aria-hidden="true"></i> Edit</a>
                                    <a href="{{ route('admin.interviews.index') }}" class="btn btn-secondary btn-sm"><i class="bi bi-arrow-left"></i> Back</a>
                                </div>
                            </div>
                            <p class="mb-3">
                                Round {{ $interview->interview_round ?? '—' }}
                                @if($interview->interview_type) · {{ $interview->interview_type }} @endif
                                @if($interview->outcome) <span class="badge bg-{{ $interview->outcome === 'Passed' ? 'success' : ($interview->outcome === 'Failed' ? 'danger' : 'secondary') }}">{{ $interview->outcome }}</span> @endif
                            </p>
                            <div class="row g-3 mb-4">
                                @if($interview->scheduled_date)<div class="col-md-6"><strong>Scheduled:</strong> {{ $interview->scheduled_date->format('M d, Y H:i') }}</div>@endif
                                @if($interview->duration_minutes)<div class="col-md-6"><strong>Duration:</strong> {{ $interview->duration_minutes }} min</div>@endif
                                @if($interview->location)<div class="col-md-6"><strong>Location:</strong> {{ $interview->location }}</div>@endif
                                @if($interview->interviewer_name)<div class="col-md-6"><strong>Interviewer:</strong> {{ $interview->interviewer_name }} @if($interview->interviewer_designation)({{ $interview->interviewer_designation }})@endif</div>@endif
                                @if($interview->meeting_link)<div class="col-12"><strong>Meeting Link:</strong> <a href="{{ $interview->meeting_link }}" target="_blank">{{ $interview->meeting_link }}</a></div>@endif
                                @if($interview->confidence_level)<div class="col-md-4"><strong>Confidence:</strong> {{ $interview->confidence_level }}/5</div>@endif
                                @if($interview->difficulty_level)<div class="col-md-4"><strong>Difficulty:</strong> {{ $interview->difficulty_level }}/5</div>@endif
                                @if($interview->overall_experience)<div class="col-md-4"><strong>Experience:</strong> {{ $interview->overall_experience }}/5</div>@endif
                            </div>
                            @if($interview->preparation_notes)<div class="mb-3"><h6 class="fw-semibold">Preparation Notes</h6><p class="text-muted">{!! nl2br(e($interview->preparation_notes)) !!}</p></div>@endif
                            @if($interview->questions_asked)<div class="mb-3"><h6 class="fw-semibold">Questions Asked</h6><p class="text-muted">{!! nl2br(e($interview->questions_asked)) !!}</p></div>@endif
                            @if($interview->my_answers)<div class="mb-3"><h6 class="fw-semibold">My Answers</h6><p class="text-muted">{!! nl2br(e($interview->my_answers)) !!}</p></div>@endif
                            @if($interview->technical_topics)<div class="mb-3"><h6 class="fw-semibold">Technical Topics</h6><p class="text-muted">{!! nl2br(e($interview->technical_topics)) !!}</p></div>@endif
                            @if($interview->coding_problems)<div class="mb-3"><h6 class="fw-semibold">Coding Problems</h6><p class="text-muted">{!! nl2br(e($interview->coding_problems)) !!}</p></div>@endif
                            @if($interview->interview_feedback)<div class="mb-3"><h6 class="fw-semibold">Your Feedback</h6><p class="text-muted">{!! nl2br(e($interview->interview_feedback)) !!}</p></div>@endif
                            @if($interview->interviewer_feedback)<div class="mb-3"><h6 class="fw-semibold">Interviewer Feedback</h6><p class="text-muted">{!! nl2br(e($interview->interviewer_feedback)) !!}</p></div>@endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
