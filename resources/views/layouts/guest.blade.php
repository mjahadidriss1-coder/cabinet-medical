<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Cabinet Médical')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --navy: #0a1628; --navy2: #112240;
            --teal: #0d9488; --teal2: #14b8a6;
            --serif: 'Instrument Serif', Georgia, serif;
            --sans:  'DM Sans', system-ui, sans-serif;
        }
        * { box-sizing: border-box; }
        body {
            font-family: var(--sans);
            background: var(--navy);
            min-height: 100vh;
            padding: 3rem 1rem 3rem;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            overflow-y: auto;
            position: relative;
        }
        body::before {
            content: '';
            position: fixed; inset: 0;
            background:
                radial-gradient(ellipse 70% 50% at 50% -10%, rgba(13,148,136,.2) 0%, transparent 60%),
                radial-gradient(ellipse 50% 50% at 90% 90%, rgba(13,148,136,.08) 0%, transparent 60%);
            pointer-events: none;
        }
        .auth-container { width: 100%; max-width: 420px; position: relative; }
        .auth-brand {
            text-align: center; margin-bottom: 2rem;
        }
        .auth-brand .dot-ring {
            width: 52px; height: 52px; border-radius: 50%;
            border: 1px solid rgba(13,148,136,.4);
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1rem;
            background: rgba(13,148,136,.08);
        }
        .auth-brand .dot-ring i { color: var(--teal2); font-size: 1.3rem; }
        .auth-brand h1 {
            font-family: var(--serif); font-size: 1.6rem;
            color: #fff; margin-bottom: .25rem;
        }
        .auth-brand p { color: rgba(255,255,255,.4); font-size: .88rem; }
        .auth-card {
            background: #fff;
            border-radius: 20px;
            padding: 2rem 2.25rem;
            box-shadow: 0 24px 60px rgba(0,0,0,.3);
        }
        .auth-card h2 {
            font-size: 1.15rem; font-weight: 600;
            color: #0f172a; margin-bottom: 1.5rem;
            padding-bottom: .75rem;
            border-bottom: 1px solid #f1f5f9;
        }
        .form-label { font-size: .83rem; font-weight: 500; color: #64748b; margin-bottom: .35rem; }
        .form-control {
            border-radius: 10px; border: 1px solid #e2e8f0;
            font-size: .9rem; padding: .6rem .9rem;
        }
        .form-control:focus {
            border-color: var(--teal);
            box-shadow: 0 0 0 3px rgba(13,148,136,.1);
        }
        .btn-auth {
            width: 100%; padding: .75rem;
            background: var(--teal); color: #fff; border: none;
            border-radius: 50px; font-size: .95rem; font-weight: 500;
            cursor: pointer; transition: all .2s;
        }
        .btn-auth:hover { background: var(--teal2); transform: translateY(-1px); }
        .auth-footer {
            text-align: center; margin-top: 1.25rem;
            font-size: .85rem; color: #94a3b8;
        }
        .auth-footer a { color: var(--teal); text-decoration: none; font-weight: 500; }
        .auth-footer a:hover { color: var(--teal2); }
        .alert { border-radius: 10px; border: none; font-size: .85rem; margin-bottom: 1rem; }
        .alert-danger { background: #fee2e2; color: #991b1b; }
        .back-link {
            display: inline-flex; align-items: center; gap: .4rem;
            color: rgba(255,255,255,.4); text-decoration: none;
            font-size: .82rem; margin-top: 1.5rem;
            transition: color .2s;
        }
        .back-link:hover { color: rgba(255,255,255,.7); }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-brand">
            <div class="dot-ring"><i class="fas fa-hospital-user"></i></div>
            <h1>Cabinet Médical</h1>
            <p>Gestion de rendez-vous médicaux</p>
        </div>
        <div class="auth-card">
            @yield('content')
        </div>
        <div class="text-center">
            <a href="/" class="back-link">
                <i class="fas fa-arrow-left" style="font-size:.75rem"></i>
                Retour à l'accueil
            </a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>