@extends('layouts.app')
@section('title', 'Forex Trading | Amber Tradings')

@section('content')
<!-- Page Header -->
<section class="relative pt-32 pb-16 overflow-hidden">
    <!-- Background Image -->
    <div class="absolute inset-0">
        <img src="{{ asset('images/hero-forex.webp') }}" alt="" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-slate-900/80"></div>
    </div>
    <div class="container mx-auto px-4 sm:px-6 text-center relative z-10">
        <h1 class="text-4xl sm:text-5xl font-bold text-white mb-4">Forex Trading</h1>
        <p class="text-lg text-white/70">Trade the world's largest financial market</p>
    </div>
</section>

<!-- Content Section -->
<section class="py-16 sm:py-20 bg-white">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 mb-6">What is Forex Trading?</h2>
                <p class="text-slate-600 leading-relaxed mb-8">
                    Forex (foreign exchange) is the global marketplace for trading national currencies. With over $6 trillion traded daily, it's the world's largest and most liquid financial market.
                </p>
                
                <!-- Info Box -->
                <div class="bg-slate-50 rounded-2xl p-6 sm:p-8 mb-8">
                    <h3 class="text-xl font-semibold text-slate-900 mb-4">Key Benefits</h3>
                    <ul class="space-y-3">
                        <li class="flex items-start gap-3">
                            <i class="fa fa-check-circle text-orange-500 mt-1"></i>
                            <span class="text-slate-600">24-hour market, 5 days a week</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fa fa-check-circle text-orange-500 mt-1"></i>
                            <span class="text-slate-600">High liquidity and tight spreads</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fa fa-check-circle text-orange-500 mt-1"></i>
                            <span class="text-slate-600">Trade major, minor, and exotic pairs</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fa fa-check-circle text-orange-500 mt-1"></i>
                            <span class="text-slate-600">Leverage opportunities</span>
                        </li>
                    </ul>
                </div>

                <!-- Additional Info -->
                <div class="bg-slate-50 rounded-2xl p-6 sm:p-8">
                    <h3 class="text-xl font-semibold text-slate-900 mb-4">Why Trade Forex with Us?</h3>
                    <p class="text-slate-600 leading-relaxed">
                        At Amber Tradings, we provide competitive spreads, advanced trading tools, and expert support to help you succeed in the forex market. Our platform offers real-time market data, technical analysis tools, and seamless execution.
                    </p>
                </div>
            </div>
            
            <!-- Sidebar CTA -->
            <div class="lg:col-span-1">
                <div class="bg-gradient-to-br from-orange-500 to-red-500 rounded-2xl p-6 sm:p-8 text-center sticky top-32">
                    <h3 class="text-2xl font-bold text-white mb-4">Start Trading Forex</h3>
                    <p class="text-white/90 mb-6">Open an account today and access global currency markets.</p>
                    <a href="https://portal.ambertradings.com/register" 
                       class="inline-block w-full py-4 bg-white text-orange-500 font-semibold rounded-full hover:bg-white/90 transition-all duration-300"
                       target="_blank">
                        Open Account
                    </a>
                    <a href="https://portal.ambertradings.com/login" 
                       class="inline-block w-full py-4 mt-3 border-2 border-white text-white font-semibold rounded-full hover:bg-white/10 transition-all duration-300"
                       target="_blank">
                        Login
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
