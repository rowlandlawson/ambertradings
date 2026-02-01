<header id="mainNav" class="fixed top-0 inset-x-0 z-[9999] bg-slate-900/80 backdrop-blur-xl shadow-lg">
    <div class="container mx-auto px-4">
        <div id="navInner" class="flex items-center justify-between py-4 lg:py-5 transition-all duration-300">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}">
                    <img id="navLogo" src="{{ asset('images/logo_color.png') }}" alt="Amber Tradings" class="h-8 sm:h-10 lg:h-12 transition-all duration-300">
                </a>
            </div>
            
            <!-- Mobile Nav Toggle -->
            <button id="mobileNavToggle" class="lg:hidden flex flex-col gap-1.5 p-2 z-50" aria-label="Toggle navigation">
                <span class="hamburger-line w-6 h-0.5 bg-white rounded transition-all duration-300 origin-center"></span>
                <span class="hamburger-line w-6 h-0.5 bg-white rounded transition-all duration-300"></span>
                <span class="hamburger-line w-6 h-0.5 bg-white rounded transition-all duration-300 origin-center"></span>
            </button>
            
            <!-- Navigation -->
            <nav id="mainNavMenu" class="hidden lg:flex items-center">
                <ul class="flex items-center gap-1">
                    <li class="{{ request()->routeIs('home') ? 'active' : '' }}">
                        <a href="{{ route('home') }}" class="px-4 py-3 text-sm font-medium text-white/85 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-300 {{ request()->routeIs('home') ? 'text-orange-500' : '' }}">
                            Home
                        </a>
                    </li>
                    
                    <li class="has-dropdown group relative">
                        <a href="#" class="flex items-center gap-1.5 px-4 py-3 text-sm font-medium text-white/85 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-300">
                            About Us 
                            <i class="fa fa-chevron-down text-[10px] transition-transform duration-300 group-hover:rotate-180"></i>
                        </a>
                        <ul class="absolute top-full left-0 min-w-[250px] py-3 bg-slate-900/95 backdrop-blur-xl rounded-xl shadow-2xl border border-white/10 opacity-0 invisible translate-y-4 group-hover:opacity-100 group-hover:visible group-hover:translate-y-1 transition-all duration-300 z-50">
                            <li><a href="{{ route('about') }}" class="block px-6 py-3 text-sm text-white/75 hover:text-white hover:bg-orange-500/15 hover:pl-8 transition-all duration-300">About Us</a></li>
                            <li><a href="{{ route('awards') }}" class="block px-6 py-3 text-sm text-white/75 hover:text-white hover:bg-orange-500/15 hover:pl-8 transition-all duration-300">Global Awards</a></li>
                            <li><a href="{{ route('why-us') }}" class="block px-6 py-3 text-sm text-white/75 hover:text-white hover:bg-orange-500/15 hover:pl-8 transition-all duration-300">Why Us</a></li>
                            <li><a href="{{ route('performance') }}" class="block px-6 py-3 text-sm text-white/75 hover:text-white hover:bg-orange-500/15 hover:pl-8 transition-all duration-300">Performance Statistics</a></li>
                            <li><a href="{{ route('contact') }}" class="block px-6 py-3 text-sm text-white/75 hover:text-white hover:bg-orange-500/15 hover:pl-8 transition-all duration-300">Contact Us</a></li>
                            <li><a href="{{ route('faq') }}" class="block px-6 py-3 text-sm text-white/75 hover:text-white hover:bg-orange-500/15 hover:pl-8 transition-all duration-300">Frequently Asked Questions</a></li>
                        </ul>
                    </li>
                    
                    <li class="has-dropdown group relative">
                        <a href="#" class="flex items-center gap-1.5 px-4 py-3 text-sm font-medium text-white/85 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-300">
                            Investment Center 
                            <i class="fa fa-chevron-down text-[10px] transition-transform duration-300 group-hover:rotate-180"></i>
                        </a>
                        <ul class="absolute top-full left-0 min-w-[250px] py-3 bg-slate-900/95 backdrop-blur-xl rounded-xl shadow-2xl border border-white/10 opacity-0 invisible translate-y-4 group-hover:opacity-100 group-hover:visible group-hover:translate-y-1 transition-all duration-300 z-50">
                            <li><a href="{{ route('invest-professional') }}" class="block px-6 py-3 text-sm text-white/75 hover:text-white hover:bg-orange-500/15 hover:pl-8 transition-all duration-300">Invest As A Professional</a></li>
                            <li><a href="{{ route('protection') }}" class="block px-6 py-3 text-sm text-white/75 hover:text-white hover:bg-orange-500/15 hover:pl-8 transition-all duration-300">Protection of Funds</a></li>
                            <li><a href="{{ route('deposits') }}" class="block px-6 py-3 text-sm text-white/75 hover:text-white hover:bg-orange-500/15 hover:pl-8 transition-all duration-300">Deposit and Withdrawals</a></li>
                        </ul>
                    </li>
                    
                    <li class="has-dropdown group relative">
                        <a href="#" class="flex items-center gap-1.5 px-4 py-3 text-sm font-medium text-white/85 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-300">
                            Investment Portfolio 
                            <i class="fa fa-chevron-down text-[10px] transition-transform duration-300 group-hover:rotate-180"></i>
                        </a>
                        <ul class="absolute top-full left-0 min-w-[250px] py-3 bg-slate-900/95 backdrop-blur-xl rounded-xl shadow-2xl border border-white/10 opacity-0 invisible translate-y-4 group-hover:opacity-100 group-hover:visible group-hover:translate-y-1 transition-all duration-300 z-50">
                            <li><a href="{{ route('portfolio') }}" class="block px-6 py-3 text-sm text-white/75 hover:text-white hover:bg-orange-500/15 hover:pl-8 transition-all duration-300">Trading Portfolio</a></li>
                            <li><a href="{{ route('forex') }}" class="block px-6 py-3 text-sm text-white/75 hover:text-white hover:bg-orange-500/15 hover:pl-8 transition-all duration-300">Forex</a></li>
                            <li><a href="{{ route('commodities') }}" class="block px-6 py-3 text-sm text-white/75 hover:text-white hover:bg-orange-500/15 hover:pl-8 transition-all duration-300">Commodities</a></li>
                            <li><a href="{{ route('indices') }}" class="block px-6 py-3 text-sm text-white/75 hover:text-white hover:bg-orange-500/15 hover:pl-8 transition-all duration-300">Indices</a></li>
                            <li><a href="{{ route('nfp') }}" class="block px-6 py-3 text-sm text-white/75 hover:text-white hover:bg-orange-500/15 hover:pl-8 transition-all duration-300">NFP</a></li>
                            <li><a href="{{ route('stocks') }}" class="block px-6 py-3 text-sm text-white/75 hover:text-white hover:bg-orange-500/15 hover:pl-8 transition-all duration-300">CFD Stocks</a></li>
                            <li><a href="{{ route('cryptocurrency') }}" class="block px-6 py-3 text-sm text-white/75 hover:text-white hover:bg-orange-500/15 hover:pl-8 transition-all duration-300">Cryptocurrency</a></li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="{{ route('contact') }}" class="px-4 py-3 text-sm font-medium text-white/85 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-300">
                            Contact Us
                        </a>
                    </li>
                    
                    <li class="ml-4">
                        <a href="{{ route('login') }}" class="inline-block px-7 py-3 text-sm font-semibold text-white bg-gradient-to-r from-orange-500 to-red-500 rounded-full shadow-lg shadow-orange-500/40 hover:shadow-orange-500/60 hover:-translate-y-0.5 transition-all duration-300">
                            LOGIN
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    
    <!-- Mobile Menu Overlay -->
    <div id="mobileMenuOverlay" class="fixed inset-0 bg-black/60 z-40 opacity-0 invisible transition-opacity duration-300 lg:hidden"></div>
    
    <!-- Mobile Menu -->
    <div id="mobileMenu" class="fixed top-0 right-0 w-80 max-w-[85%] h-screen bg-gradient-to-b from-slate-900 to-slate-800 z-50 translate-x-full transition-transform duration-300 lg:hidden overflow-y-auto">
        <div class="pt-20 px-6 pb-6">
            <ul class="flex flex-col">
                <li>
                    <a href="{{ route('home') }}" class="block py-4 text-white/85 hover:text-white border-b border-white/10 transition-colors">Home</a>
                </li>
                <li class="mobile-dropdown">
                    <a href="#" class="flex items-center justify-between py-4 text-white/85 hover:text-white border-b border-white/10 transition-colors">
                        About Us <i class="fa fa-chevron-down text-xs transition-transform duration-300"></i>
                    </a>
                    <ul class="mobile-submenu hidden pl-4 pb-2 bg-white/5 rounded-lg my-2">
                        <li><a href="{{ route('about') }}" class="block py-3 px-4 text-sm text-white/70 hover:text-white">About Us</a></li>
                        <li><a href="{{ route('awards') }}" class="block py-3 px-4 text-sm text-white/70 hover:text-white">Global Awards</a></li>
                        <li><a href="{{ route('why-us') }}" class="block py-3 px-4 text-sm text-white/70 hover:text-white">Why Us</a></li>
                        <li><a href="{{ route('performance') }}" class="block py-3 px-4 text-sm text-white/70 hover:text-white">Performance Statistics</a></li>
                        <li><a href="{{ route('contact') }}" class="block py-3 px-4 text-sm text-white/70 hover:text-white">Contact Us</a></li>
                        <li><a href="{{ route('faq') }}" class="block py-3 px-4 text-sm text-white/70 hover:text-white">FAQ</a></li>
                    </ul>
                </li>
                <li class="mobile-dropdown">
                    <a href="#" class="flex items-center justify-between py-4 text-white/85 hover:text-white border-b border-white/10 transition-colors">
                        Investment Center <i class="fa fa-chevron-down text-xs transition-transform duration-300"></i>
                    </a>
                    <ul class="mobile-submenu hidden pl-4 pb-2 bg-white/5 rounded-lg my-2">
                        <li><a href="{{ route('invest-professional') }}" class="block py-3 px-4 text-sm text-white/70 hover:text-white">Invest As A Professional</a></li>
                        <li><a href="{{ route('protection') }}" class="block py-3 px-4 text-sm text-white/70 hover:text-white">Protection of Funds</a></li>
                        <li><a href="{{ route('deposits') }}" class="block py-3 px-4 text-sm text-white/70 hover:text-white">Deposit and Withdrawals</a></li>
                    </ul>
                </li>
                <li class="mobile-dropdown">
                    <a href="#" class="flex items-center justify-between py-4 text-white/85 hover:text-white border-b border-white/10 transition-colors">
                        Investment Portfolio <i class="fa fa-chevron-down text-xs transition-transform duration-300"></i>
                    </a>
                    <ul class="mobile-submenu hidden pl-4 pb-2 bg-white/5 rounded-lg my-2">
                        <li><a href="{{ route('portfolio') }}" class="block py-3 px-4 text-sm text-white/70 hover:text-white">Trading Portfolio</a></li>
                        <li><a href="{{ route('forex') }}" class="block py-3 px-4 text-sm text-white/70 hover:text-white">Forex</a></li>
                        <li><a href="{{ route('commodities') }}" class="block py-3 px-4 text-sm text-white/70 hover:text-white">Commodities</a></li>
                        <li><a href="{{ route('indices') }}" class="block py-3 px-4 text-sm text-white/70 hover:text-white">Indices</a></li>
                        <li><a href="{{ route('nfp') }}" class="block py-3 px-4 text-sm text-white/70 hover:text-white">NFP</a></li>
                        <li><a href="{{ route('stocks') }}" class="block py-3 px-4 text-sm text-white/70 hover:text-white">CFD Stocks</a></li>
                        <li><a href="{{ route('cryptocurrency') }}" class="block py-3 px-4 text-sm text-white/70 hover:text-white">Cryptocurrency</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('contact') }}" class="block py-4 text-white/85 hover:text-white border-b border-white/10 transition-colors">Contact Us</a>
                </li>
                <li class="mt-6">
                    <a href="{{ route('login') }}" class="block w-full py-4 text-center text-white font-semibold bg-gradient-to-r from-orange-500 to-red-500 rounded-full shadow-lg">
                        LOGIN
                    </a>
                </li>
            </ul>
        </div>
    </div>
</header>
