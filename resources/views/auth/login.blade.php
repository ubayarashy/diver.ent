@extends('layouts.guest')

@section('title', 'Login - Diver Entertainment')

@section('content')

<style>
    .auth-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
        background: #000000;
    }
    .auth-card {
        max-width: 450px;
        width: 100%;
        background: rgba(255, 255, 255, 0.02);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.06);
        border-radius: 32px;
        padding: 2.5rem;
    }
    .auth-input {
        width: 100%;
        padding: 14px 18px;
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 16px;
        color: white;
        font-size: 15px;
        transition: all 0.3s ease;
    }
    .auth-input:focus {
        outline: none;
        border-color: #00D2FF;
        background: rgba(0, 0, 0, 0.8);
    }
    .auth-input::placeholder {
        color: #6b6b6b;
    }
    .auth-btn {
        width: 100%;
        padding: 14px;
        background: #00D2FF;
        color: #000000;
        border: none;
        border-radius: 16px;
        font-weight: 600;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .auth-btn:hover {
        background: #0099cc;
        transform: translateY(-2px);
    }
    .auth-link {
        color: #9a9a9a;
        text-decoration: none;
        font-size: 14px;
        transition: color 0.3s;
    }
    .auth-link:hover {
        color: #00D2FF;
    }
    .divider {
        display: flex;
        align-items: center;
        text-align: center;
        color: #3a3a3a;
        font-size: 12px;
        margin: 20px 0;
    }
    .divider::before, .divider::after {
        content: '';
        flex: 1;
        border-bottom: 1px solid rgba(255,255,255,0.08);
    }
    .divider::before { margin-right: 15px; }
    .divider::after { margin-left: 15px; }
    .demo-credentials {
        background: rgba(0, 210, 255, 0.05);
        border-radius: 12px;
        padding: 12px;
        margin-top: 20px;
    }
</style>

<div class="auth-container">
    <div class="auth-card">
        <!-- Logo -->
        <div class="text-center mb-8">
            <a href="/" class="text-2xl font-bold tracking-tighter">
                <span class="text-white">DIVER</span>
                <span class="text-[#00D2FF]">.ent</span>
            </a>
            <h2 class="text-2xl font-bold mt-6">Welcome back</h2>
            <p class="text-gray-500 text-sm mt-2">Sign in to your account</p>
        </div>
        
        <!-- Form Login -->
        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="mb-4">
                <input type="email" name="email" class="auth-input" placeholder="Email address" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <input type="password" name="password" class="auth-input" placeholder="Password" required>
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex justify-between items-center mb-6">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="remember" class="w-4 h-4 rounded border-white/20 bg-transparent">
                    <span class="text-sm text-gray-400">Remember me</span>
                </label>
                <a href="{{ route('password.request') }}" class="auth-link text-sm">Forgot password?</a>
            </div>
            
            <button type="submit" class="auth-btn">Sign In</button>
        </form>
        
        <div class="divider">OR</div>
        
        <!-- Demo Credentials -->
        <div class="demo-credentials">
            <p class="text-xs text-gray-400 text-center mb-2">Demo Accounts</p>
            <div class="grid grid-cols-2 gap-2 text-xs">
                <div><span class="text-gray-500">User:</span> <span class="text-blue">user@diver.com</span></div>
                <div><span class="text-gray-500">Pass:</span> <span class="text-blue">password</span></div>
                <div><span class="text-gray-500">Creator:</span> <span class="text-blue">creator@diver.com</span></div>
                <div><span class="text-gray-500">Pass:</span> <span class="text-blue">password</span></div>
                <div><span class="text-gray-500">Admin:</span> <span class="text-blue">admin@diver.com</span></div>
                <div><span class="text-gray-500">Pass:</span> <span class="text-blue">password</span></div>
            </div>
        </div>
        
        <p class="text-center mt-6">
            <span class="text-gray-500">Don't have an account?</span>
            <a href="{{ route('register') }}" class="auth-link ml-1">Sign up</a>
        </p>
    </div>
</div>

@endsection