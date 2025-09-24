@extends('admin.master')

@section('title', 'View Blog')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Blog Details</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.blogs.index') }}">Blogs</a></li>
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
                            <h5 class="card-title">{{ $blog->title }}</h5>
                            <div>
                                <a href="{{ route('admin.blogs.edit',$blog) }}" class="btn btn-warning"><i class="bi bi-pencil"></i> Edit</a>
                                <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Back</a>
                            </div>
                        </div>

                        @if($blog->thumbnail_path)
                            <div class="mb-3">
                                <img src="{{ asset('storage/'.$blog->thumbnail_path) }}" alt="Thumbnail" class="img-fluid rounded border" style="max-height: 320px; object-fit: cover;">
                            </div>
                        @endif

                        <p><span class="badge {{ $blog->is_published ? 'bg-success' : 'bg-secondary' }}">{{ $blog->is_published ? 'Published' : 'Draft' }}</span>
                           <span class="text-muted ms-2">{{ optional($blog->published_at)->format('M d, Y') }}</span></p>

                        @if($blog->excerpt)
                            <p class="text-muted">{{ $blog->excerpt }}</p>
                        @endif

                        <div class="mt-3">
                            {!! nl2br(e($blog->content)) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection


