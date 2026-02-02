@extends('layouts.app')
@section('title', 'Register | Amber Tradings')

@section('content')
<!-- Register Section -->
<section class="min-h-screen flex items-center justify-center relative overflow-hidden py-20">
    <!-- Background -->
    <div class="absolute inset-0">
        <img src="{{ asset('images/hero-about.webp') }}" alt="" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-br from-slate-900/95 via-slate-900/90 to-slate-800/95"></div>
    </div>

    <!-- Decorative Elements -->
    <div class="absolute top-1/4 right-1/4 w-72 h-72 bg-orange-500/20 rounded-full blur-3xl"></div>
    <div class="absolute bottom-1/4 left-1/4 w-72 h-72 bg-green-500/20 rounded-full blur-3xl"></div>

    <div class="container mx-auto px-4 sm:px-6 relative z-10">
        <div class="max-w-lg mx-auto">
            <!-- Logo -->
            <div class="text-center mb-8">
                <a href="{{ route('home') }}" class="inline-block">
                    <span class="text-3xl font-bold text-white">Amber<span class="text-orange-500">Tradings</span></span>
                </a>
            </div>

            <!-- Register Card -->
            <div class="bg-white/10 backdrop-blur-xl rounded-3xl p-8 sm:p-10 border border-white/20 shadow-2xl">
                <div class="text-center mb-8">
                    <h1 class="text-2xl sm:text-3xl font-bold text-white mb-2">Create Account</h1>
                    <p class="text-white/70">Start your trading journey today</p>
                </div>

                @if ($errors->any())
                <div class="mb-6 p-4 rounded-xl bg-red-500/20 border border-red-500/30">
                    <ul class="text-red-400 text-sm space-y-1">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('register') }}" method="POST" class="space-y-5">
                    @csrf
                    <!-- Full Name -->
                    <div>
                        <label class="block text-sm font-medium text-white/80 mb-2">Full Name</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center">
                                <i class="fa fa-user text-white/40"></i>
                            </span>
                            <input type="text" name="name" required value="{{ old('name') }}"
                                   class="w-full pl-12 pr-4 py-4 bg-white/10 border border-white/20 rounded-xl text-white placeholder-white/40 focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 outline-none transition-all"
                                   placeholder="Enter your full name">
                        </div>
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-white/80 mb-2">Email Address</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center">
                                <i class="fa fa-envelope text-white/40"></i>
                            </span>
                            <input type="email" name="email" required value="{{ old('email') }}"
                                   class="w-full pl-12 pr-4 py-4 bg-white/10 border border-white/20 rounded-xl text-white placeholder-white/40 focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 outline-none transition-all"
                                   placeholder="Enter your email">
                        </div>
                    </div>

                    <!-- Phone -->
                    <div>
                        <label class="block text-sm font-medium text-white/80 mb-2">Phone Number (Optional)</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center">
                                <i class="fa fa-phone text-white/40"></i>
                            </span>
                            <input type="tel" name="phone" value="{{ old('phone') }}"
                                   class="w-full pl-12 pr-4 py-4 bg-white/10 border border-white/20 rounded-xl text-white placeholder-white/40 focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 outline-none transition-all"
                                   placeholder="Enter your phone number">
                        </div>
                    </div>

                    <!-- Country -->
                    <div>
                        <label class="block text-sm font-medium text-white/80 mb-2">Country (Optional)</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center">
                                <i class="fa fa-globe text-white/40"></i>
                            </span>
                            <input type="text" name="country" value="{{ old('country') }}"
                                   class="w-full pl-12 pr-4 py-4 bg-white/10 border border-white/20 rounded-xl text-white placeholder-white/40 focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 outline-none transition-all"
                                   placeholder="Enter your country">
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
                                   placeholder="Create a password (min 8 characters)">
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label class="block text-sm font-medium text-white/80 mb-2">Confirm Password</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center">
                                <i class="fa fa-lock text-white/40"></i>
                            </span>
                            <input type="password" name="password_confirmation" required 
                                   class="w-full pl-12 pr-4 py-4 bg-white/10 border border-white/20 rounded-xl text-white placeholder-white/40 focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 outline-none transition-all"
                                   placeholder="Confirm your password">
                        </div>
                    </div>

                    <!-- Terms -->
                    <div class="flex items-start gap-3">
                        <input type="checkbox" name="terms" required class="w-5 h-5 mt-0.5 rounded border-white/20 bg-white/10 text-orange-500 focus:ring-orange-500">
                        <label class="text-sm text-white/70">
                            I agree to the <a href="#" class="text-orange-400 hover:underline">Terms of Service</a> and <a href="#" class="text-orange-400 hover:underline">Privacy Policy</a>
                        </label>
                    </div>

                    <!-- Register Button -->
                    <button type="submit" 
                            class="w-full py-4 bg-gradient-to-r from-orange-500 to-red-500 text-white font-semibold rounded-xl shadow-lg hover:shadow-orange-500/40 hover:-translate-y-1 transition-all duration-300">
                        Create Account
                    </button>
                </form>

                <!-- Divider -->
                <div class="flex items-center gap-4 my-8">
                    <div class="flex-1 h-px bg-white/20"></div>
                    <span class="text-white/50 text-sm">or sign up with</span>
                    <div class="flex-1 h-px bg-white/20"></div>
                </div>

                <!-- Social Register -->
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

                <!-- Login Link -->
                <p class="text-center mt-8 text-white/70">
                    Already have an account? 
                    <a href="{{ route('login') }}" class="text-orange-400 hover:text-orange-300 font-medium transition-colors">Sign In</a>
                </p>
            </div>

            <!-- Trust Badges -->
            <div class="flex items-center justify-center gap-6 mt-6 text-white/50 text-sm">
                <div class="flex items-center gap-2">
                    <i class="fa fa-shield"></i>
                    <span>SSL Secured</span>
                </div>
                <div class="flex items-center gap-2">
                    <i class="fa fa-lock"></i>
                    <span>Regulated</span>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
