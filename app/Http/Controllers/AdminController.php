<?php

namespace App\Http\Controllers;

use App\Mail\DashboardUpdated;
use App\Models\DepositRequest;
use App\Models\Investment;
use App\Models\InvestmentPackage;
use App\Models\PaymentMethod;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display admin dashboard.
     */
    public function index()
    {
        // Stats
        $totalUsers = User::where('role', 'user')->count();
        $totalInvested = Investment::sum('amount');
        $totalProfit = Investment::sum('profit');
        $activePackages = InvestmentPackage::where('is_active', true)->count();
        
        // Recent Data
        $recentUsers = User::where('role', 'user')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $recentInvestments = Investment::with('user')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('admin.index', compact(
            'totalUsers', 
            'totalInvested', 
            'totalProfit', 
            'activePackages', 
            'recentUsers', 
            'recentInvestments'
        ));
    }

    /**
     * Show admin profile.
     */
    public function profile()
    {
        $user = auth()->user();
        return view('admin.profile', compact('user'));
    }

    /**
     * Update admin profile.
     */
    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|confirmed',
        ]);

        // Verify current password if changing password
        if ($request->filled('current_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'The provided password does not match your current password.']);
            }
        }

        $user->name = $request->name;
        $user->email = $request->email;

        // Update password if provided
        if ($request->filled('new_password')) {
            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return back()->with('success', 'Profile updated successfully!');
    }

    /**
     * Display all users.
     */
    public function users(Request $request)
    {
        $query = User::where('role', 'user')->with('investments');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.users', compact('users'));
    }

    /**
     * Display user detail.
     */
    public function userDetail($id)
    {
        $user = User::findOrFail($id);
        $investments = $user->investments()->with('package')->orderBy('created_at', 'desc')->get();
        $transactions = $user->transactions()->orderBy('created_at', 'desc')->paginate(15);
        $packages = InvestmentPackage::where('is_active', true)->get();

        return view('admin.user-detail', compact('user', 'investments', 'transactions', 'packages'));
    }

    /**
     * Delete user.
     */
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }

    /**
     * Update user balance.
     */
    public function updateBalance(Request $request, $id)
    {
        $validated = $request->validate([
            'amount' => ['required', 'numeric'],
            'type' => ['required', 'in:add,subtract'],
            'description' => ['nullable', 'string', 'max:500'],
        ]);

        $user = User::findOrFail($id);
        $amount = abs($validated['amount']);

        if ($validated['type'] === 'add') {
            $user->balance += $amount;
            $transactionType = 'deposit';
        } else {
            $user->balance -= $amount;
            $transactionType = 'withdrawal';
        }

        $user->save();

        // Create transaction record
        Transaction::create([
            'user_id' => $user->id,
            'type' => $transactionType,
            'amount' => $amount,
            'status' => 'completed',
            'description' => $validated['description'] ?? 'Admin balance adjustment',
            'reference' => Transaction::generateReference(),
        ]);

        // Send email notification
        $this->sendUpdateEmail($user, 'balance_updated', [
            'Type' => $validated['type'] === 'add' ? 'Credit' : 'Debit',
            'Amount' => '$' . number_format($amount, 2),
            'New Balance' => '$' . number_format($user->balance, 2),
            'Description' => $validated['description'] ?? 'Admin balance adjustment',
        ]);

        return back()->with('success', 'User balance updated successfully! Email notification sent.');
    }

    /**
     * Add investment to user.
     */
    public function addInvestment(Request $request, $id)
    {
        $validated = $request->validate([
            'investment_package_id' => ['nullable', 'exists:investment_packages,id'],
            'type' => ['required', 'string', 'max:100'],
            'amount' => ['required', 'numeric', 'min:0'],
            'profit' => ['nullable', 'numeric', 'min:0'],
            'roi_percentage' => ['nullable', 'numeric', 'min:0'],
            'status' => ['required', 'in:pending,active,completed,cancelled'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $user = User::findOrFail($id);

        $investment = Investment::create([
            'user_id' => $user->id,
            'investment_package_id' => $validated['investment_package_id'],
            'type' => $validated['type'],
            'amount' => $validated['amount'],
            'profit' => $validated['profit'] ?? 0,
            'roi_percentage' => $validated['roi_percentage'] ?? 0,
            'status' => $validated['status'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'notes' => $validated['notes'],
        ]);

        // Update user totals
        $user->total_invested += $validated['amount'];
        if ($validated['profit']) {
            $user->total_profit += $validated['profit'];
            $user->balance += $validated['profit'];
        }
        $user->save();

        // Send email notification
        $this->sendUpdateEmail($user, 'investment_added', [
            'Investment Type' => $validated['type'],
            'Amount Invested' => '$' . number_format($validated['amount'], 2),
            'Profit' => '$' . number_format($validated['profit'] ?? 0, 2),
            'Status' => ucfirst($validated['status']),
        ]);

        return back()->with('success', 'Investment added successfully! Email notification sent.');
    }

    /**
     * Update user investment.
     */
    public function updateInvestment(Request $request, $id, $investmentId)
    {
        $validated = $request->validate([
            'investment_package_id' => ['nullable', 'exists:investment_packages,id'],
            'type' => ['required', 'string', 'max:100'],
            'amount' => ['required', 'numeric', 'min:0'],
            'add_profit' => ['nullable', 'numeric', 'min:0'],
            'add_loss' => ['nullable', 'numeric', 'min:0'],
            'roi_percentage' => ['nullable', 'numeric'],
            'status' => ['required', 'in:pending,active,completed,cancelled,paused'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $user = User::findOrFail($id);
        $investment = Investment::where('user_id', $id)->findOrFail($investmentId);

        // Calculate differences
        $amountDiff = $validated['amount'] - $investment->amount;
        
        // Get values to ADD (cumulative)
        $profitToAdd = $validated['add_profit'] ?? 0;
        $lossToAdd = $validated['add_loss'] ?? 0;
        
        // Calculate current value before update
        $currentValueBeforeUpdate = $investment->current_value;
        
        // If current value is already zero or negative, block profit additions
        if ($currentValueBeforeUpdate <= 0 && $profitToAdd > 0) {
            return back()->with('error', 'Cannot add profit! Investment current value is zero. User must top up their investment first.');
        }
        
        // Calculate new totals (add to existing)
        $newTotalProfit = ($investment->withdrawable_profit ?? 0) + $profitToAdd;
        $newTotalLoss = ($investment->loss ?? 0) + $lossToAdd;
        
        // Calculate new current value after update
        $newCurrentValue = $validated['amount'] + $newTotalProfit - $newTotalLoss;
        
        // Determine status - if current value hits zero, pause the investment
        $newStatus = $validated['status'];
        if ($newCurrentValue <= 0 && $validated['status'] === 'active') {
            $newStatus = 'paused';
        }

        // Update investment with new values
        $investment->update([
            'investment_package_id' => $validated['investment_package_id'],
            'type' => $validated['type'],
            'amount' => $validated['amount'],
            'withdrawable_profit' => $newTotalProfit,
            'loss' => $newTotalLoss,
            'roi_percentage' => $validated['roi_percentage'] ?? 0,
            'status' => $newStatus,
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'notes' => $validated['notes'],
        ]);

        // Update user totals if amount changed
        if ($amountDiff != 0) {
            $user->total_invested += $amountDiff;
            $user->save();
        }

        // Create transaction records for profit/loss additions
        if ($profitToAdd > 0) {
            Transaction::create([
                'user_id' => $user->id,
                'type' => 'profit',
                'amount' => $profitToAdd,
                'status' => 'completed',
                'description' => 'Profit added to ' . $validated['type'] . ' investment',
                'reference' => Transaction::generateReference(),
            ]);
        }

        if ($lossToAdd > 0) {
            Transaction::create([
                'user_id' => $user->id,
                'type' => 'loss',
                'amount' => $lossToAdd,
                'status' => 'completed',
                'description' => 'Loss recorded for ' . $validated['type'] . ' investment',
                'reference' => Transaction::generateReference(),
            ]);
        }

        // Check for 20% threshold warning
        $originalAmount = $validated['amount'];
        $thresholdAmount = $originalAmount * 0.20;
        $lowBalanceWarning = false;
        
        if ($newCurrentValue > 0 && $newCurrentValue <= $thresholdAmount && $currentValueBeforeUpdate > $thresholdAmount) {
            // Current value just dropped to 20% or below - send warning email
            $lowBalanceWarning = true;
            $this->sendLowBalanceWarningEmail($user, $investment, $newCurrentValue, $originalAmount);
        }
        
        // Check if investment was paused due to zero balance
        $pausedDueToZero = false;
        if ($newStatus === 'paused' && $validated['status'] === 'active') {
            $pausedDueToZero = true;
            $this->sendInvestmentPausedEmail($user, $investment);
        }

        // Determine email notification content
        $netProfit = $newTotalProfit - $newTotalLoss;
        $updateDetails = [
            'Investment Type' => $validated['type'],
            'Amount' => '$' . number_format($validated['amount'], 2),
            'Total Profit' => '+$' . number_format($newTotalProfit, 2),
            'Total Loss' => '-$' . number_format($newTotalLoss, 2),
            'Net Position' => ($netProfit >= 0 ? '+' : '-') . '$' . number_format(abs($netProfit), 2),
            'Current Value' => '$' . number_format(max(0, $newCurrentValue), 2),
            'Status' => ucfirst($newStatus),
        ];

        // Send regular update email notification
        $this->sendUpdateEmail($user, 'investment_updated', $updateDetails);

        $successMessage = 'Investment updated successfully! Email notification sent.';
        if ($lowBalanceWarning) {
            $successMessage .= ' Low balance warning email sent (value at 20% or below).';
        }
        if ($pausedDueToZero) {
            $successMessage .= ' Investment PAUSED due to zero balance.';
        }

        return back()->with('success', $successMessage);
    }
    
    /**
     * Send low balance warning email to user.
     */
    private function sendLowBalanceWarningEmail($user, $investment, $currentValue, $originalAmount)
    {
        $percentage = ($currentValue / $originalAmount) * 100;
        
        $details = [
            'subject' => '⚠️ Low Investment Balance Warning',
            'greeting' => 'Warning: Your investment balance is critically low!',
            'message' => "Your {$investment->type} investment has dropped to " . number_format($percentage, 1) . "% of its original value.",
            'Investment Type' => $investment->type,
            'Original Amount' => '$' . number_format($originalAmount, 2),
            'Current Value' => '$' . number_format($currentValue, 2),
            'Action Required' => 'Please top up your investment to continue trading.',
        ];
        
        $this->sendUpdateEmail($user, 'low_balance_warning', $details);
    }
    
    /**
     * Send investment paused email to user.
     */
    private function sendInvestmentPausedEmail($user, $investment)
    {
        $details = [
            'subject' => '🛑 Investment Trading Paused',
            'greeting' => 'Your investment trading has been paused!',
            'message' => "Your {$investment->type} investment has been paused because the current value has reached zero.",
            'Investment Type' => $investment->type,
            'Original Amount' => '$' . number_format($investment->amount, 2),
            'Status' => 'PAUSED',
            'Action Required' => 'Please top up your investment to resume trading. No profits can be added until you top up.',
        ];
        
        $this->sendUpdateEmail($user, 'investment_paused', $details);
    }

    /**
     * Delete user investment.
     */
    public function deleteInvestment($id, $investmentId)
    {
        $user = User::findOrFail($id);
        $investment = Investment::where('user_id', $id)->findOrFail($investmentId);

        // Revert user totals
        $user->total_invested -= $investment->amount;
        $user->total_profit -= $investment->profit;
        $user->balance -= $investment->profit;
        $user->save();

        $investment->delete();

        return back()->with('success', 'Investment deleted successfully!');
    }



    // ============================================
    // Investment Package Management
    // ============================================

    /**
     * Display all investment packages.
     */
    public function packages()
    {
        $packages = InvestmentPackage::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.packages', compact('packages'));
    }

    /**
     * Show create package form.
     */
    public function createPackage()
    {
        return view('admin.package-form', ['package' => null]);
    }

    /**
     * Store new investment package.
     */
    public function storePackage(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'min_amount' => ['required', 'numeric', 'min:0'],
            'max_amount' => ['required', 'numeric', 'min:0', 'gte:min_amount'],
            'roi_percentage' => ['required', 'numeric', 'min:0'],
            'duration_days' => ['required', 'integer', 'min:1'],
            'risk_level' => ['required', 'in:low,medium,high'],
            'is_active' => ['boolean'],
            'icon' => ['nullable', 'string', 'max:100'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        InvestmentPackage::create($validated);

        return redirect()->route('admin.packages')->with('success', 'Investment package created successfully!');
    }

    /**
     * Show edit package form.
     */
    public function editPackage($id)
    {
        $package = InvestmentPackage::findOrFail($id);
        return view('admin.package-form', compact('package'));
    }

    /**
     * Update investment package.
     */
    public function updatePackage(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'min_amount' => ['required', 'numeric', 'min:0'],
            'max_amount' => ['required', 'numeric', 'min:0', 'gte:min_amount'],
            'roi_percentage' => ['required', 'numeric', 'min:0'],
            'duration_days' => ['required', 'integer', 'min:1'],
            'risk_level' => ['required', 'in:low,medium,high'],
            'is_active' => ['boolean'],
            'icon' => ['nullable', 'string', 'max:100'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $package = InvestmentPackage::findOrFail($id);
        $package->update($validated);

        return redirect()->route('admin.packages')->with('success', 'Investment package updated successfully!');
    }

    /**
     * Delete investment package.
     */
    public function deletePackage($id)
    {
        $package = InvestmentPackage::findOrFail($id);
        $package->delete();

        return back()->with('success', 'Investment package deleted successfully!');
    }

    /**
     * Send dashboard update email to user.
     */
    protected function sendUpdateEmail(User $user, string $updateType, array $updateDetails = [])
    {
        try {
            Mail::to($user->email)->send(new DashboardUpdated($user, $updateType, $updateDetails));
        } catch (\Exception $e) {
            // Log the error but don't fail the main action
            \Log::error('Failed to send dashboard update email: ' . $e->getMessage());
        }
    }

    // ============================================
    // Payment Method Management
    // ============================================

    /**
     * Display payment settings page.
     */
    public function paymentSettings()
    {
        $paymentMethods = PaymentMethod::orderBy('sort_order')->get();
        return view('admin.payment-settings', compact('paymentMethods'));
    }

    /**
     * Update payment method.
     */
    public function updatePaymentMethod(Request $request, $id)
    {
        $method = PaymentMethod::findOrFail($id);

        $validated = $request->validate([
            'wallet_address' => ['nullable', 'string', 'max:500'],
            'bank_name' => ['nullable', 'string', 'max:255'],
            'account_name' => ['nullable', 'string', 'max:255'],
            'account_number' => ['nullable', 'string', 'max:100'],
            'routing_number' => ['nullable', 'string', 'max:100'],
            'swift_code' => ['nullable', 'string', 'max:50'],
            'bank_address' => ['nullable', 'string', 'max:500'],
            'instructions' => ['nullable', 'string', 'max:1000'],
            'is_active' => ['boolean'],
        ]);

        // Update based on type
        if ($method->type === 'crypto') {
            $method->wallet_address = $validated['wallet_address'] ?? null;
        } else {
            $method->bank_details = [
                'bank_name' => $validated['bank_name'] ?? null,
                'account_name' => $validated['account_name'] ?? null,
                'account_number' => $validated['account_number'] ?? null,
                'routing_number' => $validated['routing_number'] ?? null,
                'swift_code' => $validated['swift_code'] ?? null,
                'bank_address' => $validated['bank_address'] ?? null,
            ];
        }

        $method->instructions = $validated['instructions'] ?? $method->instructions;
        $method->is_active = $request->boolean('is_active');
        
        // Only activate if configured
        if ($method->is_active && !$method->isConfigured()) {
            return back()->with('error', 'Cannot activate payment method without wallet address or bank details.');
        }

        $method->save();

        return back()->with('success', $method->name . ' settings updated successfully!');
    }

    // ============================================
    // Deposit Request Management
    // ============================================

    /**
     * Display all deposit requests.
     */
    public function depositRequests()
    {
        $depositRequests = DepositRequest::with(['user', 'paymentMethod'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        $pendingCount = DepositRequest::where('status', 'pending')->count();

        return view('admin.deposit-requests', compact('depositRequests', 'pendingCount'));
    }

    /**
     * Approve deposit request.
     */
    public function approveDeposit(Request $request, $id)
    {
        $deposit = DepositRequest::with('user')->findOrFail($id);

        if ($deposit->status !== 'pending') {
            return back()->with('error', 'This deposit has already been processed.');
        }

        // Validate and use confirmed amount if provided, otherwise use original
        $validated = $request->validate([
            'amount' => ['nullable', 'numeric', 'min:0'],
            'admin_notes' => ['nullable', 'string'],
        ]);
        
        $finalAmount = $validated['amount'] ?? $deposit->amount;
        
        // Update deposit amount if changed
        if ($finalAmount != $deposit->amount) {
            $deposit->amount = $finalAmount;
            // Also add a note that amount was corrected
            $request->merge(['admin_notes' => ($request->admin_notes ? $request->admin_notes . "\n" : "") . "Amount corrected by admin."]);
        }

        // Update user balance
        $deposit->user->balance += $finalAmount;
        $deposit->user->save();

        // Create transaction record
        Transaction::create([
            'user_id' => $deposit->user_id,
            'type' => 'deposit',
            'amount' => $finalAmount,
            'status' => 'completed',
            'description' => 'Deposit via ' . $deposit->paymentMethod->name,
            'reference' => Transaction::generateReference(),
        ]);

        // Update deposit request
        $deposit->status = 'approved';
        $deposit->admin_notes = $request->input('admin_notes');
        $deposit->processed_at = now();
        $deposit->processed_by = auth()->id();
        $deposit->save();

        // Send email notification
        $this->sendUpdateEmail($deposit->user, 'deposit_approved', [
            'Amount' => '$' . number_format($finalAmount, 2),
            'Payment Method' => $deposit->paymentMethod->name,
            'New Balance' => '$' . number_format($deposit->user->balance, 2),
        ]);

        return redirect()->route('admin.deposits')->with('success', 'Deposit approved! $' . number_format($finalAmount, 2) . ' added to user balance.');
    }

    /**
     * Reject deposit request.
     */
    public function rejectDeposit(Request $request, $id)
    {
        $deposit = DepositRequest::with('user')->findOrFail($id);

        if ($deposit->status !== 'pending') {
            return back()->with('error', 'This deposit has already been processed.');
        }

        $deposit->status = 'rejected';
        $deposit->admin_notes = $request->input('admin_notes', 'Deposit rejected by admin');
        $deposit->processed_at = now();
        $deposit->processed_by = auth()->id();
        $deposit->save();

        // Send email notification
        $this->sendUpdateEmail($deposit->user, 'deposit_rejected', [
            'Amount' => '$' . number_format($deposit->amount, 2),
            'Payment Method' => $deposit->paymentMethod->name,
            'Reason' => $deposit->admin_notes,
        ]);

        return redirect()->route('admin.deposits')->with('success', 'Deposit request rejected.');
    }
}

