@extends('layouts.app')

@section('content')

@include('partials.component.announcement')
@include('partials.component.navbar')

{{-- Hero Section --}}
<section class="hero" id="hero">
    <div class="container">
        <div class="hero-content reveal">
            <span class="hero-tag">🚀 #1 Digital Marketing Agency Surabaya</span>
            <h1>Digital Marketing Agency <span class="highlight">diver.ent</span></h1>
            <p>Kami membantu bisnis Anda tumbuh melalui strategi digital marketing yang terukur, kreatif, dan data-driven. Dari social media hingga website development.</p>
            <div class="hero-ctas">
                <a href="#cta-bottom" class="btn-primary">Konsultasi Gratis →</a>
                <a href="#portfolio" class="btn-outline">Lihat Portfolio</a>
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
            <span class="section-tag">Why Choose Us</span>
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
                    <td><span class="check">✓</span> Full-service</td>
                    <td><span class="cross">✗</span> Terbatas</td>
                </tr>
                <tr>
                    <td>Tim Dedicated & Responsif</td>
                    <td><span class="check">✓</span> Tim khusus per klien</td>
                    <td><span class="cross">✗</span> Shared resource</td>
                </tr>
                <tr>
                    <td>Komunikasi & Reporting Rutin</td>
                    <td><span class="check">✓</span> Weekly report & meeting</td>
                    <td><span class="cross">✗</span> Monthly / on-request</td>
                </tr>
                <tr>
                    <td>Track Record & Sertifikasi</td>
                    <td><span class="check">✓</span> Google & Meta Certified</td>
                    <td><span class="cross">✗</span> Tidak tersertifikasi</td>
                </tr>
            </tbody>
        </table>
    </div>
</section>

{{-- Three Pillars --}}
<section class="pillars" id="pillars">
    <div class="container">
        <div class="reveal">
            <span class="section-tag">Metodologi</span>
            <h2 class="section-title">Three Pillars of Success</h2>
            <p class="section-desc">Pendekatan kami yang terbukti menghasilkan pertumbuhan digital bisnis klien.</p>
        </div>
        <div class="pillars-grid">
            <div class="pillar-card reveal reveal-delay-1">
                <div class="pillar-icon">🎯</div>
                <h3>Customized Strategy</h3>
                <p>Setiap bisnis unik. Kami merancang strategi digital yang disesuaikan dengan goals, audiens, dan industri klien.</p>
            </div>
            <div class="pillar-card reveal reveal-delay-2">
                <div class="pillar-icon">⚡</div>
                <h3>Digital Activation</h3>
                <p>Eksekusi kampanye di semua channel digital — social media, ads, SEO, content — dengan tim berpengalaman.</p>
            </div>
            <div class="pillar-card reveal reveal-delay-3">
                <div class="pillar-icon">📊</div>
                <h3>Data-Driven Optimization</h3>
                <p>Optimasi berkelanjutan berbasis data dan analytics untuk memastikan ROI maksimal dari setiap campaign.</p>
            </div>
        </div>
    </div>
</section>

{{-- Client Logo Carousel --}}
<div class="client-logos">
    <div class="logo-track">
        <span>PT Telkom Indonesia</span><span>Bank BCA</span><span>Tokopedia</span>
        <span>Grab Indonesia</span><span>Wardah Beauty</span><span>Erigo</span>
        <span>J&T Express</span><span>Kopi Kenangan</span><span>Ruangguru</span>
        <span>Sociolla</span><span>Astra International</span><span>Indomie</span>
        {{-- Duplicate for infinite scroll --}}
        <span>PT Telkom Indonesia</span><span>Bank BCA</span><span>Tokopedia</span>
        <span>Grab Indonesia</span><span>Wardah Beauty</span><span>Erigo</span>
        <span>J&T Express</span><span>Kopi Kenangan</span><span>Ruangguru</span>
        <span>Sociolla</span><span>Astra International</span><span>Indomie</span>
    </div>
