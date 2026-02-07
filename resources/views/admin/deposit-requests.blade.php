@extends('layouts.admin')

@section('title', 'Deposit Requests')
@section('page-title', 'Deposit Requests')

@section('content')
<!-- Stats -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="stat-card">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl bg-yellow-100 flex items-center justify-center">
                <i class="fas fa-clock text-yellow-600 text-xl"></i>
            </div>
            <span class="text-xs text-gray-400 uppercase font-medium">Pending</span>
        </div>
        <h3 class="text-3xl font-bold text-yellow-600 mb-1">{{ $pendingCount }}</h3>
        <p class="text-sm text-gray-500">Awaiting approval</p>
    </div>
    
    <div class="stat-card">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center">
                <i class="fas fa-check-circle text-green-600 text-xl"></i>
            </div>
            <span class="text-xs text-gray-400 uppercase font-medium">Approved</span>
        </div>
        <h3 class="text-3xl font-bold text-green-600 mb-1">{{ $depositRequests->where('status', 'approved')->count() }}</h3>
        <p class="text-sm text-gray-500">This page</p>
    </div>
    
    <div class="stat-card">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl bg-red-100 flex items-center justify-center">
                <i class="fas fa-times-circle text-red-600 text-xl"></i>
            </div>
            <span class="text-xs text-gray-400 uppercase font-medium">Rejected</span>
        </div>
        <h3 class="text-3xl font-bold text-red-600 mb-1">{{ $depositRequests->where('status', 'rejected')->count() }}</h3>
        <p class="text-sm text-gray-500">This page</p>
    </div>
</div>

