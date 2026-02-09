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
            <div class="w-12 h-12 rounded-xl {{ $stats['total_profit'] >= 0 ? 'bg-green-100' : 'bg-red-100' }} flex items-center justify-center">
                <i class="fas {{ $stats['total_profit'] >= 0 ? 'fa-arrow-trend-up text-green-600' : 'fa-arrow-trend-down text-red-600' }} text-xl"></i>
            </div>
            <div>
                <p class="text-xs text-gray-500 uppercase">{{ $stats['total_profit'] >= 0 ? 'Total Profit' : 'Total Loss' }}</p>
                <p class="text-xl font-bold {{ $stats['total_profit'] >= 0 ? 'text-green-600' : 'text-red-600' }}">
                    {{ $stats['total_profit'] >= 0 ? '+' : '' }}${{ number_format($stats['total_profit'], 2) }}
                </p>
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
                    $roi = $user->total_invested > 0 ? ($stats['total_profit'] / $user->total_invested) * 100 : 0;
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

<div class="p-6 border-b border-gray-200">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-xl font-semibold text-gray-900">Investment Portfolio</h2>
            <p class="text-gray-500 text-sm mt-1">Track all your investments and their performance</p>
        </div>
        <a href="{{ route('dashboard.plans') }}" class="inline-flex justify-center items-center px-4 py-2 bg-gradient-to-r from-amber-500 to-orange-600 text-white font-medium rounded-xl hover:from-amber-600 hover:to-orange-700 transition-all text-sm whitespace-nowrap">
            <i class="fas fa-plus mr-2"></i>New Investment
        </a>
    </div>
