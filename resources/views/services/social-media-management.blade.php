@extends('layouts.app')

@section('content')

@include('partials.component.announcement')
@include('partials.component.navbar')

{{-- Hero Section --}}
<section class="smm-hero" id="smm-hero">
    <div class="container">
        <div class="smm-hero-content reveal">
            <nav class="breadcrumb-nav" aria-label="breadcrumb">
                <a href="/">Home</a> <span>/</span> <a href="/#services">Services</a> <span>/</span> <span class="active">Social Media Management</span>
            </nav>
            <span class="hero-tag">🏆 Top Rated Service</span>
            <h1>Jasa <span class="highlight">Social Media</span> Management</h1>
            <p>Solusi lengkap pengelolaan media sosial untuk bisnis Anda. Mulai dari strategi, aktivasi, campaign, manajemen akun, admin, serta pelaporan secara profesional.</p>
            <div class="hero-ctas">
                <a href="#smm-why" class="btn-primary">Mengapa diver.ent? →</a>
                <a href="#smm-platforms" class="btn-outline">Lihat Platform</a>
            </div>
        </div>
    </div>
</section>

{{-- Stats Bar --}}
<div class="smm-stats-bar">
    <div class="container">
        <div class="stats-row reveal">
            <div class="stat-pill"><strong>200+</strong> Projects</div>
            <div class="stat-divider">•</div>
            <div class="stat-pill"><strong>5+ Tahun</strong> Experience</div>
            <div class="stat-divider">•</div>
            <div class="stat-pill"><strong>Professional</strong> Team</div>
            <div class="stat-divider">•</div>
            <div class="stat-pill"><strong>Advanced</strong> Strategy</div>
        </div>
    </div>
</div>

{{-- Features Section --}}
<section class="smm-features" id="smm-features">
    <div class="container">
        <div class="smm-features-grid">
            <div class="smm-features-text reveal">
                <span class="section-tag">Miliki Social Media Profesional</span>
                <h2 class="section-title">Partner Kelola Media Sosial Bisnis Anda</h2>
                <p class="section-desc">Maksimalkan potensi media sosial bisnis Anda. diver.ent menyediakan layanan pengelolaan media sosial yang profesional untuk mencapai target audiens dan meningkatkan konversi.</p>
                <div class="smm-checklist">
                    <div class="check-item">
                        <span class="check-icon">✓</span>
                        <p>Tidak ada strategi <strong>'satu untuk semua'</strong>. Kami melakukan analisis mendalam untuk memahami industri dan target audience klien.</p>
                    </div>
                    <div class="check-item">
                        <span class="check-icon">✓</span>
                        <p>Tampilan social media <strong>lebih menarik dan profesional</strong>, efektif meningkatkan branding dan kepercayaan audience.</p>
                    </div>
                    <div class="check-item">
                        <span class="check-icon">✓</span>
                        <p>Koordinasi melalui <strong>evaluasi rutin</strong> berbasis data dan tren terkini untuk pertumbuhan yang berkelanjutan.</p>
                    </div>
                </div>
                <div class="hero-ctas" style="margin-top:32px;">
                    <a href="#smm-why" class="btn-primary">Mengapa diver.ent?</a>
                    <a href="#smm-case" class="btn-outline">Studi Kasus →</a>
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
                            <div class="mockup-stat-row">
                                <div class="mockup-stat">
                                    <span class="ms-label">Followers</span>
                                    <span class="ms-value">+340%</span>
                                    <div class="ms-bar"><div class="ms-fill" style="width:85%"></div></div>
                                </div>
                                <div class="mockup-stat">
                                    <span class="ms-label">Engagement</span>
                                    <span class="ms-value">+520%</span>
                                    <div class="ms-bar"><div class="ms-fill" style="width:95%"></div></div>
                                </div>
                            </div>
                            <div class="mockup-stat-row">
                                <div class="mockup-stat">
                                    <span class="ms-label">Reach</span>
                                    <span class="ms-value">+275%</span>
                                    <div class="ms-bar"><div class="ms-fill" style="width:70%"></div></div>
                                </div>
                                <div class="mockup-stat">
                                    <span class="ms-label">Conversion</span>
                                    <span class="ms-value">+180%</span>
                                    <div class="ms-bar"><div class="ms-fill" style="width:60%"></div></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Platform Section --}}
