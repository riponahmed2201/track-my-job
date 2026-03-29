@extends('admin.master')

@section('title', isset($follow_up) ? 'Edit Follow-up' : 'New Follow-up')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>{{ isset($follow_up) ? 'Edit Follow-up' : 'Add Follow-up' }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.follow-ups.index') }}">Follow-ups</a></li>
                    <li class="breadcrumb-item active">{{ isset($follow_up) ? 'Edit' : 'Create' }}</li>
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

                            <form action="{{ isset($follow_up) ? route('admin.follow-ups.update', $follow_up) : route('admin.follow-ups.store') }}" method="POST">
                                @csrf
                                @if(isset($follow_up)) @method('PUT') @endif

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Job Application <span class="text-danger">*</span></label>
                                        <select name="job_application_id" class="form-select" required>
                                            <option value="">Select Job Application</option>
                                            @foreach($jobApplications as $ja)
                                                <option value="{{ $ja->id }}" {{ old('job_application_id', $follow_up->job_application_id ?? $jobApplicationId ?? '') == $ja->id ? 'selected' : '' }}>
                                                    {{ $ja->job_title }} @ {{ $ja->company?->name ?? '—' }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label fw-semibold">Follow-up Date <span class="text-danger">*</span></label>
                                        <input type="date" name="follow_up_date" class="form-control flatpickr-date" value="{{ old('follow_up_date', isset($follow_up) && $follow_up->follow_up_date ? $follow_up->follow_up_date->format('Y-m-d') : '') }}" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label fw-semibold">Type</label>
                                        <input type="text" name="follow_up_type" class="form-control" placeholder="e.g. Email, Phone" value="{{ old('follow_up_type', $follow_up->follow_up_type ?? '') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Contact Person</label>
                                        <input type="text" name="contact_person" class="form-control" value="{{ old('contact_person', $follow_up->contact_person ?? '') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Subject</label>
                                        <input type="text" name="subject" class="form-control" value="{{ old('subject', $follow_up->subject ?? '') }}">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Message Sent</label>
                                        <textarea name="message_sent" class="form-control" rows="3">{{ old('message_sent', $follow_up->message_sent ?? '') }}</textarea>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Response Received</label>
                                        <textarea name="response_received" class="form-control" rows="3">{{ old('response_received', $follow_up->response_received ?? '') }}</textarea>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Response Time (hours)</label>
                                        <input type="number" name="response_time_hours" class="form-control" min="0" value="{{ old('response_time_hours', $follow_up->response_time_hours ?? '') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Sentiment</label>
                                        <select name="sentiment" class="form-select">
                                            <option value="">—</option>
                                            @foreach (['Positive', 'Neutral', 'Negative'] as $s)
                                                <option value="{{ $s }}" {{ old('sentiment', $follow_up->sentiment ?? '') == $s ? 'selected' : '' }}>{{ $s }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Next Action</label>
                                        <input type="text" name="next_action" class="form-control" value="{{ old('next_action', $follow_up->next_action ?? '') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Reminder Date</label>
                                        <input type="date" name="reminder_date" class="form-control flatpickr-date" value="{{ old('reminder_date', isset($follow_up) && $follow_up->reminder_date ? $follow_up->reminder_date->format('Y-m-d') : '') }}">
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="reminder_set" value="1" {{ old('reminder_set', $follow_up->reminder_set ?? false) ? 'checked' : '' }}>
                                            <label class="form-check-label">Reminder set</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="completed" value="1" {{ old('completed', $follow_up->completed ?? false) ? 'checked' : '' }}>
                                            <label class="form-check-label">Completed</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary px-4">{{ isset($follow_up) ? 'Update' : 'Create' }}</button>
                                    <a href="{{ route('admin.follow-ups.index') }}" class="btn btn-secondary px-4">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
