@extends('layouts.dashboard')

@section('title', 'Profile')
@section('page-title', 'My Profile')

@section('content')
<div class="grid lg:grid-cols-3 gap-6">
    <!-- Profile Info Card -->
    <div class="glass-card p-6">
        <div class="text-center">
            <div class="w-24 h-24 mx-auto rounded-full bg-gradient-to-br from-amber-500 to-orange-600 flex items-center justify-center text-3xl font-bold mb-4">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <h2 class="text-xl font-semibold text-gray-900">{{ $user->name }}</h2>
            <p class="text-gray-400 text-sm">{{ $user->email }}</p>
            
            <div class="mt-6 pt-6 border-t border-gray-200 space-y-3">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">Member Since</span>
                    <span class="text-gray-900">{{ $user->created_at->format('M Y') }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">Account Status</span>
                    <span class="text-green-600">
                        <i class="fas fa-check-circle mr-1"></i> Active
                    </span>
                </div>
                @if($user->phone)
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">Phone</span>
                    <span class="text-gray-900">{{ $user->phone }}</span>
                </div>
                @endif
                @if($user->country)
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">Country</span>
                    <span class="text-gray-900">{{ $user->country }}</span>
                </div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Edit Profile Form -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Profile Details -->
        <div class="glass-card p-6">
            <h3 class="text-lg font-semibold mb-6 flex items-center gap-2">
                <i class="fas fa-user text-amber-500"></i>
                Profile Details
            </h3>
            
            <form action="{{ route('dashboard.profile.update') }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                            class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-900 placeholder-gray-400 focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20 outline-none transition-all">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                        <input type="email" value="{{ $user->email }}" disabled 
                            class="w-full px-4 py-3 rounded-xl bg-gray-100 border border-gray-200 text-gray-500 cursor-not-allowed">
                        <p class="text-xs text-gray-500 mt-1">Email cannot be changed</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                        <input type="tel" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="+1 234 567 890"
                            class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-900 placeholder-gray-400 focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20 outline-none transition-all">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Country</label>
                        <input type="text" name="country" value="{{ old('country', $user->country) }}" placeholder="United States"
                            class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-900 placeholder-gray-400 focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20 outline-none transition-all">
                    </div>
                </div>
                
                <div class="mt-6">
                    <button type="submit" class="px-6 py-3 bg-amber-500 text-white font-medium rounded-xl hover:from-amber-600 hover:to-orange-700 transition-all duration-200">
                        <i class="fas fa-save mr-2"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Change Password -->
        <div class="glass-card p-6">
            <h3 class="text-lg font-semibold mb-6 flex items-center gap-2">
                <i class="fas fa-lock text-amber-500"></i>
                Change Password
            </h3>
            
            <form action="{{ route('dashboard.password.update') }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="grid md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Current Password</label>
                        <input type="password" name="current_password" 
                            class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-900 placeholder-gray-400 focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20 outline-none transition-all">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                        <input type="password" name="password" 
                            class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-900 placeholder-gray-400 focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20 outline-none transition-all">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                        <input type="password" name="password_confirmation" 
                            class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-900 placeholder-gray-400 focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20 outline-none transition-all">
                    </div>
                </div>
                
                <div class="mt-6">
                    <button type="submit" class="px-6 py-3 bg-gray-200 text-gray-700 font-medium rounded-xl hover:bg-gray-300 transition-all duration-200">
                        <i class="fas fa-key mr-2"></i> Update Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