</div>
    
    <!-- Investment List -->
    <div class="p-6">
        @if($investments->count() > 0)
        
        <!-- Mobile Card View -->
        <div class="investment-cards">
          @foreach($investments as $investment)
            <div class="investment-card">
              <div class="card-row">
                <span class="card-label">Investment</span>
                <span class="card-value">
                  {{ $investment->type }}
                  @if($investment->end_date)
                    <div style="font-size: 12px; color: #9ca3af;">Ends: {{ \Carbon\Carbon::parse($investment->end_date)->format('M d, Y') }}</div>
                  @endif
                </span>
              </div>
              
              <div class="card-row">
                <span class="card-label">Invested</span>
                <span class="card-value">${{ number_format($investment->amount, 2) }}</span>
              </div>
              
              <div class="card-row">
                <span class="card-label">Current Value</span>
                <span class="card-value">
                  ${{ number_format($investment->current_value, 2) }}
                  @if($investment->hasCapitalLoss())
                    <div style="font-size: 12px; color: #dc2626;">-${{ number_format($investment->capital_loss, 2) }} from principal</div>
                  @endif
                </span>
              </div>
              
              <div class="card-row">
                <span class="card-label">Profit</span>
                <span class="card-value" style="color: {{ $investment->withdrawable_profit > 0 ? '#10b981' : '#9ca3af' }};">
                  {{ $investment->withdrawable_profit > 0 ? '+' : '' }}${{ number_format($investment->withdrawable_profit, 2) }}
                </span>
              </div>
              
              <div class="card-row">
                <span class="card-label">Loss</span>
                <span class="card-value" style="color: {{ $investment->loss > 0 ? '#dc2626' : '#9ca3af' }};">
                  {{ $investment->loss > 0 ? '-' : '' }}${{ number_format($investment->loss, 2) }}
                </span>
              </div>
              
              <div class="card-row">
                <span class="card-label">Status</span>
                <span class="card-value">
                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium
                        @if($investment->status == 'active') bg-blue-100 text-blue-600
                        @elseif($investment->status == 'completed') bg-green-100 text-green-600
                        @elseif($investment->status == 'pending') bg-yellow-100 text-yellow-600
                        @elseif($investment->status == 'paused') bg-orange-100 text-orange-600
                        @else bg-red-100 text-red-600 @endif">
                        <i class="fas fa-circle text-[6px]"></i>
                        {{ ucfirst($investment->status) }}
                    </span>
                    @if($investment->status == 'paused')
                    <p class="text-xs text-orange-600 mt-1">⚠️ Top up to resume</p>
                    @endif
                </span>
              </div>
              
              <div class="card-row" style="border: none; margin-top: 12px;">
                <div style="display: flex; gap: 8px; width: 100%;">
                  @if($investment->status == 'active' || $investment->status == 'paused')
                    <button type="button" onclick="openTopUpModal({{ $investment->id }}, '{{ $investment->type }}')" 
                            class="px-4 py-2 {{ $investment->status == 'paused' ? 'bg-orange-100 text-orange-600 hover:bg-orange-200' : 'bg-blue-100 text-blue-600 hover:bg-blue-200' }} text-sm font-medium rounded-lg transition-colors flex-1">
                        <i class="fas fa-plus mr-1"></i>{{ $investment->status == 'paused' ? 'Top Up (Required)' : 'Top Up' }}
                    </button>
                  @endif
                  
                  @php
                    $mobileNetProfit = ($investment->withdrawable_profit ?? 0) - ($investment->loss ?? 0);
                  @endphp
                  @if($mobileNetProfit > 0)
                    <button type="button" onclick="openWithdrawModal({{ $investment->id }}, '{{ $investment->type }}', {{ $investment->withdrawable_profit ?? 0 }}, {{ $investment->loss ?? 0 }}, {{ $mobileNetProfit }})"
                            class="w-full px-4 py-2 bg-green-100 text-green-600 text-sm font-medium rounded-lg hover:bg-green-200 transition-colors flex-1">
                        <i class="fas fa-wallet mr-1"></i>Withdraw
                    </button>
                  @endif
                  
                  @if($investment->status == 'active')
                    <button type="button" onclick="openEndInvestmentModal({{ $investment->id }}, '{{ $investment->type }}', {{ $investment->current_value }}, {{ $investment->amount }}, {{ $investment->withdrawable_profit ?? 0 }}, {{ $investment->loss ?? 0 }})"
                            class="w-full px-4 py-2 bg-orange-100 text-orange-600 text-sm font-medium rounded-lg hover:bg-orange-200 transition-colors flex-1">
                        <i class="fas fa-stop-circle mr-1"></i>End
                    </button>
                  @endif
                </div>
              </div>
            </div>
          @endforeach
        </div>

        <div class="investment-table overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-left text-xs text-gray-500 uppercase border-b border-gray-200 whitespace-nowrap">
                        <th class="pb-4 font-medium">Investment</th>
                        <th class="pb-4 font-medium">Invested</th>
                        <th class="pb-4 font-medium">Current Value</th>
                        <th class="pb-4 font-medium">Profit</th>
                        <th class="pb-4 font-medium">Loss</th>
                        <th class="pb-4 font-medium">Status</th>
                        <th class="pb-4 font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($investments as $investment)
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors whitespace-nowrap">
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
                                    @if($investment->end_date)
                                    <p class="text-xs text-gray-500">Ends: {{ \Carbon\Carbon::parse($investment->end_date)->format('M d, Y') }}</p>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="py-4 font-semibold text-gray-900">${{ number_format($investment->amount, 2) }}</td>
                        <td class="py-4">
                            @php
                                $currentValue = $investment->current_value;
                                $hasCapitalLoss = $investment->hasCapitalLoss();
                            @endphp
                            <div>
                                <span class="{{ $hasCapitalLoss ? 'text-red-600' : 'text-gray-900' }} font-semibold">
                                    ${{ number_format($currentValue, 2) }}
                                </span>
                                @if($hasCapitalLoss)
                                <p class="text-xs text-red-500">
                                    <i class="fas fa-arrow-down"></i>
                                    -${{ number_format($investment->capital_loss, 2) }} from principal
                                </p>
                                @endif
                            </div>
                        </td>
                        <td class="py-4">
                            @if($investment->withdrawable_profit > 0)
                            <span class="text-green-600 font-semibold">+${{ number_format($investment->withdrawable_profit, 2) }}</span>
                            @else
                            <span class="text-gray-400">$0.00</span>
                            @endif
                        </td>
                        <td class="py-4">
                            @if($investment->loss > 0)
                            <span class="text-red-600 font-semibold">-${{ number_format($investment->loss, 2) }}</span>
                            @if($hasCapitalLoss)
                            <p class="text-xs text-red-500">Exceeds profit</p>
                            @endif
                            @else
                            <span class="text-gray-400">$0.00</span>
                            @endif
                        </td>
                        <td class="py-4">
                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium
                                @if($investment->status == 'active') bg-blue-100 text-blue-600
                                @elseif($investment->status == 'completed') bg-green-100 text-green-600
                                @elseif($investment->status == 'pending') bg-yellow-100 text-yellow-600
                                @elseif($investment->status == 'paused') bg-orange-100 text-orange-600
                                @else bg-red-100 text-red-600 @endif">
                                <i class="fas fa-circle text-[6px]"></i>
                                {{ ucfirst($investment->status) }}
                            </span>
                            @if($investment->status == 'paused')
                            <p class="text-xs text-orange-600 mt-1">Top up required</p>
                            @endif
                        </td>
                        <td class="py-4">
                            <div class="flex items-center gap-2">
                                @if($investment->status == 'active' || $investment->status == 'paused')
                                <!-- Top-up Button -->
                                <button type="button" onclick="openTopUpModal({{ $investment->id }}, '{{ $investment->type }}')" 
                                        class="px-4 py-2 {{ $investment->status == 'paused' ? 'bg-orange-100 text-orange-600 hover:bg-orange-200' : 'bg-blue-100 text-blue-600 hover:bg-blue-200' }} text-sm font-medium rounded-lg transition-colors">
                                    <i class="fas fa-plus mr-1"></i>{{ $investment->status == 'paused' ? 'Top Up!' : 'Top Up' }}
                                </button>
                                @endif
                                
                                @php
                                    $desktopNetProfit = ($investment->withdrawable_profit ?? 0) - ($investment->loss ?? 0);
                                @endphp
                                @if($desktopNetProfit > 0)
                                <!-- Withdraw Profit Button -->
                                <button type="button" onclick="openWithdrawModal({{ $investment->id }}, '{{ $investment->type }}', {{ $investment->withdrawable_profit ?? 0 }}, {{ $investment->loss ?? 0 }}, {{ $desktopNetProfit }})"
                                        class="px-4 py-2 bg-green-100 text-green-600 text-sm font-medium rounded-lg hover:bg-green-200 transition-colors">
                                    <i class="fas fa-wallet mr-1"></i>Withdraw
                                </button>
                                @endif
                                
                                @if($investment->status == 'active')
                                <!-- End Investment Button -->
                                <button type="button" onclick="openEndInvestmentModal({{ $investment->id }}, '{{ $investment->type }}', {{ $investment->current_value }}, {{ $investment->amount }}, {{ $investment->withdrawable_profit ?? 0 }}, {{ $investment->loss ?? 0 }})"
                                        class="px-4 py-2 bg-orange-100 text-orange-600 text-sm font-medium rounded-lg hover:bg-orange-200 transition-colors">
                                    <i class="fas fa-stop-circle mr-1"></i>End
                                </button>
                                @endif
                            </div>
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
    <div class="grid md:grid-cols-3 gap-6">
        <div class="p-4 rounded-xl bg-green-50 border border-green-100">
            <h4 class="font-semibold text-green-700 mb-2 flex items-center gap-2">
                <i class="fas fa-arrow-trend-up"></i>
                Profit
            </h4>
            <p class="text-sm text-green-600">
                Profits earned from your investment. Click "Withdraw" to move profits to your main wallet balance.
            </p>
        </div>
        <div class="p-4 rounded-xl bg-red-50 border border-red-100">
            <h4 class="font-semibold text-red-700 mb-2 flex items-center gap-2">
                <i class="fas fa-arrow-trend-down"></i>
                Loss
            </h4>
            <p class="text-sm text-red-600">
                Any losses experienced. Our expert traders work to minimize losses and maximize your returns.
            </p>
        </div>
        <div class="p-4 rounded-xl bg-blue-50 border border-blue-100">
            <h4 class="font-semibold text-blue-700 mb-2 flex items-center gap-2">
                <i class="fas fa-plus-circle"></i>
                Top Up
            </h4>
            <p class="text-sm text-blue-600">
                Add more funds to an active investment to increase your potential returns.
            </p>
        </div>
    </div>
