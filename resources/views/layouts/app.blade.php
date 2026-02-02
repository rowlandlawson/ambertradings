<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Amber Tradings')</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css?family=Rubik:400|Poppins:800,700,600|Lato:700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <!-- Tailwind CSS via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            font-family: 'Inter', 'Source Sans Pro', Arial, sans-serif;
        }
    </style>
    
    @yield('styles')
</head>
<body class="antialiased bg-white text-slate-700 overflow-x-hidden">
    <!-- Page Loading Overlay -->
    <div id="pageLoader" class="fixed inset-0 z-[99999] flex items-center justify-center bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 transition-opacity duration-500">
        <div class="text-center">
            <!-- Animated Logo -->
            <div class="relative mb-8">
                <div class="w-20 h-20 mx-auto rounded-2xl bg-gradient-to-br from-orange-500 to-red-500 flex items-center justify-center animate-pulse">
                    <img src="{{ asset('images/logo.webp') }}" alt="" class="w-full h-full object-contain">
                </div>
                <!-- Spinning ring -->
                <div class="absolute inset-0 w-20 h-20 mx-auto border-4 border-transparent border-t-orange-500 rounded-full animate-spin"></div>
            </div>
            <!-- Logo Text -->
            <h2 class="text-2xl font-bold text-white mb-2">
                Amber<span class="text-orange-500">Tradings</span>
            </h2>
            <!-- Loading dots -->
            <div class="flex items-center justify-center gap-1 mt-4">
                <div class="w-2 h-2 bg-orange-500 rounded-full animate-bounce" style="animation-delay: 0ms;"></div>
                <div class="w-2 h-2 bg-orange-500 rounded-full animate-bounce" style="animation-delay: 150ms;"></div>
                <div class="w-2 h-2 bg-orange-500 rounded-full animate-bounce" style="animation-delay: 300ms;"></div>
            </div>
        </div>
    </div>

    <!-- Header -->
    @include('components.header')
    
    <!-- Main Content -->
    <main>
        @yield('content')
    </main>
    
    <!-- Footer -->
    @include('components.footer')
    
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>
        $(document).ready(function() {
            const mobileToggle = $('#mobileNavToggle');
            const mobileMenu = $('#mobileMenu');
            const overlay = $('#mobileMenuOverlay');
            const navbar = $('#mainNav');
            const navInner = $('#navInner');
            const navLogo = $('#navLogo');
            const hamburgerLines = $('.hamburger-line');
            
            // Toggle mobile menu
            mobileToggle.click(function() {
                // Toggle hamburger animation
                hamburgerLines.eq(0).toggleClass('rotate-45 translate-y-2');
                hamburgerLines.eq(1).toggleClass('opacity-0');
                hamburgerLines.eq(2).toggleClass('-rotate-45 -translate-y-2');
                
                // Toggle menu visibility
                mobileMenu.toggleClass('translate-x-full translate-x-0');
                overlay.toggleClass('opacity-0 invisible opacity-100 visible');
                $('body').toggleClass('overflow-hidden');
            });
            
            // Close menu when clicking overlay
            overlay.click(function() {
                hamburgerLines.eq(0).removeClass('rotate-45 translate-y-2');
                hamburgerLines.eq(1).removeClass('opacity-0');
                hamburgerLines.eq(2).removeClass('-rotate-45 -translate-y-2');
                
                mobileMenu.addClass('translate-x-full').removeClass('translate-x-0');
                overlay.addClass('opacity-0 invisible').removeClass('opacity-100 visible');
                $('body').removeClass('overflow-hidden');
            });
            
            // Handle mobile dropdowns
            $('.mobile-dropdown > a').click(function(e) {
                e.preventDefault();
                const submenu = $(this).siblings('.mobile-submenu');
                const icon = $(this).find('i');
                
                submenu.slideToggle(200);
                icon.toggleClass('rotate-180');
            });
            
            // Navbar is always fixed with same appearance - no scroll changes needed
            
            // Close mobile menu on window resize
            $(window).resize(function() {
                if ($(window).width() > 1024) {
                    hamburgerLines.eq(0).removeClass('rotate-45 translate-y-2');
                    hamburgerLines.eq(1).removeClass('opacity-0');
                    hamburgerLines.eq(2).removeClass('-rotate-45 -translate-y-2');
                    
                    mobileMenu.addClass('translate-x-full').removeClass('translate-x-0');
                    overlay.addClass('opacity-0 invisible').removeClass('opacity-100 visible');
                    $('body').removeClass('overflow-hidden');
                }
            });
        });
    </script>
    
    <!-- Page Loader Script -->
    <script>
        // Hide loader when page is fully loaded
        window.addEventListener('load', function() {
            const loader = document.getElementById('pageLoader');
            if (loader) {
                // Add fade-out effect
                loader.style.opacity = '0';
                // Remove from DOM after animation
                setTimeout(function() {
                    loader.style.display = 'none';
                }, 500);
            }
        });
        
        // Fallback: hide loader after 3 seconds max
        setTimeout(function() {
            const loader = document.getElementById('pageLoader');
            if (loader && loader.style.display !== 'none') {
                loader.style.opacity = '0';
                setTimeout(function() {
                    loader.style.display = 'none';
                }, 500);
            }
        }, 3000);
    </script>
    
    @yield('scripts')
</body>
</html>
