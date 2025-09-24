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
                                                <td>{{ $company->id }}</td>
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
                                                <td>
                                                    {{-- View Button --}}
                                                    <a href="{{ route('admin.companies.show', $company) }}"
                                                        class="btn btn-sm btn-info">
                                                        <i class="bi bi-eye"></i>
                                                    </a>

                                                    {{-- Edit Button --}}
                                                    <a href="{{ route('admin.companies.edit', $company) }}"
                                                        class="btn btn-sm btn-warning">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>

                                                    {{-- Delete Button --}}
                                                    <form action="{{ route('admin.companies.destroy', $company) }}"
                                                        method="POST" class="d-inline"
                                                        onsubmit="return confirm('Delete this company?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
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
