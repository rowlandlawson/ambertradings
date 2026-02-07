<!-- Footer -->
<footer class="bg-slate-950 text-white">
    <!-- Backed By The Best -->
    <div class="border-b border-white/10 bg-slate-900/50">
        <div class="w-full px-4 sm:px-8 py-10">
            <div class="text-center mb-8">
                <h4 class="text-lg font-semibold text-white/90">Backed By The Best</h4>
                <p class="text-sm text-slate-400 mt-2">Partnered with industry leaders to ensure your success</p>
            </div>
            <div class="flex flex-wrap justify-center items-center gap-6 sm:gap-8 opacity-90">
                @foreach(range(1, 18) as $i)
                 <div class="w-24 sm:w-28 h-12 flex items-center justify-center bg-transparent rounded-lg p-2 hover:scale-105 transition-transform duration-300">
                    <img src="{{ asset('images/b'.$i.'.png') }}" alt="Partner {{ $i }}" class="max-w-full max-h-full object-contain filter grayscale hover:grayscale-0 transition-all duration-300">
                 </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Main Footer -->
    <div class="w-full px-4 sm:px-8 py-12 sm:py-16">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 lg:gap-12">
            <!-- Company Info -->
            <div class="col-span-2 md:col-span-1">
                <a href="{{ route('home') }}" class="inline-block mb-6">
                    <img src="{{ asset('images/logo.webp') }}" alt="Amber Tradings" class="h-10">
                </a>
                <p class="text-slate-400 text-sm leading-relaxed mb-6">
                    Your trusted partner for smart investing. Trade with confidence on our secure platform.
                </p>
                <div class="flex gap-4">
                    <a href="https://www.facebook.com/ambergroup.io" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-orange-500 transition-colors">
                        <i class="fa fa-facebook text-white"></i>
                    </a>
                    
                    <a href="https://x.com/ambergroup_io" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-orange-500 transition-colors">
    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
        <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
    </svg>
</a>
                    <a href="https://www.linkedin.com/company/amberbtc/" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-orange-500 transition-colors">
                        <i class="fa fa-linkedin text-white"></i>
                    </a>
                    <a href="https://youtu.be/JOhPpbk6G74?si=6RrZPWiGXTntN7KM" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-orange-500 transition-colors">
                        <i class="fa fa-youtube text-white"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="text-white font-semibold mb-4">Quick Links</h4>
                <ul class="space-y-3">
                    <li><a href="{{ route('home') }}" class="text-slate-400 hover:text-orange-500 transition-colors text-sm">Home</a></li>
                    <li><a href="{{ route('about') }}" class="text-slate-400 hover:text-orange-500 transition-colors text-sm">About Us</a></li>
                    <li><a href="{{ route('portfolio') }}" class="text-slate-400 hover:text-orange-500 transition-colors text-sm">Trading Portfolio</a></li>
                    <li><a href="{{ route('contact') }}" class="text-slate-400 hover:text-orange-500 transition-colors text-sm">Contact Us</a></li>
                    <li><a href="{{ route('faq') }}" class="text-slate-400 hover:text-orange-500 transition-colors text-sm">FAQ</a></li>
                </ul>
            </div>

            <!-- Trading -->
            <div>
                <h4 class="text-white font-semibold mb-4">Trading</h4>
                <ul class="space-y-3">
                    <li><a href="{{ route('forex') }}" class="text-slate-400 hover:text-orange-500 transition-colors text-sm">Forex</a></li>
                    <li><a href="{{ route('cryptocurrency') }}" class="text-slate-400 hover:text-orange-500 transition-colors text-sm">Cryptocurrency</a></li>
                    <li><a href="{{ route('stocks') }}" class="text-slate-400 hover:text-orange-500 transition-colors text-sm">CFD Stocks</a></li>
                    <li><a href="{{ route('commodities') }}" class="text-slate-400 hover:text-orange-500 transition-colors text-sm">Commodities</a></li>
                    <li><a href="{{ route('indices') }}" class="text-slate-400 hover:text-orange-500 transition-colors text-sm">Indices</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h4 class="text-white font-semibold mb-4">Contact</h4>
                <ul class="space-y-3">
                    <li class="flex items-start gap-3">
                        <i class="fa fa-envelope text-orange-500 mt-1"></i>
                        <a href="mailto:support@ambertradings.com" class="text-slate-400 hover:text-orange-500 transition-colors text-sm">support@ambertradings.com</a>
                    </li>
                    <!-- <li class="flex items-start gap-3">
                        <i class="fa fa-phone text-orange-500 mt-1"></i>
                        <span class="text-slate-400 text-sm">+1 (234) 567-8900</span>
                    </li> -->
                    <li class="flex items-start gap-3">
                        <i class="fa fa-map-marker text-orange-500 mt-1"></i>
                        <span class="text-slate-400 text-sm">New York Address:<br>900 Third Ave, Suite 110C-5, New York, NY 10022, United States.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fa fa-map-marker text-orange-500 mt-1"></i>
                        <span class="text-slate-400 text-sm">London Address:<br>Kent House 14-17 Market Place, London W1W 8AJ, United Kingdom.</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Bottom Bar -->
    <div class="border-t border-white/10">
        <div class="w-full px-4 sm:px-8 py-6">
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                <p class="text-slate-500 text-sm text-center sm:text-left">
                    © {{ date('Y') }} Amber Tradings. All rights reserved.
                </p>
                <div class="flex gap-6">
                    <a href="#" class="text-slate-500 hover:text-orange-500 transition-colors text-sm">Privacy Policy</a>
                    <a href="#" class="text-slate-500 hover:text-orange-500 transition-colors text-sm">Terms of Service</a>
                    <a href="#" class="text-slate-500 hover:text-orange-500 transition-colors text-sm">Risk Disclosure</a>
                </div>
            </div>
        </div>
    </div>
</footer>
