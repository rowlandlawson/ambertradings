@extends('layouts.app')
@section('title', 'Trading Portfolio | Amber Tradings')

@section('content')
<!-- Page Header -->
<section class="relative pt-32 pb-16 overflow-hidden">
    <!-- Background Image -->
    <div class="absolute inset-0">
        <img src="{{ asset('images/hero-portfolio.webp') }}" alt="" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-slate-900/80"></div>
    </div>
    <div class="container mx-auto px-4 sm:px-6 text-center relative z-10">
        <h1 class="text-4xl sm:text-5xl font-bold text-white mb-4">Trading Portfolio</h1>
        <p class="text-lg text-white/70">Explore our diverse range of trading instruments</p>
    </div>
</section>

<!-- Portfolio Cards Section -->
<section class="py-16 sm:py-20 bg-white">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
            <!-- Forex Card -->
            <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-lg hover:shadow-xl hover:-translate-y-2 transition-all duration-300 border border-slate-100">
                <div class="w-16 h-16 bg-orange-100 rounded-xl flex items-center justify-center mb-6">
                    <i class="fa fa-exchange text-3xl text-orange-500"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">Forex</h3>
                <p class="text-slate-600 mb-6">Trade major, minor, and exotic currency pairs with competitive spreads.</p>
                <a href="{{ route('forex') }}" class="inline-flex items-center text-orange-500 font-semibold hover:text-orange-600 transition-colors">
                    Learn More <i class="fa fa-arrow-right ml-2"></i>
                </a>
            </div>

            <!-- Commodities Card -->
            <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-lg hover:shadow-xl hover:-translate-y-2 transition-all duration-300 border border-slate-100">
                <div class="w-16 h-16 bg-orange-100 rounded-xl flex items-center justify-center mb-6">
                    <i class="fa fa-cubes text-3xl text-orange-500"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">Commodities</h3>
                <p class="text-slate-600 mb-6">Access gold, silver, oil, and other commodity markets.</p>
                <a href="{{ route('commodities') }}" class="inline-flex items-center text-orange-500 font-semibold hover:text-orange-600 transition-colors">
                    Learn More <i class="fa fa-arrow-right ml-2"></i>
                </a>
            </div>

            <!-- Indices Card -->
            <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-lg hover:shadow-xl hover:-translate-y-2 transition-all duration-300 border border-slate-100">
                <div class="w-16 h-16 bg-orange-100 rounded-xl flex items-center justify-center mb-6">
                    <i class="fa fa-bar-chart text-3xl text-orange-500"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">Indices</h3>
                <p class="text-slate-600 mb-6">Trade global stock indices including major markets worldwide.</p>
                <a href="{{ route('indices') }}" class="inline-flex items-center text-orange-500 font-semibold hover:text-orange-600 transition-colors">
                    Learn More <i class="fa fa-arrow-right ml-2"></i>
                </a>
            </div>

            <!-- NFP Card -->
            <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-lg hover:shadow-xl hover:-translate-y-2 transition-all duration-300 border border-slate-100">
                <div class="w-16 h-16 bg-orange-100 rounded-xl flex items-center justify-center mb-6">
                    <i class="fa fa-newspaper-o text-3xl text-orange-500"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">NFP Trading</h3>
                <p class="text-slate-600 mb-6">Capitalize on Non-Farm Payroll market movements.</p>
                <a href="{{ route('nfp') }}" class="inline-flex items-center text-orange-500 font-semibold hover:text-orange-600 transition-colors">
                    Learn More <i class="fa fa-arrow-right ml-2"></i>
                </a>
            </div>

            <!-- Stocks Card -->
            <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-lg hover:shadow-xl hover:-translate-y-2 transition-all duration-300 border border-slate-100">
                <div class="w-16 h-16 bg-orange-100 rounded-xl flex items-center justify-center mb-6">
                    <i class="fa fa-building text-3xl text-orange-500"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">CFD Stocks</h3>
                <p class="text-slate-600 mb-6">Trade shares of top global companies.</p>
                <a href="{{ route('stocks') }}" class="inline-flex items-center text-orange-500 font-semibold hover:text-orange-600 transition-colors">
                    Learn More <i class="fa fa-arrow-right ml-2"></i>
                </a>
            </div>

            <!-- Cryptocurrency Card -->
            <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-lg hover:shadow-xl hover:-translate-y-2 transition-all duration-300 border border-slate-100">
                <div class="w-16 h-16 bg-orange-100 rounded-xl flex items-center justify-center mb-6">
                    <i class="fa fa-bitcoin text-3xl text-orange-500"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">Cryptocurrency</h3>
                <p class="text-slate-600 mb-6">Trade Bitcoin, Ethereum, and other digital assets.</p>
                <a href="{{ route('cryptocurrency') }}" class="inline-flex items-center text-orange-500 font-semibold hover:text-orange-600 transition-colors">
                    Learn More <i class="fa fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
