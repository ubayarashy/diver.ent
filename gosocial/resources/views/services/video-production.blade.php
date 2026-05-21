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
                                        <div class="vp-track-bar" style="width:90%;background:linear-gradient(90deg,var(--accent),#b3d900);"></div>
                                    </div>
                                    <div class="vp-track vp-track-audio">
                                        <span class="vp-track-label">A1</span>
                                        <div class="vp-track-bar" style="width:80%;background:linear-gradient(90deg,#6b89ff,#4338ca);"></div>
                                    </div>
                                    <div class="vp-track vp-track-fx">
                                        <span class="vp-track-label">FX</span>
                                        <div class="vp-track-bar" style="width:60%;background:linear-gradient(90deg,#e94560,#b91c1c);"></div>
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
                ['icon' => '🎨', 'name' => 'Video Animasi', 'badge' => 'Best Seller', 'bclass' => 'badge-top', 'desc' => 'Video animasi explainer 2D (motion graphic) untuk company profile maupun promosi produk dan layanan.'],
                ['icon' => '📱', 'name' => 'Video Konten Sosmed', 'badge' => 'Trending', 'bclass' => 'badge-trending', 'desc' => 'Pembuatan video untuk konten posting maupun promosi di YouTube, TikTok, dan Instagram.'],
                ['icon' => '🏢', 'name' => 'Video Company Profile', 'badge' => 'Top Choice', 'bclass' => 'badge-best', 'desc' => 'Video company profile untuk meningkatkan citra perusahaan dan mendukung promosi bisnis.'],
                ['icon' => '📢', 'name' => 'Video Promosi / Iklan', 'badge' => '', 'bclass' => '', 'desc' => 'Video iklan komersial untuk kampanye digital, TV commercial, dan placement di berbagai platform.'],
                ['icon' => '🎓', 'name' => 'Video Edukasi', 'badge' => '', 'bclass' => '', 'desc' => 'Video edukasi dan tutorial untuk pelatihan internal, e-learning, dan konten edukatif.'],
                ['icon' => '🎤', 'name' => 'Video Event / Dokumentasi', 'badge' => '', 'bclass' => '', 'desc' => 'Dokumentasi video acara perusahaan, seminar, launching product, dan gathering.'],
            ];
            @endphp
            @foreach($videoTypes as $type)
            <div class="platform-card">
                @if($type['badge'])
                <span class="service-badge {{ $type['bclass'] }}">{{ $type['badge'] }}</span>
                @endif
                <span class="platform-icon">{{ $type['icon'] }}</span>
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
                <h3>Riset & Strategi 🔍</h3>
                <p>Analisis bisnis, audiens, dan tren pasar Anda untuk dasar konsep dan strategi video.</p>
            </div>
            <div class="process-connector">→</div>
            <div class="process-card">
                <div class="process-number">02</div>
                <h3>Eksekusi & Produksi 🚀</h3>
                <p>Menerapkan strategi dengan kreativitas, tim profesional, dan teknologi terkini.</p>
            </div>
            <div class="process-connector">→</div>
            <div class="process-card">
                <div class="process-number">03</div>
                <h3>Evaluasi & Delivery 📈</h3>
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
                ['icon' => '🎬', 'title' => 'Tim Kreatif Profesional', 'desc' => 'Ditangani oleh videografer, editor, dan kreator berpengalaman di berbagai jenis video produksi.'],
                ['icon' => '📹', 'title' => 'Peralatan Canggih', 'desc' => 'Menggunakan kamera cinema-grade, drone, lighting studio, dan audio recording profesional.'],
                ['icon' => '✨', 'title' => 'Post-Production Berkualitas', 'desc' => 'Editing, color grading, motion graphic, sound design, dan visual effects berkualitas tinggi.'],
                ['icon' => '📋', 'title' => 'Konsep Terstruktur', 'desc' => 'Mulai dari brainstorming, scriptwriting, storyboard, hingga produksi dengan alur yang jelas.'],
                ['icon' => '⚡', 'title' => 'Proses Cepat', 'desc' => 'Timeline produksi yang efisien dengan koordinasi transparan di setiap tahap pengerjaan.'],
                ['icon' => '🎯', 'title' => 'Orientasi Hasil', 'desc' => 'Video dirancang tidak hanya menarik, tapi juga efektif untuk mencapai tujuan bisnis Anda.'],
            ];
            @endphp
            @foreach($benefits as $item)
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
        <span>RS Onkologi</span><span>Perawatku</span><span>Essenza</span>
        <span>Triv</span><span>Labore</span><span>SIP Atomic</span>
        {{-- Duplicate --}}
        <span>Bank OCBC</span><span>Instax Fujifilm</span><span>Kominfo</span>
        <span>NAV Karaoke</span><span>BINUS University</span><span>Universitas Terbuka</span>
        <span>RS Onkologi</span><span>Perawatku</span><span>Essenza</span>
        <span>Triv</span><span>Labore</span><span>SIP Atomic</span>
    </div>
</div>

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
