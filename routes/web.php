<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChatController;

// Main Pages
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/awards', [PageController::class, 'awards'])->name('awards');
Route::get('/why-us', [PageController::class, 'whyUs'])->name('why-us');
Route::get('/performance', [PageController::class, 'performance'])->name('performance');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/faq', [PageController::class, 'faq'])->name('faq');
Route::get('/terms-and-conditions', [PageController::class, 'termsConditions'])->name('terms-conditions');

// Portfolio Pages
Route::get('/portfolio', [PageController::class, 'portfolio'])->name('portfolio');
Route::get('/forex', [PageController::class, 'forex'])->name('forex');
Route::get('/commodities', [PageController::class, 'commodities'])->name('commodities');
Route::get('/indices', [PageController::class, 'indices'])->name('indices');
Route::get('/nfp', [PageController::class, 'nfp'])->name('nfp');
Route::get('/stocks', [PageController::class, 'stocks'])->name('stocks');
Route::get('/cryptocurrency', [PageController::class, 'cryptocurrency'])->name('cryptocurrency');

// Investment Pages
Route::get('/invest-professional', [PageController::class, 'investProfessional'])->name('invest-professional');
Route::get('/protection', [PageController::class, 'protection'])->name('protection');
Route::get('/deposits', [PageController::class, 'deposits'])->name('deposits');

// Auth Pages (Guest only)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Logout (Auth required)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Email Verification
Route::get('/verify-email', [AuthController::class, 'showVerify'])->name('verification.notice');
Route::post('/verify-email', [AuthController::class, 'verify'])->name('verification.verify');
Route::post('/verify-email/resend', [AuthController::class, 'resendCode'])->name('verification.resend');

// Password Reset
Route::get('/forgot-password', [AuthController::class, 'showForgot'])->name('password.forgot');
Route::post('/forgot-password', [AuthController::class, 'sendResetCode'])->name('password.email');
Route::get('/reset-password', [AuthController::class, 'showReset'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update.code');

// User Dashboard (Auth required)
Route::middleware('auth')->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::get('/plans', [DashboardController::class, 'plans'])->name('plans');
    Route::post('/invest', [DashboardController::class, 'invest'])->name('invest');
    Route::get('/investments', [DashboardController::class, 'investments'])->name('investments');
    Route::get('/transactions', [DashboardController::class, 'transactions'])->name('transactions');
    Route::get('/fund', [DashboardController::class, 'fund'])->name('fund');
    Route::post('/fund/submit', [DashboardController::class, 'submitDeposit'])->name('submit-deposit');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
    Route::put('/profile', [DashboardController::class, 'updateProfile'])->name('profile.update');
    Route::put('/password', [DashboardController::class, 'updatePassword'])->name('password.update');
    Route::post('/investments/{investmentId}/withdraw-profit', [DashboardController::class, 'withdrawProfit'])->name('withdraw-profit');
    Route::post('/investments/{investmentId}/top-up', [DashboardController::class, 'topUpInvestment'])->name('top-up-investment');
    Route::post('/investments/{investmentId}/end', [DashboardController::class, 'endInvestment'])->name('end-investment');
});

// Admin Dashboard (Auth required + Admin role)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [AdminController::class, 'index'])->name('index');
    
    // Profile Management
    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
    Route::put('/profile', [AdminController::class, 'updateProfile'])->name('update-profile');
    
    // User Management
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/users/{id}', [AdminController::class, 'userDetail'])->name('user-detail');
    Route::post('/users/{id}/update-balance', [AdminController::class, 'updateBalance'])->name('update-balance');
    Route::post('/users/{id}/add-investment', [AdminController::class, 'addInvestment'])->name('add-investment');
    Route::put('/users/{id}/investments/{investmentId}', [AdminController::class, 'updateInvestment'])->name('update-investment');
    Route::delete('/users/{id}/investments/{investmentId}', [AdminController::class, 'deleteInvestment'])->name('delete-investment');
    Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('delete-user');
    
    // Investment Package Management
    Route::get('/packages', [AdminController::class, 'packages'])->name('packages');
    Route::get('/packages/create', [AdminController::class, 'createPackage'])->name('package.create');
    Route::post('/packages', [AdminController::class, 'storePackage'])->name('package.store');
    Route::get('/packages/{id}/edit', [AdminController::class, 'editPackage'])->name('package.edit');
    Route::put('/packages/{id}', [AdminController::class, 'updatePackage'])->name('package.update');
    Route::delete('/packages/{id}', [AdminController::class, 'deletePackage'])->name('package.delete');

    // Payment Settings
    Route::get('/payment-settings', [AdminController::class, 'paymentSettings'])->name('payment-settings');
    Route::put('/payment-methods/{id}', [AdminController::class, 'updatePaymentMethod'])->name('update-payment-method');

    // Deposit Requests
    Route::get('/deposits', [AdminController::class, 'depositRequests'])->name('deposits');
    Route::post('/deposits/{id}/approve', [AdminController::class, 'approveDeposit'])->name('approve-deposit');
    Route::post('/deposits/{id}/reject', [AdminController::class, 'rejectDeposit'])->name('reject-deposit');
});


// Chat Route
Route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('chat.send');

// Receipt Image Route (bypasses Apache symlink restriction)
Route::get('/receipt/{filename}', function ($filename) {
    $path = storage_path('app/public/receipts/' . $filename);
    
    if (!file_exists($path)) {
        abort(404);
    }
    
    $mimeType = mime_content_type($path);
    
    return response()->file($path, [
        'Content-Type' => $mimeType,
    ]);
})->where('filename', '.*')->name('receipt.show')->middleware('auth');
