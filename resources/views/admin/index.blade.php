@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard Overview')

@section('content')
<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Users -->
    <div class="stat-card">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl gradient-purple flex items-center justify-center">
                <i class="fas fa-users text-white text-xl"></i>
            </div>
            <span class="text-xs text-gray-400 uppercase font-medium">Users</span>
        </div>
        <h3 class="text-3xl font-bold text-gray-900 mb-1">{{ number_format($totalUsers) }}</h3>
        <p class="text-sm text-gray-500">Total registered users</p>
    </div>
    
    <!-- Total Investments -->
    <div class="stat-card">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl gradient-blue flex items-center justify-center">
                <i class="fas fa-chart-line text-white text-xl"></i>
            </div>
            <span class="text-xs text-gray-400 uppercase font-medium">Investments</span>
        </div>
        <h3 class="text-3xl font-bold text-gray-900 mb-1">${{ number_format($totalInvested, 2) }}</h3>
        <p class="text-sm text-gray-500">Total invested amount</p>
    </div>
    
    <!-- Total Profit Paid -->
    <div class="stat-card">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl gradient-green flex items-center justify-center">
                <i class="fas fa-money-bill-wave text-white text-xl"></i>
            </div>
            <span class="text-xs text-gray-400 uppercase font-medium">Profits</span>
        </div>
        <h3 class="text-3xl font-bold text-green-600 mb-1">${{ number_format($totalProfit, 2) }}</h3>
        <p class="text-sm text-gray-500">Total profit distributed</p>
    </div>
    
    <!-- Active Packages -->
    <div class="stat-card">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl gradient-orange flex items-center justify-center">
                <i class="fas fa-gem text-white text-xl"></i>
            </div>
            <span class="text-xs text-gray-400 uppercase font-medium">Packages</span>
        </div>
        <h3 class="text-3xl font-bold text-gray-900 mb-1">{{ $activePackages }}</h3>
        <p class="text-sm text-gray-500">Active investment plans</p>
    </div>
</div>

<!-- Quick Actions -->
<div class="glass-card p-6 mb-8">
    <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <a href="{{ route('admin.users') }}" class="flex flex-col items-center gap-3 p-4 rounded-xl bg-purple-50 hover:bg-purple-100 transition-colors group">
            <div class="w-12 h-12 rounded-full gradient-purple flex items-center justify-center">
                <i class="fas fa-users text-white"></i>
            </div>
            <span class="text-sm font-medium text-gray-700 group-hover:text-purple-600">Manage Users</span>
        </a>
        
        <a href="{{ route('admin.packages') }}" class="flex flex-col items-center gap-3 p-4 rounded-xl bg-blue-50 hover:bg-blue-100 transition-colors group">
            <div class="w-12 h-12 rounded-full gradient-blue flex items-center justify-center">
                <i class="fas fa-gem text-white"></i>
            </div>
            <span class="text-sm font-medium text-gray-700 group-hover:text-blue-600">Packages</span>
        </a>
        
        <a href="{{ route('admin.package.create') }}" class="flex flex-col items-center gap-3 p-4 rounded-xl bg-green-50 hover:bg-green-100 transition-colors group">
            <div class="w-12 h-12 rounded-full gradient-green flex items-center justify-center">
                <i class="fas fa-plus text-white"></i>
            </div>
            <span class="text-sm font-medium text-gray-700 group-hover:text-green-600">New Package</span>
        </a>
        
        <a href="{{ route('home') }}" class="flex flex-col items-center gap-3 p-4 rounded-xl bg-orange-50 hover:bg-orange-100 transition-colors group">
            <div class="w-12 h-12 rounded-full gradient-orange flex items-center justify-center">
                <i class="fas fa-globe text-white"></i>
            </div>
            <span class="text-sm font-medium text-gray-700 group-hover:text-orange-600">View Site</span>
        </a>
    </div>
</div>

<!-- Recent Users & Activities -->
<div class="grid lg:grid-cols-2 gap-6">
    <!-- Recent Users -->
    <div class="glass-card overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex items-center justify-between">
            <h3 class="text-lg font-semibold text-gray-900">Recent Users</h3>
            <a href="{{ route('admin.users') }}" class="text-sm text-purple-600 hover:text-purple-700 font-medium">View All</a>
        </div>
        <div class="p-6">
            @if($recentUsers->count() > 0)
            <div class="space-y-4">
                @foreach($recentUsers as $user)
                <a href="{{ route('admin.user-detail', $user->id) }}" class="flex items-center gap-4 p-3 rounded-xl hover:bg-gray-50 transition-colors">
                    <div class="w-10 h-10 rounded-full gradient-blue flex items-center justify-center text-white font-bold">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-medium text-gray-900 truncate">{{ $user->name }}</p>
                        <p class="text-xs text-gray-500 truncate">{{ $user->email }}</p>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold text-gray-900">${{ number_format($user->balance, 2) }}</p>
                        <p class="text-xs text-gray-500">{{ $user->created_at->diffForHumans() }}</p>
                    </div>
                </a>
                @endforeach
            </div>
            @else
            <div class="text-center py-8">
                <div class="w-16 h-16 mx-auto rounded-full bg-gray-100 flex items-center justify-center mb-4">
                    <i class="fas fa-users text-gray-400 text-xl"></i>
                </div>
                <p class="text-gray-500">No users yet</p>
            </div>
            @endif
        </div>
    </div>
    
    <!-- Recent Investments -->
    <div class="glass-card overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex items-center justify-between">
            <h3 class="text-lg font-semibold text-gray-900">Recent Investments</h3>
        </div>
        <div class="p-6">
            @if($recentInvestments->count() > 0)
            <div class="space-y-4">
                @foreach($recentInvestments as $investment)
                <div class="flex items-center gap-4 p-3 rounded-xl bg-gray-50">
                    <div class="w-10 h-10 rounded-full gradient-green flex items-center justify-center">
                        <i class="fas fa-chart-line text-white"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-medium text-gray-900 truncate">{{ $investment->user->name ?? 'Unknown' }}</p>
                        <p class="text-xs text-gray-500">{{ $investment->type }}</p>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold text-gray-900">${{ number_format($investment->amount, 2) }}</p>
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium
                            @if($investment->status == 'active') bg-blue-100 text-blue-600
                            @elseif($investment->status == 'completed') bg-green-100 text-green-600
                            @else bg-gray-100 text-gray-600 @endif">
                            {{ ucfirst($investment->status) }}
                        </span>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-8">
                <div class="w-16 h-16 mx-auto rounded-full bg-gray-100 flex items-center justify-center mb-4">
                    <i class="fas fa-chart-line text-gray-400 text-xl"></i>
                </div>
                <p class="text-gray-500">No investments yet</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
