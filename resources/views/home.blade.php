@extends('layouts.app')

@section('content')

@include('partials.component.announcement')
@include('partials.component.navbar')

<style>
    /* Smooth Scroll Behavior */
    html {
        scroll-behavior: smooth;
        scroll-padding-top: 80px;
    }

    /* Reveal Animation */
    .reveal {
        opacity: 0;
        transform: translateY(40px);
        transition: all 0.8s cubic-bezier(0.2, 0.9, 0.4, 1.1);
    }

    .reveal.active {
        opacity: 1;
        transform: translateY(0);
    }

    .reveal-delay-1 { transition-delay: 0.1s; }
    .reveal-delay-2 { transition-delay: 0.2s; }
    .reveal-delay-3 { transition-delay: 0.3s; }
    .reveal-delay-4 { transition-delay: 0.4s; }

    /* Hero Section */
    .hero {
        min-height: 90vh;
        display: flex;
        align-items: center;
        padding: 100px 0 80px;
        position: relative;
        overflow: hidden;
    }

    .hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at 20% 50%, rgba(59,130,255,0.08) 0%, transparent 50%);
        pointer-events: none;
    }

    .hero-content {
        max-width: 800px;
        position: relative;
        z-index: 2;
    }

    .hero-tag {
        display: inline-block;
        background: rgba(59, 130, 255, 0.1);
        color: var(--accent);
        padding: 8px 16px;
        border-radius: 40px;
        font-size: 0.8rem;
        font-weight: 600;
        margin-bottom: 28px;
        letter-spacing: 0.5px;
    }

    .hero h1 {
        font-size: clamp(2.5rem, 7vw, 5rem);
        font-weight: 800;
        line-height: 1.1;
        margin-bottom: 24px;
        font-family: var(--font-display);
        letter-spacing: -2px;
    }

    .hero .highlight {
        color: var(--accent);
        position: relative;
        display: inline-block;
    }

    .hero .highlight::after {
        content: '';
        position: absolute;
        bottom: 5px;
        left: 0;
        width: 100%;
        height: 4px;
        background: var(--accent);
        opacity: 0.3;
        border-radius: 2px;
    }

    .hero p {
        font-size: 1.1rem;
        color: var(--text-secondary);
        margin-bottom: 32px;
        max-width: 560px;
        line-height: 1.7;
    }

    .hero-ctas {
        display: flex;
        gap: 20px;
        margin-bottom: 60px;
        flex-wrap: wrap;
    }

    .hero-media {
        border-top: 1px solid var(--border);
        padding-top: 32px;
        display: flex;
        align-items: center;
        gap: 32px;
        flex-wrap: wrap;
    }

    .hero-media span {
        color: var(--text-secondary);
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .media-logos {
        display: flex;
        gap: 32px;
        flex-wrap: wrap;
    }

    .media-logos span {
        font-size: 0.85rem;
        font-weight: 600;
        opacity: 0.5;
        transition: opacity 0.3s;
        cursor: default;
    }

    .media-logos span:hover {
        opacity: 1;
    }

    /* Section Common */
    section {
        padding: 100px 0;
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
        font-size: clamp(2rem, 5vw, 3.2rem);
        font-weight: 800;
        margin-bottom: 16px;
        font-family: var(--font-display);
        letter-spacing: -1px;
    }

    .section-desc {
        color: var(--text-secondary);
        font-size: 1.05rem;
        max-width: 600px;
        line-height: 1.7;
        margin-bottom: 48px;
    }

    /* Why Choose Us */
    .why-us {
        background: var(--surface);
        position: relative;
    }

    .comparison-table {
        width: 100%;
        border-collapse: collapse;
        background: var(--bg);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    }

    .comparison-table th,
    .comparison-table td {
        padding: 20px 24px;
        text-align: left;
        border-bottom: 1px solid var(--border);
    }

    .comparison-table th {
        background: var(--surface-card);
        font-weight: 700;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .comparison-table tr:last-child td {
        border-bottom: none;
    }

    .comparison-table tr:hover td {
        background: rgba(59, 130, 255, 0.02);
    }

    .check {
        color: var(--accent);
        font-weight: 600;
    }

    .cross {
        color: #ef4444;
    }

    /* Three Pillars */
    .pillars-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
        margin-top: 48px;
    }

    .pillar-card {
        background: var(--surface-card);
        border: 1px solid var(--border);
        border-radius: 24px;
        padding: 40px 32px;
        text-align: center;
        transition: all 0.4s cubic-bezier(0.2, 0.9, 0.4, 1.1);
        position: relative;
        overflow: hidden;
    }

    .pillar-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--accent), transparent);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.4s ease;
    }

    .pillar-card:hover {
        transform: translateY(-6px);
        border-color: var(--accent);
    }

    .pillar-card:hover::before {
        transform: scaleX(1);
    }

    .pillar-icon {
        font-size: 2.5rem;
        margin-bottom: 24px;
        color: var(--accent);
    }

    .pillar-card h3 {
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 16px;
        font-family: var(--font-display);
    }

    .pillar-card p {
        color: var(--text-secondary);
        line-height: 1.7;
        font-size: 0.9rem;
    }

    /* Client Logos Carousel */
    .client-logos {
        padding: 50px 0;
        background: var(--surface);
        overflow: hidden;
        border-top: 1px solid var(--border);
        border-bottom: 1px solid var(--border);
    }

    .logo-track {
        display: flex;
        gap: 48px;
        animation: scrollLogos 25s linear infinite;
        width: max-content;
    }

    .logo-track span {
        color: var(--text-secondary);
        font-size: 1rem;
        font-weight: 600;
        opacity: 0.6;
        transition: opacity 0.3s;
        white-space: nowrap;
    }

    .logo-track span:hover {
        opacity: 1;
        color: var(--accent);
    }

    @keyframes scrollLogos {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }

    /* Portfolio Section */
    .portfolio-filters {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin-bottom: 40px;
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

    .portfolio-grid {
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
    }

    .portfolio-thumb {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.5s ease;
    }

    .portfolio-item:hover .portfolio-thumb {
        transform: scale(1.05);
    }

    .overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.9) 0%, transparent 100%);
        padding: 24px;
        transform: translateY(100%);
        transition: transform 0.4s ease;
    }

    .portfolio-item:hover .overlay {
        transform: translateY(0);
    }

    .overlay h4 {
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 4px;
        color: #fff;
    }

    .overlay span {
        font-size: 0.8rem;
        color: var(--accent);
    }

    /* Services Section */
    .services-section {
        background: var(--surface);
    }

    .services-slider {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 24px;
        margin-top: 48px;
    }

    .service-card {
        background: var(--bg);
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 28px;
        transition: all 0.4s ease;
        position: relative;
    }

    .service-card:hover {
        transform: translateY(-4px);
        border-color: var(--accent);
    }

    .service-badge {
        position: absolute;
        top: 16px;
        right: 16px;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 700;
    }

    .badge-full { background: var(--accent); color: #000; }
    .badge-top { background: #f59e0b; color: #000; }
    .badge-best { background: #10b981; color: #fff; }
    .badge-trending { background: var(--accent); color: #000; }

    .service-icon {
        font-size: 2.2rem;
        margin-bottom: 20px;
        color: var(--accent);
    }

    .service-card h3 {
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 12px;
    }

    .service-card p {
        color: var(--text-secondary);
        font-size: 0.85rem;
        line-height: 1.6;
    }

    /* About Section */
    .about-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 60px;
        align-items: center;
        margin-top: 48px;
    }

    .about-stats {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 24px;
        margin-top: 48px;
    }

    .stat-item {
        background: var(--surface-card);
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 24px;
        text-align: center;
        transition: all 0.3s;
    }

    .stat-item:hover {
        border-color: var(--accent);
        transform: translateY(-2px);
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--accent);
        font-family: var(--font-display);
        margin-bottom: 8px;
    }

    .stat-label {
        font-size: 0.8rem;
        color: var(--text-secondary);
    }

    .about-visual {
        background: linear-gradient(135deg, var(--surface-card), var(--surface));
        border-radius: 24px;
        min-height: 400px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid var(--border);
    }

    /* Testimonials */
    .testimonials {
        background: var(--surface);
    }

    .testimonial-carousel {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 24px;
        margin-top: 48px;
    }

    .testimonial-card {
        background: var(--bg);
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 28px;
        transition: all 0.3s;
    }

    .testimonial-card:hover {
        transform: translateY(-4px);
        border-color: var(--accent);
    }

    .testimonial-quote {
        font-size: 0.9rem;
        line-height: 1.7;
        margin-bottom: 24px;
        color: var(--text-secondary);
        font-style: italic;
    }

    .testimonial-author {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .testimonial-avatar {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, var(--accent), var(--accent-hover));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        color: #fff;
    }

    .author-name {
        font-weight: 700;
        margin-bottom: 4px;
    }

    .author-role {
        font-size: 0.75rem;
        color: var(--text-secondary);
    }

    /* CTA Bottom */
    .cta-bottom {
        text-align: center;
        padding: 120px 0;
        position: relative;
        background: linear-gradient(135deg, var(--surface), var(--bg));
    }

    .cta-bottom .section-title {
        max-width: 700px;
        margin-left: auto;
        margin-right: auto;
    }

    .cta-bottom .section-desc {
        margin-left: auto;
        margin-right: auto;
        text-align: center;
    }

    .cta-bottom .hero-ctas {
        justify-content: center;
    }

    /* Media Coverage */
    .media-coverage {
        text-align: center;
        padding: 60px 0;
        border-top: 1px solid var(--border);
        border-bottom: 1px solid var(--border);
    }

    .media-coverage p {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: var(--text-secondary);
        margin-bottom: 24px;
    }

    .media-row {
        display: flex;
        justify-content: center;
        gap: 48px;
        flex-wrap: wrap;
    }

    .media-row span {
        font-family: var(--font-display);
        font-weight: 700;
        font-size: 1rem;
        opacity: 0.5;
        transition: opacity 0.3s;
        cursor: default;
    }

    .media-row span:hover {
        opacity: 1;
    }

    /* Buttons */
    .btn-primary {
        background: linear-gradient(135deg, var(--accent), var(--accent-hover));
        color: #fff;
        padding: 12px 28px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s;
        border: none;
        cursor: pointer;
        text-decoration: none;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(59, 130, 255, 0.35);
    }

    .btn-outline {
        background: transparent;
        border: 1px solid var(--border);
        color: var(--text);
        padding: 12px 28px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s;
        text-decoration: none;
    }

    .btn-outline:hover {
        border-color: var(--accent);
        color: var(--accent);
    }

    /* Responsive */
    @media (max-width: 1024px) {
        section {
            padding: 80px 0;
        }
        .pillars-grid {
            gap: 20px;
        }
        .about-grid {
            gap: 40px;
        }
    }

    @media (max-width: 768px) {
        section {
            padding: 60px 0;
        }
        .hero {
            padding: 80px 0 60px;
        }
        .hero-ctas {
            gap: 12px;
        }
        .pillars-grid {
            grid-template-columns: 1fr;
        }
        .about-grid {
            grid-template-columns: 1fr;
        }
        .portfolio-grid {
            grid-template-columns: 1fr;
        }
        .services-slider {
            grid-template-columns: 1fr;
        }
        .testimonial-carousel {
            grid-template-columns: 1fr;
        }
        .comparison-table th,
        .comparison-table td {
            padding: 12px 16px;
            font-size: 0.85rem;
        }
        .about-stats {
            gap: 16px;
        }
        .stat-number {
            font-size: 2rem;
        }
    }
</style>

{{-- Hero Section --}}
<section class="hero" id="hero">
    <div class="container">
        <div class="hero-content reveal">
            <span class="hero-tag"><i class="fas fa-rocket" style="margin-right: 6px;"></i> #1 Digital Marketing Agency Medan</span>
            <h1>Digital Marketing Agency <span class="highlight">diver.ent</span></h1>
            <p>Kami membantu bisnis Anda tumbuh melalui strategi digital marketing yang terukur, kreatif, dan data-driven. Dari social media hingga website development.</p>
            <div class="hero-ctas">
                <a href="#cta-bottom" class="btn-primary"><i class="fas fa-calendar-check"></i> Konsultasi Gratis →</a>
                <a href="#portfolio" class="btn-outline"><i class="fas fa-folder-open"></i> Lihat Portfolio</a>
            </div>
            <div class="hero-media">
                <span>As Seen On</span>
                <div class="media-logos">
                    <span>KOMPAS</span>
                    <span>detik</span>
                    <span>IDN Times</span>
                    <span>TEMPO</span>
                    <span>Sindonews</span>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Why Choose Us --}}
<section class="why-us" id="why-us">
    <div class="container">
        <div class="reveal">
            <span class="section-tag"><i class="fas fa-chart-line"></i> Why Choose Us</span>
            <h2 class="section-title">Mengapa diver.ent?</h2>
            <p class="section-desc">Perbandingan layanan kami dengan agensi digital marketing lainnya.</p>
        </div>
        <table class="comparison-table reveal">
            <thead>
                <tr>
                    <th>Aspek</th>
                    <th>diver.ent ✦</th>
                    <th>Agensi Lain</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Kelengkapan Layanan (12+ layanan)</td>
                    <td><i class="fas fa-check-circle check"></i> Full-service</td>
                    <td><i class="fas fa-times-circle cross"></i> Terbatas</td>
                </tr>
                <tr>
                    <td>Tim Dedicated & Responsif</td>
                    <td><i class="fas fa-check-circle check"></i> Tim khusus per klien</td>
                    <td><i class="fas fa-times-circle cross"></i> Shared resource</td>
                </tr>
                <tr>
                    <td>Komunikasi & Reporting Rutin</td>
                    <td><i class="fas fa-check-circle check"></i> Weekly report & meeting</td>
                    <td><i class="fas fa-times-circle cross"></i> Monthly / on-request</td>
                </tr>
                <tr>
                    <td>Track Record & Sertifikasi</td>
                    <td><i class="fas fa-check-circle check"></i> Google & Meta Certified</td>
                    <td><i class="fas fa-times-circle cross"></i> Tidak tersertifikasi</td>
                </tr>
            </tbody>
        </table>
    </div>
</section>

{{-- Three Pillars --}}
<section class="pillars" id="pillars">
    <div class="container">
        <div class="reveal">
            <span class="section-tag"><i class="fas fa-cubes"></i> Metodologi</span>
            <h2 class="section-title">Three Pillars of Success</h2>
            <p class="section-desc">Pendekatan kami yang terbukti menghasilkan pertumbuhan digital bisnis klien.</p>
        </div>
        <div class="pillars-grid">
            <div class="pillar-card reveal reveal-delay-1">
                <div class="pillar-icon"><i class="fas fa-bullseye"></i></div>
                <h3>Customized Strategy</h3>
                <p>Setiap bisnis unik. Kami merancang strategi digital yang disesuaikan dengan goals, audiens, dan industri klien.</p>
            </div>
            <div class="pillar-card reveal reveal-delay-2">
                <div class="pillar-icon"><i class="fas fa-bolt"></i></div>
                <h3>Digital Activation</h3>
                <p>Eksekusi kampanye di semua channel digital — social media, ads, SEO, content — dengan tim berpengalaman.</p>
            </div>
            <div class="pillar-card reveal reveal-delay-3">
                <div class="pillar-icon"><i class="fas fa-chart-bar"></i></div>
                <h3>Data-Driven Optimization</h3>
                <p>Optimasi berkelanjutan berbasis data dan analytics untuk memastikan ROI maksimal dari setiap campaign.</p>
            </div>
        </div>
    </div>
</section>

{{-- Client Logo Carousel --}}
<div class="client-logos">
    <div class="logo-track">
        <span><i class="fas fa-building"></i> PT Telkom Indonesia</span>
        <span><i class="fas fa-university"></i> Bank BCA</span>
        <span><i class="fas fa-store"></i> Tokopedia</span>
        <span><i class="fas fa-car"></i> Grab Indonesia</span>
        <span><i class="fas fa-female"></i> Wardah Beauty</span>
        <span><i class="fas fa-tshirt"></i> Erigo</span>
        <span><i class="fas fa-truck"></i> J&T Express</span>
        <span><i class="fas fa-mug-hot"></i> Kopi Kenangan</span>
        <span><i class="fas fa-graduation-cap"></i> Ruangguru</span>
        <span><i class="fas fa-makeup"></i> Sociolla</span>
        <span><i class="fas fa-car"></i> Astra International</span>
        <span><i class="fas fa-utensils"></i> Indomie</span>
        {{-- Duplicate for infinite scroll --}}
        <span><i class="fas fa-building"></i> PT Telkom Indonesia</span>
        <span><i class="fas fa-university"></i> Bank BCA</span>
        <span><i class="fas fa-store"></i> Tokopedia</span>
        <span><i class="fas fa-car"></i> Grab Indonesia</span>
        <span><i class="fas fa-female"></i> Wardah Beauty</span>
        <span><i class="fas fa-tshirt"></i> Erigo</span>
        <span><i class="fas fa-truck"></i> J&T Express</span>
        <span><i class="fas fa-mug-hot"></i> Kopi Kenangan</span>
        <span><i class="fas fa-graduation-cap"></i> Ruangguru</span>
        <span><i class="fas fa-makeup"></i> Sociolla</span>
        <span><i class="fas fa-car"></i> Astra International</span>
        <span><i class="fas fa-utensils"></i> Indomie</span>
    </div>
</div>

{{-- Portfolio --}}
<section class="portfolio-section" id="portfolio">
    <div class="container">
        <div class="reveal">
            <span class="section-tag"><i class="fas fa-star"></i> Portfolio</span>
            <h2 class="section-title">Our Best Work</h2>
            <p class="section-desc">Lihat hasil karya terbaik kami di berbagai industri.</p>
        </div>
        <div class="portfolio-filters reveal">
            <button class="filter-btn active" data-filter="all"><i class="fas fa-fire"></i> Featured</button>
            <button class="filter-btn" data-filter="social"><i class="fab fa-instagram"></i> Social Media</button>
            <button class="filter-btn" data-filter="web"><i class="fas fa-globe"></i> Website & Apps</button>
            <button class="filter-btn" data-filter="ads"><i class="fas fa-chart-line"></i> Digital Ads</button>
            <button class="filter-btn" data-filter="brand"><i class="fas fa-palette"></i> Visual Branding</button>
            <button class="filter-btn" data-filter="video"><i class="fas fa-video"></i> Photo & Video</button>
        </div>
        <div class="portfolio-grid reveal">
            @php
            $portfolioItems = [
                ['name' => 'Brand Campaign Wardah', 'cat' => 'social', 'label' => 'Social Media', 'icon' => 'fab fa-instagram'],
                ['name' => 'E-Commerce Platform', 'cat' => 'web', 'label' => 'Website', 'icon' => 'fas fa-shopping-cart'],
                ['name' => 'Google Ads Kopi Kenangan', 'cat' => 'ads', 'label' => 'Digital Ads', 'icon' => 'fab fa-google'],
                ['name' => 'Rebranding Erigo', 'cat' => 'brand', 'label' => 'Branding', 'icon' => 'fas fa-pen-fancy'],
                ['name' => 'Product Video Shoot', 'cat' => 'video', 'label' => 'Video Production', 'icon' => 'fas fa-play-circle'],
                ['name' => 'Social Media BCA', 'cat' => 'social', 'label' => 'Social Media', 'icon' => 'fab fa-facebook'],
            ];
            @endphp
            @foreach($portfolioItems as $item)
            <div class="portfolio-item" data-category="{{ $item['cat'] }}">
                <div class="portfolio-thumb" style="background:linear-gradient(135deg, #1a1a2e, #16213e); display: flex; align-items: center; justify-content: center;">
                    <i class="{{ $item['icon'] }}" style="font-size: 48px; opacity: 0.3; color: var(--accent);"></i>
                </div>
                <div class="overlay">
                    <h4>{{ $item['name'] }}</h4>
                    <span><i class="fas fa-tag"></i> {{ $item['label'] }}</span>
                </div>
            </div>
            @endforeach
        </div>
        <div style="text-align:center;margin-top:40px;" class="reveal">
            <a href="{{ route('portfolio') }}" class="btn-outline"><i class="fas fa-arrow-right"></i> See All Portfolio →</a>
        </div>
    </div>
</section>

{{-- Services --}}
<section class="services-section" id="services">
    <div class="container">
        <div class="reveal">
            <span class="section-tag"><i class="fas fa-cogs"></i> Services</span>
            <h2 class="section-title">Layanan Kami</h2>
            <p class="section-desc">12 layanan digital marketing komprehensif untuk pertumbuhan bisnis Anda.</p>
        </div>
        <div class="services-slider reveal">
            @php
            $services = [
                ['icon'=>'fas fa-sync-alt','name'=>'360° Marketing','desc'=>'Solusi marketing menyeluruh dari strategi hingga eksekusi.','badge'=>'Full Solution','bclass'=>'badge-full'],
                ['icon'=>'fab fa-instagram','name'=>'Social Media','desc'=>'Manajemen akun sosial media dengan konten kreatif & engaging.','badge'=>'Top Choice','bclass'=>'badge-top'],
                ['icon'=>'fas fa-globe','name'=>'Website Dev','desc'=>'Pengembangan website modern, responsif, dan SEO-friendly.','badge'=>'Best','bclass'=>'badge-best'],
                ['icon'=>'fas fa-chart-line','name'=>'Digital Ads','desc'=>'Kampanye iklan digital di Google, Meta, TikTok & platform lain.','badge'=>'Trending','bclass'=>'badge-trending'],
                ['icon'=>'fas fa-palette','name'=>'Branding & Design','desc'=>'Identitas visual brand yang konsisten dan memorable.','badge'=>'','bclass'=>''],
                ['icon'=>'fas fa-users','name'=>'KOL & Affiliate','desc'=>'Kolaborasi dengan influencer & KOL untuk memperluas reach.','badge'=>'Trending','bclass'=>'badge-trending'],
                ['icon'=>'fas fa-camera','name'=>'Foto Produk','desc'=>'Fotografi produk profesional untuk e-commerce & katalog.','badge'=>'','bclass'=>''],
                ['icon'=>'fas fa-video','name'=>'Video Production','desc'=>'Produksi video komersial, company profile, & konten sosmed.','badge'=>'Best','bclass'=>'badge-best'],
                ['icon'=>'fas fa-pen-nib','name'=>'Logo Design','desc'=>'Desain logo yang unik dan merepresentasikan brand Anda.','badge'=>'','bclass'=>''],
                ['icon'=>'fas fa-camera-retro','name'=>'Commercial Photo','desc'=>'Fotografi komersial untuk branding & marketing materials.','badge'=>'','bclass'=>''],
                ['icon'=>'fas fa-mobile-alt','name'=>'Apps Dev','desc'=>'Pengembangan aplikasi mobile iOS & Android.','badge'=>'Best','bclass'=>'badge-best'],
                ['icon'=>'fas fa-search','name'=>'SEO','desc'=>'Optimasi mesin pencari untuk meningkatkan visibilitas organik.','badge'=>'Top Choice','bclass'=>'badge-top'],
            ];
            @endphp
            @foreach($services as $svc)
            <div class="service-card">
                @if($svc['badge'])
                <span class="service-badge {{ $svc['bclass'] }}">{{ $svc['badge'] }}</span>
                @endif
                <div class="service-icon"><i class="{{ $svc['icon'] }}"></i></div>
                <h3>{{ $svc['name'] }}</h3>
                <p>{{ $svc['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- About --}}
<section class="about" id="about">
    <div class="container">
        <div class="about-grid">
            <div class="reveal">
                <span class="section-tag"><i class="fas fa-info-circle"></i> About Us</span>
                <h2 class="section-title">diver.ent Digital Agency</h2>
                <p class="section-desc">diver.ent adalah digital marketing agency berbasis di Medan yang berkomitmen membantu bisnis Indonesia tumbuh di era digital melalui strategi yang terukur dan data-driven.</p>
                <div class="about-stats">
                    <div class="stat-item">
                        <div class="stat-number" data-count="80" data-suffix="%">0%</div>
                        <div class="stat-label"><i class="fas fa-chart-line"></i> Klien mengalami peningkatan performa digital</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number" data-count="200" data-suffix="+">0+</div>
                        <div class="stat-label"><i class="fas fa-briefcase"></i> Proyek berhasil diselesaikan</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number" data-count="50" data-suffix="+">0+</div>
                        <div class="stat-label"><i class="fas fa-users"></i> Klien aktif dari berbagai industri</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number" data-count="12" data-suffix="">0</div>
                        <div class="stat-label"><i class="fas fa-cogs"></i> Layanan digital komprehensif</div>
                    </div>
                </div>
            </div>
            <div class="about-visual reveal">
                <i class="fas fa-users" style="font-size: 64px; opacity: 0.15; color: var(--accent);"></i>
                <span style="margin-left: 16px; opacity:0.15;">Tim diver.ent</span>
            </div>
        </div>
    </div>
</section>

{{-- Testimonials --}}
<section class="testimonials" id="testimonials">
    <div class="container">
        <div class="reveal">
            <span class="section-tag"><i class="fas fa-comment-dots"></i> Testimonials</span>
            <h2 class="section-title">Kata Mereka</h2>
            <p class="section-desc">Testimoni nyata dari klien yang telah bekerja sama dengan diver.ent.</p>
        </div>
        <div class="testimonial-carousel reveal">
            @php
            $testimonials = [
                ['q'=>'diver.ent berhasil meningkatkan engagement Instagram kami hingga 300% dalam 3 bulan. Tim yang sangat profesional dan responsif!','name'=>'Rina Susanti','role'=>'CMO, PT Maju Bersama','init'=>'RS'],
                ['q'=>'Website yang dibuat diver.ent sangat modern dan hasilnya langsung terasa di conversion rate kami. Highly recommended!','name'=>'Budi Hartono','role'=>'CEO, Kuliner Nusantara','init'=>'BH'],
                ['q'=>'Kampanye Google Ads kami ditangani sangat well oleh tim diver.ent. ROI naik 250% dibanding sebelumnya.','name'=>'Diana Putri','role'=>'Marketing Manager, FashionID','init'=>'DP'],
                ['q'=>'Rebranding yang dilakukan diver.ent benar-benar mengubah persepsi brand kami di mata konsumen. Amazing work!','name'=>'Ahmad Fauzi','role'=>'Founder, TechStartup.id','init'=>'AF'],
                ['q'=>'Konten video produksi diver.ent sangat berkualitas tinggi. Setiap detail diperhatikan dengan baik.','name'=>'Sari Dewi','role'=>'Brand Manager, BeautyLokal','init'=>'SD'],
                ['q'=>'Setelah SEO oleh diver.ent, traffic organik website kami meningkat 400%. Investasi yang sangat worth it.','name'=>'Hendra Wijaya','role'=>'Director, PropertyPro','init'=>'HW'],
            ];
            @endphp
            @foreach($testimonials as $t)
            <div class="testimonial-card">
                <div class="testimonial-quote"><i class="fas fa-quote-left" style="color: var(--accent); margin-right: 8px; opacity: 0.5;"></i> "{{ $t['q'] }}"</div>
                <div class="testimonial-author">
                    <div class="testimonial-avatar">{{ $t['init'] }}</div>
                    <div>
                        <div class="author-name">{{ $t['name'] }}</div>
                        <div class="author-role"><i class="fas fa-briefcase"></i> {{ $t['role'] }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- CTA Bottom --}}
<section class="cta-bottom" id="cta-bottom">
    <div class="container reveal">
        <span class="section-tag"><i class="fas fa-play-circle"></i> Start Now</span>
        <h2 class="section-title">Don't Get Left Behind</h2>
        <p class="section-desc">Kompetitor Anda sudah memulai transformasi digital. Saatnya bisnis Anda tampil lebih baik di dunia digital.</p>
        <div class="hero-ctas">
            <a href="#portfolio" class="btn-primary"><i class="fas fa-chart-line"></i> Case Studies →</a>
            <a href="https://wa.me/6281234567890?text=Halo%20diver.ent%2C%20saya%20ingin%20konsultasi" target="_blank" class="btn-outline"><i class="fab fa-whatsapp"></i> Contact Us</a>
        </div>
    </div>
</section>

{{-- Media Coverage --}}
<div class="media-coverage">
    <p><i class="fas fa-newspaper"></i> As Seen On</p>
    <div class="media-row">
        <span>KOMPAS</span>
        <span>detik</span>
        <span>IDN Times</span>
        <span>TEMPO</span>
        <span>Sindonews</span>
    </div>
</div>

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

    // Reveal animation on scroll
    const reveals = document.querySelectorAll('.reveal');
    
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
    
    // Counter animation for about stats
    const counters = document.querySelectorAll('.stat-number');
    const speed = 200;
    let animated = false;

    const animateCounters = () => {
        if (animated) return;
        animated = true;
        counters.forEach(counter => {
            const updateCount = () => {
                const target = parseInt(counter.getAttribute('data-count'));
                const suffix = counter.getAttribute('data-suffix') || '';
                const count = parseInt(counter.innerText);
                const increment = Math.ceil(target / speed);
                
                if (count < target) {
                    counter.innerText = count + increment + suffix;
                    setTimeout(updateCount, 20);
                } else {
                    counter.innerText = target + suffix;
                }
            };
            updateCount();
        });
    };

    // Trigger counter when about section is visible
    const aboutSection = document.querySelector('.about');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounters();
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.3 });
    
    if (aboutSection) observer.observe(aboutSection);
</script>

@endsection