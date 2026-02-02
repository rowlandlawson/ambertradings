@extends('layouts.dashboard')

@section('title', 'Transactions')
@section('page-title', 'Transaction History')

@section('content')
<div class="glass-card overflow-hidden">
    <!-- Header -->
    <div class="p-6 border-b border-gray-200">
        <div>
            <h2 class="text-xl font-semibold">Transaction History</h2>
            <p class="text-gray-500 text-sm mt-1">View all your deposits, withdrawals, and other transactions</p>
        </div>
    </div>
    
    <!-- Transaction List -->
    <div class="p-6">
        @if($transactions->count() > 0)
        <div class="space-y-3">
            @foreach($transactions as $transaction)
            <div class="flex items-center gap-4 p-4 rounded-xl bg-gray-50 hover:bg-gray-100 transition-colors">
                <div class="w-12 h-12 rounded-full flex items-center justify-center
                    @if($transaction->type == 'deposit' || $transaction->type == 'profit') bg-green-500/20 text-green-400
                    @elseif($transaction->type == 'withdrawal') bg-red-500/20 text-red-400
                    @else bg-blue-500/20 text-blue-400 @endif">
                    <i class="{{ $transaction->type_icon }} text-lg"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2">
                        <h4 class="font-medium text-gray-900 capitalize">{{ $transaction->type }}</h4>
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium
                            @if($transaction->status == 'completed') bg-green-500/20 text-green-400
                            @elseif($transaction->status == 'pending') bg-yellow-500/20 text-yellow-400
                            @else bg-red-500/20 text-red-400 @endif">
                            {{ ucfirst($transaction->status) }}
                        </span>
                    </div>
                    <p class="text-sm text-gray-500 mt-1">{{ $transaction->description ?? 'No description' }}</p>
                    <p class="text-xs text-gray-600 mt-1">{{ $transaction->created_at->format('M d, Y \a\t h:i A') }}</p>
                </div>
                <div class="text-right">
                    <p class="text-lg font-bold
                        @if($transaction->type == 'deposit' || $transaction->type == 'profit') text-green-400
                        @elseif($transaction->type == 'withdrawal') text-red-400
                        @else text-gray-900 @endif">
                        @if($transaction->type == 'deposit' || $transaction->type == 'profit')+@elseif($transaction->type == 'withdrawal')-@endif
                        ${{ number_format($transaction->amount, 2) }}
                    </p>
                    @if($transaction->reference)
                    <p class="text-xs text-gray-600 mt-1">{{ $transaction->reference }}</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        
        <!-- Pagination -->
        <div class="mt-6">
            {{ $transactions->links() }}
        </div>
        @else
        <div class="text-center py-16">
            <div class="w-20 h-20 mx-auto rounded-full bg-white/5 flex items-center justify-center mb-6">
                <i class="fas fa-exchange-alt text-gray-500 text-3xl"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">No Transactions Yet</h3>
            <p class="text-gray-500 max-w-md mx-auto">
                Your transaction history will appear here once you make your first deposit or investment.
            </p>
        </div>
        @endif
    </div>
</div>
@endsection
