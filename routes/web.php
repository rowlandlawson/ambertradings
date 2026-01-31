<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

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
