@extends('layouts.app')

@section('content')

@include('partials.component.announcement')
@include('partials.component.navbar')

{{-- Hero Section --}}
<section class="smm-hero" id="fp-hero">
    <div class="container">
        <div class="smm-hero-content reveal">
            <nav class="breadcrumb-nav" aria-label="breadcrumb">
                <a href="/">Home</a> <span>/</span> <a href="/#services">Services</a> <span>/</span> <span class="active">Foto Produk</span>
            </nav>
            <span class="hero-tag">📸 #1 Product Photography</span>
            <h1>Jasa <span class="highlight">Foto Produk</span> Profesional</h1>
            <p>Layanan fotografi produk terlengkap mulai dari katalog, makanan, minuman, fashion, dan lainnya. Didukung peralatan studio profesional untuk keperluan promosi bisnis Anda.</p>
            <div class="hero-ctas">
                <a href="#fp-types" class="btn-primary">Lihat Jenis Foto →</a>
                <a href="#fp-process" class="btn-outline">Proses Kerja</a>
            </div>
        </div>
    </div>
</section>

{{-- Stats Bar --}}
<div class="smm-stats-bar">
    <div class="container">
        <div class="stats-row reveal">
            <div class="stat-pill"><strong>1000+</strong> Produk Difoto</div>
            <div class="stat-divider">•</div>
            <div class="stat-pill"><strong>Studio</strong> Profesional</div>
            <div class="stat-divider">•</div>
            <div class="stat-pill"><strong>Free</strong> All Files</div>
            <div class="stat-divider">•</div>
            <div class="stat-pill"><strong>3-5</strong> Hari Kerja</div>
        </div>
    </div>
</div>

{{-- Why Product Photography --}}
<section class="smm-features" id="fp-why">
    <div class="container">
        <div class="smm-features-grid">
            <div class="smm-features-text reveal">
                <span class="section-tag">Jasa Foto Produk #1</span>
                <h2 class="section-title">Foto Produk Profesional untuk Branding Bisnis</h2>
                <p class="section-desc">Visual yang profesional membangun kepercayaan, meningkatkan minat beli, dan membuat produk Anda lebih menonjol di pasar digital.</p>
                <div class="smm-checklist">
                    <div class="check-item">
                        <span class="check-icon">✓</span>
                        <p><strong>75% pembeli e-commerce</strong> menganggap foto produk sangat memengaruhi keputusan pembelian.</p>
                    </div>
                    <div class="check-item">
                        <span class="check-icon">✓</span>
                        <p>Foto produk adalah <strong>representasi kualitas dan nilai</strong> dari brand terbaik Anda.</p>
                    </div>
                    <div class="check-item">
                        <span class="check-icon">✓</span>
                        <p>Tanpa visual yang kuat, <strong>produk terbaik pun bisa terabaikan</strong> oleh calon pembeli.</p>
                    </div>
                </div>
                <div class="hero-ctas" style="margin-top:32px;">
                    <a href="#fp-types" class="btn-primary">Jenis Foto Produk</a>
                    <a href="#fp-benefits" class="btn-outline">Keuntungan →</a>
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
                            <div class="fp-showcase">
                                <div class="fp-show-item" style="background:linear-gradient(135deg,#2d1b69,#11001c);">
                                    <span class="fp-show-label">Katalog</span>
                                    <span class="fp-show-stat">📦</span>
                                </div>
                                <div class="fp-show-item" style="background:linear-gradient(135deg,#b91c1c,#450a0a);">
                                    <span class="fp-show-label">Makanan</span>
                                    <span class="fp-show-stat">🍽️</span>
                                </div>
                                <div class="fp-show-item" style="background:linear-gradient(135deg,#0369a1,#0c4a6e);">
                                    <span class="fp-show-label">Minuman</span>
                                    <span class="fp-show-stat">🥤</span>
                                </div>
                                <div class="fp-show-item" style="background:linear-gradient(135deg,#4338ca,#1e1b4b);">
                                    <span class="fp-show-label">Fashion</span>
                                    <span class="fp-show-stat">👗</span>
                                </div>
                                <div class="fp-show-item" style="background:linear-gradient(135deg,#065f46,#022c22);">
                                    <span class="fp-show-label">Skincare</span>
                                    <span class="fp-show-stat">✨</span>
                                </div>
                                <div class="fp-show-item" style="background:linear-gradient(135deg,#92400e,#451a03);">
                                    <span class="fp-show-label">Lifestyle</span>
                                    <span class="fp-show-stat">🎨</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Types of Product Photography --}}
<section class="smm-platforms" id="fp-types">
    <div class="container">
        <div class="reveal">
            <span class="section-tag">Jenis Layanan</span>
            <h2 class="section-title">Tipe Foto Produk</h2>
            <p class="section-desc">Berbagai jenis fotografi produk profesional sesuai kebutuhan bisnis Anda.</p>
        </div>
        <div class="platform-grid reveal">
            @php
            $photoTypes = [
                ['icon' => '📦', 'name' => 'Foto Katalog', 'badge' => 'Best Seller', 'bclass' => 'badge-top', 'desc' => 'Foto produk clean dan profesional untuk katalog online, e-commerce, dan marketplace.'],
                ['icon' => '🍕', 'name' => 'Foto Makanan', 'badge' => 'Popular', 'bclass' => 'badge-trending', 'desc' => 'Food photography yang menggugah selera untuk menu restoran, promosi, dan sosial media.'],
                ['icon' => '🥤', 'name' => 'Foto Minuman', 'badge' => '', 'bclass' => '', 'desc' => 'Beverage photography yang segar dan menarik untuk branding dan marketing produk minuman.'],
                ['icon' => '👗', 'name' => 'Foto Fashion', 'badge' => 'Top Choice', 'bclass' => 'badge-best', 'desc' => 'Foto pakaian flatlay atau model untuk katalog fashion, e-commerce, dan lookbook brand.'],
                ['icon' => '✨', 'name' => 'Foto Skincare & Beauty', 'badge' => '', 'bclass' => '', 'desc' => 'Foto produk kecantikan dengan lighting studio profesional yang menonjolkan detail dan tekstur.'],
                ['icon' => '🎨', 'name' => 'Foto Lifestyle', 'badge' => '', 'bclass' => '', 'desc' => 'Foto produk dengan styling lifestyle dan properti untuk konten sosial media dan iklan digital.'],
            ];
            @endphp
            @foreach($photoTypes as $type)
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
<section class="fp-process-section" id="fp-process">
    <div class="container">
        <div class="reveal">
            <span class="section-tag">Our Process</span>
            <h2 class="section-title">Proses Foto Produk</h2>
            <p class="section-desc">Alur kerja yang mudah dan transparan.</p>
        </div>
        <div class="fp-process-flow reveal">
            @php
            $steps = [
                ['num' => '1', 'icon' => '💼', 'title' => 'Pilih Paket', 'desc' => 'Tentukan paket foto yang sesuai kebutuhan.'],
                ['num' => '2', 'icon' => '💡', 'title' => 'Kirim Brief', 'desc' => 'Jelaskan detail kebutuhan yang diinginkan.'],
                ['num' => '3', 'icon' => '🚚', 'title' => 'Kirim Produk', 'desc' => 'Kirimkan produk ke studio terdekat.'],
                ['num' => '4', 'icon' => '📸', 'title' => 'Proses Foto', 'desc' => 'Pemotretan produk di studio profesional.'],
                ['num' => '5', 'icon' => '🏞️', 'title' => 'Terima Hasil', 'desc' => 'File HD dikirimkan ke email Anda.'],
                ['num' => '6', 'icon' => '📦', 'title' => 'Return', 'desc' => 'Produk dikembalikan setelah selesai.'],
            ];
            @endphp
            @foreach($steps as $index => $step)
            <div class="fp-step-card">
                <div class="fp-step-num">{{ $step['num'] }}</div>
                <span class="fp-step-icon">{{ $step['icon'] }}</span>
                <h4>{{ $step['title'] }}</h4>
                <p>{{ $step['desc'] }}</p>
            </div>
            @if($index < count($steps) - 1)
            <div class="fp-step-arrow">→</div>
            @endif
            @endforeach
        </div>
    </div>
</section>

