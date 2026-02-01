@extends('layouts.app')
@section('title', 'About Us | Amber Tradings')

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
            <span class="text-white">About Us</span>
        </nav>
        <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold text-white mb-6">About Amber Tradings</h1>
        <p class="text-lg sm:text-xl text-white/80 max-w-3xl mx-auto">
            Over 2 million people worldwide have chosen a global leader in online financial trading & investment. Here's why.
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
                Amber Tradings is an award-winning broker for a reason. Wherever your financial interest lies, you can rely on us to provide trading solutions to suit you. This means offering you the widest selection of instruments, platforms, account types and resources to make your trading experience as efficient and convenient as possible.
            </p>
            <p class="text-lg font-semibold text-slate-800 mb-6">
                We also offer exclusive benefits to traders who qualify as Professional Clients.
            </p>
            <p class="text-orange-500 font-medium">
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
        
        <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
            <!-- Left Column -->
            <div class="bg-white rounded-2xl p-8 shadow-lg">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center flex-shrink-0">
                        <i class="fa fa-check text-green-600 text-xl"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold text-slate-900 mb-2">Financial Authority Regulated</h4>
                        <p class="text-slate-600">Regulated by the financial authorities and Exchange Commission.</p>
                    </div>
                </div>
            </div>
            
            <!-- Right Column -->
            <div class="space-y-4">
                <div class="bg-white rounded-xl p-6 shadow-lg flex items-center gap-4">
                    <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                        <i class="fa fa-lock text-orange-500"></i>
                    </div>
                    <span class="font-medium text-slate-800">Segregation of client funds</span>
                </div>
                <div class="bg-white rounded-xl p-6 shadow-lg flex items-center gap-4">
                    <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                        <i class="fa fa-star text-orange-500"></i>
                    </div>
                    <span class="font-medium text-slate-800">Superb industry reputation</span>
                </div>
                <div class="bg-white rounded-xl p-6 shadow-lg flex items-center gap-4">
                    <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                        <i class="fa fa-heart text-orange-500"></i>
                    </div>
                    <span class="font-medium text-slate-800">Core values of trust and commitment</span>
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
        
        <div class="grid md:grid-cols-3 gap-8">
            <!-- Support Card 1 -->
            <div class="bg-gradient-to-br from-slate-50 to-white rounded-2xl p-8 border border-slate-100 hover:shadow-xl transition-shadow duration-300">
                <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-red-500 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fa fa-headphones text-2xl text-white"></i>
                </div>
                <h4 class="text-xl font-semibold text-slate-900 mb-3">Multilingual Support</h4>
                <p class="text-slate-600">Dedicated and multilingual customer support available around the clock.</p>
            </div>
            
            <!-- Support Card 2 -->
            <div class="bg-gradient-to-br from-slate-50 to-white rounded-2xl p-8 border border-slate-100 hover:shadow-xl transition-shadow duration-300">
                <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-red-500 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fa fa-user-circle text-2xl text-white"></i>
                </div>
                <h4 class="text-xl font-semibold text-slate-900 mb-3">Personal Account Managers</h4>
                <p class="text-slate-600">Multilingual and friendly personal Account Managers to guide you.</p>
            </div>
            
            <!-- Support Card 3 -->
            <div class="bg-gradient-to-br from-slate-50 to-white rounded-2xl p-8 border border-slate-100 hover:shadow-xl transition-shadow duration-300">
                <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-red-500 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fa fa-credit-card text-2xl text-white"></i>
                </div>
                <h4 class="text-xl font-semibold text-slate-900 mb-3">Flexible Payments</h4>
                <p class="text-slate-600">Wide variety of deposit and withdrawal methods for your convenience.</p>
            </div>
        </div>
    </div>
</section>

<!-- Registration Certificate Section -->
<section class="py-16 sm:py-24 bg-slate-50">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-3xl sm:text-4xl font-bold mb-6">
                    <span class="text-orange-500">Registration</span> Certificate
                </h2>
                <p class="text-lg text-slate-600 leading-relaxed mb-8">
                    Our company is fully registered and operates in compliance with all regulatory requirements. We maintain the highest standards of corporate governance and transparency.
                </p>
            </div>
            <div class="flex justify-center">
                <div class="relative">
                    <img src="{{ asset('images/cert1.webp') }}" alt="Registration Certificate" class="rounded-2xl shadow-2xl max-w-sm w-full">
                    <div class="absolute -top-4 -left-4 w-16 h-16 bg-gradient-to-br from-orange-500 to-red-500 rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fa fa-certificate text-2xl text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Global Awards Section -->
<section class="py-16 sm:py-24 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">Amber Trading's Global Awards</h2>
            <p class="text-lg text-white/70 max-w-3xl mx-auto">
                Since Amber Trading's inception, the brand has been continually partnered by many of the industry's most influential award winning brokers. This is a testament to our commitment to providing exceptional customer service, state of the art trading conditions and an outstanding experience.
            </p>
        </div>
        <div class="bg-white/5 backdrop-blur-sm rounded-2xl p-8 border border-white/10 mb-16">
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="w-20 h-20 mx-auto mb-4 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-full flex items-center justify-center">
                        <i class="fa fa-trophy text-3xl text-white"></i>
                    </div>
                    <h4 class="font-semibold text-white mb-2">Best Trading Platform</h4>
                    <p class="text-white/60 text-sm">2024</p>
                </div>
                <div class="text-center">
                    <div class="w-20 h-20 mx-auto mb-4 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-full flex items-center justify-center">
                        <i class="fa fa-star text-3xl text-white"></i>
                    </div>
                    <h4 class="font-semibold text-white mb-2">Excellence in Service</h4>
                    <p class="text-white/60 text-sm">2023</p>
                </div>
                <div class="text-center">
                    <div class="w-20 h-20 mx-auto mb-4 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-full flex items-center justify-center">
                        <i class="fa fa-shield text-3xl text-white"></i>
                    </div>
                    <h4 class="font-semibold text-white mb-2">Most Trusted Broker</h4>
                    <p class="text-white/60 text-sm">2023</p>
                </div>
                <div class="text-center">
                    <div class="w-20 h-20 mx-auto mb-4 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-full flex items-center justify-center">
                        <i class="fa fa-globe text-3xl text-white"></i>
                    </div>
                    <h4 class="font-semibold text-white mb-2">Best Global Broker</h4>
                    <p class="text-white/60 text-sm">2022</p>
                </div>
            </div>
        </div>

        <!-- More Reasons to Choose Section -->
        <div class="text-center mb-10">
            <h3 class="text-2xl sm:text-3xl font-bold text-white mb-4">More reasons to choose Amber Tradings</h3>
        </div>
        <div class="grid md:grid-cols-3 gap-8">
            <!-- Reason 1 -->
            <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/10">
                <div class="w-14 h-14 bg-gradient-to-br from-orange-500 to-red-500 rounded-xl flex items-center justify-center mb-6">
                    <i class="fa fa-graduation-cap text-2xl text-white"></i>
                </div>
                <h4 class="text-xl font-semibold text-white mb-4">Build your skills with free educational resources</h4>
                <ul class="space-y-3">
                    <li class="flex items-center gap-2 text-white/80">
                        <i class="fa fa-check text-orange-500"></i>
                        <span>Serving clients in over 150 countries worldwide</span>
                    </li>
                    <li class="flex items-center gap-2 text-white/80">
                        <i class="fa fa-check text-orange-500"></i>
                        <span>Licensed and regulated across multiple jurisdictions</span>
                    </li>
                    <li class="flex items-center gap-2 text-white/80">
                        <i class="fa fa-check text-orange-500"></i>
                        <span>Segregated funds protection provided</span>
                    </li>
                </ul>
            </div>

            <!-- Reason 2 -->
            <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/10">
                <div class="w-14 h-14 bg-gradient-to-br from-orange-500 to-red-500 rounded-xl flex items-center justify-center mb-6">
                    <i class="fa fa-desktop text-2xl text-white"></i>
                </div>
                <h4 class="text-xl font-semibold text-white mb-4">Choose the world's favourite platform, MetaTrader</h4>
                <ul class="space-y-3">
                    <li class="flex items-center gap-2 text-white/80">
                        <i class="fa fa-check text-orange-500"></i>
                        <span>Your choice of MetaTrader 4 or MetaTrader 5</span>
                    </li>
                    <li class="flex items-center gap-2 text-white/80">
                        <i class="fa fa-check text-orange-500"></i>
                        <span>Available via desktop, mobile or browser</span>
                    </li>
                    <li class="flex items-center gap-2 text-white/80">
                        <i class="fa fa-check text-orange-500"></i>
                        <span>Standard views or customise your workspace</span>
                    </li>
                </ul>
            </div>

            <!-- Reason 3 -->
            <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/10">
                <div class="w-14 h-14 bg-gradient-to-br from-orange-500 to-red-500 rounded-xl flex items-center justify-center mb-6">
                    <i class="fa fa-bolt text-2xl text-white"></i>
                </div>
                <h4 class="text-xl font-semibold text-white mb-4">Maximise your trading efficiency</h4>
                <ul class="space-y-3">
                    <li class="flex items-center gap-2 text-white/80">
                        <i class="fa fa-check text-orange-500"></i>
                        <span>Lower trading costs with tight spreads (EUR/USD from 0.1)</span>
                    </li>
                    <li class="flex items-center gap-2 text-white/80">
                        <i class="fa fa-check text-orange-500"></i>
                        <span>No hidden commissions</span>
                    </li>
                    <li class="flex items-center gap-2 text-white/80">
                        <i class="fa fa-check text-orange-500"></i>
                        <span>Plan positions accurately with superfast execution</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Performance Statistics Header -->
