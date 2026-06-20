<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'TLMS') }} - Time & Labor Management System</title>
    <link rel="stylesheet" href="https://cdn.tailwindcss.com">
    <link rel="stylesheet" href="{{ asset('css/tlms.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="flex">
        
        <!-- Sidebar -->
        <aside class="sidebar">
            <!-- Logo -->
            <div class="sidebar-logo">
                <div class="icon">
                    <i class="fas fa-building"></i>
                </div>
                <span class="text">TLMS</span>
            </div>
            
            <!-- Menu -->
            <ul class="sidebar-menu">
                <li>
                    <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('attendance.index') }}" class="sidebar-link {{ request()->routeIs('attendance.*') ? 'active' : '' }}">
                        <i class="fas fa-calendar-check"></i>
                        <span>Attendance</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('employees.index') }}" class="sidebar-link {{ request()->routeIs('employees.*') ? 'active' : '' }}">
                        <i class="fas fa-users"></i>
                        <span>Employees</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('reports.index') }}" class="sidebar-link {{ request()->routeIs('reports.*') ? 'active' : '' }}">
                        <i class="fas fa-chart-bar"></i>
                        <span>Reports</span>
                    </a>
                </li>
            </ul>
            
            <div class="sidebar-divider"></div>
            
            <!-- User Info -->
            <div class="user-info-box">
                <div class="flex items-center gap-3">
                    <div class="avatar">{{ substr(Auth::user()->name, 0, 1) }}</div>
                    <div>
                        <div class="name">{{ Auth::user()->name }}</div>
                        <div class="email">{{ Auth::user()->email }}</div>
                    </div>
                </div>
            </div>
            
            <!-- Logout -->
            <div class="logout-btn">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="sidebar-link w-full">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="main-content flex-1">
            <!-- Top Bar -->
            <header class="top-bar">
                <h2 class="page-title">
                    @if(request()->routeIs('dashboard')) Dashboard
                    @elseif(request()->routeIs('attendance.*')) Attendance
                    @elseif(request()->routeIs('employees.*')) Employees Management
                    @elseif(request()->routeIs('reports.*')) Reports
                    @else TLMS
                    @endif
                </h2>
                <div class="user-info">
                    <div class="user-avatar">{{ substr(Auth::user()->name, 0, 1) }}</div>
                    <span class="font-semibold">{{ Auth::user()->name }}</span>
                </div>
            </header>

            <!-- Page Content -->
            <main class="page-content">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>