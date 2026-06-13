@extends('layouts.app')

@section('content')

@include('partials.component.announcement')
@include('partials.component.navbar')

<style>
    /* ========== SMOOTH SCROLL ========== */
    html {
        scroll-behavior: smooth;
        scroll-padding-top: 80px;
    }

    /* ========== REVEAL ANIMATION (HALUS) ========== */
    .reveal {
        opacity: 0;
        transform: translateY(24px);
        transition: opacity 0.8s cubic-bezier(0.2, 0.9, 0.4, 1.1), transform 0.8s cubic-bezier(0.2, 0.9, 0.4, 1.1);
    }

    .reveal.active {
        opacity: 1;
        transform: translateY(0);
    }

    .reveal-delay-1 { transition-delay: 0.1s; }
    .reveal-delay-2 { transition-delay: 0.2s; }
    .reveal-delay-3 { transition-delay: 0.3s; }

    /* ========== HERO SECTION ========== */
    .hero {
        min-height: 90vh;
        display: flex;
        align-items: center;
        padding: 120px 0 80px;
        position: relative;
        overflow: hidden;
    }

    /* Light mode background */
    [data-theme="light"] .hero {
        background: linear-gradient(135deg, #FBF9FB 0%, #F0F4F8 100%);
    }

    /* Dark mode background */
    [data-theme="dark"] .hero {
        background: linear-gradient(135deg, #07111F 0%, #0A192F 100%);
    }

    .hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(ellipse at 30% 50%, var(--accent) 0%, transparent 70%);
        opacity: 0.06;
        pointer-events: none;
    }

    .hero-content {
        max-width: 720px;
        position: relative;
        z-index: 2;
    }

    .hero-tag {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 16px;
        border-radius: 40px;
        font-size: 0.7rem;
        font-weight: 600;
        margin-bottom: 28px;
        letter-spacing: 0.3px;
    }

    [data-theme="light"] .hero-tag {
        background: rgba(0, 210, 255, 0.1);
        color: #00A3CC;
        border: 0.5px solid rgba(0, 210, 255, 0.15);
    }

    [data-theme="dark"] .hero-tag {
        background: rgba(0, 210, 255, 0.12);
        color: var(--accent);
    }

    .hero h1 {
        font-size: clamp(2.5rem, 7vw, 4.8rem);
        font-weight: 700;
        line-height: 1.15;
        margin-bottom: 20px;
        font-family: var(--font-display);
        letter-spacing: -1px;
    }

    [data-theme="light"] .hero h1 {
        color: #0A192F;
    }

    [data-theme="dark"] .hero h1 {
        color: var(--text);
    }

    .hero .highlight {
        position: relative;
        display: inline-block;
    }

    [data-theme="light"] .hero .highlight {
        background: linear-gradient(135deg, #00D2FF, #0099CC);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    [data-theme="dark"] .hero .highlight {
        color: var(--accent);
    }

    .hero p {
        font-size: 1.05rem;
        margin-bottom: 36px;
        max-width: 540px;
        line-height: 1.65;
    }

    [data-theme="light"] .hero p {
        color: #4a5568;
    }

    [data-theme="dark"] .hero p {
        color: var(--text-secondary);
    }

    .hero-ctas {
        display: flex;
        gap: 16px;
        margin-bottom: 48px;
        flex-wrap: wrap;
    }

    .hero-media {
        padding-top: 32px;
        display: flex;
        align-items: center;
        gap: 32px;
        flex-wrap: wrap;
    }

    [data-theme="light"] .hero-media {
        border-top: 1px solid rgba(0, 0, 0, 0.08);
    }

    [data-theme="dark"] .hero-media {
        border-top: 1px solid var(--border);
    }

    .hero-media span:first-child {
        font-size: 0.7rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 1.5px;
    }

    [data-theme="light"] .hero-media span:first-child {
        color: #718096;
    }

    [data-theme="dark"] .hero-media span:first-child {
        color: var(--text-secondary);
    }

    .media-logos {
        display: flex;
        gap: 32px;
        flex-wrap: wrap;
    }

    .media-logos span {
        font-size: 0.8rem;
        font-weight: 500;
        letter-spacing: 0.5px;
    }

    [data-theme="light"] .media-logos span {
        opacity: 0.5;
        color: #4a5568;
    }

    [data-theme="dark"] .media-logos span {
        opacity: 0.4;
        color: #A7B3C2;
    }

    /* ========== SECTION UMUM ========== */
    section {
        padding: 90px 0;
    }

    .section-tag {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(59, 130, 255, 0.1);
        color: var(--accent);
        padding: 5px 14px;
        border-radius: 40px;
        font-size: 0.65rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 20px;
    }

    .section-title {
        font-size: clamp(1.8rem, 4vw, 2.8rem);
        font-weight: 700;
        margin-bottom: 16px;
        font-family: var(--font-display);
        letter-spacing: -0.4px;
        line-height: 1.25;
    }

    .section-desc {
        color: var(--text-secondary);
        font-size: 1rem;
        max-width: 600px;
        line-height: 1.65;
        margin-bottom: 48px;
    }

    /* ========== WHY CHOOSE US (TABEL) ========== */
    .why-us {
        background: var(--surface);
    }

    .comparison-table {
        width: 100%;
        border-collapse: collapse;
        background: var(--bg);
        border-radius: 24px;
        overflow: hidden;
    }

    .comparison-table th,
    .comparison-table td {
        padding: 20px 28px;
        text-align: left;
        border-bottom: 1px solid var(--border);
    }

    .comparison-table th {
        background: rgba(59, 130, 255, 0.03);
        font-weight: 600;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.8px;
    }

    .comparison-table tr:last-child td {
        border-bottom: none;
    }

    .comparison-table td:first-child,
    .comparison-table th:first-child {
        font-weight: 600;
    }

    .check {
        color: var(--accent);
        margin-right: 8px;
    }

    .cross {
        color: #ef4444;
        margin-right: 8px;
    }

    /* ========== THREE PILLARS ========== */
    .pillars-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 32px;
        margin-top: 24px;
    }

    .pillar-card {
        background: var(--surface-card);
        border: 1px solid var(--border);
        border-radius: 28px;
        padding: 40px 28px;
        text-align: center;
        transition: all 0.35s ease;
    }

    .pillar-card:hover {
        transform: translateY(-6px);
        border-color: var(--accent);
    }

    .pillar-icon {
        font-size: 2.2rem;
        margin-bottom: 24px;
        color: var(--accent);
    }

    .pillar-card h3 {
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 14px;
        font-family: var(--font-display);
    }

    .pillar-card p {
        color: var(--text-secondary);
        line-height: 1.65;
        font-size: 0.85rem;
    }

    /* ========== PORTFOLIO ========== */
    .portfolio-filters {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin-bottom: 44px;
    }

    .filter-btn {
        background: transparent;
        border: 1px solid var(--border);
        padding: 8px 22px;
        border-radius: 50px;
        color: var(--text-secondary);
        cursor: pointer;
        transition: all 0.25s ease;
        font-weight: 500;
        font-size: 0.75rem;
    }

    .filter-btn.active,
    .filter-btn:hover {
        background: var(--accent);
        color: #000;
        border-color: var(--accent);
    }

    .portfolio-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
        gap: 28px;
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
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .portfolio-item:hover .portfolio-thumb {
        transform: scale(1.02);
    }

    .overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.85) 0%, transparent 100%);
        padding: 28px 24px;
        transform: translateY(100%);
        transition: transform 0.35s cubic-bezier(0.2, 0.9, 0.4, 1.1);
    }

    .portfolio-item:hover .overlay {
        transform: translateY(0);
    }

    .overlay h4 {
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 6px;
        color: #fff;
    }

    .overlay span {
        font-size: 0.7rem;
        color: var(--accent);
    }

    /* ========== SERVICES SECTION ========== */
    .services-section {
        background: var(--surface);
    }

    .services-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 28px;
        margin-top: 24px;
    }

    .service-card {
        background: var(--bg);
        border: 1px solid var(--border);
        border-radius: 24px;
        padding: 36px 24px;
        transition: all 0.35s ease;
        position: relative;
        text-align: center;
    }

    .service-card:hover {
        transform: translateY(-5px);
        border-color: var(--accent);
    }

    .service-badge {
        position: absolute;
        top: 16px;
        right: 16px;
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 0.55rem;
        font-weight: 700;
        text-transform: uppercase;
        background: var(--accent);
        color: #000;
    }

    .service-icon {
        font-size: 2.2rem;
        margin-bottom: 22px;
        color: var(--accent);
    }

    .service-card h3 {
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 12px;
        font-family: var(--font-display);
    }

    .service-card p {
        color: var(--text-secondary);
        font-size: 0.8rem;
        line-height: 1.65;
        margin-bottom: 20px;
    }

    .service-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--accent);
        font-size: 0.7rem;
        font-weight: 600;
        text-decoration: none;
        transition: gap 0.25s ease;
    }

    .service-link:hover {
        gap: 12px;
    }

    /* ========== ABOUT SECTION ========== */
    .about-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 64px;
        align-items: center;
        margin-top: 24px;
    }

    .about-stats {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        margin-top: 40px;
    }

    .stat-item {
        background: var(--surface-card);
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 24px 20px;
        text-align: center;
        transition: all 0.25s ease;
    }

    .stat-item:hover {
        border-color: var(--accent);
    }

    .stat-number {
        font-size: 2.2rem;
        font-weight: 800;
        color: var(--accent);
        font-family: var(--font-display);
        margin-bottom: 8px;
        letter-spacing: -0.5px;
    }

    .stat-label {
        font-size: 0.7rem;
        color: var(--text-secondary);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }

    .about-visual {
        background: linear-gradient(135deg, rgba(59,130,255,0.03), rgba(59,130,255,0.01));
        border-radius: 32px;
        min-height: 380px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid var(--border);
        overflow: hidden;
        position: relative;
    }

    .about-visual img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* ========== TESTIMONIALS ========== */
    .testimonials {
        background: var(--surface);
    }

    .testimonial-carousel {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
        gap: 28px;
        margin-top: 24px;
    }

    .testimonial-card {
        background: var(--bg);
        border: 1px solid var(--border);
        border-radius: 24px;
        padding: 32px;
        transition: all 0.3s ease;
    }

    .testimonial-card:hover {
        border-color: var(--accent);
        transform: translateY(-3px);
    }

    .testimonial-quote {
        font-size: 0.85rem;
        line-height: 1.7;
        margin-bottom: 28px;
        color: var(--text-secondary);
        font-style: normal;
    }

    .testimonial-author {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .testimonial-avatar {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, var(--accent), rgba(59,130,255,0.6));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        color: #fff;
        font-size: 0.9rem;
    }

    .author-name {
        font-weight: 700;
        margin-bottom: 4px;
        font-size: 0.9rem;
    }

    .author-role {
        font-size: 0.65rem;
        color: var(--text-secondary);
        display: flex;
        align-items: center;
        gap: 6px;
    }

    /* ========== FAQ SECTION ========== */
    .faq-section {
        background: var(--bg);
    }

    .faq-grid {
        max-width: 760px;
        margin: 0 auto;
    }

    .faq-item {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 20px;
        margin-bottom: 16px;
        overflow: hidden;
        transition: all 0.25s ease;
    }

    .faq-item:hover {
        border-color: var(--accent);
    }

    .faq-question {
        width: 100%;
        padding: 20px 28px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: none;
        border: none;
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--text);
        cursor: pointer;
        transition: color 0.2s;
    }

    .faq-question:hover {
        color: var(--accent);
    }

    .faq-icon {
        font-size: 0.9rem;
        transition: transform 0.3s ease;
    }

    .faq-item.active .faq-icon {
        transform: rotate(180deg);
    }

    .faq-answer {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.4s ease-out;
        padding: 0 28px;
    }

    .faq-item.active .faq-answer {
        max-height: 200px;
        padding: 0 28px 20px 28px;
    }

    .faq-answer p {
        color: var(--text-secondary);
        font-size: 0.85rem;
        line-height: 1.7;
    }

    /* ========== CTA BOTTOM ========== */
    .cta-bottom {
        text-align: center;
        padding: 100px 0;
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
        margin-bottom: 0;
    }

    /* ========== MEDIA COVERAGE ========== */
    .media-coverage {
        text-align: center;
        padding: 48px 0;
        border-top: 1px solid var(--border);
        border-bottom: 1px solid var(--border);
    }

    .media-coverage p {
        font-size: 0.65rem;
        text-transform: uppercase;
        letter-spacing: 2.5px;
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
        font-weight: 600;
        font-size: 0.85rem;
        opacity: 0.4;
        letter-spacing: 0.5px;
    }

    /* ========== BUTTONS ========== */
    .btn-primary {
        background: linear-gradient(135deg, var(--accent), var(--accent-hover));
        color: #fff;
        padding: 12px 30px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s ease;
        text-decoration: none;
        border: none;
        cursor: pointer;
    }

    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(59, 130, 255, 0.25);
    }

    .btn-outline {
        background: transparent;
        border: 1px solid var(--border);
        color: var(--text);
        padding: 12px 30px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s ease;
        text-decoration: none;
        cursor: pointer;
    }

    [data-theme="light"] .btn-outline {
        border-color: #DCE4EA;
        color: #0A192F;
    }

    [data-theme="light"] .btn-outline:hover {
        border-color: #00D2FF;
        color: #00A3CC;
        background: rgba(0, 210, 255, 0.05);
    }

    [data-theme="dark"] .btn-outline:hover {
        border-color: var(--accent);
        color: var(--accent);
        transform: translateY(-2px);
    }

    /* ========== RESPONSIVE ========== */
    @media (max-width: 1024px) {
        section {
            padding: 70px 0;
        }
        .services-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
        }
        .pillars-grid {
            gap: 24px;
        }
        .about-grid {
            gap: 48px;
        }
    }

    @media (max-width: 768px) {
        section {
            padding: 60px 0;
        }
        .hero {
            padding: 100px 0 60px;
        }
        .hero-ctas {
            gap: 12px;
        }
        .services-grid {
            grid-template-columns: 1fr;
        }
        .pillars-grid {
            grid-template-columns: 1fr;
        }
        .about-grid {
            grid-template-columns: 1fr;
            gap: 40px;
        }
        .portfolio-grid {
            grid-template-columns: 1fr;
        }
        .testimonial-carousel {
            grid-template-columns: 1fr;
        }
        .comparison-table th,
        .comparison-table td {
            padding: 14px 18px;
            font-size: 0.75rem;
        }
        .about-stats {
            gap: 16px;
        }
        .stat-number {
            font-size: 1.8rem;
        }
        .faq-question {
            font-size: 0.85rem;
            padding: 16px 22px;
        }
        .faq-item.active .faq-answer {
            padding: 0 22px 16px 22px;
        }
        .media-row {
            gap: 28px;
        }
    }
</style>

{{-- Hero Section --}}
<section class="hero" id="hero">
    <div class="container">
        <div class="hero-content reveal">
            <span class="hero-tag"><i class="fas fa-rocket"></i> #1 Digital Marketing Agency Medan</span>
            <h1>Digital Marketing Agency <span class="highlight">diver.ent</span></h1>
            <p>Kami membantu bisnis Anda tumbuh melalui strategi digital marketing yang terukur, kreatif, dan data-driven.</p>
            <div class="hero-ctas">
                <a href="#cta-bottom" class="btn-primary"><i class="fas fa-calendar-check"></i> Konsultasi Gratis</a>
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
        <div class="reveal">
            <table class="comparison-table">
                <thead>
                    <tr>
                        <th>Aspek</th>
                        <th>diver.ent ✦</th>
                        <th>Agensi Lain</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Kelengkapan Layanan</td>
                        <td><i class="fas fa-check-circle check"></i> Terfokus & Spesialis</td>
                        <td><i class="fas fa-times-circle cross"></i> Generalis</td>
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
                <p>Eksekusi kampanye di semua channel digital dengan tim berpengalaman dan teknologi terkini.</p>
            </div>
            <div class="pillar-card reveal reveal-delay-3">
                <div class="pillar-icon"><i class="fas fa-chart-bar"></i></div>
                <h3>Data-Driven Optimization</h3>
                <p>Optimasi berkelanjutan berbasis data dan analytics untuk memastikan ROI maksimal.</p>
            </div>
        </div>
    </div>
