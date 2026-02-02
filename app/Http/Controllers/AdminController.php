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
     * Display all users.
     */
    public function users(Request $request)
    {
        $query = User::where('role', 'user');

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
        $transactions = $user->transactions()->orderBy('created_at', 'desc')->take(20)->get();
        $packages = InvestmentPackage::where('is_active', true)->get();

        return view('admin.user-detail', compact('user', 'investments', 'transactions', 'packages'));
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
            'profit' => ['nullable', 'numeric'], // Allow negative for losses
            'roi_percentage' => ['nullable', 'numeric'],
            'status' => ['required', 'in:pending,active,completed,cancelled'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $user = User::findOrFail($id);
        $investment = Investment::where('user_id', $id)->findOrFail($investmentId);

        // Calculate profit difference (new profit - old profit)
        $oldProfit = $investment->profit ?? 0;
        $newProfit = $validated['profit'] ?? 0;
        $profitDiff = $newProfit - $oldProfit;
        $amountDiff = $validated['amount'] - $investment->amount;

        $investment->update($validated);

        // Update user totals
        $user->total_invested += $amountDiff;
        
        if ($profitDiff != 0) {
            $user->total_profit += $profitDiff;
            $user->balance += $profitDiff; // Add profit to balance (or subtract if negative/loss)
            
            // Create transaction record for profit/loss
            Transaction::create([
                'user_id' => $user->id,
                'type' => $profitDiff > 0 ? 'profit' : 'loss',
                'amount' => abs($profitDiff),
                'status' => 'completed',
                'description' => $profitDiff > 0 
                    ? 'Profit from ' . $validated['type'] . ' investment' 
                    : 'Loss from ' . $validated['type'] . ' investment',
                'reference' => Transaction::generateReference(),
            ]);
        }
        $user->save();

        // Send email notification
        $profitLabel = $newProfit >= 0 ? 'Profit: +$' : 'Loss: -$';
        $this->sendUpdateEmail($user, 'investment_updated', [
            'Investment Type' => $validated['type'],
            'Amount' => '$' . number_format($validated['amount'], 2),
            'Current ' . ($newProfit >= 0 ? 'Profit' : 'Loss') => ($newProfit >= 0 ? '+' : '-') . '$' . number_format(abs($newProfit), 2),
            'Status' => ucfirst($validated['status']),
        ]);

        return back()->with('success', 'Investment updated successfully! User balance updated and email notification sent.');
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

        return back()->with('success', 'Deposit request rejected.');
    }
}