<section class="py-16 sm:py-24 bg-white">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 mb-6">Amber Tradings Performance Statistics</h2>
            <p class="text-lg text-slate-600 max-w-4xl mx-auto leading-relaxed">
                As an established authority in forex trading, Amber Tradings performance statistics are verified and published. Our aim is not only to reset the standards and benchmarks within the forex industry, but also to create awareness and deliver the highest levels of transparency to all our clients.
            </p>
        </div>

        <!-- Client Satisfaction -->
        <div class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-8 text-center">Client Satisfaction and Services</h3>
            <p class="text-slate-600 text-center mb-10 max-w-3xl mx-auto">
                At Amber Tradings we go above and beyond to ensure that our clients receive the excellent support they deserve, making their trading experience optimal and user-friendly.
            </p>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center p-8 bg-gradient-to-br from-slate-50 to-white rounded-2xl border border-slate-100">
                    <h3 class="text-4xl sm:text-5xl font-bold text-orange-500 mb-2">&lt;12 mins</h3>
                    <p class="text-lg font-semibold text-slate-800 mb-2">Client Approved</p>
                    <p class="text-slate-600 text-sm">Super-fast client approval procedure</p>
                </div>
                <div class="text-center p-8 bg-gradient-to-br from-slate-50 to-white rounded-2xl border border-slate-100">
                    <h3 class="text-4xl sm:text-5xl font-bold text-orange-500 mb-2">84%+</h3>
                    <p class="text-lg font-semibold text-slate-800 mb-2">Funds Processed</p>
                    <p class="text-slate-600 text-sm">Processed within 5 minutes</p>
                </div>
                <div class="text-center p-8 bg-gradient-to-br from-slate-50 to-white rounded-2xl border border-slate-100">
                    <h3 class="text-4xl sm:text-5xl font-bold text-orange-500 mb-2">90%+</h3>
                    <p class="text-lg font-semibold text-slate-800 mb-2">Positive Feedback</p>
                    <p class="text-slate-600 text-sm">Customer satisfaction rate</p>
                </div>
            </div>
        </div>

        <!-- Order Execution Speed -->
        <div class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-8 text-center">Order Execution Speed</h3>
            <p class="text-slate-600 text-center mb-10 max-w-3xl mx-auto">
                Amber Trading's award-winning order execution speeds ensure that your trading experience is superior at all times. We know that speed is crucial for you to get the best possible price.
            </p>
            <div class="bg-gradient-to-br from-orange-500 to-red-500 rounded-2xl p-8 sm:p-12 text-center">
                <h3 class="text-5xl sm:text-6xl font-bold text-white mb-4">Lightning Fast</h3>
                <p class="text-white/90 text-lg">Record-breaking execution speeds for optimal trading</p>
            </div>
        </div>

        <!-- Slippage & Requotes -->
        <div class="grid md:grid-cols-2 gap-8">
            <!-- Slippage -->
            <div class="bg-slate-50 rounded-2xl p-8">
                <h3 class="text-xl font-bold text-slate-900 mb-4">Slippage</h3>
                <p class="text-slate-600 leading-relaxed mb-4">
                    Giving a new meaning to slippage, Amber Trading's positive slippage statistics mean that we don't just rest by providing the requested price; we aim for best execution.
                </p>
                <p class="text-slate-600 leading-relaxed">
                    The majority of Amber Tradings clients receive improved pricing through positive slippage. Reduced negative slippage has become an Amber Tradings standard.
                </p>
            </div>

            <!-- Requotes -->
            <div class="bg-slate-50 rounded-2xl p-8">
                <h3 class="text-xl font-bold text-slate-900 mb-4">Requotes</h3>
                <p class="text-slate-600 leading-relaxed mb-4">
                    Amber Tradings has a deep liquidity pool available through top-tier banks and financial institutions, which allows us to fill your orders even when markets experience extra high volatility.
                </p>
                <p class="text-slate-600 leading-relaxed">
                    Our re-quote rate has already reached extremely competitive lows and we're looking to go even lower!
                </p>
            </div>
        </div>
    </div>
