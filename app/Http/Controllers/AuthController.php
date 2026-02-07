<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationCodeMail;
use App\Mail\ResetCodeMail;
use Carbon\Carbon;

class AuthController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLogin()
    {
        // If user is already logged in, redirect to dashboard
        if (Auth::check()) {
            return $this->redirectBasedOnRole(Auth::user());
        }
        
        // Return login view with no-cache headers to prevent browser caching
        return response()
            ->view('pages.login')
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->header('Pragma', 'no-cache');
    }

    /**
     * Handle login request.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return $this->redirectBasedOnRole(Auth::user());
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Show the registration form.
     */
    public function showRegister()
    {
        // If user is already logged in, redirect to dashboard
        if (Auth::check()) {
            return $this->redirectBasedOnRole(Auth::user());
        }
        
        // Return register view with no-cache headers
        return response()
            ->view('pages.register')
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->header('Pragma', 'no-cache');
    }

    /**
     * Handle registration request.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::min(8)],
            'phone' => ['nullable', 'string', 'max:20'],
            'country' => ['nullable', 'string', 'max:100'],
        ]);

        $code = (string) rand(100000, 999999);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'phone' => $validated['phone'] ?? null,
            'country' => $validated['country'] ?? null,
            'role' => 'user',
            'balance' => 0,
            'total_invested' => 0,
            'total_profit' => 0,
            'verification_code' => $code,
            'verification_expires_at' => Carbon::now()->addMinutes(15),
        ]);

        // Send verification email
        try {
            Mail::to($user->email)->send(new VerificationCodeMail($user, $code));
        } catch (\Exception $e) {
            // Log error but allow registration to proceed
            \Log::error('Failed to send verification email: ' . $e->getMessage());
        }

        // Store email in session for the verification page
        session(['verification_email' => $user->email]);

        return redirect()->route('verification.notice')->with('success', 'Registration successful! Please check your email for a verification code.');
    }

    /**
     * Show verification form.
     */
    public function showVerify()
    {
        if (Auth::check() && Auth::user()->email_verified_at) {
            return redirect()->route('dashboard.index');
        }

        $email = session('verification_email');
        if (!$email) {
            return redirect()->route('login')->with('error', 'Session expired. Please login to verify your email.');
        }

        return view('auth.verify', ['email' => $email]);
    }

    /**
     * Handle verification code submission.
     */
    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required|string|size:6',
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'User not found.');
        }

        if ($user->verification_code !== $request->code) {
            return back()->with('error', 'Invalid verification code.');
        }

        if (Carbon::now()->gt($user->verification_expires_at)) {
            return back()->with('error', 'Verification code has expired. Please request a new one.');
        }

        // Mark as verified
        $user->email_verified_at = Carbon::now();
        $user->verification_code = null;
        $user->verification_expires_at = null;
        $user->save();

        Auth::login($user);

        return redirect()->route('dashboard.index')->with('success', 'Email verified successfully! Welcome to Amber Tradings.');
    }

    /**
     * Resend verification code.
     */
    public function resendCode(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $user = User::where('email', $request->email)->first();

        // If already verified
        if ($user->email_verified_at) {
            return redirect()->route('dashboard.index')->with('info', 'Your email is already verified.');
        }

        // Generate new code
        $code = (string) rand(100000, 999999);
        $user->verification_code = $code;
        $user->verification_expires_at = Carbon::now()->addMinutes(15);
        $user->save();

        // Send email
        try {
            Mail::to($user->email)->send(new VerificationCodeMail($user, $code));
        } catch (\Exception $e) {
            // DEBUG: Show error on screen (since they are debugging)
            // If they fixed it, this won't trigger.
            dd('EMAIL ERROR: ' . $e->getMessage());
        }

        return back()->with('success', 'A new verification code has been sent to your email.');
    }

    // --- Password Reset Flow ---

    /**
     * Show forgot password form.
     */
    public function showForgot()
    {
        return view('auth.forgot-password');
    }

    /**
     * Send reset code.
     */
    public function sendResetCode(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $user = User::where('email', $request->email)->first();
        $code = (string) rand(100000, 999999);

        $user->reset_code = $code;
        $user->reset_expires_at = Carbon::now()->addMinutes(15);
        $user->save();

        try {
            Mail::to($user->email)->send(new ResetCodeMail($user, $code));
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to send reset email. Please try again.');
        }

        session(['reset_email' => $user->email]);

        return redirect()->route('password.reset')->with('success', 'Reset code sent! Please check your email.');
    }

    /**
     * Show reset password form.
     */
    public function showReset()
    {
        $email = session('reset_email');
        if (!$email) {
            return redirect()->route('password.forgot')->with('error', 'Session expired. Please start over.');
        }

        return view('auth.reset-password', ['email' => $email]);
    }

    /**
     * Handle password reset.
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'code' => 'required|string|size:6',
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user->reset_code !== $request->code) {
            return back()->with('error', 'Invalid reset code.');
        }

        if (Carbon::now()->gt($user->reset_expires_at)) {
            return back()->with('error', 'Reset code has expired. Please request a new one.');
        }

        $user->password = Hash::make($request->password);
        $user->reset_code = null;
        $user->reset_expires_at = null;
        $user->save();

        // Optional: Login automatically or redirect to login
        Auth::login($user);

        return redirect()->route('dashboard.index')->with('success', 'Password reset successfully!');
    }

    /**
     * Handle logout request.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'You have been logged out successfully.');
    }

    /**
     * Redirect user based on their role.
     */
    protected function redirectBasedOnRole(User $user)
    {
        if ($user->isAdmin()) {
            return redirect()->route('admin.index');
        }

        return redirect()->route('dashboard.index');
    }
}
