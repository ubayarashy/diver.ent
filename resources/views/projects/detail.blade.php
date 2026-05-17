@extends('layouts.app')

@section('title', $project->title . ' - Diver Entertainment')

@section('content')

<style>
    .horizontal-scroll-wrapper {
        overflow-x: auto;
        scroll-behavior: smooth;
        scrollbar-width: thin;
        scrollbar-color: #00D2FF #1a1a1a;
    }
    .horizontal-scroll-wrapper::-webkit-scrollbar {
        height: 4px;
    }
    .horizontal-scroll-wrapper::-webkit-scrollbar-track {
        background: #1a1a1a;
        border-radius: 10px;
    }
    .horizontal-scroll-wrapper::-webkit-scrollbar-thumb {
        background: #00D2FF;
        border-radius: 10px;
    }
    .like-btn {
        transition: all 0.2s ease;
        cursor: pointer;
    }
    .like-btn.liked {
        color: #ff4444;
    }
    .like-btn:hover {
        transform: scale(1.1);
    }
</style>

<div class="pt-20">
    <!-- Hero Image -->
    <div class="relative h-[60vh] md:h-[80vh] overflow-hidden">
        <img src="{{ $project->thumbnail }}" 
             alt="{{ $project->title }}" 
             class="w-full h-full object-cover cinematic-img">
        <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent"></div>
        
        <div class="absolute bottom-0 left-0 p-8 md:p-16">
            <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold mb-4">{{ $project->title }}</h1>
            <div class="flex gap-4">
                <span class="px-3 py-1 bg-white/10 rounded-full text-sm">{{ $project->category->name ?? 'Uncategorized' }}</span>
                <span class="px-3 py-1 bg-white/10 rounded-full text-sm">{{ $project->status }}</span>
                <span class="px-3 py-1 bg-white/10 rounded-full text-sm">{{ date('Y', strtotime($project->published_at)) }}</span>
            </div>
        </div>
    </div>
    
    <div class="container mx-auto px-6 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Content -->
            <div class="lg:col-span-2">
                <div class="mb-8">
                    <h2 class="text-2xl font-bold mb-4">Project Overview</h2>
                    <p class="text-gray-300 leading-relaxed mb-4">{{ $project->description }}</p>
                    @if($project->content)
                    <p class="text-gray-300 leading-relaxed">{{ $project->content }}</p>
                    @endif
                </div>
                
                <!-- Gallery Slider -->
                @if($project->gallery && count(json_decode($project->gallery, true)) > 0)
                <div class="mb-8">
                    <h2 class="text-2xl font-bold mb-4">Gallery</h2>
                    <div class="horizontal-scroll-wrapper overflow-x-auto flex gap-4 pb-4">
                        @php $gallery = json_decode($project->gallery, true); @endphp
                        @foreach($gallery as $image)
                        <img src="{{ $image }}" class="w-64 h-48 object-cover rounded-xl flex-shrink-0 grayscale-hover transition">
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
            
            <!-- Sidebar -->
            <div>
                <div class="glass rounded-2xl p-6 mb-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-bold">Project Details</h3>
                        @auth
                        <button onclick="toggleLike()" 
                                id="likeBtn"
                                class="like-btn flex items-center gap-2 px-3 py-1 rounded-full transition {{ $project->isLikedBy(auth()->id()) ? 'liked' : 'text-gray-400 hover:text-red-500' }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                            <span id="likesCount">{{ number_format($project->likes_count) }}</span>
                        </button>
                        @endauth
                        @guest
                        <a href="{{ route('login') }}" class="flex items-center gap-2 text-gray-400 hover:text-red-500 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                            <span>{{ number_format($project->likes_count) }}</span>
                        </a>
                        @endguest
                    </div>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-400">Client</span>
                            <span>{{ $project->user->name ?? 'Diver Entertainment' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400">Year</span>
                            <span>{{ date('Y', strtotime($project->published_at)) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400">Category</span>
                            <span>{{ $project->category->name ?? 'Uncategorized' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400">Views</span>
                            <span>{{ number_format($project->views) }}</span>
                        </div>
                    </div>
                </div>
                
                @if($project->tools_used)
                <div class="glass rounded-2xl p-6 mb-6">
                    <h3 class="font-bold mb-4">Tools Used</h3>
                    <div class="flex flex-wrap gap-2">
                        @php $tools = json_decode($project->tools_used, true); @endphp
                        @if(is_array($tools))
                            @foreach($tools as $tool)
                            <span class="px-3 py-1 bg-white/5 rounded-full text-xs">{{ $tool }}</span>
                            @endforeach
                        @endif
                    </div>
                </div>
                @endif
                
                <div class="glass rounded-2xl p-6">
                    <div class="flex items-center gap-4 mb-4">
                        <img src="{{ $project->user->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($project->user->name ?? 'Diver') . '&background=00D2FF&color=fff&size=48' }}" 
                             class="w-12 h-12 rounded-full object-cover">
                        <div>
                            <h4 class="font-bold">{{ $project->user->name ?? 'Diver Entertainment' }}</h4>
                            <p class="text-xs text-gray-400">{{ $project->user->role ?? 'Creative Agency' }}</p>
                        </div>
                    </div>
                    <div class="flex gap-3">
                        @auth
                            @if(auth()->id() !== $project->user_id)
                            <button onclick="toggleFollowCreator({{ $project->user_id }})" 
                                    id="followCreatorBtn"
                                    class="flex-1 py-2 rounded-full text-sm font-semibold transition {{ auth()->user()->isFollowing($project->user_id) ? 'bg-blue/20 border border-blue text-blue' : 'bg-white text-black hover:bg-gray-100' }}">
                                {{ auth()->user()->isFollowing($project->user_id) ? 'Following' : 'Follow' }}
                            </button>
                            @endif
                        @else
                        <a href="{{ route('login') }}" class="flex-1 py-2 bg-white text-black rounded-full text-sm font-semibold text-center">Follow</a>
                        @endauth
                        <a href="{{ route('creators.profile', $project->user_id) }}" class="px-4 py-2 border border-white/20 rounded-full text-sm hover:bg-white/10 transition text-center">
                            View Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Related Projects -->
        @if(isset($relatedProjects) && $relatedProjects->count() > 0)
        <div class="mt-16">
            <h2 class="text-2xl font-bold mb-6">Related Projects</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($relatedProjects as $related)
                <a href="{{ route('projects.detail', $related->slug) }}" class="group cursor-pointer">
                    <img src="{{ $related->thumbnail }}" class="w-full h-48 object-cover rounded-xl grayscale-hover transition">
                    <h3 class="font-bold mt-2 group-hover:text-blue transition">{{ $related->title }}</h3>
                    <p class="text-sm text-gray-400">{{ $related->category->name ?? 'Uncategorized' }}</p>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
    // Like functionality
    async function toggleLike() {
        const btn = document.getElementById('likeBtn');
        const likesSpan = document.getElementById('likesCount');
        const slug = '{{ $project->slug }}';
        
        btn.disabled = true;
        
        try {
            const response = await fetch(`/projects/${slug}/like`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            });
            
            const data = await response.json();
            
            if (data.success) {
                if (data.liked) {
                    btn.classList.add('liked');
                } else {
                    btn.classList.remove('liked');
                }
                likesSpan.textContent = data.likes_count.toLocaleString();
            }
        } catch (error) {
            console.error('Error:', error);
        } finally {
            btn.disabled = false;
        }
    }
    
    // Follow creator functionality
    async function toggleFollowCreator(creatorId) {
        const btn = document.getElementById('followCreatorBtn');
        const isFollowing = btn.textContent.trim() === 'Following';
        const url = isFollowing ? `/creators/${creatorId}/unfollow` : `/creators/${creatorId}/follow`;
        const method = isFollowing ? 'DELETE' : 'POST';
        
        btn.disabled = true;
        btn.textContent = 'Loading...';
        
        try {
            const response = await fetch(url, {
                method: method,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            });
            
            const data = await response.json();
            
            if (data.success) {
                if (isFollowing) {
                    btn.textContent = 'Follow';
                    btn.classList.remove('bg-blue/20', 'border', 'border-blue', 'text-blue');
                    btn.classList.add('bg-white', 'text-black', 'hover:bg-gray-100');
                } else {
                    btn.textContent = 'Following';
                    btn.classList.remove('bg-white', 'text-black', 'hover:bg-gray-100');
                    btn.classList.add('bg-blue/20', 'border', 'border-blue', 'text-blue');
                }
            } else {
                btn.textContent = isFollowing ? 'Following' : 'Follow';
            }
        } catch (error) {
            console.error('Error:', error);
            btn.textContent = isFollowing ? 'Following' : 'Follow';
        } finally {
            btn.disabled = false;
        }
    }
</script>
@endpush

@endsection