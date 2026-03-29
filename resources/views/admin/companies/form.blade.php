@extends('admin.master')

@section('title', isset($company) ? 'Edit Company' : 'New Company')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>{{ isset($company) ? 'Edit Company' : 'Create Company' }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.companies.index') }}">Companies</a></li>
                    <li class="breadcrumb-item active">{{ isset($company) ? 'Edit' : 'Create' }}</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title mb-4">
                                {{ isset($company) ? 'Edit Company Information' : 'Company Information' }}
                            </h5>

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
                                action="{{ isset($company) ? route('admin.companies.update', $company->id) : route('admin.companies.store') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @if (isset($company))
                                    @method('PUT')
                                @endif

                                <div class="row g-3">
                                    {{-- Left Column --}}
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-semibold">Company Name <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{ old('name', $company->name ?? '') }}" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label fw-semibold">Website</label>
                                            <input type="url" name="website" class="form-control"
                                                value="{{ old('website', $company->website ?? '') }}">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label fw-semibold">Industry</label>
                                            <input type="text" name="industry" class="form-control"
                                                value="{{ old('industry', $company->industry ?? '') }}">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label fw-semibold">Company Size</label>
                                            <input type="text" name="company_size" class="form-control"
                                                value="{{ old('company_size', $company->company_size ?? '') }}">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label fw-semibold">Headquarters</label>
                                            <input type="text" name="headquarters" class="form-control"
                                                value="{{ old('headquarters', $company->headquarters ?? '') }}">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label fw-semibold">Founded Year</label>
                                            <input type="number" name="founded_year" class="form-control"
                                                value="{{ old('founded_year', $company->founded_year ?? '') }}">
                                        </div>
                                    </div>

                                    {{-- Right Column --}}
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-semibold">Company Type</label>
                                            <input type="text" name="company_type" class="form-control"
                                                value="{{ old('company_type', $company->company_type ?? '') }}">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label fw-semibold">Logo</label>
                                            <input type="file" name="logo_url" class="form-control" accept="image/*">
                                            @if (isset($company) && $company->logo_url)
                                                <img src="{{ asset('storage/' . $company->logo_url) }}" alt="Logo"
                                                    class="mt-2 rounded shadow-sm border" style="height:60px;">
                                            @endif
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label fw-semibold">Glassdoor URL</label>
                                            <input type="url" name="glassdoor_url" class="form-control"
                                                value="{{ old('glassdoor_url', $company->glassdoor_url ?? '') }}">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label fw-semibold">LinkedIn URL</label>
                                            <input type="url" name="linkedin_url" class="form-control"
                                                value="{{ old('linkedin_url', $company->linkedin_url ?? '') }}">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label fw-semibold">Average Rating</label>
                                            <input type="number" step="0.01" min="0" max="5"
                                                name="average_rating" class="form-control"
                                                value="{{ old('average_rating', $company->average_rating ?? '') }}">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label fw-semibold">Total Reviews</label>
                                            <input type="number" name="total_reviews" class="form-control"
                                                value="{{ old('total_reviews', $company->total_reviews ?? '') }}">
                                        </div>
                                    </div>

                                    {{-- Full Width Description --}}
                                    <div class="col-12">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-semibold">Description</label>
                                            <textarea name="description" rows="4" class="form-control">{{ old('description', $company->description ?? '') }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary px-4">
                                        {{ isset($company) ? 'Update Company' : 'Create Company' }}
                                    </button>
                                    <a href="{{ route('admin.companies.index') }}"
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
