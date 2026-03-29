<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Track My Job — Never lose a job application again</title>
    <meta name="description" content="Track job applications, companies, interviews and follow-ups in one place. Stay organized and land your next role.">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700|outfit:400,500,600,700" rel="stylesheet" />

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --welcome-bg: #020617;
            --welcome-bg-card: #0f172a;
            --welcome-text: #f1f5f9;
            --welcome-muted: #94a3b8;
            --welcome-cyan: #06b6d4;
            --welcome-cyan-hover: #22d3ee;
            --welcome-cyan-soft: rgba(6, 182, 212, 0.15);
            --welcome-emerald: #34d399;
            --welcome-amber: #fbbf24;
            --welcome-violet: #a78bfa;
            --welcome-border: rgba(255, 255, 255, 0.08);
        }

        body {
            font-family: 'Instrument Sans', system-ui, sans-serif;
            background-color: var(--welcome-bg);
            color: var(--welcome-text);
            min-height: 100vh;
            overflow-x: hidden;
        }

        .font-display { font-family: 'Outfit', 'Instrument Sans', system-ui, sans-serif; }

        /* Header */
        .welcome-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
            border-bottom: 1px solid var(--welcome-border);
            background: rgba(2, 6, 23, 0.92);
            backdrop-filter: blur(12px);
        }
        .welcome-header .nav-link {
            color: var(--welcome-muted);
            font-weight: 500;
        }
        .welcome-header .nav-link:hover { color: #fff; }
        .btn-cyan {
            background: var(--welcome-cyan);
            color: #0f172a;
            font-weight: 600;
            border: none;
        }
        .btn-cyan:hover {
            background: var(--welcome-cyan-hover);
            color: #0f172a;
        }
        .btn-outline-light-subtle {
            border: 1px solid #475569;
            color: var(--welcome-muted);
            background: transparent;
        }
        .btn-outline-light-subtle:hover {
            border-color: #64748b;
            color: #fff;
            background: transparent;
        }

        /* Hero */
        .hero-section {
            background-color: #0f172a;
            background-image:
                radial-gradient(at 40% 20%, rgba(34, 211, 238, 0.12) 0px, transparent 50%),
                radial-gradient(at 80% 0%, rgba(251, 191, 36, 0.08) 0px, transparent 50%),
                radial-gradient(at 0% 50%, rgba(52, 211, 153, 0.06) 0px, transparent 50%),
                radial-gradient(at 80% 50%, rgba(34, 211, 238, 0.06) 0px, transparent 50%);
            min-height: 90vh;
            padding-top: 5rem;
            position: relative;
        }
        .hero-section .hero-glow-blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.4;
            pointer-events: none;
        }
        .hero-section .hero-glow-blob-1 {
            width: 24rem;
            height: 24rem;
            background: rgba(34, 211, 238, 0.15);
            top: 25%;
            left: 25%;
            animation: float 6s ease-in-out infinite;
        }
        .hero-section .hero-glow-blob-2 {
            width: 20rem;
            height: 20rem;
            background: rgba(251, 191, 36, 0.12);
            bottom: 25%;
            right: 25%;
            animation: float 6s ease-in-out infinite;
            animation-delay: -3s;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .badge-tag {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            background: var(--welcome-cyan-soft);
            border: 1px solid rgba(6, 182, 212, 0.25);
            color: #67e8f9;
            font-size: 0.875rem;
            font-weight: 500;
        }
        .badge-tag-dot {
            width: 0.5rem;
            height: 0.5rem;
            border-radius: 50%;
            background: var(--welcome-cyan-hover);
            animation: pulse 2s ease-in-out infinite;
        }
        @keyframes pulse { 0%, 100% { opacity: 1; } 50% { opacity: 0.5; } }

        .hero-title {
            font-size: clamp(1.75rem, 5vw, 3.75rem);
            font-weight: 700;
            line-height: 1.1;
            color: #fff;
        }
        .hero-sub {
            color: var(--welcome-muted);
            font-size: 1.125rem;
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.7s ease-out forwards;
        }
        .animate-fade-in-up.delay-1 { animation-delay: 0.1s; }
        .animate-fade-in-up.delay-2 { animation-delay: 0.2s; }
        .animate-fade-in-up.delay-3 { animation-delay: 0.3s; }
        .animate-fade-in-up.delay-4 { animation-delay: 0.4s; }
        .animate-fade-in-up.start-hidden { opacity: 0; }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Hero card */
        .hero-card {
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid var(--welcome-border);
            border-radius: 1rem;
            padding: 1.5rem 2rem;
            box-shadow: 0 0 80px -20px rgba(34, 211, 238, 0.2), 0 0 40px -20px rgba(251, 191, 36, 0.1);
            backdrop-filter: blur(8px);
        }
        .status-pill {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 0.5rem;
            font-size: 0.75rem;
            font-weight: 500;
        }
        .status-pill-applied { background: rgba(52, 211, 153, 0.15); color: var(--welcome-emerald); }
        .status-pill-interview { background: rgba(251, 191, 36, 0.15); color: var(--welcome-amber); }
        .status-pill-offer { background: var(--welcome-cyan-soft); color: #67e8f9; }
        .job-row {
            background: rgba(30, 41, 59, 0.6);
            border: 1px solid rgba(51, 65, 85, 0.5);
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
        }
        .job-row .avatar {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 0.5rem;
            background: #334155;
            color: var(--welcome-muted);
            font-weight: 600;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Features */
        .features-section {
            padding: 5rem 0;
            border-top: 1px solid var(--welcome-border);
        }
        .feature-card {
            background: rgba(15, 23, 42, 0.5);
            border: 1px solid var(--welcome-border);
            border-radius: 1rem;
            padding: 1.5rem;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .feature-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.4);
        }
        .feature-icon {
            width: 3rem;
            height: 3rem;
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }
        .feature-icon.cyan { background: var(--welcome-cyan-soft); color: #67e8f9; }
        .feature-icon.emerald { background: rgba(52, 211, 153, 0.15); color: var(--welcome-emerald); }
        .feature-icon.amber { background: rgba(251, 191, 36, 0.15); color: var(--welcome-amber); }
        .feature-icon.violet { background: rgba(167, 139, 250, 0.15); color: var(--welcome-violet); }
        .feature-card h3 {
            font-weight: 600;
            color: #fff;
            font-size: 1.125rem;
            margin-bottom: 0.5rem;
        }
        .feature-card p {
            color: var(--welcome-muted);
            font-size: 0.875rem;
            line-height: 1.6;
            margin: 0;
        }

        /* CTA & Footer */
        .cta-section {
            padding: 5rem 0;
            border-top: 1px solid var(--welcome-border);
        }
        .welcome-footer {
            border-top: 1px solid var(--welcome-border);
            padding: 2rem 0;
        }
        .welcome-footer p { margin: 0; color: #64748b; font-size: 0.875rem; }
        html { scroll-behavior: smooth; }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="welcome-header">
        <nav class="container py-3 d-flex align-items-center justify-content-between">
            <a href="/" class="font-display fw-semibold text-white text-decoration-none" style="font-size: 1.25rem;">Track My Job</a>
            <div class="d-flex align-items-center gap-3">
                <a href="{{ url('/admin/login') }}" class="nav-link text-decoration-none">Log in</a>
                <a href="{{ url('/admin/login') }}" class="btn btn-cyan btn-sm px-4 py-2 rounded-2">Get started</a>
            </div>
        </nav>
    </header>

    <main>
        <!-- Hero -->
        <section class="hero-section d-flex align-items-center">
            <div class="hero-glow-blob hero-glow-blob-1"></div>
            <div class="hero-glow-blob hero-glow-blob-2"></div>

            <div class="container position-relative">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <p class="badge-tag mb-4 animate-fade-in-up start-hidden delay-1"> <span class="badge-tag-dot"></span> Job application tracker for serious candidates</p>
                        <h1 class="font-display hero-title mb-4 animate-fade-in-up start-hidden delay-1">Never lose a job application again</h1>
                        <p class="hero-sub mb-4 animate-fade-in-up start-hidden delay-2">Track companies, applications, interviews and follow-ups in one place. Stay organized and land your next role.</p>
                        <div class="d-flex flex-wrap gap-3 mb-5 animate-fade-in-up start-hidden delay-3">
                            <a href="{{ url('/admin/login') }}" class="btn btn-cyan px-4 py-3 rounded-3 fw-semibold d-inline-flex align-items-center gap-2">
                                Open dashboard
                                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                            </a>
                            <a href="#features" class="btn btn-outline-light-subtle px-4 py-3 rounded-3">See how it works</a>
                        </div>
                    </div>
                </div>
                <div class="row mt-5 mt-lg-0">
                    <div class="col-lg-10 animate-fade-in-up start-hidden delay-4">
                        <div class="hero-card">
                            <div class="d-flex flex-wrap gap-2 mb-4">
                                <span class="status-pill status-pill-applied">Applied</span>
                                <span class="status-pill status-pill-interview">Interview</span>
                                <span class="status-pill status-pill-offer">Offer</span>
                            </div>
                            <div class="d-flex flex-column gap-3">
                                @foreach ([['Company A', 'Senior Developer', 'Interview scheduled'], ['Company B', 'Full Stack Engineer', 'Applied'], ['Company C', 'Backend Lead', 'Offer received']] as $row)
                                <div class="job-row d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="avatar">{{ substr($row[0], -1) }}</div>
                                        <div>
                                            <p class="fw-medium text-white mb-0">{{ $row[0] }} — {{ $row[1] }}</p>
                                            <p class="text-secondary small mb-0" style="color: #64748b !important;">{{ $row[2] }}</p>
                                        </div>
                                    </div>
                                    <span class="text-secondary small" style="color: #64748b !important;">Tracked</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features -->
        <section id="features" class="features-section">
            <div class="container">
                <div class="text-center mb-5 pb-3" style="max-width: 36rem; margin-left: auto; margin-right: auto;">
                    <h2 class="font-display fw-bold text-white mb-3" style="font-size: clamp(1.5rem, 3vw, 2.25rem);">Everything you need to stay on top</h2>
                    <p class="hero-sub mb-0">One place for all your job hunt data. No more spreadsheets or sticky notes.</p>
                </div>
                <div class="row g-4">
                    <div class="col-sm-6 col-lg-3">
                        <div class="feature-card h-100">
                            <div class="feature-icon cyan">
                                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                            </div>
                            <h3 class="font-display">Track applications</h3>
                            <p>Log every application with company, role, status and deadlines. Never forget where you applied.</p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="feature-card h-100">
                            <div class="feature-icon emerald">
                                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            </div>
                            <h3 class="font-display">Manage companies</h3>
                            <p>Keep company details, links and notes in one place for every application.</p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="feature-card h-100">
                            <div class="feature-icon amber">
                                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                            <h3 class="font-display">Status & follow-ups</h3>
                            <p>Update status from applied to offer. Schedule and see follow-up reminders.</p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="feature-card h-100">
                            <div class="feature-icon violet">
                                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </div>
                            <h3 class="font-display">Interviews & notes</h3>
                            <p>Record interview dates and notes so you're prepared for every conversation.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA -->
        <section class="cta-section">
            <div class="container text-center">
                <h2 class="font-display fw-bold text-white mb-3" style="font-size: clamp(1.5rem, 3vw, 2.25rem);">Ready to organize your job hunt?</h2>
                <p class="hero-sub mb-4">Log in and start tracking your applications in minutes.</p>
                <a href="{{ url('/admin/login') }}" class="btn btn-cyan px-5 py-3 rounded-3 fw-semibold d-inline-flex align-items-center gap-2" style="font-size: 1.125rem;">
                    Open dashboard
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                </a>
            </div>
        </section>
    </main>

    <footer class="welcome-footer">
        <div class="container d-flex flex-column flex-sm-row align-items-center justify-content-between gap-3">
            <p class="font-display fw-semibold mb-0">Track My Job</p>
            <p class="mb-0">Built for candidates who mean business.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
