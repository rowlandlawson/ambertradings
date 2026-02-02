@extends('layouts.admin')

@section('title', 'Investment Packages')
@section('page-title', 'Investment Packages')

@section('content')
<div class="glass-card overflow-hidden">
    <!-- Header -->
    <div class="p-6 border-b border-gray-200">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-xl font-semibold">Investment Packages</h2>
                <p class="text-gray-500 text-sm mt-1">Manage available investment plans for users</p>
            </div>
            <a href="{{ route('admin.package.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-purple-500 to-pink-600 text-white rounded-xl hover:from-purple-600 hover:to-pink-700 transition-all">
                <i class="fas fa-plus"></i>
                <span>Add Package</span>
            </a>
        </div>
    </div>
    
    <!-- Packages Grid -->
    <div class="p-6">
        @if($packages->count() > 0)
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($packages as $package)
            <div class="bg-gray-50 rounded-2xl p-6 border border-gray-200 hover:border-purple-500/30 transition-all">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-500/20 to-pink-500/10 flex items-center justify-center">
                        <i class="{{ $package->icon ?? 'fas fa-gem' }} text-purple-400 text-xl"></i>
                    </div>
                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium
                        {{ $package->is_active ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' }}">
                        {{ $package->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </div>
                
                <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $package->name }}</h3>
                <p class="text-sm text-gray-500 mb-4 line-clamp-2">{{ $package->description ?? 'No description' }}</p>
                
                <div class="space-y-2 mb-4 pt-4 border-t border-gray-200">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Investment Range</span>
                        <span class="text-gray-900">${{ number_format($package->min_amount) }} - ${{ number_format($package->max_amount) }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">ROI</span>
                        <span class="text-green-600 font-semibold">{{ $package->roi_percentage }}%</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Duration</span>
                        <span class="text-gray-900">{{ $package->duration_days }} days</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Risk Level</span>
                        <span class="px-2 py-0.5 rounded text-xs font-medium
                            @if($package->risk_level == 'low') bg-green-500/20 text-green-400
                            @elseif($package->risk_level == 'medium') bg-yellow-500/20 text-yellow-400
                            @else bg-red-500/20 text-red-400 @endif">
                            {{ ucfirst($package->risk_level) }}
                        </span>
                    </div>
                </div>
                
                <div class="flex items-center gap-2 pt-4 border-t border-gray-200">
                    <a href="{{ route('admin.package.edit', $package->id) }}" 
                        class="flex-1 py-2 text-center text-blue-400 bg-blue-500/10 rounded-lg hover:bg-blue-500/20 transition-colors">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </a>
                    <form action="{{ route('admin.package.delete', $package->id) }}" method="POST" class="flex-1"
                        onsubmit="return confirm('Are you sure you want to delete this package?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full py-2 text-red-400 bg-red-500/10 rounded-lg hover:bg-red-500/20 transition-colors">
                            <i class="fas fa-trash mr-1"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        
        <!-- Pagination -->
        <div class="mt-6">
            {{ $packages->links() }}
        </div>
        @else
        <div class="text-center py-16">
            <div class="w-20 h-20 mx-auto rounded-full bg-white/5 flex items-center justify-center mb-6">
                <i class="fas fa-box text-gray-500 text-3xl"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">No Packages Yet</h3>
            <p class="text-gray-500 mb-6">Create your first investment package to get started.</p>
            <a href="{{ route('admin.package.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-purple-500 to-pink-600 text-white rounded-xl">
                <i class="fas fa-plus"></i> Create Package
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
