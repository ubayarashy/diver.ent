@extends('layouts.app')

@section('title', 'Diver Entertainment - Creative Agency Premium')

@section('content')

<style>
    /* ============================================ */
    /* THEME: BLACK & WHITE + VIBRANT BLUE */
    /* ============================================ */
    :root {
        --black: #000000;
        --white: #ffffff;
        --blue: #00D2FF;
        --blue-dark: #0099cc;
        --blue-glow: rgba(0, 210, 255, 0.12);
        --gray-100: #111111;
        --gray-200: #1a1a1a;
        --gray-300: #2a2a2a;
        --gray-400: #6b6b6b;
        --gray-500: #9a9a9a;
    }
    
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { background: var(--black); color: var(--white); font-family: 'Satoshi', 'Inter', sans-serif; overflow-x: hidden; }
    .section-black { background-color: var(--black); color: var(--white); }
    
    /* Glassmorphism */
    .glass { background: rgba(255, 255, 255, 0.03); backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.06); transition: all 0.4s ease; }
    .glass:hover { border-color: rgba(0, 210, 255, 0.3); background: rgba(255, 255, 255, 0.05); }
    
    .text-blue { color: var(--blue) !important; }
    .border-blue { border-color: var(--blue) !important; }
    .bg-blue { background: var(--blue) !important; }
    
    /* Gradient Text */
    .gradient-blue { background: linear-gradient(135deg, var(--white) 0%, var(--blue) 60%, var(--white) 100%); background-size: 200% auto; -webkit-background-clip: text; background-clip: text; color: transparent; animation: shine 4s ease-in-out infinite; }
    @keyframes shine { 0% { background-position: 0% center; } 100% { background-position: 200% center; } }
    
    /* ============================================ */
    /* ABSTRACT ELEMENTS - ELEGAN */
    /* ============================================ */
    .abstract-dot { position: absolute; background: var(--blue); border-radius: 50%; opacity: 0.1; pointer-events: none; }
    .abstract-line { position: absolute; background: linear-gradient(90deg, transparent, var(--blue), transparent); height: 1px; opacity: 0.15; pointer-events: none; }
    .abstract-glow { position: absolute; background: radial-gradient(circle, var(--blue-glow) 0%, transparent 70%); border-radius: 50%; filter: blur(50px); pointer-events: none; }
    
    /* ============================================ */
    /* HERO GRID - LEFT TEXT WITH "YOUR DIVING BUDDY" */
    /* ============================================ */
    .hero-grid { display: grid; grid-template-columns: 1fr 1fr; min-height: 90vh; align-items: center; gap: 4rem; }
    @media (max-width: 768px) { .hero-grid { grid-template-columns: 1fr; text-align: center; gap: 2rem; padding: 4rem 0; } }
    
    .hero-tagline { font-size: 1rem; letter-spacing: 4px; margin-bottom: 1.5rem; color: var(--blue); font-weight: 500; }
    .hero-title { font-size: 4.5rem; font-weight: 700; line-height: 1.1; margin-bottom: 1.5rem; }
    @media (min-width: 768px) { .hero-title { font-size: 5.5rem; } }
    @media (min-width: 1024px) { .hero-title { font-size: 6.5rem; } }
    
    .hero-stats { display: flex; gap: 2rem; margin-top: 2rem; }
    .hero-stat { border-left: 1px solid rgba(255,255,255,0.1); padding-left: 1rem; }
    .hero-stat .number { font-size: 1.5rem; font-weight: 700; color: var(--blue); }
    .hero-stat .label { font-size: 0.7rem; text-transform: uppercase; letter-spacing: 1px; color: var(--gray-500); }
    
    /* ============================================ */
    /* TEMPLATE 1: MASONRY GRID */
    /* ============================================ */
    .masonry-grid { columns: 3; column-gap: 1.5rem; }
    @media (max-width: 1024px) { .masonry-grid { columns: 2; } }
    @media (max-width: 640px) { .masonry-grid { columns: 1; } }
    .masonry-item { break-inside: avoid; margin-bottom: 1.5rem; position: relative; overflow: hidden; border-radius: 1.5rem; transition: all 0.4s ease; }
    .masonry-item:hover { transform: translateY(-5px); }
    .masonry-item img { width: 100%; height: auto; transition: transform 0.7s ease; filter: grayscale(100%); }
    .masonry-item:hover img { transform: scale(1.03); filter: grayscale(0%); }
    .masonry-overlay { position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.85), transparent); opacity: 0; transition: opacity 0.4s ease; display: flex; flex-direction: column; justify-content: flex-end; padding: 1.5rem; }
    .masonry-item:hover .masonry-overlay { opacity: 1; }
    
    /* ============================================ */
    /* TEMPLATE 2: HORIZONTAL SWIPE GALLERY */
    /* ============================================ */
    .swipe-gallery { display: flex; overflow-x: auto; scroll-snap-type: x mandatory; scroll-behavior: smooth; cursor: grab; scrollbar-width: thin; scrollbar-color: var(--blue) rgba(255,255,255,0.1); padding-bottom: 1.5rem; gap: 1.5rem; }
    .swipe-gallery:active { cursor: grabbing; }
    .swipe-gallery::-webkit-scrollbar { height: 3px; }
    .swipe-gallery::-webkit-scrollbar-track { background: rgba(255, 255, 255, 0.08); border-radius: 10px; }
    .swipe-gallery::-webkit-scrollbar-thumb { background: var(--blue); border-radius: 10px; }
    .swipe-item { scroll-snap-align: start; flex-shrink: 0; width: 320px; transition: all 0.4s ease; }
    .swipe-item:hover { transform: translateY(-8px); }
    .swipe-card { background: var(--gray-200); border-radius: 1.5rem; overflow: hidden; }
    .swipe-card-img { height: 380px; background-size: cover; background-position: center; filter: grayscale(100%); transition: all 0.5s ease; }
    .swipe-item:hover .swipe-card-img { filter: grayscale(0%); transform: scale(1.02); }
    
    /* ============================================ */
    /* TEMPLATE 3: POSTER GRID - 3D HOVER */
    /* ============================================ */
    .poster-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.5rem; }
    .poster-card { position: relative; border-radius: 1rem; overflow: hidden; aspect-ratio: 2/3; transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94); }
    .poster-card:hover { transform: perspective(1000px) rotateY(5deg) rotateX(5deg); box-shadow: 0 20px 40px rgba(0,0,0,0.4); }
    .poster-card img { width: 100%; height: 100%; object-fit: cover; filter: grayscale(100%); transition: all 0.5s ease; }
    .poster-card:hover img { filter: grayscale(0%); }
    .poster-info { position: absolute; bottom: 0; left: 0; right: 0; padding: 1.5rem; background: linear-gradient(to top, rgba(0,0,0,0.9), transparent); transform: translateY(100%); transition: transform 0.4s ease; }
    .poster-card:hover .poster-info { transform: translateY(0); }
    
    /* ============================================ */
    /* TEMPLATE 4: ARTICLE CARDS */
    /* ============================================ */
    .article-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem; }
    @media (max-width: 1024px) { .article-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 640px) { .article-grid { grid-template-columns: 1fr; } }
    .article-card { background: rgba(255, 255, 255, 0.02); border-radius: 1rem; overflow: hidden; transition: all 0.4s ease; }
    .article-card:hover { transform: translateY(-5px); background: rgba(255, 255, 255, 0.04); }
    .article-img { height: 200px; background: linear-gradient(135deg, var(--gray-200), var(--gray-300)); display: flex; align-items: center; justify-content: center; overflow: hidden; }
    .article-img svg { width: 50px; height: 50px; opacity: 0.3; transition: all 0.3s ease; }
    .article-card:hover .article-img svg { opacity: 0.5; transform: scale(1.1); }
    .article-content { padding: 1.5rem; }
    .article-meta { display: flex; justify-content: space-between; margin-bottom: 0.75rem; font-size: 0.7rem; }
    .article-meta .category { color: var(--blue); text-transform: uppercase; letter-spacing: 1px; }
    .article-title { font-size: 1.1rem; font-weight: 600; margin-bottom: 0.5rem; line-height: 1.4; }
    .article-excerpt { font-size: 0.85rem; color: var(--gray-500); line-height: 1.5; margin-bottom: 1rem; }
    
    /* ============================================ */
    /* PROJECT SHOWCASE - SPLIT LAYOUT */
    /* ============================================ */
    .project-showcase { display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin: 2rem 0; }
    @media (max-width: 768px) { .project-showcase { grid-template-columns: 1fr; } }
    .project-showcase-left { position: relative; border-radius: 1.5rem; overflow: hidden; min-height: 450px; background-size: cover; background-position: center; filter: grayscale(100%); transition: all 0.5s ease; }
    .project-showcase-left:hover { filter: grayscale(0%); }
    .project-showcase-right { display: flex; flex-direction: column; justify-content: center; }
    .project-showcase-right .tag { color: var(--blue); font-size: 0.7rem; letter-spacing: 2px; margin-bottom: 1rem; text-transform: uppercase; }
    .project-showcase-right h3 { font-size: 2rem; font-weight: 700; margin-bottom: 1rem; line-height: 1.2; }
    .project-showcase-right p { color: var(--gray-500); line-height: 1.6; margin-bottom: 1.5rem; }
    
    /* ============================================ */
    /* TEAM CARDS */
    /* ============================================ */
    .team-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem; }
    @media (max-width: 1024px) { .team-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 640px) { .team-grid { grid-template-columns: 1fr; } }
    .team-card { text-align: center; transition: all 0.4s ease; }
    .team-card:hover { transform: translateY(-5px); }
    .team-avatar { width: 120px; height: 120px; margin: 0 auto 1rem; border-radius: 50%; background: linear-gradient(135deg, var(--gray-200), var(--gray-300)); display: flex; align-items: center; justify-content: center; overflow: hidden; }
    .team-avatar svg { width: 50px; height: 50px; opacity: 0.4; }
    .team-card:hover .team-avatar svg { opacity: 0.7; transform: scale(1.05); }
    .team-name { font-size: 1.1rem; font-weight: 600; margin-bottom: 0.25rem; }
    .team-role { font-size: 0.8rem; color: var(--blue); letter-spacing: 1px; margin-bottom: 0.5rem; }
    
    /* ============================================ */
    /* COUNTER & SCROLL REVEAL */
    /* ============================================ */
    .counter-number { font-size: 2.5rem; font-weight: 700; color: var(--blue); }
    .reveal-up { opacity: 0; transform: translateY(40px); transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94); }
    .reveal-up.active { opacity: 1; transform: translateY(0); }
    .reveal-left { opacity: 0; transform: translateX(-40px); transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94); }
    .reveal-left.active { opacity: 1; transform: translateX(0); }
    .reveal-right { opacity: 0; transform: translateX(40px); transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94); }
    .reveal-right.active { opacity: 1; transform: translateX(0); }
    .reveal-scale { opacity: 0; transform: scale(0.95); transition: all 0.6s cubic-bezier(0.34, 1.2, 0.64, 1); }
    .reveal-scale.active { opacity: 1; transform: scale(1); }
    .stagger-children > * { opacity: 0; transform: translateY(25px); transition: all 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94); }
    .stagger-children.active > *:nth-child(1) { transition-delay: 0s; opacity: 1; transform: translateY(0); }
    .stagger-children.active > *:nth-child(2) { transition-delay: 0.08s; opacity: 1; transform: translateY(0); }
    .stagger-children.active > *:nth-child(3) { transition-delay: 0.16s; opacity: 1; transform: translateY(0); }
    .stagger-children.active > *:nth-child(4) { transition-delay: 0.24s; opacity: 1; transform: translateY(0); }
    
    /* Scroll Progress */
    .scroll-progress { position: fixed; top: 0; left: 0; width: 0%; height: 2px; background: var(--blue); z-index: 1000; transition: width 0.1s ease; }
    .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
</style>

<div class="scroll-progress" id="scrollProgress"></div>

<!-- ============================================ -->
<!-- HERO SECTION - DENGAN TAGLINE "YOUR DIVING BUDDY" -->
<!-- ============================================ -->
<section class="relative min-h-screen flex items-center overflow-hidden section-black">
    <!-- Abstract Decoration -->
    <div class="abstract-glow" style="width: 400px; height: 400px; top: 20%; right: 0;"></div>
    <div class="abstract-glow" style="width: 300px; height: 300px; bottom: 10%; left: 10%;"></div>
    <div class="abstract-line" style="width: 200px; top: 30%; right: 20%;"></div>
    
    <div class="container mx-auto px-6">
        <div class="hero-grid">
            <!-- Left Side - dengan "Your Diving Buddy" -->
            <div class="relative z-10">
                <div class="hero-tagline reveal-left">✦ YOUR DIVING BUDDY ✦</div>
                <h1 class="hero-title">
                    <span class="reveal-left inline-block" style="transition-delay: 0.1s">To Elevate</span><br>
                    <span class="gradient-blue reveal-left inline-block" style="transition-delay: 0.2s">Your Brand</span>
                </h1>
                <div class="w-12 h-0.5 bg-blue mb-6 reveal-left" style="transition-delay: 0.3s"></div>
                <p class="text-gray-300 text-lg mb-8 max-w-md reveal-left" style="transition-delay: 0.4s">
                    We craft cinematic experiences that tell your story, elevate your brand, and captivate your audience.
                </p>
                <div class="flex flex-wrap gap-4 reveal-left" style="transition-delay: 0.5s">
                    <a href="#gallery" class="px-8 py-3 bg-white text-black rounded-full font-semibold hover:bg-gray-100 transition">Explore Work</a>
                    <a href="/contact" class="px-8 py-3 border border-white/30 rounded-full hover:bg-white/10 transition">Collaborate</a>
                </div>
                <div class="hero-stats reveal-left" style="transition-delay: 0.6s">
                    <div class="hero-stat"><div class="number" data-target="385">0+</div><div class="label">Projects</div></div>
                    <div class="hero-stat"><div class="number" data-target="256">0+</div><div class="label">Clients</div></div>
                    <div class="hero-stat"><div class="number" data-target="34">0+</div><div class="label">Awards</div></div>
                </div>
            </div>
            
            <!-- Right Side - Abstract Stats Card -->
            <div class="relative z-10 flex justify-center reveal-right" style="transition-delay: 0.2s">
                <div class="glass rounded-2xl p-8 w-full max-w-md">
                    <div class="flex items-center gap-2 mb-6"><div class="w-2 h-2 rounded-full bg-blue animate-pulse"></div><span class="text-xs text-gray-500">ACTIVE NOW</span></div>
                    <div class="space-y-4">
                        <div><div class="flex justify-between text-sm mb-1"><span>Brand Identity</span><span class="text-blue">92%</span></div><div class="h-1.5 bg-white/10 rounded-full"><div class="h-full w-[92%] bg-blue rounded-full"></div></div></div>
                        <div><div class="flex justify-between text-sm mb-1"><span>Digital Campaign</span><span class="text-blue">88%</span></div><div class="h-1.5 bg-white/10 rounded-full"><div class="h-full w-[88%] bg-blue rounded-full"></div></div></div>
                        <div><div class="flex justify-between text-sm mb-1"><span>Visual Storytelling</span><span class="text-blue">95%</span></div><div class="h-1.5 bg-white/10 rounded-full"><div class="h-full w-[95%] bg-blue rounded-full"></div></div></div>
                    </div>
                    <div class="border-t border-white/10 my-6"></div>
                    <div class="bg-blue/5 rounded-lg p-3"><code class="text-xs text-blue">>_ your diving buddy // est.2024</code></div>
                    <div class="flex gap-3 mt-6"><div class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center"><span class="text-blue text-xs font-bold">NK</span></div><div class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center"><span class="text-blue text-xs font-bold">GC</span></div><div class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center"><span class="text-blue text-xs font-bold">AD</span></div><div class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center"><span class="text-blue text-xs font-bold">PR</span></div></div>
                </div>
            </div>
        </div>
    </div>
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce opacity-40"><svg class="w-5 h-5" fill="none" stroke="white" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg></div>
</section>

