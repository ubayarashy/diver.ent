@extends('layouts.app')

@section('title', 'User Dashboard - Diver Entertainment')

@section('content')

<style>
    .dashboard-stat {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.06);
        border-radius: 20px;
        padding: 20px;
        transition: all 0.3s ease;
    }
    .dashboard-stat:hover {
        border-color: rgba(0, 210, 255, 0.3);
        transform: translateY(-3px);
    }
    .stat-icon {
        width: 48px;
        height: 48px;
        background: rgba(0, 210, 255, 0.1);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 16px;
    }
    .stat-icon svg {
        width: 24px;
        height: 24px;
        stroke: #00D2FF;
    }
    .project-card-sm {
        background: rgba(255, 255, 255, 0.02);
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
        display: flex;
        gap: 12px;
        padding: 12px;
    }
    .project-card-sm:hover {
        background: rgba(255, 255, 255, 0.04);
        transform: translateX(5px);
    }
    .project-thumb-sm {
        width: 60px;
        height: 60px;
        border-radius: 10px;
        background: linear-gradient(135deg, #1a1a2e, #16213e);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .sidebar-nav {
        background: rgba(255, 255, 255, 0.02);
        border-radius: 16px;
        padding: 8px;
    }
    .nav-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 16px;
        border-radius: 12px;
        color: #9a9a9a;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    .nav-item:hover, .nav-item.active {
        background: rgba(0, 210, 255, 0.1);
        color: #00D2FF;
    }
    .nav-item.active {
        border-left: 2px solid #00D2FF;
    }
    .nav-item svg {
        width: 20px;
        height: 20px;
    }
</style>

<div class="py-24 px-6">
    <div class="container mx-auto max-w-7xl">
        
        <!-- Header -->
        <div class="flex justify-between items-center mb-8 flex-wrap gap-4">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold">Welcome back, <span class="gradient-blue">User!</span></h1>
                <p class="text-gray-400 mt-1">Manage your saved content and preferences</p>
            </div>
            <a href="/explore" class="px-5 py-2 border border-blue rounded-full text-blue text-sm hover:bg-blue hover:text-black transition">+ Explore New Projects</a>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Sidebar Navigation -->
            <div class="lg:col-span-1">
                <div class="sidebar-nav" x-data="{ activeTab: 'saved' }">
                    <div class="nav-item" :class="activeTab === 'saved' ? 'active' : ''" @click="activeTab = 'saved'">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 116.364 6.364L12 20.364l-7.682-7.682a4.5 4.5 0 010-6.364z"/></svg>
                        <span>Saved Projects</span>
                    </div>
                    <div class="nav-item" :class="activeTab === 'following' ? 'active' : ''" @click="activeTab = 'following'">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        <span>Following</span>
                    </div>
                    <div class="nav-item" :class="activeTab === 'history' ? 'active' : ''" @click="activeTab = 'history'">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>History</span>
                    </div>
                    <div class="nav-item" :class="activeTab === 'settings' ? 'active' : ''" @click="activeTab = 'settings'">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span>Settings</span>
                    </div>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="lg:col-span-3">
                <!-- Saved Projects Tab -->
                <div x-show="activeTab === 'saved'" x-cloak>
                    <h2 class="text-xl font-bold mb-4">Saved Projects</h2>
                    <div class="space-y-3">
                        @for($i=1;$i<=3;$i++)
                        <div class="project-card-sm">
                            <div class="project-thumb-sm"><svg class="w-6 h-6 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg></div>
                            <div class="flex-1"><h3 class="font-semibold">Nike Air Max Campaign</h3><p class="text-xs text-gray-500">Saved on May 12, 2024</p></div>
                            <button class="text-red-500 hover:text-red-400 text-sm">Remove</button>
                        </div>
                        @endfor
                    </div>
                    <div class="text-center mt-6"><p class="text-gray-500 text-sm">— No more saved projects —</p></div>
                </div>
                
                <!-- Following Tab -->
                <div x-show="activeTab === 'following'" x-cloak>
                    <h2 class="text-xl font-bold mb-4">Following</h2>
                    <div class="space-y-3">
                        @for($i=1;$i<=3;$i++)
                        <div class="flex items-center justify-between p-3 bg-white/5 rounded-xl"><div class="flex items-center gap-3"><div class="w-10 h-10 rounded-full bg-gradient-to-br from-gray-700 to-gray-900"></div><div><h3 class="font-semibold">Alexander Chen</h3><p class="text-xs text-gray-500">Visual Artist</p></div></div><button class="text-blue text-sm">Following</button></div>
                        @endfor
                    </div>
                </div>
                
                <!-- History Tab -->
                <div x-show="activeTab === 'history'" x-cloak>
                    <h2 class="text-xl font-bold mb-4">Recently Viewed</h2>
                    <div class="space-y-3">
                        @for($i=1;$i<=4;$i++)
                        <div class="project-card-sm"><div class="project-thumb-sm"><svg class="w-6 h-6 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg></div><div class="flex-1"><h3 class="font-semibold">Gucci Cosmos Film</h3><p class="text-xs text-gray-500">Viewed 2 days ago</p></div></div>
                        @endfor
                    </div>
                </div>
                
                <!-- Settings Tab -->
                <div x-show="activeTab === 'settings'" x-cloak>
                    <h2 class="text-xl font-bold mb-4">Profile Settings</h2>
                    <div class="glass rounded-2xl p-6 space-y-4"><div><label class="text-sm text-gray-400">Name</label><input type="text" value="Regular User" class="w-full mt-1 px-4 py-2 bg-white/5 border border-white/10 rounded-lg focus:border-blue outline-none"></div><div><label class="text-sm text-gray-400">Email</label><input type="email" value="user@diver.com" class="w-full mt-1 px-4 py-2 bg-white/5 border border-white/10 rounded-lg focus:border-blue outline-none"></div><div><label class="text-sm text-gray-400">Bio</label><textarea rows="3" class="w-full mt-1 px-4 py-2 bg-white/5 border border-white/10 rounded-lg focus:border-blue outline-none">Creative enthusiast exploring visual storytelling.</textarea></div><button class="px-6 py-2 bg-blue text-black rounded-lg font-semibold">Save Changes</button></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection