<!-- Footer -->
<footer class="bg-slate-950 text-white">
    <!-- Main Footer -->
    <div class="container mx-auto px-4 sm:px-6 py-12 sm:py-16">
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
                    <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-orange-500 transition-colors">
                        <i class="fa fa-facebook text-white"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-orange-500 transition-colors">
                        <i class="fa fa-twitter text-white"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-orange-500 transition-colors">
                        <i class="fa fa-linkedin text-white"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-orange-500 transition-colors">
                        <i class="fa fa-instagram text-white"></i>
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
                    <li class="flex items-start gap-3">
                        <i class="fa fa-phone text-orange-500 mt-1"></i>
                        <span class="text-slate-400 text-sm">+1 (234) 567-8900</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fa fa-map-marker text-orange-500 mt-1"></i>
                        <span class="text-slate-400 text-sm">123 Trading Street,<br>New York, NY 10001</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Bottom Bar -->
    <div class="border-t border-white/10">
        <div class="container mx-auto px-4 sm:px-6 py-6">
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
