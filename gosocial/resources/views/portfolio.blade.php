@extends('layouts.app')

@section('content')

@include('partials.component.navbar')

{{-- Portfolio Hero --}}
<section class="portfolio-hero">
    <div class="container">
        <div class="reveal">
            <a href="/" class="back-link">← Kembali ke Home</a>
            <span class="section-tag">Portfolio</span>
            <h1 class="section-title" style="font-size:clamp(2.5rem,5vw,4rem);">Our Work</h1>
            <p class="section-desc">Koleksi lengkap hasil karya terbaik kami di berbagai industri dan platform digital.</p>
        </div>
    </div>
</section>

{{-- Portfolio Filter & Grid --}}
<section class="portfolio-full" style="padding-top:0;">
    <div class="container">
        <div class="portfolio-filters reveal">
            <button class="filter-btn active" data-filter="all">Semua</button>
            <button class="filter-btn" data-filter="social">Social Media</button>
            <button class="filter-btn" data-filter="web">Website & Apps</button>
            <button class="filter-btn" data-filter="ads">Digital Ads</button>
            <button class="filter-btn" data-filter="brand">Visual Branding</button>
            <button class="filter-btn" data-filter="video">Photo & Video</button>
            <button class="filter-btn" data-filter="seo">SEO</button>
        </div>

        <div class="portfolio-grid portfolio-grid-full reveal">
            @php
            $portfolioItems = [
                ['name' => 'Brand Campaign Wardah', 'cat' => 'social', 'label' => 'Social Media', 'desc' => 'Strategi konten Instagram & TikTok untuk meningkatkan brand awareness Wardah di kalangan Gen-Z. Engagement rate naik 320%.', 'color' => '#1a1a2e'],
                ['name' => 'E-Commerce Platform Tokopedia Seller', 'cat' => 'web', 'label' => 'Website Development', 'desc' => 'Pengembangan landing page e-commerce dengan UX modern, integrasi payment gateway, dan optimasi konversi.', 'color' => '#162032'],
                ['name' => 'Google Ads Kopi Kenangan', 'cat' => 'ads', 'label' => 'Digital Ads', 'desc' => 'Kampanye Google Ads & Meta Ads untuk meningkatkan app downloads dan store visits. ROAS 4.5x.', 'color' => '#1e1a2e'],
                ['name' => 'Rebranding Erigo Apparel', 'cat' => 'brand', 'label' => 'Visual Branding', 'desc' => 'Redesign identitas visual lengkap termasuk logo, brand guidelines, packaging, dan marketing collateral.', 'color' => '#1a2e1e'],
                ['name' => 'Product Video Shoot Skincare', 'cat' => 'video', 'label' => 'Video Production', 'desc' => 'Produksi video komersial 30 detik untuk kampanye digital dan TV commercial brand skincare lokal.', 'color' => '#2e1a1e'],
                ['name' => 'Social Media Management BCA', 'cat' => 'social', 'label' => 'Social Media', 'desc' => 'Manajemen akun Instagram, Twitter, & LinkedIn Bank BCA. Followers growth 150% dalam 6 bulan.', 'color' => '#1a2e2e'],
                ['name' => 'Company Profile Website Astra', 'cat' => 'web', 'label' => 'Website Development', 'desc' => 'Website company profile dengan animasi modern, multi-language support, dan integrasi CMS.', 'color' => '#221a2e'],
                ['name' => 'TikTok Ads Campaign F&B Brand', 'cat' => 'ads', 'label' => 'Digital Ads', 'desc' => 'Kampanye TikTok Ads dengan format Spark Ads & In-Feed Ads. CPM turun 60% vs benchmark industri.', 'color' => '#2e2a1a'],
                ['name' => 'Logo Design Tech Startup', 'cat' => 'brand', 'label' => 'Visual Branding', 'desc' => 'Desain logo minimalis modern untuk startup teknologi, termasuk brand book dan stationery design.', 'color' => '#1a1e2e'],
                ['name' => 'Foto Produk Fashion Catalogue', 'cat' => 'video', 'label' => 'Photography', 'desc' => 'Fotografi katalog produk fashion 200+ SKU dengan styling, lighting profesional, dan retouching.', 'color' => '#2e1a28'],
                ['name' => 'SEO Optimization PropertyPro', 'cat' => 'seo', 'label' => 'SEO', 'desc' => 'Optimasi on-page & off-page SEO untuk website properti. Traffic organik naik 400% dalam 8 bulan.', 'color' => '#1e2e1a'],
                ['name' => 'Instagram Reels Strategy Sociolla', 'cat' => 'social', 'label' => 'Social Media', 'desc' => 'Strategi konten Instagram Reels untuk beauty brand. Views rata-rata per Reel mencapai 500K+.', 'color' => '#2e1e1a'],
                ['name' => 'Mobile App Development EduTech', 'cat' => 'web', 'label' => 'Apps Development', 'desc' => 'Pengembangan aplikasi mobile iOS & Android untuk platform edukasi online dengan fitur live class.', 'color' => '#1a2a2e'],
                ['name' => 'Meta Ads Lead Generation Healthcare', 'cat' => 'ads', 'label' => 'Digital Ads', 'desc' => 'Kampanye lead generation di Facebook & Instagram untuk klinik kesehatan. Cost per lead turun 45%.', 'color' => '#2a1a2e'],
                ['name' => 'Packaging Design FMCG Brand', 'cat' => 'brand', 'label' => 'Visual Branding', 'desc' => 'Desain packaging produk FMCG untuk 15 varian produk dengan konsep premium dan eye-catching.', 'color' => '#1e2a1a'],
                ['name' => 'Commercial Photography Hotel', 'cat' => 'video', 'label' => 'Photography', 'desc' => 'Fotografi komersial interior & eksterior hotel bintang 5 untuk kebutuhan website dan marketing.', 'color' => '#2e201a'],
                ['name' => 'SEO & Content Marketing SaaS', 'cat' => 'seo', 'label' => 'SEO', 'desc' => 'Strategi SEO & content marketing untuk SaaS B2B. Ranking halaman 1 Google untuk 50+ keywords.', 'color' => '#1a2e20'],
                ['name' => 'KOL Campaign Beauty Brand', 'cat' => 'social', 'label' => 'Social Media', 'desc' => 'Kolaborasi dengan 25 KOL & micro-influencer untuk kampanye launch produk baru. Reach 5M+.', 'color' => '#201a2e'],
            ];
            @endphp
            @foreach($portfolioItems as $item)
            <div class="portfolio-item" data-category="{{ $item['cat'] }}">
                <div class="portfolio-thumb" style="background:linear-gradient(135deg, {{ $item['color'] }}, #0d0d1a);">
                    <span style="font-size:1.8rem;opacity:.15;">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                </div>
                <div class="overlay">
                    <span>{{ $item['label'] }}</span>
                    <h4>{{ $item['name'] }}</h4>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Portfolio Detail Cards --}}
        <div class="portfolio-details reveal" style="margin-top:64px;">
            <h2 class="section-title" style="font-size:1.8rem;margin-bottom:32px;">Project Highlights</h2>
            <div class="detail-grid">
                @foreach(array_slice($portfolioItems, 0, 6) as $item)
                <div class="detail-card reveal">
                    <div class="detail-thumb" style="background:linear-gradient(135deg, {{ $item['color'] }}, #0d0d1a);">
                        <span class="detail-label">{{ $item['label'] }}</span>
                    </div>
                    <div class="detail-content">
                        <h3>{{ $item['name'] }}</h3>
                        <p>{{ $item['desc'] }}</p>
                        <div class="detail-tags">
                            <span>{{ $item['label'] }}</span>
                            <span>2024</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="cta-bottom" id="cta-bottom">
    <div class="container reveal">
        <span class="section-tag">Tertarik?</span>
        <h2 class="section-title">Ingin Hasil Seperti Ini?</h2>
        <p class="section-desc">Konsultasikan kebutuhan digital marketing bisnis Anda dengan tim diver.ent sekarang.</p>
        <div class="hero-ctas">
            <a href="https://wa.me/6281234567890?text=Halo%20diver.ent%2C%20saya%20tertarik%20dengan%20portfolio%20kalian" target="_blank" class="btn-primary">Konsultasi Gratis →</a>
            <a href="/" class="btn-outline">Kembali ke Home</a>
        </div>
    </div>
