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
                ['icon' => '📸', 'name' => 'Instagram', 'badge' => 'Best Seller', 'bclass' => 'badge-top', 'desc' => 'Kelola akun Instagram Anda secara profesional dan efektif. Dapatkan visibilitas yang maksimal.'],
                ['icon' => '🎵', 'name' => 'TikTok', 'badge' => 'Trending', 'bclass' => 'badge-trending', 'desc' => 'Manfaatkan kekuatan TikTok yang trending untuk menjangkau generasi muda yang dinamis.'],
                ['icon' => '▶️', 'name' => 'YouTube', 'badge' => 'Top Choice', 'bclass' => 'badge-best', 'desc' => 'Tingkatkan kehadiran di YouTube dengan konten video berkualitas tinggi yang relevan.'],
                ['icon' => '👤', 'name' => 'Facebook', 'badge' => '', 'bclass' => '', 'desc' => 'Dominasi pasar Anda di Facebook dengan strategi pengelolaan sesuai tujuan bisnis.'],
                ['icon' => '💼', 'name' => 'LinkedIn', 'badge' => '', 'bclass' => '', 'desc' => 'Bangun profile perusahaan yang lebih profesional dan terpercaya dengan strategi terkini.'],
                ['icon' => '✖️', 'name' => 'X (Twitter)', 'badge' => '', 'bclass' => '', 'desc' => 'Bangun hubungan yang lebih dekat dengan pelanggan melalui pengelolaan khusus di X.'],
            ];
            @endphp
            @foreach($platforms as $platform)
            <div class="platform-card">
                @if($platform['badge'])
                <span class="service-badge {{ $platform['bclass'] }}">{{ $platform['badge'] }}</span>
                @endif
                <span class="platform-icon">{{ $platform['icon'] }}</span>
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
                <h3>Analisis & Strategi</h3>
                <p>Menyusun strategi efektif berdasarkan tujuan bisnis, target audiens, dan tren industri.</p>
            </div>
            <div class="process-connector">→</div>
            <div class="process-card">
                <div class="process-number">02</div>
                <h3>Manajemen Media Sosial</h3>
                <p>Mengelola pembuatan konten kreatif, iklan, dan mengelola interaksi secara profesional.</p>
            </div>
            <div class="process-connector">→</div>
            <div class="process-card">
                <div class="process-number">03</div>
                <h3>Evaluasi & Optimalisasi</h3>
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
                ['icon' => '🎨', 'title' => 'Konten Up-to-Date', 'desc' => 'Konten dengan desain visual profesional dan trending yang disesuaikan dengan brand Anda.'],
                ['icon' => '📦', 'title' => 'Paket Lengkap', 'desc' => 'Kami mengelola semua mulai dari konten, ads, engagement, admin pada media sosial Anda.'],
                ['icon' => '💎', 'title' => 'Hemat Waktu & Biaya', 'desc' => 'Fokus pada pengembangan bisnis inti Anda, serahkan pengelolaan media sosial kepada ahlinya.'],
                ['icon' => '👥', 'title' => 'Tim Profesional', 'desc' => 'Proyek Anda akan ditangani secara profesional oleh tim ahli yang berpengalaman di bidangnya.'],
                ['icon' => '💬', 'title' => 'Komunikasi Rutin', 'desc' => 'Dengan timeline pekerjaan yang jelas, tim kami akan berkomunikasi secara rutin untuk koordinasi.'],
                ['icon' => '📊', 'title' => 'Laporan & Optimisasi', 'desc' => 'Tidak hanya reporting yang transparan, namun kami juga memberikan strategi optimisasi.'],
            ];
            @endphp
            @foreach($whyItems as $item)
            <div class="why-card">
                <div class="why-icon">{{ $item['icon'] }}</div>
                <h3>{{ $item['title'] }}</h3>
                <p>{{ $item['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Trusted Clients --}}
<div class="client-logos">
    <div class="logo-track">
        <span>Bank OCBC</span><span>Instax Fujifilm</span><span>Kominfo</span>
        <span>NAV Karaoke</span><span>BINUS University</span><span>Universitas Terbuka</span>
        <span>RS Onkology</span><span>Perawatku</span><span>Essenza</span>
        <span>Triv</span><span>Labore</span><span>SIP Atomic</span>
        {{-- Duplicate for infinite scroll --}}
        <span>Bank OCBC</span><span>Instax Fujifilm</span><span>Kominfo</span>
        <span>NAV Karaoke</span><span>BINUS University</span><span>Universitas Terbuka</span>
        <span>RS Onkology</span><span>Perawatku</span><span>Essenza</span>
        <span>Triv</span><span>Labore</span><span>SIP Atomic</span>
    </div>
</div>

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
