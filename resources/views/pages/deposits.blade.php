@extends('layouts.app')
@section('title', 'Deposits & Withdrawals | Amber Tradings')

@section('content')
<!-- Hero Section -->
<section class="relative pt-32 pb-20 sm:pb-28 overflow-hidden">
    <!-- Background Image -->
    <div class="absolute inset-0">
        <img src="{{ asset('images/hero-deposits.webp') }}" alt="" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-slate-900/90 to-slate-900/70"></div>
    </div>
    <div class="container mx-auto px-4 sm:px-6 relative z-10">
        <div class="max-w-4xl mx-auto text-center">

            <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold text-white mb-6">
                Deposits & <span class="text-orange-500">Withdrawals</span>
            </h1>
            <p class="text-lg sm:text-xl text-white/80">
                At Amber-Tradings, making deposits and withdrawals is simple and straight forward. That means you have more time to concentrate on the markets and the next trading opportunity.
            </p>
        </div>
    </div>
</section>

<!-- Key Benefits Section -->
<section class="py-16 sm:py-24 bg-white">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="max-w-4xl mx-auto">
            <div class="space-y-6">
                <div class="flex items-start gap-4 p-6 bg-slate-50 rounded-2xl hover:shadow-lg transition-shadow duration-300">
                    <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center flex-shrink-0">
                        <i class="fa fa-rocket text-green-500 text-xl"></i>
                    </div>
                    <p class="text-lg text-slate-700">
                        We constantly strive to provide you with <span class="font-semibold text-slate-900">fast and secure ways</span> to fund your account and make withdrawals
                    </p>
                </div>

                <div class="flex items-start gap-4 p-6 bg-slate-50 rounded-2xl hover:shadow-lg transition-shadow duration-300">
                    <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center flex-shrink-0">
                        <i class="fa fa-tag text-orange-500 text-xl"></i>
                    </div>
                    <p class="text-lg text-slate-700">
                        There are <span class="font-semibold text-orange-500">no deposit fees</span>
                    </p>
                </div>

                <div class="flex items-start gap-4 p-6 bg-slate-50 rounded-2xl hover:shadow-lg transition-shadow duration-300">
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center flex-shrink-0">
                        <i class="fa fa-shield text-blue-500 text-xl"></i>
                    </div>
                    <p class="text-lg text-slate-700">
                        The <span class="font-semibold text-slate-900">safety of your funds</span> is our primary concern, so you can rest assured that your money is always handled prudently and responsibly
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Fixed Background Parallax Section -->
<section class="relative py-32 overflow-hidden">
    <div class="absolute inset-0" style="background-image: url('{{ asset('images/building-headquarters.webp') }}'); background-attachment: fixed; background-position: center; background-repeat: no-repeat; background-size: cover;"></div>
    <div class="absolute inset-0 bg-slate-900/80"></div>
    <div class="container mx-auto px-4 sm:px-6 relative z-10">
        <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
            <!-- Worldwide Regulation -->
            <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/20 hover:bg-white/15 transition-colors duration-300">
                <div class="w-16 h-16 mb-6 bg-gradient-to-br from-blue-500 to-indigo-500 rounded-2xl flex items-center justify-center">
                    <i class="fa fa-globe text-2xl text-white"></i>
                </div>
                <h4 class="text-xl font-bold text-white mb-4">Worldwide Regulation</h4>
                <p class="text-white/80 leading-relaxed">
                    We are authorised and regulated to operate across multiple jurisdictions. Over two million clients have used our services worldwide across 180 countries. We have a superb industry reputation, with our core values of trust and commitment central to our ethos.
                </p>
            </div>

            <!-- Funds Protection -->
            <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/20 hover:bg-white/15 transition-colors duration-300">
                <div class="w-16 h-16 mb-6 bg-gradient-to-br from-green-500 to-emerald-500 rounded-2xl flex items-center justify-center">
                    <i class="fa fa-lock text-2xl text-white"></i>
                </div>
                <h4 class="text-xl font-bold text-white mb-4">Funds Protection</h4>
                <p class="text-white/80 leading-relaxed">
                    Wherever you are in the world, we hold your funds with top tier banks. These regulated institutions are fully segregated from the assets of us. We do not use any client funds or assets for business activities of the company.
                </p>
            </div>

            <!-- Customer Support -->
            <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/20 hover:bg-white/15 transition-colors duration-300">
                <div class="w-16 h-16 mb-6 bg-gradient-to-br from-orange-500 to-red-500 rounded-2xl flex items-center justify-center">
                    <i class="fa fa-headphones text-2xl text-white"></i>
                </div>
                <h4 class="text-xl font-bold text-white mb-4">Customer Support</h4>
                <p class="text-white/80 leading-relaxed">
                    We have a dedicated, multilingual Customer Support team available to help you fund your trading account. Our knowledgeable and friendly personal account managers offer exemplary service to all our clients and partners, no matter how big or small.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Payment Methods Section -->
<section class="py-16 sm:py-24 bg-white">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 mb-4">Payment Methods</h2>
            <p class="text-lg text-slate-600">Choose your preferred way to fund your account</p>
        </div>

        <!-- Payment Method Cards -->
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8 max-w-5xl mx-auto mb-16">
            <!-- Credit Card -->
            <div class="bg-gradient-to-br from-slate-50 to-white rounded-2xl p-8 shadow-lg hover:shadow-xl hover:-translate-y-2 transition-all duration-300 border border-slate-100 text-center">
                <div class="w-20 h-20 bg-gradient-to-br from-orange-500 to-red-500 rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <i class="fa fa-credit-card text-3xl text-white"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">Credit/Debit Card</h3>
                <p class="text-slate-600">Instant deposits with Visa and Mastercard</p>
            </div>

            <!-- Bank Transfer -->
            <div class="bg-gradient-to-br from-slate-50 to-white rounded-2xl p-8 shadow-lg hover:shadow-xl hover:-translate-y-2 transition-all duration-300 border border-slate-100 text-center">
                <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-indigo-500 rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <i class="fa fa-university text-3xl text-white"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">Bank Transfer</h3>
                <p class="text-slate-600">Secure wire transfers from your bank</p>
            </div>

            <!-- Cryptocurrency -->
            <div class="bg-gradient-to-br from-slate-50 to-white rounded-2xl p-8 shadow-lg hover:shadow-xl hover:-translate-y-2 transition-all duration-300 border border-slate-100 text-center">
                <div class="w-20 h-20 bg-gradient-to-br from-yellow-500 to-orange-500 rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <i class="fa fa-bitcoin text-3xl text-white"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">Cryptocurrency</h3>
                <p class="text-slate-600">Deposit using Bitcoin and other cryptos</p>
            </div>
        </div>

        <!-- Info Table -->
        <div class="bg-slate-50 rounded-2xl overflow-hidden max-w-4xl mx-auto shadow-lg">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gradient-to-r from-slate-900 to-slate-800 text-white">
                            <th class="px-6 py-4 text-left font-semibold">Method</th>
                            <th class="px-6 py-4 text-left font-semibold">Processing Time</th>
                            <th class="px-6 py-4 text-left font-semibold">Minimum</th>
                            <th class="px-6 py-4 text-left font-semibold">Fees</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        <tr class="hover:bg-slate-100 transition-colors bg-white">
                            <td class="px-6 py-4 text-slate-700 font-medium">Credit/Debit Card</td>
                            <td class="px-6 py-4 text-slate-600">Instant</td>
                            <td class="px-6 py-4 text-slate-600">$50</td>
                            <td class="px-6 py-4 text-green-600 font-semibold">Free</td>
                        </tr>
                        <tr class="hover:bg-slate-100 transition-colors bg-white">
                            <td class="px-6 py-4 text-slate-700 font-medium">Bank Transfer</td>
                            <td class="px-6 py-4 text-slate-600">1-3 Business Days</td>
                            <td class="px-6 py-4 text-slate-600">$100</td>
                            <td class="px-6 py-4 text-green-600 font-semibold">Free</td>
                        </tr>
                        <tr class="hover:bg-slate-100 transition-colors bg-white">
                            <td class="px-6 py-4 text-slate-700 font-medium">Cryptocurrency</td>
                            <td class="px-6 py-4 text-slate-600">Network Confirmation</td>
                            <td class="px-6 py-4 text-slate-600">$50</td>
                            <td class="px-6 py-4 text-green-600 font-semibold">Free</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 sm:py-20 bg-gradient-to-r from-orange-500 to-red-500">
    <div class="container mx-auto px-4 sm:px-6 text-center">
        <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">Start your investment journey today.</h2>
        <p class="text-lg text-white/90 mb-8 max-w-2xl mx-auto">Fund your account and begin trading with Amber Tradings.</p>
        <a href="https://portal.ambertradings.com/register" 
           class="inline-flex items-center justify-center px-10 py-4 text-lg font-semibold text-orange-500 bg-white rounded-full shadow-lg hover:bg-white/90 hover:-translate-y-1 transition-all duration-300"
           target="_blank">
            Open Account
        </a>
    </div>
</section>
@endsection