<!-- ============================================ -->
<!-- TRUSTED CLIENTS MARQUEE -->
<!-- ============================================ -->

<style>@keyframes marquee { 0% { transform: translateX(0); } 100% { transform: translateX(-33.33%); } }</style>

<!-- ============================================ -->
<!-- TEMPLATE 1: MASONRY GALLERY -->
<!-- ============================================ -->
<section class="py-24 px-6 section-black">
    <div class="container mx-auto">
        <div class="flex justify-between items-end mb-12 flex-wrap gap-4">
            <div><span class="text-blue text-xs tracking-wider reveal-left">MASONRY GALLERY</span><h2 class="text-4xl md:text-5xl font-bold mt-2 reveal-left" style="transition-delay: 0.1s">Featured <span class="gradient-blue">Works</span></h2></div>
            <a href="/explore" class="text-sm text-gray-400 hover:text-blue transition reveal-right">View All →</a>
        </div>
        <div class="masonry-grid">
            @php $categories = ['FASHION', 'LUXURY', 'STREET', 'EDITORIAL', 'PRODUCT', 'PORTRAIT']; $brands2 = ['Nike','Gucci','Prada','Dior','Versace','Adidas']; @endphp
            @for($i=1;$i<=12;$i++)
            <div class="masonry-item reveal-scale" style="transition-delay: {{ ($i % 6) * 0.05 }}s">
                <div style="background: linear-gradient(135deg, #1a1a2e, #16213e); min-height: {{ 200 + ($i * 15) }}px; display: flex; align-items: center; justify-content: center; border-radius: 1rem;"><svg class="w-16 h-16 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg></div>
                <div class="masonry-overlay"><span class="text-blue text-xs tracking-wider">{{ $categories[array_rand($categories)] }}</span><h3 class="text-lg font-bold">{{ $brands2[array_rand($brands2)] }} Campaign</h3><p class="text-gray-400 text-sm">{{ rand(2022,2024) }}</p></div>
            </div>
            @endfor
        </div>
    </div>
</section>

<!-- ============================================ -->
<!-- TEMPLATE 2: HORIZONTAL SWIPE GALLERY -->
<!-- ============================================ -->

<!-- ============================================ -->
<!-- TEMPLATE 3: POSTER GRID -->
<!-- ============================================ -->
<section class="py-24 px-6 section-black">
    <div class="container mx-auto">
        <div class="flex justify-between items-end mb-12 flex-wrap gap-4">
            <div><span class="text-blue text-xs tracking-wider reveal-right">POSTER SERIES</span><h2 class="text-4xl md:text-5xl font-bold mt-2 reveal-right" style="transition-delay: 0.1s">Poster <span class="gradient-blue">Collection</span></h2></div>
        </div>
        <div class="poster-grid">
            @php $posterTitles = ['Minimalist Series','Urban Decay','Neon Dreams','Abstract Forms','Monochrome','Typography','Vintage Vibes','Cinematic']; @endphp
            @for($i=1;$i<=8;$i++)
            <div class="poster-card reveal-scale" style="transition-delay: {{ ($i % 8) * 0.05 }}s">
                <div style="background: linear-gradient(135deg, #1a1a2e, #16213e); width:100%; height:100%; display:flex; align-items:center; justify-content:center;"><svg class="w-16 h-16 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 4v16m8-8H4"></path></svg></div>
                <div class="poster-info"><span class="text-blue text-xs">POSTER</span><h3 class="font-bold">{{ $posterTitles[array_rand($posterTitles)] }}</h3><p class="text-gray-400 text-sm">{{ rand(2022,2024) }}</p></div>
            </div>
            @endfor
        </div>
    </div>
</section>

<!-- ============================================ -->
<!-- PROJECT SHOWCASE - SPLIT LAYOUT -->
<!-- ============================================ -->
<section class="py-24 px-6 section-black">
    <div class="container mx-auto">
        <div class="text-center mb-12"><span class="text-blue text-xs tracking-wider reveal-up">PROJECT SHOWCASE</span><h2 class="text-4xl md:text-5xl font-bold mt-2 reveal-up" style="transition-delay: 0.1s">Featured <span class="gradient-blue">Projects</span></h2></div>
        <div class="project-showcase">
            <div class="project-showcase-left reveal-scale" style="background: linear-gradient(135deg, #16213e, #1a1a2e); min-height: 450px; display: flex; align-items: center; justify-content: center;"><svg class="w-24 h-24 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg></div>
            <div class="project-showcase-right reveal-scale" style="transition-delay: 0.1s"><div class="tag">FEATURED WORK</div><h3>Nike Air Max<br>Cinematic Campaign</h3><p>An award-winning fashion film that redefined brand storytelling. Shot across three cities with local artists and athletes.</p><div class="flex gap-4"><div><div class="text-blue text-xl">2.5M</div><div class="text-xs text-gray-500">Views</div></div><div><div class="text-blue text-xl">45%</div><div class="text-xs text-gray-500">Engagement</div></div><div><div class="text-blue text-xl">12</div><div class="text-xs text-gray-500">Awards</div></div></div><a href="#" class="inline-block mt-6 text-blue text-sm hover:underline">View Project →</a></div>
        </div>
        <div class="project-showcase mt-8">
            <div class="project-showcase-right reveal-scale"><div class="tag">BRAND IDENTITY</div><h3>Starbucks Reserve<br>Visual Identity</h3><p>Complete brand identity system for Starbucks Reserve flagship store, from packaging to interior branding.</p><div class="flex gap-4"><div><div class="text-blue text-xl">1.2M</div><div class="text-xs text-gray-500">Impressions</div></div><div><div class="text-blue text-xl">60%</div><div class="text-xs text-gray-500">Growth</div></div></div><a href="#" class="inline-block mt-6 text-blue text-sm hover:underline">View Project →</a></div>
            <div class="project-showcase-left reveal-scale" style="transition-delay: 0.1s; background: linear-gradient(135deg, #0f3460, #16213e); min-height: 450px; display: flex; align-items: center; justify-content: center;"><svg class="w-24 h-24 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg></div>
        </div>
    </div>
