@extends('layouts.dashboard')

@section('title', 'Investment Plans')
@section('page-title', 'Investment Plans')

@section('content')
<!-- Current Balance Banner -->
<div class="glass-card p-4 mb-6 flex items-center justify-between bg-gradient-to-r from-amber-50 to-orange-50 border-amber-200">
    <div class="flex items-center gap-4">
        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-amber-500 to-orange-600 flex items-center justify-center">
            <i class="fas fa-wallet text-white text-xl"></i>
        </div>
        <div>
            <p class="text-sm text-gray-600">Your Available Balance</p>
            <p class="text-2xl font-bold text-gray-900">${{ number_format($user->balance, 2) }}</p>
        </div>
    </div>
    <a href="{{ route('dashboard.fund') }}" class="px-6 py-3 bg-gradient-to-r from-amber-500 to-orange-600 text-white font-medium rounded-xl hover:from-amber-600 hover:to-orange-700 transition-all">
        <i class="fas fa-plus mr-2"></i>Fund Account
    </a>
</div>

<!-- Error/Success Messages -->
@if(session('error'))
<div class="glass-card p-4 mb-6 bg-red-50 border-red-200 text-red-800 flex items-start gap-3">
    <i class="fas fa-exclamation-circle text-red-500 mt-0.5"></i>
    <div>
        <p class="font-semibold">Insufficient Balance</p>
        <p class="text-sm">{{ session('error') }}</p>
        <a href="{{ route('dashboard.fund') }}" class="inline-flex items-center gap-2 mt-3 text-sm font-medium text-red-600 hover:text-red-700">
            <i class="fas fa-wallet"></i>Fund Your Account Now
        </a>
    </div>
</div>
@endif

@if(session('success'))
<div class="glass-card p-4 mb-6 bg-green-50 border-green-200 text-green-800 flex items-start gap-3">
    <i class="fas fa-check-circle text-green-500 mt-0.5"></i>
    <p>{{ session('success') }}</p>
</div>
@endif

