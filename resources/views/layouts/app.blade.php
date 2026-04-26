<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Cabinet Médical')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @if(app()->getLocale() === 'ar')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css">
    @endif
    <style>
        body { background: #f0f4f8; }
        .sidebar { width: 250px; min-height: 100vh; background: #1a3c5e; position: fixed; top: 0; left: 0; z-index: 100; }
        [dir="rtl"] .sidebar { left: auto; right: 0; }
        .sidebar .nav-link { color: rgba(255,255,255,.75); padding: .7rem 1.5rem; border-radius: 8px; margin: 2px 8px; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { color: #fff; background: rgba(255,255,255,.1); }
        .sidebar .nav-link i { width: 20px; }
        .main-content { margin-left: 250px; }
        [dir="rtl"] .main-content { margin-left: 0; margin-right: 250px; }
        .topbar { background: #fff; border-bottom: 1px solid #dee2e6; padding: .75rem 1.5rem; }
        .badge-en_attente  { background: #ffc107; color:#000; }
        .badge-confirme    { background: #198754; }
        .badge-annule      { background: #dc3545; }
        .badge-termine     { background: #6c757d; }
    </style>
    @stack('styles')
</head>
<body>

<!-- SIDEBAR -->
<nav class="sidebar d-flex flex-column p-0">
    <div class="p-4 text-white border-bottom border-secondary">
        <i class="fas fa-hospital-user fa-2x me-2"></i>
        <span class="fw-bold fs-5">{{ __('app.title') }}</span>
    </div>
    <ul class="nav flex-column mt-3 flex-grow-1">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('appointments.*') ? 'active' : '' }}" href="{{ route('appointments.index') }}">
                <i class="fas fa-calendar-check me-2"></i> {{ __('app.appointments') }}
            </a>
        </li>
        @if(auth()->user()->isAdmin() || auth()->user()->isMedecin())
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('services.*') ? 'active' : '' }}" href="{{ route('services.index') }}">
                <i class="fas fa-stethoscope me-2"></i> {{ __('app.services') }}
            </a>
        </li>
        @endif
    </ul>
    <!-- Langue switcher -->
    <div class="p-3 border-top border-secondary">
        <div class="d-flex gap-2">
            <a href="{{ route('lang.switch', 'fr') }}" class="btn btn-sm {{ app()->getLocale()==='fr' ? 'btn-light' : 'btn-outline-light' }}">FR</a>
            <a href="{{ route('lang.switch', 'ar') }}" class="btn btn-sm {{ app()->getLocale()==='ar' ? 'btn-light' : 'btn-outline-light' }}">عر</a>
        </div>
    </div>
</nav>

<!-- MAIN -->
<div class="main-content">
    <!-- TOPBAR -->
    <div class="topbar d-flex justify-content-between align-items-center">
        <h6 class="mb-0 text-muted">@yield('page-title', '')</h6>
        <div class="dropdown">
            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                <i class="fas fa-user-circle me-1"></i> {{ auth()->user()->name }}
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><span class="dropdown-item-text text-muted small">{{ auth()->user()->role }}</span></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="dropdown-item text-danger"><i class="fas fa-sign-out-alt me-2"></i>{{ __('app.logout') }}</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="p-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">{{ session('error') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif
        @yield('content')
    </div>

    <!-- FOOTER -->
    <footer class="text-center text-muted py-3 border-top mt-4">
        <small>&copy; {{ date('Y') }} Cabinet Médical — DD2 OFPPT</small>
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@stack('scripts')
</body>
</html>