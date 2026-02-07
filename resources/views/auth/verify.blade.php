@extends('layouts.app')

@section('title', 'Verify Email')

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

    .popup-wrapper {
        position: fixed;
        inset: 0;
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        background: rgba(15, 23, 42, 0.4);
        backdrop-filter: blur(8px);
    }

    .popup-card {
        width: 100%;
        max-width: 420px;
        background: white;
        border-radius: 20px;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        overflow: hidden;
        animation: popupIn 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        position: relative;
    }

    @keyframes popupIn {
        from { opacity: 0; transform: scale(0.95) translateY(10px); }
        to { opacity: 1; transform: scale(1) translateY(0); }
    }

    .popup-header {
        padding: 32px 32px 20px;
        text-align: center;
    }

    .icon-box {
        width: 64px;
        height: 64px;
        background: var(--primary-light);
        color: var(--primary);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        margin: 0 auto 20px;
    }

    .popup-header h1 {
        font-size: 24px;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 8px;
    }

    .popup-header p {
        font-size: 14px;
        color: var(--text-secondary);
        line-height: 1.5;
    }

    .popup-body {
        padding: 0 32px 32px;
    }

    .alert {
        padding: 12px 16px;
        border-radius: 10px;
        font-size: 13px;
        margin-bottom: 20px;
        text-align: center;
    }

    .alert-error { background: #fef2f2; color: #991b1b; }
    .alert-success { background: #ecfdf5; color: #065f46; }

    .code-input-group {
        margin-bottom: 24px;
    }

    .code-input {
        width: 100%;
        padding: 16px;
        font-size: 24px;
        font-weight: 700;
        letter-spacing: 0.4em;
        text-align: center;
        border: 2px solid var(--border-color);
        border-radius: 12px;
        background: var(--bg-light);
        transition: all 0.2s ease;
    }

    .code-input:focus {
        outline: none;
        border-color: var(--primary);
        background: white;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
    }

    .verify-btn {
        width: 100%;
        padding: 14px;
        font-size: 16px;
        font-weight: 600;
        color: white;
        background: var(--primary);
        border: none;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .verify-btn:hover {
        background: var(--primary-dark);
        transform: translateY(-1px);
    }

    .resend-text {
        text-align: center;
        margin-top: 20px;
        font-size: 14px;
        color: var(--text-secondary);
    }

    .resend-link {
        color: var(--primary);
        text-decoration: none;
        font-weight: 600;
    }
</style>

<div class="popup-wrapper">
    <div class="popup-card">
        <div class="popup-header">
            <div class="icon-box">
                <i class="fas fa-envelope-open-text"></i>
            </div>
            <h1>Verify your email</h1>
            <p>We've sent a 6-digit code to <br><strong>{{ $email }}</strong></p>
        </div>

        <div class="popup-body">
            @if (session('error'))
                <div class="alert alert-error">{{ session('error') }}</div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('verification.verify') }}">
                @csrf
                <input type="hidden" name="email" value="{{ $email }}">

                <div class="code-input-group">
                    <input type="text" class="code-input" id="code" name="code" 
                        required autofocus placeholder="••••••" maxlength="6">
                    @error('code')
                        <p class="text-danger text-center small mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="verify-btn">Verify Account</button>
            </form>

            <div class="resend-text">
                <form method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <input type="hidden" name="email" value="{{ $email }}">
                    Didn't receive the code? 
                    <button type="submit" class="resend-link" style="background:none; border:none; padding:0; cursor:pointer; font-family:inherit; font-size:inherit;">
                        Resend
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
