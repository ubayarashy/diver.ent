@extends('layouts.app')

@section('title', 'Creator Profile - Diver Entertainment')

@section('content')
<div class="pt-20">
    <!-- Cinematic Banner -->
    <div class="relative h-[300px] md:h-[400px] overflow-hidden">
        <img src="https://images.unsplash.com/photo-1492691527719-9d1e07e534b4?w=1600" 
             alt="Cover" 
             class="w-full h-full object-cover grayscale">
        <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent"></div>
    </div>
    
    <!-- Profile Info -->
    <div class="container mx-auto px-6 relative -mt-20">
        <div class="flex flex-col md:flex-row items-center md:items-end gap-6 mb-12">
            <img src="https://randomuser.me/api/portraits/men/15.jpg" 
                 alt="Profile" 
                 class="w-32 h-32 rounded-full object-cover border-4 border-black">
            <div class="text-center md:text-left">
                <h1 class="text-3xl md:text-4xl font-bold">Alexander Chen</h1>
                <p class="text-gray-400">Visual Artist & Director</p>
                <div class="flex justify-center md:justify-start gap-4 mt-2">
                    <span class="text-sm">📍 Bali, Indonesia</span>
                    <span class="text-sm">📧 alex@diver.ent</span>
                </div>
            </div>
            <div class="md:ml-auto flex gap-3">
                <button class="px-6 py-2 bg-white text-black rounded-full font-semibold">Follow</button>
                <button class="px-6 py-2 border border-white/20 rounded-full">Message</button>
            </div>
        </div>
        
        <!-- Stats -->
        <div class="grid grid-cols-3 gap-4 max-w-md mx-auto md:mx-0 mb-12">
            <div class="text-center">
                <div class="text-2xl font-bold">45.2K</div>
                <div class="text-xs text-gray-500">Followers</div>
            </div>
            <div class="text-center">
                <div class="text-2xl font-bold">47</div>
                <div class="text-xs text-gray-500">Projects</div>
            </div>
            <div class="text-center">
                <div class="text-2xl font-bold">128</div>
                <div class="text-xs text-gray-500">Total Likes</div>
            </div>
        </div>
        
        <!-- Bio -->
        <div class="max-w-2xl mb-12">
            <h2 class="text-xl font-bold mb-3">About</h2>
            <p class="text-gray-300 leading-relaxed">
                Alexander is a visual artist and director specializing in minimalist aesthetics and luxury fashion campaigns. 
                With over 8 years of experience in the creative industry, he has worked with brands like Nike, Gucci, and Louis Vuitton. 
                His work focuses on cinematic storytelling and emotional connection through visual media.
            </p>
        </div>
        
        <!-- Project Gallery -->
        <h2 class="text-xl font-bold mb-6">Featured Projects</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            @php
            $creatorProjects = [
                (object)['title' => 'Nike Air Max Campaign', 'thumbnail' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=600', 'likes' => 2340],
                (object)['title' => 'Gucci Cosmos', 'thumbnail' => 'https://images.unsplash.com/photo-1588092734404-4b8af47e25a0?w=600', 'likes' => 1890],
                (object)['title' => 'Minimalist Series', 'thumbnail' => 'https://images.unsplash.com/photo-1541701494587-cb58502866ab?w=600', 'likes' => 3420],
            ];
            @endphp
            
            @foreach($creatorProjects as $project)
            <div class="group relative overflow-hidden rounded-2xl">
                <img src="{{ $project->thumbnail }}" alt="{{ $project->title }}" 
                     class="w-full h-64 object-cover grayscale-hover transition">
                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                    <div class="text-center">
                        <h3 class="font-bold">{{ $project->title }}</h3>
                        <p class="text-sm">❤️ {{ $project->likes }} likes</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection