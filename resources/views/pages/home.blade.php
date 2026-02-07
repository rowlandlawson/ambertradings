@extends('layouts.app')

@section('title', 'Amber Tradings | Home')

@section('content')
<!-- Hero Section -->
<section class="relative min-h-screen flex items-center pt-24 sm:pt-32 pb-16 sm:pb-20 overflow-hidden bg-slate-950">
    <!-- Background Image -->
   <div class="absolute inset-0">
    <video autoplay muted playsinline class="w-full h-full object-cover object-center opacity-60">
        <source src="{{ asset('videos/herobg.mp4') }}" type="video/mp4">
        <source src="{{ asset('videos/herobg.webm') }}" type="video/webm">
    </video>
    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/50 to-transparent"></div>
</div>
    
    <div class="container mx-auto px-4 sm:px-6 relative z-10">
        <div class="max-w-4xl mx-auto text-center text-white">
            <!-- Headline -->
            <h1 class="text-3xl xs:text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-4 sm:mb-6 leading-tight animate-fade-in-up">
                Need help to<br>
                <span class="bg-gradient-to-r from-orange-500 via-orange-400 to-amber-400 bg-clip-text text-transparent">
                    start investing?
                </span>
            </h1>
            
            <!-- Subtitle -->
            <p class="text-base sm:text-lg md:text-xl text-white/80 mb-8 sm:mb-10 max-w-2xl mx-auto leading-relaxed px-2 animate-fade-in-up" style="animation-delay: 0.1s;">
                Your investment portfolio will grow with every successful trade,
                while you save your time and effort.
            </p>
            
            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center mb-12 sm:mb-16 px-4 sm:px-0 animate-fade-in-up" style="animation-delay: 0.2s;">
                <a href="{{ route('register') }}" 
                   class="inline-flex items-center justify-center px-8 sm:px-10 py-3.5 sm:py-4 text-sm sm:text-base font-semibold text-white bg-gradient-to-r from-orange-500 to-red-500 rounded-full shadow-lg shadow-orange-500/40 hover:shadow-orange-500/60 hover:-translate-y-1 transition-all duration-300"
                   target="_blank">
                    Open Account
                </a>
                <a href="{{ route('login') }}" 
                   class="inline-flex items-center justify-center px-8 sm:px-10 py-3.5 sm:py-4 text-sm sm:text-base font-semibold text-white border-2 border-white/30 rounded-full hover:bg-white/10 hover:border-white/50 hover:-translate-y-1 transition-all duration-300"
                   target="_blank">
                    Login
                </a>
            </div>
            
            <!-- Feature Text -->
            <p class="text-sm sm:text-base text-white/60 max-w-3xl mx-auto leading-relaxed px-4 animate-fade-in-up" style="animation-delay: 0.3s;">
                Our intuitive platform is equipped with all the tools you need to maximize your trading potential, including technical indicators, interactive charts and a powerful security system.
            </p>
        </div>
    </div>
</section>


