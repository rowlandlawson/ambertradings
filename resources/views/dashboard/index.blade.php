@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')
<!-- Welcome Section -->
<div class="mb-8">
    <p class="text-blue-600 font-medium">Welcome!</p>
    <h1 class="text-2xl font-bold text-gray-900">{{ auth()->user()->name }}</h1>
    <p class="text-gray-500 mt-1">Here's a summary of your account. Have fun!</p>
</div>

<!-- Main Balance Card -->
<div class="glass-card p-6 mb-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
        <div class="flex-1">
            <div class="flex items-center gap-2 mb-2">
                <h3 class="text-gray-500 text-sm font-medium">Available Balance</h3>
                <i class="fas fa-info-circle text-gray-400 text-xs"></i>
            </div>
            <p class="text-4xl font-bold text-gray-900">{{ number_format($stats['balance'], 2) }} <span class="text-xl text-gray-400">USD</span></p>
            
            <div class="mt-4 pt-4 border-t border-gray-100">
                <div class="flex items-center gap-2">
                    <span class="text-gray-500 text-sm">INVESTMENT ACCOUNT</span>
                    <i class="fas fa-info-circle text-gray-400 text-xs"></i>
                </div>
                <p class="text-lg font-semibold text-gray-700">{{ number_format($stats['total_invested'], 2) }} USD</p>
            </div>
        </div>
        
        <div class="flex flex-col sm:flex-row gap-3">
            <a href="{{ route('dashboard.fund') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 gradient-blue text-white font-semibold rounded-xl hover:opacity-90 transition-opacity">
                Deposit <i class="fas fa-arrow-right"></i>
            </a>
            <a href="{{ route('dashboard.plans') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-white border-2 border-gray-200 text-gray-700 font-semibold rounded-xl hover:border-blue-500 hover:text-blue-600 transition-colors">
                Invest & Earn
            </a>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    <!-- Total Deposit Card -->
    <div class="glass-card p-6">
        <div class="flex items-center justify-between mb-3">
            <h4 class="text-gray-500 font-medium">Total Deposit</h4>
            <i class="fas fa-info-circle text-gray-400"></i>
        </div>
        <p class="text-3xl font-bold text-gray-900">{{ number_format($stats['total_invested'] + $stats['balance'], 2) }} <span class="text-lg text-gray-400">USD</span></p>
        <div class="mt-3 pt-3 border-t border-gray-100">
            <p class="text-xs text-gray-400 uppercase">This Month</p>
            <p class="text-sm font-medium text-gray-600">0 USD</p>
        </div>
    </div>
    
    <!-- Total Profit/Loss Card -->
    <div class="glass-card p-6">
        <div class="flex items-center justify-between mb-3">
            <h4 class="text-gray-500 font-medium">{{ $stats['total_profit'] >= 0 ? 'Total Profit' : 'Total Loss' }}</h4>
            <i class="fas fa-info-circle text-gray-400"></i>
        </div>
        @if($stats['total_profit'] >= 0)
        <p class="text-3xl font-bold text-green-600">+{{ number_format($stats['total_profit'], 2) }} <span class="text-lg text-gray-400">USD</span></p>
        @else
        <p class="text-3xl font-bold text-red-600">{{ number_format($stats['total_profit'], 2) }} <span class="text-lg text-gray-400">USD</span></p>
        @endif
        <div class="mt-3 pt-3 border-t border-gray-100">
            <div class="flex justify-between text-xs">
                <div>
                    <p class="text-gray-400 uppercase">Profit</p>
                    <p class="text-sm font-medium text-green-600">+${{ number_format($stats['total_profit_raw'] ?? 0, 2) }}</p>
                </div>
                <div>
                    <p class="text-gray-400 uppercase">Loss</p>
                    <p class="text-sm font-medium text-red-600">-${{ number_format($stats['total_loss'] ?? 0, 2) }}</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Active Investments Card -->
    <div class="glass-card p-6">
        <div class="flex items-center justify-between mb-3">
            <h4 class="text-gray-500 font-medium">Active Investments</h4>
            <i class="fas fa-info-circle text-gray-400"></i>
        </div>
        <p class="text-3xl font-bold text-blue-600">{{ $stats['active_investments'] }}</p>
        <div class="mt-3 pt-3 border-t border-gray-100">
            <p class="text-xs text-gray-400 uppercase">Total Investments</p>
            <p class="text-sm font-medium text-gray-600">{{ $stats['total_investments'] }}</p>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="glass-card p-6 mb-8">
    <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <a href="{{ route('dashboard.fund') }}" class="flex flex-col items-center gap-3 p-4 rounded-xl bg-blue-50 hover:bg-blue-100 transition-colors group">
            <div class="w-12 h-12 rounded-full gradient-blue flex items-center justify-center">
                <i class="fas fa-plus text-white"></i>
            </div>
            <span class="text-sm font-medium text-gray-700 group-hover:text-blue-600">Deposit</span>
        </a>
        
        <a href="{{ route('dashboard.plans') }}" class="flex flex-col items-center gap-3 p-4 rounded-xl bg-green-50 hover:bg-green-100 transition-colors group">
            <div class="w-12 h-12 rounded-full gradient-green flex items-center justify-center">
                <i class="fas fa-chart-line text-white"></i>
            </div>
            <span class="text-sm font-medium text-gray-700 group-hover:text-green-600">Invest</span>
        </a>
        
        <a href="{{ route('dashboard.transactions') }}" class="flex flex-col items-center gap-3 p-4 rounded-xl bg-purple-50 hover:bg-purple-100 transition-colors group">
            <div class="w-12 h-12 rounded-full gradient-purple flex items-center justify-center">
                <i class="fas fa-history text-white"></i>
            </div>
            <span class="text-sm font-medium text-gray-700 group-hover:text-purple-600">History</span>
        </a>
        
        <a href="{{ route('dashboard.profile') }}" class="flex flex-col items-center gap-3 p-4 rounded-xl bg-orange-50 hover:bg-orange-100 transition-colors group">
            <div class="w-12 h-12 rounded-full gradient-orange flex items-center justify-center">
                <i class="fas fa-user text-white"></i>
            </div>
            <span class="text-sm font-medium text-gray-700 group-hover:text-orange-600">Profile</span>
        </a>
    </div>