</section>

<!-- ============================================ -->
<!-- OUR RESULTS - COUNTERS -->
<!-- ============================================ -->
<section class="py-24 px-6 section-black">
    <div class="container mx-auto text-center">
        <div class="mb-12"><span class="text-blue text-xs tracking-wider reveal-up">ACHIEVEMENTS</span><h2 class="text-4xl md:text-5xl font-bold mt-2 reveal-up" style="transition-delay: 0.1s">Our <span class="gradient-blue">Results</span></h2></div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 stagger-children">
            <div><div class="counter-number" data-target="385">0</div><div class="text-gray-500 text-sm mt-1">Projects</div></div>
            <div><div class="counter-number" data-target="256">0</div><div class="text-gray-500 text-sm mt-1">Happy Clients</div></div>
            <div><div class="counter-number" data-target="34">0</div><div class="text-gray-500 text-sm mt-1">Awards</div></div>
            <div><div class="counter-number" data-target="12">0</div><div class="text-gray-500 text-sm mt-1">Years</div></div>
        </div>
    </div>
</section>

<!-- ============================================ -->
<!-- TEMPLATE 4: ARTICLES GRID -->
<!-- ============================================ -->
<section class="py-24 px-6 section-black">
    <div class="container mx-auto">
        <div class="flex justify-between items-end mb-12 flex-wrap gap-4">
            <div><span class="text-blue text-xs tracking-wider reveal-left">INSIGHTS</span><h2 class="text-4xl md:text-5xl font-bold mt-2 reveal-left" style="transition-delay: 0.1s">Latest <span class="gradient-blue">Articles</span></h2></div>
            <a href="#" class="text-sm text-gray-400 hover:text-blue transition reveal-right">All Articles →</a>
        </div>
        <div class="article-grid">
            @php $articles = [['title'=>'How Cinematic Storytelling Transforms Brand Identity','cat'=>'BRANDING','time'=>'5 min','excerpt'=>'Discover how brands like Nike use visual storytelling to connect with audiences.'],['title'=>'The Rise of Minimalist Aesthetic in Modern Advertising','cat'=>'TRENDS','time'=>'4 min','excerpt'=>'Why less is more: How luxury brands are embracing monochrome and simplicity.'],['title'=>'Behind the Scenes: Fashion Campaign Production','cat'=>'PRODUCTION','time'=>'6 min','excerpt'=>'Exclusive look at how we produced the latest Tommy Hilfiger campaign.'],['title'=>'Social Media Strategy for Local Businesses','cat'=>'STRATEGY','time'=>'7 min','excerpt'=>'How barbershops and cafes leverage visual content to attract more customers.']]; @endphp
            @foreach($articles as $a)
            <div class="article-card reveal-scale"><div class="article-img"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg></div><div class="article-content"><div class="article-meta"><span class="category">{{ $a['cat'] }}</span><span class="text-gray-600">{{ $a['time'] }}</span></div><h3 class="article-title">{{ $a['title'] }}</h3><p class="article-excerpt line-clamp-2">{{ $a['excerpt'] }}</p><a href="#" class="text-blue text-sm hover:underline inline-flex items-center gap-1">Read More <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></a></div></div>
            @endforeach
        </div>
    </div>
