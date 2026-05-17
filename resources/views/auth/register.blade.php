@extends('layouts.guest')

@section('title', 'Register - Diver Entertainment')

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
        max-width: 500px;
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
    .role-selector {
        display: flex;
        gap: 16px;
        margin-bottom: 20px;
    }
    .role-option {
        flex: 1;
        padding: 16px 12px;
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 20px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .role-option.selected {
        border-color: #00D2FF;
        background: rgba(0, 210, 255, 0.1);
    }
    .role-option.selected .role-icon svg {
        stroke: #00D2FF;
    }
    .role-option.selected .role-title {
        color: #00D2FF;
    }
    .role-icon {
        width: 48px;
        height: 48px;
        margin: 0 auto 12px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .role-icon svg {
        width: 28px;
        height: 28px;
        stroke: #9a9a9a;
        stroke-width: 1.5;
        fill: none;
        transition: all 0.3s ease;
    }
    .role-option:hover .role-icon svg {
        stroke: #00D2FF;
    }
    .role-title {
        font-weight: 600;
        font-size: 15px;
        margin-bottom: 6px;
        transition: color 0.3s ease;
    }
    .role-desc {
        font-size: 11px;
        color: #6b6b6b;
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
            <h2 class="text-2xl font-bold mt-6">Create account</h2>
            <p class="text-gray-500 text-sm mt-2">Join our creative community</p>
        </div>
        
        <!-- Form Register -->
        <form method="POST" action="{{ route('register') }}">
            @csrf
            
            <div class="mb-4">
                <input type="text" name="name" class="auth-input" placeholder="Full name" value="{{ old('name') }}" required>
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <input type="email" name="email" class="auth-input" placeholder="Email address" value="{{ old('email') }}" required>
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
            
            <div class="mb-6">
                <input type="password" name="password_confirmation" class="auth-input" placeholder="Confirm password" required>
            </div>
            
            <!-- Role Selection dengan Icon SVG Seragam -->
            <div class="mb-6" x-data="{ selectedRole: 'user' }">
                <p class="text-sm text-gray-400 mb-3">I want to join as:</p>
                <div class="role-selector">
                    <!-- User Role -->
                    <div class="role-option" :class="selectedRole === 'user' ? 'selected' : ''" @click="selectedRole = 'user'">
                        <input type="radio" name="role" value="user" class="hidden" x-model="selectedRole">
                        <div class="role-icon">
                            <svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" fill="none">
                                <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                <path d="M12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div class="role-title">User</div>
                        <div class="role-desc">Explore & Support</div>
                    </div>
                    
                    <!-- Creator Role -->
                    <div class="role-option" :class="selectedRole === 'creator' ? 'selected' : ''" @click="selectedRole = 'creator'">
                        <input type="radio" name="role" value="creator" class="hidden" x-model="selectedRole">
                        <div class="role-icon">
                            <svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" fill="none">
                                <path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                <path d="M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div class="role-title">Creator</div>
                        <div class="role-desc">Upload & Showcase</div>
                    </div>
                </div>
            </div>
            
            <button type="submit" class="auth-btn">Create Account</button>
        </form>
        
        <p class="text-center mt-6">
            <span class="text-gray-500">Already have an account?</span>
            <a href="{{ route('login') }}" class="auth-link ml-1">Sign in</a>
        </p>
        
        <!-- Terms -->
        <p class="text-center text-xs text-gray-600 mt-6">
            By signing up, you agree to our Terms of Service and Privacy Policy.
        </p>
    </div>
</div>

@endsection