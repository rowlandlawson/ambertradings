@extends('layouts.app')
@section('title', 'Why Choose Us | Amber Tradings')

@section('content')
<!-- Hero Section -->
<section class="relative pt-32 pb-20 sm:pb-28 overflow-hidden">
    <!-- Background Image -->
    <div class="absolute inset-0">
        <img src="{{ asset('images/hero-about.webp') }}" alt="" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-slate-900/90 to-slate-900/70"></div>
    </div>
    <div class="container mx-auto px-4 sm:px-6 text-center relative z-10">
         <nav class="text-sm text-white/60 mb-6">
            <a href="{{ route('home') }}" class="hover:text-orange-500 transition-colors">Home</a>
            <span class="mx-2">|</span>
            <span class="text-white">Why Choose Us</span>
        </nav>
        <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold text-white mb-6">Why Choose Amber Tradings</h1>
        <p class="text-lg sm:text-xl text-white/80 max-w-3xl mx-auto">
            Discover what sets us apart from the competition
        </p>
    </div>
</section>

<!-- Discover Better Trading Section -->
<section class="py-16 sm:py-24 bg-white">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-8">
                <span class="text-orange-500">Discover</span> better trading
            </h2>
            <p class="text-lg text-slate-600 leading-relaxed mb-6">
                Amber Tradings is an award-winning broker for a reason. Wherever your financial interests lie, you can rely on us to provide trading solutions to suit you. This means offering you the widest selection of instruments, platforms, account types and resources to make your trading experience as efficient and convenient as possible.
            </p>
            <p class="text-lg font-semibold text-slate-800 mb-6">
                We also offer exclusive benefits to traders who qualify as Professional Clients.
            </p>
            <p class="text-orange-500 font-medium text-lg">
                Check out just a few of the incredible benefits of joining Amber Tradings.
            </p>
        </div>
    </div>
</section>

<!-- Regulated and Licensed Section -->
<section class="py-16 sm:py-24 bg-slate-50">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl sm:text-4xl font-bold mb-4">
                <span class="text-orange-500">Regulated</span> and Licensed
            </h2>
            <p class="text-lg text-slate-600">Authorised to operate across multiple jurisdictions</p>
        </div>
        
        <div class="grid md:grid-cols-2 gap-8 max-w-5xl mx-auto">
            <!-- Main Regulation Card -->
            <div class="bg-white rounded-2xl p-8 shadow-lg md:col-span-2">
                <div class="flex items-start gap-6">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center flex-shrink-0">
                        <i class="fa fa-check text-2xl text-white"></i>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold text-slate-900 mb-3">Financial Authority Regulated</h4>
                        <p class="text-slate-600 text-lg">Regulated by the financial authorities and Exchange Commission, ensuring the highest standards of compliance and client protection.</p>
                    </div>
                </div>
            </div>
            
            <!-- Feature Cards -->
            <div class="bg-white rounded-2xl p-6 shadow-lg flex items-center gap-4 hover:shadow-xl transition-shadow duration-300">
                <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center flex-shrink-0">
                    <i class="fa fa-lock text-orange-500 text-xl"></i>
                </div>
                <div>
                    <h4 class="font-semibold text-slate-900">Segregation of client funds</h4>
                    <p class="text-slate-600 text-sm">Your funds are kept in separate accounts</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-lg flex items-center gap-4 hover:shadow-xl transition-shadow duration-300">
                <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center flex-shrink-0">
                    <i class="fa fa-star text-orange-500 text-xl"></i>
                </div>
                <div>
                    <h4 class="font-semibold text-slate-900">Superb industry reputation</h4>
                    <p class="text-slate-600 text-sm">Recognized for excellence and reliability</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-lg flex items-center gap-4 hover:shadow-xl transition-shadow duration-300 md:col-span-2 md:max-w-md md:mx-auto">
                <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center flex-shrink-0">
                    <i class="fa fa-heart text-orange-500 text-xl"></i>
                </div>
                <div>
                    <h4 class="font-semibold text-slate-900">Core values of trust and commitment</h4>
                    <p class="text-slate-600 text-sm">Built on integrity and client focus</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Professional Support Section -->
<section class="py-16 sm:py-24 bg-white">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 mb-4">Professional Support</h2>
            <p class="text-lg text-slate-600">Exemplary service for all of our clients and partners</p>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
            <!-- Support Card 1 -->
            <div class="group bg-gradient-to-br from-slate-50 to-white rounded-2xl p-8 border border-slate-100 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                <div class="w-20 h-20 mx-auto mb-6 bg-gradient-to-br from-orange-500 to-red-500 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <i class="fa fa-headphones text-3xl text-white"></i>
                </div>
                <h4 class="text-xl font-bold text-slate-900 mb-3 text-center">Multilingual Support</h4>
                <p class="text-slate-600 text-center">Dedicated and multilingual customer support available around the clock to assist you.</p>
            </div>
            
            <!-- Support Card 2 -->
            <div class="group bg-gradient-to-br from-slate-50 to-white rounded-2xl p-8 border border-slate-100 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                <div class="w-20 h-20 mx-auto mb-6 bg-gradient-to-br from-orange-500 to-red-500 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <i class="fa fa-user-circle text-3xl text-white"></i>
                </div>
                <h4 class="text-xl font-bold text-slate-900 mb-3 text-center">Personal Account Managers</h4>
                <p class="text-slate-600 text-center">Multilingual and friendly personal Account Managers to guide you every step of the way.</p>
            </div>
            
            <!-- Support Card 3 -->
            <div class="group bg-gradient-to-br from-slate-50 to-white rounded-2xl p-8 border border-slate-100 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                <div class="w-20 h-20 mx-auto mb-6 bg-gradient-to-br from-orange-500 to-red-500 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <i class="fa fa-credit-card text-3xl text-white"></i>
                </div>
                <h4 class="text-xl font-bold text-slate-900 mb-3 text-center">Flexible Payments</h4>
                <p class="text-slate-600 text-center">Wide variety of deposit and withdrawal methods for your convenience.</p>
            </div>
        </div>
    </div>
</section>

<!-- Key Benefits Section -->
<section class="py-16 sm:py-24 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">Why Traders Choose Us</h2>
            <p class="text-lg text-white/70">The advantages that set us apart</p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 max-w-6xl mx-auto">
            <!-- Benefit 1 -->
            <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/10 text-center hover:bg-white/15 transition-colors duration-300">
                <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-br from-orange-500 to-red-500 rounded-full flex items-center justify-center">
                    <i class="fa fa-bolt text-2xl text-white"></i>
                </div>
                <h4 class="text-lg font-semibold text-white mb-2">Fast Execution</h4>
                <p class="text-white/70 text-sm">Lightning-fast order execution with minimal slippage</p>
            </div>

            <!-- Benefit 2 -->
            <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/10 text-center hover:bg-white/15 transition-colors duration-300">
                <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-br from-orange-500 to-red-500 rounded-full flex items-center justify-center">
                    <i class="fa fa-shield text-2xl text-white"></i>
                </div>
                <h4 class="text-lg font-semibold text-white mb-2">Secure Platform</h4>
                <p class="text-white/70 text-sm">Bank-level security for your funds and data</p>
            </div>

            <!-- Benefit 3 -->
            <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/10 text-center hover:bg-white/15 transition-colors duration-300">
                <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-br from-orange-500 to-red-500 rounded-full flex items-center justify-center">
                    <i class="fa fa-percent text-2xl text-white"></i>
                </div>
                <h4 class="text-lg font-semibold text-white mb-2">Tight Spreads</h4>
                <p class="text-white/70 text-sm">Competitive spreads starting from 0.1 pips</p>
            </div>

            <!-- Benefit 4 -->
            <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/10 text-center hover:bg-white/15 transition-colors duration-300">
                <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-br from-orange-500 to-red-500 rounded-full flex items-center justify-center">
                    <i class="fa fa-clock-o text-2xl text-white"></i>
                </div>
                <h4 class="text-lg font-semibold text-white mb-2">24/5 Support</h4>
                <p class="text-white/70 text-sm">Round the clock assistance whenever you need</p>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-16 sm:py-20 bg-white">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center">
                <h3 class="text-4xl sm:text-5xl font-bold bg-gradient-to-r from-orange-500 to-red-500 bg-clip-text text-transparent mb-2">2M+</h3>
                <p class="text-slate-600 font-medium">Active Traders</p>
            </div>
            <div class="text-center">
                <h3 class="text-4xl sm:text-5xl font-bold bg-gradient-to-r from-orange-500 to-red-500 bg-clip-text text-transparent mb-2">150+</h3>
                <p class="text-slate-600 font-medium">Countries Served</p>
            </div>
            <div class="text-center">
                <h3 class="text-4xl sm:text-5xl font-bold bg-gradient-to-r from-orange-500 to-red-500 bg-clip-text text-transparent mb-2">100+</h3>
                <p class="text-slate-600 font-medium">Trading Instruments</p>
            </div>
            <div class="text-center">
                <h3 class="text-4xl sm:text-5xl font-bold bg-gradient-to-r from-orange-500 to-red-500 bg-clip-text text-transparent mb-2">24/5</h3>
                <p class="text-slate-600 font-medium">Customer Support</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 sm:py-20 bg-gradient-to-r from-orange-500 to-red-500">
    <div class="container mx-auto px-4 sm:px-6 text-center">
        <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">Ready to Start Trading?</h2>
        <p class="text-lg text-white/90 mb-8 max-w-2xl mx-auto">Join thousands of traders who trust Amber Tradings for their investment needs.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('register') }}" 
               class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-orange-500 bg-white rounded-full shadow-lg hover:bg-white/90 hover:-translate-y-1 transition-all duration-300"
               target="_blank">
                Open Account
            </a>
            <a href="{{ route('contact') }}" 
               class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white border-2 border-white rounded-full hover:bg-white/10 hover:-translate-y-1 transition-all duration-300">
                Contact Us
            </a>
        </div>
    </div>
</section>
@endsection
