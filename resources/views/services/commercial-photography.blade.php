@extends('layouts.app')

@section('content')

@include('partials.component.announcement')
@include('partials.component.navbar')

{{-- Hero Section --}}
<section class="smm-hero" id="cp-hero">
    <div class="container">
        <div class="smm-hero-content reveal">
            <nav class="breadcrumb-nav" aria-label="breadcrumb">
                <a href="/">Home</a> <span>/</span> <a href="/#services">Services</a> <span>/</span> <span class="active">Commercial Photography</span>
            </nav>
            <span class="hero-tag">📷 Professional Photography</span>
            <h1>Jasa <span class="highlight">Commercial</span> Photography</h1>
            <p>Layanan fotografi komersial profesional untuk corporate, event, dan branding bisnis Anda. Dokumentasi berkualitas tinggi dengan konsep visual yang sesuai identitas perusahaan.</p>
            <div class="hero-ctas">
                <a href="#cp-services" class="btn-primary">Lihat Layanan →</a>
                <a href="#cp-benefits" class="btn-outline">Keuntungan</a>
            </div>
        </div>
    </div>
</section>

{{-- Stats Bar --}}
<div class="smm-stats-bar">
    <div class="container">
        <div class="stats-row reveal">
            <div class="stat-pill"><strong>500+</strong> Sesi Foto</div>
            <div class="stat-divider">•</div>
            <div class="stat-pill"><strong>Professional</strong> Equipment</div>
            <div class="stat-divider">•</div>
            <div class="stat-pill"><strong>On-Location</strong> Service</div>
            <div class="stat-divider">•</div>
            <div class="stat-pill"><strong>High-Res</strong> Output</div>
        </div>
    </div>
</div>

