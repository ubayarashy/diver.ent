@extends('layouts.app')

@section('title', 'Creator Directory - Diver Entertainment')

@section('content')

<style>
    .creator-card {
        transition: all 0.4s ease;
    }
    .creator-card:hover {
        transform: translateY(-8px);
    }
    .glass {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.05);
    }
    .text-blue {
        color: #00D2FF;
    }
    .verified-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 18px;
        height: 18px;
        background: #00D2FF;
        border-radius: 50%;
        color: black;
        font-size: 10px;
    }
    .follow-btn {
        transition: all 0.3s ease;
        cursor: pointer;
    }
    .follow-btn.following {
        background: rgba(0, 210, 255, 0.1);
        border-color: #00D2FF;
        color: #00D2FF;
    }
    .follow-btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }
    .search-input {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
    }
    .search-input:focus {
        border-color: #00D2FF;
        outline: none;
    }
    .reveal-up {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.6s ease;
    }
    .reveal-up.active {
        opacity: 1;
        transform: translateY(0);
    }
    .creator-avatar-large {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #00D2FF;
    }
</style>

<!-- Hero Section -->
<section class="relative pt-32 pb-20 px-6 overflow-hidden" style="background: black;">
    <div class="absolute inset-0 opacity-30">
        <img src="https://images.unsplash.com/photo-1492691527719-9d1e07e534b4?w=1920" 
             class="w-full h-full object-cover">
    </div>
    
    <div class="relative z-10 container mx-auto">
        <div class="max-w-3xl">
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold mb-6 tracking-tighter">
                Meet Our <span class="text-blue">Creators</span>
            </h1>
            <p class="text-gray-400 text-lg md:text-xl mb-8">
                Discover and connect with the most talented creative minds in the industry.
            </p>
            
            <!-- Search Bar -->
            <div class="relative max-w-md">
                <input type="text" 
                       id="searchInput"
                       placeholder="Search by name, role, or tags..." 
                       class="search-input w-full px-6 py-4 rounded-full text-white placeholder-gray-500">
                <svg class="absolute right-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
        </div>
    </div>
</section>

<!-- Category Filter -->
<div class="sticky top-20 z-40 bg-black/95 backdrop-blur-md border-b border-blue/10 py-4">
    <div class="container mx-auto px-6">
        <div class="flex overflow-x-auto gap-3 pb-2">
            <button class="filter-btn-all px-5 py-2 rounded-full text-sm border border-white/10 hover:border-blue transition bg-blue text-black">All Creators</button>
            <button class="filter-btn px-5 py-2 rounded-full text-sm border border-white/10 hover:border-blue transition" data-cat="photography">Photography</button>
            <button class="filter-btn px-5 py-2 rounded-full text-sm border border-white/10 hover:border-blue transition" data-cat="videography">Videography</button>
            <button class="filter-btn px-5 py-2 rounded-full text-sm border border-white/10 hover:border-blue transition" data-cat="design">Design</button>
            <button class="filter-btn px-5 py-2 rounded-full text-sm border border-white/10 hover:border-blue transition" data-cat="branding">Branding</button>
            <button class="filter-btn px-5 py-2 rounded-full text-sm border border-white/10 hover:border-blue transition" data-cat="luxury">Luxury</button>
        </div>
    </div>
</div>

<!-- Creators Grid -->
<section class="py-16 px-6" style="background: black;">
    <div class="container mx-auto">
        
        <!-- Result Count -->
        <div class="mb-8 flex justify-between items-center">
            <div class="text-gray-400 text-sm">
                <span id="resultCount">0</span> creators found
            </div>
            <div class="flex gap-2">
                <button id="sortFollowers" class="text-sm text-blue">Most Followers</button>
                <span class="text-gray-600">|</span>
                <button id="sortProjects" class="text-sm text-gray-500">Most Projects</button>
                <span class="text-gray-600">|</span>
                <button id="sortRating" class="text-sm text-gray-500">Top Rated</button>
            </div>
        </div>
        
        <!-- Creators Grid -->
        <div id="creatorsGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <!-- Creators akan muncul di sini via JavaScript -->
        </div>
        
        <!-- Load More -->
        <div id="loadMoreContainer" class="text-center mt-12" style="display: none;">
            <button id="loadMoreBtn" class="px-8 py-3 border border-blue rounded-full text-blue hover:bg-blue hover:text-black transition">
                Load More Creators
            </button>
        </div>
        
        <!-- No Results -->
        <div id="noResults" class="text-center py-20" style="display: none;">
            <svg class="w-20 h-20 mx-auto text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <h3 class="text-xl font-bold mb-2">No creators found</h3>
            <p class="text-gray-400">Try adjusting your search or filter</p>
            <button id="resetFiltersBtn" class="mt-4 px-6 py-2 bg-blue text-black rounded-full text-sm">
                Reset Filters
            </button>
        </div>
        
    </div>
</section>

