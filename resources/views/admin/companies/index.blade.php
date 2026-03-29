@extends('admin.master')

@section('title', 'Companies')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Companies</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Companies</li>
                </ol>
            </nav>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title">All Companies</h5>
                                <a href="{{ route('admin.companies.create') }}" class="btn btn-primary">
                                    <i class="bi bi-plus-circle"></i> New Company
                                </a>
                            </div>

                            <form method="GET" action="{{ route('admin.companies.index') }}"
                                class="row g-3 mb-4 align-items-end">
                                <div class="col-md-3">
                                    <label class="form-label" for="filter-search">Search</label>
                                    <input type="text" name="search" id="filter-search" class="form-control"
                                        value="{{ request('search') }}" placeholder="Name, website, industry…">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label" for="filter-industry">Industry</label>
                                    <select name="industry" id="filter-industry" class="form-select">
                                        <option value="">All</option>
                                        @foreach ($industries as $ind)
                                            <option value="{{ $ind }}" {{ request('industry') === $ind ? 'selected' : '' }}>
                                                {{ $ind }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label" for="filter-size">Size</label>
                                    <input type="text" name="company_size" id="filter-size" class="form-control"
                                        value="{{ request('company_size') }}" placeholder="e.g. 50">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label" for="filter-hq">Headquarters</label>
                                    <input type="text" name="headquarters" id="filter-hq" class="form-control"
                                        value="{{ request('headquarters') }}" placeholder="City, state…">
                                </div>
                                <div class="col-md-1">
                                    <label class="form-label" for="filter-founded">Founded</label>
                                    <input type="number" name="founded_year" id="filter-founded" class="form-control"
                                        value="{{ request('founded_year') }}" placeholder="Year" min="1800"
                                        max="{{ date('Y') }}">
                                </div>
                                <div class="col-md-2 d-flex flex-wrap gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-funnel"></i> Filter
                                    </button>
                                    <a href="{{ route('admin.companies.index') }}" class="btn btn-outline-secondary">Reset</a>
                                </div>
                            </form>

                            <div class="table-responsive">
                                <table class="table table-striped align-middle">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Logo</th>
                                            <th>Name</th>
                                            <th>Website</th>
                                            <th>Industry</th>
                                            <th>Size</th>
                                            <th>Headquarters</th>
                                            <th>Founded</th>
                                            <th>Rating</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($companies as $company)
                                            <tr>
                                                <td>{{ $loop->iteration + ($companies->currentPage() - 1) * $companies->perPage() }}</td>
                                                <td>
                                                    @if ($company->logo_url)
                                                        <img src="{{ asset('storage/' . $company->logo_url) }}"
                                                            alt="logo"
                                                            style="height:48px;width:48px;object-fit:cover;border-radius:6px;" />
                                                    @else
                                                        <span class="text-muted">—</span>
                                                    @endif
                                                </td>
                                                <td>{{ $company->name }}</td>
                                                <td>
                                                    @if ($company->website)
                                                        <a href="{{ $company->website }}"
                                                            target="_blank">{{ $company->website }}</a>
                                                    @else
                                                        <span class="text-muted">—</span>
                                                    @endif
                                                </td>
                                                <td>{{ $company->industry ?? '-' }}</td>
                                                <td>{{ $company->company_size ?? '-' }}</td>
                                                <td>{{ $company->headquarters ?? '-' }}</td>
                                                <td>{{ $company->founded_year ?? '-' }}</td>
                                                <td>
                                                    @if ($company->average_rating)
                                                        {{ $company->average_rating }} ({{ $company->total_reviews ?? 0 }}
                                                        reviews)
                                                    @else
                                                        <span class="text-muted">—</span>
                                                    @endif
                                                </td>
                                                <td class="text-nowrap">
                                                    <div class="table-action-btns">
                                                        <a href="{{ route('admin.companies.show', $company) }}"
                                                            class="btn btn-sm btn-outline-primary btn-icon"
                                                            title="View"
                                                            aria-label="View company"><i class="bi bi-eye-fill"
                                                                aria-hidden="true"></i></a>
                                                        <a href="{{ route('admin.companies.edit', $company) }}"
                                                            class="btn btn-sm btn-outline-warning btn-icon"
                                                            title="Edit"
                                                            aria-label="Edit company"><i class="bi bi-pencil-square"
                                                                aria-hidden="true"></i></a>
                                                        <form action="{{ route('admin.companies.destroy', $company) }}"
                                                            method="POST" class="d-inline m-0 align-middle"
                                                            onsubmit="return confirm('Delete this company?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-outline-danger btn-icon"
                                                                title="Delete"
                                                                aria-label="Delete company"><i class="bi bi-trash-fill"
                                                                    aria-hidden="true"></i></button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="10" class="text-center">No companies found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-flex justify-content-center">
                                {{ $companies->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
