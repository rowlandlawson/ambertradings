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
            <div class="flex justify-between">
                <span class="text-gray-500">Total Profit</span>
                <span class="font-semibold text-green-600">${{ number_format($user->total_profit, 2) }}</span>
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

        <!-- Danger Zone -->
        <div class="glass-card p-6 border border-red-100">
            <h3 class="text-lg font-semibold mb-4 flex items-center gap-2 text-red-600">
                <i class="fas fa-exclamation-triangle"></i>
                Danger Zone
            </h3>
            <div class="flex items-center justify-between">
                <div>
                    <h4 class="font-medium text-gray-900">Delete User Account</h4>
                    <p class="text-sm text-gray-500">Permanently delete this user and all associated data.</p>
                </div>
                <form action="{{ route('admin.delete-user', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to PERMANENTLY delete this user? This action cannot be undone.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-50 text-red-600 font-medium rounded-lg hover:bg-red-100 transition-colors border border-red-200">
                        Delete User
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- User Investments -->
<div class="glass-card mt-6 overflow-hidden">
    <div class="p-6 border-b border-gray-200">
        <h3 class="text-lg font-semibold">User Investments</h3>
        <p class="text-sm text-gray-500 mt-1">Update profit/loss values to reflect in user's dashboard and wallet balance</p>
    </div>
    <div class="p-6">
        @if($investments->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-left text-xs text-gray-500 uppercase border-b border-gray-200 whitespace-nowrap">
                        <th class="pb-4 font-medium">Type</th>
                        <th class="pb-4 font-medium">Package</th>
                        <th class="pb-4 font-medium">Amount</th>
                        <th class="pb-4 font-medium">Profit</th>
                        <th class="pb-4 font-medium">Loss</th>
                        <th class="pb-4 font-medium">Net</th>
                        <th class="pb-4 font-medium">Status</th>
                        <th class="pb-4 font-medium">Update</th>
                        <th class="pb-4 font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($investments as $investment)
                    @php
                        $netProfit = ($investment->withdrawable_profit ?? 0) - ($investment->loss ?? 0);
                    @endphp
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors whitespace-nowrap" id="investment-{{ $investment->id }}">
                        <td class="py-4 font-medium text-gray-900">{{ $investment->type }}</td>
                        <td class="py-4 text-gray-500">{{ $investment->package->name ?? 'Custom' }}</td>
                        <td class="py-4 text-gray-900">${{ number_format($investment->amount, 2) }}</td>
                        <td class="py-4">
                            <span class="font-semibold text-green-600">+${{ number_format($investment->withdrawable_profit ?? 0, 2) }}</span>
                        </td>
                        <td class="py-4">
                            <span class="font-semibold text-red-600">-${{ number_format($investment->loss ?? 0, 2) }}</span>
                        </td>
                        <td class="py-4">
                            <span class="font-semibold {{ $netProfit >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                {{ $netProfit >= 0 ? '+' : '' }}${{ number_format($netProfit, 2) }}
                            </span>
                        </td>
                        <td class="py-4">
                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium
                                @if($investment->status == 'active') bg-blue-100 text-blue-600
                                @elseif($investment->status == 'completed') bg-green-100 text-green-600
                                @elseif($investment->status == 'pending') bg-yellow-100 text-yellow-600
                                @else bg-red-100 text-red-600 @endif">
                                {{ ucfirst($investment->status) }}
                            </span>
                        </td>
                        <td class="py-4">
                            <form action="{{ route('admin.update-investment', [$user->id, $investment->id]) }}" method="POST" class="flex items-center gap-2">
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
                                <div class="flex flex-col gap-1">
                                    <div class="flex items-center gap-1">
                                        <span class="text-xs text-green-600 font-medium">+$</span>
                                        <input type="number" name="withdrawable_profit" step="0.01" min="0" value="{{ $investment->withdrawable_profit ?? 0 }}"
                                            placeholder="Profit"
                                            class="w-20 px-2 py-1 text-sm rounded-lg bg-green-50 border border-green-200 text-gray-900 focus:border-green-500 outline-none">
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <span class="text-xs text-red-600 font-medium">-$</span>
                                        <input type="number" name="loss" step="0.01" min="0" value="{{ $investment->loss ?? 0 }}"
                                            placeholder="Loss"
                                            class="w-20 px-2 py-1 text-sm rounded-lg bg-red-50 border border-red-200 text-gray-900 focus:border-red-500 outline-none">
                                    </div>
                                </div>
                                <button type="submit" class="px-3 py-3 text-xs bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-lg hover:from-purple-600 hover:to-pink-600 transition-all">
                                    Update
                                </button>
                            </form>
                        </td>
                        <td class="py-4">
                            <form action="{{ route('admin.delete-investment', [$user->id, $investment->id]) }}" method="POST" 
                                onsubmit="return confirm('Are you sure you want to delete this investment?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="mt-4 p-4 rounded-xl bg-blue-50 border border-blue-100">
            <p class="text-sm text-blue-700">
                <i class="fas fa-info-circle mr-2"></i>
                <strong>How it works:</strong> Enter profit and loss values separately. If loss exceeds profit, the excess will be deducted from the investment principal. Users must click "Withdraw" in their dashboard to move profit to their wallet.
            </p>
        </div>
        @else
        <div class="text-center py-8">
            <div class="w-16 h-16 mx-auto rounded-full bg-gray-100 flex items-center justify-center mb-4">
                <i class="fas fa-chart-line text-gray-400 text-2xl"></i>
            </div>
            <p class="text-gray-500">No investments yet</p>
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
        @else
        <div class="text-center py-8">
            <p class="text-gray-400">No transactions yet</p>
        </div>
        @endif
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
</script>
@endsection
