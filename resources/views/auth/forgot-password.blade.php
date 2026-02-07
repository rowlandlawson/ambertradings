@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
<style>
    :root {
        --primary: #2563eb;
        --primary-dark: #1e40af;
        --primary-light: #eff6ff;
        --text-primary: #0f172a;
        --text-secondary: #64748b;
        --text-tertiary: #cbd5e1;
        --border-color: #e2e8f0;
        --success: #10b981;
        --error: #ef4444;
        --bg-light: #f8fafc;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', Trebuchet MS, sans-serif;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        color: var(--text-primary);
        min-height: 100vh;
    }

    .auth-container {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        padding: 20px;
    }

    .auth-card {
        width: 100%;
        max-width: 420px;
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07), 0 10px 20px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        animation: slideUp 0.6s ease-out;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .auth-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--primary) 0%, #3b82f6 100%);
    }

    .auth-card {
        position: relative;
    }

    .auth-header {
        padding: 32px 32px 24px;
        background: var(--primary-light);
        border-bottom: 1px solid var(--border-color);
    }

    .auth-header h1 {
        font-size: 28px;
        font-weight: 700;
        color: var(--primary-dark);
        margin-bottom: 8px;
        letter-spacing: -0.5px;
    }

    .auth-header p {
        font-size: 14px;
        color: var(--text-secondary);
        line-height: 1.6;
    }

    .auth-body {
        padding: 32px;
    }

    .alert {
        padding: 12px 16px;
        border-radius: 10px;
        font-size: 14px;
        margin-bottom: 20px;
        animation: slideDown 0.3s ease-out;
        border: 1px solid;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .alert-success {
        background: #ecfdf5;
        border-color: #d1fae5;
        color: #065f46;
    }

    .alert-error {
        background: #fef2f2;
        border-color: #fee2e2;
        color: #991b1b;
    }

    .form-group {
        margin-bottom: 24px;
    }

    .form-label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 8px;
        letter-spacing: 0.3px;
    }

    .form-control {
        width: 100%;
        padding: 12px 14px;
        font-size: 15px;
        border: 2px solid var(--border-color);
        border-radius: 10px;
        background: white;
        color: var(--text-primary);
        transition: all 0.2s ease;
        font-family: inherit;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--primary);
        background: var(--primary-light);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .form-control::placeholder {
        color: var(--text-tertiary);
    }

    .form-error {
        display: block;
        font-size: 13px;
        color: var(--error);
        margin-top: 6px;
        font-weight: 500;
    }

    .submit-btn {
        width: 100%;
        padding: 14px 20px;
        font-size: 16px;
        font-weight: 600;
        color: white;
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        border: none;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.3s ease;
        letter-spacing: 0.3px;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
    }

    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(37, 99, 235, 0.4);
    }

    .submit-btn:active {
        transform: translateY(0);
    }

    .auth-footer {
        margin-top: 24px;
        padding-top: 24px;
        border-top: 1px solid var(--border-color);
        text-align: center;
    }

    .auth-link {
        font-size: 14px;
        color: var(--primary);
        text-decoration: none;
        font-weight: 500;
        transition: color 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .auth-link:hover {
        color: var(--primary-dark);
    }

    .auth-link::before {
        content: '←';
        transition: transform 0.2s ease;
    }

    .auth-link:hover::before {
        transform: translateX(-4px);
    }

    @media (max-width: 480px) {
        .auth-card {
            border-radius: 12px;
        }

        .auth-header {
            padding: 24px 24px 16px;
        }

        .auth-header h1 {
            font-size: 24px;
        }

        .auth-body {
            padding: 24px;
        }

        .form-control {
            padding: 11px 12px;
            font-size: 16px;
        }

        .submit-btn {
            padding: 12px 16px;
            font-size: 15px;
        }
    }
</style>

<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h1>Reset Password</h1>
            <p>Enter your email address and we'll send you a code to reset your password.</p>
        </div>

        <div class="auth-body">
            @if (session('error'))
                <div class="alert alert-error" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <input 
                        type="email" 
                        class="form-control" 
                        id="email" 
                        name="email" 
                        value="{{ old('email') }}" 
                        placeholder="you@example.com"
                        required 
                        autofocus
                    >
                    @error('email')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="submit-btn">Send Reset Code</button>

                <div class="auth-footer">
                    <a href="{{ route('login') }}" class="auth-link">Back to Login</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection