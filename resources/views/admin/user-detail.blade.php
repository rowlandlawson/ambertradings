@extends('layouts.admin')

@section('title', 'User Details - ' . $user->name)
@section('page-title', 'User Details')

@section('content')
<!-- Breadcrumb -->
<div class="mb-6">
    <a href="{{ route('admin.users') }}" class="text-gray-500 hover:text-gray-700 transition-colors">
        <i class="fas fa-arrow-left mr-2"></i> Back to Users
    </a>
</div>

<div class="grid lg:grid-cols-3 gap-6">
    <!-- User Info Card -->
    <div class="glass-card p-6">
        <div class="text-center mb-6">
            <div class="w-20 h-20 mx-auto rounded-full bg-gradient-to-br from-purple-500 to-pink-600 flex items-center justify-center text-2xl font-bold mb-4">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <h2 class="text-xl font-semibold text-gray-900">{{ $user->name }}</h2>
            <p class="text-gray-400 text-sm">{{ $user->email }}</p>
        </div>
        
        <div class="space-y-4 border-t border-gray-200 pt-6">
            <div class="flex justify-between">
                <span class="text-gray-500">Balance</span>
                <span class="font-semibold text-amber-600">${{ number_format($user->balance, 2) }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500">Total Invested</span>
                <span class="font-semibold text-gray-900">${{ number_format($user->total_invested, 2) }}</span>
            </div>
            @php
                // Only count active/paused investments for profit/loss (exclude completed ones)
                $activeInvestments = $investments->whereIn('status', ['active', 'paused', 'pending']);
                $investmentProfit = $activeInvestments->sum('withdrawable_profit');
                $investmentLoss = $activeInvestments->sum('loss');
                $netProfit = $investmentProfit - $investmentLoss;
            @endphp
            <div class="flex justify-between">
                <span class="text-gray-500">Total Profit</span>
                <span class="font-semibold text-green-600">+${{ number_format($investmentProfit, 2) }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500">Total Loss</span>
                <span class="font-semibold text-red-600">-${{ number_format($investmentLoss, 2) }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500">Net Profit/Loss</span>
                <span class="font-semibold {{ $netProfit >= 0 ? 'text-green-600' : 'text-red-600' }}">
                    {{ $netProfit >= 0 ? '+' : '' }}${{ number_format($netProfit, 2) }}
                </span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500">Phone</span>
                <span class="text-gray-900">{{ $user->phone ?? 'Not set' }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500">Country</span>
                <span class="text-gray-900">{{ $user->country ?? 'Not set' }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500">Status</span>
                <span class="{{ $user->is_active ? 'text-green-600' : 'text-red-600' }}">
                    {{ $user->is_active ? 'Active' : 'Inactive' }}
                </span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500">Joined</span>
                <span class="text-gray-900">{{ $user->created_at->format('M d, Y') }}</span>
            </div>
        </div>
    </div>
    
    <!-- Actions Column -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Update Balance -->
        <div class="glass-card p-6">
            <h3 class="text-lg font-semibold mb-4 flex items-center gap-2">
                <i class="fas fa-wallet text-amber-500"></i>
                Update Balance
            </h3>
            <p class="text-gray-500 text-sm mb-4">Add or subtract from user's balance. The user will receive an email notification.</p>
            
            <form action="{{ route('admin.update-balance', $user->id) }}" method="POST">
                @csrf
                <div class="grid md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Amount ($)</label>
                        <input type="number" name="amount" step="0.01" min="0" required
                            class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-900 focus:border-purple-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Type</label>
                        <select name="type" required
                            class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-900 focus:border-purple-500 outline-none">
                            <option value="add">Add (Credit)</option>
                            <option value="subtract">Subtract (Debit)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <input type="text" name="description" placeholder="Reason for adjustment"
                            class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-900 placeholder-gray-400 focus:border-purple-500 outline-none">
                    </div>
                </div>
                <button type="submit" class="mt-4 px-6 py-3 bg-gradient-to-r from-amber-500 to-orange-600 text-white font-medium rounded-xl hover:from-amber-600 hover:to-orange-700 transition-all">
                    <i class="fas fa-save mr-2"></i> Update Balance & Notify User
                </button>
            </form>
        </div>
        
        <!-- Add Investment -->

        <!-- Add Investment -->
        <div class="glass-card p-6">
            <h3 class="text-lg font-semibold mb-4 flex items-center gap-2">
                <i class="fas fa-plus-circle text-green-500"></i>
                Add Investment
            </h3>
            <p class="text-gray-500 text-sm mb-4">Add a new investment to this user's portfolio. They will receive an email notification.</p>
            
            <form action="{{ route('admin.add-investment', $user->id) }}" method="POST">
                @csrf
                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Package (Optional)</label>
                        <select name="investment_package_id"
                            class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-900 focus:border-purple-500 outline-none">
                            <option value="">Custom Investment</option>
                            @foreach($packages as $package)
                            <option value="{{ $package->id }}">{{ $package->name }} ({{ $package->roi_percentage }}% ROI)</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Type</label>
                        <input type="text" name="type" required placeholder="e.g., Crypto, Forex, Stocks"
                            class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-900 placeholder-gray-400 focus:border-purple-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Amount ($)</label>
                        <input type="number" name="amount" step="0.01" min="0" required
                            class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-900 focus:border-purple-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Profit ($)</label>
                        <input type="number" name="profit" step="0.01" min="0" value="0"
                            class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-900 focus:border-purple-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">ROI %</label>
                        <input type="number" name="roi_percentage" step="0.01" min="0" value="0"
                            class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-900 focus:border-purple-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select name="status" required
                            class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-900 focus:border-purple-500 outline-none">
                            <option value="pending">Pending</option>
                            <option value="active" selected>Active</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Start Date</label>
                        <input type="date" name="start_date"
                            class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-900 focus:border-purple-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">End Date</label>
                        <input type="date" name="end_date"
                            class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-900 focus:border-purple-500 outline-none">
                    </div>
                </div>
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Notes</label>
                    <textarea name="notes" rows="2" placeholder="Optional notes about this investment"
                        class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-900 placeholder-gray-400 focus:border-purple-500 outline-none resize-none"></textarea>
                </div>
                <button type="submit" class="mt-4 px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white font-medium rounded-xl hover:from-green-600 hover:to-emerald-700 transition-all">
                    <i class="fas fa-plus mr-2"></i> Add Investment & Notify User
                </button>
        </form>
        </div>
    </div>
</div>

<!-- User Investments -->
<div class="glass-card mt-6 overflow-hidden">
    <div class="p-6 border-b border-gray-200">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h3 class="text-lg font-semibold flex items-center gap-2">
                    <i class="fas fa-chart-line text-purple-500"></i>
                    User Investments
                </h3>
                <p class="text-sm text-gray-500 mt-1">Add profit/loss values to update user's portfolio. Values are cumulative.</p>
            </div>
            @if($investments->count() > 0)
            @php
                $totalInvested = $investments->sum('amount');
                $totalProfit = $investments->sum('withdrawable_profit');
                $totalLoss = $investments->sum('loss');
                $netPosition = $totalProfit - $totalLoss;
            @endphp
            <!-- Summary Stats -->
            <div class="flex flex-wrap gap-3">
                <div class="px-4 py-2 rounded-xl bg-blue-50 border border-blue-200">
                    <p class="text-xs text-blue-600 font-medium">Total Invested</p>
                    <p class="text-lg font-bold text-blue-700">${{ number_format($totalInvested, 2) }}</p>
                </div>
                <div class="px-4 py-2 rounded-xl bg-green-50 border border-green-200">
                    <p class="text-xs text-green-600 font-medium">Total Profit</p>
                    <p class="text-lg font-bold text-green-700">+${{ number_format($totalProfit, 2) }}</p>
                </div>
                <div class="px-4 py-2 rounded-xl bg-red-50 border border-red-200">
                    <p class="text-xs text-red-600 font-medium">Total Loss</p>
                    <p class="text-lg font-bold text-red-700">-${{ number_format($totalLoss, 2) }}</p>
                </div>
                <div class="px-4 py-2 rounded-xl {{ $netPosition >= 0 ? 'bg-emerald-50 border-emerald-200' : 'bg-rose-50 border-rose-200' }} border">
                    <p class="text-xs {{ $netPosition >= 0 ? 'text-emerald-600' : 'text-rose-600' }} font-medium">Net Position</p>
                    <p class="text-lg font-bold {{ $netPosition >= 0 ? 'text-emerald-700' : 'text-rose-700' }}">
                        {{ $netPosition >= 0 ? '+' : '' }}${{ number_format($netPosition, 2) }}
                    </p>
                </div>
            </div>
            @endif
        </div>
    </div>
    
    <div class="p-6">
        @if($investments->count() > 0)
        <!-- Investment Cards Grid -->
        <div class="grid gap-4">
            @foreach($investments as $investment)
            @php
                $netProfit = ($investment->withdrawable_profit ?? 0) - ($investment->loss ?? 0);
                $isProfit = $netProfit >= 0;
                $currentValue = $investment->current_value;
            @endphp
            <div class="relative overflow-hidden rounded-2xl border {{ $isProfit ? 'border-green-200 bg-gradient-to-r from-green-50/50 to-white' : 'border-red-200 bg-gradient-to-r from-red-50/50 to-white' }} p-5 transition-all hover:shadow-lg" id="investment-{{ $investment->id }}">
                <!-- Paused Warning Banner -->
                @if($investment->status == 'paused')
                <div class="absolute top-0 left-0 right-0 bg-orange-500 text-white text-xs font-semibold py-1.5 px-4 text-center">
                    <i class="fas fa-pause-circle mr-1"></i> TRADING PAUSED - User must top up to resume
                </div>
                @endif
                
                <!-- Status Badge -->
                <div class="absolute {{ $investment->status == 'paused' ? 'top-10' : 'top-4' }} right-4">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold
                        @if($investment->status == 'active') bg-blue-100 text-blue-700
                        @elseif($investment->status == 'completed') bg-green-100 text-green-700
                        @elseif($investment->status == 'pending') bg-yellow-100 text-yellow-700
                        @elseif($investment->status == 'paused') bg-orange-100 text-orange-700
                        @else bg-red-100 text-red-700 @endif">
                        <span class="w-2 h-2 rounded-full 
                            @if($investment->status == 'active') bg-blue-500 animate-pulse
                            @elseif($investment->status == 'completed') bg-green-500
                            @elseif($investment->status == 'pending') bg-yellow-500
                            @elseif($investment->status == 'paused') bg-orange-500
                            @else bg-red-500 @endif"></span>
                        {{ ucfirst($investment->status) }}
                    </span>
                </div>
                
                <div class="flex flex-col lg:flex-row lg:items-center gap-6">
                    <!-- Investment Info -->
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-12 h-12 rounded-xl {{ $isProfit ? 'bg-gradient-to-br from-green-500 to-emerald-600' : 'bg-gradient-to-br from-red-500 to-rose-600' }} flex items-center justify-center shadow-lg">
                                <i class="fas {{ $isProfit ? 'fa-arrow-trend-up' : 'fa-arrow-trend-down' }} text-white text-lg"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 text-lg">{{ $investment->type }}</h4>
                                <p class="text-sm text-gray-500">{{ $investment->package->name ?? 'Custom Package' }}</p>
                            </div>
                        </div>
                        
                        <!-- Stats Grid -->
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div>
                                <p class="text-xs text-gray-500 font-medium uppercase tracking-wide">Invested</p>
                                <p class="text-lg font-bold text-gray-900">${{ number_format($investment->amount, 2) }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-medium uppercase tracking-wide">Current Value</p>
                                <p class="text-lg font-bold {{ $currentValue >= $investment->amount ? 'text-gray-900' : 'text-red-600' }}">${{ number_format($currentValue, 2) }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-green-600 font-medium uppercase tracking-wide">Total Profit</p>
                                <p class="text-lg font-bold text-green-600">+${{ number_format($investment->withdrawable_profit ?? 0, 2) }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-red-600 font-medium uppercase tracking-wide">Total Loss</p>
                                <p class="text-lg font-bold text-red-600">-${{ number_format($investment->loss ?? 0, 2) }}</p>
                            </div>
                        </div>
                        
                        <!-- Net Position Badge -->
                        <div class="mt-4">
                            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full {{ $isProfit ? 'bg-green-100' : 'bg-red-100' }}">
                                <i class="fas {{ $isProfit ? 'fa-check-circle text-green-600' : 'fa-exclamation-circle text-red-600' }}"></i>
                                <span class="font-bold {{ $isProfit ? 'text-green-700' : 'text-red-700' }}">
                                    Net: {{ $netProfit >= 0 ? '+' : '' }}${{ number_format($netProfit, 2) }}
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Update Form or Trade Ended -->
                    <div class="lg:w-80 lg:border-l lg:border-gray-200 lg:pl-6">
                        @if($investment->status == 'completed')
                        <!-- Trade Ended Display -->
                        <div class="text-center py-6">
                            <div class="w-16 h-16 mx-auto rounded-full bg-gray-100 flex items-center justify-center mb-4">
                                <i class="fas fa-flag-checkered text-gray-400 text-2xl"></i>
                            </div>
                            <h4 class="font-bold text-gray-700 text-lg mb-2">Trade Ended</h4>
                            <p class="text-sm text-gray-500 mb-4">
                                This investment has been closed by the user. Funds have been transferred to their wallet.
                            </p>
                            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-gray-100 text-gray-600 text-sm font-medium">
                                <i class="fas fa-lock"></i>
                                No further updates allowed
                            </div>
                        </div>
                        @else
                        <!-- Active Investment Update Form -->
                        <form action="{{ route('admin.update-investment', [$user->id, $investment->id]) }}" method="POST" class="space-y-4" id="update-form-{{ $investment->id }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="investment_package_id" value="{{ $investment->investment_package_id }}">
                            <input type="hidden" name="type" value="{{ $investment->type }}">
                            <input type="hidden" name="amount" value="{{ $investment->amount }}">
                            <input type="hidden" name="roi_percentage" value="{{ $investment->roi_percentage }}">
                            <input type="hidden" name="status" value="{{ $investment->status }}">
                            <input type="hidden" name="start_date" value="{{ $investment->start_date }}">
                            <input type="hidden" name="end_date" value="{{ $investment->end_date }}">
                            <input type="hidden" name="notes" value="{{ $investment->notes }}">
                            
                            <p class="text-xs font-semibold text-gray-600 uppercase tracking-wider mb-2">
                                <i class="fas fa-plus-circle mr-1"></i> Add Profit/Loss
                            </p>
                            
                            <div class="flex gap-3">
                                <!-- Add Profit -->
                                <div class="flex-1">
                                    <label class="block text-xs text-green-600 font-semibold mb-1">Add Profit</label>
                                    <div class="relative">
                                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-green-500 font-bold text-sm">+$</span>
                                        <input type="number" name="add_profit" step="0.01" min="0" value="0"
                                            class="w-full pl-9 pr-3 py-2.5 text-sm rounded-xl bg-green-50 border-2 border-green-200 text-gray-900 font-semibold focus:border-green-500 focus:ring-2 focus:ring-green-200 outline-none transition-all">
                                    </div>
                                </div>
                                <!-- Add Loss -->
                                <div class="flex-1">
                                    <label class="block text-xs text-red-600 font-semibold mb-1">Add Loss</label>
                                    <div class="relative">
                                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-red-500 font-bold text-sm">-$</span>
                                        <input type="number" name="add_loss" step="0.01" min="0" value="0"
                                            class="w-full pl-9 pr-3 py-2.5 text-sm rounded-xl bg-red-50 border-2 border-red-200 text-gray-900 font-semibold focus:border-red-500 focus:ring-2 focus:ring-red-200 outline-none transition-all">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex gap-2">
                                <button type="submit" class="flex-1 px-4 py-2.5 text-sm font-semibold bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-xl hover:from-purple-600 hover:to-pink-600 transition-all shadow-lg hover:shadow-xl">
                                    <i class="fas fa-sync-alt mr-1"></i> Update
                                </button>
                            </div>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="mt-6 p-4 rounded-xl bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200">
            <div class="flex items-start gap-3">
                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-lightbulb text-blue-600"></i>
                </div>
                <div>
                    <p class="font-semibold text-blue-800 mb-1">How Cumulative Updates Work</p>
                    <p class="text-sm text-blue-700">
                        Enter the <strong>amount to add</strong> to existing profit/loss totals. For example, if a user already has $100 profit and you enter $50 in "Add Profit", their total profit becomes $150. Input fields reset to zero after each update. Users must click "Withdraw" in their dashboard to move profit to their wallet.
                    </p>
                </div>
            </div>
        </div>
        @else
        <div class="text-center py-12">
            <div class="w-20 h-20 mx-auto rounded-full bg-gray-100 flex items-center justify-center mb-4">
                <i class="fas fa-chart-line text-gray-400 text-3xl"></i>
            </div>
            <h4 class="text-lg font-semibold text-gray-700 mb-2">No Investments Yet</h4>
            <p class="text-gray-500">This user hasn't made any investments yet.</p>
        </div>
        @endif
    </div>
</div>

<!-- Recent Transactions -->
<div class="glass-card mt-6 overflow-hidden">
    <div class="p-6 border-b border-gray-200">
        <h3 class="text-lg font-semibold">Recent Transactions</h3>
    </div>
    <div class="p-6">
        @if($transactions->count() > 0)
        <div class="space-y-3">
            @foreach($transactions as $transaction)
            <div class="flex items-center gap-4 p-3 rounded-xl bg-gray-50">
                <div class="w-10 h-10 rounded-full flex items-center justify-center
                    @if($transaction->type == 'deposit' || $transaction->type == 'profit') bg-green-100 text-green-600
                    @elseif($transaction->type == 'withdrawal' || $transaction->type == 'loss') bg-red-100 text-red-600
                    @else bg-blue-100 text-blue-600 @endif">
                    <i class="{{ $transaction->type_icon }}"></i>
                </div>
                <div class="flex-1">
                    <p class="font-medium text-gray-900 capitalize">{{ $transaction->type }}</p>
                    <p class="text-xs text-gray-500">{{ $transaction->description ?? 'No description' }}</p>
                </div>
                <div class="text-right">
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
                    <p class="text-xs text-gray-500">{{ $transaction->created_at->diffForHumans() }}</p>
                </div>
            </div>
            @endforeach
        </div>
        
        <!-- Pagination -->
        <div class="mt-4">
            {{ $transactions->links() }}
        </div>
        @else
        <div class="text-center py-8">
            <p class="text-gray-400">No transactions yet</p>
        </div>
        @endif
    </div>
</div>

<!-- Danger Zone - Delete User -->
<div class="glass-card mt-6 overflow-hidden border-2 border-red-200 bg-gradient-to-r from-red-50/50 to-white">
    <div class="p-6 border-b border-red-200">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center">
                <i class="fas fa-exclamation-triangle text-red-600"></i>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-red-700">Danger Zone</h3>
                <p class="text-sm text-red-600">Irreversible actions. Proceed with caution.</p>
            </div>
        </div>
    </div>
    <div class="p-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h4 class="font-semibold text-gray-900">Delete this user</h4>
                <p class="text-sm text-gray-600">Once deleted, all user data including investments and transactions will be permanently removed. This action cannot be undone.</p>
            </div>
            <button type="button" onclick="openDeleteUserModal()" class="px-6 py-3 bg-red-600 text-white font-semibold rounded-xl hover:bg-red-700 transition-colors whitespace-nowrap">
                <i class="fas fa-trash mr-2"></i>Delete User
            </button>
        </div>
    </div>
</div>

<!-- Delete User Confirmation Modal -->
<div id="deleteUserModal" class="fixed inset-0 z-50 hidden">
    <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" onclick="closeDeleteUserModal()"></div>
    <div class="fixed inset-0 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md relative z-10">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center">
                        <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">Delete User Account</h3>
                        <p class="text-sm text-gray-500">This action is permanent and cannot be undone</p>
                    </div>
                </div>
            </div>
            
            <form action="{{ route('admin.delete-user', $user->id) }}" method="POST" id="deleteUserForm">
                @csrf
                @method('DELETE')
                <div class="p-6 space-y-4">
                    <div class="p-4 rounded-xl bg-red-50 border border-red-200">
                        <p class="text-sm text-red-700">
                            <strong>Warning:</strong> You are about to permanently delete the account for <strong>{{ $user->name }}</strong>. All associated data including:
                        </p>
                        <ul class="mt-2 text-sm text-red-600 list-disc list-inside">
                            <li>{{ $investments->count() }} investment(s)</li>
                            <li>{{ $transactions->count() }} transaction(s)</li>
                            <li>Balance: ${{ number_format($user->balance, 2) }}</li>
                        </ul>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            To confirm, type the user's full name: <span class="text-red-600 font-bold">{{ $user->name }}</span>
                        </label>
                        <input type="text" id="confirmUserName" 
                            placeholder="Type user's full name here"
                            class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-red-500 focus:ring-2 focus:ring-red-200 outline-none transition-all"
                            autocomplete="off">
                    </div>
                </div>
                
                <div class="p-6 bg-gray-50 rounded-b-2xl flex gap-3">
                    <button type="button" onclick="closeDeleteUserModal()" 
                        class="flex-1 px-4 py-3 bg-gray-200 text-gray-700 font-semibold rounded-xl hover:bg-gray-300 transition-colors">
                        Cancel
                    </button>
                    <button type="submit" id="confirmDeleteBtn" disabled
                        class="flex-1 px-4 py-3 bg-red-600 text-white font-semibold rounded-xl hover:bg-red-700 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                        <i class="fas fa-trash mr-2"></i>Delete Forever
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
function editInvestment(id) {
    // For simplicity, we'll scroll to the add investment form
    // In a real app, you might open a modal with pre-filled data
    alert('To edit this investment, please use the investment form above with updated values, or delete and recreate.');
}

// Delete User Modal Functions
const expectedName = "{{ $user->name }}";

function openDeleteUserModal() {
    document.getElementById('deleteUserModal').classList.remove('hidden');
    document.getElementById('confirmUserName').value = '';
    document.getElementById('confirmDeleteBtn').disabled = true;
    document.body.style.overflow = 'hidden';
}

function closeDeleteUserModal() {
    document.getElementById('deleteUserModal').classList.add('hidden');
    document.body.style.overflow = '';
}

// Enable delete button only when name matches
document.getElementById('confirmUserName').addEventListener('input', function() {
    const inputName = this.value.trim();
    const deleteBtn = document.getElementById('confirmDeleteBtn');
    
    if (inputName === expectedName) {
        deleteBtn.disabled = false;
        deleteBtn.classList.remove('disabled:opacity-50', 'disabled:cursor-not-allowed');
    } else {
        deleteBtn.disabled = true;
        deleteBtn.classList.add('disabled:opacity-50', 'disabled:cursor-not-allowed');
    }
});

// Close modal on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeDeleteUserModal();
    }
});
</script>
@endsection
