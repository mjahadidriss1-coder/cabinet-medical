<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Cabinet Médical')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @if(app()->getLocale() === 'ar')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css">
    @endif
    <style>
        :root {
            --navy:   #0a1628;
            --navy2:  #112240;
            --navy3:  #1a3a5c;
            --teal:   #0d9488;
            --teal2:  #14b8a6;
            --cream:  #f8f5f0;
            --muted:  #94a3b8;
            --sidebar-w: 260px;
            --serif: 'Instrument Serif', Georgia, serif;
            --sans:  'DM Sans', system-ui, sans-serif;
        }

        * { box-sizing: border-box; }
        body {
            font-family: var(--sans);
            background: #f0f4f8;
            color: #1e293b;
        }

        /* ── SIDEBAR ── */
        .sidebar {
            width: var(--sidebar-w);
            min-height: 100vh;
            background: var(--navy);
            position: fixed; top: 0; left: 0; z-index: 100;
            display: flex; flex-direction: column;
            border-right: 1px solid rgba(255,255,255,.06);
        }
        [dir="rtl"] .sidebar { left: auto; right: 0; border-right: none; border-left: 1px solid rgba(255,255,255,.06); }

        .sidebar-brand {
            padding: 1.5rem 1.25rem;
            display: flex; align-items: center; gap: .6rem;
            border-bottom: 1px solid rgba(255,255,255,.06);
        }
        .sidebar-brand .brand-dot {
            width: 9px; height: 9px; border-radius: 50%;
            background: var(--teal2); flex-shrink: 0;
        }
        .sidebar-brand span {
            font-family: var(--serif);
            font-size: 1.15rem; color: #fff;
        }

        .sidebar-nav { flex: 1; padding: 1rem .75rem; }
        .nav-section-label {
            font-size: .68rem; font-weight: 600; letter-spacing: .1em;
            text-transform: uppercase; color: rgba(255,255,255,.3);
            padding: .75rem .5rem .4rem;
        }
        .sidebar-link {
            display: flex; align-items: center; gap: .75rem;
            padding: .6rem .85rem; border-radius: 10px;
            color: rgba(255,255,255,.6); text-decoration: none;
            font-size: .9rem; font-weight: 400;
            transition: all .15s; margin-bottom: 2px;
        }
        .sidebar-link i { width: 18px; text-align: center; font-size: .9rem; }
        .sidebar-link:hover { color: #fff; background: rgba(255,255,255,.07); }
        .sidebar-link.active {
            color: #fff;
            background: rgba(13,148,136,.2);
            border: 1px solid rgba(13,148,136,.3);
        }
        .sidebar-link.active i { color: var(--teal2); }

        /* Lang switcher */
        .lang-switcher {
            padding: 1rem .75rem;
            border-top: 1px solid rgba(255,255,255,.06);
        }
        .lang-btn {
            display: inline-flex; align-items: center; justify-content: center;
            width: 36px; height: 36px; border-radius: 8px;
            text-decoration: none; font-size: .82rem; font-weight: 600;
            color: rgba(255,255,255,.5);
            transition: all .15s;
        }
        .lang-btn.active { background: rgba(13,148,136,.2); color: var(--teal2); border: 1px solid rgba(13,148,136,.3); }
        .lang-btn:hover:not(.active) { background: rgba(255,255,255,.07); color: #fff; }

        /* ── MAIN ── */
        .main-content {
            margin-left: var(--sidebar-w);
            min-height: 100vh;
            display: flex; flex-direction: column;
        }
        [dir="rtl"] .main-content { margin-left: 0; margin-right: var(--sidebar-w); }

        /* ── TOPBAR ── */
        .topbar {
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            padding: .85rem 1.75rem;
            display: flex; align-items: center; justify-content: space-between;
            position: sticky; top: 0; z-index: 50;
        }
        .topbar-title {
            font-size: .95rem; font-weight: 500; color: #64748b;
        }
        .user-menu-btn {
            display: flex; align-items: center; gap: .6rem;
            background: #f8fafc; border: 1px solid #e2e8f0;
            border-radius: 50px; padding: .4rem .9rem .4rem .4rem;
            cursor: pointer; transition: all .15s;
        }
        .user-menu-btn:hover { border-color: #cbd5e1; background: #f1f5f9; }
        .user-avatar {
            width: 30px; height: 30px; border-radius: 50%;
            background: linear-gradient(135deg, var(--teal), var(--navy3));
            display: flex; align-items: center; justify-content: center;
            font-size: .75rem; font-weight: 600; color: #fff;
        }
        .user-name { font-size: .88rem; font-weight: 500; color: #334155; }

        /* ── CONTENT ── */
        .page-content { padding: 1.75rem; flex: 1; }

        /* ── CARDS ── */
        .card {
            border: 1px solid #e2e8f0 !important;
            border-radius: 14px !important;
            box-shadow: 0 1px 3px rgba(0,0,0,.04) !important;
        }
        .card-header-custom {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid #f1f5f9;
            display: flex; align-items: center; justify-content: space-between;
        }

        /* ── BUTTONS ── */
        .btn-primary {
            background: var(--teal) !important;
            border-color: var(--teal) !important;
            border-radius: 50px !important;
            padding: .5rem 1.25rem !important;
            font-weight: 500 !important;
        }
        .btn-primary:hover { background: var(--teal2) !important; border-color: var(--teal2) !important; }
        .btn-secondary { border-radius: 50px !important; }
        .btn-warning  { border-radius: 50px !important; }
        .btn-danger   { border-radius: 50px !important; }
        .btn-outline-info    { border-radius: 50px !important; }
        .btn-outline-warning { border-radius: 50px !important; }
        .btn-outline-danger  { border-radius: 50px !important; }

        /* ── TABLE ── */
        .table { font-size: .9rem; }
        .table thead th {
            font-size: .75rem; font-weight: 600; letter-spacing: .05em;
            text-transform: uppercase; color: #94a3b8;
            background: #f8fafc; border-bottom: 1px solid #e2e8f0;
            padding: .85rem 1rem;
        }
        .table tbody td { padding: .9rem 1rem; vertical-align: middle; border-color: #f1f5f9; }
        .table tbody tr:hover { background: #f8fafc; }

        /* ── BADGES ── */
        .badge-en_attente { background: #fef3c7; color: #92400e; border: 1px solid #fde68a; }
        .badge-confirme   { background: #d1fae5; color: #065f46; border: 1px solid #a7f3d0; }
        .badge-annule     { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }
        .badge-termine    { background: #f1f5f9; color: #475569; border: 1px solid #e2e8f0; }
        .badge { font-weight: 500 !important; font-size: .78rem !important; }

        /* ── ALERTS ── */
        .alert { border-radius: 12px !important; border: none !important; font-size: .9rem; }
        .alert-success { background: #d1fae5; color: #065f46; }
        .alert-danger  { background: #fee2e2; color: #991b1b; }

        /* ── FORMS ── */
        .form-control, .form-select {
            border-radius: 10px !important;
            border: 1px solid #e2e8f0 !important;
            font-size: .9rem !important;
            padding: .6rem .9rem !important;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--teal) !important;
            box-shadow: 0 0 0 3px rgba(13,148,136,.1) !important;
        }
        .form-label { font-size: .85rem; font-weight: 500; color: #475569; margin-bottom: .4rem; }

        /* ── MODAL ── */
        .modal-content { border-radius: 16px !important; border: none !important; }
        .modal-header { border-radius: 16px 16px 0 0 !important; }

        /* ── FOOTER ── */
        .page-footer {
            text-align: center; padding: 1.25rem;
            font-size: .82rem; color: #94a3b8;
            border-top: 1px solid #e2e8f0;
            background: #fff;
        }

        /* ── PAGE HEADER ── */
        .page-header { margin-bottom: 1.5rem; }
        .page-header h4 {
            font-size: 1.35rem; font-weight: 600; color: #0f172a;
            display: flex; align-items: center; gap: .5rem;
        }
        .page-header h4 i { color: var(--teal); font-size: 1.1rem; }
    </style>
    @stack('styles')
</head>
<body>

<!-- SIDEBAR -->
<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-dot"></div>
        <span>{{ __('app.title') }}</span>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-section-label">Menu</div>
        <a href="{{ route('appointments.index') }}"
           class="sidebar-link {{ request()->routeIs('appointments.*') ? 'active' : '' }}">
            <i class="fas fa-calendar-check"></i>
            {{ __('app.appointments') }}
        </a>
        @if(auth()->user()->isAdmin() || auth()->user()->isMedecin())
        <a href="{{ route('services.index') }}"
           class="sidebar-link {{ request()->routeIs('services.*') ? 'active' : '' }}">
            <i class="fas fa-stethoscope"></i>
            {{ __('app.services') }}
        </a>
        @endif
    </nav>

    <!-- Lang -->
    <div class="lang-switcher">
        <div class="d-flex gap-2">
            <a href="{{ route('lang.switch', 'fr') }}"
               class="lang-btn {{ app()->getLocale()==='fr' ? 'active' : '' }}">FR</a>
            <a href="{{ route('lang.switch', 'ar') }}"
               class="lang-btn {{ app()->getLocale()==='ar' ? 'active' : '' }}">عر</a>
        </div>
    </div>
</aside>

<!-- MAIN -->
<div class="main-content">

    <!-- TOPBAR -->
    <header class="topbar">
        <span class="topbar-title">@yield('page-title', '')</span>
        <div class="dropdown">
            <div class="user-menu-btn" data-bs-toggle="dropdown">
                <div class="user-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                </div>
                <span class="user-name">{{ auth()->user()->name }}</span>
                <i class="fas fa-chevron-down ms-1" style="font-size:.7rem;color:#94a3b8"></i>
            </div>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" style="border-radius:12px;min-width:180px">
                <li><span class="dropdown-item-text text-muted small">{{ ucfirst(auth()->user()->role) }}</span></li>
                <li><hr class="dropdown-divider my-1"></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="dropdown-item text-danger" style="font-size:.9rem">
                            <i class="fas fa-sign-out-alt me-2"></i>{{ __('app.logout') }}
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </header>

    <!-- CONTENT -->
    <main class="page-content">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <i class="fas fa-circle-check me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                <i class="fas fa-circle-exclamation me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')

    </main>

    <!-- FOOTER -->
    <footer class="page-footer">
        &copy; {{ date('Y') }} Cabinet Médical — DD2 OFPPT
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@stack('scripts')
</body>
</html>