@push('scripts')
<script>
    // Data Creators dari PHP
    const creatorsData = @json($creators);
    
    console.log('Creators data:', creatorsData);
    console.log('Jumlah creator:', creatorsData.length);
    
    // AMBIL DATA FOLLOWING DARI DATABASE
    let followingIds = [];
    @auth
        @php
            $followingIdsArray = auth()->user()->following()->pluck('following_id')->toArray();
        @endphp
        followingIds = @json($followingIdsArray);
        console.log('Following IDs from DB:', followingIds);
    @endauth
    
    // State
    let activeCategory = 'all';
    let searchQuery = '';
    let sortBy = 'followers';
    let visibleCount = 12;
    
    // DOM Elements
    const creatorsGrid = document.getElementById('creatorsGrid');
    const resultCount = document.getElementById('resultCount');
    const loadMoreContainer = document.getElementById('loadMoreContainer');
    const noResults = document.getElementById('noResults');
    const searchInput = document.getElementById('searchInput');
    
    // Helper Functions
    function formatNumber(num) {
        if (num >= 1000000) return (num / 1000000).toFixed(1) + 'M';
        if (num >= 1000) return (num / 1000).toFixed(1) + 'K';
        return num.toString();
    }
    
    function escapeHtml(text) {
        if (!text) return '';
        return text.replace(/[&<>]/g, function(m) {
            if (m === '&') return '&amp;';
            if (m === '<') return '&lt;';
            if (m === '>') return '&gt;';
            return m;
        });
    }
    
    async function toggleFollow(creatorId, buttonElement) {
        if (!buttonElement) return;
        
        const isFollowing = buttonElement.textContent.trim() === 'Following';
        const url = isFollowing 
            ? `/creators/${creatorId}/unfollow`
            : `/creators/${creatorId}/follow`;
        const method = isFollowing ? 'DELETE' : 'POST';
        
        buttonElement.disabled = true;
        buttonElement.textContent = 'Loading...';
        
        try {
            const response = await fetch(url, {
                method: method,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json'
                }
            });
            
            const data = await response.json();
            
            if (data.success) {
                if (isFollowing) {
                    buttonElement.textContent = 'Follow';
                    buttonElement.classList.remove('following');
                    buttonElement.classList.remove('border-blue', 'text-blue');
                    buttonElement.classList.add('border-blue/50', 'text-white', 'hover:bg-blue', 'hover:text-black');
                    followingIds = followingIds.filter(id => id !== creatorId);
                } else {
                    buttonElement.textContent = 'Following';
                    buttonElement.classList.remove('border-blue/50', 'text-white', 'hover:bg-blue', 'hover:text-black');
                    buttonElement.classList.add('following', 'border-blue', 'text-blue');
                    followingIds.push(creatorId);
                }
            } else {
                alert(data.message || 'Something went wrong');
                buttonElement.textContent = isFollowing ? 'Following' : 'Follow';
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Failed to update follow status');
            buttonElement.textContent = isFollowing ? 'Following' : 'Follow';
        } finally {
            buttonElement.disabled = false;
        }
    }
    
    function renderCreators() {
        // Filter
        let filtered = [...creatorsData];
        
        if (activeCategory !== 'all') {
            filtered = filtered.filter(c => c.tags && c.tags.includes(activeCategory));
        }
        
        if (searchQuery) {
            const query = searchQuery.toLowerCase();
            filtered = filtered.filter(c => 
                c.name.toLowerCase().includes(query) ||
                (c.role && c.role.toLowerCase().includes(query)) ||
                (c.tags && c.tags.some(tag => tag.toLowerCase().includes(query))) ||
                (c.location && c.location.toLowerCase().includes(query))
            );
        }
        
        // Sort
        if (sortBy === 'followers') {
            filtered.sort((a, b) => b.followers - a.followers);
        } else if (sortBy === 'projects') {
            filtered.sort((a, b) => b.projects - a.projects);
        } else if (sortBy === 'rating') {
            filtered.sort((a, b) => b.rating - a.rating);
        }
        
        // Update result count
        resultCount.textContent = filtered.length;
        
        // Check no results
        if (filtered.length === 0) {
            creatorsGrid.innerHTML = '';
            loadMoreContainer.style.display = 'none';
            noResults.style.display = 'block';
            return;
        }
        
        noResults.style.display = 'none';
        
        // Slice for visible
        const visible = filtered.slice(0, visibleCount);
        
        // Show/hide load more
        if (visibleCount < filtered.length) {
            loadMoreContainer.style.display = 'block';
        } else {
            loadMoreContainer.style.display = 'none';
        }
        
        // Render HTML
        let html = '';
        visible.forEach((creator, index) => {
            const isFollowing = followingIds.includes(creator.id);
            html += `
                <div class="creator-card group reveal-up" style="animation-delay: ${index * 0.03}s">
                    <div class="glass rounded-2xl overflow-hidden">
                        <div class="relative pt-8 pb-4 bg-gradient-to-b from-blue/10 to-transparent">
                            <div class="flex justify-center">
                                <img src="${creator.avatar}" class="creator-avatar-large">
                            </div>
                            ${creator.verified ? '<div class="absolute top-3 right-3"><span class="verified-badge"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg></span></div>' : ''}
                        </div>
                        <div class="p-5 pt-2">
                            <div class="text-center">
                                <h3 class="font-bold text-lg">${escapeHtml(creator.name)}</h3>
                                <p class="text-gray-400 text-sm mb-1">${escapeHtml(creator.role)}</p>
                                <p class="text-gray-500 text-xs mb-3">${escapeHtml(creator.location || 'Various')}</p>
                                <p class="text-gray-400 text-sm line-clamp-2 mb-4">${escapeHtml(creator.bio.substring(0, 100))}${creator.bio.length > 100 ? '...' : ''}</p>
                            </div>
                            <div class="flex justify-between mb-4 text-center">
                                <div><div class="font-bold text-sm">${formatNumber(creator.followers)}</div><div class="text-xs text-gray-500">Followers</div></div>
                                <div><div class="font-bold text-sm">${creator.projects}</div><div class="text-xs text-gray-500">Projects</div></div>
                                <div><div class="font-bold text-sm">⭐ ${creator.rating}</div><div class="text-xs text-gray-500">Rating</div></div>
                            </div>
                            <div class="flex flex-wrap justify-center gap-2 mb-4">
                                ${creator.tags && creator.tags.slice(0, 3).map(tag => `<span class="text-xs px-2 py-1 rounded-full bg-white/5 text-gray-400">${escapeHtml(tag)}</span>`).join('')}
                            </div>
                            <div class="flex gap-2">
                                <button onclick="toggleFollow(${creator.id}, this)" 
                                        class="follow-btn flex-1 py-2 rounded-full text-sm font-semibold border transition ${isFollowing ? 'following border-blue text-blue' : 'border-blue/50 text-white hover:bg-blue hover:text-black'}">
                                    ${isFollowing ? 'Following' : 'Follow'}
                                </button>
                                <a href="/creators/${creator.id}" 
                                   class="flex-1 py-2 rounded-full text-sm font-semibold border border-white/20 hover:border-blue hover:text-blue transition text-center">
                                    View Profile
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        });
        
        creatorsGrid.innerHTML = html;
        
        // Trigger animation
        setTimeout(() => {
            document.querySelectorAll('.reveal-up').forEach(el => el.classList.add('active'));
        }, 100);
    }
    
    function loadMore() {
        visibleCount += 12;
        renderCreators();
    }
    
    function resetFilters() {
        activeCategory = 'all';
        searchQuery = '';
        searchInput.value = '';
        visibleCount = 12;
        renderCreators();
        
        document.querySelectorAll('.filter-btn, .filter-btn-all').forEach(btn => {
            btn.classList.remove('bg-blue', 'text-black');
            btn.classList.add('text-white');
        });
        document.querySelector('.filter-btn-all').classList.add('bg-blue', 'text-black');
        document.querySelector('.filter-btn-all').classList.remove('text-white');
    }
    
    function updateSortButtons(activeId) {
        const buttons = ['sortFollowers', 'sortProjects', 'sortRating'];
        buttons.forEach(id => {
            const btn = document.getElementById(id);
            if (id === activeId) {
                btn.classList.add('text-blue');
                btn.classList.remove('text-gray-500');
            } else {
                btn.classList.add('text-gray-500');
                btn.classList.remove('text-blue');
            }
        });
    }
    
    // Event Listeners
    document.addEventListener('DOMContentLoaded', () => {
        renderCreators();
        
        searchInput.addEventListener('input', (e) => {
            searchQuery = e.target.value;
            visibleCount = 12;
            renderCreators();
        });
        
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                activeCategory = btn.dataset.cat;
                visibleCount = 12;
                renderCreators();
                
                document.querySelectorAll('.filter-btn, .filter-btn-all').forEach(b => {
                    b.classList.remove('bg-blue', 'text-black');
                    b.classList.add('text-white');
                });
                btn.classList.add('bg-blue', 'text-black');
                btn.classList.remove('text-white');
            });
        });
        
        document.querySelector('.filter-btn-all').addEventListener('click', () => {
            activeCategory = 'all';
            visibleCount = 12;
            renderCreators();
            
            document.querySelectorAll('.filter-btn, .filter-btn-all').forEach(b => {
                b.classList.remove('bg-blue', 'text-black');
                b.classList.add('text-white');
            });
            document.querySelector('.filter-btn-all').classList.add('bg-blue', 'text-black');
            document.querySelector('.filter-btn-all').classList.remove('text-white');
        });
        
        document.getElementById('sortFollowers').addEventListener('click', () => {
            sortBy = 'followers';
            visibleCount = 12;
            renderCreators();
            updateSortButtons('sortFollowers');
        });
        
        document.getElementById('sortProjects').addEventListener('click', () => {
            sortBy = 'projects';
            visibleCount = 12;
            renderCreators();
            updateSortButtons('sortProjects');
        });
        
        document.getElementById('sortRating').addEventListener('click', () => {
            sortBy = 'rating';
            visibleCount = 12;
            renderCreators();
            updateSortButtons('sortRating');
        });
        
        document.getElementById('loadMoreBtn').addEventListener('click', loadMore);
        document.getElementById('resetFiltersBtn').addEventListener('click', resetFilters);
    });
</script>
@endpush
@endsection