</section>


{{-- Services - 4 Layanan Unggulan --}}
<section class="services-section" id="services">
    <div class="container">
        <div class="reveal">
            <span class="section-tag"><i class="fas fa-cogs"></i> Our Services</span>
            <h2 class="section-title">Layanan Unggulan Kami</h2>
            <p class="section-desc">4 layanan digital marketing spesialis untuk pertumbuhan bisnis Anda.</p>
        </div>
        <div class="services-grid reveal">
            <div class="service-card">
                <span class="service-badge">POPULAR</span>
                <div class="service-icon"><i class="fab fa-instagram"></i></div>
                <h3>Social Media Management</h3>
                <p>Kelola akun media sosial Anda dengan konten kreatif, strategi engagement, dan analitik performa.</p>
                <a href="{{ route('service.smm') }}" class="service-link">Pelajari <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="service-card">
                <div class="service-icon"><i class="fas fa-video"></i></div>
                <h3>Videography</h3>
                <p>Produksi video profesional untuk company profile, iklan, brand story, dan konten viral.</p>
                <a href="{{ route('service.vp') }}" class="service-link">Pelajari <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="service-card">
                <div class="service-icon"><i class="fas fa-camera"></i></div>
                <h3>Photography</h3>
                <p>Fotografi produk, commercial, portrait, dan event dengan hasil berkualitas tinggi.</p>
                <a href="{{ route('service.fp') }}" class="service-link">Pelajari <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="service-card">
                <span class="service-badge">TRENDING</span>
                <div class="service-icon"><i class="fas fa-chart-line"></i></div>
                <h3>Digital Ads</h3>
                <p>Kampanye iklan digital di Google, Meta, TikTok yang ditargetkan dengan tepat sasaran.</p>
                <a href="{{ route('service.dc') }}" class="service-link">Pelajari <i class="fas fa-arrow-right"></i></a>
            </div>
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
                        <div class="stat-label"><i class="fas fa-chart-line"></i> Peningkatan Performa</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number" data-count="200" data-suffix="+">0+</div>
                        <div class="stat-label"><i class="fas fa-briefcase"></i> Proyek Selesai</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number" data-count="50" data-suffix="+">0+</div>
                        <div class="stat-label"><i class="fas fa-users"></i> Klien Aktif</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number" data-count="4" data-suffix="">0</div>
                        <div class="stat-label"><i class="fas fa-cogs"></i> Layanan Unggulan</div>
                    </div>
                </div>
            </div>
            <div class="about-visual reveal">
                <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=800&h=600&fit=crop" alt="diver.ent Team">
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
                <div class="testimonial-quote"><i class="fas fa-quote-left" style="color: var(--accent); margin-right: 8px; opacity: 0.4;"></i> "{{ $t['q'] }}"</div>
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

{{-- FAQ Section --}}
<section class="faq-section" id="faq">
    <div class="container">
        <div class="reveal">
            <div class="section-tag"><i class="fas fa-question-circle"></i> FAQ</div>
            <h2 class="section-title">Pertanyaan Umum</h2>
            <p class="section-desc">Informasi yang sering ditanyakan tentang layanan kami.</p>
        </div>
        <div class="faq-grid reveal">
            <div class="faq-item">
                <button class="faq-question">
                    Berapa lama waktu pengerjaan proyek?
                    <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                </button>
                <div class="faq-answer">
                    <p>Waktu pengerjaan tergantung pada kompleksitas proyek. Untuk Social Media Management biasanya 1-2 minggu, Videography 2-4 minggu, Fotografi 3-7 hari, dan Digital Ads 1-2 minggu. Kami akan memberikan timeline jelas setelah brief disetujui.</p>
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-question">
                    Bagaimana cara memulai kerjasama?
                    <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                </button>
                <div class="faq-answer">
                    <p>Cukup klik tombol "Mulai Kerjasama" di halaman ini atau kunjungi halaman "Ayo Kerjasama" setelah login. Isi brief proyek Anda, tim kami akan menghubungi maksimal 1x24 jam.</p>
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-question">
                    Apakah ada biaya konsultasi?
                    <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                </button>
                <div class="faq-answer">
                    <p>Konsultasi awal GRATIS! Tim kami akan dengan senang hati mendengarkan kebutuhan Anda dan memberikan rekomendasi terbaik tanpa biaya apapun.</p>
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-question">
                    Apakah bisa request revisi?
                    <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                </button>
                <div class="faq-answer">
                    <p>Ya, setiap paket layanan sudah termasuk revisi sesuai kesepakatan awal. Kami memastikan hasil akhir sesuai dengan ekspektasi Anda.</p>
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-question">
                    Bagaimana sistem pembayaran?
                    <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                </button>
                <div class="faq-answer">
                    <p>Kami menerima pembayaran melalui transfer bank (BCA, Mandiri, BRI) dengan skema 50% DP dan 50% setelah proyek selesai. Untuk proyek besar bisa dinegosiasikan.</p>
                </div>
            </div>
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
            <a href="#portfolio" class="btn-primary"><i class="fas fa-chart-line"></i> Lihat Case Studies</a>
            <a href="{{ route('client.create-project') }}" class="btn-outline"><i class="fab fa-whatsapp"></i> Mulai Kerjasama</a>
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
    let animated = false;

    const animateCounters = () => {
        if (animated) return;
        animated = true;
        counters.forEach(counter => {
            const target = parseInt(counter.getAttribute('data-count'));
            const suffix = counter.getAttribute('data-suffix') || '';
            let count = 0;
            const increment = Math.ceil(target / 50);
            const updateCount = () => {
                count += increment;
                if (count < target) {
                    counter.innerText = count + suffix;
                    requestAnimationFrame(updateCount);
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

    // FAQ Accordion
    document.querySelectorAll('.faq-item').forEach(item => {
        const question = item.querySelector('.faq-question');
        question.addEventListener('click', () => {
            item.classList.toggle('active');
        });
    });
</script>

@endsection