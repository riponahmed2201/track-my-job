@extends('admin.master')

@section('title', 'Contacts')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Contacts</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Contacts</li>
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
                                <h5 class="card-title">All Contacts</h5>
                                <a href="{{ route('admin.contacts.create') }}" class="btn btn-primary">
                                    <i class="bi bi-plus-circle"></i> New Contact
                                </a>
                            </div>

                            <form method="GET" action="{{ route('admin.contacts.index') }}" class="row g-3 mb-4 align-items-end">
                                <div class="col-md-4">
                                    <label class="form-label">Company</label>
                                    <select name="company_id" class="form-select">
                                        <option value="">All</option>
                                        @foreach ($companies as $c)
                                            <option value="{{ $c->id }}" {{ request('company_id') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Type</label>
                                    <select name="contact_type" class="form-select">
                                        <option value="">All</option>
                                        @foreach (['HR', 'Recruiter', 'Manager', 'Employee', 'Referral'] as $t)
                                            <option value="{{ $t }}" {{ request('contact_type') == $t ? 'selected' : '' }}>{{ $t }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary w-100"><i class="bi bi-funnel"></i> Filter</button>
                                </div>
                                <div class="col-md-2">
                                    <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary w-100">Reset</a>
                                </div>
                            </form>

                            <div class="table-responsive">
                                <table class="table table-striped align-middle">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Company</th>
                                            <th>Designation</th>
                                            <th>Contact Type</th>
                                            <th>Email / Phone</th>
                                            <th>Last Contacted</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($contacts as $contact)
                                            <tr>
                                                <td>{{ $loop->iteration + ($contacts->currentPage() - 1) * $contacts->perPage() }}</td>
                                                <td>{{ $contact->name }}</td>
                                                <td>{{ $contact->company?->name ?? '—' }}</td>
                                                <td>{{ $contact->designation ?? '—' }}</td>
                                                <td>{{ $contact->contact_type ?? '—' }}</td>
                                                <td>
                                                    @if($contact->email)<small>{{ $contact->email }}</small>@endif
                                                    @if($contact->phone)<br><small>{{ $contact->phone }}</small>@endif
                                                    @if(!$contact->email && !$contact->phone)—@endif
                                                </td>
                                                <td>{{ $contact->last_contacted_date?->format('M d, Y') ?? '—' }}</td>
                                                <td class="text-nowrap">
                                                    <div class="table-action-btns">
                                                        <a href="{{ route('admin.contacts.show', $contact) }}"
                                                            class="btn btn-sm btn-outline-primary btn-icon"
                                                            title="View"
                                                            aria-label="View contact"><i class="bi bi-eye-fill"
                                                                aria-hidden="true"></i></a>
                                                        <a href="{{ route('admin.contacts.edit', $contact) }}"
                                                            class="btn btn-sm btn-outline-warning btn-icon"
                                                            title="Edit"
                                                            aria-label="Edit contact"><i class="bi bi-pencil-square"
                                                                aria-hidden="true"></i></a>
                                                        <form action="{{ route('admin.contacts.destroy', $contact) }}"
                                                            method="POST" class="d-inline m-0 align-middle"
                                                            onsubmit="return confirm('Delete this contact?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-outline-danger btn-icon"
                                                                title="Delete"
                                                                aria-label="Delete contact"><i class="bi bi-trash-fill"
                                                                    aria-hidden="true"></i></button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center">No contacts found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center">{{ $contacts->links('pagination::bootstrap-4') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
