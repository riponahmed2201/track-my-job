@extends('admin.master')

@section('title', isset($contact) ? 'Edit Contact' : 'New Contact')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>{{ isset($contact) ? 'Edit Contact' : 'Create Contact' }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.contacts.index') }}">Contacts</a></li>
                    <li class="breadcrumb-item active">{{ isset($contact) ? 'Edit' : 'Create' }}</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">@foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach</ul>
                                </div>
                            @endif

                            <form action="{{ isset($contact) ? route('admin.contacts.update', $contact) : route('admin.contacts.store') }}" method="POST">
                                @csrf
                                @if(isset($contact)) @method('PUT') @endif

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Company <span class="text-danger">*</span></label>
                                        <select name="company_id" class="form-select" required>
                                            <option value="">Select Company</option>
                                            @foreach($companies as $c)
                                                <option value="{{ $c->id }}" {{ old('company_id', $contact->company_id ?? $companyId ?? '') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" value="{{ old('name', $contact->name ?? '') }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Designation</label>
                                        <input type="text" name="designation" class="form-control" value="{{ old('designation', $contact->designation ?? '') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Department</label>
                                        <input type="text" name="department" class="form-control" value="{{ old('department', $contact->department ?? '') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Email</label>
                                        <input type="email" name="email" class="form-control" value="{{ old('email', $contact->email ?? '') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Phone</label>
                                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $contact->phone ?? '') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Contact Type</label>
                                        <select name="contact_type" class="form-select">
                                            <option value="">—</option>
                                            @foreach(['HR', 'Recruiter', 'Manager', 'Employee', 'Referral'] as $t)
                                                <option value="{{ $t }}" {{ old('contact_type', $contact->contact_type ?? '') == $t ? 'selected' : '' }}>{{ $t }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Relationship</label>
                                        <input type="text" name="relationship" class="form-control" value="{{ old('relationship', $contact->relationship ?? '') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">LinkedIn URL</label>
                                        <input type="url" name="linkedin_url" class="form-control" value="{{ old('linkedin_url', $contact->linkedin_url ?? '') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">WhatsApp</label>
                                        <input type="text" name="whatsapp" class="form-control" value="{{ old('whatsapp', $contact->whatsapp ?? '') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Last Contacted Date</label>
                                        <input type="date" name="last_contacted_date" class="form-control flatpickr-date" value="{{ old('last_contacted_date', isset($contact) && $contact->last_contacted_date ? $contact->last_contacted_date->format('Y-m-d') : '') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Response Rate</label>
                                        <select name="response_rate" class="form-select">
                                            <option value="">—</option>
                                            @foreach(['High', 'Medium', 'Low', 'No Response'] as $r)
                                                <option value="{{ $r }}" {{ old('response_rate', $contact->response_rate ?? '') == $r ? 'selected' : '' }}>{{ $r }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="helpful" value="1" {{ old('helpful', $contact->helpful ?? true) ? 'checked' : '' }}>
                                            <label class="form-check-label">Helpful</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Notes</label>
                                        <textarea name="notes" class="form-control" rows="3">{{ old('notes', $contact->notes ?? '') }}</textarea>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary px-4">{{ isset($contact) ? 'Update' : 'Create' }}</button>
                                    <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary px-4">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
