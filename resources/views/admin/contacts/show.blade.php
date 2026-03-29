@extends('admin.master')

@section('title', 'View Contact')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Contact Details</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.contacts.index') }}">Contacts</a></li>
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
                                <h5 class="card-title mb-0">{{ $contact->name }}</h5>
                                <div>
                                    <a href="{{ route('admin.contacts.edit', $contact) }}" class="btn btn-outline-warning btn-sm"><i class="bi bi-pencil-square me-1" aria-hidden="true"></i> Edit</a>
                                    <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary btn-sm"><i class="bi bi-arrow-left"></i> Back</a>
                                </div>
                            </div>
                            <p class="text-muted mb-3">
                                @if($contact->company)
                                    <a href="{{ route('admin.companies.show', $contact->company) }}">{{ $contact->company->name }}</a>
                                @else
                                    —
                                @endif
                                @if($contact->designation) · {{ $contact->designation }} @endif
                                @if($contact->contact_type) <span class="badge bg-info">{{ $contact->contact_type }}</span> @endif
                            </p>
                            <div class="row g-3">
                                @if($contact->email)<div class="col-md-6"><strong>Email:</strong> <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></div>@endif
                                @if($contact->phone)<div class="col-md-6"><strong>Phone:</strong> {{ $contact->phone }}</div>@endif
                                @if($contact->linkedin_url)<div class="col-md-6"><strong>LinkedIn:</strong> <a href="{{ $contact->linkedin_url }}" target="_blank">Link</a></div>@endif
                                @if($contact->whatsapp)<div class="col-md-6"><strong>WhatsApp:</strong> {{ $contact->whatsapp }}</div>@endif
                                @if($contact->department)<div class="col-md-6"><strong>Department:</strong> {{ $contact->department }}</div>@endif
                                @if($contact->relationship)<div class="col-md-6"><strong>Relationship:</strong> {{ $contact->relationship }}</div>@endif
                                @if($contact->last_contacted_date)<div class="col-md-6"><strong>Last Contacted:</strong> {{ $contact->last_contacted_date->format('M d, Y') }}</div>@endif
                                @if($contact->response_rate)<div class="col-md-6"><strong>Response Rate:</strong> {{ $contact->response_rate }}</div>@endif
                                <div class="col-md-6"><strong>Helpful:</strong> {{ $contact->helpful ? 'Yes' : 'No' }}</div>
                            </div>
                            @if($contact->notes)
                                <div class="mt-4">
                                    <h6 class="fw-semibold">Notes</h6>
                                    <p class="text-muted">{!! nl2br(e($contact->notes)) !!}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
