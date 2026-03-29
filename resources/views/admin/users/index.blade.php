@extends('admin.master')

@section('title', 'Users')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Users</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Users</li>
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
                                <h5 class="card-title">All Users</h5>
                                <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                                    <i class="bi bi-plus-circle"></i> New User
                                </a>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped align-middle">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Email Verified</th>
                                            <th>Created</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($users as $user)
                                            <tr>
                                                <td>{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->email_verified_at ? $user->email_verified_at->format('M d, Y') : '—' }}</td>
                                                <td>{{ $user->created_at->format('M d, Y') }}</td>
                                                <td class="text-nowrap">
                                                    <div class="table-action-btns">
                                                        <a href="{{ route('admin.users.show', $user) }}"
                                                            class="btn btn-sm btn-outline-primary btn-icon"
                                                            title="View"
                                                            aria-label="View user"><i class="bi bi-eye-fill"
                                                                aria-hidden="true"></i></a>
                                                        <a href="{{ route('admin.users.edit', $user) }}"
                                                            class="btn btn-sm btn-outline-warning btn-icon"
                                                            title="Edit"
                                                            aria-label="Edit user"><i class="bi bi-pencil-square"
                                                                aria-hidden="true"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">No users found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-flex justify-content-center">
                                {{ $users->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
