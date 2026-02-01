@extends('layouts.app')
@section('title', 'It\'s Your World. Trade It. | Amber Tradings')

@section('content')
<!-- Hero Section -->
<section class="relative pt-32 pb-20 sm:pb-28 overflow-hidden">
    <!-- Background -->
    <div class="absolute inset-0">
        <img src="{{ asset('images/hero-about.webp') }}" alt="" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-slate-900/90 to-slate-900/70"></div>
    </div>
    <div class="container mx-auto px-4 sm:px-6 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold text-white mb-6">
                It's Your World. <span class="text-orange-500">Trade It.</span>
            </h1>
            <div class="flex flex-wrap justify-center gap-4 sm:gap-6 mt-10">
                <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 text-white/80 hover:text-orange-500 transition-colors">
                    <span class="font-medium">NEED HELP?</span>
                    <span class="text-orange-500 font-semibold">CONTACT US</span>
                </a>
                <div class="flex items-center gap-4">
                    <span class="text-white/60">CONNECT</span>
                    <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-orange-500 transition-colors">
                        <i class="fa fa-linkedin text-white"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-red-500 transition-colors">
                        <i class="fa fa-youtube-play text-white"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Trading Categories Section -->
<section class="py-16 sm:py-24 bg-white">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="text-center mb-12">
            <span class="inline-block px-4 py-2 text-sm font-medium text-orange-500 bg-orange-100 rounded-full mb-4">Explore Markets</span>
            <h2 class="text-3xl sm:text-4xl font-bold text-slate-900">Tell me more about the</h2>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-5xl mx-auto">
            <!-- Forex -->
            <a href="{{ route('forex') }}" class="group bg-gradient-to-br from-slate-50 to-white rounded-2xl p-6 border border-slate-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-orange-500 to-red-500 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <i class="fa fa-dollar text-2xl text-white"></i>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold text-slate-900 group-hover:text-orange-500 transition-colors">Forex</h4>
                        <p class="text-slate-500 text-sm">Currency Trading</p>
                    </div>
                    <i class="fa fa-arrow-right text-slate-300 group-hover:text-orange-500 ml-auto transition-colors"></i>
                </div>
            </a>

            <!-- Commodities -->
            <a href="{{ route('commodities') }}" class="group bg-gradient-to-br from-slate-50 to-white rounded-2xl p-6 border border-slate-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-orange-500 to-red-500 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <i class="fa fa-cubes text-2xl text-white"></i>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold text-slate-900 group-hover:text-orange-500 transition-colors">Commodities</h4>
                        <p class="text-slate-500 text-sm">Raw Materials</p>
                    </div>
                    <i class="fa fa-arrow-right text-slate-300 group-hover:text-orange-500 ml-auto transition-colors"></i>
                </div>
            </a>

            <!-- Indices -->
            <a href="{{ route('indices') }}" class="group bg-gradient-to-br from-slate-50 to-white rounded-2xl p-6 border border-slate-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-orange-500 to-red-500 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <i class="fa fa-bar-chart text-2xl text-white"></i>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold text-slate-900 group-hover:text-orange-500 transition-colors">Indices</h4>
                        <p class="text-slate-500 text-sm">Market Indices</p>
                    </div>
                    <i class="fa fa-arrow-right text-slate-300 group-hover:text-orange-500 ml-auto transition-colors"></i>
                </div>
            </a>

            <!-- NFP -->
            <a href="{{ route('nfp') }}" class="group bg-gradient-to-br from-slate-50 to-white rounded-2xl p-6 border border-slate-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-orange-500 to-red-500 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <i class="fa fa-calendar text-2xl text-white"></i>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold text-slate-900 group-hover:text-orange-500 transition-colors">NFP</h4>
                        <p class="text-slate-500 text-sm">Non-Farm Payroll</p>
                    </div>
                    <i class="fa fa-arrow-right text-slate-300 group-hover:text-orange-500 ml-auto transition-colors"></i>
                </div>
            </a>

            <!-- CFD Stocks -->
            <a href="{{ route('stocks') }}" class="group bg-gradient-to-br from-slate-50 to-white rounded-2xl p-6 border border-slate-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-orange-500 to-red-500 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <i class="fa fa-line-chart text-2xl text-white"></i>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold text-slate-900 group-hover:text-orange-500 transition-colors">CFD Stocks</h4>
                        <p class="text-slate-500 text-sm">Stock Trading</p>
                    </div>
                    <i class="fa fa-arrow-right text-slate-300 group-hover:text-orange-500 ml-auto transition-colors"></i>
                </div>
            </a>

            <!-- Cryptocurrency -->
            <a href="{{ route('cryptocurrency') }}" class="group bg-gradient-to-br from-slate-50 to-white rounded-2xl p-6 border border-slate-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-orange-500 to-red-500 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <i class="fa fa-bitcoin text-2xl text-white"></i>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold text-slate-900 group-hover:text-orange-500 transition-colors">Cryptocurrency</h4>
                        <p class="text-slate-500 text-sm">Digital Assets</p>
                    </div>
                    <i class="fa fa-arrow-right text-slate-300 group-hover:text-orange-500 ml-auto transition-colors"></i>
                </div>
            </a>
        </div>
    </div>