<section class="smm-platforms" id="smm-platforms">
    <div class="container">
        <div class="reveal">
            <span class="section-tag">Solusi Manajemen Medsos</span>
            <h2 class="section-title">Pilihan Social Media Platform</h2>
            <p class="section-desc">Kami mengelola berbagai platform media sosial untuk memaksimalkan kehadiran digital bisnis Anda.</p>
        </div>
        <div class="platform-grid reveal">
            @php
            $platforms = [
                ['icon' => 'fab fa-instagram', 'name' => 'Instagram', 'badge' => 'Best Seller', 'bclass' => 'badge-top', 'desc' => 'Kelola akun Instagram Anda secara profesional dan efektif. Dapatkan visibilitas yang maksimal.'],
                ['icon' => 'fab fa-tiktok', 'name' => 'TikTok', 'badge' => 'Trending', 'bclass' => 'badge-trending', 'desc' => 'Manfaatkan kekuatan TikTok yang trending untuk menjangkau generasi muda yang dinamis.'],
                ['icon' => 'fab fa-youtube', 'name' => 'YouTube', 'badge' => 'Top Choice', 'bclass' => 'badge-best', 'desc' => 'Tingkatkan kehadiran di YouTube dengan konten video berkualitas tinggi yang relevan.'],
                ['icon' => 'fab fa-facebook', 'name' => 'Facebook', 'badge' => '', 'bclass' => '', 'desc' => 'Dominasi pasar Anda di Facebook dengan strategi pengelolaan sesuai tujuan bisnis.'],
                ['icon' => 'fab fa-linkedin', 'name' => 'LinkedIn', 'badge' => '', 'bclass' => '', 'desc' => 'Bangun profile perusahaan yang lebih profesional dan terpercaya dengan strategi terkini.'],
                ['icon' => 'fab fa-twitter', 'name' => 'X (Twitter)', 'badge' => '', 'bclass' => '', 'desc' => 'Bangun hubungan yang lebih dekat dengan pelanggan melalui pengelolaan khusus di X.'],
            ];
            @endphp
            @foreach($platforms as $platform)
            <div class="platform-card">
                @if($platform['badge'])
                <span class="service-badge {{ $platform['bclass'] }}">{{ $platform['badge'] }}</span>
                @endif
                <div class="platform-icon-wrapper">
                    <i class="{{ $platform['icon'] }} platform-icon"></i>
                </div>
                <h3>Jasa Kelola {{ $platform['name'] }}</h3>
                <p>{{ $platform['desc'] }}</p>
                <a href="#" class="platform-link">Selengkapnya →</a>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Process Section --}}
<section class="smm-process" id="smm-process">
    <div class="container">
        <div class="reveal">
            <span class="section-tag">Cara Kerja</span>
            <h2 class="section-title">Proses Kami</h2>
            <p class="section-desc">Pendekatan sistematis yang terbukti menghasilkan pertumbuhan digital.</p>
        </div>
        <div class="process-grid reveal">
            <div class="process-card">
                <div class="process-number">01</div>
                <h3><i class="fas fa-chart-line"></i> Analisis & Strategi</h3>
                <p>Menyusun strategi efektif berdasarkan tujuan bisnis, target audiens, dan tren industri.</p>
            </div>
            <div class="process-connector">→</div>
            <div class="process-card">
                <div class="process-number">02</div>
                <h3><i class="fas fa-hashtag"></i> Manajemen Media Sosial</h3>
                <p>Mengelola pembuatan konten kreatif, iklan, dan mengelola interaksi secara profesional.</p>
            </div>
            <div class="process-connector">→</div>
            <div class="process-card">
                <div class="process-number">03</div>
                <h3><i class="fas fa-chart-simple"></i> Evaluasi & Optimalisasi</h3>
                <p>Memberikan insight dengan koordinasi rutin, dan terus mengoptimalkan hasil.</p>
            </div>
        </div>
    </div>
