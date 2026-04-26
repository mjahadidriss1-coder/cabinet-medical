<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cabinet Médical — Votre santé, notre priorité</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --navy:   #0a1628;
            --navy2:  #112240;
            --teal:   #0d9488;
            --teal2:  #14b8a6;
            --cream:  #f8f5f0;
            --muted:  #94a3b8;
            --white:  #ffffff;
            --serif:  'Instrument Serif', Georgia, serif;
            --sans:   'DM Sans', system-ui, sans-serif;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: var(--sans);
            background: var(--navy);
            color: var(--white);
            overflow-x: hidden;
        }

        /* ── NAV ── */
        nav {
            position: fixed; top: 0; left: 0; right: 0; z-index: 100;
            display: flex; align-items: center; justify-content: space-between;
            padding: 1.25rem 5%;
            background: rgba(10,22,40,0.85);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255,255,255,0.06);
        }
        .nav-brand {
            display: flex; align-items: center; gap: .6rem;
            font-family: var(--serif); font-size: 1.3rem; color: var(--white);
            text-decoration: none;
        }
        .nav-brand .dot { width: 8px; height: 8px; border-radius: 50%; background: var(--teal2); }
        .nav-links { display: flex; align-items: center; gap: 2rem; }
        .nav-links a { color: var(--muted); text-decoration: none; font-size: .9rem; transition: color .2s; }
        .nav-links a:hover { color: var(--white); }
        .btn-nav {
            padding: .55rem 1.4rem; border-radius: 50px;
            background: var(--teal); color: var(--white);
            text-decoration: none; font-size: .88rem; font-weight: 500;
            transition: background .2s, transform .1s;
        }
        .btn-nav:hover { background: var(--teal2); transform: translateY(-1px); }

        /* ── HERO ── */
        .hero {
            min-height: 100vh;
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            text-align: center;
            padding: 6rem 5% 4rem;
            position: relative;
            overflow: hidden;
        }
        .hero::before {
            content: '';
            position: absolute; inset: 0;
            background:
                radial-gradient(ellipse 80% 60% at 50% 0%, rgba(13,148,136,.18) 0%, transparent 70%),
                radial-gradient(ellipse 40% 40% at 80% 80%, rgba(13,148,136,.08) 0%, transparent 60%);
        }
        .hero-badge {
            display: inline-flex; align-items: center; gap: .5rem;
            background: rgba(13,148,136,.12); border: 1px solid rgba(13,148,136,.3);
            color: var(--teal2); font-size: .8rem; font-weight: 500;
            padding: .4rem 1rem; border-radius: 50px;
            margin-bottom: 2rem; position: relative;
        }
        .hero h1 {
            font-family: var(--serif);
            font-size: clamp(2.8rem, 6vw, 5rem);
            line-height: 1.1;
            letter-spacing: -.02em;
            margin-bottom: 1.5rem;
            position: relative;
        }
        .hero h1 em { color: var(--teal2); font-style: italic; }
        .hero p {
            max-width: 560px; font-size: 1.1rem; color: var(--muted);
            line-height: 1.7; margin-bottom: 2.5rem; position: relative;
        }
        .hero-actions { display: flex; gap: 1rem; flex-wrap: wrap; justify-content: center; position: relative; }
        .btn-primary-hero {
            display: inline-flex; align-items: center; gap: .5rem;
            padding: .85rem 2rem; border-radius: 50px;
            background: var(--teal); color: var(--white);
            font-size: 1rem; font-weight: 500; text-decoration: none;
            transition: all .2s;
            box-shadow: 0 0 40px rgba(13,148,136,.3);
        }
        .btn-primary-hero:hover { background: var(--teal2); transform: translateY(-2px); box-shadow: 0 0 60px rgba(13,148,136,.4); }
        .btn-ghost {
            display: inline-flex; align-items: center; gap: .5rem;
            padding: .85rem 2rem; border-radius: 50px;
            border: 1px solid rgba(255,255,255,.15); color: var(--white);
            font-size: 1rem; text-decoration: none;
            transition: all .2s;
        }
        .btn-ghost:hover { border-color: rgba(255,255,255,.4); background: rgba(255,255,255,.05); }

        /* ── STATS ── */
        .stats {
            display: grid; grid-template-columns: repeat(3, 1fr);
            gap: 1px; background: rgba(255,255,255,.06);
            margin: 4rem 5%;
            border-radius: 16px; overflow: hidden;
            border: 1px solid rgba(255,255,255,.06);
        }
        .stat-item {
            background: var(--navy2);
            padding: 2rem; text-align: center;
        }
        .stat-number {
            font-family: var(--serif); font-size: 2.8rem;
            color: var(--teal2); line-height: 1;
            margin-bottom: .4rem;
        }
        .stat-label { color: var(--muted); font-size: .9rem; }

        /* ── FEATURES ── */
        .section { padding: 5rem 5%; }
        .section-label {
            display: inline-block;
            color: var(--teal2); font-size: .8rem; font-weight: 600;
            letter-spacing: .1em; text-transform: uppercase;
            margin-bottom: 1rem;
        }
        .section-title {
            font-family: var(--serif);
            font-size: clamp(2rem, 4vw, 3rem);
            line-height: 1.2; margin-bottom: 1rem;
        }
        .section-subtitle { color: var(--muted); font-size: 1.05rem; max-width: 500px; line-height: 1.7; }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem; margin-top: 3.5rem;
        }
        .feature-card {
            background: var(--navy2);
            border: 1px solid rgba(255,255,255,.07);
            border-radius: 16px; padding: 2rem;
            transition: border-color .2s, transform .2s;
        }
        .feature-card:hover { border-color: rgba(13,148,136,.4); transform: translateY(-4px); }
        .feature-icon {
            width: 48px; height: 48px; border-radius: 12px;
            background: rgba(13,148,136,.12); border: 1px solid rgba(13,148,136,.2);
            display: flex; align-items: center; justify-content: center;
            color: var(--teal2); font-size: 1.2rem;
            margin-bottom: 1.25rem;
        }
        .feature-card h3 { font-size: 1.05rem; font-weight: 600; margin-bottom: .6rem; }
        .feature-card p { color: var(--muted); font-size: .92rem; line-height: 1.65; }

        /* ── HOW IT WORKS ── */
        .steps { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 2rem; margin-top: 3.5rem; }
        .step { text-align: center; }
        .step-number {
            width: 52px; height: 52px; border-radius: 50%;
            border: 1px solid rgba(13,148,136,.4);
            display: flex; align-items: center; justify-content: center;
            font-family: var(--serif); font-size: 1.4rem; color: var(--teal2);
            margin: 0 auto 1.25rem;
        }
        .step h3 { font-size: 1rem; font-weight: 600; margin-bottom: .5rem; }
        .step p { color: var(--muted); font-size: .88rem; line-height: 1.6; }
        .step-connector {
            display: none;
        }

        /* ── CTA ── */
        .cta-section {
            margin: 0 5% 5rem;
            background: linear-gradient(135deg, var(--teal) 0%, #0f766e 100%);
            border-radius: 24px; padding: 4rem;
            text-align: center; position: relative; overflow: hidden;
        }
        .cta-section::before {
            content: '';
            position: absolute; inset: 0;
            background: radial-gradient(ellipse 60% 80% at 50% -20%, rgba(255,255,255,.15) 0%, transparent 70%);
        }
        .cta-section h2 {
            font-family: var(--serif); font-size: clamp(1.8rem, 3.5vw, 2.8rem);
            margin-bottom: 1rem; position: relative;
        }
        .cta-section p { color: rgba(255,255,255,.8); margin-bottom: 2rem; font-size: 1.05rem; position: relative; }
        .btn-cta {
            display: inline-flex; align-items: center; gap: .5rem;
            padding: .9rem 2.2rem; border-radius: 50px;
            background: var(--white); color: var(--teal);
            font-weight: 600; text-decoration: none;
            transition: all .2s; position: relative;
        }
        .btn-cta:hover { transform: translateY(-2px); box-shadow: 0 12px 40px rgba(0,0,0,.2); }

        /* ── FOOTER ── */
        footer {
            border-top: 1px solid rgba(255,255,255,.06);
            padding: 2rem 5%; text-align: center;
            color: var(--muted); font-size: .88rem;
        }

        /* ── ANIMATIONS ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(30px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .animate { opacity: 0; animation: fadeUp .7s ease forwards; }
        .delay-1 { animation-delay: .1s; }
        .delay-2 { animation-delay: .2s; }
        .delay-3 { animation-delay: .3s; }
        .delay-4 { animation-delay: .4s; }
    </style>
</head>
<body>

<!-- NAV -->
<nav>
    <a href="/" class="nav-brand">
        <div class="dot"></div>
        Cabinet Médical
    </a>
    <div class="nav-links">
        <a href="#fonctionnalites">Fonctionnalités</a>
        <a href="#comment">Comment ça marche</a>
        <a href="{{ route('login') }}">Connexion</a>
        <a href="{{ route('register') }}" class="btn-nav">Commencer</a>
    </div>
</nav>

<!-- HERO -->
<section class="hero">
    <div class="hero-badge animate">
        <i class="fas fa-circle-check" style="font-size:.75rem"></i>
        Gestion simplifiée des rendez-vous
    </div>
    <h1 class="animate delay-1">
        Votre santé,<br>
        <em>notre priorité.</em>
    </h1>
    <p class="animate delay-2">
        Prenez vos rendez-vous médicaux en ligne, suivez vos consultations
        et gérez votre cabinet facilement depuis une seule plateforme.
    </p>
    <div class="hero-actions animate delay-3">
        <a href="{{ route('register') }}" class="btn-primary-hero">
            <i class="fas fa-calendar-plus"></i>
            Prendre un rendez-vous
        </a>
        <a href="{{ route('login') }}" class="btn-ghost">
            <i class="fas fa-arrow-right-to-bracket"></i>
            Se connecter
        </a>
    </div>
</section>

<!-- STATS -->
<div class="stats animate delay-4">
    <div class="stat-item">
        <div class="stat-number">500+</div>
        <div class="stat-label">Patients enregistrés</div>
    </div>
    <div class="stat-item">
        <div class="stat-number">5</div>
        <div class="stat-label">Spécialités médicales</div>
    </div>
    <div class="stat-item">
        <div class="stat-number">24/7</div>
        <div class="stat-label">Disponible en ligne</div>
    </div>
</div>

<!-- FEATURES -->
<section class="section" id="fonctionnalites">
    <span class="section-label">Fonctionnalités</span>
    <h2 class="section-title">Tout ce dont vous avez besoin</h2>
    <p class="section-subtitle">Une plateforme complète pour les patients et les médecins.</p>

    <div class="features-grid">
        <div class="feature-card">
            <div class="feature-icon"><i class="fas fa-calendar-check"></i></div>
            <h3>Réservation en ligne</h3>
            <p>Prenez vos rendez-vous à tout moment, sans attente téléphonique. Confirmation instantanée par email.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon"><i class="fas fa-user-doctor"></i></div>
            <h3>Gestion des médecins</h3>
            <p>Chaque médecin gère son agenda, ses spécialités et ses consultations depuis son tableau de bord.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon"><i class="fas fa-envelope-open-text"></i></div>
            <h3>Notifications email</h3>
            <p>Email de confirmation automatique à chaque rendez-vous créé, pour le patient et le médecin.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon"><i class="fas fa-magnifying-glass"></i></div>
            <h3>Recherche instantanée</h3>
            <p>Filtrez vos rendez-vous en temps réel sans rechargement de page grâce à la recherche Axios.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon"><i class="fas fa-language"></i></div>
            <h3>Bilingue FR / عر</h3>
            <p>Interface disponible en français et en arabe, avec support RTL complet.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon"><i class="fas fa-code"></i></div>
            <h3>API REST</h3>
            <p>Accédez à vos données via des endpoints JSON pour intégrer avec d'autres systèmes.</p>
        </div>
    </div>
</section>

<!-- HOW IT WORKS -->
<section class="section" id="comment" style="background: rgba(255,255,255,.02); border-top: 1px solid rgba(255,255,255,.05); border-bottom: 1px solid rgba(255,255,255,.05);">
    <span class="section-label">Comment ça marche</span>
    <h2 class="section-title">Simple en 3 étapes</h2>

    <div class="steps">
        <div class="step">
            <div class="step-number">1</div>
            <h3>Créez votre compte</h3>
            <p>Inscrivez-vous gratuitement en tant que patient en quelques secondes.</p>
        </div>
        <div class="step">
            <div class="step-number">2</div>
            <h3>Choisissez un médecin</h3>
            <p>Sélectionnez le médecin, le service et le créneau qui vous convient.</p>
        </div>
        <div class="step">
            <div class="step-number">3</div>
            <h3>Recevez la confirmation</h3>
            <p>Un email de confirmation est envoyé immédiatement avec tous les détails.</p>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="section">
    <div class="cta-section">
        <h2>Prêt à commencer ?</h2>
        <p>Rejoignez notre plateforme et gérez vos rendez-vous médicaux facilement.</p>
        <a href="{{ route('register') }}" class="btn-cta">
            <i class="fas fa-user-plus"></i>
            Créer un compte gratuit
        </a>
    </div>
</section>

<!-- FOOTER -->
<footer>
    <p>&copy; {{ date('Y') }} Cabinet Médical — Projet CC2 OFPPT DD2</p>
</footer>

</body>
</html>