{{-- Benefits --}}
<section class="smm-why" id="fp-benefits">
    <div class="container">
        <div class="reveal">
            <span class="section-tag">Features & Benefits</span>
            <h2 class="section-title">Keuntungan Foto Produk di <span class="highlight">diver.ent</span></h2>
        </div>
        <div class="why-grid reveal">
            @php
            $benefits = [
                ['icon' => '📸', 'title' => 'Peralatan Profesional', 'desc' => 'Menggunakan kamera DSLR/mirrorless, lighting studio, dan setup profesional untuk hasil maksimal.'],
                ['icon' => '🎨', 'title' => 'Konsep Kreatif', 'desc' => 'Tim kreatif membantu merancang konsep visual yang sesuai dengan identitas brand Anda.'],
                ['icon' => '⚡', 'title' => 'Proses Cepat', 'desc' => 'Hasil foto dikirimkan dalam 3-5 hari kerja. Tersedia opsi express untuk kebutuhan mendesak.'],
                ['icon' => '📥', 'title' => 'Free All Files', 'desc' => 'Semua file foto diberikan dalam format HD, siap digunakan untuk media digital maupun cetak.'],
                ['icon' => '✏️', 'title' => 'Editing Profesional', 'desc' => 'Color correction, retouching, dan background removal untuk hasil yang sempurna.'],
                ['icon' => '💰', 'title' => 'Harga Kompetitif', 'desc' => 'Paket harga yang fleksibel dan terjangkau, mulai dari paket basic hingga premium.'],
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
        <span>Instax Fujifilm</span><span>Bank OCBC</span><span>Labore</span>
        <span>Triv</span><span>Essenza</span><span>Perawatku</span>
        <span>NAV Karaoke</span><span>RS Onkologi</span><span>SIP Atomic</span>
        <span>BINUS University</span><span>Kominfo</span><span>Universitas Terbuka</span>
        {{-- Duplicate --}}
        <span>Instax Fujifilm</span><span>Bank OCBC</span><span>Labore</span>
        <span>Triv</span><span>Essenza</span><span>Perawatku</span>
        <span>NAV Karaoke</span><span>RS Onkologi</span><span>SIP Atomic</span>
        <span>BINUS University</span><span>Kominfo</span><span>Universitas Terbuka</span>
    </div>
</div>

{{-- FAQ --}}
<section class="dc-faq" id="fp-faq">
    <div class="container">
        <div class="reveal">
            <span class="section-tag">FAQ</span>
            <h2 class="section-title">Pertanyaan Umum</h2>
        </div>
        <div class="faq-grid reveal">
            @php
            $faqs = [
                ['q' => 'Berapa lama proses foto produk selesai?', 'a' => 'Proses pemotretan dan editing biasanya memakan waktu 3-5 hari kerja. Tersedia opsi express untuk kebutuhan yang lebih cepat.'],
                ['q' => 'Apakah produk harus dikirim ke studio?', 'a' => 'Ya, produk dapat dikirimkan ke studio kami. Untuk produk dalam jumlah banyak atau berukuran besar, kami juga bisa datang ke lokasi Anda.'],
                ['q' => 'Format file apa yang diberikan?', 'a' => 'Semua hasil foto diberikan dalam format JPEG/PNG resolusi tinggi (HD). Format RAW tersedia atas permintaan khusus.'],
                ['q' => 'Apakah ada minimum order?', 'a' => 'Tidak ada minimum order. Anda bisa memesan mulai dari 1 produk. Tersedia paket bundling dengan harga lebih hemat untuk jumlah banyak.'],
                ['q' => 'Bagaimana jika hasil foto tidak sesuai?', 'a' => 'Kami menyediakan revisi gratis untuk memastikan hasil foto sesuai dengan ekspektasi. Koordinasi dilakukan secara transparan selama proses.'],
                ['q' => 'Apakah bisa foto dengan model?', 'a' => 'Ya, kami menyediakan paket foto produk dengan model profesional. Biaya model dikenakan terpisah sesuai kebutuhan.'],
            ];
            @endphp
            @foreach($faqs as $index => $faq)
            <div class="faq-item" id="fp-faq-{{ $index }}">
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
<section class="cta-bottom" id="fp-cta">
    <div class="container reveal">
        <span class="section-tag">Mulai Sekarang</span>
        <h2 class="section-title">Butuh Jasa Foto Produk?</h2>
        <p class="section-desc">Konsultasikan kebutuhan foto produk bisnis Anda dengan tim profesional diver.ent. Gratis, tanpa komitmen.</p>
        <div class="hero-ctas">
            <a href="https://wa.me/6281234567890?text=Halo%20diver.ent%2C%20saya%20ingin%20konsultasi%20Foto%20Produk" target="_blank" class="btn-primary">Konsultasi Gratis →</a>
            <a href="{{ route('portfolio') }}" class="btn-outline">Lihat Portfolio</a>
        </div>
    </div>
</section>

@include('partials.component.footer')
@include('partials.component.modals')

@endsection
