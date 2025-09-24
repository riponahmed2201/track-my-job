@extends('admin.master')

@section('title', 'Blogs')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Blogs</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Blogs</li>
            </ol>
        </nav>
    </div>

    @if(session('success'))
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
                            <h5 class="card-title">All Blogs</h5>
                            <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle"></i> New Blog</a>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped align-middle">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Thumbnail</th>
                                        <th>Title</th>
                                        <th>Slug</th>
                                        <th>Published</th>
                                        <th>Published At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($blogs as $blog)
                                        <tr>
                                            <td>{{ $blog->id }}</td>
                                            <td>
                                                @if($blog->thumbnail_path)
                                                    <img src="{{ asset('storage/'.$blog->thumbnail_path) }}" alt="thumb" style="height:48px;width:72px;object-fit:cover;border-radius:6px;" />
                                                @else
                                                    <span class="text-muted">—</span>
                                                @endif
                                            </td>
                                            <td>{{ $blog->title }}</td>
                                            <td>{{ $blog->slug }}</td>
                                            <td>
                                                <span class="badge {{ $blog->is_published ? 'bg-success' : 'bg-secondary' }}">{{ $blog->is_published ? 'Yes' : 'No' }}</span>
                                            </td>
                                            <td>{{ optional($blog->published_at)->format('M d, Y') ?: '-' }}</td>
                                            <td>
                                                <a href="{{ route('admin.blogs.show',$blog) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                                                <a href="{{ route('admin.blogs.edit',$blog) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                                                <form action="{{ route('admin.blogs.destroy',$blog) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this blog?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No blogs found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-center">
                            {{ $blogs->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection


