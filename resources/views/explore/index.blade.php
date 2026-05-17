@extends('layouts.app')

@section('title', 'Explore Projects - Diver Entertainment')

@section('content')

<style>
    /* ============================================ */
    /* EXPLORE PAGE STYLES - Black & White + Blue Accent */
    /* ============================================ */
    
    /* Sticky Category Filter - Background SOLID HITAM */
    .sticky-filter {
        position: sticky;
        top: 80px;
        z-index: 40;
        background: #000000;
        padding: 16px 0;
        border-bottom: 1px solid rgba(0, 210, 255, 0.15);
    }
    
    .sticky-filter::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: #000000;
        z-index: -1;
    }
    
    @media (max-width: 768px) {
        .sticky-filter {
            top: 70px;
            padding: 12px 0;
        }
    }
    
    /* Category Filter Buttons */
    .filter-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        border-radius: 40px;
        font-size: 14px;
        font-weight: 500;
        letter-spacing: 0.5px;
        transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        background: rgba(20, 20, 20, 0.95);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: #9a9a9a;
        white-space: nowrap;
    }
    
    .filter-btn svg {
        width: 18px;
        height: 18px;
        stroke: currentColor;
        fill: none;
    }
    
    .filter-btn:hover {
        border-color: #00D2FF;
        color: #00D2FF;
        transform: translateY(-2px);
        background: #000000;
    }
    
    .filter-btn.active {
        background: #00D2FF;
        border-color: #00D2FF;
        color: #000000;
    }
    
    .filter-btn.active svg {
        stroke: #000000;
    }
    
    /* Filter Container Scroll Horizontal */
    .filter-scroll {
        display: flex;
        overflow-x: auto;
        gap: 12px;
        padding-bottom: 8px;
        scrollbar-width: thin;
        scrollbar-color: #00D2FF #1a1a1a;
    }
    
    .filter-scroll::-webkit-scrollbar {
        height: 3px;
    }
    
    .filter-scroll::-webkit-scrollbar-track {
        background: #1a1a1a;
        border-radius: 10px;
    }
    
    .filter-scroll::-webkit-scrollbar-thumb {
        background: #00D2FF;
        border-radius: 10px;
    }
    
    /* Project Card */
    .project-card {
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }
    
    .project-card:hover {
        transform: translateY(-8px);
    }
    
    /* Thumbnail Image */
    .thumbnail-img {
        transition: all 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        filter: grayscale(100%);
    }
    
    .project-card:hover .thumbnail-img {
        filter: grayscale(0%);
        transform: scale(1.05);
    }
    
    /* Category Badge */
    .category-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        background: rgba(0, 0, 0, 0.85);
        backdrop-filter: blur(4px);
        border-radius: 30px;
        font-size: 11px;
        font-weight: 500;
        letter-spacing: 0.5px;
        color: #00D2FF;
        border: 1px solid rgba(0, 210, 255, 0.3);
        z-index: 5;
    }
    
    /* Overlay on Hover */
    .project-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.95), rgba(0, 0, 0, 0.6), transparent);
        opacity: 0;
        transition: opacity 0.4s ease;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 20px;
    }
    
    .project-card:hover .project-overlay {
        opacity: 1;
    }
    
    /* Like Button Animation */
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
    
    /* Loading Spinner */
    .loading-spinner {
        width: 40px;
        height: 40px;
        border: 2px solid rgba(0, 210, 255, 0.2);
        border-top-color: #00D2FF;
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
    }
    
    @keyframes spin {
        to { transform: rotate(360deg); }
    }
    
    /* Search Input */
    .search-input {
        width: 100%;
        padding: 14px 20px;
        background: rgba(0, 0, 0, 0.7);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 50px;
        color: white;
        font-size: 14px;
        transition: all 0.3s ease;
    }
    
    .search-input:focus {
        outline: none;
        border-color: #00D2FF;
        background: #000000;
    }
    
    .search-input::placeholder {
        color: #6b6b6b;
    }
    
    /* Masonry Grid */
    .masonry-grid {
        columns: 1;
        column-gap: 24px;
    }
    
    @media (min-width: 640px) {
        .masonry-grid { columns: 2; }
    }
    
    @media (min-width: 1024px) {
        .masonry-grid { columns: 3; }
    }
    
    @media (min-width: 1280px) {
        .masonry-grid { columns: 4; }
    }
    
    .masonry-item {
        break-inside: avoid;
        margin-bottom: 24px;
    }
    
    /* Result Count */
    .result-count {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #9a9a9a;
        font-size: 14px;
    }
    
    .result-count span {
        color: #00D2FF;
        font-weight: 600;
    }
    
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>

<!-- Hero Explore Section -->
<section class="relative pt-36 pb-16 px-6 overflow-hidden">
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-gradient-to-r from-black via-black/80 to-transparent z-10"></div>
        <img src="https://images.unsplash.com/photo-1500462918059-b1a0cb512f1d?w=1920" 
             alt="Explore Hero" 
             class="w-full h-full object-cover opacity-40">
    </div>
    
    <div class="relative z-20 container mx-auto">
        <div class="max-w-3xl">
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold mb-4 tracking-tighter reveal">
                Explore <span class="gradient-blue">Gallery</span>
            </h1>
            <p class="text-gray-400 text-lg md:text-xl mb-8 max-w-2xl reveal" style="transition-delay: 0.1s">
                Discover thousands of creative works from our talented community of photographers, designers, and videographers.
            </p>
            
            <!-- Search Bar -->
            <div class="relative max-w-md reveal" style="transition-delay: 0.2s">
                <input type="text" 
                       x-model="searchQuery"
                       placeholder="Search projects, tags, or creators..." 
                       class="search-input pr-12">
                <svg class="absolute right-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
        </div>
    </div>
</section>

<!-- Category Filter -->
<div class="sticky-filter" x-data="{ activeCategory: 'all' }">
    <div class="container mx-auto px-6">
        <div class="filter-scroll">
            <button @click="activeCategory = 'all'; $dispatch('category-change', 'all')" 
                    :class="activeCategory === 'all' ? 'active' : ''"
                    class="filter-btn">
                <svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <rect x="3" y="3" width="7" height="7" rx="1"/>
                    <rect x="14" y="3" width="7" height="7" rx="1"/>
                    <rect x="3" y="14" width="7" height="7" rx="1"/>
                    <rect x="14" y="14" width="7" height="7" rx="1"/>
                </svg>
                <span>All</span>
            </button>
            <button @click="activeCategory = 'photography'; $dispatch('category-change', 'photography')" 
                    :class="activeCategory === 'photography' ? 'active' : ''"
                    class="filter-btn">
                <svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                <span>Photography</span>
            </button>
            <button @click="activeCategory = 'design'; $dispatch('category-change', 'design')" 
                    :class="activeCategory === 'design' ? 'active' : ''"
                    class="filter-btn">
                <svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                <span>Design</span>
            </button>
            <button @click="activeCategory = 'videography'; $dispatch('category-change', 'videography')" 
                    :class="activeCategory === 'videography' ? 'active' : ''"
                    class="filter-btn">
                <svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><rect x="2" y="6" width="16" height="12" rx="2"/><path d="M22 8l-4 4 4 4V8z"/></svg>
                <span>Videography</span>
            </button>
            <button @click="activeCategory = 'poster'; $dispatch('category-change', 'poster')" 
                    :class="activeCategory === 'poster' ? 'active' : ''"
                    class="filter-btn">
                <svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><rect x="4" y="4" width="16" height="16" rx="2"/><line x1="9" y1="8" x2="15" y2="8"/><line x1="9" y1="12" x2="15" y2="12"/><line x1="9" y1="16" x2="12" y2="16"/></svg>
                <span>Poster</span>
            </button>
            <button @click="activeCategory = 'branding'; $dispatch('category-change', 'branding')" 
                    :class="activeCategory === 'branding' ? 'active' : ''"
                    class="filter-btn">
                <svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M20 7h-4.18A3 3 0 0 0 16 5.18V4a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/><circle cx="8" cy="12" r="2"/><path d="M16 12h-4"/></svg>
                <span>Branding</span>
            </button>
            <button @click="activeCategory = 'portrait'; $dispatch('category-change', 'portrait')" 
                    :class="activeCategory === 'portrait' ? 'active' : ''"
                    class="filter-btn">
                <svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                <span>Portrait</span>
            </button>
            <button @click="activeCategory = 'street'; $dispatch('category-change', 'street')" 
                    :class="activeCategory === 'street' ? 'active' : ''"
                    class="filter-btn">
                <svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M2 12h20M12 2v20M3 3l18 18M21 3L3 21"/></svg>
                <span>Street</span>
            </button>
        </div>
    </div>
