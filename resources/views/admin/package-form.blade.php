@extends('layouts.admin')

@section('title', $package ? 'Edit Package' : 'Create Package')
@section('page-title', $package ? 'Edit Investment Package' : 'Create Investment Package')

@section('content')
<!-- Breadcrumb -->
<div class="mb-6">
    <a href="{{ route('admin.packages') }}" class="text-gray-500 hover:text-gray-700 transition-colors">
        <i class="fas fa-arrow-left mr-2"></i> Back to Packages
    </a>
</div>

<div class="glass-card max-w-3xl mx-auto">
    <div class="p-6 border-b border-gray-200">
        <h2 class="text-xl font-semibold">{{ $package ? 'Edit Package' : 'Create New Package' }}</h2>
        <p class="text-gray-500 text-sm mt-1">{{ $package ? 'Update the investment package details' : 'Fill in the details to create a new investment package' }}</p>
    </div>
    
    <form action="{{ $package ? route('admin.package.update', $package->id) : route('admin.package.store') }}" method="POST" class="p-6">
        @csrf
        @if($package)
        @method('PUT')
        @endif
        
        <div class="space-y-6">
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Package Name *</label>
                    <input type="text" name="name" value="{{ old('name', $package->name ?? '') }}" required
                        placeholder="e.g., Gold Plan, Premium Package"
                        class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-900 placeholder-gray-400 focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 outline-none transition-all">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Icon Class</label>
                    <input type="text" name="icon" value="{{ old('icon', $package->icon ?? 'fas fa-gem') }}"
                        placeholder="e.g., fas fa-gem, fas fa-crown"
                        class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-900 placeholder-gray-400 focus:border-purple-500 outline-none transition-all">
                    <p class="text-xs text-gray-500 mt-1">Font Awesome icon class</p>
                </div>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Description</label>
                <textarea name="description" rows="3" placeholder="Describe the investment package..."
                    class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-900 placeholder-gray-400 focus:border-purple-500 outline-none transition-all resize-none">{{ old('description', $package->description ?? '') }}</textarea>
            </div>
            
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Minimum Amount ($) *</label>
                    <input type="number" name="min_amount" step="0.01" min="0" required
                        value="{{ old('min_amount', $package->min_amount ?? '') }}" placeholder="100"
                        class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-900 placeholder-gray-400 focus:border-purple-500 outline-none transition-all">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Maximum Amount ($) *</label>
                    <input type="number" name="max_amount" step="0.01" min="0" required
                        value="{{ old('max_amount', $package->max_amount ?? '') }}" placeholder="10000"
                        class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-900 placeholder-gray-400 focus:border-purple-500 outline-none transition-all">
                </div>
            </div>
            
            <div class="grid md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">ROI Percentage (%) *</label>
                    <input type="number" name="roi_percentage" step="0.01" min="0" required
                        value="{{ old('roi_percentage', $package->roi_percentage ?? '') }}" placeholder="15"
                        class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-900 placeholder-gray-400 focus:border-purple-500 outline-none transition-all">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Duration (Days) *</label>
                    <input type="number" name="duration_days" min="1" required
                        value="{{ old('duration_days', $package->duration_days ?? '') }}" placeholder="30"
                        class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-900 placeholder-gray-400 focus:border-purple-500 outline-none transition-all">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Risk Level *</label>
                    <select name="risk_level" required
                        class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-900 focus:border-purple-500 outline-none transition-all">
                        <option value="low" {{ old('risk_level', $package->risk_level ?? '') == 'low' ? 'selected' : '' }}>Low Risk</option>
                        <option value="medium" {{ old('risk_level', $package->risk_level ?? 'medium') == 'medium' ? 'selected' : '' }}>Medium Risk</option>
                        <option value="high" {{ old('risk_level', $package->risk_level ?? '') == 'high' ? 'selected' : '' }}>High Risk</option>
                    </select>
                </div>
            </div>
            
            <div class="flex items-center gap-3 p-4 rounded-xl bg-gray-50">
                <input type="checkbox" name="is_active" id="is_active" value="1"
                    {{ old('is_active', $package->is_active ?? true) ? 'checked' : '' }}
                    class="w-5 h-5 rounded border-gray-300 text-purple-500 focus:ring-purple-500 bg-white">
                <label for="is_active" class="text-gray-700">
                    <span class="font-medium">Active Package</span>
                    <p class="text-sm text-gray-500">When enabled, this package will be available for selection</p>
                </label>
            </div>
        </div>
        
        <div class="flex items-center gap-4 mt-8 pt-6 border-t border-gray-200">
            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-purple-500 to-pink-600 text-white font-medium rounded-xl hover:from-purple-600 hover:to-pink-700 transition-all">
                <i class="fas fa-save mr-2"></i> {{ $package ? 'Update Package' : 'Create Package' }}
            </button>
            <a href="{{ route('admin.packages') }}" class="px-6 py-3 bg-gray-200 text-gray-700 font-medium rounded-xl hover:bg-gray-300 transition-all">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
