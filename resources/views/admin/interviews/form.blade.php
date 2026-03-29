@extends('admin.master')

@section('title', isset($interview) ? 'Edit Interview' : 'New Interview')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>{{ isset($interview) ? 'Edit Interview' : 'Record Interview' }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.interviews.index') }}">Interviews</a></li>
                    <li class="breadcrumb-item active">{{ isset($interview) ? 'Edit' : 'Create' }}</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">@foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach</ul>
                                </div>
                            @endif

                            <form action="{{ isset($interview) ? route('admin.interviews.update', $interview) : route('admin.interviews.store') }}" method="POST">
                                @csrf
                                @if(isset($interview)) @method('PUT') @endif

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Job Application <span class="text-danger">*</span></label>
                                        <select name="job_application_id" class="form-select" required>
                                            <option value="">Select Job Application</option>
                                            @foreach($jobApplications as $ja)
                                                <option value="{{ $ja->id }}" {{ old('job_application_id', $interview->job_application_id ?? $jobApplicationId ?? '') == $ja->id ? 'selected' : '' }}>
                                                    {{ $ja->job_title }} @ {{ $ja->company?->name ?? '—' }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label fw-semibold">Round</label>
                                        <input type="number" name="interview_round" class="form-control" min="1" value="{{ old('interview_round', $interview->interview_round ?? 1) }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label fw-semibold">Type</label>
                                        <input type="text" name="interview_type" class="form-control" placeholder="e.g. Phone, Technical" value="{{ old('interview_type', $interview->interview_type ?? '') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Interviewer Name</label>
                                        <input type="text" name="interviewer_name" class="form-control" value="{{ old('interviewer_name', $interview->interviewer_name ?? '') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Interviewer Designation</label>
                                        <input type="text" name="interviewer_designation" class="form-control" value="{{ old('interviewer_designation', $interview->interviewer_designation ?? '') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Scheduled Date & Time</label>
                                        <input type="datetime-local" name="scheduled_date" class="form-control" value="{{ old('scheduled_date', isset($interview) && $interview->scheduled_date ? $interview->scheduled_date->format('Y-m-d\TH:i') : '') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Duration (minutes)</label>
                                        <input type="number" name="duration_minutes" class="form-control" min="0" value="{{ old('duration_minutes', $interview->duration_minutes ?? '') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Location / Format</label>
                                        <input type="text" name="location" class="form-control" placeholder="e.g. Video Call" value="{{ old('location', $interview->location ?? '') }}">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Meeting Link</label>
                                        <input type="url" name="meeting_link" class="form-control" value="{{ old('meeting_link', $interview->meeting_link ?? '') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Interview Format</label>
                                        <input type="text" name="interview_format" class="form-control" placeholder="e.g. Behavioral, Technical" value="{{ old('interview_format', $interview->interview_format ?? '') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Outcome</label>
                                        <select name="outcome" class="form-select">
                                            <option value="">—</option>
                                            @foreach (['Pending', 'Passed', 'Failed', 'Rescheduled'] as $o)
                                                <option value="{{ $o }}" {{ old('outcome', $interview->outcome ?? '') == $o ? 'selected' : '' }}>{{ $o }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Confidence (1-5)</label>
                                        <input type="number" name="confidence_level" class="form-control" min="1" max="5" value="{{ old('confidence_level', $interview->confidence_level ?? '') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Difficulty (1-5)</label>
                                        <input type="number" name="difficulty_level" class="form-control" min="1" max="5" value="{{ old('difficulty_level', $interview->difficulty_level ?? '') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Experience (1-5)</label>
                                        <input type="number" name="overall_experience" class="form-control" min="1" max="5" value="{{ old('overall_experience', $interview->overall_experience ?? '') }}">
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="next_round_scheduled" value="1" {{ old('next_round_scheduled', $interview->next_round_scheduled ?? false) ? 'checked' : '' }}>
                                            <label class="form-check-label">Next round scheduled</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="follow_up_required" value="1" {{ old('follow_up_required', $interview->follow_up_required ?? false) ? 'checked' : '' }}>
                                            <label class="form-check-label">Follow-up required</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Preparation Notes</label>
                                        <textarea name="preparation_notes" class="form-control" rows="2">{{ old('preparation_notes', $interview->preparation_notes ?? '') }}</textarea>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Questions Asked</label>
                                        <textarea name="questions_asked" class="form-control" rows="3">{{ old('questions_asked', $interview->questions_asked ?? '') }}</textarea>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">My Answers / Notes</label>
                                        <textarea name="my_answers" class="form-control" rows="3">{{ old('my_answers', $interview->my_answers ?? '') }}</textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Technical Topics</label>
                                        <textarea name="technical_topics" class="form-control" rows="2">{{ old('technical_topics', $interview->technical_topics ?? '') }}</textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Coding Problems</label>
                                        <textarea name="coding_problems" class="form-control" rows="2">{{ old('coding_problems', $interview->coding_problems ?? '') }}</textarea>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Interview Feedback (your)</label>
                                        <textarea name="interview_feedback" class="form-control" rows="2">{{ old('interview_feedback', $interview->interview_feedback ?? '') }}</textarea>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Interviewer Feedback</label>
                                        <textarea name="interviewer_feedback" class="form-control" rows="2">{{ old('interviewer_feedback', $interview->interviewer_feedback ?? '') }}</textarea>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary px-4">{{ isset($interview) ? 'Update' : 'Create' }}</button>
                                    <a href="{{ route('admin.interviews.index') }}" class="btn btn-secondary px-4">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
