@extends('layouts.app')

@section('content')

@include('partials.component.announcement')
@include('partials.component.navbar')

{{-- Hero Section --}}
<section class="smm-hero" id="fp-hero">
    <div class="container">
        <div class="smm-hero-content reveal">
            <nav class="breadcrumb-nav" aria-label="breadcrumb">
                <a href="/">Home</a>
                <span class="separator">/</span>
                <a href="/#services">Services</a>
                <span class="separator">/</span>
                <span class="active">Fotografi</span>
            </nav>
            <span class="hero-tag">#1 Product Photography</span>
            <h1>Jasa <span class="highlight">Fotografi</span> Profesional</h1>
            <p>Layanan fotografi terlengkap mulai dari katalog, makanan, minuman, fashion, dan lainnya. Didukung peralatan studio profesional untuk keperluan promosi bisnis Anda.</p>
            <div class="hero-ctas">
                <a href="#fp-types" class="btn-primary">Jenis Fotografi →</a>
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
</section>

{{-- Why Product Photography --}}
<section class="smm-features" id="fp-why">
    <div class="container">
        <div class="smm-features-grid">
            <div class="smm-features-text reveal">
                <span class="section-tag">Jasa Fotografi #1</span>
                <h2 class="section-title">Fotografi Profesional untuk Branding Bisnis</h2>
                <p class="section-desc">Visual yang profesional membangun kepercayaan, meningkatkan minat beli, dan membuat produk Anda lebih menonjol di pasar digital.</p>
                <div class="smm-checklist">
                    <div class="check-item">
                        <span class="check-icon">✓</span>
                        <p><strong>75% pembeli e-commerce</strong> menganggap foto produk sangat memengaruhi keputusan pembelian.</p>
                    </div>
                    <div class="check-item">
                        <span class="check-icon">✓</span>
                        <p>Foto profesional adalah <strong>representasi kualitas dan nilai</strong> dari brand terbaik Anda.</p>
                    </div>
                    <div class="check-item">
                        <span class="check-icon">✓</span>
                        <p>Tanpa visual yang kuat, <strong>produk terbaik pun bisa terabaikan</strong> oleh calon pembeli.</p>
                    </div>
                </div>
                <div class="hero-ctas" style="margin-top:32px;">
                    <a href="#fp-types" class="btn-primary">Jenis Fotografi</a>
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
                                    <i class="fas fa-box-open fp-show-stat"></i>
                                </div>
                                <div class="fp-show-item" style="background:linear-gradient(135deg,#b91c1c,#450a0a);">
                                    <span class="fp-show-label">Makanan</span>
                                    <i class="fas fa-utensils fp-show-stat"></i>
                                </div>
                                <div class="fp-show-item" style="background:linear-gradient(135deg,#0369a1,#0c4a6e);">
                                    <span class="fp-show-label">Minuman</span>
                                    <i class="fas fa-mug-hot fp-show-stat"></i>
                                </div>
                                <div class="fp-show-item" style="background:linear-gradient(135deg,#4338ca,#1e1b4b);">
                                    <span class="fp-show-label">Fashion</span>
                                    <i class="fas fa-tshirt fp-show-stat"></i>
                                </div>
                                <div class="fp-show-item" style="background:linear-gradient(135deg,#065f46,#022c22);">
                                    <span class="fp-show-label">Skincare</span>
                                    <i class="fas fa-spa fp-show-stat"></i>
                                </div>
                                <div class="fp-show-item" style="background:linear-gradient(135deg,#92400e,#451a03);">
                                    <span class="fp-show-label">Lifestyle</span>
                                    <i class="fas fa-camera fp-show-stat"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Types of Photography --}}
