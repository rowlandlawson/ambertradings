<?php

namespace App\Http\Controllers;

use App\Models\DepositRequest;
use App\Models\Investment;
use App\Models\InvestmentPackage;
use App\Models\InvestmentTopup;
use App\Models\PaymentMethod;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    /**
     * Display the user dashboard.
     */
    public function index()
    {
        $user = Auth::user();
        
        $recentTransactions = Transaction::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        $activeInvestments = Investment::where('user_id', $user->id)
            ->where('status', 'active')
            ->with('package')
            ->orderBy('created_at', 'desc')
            ->get();
        
        // Get paused investments for alert banner
        $pausedInvestments = Investment::where('user_id', $user->id)
            ->where('status', 'paused')
            ->with('package')
            ->get();
        
        // Calculate total profit from all investments (profit - loss)
        $allInvestments = Investment::where('user_id', $user->id)->get();
        $totalProfit = $allInvestments->sum('withdrawable_profit') ?? 0;
        $totalLoss = $allInvestments->sum('loss') ?? 0;
        $netProfit = $totalProfit - $totalLoss;
            
        $stats = [
            'balance' => $user->balance,
            'total_invested' => $user->total_invested,
            'total_profit' => $netProfit,
            'total_profit_raw' => $totalProfit,
            'total_loss' => $totalLoss,
            'active_investments' => $activeInvestments->count(),
            'total_investments' => $allInvestments->count(),
            'paused_investments' => $pausedInvestments->count(),
        ];

        return view('dashboard.index', compact('user', 'recentTransactions', 'activeInvestments', 'pausedInvestments', 'stats'));
    }

    /**
     * Display available investment plans.
     */
    public function plans()
    {
        $user = Auth::user();
        $packages = InvestmentPackage::where('is_active', true)
            ->orderBy('min_amount', 'asc')
            ->get();

        return view('dashboard.plans', compact('user', 'packages'));
    }

    /**
     * Process user investment in a package.
     */
    public function invest(Request $request)
    {
        $validated = $request->validate([
            'package_id' => ['required', 'exists:investment_packages,id'],
            'amount' => ['required', 'numeric', 'min:1'],
        ]);

        $user = Auth::user();
        $package = InvestmentPackage::findOrFail($validated['package_id']);
        $amount = $validated['amount'];

        // Validate amount is within package limits
        if ($amount < $package->min_amount) {
            return back()->withErrors([
                'amount' => 'Minimum investment for this package is $' . number_format($package->min_amount, 2)
            ]);
        }

        if ($amount > $package->max_amount) {
            return back()->withErrors([
                'amount' => 'Maximum investment for this package is $' . number_format($package->max_amount, 2)
            ]);
        }

        // Check if user has sufficient balance
        if ($user->balance < $amount) {
            return back()->with('error', 'Insufficient balance! You need $' . number_format($amount, 2) . ' but only have $' . number_format($user->balance, 2) . '. Please fund your account first.');
        }

        // Deduct from user balance
        $user->balance -= $amount;
        $user->total_invested += $amount;
        $user->save();

        // Create investment record
        $investment = Investment::create([
            'user_id' => $user->id,
            'investment_package_id' => $package->id,
            'type' => $package->name,
            'amount' => $amount,
            'profit' => 0,
            'withdrawable_profit' => 0,
            'loss' => 0,
            'roi_percentage' => $package->roi_percentage,
            'status' => 'active',
            'start_date' => now(),
            'end_date' => now()->addDays($package->duration_days),
            'notes' => 'User invested in ' . $package->name . ' package',
        ]);

        // Create transaction record
        Transaction::create([
            'user_id' => $user->id,
            'type' => 'investment',
            'amount' => $amount,
            'status' => 'completed',
            'description' => 'Investment in ' . $package->name . ' package',
            'reference' => Transaction::generateReference(),
        ]);

        return redirect()->route('dashboard.investments')
            ->with('success', 'Investment successful! You invested $' . number_format($amount, 2) . ' in ' . $package->name . '. Your investment is now active.');
    }

    /**
     * Display fund account page.
     */
    /**
     * Display fund account page.
     */
    public function fund()
    {
        $user = Auth::user();
        $paymentMethods = PaymentMethod::where('is_active', true)->orderBy('sort_order')->get();
        return view('dashboard.fund', compact('user', 'paymentMethods'));
    }

    /**
     * Submit deposit request.
     */
    public function submitDeposit(Request $request)
    {
        $validated = $request->validate([
            'payment_method_id' => ['required', 'exists:payment_methods,id'],
            'amount' => ['required', 'numeric', 'min:10'],
            'receipt' => ['required', 'image', 'max:5120'], // Max 5MB
        ]);

        $paymentMethod = PaymentMethod::findOrFail($validated['payment_method_id']);

        if ($request->hasFile('receipt')) {
            $path = $request->file('receipt')->store('receipts', 'public');

            DepositRequest::create([
                'user_id' => Auth::id(),
                'payment_method_id' => $validated['payment_method_id'],
                'amount' => $validated['amount'],
                'receipt_image' => $path,
                'status' => 'pending',
            ]);

            // Optional: Send email to admin about new deposit

            return back()->with('success', 'Deposit request submitted successfully! Your balance will be updated once approved.');
        }

        return back()->with('error', 'Please upload a valid receipt image.');
    }

    /**
     * Display user investments.
     */
    public function investments()
    {
        $user = Auth::user();
        
        $investments = Investment::where('user_id', $user->id)
            ->with('package')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        // Calculate total profit from all investments (profit - loss)
        $allInvestments = Investment::where('user_id', $user->id)->get();
        $totalProfit = $allInvestments->sum('withdrawable_profit') ?? 0;
        $totalLoss = $allInvestments->sum('loss') ?? 0;
        $netProfit = $totalProfit - $totalLoss;
        
        $stats = [
            'total_profit' => $netProfit,
            'total_profit_raw' => $totalProfit,
            'total_loss' => $totalLoss,
        ];

        return view('dashboard.investments', compact('user', 'investments', 'stats'));
    }

    /**
     * Withdraw profit from investment to wallet.
     * User can withdraw any amount up to their net profit (profit - loss).
     */
    public function withdrawProfit(Request $request, $investmentId)
    {
        $validated = $request->validate([
            'amount' => ['required', 'numeric', 'min:0.01'],
        ]);

        $user = User::find(Auth::id()); // Fetch fresh user instance
        $investment = Investment::where('id', $investmentId)
            ->where('user_id', $user->id)
            ->firstOrFail();

        // Calculate net profit (profit - loss)
        $netProfit = ($investment->withdrawable_profit ?? 0) - ($investment->loss ?? 0);

        if ($netProfit <= 0) {
            return back()->with('error', 'No net profit available to withdraw. Your losses exceed or equal your profits.');
        }

        $withdrawAmount = $validated['amount'];

        if ($withdrawAmount > $netProfit) {
            return back()->with('error', 'You cannot withdraw more than your net profit of $' . number_format($netProfit, 2));
        }

        // Move profit to user's wallet
        $user->balance += $withdrawAmount;
        $user->total_profit += $withdrawAmount; // Add to lifetime accumulated profit
        $user->save();

        // Deduct from investment's withdrawable_profit
        $investment->update([
            'withdrawable_profit' => max(0, $investment->withdrawable_profit - $withdrawAmount)
        ]);

        // Create transaction record
        Transaction::create([
            'user_id' => $user->id,
            'type' => 'profit_withdrawal',
            'amount' => $withdrawAmount,
            'status' => 'completed',
            'description' => 'Profit withdrawal from ' . $investment->type . ' investment',
            'reference' => Transaction::generateReference(),
        ]);

        return back()->with('success', 'Profit of $' . number_format($withdrawAmount, 2) . ' has been withdrawn to your wallet!');
    }

    /**
     * Top up an existing investment.
     */
    public function topUpInvestment(Request $request, $investmentId)
    {
        $validated = $request->validate([
            'amount' => ['required', 'numeric', 'min:1'],
        ]);

        $user = Auth::user();
        $investment = Investment::where('id', $investmentId)
            ->where('user_id', $user->id)
            ->whereIn('status', ['active', 'paused']) // Allow both active and paused
            ->firstOrFail();

        $amount = $validated['amount'];
        $wasPaused = $investment->status === 'paused';

        // Check if user has sufficient balance
        if ($user->balance < $amount) {
            return back()->with('error', 'Insufficient balance! You need $' . number_format($amount, 2) . ' but only have $' . number_format($user->balance, 2) . '.');
        }

        // Deduct from user balance
        $user->balance -= $amount;
        $user->total_invested += $amount;
        $user->save();

        // Add to investment amount
        $investment->amount += $amount;
        
        // Reactivate if was paused and now has positive current value
        $newCurrentValue = $investment->amount + ($investment->withdrawable_profit ?? 0) - ($investment->loss ?? 0);
        if ($wasPaused && $newCurrentValue > 0) {
            $investment->status = 'active';
        }
        
        $investment->save();

        // Record the top-up
        InvestmentTopup::create([
            'investment_id' => $investment->id,
            'user_id' => $user->id,
            'amount' => $amount,
            'status' => 'completed',
            'notes' => 'Top-up for ' . $investment->type . ' investment' . ($wasPaused ? ' (reactivated)' : ''),
        ]);

        // Create transaction record
        Transaction::create([
            'user_id' => $user->id,
            'type' => 'investment_topup',
            'amount' => $amount,
            'status' => 'completed',
            'description' => 'Top-up for ' . $investment->type . ' investment' . ($wasPaused ? ' - Trading Resumed' : ''),
            'reference' => Transaction::generateReference(),
        ]);

        $successMessage = 'Investment topped up with $' . number_format($amount, 2) . ' successfully!';
        if ($wasPaused && $investment->status === 'active') {
            $successMessage .= ' Your trading has been resumed.';
        }

        return back()->with('success', $successMessage);
    }

    /**
     * End an investment and move the current value to wallet.
     * This closes the trade and moves principal + profit - loss to wallet.
     */
    public function endInvestment(Request $request, $investmentId)
    {
        $user = \App\Models\User::find(Auth::id());
        $investment = Investment::where('id', $investmentId)
            ->where('user_id', $user->id)
            ->where('status', 'active')
            ->firstOrFail();

        // Calculate the final value to return to wallet
        // current_value = amount + withdrawable_profit - loss
        $finalValue = $investment->current_value;
        
        if ($finalValue <= 0) {
            // Investment has been completely lost - just mark as completed
            $investment->update([
                'status' => 'completed',
                'notes' => ($investment->notes ? $investment->notes . "\n" : '') . 'Investment ended by user. Total loss.',
            ]);

            // Update user's total_invested (deduct the original amount)
            $user->total_invested = max(0, $user->total_invested - $investment->amount);
            $user->save();

            // Create transaction record
            Transaction::create([
                'user_id' => $user->id,
                'type' => 'investment_closed',
                'amount' => 0,
                'status' => 'completed',
                'description' => 'Investment closed: ' . $investment->type . '. Total loss - no funds returned.',
                'reference' => Transaction::generateReference(),
            ]);

            return back()->with('warning', 'Investment closed. Unfortunately, the total loss means no funds are available to return to your wallet.');
        }

        // Move final value to wallet
        $user->balance += $finalValue;
        $user->total_invested = max(0, $user->total_invested - $investment->amount);
        
        // If there was net profit, add to total_profit
        $netProfit = $investment->net_profit;
        if ($netProfit > 0) {
            $user->total_profit += $netProfit;
        }
        
        $user->save();

        // Mark investment as completed
        $investment->update([
            'status' => 'completed',
            'notes' => ($investment->notes ? $investment->notes . "\n" : '') . 'Investment ended by user. Final value: $' . number_format($finalValue, 2),
        ]);

        // Create transaction record
        Transaction::create([
            'user_id' => $user->id,
            'type' => 'investment_closed',
            'amount' => $finalValue,
            'status' => 'completed',
            'description' => 'Investment closed: ' . $investment->type . '. Returned $' . number_format($finalValue, 2) . ' to wallet.',
            'reference' => Transaction::generateReference(),
        ]);

        return back()->with('success', 'Investment ended successfully! $' . number_format($finalValue, 2) . ' has been moved to your wallet.');
    }

    /**
     * Display user transactions.
     */
    public function transactions()
    {
        $user = Auth::user();
        
        $transactions = Transaction::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('dashboard.transactions', compact('user', 'transactions'));
    }

    /**
     * Display user profile.
     */
    public function profile()
    {
        $user = Auth::user();
        return view('dashboard.profile', compact('user'));
    }

    /**
     * Update user profile.
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'country' => ['nullable', 'string', 'max:100'],
        ]);

        $user->update($validated);

        return back()->with('success', 'Profile updated successfully!');
    }

    /**
     * Update user password.
     */
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $user = Auth::user();

        if (!Hash::check($validated['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('success', 'Password updated successfully!');
    }
}