</section>

<!-- ============================================ -->
<!-- TEAM SECTION -->
<!-- ============================================ -->
<section class="py-24 px-6 section-black">
    <div class="container mx-auto">
        <div class="text-center mb-12"><span class="text-blue text-xs tracking-wider reveal-up">THE TEAM</span><h2 class="text-4xl md:text-5xl font-bold mt-2 reveal-up" style="transition-delay: 0.1s">Creative <span class="gradient-blue">Minds</span></h2></div>
        <div class="team-grid">
            @php $teams = [['name'=>'Andi Pratama','role'=>'Creative Director'],['name'=>'Citra Dewi','role'=>'Lead Photographer'],['name'=>'Budi Santoso','role'=>'Videographer'],['name'=>'Dian Sastro','role'=>'Lead Editor'],['name'=>'Eka Gusti','role'=>'Social Media Director'],['name'=>'Fajar Nugraha','role'=>'Lead Designer'],['name'=>'Rina Widiastuti','role'=>'Motion Artist'],['name'=>'Tony Harsono','role'=>'Producer']]; @endphp
            @foreach($teams as $t)
            <div class="team-card reveal-scale"><div class="team-avatar"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg></div><div class="team-name">{{ $t['name'] }}</div><div class="team-role">{{ $t['role'] }}</div></div>
            @endforeach
        </div>
    </div>
</section>

<!-- ============================================ -->
<!-- PHILOSOPHY PARALLAX -->
<!-- ============================================ -->
<section class="py-32 px-6 section-black relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-r from-blue/5 via-transparent to-blue/5"></div>
    <div class="relative z-10 text-center max-w-4xl mx-auto"><span class="text-blue text-xs tracking-wider reveal-up">PHILOSOPHY</span><h2 class="text-4xl md:text-6xl lg:text-7xl font-bold mt-4 reveal-up" style="transition-delay: 0.1s">We Don't Just Create.<br>We <span class="gradient-blue">Immerse</span>.</h2><p class="text-gray-300 text-lg mt-6 reveal-up" style="transition-delay: 0.2s">Diver Entertainment is more than a creative agency. We're storytellers, visionaries, and your dedicated partner in navigating the depths of digital creativity.</p></div>
</section>

