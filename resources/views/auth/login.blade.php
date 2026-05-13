@extends('layouts.guest')

@section('content')
<div class="min-h-screen flex items-center justify-center px-6 py-20">
    <div class="max-w-md w-full glass rounded-2xl p-8 reveal">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold mb-2">Welcome Back</h2>
            <p class="text-gray-400">Sign in to continue your creative journey</p>
        </div>
        
        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf
            
            <div>
                <label class="block text-sm font-medium mb-2">Email Address</label>
                <input type="email" name="email" required class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl focus:outline-none focus:border-white/30 transition">
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-2">Password</label>
                <input type="password" name="password" required class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl focus:outline-none focus:border-white/30 transition">
            </div>
            
            <div class="flex items-center justify-between">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="mr-2">
                    <span class="text-sm text-gray-400">Remember me</span>
                </label>
                <a href="#" class="text-sm text-gray-400 hover:text-white transition">Forgot password?</a>
            </div>
            
            <button type="submit" class="w-full py-3 bg-white text-black rounded-xl font-semibold hover:bg-gray-200 transition magnetic-btn">
                Sign In
            </button>
        </form>
        
        <p class="text-center text-gray-400 mt-6">
            Don't have an account? 
            <a href="{{ route('register') }}" class="text-white hover:underline">Sign up</a>
        </p>
    </div>
</div>
@endsection