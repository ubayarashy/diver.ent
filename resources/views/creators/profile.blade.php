@extends('layouts.app')

@section('title', $creatorData->name . ' - Diver Entertainment')

@section('content')

<style>
    .profile-avatar {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #000000;
        transition: transform 0.3s ease;
    }
    .profile-avatar:hover {
        transform: scale(1.05);
    }
    .stat-card {
        transition: all 0.3s ease;
    }
    .stat-card:hover {
        transform: translateY(-5px);
        background: rgba(0, 210, 255, 0.1);
    }
    .project-card {
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }
    .project-card:hover {
        transform: translateY(-8px);
    }
    .social-icon {
        transition: all 0.3s ease;
    }
    .social-icon:hover {
        color: #00D2FF;
        transform: translateY(-3px);
    }
    .reveal-up {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.6s cubic-bezier(0.34, 1.2, 0.64, 1);
    }
    .reveal-up.active {
        opacity: 1;
        transform: translateY(0);
    }
    .follow-btn {
        transition: all 0.3s ease;
        cursor: pointer;
    }
    .follow-btn.following {
        background: rgba(0, 210, 255, 0.15);
        border: 1px solid #00D2FF;
        color: #00D2FF;
    }
    .follow-btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }
</style>

<!-- Profile Header -->
<div class="pt-32 pb-12 px-6 bg-black">
    <div class="container mx-auto">
        <div class="flex flex-col md:flex-row items-center gap-6 mb-12 reveal-up">
            <!-- Avatar -->
            <img src="{{ $creatorData->avatar }}" alt="{{ $creatorData->name }}" class="profile-avatar">
            
            <!-- Info -->
            <div class="text-center md:text-left">
                <div class="flex items-center justify-center md:justify-start gap-2 mb-2">
                    <h1 class="text-3xl md:text-4xl font-bold">{{ $creatorData->name }}</h1>
                    @if($creatorData->verified)
                    <span class="verified-badge inline-flex items-center justify-center w-5 h-5 bg-blue rounded-full">
                        <svg class="w-3 h-3 text-black" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </span>
                    @endif
                </div>
                <p class="text-gray-400 text-lg">{{ $creatorData->role }}</p>
                @if($creatorData->location)
                <p class="text-gray-500 text-sm mt-1">📍 {{ $creatorData->location }}</p>
                @endif
            </div>
            
            <!-- Follow Button -->
            <div class="md:ml-auto">
                @auth
                    @if(auth()->id() !== $creatorData->id)
                        <button onclick="toggleFollow({{ $creatorData->id }})" 
                                id="followBtn"
                                class="follow-btn px-8 py-3 rounded-full font-semibold transition-all duration-300 
                                    {{ $creatorData->is_following ? 'following' : 'bg-blue text-black hover:bg-blue-dark' }}">
                            {{ $creatorData->is_following ? 'Following' : 'Follow' }}
                        </button>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="px-8 py-3 bg-blue text-black rounded-full font-semibold hover:bg-blue-dark transition">Follow</a>
                @endauth
            </div>
        </div>
        
        <!-- Stats -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-12 reveal-up" style="transition-delay: 0.1s">
            <div class="stat-card glass rounded-2xl p-4 text-center">
                <div class="text-2xl font-bold text-blue" id="followersCount">{{ number_format($creatorData->followers) }}</div>
                <div class="text-sm text-gray-400">Followers</div>
            </div>
            <div class="stat-card glass rounded-2xl p-4 text-center">
                <div class="text-2xl font-bold text-blue">{{ $creatorData->following }}</div>
                <div class="text-sm text-gray-400">Following</div>
            </div>
            <div class="stat-card glass rounded-2xl p-4 text-center">
                <div class="text-2xl font-bold text-blue">{{ $creatorData->projects }}</div>
                <div class="text-sm text-gray-400">Projects</div>
            </div>
            <div class="stat-card glass rounded-2xl p-4 text-center">
                <div class="text-2xl font-bold text-blue">{{ number_format($creatorData->total_likes) }}</div>
                <div class="text-sm text-gray-400">Total Likes</div>
            </div>
        </div>
        
        <!-- Bio Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 mb-12 reveal-up" style="transition-delay: 0.2s">
            <div class="lg:col-span-2">
                <h2 class="text-xl font-bold mb-4">About</h2>
                <p class="text-gray-300 leading-relaxed">{{ $creatorData->bio }}</p>
            </div>
            <div>
                <h2 class="text-xl font-bold mb-4">Contact</h2>
                <div class="space-y-3">
                    <p class="text-gray-400 text-sm">📧 {{ $creatorData->email }}</p>
                    <div class="flex gap-4 mt-4">
                        @foreach($creatorData->social as $platform => $url)
                        <a href="{{ $url }}" target="_blank" class="social-icon text-gray-400 hover:text-blue transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                @if($platform == 'instagram')
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zM12 16c-2.209 0-4-1.791-4-4s1.791-4 4-4 4 1.791 4 4-1.791 4-4 4z"/>
                                @endif
                            </svg>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Featured Projects -->
        @if($creatorProjects->count() > 0)
        <div class="reveal-up" style="transition-delay: 0.3s">
            <h2 class="text-xl font-bold mb-6">Featured Projects</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($creatorProjects as $project)
                <div class="project-card group relative overflow-hidden rounded-2xl">
                    <img src="{{ $project->thumbnail }}" class="w-full h-64 object-cover grayscale-hover transition duration-700" alt="{{ $project->title }}">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition duration-500 flex flex-col justify-end p-5">
                        <h3 class="text-lg font-bold">{{ $project->title }}</h3>
                        <div class="flex justify-between items-center mt-2">
                            <span class="text-sm text-gray-300">❤️ {{ number_format($project->likes) }} likes</span>
                            <a href="/projects/{{ $project->slug }}" class="px-4 py-1 bg-white text-black rounded-full text-sm">View</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
    // Reveal animations
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) entry.target.classList.add('active');
        });
    }, { threshold: 0.1 });
    
    document.querySelectorAll('.reveal-up').forEach(el => revealObserver.observe(el));
    
 async function toggleFollow(creatorId) {
    const btn = document.getElementById('followBtn');
    if (!btn) return;
    
    const followerElement = document.getElementById('followersCount');
    const isFollowing = btn.textContent.trim() === 'Following';
    const url = isFollowing 
        ? `/creators/${creatorId}/unfollow`
        : `/creators/${creatorId}/follow`;
    const method = isFollowing ? 'DELETE' : 'POST';
    
    btn.disabled = true;
    btn.textContent = 'Loading...';
    
    try {
        const response = await fetch(url, {
            method: method,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        });
        
        const data = await response.json();
        
        if (data.success) {
            if (isFollowing) {
                btn.textContent = 'Follow';
                btn.classList.remove('following');
                btn.classList.add('bg-blue', 'text-black', 'hover:bg-blue-dark');
                
                // Kurangi follower count
                if (followerElement) {
                    let currentCount = parseInt(followerElement.textContent.replace(/[^0-9]/g, ''));
                    if (!isNaN(currentCount)) {
                        let newCount = currentCount - 1;
                        followerElement.textContent = newCount.toLocaleString();
                    }
                }
            } else {
                btn.textContent = 'Following';
                btn.classList.remove('bg-blue', 'text-black', 'hover:bg-blue-dark');
                btn.classList.add('following');
                
                // Tambah follower count
                if (followerElement) {
                    let currentCount = parseInt(followerElement.textContent.replace(/[^0-9]/g, ''));
                    if (!isNaN(currentCount)) {
                        let newCount = currentCount + 1;
                        followerElement.textContent = newCount.toLocaleString();
                    }
                }
            }
        } else {
            alert(data.message || 'Something went wrong');
            btn.textContent = isFollowing ? 'Following' : 'Follow';
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Failed to update follow status');
        btn.textContent = isFollowing ? 'Following' : 'Follow';
    } finally {
        btn.disabled = false;
    }
}
</script>
@endpush

@endsection