<section class="smm-platforms" id="fp-types">
    <div class="container">
        <div class="reveal text-center">
            <span class="section-tag">Jenis Layanan</span>
            <h2 class="section-title">Tipe Fotografi</h2>
            <p class="section-desc">Berbagai jenis fotografi profesional sesuai kebutuhan bisnis Anda.</p>
        </div>
        <div class="platform-grid reveal">
            @php
            $photoTypes = [
                ['icon' => 'fas fa-box-open', 'name' => 'Foto Katalog', 'badge' => 'Best Seller', 'bclass' => 'badge-top', 'desc' => 'Foto produk clean dan profesional untuk katalog online, e-commerce, dan marketplace.'],
                ['icon' => 'fas fa-utensils', 'name' => 'Foto Makanan', 'badge' => 'Popular', 'bclass' => 'badge-trending', 'desc' => 'Food photography yang menggugah selera untuk menu restoran, promosi, dan sosial media.'],
                ['icon' => 'fas fa-mug-hot', 'name' => 'Foto Minuman', 'badge' => '', 'bclass' => '', 'desc' => 'Beverage photography yang segar dan menarik untuk branding dan marketing produk minuman.'],
                ['icon' => 'fas fa-tshirt', 'name' => 'Foto Fashion', 'badge' => 'Top Choice', 'bclass' => 'badge-best', 'desc' => 'Foto pakaian flatlay atau model untuk katalog fashion, e-commerce, dan lookbook brand.'],
                ['icon' => 'fas fa-spa', 'name' => 'Foto Skincare & Beauty', 'badge' => '', 'bclass' => '', 'desc' => 'Foto produk kecantikan dengan lighting studio profesional yang menonjolkan detail dan tekstur.'],
                ['icon' => 'fas fa-camera-retro', 'name' => 'Foto Lifestyle', 'badge' => '', 'bclass' => '', 'desc' => 'Foto produk dengan styling lifestyle dan properti untuk konten sosial media dan iklan digital.'],
            ];
            @endphp
            @foreach($photoTypes as $type)
            <div class="platform-card">
                @if($type['badge'])
                <span class="service-badge {{ $type['bclass'] }}">{{ $type['badge'] }}</span>
                @endif
                <div class="platform-icon-wrapper">
                    <i class="{{ $type['icon'] }} platform-icon"></i>
                </div>
                <h3>{{ $type['name'] }}</h3>
                <p>{{ $type['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Paket & Harga Jasa Fotografi --}}
<section class="fp-pricing" id="fp-pricing">
    <div class="container">
        <div class="reveal text-center">
            <span class="section-tag">Pricing Plans</span>
            <h2 class="section-title">Paket & Harga Jasa Fotografi</h2>
            <p class="section-desc">Pilih paket layanan fotografi yang paling sesuai dengan kebutuhan dan budget bisnis Anda.</p>
        </div>
        <div class="pricing-grid reveal">
            <div class="pricing-card">
                <div class="pricing-header">
                    <h3>Foto Catalog</h3>
                    <div class="price">
                        <span class="currency">Rp</span>
                        <span class="amount">35</span>
                        <span class="period">.000</span>
                    </div>
                    <p class="price-note">Mulai dari</p>
                    <span class="pricing-desc">Latar belakang polos, cocok untuk e-commerce.</span>
                </div>
                <div class="pricing-body">
                    <ul>
                        <li><i class="fas fa-check check"></i> 1 Editing Foto</li>
                        <li><i class="fas fa-check check"></i> Basic Treatment</li>
                        <li><i class="fas fa-check check"></i> Free Penyimpanan</li>
                        <li><i class="fas fa-check check"></i> Studio Equipment</li>
                    </ul>
                </div>
                <div class="pricing-footer">
                    <a href="#" class="btn-outline">Pilih Paket</a>
                </div>
            </div>

            <div class="pricing-card popular">
                <div class="popular-badge">Populer</div>
                <div class="pricing-header">
                    <h3>Foto Creative</h3>
                    <div class="price">
                        <span class="currency">Rp</span>
                        <span class="amount">70</span>
                        <span class="period">.000</span>
                    </div>
                    <p class="price-note">Mulai dari</p>
                    <span class="pricing-desc">Konsep, tema, dan properti pendukung.</span>
                </div>
                <div class="pricing-body">
                    <ul>
                        <li><i class="fas fa-check check"></i> 2 Editing Foto</li>
                        <li><i class="fas fa-check check"></i> Free Styling</li>
                        <li><i class="fas fa-check check"></i> Free Penyimpanan</li>
                        <li><i class="fas fa-check check"></i> Studio Equipment</li>
                    </ul>
                </div>
                <div class="pricing-footer">
                    <a href="#" class="btn-primary">Pilih Paket</a>
                </div>
            </div>

            <div class="pricing-card">
                <div class="pricing-header">
                    <h3>Foto FnB</h3>
                    <div class="price">
                        <span class="currency">Rp</span>
                        <span class="amount">100</span>
                        <span class="period">.000</span>
                    </div>
                    <p class="price-note">Mulai dari</p>
                    <span class="pricing-desc">Styling khusus makanan/minuman.</span>
                </div>
                <div class="pricing-body">
                    <ul>
                        <li><i class="fas fa-check check"></i> 2 Editing Foto</li>
                        <li><i class="fas fa-check check"></i> Food Styling</li>
                        <li><i class="fas fa-check check"></i> Free Penyimpanan</li>
                        <li><i class="fas fa-check check"></i> Studio Equipment</li>
                    </ul>
                </div>
                <div class="pricing-footer">
                    <a href="#" class="btn-outline">Pilih Paket</a>
                </div>
            </div>

            <div class="pricing-card">
                <div class="pricing-header">
                    <h3>Foto Model</h3>
                    <div class="price">
                        <span class="currency">Rp</span>
                        <span class="amount">250</span>
                        <span class="period">.000</span>
                    </div>
                    <p class="price-note">Mulai dari</p>
                    <span class="pricing-desc">Pilihan model dan styling khusus.</span>
                </div>
                <div class="pricing-body">
                    <ul>
                        <li><i class="fas fa-check check"></i> Up to 5 Foto</li>
                        <li><i class="fas fa-check check"></i> Model & MUA</li>
                        <li><i class="fas fa-check check"></i> Free Penyimpanan</li>
                        <li><i class="fas fa-check check"></i> Studio Equipment</li>
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
            <h2 class="section-title">Kategori Fotografi yang Didukung</h2>
            <p class="section-desc">Pilih kategori layanan fotografi yang kami dukung untuk berbagai jenis industri Anda.</p>
        </div>
        <div class="category-tabs reveal">
            <div class="cat-tab active" onclick="filterCategory(this, 'all')">
                <i class="fas fa-star cat-icon"></i>
                <h4>Semua</h4>
            </div>
            <div class="cat-tab" onclick="filterCategory(this, 'makanan')">
                <i class="fas fa-utensils cat-icon"></i>
                <h4>Makanan</h4>
            </div>
            <div class="cat-tab" onclick="filterCategory(this, 'minuman')">
                <i class="fas fa-mug-hot cat-icon"></i>
                <h4>Minuman</h4>
            </div>
            <div class="cat-tab" onclick="filterCategory(this, 'baju')">
                <i class="fas fa-tshirt cat-icon"></i>
                <h4>Fashion</h4>
            </div>
            <div class="cat-tab" onclick="filterCategory(this, 'skincare')">
                <i class="fas fa-spa cat-icon"></i>
                <h4>Skincare</h4>
            </div>
            <div class="cat-tab" onclick="filterCategory(this, 'elektronik')">
                <i class="fas fa-mobile-alt cat-icon"></i>
                <h4>Elektronik</h4>
            </div>
            <div class="cat-tab" onclick="filterCategory(this, 'perhiasan')">
                <i class="fas fa-gem cat-icon"></i>
                <h4>Perhiasan</h4>
            </div>
        </div>

        <div class="category-content reveal">
            <div id="pane-all" class="cat-pane active">
                <div class="cat-visual" style="background:linear-gradient(135deg,#2d1b69,#11001c);">
                    <i class="fas fa-camera"></i>
                    <span>All Services</span>
                </div>
                <div class="cat-text">
                    <h3>Fotografi Profesional</h3>
                    <p>diver.ent melayani segala jenis kebutuhan fotografi untuk berbagai industri. Dari foto katalog, lifestyle, hingga macro photography, kami siap membantu meningkatkan nilai jual brand Anda dengan visual yang menawan.</p>
                </div>
            </div>
            <div id="pane-makanan" class="cat-pane" style="display:none;">
                <div class="cat-visual" style="background:linear-gradient(135deg,#b91c1c,#450a0a);">
                    <i class="fas fa-utensils"></i>
                    <span>Food Photography</span>
                </div>
                <div class="cat-text">
                    <h3>Fotografi Makanan</h3>
                    <p>diver.ent dapat membantu bisnis kuliner menampilkan foto makanan terbaik kepada konsumen. Foto tersebut dibuat semenarik mungkin yang menggugah selera konsumen.</p>
                </div>
            </div>
            <div id="pane-minuman" class="cat-pane" style="display:none;">
                <div class="cat-visual" style="background:linear-gradient(135deg,#0369a1,#0c4a6e);">
                    <i class="fas fa-mug-hot"></i>
                    <span>Beverage</span>
                </div>
                <div class="cat-text">
                    <h3>Fotografi Minuman</h3>
                    <p>Mendukung foto untuk minuman panas atau dingin maupun minuman dalam kemasan, agar memasarkan produk bisa lebih mudah dengan tampilan foto yang estetik dan menggugah selera.</p>
                </div>
            </div>
            <div id="pane-baju" class="cat-pane" style="display:none;">
                <div class="cat-visual" style="background:linear-gradient(135deg,#4338ca,#1e1b4b);">
                    <i class="fas fa-tshirt"></i>
                    <span>Fashion</span>
                </div>
                <div class="cat-text">
                    <h3>Fotografi Fashion</h3>
                    <p>Jasa foto produk pakaian seperti kaos, baju, kemeja, celana, tas, hingga aksesoris. Tersedia pilihan flatlay, ghost mannequin, maupun foto tematik dengan model.</p>
                </div>
            </div>
            <div id="pane-skincare" class="cat-pane" style="display:none;">
                <div class="cat-visual" style="background:linear-gradient(135deg,#065f46,#022c22);">
                    <i class="fas fa-spa"></i>
                    <span>Skincare</span>
                </div>
                <div class="cat-text">
                    <h3>Fotografi Skincare & Kosmetik</h3>
                    <p>Menonjolkan tekstur dan detail produk kecantikan Anda dengan pencahayaan studio yang sempurna. Sangat cocok untuk campaign produk baru maupun katalog e-commerce.</p>
                </div>
            </div>
            <div id="pane-elektronik" class="cat-pane" style="display:none;">
                <div class="cat-visual" style="background:linear-gradient(135deg,#1e293b,#0f172a);">
                    <i class="fas fa-mobile-alt"></i>
                    <span>Electronics</span>
                </div>
                <div class="cat-text">
                    <h3>Fotografi Elektronik & Gadget</h3>
                    <p>Fotografi yang clean, sharp, dan modern untuk menampilkan desain dan fitur terbaik dari produk elektronik, gadget, atau aksesori teknologi Anda.</p>
                </div>
            </div>
            <div id="pane-perhiasan" class="cat-pane" style="display:none;">
                <div class="cat-visual" style="background:linear-gradient(135deg,#92400e,#451a03);">
                    <i class="fas fa-gem"></i>
                    <span>Jewelry</span>
                </div>
                <div class="cat-text">
                    <h3>Fotografi Perhiasan</h3>
                    <p>Fotografi makro dengan tingkat presisi tinggi untuk memperlihatkan keindahan, kilauan, dan detail kerajinan dari produk perhiasan maupun aksesoris premium Anda.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Portfolio --}}
<section class="fp-portfolio" id="fp-portfolio">
    <div class="container">
        <div class="reveal text-center">
            <span class="section-tag">Portfolio</span>
            <h2 class="section-title">Our Latest Work</h2>
            <p class="section-desc">Beberapa contoh hasil karya terbaik kami dalam membantu bisnis Anda.</p>
        </div>
        <div class="portfolio-grid reveal" id="portfolio-grid">
            <div class="portfolio-item port-item-makanan">
                <div class="port-img" style="background:linear-gradient(135deg,#b91c1c,#7f1d1d);">
                    <i class="fas fa-utensils"></i>
                </div>
                <div class="port-info">
                    <h4>Menu Restoran Spesial</h4>
                    <span>Food Photography</span>
                </div>
            </div>
            <div class="portfolio-item port-item-makanan">
                <div class="port-img" style="background:linear-gradient(135deg,#b91c1c,#7f1d1d);">
                    <i class="fas fa-pizza-slice"></i>
                </div>
                <div class="port-info">
                    <h4>Katalog Snack Premium</h4>
                    <span>Food Photography</span>
                </div>
            </div>
            <div class="portfolio-item port-item-minuman">
                <div class="port-img" style="background:linear-gradient(135deg,#0369a1,#075985);">
                    <i class="fas fa-mug-hot"></i>
                </div>
                <div class="port-info">
                    <h4>Kopi Susu Kekinian</h4>
                    <span>Beverage</span>
                </div>
            </div>
            <div class="portfolio-item port-item-minuman">
                <div class="port-img" style="background:linear-gradient(135deg,#0369a1,#075985);">
                    <i class="fas fa-wine-bottle"></i>
                </div>
                <div class="port-info">
                    <h4>Minuman Kaleng Fresh</h4>
                    <span>Beverage</span>
                </div>
            </div>
            <div class="portfolio-item port-item-baju">
                <div class="port-img" style="background:linear-gradient(135deg,#4338ca,#3730a3);">
                    <i class="fas fa-tshirt"></i>
                </div>
                <div class="port-info">
                    <h4>Lookbook Hijab</h4>
                    <span>Fashion</span>
                </div>
            </div>
            <div class="portfolio-item port-item-baju">
                <div class="port-img" style="background:linear-gradient(135deg,#4338ca,#3730a3);">
                    <i class="fas fa-shoe-prints"></i>
                </div>
                <div class="port-info">
                    <h4>Katalog Kaos Distro</h4>
                    <span>Fashion</span>
                </div>
            </div>
            <div class="portfolio-item port-item-skincare">
                <div class="port-img" style="background:linear-gradient(135deg,#065f46,#064e3b);">
                    <i class="fas fa-spa"></i>
                </div>
                <div class="port-info">
                    <h4>Serum Wajah</h4>
                    <span>Beauty</span>
                </div>
            </div>
            <div class="portfolio-item port-item-skincare">
                <div class="port-img" style="background:linear-gradient(135deg,#065f46,#064e3b);">
                    <i class="fas fa-leaf"></i>
                </div>
                <div class="port-info">
                    <h4>Body Lotion</h4>
                    <span>Beauty</span>
                </div>
            </div>
            <div class="portfolio-item port-item-elektronik">
                <div class="port-img" style="background:linear-gradient(135deg,#1e293b,#0f172a);">
                    <i class="fas fa-headphones"></i>
                </div>
                <div class="port-info">
                    <h4>TWS Earbuds</h4>
                    <span>Product</span>
                </div>
            </div>
            <div class="portfolio-item port-item-elektronik">
                <div class="port-img" style="background:linear-gradient(135deg,#1e293b,#0f172a);">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="port-info">
                    <h4>Smartwatch</h4>
                    <span>Product</span>
                </div>
            </div>
            <div class="portfolio-item port-item-perhiasan">
                <div class="port-img" style="background:linear-gradient(135deg,#92400e,#78350f);">
                    <i class="fas fa-gem"></i>
                </div>
                <div class="port-info">
                    <h4>Cincin Tunangan</h4>
                    <span>Macro</span>
                </div>
            </div>
            <div class="portfolio-item port-item-perhiasan">
                <div class="port-img" style="background:linear-gradient(135deg,#92400e,#78350f);">
                    <i class="fas fa-ring"></i>
                </div>
                <div class="port-info">
                    <h4>Kalung Berlian</h4>
                    <span>Macro</span>
                </div>
            </div>
        </div>
        <div class="text-center reveal" style="margin-top:40px;">
            <a href="{{ route('portfolio') }}" class="btn-outline">Lihat Semua Portfolio →</a>
        </div>
    </div>
</section>

<script>
    function filterCategory(element, category) {
        document.querySelectorAll('.cat-tab').forEach(tab => tab.classList.remove('active'));
        element.classList.add('active');
        
        document.querySelectorAll('.cat-pane').forEach(pane => pane.style.display = 'none');
        const activePane = document.getElementById('pane-' + category);
        if(activePane) activePane.style.display = 'flex';
        
        const items = document.querySelectorAll('.portfolio-item');
        items.forEach(item => {
            if (category === 'all') {
                item.style.display = 'block';
            } else {
                if (item.classList.contains('port-item-' + category)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            }
        });
    }
</script>

{{-- Process --}}
<section class="fp-process-section" id="fp-process">
    <div class="container">
        <div class="reveal text-center">
            <span class="section-tag">Our Process</span>
            <h2 class="section-title">Proses Fotografi</h2>
            <p class="section-desc">Alur kerja yang mudah dan transparan.</p>
        </div>
        <div class="fp-process-flow reveal">
            @php
            $steps = [
                ['num' => '1', 'icon' => 'fas fa-box', 'title' => 'Pilih Paket', 'desc' => 'Tentukan paket foto yang sesuai'],
                ['num' => '2', 'icon' => 'fas fa-file-alt', 'title' => 'Kirim Brief', 'desc' => 'Jelaskan detail kebutuhan'],
                ['num' => '3', 'icon' => 'fas fa-truck', 'title' => 'Kirim Produk', 'desc' => 'Kirim produk ke studio'],
                ['num' => '4', 'icon' => 'fas fa-camera', 'title' => 'Proses Foto', 'desc' => 'Pemotretan profesional'],
                ['num' => '5', 'icon' => 'fas fa-images', 'title' => 'Terima Hasil', 'desc' => 'File HD dikirim'],
                ['num' => '6', 'icon' => 'fas fa-undo-alt', 'title' => 'Return', 'desc' => 'Produk dikembalikan'],
            ];
            @endphp
            @foreach($steps as $index => $step)
            <div class="fp-step-card">
                <div class="fp-step-num">{{ $step['num'] }}</div>
                <div class="fp-step-icon-wrapper">
                    <i class="{{ $step['icon'] }} fp-step-icon"></i>
                </div>
                <h4>{{ $step['title'] }}</h4>
                <p>{{ $step['desc'] }}</p>
            </div>
            @if($index < count($steps) - 1)
            <div class="fp-step-arrow"><i class="fas fa-arrow-right"></i></div>
            @endif
            @endforeach
        </div>
    </div>
</section>

{{-- Benefits --}}
<section class="smm-why" id="fp-benefits">
    <div class="container">
        <div class="reveal text-center">
            <span class="section-tag">Features & Benefits</span>
            <h2 class="section-title">Keuntungan Fotografi di <span class="highlight">diver.ent</span></h2>
        </div>
        <div class="why-grid reveal">
            @php
            $benefits = [
                ['icon' => 'fas fa-camera', 'title' => 'Peralatan Profesional', 'desc' => 'Kamera DSLR/mirrorless, lighting studio, dan setup profesional untuk hasil maksimal.'],
                ['icon' => 'fas fa-palette', 'title' => 'Konsep Kreatif', 'desc' => 'Tim kreatif membantu merancang konsep visual yang sesuai dengan identitas brand Anda.'],
                ['icon' => 'fas fa-bolt', 'title' => 'Proses Cepat', 'desc' => 'Hasil foto dikirimkan dalam 3-5 hari kerja. Tersedia opsi express untuk kebutuhan mendesak.'],
                ['icon' => 'fas fa-download', 'title' => 'Free All Files', 'desc' => 'Semua file foto diberikan dalam format HD, siap digunakan untuk media digital maupun cetak.'],
                ['icon' => 'fas fa-magic', 'title' => 'Editing Profesional', 'desc' => 'Color correction, retouching, dan background removal untuk hasil yang sempurna.'],
                ['icon' => 'fas fa-tag', 'title' => 'Harga Kompetitif', 'desc' => 'Paket harga yang fleksibel dan terjangkau, mulai dari paket basic hingga premium.'],
            ];
            @endphp
            @foreach($benefits as $item)
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

{{-- Trusted Clients --}}


{{-- FAQ --}}
<section class="dc-faq" id="fp-faq">
    <div class="container">
        <div class="reveal text-center">
            <span class="section-tag">FAQ</span>
            <h2 class="section-title">Pertanyaan Umum</h2>
        </div>
        <div class="faq-grid reveal">
            @php
            $faqs = [
                ['q' => 'Berapa lama proses foto selesai?', 'a' => 'Proses pemotretan dan editing biasanya memakan waktu 3-5 hari kerja. Tersedia opsi express untuk kebutuhan yang lebih cepat.'],
                ['q' => 'Apakah produk harus dikirim ke studio?', 'a' => 'Ya, produk dapat dikirimkan ke studio kami. Untuk produk dalam jumlah banyak atau berukuran besar, kami juga bisa datang ke lokasi Anda.'],
                ['q' => 'Format file apa yang diberikan?', 'a' => 'Semua hasil foto diberikan dalam format JPEG/PNG resolusi tinggi (HD). Format RAW tersedia atas permintaan khusus.'],
                ['q' => 'Apakah ada minimum order?', 'a' => 'Tidak ada minimum order. Anda bisa memesan mulai dari 1 produk. Tersedia paket bundling dengan harga lebih hemat.'],
                ['q' => 'Bagaimana jika hasil foto tidak sesuai?', 'a' => 'Kami menyediakan revisi gratis untuk memastikan hasil foto sesuai dengan ekspektasi. Koordinasi dilakukan secara transparan.'],
                ['q' => 'Apakah bisa foto dengan model?', 'a' => 'Ya, kami menyediakan paket foto dengan model profesional. Biaya model dikenakan terpisah sesuai kebutuhan.'],
            ];
            @endphp
            @foreach($faqs as $index => $faq)
            <div class="faq-item">
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
    <div class="container reveal text-center">
        <span class="section-tag">Mulai Sekarang</span>
        <h2 class="section-title">Butuh Jasa Fotografi?</h2>
        <p class="section-desc">Konsultasikan kebutuhan fotografi bisnis Anda dengan tim profesional diver.ent. Gratis, tanpa komitmen.</p>
        <div class="hero-ctas" style="justify-content: center;">
            <a href="https://wa.me/6281234567890?text=Halo%20diver.ent%2C%20saya%20ingin%20konsultasi%20Fotografi" target="_blank" class="btn-primary">Konsultasi Gratis →</a>
            <a href="{{ route('portfolio') }}" class="btn-outline">Lihat Portfolio</a>
        </div>
    </div>
</section>

@include('partials.component.footer')
@include('partials.component.modals')

@endsection