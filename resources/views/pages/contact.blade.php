@extends('layouts.app')
@section('title', 'Contact Us | Amber Tradings')

@section('content')
<!-- Hero Section -->
<section class="relative pt-32 pb-20 sm:pb-28 overflow-hidden">
    <!-- Background -->
    <div class="absolute inset-0">
        <img src="{{ asset('images/hero-about.webp') }}" alt="" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-slate-900/90 to-slate-900/70"></div>
    </div>
    <div class="container mx-auto px-4 sm:px-6 text-center relative z-10">
        <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold text-white mb-6">Contact Us</h1>
        <p class="text-lg sm:text-xl text-white/80 max-w-2xl mx-auto">
            We're here to help you succeed. Get in touch with our team.
        </p>
    </div>
</section>

<!-- Contact Info Cards -->
<section class="py-16 sm:py-24 bg-white">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto mb-16">
            <!-- London Office -->
            <div class="bg-gradient-to-br from-slate-50 to-white rounded-2xl p-8 border border-slate-100 hover:shadow-xl transition-shadow duration-300">
                <div class="w-16 h-16 mb-6 bg-gradient-to-br from-orange-500 to-red-500 rounded-2xl flex items-center justify-center">
                    <i class="fa fa-building text-2xl text-white"></i>
                </div>
                <h4 class="text-xl font-bold text-slate-900 mb-4">London Office</h4>
                <p class="text-slate-600 leading-relaxed">
                    Kent House 14-17 Market Place,<br>
                    London W1W 8AJ,<br>
                    United Kingdom
                </p>
            </div>

            <!-- New York Office -->
            <div class="bg-gradient-to-br from-slate-50 to-white rounded-2xl p-8 border border-slate-100 hover:shadow-xl transition-shadow duration-300">
                <div class="w-16 h-16 mb-6 bg-gradient-to-br from-orange-500 to-red-500 rounded-2xl flex items-center justify-center">
                    <i class="fa fa-building-o text-2xl text-white"></i>
                </div>
                <h4 class="text-xl font-bold text-slate-900 mb-4">New York Office</h4>
                <p class="text-slate-600 leading-relaxed">
                    900 Third Ave, Suite 110C-5,<br>
                    New York, NY 10022,<br>
                    United States
                </p>
            </div>

            <!-- Email -->
            <div class="bg-gradient-to-br from-slate-50 to-white rounded-2xl p-8 border border-slate-100 hover:shadow-xl transition-shadow duration-300">
                <div class="w-16 h-16 mb-6 bg-gradient-to-br from-orange-500 to-red-500 rounded-2xl flex items-center justify-center">
                    <i class="fa fa-envelope text-2xl text-white"></i>
                </div>
                <h4 class="text-xl font-bold text-slate-900 mb-4">Email Us</h4>
                <a href="mailto:support@ambertradings.com" class="text-orange-500 hover:text-orange-600 font-medium text-lg transition-colors">
                    support@ambertradings.com
                </a>
                <p class="text-slate-500 text-sm mt-2">We respond within 24 hours</p>
            </div>
        </div>

        <!-- Contact Form Section -->
        <div class="grid lg:grid-cols-2 gap-12 items-start max-w-6xl mx-auto">
            <!-- Left Side - Additional Info -->
            <div>
                <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 mb-6">Get in Touch</h2>
                <p class="text-lg text-slate-600 leading-relaxed mb-8">
                    Have a question or need assistance? Our dedicated support team is here to help you with any inquiries about trading, accounts, or our services.
                </p>

                <div class="space-y-6">
                    <!-- Telegram -->
                    <div class="flex items-center gap-4 p-4 bg-slate-50 rounded-xl">
                        <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center flex-shrink-0">
                            <i class="fa fa-telegram text-xl text-white"></i>
                        </div>
                        <div>
                            <h5 class="font-semibold text-slate-900">Telegram</h5>
                            <a href="https://t.me/amberbrokerage" target="_blank" class="text-blue-500 hover:underline">@amberbrokerage</a>
                        </div>
                    </div>

                    <!-- Support Hours -->
                    <div class="flex items-center gap-4 p-4 bg-slate-50 rounded-xl">
                        <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center flex-shrink-0">
                            <i class="fa fa-clock-o text-xl text-white"></i>
                        </div>
                        <div>
                            <h5 class="font-semibold text-slate-900">Support Hours</h5>
                            <p class="text-slate-600">24 hours, Monday - Friday</p>
                        </div>
                    </div>

                    <!-- Live Chat -->
                    <div class="flex items-center gap-4 p-4 bg-slate-50 rounded-xl">
                        <div class="w-12 h-12 bg-orange-500 rounded-xl flex items-center justify-center flex-shrink-0">
                            <i class="fa fa-comments text-xl text-white"></i>
                        </div>
                        <div>
                            <h5 class="font-semibold text-slate-900">Live Chat</h5>
                            <p class="text-slate-600">Available on our trading platform</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Contact Form -->
            <div class="bg-white rounded-2xl p-8 shadow-xl border border-slate-100">
                <h3 class="text-2xl font-bold text-slate-900 mb-6">Send us a Message</h3>
                <form action="#" method="POST" class="space-y-5">
                    @csrf
                    <div class="grid sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Your Name</label>
                            <input type="text" name="name" required 
                                   class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Your Email</label>
                            <input type="email" name="email" required 
                                   class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 outline-none transition-all">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Subject</label>
                        <input type="text" name="subject" required 
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Your Message</label>
                        <textarea name="message" rows="5" required 
                                  class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 outline-none transition-all resize-none"></textarea>
                    </div>
                    <button type="submit" 
                            class="w-full py-4 bg-gradient-to-r from-orange-500 to-red-500 text-white font-semibold rounded-full shadow-lg hover:shadow-orange-500/40 hover:-translate-y-1 transition-all duration-300">
                        Send Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Map Section (Optional) -->
<section class="py-16 sm:py-20 bg-slate-50">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 mb-4">Our Global Presence</h2>
            <p class="text-lg text-slate-600">Serving traders across 150+ countries worldwide</p>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white rounded-xl p-6 text-center shadow-lg">
                <h3 class="text-3xl font-bold text-orange-500 mb-2">150+</h3>
                <p class="text-slate-600">Countries Served</p>
            </div>
            <div class="bg-white rounded-xl p-6 text-center shadow-lg">
                <h3 class="text-3xl font-bold text-orange-500 mb-2">24/5</h3>
                <p class="text-slate-600">Support Available</p>
            </div>
            <div class="bg-white rounded-xl p-6 text-center shadow-lg">
                <h3 class="text-3xl font-bold text-orange-500 mb-2">10+</h3>
                <p class="text-slate-600">Languages Supported</p>
            </div>
            <div class="bg-white rounded-xl p-6 text-center shadow-lg">
                <h3 class="text-3xl font-bold text-orange-500 mb-2">&lt;24hrs</h3>
                <p class="text-slate-600">Response Time</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 sm:py-20 bg-gradient-to-r from-orange-500 to-red-500">
    <div class="container mx-auto px-4 sm:px-6 text-center">
        <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">Ready to Start Trading?</h2>
        <p class="text-lg text-white/90 mb-8 max-w-2xl mx-auto">Join thousands of traders who trust Amber Tradings for their investment needs.</p>
        <a href="https://portal.ambertradings.com/register" 
           class="inline-flex items-center justify-center px-10 py-4 text-lg font-semibold text-orange-500 bg-white rounded-full shadow-lg hover:bg-white/90 hover:-translate-y-1 transition-all duration-300"
           target="_blank">
            Open Account
        </a>
    </div>
</section>
@endsection
