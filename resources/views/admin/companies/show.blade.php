@extends('admin.master')

@section('title', 'View Company')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Company Details</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.companies.index') }}">Companies</a></li>
                    <li class="breadcrumb-item active">View</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            {{-- Header with title and actions --}}
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title mb-0">{{ $company->name }}</h5>
                                <div>
                                    <a href="{{ route('admin.companies.edit', $company) }}" class="btn btn-outline-warning">
                                        <i class="bi bi-pencil-square me-1" aria-hidden="true"></i> Edit
                                    </a>
                                    <a href="{{ route('admin.companies.index') }}" class="btn btn-secondary">
                                        <i class="bi bi-arrow-left"></i> Back
                                    </a>
                                </div>
                            </div>

                            {{-- Company Logo --}}
                            @if ($company->logo_url)
                                <div class="mb-3 text-center">
                                    <img src="{{ asset('storage/' . $company->logo_url) }}" alt="Logo"
                                        class="img-fluid rounded border shadow-sm"
                                        style="max-height: 120px; object-fit: contain;">
                                </div>
                            @endif

                            {{-- Company Info --}}
                            <div class="mb-3">
                                <p>
                                    <span class="badge bg-info">{{ $company->industry ?? 'N/A' }}</span>
                                    <span class="text-muted ms-2">Founded: {{ $company->founded_year ?? 'N/A' }}</span>
                                </p>

                                @if ($company->website)
                                    <p><strong>Website:</strong>
                                        <a href="{{ $company->website }}" target="_blank">{{ $company->website }}</a>
                                    </p>
                                @endif

                                @if ($company->company_type)
                                    <p><strong>Type:</strong> {{ $company->company_type }}</p>
                                @endif

                                @if ($company->company_size)
                                    <p><strong>Size:</strong> {{ $company->company_size }}</p>
                                @endif

                                @if ($company->headquarters)
                                    <p><strong>Headquarters:</strong> {{ $company->headquarters }}</p>
                                @endif

                                <p>
                                    <strong>Rating:</strong>
                                    <span class="badge bg-success">{{ $company->average_rating ?? 0 }}/5</span>
                                    <span class="text-muted">({{ $company->total_reviews ?? 0 }} Reviews)</span>
                                </p>
                            </div>

                            {{-- External Links --}}
                            <div class="mb-3">
                                @if ($company->glassdoor_url)
                                    <p><strong>Glassdoor:</strong>
                                        <a href="{{ $company->glassdoor_url }}"
                                            target="_blank">{{ $company->glassdoor_url }}</a>
                                    </p>
                                @endif
                                @if ($company->linkedin_url)
                                    <p><strong>LinkedIn:</strong>
                                        <a href="{{ $company->linkedin_url }}"
                                            target="_blank">{{ $company->linkedin_url }}</a>
                                    </p>
                                @endif
                            </div>

                            {{-- Description --}}
                            @if ($company->description)
                                <div class="mt-3">
                                    <h6 class="fw-semibold">Description</h6>
                                    <p class="text-muted">{!! nl2br(e($company->description)) !!}</p>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
