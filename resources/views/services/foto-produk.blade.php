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

{{-- Paket & Harga Jasa Foto Produk --}}
<section class="fp-pricing" id="fp-pricing">
    <div class="container">
        <div class="reveal text-center">
            <span class="section-tag">Pricing Plans</span>
            <h2 class="section-title">Paket & Harga Jasa Foto Produk</h2>
            <p class="section-desc">Pilih paket layanan foto produk yang paling sesuai dengan kebutuhan dan budget bisnis Anda.</p>
        </div>
        <div class="pricing-grid reveal">
            {{-- Paket 1 --}}
            <div class="pricing-card">
                <div class="pricing-header">
                    <h3>Foto Catalog</h3>
                    <div class="price">
                        <span class="currency">Rp</span>
                        <span class="amount">35</span>
                        <span class="period">.000,-</span>
                    </div>
                    <p>Mulai dari</p>
                    <span class="pricing-desc">Latar belakang polos, cocok untuk e-commerce & marketplace.</span>
                </div>
                <div class="pricing-body">
                    <ul>
                        <li><span class="check">✓</span> 1 Editing Foto / Produk</li>
                        <li><span class="check">✓</span> Basic Treatment Produk</li>
                        <li><span class="check">✓</span> Free Penyimpanan File</li>
                        <li><span class="check">✓</span> Photo Studio Equipments</li>
                    </ul>
                </div>
                <div class="pricing-footer">
                    <a href="#" class="btn-outline">Pilih Paket</a>
                </div>
            </div>

            {{-- Paket 2 --}}
            <div class="pricing-card popular">
                <div class="popular-badge">Populer</div>
                <div class="pricing-header">
                    <h3>Foto Creative</h3>
                    <div class="price">
                        <span class="currency">Rp</span>
                        <span class="amount">70</span>
                        <span class="period">.000,-</span>
                    </div>
                    <p>Mulai dari</p>
                    <span class="pricing-desc">Konsep, tema, dan properti pendukung untuk visual menarik.</span>
                </div>
                <div class="pricing-body">
                    <ul>
                        <li><span class="check">✓</span> 2 Editing Foto / Produk</li>
                        <li><span class="check">✓</span> Free Styling & Konsep Foto</li>
                        <li><span class="check">✓</span> Free Penyimpanan File</li>
                        <li><span class="check">✓</span> Photo Studio Equipments</li>
                    </ul>
                </div>
                <div class="pricing-footer">
                    <a href="#" class="btn-primary">Pilih Paket</a>
                </div>
            </div>

            {{-- Paket 3 --}}
            <div class="pricing-card">
                <div class="pricing-header">
                    <h3>Foto FnB</h3>
                    <div class="price">
                        <span class="currency">Rp</span>
                        <span class="amount">100</span>
                        <span class="period">.000,-</span>
                    </div>
                    <p>Mulai dari</p>
                    <span class="pricing-desc">Dilengkapi dengan styling dan treatment khusus makanan/minuman.</span>
                </div>
                <div class="pricing-body">
                    <ul>
                        <li><span class="check">✓</span> 2 Editing Foto / Produk</li>
                        <li><span class="check">✓</span> Free Styling & Treatment Khusus</li>
                        <li><span class="check">✓</span> Free Penyimpanan File</li>
                        <li><span class="check">✓</span> Photo Studio Equipments</li>
                    </ul>
                </div>
                <div class="pricing-footer">
                    <a href="#" class="btn-outline">Pilih Paket</a>
                </div>
            </div>

            {{-- Paket 4 --}}
            <div class="pricing-card">
                <div class="pricing-header">
                    <h3>Foto Model</h3>
                    <div class="price">
                        <span class="currency">Rp</span>
                        <span class="amount">250</span>
                        <span class="period">.000,-</span>
                    </div>
                    <p>Mulai dari</p>
                    <span class="pricing-desc">Ditambah berbagai pilihan model dan styling khusus / MUA.</span>
                </div>
                <div class="pricing-body">
                    <ul>
                        <li><span class="check">✓</span> Up to 5 Editing Foto</li>
                        <li><span class="check">✓</span> Free Styling & Model Makeup</li>
                        <li><span class="check">✓</span> Free Penyimpanan File</li>
                        <li><span class="check">✓</span> Photo Studio Equipments</li>
                    </ul>
                </div>
                <div class="pricing-footer">
                    <a href="#" class="btn-outline">Pilih Paket</a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Kategori Produk --}}
