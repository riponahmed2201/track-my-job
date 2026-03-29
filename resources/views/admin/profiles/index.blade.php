@extends('admin.master')

@section('title', 'Account settings')

@section('content')
    @php
        $passwordFieldErrors = $errors->hasAny(['current_password', 'password', 'password_confirmation']);
        $activePasswordTab = $passwordFieldErrors
            || request('tab') === 'password'
            || session('warning');
        $activeDetailsTab = ! $activePasswordTab;
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
                <div class="col-lg-8 col-xl-7">
                    <p class="text-muted mb-3">Switch tabs to update your profile or your password.</p>

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

                    <div class="card shadow-sm">
                        <div class="card-body pb-2">
                            <ul class="nav nav-tabs nav-tabs-bordered pt-2" id="accountTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link {{ $activeDetailsTab ? 'active' : '' }}" id="tab-details-btn"
                                        data-bs-toggle="tab" data-bs-target="#tab-details" type="button" role="tab"
                                        aria-controls="tab-details" aria-selected="{{ $activeDetailsTab ? 'true' : 'false' }}">
                                        <i class="bi bi-person me-1" aria-hidden="true"></i> Your details
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link {{ $activePasswordTab ? 'active' : '' }}"
                                        id="tab-password-btn" data-bs-toggle="tab" data-bs-target="#tab-password"
                                        type="button" role="tab" aria-controls="tab-password"
                                        aria-selected="{{ $activePasswordTab ? 'true' : 'false' }}">
                                        <i class="bi bi-key me-1" aria-hidden="true"></i> Password
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body pt-0">
                            <div class="tab-content">
                                <div class="tab-pane fade {{ $activeDetailsTab ? 'show active' : '' }}" id="tab-details"
                                    role="tabpanel" aria-labelledby="tab-details-btn" tabindex="0">
                                    <p class="small text-muted mb-3">Name, email, and optional phone.</p>

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

                                <div class="tab-pane fade {{ $activePasswordTab ? 'show active' : '' }}" id="tab-password"
                                    role="tabpanel" aria-labelledby="tab-password-btn" tabindex="0">
                                    <p class="small text-muted mb-3">After a successful change you will be signed out and
                                        need to log in again.</p>

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
                                            <input type="password" name="password" id="password" class="form-control"
                                                required minlength="8" autocomplete="new-password"
                                                placeholder="At least 8 characters">
                                        </div>
                                        <div class="mb-3">
                                            <label for="password_confirmation" class="form-label">Confirm new
                                                password</label>
                                            <input type="password" name="password_confirmation"
                                                id="password_confirmation" class="form-control" required
                                                autocomplete="new-password" placeholder="Repeat new password">
                                        </div>

                                        <button type="submit" class="btn btn-dark">Update password</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <p class="mt-4 mb-0">
                        <a href="{{ route('admin.dashboard') }}" class="text-decoration-none small">&larr; Back to
                            dashboard</a>
                    </p>
                </div>
            </div>
        </section>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (window.location.hash === '#change-password') {
                var btn = document.getElementById('tab-password-btn');
                if (btn && typeof bootstrap !== 'undefined' && bootstrap.Tab) {
                    bootstrap.Tab.getOrCreateInstance(btn).show();
                }
            }
        });
    </script>
@endsection
