<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Cabinet Médical')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        body { background: linear-gradient(135deg, #1a3c5e 0%, #2980b9 100%); min-height: 100vh; }
        .card { border: none; border-radius: 16px; box-shadow: 0 20px 60px rgba(0,0,0,.2); }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center">
    <div class="container" style="max-width:420px">
        <div class="text-center text-white mb-4">
            <i class="fas fa-hospital-user fa-3x"></i>
            <h3 class="mt-2 fw-bold">Cabinet Médical</h3>
        </div>
        <div class="card p-4">
            @yield('content')
        </div>
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>