</section>

<!-- Learning Resources Section -->
<section class="py-16 sm:py-24 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="text-center mb-12">
            <span class="inline-block px-4 py-2 text-sm font-medium text-orange-400 bg-orange-500/10 rounded-full mb-4">Educational Resources</span>
            <h2 class="text-3xl sm:text-4xl font-bold text-white">I would like to know about</h2>
        </div>

        <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
            <!-- Emotional Intelligence -->
            <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/10 hover:bg-white/15 transition-colors duration-300">
                <div class="w-16 h-16 mb-6 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center">
                    <i class="fa fa-heart text-2xl text-white"></i>
                </div>
                <h4 class="text-xl font-bold text-white mb-3">Emotional Intelligence</h4>
                <p class="text-white/70 mb-4">Master the psychology behind successful trading decisions.</p>
                <a href="#" class="text-orange-400 hover:text-orange-300 font-medium inline-flex items-center gap-2">
                    Learn More <i class="fa fa-arrow-right"></i>
                </a>
            </div>

            <!-- Successful Trader -->
            <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/10 hover:bg-white/15 transition-colors duration-300">
                <div class="w-16 h-16 mb-6 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-2xl flex items-center justify-center">
                    <i class="fa fa-user-circle text-2xl text-white"></i>
                </div>
                <h4 class="text-xl font-bold text-white mb-3">What makes a successful trader?</h4>
                <p class="text-white/70 mb-4">Discover the traits and habits of top-performing traders.</p>
                <a href="#" class="text-orange-400 hover:text-orange-300 font-medium inline-flex items-center gap-2">
                    Learn More <i class="fa fa-arrow-right"></i>
                </a>
            </div>

            <!-- Bitcoin -->
            <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/10 hover:bg-white/15 transition-colors duration-300">
                <div class="w-16 h-16 mb-6 bg-gradient-to-br from-yellow-500 to-orange-500 rounded-2xl flex items-center justify-center">
                    <i class="fa fa-bitcoin text-2xl text-white"></i>
                </div>
                <h4 class="text-xl font-bold text-white mb-3">What is Bitcoin & How to buy Bitcoin</h4>
                <p class="text-white/70 mb-4">Your complete guide to understanding and trading Bitcoin.</p>
                <a href="{{ route('cryptocurrency') }}" class="text-orange-400 hover:text-orange-300 font-medium inline-flex items-center gap-2">
                    Learn More <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Disclaimer Section -->
<section class="py-16 sm:py-20 bg-slate-50">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="max-w-4xl mx-auto text-center">
            <div class="mb-8">
                <img src="{{ asset('images/logo.webp') }}" alt="Amber Tradings" class="h-12 mx-auto mb-6" onerror="this.style.display='none'">
                <p class="text-slate-600 leading-relaxed">
                    This website is operated and maintained by <span class="font-semibold text-slate-800">Amber Tradings</span>.
                </p>
            </div>
            <div class="bg-white rounded-2xl p-8 shadow-lg border border-slate-100">
                <p class="text-slate-500 text-sm leading-relaxed mb-4">
                    Unless otherwise specified, all return figures shown above are for illustrative purposes only, and are not actual customer or model returns. Actual returns will vary greatly and depend on personal and market circumstances. Amber Tradings internet-based services are designed to assist clients in achieving discrete financial goals.
                </p>
                <p class="text-slate-600 font-medium">
                    <i class="fa fa-map-marker text-orange-500 mr-2"></i>
                    Amber Tradings is located at Kent House 14-17 Market Place, London W1W 8AJ, United Kingdom.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 sm:py-20 bg-gradient-to-r from-orange-500 to-red-500">
    <div class="container mx-auto px-4 sm:px-6 text-center">
        <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">Start Your Trading Journey</h2>
        <p class="text-lg text-white/90 mb-8 max-w-2xl mx-auto">Join millions of traders worldwide who trust Amber Tradings.</p>
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