@if($errors->any())
<div class="glass-card p-4 mb-6 bg-red-50 border-red-200 text-red-800">
    <ul class="list-disc list-inside text-sm space-y-1">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="glass-card overflow-hidden">
    <!-- Header -->
    <div class="p-6 border-b border-gray-200">
        <div>
            <h2 class="text-xl font-semibold text-gray-900">Available Investment Plans</h2>
            <p class="text-gray-500 text-sm mt-1">Choose an investment plan and start earning returns</p>
        </div>
    </div>
    
    <!-- Plans Grid -->
    <div class="p-6">
        @if($packages->count() > 0)
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($packages as $package)
            <div class="bg-gray-50 rounded-2xl p-6 border border-gray-200 hover:border-amber-500/50 hover:shadow-lg transition-all duration-300">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-amber-500 to-orange-600 flex items-center justify-center">
                        <i class="{{ $package->icon ?? 'fas fa-gem' }} text-white text-2xl"></i>
                    </div>
                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium
                        @if($package->risk_level == 'low') bg-green-100 text-green-600
                        @elseif($package->risk_level == 'medium') bg-yellow-100 text-yellow-600
                        @else bg-red-100 text-red-600 @endif">
                        {{ ucfirst($package->risk_level) }} Risk
                    </span>
                </div>
                
                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $package->name }}</h3>
                <p class="text-sm text-gray-500 mb-4 line-clamp-2">{{ $package->description ?? 'Professional investment package' }}</p>
                
                <div class="space-y-3 mb-6 pt-4 border-t border-gray-200">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Investment Range</span>
                        <span class="text-gray-900 font-medium">${{ number_format($package->min_amount) }} - ${{ number_format($package->max_amount) }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">ROI Return</span>
                        <span class="text-green-600 font-bold text-lg">{{ $package->roi_percentage }}%</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Duration</span>
                        <span class="text-gray-900 font-medium">{{ $package->duration_days }} days</span>
                    </div>
                </div>
                
                <!-- Investment Form -->
                <form action="{{ route('dashboard.invest') }}" method="POST" class="space-y-3">
                    @csrf
                    <input type="hidden" name="package_id" value="{{ $package->id }}">
                    
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Investment Amount ($)</label>
                        <input type="number" name="amount" step="0.01" 
                               min="{{ $package->min_amount }}" 
                               max="{{ $package->max_amount }}"
                               placeholder="Enter amount ({{ $package->min_amount }} - {{ $package->max_amount }})"
                               class="w-full px-4 py-2.5 rounded-lg border border-gray-200 text-gray-900 text-sm focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20 outline-none transition-all"
                               required>
                    </div>
                    
                    @if($user->balance >= $package->min_amount)
                    <button type="submit" 
                            class="w-full py-3 text-center text-white font-semibold bg-gradient-to-r from-amber-500 to-orange-600 rounded-xl hover:from-amber-600 hover:to-orange-700 transition-all duration-300">
                        <i class="fas fa-chart-line mr-2"></i>Invest Now
                    </button>
                    @else
                    <div class="text-center">
                        <p class="text-xs text-red-500 mb-2">
                            <i class="fas fa-exclamation-triangle mr-1"></i>
                            Insufficient balance for this package
                        </p>
                        <a href="{{ route('dashboard.fund') }}" 
                           class="block w-full py-3 text-center text-white font-semibold bg-gradient-to-r from-gray-400 to-gray-500 rounded-xl hover:from-amber-500 hover:to-orange-600 transition-all duration-300">
                            <i class="fas fa-wallet mr-2"></i>Fund Account First
                        </a>
                    </div>
                    @endif
                </form>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-16">
            <div class="w-20 h-20 mx-auto rounded-full bg-gray-100 flex items-center justify-center mb-6">
                <i class="fas fa-gem text-gray-400 text-3xl"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">No Investment Plans Available</h3>
            <p class="text-gray-500 max-w-md mx-auto">
                Investment plans are being prepared. Please check back later or contact support for more information.
            </p>
        </div>
        @endif
    </div>
</div>

<!-- How It Works Section -->
<div class="glass-card mt-6 p-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center gap-2">
        <i class="fas fa-info-circle text-amber-500"></i>
        How It Works
    </h3>
    
    <div class="grid md:grid-cols-4 gap-6">
        <div class="text-center p-4">
            <div class="w-12 h-12 mx-auto rounded-full bg-amber-100 flex items-center justify-center mb-4">
                <span class="text-amber-600 font-bold text-xl">1</span>
            </div>
            <h4 class="font-semibold text-gray-900 mb-2">Fund Account</h4>
            <p class="text-sm text-gray-500">Deposit funds into your account using your preferred payment method.</p>
        </div>
        
        <div class="text-center p-4">
            <div class="w-12 h-12 mx-auto rounded-full bg-amber-100 flex items-center justify-center mb-4">
                <span class="text-amber-600 font-bold text-xl">2</span>
            </div>
            <h4 class="font-semibold text-gray-900 mb-2">Choose a Plan</h4>
            <p class="text-sm text-gray-500">Select an investment plan that matches your goals and risk tolerance.</p>
        </div>
        
        <div class="text-center p-4">
            <div class="w-12 h-12 mx-auto rounded-full bg-amber-100 flex items-center justify-center mb-4">
                <span class="text-amber-600 font-bold text-xl">3</span>
            </div>
            <h4 class="font-semibold text-gray-900 mb-2">We Trade For You</h4>
            <p class="text-sm text-gray-500">Our expert traders manage your investment and trade on your behalf.</p>
        </div>
        
        <div class="text-center p-4">
            <div class="w-12 h-12 mx-auto rounded-full bg-amber-100 flex items-center justify-center mb-4">
                <span class="text-amber-600 font-bold text-xl">4</span>
            </div>
            <h4 class="font-semibold text-gray-900 mb-2">Earn Returns</h4>
            <p class="text-sm text-gray-500">Receive your profits when the investment period ends.</p>
        </div>
    </div>
</div>
@endsection
