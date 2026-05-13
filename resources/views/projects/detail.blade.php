@extends('layouts.app')

@section('title', 'Project Detail - Diver Entertainment')

@section('content')
<div class="pt-20">
    <!-- Hero Image -->
    <div class="relative h-[60vh] md:h-[80vh] overflow-hidden">
        <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=1600" 
             alt="Project" 
             class="w-full h-full object-cover cinematic-img">
        <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent"></div>
        
        <div class="absolute bottom-0 left-0 p-8 md:p-16">
            <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold mb-4">Nike Air Max Campaign</h1>
            <div class="flex gap-4">
                <span class="px-3 py-1 bg-white/10 rounded-full text-sm">Fashion</span>
                <span class="px-3 py-1 bg-white/10 rounded-full text-sm">Campaign</span>
                <span class="px-3 py-1 bg-white/10 rounded-full text-sm">2024</span>
            </div>
        </div>
    </div>
    
    <div class="container mx-auto px-6 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Content -->
            <div class="lg:col-span-2">
                <div class="mb-8">
                    <h2 class="text-2xl font-bold mb-4">Project Overview</h2>
                    <p class="text-gray-300 leading-relaxed mb-4">
                        A cinematic campaign for Nike Air Max that celebrates movement, urban culture, and self-expression. 
                        The project combines live-action footage with dynamic motion graphics to create an immersive visual experience.
                    </p>
                    <p class="text-gray-300 leading-relaxed">
                        Shot across three cities - Tokyo, New York, and London - the campaign features local artists, dancers, 
                        and athletes who embody the spirit of the Air Max brand.
                    </p>
                </div>
                
                <!-- Gallery Slider -->
                <div class="mb-8">
                    <h2 class="text-2xl font-bold mb-4">Gallery</h2>
                    <div class="horizontal-scroll-wrapper overflow-x-auto flex gap-4 pb-4">
                        <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=400" class="w-64 h-48 object-cover rounded-xl flex-shrink-0">
                        <img src="https://images.unsplash.com/photo-1518002172853-08c1f8def5cc?w=400" class="w-64 h-48 object-cover rounded-xl flex-shrink-0">
                        <img src="https://images.unsplash.com/photo-1588092734404-4b8af47e25a0?w=400" class="w-64 h-48 object-cover rounded-xl flex-shrink-0">
                        <img src="https://images.unsplash.com/photo-1556905055-8f358a7a47b2?w=400" class="w-64 h-48 object-cover rounded-xl flex-shrink-0">
                    </div>
                </div>
            </div>
            
            <!-- Sidebar -->
            <div>
                <div class="glass rounded-2xl p-6 mb-6">
                    <h3 class="font-bold mb-4">Project Details</h3>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-400">Client</span>
                            <span>Nike</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400">Year</span>
                            <span>2024</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400">Category</span>
                            <span>Fashion Campaign</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400">Duration</span>
                            <span>3 months</span>
                        </div>
                    </div>
                </div>
                
                <div class="glass rounded-2xl p-6 mb-6">
                    <h3 class="font-bold mb-4">Tools Used</h3>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-3 py-1 bg-white/5 rounded-full text-xs">Adobe Premiere</span>
                        <span class="px-3 py-1 bg-white/5 rounded-full text-xs">After Effects</span>
                        <span class="px-3 py-1 bg-white/5 rounded-full text-xs">DaVinci Resolve</span>
                        <span class="px-3 py-1 bg-white/5 rounded-full text-xs">Cinema 4D</span>
                    </div>
                </div>
                
                <div class="glass rounded-2xl p-6">
                    <div class="flex items-center gap-4 mb-4">
                        <img src="https://randomuser.me/api/portraits/men/15.jpg" class="w-12 h-12 rounded-full">
                        <div>
                            <h4 class="font-bold">Alexander Chen</h4>
                            <p class="text-xs text-gray-400">Creative Director</p>
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <button class="flex-1 py-2 bg-white text-black rounded-full text-sm font-semibold">Follow</button>
                        <button class="px-4 py-2 border border-white/20 rounded-full text-sm">View Profile</button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Related Projects -->
        <div class="mt-16">
            <h2 class="text-2xl font-bold mb-6">Related Projects</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
              
                <div class="group cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1556905055-8f358a7a47b2?w=600" class="w-full h-48 object-cover rounded-xl grayscale-hover">
                    <h3 class="font-bold mt-2">Louis Vuitton</h3>
                    <p class="text-sm text-gray-400">Luxury Editorial</p>
                </div>
                <div class="group cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1588092734404-4b8af47e25a0?w=600" class="w-full h-48 object-cover rounded-xl grayscale-hover">
                    <h3 class="font-bold mt-2">Gucci Garden</h3>
                    <p class="text-sm text-gray-400">Fashion Film</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection