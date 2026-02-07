@extends('layouts.app')
@section('title', 'Performance Statistics | Amber Tradings')

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
            <nav class="text-sm text-white/60">
                <a href="{{ route('home') }}" class="hover:text-orange-500 transition-colors">Home</a>
                <span class="mx-2">|</span>
                <span class="text-white">Performance Statistics</span>
            </nav>
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold text-white mb-6">
                Amber Tradings Performance <span class="text-orange-500">Statistics</span>
            </h1>
            <p class="text-lg sm:text-xl text-white/80 mb-8">
                As an established authority in forex trading, Amber Tradings performance statistics are verified and published. Our aim is not only to reset the standards and benchmarks within the forex industry, but also to create awareness and deliver the highest levels of transparency to all our clients.
            </p>
        </div>
    </div>
</section>

<!-- PwC Verification Banner -->
<section class="py-8 bg-slate-50">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="flex flex-col sm:flex-row items-center gap-6 sm:gap-10 bg-white rounded-2xl p-6 sm:p-8 shadow-lg border border-slate-100">
            <div class="flex-shrink-0">
                <img src="{{ asset('images/pwc.png') }}" alt="PricewaterhouseCoopers" class="h-14 sm:h-16 w-auto">
            </div>
            <div class="text-center sm:text-left">
                <p class="text-slate-600 leading-relaxed">
                    In line with Amber Trading's commitment to transparency, these statistics have been checked by 
                    <span class="font-semibold text-slate-800">PricewaterhouseCoopers Limited (PwC)</span> 
                    in accordance with International Standard on Assurance Engagements (ISAE) 3000.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Client Satisfaction Section -->
<section class="py-16 sm:py-24 bg-white">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 mb-4">Client Satisfaction and Services</h2>
            <p class="text-lg text-slate-600 max-w-3xl mx-auto">
                At Amber Tradings we go above and beyond to ensure that our clients receive the excellent support they deserve, making their trading experience optimal and user-friendly. From our super-fast client approval procedure to our swift client fund processing, our goal is to provide you with an outstanding service in every way.
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
            <!-- Client Approved -->
            <div class="bg-gradient-to-br from-slate-50 to-white rounded-2xl p-8 border border-slate-100 text-center hover:shadow-xl transition-shadow duration-300">
                <div class="w-20 h-20 mx-auto mb-6 bg-gradient-to-br from-orange-500 to-red-500 rounded-full flex items-center justify-center">
                    <i class="fa fa-user-check text-3xl text-white"></i>
                </div>
                <h4 class="text-lg font-semibold text-slate-600 mb-2">Client approved</h4>
                <h3 class="text-4xl sm:text-5xl font-bold text-orange-500 mb-2">Less than 12</h3>
                <p class="text-2xl font-semibold text-slate-800">mins</p>
            </div>

            <!-- Funds Processed -->
            <div class="bg-gradient-to-br from-slate-50 to-white rounded-2xl p-8 border border-slate-100 text-center hover:shadow-xl transition-shadow duration-300">
                <div class="w-20 h-20 mx-auto mb-6 bg-gradient-to-br from-orange-500 to-red-500 rounded-full flex items-center justify-center">
                    <i class="fa fa-money text-3xl text-white"></i>
                </div>
                <h4 class="text-lg font-semibold text-slate-600 mb-2">Funds Processed</h4>
                <h3 class="text-4xl sm:text-5xl font-bold text-orange-500 mb-2">More than 84%</h3>
                <p class="text-lg font-semibold text-slate-800">processed within 5 mins</p>
            </div>

            <!-- Positive Feedback -->
            <div class="bg-gradient-to-br from-slate-50 to-white rounded-2xl p-8 border border-slate-100 text-center hover:shadow-xl transition-shadow duration-300">
                <div class="w-20 h-20 mx-auto mb-6 bg-gradient-to-br from-orange-500 to-red-500 rounded-full flex items-center justify-center">
                    <i class="fa fa-thumbs-up text-3xl text-white"></i>
                </div>
                <h4 class="text-lg font-semibold text-slate-600 mb-2">Positive Feedback</h4>
                <h3 class="text-4xl sm:text-5xl font-bold text-orange-500 mb-2">More than 90%</h3>
                <p class="text-2xl font-semibold text-slate-800">Positive</p>
            </div>
        </div>
    </div>
</section>

