<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;

// Main Pages
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/awards', [PageController::class, 'awards'])->name('awards');
Route::get('/why-us', [PageController::class, 'whyUs'])->name('why-us');
Route::get('/performance', [PageController::class, 'performance'])->name('performance');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/faq', [PageController::class, 'faq'])->name('faq');

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
});

// Admin Dashboard (Auth required + Admin role)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [AdminController::class, 'index'])->name('index');
    
    // User Management
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/users/{id}', [AdminController::class, 'userDetail'])->name('user-detail');
    Route::post('/users/{id}/update-balance', [AdminController::class, 'updateBalance'])->name('update-balance');
    Route::post('/users/{id}/add-investment', [AdminController::class, 'addInvestment'])->name('add-investment');
    Route::put('/users/{id}/investments/{investmentId}', [AdminController::class, 'updateInvestment'])->name('update-investment');
    Route::delete('/users/{id}/investments/{investmentId}', [AdminController::class, 'deleteInvestment'])->name('delete-investment');
    
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

