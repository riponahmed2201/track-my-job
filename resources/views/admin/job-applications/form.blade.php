@extends('admin.master')

@section('title', isset($jobApplication) ? 'Edit Job Application' : 'New Job Application')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>{{ isset($jobApplication) ? 'Edit Job Application' : 'Create Job Application' }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.job-applications.index') }}">Job Applications</a>
                    </li>
                    <li class="breadcrumb-item active">{{ isset($jobApplication) ? 'Edit' : 'Create' }}</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title mb-4">
                                {{ isset($jobApplication) ? 'Edit Job Application' : 'Job Application Information' }}</h5>

                            {{-- Validation Errors --}}
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            {{-- Form --}}
                            <form
                                action="{{ isset($jobApplication) ? route('admin.job-applications.update', $jobApplication->id) : route('admin.job-applications.store') }}"
                                method="POST">
                                @csrf
                                @if (isset($jobApplication))
                                    @method('PUT')
                                @endif

                                <div class="row g-3">
                                    {{-- Left Column --}}
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-semibold">User</label>
                                            <select name="user_id" class="form-control">
                                                <option value="">Select User</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}"
                                                        {{ old('user_id', $jobApplication->user_id ?? '') == $user->id ? 'selected' : '' }}>
                                                        {{ $user->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label fw-semibold">Company</label>
                                            <select name="company_id" class="form-control">
                                                <option value="">Select Company</option>
                                                @foreach ($companies as $company)
                                                    <option value="{{ $company->id }}"
                                                        {{ old('company_id', $jobApplication->company_id ?? '') == $company->id ? 'selected' : '' }}>
                                                        {{ $company->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label fw-semibold">Job Title <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="job_title" class="form-control"
                                                value="{{ old('job_title', $jobApplication->job_title ?? '') }}" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label fw-semibold">Job URL</label>
                                            <input type="url" name="job_url" class="form-control"
                                                value="{{ old('job_url', $jobApplication->job_url ?? '') }}">
                                        </div>

                                        <div class="row g-3 mb-3">
                                            <div class="col">
                                                <label class="form-label fw-semibold">Salary Min</label>
                                                <input type="number" name="salary_range_min" class="form-control"
                                                    value="{{ old('salary_range_min', $jobApplication->salary_range_min ?? '') }}">
                                            </div>
                                            <div class="col">
                                                <label class="form-label fw-semibold">Salary Max</label>
                                                <input type="number" name="salary_range_max" class="form-control"
                                                    value="{{ old('salary_range_max', $jobApplication->salary_range_max ?? '') }}">
                                            </div>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label fw-semibold">Currency</label>
                                            <input type="text" name="currency" class="form-control"
                                                value="{{ old('currency', $jobApplication->currency ?? '') }}">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label fw-semibold">Location</label>
                                            <input type="text" name="location" class="form-control"
                                                value="{{ old('location', $jobApplication->location ?? '') }}">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label fw-semibold">Work Type</label>
                                            <input type="text" name="work_type" class="form-control"
                                                value="{{ old('work_type', $jobApplication->work_type ?? '') }}">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label fw-semibold">Employment Type</label>
                                            <input type="text" name="employment_type" class="form-control"
                                                value="{{ old('employment_type', $jobApplication->employment_type ?? '') }}">
                                        </div>
                                    </div>

                                    {{-- Right Column --}}
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-semibold">Application Date</label>
                                            <input type="date" name="application_date" class="form-control flatpickr-date"
                                                value="{{ old('application_date', isset($jobApplication) && $jobApplication->application_date ? $jobApplication->application_date->format('Y-m-d') : '') }}">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label fw-semibold">Application Deadline</label>
                                            <input type="date" name="application_deadline" class="form-control flatpickr-date"
                                                value="{{ old('application_deadline', isset($jobApplication) && $jobApplication->application_deadline ? $jobApplication->application_deadline->format('Y-m-d') : '') }}">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label fw-semibold">Status</label>
                                            <select name="application_status" class="form-control">
                                                @foreach (['applied', 'under_review', 'phone_screen', 'technical_test', 'interview', 'final_interview', 'offer', 'accepted', 'rejected', 'withdrawn'] as $status)
                                                    <option value="{{ $status }}"
                                                        {{ old('application_status', $jobApplication->application_status ?? '') == $status ? 'selected' : '' }}>
                                                        {{ ucfirst(str_replace('_', ' ', $status)) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label fw-semibold">Priority</label>
                                            <select name="priority" class="form-control">
                                                @foreach (['low', 'medium', 'high'] as $priority)
                                                    <option value="{{ $priority }}"
                                                        {{ old('priority', $jobApplication->priority ?? '') == $priority ? 'selected' : '' }}>
                                                        {{ ucfirst($priority) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label fw-semibold">Source</label>
                                            <input type="text" name="source" class="form-control"
                                                value="{{ old('source', $jobApplication->source ?? '') }}">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label fw-semibold">Referral Contact</label>
                                            <input type="text" name="referral_contact" class="form-control"
                                                value="{{ old('referral_contact', $jobApplication->referral_contact ?? '') }}">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label fw-semibold">Expected Salary</label>
                                            <input type="number" name="expected_salary" class="form-control"
                                                value="{{ old('expected_salary', $jobApplication->expected_salary ?? '') }}">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label fw-semibold">Notice Period</label>
                                            <input type="text" name="notice_period" class="form-control"
                                                value="{{ old('notice_period', $jobApplication->notice_period ?? '') }}">
                                        </div>

                                        {{-- Last & Next Follow-up Dates --}}
                                        <div class="row g-3 mb-3">
                                            <div class="col">
                                                <label class="form-label fw-semibold">Last Follow-up Date</label>
                                                <input type="date" name="last_follow_up_date" class="form-control flatpickr-date"
                                                    value="{{ old('last_follow_up_date', isset($jobApplication) && $jobApplication->last_follow_up_date ? $jobApplication->last_follow_up_date->format('Y-m-d') : '') }}">
                                            </div>
                                            <div class="col">
                                                <label class="form-label fw-semibold">Next Follow-up Date</label>
                                                <input type="date" name="next_follow_up_date" class="form-control flatpickr-date"
                                                    value="{{ old('next_follow_up_date', isset($jobApplication) && $jobApplication->next_follow_up_date ? $jobApplication->next_follow_up_date->format('Y-m-d') : '') }}">
                                            </div>
                                        </div>

                                        {{-- Cover Letter & Portfolio --}}
                                        <div class="form-group mb-3 d-flex align-items-center gap-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="cover_letter_sent"
                                                    value="1" id="coverLetter"
                                                    {{ old('cover_letter_sent', $jobApplication->cover_letter_sent ?? false) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="coverLetter">Cover Letter
                                                    Sent</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="portfolio_sent"
                                                    value="1" id="portfolioSent"
                                                    {{ old('portfolio_sent', $jobApplication->portfolio_sent ?? false) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="portfolioSent">Portfolio Sent</label>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Full Width Job Description --}}
                                    <div class="col-12">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-semibold">Job Description <span
                                                    class="text-danger">*</span></label>
                                            <textarea name="job_description" rows="6" class="form-control" required>{{ old('job_description', $jobApplication->job_description ?? '') }}</textarea>
                                        </div>
                                    </div>

                                    {{-- Full Width Notes --}}
                                    <div class="col-12">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-semibold">Notes</label>
                                            <textarea name="notes" rows="4" class="form-control">{{ old('notes', $jobApplication->notes ?? '') }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <button type="submit"
                                        class="btn btn-primary px-4">{{ isset($jobApplication) ? 'Update' : 'Create' }}</button>
                                    <a href="{{ route('admin.job-applications.index') }}"
                                        class="btn btn-secondary px-4">Cancel</a>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
