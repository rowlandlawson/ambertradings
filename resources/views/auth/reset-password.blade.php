@extends('layouts.app')

@section('title', 'Set New Password')

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

    .auth-container {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 80vh;
        padding: 20px;
    }

    .auth-card {
        width: 100%;
        max-width: 450px;
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07), 0 10px 20px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        animation: slideUp 0.6s ease-out;
        position: relative;
    }

    @keyframes slideUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
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

    .auth-header {
        padding: 32px 32px 24px;
        background: var(--primary-light);
        border-bottom: 1px solid var(--border-color);
    }

    .auth-header h1 {
        font-size: 26px;
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
        border: 1px solid;
    }

    .alert-error {
        background: #fef2f2;
        border-color: #fee2e2;
        color: #991b1b;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 8px;
    }

    .form-control {
        width: 100%;
        padding: 12px 14px;
        font-size: 15px;
        border: 2px solid var(--border-color);
        border-radius: 10px;
        background: white;
        transition: all 0.2s ease;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--primary);
        background: var(--primary-light);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .letter-spacing-2 {
        letter-spacing: 0.5em;
        font-weight: bold;
        font-size: 1.3rem;
        text-align: center;
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
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        margin-top: 10px;
    }

    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(37, 99, 235, 0.4);
    }

    .password-toggle {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: var(--text-secondary);
        cursor: pointer;
        padding: 4px;
        transition: color 0.2s ease;
    }

    .password-toggle:hover {
        color: var(--primary);
    }

    .password-wrapper {
        position: relative;
    }

    .password-wrapper .form-control {
        padding-right: 45px;
    }
</style>

<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h1>Set New Password</h1>
            <p>Verification code sent to <strong>{{ $email }}</strong>. Enter the code and your new password below.</p>
        </div>

        <div class="auth-body">
            @if (session('error'))
                <div class="alert alert-error" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.update.code') }}">
                @csrf
                <input type="hidden" name="email" value="{{ $email }}">

                <div class="form-group">
                    <label for="code" class="form-label">Reset Code</label>
                    <input type="text" class="form-control letter-spacing-2" 
                        id="code" name="code" required autofocus placeholder="123456" maxlength="6">
                    @error('code')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">New Password</label>
                    <div class="password-wrapper">
                        <input type="password" class="form-control" 
                            id="password" name="password" required placeholder="••••••••">
                        <button type="button" class="password-toggle" onclick="togglePassword('password', this)">
                            <i class="fa fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <div class="password-wrapper">
                        <input type="password" class="form-control" 
                            id="password_confirmation" name="password_confirmation" required placeholder="••••••••">
                        <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation', this)">
                            <i class="fa fa-eye"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="submit-btn">Update Password</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function togglePassword(inputId, button) {
    const input = document.getElementById(inputId);
    const icon = button.querySelector('i');
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}
</script>
@endpush