</section>

{{-- Footer --}}
<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-about">
                <h4>diver.ent</h4>
                <p>Digital marketing agency terpercaya di Surabaya. Kami membantu bisnis tumbuh melalui strategi digital yang terukur dan kreatif.</p>
                <div class="footer-badges">
                    <span class="footer-badge">Google Ads Certified</span>
                    <span class="footer-badge">Meta Certified</span>
                    <span class="footer-badge">PSE Kominfo</span>
                </div>
            </div>
            <div>
                <h4>Company</h4>
                <a href="/#about">About Us</a>
                <a href="/portfolio">Portfolio</a>
                <a href="/#services">Services</a>
            </div>
            <div>
                <h4>Top Services</h4>
                <a href="/#services">Social Media Management</a>
                <a href="/#services">Digital Ads</a>
                <a href="/#services">Website Development</a>
            </div>
            <div>
                <h4>Contact</h4>
                <a href="https://wa.me/6281234567890" target="_blank">📱 +62 812-3456-7890</a>
                <a href="mailto:hello@diverent.co.id">✉️ hello@diverent.co.id</a>
                <p style="margin-top:8px;">📍 Surabaya, Jawa Timur</p>
            </div>
        </div>
        <div class="footer-bottom">
            <span>© {{ date('Y') }} diver.ent. All rights reserved.</span>
            <div class="social-links">
                <a href="#" aria-label="Instagram">IG</a>
                <a href="#" aria-label="Facebook">FB</a>
                <a href="#" aria-label="YouTube">YT</a>
                <a href="#" aria-label="LinkedIn">LI</a>
            </div>
        </div>
    </div>
</footer>

{{-- WhatsApp Float --}}
<div class="wa-float" id="wa-float" aria-label="Chat via WhatsApp" onclick="window.open('https://wa.me/6281234567890','_blank')">💬</div>

@include('partials.component.modals')

@endsection