</section>

{{-- Why Choose Us --}}
<section class="smm-why" id="smm-why">
    <div class="container">
        <div class="reveal">
            <span class="section-tag">Why Choose Us?</span>
            <h2 class="section-title">Dikelola Secara <span class="highlight">Profesional</span></h2>
        </div>
        <div class="why-grid reveal">
            @php
            $whyItems = [
                ['icon' => 'fas fa-palette', 'title' => 'Konten Up-to-Date', 'desc' => 'Konten dengan desain visual profesional dan trending yang disesuaikan dengan brand Anda.'],
                ['icon' => 'fas fa-box', 'title' => 'Paket Lengkap', 'desc' => 'Kami mengelola semua mulai dari konten, ads, engagement, admin pada media sosial Anda.'],
                ['icon' => 'fas fa-clock', 'title' => 'Hemat Waktu & Biaya', 'desc' => 'Fokus pada pengembangan bisnis inti Anda, serahkan pengelolaan media sosial kepada ahlinya.'],
                ['icon' => 'fas fa-users', 'title' => 'Tim Profesional', 'desc' => 'Proyek Anda akan ditangani secara profesional oleh tim ahli yang berpengalaman di bidangnya.'],
                ['icon' => 'fas fa-comments', 'title' => 'Komunikasi Rutin', 'desc' => 'Dengan timeline pekerjaan yang jelas, tim kami akan berkomunikasi secara rutin untuk koordinasi.'],
                ['icon' => 'fas fa-chart-line', 'title' => 'Laporan & Optimisasi', 'desc' => 'Tidak hanya reporting yang transparan, namun kami juga memberikan strategi optimisasi.'],
            ];
            @endphp
            @foreach($whyItems as $item)
            <div class="why-card">
                <div class="why-icon-wrapper">
                    <i class="{{ $item['icon'] }} why-icon"></i>
                </div>
                <h3>{{ $item['title'] }}</h3>
                <p>{{ $item['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>


{{-- Case Study / Testimonial --}}
<section class="smm-case" id="smm-case">
    <div class="container">
        <div class="reveal">
            <span class="section-tag">Studi Kasus</span>
            <h2 class="section-title">Hasil Nyata untuk Klien Kami</h2>
            <p class="section-desc">Highlighting the results we deliver for our clients' social media presence.</p>
        </div>
        <div class="case-grid reveal">
            @php
            $cases = [
                ['client' => 'Fashion Brand', 'result' => '+340% Followers', 'desc' => 'Meningkatkan followers Instagram dari 2K menjadi 8.8K dalam 4 bulan dengan strategi konten yang konsisten dan campaign kreatif.', 'metric1_label' => 'Engagement Rate', 'metric1_value' => '8.5%', 'metric2_label' => 'Reach Growth', 'metric2_value' => '+520%'],
                ['client' => 'F&B Restaurant', 'result' => '+275% Engagement', 'desc' => 'Meningkatkan engagement rate dari 1.2% menjadi 4.5% melalui konten interaktif dan strategi community management.', 'metric1_label' => 'Conversion', 'metric1_value' => '+180%', 'metric2_label' => 'Brand Awareness', 'metric2_value' => '+300%'],
                ['client' => 'Healthcare Clinic', 'result' => '+450% Reach', 'desc' => 'Meningkatkan jangkauan konten dari 5K menjadi 27.5K per bulan dengan strategi hashtag dan konten edukatif.', 'metric1_label' => 'New Patients', 'metric1_value' => '+65%', 'metric2_label' => 'Trust Score', 'metric2_value' => '9.2/10'],
            ];
            @endphp
            @foreach($cases as $case)
            <div class="case-card">
                <div class="case-header">
                    <span class="case-client">{{ $case['client'] }}</span>
                    <span class="case-result">{{ $case['result'] }}</span>
                </div>
                <p class="case-desc">{{ $case['desc'] }}</p>
                <div class="case-metrics">
                    <div class="case-metric">
                        <span class="cm-label">{{ $case['metric1_label'] }}</span>
                        <span class="cm-value">{{ $case['metric1_value'] }}</span>
                    </div>
                    <div class="case-metric">
                        <span class="cm-label">{{ $case['metric2_label'] }}</span>
                        <span class="cm-value">{{ $case['metric2_value'] }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- CTA Bottom --}}
<section class="cta-bottom" id="smm-cta">
    <div class="container reveal">
        <span class="section-tag">Mulai Sekarang</span>
        <h2 class="section-title">Siap Maksimalkan Social Media Bisnis Anda?</h2>
        <p class="section-desc">Konsultasikan kebutuhan social media management bisnis Anda dengan tim ahli diver.ent. Gratis, tanpa komitmen.</p>
        <div class="hero-ctas">
            <a href="https://wa.me/6281234567890?text=Halo%20diver.ent%2C%20saya%20ingin%20konsultasi%20Social%20Media%20Management" target="_blank" class="btn-primary">Konsultasi Gratis →</a>
            <a href="/" class="btn-outline">Kembali ke Home</a>
        </div>
    </div>
</section>

@include('partials.component.footer')
@include('partials.component.modals')

@endsection

<style>
/* ===== Social Media Management Page Styles ===== */
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

.mockup-stat-row {
    display: flex;
    gap: 20px;
    margin-bottom: 20px;
}

.mockup-stat {
    flex: 1;
}

.ms-label {
    font-size: 0.7rem;
    color: var(--text-secondary);
    text-transform: uppercase;
    letter-spacing: 1px;
}

.ms-value {
    display: block;
    font-size: 1.4rem;
    font-weight: 700;
    color: var(--accent);
    margin: 5px 0 8px;
}

.ms-bar {
    background: var(--border);
    border-radius: 10px;
    height: 6px;
    overflow: hidden;
}

.ms-fill {
    background: var(--accent);
    height: 100%;
    border-radius: 10px;
}

/* Platform Grid */
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

/* UNIFIED ICON STYLES */
.platform-icon-wrapper,
.why-icon-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 1.2rem;
}

.platform-icon,
.why-icon {
    font-size: 2.8rem;
    display: inline-block;
    transition: transform 0.2s ease;
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
    margin-bottom: 1rem;
}

.platform-link {
    color: var(--accent);
    font-size: 0.85rem;
    font-weight: 600;
    text-decoration: none;
    transition: opacity 0.2s;
}

.platform-link:hover {
    opacity: 0.8;
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

/* Why Choose Us Grid */
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

/* Case Study Grid */
.smm-case {
    padding: 60px 0;
}

.case-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 1.5rem;
    margin-top: 2rem;
}

.case-card {
    background: var(--surface);
    border-radius: 20px;
    padding: 1.5rem;
    transition: var(--transition);
    border: 1px solid var(--border);
}

.case-card:hover {
    transform: translateY(-5px);
    border-color: var(--accent);
}

.case-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.case-client {
    font-weight: 700;
    font-size: 1.2rem;
    color: var(--accent);
}

.case-result {
    font-weight: 600;
    font-size: 0.9rem;
    background: rgba(0, 210, 255, 0.12);
    padding: 4px 12px;
    border-radius: 20px;
    color: var(--accent);
}

.case-desc {
    color: var(--text-secondary);
    font-size: 0.9rem;
    line-height: 1.6;
    margin-bottom: 1rem;
}

.case-metrics {
    display: flex;
    gap: 1rem;
    padding-top: 1rem;
    border-top: 1px solid var(--border);
}

.case-metric {
    flex: 1;
    text-align: center;
}

.cm-label {
    font-size: 0.7rem;
    color: var(--text-secondary);
    display: block;
    margin-bottom: 4px;
}

.cm-value {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--accent);
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
    
    .mockup-stat-row {
        flex-direction: column;
        gap: 15px;
    }
}

@media (max-width: 768px) {
    .smm-hero {
        padding: 80px 0 40px;
    }
    
    .section-title {
        font-size: 1.8rem;
    }
    
    .platform-grid, .why-grid, .case-grid {
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
        font-size: 2.2rem;
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