<!-- Features Section -->
<section class="py-16 sm:py-24 bg-white">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="text-center mb-10 sm:mb-16">
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-slate-900 mb-3 sm:mb-4">Why Amber Group</h2>
            <p class="text-base sm:text-lg text-slate-600">Your bridge between traditional and digital finance</p>
        </div>
        
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8">
            <!-- Feature 1 -->
            <div class="group p-6 bg-white rounded-2xl shadow-lg shadow-slate-200/50 hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                <div class="w-16 h-16 mb-6 mx-auto flex items-center justify-center rounded-2xl bg-gradient-to-br from-orange-100 to-indigo-100">
                    <i class="fa fa-line-chart text-3xl text-orange-500"></i>
                </div>
                <h4 class="text-lg font-semibold text-slate-900 mb-4 text-center">Investing in digital assets</h4>
                <p class="text-slate-600 text-sm text-center leading-relaxed">Trusted by top-tier institutional and individual investors, Amber Premium offers bespoke digital assets investment and portfolio management solutions catered to clients' specific needs.</p>
            </div>
            
            <!-- Feature 2 -->
            <div class="group p-6 bg-white rounded-2xl shadow-lg shadow-slate-200/50 hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                <div class="w-16 h-16 mb-6 mx-auto flex items-center justify-center rounded-2xl bg-gradient-to-br from-orange-100 to-indigo-100">
                    <i class="fa fa-users text-3xl text-orange-500"></i>
                </div>
                <h4 class="text-lg font-semibold text-slate-900 mb-4 text-center">Institutional-grade digital asset management</h4>
                <p class="text-slate-600 text-sm text-center leading-relaxed">Amber boasts an expansive and exceptionally skilled trading team, recognized as one of the largest and most proficient in the industry. Through in-depth market analysis and quantitative strategies, we help clients capitalize on opportunities to achieve stable growth of their crypto holdings.</p>
            </div>
            
            <!-- Feature 3 -->
            <div class="group p-6 bg-white rounded-2xl shadow-lg shadow-slate-200/50 hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                <div class="w-16 h-16 mb-6 mx-auto flex items-center justify-center rounded-2xl bg-gradient-to-br from-orange-100 to-indigo-100">
                    <i class="fa fa-tint text-3xl text-orange-500"></i>
                </div>
                <h4 class="text-lg font-semibold text-slate-900 mb-4 text-center">Accessing more liquidity</h4>
                <p class="text-slate-600 text-sm text-center leading-relaxed">As a top liquidity provider, Amber provides liquidity solutions to leading projects and institutions globally. Enjoy best-in-class trading execution to adapt quickly to market shifts at minimal cost.</p>
            </div>

             <!-- Feature 4 -->
            <div class="group p-6 bg-white rounded-2xl shadow-lg shadow-slate-200/50 hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                <div class="w-16 h-16 mb-6 mx-auto flex items-center justify-center rounded-2xl bg-gradient-to-br from-orange-100 to-indigo-100">
                    <i class="fa fa-server text-3xl text-orange-500"></i>
                </div>
                <h4 class="text-lg font-semibold text-slate-900 mb-4 text-center">Robust crypto infrastructure support</h4>
                <p class="text-slate-600 text-sm text-center leading-relaxed">Amber provides scalable, all-in-one infrastructure solutions to power the growth of digital businesses. Our reliable and customizable infrastructure support enables clients to focus on core product development while meeting dynamic computing needs.</p>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="py-16 sm:py-24 bg-gradient-to-b from-slate-50 to-white">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="text-center mb-10 sm:mb-16">
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-slate-900 mb-3 sm:mb-4">Investment Portfolio</h2>
            <p class="text-base sm:text-lg text-slate-600">Explore our diverse range of trading instruments</p>
        </div>
        
        <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6 sm:gap-8">
            <!-- Service Cards -->
            <div class="group p-8 bg-white rounded-2xl shadow-lg border border-slate-100 hover:border-orange-200 hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                <h4 class="text-xl font-semibold text-slate-900 mb-4 flex items-center gap-3">
                    <i class="fa fa-exchange text-orange-500"></i>Forex
                </h4>
                <p class="text-slate-600 mb-6 leading-relaxed">Trade major, minor, and exotic currency pairs with competitive spreads.</p>
                <a href="{{ route('forex') }}" class="inline-block px-6 py-2.5 text-sm font-medium text-white bg-gradient-to-r from-orange-500 to-red-500 rounded-full hover:-translate-y-0.5 hover:shadow-lg hover:shadow-orange-500/30 transition-all duration-300">Learn More</a>
            </div>
            
            <div class="group p-8 bg-white rounded-2xl shadow-lg border border-slate-100 hover:border-orange-200 hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                <h4 class="text-xl font-semibold text-slate-900 mb-4 flex items-center gap-3">
                    <i class="fa fa-cubes text-orange-500"></i>Commodities
                </h4>
                <p class="text-slate-600 mb-6 leading-relaxed">Access gold, silver, oil, and other commodity markets.</p>
                <a href="{{ route('commodities') }}" class="inline-block px-6 py-2.5 text-sm font-medium text-white bg-gradient-to-r from-orange-500 to-red-500 rounded-full hover:-translate-y-0.5 hover:shadow-lg hover:shadow-orange-500/30 transition-all duration-300">Learn More</a>
            </div>
            
            <div class="group p-8 bg-white rounded-2xl shadow-lg border border-slate-100 hover:border-orange-200 hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                <h4 class="text-xl font-semibold text-slate-900 mb-4 flex items-center gap-3">
                    <i class="fa fa-bitcoin text-orange-500"></i>Cryptocurrency
                </h4>
                <p class="text-slate-600 mb-6 leading-relaxed">Trade Bitcoin, Ethereum, and other digital assets.</p>
                <a href="{{ route('cryptocurrency') }}" class="inline-block px-6 py-2.5 text-sm font-medium text-white bg-gradient-to-r from-orange-500 to-red-500 rounded-full hover:-translate-y-0.5 hover:shadow-lg hover:shadow-orange-500/30 transition-all duration-300">Learn More</a>
            </div>
            
            <div class="group p-8 bg-white rounded-2xl shadow-lg border border-slate-100 hover:border-orange-200 hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                <h4 class="text-xl font-semibold text-slate-900 mb-4 flex items-center gap-3">
                    <i class="fa fa-bar-chart text-orange-500"></i>Indices
                </h4>
                <p class="text-slate-600 mb-6 leading-relaxed">Trade global stock indices including S&P 500, NASDAQ, and more.</p>
                <a href="{{ route('indices') }}" class="inline-block px-6 py-2.5 text-sm font-medium text-white bg-gradient-to-r from-orange-500 to-red-500 rounded-full hover:-translate-y-0.5 hover:shadow-lg hover:shadow-orange-500/30 transition-all duration-300">Learn More</a>
            </div>
            
            <div class="group p-8 bg-white rounded-2xl shadow-lg border border-slate-100 hover:border-orange-200 hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                <h4 class="text-xl font-semibold text-slate-900 mb-4 flex items-center gap-3">
                    <i class="fa fa-building text-orange-500"></i>CFD Stocks
                </h4>
                <p class="text-slate-600 mb-6 leading-relaxed">Trade shares of top global companies without owning the underlying asset.</p>
                <a href="{{ route('stocks') }}" class="inline-block px-6 py-2.5 text-sm font-medium text-white bg-gradient-to-r from-orange-500 to-red-500 rounded-full hover:-translate-y-0.5 hover:shadow-lg hover:shadow-orange-500/30 transition-all duration-300">Learn More</a>
            </div>
            
            <div class="group p-8 bg-white rounded-2xl shadow-lg border border-slate-100 hover:border-orange-200 hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                <h4 class="text-xl font-semibold text-slate-900 mb-4 flex items-center gap-3">
                    <i class="fa fa-briefcase text-orange-500"></i>NFP Trading
                </h4>
                <p class="text-slate-600 mb-6 leading-relaxed">Capitalize on Non-Farm Payroll market movements.</p>
                <a href="{{ route('nfp') }}" class="inline-block px-6 py-2.5 text-sm font-medium text-white bg-gradient-to-r from-orange-500 to-red-500 rounded-full hover:-translate-y-0.5 hover:shadow-lg hover:shadow-orange-500/30 transition-all duration-300">Learn More</a>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-12 sm:py-20 bg-white">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-8">
            <div class="text-center p-4 sm:p-6">
                <h2 class="text-3xl sm:text-5xl font-bold bg-gradient-to-r from-orange-500 to-indigo-600 bg-clip-text text-transparent mb-1 sm:mb-2">10K+</h2>
                <p class="text-sm sm:text-base text-slate-600 font-medium">Active Traders</p>
            </div>
            <div class="text-center p-4 sm:p-6">
                <h2 class="text-3xl sm:text-5xl font-bold bg-gradient-to-r from-orange-500 to-indigo-600 bg-clip-text text-transparent mb-1 sm:mb-2">$50M+</h2>
                <p class="text-sm sm:text-base text-slate-600 font-medium">Trading Volume</p>
            </div>
            <div class="text-center p-4 sm:p-6">
                <h2 class="text-3xl sm:text-5xl font-bold bg-gradient-to-r from-orange-500 to-indigo-600 bg-clip-text text-transparent mb-1 sm:mb-2">100+</h2>
                <p class="text-sm sm:text-base text-slate-600 font-medium">Trading Instruments</p>
            </div>
            <div class="text-center p-4 sm:p-6">
                <h2 class="text-3xl sm:text-5xl font-bold bg-gradient-to-r from-orange-500 to-indigo-600 bg-clip-text text-transparent mb-1 sm:mb-2">24/5</h2>
                <p class="text-sm sm:text-base text-slate-600 font-medium">Customer Support</p>
            </div>
        </div>
    </div>