</div>

<!-- Top-Up Modal -->
<div id="topUpModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" onclick="closeTopUpModal()"></div>
        <div class="relative inline-block w-full max-w-md p-6 my-8 text-left align-middle bg-white rounded-2xl shadow-xl transform transition-all">
            <h3 class="text-xl font-bold text-gray-900 mb-4">
                <i class="fas fa-plus-circle text-blue-500 mr-2"></i>
                Top Up Investment
            </h3>
            <p class="text-gray-600 mb-4" id="topUpInvestmentName"></p>
            
            <form id="topUpForm" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Amount to Add</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">$</span>
                        <input type="number" name="amount" id="topUpAmount" step="0.01" min="1" required
                               class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-amber-500"
                               placeholder="Enter amount">
                    </div>
                    <p class="text-xs text-gray-500 mt-2">Current Balance: ${{ number_format($user->balance, 2) }}</p>
                </div>
                
                <div class="flex gap-3">
                    <button type="button" onclick="closeTopUpModal()" 
                            class="flex-1 px-4 py-3 border border-gray-300 text-gray-700 font-medium rounded-xl hover:bg-gray-50 transition-colors">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="flex-1 px-4 py-3 bg-gradient-to-r from-amber-500 to-orange-600 text-white font-medium rounded-xl hover:from-amber-600 hover:to-orange-700 transition-all">
                        <i class="fas fa-plus mr-2"></i>Top Up
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Withdraw Profit Modal -->
<div id="withdrawModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity backdrop-blur-sm" onclick="closeWithdrawModal()"></div>
        <div class="relative inline-block w-full max-w-md p-6 my-8 text-left align-middle bg-white rounded-2xl shadow-xl transform transition-all">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">
                    <i class="fas fa-wallet text-green-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-900">Withdraw Profit</h3>
                    <p class="text-sm text-gray-500" id="withdrawInvestmentName"></p>
                </div>
            </div>
            
            <!-- Profit Summary -->
            <div class="bg-gray-50 rounded-xl p-4 mb-6">
                <div class="grid grid-cols-3 gap-4 text-center">
                    <div>
                        <p class="text-xs text-gray-500 uppercase">Total Profit</p>
                        <p class="text-lg font-bold text-green-600" id="withdrawTotalProfit">+$0.00</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase">Total Loss</p>
                        <p class="text-lg font-bold text-red-600" id="withdrawTotalLoss">-$0.00</p>
                    </div>
                    <div class="border-l-2 border-gray-200">
                        <p class="text-xs text-gray-500 uppercase">Net Profit</p>
                        <p class="text-lg font-bold text-emerald-600" id="withdrawNetProfit">$0.00</p>
                    </div>
                </div>
            </div>
            
            <form id="withdrawForm" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Amount to Withdraw</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-semibold">$</span>
                        <input type="number" name="amount" id="withdrawAmount" step="0.01" min="0.01" required
                               class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 text-lg font-semibold"
                               placeholder="0.00">
                    </div>
                    <div class="flex justify-between mt-2">
                        <p class="text-xs text-gray-500">Max: <span id="maxWithdrawAmount" class="font-semibold text-green-600">$0.00</span></p>
                        <button type="button" onclick="setMaxWithdraw()" class="text-xs text-green-600 hover:text-green-700 font-semibold">
                            Withdraw Max
                        </button>
                    </div>
                </div>
                
                <div class="p-3 rounded-lg bg-amber-50 border border-amber-200 mb-4">
                    <p class="text-xs text-amber-700">
                        <i class="fas fa-info-circle mr-1"></i>
                        You can only withdraw up to your net profit (profit minus loss). The withdrawn amount will be added to your wallet balance.
                    </p>
                </div>
                
                <div class="flex gap-3">
                    <button type="button" onclick="closeWithdrawModal()" 
                            class="flex-1 px-4 py-3 border border-gray-300 text-gray-700 font-medium rounded-xl hover:bg-gray-50 transition-colors">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="flex-1 px-4 py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white font-medium rounded-xl hover:from-green-600 hover:to-emerald-700 transition-all">
                        <i class="fas fa-check mr-2"></i>Confirm Withdrawal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- End Investment Confirmation Modal -->
<div id="endInvestmentModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity backdrop-blur-sm" onclick="closeEndInvestmentModal()"></div>
        <div class="relative inline-block w-full max-w-md p-6 my-8 text-left align-middle bg-white rounded-2xl shadow-xl transform transition-all">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-12 h-12 rounded-full bg-orange-100 flex items-center justify-center">
                    <i class="fas fa-stop-circle text-orange-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-900">End Investment</h3>
                    <p class="text-sm text-gray-500" id="endInvestmentName"></p>
                </div>
            </div>
            
            <!-- Warning Message -->
            <div class="bg-orange-50 rounded-xl p-4 mb-6 border border-orange-200">
                <div class="flex items-start gap-3">
                    <i class="fas fa-exclamation-triangle text-orange-500 mt-0.5"></i>
                    <div>
                        <p class="font-semibold text-orange-800">Are you sure?</p>
                        <p class="text-sm text-orange-700 mt-1">
                            This action will close your investment and transfer all funds to your wallet. This cannot be undone.
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Investment Summary -->
            <div class="bg-gray-50 rounded-xl p-4 mb-6">
                <h4 class="text-sm font-semibold text-gray-700 mb-3 uppercase tracking-wider">Investment Summary</h4>
                <div class="space-y-2">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Principal Invested</span>
                        <span class="font-semibold text-gray-900" id="endInvestmentPrincipal">$0.00</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Total Profit</span>
                        <span class="font-semibold text-green-600" id="endInvestmentProfit">+$0.00</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Total Loss</span>
                        <span class="font-semibold text-red-600" id="endInvestmentLoss">-$0.00</span>
                    </div>
                    <div class="border-t border-gray-200 pt-2 mt-2">
                        <div class="flex justify-between">
                            <span class="font-semibold text-gray-700">Amount to Wallet</span>
                            <span class="text-lg font-bold text-emerald-600" id="endInvestmentTotal">$0.00</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <form id="endInvestmentForm" method="POST">
                @csrf
                <div class="flex gap-3">
                    <button type="button" onclick="closeEndInvestmentModal()" 
                            class="flex-1 px-4 py-3 border border-gray-300 text-gray-700 font-medium rounded-xl hover:bg-gray-50 transition-colors">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="flex-1 px-4 py-3 bg-gradient-to-r from-orange-500 to-red-500 text-white font-medium rounded-xl hover:from-orange-600 hover:to-red-600 transition-all">
                        <i class="fas fa-stop-circle mr-2"></i>End Investment
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
function openTopUpModal(investmentId, investmentType) {
    document.getElementById('topUpModal').classList.remove('hidden');
    document.getElementById('topUpInvestmentName').textContent = 'Add funds to: ' + investmentType;
    document.getElementById('topUpForm').action = '/dashboard/investments/' + investmentId + '/top-up';
}

function closeTopUpModal() {
    document.getElementById('topUpModal').classList.add('hidden');
    document.getElementById('topUpAmount').value = '';
}

</script>
<script>
// Withdraw Modal
let currentMaxWithdraw = 0;

function openWithdrawModal(investmentId, investmentType, totalProfit, totalLoss, netProfit) {
    document.getElementById('withdrawModal').classList.remove('hidden');
    document.getElementById('withdrawInvestmentName').textContent = investmentType + ' Investment';
    document.getElementById('withdrawTotalProfit').textContent = '+$' + parseFloat(totalProfit).toFixed(2);
    document.getElementById('withdrawTotalLoss').textContent = '-$' + parseFloat(totalLoss).toFixed(2);
    document.getElementById('withdrawNetProfit').textContent = '$' + parseFloat(netProfit).toFixed(2);
    document.getElementById('maxWithdrawAmount').textContent = '$' + parseFloat(netProfit).toFixed(2);
    document.getElementById('withdrawForm').action = '/dashboard/investments/' + investmentId + '/withdraw-profit';
    document.getElementById('withdrawAmount').value = '';
    document.getElementById('withdrawAmount').max = netProfit;
    currentMaxWithdraw = netProfit;
    document.body.style.overflow = 'hidden';
}

function closeWithdrawModal() {
    document.getElementById('withdrawModal').classList.add('hidden');
    document.getElementById('withdrawAmount').value = '';
    document.body.style.overflow = '';
}

