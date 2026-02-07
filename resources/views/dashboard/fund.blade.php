@extends('layouts.dashboard')

@section('title', 'Fund Account')

@section('content')
<!-- Header -->
<div class="mb-8">
    <h1 class="text-2xl font-bold text-gray-900">Fund Your Account</h1>
    <p class="text-gray-500 mt-1">Select a payment method to deposit funds into your account</p>
</div>

@if(session('success'))
<div class="glass-card p-4 mb-6 bg-green-50 border border-green-200 text-green-800 flex items-start gap-3">
    <i class="fas fa-check-circle text-green-500 mt-0.5"></i>
    <p>{{ session('success') }}</p>
</div>
@endif

@if(session('error'))
<div class="glass-card p-4 mb-6 bg-red-50 border border-red-200 text-red-800 flex items-start gap-3">
    <i class="fas fa-exclamation-circle text-red-500 mt-0.5"></i>
    <p>{{ session('error') }}</p>
</div>
@endif

@if($errors->any())
<div class="glass-card p-4 mb-6 bg-red-50 border border-red-200 text-red-800">
    <ul class="list-disc list-inside">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<!-- Payment Methods Grid -->
@if($paymentMethods->count() > 0)
<div class="grid md:grid-cols-2 gap-6">
    @foreach($paymentMethods as $method)
    <div class="glass-card overflow-hidden cursor-pointer payment-method-card" data-method-id="{{ $method->id }}">
        <div class="p-6">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-14 h-14 rounded-xl 
                    @if($method->name == 'Bitcoin (BTC)') bg-orange-100 text-orange-600
                    @elseif($method->name == 'Ethereum (ETH)') bg-purple-100 text-purple-600
                    @elseif($method->name == 'USDT (Tether)') bg-green-100 text-green-600
                    @else bg-blue-100 text-blue-600 @endif
                    flex items-center justify-center">
                    <i class="{{ $method->icon_class }} text-2xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">{{ $method->name }}</h3>
                    <p class="text-sm text-gray-500">
                        @if($method->type === 'crypto')
                        Instant processing, secure transactions
                        @else
                        Direct bank deposit
                        @endif
                    </p>
                </div>
                <i class="fas fa-chevron-right text-gray-400 ml-auto"></i>
            </div>
        </div>
        
        <!-- Expandable Payment Details -->
        <div class="payment-details hidden border-t border-gray-100 p-6 bg-gray-50">
            @if($method->type === 'crypto')
            <!-- Crypto Address -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-wallet mr-1"></i> Wallet Address
                </label>
                <div class="flex items-center gap-2">
                    <input type="text" value="{{ $method->wallet_address }}" readonly
                        class="flex-1 px-4 py-3 bg-white border border-gray-200 rounded-xl text-gray-900 font-mono text-sm">
                    <button type="button" onclick="copyToClipboard('{{ $method->wallet_address }}')"
                        class="px-4 py-3 bg-gray-200 hover:bg-gray-300 rounded-xl transition-colors">
                        <i class="fas fa-copy"></i>
                    </button>
                </div>
            </div>
            @else
            <!-- Bank Details -->
            <div class="grid grid-cols-2 gap-4 mb-4">
                @if($method->bank_details['bank_name'] ?? null)
                <div>
                    <label class="block text-xs text-gray-500 uppercase mb-1">Bank Name</label>
                    <p class="font-medium text-gray-900">{{ $method->bank_details['bank_name'] }}</p>
                </div>
                @endif
                @if($method->bank_details['account_name'] ?? null)
                <div>
                    <label class="block text-xs text-gray-500 uppercase mb-1">Account Name</label>
                    <p class="font-medium text-gray-900">{{ $method->bank_details['account_name'] }}</p>
                </div>
                @endif
                @if($method->bank_details['account_number'] ?? null)
                <div>
                    <label class="block text-xs text-gray-500 uppercase mb-1">Account Number</label>
                    <p class="font-medium text-gray-900">{{ $method->bank_details['account_number'] }}</p>
                </div>
                @endif
                @if($method->bank_details['routing_number'] ?? null)
                <div>
                    <label class="block text-xs text-gray-500 uppercase mb-1">Routing Number</label>
                    <p class="font-medium text-gray-900">{{ $method->bank_details['routing_number'] }}</p>
                </div>
                @endif
                @if($method->bank_details['swift_code'] ?? null)
                <div>
                    <label class="block text-xs text-gray-500 uppercase mb-1">SWIFT Code</label>
                    <p class="font-medium text-gray-900">{{ $method->bank_details['swift_code'] }}</p>
                </div>
                @endif
            </div>
            @endif
            
            @if($method->instructions)
            <div class="p-3 rounded-lg bg-blue-50 border border-blue-100 text-blue-700 text-sm mb-4">
                <i class="fas fa-info-circle mr-2"></i>
                {{ $method->instructions }}
            </div>
            @endif
            
            <!-- Deposit Form -->
            <form action="{{ route('dashboard.submit-deposit') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <input type="hidden" name="payment_method_id" value="{{ $method->id }}">
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Amount (USD)</label>
                    <div class="flex items-center">
                        <span class="px-4 py-3 bg-gray-100 border border-r-0 border-gray-200 rounded-l-xl text-gray-500">$</span>
                        <input type="number" name="amount" step="0.01" min="10" required
                            placeholder="Enter deposit amount"
                            class="flex-1 px-4 py-3 bg-white border border-gray-200 rounded-r-xl text-gray-900 focus:border-blue-500 outline-none">
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-receipt mr-1"></i> Upload Payment Receipt
                    </label>
                    <div class="relative">
                        <input type="file" name="receipt" accept="image/*" required
                            class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-gray-900 focus:border-blue-500 outline-none file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Upload a screenshot of your payment confirmation</p>
                </div>
                
                <button type="submit" class="w-full px-6 py-3 gradient-blue text-white font-semibold rounded-xl hover:opacity-90 transition-opacity">
                    <i class="fas fa-paper-plane mr-2"></i>
                    Submit Deposit Request
                </button>
            </form>
        </div>
    </div>
    @endforeach
</div>

<!-- Info Box -->
<div class="glass-card mt-8 p-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
        <i class="fas fa-info-circle text-blue-500"></i>
        How Deposits Work
    </h3>
    <div class="grid md:grid-cols-3 gap-6">
        <div class="flex items-start gap-3">
            <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center shrink-0">
                <span class="text-blue-600 font-bold text-sm">1</span>
            </div>
            <div>
                <h4 class="font-medium text-gray-900">Select Payment Method</h4>
                <p class="text-sm text-gray-500">Choose your preferred payment method and view the payment details</p>
            </div>
        </div>
        <div class="flex items-start gap-3">
            <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center shrink-0">
                <span class="text-blue-600 font-bold text-sm">2</span>
            </div>
            <div>
                <h4 class="font-medium text-gray-900">Make Payment</h4>
                <p class="text-sm text-gray-500">Send the funds to the wallet/account provided and take a screenshot</p>
            </div>
        </div>
        <div class="flex items-start gap-3">
            <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center shrink-0">
                <span class="text-blue-600 font-bold text-sm">3</span>
            </div>
            <div>
                <h4 class="font-medium text-gray-900">Upload Receipt</h4>
                <p class="text-sm text-gray-500">Submit the receipt and your balance will be updated after verification</p>
            </div>
        </div>
    </div>
</div>

@else
<div class="glass-card p-16 text-center">
    <div class="w-20 h-20 mx-auto rounded-full bg-gray-100 flex items-center justify-center mb-6">
        <i class="fas fa-wallet text-gray-400 text-3xl"></i>
    </div>
    <h3 class="text-xl font-semibold text-gray-700 mb-2">No Payment Methods Available</h3>
    <p class="text-gray-500 max-w-md mx-auto">
        Payment methods are currently being configured. Please check back later or contact support.
    </p>
</div>
@endif
@endsection

@section('scripts')
<script>
    // Toggle payment details
    document.querySelectorAll('.payment-method-card').forEach(card => {
        card.addEventListener('click', function(e) {
            // Don't toggle if clicking inside form
            if (e.target.closest('form')) return;
            
            const details = this.querySelector('.payment-details');
            const chevron = this.querySelector('.fa-chevron-right');
            
            // Close other cards
            document.querySelectorAll('.payment-method-card').forEach(other => {
                if (other !== this) {
                    other.querySelector('.payment-details').classList.add('hidden');
                    other.querySelector('.fa-chevron-right').classList.remove('rotate-90');
                }
            });
            
            // Toggle this card
            details.classList.toggle('hidden');
            chevron.classList.toggle('rotate-90');
        });
    });
    
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            Toast.fire({
                icon: 'success',
                title: 'Address copied to clipboard!'
            });
        });
    }
</script>
@endsection
