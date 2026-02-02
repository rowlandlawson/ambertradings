@extends('layouts.admin')

@section('title', 'Manage Users')
@section('page-title', 'User Management')

@section('content')
<div class="glass-card overflow-hidden">
    <!-- Header -->
    <div class="p-6 border-b border-gray-200">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-xl font-semibold">All Users</h2>
                <p class="text-gray-500 text-sm mt-1">Manage user accounts and balances</p>
            </div>
            
            <!-- Search -->
            <form action="{{ route('admin.users') }}" method="GET" class="flex gap-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search users..."
                    class="px-4 py-2 rounded-xl bg-gray-50 border border-gray-200 text-gray-900 placeholder-gray-400 focus:border-purple-500 outline-none">
                <button type="submit" class="px-4 py-2 bg-purple-500 text-white rounded-xl hover:bg-purple-600 transition-colors">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
    </div>
    
    <!-- Users Table -->
    <div class="p-6">
        @if($users->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-left text-xs text-gray-500 uppercase border-b border-gray-200">
                        <th class="pb-4 font-medium">User</th>
                        <th class="pb-4 font-medium">Balance</th>
                        <th class="pb-4 font-medium">Invested</th>
                        <th class="pb-4 font-medium">Profit</th>
                        <th class="pb-4 font-medium">Status</th>
                        <th class="pb-4 font-medium">Joined</th>
                        <th class="pb-4 font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                        <td class="py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-purple-500 to-pink-600 flex items-center justify-center font-bold">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">{{ $user->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $user->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 font-semibold text-amber-400">${{ number_format($user->balance, 2) }}</td>
                        <td class="py-4 text-gray-900">${{ number_format($user->total_invested, 2) }}</td>
                        <td class="py-4 text-green-400">${{ number_format($user->total_profit, 2) }}</td>
                        <td class="py-4">
                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium
                                {{ $user->is_active ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' }}">
                                <i class="fas fa-circle text-[6px]"></i>
                                {{ $user->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="py-4 text-gray-400 text-sm">{{ $user->created_at->format('M d, Y') }}</td>
                        <td class="py-4">
                            <a href="{{ route('admin.user-detail', $user->id) }}" 
                                class="inline-flex items-center gap-2 px-4 py-2 bg-purple-500/20 text-purple-400 rounded-lg hover:bg-purple-500/30 transition-colors">
                                <i class="fas fa-eye"></i>
                                <span>View</span>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="mt-6">
            {{ $users->links() }}
        </div>
        @else
        <div class="text-center py-16">
            <div class="w-20 h-20 mx-auto rounded-full bg-white/5 flex items-center justify-center mb-6">
                <i class="fas fa-users text-gray-500 text-3xl"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">No Users Found</h3>
            <p class="text-gray-500">
                @if(request('search'))
                    No users match your search criteria.
                @else
                    No users have registered yet.
                @endif
            </p>
        </div>
        @endif
    </div>
</div>
@endsection
