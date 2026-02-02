<?php

namespace App\Http\Controllers;

use App\Models\DepositRequest;
use App\Models\Investment;
use App\Models\InvestmentPackage;
use App\Models\PaymentMethod;
use App\Models\Transaction;
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
            
        $stats = [
            'balance' => $user->balance,
            'total_invested' => $user->total_invested,
            'total_profit' => $user->total_profit,
            'active_investments' => $activeInvestments->count(),
            'total_investments' => Investment::where('user_id', $user->id)->count(),
        ];

        return view('dashboard.index', compact('user', 'recentTransactions', 'activeInvestments', 'stats'));
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

        return view('dashboard.investments', compact('user', 'investments'));
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