</div>

<!-- Projects Grid Section -->
<section class="py-12 px-6" x-data="explorePage()" x-init="init()">
    <div class="container mx-auto">
        <div class="mb-8 flex justify-between items-center flex-wrap gap-4">
            <div class="result-count">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <rect x="3" y="3" width="18" height="18" rx="2"/>
                    <line x1="9" y1="3" x2="9" y2="21"/>
                </svg>
                <span x-text="filteredProjects.length"></span> projects found
            </div>
            <div class="text-xs text-gray-500">▼ Scroll to load more</div>
        </div>
        
        <div class="masonry-grid">
            <template x-for="project in displayedProjects" :key="project.id">
                <div class="masonry-item">
                    <div class="project-card group relative cursor-pointer">
                        <div class="relative overflow-hidden rounded-2xl bg-gray-900">
                            <img :src="project.thumbnail" :alt="project.title" class="thumbnail-img w-full transition-all duration-500">
                            
                            <div class="category-badge">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <template x-if="project.category === 'Photography'">
                                        <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/>
                                    </template>
                                    <template x-if="project.category === 'Design'">
                                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                                    </template>
                                    <template x-if="project.category === 'Videography'">
                                        <rect x="2" y="6" width="16" height="12" rx="2"/>
                                    </template>
                                    <template x-if="!project.category || (project.category !== 'Photography' && project.category !== 'Design' && project.category !== 'Videography')">
                                        <circle cx="12" cy="12" r="10"/>
                                    </template>
                                </svg>
                                <span x-text="project.category"></span>
                            </div>
                            
                            <div class="project-overlay">
                                <h3 class="text-lg font-bold mb-1" x-text="project.title"></h3>
                                <p class="text-gray-300 text-sm mb-3 line-clamp-2" x-text="project.description"></p>
                                <div class="flex flex-wrap gap-2 mb-3">
                                    <span class="text-xs px-2 py-1 bg-white/10 rounded-full" x-text="project.subcategory"></span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <div class="flex gap-4 text-xs">
                                        <button @click="likeProject(project.id, $event)" 
                                                class="like-btn flex items-center gap-1 transition"
                                                :class="likedProjects.includes(project.id) ? 'liked' : 'text-gray-300'">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                            </svg>
                                            <span x-text="project.likes.toLocaleString()"></span>
                                        </button>
                                        <span class="flex items-center gap-1">👁️ <span x-text="project.views.toLocaleString()"></span></span>
                                    </div>
                                    <a :href="'/projects/' + project.slug" 
                                       class="px-3 py-1.5 bg-[#00D2FF] text-black rounded-full text-xs font-semibold hover:brightness-110 transition">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <h3 class="font-semibold text-sm" x-text="project.title"></h3>
                            <p class="text-xs text-gray-500" x-text="project.photographer || project.designer || project.videographer"></p>
                        </div>
                    </div>
                </div>
            </template>
        </div>
        
        <div class="text-center mt-12" x-show="displayedProjects.length < filteredProjects.length">
            <button @click="loadMore" 
                    class="px-8 py-3 border border-[#00D2FF] rounded-full text-[#00D2FF] hover:bg-[#00D2FF] hover:text-black transition inline-flex items-center gap-2"
                    :disabled="loading">
                <div x-show="loading" class="loading-spinner w-4 h-4"></div>
                <span x-text="loading ? 'Loading...' : 'Load More Projects'"></span>
            </button>
        </div>
        
        <div class="text-center py-20" x-show="filteredProjects.length === 0">
            <svg class="w-20 h-20 mx-auto text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <h3 class="text-xl font-bold mb-2">No projects found</h3>
            <p class="text-gray-400">Try adjusting your search or filter</p>
        </div>
    </div>