</section>

<!-- PwC Verification Section -->
<section class="py-12 sm:py-16 bg-slate-50">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="flex flex-col sm:flex-row items-center gap-6 sm:gap-10 bg-white rounded-2xl p-6 sm:p-10 shadow-lg border border-slate-100">
            <div class="flex-shrink-0">
                <img src="{{ asset('images/pwc-logo.webp') }}" alt="PricewaterhouseCoopers" class="h-16 sm:h-20 w-auto">
            </div>
            <div class="text-center sm:text-left">
                <p class="text-slate-600 leading-relaxed">
                    In line with Amber Trading's commitment to transparency, these statistics have been checked by 
                    <span class="font-semibold text-slate-800">PricewaterhouseCoopers Limited (PwC)</span> 
                    in accordance with International Standard on Assurance Engagements (ISAE) 3000.
                </p>
                <p class="text-slate-500 text-sm mt-2 italic">*The figures above (from July 2018 onward) have been checked and confirmed by PWC.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 sm:py-20 bg-gradient-to-r from-orange-500 to-red-500">
    <div class="container mx-auto px-4 sm:px-6 text-center">
        <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">Ready to Join Us?</h2>
        <p class="text-lg text-white/90 mb-8 max-w-2xl mx-auto">Start your trading journey with Amber Tradings today and experience the difference.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('register') }}" 
               class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-orange-500 bg-white rounded-full shadow-lg hover:bg-white/90 hover:-translate-y-1 transition-all duration-300"
               target="_blank">
                Register Now
            </a>
            <a href="{{ route('contact') }}" 
               class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white border-2 border-white rounded-full hover:bg-white/10 hover:-translate-y-1 transition-all duration-300">
                Contact Us
            </a>
        </div>
    </div>
</section>
@endsection
