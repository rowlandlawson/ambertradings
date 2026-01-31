@extends('layouts.app')
@section('title', 'Global Awards | Amber Tradings')

@section('content')
<!-- Hero Section -->
<section class="relative pt-32 pb-20 sm:pb-28 overflow-hidden">
    <!-- Background -->
    <div class="absolute inset-0">
        <img src="{{ asset('images/hero-about.webp') }}" alt="" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-slate-900/90 to-slate-900/70"></div>
    </div>
    <div class="container mx-auto px-4 sm:px-6 text-center relative z-10">
        <div class="w-24 h-24 mx-auto mb-8 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-full flex items-center justify-center">
            <i class="fa fa-trophy text-4xl text-white"></i>
        </div>
        <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold text-white mb-6">Amber Trading's Global Awards</h1>
        <p class="text-lg sm:text-xl text-white/80 max-w-3xl mx-auto">
            Since Amber Trading's inception, the brand has been continually partnered by many of the industry's most influential award winning brokers.
        </p>
    </div>
</section>

<!-- Introduction Section -->
<section class="py-16 sm:py-20 bg-white">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="max-w-4xl mx-auto text-center">
            <p class="text-lg sm:text-xl text-slate-600 leading-relaxed mb-6">
                This is a testament to our commitment to providing exceptional customer service, state of the art trading conditions and - above all - an outstanding experience.
            </p>
            <p class="text-lg font-semibold text-slate-800">
                We are honored by every accolade we receive, while our dedication to our clients and partners grows stronger.
            </p>
        </div>
    </div>
</section>

<!-- Awards Grid Section -->
<section class="py-16 sm:py-24 bg-slate-50">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 mb-4">Our Achievements</h2>
            <p class="text-lg text-slate-600">Recognized excellence across multiple categories</p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Award 1 - FX Empire -->
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-2 border border-slate-100">
                <div class="w-20 h-20 mx-auto mb-6 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-2xl flex items-center justify-center">
                    <i class="fa fa-trophy text-3xl text-white"></i>
                </div>
                <div class="text-center">
                    <span class="inline-block px-3 py-1 bg-orange-100 text-orange-600 text-sm font-medium rounded-full mb-4">FX Empire</span>
                    <h4 class="text-xl font-bold text-slate-900 mb-2">Best Trading Platform</h4>
                    <p class="text-orange-500 font-semibold mb-3">2024</p>
                    <p class="text-slate-600 text-sm">Recognized for innovative trading technology and exceptional user experience.</p>
                </div>
            </div>

            <!-- Award 2 - Global Investor MENA -->
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-2 border border-slate-100">
                <div class="w-20 h-20 mx-auto mb-6 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-2xl flex items-center justify-center">
                    <i class="fa fa-star text-3xl text-white"></i>
                </div>
                <div class="text-center">
                    <span class="inline-block px-3 py-1 bg-orange-100 text-orange-600 text-sm font-medium rounded-full mb-4">Global Investor MENA</span>
                    <h4 class="text-xl font-bold text-slate-900 mb-2">Excellence in Service</h4>
                    <p class="text-orange-500 font-semibold mb-3">2023</p>
                    <p class="text-slate-600 text-sm">Awarded for outstanding client support and highest satisfaction rates.</p>
                </div>
            </div>

            <!-- Award 3 - European Magazine -->
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-2 border border-slate-100">
                <div class="w-20 h-20 mx-auto mb-6 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-2xl flex items-center justify-center">
                    <i class="fa fa-globe text-3xl text-white"></i>
                </div>
                <div class="text-center">
                    <span class="inline-block px-3 py-1 bg-orange-100 text-orange-600 text-sm font-medium rounded-full mb-4">The European Magazine</span>
                    <h4 class="text-xl font-bold text-slate-900 mb-2">Best Global Broker</h4>
                    <p class="text-orange-500 font-semibold mb-3">2023</p>
                    <p class="text-slate-600 text-sm">Recognized for global reach and exceptional trading conditions.</p>
                </div>
            </div>

            <!-- Award 4 - World Finance -->
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-2 border border-slate-100">
                <div class="w-20 h-20 mx-auto mb-6 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-2xl flex items-center justify-center">
                    <i class="fa fa-shield text-3xl text-white"></i>
                </div>
                <div class="text-center">
                    <span class="inline-block px-3 py-1 bg-orange-100 text-orange-600 text-sm font-medium rounded-full mb-4">World Finance</span>
                    <h4 class="text-xl font-bold text-slate-900 mb-2">Most Trusted Broker</h4>
                    <p class="text-orange-500 font-semibold mb-3">2022</p>
                    <p class="text-slate-600 text-sm">Awarded for security, transparency, and reliability in trading.</p>
                </div>
            </div>

            <!-- Award 5 - World Finance -->
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-2 border border-slate-100">
                <div class="w-20 h-20 mx-auto mb-6 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-2xl flex items-center justify-center">
                    <i class="fa fa-line-chart text-3xl text-white"></i>
                </div>
                <div class="text-center">
                    <span class="inline-block px-3 py-1 bg-orange-100 text-orange-600 text-sm font-medium rounded-full mb-4">World Finance</span>
                    <h4 class="text-xl font-bold text-slate-900 mb-2">Best Trading Conditions</h4>
                    <p class="text-orange-500 font-semibold mb-3">2022</p>
                    <p class="text-slate-600 text-sm">Recognized for competitive spreads and superior execution speeds.</p>
                </div>
            </div>

            <!-- Award 6 - Industry Choice -->
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-2 border border-slate-100">
                <div class="w-20 h-20 mx-auto mb-6 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-2xl flex items-center justify-center">
                    <i class="fa fa-users text-3xl text-white"></i>
                </div>
                <div class="text-center">
                    <span class="inline-block px-3 py-1 bg-orange-100 text-orange-600 text-sm font-medium rounded-full mb-4">Industry Choice</span>
                    <h4 class="text-xl font-bold text-slate-900 mb-2">Best Customer Support</h4>
                    <p class="text-orange-500 font-semibold mb-3">2021</p>
                    <p class="text-slate-600 text-sm">Awarded for 24/5 multilingual support and client satisfaction.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- More Reasons Section -->
<section class="py-16 sm:py-24 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">More reasons to choose Amber Tradings</h2>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <!-- Reason 1 -->
            <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/10 hover:bg-white/15 transition-colors duration-300">
                <div class="w-14 h-14 bg-gradient-to-br from-orange-500 to-red-500 rounded-xl flex items-center justify-center mb-6">
                    <i class="fa fa-graduation-cap text-2xl text-white"></i>
                </div>
                <h4 class="text-xl font-semibold text-white mb-4">Build your skills with free educational resources</h4>
                <ul class="space-y-3">
                    <li class="flex items-start gap-3 text-white/80">
                        <i class="fa fa-check text-orange-500 mt-1"></i>
                        <span>Serving clients in over 150 countries worldwide</span>
                    </li>
                    <li class="flex items-start gap-3 text-white/80">
                        <i class="fa fa-check text-orange-500 mt-1"></i>
                        <span>Licensed and regulated across multiple jurisdictions</span>
                    </li>
                    <li class="flex items-start gap-3 text-white/80">
                        <i class="fa fa-check text-orange-500 mt-1"></i>
                        <span>Segregated funds protection provided</span>
                    </li>
                </ul>
            </div>

            <!-- Reason 2 -->
            <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/10 hover:bg-white/15 transition-colors duration-300">
                <div class="w-14 h-14 bg-gradient-to-br from-orange-500 to-red-500 rounded-xl flex items-center justify-center mb-6">
                    <i class="fa fa-desktop text-2xl text-white"></i>
                </div>
                <h4 class="text-xl font-semibold text-white mb-4">Choose the world's favourite platform, MetaTrader</h4>
                <ul class="space-y-3">
                    <li class="flex items-start gap-3 text-white/80">
                        <i class="fa fa-check text-orange-500 mt-1"></i>
                        <span>Your choice of MetaTrader 4 or MetaTrader 5</span>
                    </li>
                    <li class="flex items-start gap-3 text-white/80">
                        <i class="fa fa-check text-orange-500 mt-1"></i>
                        <span>Available via desktop, mobile or browser</span>
                    </li>
                    <li class="flex items-start gap-3 text-white/80">
                        <i class="fa fa-check text-orange-500 mt-1"></i>
                        <span>Standard views or customise your workspace</span>
                    </li>
                </ul>
            </div>

            <!-- Reason 3 -->
            <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/10 hover:bg-white/15 transition-colors duration-300">
                <div class="w-14 h-14 bg-gradient-to-br from-orange-500 to-red-500 rounded-xl flex items-center justify-center mb-6">
                    <i class="fa fa-bolt text-2xl text-white"></i>
                </div>
                <h4 class="text-xl font-semibold text-white mb-4">Maximise your trading efficiency</h4>
                <ul class="space-y-3">
                    <li class="flex items-start gap-3 text-white/80">
                        <i class="fa fa-check text-orange-500 mt-1"></i>
                        <span>Lower trading costs with tight spreads (EUR/USD from 0.1)</span>
                    </li>
                    <li class="flex items-start gap-3 text-white/80">
                        <i class="fa fa-check text-orange-500 mt-1"></i>
                        <span>No hidden commissions</span>
                    </li>
                    <li class="flex items-start gap-3 text-white/80">
                        <i class="fa fa-check text-orange-500 mt-1"></i>
                        <span>Plan positions accurately with superfast execution</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 sm:py-20 bg-gradient-to-r from-orange-500 to-red-500">
    <div class="container mx-auto px-4 sm:px-6 text-center">
        <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">Start Trading with an Award-Winning Broker</h2>
        <p class="text-lg text-white/90 mb-8 max-w-2xl mx-auto">Join millions of traders who trust Amber Tradings for their investment needs.</p>
        <a href="https://portal.ambertradings.com/register" 
           class="inline-flex items-center justify-center px-10 py-4 text-lg font-semibold text-orange-500 bg-white rounded-full shadow-lg hover:bg-white/90 hover:-translate-y-1 transition-all duration-300"
           target="_blank">
            Register Now
        </a>
    </div>
</section>
@endsection
