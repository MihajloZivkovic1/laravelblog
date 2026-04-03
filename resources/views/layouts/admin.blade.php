<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin | @yield('title', 'Dashboard')</title>

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --sidebar-width: 260px;
            --sidebar-bg: #0f172a;
            --sidebar-accent: #6366f1;
            --sidebar-text: rgba(255,255,255,0.7);
            --topbar-height: 60px;
            --content-bg: #f1f5f9;
        }

        * { font-family: 'Inter', sans-serif; }

        body {
            background: var(--content-bg);
            min-height: 100vh;
        }

        /* ── Sidebar ── */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--sidebar-bg);
            overflow-y: auto;
            z-index: 1000;
            transition: transform 0.3s ease;
        }

        .sidebar-brand {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-brand h4 {
            color: #fff;
            font-weight: 700;
            margin: 0;
            font-size: 1.3rem;
        }

        .sidebar-brand span {
            color: var(--sidebar-accent);
        }

        .sidebar-brand small {
            color: var(--sidebar-text);
            font-size: 0.75rem;
        }

        .sidebar-menu {
            padding: 1rem 0;
            list-style: none;
            margin: 0;
        }

        .sidebar-menu .menu-label {
            color: rgba(255,255,255,0.3);
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 1rem 1.5rem 0.5rem;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.65rem 1.5rem;
            color: var(--sidebar-text);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            color: #fff;
            background: rgba(99,102,241,0.15);
            border-left-color: var(--sidebar-accent);
        }

        .sidebar-menu a i {
            font-size: 1.1rem;
            width: 20px;
        }

        /* ── Topbar ── */
        .topbar {
            position: fixed;
            top: 0;
            left: var(--sidebar-width);
            right: 0;
            height: var(--topbar-height);
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1.5rem;
            z-index: 999;
        }

        .topbar-title {
            font-weight: 600;
            font-size: 1rem;
            color: #0f172a;
        }

        .topbar-user {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #475569;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .topbar-user .avatar {
            width: 34px;
            height: 34px;
            background: var(--sidebar-accent);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 700;
            font-size: 0.85rem;
        }

        /* ── Main Content ── */
        .main-content {
            margin-left: var(--sidebar-width);
            padding-top: var(--topbar-height);
            min-height: 100vh;
        }

        .content-wrapper {
            padding: 1.5rem;
        }

        /* ── Cards ── */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
        }

        .card-header {
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            border-radius: 12px 12px 0 0 !important;
            padding: 1rem 1.5rem;
            font-weight: 600;
        }

        /* ── Tables ── */
        .table th {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #64748b;
            font-weight: 600;
            border-bottom: 2px solid #e2e8f0;
        }

        /* ── Badges ── */
        .badge-published {
            background: #dcfce7;
            color: #16a34a;
            padding: 0.3rem 0.7rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .badge-draft {
            background: #fef9c3;
            color: #ca8a04;
            padding: 0.3rem 0.7rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        /* ── Buttons ── */
        .btn-primary {
            background: var(--sidebar-accent);
            border-color: var(--sidebar-accent);
        }

        .btn-primary:hover {
            background: #4f46e5;
            border-color: #4f46e5;
        }

        /* ── Stat Cards ── */
        .stat-card {
            background: #fff;
            border-radius: 12px;
            padding: 1.5rem;
            border: none;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
        }

        .stat-card .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
        }

        .stat-card .stat-value {
            font-size: 1.8rem;
            font-weight: 700;
            color: #0f172a;
        }

        .stat-card .stat-label {
            color: #64748b;
            font-size: 0.85rem;
        }
    </style>

    @stack('styles')
</head>
<body>

{{-- Sidebar --}}
<aside class="sidebar">
    <div class="sidebar-brand">
        <h4>World<span>Blog</span></h4>
        <small>Admin Panel</small>
    </div>

    <ul class="sidebar-menu">
        <li class="menu-label">Main</li>
        <li>
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
        </li>

        <li class="menu-label">Content</li>
        <li>
            <a href="{{ route('admin.posts.index') }}" class="{{ request()->routeIs('admin.posts.*') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-text"></i> Posts
            </a>
        </li>
        <li>
            <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <i class="bi bi-folder"></i> Categories
            </a>
        </li>
        <li>
            <a href="{{ route('admin.tags.index') }}" class="{{ request()->routeIs('admin.tags.*') ? 'active' : '' }}">
                <i class="bi bi-tags"></i> Tags
            </a>
        </li>

        <li class="menu-label">Users</li>
        <li>
            <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="bi bi-people"></i> Users
            </a>
        </li>

        <li class="menu-label">Moderation</li>
        <li>
            <a href="{{ route('admin.comments.index') }}" class="{{ request()->routeIs('admin.comments.*') ? 'active' : '' }}">
                <i class="bi bi-chat-dots"></i> Comments
            </a>
        </li>
        <li>
            <a href="{{ route('admin.contact.index') }}" class="{{ request()->routeIs('admin.contact.*') ? 'active' : '' }}">
                <i class="bi bi-envelope"></i> Messages
            </a>
        </li>

        <li class="menu-label">System</li>
        <li>
            <a href="{{ route('admin.logs.index') }}" class="{{ request()->routeIs('admin.logs.*') ? 'active' : '' }}">
                <i class="bi bi-journal-text"></i> Activity Logs
            </a>
        </li>

        <li class="menu-label">Account</li>
        <li>
            <a href="{{ route('home') }}">
                <i class="bi bi-globe"></i> View Site
            </a>
        </li>
        <li>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" style="background:none;border:none;width:100%;text-align:left;">
                    <a href="#" onclick="event.preventDefault(); this.closest('form').submit()">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </a>
                </button>
            </form>
        </li>
    </ul>
</aside>

{{-- Topbar --}}
<div class="topbar">
    <span class="topbar-title">@yield('title', 'Dashboard')</span>
    <div class="topbar-user">
        <div class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
        {{ auth()->user()->name }}
    </div>
</div>

{{-- Main Content --}}
<div class="main-content">
    <div class="content-wrapper">

        {{-- Flash Messages --}}
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

        @yield('content')
    </div>
</div>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@stack('scripts')
</body>
</html>
