@extends('layouts.app')

@section('content')

@include('partials.component.announcement')
@include('partials.component.navbar')

{{-- Hero Section --}}
<section class="smm-hero" id="vp-hero">
    <div class="container">
        <div class="smm-hero-content reveal">
            <nav class="breadcrumb-nav" aria-label="breadcrumb">
                <a href="/">Home</a> <span>/</span> <a href="/#services">Services</a> <span>/</span> <span class="active">Video Production</span>
            </nav>
            <span class="hero-tag">🎬 Professional Video</span>
            <h1>Jasa <span class="highlight">Video</span> Production</h1>
            <p>Layanan pembuatan video profesional untuk berbagai kebutuhan promosi bisnis. Wujudkan cerita yang hidup melalui video yang mengesankan dan komunikatif.</p>
            <div class="hero-ctas">
                <a href="#vp-types" class="btn-primary">Jenis Video →</a>
                <a href="#vp-process" class="btn-outline">Cara Kerja</a>
            </div>
        </div>
    </div>
</section>

{{-- Stats Bar --}}
<div class="smm-stats-bar">
    <div class="container">
        <div class="stats-row reveal">
            <div class="stat-pill"><strong>1,000+</strong> Projects</div>
            <div class="stat-divider">•</div>
            <div class="stat-pill"><strong>7+ Tahun</strong> Experience</div>
            <div class="stat-divider">•</div>
            <div class="stat-pill"><strong>Professional</strong> Team</div>
            <div class="stat-divider">•</div>
            <div class="stat-pill"><strong>Advanced</strong> Technology</div>
        </div>
    </div>
</div>

{{-- Why Video --}}
<section class="smm-features" id="vp-about">
    <div class="container">
        <div class="smm-features-grid">
            <div class="smm-features-text reveal">
                <span class="section-tag">Jasa Video Production #1</span>
                <h2 class="section-title">Cerita yang Hidup Melalui <span class="highlight">Video</span></h2>
                <p class="section-desc">Video merupakan media paling efektif untuk campaign, awareness, dan edukasi pasar karena memadukan visual dengan audio sehingga pesan mudah ditangkap oleh audience.</p>
                <div class="smm-checklist">
                    <div class="check-item">
                        <span class="check-icon">✓</span>
                        <p>Visualisasi produk & layanan lebih <strong>interaktif dan menarik</strong>.</p>
                    </div>
                    <div class="check-item">
                        <span class="check-icon">✓</span>
                        <p>Komunikasi brand yang lebih <strong>profesional dan memorable</strong>.</p>
                    </div>
                    <div class="check-item">
                        <span class="check-icon">✓</span>
                        <p><strong>Meningkatkan engagement</strong> hingga 10x dibanding konten statis.</p>
                    </div>
                </div>
                <div class="hero-ctas" style="margin-top:32px;">
                    <a href="#vp-types" class="btn-primary">Lihat Jenis Video</a>
                    <a href="#vp-benefits" class="btn-outline">Keuntungan →</a>
                </div>
            </div>
            <div class="smm-features-visual reveal">
                <div class="smm-visual-card">
                    <div class="visual-mockup">
                        <div class="mockup-header">
                            <span class="dot red"></span>
                            <span class="dot yellow"></span>
                            <span class="dot green"></span>
                        </div>
                        <div class="mockup-body">
                            <div class="vp-timeline-mock">
                                <div class="vp-player-area">
                                    <div class="vp-play-btn">▶</div>
                                    <span class="vp-timecode">00:00 / 02:30</span>
                                </div>
                                <div class="vp-timeline-tracks">
                                    <div class="vp-track vp-track-video">
                                        <span class="vp-track-label">V1</span>
                                        <div class="vp-track-bar" style="width:90%;background:linear-gradient(90deg,var(--accent),#00a0cc);"></div>
                                    </div>
                                    <div class="vp-track vp-track-audio">
                                        <span class="vp-track-label">A1</span>
                                        <div class="vp-track-bar" style="width:80%;background:linear-gradient(90deg,var(--accent),#0A192F);"></div>
                                    </div>
                                    <div class="vp-track vp-track-fx">
                                        <span class="vp-track-label">FX</span>
                                        <div class="vp-track-bar" style="width:60%;background:linear-gradient(90deg,#0A192F,var(--accent));"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Video Types --}}
<section class="smm-platforms" id="vp-types">
    <div class="container">
        <div class="reveal">
            <span class="section-tag">Solusi Pembuatan Video</span>
            <h2 class="section-title">Pilihan Jenis Video</h2>
            <p class="section-desc">Berbagai jenis video profesional untuk kebutuhan bisnis dan promosi Anda.</p>
        </div>
        <div class="platform-grid reveal">
            @php
            $videoTypes = [
                ['icon' => 'fa-film', 'name' => 'Video Animasi', 'badge' => 'Best Seller', 'bclass' => 'badge-top', 'desc' => 'Video animasi explainer 2D (motion graphic) untuk company profile maupun promosi produk dan layanan.'],
                ['icon' => 'fa-hashtag', 'name' => 'Video Konten Sosmed', 'badge' => 'Trending', 'bclass' => 'badge-trending', 'desc' => 'Pembuatan video untuk konten posting maupun promosi di YouTube, TikTok, dan Instagram.'],
                ['icon' => 'fa-building', 'name' => 'Video Company Profile', 'badge' => 'Top Choice', 'bclass' => 'badge-best', 'desc' => 'Video company profile untuk meningkatkan citra perusahaan dan mendukung promosi bisnis.'],
                ['icon' => 'fa-chart-line', 'name' => 'Video Promosi / Iklan', 'badge' => '', 'bclass' => '', 'desc' => 'Video iklan komersial untuk kampanye digital, TV commercial, dan placement di berbagai platform.'],
                ['icon' => 'fa-graduation-cap', 'name' => 'Video Edukasi', 'badge' => '', 'bclass' => '', 'desc' => 'Video edukasi dan tutorial untuk pelatihan internal, e-learning, dan konten edukatif.'],
                ['icon' => 'fa-calendar-alt', 'name' => 'Video Event / Dokumentasi', 'badge' => '', 'bclass' => '', 'desc' => 'Dokumentasi video acara perusahaan, seminar, launching product, dan gathering.'],
            ];
            @endphp
            @foreach($videoTypes as $type)
            <div class="platform-card">
                @if($type['badge'])
                <span class="service-badge {{ $type['bclass'] }}">{{ $type['badge'] }}</span>
                @endif
                <div class="platform-icon-wrapper">
                    <i class="fas {{ $type['icon'] }} platform-icon"></i>
                </div>
                <h3>{{ $type['name'] }}</h3>
                <p>{{ $type['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Process --}}
<section class="smm-process" id="vp-process">
    <div class="container">
        <div class="reveal">
            <span class="section-tag">Our Process</span>
            <h2 class="section-title">Bagaimana Kami Membantu?</h2>
            <p class="section-desc">Proses produksi video yang terstruktur dan profesional.</p>
        </div>
        <div class="process-grid reveal">
            <div class="process-card">
                <div class="process-number">01</div>
                <h3><i class="fas fa-search"></i> Riset & Strategi</h3>
                <p>Analisis bisnis, audiens, dan tren pasar Anda untuk dasar konsep dan strategi video.</p>
            </div>
            <div class="process-connector">→</div>
            <div class="process-card">
                <div class="process-number">02</div>
                <h3><i class="fas fa-video"></i> Eksekusi & Produksi</h3>
                <p>Menerapkan strategi dengan kreativitas, tim profesional, dan teknologi terkini.</p>
            </div>
            <div class="process-connector">→</div>
            <div class="process-card">
                <div class="process-number">03</div>
                <h3><i class="fas fa-chart-line"></i> Evaluasi & Delivery</h3>
                <p>Review, revisi, finalisasi, dan penyerahan file video berkualitas tinggi siap pakai.</p>
            </div>
        </div>
    </div>
</section>

{{-- Benefits --}}
<section class="smm-why" id="vp-benefits">
    <div class="container">
        <div class="reveal">
            <span class="section-tag">Features & Benefits</span>
            <h2 class="section-title">Keuntungan Video Production di <span class="highlight">diver.ent</span></h2>
        </div>
        <div class="why-grid reveal">
            @php
            $benefits = [
                ['icon' => 'fa-users', 'title' => 'Tim Kreatif Profesional', 'desc' => 'Ditangani oleh videografer, editor, dan kreator berpengalaman di berbagai jenis video produksi.'],
                ['icon' => 'fa-camera', 'title' => 'Peralatan Canggih', 'desc' => 'Menggunakan kamera cinema-grade, drone, lighting studio, dan audio recording profesional.'],
                ['icon' => 'fa-magic', 'title' => 'Post-Production Berkualitas', 'desc' => 'Editing, color grading, motion graphic, sound design, dan visual effects berkualitas tinggi.'],
                ['icon' => 'fa-tasks', 'title' => 'Konsep Terstruktur', 'desc' => 'Mulai dari brainstorming, scriptwriting, storyboard, hingga produksi dengan alur yang jelas.'],
                ['icon' => 'fa-bolt', 'title' => 'Proses Cepat', 'desc' => 'Timeline produksi yang efisien dengan koordinasi transparan di setiap tahap pengerjaan.'],
                ['icon' => 'fa-bullseye', 'title' => 'Orientasi Hasil', 'desc' => 'Video dirancang tidak hanya menarik, tapi juga efektif untuk mencapai tujuan bisnis Anda.'],
            ];
            @endphp
            @foreach($benefits as $item)
            <div class="why-card">
                <div class="why-icon-wrapper">
                    <i class="fas {{ $item['icon'] }} why-icon"></i>
                </div>
                <h3>{{ $item['title'] }}</h3>
                <p>{{ $item['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>


{{-- FAQ --}}
<section class="dc-faq" id="vp-faq">
    <div class="container">
        <div class="reveal">
            <span class="section-tag">FAQ</span>
            <h2 class="section-title">Pertanyaan Umum</h2>
        </div>
        <div class="faq-grid reveal">
            @php
            $faqs = [
                ['q' => 'Berapa lama proses pembuatan video?', 'a' => 'Tergantung jenis dan kompleksitas video. Video animasi 2D biasanya 2-4 minggu, video shooting 1-3 minggu setelah produksi.'],
                ['q' => 'Apakah bisa revisi setelah video selesai?', 'a' => 'Ya, kami menyediakan revisi gratis sesuai paket yang dipilih. Revisi tambahan dapat didiskusikan lebih lanjut.'],
                ['q' => 'Apakah termasuk scriptwriting dan storyboard?', 'a' => 'Ya, paket kami sudah termasuk brainstorming konsep, penulisan script, dan pembuatan storyboard sebelum produksi.'],
                ['q' => 'Format file apa yang diberikan?', 'a' => 'Video diberikan dalam format MP4 (H.264/H.265) resolusi Full HD atau 4K. Format lain tersedia atas permintaan.'],
                ['q' => 'Apakah bisa shooting di lokasi klien?', 'a' => 'Ya, kami menyediakan layanan shooting on-location di area Jawa. Untuk luar Jawa bisa diatur secara khusus.'],
                ['q' => 'Apa saja yang perlu disiapkan klien?', 'a' => 'Cukup siapkan brief kebutuhan, referensi video (jika ada), dan akses lokasi. Tim kami akan mengurus sisanya.'],
            ];
            @endphp
            @foreach($faqs as $index => $faq)
            <div class="faq-item" id="vp-faq-{{ $index }}">
                <button class="faq-question" onclick="this.parentElement.classList.toggle('open')">
                    <span>{{ $faq['q'] }}</span>
                    <span class="faq-toggle">+</span>
                </button>
                <div class="faq-answer">
                    <p>{{ $faq['a'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- CTA Bottom --}}
<section class="cta-bottom" id="vp-cta">
    <div class="container reveal">
        <span class="section-tag">Mulai Sekarang</span>
        <h2 class="section-title">Perlu Diskusi Tentang Video?</h2>
        <p class="section-desc">Tim kreatif kami siap membahas kebutuhan pembuatan video yang sesuai dengan keinginan Anda. Gratis, tanpa komitmen.</p>
        <div class="hero-ctas">
            <a href="https://wa.me/6281234567890?text=Halo%20diver.ent%2C%20saya%20ingin%20konsultasi%20Video%20Production" target="_blank" class="btn-primary">Konsultasi Gratis →</a>
            <a href="{{ route('portfolio') }}" class="btn-outline">Lihat Portfolio</a>
        </div>
    </div>
</section>

@include('partials.component.footer')
@include('partials.component.modals')

@endsection

<style>
/* ===== Video Production Page Styles ===== */
/* Menggunakan sistem warna diver.ent: Accent: #00D2FF */

/* Hero Section */
.smm-hero {
    padding: 120px 0 60px;
    position: relative;
}

.hero-tag {
    display: inline-block;
    background: rgba(0, 210, 255, 0.12);
    color: var(--accent);
    padding: 6px 14px;
    border-radius: 50px;
    font-size: 0.8rem;
    font-weight: 500;
    margin-bottom: 1rem;
}

.smm-hero h1 {
    font-size: 3.2rem;
    font-weight: 800;
    line-height: 1.2;
    margin-bottom: 1rem;
    font-family: var(--font-display);
}

.highlight {
    color: var(--accent);
}

.smm-hero p {
    font-size: 1.1rem;
    color: var(--text-secondary);
    max-width: 600px;
    margin-bottom: 2rem;
}

.hero-ctas {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.breadcrumb-nav {
    margin-bottom: 1.5rem;
    font-size: 0.85rem;
    color: var(--text-secondary);
}

.breadcrumb-nav a:hover {
    color: var(--accent);
}

.breadcrumb-nav span {
    margin: 0 8px;
}

/* Stats Bar */
.smm-stats-bar {
    background: var(--surface);
    border-top: 1px solid var(--border);
    border-bottom: 1px solid var(--border);
    padding: 1.2rem 0;
    margin-bottom: 60px;
}

.stats-row {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 1rem;
    flex-wrap: wrap;
}

.stat-pill {
    font-size: 0.95rem;
    color: var(--text-secondary);
}

.stat-pill strong {
    color: var(--accent);
    font-size: 1.1rem;
}

.stat-divider {
    color: var(--border);
}

/* Features Grid */
.smm-features-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    align-items: center;
    margin-bottom: 60px;
}

.section-tag {
    display: inline-block;
    background: rgba(0, 210, 255, 0.12);
    color: var(--accent);
    padding: 4px 12px;
    border-radius: 30px;
    font-size: 0.75rem;
    font-weight: 600;
    letter-spacing: 0.5px;
    margin-bottom: 1rem;
}

.section-title {
    font-size: 2.2rem;
    font-weight: 700;
    margin-bottom: 1rem;
    font-family: var(--font-display);
}

.section-desc {
    color: var(--text-secondary);
    margin-bottom: 1.5rem;
}

.smm-checklist {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.check-item {
    display: flex;
    align-items: flex-start;
    gap: 10px;
}

.check-icon {
    color: var(--accent);
    font-weight: bold;
    font-size: 1.1rem;
}

/* Visual Mockup */
.smm-visual-card {
    background: var(--surface);
    border-radius: 20px;
    border: 1px solid var(--border);
    overflow: hidden;
    box-shadow: 0 20px 35px -15px rgba(0, 0, 0, 0.2);
}

.visual-mockup {
    border-radius: 20px;
    overflow: hidden;
}

.mockup-header {
    background: var(--surface-alt);
    padding: 12px 16px;
    display: flex;
    gap: 8px;
    border-bottom: 1px solid var(--border);
}

.dot {
    width: 12px;
    height: 12px;
    border-radius: 50%;
}

.dot.red { background: #ff5f56; }
.dot.yellow { background: #ffbd2e; }
.dot.green { background: #27c93f; }

.mockup-body {
    padding: 24px;
    background: var(--surface);
}

.vp-timeline-mock {
    background: var(--bg);
    border-radius: 12px;
    padding: 16px;
}

.vp-player-area {
    background: var(--surface-alt);
    border-radius: 8px;
    padding: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.vp-play-btn {
    width: 40px;
    height: 40px;
    background: var(--accent);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    cursor: pointer;
}

.vp-timecode {
    font-family: monospace;
    color: var(--text-secondary);
}

.vp-timeline-tracks {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.vp-track {
    display: flex;
    align-items: center;
    gap: 12px;
}

.vp-track-label {
    font-weight: 600;
    font-size: 0.8rem;
    width: 30px;
}

.vp-track-bar {
    height: 8px;
    border-radius: 4px;
    flex: 1;
}

/* Video Types Grid */
.smm-platforms {
    padding: 60px 0;
}

.platform-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
    margin-top: 2rem;
}

.platform-card {
    background: var(--surface);
    border-radius: 20px;
    padding: 2rem 1.5rem;
    transition: var(--transition);
    border: 1px solid var(--border);
    position: relative;
    text-align: center;
}

.platform-card:hover {
    transform: translateY(-5px);
    border-color: var(--accent);
}

/* UNIFIED ICON STYLES - SERAGAM UNTUK SEMUA IKON FONT AWESOME */
.platform-icon-wrapper,
.why-icon-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 1.2rem;
}

.platform-icon,
.why-icon {
    font-size: 2.5rem;
    display: inline-block;
    transition: transform 0.2s ease;
    /* WARNA SERAGAM: menggunakan accent color #00D2FF */
    color: var(--accent);
}

.platform-card:hover .platform-icon,
.why-card:hover .why-icon {
    transform: scale(1.08);
}

.platform-card h3,
.why-card h3 {
    font-size: 1.3rem;
    margin-bottom: 0.75rem;
    font-family: var(--font-display);
}

.platform-card p,
.why-card p {
    color: var(--text-secondary);
    font-size: 0.9rem;
    line-height: 1.5;
}

/* Badge styling */
.service-badge {
    position: absolute;
    top: -10px;
    right: 15px;
    background: var(--accent);
    color: #0A192F;
    font-size: 0.7rem;
    font-weight: 700;
    padding: 4px 12px;
    border-radius: 30px;
}

.badge-top, .badge-trending, .badge-best {
    background: var(--accent);
}

/* Process Section */
.smm-process {
    padding: 60px 0;
    background: var(--surface-alt);
}

.process-grid {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
    margin-top: 2rem;
}

.process-card {
    background: var(--surface);
    border-radius: 20px;
    padding: 2rem;
    text-align: center;
    flex: 1;
    min-width: 200px;
    border: 1px solid var(--border);
}

.process-card h3 i {
    color: var(--accent);
    margin-right: 8px;
}

.process-number {
    font-size: 3rem;
    font-weight: 800;
    color: var(--accent);
    opacity: 0.5;
    margin-bottom: 0.5rem;
}

.process-card h3 {
    font-size: 1.2rem;
    margin-bottom: 0.5rem;
}

.process-card p {
    color: var(--text-secondary);
    font-size: 0.85rem;
}

.process-connector {
    font-size: 1.5rem;
    color: var(--accent);
}

/* Benefits Grid */
.smm-why {
    padding: 60px 0;
}

.why-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
    margin-top: 2rem;
}

.why-card {
    background: var(--surface);
    border-radius: 20px;
    padding: 2rem;
    transition: var(--transition);
    border: 1px solid var(--border);
    text-align: center;
}

.why-card:hover {
    transform: translateY(-5px);
    border-color: var(--accent);
}

/* Client Logos */
.client-logos {
    overflow: hidden;
    padding: 40px 0;
    background: var(--surface-alt);
    margin: 40px 0;
}

.logo-track {
    display: flex;
    gap: 2rem;
    animation: scroll 30s linear infinite;
    white-space: nowrap;
}

.logo-track span {
    font-weight: 500;
    color: var(--text-secondary);
    font-size: 1rem;
}

@keyframes scroll {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}

/* FAQ Section */
.dc-faq {
    padding: 60px 0;
}

.faq-grid {
    max-width: 800px;
    margin: 2rem auto 0;
}

.faq-item {
    background: var(--surface);
    border-radius: 16px;
    margin-bottom: 1rem;
    border: 1px solid var(--border);
    overflow: hidden;
}

.faq-question {
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.2rem 1.5rem;
    background: transparent;
    border: none;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    color: var(--text);
}

.faq-toggle {
    font-size: 1.2rem;
    transition: transform 0.3s;
}

.faq-item.open .faq-toggle {
    transform: rotate(45deg);
}

.faq-answer {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease;
    padding: 0 1.5rem;
}

.faq-item.open .faq-answer {
    max-height: 200px;
    padding: 0 1.5rem 1.2rem;
}

.faq-answer p {
    color: var(--text-secondary);
    line-height: 1.6;
}

/* CTA Bottom */
.cta-bottom {
    padding: 60px 0;
    text-align: center;
    background: linear-gradient(135deg, var(--surface), var(--surface-alt));
    margin-top: 40px;
}

/* Responsive */
@media (max-width: 992px) {
    .smm-features-grid {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    .smm-hero h1 {
        font-size: 2.5rem;
    }
    
    .process-connector {
        display: none;
    }
    
    .process-grid {
        flex-direction: column;
    }
    
    .process-card {
        width: 100%;
    }
}

@media (max-width: 768px) {
    .smm-hero {
        padding: 80px 0 40px;
    }
    
    .section-title {
        font-size: 1.8rem;
    }
    
    .platform-grid, .why-grid {
        grid-template-columns: 1fr;
    }
    
    .hero-ctas {
        flex-direction: column;
        align-items: center;
    }
    
    .btn-primary, .btn-outline {
        width: 100%;
        text-align: center;
        justify-content: center;
    }
    
    .platform-icon,
    .why-icon {
        font-size: 2rem;
    }
}

/* Reveal Animation */
.reveal {
    opacity: 0;
    transform: translateY(30px);
    animation: reveal 0.6s forwards;
}

@keyframes reveal {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>