<!-- Order Execution Speed Section -->
<section class="py-16 sm:py-24 bg-slate-50">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 mb-6">Order Execution Speed</h2>
                <p class="text-lg text-slate-600 leading-relaxed mb-6">
                    Amber Trading's award-winning order execution speeds ensure that your trading experience is superior at all times. We know that speed is crucial for you to get the best possible price, which is why we execute your trades in lightning-fast record-breaking speeds.
                </p>
                <div class="bg-white rounded-xl p-6 border border-slate-200">
                    <h4 class="font-semibold text-slate-800 mb-2">Speed of execution at Amber Tradings</h4>
                    <p class="text-slate-500 text-sm italic">*The figures above (from July 2018 onward) have been checked and confirmed by PWC.</p>
                </div>
            </div>
            <div class="bg-white rounded-2xl p-4 shadow-lg border border-slate-100">
                <!-- Placeholder for chart image - replace src with your image -->
                <div class="aspect-video bg-slate-100 rounded-xl flex items-center justify-center">
                    <img src="{{ asset('images/candle1.webp') }}" alt="Speed of execution at Amber Tradings" class="w-full h-full object-contain rounded-xl" onerror="this.style.display='none'; this.parentElement.innerHTML='<div class=\'text-center p-8\'><i class=\'fa fa-line-chart text-6xl text-slate-300 mb-4\'></i><p class=\'text-slate-400\'>Execution Speed Chart</p></div>';">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Slippage Section -->
<section class="py-16 sm:py-24 bg-white">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div class="order-2 lg:order-1 bg-white rounded-2xl p-4 shadow-lg border border-slate-100">
                <!-- Placeholder for chart image - replace src with your image -->
                <div class="aspect-video bg-slate-100 rounded-xl flex items-center justify-center">
                    <img src="{{ asset('images/candle2.webp') }}" alt="Slippage Statistics" class="w-full h-full object-contain rounded-xl" onerror="this.style.display='none'; this.parentElement.innerHTML='<div class=\'text-center p-8\'><i class=\'fa fa-bar-chart text-6xl text-slate-300 mb-4\'></i><p class=\'text-slate-400\'>Slippage Chart</p></div>';">
                </div>
            </div>
            <div class="order-1 lg:order-2">
                <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 mb-6">Slippage</h2>
                <p class="text-lg text-slate-600 leading-relaxed mb-4">
                    Giving a new meaning to slippage, Amber Trading's positive slippage statistics mean that we don't just rest by providing the requested price; we aim for best execution.
                </p>
                <p class="text-lg text-slate-600 leading-relaxed mb-6">
                    The majority of Amber Tradings clients receive improved pricing through positive slippage. In fact, it's usually even better than your initial request. Reduced negative slippage has become an Amber Tradings standard and we aim to keep it that way!
                </p>
                <div class="bg-slate-50 rounded-xl p-6 border border-slate-200">
                    <p class="text-slate-500 text-sm italic">*The figures above (from July 2018 onward) have been checked and confirmed by PWC.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Requotes Section -->
<section class="py-16 sm:py-24 bg-slate-50">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 mb-6">Requotes</h2>
                <p class="text-lg text-slate-600 leading-relaxed mb-4">
                    Amber Tradings has a deep liquidity pool available through top-tier banks and financial institutions, which allows us to fill your orders even when markets experience extra high volatility.
                </p>
                <p class="text-lg text-slate-600 leading-relaxed mb-6">
                    Our re-quote rate has already reached extremely competitive lows and we're looking to go even lower!
                </p>
                <div class="bg-white rounded-xl p-6 border border-slate-200">
                    <p class="text-slate-500 text-sm italic">*The figures above (from July 2018 onward) have been checked and confirmed by PWC.</p>
                </div>
            </div>
            <div class="bg-white rounded-2xl p-4 shadow-lg border border-slate-100">
                <!-- Placeholder for chart image - replace src with your image -->
                <div class="aspect-video bg-slate-100 rounded-xl flex items-center justify-center">
                    <img src="{{ asset('images/candle3.webp') }}" alt="Requotes Statistics" class="w-full h-full object-contain rounded-xl" onerror="this.style.display='none'; this.parentElement.innerHTML='<div class=\'text-center p-8\'><i class=\'fa fa-pie-chart text-6xl text-slate-300 mb-4\'></i><p class=\'text-slate-400\'>Requotes Chart</p></div>';">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 sm:py-20 bg-gradient-to-r from-orange-500 to-red-500">
    <div class="container mx-auto px-4 sm:px-6 text-center">
        <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">Experience Our Performance</h2>
        <p class="text-lg text-white/90 mb-8 max-w-2xl mx-auto">Start trading with an award-winning broker and see the difference for yourself.</p>
        <a href="{{ route('register') }}" 
           class="inline-flex items-center justify-center px-10 py-4 text-lg font-semibold text-orange-500 bg-white rounded-full shadow-lg hover:bg-white/90 hover:-translate-y-1 transition-all duration-300"
           target="_blank">
            Open Account
        </a>
    </div>
</section>
@endsection
