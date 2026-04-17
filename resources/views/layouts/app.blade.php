<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>NV CREATIVE - Wear Your Vision</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Montserrat:wght@600;700;800&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #111111;
            --text: #eaeaea;
            --panel: #171717;
            --panel-border: #2c2c2c;
            --accent: #ffd700;
            --accent-alt: #00ffaa;
            --heading: #ffffff;
            --muted: #cfcfcf;
            --focus-ring: #00ffaa;
            --shadow-soft: 0 10px 28px rgba(0, 0, 0, .35);
        }
        * { box-sizing: border-box; }
        body { background:var(--bg); color:var(--text); font-family:'Inter', Arial, sans-serif; font-size:15px; line-height:1.6; letter-spacing:.01em; }
        h1, h2, h3, h4, h5, .display-5, .navbar-brand { font-family:'Montserrat', 'Poppins', Arial, sans-serif; color: var(--heading); font-weight: 700; letter-spacing: .02em; }
        main { min-height: calc(100vh - 210px); }
        .accent { color:var(--accent); }
        .bg-panel { background:var(--panel); border:1px solid var(--panel-border); border-radius: 1rem; box-shadow: var(--shadow-soft); }
        .hero {
            min-height: 76vh;
            border-radius: 1.25rem;
            overflow: hidden;
            position: relative;
            display: flex;
            align-items: end;
            background: linear-gradient(120deg, rgba(15,15,15,.9), rgba(15,15,15,.35)), url('https://images.unsplash.com/photo-1521572267360-ee0c2909d518?auto=format&fit=crop&w=1600&q=80') center/cover no-repeat;
            box-shadow: var(--shadow-soft);
        }
        .hero-content { max-width: 620px; padding: 3rem; animation: fadeInUp .8s ease forwards; }
        .hero-title { font-size: clamp(2.1rem, 6vw, 4.4rem); font-weight: 800; margin-bottom: .6rem; }
        .hero-subtitle { font-size: clamp(1rem, 2.2vw, 1.35rem); color: #f5f5f5; margin-bottom: 1.6rem; }
        .fade-zoom { animation: fadeZoom 1s ease forwards; transform-origin: center; }
        .product-grid .col-md-3 { display: flex; }
        .product-card { transition:transform .28s ease, box-shadow .28s ease, border-color .28s ease; border-radius: 1rem; overflow: hidden; border: 1px solid var(--panel-border); background: var(--panel); position: relative; }
        .product-card:hover { transform:translateY(-8px); box-shadow:0 20px 42px rgba(0,0,0,.45); border-color: rgba(255, 215, 0, .48); }
        .product-card:hover .product-image { transform: scale(1.06); }
        .product-image { height:300px; object-fit:cover; transition: transform .35s ease; }
        .product-overlay {
            position: absolute;
            inset: auto 1rem 1rem 1rem;
            opacity: 0;
            transform: translateY(12px);
            transition: all .25s ease;
        }
        .product-card:hover .product-overlay { opacity: 1; transform: translateY(0); }
        .navbar {
            background: transparent;
            border-bottom: 1px solid transparent;
            transition: background .28s ease, border-color .28s ease, box-shadow .28s ease;
        }
        .navbar.navbar-scrolled {
            background: rgba(15, 15, 15, .95);
            border-bottom-color: #282828;
            backdrop-filter: blur(8px);
            box-shadow: 0 8px 20px rgba(0,0,0,.4);
        }
        .nav-link { color: #d8d8d8 !important; font-weight: 500; }
        .nav-link:hover, .nav-link:focus-visible { color: #ffffff !important; }
        .brand-logo {
            height: 44px;
            width: auto;
            display: block;
        }
        footer { border-top:1px solid #2a2a2a; margin-top: 4rem; }
        .text-secondary { color: var(--muted) !important; }
        .btn { border-radius: .7rem; font-weight: 600; padding: .6rem 1.2rem; transition: transform .2s ease, box-shadow .2s ease, background .2s ease; position: relative; overflow: hidden; }
        .btn:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(0,0,0,.35); }
        .btn::after {
            content: "";
            position: absolute;
            width: 220%;
            padding-top: 220%;
            left: 50%;
            top: 50%;
            background: rgba(255,255,255,.18);
            border-radius: 50%;
            transform: translate(-50%, -50%) scale(0);
            opacity: 0;
            transition: transform .45s ease, opacity .45s ease;
            pointer-events: none;
        }
        .btn:active::after { transform: translate(-50%, -50%) scale(1); opacity: 1; transition: 0s; }
        .form-control, .form-select { background:var(--panel); color:var(--text); border-color:var(--panel-border); }
        .form-control:focus, .form-select:focus { border-color:var(--focus-ring); box-shadow:0 0 0 .2rem rgba(0,255,170,.25); background:var(--panel); color:var(--text); }
        .btn-success { background:#ffd700; color:#0f0f0f; border-color:#ffd700; font-weight:700; }
        .btn-success:hover { background:#e6c200; border-color:#e6c200; color:#000; }
        .btn-outline-light { border-color: #5e5e5e; }
        .btn-outline-light:hover { border-color: #ffffff; background: #ffffff; color: #0f0f0f; }
        .table { color: var(--text); border-color: #323232; }
        .table th { font-weight: 600; color: #ffffff; }
        .table { color: var(--text); }
        .table-striped>tbody>tr:nth-of-type(odd)>* { color: var(--text); background-color: rgba(255,255,255,.04); }
        .section-title { margin-bottom: 1.2rem; font-size: clamp(1.4rem, 2.4vw, 2rem); }
        .badge-chip { border: 1px solid #3a3a3a; background: #1e1e1e; color: #f1f1f1; border-radius: 999px; padding: .3rem .65rem; font-size: .75rem; }
        .price-text { font-size: 1.05rem; font-weight: 700; color: #ffffff; }
        .qty-input { max-width: 110px; }
        .category-pill { border: 1px solid #3a3a3a; background: #1a1a1a; color: #e6e6e6; border-radius: 999px; padding: .35rem .7rem; font-size: .78rem; }
        .admin-shell { display: grid; grid-template-columns: 250px 1fr; gap: 1rem; align-items: start; }
        .admin-sidebar { position: sticky; top: 95px; }
        .admin-sidebar .nav-link { border-radius: .6rem; padding: .55rem .8rem; }
        .admin-sidebar .nav-link.active, .admin-sidebar .nav-link:hover { background: #202020; color: #ffffff !important; }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeZoom {
            from { opacity: 0; transform: scale(1.02); }
            to { opacity: 1; transform: scale(1); }
        }
        @media (max-width: 991px) {
            .hero { min-height: 68vh; }
            .admin-shell { grid-template-columns: 1fr; }
            .admin-sidebar { position: static; }
        }
        @media (max-width: 767px) {
            .product-image { height: 250px; }
            .hero-content { padding: 2rem 1.4rem; }
            .product-grid .col-md-3 { width: 50%; }
        }
        @media (max-width: 500px) {
            .product-grid .col-md-3 { width: 100%; }
        }
        a:focus-visible, button:focus-visible, input:focus-visible, select:focus-visible, textarea:focus-visible {
            outline: 3px solid var(--focus-ring);
            outline-offset: 2px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark sticky-top" id="mainNavbar">
    <div class="container">
        <a class="navbar-brand fw-bold py-0" href="{{ route('home') }}">
            <img src="{{ asset('images/brand/nv-logo-white.png') }}" alt="NV Creative" class="brand-logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nvNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nvNav">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('shop.index') }}">Shop</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('designs.index') }}">Categories</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('cart.index') }}">🛒 Cart</a></li>
                @auth
                    <li class="nav-item"><a class="nav-link" href="{{ route('orders.index') }}">Orders</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('profile.edit') }}">Profile</a></li>
                    @if(auth()->user()->isAdmin())
                        @php
                            $unreadNotifications = auth()->user()->unreadNotifications()->latest()->take(5)->get();
                            $unreadCount = auth()->user()->unreadNotifications()->count();
                        @endphp
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-label="Admin notifications">
                                🔔 Notifications @if($unreadCount > 0)<span class="badge text-bg-warning">{{ $unreadCount }}</span>@endif
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end bg-panel" style="min-width: 320px;">
                                @forelse($unreadNotifications as $notification)
                                    <li>
                                        <a class="dropdown-item text-light" href="{{ route('admin.notifications.open', $notification->id) }}">
                                            {{ $notification->data['message'] ?? 'New notification' }}
                                        </a>
                                    </li>
                                @empty
                                    <li><span class="dropdown-item text-secondary">No unread notifications.</span></li>
                                @endforelse
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">Admin</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.audit-logs.index') }}">Audit Logs</a></li>
                    @endif
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">@csrf
                            <button class="btn btn-sm btn-outline-light">Logout</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="btn btn-sm btn-success" href="{{ route('register') }}">Register</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<main class="py-4 fade-zoom">
    <div class="container">
        @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
        @if(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif
        @if($errors->any())
            <div class="alert alert-danger" role="alert" aria-live="polite">
                <strong>Please fix the following:</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @yield('content')
    </div>
</main>

<footer class="py-4 mt-5">
    <div class="container d-flex justify-content-between flex-wrap gap-3">
        <div>
            <p class="mb-1 text-secondary"><strong>NV CREATIVE</strong> - Wear Your Vision</p>
            <p class="mb-0 text-secondary">Address: Purok Tadena, Mankilam, Tagum City, Philippines</p>
        </div>
        <div class="text-md-end">
            <p class="mb-1 text-secondary">Contact: 09929759718</p>
            <p class="mb-1 text-secondary">Email: nvcreative@gmail.com</p>
            <p class="mb-0 text-secondary">Facebook: NV Creative</p>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    (() => {
        const navbar = document.getElementById('mainNavbar');
        if (!navbar) return;
        const updateNavbar = () => {
            if (window.scrollY > 20) {
                navbar.classList.add('navbar-scrolled');
            } else {
                navbar.classList.remove('navbar-scrolled');
            }
        };
        updateNavbar();
        window.addEventListener('scroll', updateNavbar, { passive: true });
    })();
</script>
</body>
</html>
