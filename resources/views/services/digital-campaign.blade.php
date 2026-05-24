@extends('layouts.app')

@section('content')

@include('partials.component.announcement')
@include('partials.component.navbar')

{{-- Hero Section --}}
<section class="smm-hero" id="dc-hero">
    <div class="container">
        <div class="smm-hero-content reveal">
            <nav class="breadcrumb-nav" aria-label="breadcrumb">
                <a href="/">Home</a> <span>/</span> <a href="/#services">Services</a> <span>/</span> <span class="active">Digital Campaign / Ads</span>
            </nav>
            <span class="hero-tag">📈 Certified Ads Partner</span>
            <h1>Jasa <span class="highlight">Digital Campaign</span> & Ads</h1>
            <p>Tingkatkan penjualan & popularitas brand Anda melalui iklan digital di Meta Ads, Google Ads, dan TikTok Ads. Strategi berbasis data, konten kreatif, dan optimasi berkelanjutan.</p>
            <div class="hero-ctas">
                <a href="#dc-benefits" class="btn-primary">Keuntungan Iklan →</a>
                <a href="#dc-platforms" class="btn-outline">Lihat Platform</a>
            </div>
        </div>
    </div>
</section>

{{-- Stats Bar --}}
<div class="smm-stats-bar">
    <div class="container">
        <div class="stats-row reveal">
            <div class="stat-pill"><strong>500+</strong> Campaigns</div>
            <div class="stat-divider">•</div>
            <div class="stat-pill"><strong>Google</strong> Certified</div>
            <div class="stat-divider">•</div>
            <div class="stat-pill"><strong>Meta</strong> Certified</div>
            <div class="stat-divider">•</div>
            <div class="stat-pill"><strong>TikTok</strong> Partner</div>
        </div>
    </div>
</div>

{{-- Process / How it Works --}}
<section class="smm-features" id="dc-process">
    <div class="container">
        <div class="smm-features-grid">
            <div class="smm-features-text reveal">
                <span class="section-tag">Jasa Iklan Digital</span>
                <h2 class="section-title">Tingkatkan Penjualan & Popularitas Brand 📈</h2>
                <p class="section-desc">Kami merancang, menjalankan, dan mengoptimasi kampanye iklan digital agar brand Anda menjangkau lebih banyak audiens dan menghasilkan konversi maksimal.</p>

                <div class="dc-steps">
                    <div class="dc-step">
                        <div class="dc-step-num">1</div>
                        <div>
                            <h4>Analisis Strategi Terbaik 🎯</h4>
                            <p>Kami merancang strategi iklan digital terbaik agar brand Anda menjangkau lebih banyak audiens.</p>
                        </div>
                    </div>
                    <div class="dc-step">
                        <div class="dc-step-num">2</div>
                        <div>
                            <h4>Buat Campaign yang Kreatif 🔥</h4>
                            <p>Kami bantu membuat konten iklan kreatif agar campaign Anda lebih menonjol dan efektif.</p>
                        </div>
                    </div>
                    <div class="dc-step">
                        <div class="dc-step-num">3</div>
                        <div>
                            <h4>Optimasi Konversi & Penjualan</h4>
                            <p>Optimasi iklan berjalan untuk mendapatkan konversi tinggi dengan laporan yang transparan.</p>
                        </div>
                    </div>
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
                            <div class="dc-dashboard">
                                <div class="dc-dash-header">
                                    <span class="dc-dash-title">Campaign Dashboard</span>
                                    <span class="dc-dash-status">● Live</span>
                                </div>
                                <div class="mockup-stat-row">
                                    <div class="mockup-stat">
                                        <span class="ms-label">CTR</span>
                                        <span class="ms-value">4.8%</span>
                                        <div class="ms-bar"><div class="ms-fill" style="width:80%"></div></div>
                                    </div>
                                    <div class="mockup-stat">
                                        <span class="ms-label">ROAS</span>
                                        <span class="ms-value">5.2x</span>
                                        <div class="ms-bar"><div class="ms-fill" style="width:90%"></div></div>
                                    </div>
                                </div>
                                <div class="mockup-stat-row">
                                    <div class="mockup-stat">
                                        <span class="ms-label">CPC</span>
                                        <span class="ms-value">Rp 850</span>
                                        <div class="ms-bar"><div class="ms-fill" style="width:65%"></div></div>
                                    </div>
                                    <div class="mockup-stat">
                                        <span class="ms-label">Conversions</span>
                                        <span class="ms-value">+320%</span>
                                        <div class="ms-bar"><div class="ms-fill" style="width:85%"></div></div>
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

{{-- Ad Platforms --}}
<section class="smm-platforms" id="dc-platforms">
    <div class="container">
        <div class="reveal">
            <span class="section-tag">Platform Iklan</span>
            <h2 class="section-title">Pilihan Platform Digital Ads</h2>
            <p class="section-desc">Kami mengelola kampanye iklan di berbagai platform untuk menjangkau audiens yang tepat.</p>
        </div>
        <div class="platform-grid reveal">
            @php
            $adPlatforms = [
                ['icon' => '📘', 'name' => 'Meta Ads', 'badge' => 'Best Seller', 'bclass' => 'badge-top', 'desc' => 'Jangkau audiens di Facebook & Instagram dengan targeting presisi berdasarkan demografi, minat, dan perilaku.', 'budget' => 'Min. Rp 500.000/bulan'],
                ['icon' => '🎵', 'name' => 'TikTok Ads', 'badge' => 'Trending', 'bclass' => 'badge-trending', 'desc' => 'Manfaatkan platform dengan pertumbuhan tercepat untuk menjangkau generasi muda yang dinamis.', 'budget' => 'Min. Rp 500.000/bulan'],
                ['icon' => '🔍', 'name' => 'Google Ads', 'badge' => 'Top Choice', 'bclass' => 'badge-best', 'desc' => 'Tampilkan bisnis Anda di halaman pertama Google saat calon pelanggan mencari produk/jasa Anda.', 'budget' => 'Min. Rp 500.000/bulan'],
                ['icon' => '▶️', 'name' => 'YouTube Ads', 'badge' => '', 'bclass' => '', 'desc' => 'Video ads yang ditampilkan sebelum atau selama konten YouTube untuk meningkatkan awareness brand.', 'budget' => 'Budget fleksibel'],
                ['icon' => '🛒', 'name' => 'Marketplace Ads', 'badge' => '', 'bclass' => '', 'desc' => 'Promosikan produk di Shopee, Tokopedia, dan marketplace lainnya untuk meningkatkan penjualan.', 'budget' => 'Budget fleksibel'],
                ['icon' => '💼', 'name' => 'LinkedIn Ads', 'badge' => '', 'bclass' => '', 'desc' => 'Platform terbaik untuk B2B marketing, lead generation, dan recruitment campaign profesional.', 'budget' => 'Budget fleksibel'],
            ];
            @endphp
            @foreach($adPlatforms as $platform)
            <div class="platform-card">
                @if($platform['badge'])
                <span class="service-badge {{ $platform['bclass'] }}">{{ $platform['badge'] }}</span>
                @endif
                <span class="platform-icon">{{ $platform['icon'] }}</span>
                <h3>{{ $platform['name'] }}</h3>
                <p>{{ $platform['desc'] }}</p>
                <span class="dc-budget">{{ $platform['budget'] }}</span>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Benefits / Features --}}
<section class="smm-why" id="dc-benefits">
    <div class="container">
        <div class="reveal">
            <span class="section-tag">Features & Benefits</span>
            <h2 class="section-title">Keuntungan Iklan Dikelola <span class="highlight">diver.ent</span></h2>
        </div>
        <div class="why-grid reveal">
            @php
            $benefits = [
                ['icon' => '🔬', 'title' => 'Iklan Dengan Riset & Data', 'desc' => 'Setiap campaign dirancang dari riset mendalam, tren industri, dan target bisnis Anda.'],
                ['icon' => '🎨', 'title' => 'Pembuatan Konten Iklan', 'desc' => 'Pembuatan konten iklan yang menarik sekaligus fokus mendorong hasil nyata.'],
                ['icon' => '⚡', 'title' => 'Optimasi Berkelanjutan', 'desc' => 'Memberikan hasil analisis untuk digunakan dalam mengambil keputusan bisnis.'],
                ['icon' => '📊', 'title' => 'Monitoring & Evaluasi', 'desc' => 'Performa iklan dipantau berkala untuk menjaga efektivitas & efisiensi budget.'],
                ['icon' => '📋', 'title' => 'Laporan Transparan', 'desc' => 'Laporan rutin berisi insight jelas (CTR, CPC, CPM, ROAS) untuk mendukung strategi berikutnya.'],
                ['icon' => '👨‍💻', 'title' => 'Tim Berpengalaman', 'desc' => 'Ditangani oleh advertiser profesional bersertifikasi dengan pengalaman lintas industri.'],
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

{{-- Case Studies --}}
<section class="smm-case" id="dc-case">
    <div class="container">
        <div class="reveal">
            <span class="section-tag">Studi Kasus</span>
            <h2 class="section-title">Dari Traffic ke Penjualan</h2>
            <p class="section-desc">Semua lewat iklan digital yang terukur dan teroptimasi.</p>
        </div>
        <div class="dc-case-grid reveal">
            @php
            $dcCases = [
                ['client' => 'E-Commerce Brand', 'campaign' => 'Meta Ads + Google Ads', 'desc' => 'Campaign untuk meningkatkan traffic dan penjualan melalui Instagram Ads dan Google Search Ads.', 'roas' => '5.2x', 'ctr' => '4.8%', 'conv' => '+320%'],
                ['client' => 'Education Platform', 'campaign' => 'Google Ads', 'desc' => 'Campaign untuk promosi pendaftaran webinar dan kelas offline melalui Google Ads.', 'roas' => '3.8x', 'ctr' => '6.2%', 'conv' => '+210%'],
                ['client' => 'F&B Restaurant', 'campaign' => 'Meta Ads + TikTok Ads', 'desc' => 'Pembuatan konten dan optimasi iklan untuk meningkatkan kunjungan dan brand awareness.', 'roas' => '4.5x', 'ctr' => '5.1%', 'conv' => '+275%'],
                ['client' => 'Property Developer', 'campaign' => 'Google Ads', 'desc' => 'Optimasi pencarian lokal dan lead generation melalui Google Search & Display Ads.', 'roas' => '6.1x', 'ctr' => '3.9%', 'conv' => '+180%'],
            ];
            @endphp
            @foreach($dcCases as $case)
            <div class="dc-case-card">
                <div class="dc-case-top">
                    <span class="dc-case-client">{{ $case['client'] }}</span>
                    <span class="dc-case-platform">{{ $case['campaign'] }}</span>
                </div>
                <p class="case-desc">{{ $case['desc'] }}</p>
                <div class="dc-case-metrics">
                    <div class="dc-metric">
                        <span class="dc-metric-val">{{ $case['roas'] }}</span>
                        <span class="dc-metric-lbl">ROAS</span>
                    </div>
                    <div class="dc-metric">
                        <span class="dc-metric-val">{{ $case['ctr'] }}</span>
                        <span class="dc-metric-lbl">CTR</span>
                    </div>
                    <div class="dc-metric">
                        <span class="dc-metric-val">{{ $case['conv'] }}</span>
                        <span class="dc-metric-lbl">Conversion</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Trusted Clients --}}