</section>

@push('scripts')
<script>
    function explorePage() {
        return {
            projects: @json($allProjects),
            likedProjects: @json($likedProjectIds ?? []),
            activeCategory: 'all',
            searchQuery: '',
            visibleCount: 24,
            loading: false,
            
            get filteredProjects() {
                let filtered = [...this.projects];
                
                if (this.activeCategory !== 'all') {
                    filtered = filtered.filter(p => {
                        const cat = this.activeCategory;
                        if (cat === 'photography') return p.category === 'Photography';
                        if (cat === 'design') return p.category === 'Design';
                        if (cat === 'videography') return p.category === 'Videography';
                        if (cat === 'poster') return p.subcategory === 'Poster Design';
                        if (cat === 'branding') return p.subcategory === 'Brand Identity';
                        if (cat === 'portrait') return p.subcategory === 'Portrait' || p.subcategory === 'Portrait Photography';
                        if (cat === 'street') return p.tags?.includes('street') || p.tags?.includes('urban');
                        return true;
                    });
                }
                
                if (this.searchQuery) {
                    const query = this.searchQuery.toLowerCase();
                    filtered = filtered.filter(p => 
                        p.title.toLowerCase().includes(query) ||
                        p.description.toLowerCase().includes(query) ||
                        (p.tags && p.tags.some(tag => tag.toLowerCase().includes(query))) ||
                        (p.category && p.category.toLowerCase().includes(query))
                    );
                }
                
                return filtered;
            },
            
            get displayedProjects() {
                return this.filteredProjects.slice(0, this.visibleCount);
            },
            
            init() {
                window.addEventListener('category-change', (e) => {
                    this.activeCategory = e.detail;
                    this.visibleCount = 24;
                });
            },
            
            loadMore() {
                if (this.loading) return;
                this.loading = true;
                setTimeout(() => {
                    this.visibleCount += 12;
                    this.loading = false;
                }, 500);
            },
            
            getProjectSlug(projectId) {
                const project = this.projects.find(p => p.id === projectId);
                return project ? project.slug : '';
            },
            
            async likeProject(projectId, event) {
                if (event) event.stopPropagation();
                
                const slug = this.getProjectSlug(projectId);
                if (!slug) return;
                
                const isLiked = this.likedProjects.includes(projectId);
                const url = `/projects/${slug}/like`;
                
                try {
                    const response = await fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Content-Type': 'application/json'
                        }
                    });
                    
                    const data = await response.json();
                    
                    if (data.success) {
                        if (data.liked) {
                            this.likedProjects.push(projectId);
                        } else {
                            this.likedProjects = this.likedProjects.filter(id => id !== projectId);
                        }
                        
                        // Update likes count di project
                        const project = this.projects.find(p => p.id === projectId);
                        if (project) {
                            project.likes = data.likes_count;
                        }
                        
                        // Force re-render
                        this.projects = [...this.projects];
                    }
                } catch (error) {
                    console.error('Error liking project:', error);
                }
            }
        }
    }
    
    // Reveal animations
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) entry.target.classList.add('active');
        });
    }, { threshold: 0.1 });
    
    document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));
</script>
@endpush

@endsection