</div>

{{-- Portfolio --}}
<section class="portfolio-section" id="portfolio">
    <div class="container">
        <div class="reveal">
            <span class="section-tag">Portfolio</span>
            <h2 class="section-title">Our Best Work</h2>
            <p class="section-desc">Lihat hasil karya terbaik kami di berbagai industri.</p>
        </div>
        <div class="portfolio-filters reveal">
            <button class="filter-btn active" data-filter="all">Featured</button>
            <button class="filter-btn" data-filter="social">Social Media</button>
            <button class="filter-btn" data-filter="web">Website & Apps</button>
            <button class="filter-btn" data-filter="ads">Digital Ads</button>
            <button class="filter-btn" data-filter="brand">Visual Branding</button>
            <button class="filter-btn" data-filter="video">Photo & Video</button>
        </div>
        <div class="portfolio-grid reveal">
            @php
            $portfolioItems = [
                ['name' => 'Brand Campaign Wardah', 'cat' => 'social', 'label' => 'Social Media'],
                ['name' => 'E-Commerce Platform', 'cat' => 'web', 'label' => 'Website'],
                ['name' => 'Google Ads Kopi Kenangan', 'cat' => 'ads', 'label' => 'Digital Ads'],
                ['name' => 'Rebranding Erigo', 'cat' => 'brand', 'label' => 'Branding'],
                ['name' => 'Product Video Shoot', 'cat' => 'video', 'label' => 'Video Production'],
                ['name' => 'Social Media BCA', 'cat' => 'social', 'label' => 'Social Media'],
            ];
            @endphp
            @foreach($portfolioItems as $item)
            <div class="portfolio-item" data-category="{{ $item['cat'] }}">
                <div class="portfolio-thumb" style="background:linear-gradient(135deg, #1a1a2e, #16213e);">
                    <span style="font-size:2rem;opacity:.2;">{{ $loop->iteration }}</span>
                </div>
                <div class="overlay">
                    <h4>{{ $item['name'] }}</h4>
                    <span>{{ $item['label'] }}</span>
                </div>
            </div>
            @endforeach
        </div>
        <div style="text-align:center;margin-top:40px;" class="reveal">
            <a href="{{ route('portfolio') }}" class="btn-outline">See All Portfolio →</a>
        </div>
    </div>
</section>

