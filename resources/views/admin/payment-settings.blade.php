@extends('layouts.admin')

@section('title', 'Payment Settings')
@section('page-title', 'Payment Settings')

@section('content')
<div class="mb-6">
    <p class="text-gray-500">Configure wallet addresses and bank details for each payment method. Only activated methods with valid details will be shown to users.</p>
</div>

<div class="space-y-6">
    @foreach($paymentMethods as $method)
    <div class="glass-card overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl 
                    @if($method->name == 'Bitcoin (BTC)') bg-orange-100 text-orange-600
                    @elseif($method->name == 'Ethereum (ETH)') bg-purple-100 text-purple-600
                    @elseif($method->name == 'USDT (Tether)') bg-green-100 text-green-600
                    @else bg-blue-100 text-blue-600 @endif
                    flex items-center justify-center">
                    <i class="{{ $method->icon_class }} text-xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">{{ $method->name }}</h3>
                    <p class="text-sm text-gray-500">{{ $method->type === 'crypto' ? 'Cryptocurrency' : 'Bank Transfer' }}</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                @if($method->is_active && $method->isConfigured())
                <span class="px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-600">
                    <i class="fas fa-check-circle mr-1"></i> Active
                </span>
                @elseif($method->isConfigured())
                <span class="px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-600">
                    <i class="fas fa-pause-circle mr-1"></i> Inactive
                </span>
                @else
                <span class="px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                    <i class="fas fa-times-circle mr-1"></i> Not Configured
                </span>
                @endif
            </div>
        </div>
        
        <form action="{{ route('admin.update-payment-method', $method->id) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')
            
            @if($method->type === 'crypto')
            <!-- Crypto Wallet Fields -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Wallet Address</label>
                <input type="text" name="wallet_address" value="{{ $method->wallet_address }}"
                    placeholder="Enter your {{ $method->name }} wallet address"
                    class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-900 focus:border-purple-500 focus:ring-1 focus:ring-purple-500 outline-none">
                <p class="text-xs text-gray-500 mt-1">Users will send payments to this address</p>
            </div>
            @else
            <!-- Bank Transfer Fields -->
            <div class="grid md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Bank Name</label>
                    <input type="text" name="bank_name" value="{{ $method->bank_details['bank_name'] ?? '' }}"
                        placeholder="e.g., Chase Bank"
                        class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-900 focus:border-purple-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Account Name</label>
                    <input type="text" name="account_name" value="{{ $method->bank_details['account_name'] ?? '' }}"
                        placeholder="e.g., Amber Tradings LLC"
                        class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-900 focus:border-purple-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Account Number</label>
                    <input type="text" name="account_number" value="{{ $method->bank_details['account_number'] ?? '' }}"
                        placeholder="Account number"
                        class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-900 focus:border-purple-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Routing Number</label>
                    <input type="text" name="routing_number" value="{{ $method->bank_details['routing_number'] ?? '' }}"
                        placeholder="Routing number"
                        class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-900 focus:border-purple-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">SWIFT Code</label>
                    <input type="text" name="swift_code" value="{{ $method->bank_details['swift_code'] ?? '' }}"
                        placeholder="SWIFT/BIC code"
                        class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-900 focus:border-purple-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Bank Address</label>
                    <input type="text" name="bank_address" value="{{ $method->bank_details['bank_address'] ?? '' }}"
                        placeholder="Bank address"
                        class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-900 focus:border-purple-500 outline-none">
                </div>
            </div>
            @endif
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Instructions for Users</label>
                <textarea name="instructions" rows="2" placeholder="Additional instructions for users"
                    class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-900 focus:border-purple-500 outline-none resize-none">{{ $method->instructions }}</textarea>
            </div>
            
            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ $method->is_active ? 'checked' : '' }}
                        class="w-5 h-5 rounded border-gray-300 text-purple-600 focus:ring-purple-500">
                    <span class="text-sm font-medium text-gray-700">Enable this payment method</span>
                </label>
                
                <button type="submit" class="px-6 py-2.5 gradient-purple text-white font-medium rounded-xl hover:opacity-90 transition-opacity">
                    <i class="fas fa-save mr-2"></i>Save Changes
                </button>
            </div>
        </form>
    </div>
    @endforeach
</div>
@endsection