</section>

<!-- Expect More Section -->
<section class="relative py-20 sm:py-32 overflow-hidden">
    <!-- Background Image -->
    <div class="absolute inset-0">
        <img src="{{ asset('images/building-headquarters.webp') }}" alt="Amber Tradings Headquarters" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-slate-900/70"></div>
    </div>
    <div class="container mx-auto px-4 sm:px-6 relative z-10">
        <div class="max-w-3xl">
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white mb-6 leading-tight">
                Your goals are unique to you and important to us.
            </h2>
            <p class="text-lg sm:text-xl text-white/80 leading-relaxed">
                We look beyond the numbers to create a wealth management plan tailored to your needs and ambitions.
            </p>
        </div>
    </div>
</section>

<!-- Commitment To Excellence Section -->
<section class="py-16 sm:py-24 bg-white">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="grid lg:grid-cols-2 gap-10 lg:gap-16 items-center">
            <!-- Content -->
            <div>
                <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 mb-6">
                    Commitment To Excellence
                </h2>
                <div class="flex flex-col gap-6">
                    <div class="p-6 bg-slate-50 rounded-2xl border border-slate-100 hover:border-orange-200 transition-colors">
                        <h3 class="text-xl font-bold text-slate-900 mb-2">Proven Track Record: Recognized for Excellence</h3>
                        <p class="text-slate-600 leading-relaxed">
                            Uncover our exceptional accomplishments and explore our impressive awards collection.
                        </p>
                    </div>
                    
                    <div class="p-6 bg-slate-50 rounded-2xl border border-slate-100 hover:border-orange-200 transition-colors">
                        <h3 class="text-xl font-bold text-slate-900 mb-2">Rigorous Independent Security Verification</h3>
                        <p class="text-slate-600 leading-relaxed">
                            Experts confirm we exceed all protection standards to guard your wealth.
                        </p>
                    </div>

                    <div class="p-6 bg-slate-50 rounded-2xl border border-slate-100 hover:border-orange-200 transition-colors">
                        <h3 class="text-xl font-bold text-slate-900 mb-2">Our Licensing and Registration</h3>
                        <p class="text-slate-600 leading-relaxed">
                            Regulatory compliance through extensive licensing and registrations for fully compliant and trusted operations.
                        </p>
                    </div>
                </div>
            </div>
            <!-- Certificate Image/Graphic -->
            <div class="flex justify-center lg:justify-end">
                <div class="relative">
                    <img src="{{ asset('images/cert1.webp') }}" alt="License Certificate" class="rounded-2xl shadow-xl max-w-md w-full border-8 border-white">
                    <div class="absolute -bottom-6 -right-6 w-24 h-24 bg-gradient-to-br from-orange-500 to-red-500 rounded-2xl flex items-center justify-center shadow-lg animate-bounce-slow">
                        <i class="fa fa-trophy text-4xl text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Accomplish More Section -->
