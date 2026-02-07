<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - Amber Tradings</title>
    
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
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: #ffffff;
        }
        .sidebar-link.active {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: #ffffff;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
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
        .gradient-blue {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        }
        .gradient-green {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }
        .gradient-purple {
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        }
        .gradient-orange {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
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
        </div>
        
        <!-- User Profile Quick View -->
        <div class="p-6 border-b border-gray-100">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-full gradient-blue flex items-center justify-center text-white font-bold text-xl">
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="font-semibold text-gray-900 truncate">{{ auth()->user()->name }}</p>
                    <p class="text-sm text-gray-500 truncate">{{ auth()->user()->email }}</p>
                </div>
            </div>
        </div>
        
        <!-- Navigation -->
        <nav class="p-4 space-y-1">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-4 mb-3">Menu</p>
            
            <a href="{{ route('dashboard.index') }}" class="sidebar-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
                <i class="fas fa-th-large"></i>
                <span>Dashboard</span>
            </a>
            
            <a href="{{ route('dashboard.transactions') }}" class="sidebar-link {{ request()->routeIs('dashboard.transactions') ? 'active' : '' }}">
                <i class="fas fa-exchange-alt"></i>
                <span>Transaction</span>
            </a>
            
            <a href="{{ route('dashboard.investments') }}" class="sidebar-link {{ request()->routeIs('dashboard.investments') ? 'active' : '' }}">
                <i class="fas fa-chart-line"></i>
                <span>Investment</span>
            </a>
            
            <a href="{{ route('dashboard.plans') }}" class="sidebar-link {{ request()->routeIs('dashboard.plans') ? 'active' : '' }}">
                <i class="fas fa-gem"></i>
                <span>Our Plans</span>
            </a>
            
            <a href="{{ route('dashboard.fund') }}" class="sidebar-link {{ request()->routeIs('dashboard.fund') ? 'active' : '' }}">
                <i class="fas fa-wallet"></i>
                <span>Deposit Funds</span>
            </a>
            
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-4 mt-6 mb-3">Account</p>
            
            <a href="{{ route('dashboard.profile') }}" class="sidebar-link {{ request()->routeIs('dashboard.profile') ? 'active' : '' }}">
                <i class="fas fa-user"></i>
                <span>My Profile</span>
            </a>
            
            @if(auth()->user()->isAdmin())
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-4 mt-6 mb-3">Admin</p>
            
            <a href="{{ route('admin.index') }}" class="sidebar-link">
                <i class="fas fa-cog"></i>
                <span>Admin Panel</span>
            </a>
            @endif
        </nav>
        
        <!-- Logout at Bottom (Removed) -->
        <!-- <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-gray-100"></div> -->
    </aside>
    
    <!-- Main Content -->
    <main class="lg:ml-72 min-h-screen">
        <!-- Top Header -->
        <header class="bg-white border-b border-gray-200 sticky top-0 z-30">
            <div class="flex items-center justify-between px-6 py-4">
                <!-- Mobile Menu Button -->
                <button onclick="toggleSidebar()" class="lg:hidden p-2 text-gray-600 hover:bg-gray-100 rounded-lg mr-2">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                
                <!-- Mobile Actions (Beside Hamburger) -->
                <div class="flex items-center gap-2 lg:hidden">
                    <!-- Go to Website -->
                    <a href="{{ route('home') }}" class="w-10 h-10 flex items-center justify-center text-gray-500 hover:text-blue-600 hover:bg-blue-50 rounded-full transition-all" title="Go to Website">
                        <i class="fas fa-globe text-lg"></i>
                    </a>
                    
                    <!-- Sign Out -->
                    <form action="{{ route('logout') }}" method="POST" class="inline-block">
                        @csrf
                        <button type="submit" class="w-10 h-10 flex items-center justify-center text-gray-500 hover:text-red-500 hover:bg-red-50 rounded-full transition-all" title="Sign Out">
                            <i class="fas fa-sign-out-alt text-lg"></i>
                        </button>
                    </form>
                </div>
                
                <!-- Page Title -->
                <div class="hidden lg:block">
                    <p class="text-sm text-gray-500">Welcome back,</p>
                    <h1 class="text-xl font-bold text-gray-900">{{ auth()->user()->name }}</h1>
                </div>
                
                <!-- Mobile Logo -->
                <div class="lg:hidden">
                    <img src="{{ asset('images/logo.webp') }}" alt="Amber Tradings" class="h-8 object-contain">
                </div>
                
                <!-- Right Actions -->
                <div class="flex items-center gap-4">
                    <!-- Desktop Actions (Hidden on Mobile) -->
                    <div class="hidden lg:flex items-center gap-4">
                        <!-- Go to Website -->
                        <a href="{{ route('home') }}" class="w-10 h-10 flex items-center justify-center text-gray-500 hover:text-blue-600 hover:bg-blue-50 rounded-full transition-all" title="Go to Website">
                            <i class="fas fa-globe text-lg"></i>
                        </a>
                        
                        <!-- Sign Out -->
                        <form action="{{ route('logout') }}" method="POST" class="inline-block">
                            @csrf
                            <button type="submit" class="w-10 h-10 flex items-center justify-center text-gray-500 hover:text-red-500 hover:bg-red-50 rounded-full transition-all" title="Sign Out">
                                <i class="fas fa-sign-out-alt text-lg"></i>
                            </button>
                        </form>
                    </div>

                    <div class="w-10 h-10 rounded-full gradient-blue flex items-center justify-center text-white font-bold">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                </div>
            </div>
        </header>
        
        <!-- Page Content -->
        <div class="p-4 lg:p-6">
            @yield('content')
        </div>
    </main>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        window.Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        @if(session('success'))
            Toast.fire({
                icon: 'success',
                title: "{{ session('success') }}"
            });
        @endif

        @if(session('error'))
            Toast.fire({
                icon: 'error',
                title: "{{ session('error') }}"
            });
        @endif
        
        @if(session('info'))
            Toast.fire({
                icon: 'info',
                title: "{{ session('info') }}"
            });
        @endif
        
        @if(session('warning'))
            Toast.fire({
                icon: 'warning',
                title: "{{ session('warning') }}"
            });
        @endif
        
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
