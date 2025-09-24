@extends('admin.master')

@section('title', 'Edit Blog')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Edit Blog</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.blogs.index') }}">Blogs</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Blog Information</h5>

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.blogs.update', $blog) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" value="{{ old('title', $blog->title) }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Excerpt</label>
                                <textarea name="excerpt" rows="2" class="form-control">{{ old('excerpt', $blog->excerpt) }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Content</label>
                                <textarea name="content" rows="8" class="form-control" required>{{ old('content', $blog->content) }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Thumbnail Image</label>
                                <input type="file" name="thumbnail" class="form-control" accept="image/*">
                                @if($blog->thumbnail_path)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/'.$blog->thumbnail_path) }}" alt="Thumbnail" style="max-height: 100px;" class="rounded border">
                                    </div>
                                @endif
                            </div>
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="is_published" name="is_published" value="1" {{ old('is_published', $blog->is_published) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_published">Publish</label>
                            </div>
                            <div>
                                <button class="btn btn-primary">Update Blog</button>
                                <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection


