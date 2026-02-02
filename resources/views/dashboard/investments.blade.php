@extends('layouts.dashboard')

@section('title', 'My Investments')
@section('page-title', 'My Investments')

@section('content')
<!-- Investment Summary Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
    <!-- Total Invested -->
    <div class="glass-card p-5">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center">
                <i class="fas fa-chart-line text-blue-600 text-xl"></i>
            </div>
            <div>
                <p class="text-xs text-gray-500 uppercase">Total Invested</p>
                <p class="text-xl font-bold text-gray-900">${{ number_format($user->total_invested, 2) }}</p>
            </div>
        </div>
    </div>
    
    <!-- Total Profit/Gain -->
    <div class="glass-card p-5">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center">
                <i class="fas fa-arrow-trend-up text-green-600 text-xl"></i>
            </div>
            <div>
                <p class="text-xs text-gray-500 uppercase">Total Profit</p>
                <p class="text-xl font-bold text-green-600">+${{ number_format($user->total_profit, 2) }}</p>
            </div>
        </div>
    </div>
    
    <!-- ROI Percentage -->
    <div class="glass-card p-5">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-amber-100 flex items-center justify-center">
                <i class="fas fa-percent text-amber-600 text-xl"></i>
            </div>
            <div>
                <p class="text-xs text-gray-500 uppercase">Overall ROI</p>
                @php
                    $roi = $user->total_invested > 0 ? ($user->total_profit / $user->total_invested) * 100 : 0;
                @endphp
                <p class="text-xl font-bold {{ $roi >= 0 ? 'text-green-600' : 'text-red-600' }}">{{ number_format($roi, 2) }}%</p>
            </div>
        </div>
    </div>
    
    <!-- Active Investments Count -->
    <div class="glass-card p-5">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center">
                <i class="fas fa-coins text-purple-600 text-xl"></i>
            </div>
            <div>
                <p class="text-xs text-gray-500 uppercase">Active Investments</p>
                <p class="text-xl font-bold text-gray-900">{{ $investments->where('status', 'active')->count() }}</p>
            </div>
        </div>
    </div>
</div>

@if(session('success'))
<div class="glass-card p-4 mb-6 bg-green-50 border-green-200 text-green-800 flex items-start gap-3">
    <i class="fas fa-check-circle text-green-500 mt-0.5"></i>
    <p>{{ session('success') }}</p>
</div>
@endif

<div class="glass-card overflow-hidden">
    <!-- Header -->
    <div class="p-6 border-b border-gray-200">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-xl font-semibold text-gray-900">Investment Portfolio</h2>
                <p class="text-gray-500 text-sm mt-1">Track all your investments and their performance</p>
            </div>
            <a href="{{ route('dashboard.plans') }}" class="px-5 py-2.5 bg-gradient-to-r from-amber-500 to-orange-600 text-white font-medium rounded-xl hover:from-amber-600 hover:to-orange-700 transition-all text-sm">
                <i class="fas fa-plus mr-2"></i>New Investment
            </a>
        </div>
    </div>
    
    <!-- Investment List -->
    <div class="p-6">
        @if($investments->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-left text-xs text-gray-500 uppercase border-b border-gray-200">
                        <th class="pb-4 font-medium">Investment</th>
                        <th class="pb-4 font-medium">Invested</th>
                        <th class="pb-4 font-medium">Current Profit</th>
                        <th class="pb-4 font-medium">Return</th>
                        <th class="pb-4 font-medium">Status</th>
                        <th class="pb-4 font-medium">End Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($investments as $investment)
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                        <td class="py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-500 to-orange-600 flex items-center justify-center">
                                    @if($investment->package)
                                    <i class="{{ $investment->package->icon ?? 'fas fa-chart-line' }} text-white text-sm"></i>
                                    @else
                                    <i class="fas fa-chart-line text-white text-sm"></i>
                                    @endif
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">{{ $investment->type }}</p>
                                    @if($investment->package)
                                    <p class="text-xs text-gray-500">{{ $investment->package->name }}</p>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="py-4 font-semibold text-gray-900">${{ number_format($investment->amount, 2) }}</td>
                        <td class="py-4">
                            @if($investment->profit > 0)
                            <span class="text-green-600 font-semibold">+${{ number_format($investment->profit, 2) }}</span>
                            @elseif($investment->profit < 0)
                            <span class="text-red-600 font-semibold">-${{ number_format(abs($investment->profit), 2) }}</span>
                            @else
                            <span class="text-gray-400">$0.00</span>
                            @endif
                        </td>
                        <td class="py-4">
                            @php
                                $investmentRoi = $investment->amount > 0 ? ($investment->profit / $investment->amount) * 100 : 0;
                            @endphp
                            <span class="{{ $investmentRoi >= 0 ? 'text-green-600' : 'text-red-600' }} font-medium">
                                {{ $investmentRoi >= 0 ? '+' : '' }}{{ number_format($investmentRoi, 2) }}%
                            </span>
                        </td>
                        <td class="py-4">
                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium
                                @if($investment->status == 'active') bg-blue-100 text-blue-600
                                @elseif($investment->status == 'completed') bg-green-100 text-green-600
                                @elseif($investment->status == 'pending') bg-yellow-100 text-yellow-600
                                @else bg-red-100 text-red-600 @endif">
                                <i class="fas fa-circle text-[6px]"></i>
                                {{ ucfirst($investment->status) }}
                            </span>
                        </td>
                        <td class="py-4 text-gray-500 text-sm">
                            @if($investment->end_date)
                            {{ \Carbon\Carbon::parse($investment->end_date)->format('M d, Y') }}
                            @else
                            --
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="mt-6">
            {{ $investments->links() }}
        </div>
        @else
        <div class="text-center py-16">
            <div class="w-20 h-20 mx-auto rounded-full bg-gray-100 flex items-center justify-center mb-6">
                <i class="fas fa-chart-line text-gray-400 text-3xl"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">No Investments Yet</h3>
            <p class="text-gray-500 max-w-md mx-auto mb-6">
                You haven't made any investments yet. Start your investment journey today!
            </p>
            <a href="{{ route('dashboard.plans') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-amber-500 to-orange-600 text-white font-medium rounded-xl hover:from-amber-600 hover:to-orange-700 transition-all">
                <i class="fas fa-gem"></i>
                View Investment Plans
            </a>
        </div>
        @endif
    </div>
</div>

<!-- Investment Info -->
<div class="glass-card mt-6 p-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
        <i class="fas fa-info-circle text-amber-500"></i>
        Understanding Your Returns
    </h3>
    <div class="grid md:grid-cols-2 gap-6">
        <div class="p-4 rounded-xl bg-green-50 border border-green-100">
            <h4 class="font-semibold text-green-700 mb-2 flex items-center gap-2">
                <i class="fas fa-arrow-trend-up"></i>
                Profit (Gain)
            </h4>
            <p class="text-sm text-green-600">
                When your investment earns money, the profit is shown in green. This is added to your balance when the investment is completed.
            </p>
        </div>
        <div class="p-4 rounded-xl bg-red-50 border border-red-100">
            <h4 class="font-semibold text-red-700 mb-2 flex items-center gap-2">
                <i class="fas fa-arrow-trend-down"></i>
                Loss
            </h4>
            <p class="text-sm text-red-600">
                If an investment experiences a loss, it will be shown in red. Our expert traders work to minimize losses and maximize your returns.
            </p>
        </div>
    </div>
</div>
@endsection
