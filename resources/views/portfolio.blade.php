@extends('layouts.app')

@section('content')

@include('partials.component.navbar')

<style>
    .portfolio-hero {
        padding: 120px 0 60px;
        background: linear-gradient(135deg, var(--bg) 0%, var(--surface) 100%);
    }
    
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--text-secondary);
        text-decoration: none;
        margin-bottom: 24px;
        transition: color 0.3s;
    }
    
    .back-link:hover {
        color: var(--accent);
    }
    
    .section-tag {
        display: inline-block;
        background: rgba(59, 130, 255, 0.1);
        color: var(--accent);
        padding: 6px 14px;
        border-radius: 40px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 20px;
    }
    
    .section-title {
        font-family: var(--font-display);
        font-size: clamp(2.5rem, 5vw, 4rem);
        font-weight: 800;
        letter-spacing: -1px;
        margin-bottom: 16px;
    }
    
    .section-desc {
        color: var(--text-secondary);
        font-size: 1.05rem;
        max-width: 600px;
        line-height: 1.7;
    }
    
    .portfolio-filters {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin-bottom: 48px;
        padding: 20px 0;
    }
    
    .filter-btn {
        background: transparent;
        border: 1px solid var(--border);
        padding: 8px 24px;
        border-radius: 40px;
        color: var(--text-secondary);
        cursor: pointer;
        transition: all 0.3s;
        font-weight: 500;
        font-size: 0.85rem;
    }
    
    .filter-btn.active,
    .filter-btn:hover {
        background: var(--accent);
        color: #000;
        border-color: var(--accent);
    }
    
    .portfolio-grid-full {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 24px;
    }
    
    .portfolio-item {
        position: relative;
        border-radius: 20px;
        overflow: hidden;
        cursor: pointer;
        aspect-ratio: 4/3;
        background: var(--surface);
        border: 1px solid var(--border);
        transition: all 0.3s;
    }
    
    .portfolio-item:hover {
        transform: translateY(-4px);
        border-color: var(--accent);
    }
    
    .portfolio-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .portfolio-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
    }
    
    .portfolio-item:hover .portfolio-image {
        transform: scale(1.05);
    }
    
    .portfolio-info {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.9) 0%, transparent 100%);
        padding: 20px;
    }
    
    .portfolio-info span {
        font-size: 0.7rem;
        color: var(--accent);
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .portfolio-info h4 {
        font-size: 1rem;
        font-weight: 600;
        color: #fff;
        margin-top: 4px;
    }
    
    .detail-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 24px;
        margin-top: 48px;
    }
    
    .detail-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.3s;
    }
    
    .detail-card:hover {
        transform: translateY(-4px);
        border-color: var(--accent);
    }
    
    .detail-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
    
    .detail-placeholder {
        width: 100%;
        height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
    }
    
    .detail-label {
        display: inline-block;
        padding: 4px 12px;
        background: var(--accent);
        color: #000;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 600;
        margin-bottom: 12px;
    }
    
    .detail-content {
        padding: 24px;
    }
    
    .detail-content h3 {
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 12px;
    }
    
    .detail-content p {
        color: var(--text-secondary);
        font-size: 0.85rem;
        line-height: 1.6;
        margin-bottom: 16px;
    }
    
    .detail-tags {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }
    
    .detail-tags span {
        padding: 4px 12px;
        background: var(--surface-alt);
        border-radius: 20px;
        font-size: 0.7rem;
        color: var(--text-secondary);
    }
    
    .results-stats {
        display: flex;
        gap: 16px;
        margin-top: 16px;
        padding-top: 16px;
        border-top: 1px solid var(--border);
    }
    
    .result-stat {
        text-align: center;
    }
    
    .result-stat .value {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--accent);
    }
    
    .result-stat .label {
        font-size: 0.7rem;
        color: var(--text-secondary);
    }
    
    .cta-bottom {
        text-align: center;
        padding: 100px 0;
        background: linear-gradient(135deg, var(--surface), var(--bg));
    }
    
    .empty-portfolio {
        text-align: center;
        padding: 80px 20px;
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 20px;
    }
    
    .empty-portfolio i {
        font-size: 4rem;
        margin-bottom: 20px;
        opacity: 0.5;
    }
    
    .reveal {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.6s ease;
    }
    
    .reveal.active {
        opacity: 1;
        transform: translateY(0);
    }
    
    @media (max-width: 768px) {
        .portfolio-hero {
            padding: 100px 0 40px;
        }
        .portfolio-grid-full {
            grid-template-columns: 1fr;
        }
        .detail-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

{{-- Portfolio Hero --}}
<section class="portfolio-hero">
    <div class="container">
        <div class="reveal">
            <a href="/" class="back-link">
                <i class="fas fa-arrow-left"></i> Kembali ke Home
            </a>
            <span class="section-tag">
                <i class="fas fa-star"></i> Portfolio
            </span>
            <h1 class="section-title">Our Work</h1>
            <p class="section-desc">Koleksi lengkap hasil karya terbaik kami di berbagai industri dan platform digital.</p>
        </div>
    </div>
</section>



{{-- Portfolio Filter & Grid --}}
<section class="portfolio-full" style="padding-top:0;">
    <div class="container">
        <div class="portfolio-filters reveal">
            <button class="filter-btn active" data-filter="all">Semua</button>
            <button class="filter-btn" data-filter="social">Social Media</button>
            <button class="filter-btn" data-filter="web">Website & Apps</button>
            <button class="filter-btn" data-filter="ads">Digital Ads</button>
            <button class="filter-btn" data-filter="brand">Visual Branding</button>
            <button class="filter-btn" data-filter="video">Photo & Video</button>
            <button class="filter-btn" data-filter="seo">SEO</button>
        </div>

        @if($portfolios->count() > 0)
        <div class="portfolio-grid portfolio-grid-full reveal" id="portfolioGrid">
            @foreach($portfolios as $item)
            <div class="portfolio-item" data-category="{{ $item->category }}">
                @if($item->image && file_exists(public_path('storage/' . $item->image)))
                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="portfolio-image">
                @else
                    <div class="portfolio-placeholder" style="background: linear-gradient(135deg, {{ $item->getCategoryColor() }}, #0d0d1a);">
                        <i class="{{ $item->getCategoryIcon() }}" style="font-size: 48px; opacity: 0.3; color: white;"></i>
                    </div>
                @endif
                <div class="portfolio-info">
                    <span>{{ $item->label }}</span>
                    <h4>{{ $item->title }}</h4>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Portfolio Detail Cards --}}
    
        @else
        <div class="empty-portfolio reveal">
            <i class="fas fa-image"></i>
            <h3>Belum Ada Portfolio</h3>
            <p>Portfolio akan segera ditambahkan. Stay tuned!</p>
        </div>
        @endif
    </div>
</section>

{{-- CTA --}}
<section class="cta-bottom" id="cta-bottom">
    <div class="container reveal">
        <span class="section-tag">
            <i class="fas fa-rocket"></i> Tertarik?
        </span>
        <h2 class="section-title">Ingin Hasil Seperti Ini?</h2>
        <p class="section-desc">Konsultasikan kebutuhan digital marketing bisnis Anda dengan tim diver.ent sekarang.</p>
        <div class="hero-ctas">
            <a href="{{ route('client.create-project') }}" class="btn-primary">
                <i class="fas fa-handshake"></i> Ayo Kerjasama →
            </a>
            <a href="/" class="btn-outline">
                <i class="fas fa-home"></i> Kembali ke Home
            </a>
        </div>
    </div>
</section>

@include('partials.component.footer')
@include('partials.component.modals')

<script>
    // Portfolio filter functionality
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            const filter = this.dataset.filter;
            document.querySelectorAll('.portfolio-item').forEach(item => {
                if (filter === 'all' || item.dataset.category === filter) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
    
    // Reveal animation
    
    function reveal() {
        reveals.forEach(el => {
            const windowHeight = window.innerHeight;
            const revealTop = el.getBoundingClientRect().top;
            const revealPoint = 120;
            if (revealTop < windowHeight - revealPoint) {
                el.classList.add('active');
            }
        });
    }
    
    window.addEventListener('scroll', reveal);
    window.addEventListener('load', reveal);
</script>

@endsection