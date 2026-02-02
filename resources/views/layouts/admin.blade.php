<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - Amber Tradings</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Tailwind CSS via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 14px 20px;
            border-radius: 12px;
            color: #64748b;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        .sidebar-link:hover {
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            color: #ffffff;
        }
        .sidebar-link.active {
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            color: #ffffff;
            box-shadow: 0 4px 15px rgba(139, 92, 246, 0.3);
        }
        .sidebar-link i {
            width: 22px;
            text-align: center;
            font-size: 18px;
        }
        .stat-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 24px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }
        .glass-card {
            background: #ffffff;
            border-radius: 20px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }
        .gradient-purple {
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        }
        .gradient-blue {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        }
        .gradient-green {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }
        .gradient-orange {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        }
        .gradient-pink {
            background: linear-gradient(135deg, #ec4899 0%, #db2777 100%);
        }
    </style>
    
    @yield('styles')
</head>
<body class="bg-gray-50 min-h-screen text-gray-900">
    <!-- Mobile Menu Overlay -->
    <div id="sidebarOverlay" class="fixed inset-0 bg-black/50 z-40 lg:hidden hidden" onclick="toggleSidebar()"></div>
    
    <!-- Sidebar -->
    <aside id="sidebar" class="fixed top-0 left-0 z-50 h-full w-72 bg-white border-r border-gray-200 transform -translate-x-full lg:translate-x-0 transition-transform duration-300">
        <!-- Logo -->
        <div class="p-6 border-b border-gray-100">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <img src="{{ asset('images/logo.webp') }}" alt="Amber Tradings" class="h-10 object-contain">
            </a>
            <span class="inline-flex items-center mt-2 px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-600">
                <i class="fas fa-shield-alt mr-1"></i> Admin Panel
            </span>
        </div>
        
        <!-- Admin Profile -->
        <div class="p-6 border-b border-gray-100">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-full gradient-purple flex items-center justify-center text-white font-bold text-xl">
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="font-semibold text-gray-900 truncate">{{ auth()->user()->name }}</p>
                    <p class="text-sm text-purple-600 font-medium">Administrator</p>
                </div>
            </div>
        </div>
        
        <!-- Navigation -->
        <nav class="p-4 space-y-1">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-4 mb-3">Admin Menu</p>
            
            <a href="{{ route('admin.index') }}" class="sidebar-link {{ request()->routeIs('admin.index') ? 'active' : '' }}">
                <i class="fas fa-th-large"></i>
                <span>Dashboard</span>
            </a>
            
            <a href="{{ route('admin.users') }}" class="sidebar-link {{ request()->routeIs('admin.users') || request()->routeIs('admin.user-detail') ? 'active' : '' }}">
                <i class="fas fa-users"></i>
                <span>User Management</span>
            </a>
            
            <a href="{{ route('admin.packages') }}" class="sidebar-link {{ request()->routeIs('admin.packages*') ? 'active' : '' }}">
                <i class="fas fa-gem"></i>
                <span>Investment Packages</span>
            </a>
            
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-4 mt-6 mb-3">Payments</p>
            
            <a href="{{ route('admin.payment-settings') }}" class="sidebar-link {{ request()->routeIs('admin.payment-settings') ? 'active' : '' }}">
                <i class="fas fa-wallet"></i>
                <span>Payment Settings</span>
            </a>
            
            <a href="{{ route('admin.deposits') }}" class="sidebar-link {{ request()->routeIs('admin.deposits') ? 'active' : '' }}">
                <i class="fas fa-money-bill-wave"></i>
                <span>Deposit Requests</span>
                @php
                    $pendingDeposits = \App\Models\DepositRequest::where('status', 'pending')->count();
                @endphp
                @if($pendingDeposits > 0)
                <span class="ml-auto px-2 py-0.5 bg-red-500 text-white text-xs font-bold rounded-full">{{ $pendingDeposits }}</span>
                @endif
            </a>
        </nav>
        
        <!-- Logout at Bottom -->
        <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-gray-100">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-red-500 hover:bg-red-50 rounded-xl transition-colors font-medium">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Sign Out</span>
                </button>
            </form>
        </div>
    </aside>
    
    <!-- Main Content -->
    <main class="lg:ml-72 min-h-screen">
        <!-- Top Header -->
        <header class="bg-white border-b border-gray-200 sticky top-0 z-30">
            <div class="flex items-center justify-between px-6 py-4">
                <!-- Mobile Menu Button -->
                <button onclick="toggleSidebar()" class="lg:hidden p-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                
                <!-- Page Title -->
                <div class="hidden lg:block">
                    <h1 class="text-xl font-bold text-gray-900">@yield('page-title', 'Admin Dashboard')</h1>
                </div>
                
                <!-- Mobile Logo -->
                <div class="lg:hidden">
                    <img src="{{ asset('images/logo.webp') }}" alt="Amber Tradings" class="h-8 object-contain">
                </div>
                
                <!-- Right Actions -->
                <div class="flex items-center gap-4">
                    <a href="{{ route('home') }}" class="text-sm text-gray-500 hover:text-purple-600 hidden md:inline-flex items-center gap-2">
                        <i class="fas fa-globe"></i>
                        Main Website
                    </a>
                    <div class="w-10 h-10 rounded-full gradient-purple flex items-center justify-center text-white font-bold">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                </div>
            </div>
        </header>
        
        <!-- Alert Messages -->
        @if(session('success'))
        <div class="mx-6 mt-6">
            <div class="p-4 rounded-xl bg-green-50 border border-green-200 text-green-800 flex items-start gap-3">
                <i class="fas fa-check-circle text-green-500 mt-0.5"></i>
                <p>{{ session('success') }}</p>
            </div>
        </div>
        @endif
        
        @if(session('error'))
        <div class="mx-6 mt-6">
            <div class="p-4 rounded-xl bg-red-50 border border-red-200 text-red-800 flex items-start gap-3">
                <i class="fas fa-exclamation-circle text-red-500 mt-0.5"></i>
                <p>{{ session('error') }}</p>
            </div>
        </div>
        @endif
        
        <!-- Page Content -->
        <div class="p-6">
            @yield('content')
        </div>
    </main>
    
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }
    </script>
    
    @yield('scripts')
</body>
</html>
