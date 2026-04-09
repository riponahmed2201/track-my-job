@extends('admin.master')

@section('title', 'Database Backup')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Database Backup</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Database Backup</li>
                </ol>
            </nav>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title mb-0">Available Backups</h5>
                                <form action="{{ route('admin.database-backups.store') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-plus-circle me-1"></i> Create Backup
                                    </button>
                                </form>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped align-middle">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>File</th>
                                            <th>Size</th>
                                            <th>Created</th>
                                            <th class="text-nowrap">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($files as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td><code>{{ $item['file'] }}</code></td>
                                                <td>{{ number_format($item['size'] / 1024, 2) }} KB</td>
                                                <td>{{ \Carbon\Carbon::createFromTimestamp($item['last_modified'])->format('M d, Y h:i A') }}</td>
                                                <td class="text-nowrap">
                                                    <div class="table-action-btns">
                                                        <a href="{{ route('admin.database-backups.download', $item['file']) }}"
                                                            class="btn btn-sm btn-outline-primary btn-icon"
                                                            title="Download"
                                                            aria-label="Download backup">
                                                            <i class="bi bi-download" aria-hidden="true"></i>
                                                        </a>
                                                        <form
                                                            action="{{ route('admin.database-backups.destroy', $item['file']) }}"
                                                            method="POST" class="d-inline m-0"
                                                            onsubmit="return confirm('Delete this backup file?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-outline-danger btn-icon"
                                                                title="Delete"
                                                                aria-label="Delete backup">
                                                                <i class="bi bi-trash-fill" aria-hidden="true"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center text-muted">
                                                    No backup found. Click "Create Backup" to generate one.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

