@extends('layouts.app')
@section('title', 'Professional Client | Amber Tradings')

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
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold text-white mb-6">
                Trade as a <span class="text-orange-500">Professional Client</span>
            </h1>
            <nav class="text-sm text-white/60">
                <a href="{{ route('home') }}" class="hover:text-orange-500 transition-colors">Home</a>
                <span class="mx-2">|</span>
                <span class="text-white">Invest as a Professional Client</span>
            </nav>
        </div>
    </div>
</section>

<!-- Benefits Section -->
<section class="py-16 sm:py-24 bg-white">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 mb-4">
                Classifying as a Professional Client means you get
            </h2>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
            <!-- ICF Protection -->
            <div class="bg-gradient-to-br from-slate-50 to-white rounded-2xl p-8 border border-slate-100 hover:shadow-xl transition-shadow duration-300">
                <div class="w-16 h-16 mb-6 bg-gradient-to-br from-orange-500 to-red-500 rounded-2xl flex items-center justify-center">
                    <i class="fa fa-shield text-2xl text-white"></i>
                </div>
                <h4 class="text-xl font-bold text-slate-900 mb-3">ICF Protection</h4>
                <p class="text-slate-600">Professional clients are covered by the Investor Compensation Fund.</p>
            </div>

            <!-- Best Execution Policies -->
            <div class="bg-gradient-to-br from-slate-50 to-white rounded-2xl p-8 border border-slate-100 hover:shadow-xl transition-shadow duration-300">
                <div class="w-16 h-16 mb-6 bg-gradient-to-br from-orange-500 to-red-500 rounded-2xl flex items-center justify-center">
                    <i class="fa fa-bolt text-2xl text-white"></i>
                </div>
                <h4 class="text-xl font-bold text-slate-900 mb-3">Best Execution Policies</h4>
                <p class="text-slate-600">Professional clients are always prioritised above other clients with regards to our order execution policies.</p>
            </div>

            <!-- Obligations to be informed -->
            <div class="bg-gradient-to-br from-slate-50 to-white rounded-2xl p-8 border border-slate-100 hover:shadow-xl transition-shadow duration-300">
                <div class="w-16 h-16 mb-6 bg-gradient-to-br from-orange-500 to-red-500 rounded-2xl flex items-center justify-center">
                    <i class="fa fa-info-circle text-2xl text-white"></i>
                </div>
                <h4 class="text-xl font-bold text-slate-900 mb-3">Obligations to be informed</h4>
                <p class="text-slate-600">Specifically related to information related to Company, services and applicable charges (e.g. costs, commissions and fees) and other income payable to us.</p>
            </div>

            <!-- Disclaimers and risk warnings -->
            <div class="bg-gradient-to-br from-slate-50 to-white rounded-2xl p-8 border border-slate-100 hover:shadow-xl transition-shadow duration-300">
                <div class="w-16 h-16 mb-6 bg-gradient-to-br from-orange-500 to-red-500 rounded-2xl flex items-center justify-center">
                    <i class="fa fa-exclamation-triangle text-2xl text-white"></i>
                </div>
                <h4 class="text-xl font-bold text-slate-900 mb-3">Disclaimers and risk warnings</h4>
                <p class="text-slate-600">We are obligated to provide you with written risk warnings in regards to complex financial instruments (like CFDs).</p>
            </div>

            <!-- Marketing communication -->
            <div class="bg-gradient-to-br from-slate-50 to-white rounded-2xl p-8 border border-slate-100 hover:shadow-xl transition-shadow duration-300 md:col-span-2 lg:col-span-1">
                <div class="w-16 h-16 mb-6 bg-gradient-to-br from-orange-500 to-red-500 rounded-2xl flex items-center justify-center">
                    <i class="fa fa-bullhorn text-2xl text-white"></i>
                </div>
                <h4 class="text-xl font-bold text-slate-900 mb-3">Marketing communication</h4>
                <p class="text-slate-600">We are obligated to comply with relevant legislation relating to marketing communication.</p>
            </div>
        </div>

        <div class="text-center mt-10">
            <p class="text-slate-600">
                Please make sure you are familiar with our 
                <a href="#" class="text-orange-500 hover:underline font-medium">full terms and conditions</a>.
            </p>
        </div>
    </div>
</section>

<!-- Qualification Section -->
<section class="relative py-16 sm:py-24 overflow-hidden">
    <!-- Background Image -->
    <div class="absolute inset-0">
        <img src="{{ asset('images/building-headquarters.webp') }}" alt="" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-slate-900/85"></div>
    </div>
    <div class="container mx-auto px-4 sm:px-6 relative z-10">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">
                    Do you qualify as a Professional Client?
                </h2>
                <p class="text-lg text-white/80">
                    You must be able to answer 'yes' to at least two of the following questions:
                </p>
            </div>

            <div class="space-y-6">
                <!-- Question 1 -->
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 bg-orange-500 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-white font-bold">1</span>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-white">Have you invested with us?</h4>
                        </div>
                    </div>
                </div>

                <!-- Question 2 -->
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 bg-orange-500 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-white font-bold">2</span>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-white">Do you have at least one year of professional work experience in the financial sector, where knowledge of transactions or services in CFDs was required?</h4>
                        </div>
                    </div>
                </div>

                <!-- Question 3 -->
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 bg-orange-500 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-white font-bold">3</span>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-white">Does the size of your portfolio (including cash and financial instruments) exceed 500 Euros?</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Loyalty Programme Section -->
<section class="py-16 sm:py-24 bg-white">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="grid lg:grid-cols-2 gap-12 items-center max-w-6xl mx-auto">
            <div>
                <span class="inline-block px-4 py-2 text-sm font-medium text-orange-500 bg-orange-100 rounded-full mb-6">Exclusive Benefits</span>
                <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 mb-6">The Loyalty Programme</h2>
                <p class="text-lg text-slate-600 mb-8">
                    Get more value for your dollar as a professional client with us
                </p>

                <div class="space-y-4">
                    <div class="flex items-start gap-4">
                        <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                            <i class="fa fa-check text-green-500"></i>
                        </div>
                        <p class="text-slate-700">Access loyalty rewards as a professional client (T&Cs apply)</p>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                            <i class="fa fa-check text-green-500"></i>
                        </div>
                        <p class="text-slate-700">Trade your favourite FX, commodity and precious metal CFDs to earn loyalty</p>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                            <i class="fa fa-check text-green-500"></i>
                        </div>
                        <p class="text-slate-700">Work up through five loyalty levels with larger rewards at every stage</p>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                            <i class="fa fa-check text-green-500"></i>
                        </div>
                        <p class="text-slate-700">Use your rewards for trading or withdraw them at any time</p>
                    </div>
                </div>

                <p class="text-slate-500 mt-8 text-sm italic">
                    Please contact us for full details and T&Cs regarding the Loyalty Programme.
                </p>
            </div>

            <div class="bg-gradient-to-br from-slate-900 to-slate-800 rounded-2xl p-8 sm:p-12 text-center">
                <div class="w-24 h-24 mx-auto mb-8 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-full flex items-center justify-center">
                    <i class="fa fa-star text-4xl text-white"></i>
                </div>
                <h3 class="text-2xl font-bold text-white mb-4">5 Loyalty Levels</h3>
                <p class="text-white/80 mb-8">Unlock greater rewards as you progress through our exclusive loyalty programme</p>
                <div class="flex justify-center gap-2">
                    <div class="w-10 h-10 bg-amber-600 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-sm">1</span>
                    </div>
                    <div class="w-10 h-10 bg-amber-500 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-sm">2</span>
                    </div>
                    <div class="w-10 h-10 bg-yellow-500 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-sm">3</span>
                    </div>
                    <div class="w-10 h-10 bg-yellow-400 rounded-lg flex items-center justify-center">
                        <span class="text-slate-900 font-bold text-sm">4</span>
                    </div>
                    <div class="w-10 h-10 bg-gradient-to-br from-yellow-300 to-yellow-100 rounded-lg flex items-center justify-center">
                        <span class="text-slate-900 font-bold text-sm">5</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 sm:py-20 bg-gradient-to-r from-orange-500 to-red-500">
    <div class="container mx-auto px-4 sm:px-6 text-center">
        <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">Are you a Professional Client?</h2>
        <p class="text-lg text-white/90 mb-8 max-w-2xl mx-auto">Apply to find out and unlock exclusive benefits and rewards.</p>
        <a href="{{ route('login') }}" 
           class="inline-flex items-center justify-center px-10 py-4 text-lg font-semibold text-orange-500 bg-white rounded-full shadow-lg hover:bg-white/90 hover:-translate-y-1 transition-all duration-300"
           target="_blank">
            Login To Begin
        </a>
    </div>
</section>
@endsection