<div class="client-logos">
    <div class="logo-track">
        <span>Kata AI</span><span>The Lab</span><span>TokoCuan</span>
        <span>NMR Brand</span><span>Azkhal</span><span>Nigaya</span>
        <span>Animasi Studio</span><span>Yamani</span><span>Cokelat Holic</span>
        <span>Balm Gallery</span><span>Andalusia</span><span>BFI Syariah</span>
        {{-- Duplicate for infinite scroll --}}
        <span>Kata AI</span><span>The Lab</span><span>TokoCuan</span>
        <span>NMR Brand</span><span>Azkhal</span><span>Nigaya</span>
        <span>Animasi Studio</span><span>Yamani</span><span>Cokelat Holic</span>
        <span>Balm Gallery</span><span>Andalusia</span><span>BFI Syariah</span>
    </div>
</div>

{{-- FAQ Section --}}
<section class="dc-faq" id="dc-faq">
    <div class="container">
        <div class="reveal">
            <span class="section-tag">FAQ</span>
            <h2 class="section-title">Frequently Asked Questions</h2>
        </div>
        <div class="faq-grid reveal">
            @php
            $faqs = [
                ['q' => 'Apa itu layanan Digital Campaign di diver.ent?', 'a' => 'Layanan Digital Campaign diver.ent adalah strategi pemasaran berbayar untuk meningkatkan visibilitas brand, traffic, dan penjualan melalui platform seperti Meta Ads, TikTok Ads, dan Google Ads.'],
                ['q' => 'Bagaimana cara kerja layanan iklan di diver.ent?', 'a' => 'Kami memulai dengan memahami target market Anda, menyusun strategi kampanye yang paling relevan, membuat materi iklan, menjalankan campaign, dan terus mengoptimalkannya agar hasil maksimal.'],
                ['q' => 'Apakah saya perlu menyiapkan materi iklan sendiri?', 'a' => 'Tidak harus. Tim diver.ent dapat membantu mulai dari pembuatan konsep, copywriting, hingga desain atau video ads. Jika Anda sudah memiliki materi, kami juga bisa langsung mengoptimalkan.'],
                ['q' => 'Apakah ada minimum budget iklan?', 'a' => 'Ya, minimum budget iklan tiap platform adalah Rp 500.000/bulan untuk Meta Ads, TikTok Ads, dan Google Ads.'],
                ['q' => 'Apakah saya bisa melihat hasil dan performa iklan?', 'a' => 'Tentu. Kami menyediakan laporan performa mingguan/bulanan yang meliputi metrik utama seperti CTR, CPC, CPM, ROAS, dan jumlah leads atau konversi.'],
                ['q' => 'Berapa lama waktu untuk melihat hasilnya?', 'a' => 'Hasil awal biasanya bisa terlihat dalam 3–7 hari, namun optimasi maksimal biasanya terjadi dalam 2–4 minggu tergantung pada platform dan objektif iklan.'],
            ];
            @endphp
            @foreach($faqs as $index => $faq)
            <div class="faq-item" id="faq-{{ $index }}">
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
<section class="cta-bottom" id="dc-cta">
    <div class="container reveal">
        <span class="section-tag">Mulai Sekarang</span>
        <h2 class="section-title">Siap Tingkatkan Penjualan dengan Digital Ads?</h2>
        <p class="section-desc">Konsultasikan kebutuhan iklan digital bisnis Anda. Gratis, tanpa komitmen.</p>
        <div class="hero-ctas">
            <a href="https://wa.me/6281234567890?text=Halo%20diver.ent%2C%20saya%20ingin%20konsultasi%20Digital%20Campaign" target="_blank" class="btn-primary">Konsultasi Gratis →</a>
            <a href="/" class="btn-outline">Kembali ke Home</a>
        </div>
    </div>
</section>

@include('partials.component.footer')
@include('partials.component.modals')

@endsection
