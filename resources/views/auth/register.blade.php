@extends('layouts.guest')

@section('content')
<div class="min-h-screen flex items-center justify-center px-6 py-20">
    <div class="max-w-md w-full glass rounded-2xl p-8 reveal">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold mb-2">Join Diver</h2>
            <p class="text-gray-400">Become part of our creative community</p>
        </div>
        
        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf
            
            <div>
                <label class="block text-sm font-medium mb-2">Full Name</label>
                <input type="text" name="name" required class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl focus:outline-none focus:border-white/30 transition">
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-2">Email Address</label>
                <input type="email" name="email" required class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl focus:outline-none focus:border-white/30 transition">
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-2">Password</label>
                <input type="password" name="password" required class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl focus:outline-none focus:border-white/30 transition">
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-2">Confirm Password</label>
                <input type="password" name="password_confirmation" required class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl focus:outline-none focus:border-white/30 transition">
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-2">I want to join as</label>
                <select name="role" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl focus:outline-none focus:border-white/30 transition">
                    <option value="user">Viewer - Explore & Support Creators</option>
                    <option value="creator">Creator - Upload & Showcase My Work</option>
                </select>
            </div>
            
            <button type="submit" class="w-full py-3 bg-white text-black rounded-xl font-semibold hover:bg-gray-200 transition magnetic-btn">
                Create Account
            </button>
        </form>
        
        <p class="text-center text-gray-400 mt-6">
            Already have an account? 
            <a href="{{ route('login') }}" class="text-white hover:underline">Sign in</a>
        </p>
    </div>
</div>
@endsection