function setMaxWithdraw() {
    document.getElementById('withdrawAmount').value = currentMaxWithdraw.toFixed(2);
}

// Validate withdrawal amount
document.getElementById('withdrawAmount').addEventListener('input', function() {
    if (parseFloat(this.value) > currentMaxWithdraw) {
        this.value = currentMaxWithdraw.toFixed(2);
    }
});

// Close modals on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeTopUpModal();
        closeWithdrawModal();
        closeEndInvestmentModal();
    }
});

// End Investment Modal
function openEndInvestmentModal(investmentId, investmentType, currentValue, principal, profit, loss) {
    document.getElementById('endInvestmentModal').classList.remove('hidden');
    document.getElementById('endInvestmentName').textContent = investmentType + ' Investment';
    document.getElementById('endInvestmentPrincipal').textContent = '$' + parseFloat(principal).toFixed(2);
    document.getElementById('endInvestmentProfit').textContent = '+$' + parseFloat(profit).toFixed(2);
    document.getElementById('endInvestmentLoss').textContent = '-$' + parseFloat(loss).toFixed(2);
    document.getElementById('endInvestmentTotal').textContent = '$' + parseFloat(currentValue).toFixed(2);
    document.getElementById('endInvestmentForm').action = '/dashboard/investments/' + investmentId + '/end';
    document.body.style.overflow = 'hidden';
}

function closeEndInvestmentModal() {
    document.getElementById('endInvestmentModal').classList.add('hidden');
    document.body.style.overflow = '';
}
</script>
@endsection

@section('styles')
<style>
  @media (max-width: 768px) {
    .investment-table {
      display: none;
    }
    
    .investment-cards {
      display: block;
    }
    
    .investment-card {
      background: white;
      border: 1px solid #e5e7eb;
      border-radius: 8px;
      padding: 16px;
      margin-bottom: 16px;
      box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    
    .card-row {
      display: flex;
      justify-content: space-between;
      margin-bottom: 12px;
      padding-bottom: 12px;
      border-bottom: 1px solid #f3f4f6;
    }
    
    .card-row:last-child {
      border-bottom: none;
      margin-bottom: 0;
      padding-bottom: 0;
    }
    
    .card-label {
      font-weight: 600;
      color: #6b7280;
      font-size: 13px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    
    .card-value {
      font-weight: 600;
      color: #1f2937;
      text-align: right;
    }
  }
  
  @media (min-width: 769px) {
    .investment-cards {
      display: none;
    }
    
    .investment-table {
      display: block;
    }
  }
</style>
@endsection
