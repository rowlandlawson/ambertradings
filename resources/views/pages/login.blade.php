@extends('layouts.app')
@section('title', 'Login | Amber Tradings')

@section('content')
<!-- Login Section -->
<section class="min-h-screen flex items-center justify-center relative overflow-hidden py-20">
    <!-- Background -->
    <div class="absolute inset-0">
        <img src="{{ asset('images/hero-about.webp') }}" alt="" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-br from-slate-900/95 via-slate-900/90 to-slate-800/95"></div>
    </div>

    <!-- Decorative Elements -->
    <div class="absolute top-1/4 left-1/4 w-72 h-72 bg-orange-500/20 rounded-full blur-3xl"></div>
    <div class="absolute bottom-1/4 right-1/4 w-72 h-72 bg-blue-500/20 rounded-full blur-3xl"></div>

    <div class="container mx-auto px-4 sm:px-6 relative z-10">
        <div class="max-w-md mx-auto">
            <!-- Logo -->
            <div class="text-center mb-8">
                <a href="{{ route('home') }}" class="inline-block">
                    <span class="text-3xl font-bold text-white">Amber<span class="text-orange-500">Tradings</span></span>
                </a>
            </div>

            <!-- Login Card -->
            <div class="bg-white/10 backdrop-blur-xl rounded-3xl p-8 sm:p-10 border border-white/20 shadow-2xl">
                <div class="text-center mb-8">
                    <h1 class="text-2xl sm:text-3xl font-bold text-white mb-2">Welcome Back</h1>
                    <p class="text-white/70">Sign in to access your trading account</p>
                </div>

                <form action="#" method="POST" class="space-y-6">
                    @csrf
                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-white/80 mb-2">Email Address</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center">
                                <i class="fa fa-envelope text-white/40"></i>
                            </span>
                            <input type="email" name="email" required 
                                   class="w-full pl-12 pr-4 py-4 bg-white/10 border border-white/20 rounded-xl text-white placeholder-white/40 focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 outline-none transition-all"
                                   placeholder="Enter your email">
                        </div>
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-sm font-medium text-white/80 mb-2">Password</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center">
                                <i class="fa fa-lock text-white/40"></i>
                            </span>
                            <input type="password" name="password" required 
                                   class="w-full pl-12 pr-4 py-4 bg-white/10 border border-white/20 rounded-xl text-white placeholder-white/40 focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 outline-none transition-all"
                                   placeholder="Enter your password">
                        </div>
                    </div>

                    <!-- Remember & Forgot -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="remember" class="w-4 h-4 rounded border-white/20 bg-white/10 text-orange-500 focus:ring-orange-500">
                            <span class="text-sm text-white/70">Remember me</span>
                        </label>
                        <a href="#" class="text-sm text-orange-400 hover:text-orange-300 transition-colors">Forgot password?</a>
                    </div>

                    <!-- Login Button -->
                    <button type="submit" 
                            class="w-full py-4 bg-gradient-to-r from-orange-500 to-red-500 text-white font-semibold rounded-xl shadow-lg hover:shadow-orange-500/40 hover:-translate-y-1 transition-all duration-300">
                        Sign In
                    </button>
                </form>

                <!-- Divider -->
                <div class="flex items-center gap-4 my-8">
                    <div class="flex-1 h-px bg-white/20"></div>
                    <span class="text-white/50 text-sm">or continue with</span>
                    <div class="flex-1 h-px bg-white/20"></div>
                </div>

                <!-- Social Login -->
                <div class="grid grid-cols-2 gap-4">
                    <button class="flex items-center justify-center gap-2 py-3 bg-white/10 border border-white/20 rounded-xl text-white hover:bg-white/20 transition-colors">
                        <i class="fa fa-google"></i>
                        <span>Google</span>
                    </button>
                    <button class="flex items-center justify-center gap-2 py-3 bg-white/10 border border-white/20 rounded-xl text-white hover:bg-white/20 transition-colors">
                        <i class="fa fa-apple"></i>
                        <span>Apple</span>
                    </button>
                </div>

                <!-- Register Link -->
                <p class="text-center mt-8 text-white/70">
                    Don't have an account? 
                    <a href="{{ route('register') }}" class="text-orange-400 hover:text-orange-300 font-medium transition-colors">Create Account</a>
                </p>
            </div>

            <!-- Security Badge -->
            <div class="flex items-center justify-center gap-2 mt-6 text-white/50 text-sm">
                <i class="fa fa-shield"></i>
                <span>256-bit SSL Encrypted</span>
            </div>
        </div>
    </div>
</section>
@endsection