{{-- Photography Services --}}
<section class="smm-platforms" id="cp-services">
    <div class="container">
        <div class="reveal">
            <span class="section-tag">Jenis Layanan</span>
            <h2 class="section-title">Layanan Fotografi Komersial</h2>
            <p class="section-desc">Berbagai jenis fotografi profesional untuk kebutuhan bisnis dan perusahaan Anda.</p>
        </div>
        <div class="platform-grid reveal">
            @php
            $photoServices = [
                ['icon' => '👔', 'name' => 'Corporate Portrait', 'badge' => 'Best Seller', 'bclass' => 'badge-top', 'desc' => 'Foto profil profesional untuk direksi, karyawan, dan tim perusahaan dengan lighting studio berkualitas.'],
                ['icon' => '🏢', 'name' => 'Dokumentasi Kantor', 'badge' => '', 'bclass' => '', 'desc' => 'Dokumentasi interior dan eksterior kantor, pabrik, atau fasilitas bisnis untuk company profile.'],
                ['icon' => '🎉', 'name' => 'Event Photography', 'badge' => 'Popular', 'bclass' => 'badge-trending', 'desc' => 'Dokumentasi seminar, gathering, launching product, dan acara internal perusahaan.'],
                ['icon' => '🏭', 'name' => 'Industrial Photo', 'badge' => '', 'bclass' => '', 'desc' => 'Fotografi pabrik, proses produksi, dan fasilitas industri untuk kebutuhan corporate.'],
                ['icon' => '📰', 'name' => 'Company Profile', 'badge' => 'Top Choice', 'bclass' => 'badge-best', 'desc' => 'Paket foto lengkap untuk kebutuhan company profile, annual report, dan publikasi resmi.'],
                ['icon' => '🍽️', 'name' => 'F&B Photography', 'badge' => '', 'bclass' => '', 'desc' => 'Fotografi makanan dan minuman profesional untuk menu, promosi, dan konten sosial media.'],
            ];
            @endphp
            @foreach($photoServices as $service)
            <div class="platform-card">
                @if($service['badge'])
                <span class="service-badge {{ $service['bclass'] }}">{{ $service['badge'] }}</span>
                @endif
                <span class="platform-icon">{{ $service['icon'] }}</span>
                <h3>{{ $service['name'] }}</h3>
                <p>{{ $service['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- What's Included --}}
<section class="smm-features" id="cp-included">
    <div class="container">
        <div class="smm-features-grid">
            <div class="smm-features-text reveal">
                <span class="section-tag">Yang Anda Dapatkan</span>
                <h2 class="section-title">Paket Layanan Commercial Photography</h2>
                <p class="section-desc">Setiap sesi foto dikerjakan secara profesional dengan standar industri kreatif.</p>

                <div class="cp-includes-grid">
                    @php
                    $includes = [
                        ['icon' => '📸', 'title' => 'Fotografer Profesional', 'desc' => 'Tim fotografer berpengalaman dengan peralatan kelas industri'],
                        ['icon' => '💡', 'title' => 'Lighting Profesional', 'desc' => 'Setup lighting studio atau portable untuk hasil optimal'],
                        ['icon' => '📍', 'title' => 'Foto On Location', 'desc' => 'Sesi foto di lokasi kantor, pabrik, atau venue pilihan'],
                        ['icon' => '✨', 'title' => 'Post Production', 'desc' => 'Color grading, retouching, dan editing berkualitas tinggi'],
                        ['icon' => '💄', 'title' => 'Styling & MUA', 'desc' => 'Tim styling dan makeup artist untuk foto corporate/event'],
                        ['icon' => '📥', 'title' => 'File High Resolution', 'desc' => 'Dokumentasi lengkap dalam format berkualitas tinggi'],
                    ];
                    @endphp
                    @foreach($includes as $item)
                    <div class="cp-include-item">
                        <span class="cp-inc-icon">{{ $item['icon'] }}</span>
                        <div>
                            <h4>{{ $item['title'] }}</h4>
                            <p>{{ $item['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="cp-bonus">
                    <span>✓</span> Konsultasi gratis • Free All Files • Free Visual Concept • Full Support
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
                            <div class="cp-gallery-mock">
                                <div class="cp-gm-item" style="background:linear-gradient(135deg,#1a1a2e,#16213e);aspect-ratio:1/1;grid-row:span 2;">
                                    <span>Corporate<br>Portrait</span>
                                </div>
                                <div class="cp-gm-item" style="background:linear-gradient(135deg,#0f3460,#16213e);">
                                    <span>Event</span>
                                </div>
                                <div class="cp-gm-item" style="background:linear-gradient(135deg,#533483,#16213e);">
                                    <span>Office</span>
                                </div>
                                <div class="cp-gm-item" style="background:linear-gradient(135deg,#e94560,#16213e);grid-column:span 2;">
                                    <span>F&B Photography</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Process --}}
<section class="smm-process" id="cp-process">
    <div class="container">
        <div class="reveal">
            <span class="section-tag">Cara Kerja</span>
            <h2 class="section-title">Proses Pemotretan</h2>
            <p class="section-desc">Alur kerja yang terstruktur untuk hasil foto yang konsisten dan berkualitas.</p>
        </div>
        <div class="process-grid reveal">
            <div class="process-card">
                <div class="process-number">01</div>
                <h3>Konsultasi & Konsep</h3>
                <p>Diskusi kebutuhan, gaya visual, dan konsep foto yang sesuai identitas perusahaan Anda.</p>
            </div>
            <div class="process-connector">→</div>
            <div class="process-card">
                <div class="process-number">02</div>
                <h3>Pemotretan</h3>
                <p>Sesi foto profesional di lokasi Anda atau studio dengan peralatan dan lighting berkualitas tinggi.</p>
            </div>
            <div class="process-connector">→</div>
            <div class="process-card">
                <div class="process-number">03</div>
                <h3>Editing & Delivery</h3>
                <p>Post-production profesional (5-7 hari kerja) dan penyerahan file HD siap pakai.</p>
            </div>
        </div>
    </div>
</section>

{{-- Benefits / Features --}}
<section class="smm-why" id="cp-benefits">
    <div class="container">
        <div class="reveal">
            <span class="section-tag">Features & Benefits</span>
            <h2 class="section-title">Keuntungan Bersama <span class="highlight">diver.ent</span></h2>
        </div>
        <div class="why-grid reveal">
            @php
            $benefits = [
                ['icon' => '🏢', 'title' => 'Spesialisasi Corporate', 'desc' => 'Fokus pada kebutuhan perusahaan profesional dengan pengalaman dokumentasi kantor, pabrik, hingga acara resmi.'],
                ['icon' => '⚙️', 'title' => 'Standar Industri Tinggi', 'desc' => 'Menggunakan kamera, lighting, dan sistem kerja setara industri kreatif untuk hasil yang konsisten.'],
                ['icon' => '🎨', 'title' => 'Kreatif Konsep Visual', 'desc' => 'Membantu merancang konsep foto yang sesuai identitas perusahaan agar lebih kredibel dan profesional.'],
                ['icon' => '📍', 'title' => 'Lokasi Fleksibel', 'desc' => 'Siap melakukan sesi foto di kantor, pabrik, hotel, atau lokasi lain sesuai kebutuhan dan kesepakatan.'],
                ['icon' => '📋', 'title' => 'Proses Terstruktur', 'desc' => 'Setiap sesi foto dijalankan dengan alur jelas: persiapan, pemotretan, editing, hingga penyerahan hasil.'],
                ['icon' => '🏆', 'title' => 'Hasil Terbaik', 'desc' => 'Hasil foto berkualitas tinggi dan optimal untuk media cetak, digital, hingga publikasi eksternal.'],
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
        <span>RS Onkologi</span><span>Labore</span><span>Triv</span>
        <span>Universitas Terbuka</span><span>Instax Fujifilm</span><span>Bank OCBC</span>
        <span>BINUS University</span><span>NAV Karaoke</span><span>Essenza</span>
        <span>Perawatku</span><span>SIP Atomic</span><span>Kominfo</span>
        {{-- Duplicate --}}
        <span>RS Onkologi</span><span>Labore</span><span>Triv</span>
        <span>Universitas Terbuka</span><span>Instax Fujifilm</span><span>Bank OCBC</span>
        <span>BINUS University</span><span>NAV Karaoke</span><span>Essenza</span>
        <span>Perawatku</span><span>SIP Atomic</span><span>Kominfo</span>
    </div>
</div>

{{-- FAQ Section --}}
<section class="dc-faq" id="cp-faq">
    <div class="container">
        <div class="reveal">
            <span class="section-tag">FAQ</span>
            <h2 class="section-title">Pertanyaan Umum</h2>
        </div>
        <div class="faq-grid reveal">
            @php
            $faqs = [
                ['q' => 'Apakah layanan tersedia di seluruh Indonesia?', 'a' => 'Saat ini layanan kami mencakup area Pulau Jawa. Untuk luar Jawa bisa dibicarakan secara khusus dengan tim kami.'],
                ['q' => 'Berapa lama waktu pengerjaan dan editing foto?', 'a' => 'Proses editing rata-rata 5–7 hari kerja setelah pemotretan. Ada opsi express jika dibutuhkan lebih cepat.'],
                ['q' => 'Apakah bisa pemotretan di kantor atau pabrik klien?', 'a' => 'Ya, kami datang langsung ke lokasi perusahaan, baik kantor, pabrik, maupun fasilitas bisnis.'],
                ['q' => 'Apakah harga bisa disesuaikan dengan kebutuhan?', 'a' => 'Ya, paket harga fleksibel. Anda dapat memilih paket yang tersedia atau meminta penawaran khusus.'],
                ['q' => 'Apa saja jenis fotografi komersial yang ditawarkan?', 'a' => 'Layanan mencakup corporate portraits, dokumentasi kantor/pabrik, company profile, hingga event perusahaan.'],
                ['q' => 'Apakah file foto diberikan dalam resolusi tinggi?', 'a' => 'Semua hasil foto diberikan dalam resolusi tinggi (HD) dan siap digunakan untuk media digital maupun cetak.'],
                ['q' => 'Apakah tersedia dokumentasi untuk acara perusahaan?', 'a' => 'Ya, kami melayani dokumentasi seminar, gathering, launching product, maupun acara internal perusahaan.'],
                ['q' => 'Bagaimana cara memesan dan menjadwalkan sesi foto?', 'a' => 'Hubungi kami via WhatsApp atau form kontak di website untuk konsultasi dan mengatur jadwal pemotretan.'],
            ];
            @endphp
            @foreach($faqs as $index => $faq)
            <div class="faq-item" id="cp-faq-{{ $index }}">
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
<section class="cta-bottom" id="cp-cta">
    <div class="container reveal">
        <span class="section-tag">Mulai Sekarang</span>
        <h2 class="section-title">Butuh Jasa Fotografi Komersial?</h2>
        <p class="section-desc">Konsultasikan kebutuhan fotografi bisnis Anda dengan tim profesional diver.ent. Gratis, tanpa komitmen.</p>
        <div class="hero-ctas">
            <a href="https://wa.me/6281234567890?text=Halo%20diver.ent%2C%20saya%20ingin%20konsultasi%20Commercial%20Photography" target="_blank" class="btn-primary">Konsultasi Gratis →</a>
            <a href="{{ route('portfolio') }}" class="btn-outline">Lihat Portfolio</a>
        </div>
    </div>
</section>

@include('partials.component.footer')
@include('partials.component.modals')

@endsection
