@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Admin Profile</h1>
            <p class="text-gray-500 mt-1">Manage your account settings and password</p>
        </div>
    </div>

    <!-- Profile Form -->
    <div class="glass-card p-6">
        <form action="{{ route('admin.update-profile') }}" method="POST" class="space-y-6 max-w-2xl">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                    class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-900 focus:border-purple-500 outline-none">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                    class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-900 focus:border-purple-500 outline-none">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="border-t border-gray-100 pt-6 mt-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Change Password</h3>
                <p class="text-sm text-gray-500 mb-6">Leave blank if you don't want to change your password.</p>

                <div class="space-y-4">
                    <!-- Current Password -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Current Password</label>
                        <input type="password" name="current_password"
                            class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-900 focus:border-purple-500 outline-none"
                            placeholder="Required only if changing password">
                        @error('current_password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- New Password -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                        <input type="password" name="new_password"
                            class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-900 focus:border-purple-500 outline-none"
                            placeholder="Min. 8 characters">
                        @error('new_password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm New Password -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Confirm New Password</label>
                        <input type="password" name="new_password_confirmation"
                            class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-900 focus:border-purple-500 outline-none">
                    </div>
                </div>
            </div>

            <!-- Submit -->
            <div class="flex items-center justify-end pt-6">
                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-medium rounded-xl hover:from-purple-700 hover:to-indigo-700 transition-all shadow-lg shadow-purple-200 transform hover:-translate-y-0.5">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