</div>

<!-- Recent Activity -->
<div class="grid lg:grid-cols-2 gap-6">
    <!-- Recent Transactions -->
    <div class="glass-card overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex items-center justify-between">
            <h3 class="text-lg font-semibold text-gray-900">Recent Transactions</h3>
            <a href="{{ route('dashboard.transactions') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium">View All</a>
        </div>
        <div class="p-6">
            @if($recentTransactions->count() > 0)
            <div class="space-y-4">
                @foreach($recentTransactions as $transaction)
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center
                        @if($transaction->type == 'deposit' || $transaction->type == 'profit') bg-green-100 text-green-600
                        @elseif($transaction->type == 'withdrawal' || $transaction->type == 'loss') bg-red-100 text-red-600
                        @else bg-blue-100 text-blue-600 @endif">
                        <i class="{{ $transaction->type_icon }}"></i>
                    </div>
                    <div class="flex-1">
                        <p class="font-medium text-gray-900 capitalize">{{ $transaction->type }}</p>
                        <p class="text-xs text-gray-500">{{ $transaction->created_at->diffForHumans() }}</p>
                    </div>
                    <p class="font-semibold
                        @if($transaction->type == 'deposit' || $transaction->type == 'profit') text-green-600
                        @elseif($transaction->type == 'withdrawal' || $transaction->type == 'loss') text-red-600
                        @else text-gray-900 @endif">
                        @if($transaction->type == 'deposit' || $transaction->type == 'profit')
                        +${{ number_format($transaction->amount, 2) }}
                        @elseif($transaction->type == 'withdrawal' || $transaction->type == 'loss')
                        -${{ number_format($transaction->amount, 2) }}
                        @else
                        ${{ number_format($transaction->amount, 2) }}
                        @endif
                    </p>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-8">
                <div class="w-16 h-16 mx-auto rounded-full bg-gray-100 flex items-center justify-center mb-4">
                    <i class="fas fa-exchange-alt text-gray-400 text-xl"></i>
                </div>
                <p class="text-gray-500">No transactions yet</p>
            </div>
            @endif
        </div>
    </div>
    
    <!-- Active Investments -->
    <div class="glass-card overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex items-center justify-between">
            <h3 class="text-lg font-semibold text-gray-900">Active Investments</h3>
            <a href="{{ route('dashboard.investments') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium">View All</a>
        </div>
        <div class="p-6">
            @if($activeInvestments->count() > 0)
            <div class="space-y-4">
            @foreach($activeInvestments as $investment)
                @php
                    $netProfit = $investment->net_profit;
                    $isGain = $netProfit >= 0;
                    $currentValue = $investment->current_value;
                    $hasCapitalLoss = $investment->hasCapitalLoss();
                @endphp
                <div class="flex items-center gap-4 p-4 rounded-xl bg-gray-50">
                    <div class="w-10 h-10 rounded-full {{ $isGain ? 'gradient-blue' : 'bg-red-500' }} flex items-center justify-center">
                        <i class="fas {{ $isGain ? 'fa-chart-line' : 'fa-arrow-trend-down' }} text-white"></i>
                    </div>
                    <div class="flex-1">
                        <p class="font-medium text-gray-900">{{ $investment->type }}</p>
                        <p class="text-xs text-gray-500">${{ number_format($investment->amount, 2) }} invested</p>
                    </div>
                    <div class="text-right">
                        @if($isGain)
                        <p class="font-semibold text-green-600">+${{ number_format($netProfit, 2) }}</p>
                        @else
                        <p class="font-semibold text-red-600">-${{ number_format(abs($netProfit), 2) }}</p>
                        @endif
                        @if($hasCapitalLoss)
                        <p class="text-xs text-red-500">Value: ${{ number_format($currentValue, 2) }}</p>
                        @endif
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $isGain ? 'bg-blue-100 text-blue-600' : 'bg-red-100 text-red-600' }}">
                            {{ $isGain ? 'Active' : 'Loss' }}
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
                <p class="text-gray-500 mb-4">No active investments</p>
                <a href="{{ route('dashboard.plans') }}" class="inline-flex items-center gap-2 px-4 py-2 gradient-blue text-white text-sm font-medium rounded-lg">
                    <i class="fas fa-plus"></i>
                    Start Investing
                </a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
