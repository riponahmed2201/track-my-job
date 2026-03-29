@extends('admin.master')

@section('title', 'Account settings')

@section('content')
    @php
        $passwordFieldErrors = $errors->hasAny(['current_password', 'password', 'password_confirmation']);
    @endphp
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Account settings</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Account</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row justify-content-center">
                <div class="col-lg-7 col-xl-6">
                    <p class="text-muted mb-4">Update your name and email above; use the second box only when you want a
                        new password.</p>

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('warning'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            {{ session('warning') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Profile --}}
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="card-title mb-1">Your details</h5>
                            <p class="small text-muted mb-3">নাম, ইমেইল ও ফোন (ঐচ্ছিক)</p>

                            @if ($errors->any() && ! $passwordFieldErrors)
                                <div class="alert alert-danger py-2">
                                    <ul class="mb-0 small">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('admin.profile.update') }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        value="{{ old('name', $user->name) }}" required maxlength="255">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" id="email" class="form-control"
                                        value="{{ old('email', $user->email) }}" required maxlength="255">
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone <span
                                            class="text-muted fw-normal">(optional)</span></label>
                                    <input type="text" name="phone" id="phone" class="form-control"
                                        value="{{ old('phone', $user->phone) }}" maxlength="30"
                                        placeholder="e.g. 01xxxxxxxxx" autocomplete="tel">
                                </div>

                                <button type="submit" class="btn btn-primary">Save details</button>
                            </form>
                        </div>
                    </div>

                    {{-- Password --}}
                    <div class="card shadow-sm border-0 bg-light" id="change-password">
                        <div class="card-body">
                            <h5 class="card-title mb-1">Change password</h5>
                            <p class="small text-muted mb-3">After a successful change you will be signed out and need to log
                                in again.</p>

                            @if ($passwordFieldErrors)
                                <div class="alert alert-danger py-2">
                                    <ul class="mb-0 small">
                                        @foreach ($errors->get('current_password') as $e)
                                            <li>{{ $e }}</li>
                                        @endforeach
                                        @foreach ($errors->get('password') as $e)
                                            <li>{{ $e }}</li>
                                        @endforeach
                                        @foreach ($errors->get('password_confirmation') as $e)
                                            <li>{{ $e }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('admin.password.update') }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="current_password" class="form-label">Current password</label>
                                    <input type="password" name="current_password" id="current_password"
                                        class="form-control" required autocomplete="current-password"
                                        placeholder="••••••••">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">New password</label>
                                    <input type="password" name="password" id="password" class="form-control" required
                                        minlength="8" autocomplete="new-password" placeholder="At least 8 characters">
                                </div>
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Confirm new password</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        class="form-control" required autocomplete="new-password"
                                        placeholder="Repeat new password">
                                </div>

                                <button type="submit" class="btn btn-dark">Update password</button>
                            </form>
                        </div>
                    </div>

                    <p class="mt-3 mb-0">
                        <a href="{{ route('admin.dashboard') }}" class="text-decoration-none small">&larr; Back to
                            dashboard</a>
                    </p>
                </div>
            </div>
        </section>
    </main>

    @if ($passwordFieldErrors)
        <script>
            document.getElementById('change-password')?.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        </script>
    @endif
@endsection