<section class="fp-categories" id="fp-categories">
    <div class="container">
        <div class="reveal text-center">
            <span class="section-tag">Supported Categories</span>
            <h2 class="section-title">Kategori Foto Produk yang Didukung</h2>
            <p class="section-desc">Pilih kategori layanan fotografi yang kami dukung untuk berbagai jenis industri Anda.</p>
        </div>
        <div class="category-tabs reveal" style="flex-wrap: wrap; justify-content: center; margin-top: 32px;">
            <div class="cat-tab active" onclick="filterCategory(this, 'all')">
                <span class="cat-icon">🌟</span>
                <h4>Semua Kategori</h4>
            </div>
            <div class="cat-tab" onclick="filterCategory(this, 'makanan')">
                <span class="cat-icon">🍕</span>
                <h4>Makanan</h4>
            </div>
            <div class="cat-tab" onclick="filterCategory(this, 'minuman')">
                <span class="cat-icon">🥤</span>
                <h4>Minuman</h4>
            </div>
            <div class="cat-tab" onclick="filterCategory(this, 'baju')">
                <span class="cat-icon">👗</span>
                <h4>Baju & Fashion</h4>
            </div>
            <div class="cat-tab" onclick="filterCategory(this, 'skincare')">
                <span class="cat-icon">✨</span>
                <h4>Skincare</h4>
            </div>
            <div class="cat-tab" onclick="filterCategory(this, 'elektronik')">
                <span class="cat-icon">📱</span>
                <h4>Elektronik</h4>
            </div>
            <div class="cat-tab" onclick="filterCategory(this, 'perhiasan')">
                <span class="cat-icon">💍</span>
                <h4>Perhiasan</h4>
            </div>
        </div>

        <div class="category-content reveal" style="margin-top: 40px;">
            <div id="pane-all" class="cat-pane active">
                <div class="cat-visual" style="background:linear-gradient(135deg,#333,#111);">🌟 All Photography Services</div>
                <div class="cat-text">
                    <h3>Foto Produk Profesional</h3>
                    <p>diver.ent (diver.ent) melayani segala jenis kebutuhan fotografi produk untuk berbagai industri. Dari foto katalog, lifestyle, hingga macro photography, kami siap membantu meningkatkan nilai jual brand Anda dengan visual yang menawan.</p>
                </div>
            </div>
            <div id="pane-makanan" class="cat-pane" style="display:none;">
                <div class="cat-visual" style="background:linear-gradient(135deg,#b91c1c,#450a0a);">🍕 Food Photography Mockup</div>
                <div class="cat-text">
                    <h3>Foto Produk Makanan</h3>
                    <p>diver.ent (diver.ent) dapat membantu bisnis kuliner menampilkan foto produk makanan terbaik kepada konsumen. Foto tersebut dibuat semenarik mungkin yang menggugah selera konsumen. Mulai dari detail makanan hingga keseluruhan hidangan direpresentasikan dengan ciamik.</p>
                </div>
            </div>
            <div id="pane-minuman" class="cat-pane" style="display:none;">
                <div class="cat-visual" style="background:linear-gradient(135deg,#0369a1,#0c4a6e);">🥤 Beverage Photography Mockup</div>
                <div class="cat-text">
                    <h3>Foto Produk Minuman</h3>
                    <p>Mendukung foto produk untuk minuman panas atau dingin maupun minuman dalam kemasan, agar memasarkan produk bisa lebih mudah dengan tampilan foto yang estetik dan menggugah selera.</p>
                </div>
            </div>
            <div id="pane-baju" class="cat-pane" style="display:none;">
                <div class="cat-visual" style="background:linear-gradient(135deg,#4338ca,#1e1b4b);">👗 Fashion Photography Mockup</div>
                <div class="cat-text">
                    <h3>Foto Produk Baju & Fashion</h3>
                    <p>Jasa foto produk pakaian seperti kaos, baju, kemeja, celana, tas, hingga aksesoris. Tersedia pilihan flatlay, ghost mannequin, maupun foto tematik dengan model untuk meningkatkan nilai jual brand fashion Anda.</p>
                </div>
            </div>
            <div id="pane-skincare" class="cat-pane" style="display:none;">
                <div class="cat-visual" style="background:linear-gradient(135deg,#065f46,#022c22);">✨ Skincare Photography Mockup</div>
                <div class="cat-text">
                    <h3>Foto Produk Skincare & Kosmetik</h3>
                    <p>Menonjolkan tekstur dan detail produk kecantikan Anda dengan pencahayaan studio yang sempurna. Sangat cocok untuk campaign produk baru maupun katalog e-commerce.</p>
                </div>
            </div>
            <div id="pane-elektronik" class="cat-pane" style="display:none;">
                <div class="cat-visual" style="background:linear-gradient(135deg,#333,#111);">📱 Electronic Photography Mockup</div>
                <div class="cat-text">
                    <h3>Foto Produk Elektronik & Gadget</h3>
                    <p>Fotografi produk yang clean, sharp, dan modern untuk menampilkan desain dan fitur terbaik dari produk elektronik, gadget, atau aksesori teknologi Anda.</p>
                </div>
            </div>
            <div id="pane-perhiasan" class="cat-pane" style="display:none;">
                <div class="cat-visual" style="background:linear-gradient(135deg,#92400e,#451a03);">💍 Jewelry Photography Mockup</div>
                <div class="cat-text">
                    <h3>Foto Produk Perhiasan</h3>
                    <p>Fotografi makro dengan tingkat presisi tinggi untuk memperlihatkan keindahan, kilauan, dan detail kerajinan dari produk perhiasan maupun aksesoris premium Anda.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Portfolio Our Latest Work --}}
<section class="fp-portfolio" id="fp-portfolio">
    <div class="container">
        <div class="reveal text-center">
            <span class="section-tag">Portfolio</span>
            <h2 class="section-title">Our Latest Work</h2>
            <p class="section-desc">Beberapa contoh hasil karya terbaik kami dalam membantu bisnis membuat foto produk yang profesional.</p>
        </div>
        <div class="portfolio-grid reveal" id="portfolio-grid">
            {{-- Makanan --}}
            <div class="portfolio-item port-item-makanan">
                <div class="port-img" style="background:linear-gradient(45deg,#b91c1c,#450a0a);">📷 Food Mockup 1</div>
                <div class="port-info">
                    <h4>Menu Restoran Spesial</h4>
                    <span>Food Photography</span>
                </div>
            </div>
            <div class="portfolio-item port-item-makanan">
                <div class="port-img" style="background:linear-gradient(45deg,#b91c1c,#450a0a);">📷 Food Mockup 2</div>
                <div class="port-info">
                    <h4>Katalog Snack Premium</h4>
                    <span>Food Photography</span>
                </div>
            </div>
            {{-- Minuman --}}
            <div class="portfolio-item port-item-minuman">
                <div class="port-img" style="background:linear-gradient(45deg,#0369a1,#0c4a6e);">📷 Beverage Mockup 1</div>
                <div class="port-info">
                    <h4>Kopi Susu Kekinian</h4>
                    <span>Beverage Photography</span>
                </div>
            </div>
            <div class="portfolio-item port-item-minuman">
                <div class="port-img" style="background:linear-gradient(45deg,#0369a1,#0c4a6e);">📷 Beverage Mockup 2</div>
                <div class="port-info">
                    <h4>Minuman Kaleng Fresh</h4>
                    <span>Beverage Photography</span>
                </div>
            </div>
            {{-- Baju --}}
            <div class="portfolio-item port-item-baju">
                <div class="port-img" style="background:linear-gradient(45deg,#4338ca,#1e1b4b);">📷 Fashion Mockup 1</div>
                <div class="port-info">
                    <h4>Lookbook Koleksi Hijab</h4>
                    <span>Fashion Photography</span>
                </div>
            </div>
            <div class="portfolio-item port-item-baju">
                <div class="port-img" style="background:linear-gradient(45deg,#4338ca,#1e1b4b);">📷 Fashion Mockup 2</div>
                <div class="port-info">
                    <h4>Katalog Kaos Distro</h4>
                    <span>Fashion Photography</span>
                </div>
            </div>
            {{-- Skincare --}}
            <div class="portfolio-item port-item-skincare">
                <div class="port-img" style="background:linear-gradient(45deg,#065f46,#022c22);">📷 Skincare Mockup 1</div>
                <div class="port-info">
                    <h4>Serum Wajah Glowing</h4>
                    <span>Beauty Photography</span>
                </div>
            </div>
            <div class="portfolio-item port-item-skincare">
                <div class="port-img" style="background:linear-gradient(45deg,#065f46,#022c22);">📷 Skincare Mockup 2</div>
                <div class="port-info">
                    <h4>Body Lotion Herbal</h4>
                    <span>Beauty Photography</span>
                </div>
            </div>
            {{-- Elektronik --}}
            <div class="portfolio-item port-item-elektronik">
                <div class="port-img" style="background:linear-gradient(45deg,#333,#111);">📷 Gadget Mockup 1</div>
                <div class="port-info">
                    <h4>TWS Earbuds Bluetooth</h4>
                    <span>Product Photography</span>
                </div>
            </div>
            <div class="portfolio-item port-item-elektronik">
                <div class="port-img" style="background:linear-gradient(45deg,#333,#111);">📷 Gadget Mockup 2</div>
                <div class="port-info">
                    <h4>Smartwatch Sport</h4>
                    <span>Product Photography</span>
                </div>
            </div>
            {{-- Perhiasan --}}
            <div class="portfolio-item port-item-perhiasan">
                <div class="port-img" style="background:linear-gradient(45deg,#92400e,#451a03);">📷 Jewelry Mockup 1</div>
                <div class="port-info">
                    <h4>Cincin Tunangan Emas</h4>
                    <span>Macro Photography</span>
                </div>
            </div>
            <div class="portfolio-item port-item-perhiasan">
                <div class="port-img" style="background:linear-gradient(45deg,#92400e,#451a03);">📷 Jewelry Mockup 2</div>
                <div class="port-info">
                    <h4>Kalung Berlian Elegan</h4>
                    <span>Macro Photography</span>
                </div>
            </div>
        </div>
        <div class="text-center reveal" style="margin-top:40px;">
            <a href="{{ route('portfolio') }}" class="btn-outline">Lihat Semua Portfolio</a>
        </div>
    </div>
</section>

<script>
    function filterCategory(element, category) {
        // Reset tabs
        document.querySelectorAll('.cat-tab').forEach(tab => tab.classList.remove('active'));
        element.classList.add('active');
        
        // Change category description pane
        document.querySelectorAll('.cat-pane').forEach(pane => pane.style.display = 'none');
        document.getElementById('pane-' + category).style.display = 'flex';
        
        // Filter portfolio items
        const items = document.querySelectorAll('.portfolio-item');
        items.forEach(item => {
            // Apply a simple fade animation for smooth transition
            item.style.opacity = '0';
            setTimeout(() => {
                if (category === 'all') {
                    item.style.display = 'block';
                    setTimeout(() => item.style.opacity = '1', 50);
                } else {
                    if (item.classList.contains('port-item-' + category)) {
                        item.style.display = 'block';
                        setTimeout(() => item.style.opacity = '1', 50);
                    } else {
                        item.style.display = 'none';
                    }
                }
            }, 300); // 300ms match css transition if any
        });
    }
</script>

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