<section class="py-16 sm:py-24 bg-slate-50">
    <div class="container mx-auto px-4 sm:px-6">
        <!-- Section Header -->
        <div class="text-center mb-12 sm:mb-16">
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-slate-900">Grow your wealth</h2>
        </div>

        <!-- Feature Cards Grid -->
        <div class="grid md:grid-cols-2 gap-6 sm:gap-8 mb-12 sm:mb-16">
            <!-- Card 1 - Build Wealth -->
            <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-lg hover:shadow-xl transition-shadow duration-300">
                <div class="w-14 h-14 bg-gradient-to-br from-orange-500 to-red-500 rounded-xl flex items-center justify-center mb-6">
                    <i class="fa fa-line-chart text-2xl text-white"></i>
                </div>
                <h3 class="text-xl sm:text-2xl font-bold text-slate-900 mb-3">Grow</h3>
                <h4 class="text-lg font-semibold text-orange-500 mb-4">Secure your future</h4>
                <p class="text-slate-500 italic mb-4">"I want to build my wealth to reach my goals."</p>
                <p class="text-slate-600 leading-relaxed">We'll work together to develop wealth-building strategies that focus on what's important to you, your needs and those of your family.</p>
            </div>

            <!-- Card 2 - Secure Future -->
            <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-lg hover:shadow-xl transition-shadow duration-300">
                <div class="w-14 h-14 bg-gradient-to-br from-orange-500 to-red-500 rounded-xl flex items-center justify-center mb-6">
                    <i class="fa fa-shield text-2xl text-white"></i>
                </div>
                <h3 class="text-xl sm:text-2xl font-bold text-slate-900 mb-3">Grow</h3>
                <h4 class="text-lg font-semibold text-orange-500 mb-4">Secure your future</h4>
                <p class="text-slate-500 italic mb-4">"I want to know I'm prepared for whatever may happen."</p>
                <p class="text-slate-600 leading-relaxed">Change is inevitable – and we can help you plan for it. We'll guide you through ways to help maintain and protect your wealth so you can enjoy more peace of mind.</p>
            </div>

            <!-- Card 3 - Achieve Goals -->
            <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-lg hover:shadow-xl transition-shadow duration-300">
                <div class="w-14 h-14 bg-gradient-to-br from-orange-500 to-red-500 rounded-xl flex items-center justify-center mb-6">
                    <i class="fa fa-flag-checkered text-2xl text-white"></i>
                </div>
                <h3 class="text-xl sm:text-2xl font-bold text-slate-900 mb-3">Grow</h3>
                <h4 class="text-lg font-semibold text-orange-500 mb-4">Achieve your goals</h4>
                <p class="text-slate-500 italic mb-4">"I want to live life to the fullest, today and into the future."</p>
                <p class="text-slate-600 leading-relaxed">We'll help you manage the competing needs of today and your goals for the future. With a plan in place, you can get there with confidence.</p>
            </div>

            <!-- Card 4 - Support Matters -->
            <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-lg hover:shadow-xl transition-shadow duration-300">
                <div class="w-14 h-14 bg-gradient-to-br from-orange-500 to-red-500 rounded-xl flex items-center justify-center mb-6">
                    <i class="fa fa-heart text-2xl text-white"></i>
                </div>
                <h3 class="text-xl sm:text-2xl font-bold text-slate-900 mb-3">Grow</h3>
                <h4 class="text-lg font-semibold text-orange-500 mb-4">Support what matters to you</h4>
                <p class="text-slate-500 italic mb-4">"I want to support the people and causes that I care about."</p>
                <p class="text-slate-600 leading-relaxed">Your wealth can let you do more for others. We'll help you make a difference your way – from assisting your family to responsible investing to philanthropic giving.</p>
            </div>
        </div>

        <!-- Plan for Success CTA -->
        <div class="bg-gradient-to-br from-slate-900 to-slate-800 rounded-2xl p-8 sm:p-12 text-center">
            <h3 class="text-2xl sm:text-3xl font-bold text-white mb-4">Plan for your success</h3>
            <p class="text-white/80 mb-8 max-w-2xl mx-auto">Discover a guided, bespoke approach to managing your wealth with Amber Tradings.</p>
            <a href="{{ route('contact') }}" 
               class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white bg-gradient-to-r from-orange-500 to-red-500 rounded-full shadow-lg hover:shadow-orange-500/40 hover:-translate-y-1 transition-all duration-300">
                Contact us
            </a>
        </div>
    </div>
</section>

@endsection

@section('styles')
<style>
    @keyframes fade-in {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    @keyframes fade-in-up {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .animate-fade-in {
        animation: fade-in 0.8s ease-out forwards;
    }
    
    .animate-fade-in-up {
        animation: fade-in-up 0.8s ease-out forwards;
    }
    
    @keyframes hero-zoom {
        0% { transform: scale(1); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }
    
    .animate-hero-zoom {
        animation: hero-zoom 20s ease-in-out infinite;
    }
</style>
@endsection
