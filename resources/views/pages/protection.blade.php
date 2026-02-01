@extends('layouts.app')
@section('title', 'Client Protection | Amber Tradings')

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
                Clients' <span class="text-orange-500">Segregation</span> of Funds
            </h1>
            <p class="text-lg sm:text-xl text-white/80">
                We provide services to clients in 33 countries. We always strictly abide by the regulations and the protection of our clients' investment is our primary concern. We are committed to providing a trusted and reliable trading environment for all our clients.
            </p>
        </div>
    </div>
</section>

<!-- Main Protection Features -->
<section class="py-16 sm:py-24 bg-white">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="grid lg:grid-cols-2 gap-8 max-w-6xl mx-auto">
            <!-- Regulation -->
            <div class="bg-gradient-to-br from-slate-50 to-white rounded-2xl p-8 border border-slate-100 hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-start gap-6">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center flex-shrink-0">
                        <i class="fa fa-gavel text-2xl text-white"></i>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold text-slate-900 mb-3">Regulation</h4>
                        <p class="text-slate-600 leading-relaxed">
                            Investor funds are safely deposited in separate accounts from the company's own funds and always with top-tier banks.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Segregated Funds -->
            <div class="bg-gradient-to-br from-slate-50 to-white rounded-2xl p-8 border border-slate-100 hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-start gap-6">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center flex-shrink-0">
                        <i class="fa fa-lock text-2xl text-white"></i>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold text-slate-900 mb-3">Segregated Funds</h4>
                        <p class="text-slate-600 leading-relaxed">
                            Clients' funds are segregated completely with the operational funds of the company and kept in top-tier banks. We will never use clients' funds in its operation or any other investment, ensuring their protection at all times.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Bank Partnerships -->
            <div class="bg-gradient-to-br from-slate-50 to-white rounded-2xl p-8 border border-slate-100 hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-start gap-6">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center flex-shrink-0">
                        <i class="fa fa-bank text-2xl text-white"></i>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold text-slate-900 mb-3">Bank Partnerships</h4>
                        <p class="text-slate-600 leading-relaxed">
                            We have established partnerships with several banks to ensure the safety and security of client funds.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Investor Compensation Fund -->
            <div class="bg-gradient-to-br from-slate-50 to-white rounded-2xl p-8 border border-slate-100 hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-start gap-6">
                    <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-red-500 rounded-2xl flex items-center justify-center flex-shrink-0">
                        <i class="fa fa-shield text-2xl text-white"></i>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold text-slate-900 mb-3">Investor Compensation Fund</h4>
                        <p class="text-slate-600 leading-relaxed">
                            We are a member of the Investor Compensation Fund, a scheme which serves to protect eligible retail clients and pay them relevant compensation in the event that the company fails to return funds and financial instruments belonging to those clients, due to financial problems, as applicable.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Encryption Section -->
<section class="py-16 sm:py-24 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-12">
                <div class="w-20 h-20 mx-auto mb-6 bg-gradient-to-br from-cyan-500 to-blue-500 rounded-2xl flex items-center justify-center">
                    <i class="fa fa-key text-3xl text-white"></i>
                </div>
                <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">Encryption Methods</h2>
                <p class="text-lg text-white/80 max-w-3xl mx-auto">
                    We adopted the SSL (Secure Sockets Layer) network security protocol to guarantee a secure connection for all communications with our clients, protect customers during their transactions with the company and keep all customer information private.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/10 text-center">
                    <div class="w-16 h-16 mx-auto mb-6 bg-gradient-to-br from-green-500 to-emerald-500 rounded-full flex items-center justify-center">
                        <i class="fa fa-check text-2xl text-white"></i>
                    </div>
                    <h4 class="text-lg font-semibold text-white mb-3">User Identification</h4>
                    <p class="text-white/70">
                        User identification and server authentication policies, ensure the data is sent to the right customer terminal and server.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/10 text-center">
                    <div class="w-16 h-16 mx-auto mb-6 bg-gradient-to-br from-blue-500 to-indigo-500 rounded-full flex items-center justify-center">
                        <i class="fa fa-lock text-2xl text-white"></i>
                    </div>
                    <h4 class="text-lg font-semibold text-white mb-3">Data Encryption</h4>
                    <p class="text-white/70">
                        Data transmission is encrypted to prevent data theft and unauthorized access by third parties.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/10 text-center">
                    <div class="w-16 h-16 mx-auto mb-6 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full flex items-center justify-center">
                        <i class="fa fa-shield text-2xl text-white"></i>
                    </div>
                    <h4 class="text-lg font-semibold text-white mb-3">Data Integrity</h4>
                    <p class="text-white/70">
                        Maintain data integrity and ensure that all data remain unchanged during transmission.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Transparency Section -->
<section class="py-16 sm:py-24 bg-white">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="max-w-4xl mx-auto">
            <div class="bg-gradient-to-br from-orange-50 to-amber-50 rounded-2xl p-8 sm:p-12 border border-orange-100">
                <div class="flex flex-col md:flex-row items-center gap-8">
                    <div class="flex-shrink-0">
                        <div class="w-24 h-24 bg-gradient-to-br from-orange-500 to-red-500 rounded-2xl flex items-center justify-center">
                            <i class="fa fa-eye text-4xl text-white"></i>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-slate-900 mb-4">
                            We have a sound financial status and keep transparent information practices
                        </h3>
                        <p class="text-slate-600 leading-relaxed">
                            We are committed to providing complete transparency. We meet strict financial standards, including capital adequacy levels and are required to submit financial reports periodically to our regulators.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-16 sm:py-20 bg-slate-50">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8 max-w-5xl mx-auto">
            <div class="text-center">
                <h3 class="text-4xl sm:text-5xl font-bold bg-gradient-to-r from-orange-500 to-red-500 bg-clip-text text-transparent mb-2">33</h3>
                <p class="text-slate-600 font-medium">Countries Served</p>
            </div>
            <div class="text-center">
                <h3 class="text-4xl sm:text-5xl font-bold bg-gradient-to-r from-orange-500 to-red-500 bg-clip-text text-transparent mb-2">SSL</h3>
                <p class="text-slate-600 font-medium">256-bit Encryption</p>
            </div>
            <div class="text-center">
                <h3 class="text-4xl sm:text-5xl font-bold bg-gradient-to-r from-orange-500 to-red-500 bg-clip-text text-transparent mb-2">100%</h3>
                <p class="text-slate-600 font-medium">Segregated Funds</p>
            </div>
            <div class="text-center">
                <h3 class="text-4xl sm:text-5xl font-bold bg-gradient-to-r from-orange-500 to-red-500 bg-clip-text text-transparent mb-2">ICF</h3>
                <p class="text-slate-600 font-medium">Protection Member</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 sm:py-20 bg-gradient-to-r from-orange-500 to-red-500">
    <div class="container mx-auto px-4 sm:px-6 text-center">
        <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">Trade with Confidence</h2>
        <p class="text-lg text-white/90 mb-8 max-w-2xl mx-auto">Your funds are protected with industry-leading security measures.</p>
        <a href="{{ route('register') }}" 
           class="inline-flex items-center justify-center px-10 py-4 text-lg font-semibold text-orange-500 bg-white rounded-full shadow-lg hover:bg-white/90 hover:-translate-y-1 transition-all duration-300"
           target="_blank">
            Open Account
        </a>
    </div>
</section>
@endsection