<!-- Deposit Requests Table -->
<div class="glass-card overflow-hidden">
    <div class="p-6 border-b border-gray-100">
        <h3 class="text-lg font-semibold text-gray-900">All Deposit Requests</h3>
        <p class="text-sm text-gray-500 mt-1">Review and process user deposit requests</p>
    </div>
    
    <div class="p-6">
        @if($depositRequests->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-left text-xs text-gray-500 uppercase border-b border-gray-200">
                        <th class="pb-4 font-medium">User</th>
                        <th class="pb-4 font-medium">Amount</th>
                        <th class="pb-4 font-medium">Payment Method</th>
                        <th class="pb-4 font-medium">Receipt</th>
                        <th class="pb-4 font-medium">Date</th>
                        <th class="pb-4 font-medium">Status</th>
                        <th class="pb-4 font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($depositRequests as $deposit)
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                        <td class="py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full gradient-blue flex items-center justify-center text-white font-bold text-sm">
                                    {{ strtoupper(substr($deposit->user->name ?? 'U', 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">{{ $deposit->user->name ?? 'Unknown' }}</p>
                                    <p class="text-xs text-gray-500">{{ $deposit->user->email ?? '' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-4">
                            <span class="text-lg font-bold text-gray-900">${{ number_format($deposit->amount, 2) }}</span>
                        </td>
                        <td class="py-4">
                            <div class="flex items-center gap-2">
                                <i class="{{ $deposit->paymentMethod->icon_class ?? 'fas fa-wallet' }} text-gray-400"></i>
                                <span class="text-sm text-gray-700">{{ $deposit->paymentMethod->name ?? 'Unknown' }}</span>
                            </div>
                        </td>
                        <td class="py-4">
                            <a href="{{ asset('storage/' . $deposit->receipt_image) }}" target="_blank" 
                               class="inline-flex items-center gap-2 px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg text-sm transition-colors">
                                <i class="fas fa-image"></i>
                                View Receipt
                            </a>
                        </td>
                        <td class="py-4 text-sm text-gray-500">
                            {{ $deposit->created_at->format('M d, Y H:i') }}
                        </td>
                        <td class="py-4">
                            <span class="px-3 py-1 rounded-full text-xs font-medium {{ $deposit->status_badge_class }}">
                                {{ ucfirst($deposit->status) }}
                            </span>
                        </td>
                        <td class="py-4">
                            @if($deposit->status === 'pending')
                            <div class="flex items-center gap-2">
                                <button onclick="openApproveModal('{{ $deposit->id }}', '{{ $deposit->amount }}', '{{ $deposit->user->name ?? 'User' }}')" 
                                        class="p-2 bg-green-100 text-green-600 hover:bg-green-200 rounded-lg transition-colors" 
                                        title="Approve">
                                    <i class="fas fa-check"></i>
                                </button>
                                <button onclick="openRejectModal('{{ $deposit->id }}', '{{ $deposit->user->name ?? 'User' }}')" 
                                        class="p-2 bg-red-100 text-red-600 hover:bg-red-200 rounded-lg transition-colors" 
                                        title="Reject">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            @else
                            <span class="text-sm text-gray-400">
                                {{ $deposit->processed_at ? $deposit->processed_at->diffForHumans() : '-' }}
                            </span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="mt-6">
            {{ $depositRequests->links() }}
        </div>
        @else
        <div class="text-center py-16">
            <div class="w-20 h-20 mx-auto rounded-full bg-gray-100 flex items-center justify-center mb-6">
                <i class="fas fa-inbox text-gray-400 text-3xl"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">No Deposit Requests</h3>
            <p class="text-gray-500">There are no deposit requests yet.</p>
        </div>
        @endif
    </div>
</div>

</div>

<!-- Rejection Modal -->
<div id="rejectModal" class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center backdrop-blur-sm transition-opacity duration-300">
    <div class="bg-white rounded-2xl w-full max-w-md p-6 m-4 shadow-2xl transform transition-transform duration-300 scale-95 opacity-0" id="rejectModalContent">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold text-red-600">Reject Deposit</h3>
            <button onclick="closeRejectModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        
        <form id="rejectForm" method="POST" class="space-y-4">
            @csrf
            
            <div class="p-4 bg-red-50 rounded-xl border border-red-100 mb-4">
                <p class="text-sm text-red-600 mb-1">Rejecting deposit for:</p>
                <p class="font-bold text-red-900 text-lg" id="rejectModalUserName">User Name</p>
            </div>
            
            <div class="flex items-start gap-3 p-3 bg-yellow-50 text-yellow-800 text-sm rounded-lg mb-4">
                <i class="fas fa-exclamation-triangle mt-0.5"></i>
                <p>This action cannot be undone. The user will be notified via email.</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Reason for Rejection (Required)</label>
                <textarea name="admin_notes" rows="3" required placeholder="e.g., Payment not received, Invalid receipt..."
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 focus:bg-white focus:border-red-500 outline-none transition-colors"></textarea>
            </div>
            
            <div class="flex gap-3 mt-6">
                <button type="button" onclick="closeRejectModal()" class="flex-1 px-4 py-3 bg-gray-100 text-gray-700 font-medium rounded-xl hover:bg-gray-200 transition-colors">
                    Cancel
                </button>
                <button type="submit" class="flex-1 px-4 py-3 bg-red-600 text-white font-bold rounded-xl hover:bg-red-700 transition-colors shadow-lg shadow-red-500/30">
                    Reject Deposit
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Approval Modal -->
<div id="approveModal" class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center backdrop-blur-sm transition-opacity duration-300">
    <div class="bg-white rounded-2xl w-full max-w-md p-6 m-4 shadow-2xl transform transition-transform duration-300 scale-95 opacity-0" id="approveModalContent">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold text-gray-900">Approve Deposit</h3>
            <button onclick="closeApproveModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        
        <form id="approveForm" method="POST" class="space-y-4">
            @csrf
            
            <div class="p-4 bg-blue-50 rounded-xl border border-blue-100 mb-4">
                <p class="text-sm text-blue-600 mb-1">Approving deposit for:</p>
                <p class="font-bold text-blue-900 text-lg" id="modalUserName">User Name</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Confirmed Amount ($)</label>
                <div class="relative">
                    <span class="absolute left-4 top-3 text-gray-400 font-medium">$</span>
                    <input type="number" name="amount" id="modalAmount" step="0.01" min="0" required
                        class="w-full pl-8 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 font-bold text-lg focus:bg-white focus:border-blue-500 outline-none transition-colors">
                </div>
                <p class="text-xs text-gray-500 mt-2">Adjust this if the received amount differs from request.</p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Admin Notes (Optional)</label>
                <textarea name="admin_notes" rows="2" placeholder="Any internal notes..."
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 focus:bg-white focus:border-blue-500 outline-none transition-colors"></textarea>
            </div>
            
            <div class="flex gap-3 mt-6">
                <button type="button" onclick="closeApproveModal()" class="flex-1 px-4 py-3 bg-gray-100 text-gray-700 font-medium rounded-xl hover:bg-gray-200 transition-colors">
                    Cancel
                </button>
                <button type="submit" class="flex-1 px-4 py-3 gradient-green text-white font-bold rounded-xl hover:opacity-90 transition-opacity shadow-lg shadow-green-500/30">
                    Confirm & Approve
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openApproveModal(id, amount, userName) {
        const modal = document.getElementById('approveModal');
        const content = document.getElementById('approveModalContent');
        const form = document.getElementById('approveForm');
        
        // Set form action
        form.action = `/admin/deposits/${id}/approve`;
        
        // Set values
        document.getElementById('modalAmount').value = amount;
        document.getElementById('modalUserName').innerText = userName;
        
        // Show modal with animation
        modal.classList.remove('hidden');
        // Small delay to allow display:block to apply before opacity transition
        setTimeout(() => {
            content.classList.remove('scale-95', 'opacity-0');
            content.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeApproveModal() {
        const modal = document.getElementById('approveModal');
        const content = document.getElementById('approveModalContent');
        
        content.classList.remove('scale-100', 'opacity-100');
        content.classList.add('scale-95', 'opacity-0');
        
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }
    
    // Close on outside click
    document.getElementById('approveModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeApproveModal();
        }
    });

    // Reject Modal Functions
    function openRejectModal(id, userName) {
        const modal = document.getElementById('rejectModal');
        const content = document.getElementById('rejectModalContent');
        const form = document.getElementById('rejectForm');
        
        form.action = `/admin/deposits/${id}/reject`;
        document.getElementById('rejectModalUserName').innerText = userName;
        
        modal.classList.remove('hidden');
        setTimeout(() => {
            content.classList.remove('scale-95', 'opacity-0');
            content.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeRejectModal() {
        const modal = document.getElementById('rejectModal');
        const content = document.getElementById('rejectModalContent');
        
        content.classList.remove('scale-100', 'opacity-100');
        content.classList.add('scale-95', 'opacity-0');
        
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    document.getElementById('rejectModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeRejectModal();
        }
    });

    // Prevent double submission on all forms
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function() {
            const btn = this.querySelector('button[type="submit"]');
            if (btn && !btn.disabled) {
                const originalText = btn.innerHTML;
                btn.disabled = true;
                btn.style.opacity = '0.7';
                btn.style.cursor = 'not-allowed';
                btn.innerHTML = '<i class="fas fa-spinner fa-spin animate-spin"></i> Processing...';
                
                // Allow re-enable if submission fails or takes too long (optional safety)
                // setTimeout(() => {
                //     btn.disabled = false;
                //     btn.style.opacity = '1';
                //     btn.style.cursor = 'pointer';
                //     btn.innerHTML = originalText;
                // }, 10000);
            }
        });
    });
</script>
@endsection