<!-- ============================================ -->
<!-- TESTIMONIALS -->
<!-- ============================================ -->
<section class="py-24 px-6 section-black">
    <div class="container mx-auto">
        <div class="text-center mb-12"><span class="text-blue text-xs tracking-wider reveal-up">TESTIMONIALS</span><h2 class="text-4xl md:text-5xl font-bold mt-2 reveal-up" style="transition-delay: 0.1s">What <span class="gradient-blue">Clients Say</span></h2></div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="glass rounded-2xl p-6 reveal-scale"><div class="flex items-center gap-4 mb-4"><div class="w-12 h-12 rounded-full bg-gradient-to-br from-gray-700 to-gray-900 flex items-center justify-center"><span class="text-white/50">MR</span></div><div><h4 class="font-bold text-sm">Michael Roberts</h4><p class="text-xs text-gray-500">Marketing Director, Nike</p></div></div><div class="flex gap-1 mb-3 text-blue">★★★★★</div><p class="text-gray-400 text-sm">Diver Entertainment transformed our brand identity. The fashion campaign was pure magic! 45% increase in engagement.</p></div>
            <div class="glass rounded-2xl p-6 reveal-scale" style="transition-delay: 0.1s"><div class="flex items-center gap-4 mb-4"><div class="w-12 h-12 rounded-full bg-gradient-to-br from-gray-700 to-gray-900 flex items-center justify-center"><span class="text-white/50">JW</span></div><div><h4 class="font-bold text-sm">James Wilson</h4><p class="text-xs text-gray-500">Owner, Barbershop Suites</p></div></div><div class="flex gap-1 mb-3 text-blue">★★★★★</div><p class="text-gray-400 text-sm">Our barbershop branding went viral! Instagram grew 300% in 3 months.</p></div>
            <div class="glass rounded-2xl p-6 reveal-scale" style="transition-delay: 0.2s"><div class="flex items-center gap-4 mb-4"><div class="w-12 h-12 rounded-full bg-gradient-to-br from-gray-700 to-gray-900 flex items-center justify-center"><span class="text-white/50">AM</span></div><div><h4 class="font-bold text-sm">Alessandro Michele</h4><p class="text-xs text-gray-500">Creative Director, Gucci</p></div></div><div class="flex gap-1 mb-3 text-blue">★★★★★</div><p class="text-gray-400 text-sm">The cinematic quality of the film was world-class. Their creative vision is unmatched.</p></div>
        </div>
    </div>
</section>

<!-- ============================================ -->
<!-- CTA SECTION -->
<!-- ============================================ -->
<section class="py-32 px-6 text-center section-black relative overflow-hidden">
    <div class="absolute inset-0 opacity-5" style="background-image: url('https://images.unsplash.com/photo-1541701494587-cb58502866ab?w=1920'); background-size: cover;"></div>
    <div class="relative z-10 max-w-4xl mx-auto"><h2 class="text-4xl md:text-6xl lg:text-7xl font-bold mb-6 reveal-up">Let's Build Something<br><span class="gradient-blue">Extraordinary</span></h2><p class="text-gray-300 text-lg mb-10 reveal-up" style="transition-delay: 0.2s">Ready to dive into your next creative project? Let's collaborate and create something extraordinary together.</p><div class="flex flex-col sm:flex-row gap-4 justify-center reveal-up" style="transition-delay: 0.4s"><a href="/register?role=creator" class="px-8 py-4 bg-white text-black rounded-full font-semibold hover:bg-gray-100 transition">Join as Creator</a><a href="/contact" class="px-8 py-4 border border-blue rounded-full text-blue hover:bg-blue hover:text-black transition">Contact Us</a></div></div>
</section>

@push('scripts')
<script>
(function() {
    // Scroll Reveal Observer
    const revealElements = document.querySelectorAll('.reveal-up, .reveal-left, .reveal-right, .reveal-scale, .stagger-children');
    const revealObserver = new IntersectionObserver((entries) => { entries.forEach(entry => { if (entry.isIntersecting) entry.target.classList.add('active'); }); }, { threshold: 0.15, rootMargin: '0px 0px -50px 0px' });
    revealElements.forEach(el => revealObserver.observe(el));
    
    // Counter Animation
    const counters = document.querySelectorAll('.counter-number, .hero-stat .number');
    const counterObserver = new IntersectionObserver((entries) => { entries.forEach(entry => { if (entry.isIntersecting && !entry.target.classList.contains('animated')) { entry.target.classList.add('animated'); const target = parseInt(entry.target.dataset.target); let current = 0; const step = Math.ceil(target / 60); const updateCounter = () => { current += step; if (current >= target) entry.target.innerText = target.toLocaleString(); else { entry.target.innerText = Math.floor(current).toLocaleString() + '+'; requestAnimationFrame(updateCounter); } }; requestAnimationFrame(updateCounter); } }); }, { threshold: 0.5 });
    counters.forEach(counter => counterObserver.observe(counter));
    
    // Scroll Progress
    const scrollIndicator = document.getElementById('scrollProgress');
    if (scrollIndicator) { window.addEventListener('scroll', () => { const winScroll = document.documentElement.scrollTop; const height = document.documentElement.scrollHeight - document.documentElement.clientHeight; const scrolled = (winScroll / height) * 100; scrollIndicator.style.width = scrolled + '%'; }); }
})();
</script>
@endpush

@endsection