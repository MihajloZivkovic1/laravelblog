<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Laravel Blog')</title>

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Source+Sans+3:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #1a1a2e;
            --accent: #e94560;
            --light-bg: #f8f9fa;
            --text: #333;
        }

        body {
            font-family: 'Source Sans 3', sans-serif;
            color: var(--text);
            background: #fff;
        }

        h1, h2, h3, h4, h5 {
            font-family: 'Playfair Display', serif;
        }

        /* Navbar */
        .navbar {
            background: var(--primary) !important;
            padding: 1rem 0;
            border-bottom: 3px solid var(--accent);
        }

        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            color: #fff !important;
            font-weight: 700;
        }

        .navbar-brand span {
            color: var(--accent);
        }

        .nav-link {
            color: rgba(255,255,255,0.8) !important;
            font-weight: 600;
            transition: color 0.2s;
        }

        .nav-link:hover {
            color: var(--accent) !important;
        }

        /* Search bar */
        .search-form .form-control {
            border-radius: 20px 0 0 20px;
            border: none;
        }

        .search-form .btn {
            border-radius: 0 20px 20px 0;
            background: var(--accent);
            border: none;
            color: #fff;
        }

        /* Main content */
        main {
            min-height: calc(100vh - 140px);
            padding: 2rem 0;
        }

        /* Alerts */
        .alert {
            border-radius: 8px;
            border: none;
        }

        /* Footer */
        footer {
            background: var(--primary);
            color: rgba(255,255,255,0.7);
            padding: 1.5rem 0;
            font-size: 0.9rem;
            border-top: 3px solid var(--accent);
        }

        footer a {
            color: var(--accent);
            text-decoration: none;
        }

        /* Sidebar */
        .sidebar-widget {
            background: var(--light-bg);
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .sidebar-widget h5 {
            color: var(--primary);
            border-bottom: 2px solid var(--accent);
            padding-bottom: 0.5rem;
            margin-bottom: 1rem;
        }

        /* Buttons */
        .btn-accent {
            background: var(--accent);
            color: #fff;
            border: none;
        }

        .btn-accent:hover {
            background: #c73652;
            color: #fff;
        }
    </style>

    @stack('styles')
</head>
<body>

{{-- Navbar --}}
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">Laravel<span>Blog</span></a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            {{-- Search --}}
            <form class="search-form d-flex mx-auto" action="{{ route('posts.search') }}" method="GET">
                <input class="form-control" type="search" name="q" placeholder="Search posts..." value="{{ request('q') }}">
                <button type="submit"><i class="bi bi-search"></i></button>
            </form>

            {{-- Nav Links --}}
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                </li>

                @auth
                    @if(auth()->user()->isAdmin())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                <i class="bi bi-speedometer2"></i> Admin
                            </a>
                        </li>
                    @endif
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle"></i> {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="bi bi-box-arrow-right"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-accent px-3 ms-2 rounded-pill" href="{{ route('register') }}">Register</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

{{-- Flash Messages --}}
<div class="container mt-3">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="bi bi-exclamation-circle"></i>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
</div>

{{-- Main Content --}}
<main>
    <div class="container">
        @yield('content')
    </div>
</main>

{{-- Footer --}}
<footer>
    <div class="container text-center">
        <p class="mb-0">&copy; {{ date('Y') }} <a href="{{ route('home') }}">LaravelBlog</a>. All rights reserved.</p>
    </div>
</footer>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@stack('scripts')
</body>
</html>
