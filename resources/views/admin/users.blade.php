@extends('layouts.admin')

@section('title', 'Manage Users')
@section('page-title', 'User Management')

@section('content')
<div class="glass-card overflow-hidden">
    <!-- Header with Search -->
    <div class="p-4 md:p-6 border-b border-gray-200">
        <div class="flex flex-col gap-4">
            <div>
                <h2 class="text-xl md:text-2xl font-semibold text-gray-900">All Users</h2>
                <p class="text-gray-500 text-xs md:text-sm mt-1">
                    Manage user accounts, balances and monitor activity
                    <span class="block mt-1 text-gray-400">{{ $users->total() }} total users</span>
                </p>
            </div>
            
            <!-- Search & Filter -->
            <form action="{{ route('admin.users') }}" method="GET" class="flex flex-col sm:flex-row gap-2">
                <div class="flex-1">
                    <input type="text" name="search" value="{{ request('search') }}" 
                        placeholder="Search by name or email..."
                        class="w-full px-4 py-2.5 rounded-lg bg-gray-50 border border-gray-200 text-sm text-gray-900 placeholder-gray-400 focus:border-purple-500 focus:bg-white focus:ring-2 focus:ring-purple-500/20 outline-none transition-all">
                </div>
                <button type="submit" class="px-4 py-2.5 bg-purple-500 text-white text-sm font-medium rounded-lg hover:bg-purple-600 transition-colors flex items-center justify-center gap-2 whitespace-nowrap">
                    <i class="fas fa-search text-sm"></i>
                    <span class="hidden sm:inline">Search</span>
                </button>
                @if(request('search'))
                <a href="{{ route('admin.users') }}" class="px-4 py-2.5 bg-gray-200 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-300 transition-colors flex items-center justify-center gap-2 whitespace-nowrap">
                    <i class="fas fa-times text-sm"></i>
                    <span class="hidden sm:inline">Clear</span>
                </a>
                @endif
            </form>
        </div>
    </div>
    
    <!-- Users Content -->
    <div class="p-4 md:p-6">
        @if($users->count() > 0)
        
        <!-- Desktop Table View -->
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-left text-xs text-gray-600 uppercase tracking-wider border-b border-gray-200">
                        <th class="pb-4 font-semibold pl-0">User</th>
                        <th class="pb-4 font-semibold text-right">Balance</th>
                        <th class="pb-4 font-semibold text-right">Invested</th>
                        <th class="pb-4 font-semibold text-right">Net Profit</th>
                        <th class="pb-4 font-semibold text-center">Status</th>
                        <th class="pb-4 font-semibold">Joined</th>
                        <th class="pb-4 font-semibold text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($users as $user)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="py-4 pl-0">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-purple-500 to-pink-600 flex items-center justify-center text-white font-bold text-sm flex-shrink-0">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div class="min-w-0">
                                    <p class="font-medium text-gray-900 truncate text-sm">{{ $user->name }}</p>
                                    <p class="text-xs text-gray-500 truncate">{{ $user->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 text-right">
                            <p class="font-semibold text-amber-500 text-sm">${{ number_format($user->balance, 2) }}</p>
                        </td>
                        <td class="py-4 text-right">
                            <p class="text-gray-600 text-sm">${{ number_format($user->total_invested, 2) }}</p>
                        </td>
                        @php
                            $activeInvestments = $user->investments->whereIn('status', ['active', 'paused', 'pending']);
                            $userNetProfit = $activeInvestments->sum('withdrawable_profit') - $activeInvestments->sum('loss');
                        @endphp
                        <td class="py-4 text-right">
                            <p class="font-medium text-sm {{ $userNetProfit >= 0 ? 'text-green-500' : 'text-red-500' }}">{{ $userNetProfit >= 0 ? '+' : '' }}${{ number_format($userNetProfit, 2) }}</p>
                        </td>
                        <td class="py-4 text-center">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium
                                @if($user->is_active) 
                                    bg-green-50 text-green-700 border border-green-200
                                @else 
                                    bg-red-50 text-red-700 border border-red-200
                                @endif">
                                <span class="w-2 h-2 rounded-full @if($user->is_active) bg-green-500 @else bg-red-500 @endif"></span>
                                {{ $user->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="py-4">
                            <p class="text-gray-500 text-sm">{{ $user->created_at->format('M d, Y') }}</p>
                        </td>
                        <td class="py-4 text-right">
                            <a href="{{ route('admin.user-detail', $user->id) }}" 
                                class="inline-flex items-center gap-2 px-3 py-1.5 bg-purple-50 text-purple-600 rounded-lg hover:bg-purple-100 transition-colors text-sm font-medium border border-purple-200">
                                <i class="fas fa-eye text-xs"></i>
                                View
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Mobile Card View -->
        <div class="md:hidden space-y-3">
            @foreach($users as $user)
            <div class="bg-gray-50 rounded-lg border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
                <!-- Card Header -->
                <div class="p-4 border-b border-gray-200 flex items-start justify-between gap-3">
                    <div class="flex items-center gap-3 flex-1 min-w-0">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-purple-500 to-pink-600 flex items-center justify-center text-white font-bold text-sm flex-shrink-0">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="font-semibold text-gray-900 truncate text-sm">{{ $user->name }}</p>
                            <p class="text-xs text-gray-500 truncate">{{ $user->email }}</p>
                        </div>
                    </div>
                    <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded-full text-xs font-medium flex-shrink-0
                        @if($user->is_active) 
                            bg-green-50 text-green-700 border border-green-200
                        @else 
                            bg-red-50 text-red-700 border border-red-200
                        @endif">
                        <span class="w-1.5 h-1.5 rounded-full @if($user->is_active) bg-green-500 @else bg-red-500 @endif"></span>
                        {{ $user->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </div>

                <!-- Card Body -->
                <div class="p-4 space-y-3">
                    <div class="grid grid-cols-3 gap-3">
                        <div>
                            <p class="text-xs text-gray-500 font-medium uppercase tracking-wider">Balance</p>
                            <p class="text-sm font-bold text-amber-500 mt-1">${{ number_format($user->balance, 2) }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-medium uppercase tracking-wider">Invested</p>
                            <p class="text-sm font-semibold text-gray-900 mt-1">${{ number_format($user->total_invested, 2) }}</p>
                        </div>
                        @php
                            $mobileActiveInvestments = $user->investments->whereIn('status', ['active', 'paused', 'pending']);
                            $mobileNetProfit = $mobileActiveInvestments->sum('withdrawable_profit') - $mobileActiveInvestments->sum('loss');
                        @endphp
                        <div>
                            <p class="text-xs text-gray-500 font-medium uppercase tracking-wider">Net Profit</p>
                            <p class="text-sm font-bold mt-1 {{ $mobileNetProfit >= 0 ? 'text-green-500' : 'text-red-500' }}">{{ $mobileNetProfit >= 0 ? '+' : '' }}${{ number_format($mobileNetProfit, 2) }}</p>
                        </div>
                    </div>
                    
                    <div class="pt-2 border-t border-gray-200">
                        <p class="text-xs text-gray-500">Joined {{ $user->created_at->format('M d, Y') }}</p>
                    </div>
                </div>

                <!-- Card Footer -->
                <div class="px-4 py-3 bg-gray-100 border-t border-gray-200">
                    <a href="{{ route('admin.user-detail', $user->id) }}" 
                        class="w-full flex items-center justify-center gap-2 px-3 py-2 bg-purple-500 text-white rounded-lg hover:bg-purple-600 transition-colors text-sm font-medium">
                        <i class="fas fa-eye text-xs"></i>
                        View Details
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        
        <!-- Pagination -->
        <div class="mt-6">
            {{ $users->links() }}
        </div>

        @else
        <!-- Empty State -->
        <div class="text-center py-12 md:py-20">
            <div class="w-16 h-16 md:w-20 md:h-20 mx-auto rounded-full bg-gray-100 flex items-center justify-center mb-4 md:mb-6">
                <i class="fas fa-users text-gray-400 text-3xl md:text-4xl"></i>
            </div>
            <h3 class="text-lg md:text-xl font-semibold text-gray-900 mb-2">No Users Found</h3>
            <p class="text-gray-500 text-sm md:text-base max-w-md mx-auto">
                @if(request('search'))
                    No users match your search criteria. Try adjusting your filters.
                @else
                    No users have registered yet. They'll appear here once sign-ups begin.
                @endif
            </p>
            @if(request('search'))
            <a href="{{ route('admin.users') }}" class="inline-flex items-center gap-2 mt-6 px-4 py-2 bg-purple-500 text-white rounded-lg hover:bg-purple-600 transition-colors text-sm font-medium">
                <i class="fas fa-arrow-left"></i>
                Back to All Users
            </a>
            @endif
        </div>
        @endif
    </div>
</div>

@endsection

@section('styles')
<style>
    /* Smooth transitions and focus states */
    input[type="text"]:focus {
        box-shadow: 0 0 0 3px rgba(168, 85, 247, 0.1);
    }

    /* Table row hover effect */
    tbody tr {
        transition: background-color 0.2s ease;
    }

    tbody tr:hover {
        background-color: rgba(249, 250, 251, 0.8);
    }

    /* Mobile optimizations */
    @media (max-width: 768px) {
        .glass-card {
            border-radius: 12px;
        }

        /* Ensure clickable areas are touch-friendly */
        a, button {
            min-height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    }

    /* Responsive pagination */
    .pagination {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
        justify-content: center;
    }

    .pagination a,
    .pagination button {
        padding: 0.5rem 0.75rem;
        border-radius: 0.5rem;
        font-size: 0.875rem;
    }

    /* Ensure truncated text is handled properly */
    .truncate {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
</style>
@endsection