{{-- Services --}}
<section class="services-section" id="services">
    <div class="container">
        <div class="reveal">
            <span class="section-tag">Services</span>
            <h2 class="section-title">Layanan Kami</h2>
            <p class="section-desc">12 layanan digital marketing komprehensif untuk pertumbuhan bisnis Anda.</p>
        </div>
        <div class="services-slider reveal">
            @php
            $services = [
                ['icon'=>'🔄','name'=>'360° Marketing','desc'=>'Solusi marketing menyeluruh dari strategi hingga eksekusi.','badge'=>'Full Solution','bclass'=>'badge-full'],
                ['icon'=>'📱','name'=>'Social Media','desc'=>'Manajemen akun sosial media dengan konten kreatif & engaging.','badge'=>'Top Choice','bclass'=>'badge-top'],
                ['icon'=>'🌐','name'=>'Website Dev','desc'=>'Pengembangan website modern, responsif, dan SEO-friendly.','badge'=>'Best','bclass'=>'badge-best'],
                ['icon'=>'📢','name'=>'Digital Ads','desc'=>'Kampanye iklan digital di Google, Meta, TikTok & platform lain.','badge'=>'Trending','bclass'=>'badge-trending'],
                ['icon'=>'🎨','name'=>'Branding & Design','desc'=>'Identitas visual brand yang konsisten dan memorable.','badge'=>'','bclass'=>''],
                ['icon'=>'🤝','name'=>'KOL & Affiliate','desc'=>'Kolaborasi dengan influencer & KOL untuk memperluas reach.','badge'=>'Trending','bclass'=>'badge-trending'],
                ['icon'=>'📸','name'=>'Foto Produk','desc'=>'Fotografi produk profesional untuk e-commerce & katalog.','badge'=>'','bclass'=>''],
                ['icon'=>'🎬','name'=>'Video Production','desc'=>'Produksi video komersial, company profile, & konten sosmed.','badge'=>'Best','bclass'=>'badge-best'],
                ['icon'=>'✏️','name'=>'Logo Design','desc'=>'Desain logo yang unik dan merepresentasikan brand Anda.','badge'=>'','bclass'=>''],
                ['icon'=>'📷','name'=>'Commercial Photo','desc'=>'Fotografi komersial untuk branding & marketing materials.','badge'=>'','bclass'=>''],
                ['icon'=>'📲','name'=>'Apps Dev','desc'=>'Pengembangan aplikasi mobile iOS & Android.','badge'=>'Best','bclass'=>'badge-best'],
                ['icon'=>'🔍','name'=>'SEO','desc'=>'Optimasi mesin pencari untuk meningkatkan visibilitas organik.','badge'=>'Top Choice','bclass'=>'badge-top'],
            ];
            @endphp
            @foreach($services as $svc)
            <div class="service-card">
                @if($svc['badge'])
                <span class="service-badge {{ $svc['bclass'] }}">{{ $svc['badge'] }}</span>
                @endif
                <span class="service-icon">{{ $svc['icon'] }}</span>
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
                <span class="section-tag">About Us</span>
                <h2 class="section-title">diver.ent Digital Agency</h2>
                <p class="section-desc">diver.ent adalah digital marketing agency berbasis di Surabaya yang berkomitmen membantu bisnis Indonesia tumbuh di era digital melalui strategi yang terukur dan data-driven.</p>
                <div class="about-stats">
                    <div class="stat-item">
                        <div class="stat-number" data-count="80" data-suffix="%">0%</div>
                        <div class="stat-label">Klien mengalami peningkatan performa digital</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number" data-count="200" data-suffix="+">0+</div>
                        <div class="stat-label">Proyek berhasil diselesaikan</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number" data-count="50" data-suffix="+">0+</div>
                        <div class="stat-label">Klien aktif dari berbagai industri</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number" data-count="12" data-suffix="">0</div>
                        <div class="stat-label">Layanan digital komprehensif</div>
                    </div>
                </div>
            </div>
            <div class="about-visual reveal" style="background: linear-gradient(135deg, #111, #1a1a2e);">
                <span style="opacity:.15;font-family:var(--font-display);font-size:1.2rem;">Tim diver.ent</span>
            </div>
        </div>
    </div>
</section>

{{-- Testimonials --}}
<section class="testimonials" id="testimonials">
    <div class="container">
        <div class="reveal">
            <span class="section-tag">Testimonials</span>
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
                <div class="testimonial-quote">"{{ $t['q'] }}"</div>
                <div class="testimonial-author">
                    <div class="testimonial-avatar">{{ $t['init'] }}</div>
                    <div>
                        <div class="author-name">{{ $t['name'] }}</div>
                        <div class="author-role">{{ $t['role'] }}</div>
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
        <span class="section-tag">Start Now</span>
        <h2 class="section-title">Don't Get Left Behind</h2>
        <p class="section-desc">Kompetitor Anda sudah memulai transformasi digital. Saatnya bisnis Anda tampil lebih baik di dunia digital.</p>
        <div class="hero-ctas">
            <a href="#portfolio" class="btn-primary">Case Studies →</a>
            <a href="https://wa.me/6281234567890?text=Halo%20diver.ent%2C%20saya%20ingin%20konsultasi" target="_blank" class="btn-outline">Contact Us</a>
        </div>
    </div>
</section>

{{-- Media Coverage --}}
<div class="media-coverage">
    <p>As Seen On</p>
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

@endsection
