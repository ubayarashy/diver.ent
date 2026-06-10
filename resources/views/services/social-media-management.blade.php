@extends('layouts.app')
@section('content')
@include('partials.component.announcement')
@include('partials.component.navbar')
<style>
* { margin: 0; padding: 0; box-sizing: border-box; }
body { overflow-x: hidden; }
.container { width: 100%; max-width: 1440px; margin: 0 auto; padding: 0 48px; }
.smm-hero { padding: 100px 0 60px; background: var(--bg); position: relative; }
.hero-tag { display: inline-block; background: rgba(59,130,255,0.1); color: var(--accent); padding: 6px 14px; border-radius: 30px; font-size: 0.7rem; font-weight: 600; margin-bottom: 1.2rem; letter-spacing: 0.5px; }
.smm-hero h1 { font-size: 3rem; font-weight: 700; line-height: 1.2; margin-bottom: 1rem; font-family: var(--font-display); letter-spacing: -0.02em; }
.highlight { color: var(--accent); }
.smm-hero p { font-size: 1rem; color: var(--text-secondary); max-width: 550px; margin-bottom: 2rem; line-height: 1.6; }
.hero-ctas { display: flex; gap: 1rem; flex-wrap: wrap; }
.breadcrumb-nav { margin-bottom: 1.5rem; font-size: 0.8rem; color: var(--text-secondary); }
.breadcrumb-nav a { color: var(--text-secondary); text-decoration: none; transition: color 0.2s; }
.breadcrumb-nav a:hover { color: var(--accent); }
.breadcrumb-nav span { margin: 0 8px; }
.breadcrumb-nav .active { color: var(--accent); }
.smm-stats-bar { background: var(--surface); border-top: 1px solid var(--border); border-bottom: 1px solid var(--border); padding: 1rem 0; margin-bottom: 60px; width: 100%; }
.stats-row { display: flex; justify-content: center; align-items: center; gap: 2.5rem; flex-wrap: wrap; }
.stat-pill { font-size: 0.85rem; color: var(--text-secondary); }
.stat-pill strong { color: var(--accent); font-size: 1rem; font-weight: 700; }
.stat-divider { color: var(--border); opacity: 0.5; }
.smm-features-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: center; margin-bottom: 60px; }
.section-tag { display: inline-block; background: rgba(59,130,255,0.1); color: var(--accent); padding: 4px 12px; border-radius: 30px; font-size: 0.65rem; font-weight: 600; letter-spacing: 0.8px; margin-bottom: 1rem; text-transform: uppercase; }
.section-title { font-size: 2rem; font-weight: 700; margin-bottom: 1rem; font-family: var(--font-display); letter-spacing: -0.02em; line-height: 1.25; }
.section-desc { color: var(--text-secondary); margin-bottom: 1.5rem; line-height: 1.6; font-size: 0.95rem; }
.smm-checklist { display: flex; flex-direction: column; gap: 0.75rem; }
.check-item { display: flex; align-items: flex-start; gap: 10px; }
.check-icon { color: var(--accent); font-weight: bold; }
.smm-visual-card { background: var(--surface); border-radius: 24px; border: 1px solid var(--border); overflow: hidden; transition: transform 0.3s ease, box-shadow 0.3s ease; }
.smm-visual-card:hover { transform: translateY(-4px); box-shadow: 0 20px 35px -12px rgba(0,0,0,0.1); }
.visual-mockup { overflow: hidden; }
.mockup-header { background: var(--surface-alt); padding: 12px 16px; display: flex; gap: 8px; border-bottom: 1px solid var(--border); }
.dot { width: 10px; height: 10px; border-radius: 50%; }
.dot.red { background: #ff5f56; }
.dot.yellow { background: #ffbd2e; }
.dot.green { background: #27c93f; }
.mockup-body { padding: 28px; background: var(--surface); }
.mockup-stat-row { display: flex; gap: 24px; margin-bottom: 24px; }
.mockup-stat { flex: 1; }
.ms-label { font-size: 0.6rem; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 0.8px; font-weight: 500; }
.ms-value { display: block; font-size: 1.4rem; font-weight: 700; color: var(--accent); margin: 6px 0 10px; }
.ms-bar { background: var(--border); border-radius: 20px; height: 4px; overflow: hidden; }
.ms-fill { background: var(--accent); height: 100%; border-radius: 20px; }
.smm-platforms { padding: 60px 0; background: var(--surface); width: 100%; }
.platform-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 1.5rem; margin-top: 2rem; }
.platform-card { background: var(--bg); border-radius: 20px; padding: 2rem 1.8rem; transition: all 0.3s ease; border: 1px solid var(--border); position: relative; text-align: center; cursor: pointer; }
.platform-card:hover { transform: translateY(-5px); border-color: var(--accent); box-shadow: 0 12px 30px -10px rgba(0,0,0,0.08); }
.platform-icon { font-size: 2.5rem; margin-bottom: 1.2rem; display: inline-block; color: var(--accent); }
.platform-card h3 { font-size: 1.2rem; margin-bottom: 0.75rem; font-weight: 600; }
.platform-card p { color: var(--text-secondary); font-size: 0.85rem; line-height: 1.6; margin-bottom: 1rem; }
.platform-link { display: inline-block; color: var(--accent); font-size: 0.75rem; font-weight: 500; text-decoration: none; transition: opacity 0.2s; }
.platform-link:hover { opacity: 0.7; }
.service-badge { position: absolute; top: -10px; right: 20px; background: var(--accent); color: #000; font-size: 0.6rem; font-weight: 700; padding: 4px 14px; border-radius: 30px; text-transform: uppercase; letter-spacing: 0.5px; }
.smm-process { padding: 60px 0; background: var(--bg); width: 100%; }
.process-grid { display: flex; justify-content: center; align-items: stretch; flex-wrap: wrap; gap: 1rem; margin-top: 2rem; }
.process-card { background: var(--surface); border-radius: 20px; padding: 2rem; text-align: center; flex: 1; min-width: 240px; border: 1px solid var(--border); transition: all 0.3s ease; }
.process-card:hover { border-color: var(--accent); transform: translateY(-4px); }
.process-number { font-size: 2.2rem; font-weight: 800; color: var(--accent); opacity: 0.4; margin-bottom: 0.75rem; font-family: monospace; }
.process-card h3 { font-size: 1.1rem; margin-bottom: 0.75rem; font-weight: 600; }
.process-card p { color: var(--text-secondary); font-size: 0.85rem; line-height: 1.6; }
.process-connector { font-size: 1.2rem; color: var(--accent); display: flex; align-items: center; opacity: 0.4; }
.smm-why { padding: 60px 0; background: var(--surface); width: 100%; }
.why-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.8rem; margin-top: 2rem; }
.why-card { background: var(--bg); border-radius: 20px; padding: 2rem 1.8rem; transition: all 0.3s ease; border: 1px solid var(--border); text-align: center; cursor: pointer; }
.why-card:hover { transform: translateY(-5px); border-color: var(--accent); box-shadow: 0 12px 30px -10px rgba(0,0,0,0.08); }
.why-icon { font-size: 2.2rem; margin-bottom: 1rem; display: inline-block; color: var(--accent); }
.why-card h3 { font-size: 1.1rem; margin-bottom: 0.75rem; font-weight: 600; }
.why-card p { color: var(--text-secondary); font-size: 0.85rem; line-height: 1.6; }
.case-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.8rem; margin-top: 2rem; }
.case-card { background: var(--bg); border-radius: 20px; padding: 1.8rem; border: 1px solid var(--border); transition: all 0.3s ease; cursor: pointer; }
.case-card:hover { transform: translateY(-4px); border-color: var(--accent); box-shadow: 0 12px 30px -10px rgba(0,0,0,0.08); }
.case-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; flex-wrap: wrap; gap: 0.5rem; }
.case-client { font-weight: 700; font-size: 1rem; color: var(--accent); }
.case-result { font-weight: 600; font-size: 0.7rem; background: rgba(59,130,255,0.1); padding: 4px 12px; border-radius: 30px; color: var(--accent); text-transform: uppercase; }
.case-desc { color: var(--text-secondary); font-size: 0.85rem; line-height: 1.6; margin-bottom: 1.2rem; }
.case-metrics { display: flex; gap: 1rem; padding-top: 1rem; border-top: 1px solid var(--border); }
.case-metric { flex: 1; text-align: center; }
.cm-label { font-size: 0.6rem; color: var(--text-secondary); display: block; margin-bottom: 5px; text-transform: uppercase; letter-spacing: 0.5px; }
.cm-value { font-size: 1rem; font-weight: 700; color: var(--accent); }
.dc-faq { padding: 60px 0; background: var(--bg); width: 100%; }
.faq-grid { max-width: 800px; margin: 2rem auto 0; }
.faq-item { background: var(--surface); border-radius: 16px; margin-bottom: 1rem; border: 1px solid var(--border); overflow: hidden; transition: all 0.2s ease; }
.faq-item:hover { border-color: var(--accent); }
.faq-question { width: 100%; display: flex; justify-content: space-between; align-items: center; padding: 1.1rem 1.5rem; background: transparent; border: none; font-size: 0.9rem; font-weight: 600; cursor: pointer; color: var(--text); transition: color 0.2s; }
.faq-question:hover { color: var(--accent); }
.faq-toggle { font-size: 1.1rem; transition: transform 0.3s; }
.faq-item.open .faq-toggle { transform: rotate(45deg); }
.faq-answer { max-height: 0; overflow: hidden; transition: max-height 0.35s ease; padding: 0 1.5rem; }
.faq-item.open .faq-answer { max-height: 180px; padding: 0 1.5rem 1.2rem; }
.faq-answer p { color: var(--text-secondary); line-height: 1.65; font-size: 0.85rem; }
.cta-bottom { padding: 70px 0; text-align: center; background: linear-gradient(135deg, var(--surface), var(--bg)); width: 100%; border-top: 1px solid var(--border); }
.cta-bottom .section-title { max-width: 600px; margin-left: auto; margin-right: auto; }
.cta-bottom .section-desc { margin-left: auto; margin-right: auto; max-width: 500px; }
.btn-primary { background: var(--accent); color: #000; padding: 12px 32px; border-radius: 40px; font-weight: 600; font-size: 0.85rem; display: inline-flex; align-items: center; gap: 8px; text-decoration: none; transition: all 0.3s ease; border: none; cursor: pointer; }
.btn-primary:hover { transform: translateY(-2px); opacity: 0.9; box-shadow: 0 8px 20px rgba(59,130,255,0.2); }
.btn-outline { background: transparent; border: 1px solid var(--border); color: var(--text); padding: 12px 32px; border-radius: 40px; font-weight: 600; font-size: 0.85rem; display: inline-flex; align-items: center; gap: 8px; text-decoration: none; transition: all 0.3s ease; cursor: pointer; }
.btn-outline:hover { border-color: var(--accent); color: var(--accent); transform: translateY(-2px); }
@media (max-width: 1200px) { .why-grid, .case-grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 992px) { .smm-features-grid { grid-template-columns: 1fr; gap: 2rem; } .process-connector { display: none; } .process-grid { flex-direction: column; } .process-card { width: 100%; } .container { padding: 0 32px; } .why-grid, .case-grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 768px) { .smm-hero { padding: 80px 0 40px; } .smm-hero h1 { font-size: 2rem; } .section-title { font-size: 1.5rem; } .hero-ctas { flex-direction: column; align-items: stretch; } .btn-primary, .btn-outline { justify-content: center; } .stats-row { gap: 1rem; } .container { padding: 0 20px; } .why-grid, .case-grid { grid-template-columns: 1fr; } .platform-grid { grid-template-columns: 1fr; } }
.reveal { opacity: 0; transform: translateY(20px); transition: opacity 0.7s cubic-bezier(0.2, 0.9, 0.4, 1.1), transform 0.7s cubic-bezier(0.2, 0.9, 0.4, 1.1); }
.reveal.active { opacity: 1; transform: translateY(0); }
</style>
<section class="smm-hero"><div class="container"><div class="smm-hero-content reveal"><nav class="breadcrumb-nav"><a href="/">Home</a><span>/</span><a href="/#services">Services</a><span>/</span><span class="active">Social Media Management</span></nav><span class="hero-tag">Top Rated Service</span><h1>Jasa <span class="highlight">Social Media</span> Management</h1><p>Solusi lengkap pengelolaan media sosial untuk bisnis Anda. Mulai dari strategi, aktivasi, campaign, manajemen akun, admin, serta pelaporan secara profesional.</p><div class="hero-ctas"><a href="#smm-why" class="btn-primary">Mengapa diver.ent</a><a href="#smm-platforms" class="btn-outline">Lihat Platform</a></div></div></div></section>
<div class="smm-stats-bar"><div class="container"><div class="stats-row reveal"><div class="stat-pill"><strong>200+</strong> Projects</div><div class="stat-divider">•</div><div class="stat-pill"><strong>5+ Tahun</strong> Experience</div><div class="stat-divider">•</div><div class="stat-pill"><strong>Professional</strong> Team</div><div class="stat-divider">•</div><div class="stat-pill"><strong>Advanced</strong> Strategy</div></div></div></div>
<section class="smm-features"><div class="container"><div class="smm-features-grid"><div class="smm-features-text reveal"><span class="section-tag">Why Choose Us</span><h2 class="section-title">Partner Kelola <span class="highlight">Media Sosial</span> Bisnis Anda</h2><p class="section-desc">Maksimalkan potensi media sosial bisnis Anda. diver.ent menyediakan layanan pengelolaan media sosial yang profesional untuk mencapai target audiens dan meningkatkan konversi.</p><div class="smm-checklist"><div class="check-item"><span class="check-icon">—</span><p><strong>Strategi khusus</strong> berdasarkan analisis mendalam untuk memahami industri dan target audience klien.</p></div><div class="check-item"><span class="check-icon">—</span><p>Tampilan social media <strong>lebih menarik dan profesional</strong>, efektif meningkatkan branding dan kepercayaan audience.</p></div><div class="check-item"><span class="check-icon">—</span><p>Koordinasi melalui <strong>evaluasi rutin</strong> berbasis data dan tren terkini untuk pertumbuhan berkelanjutan.</p></div></div></div><div class="smm-features-visual reveal"><div class="smm-visual-card"><div class="visual-mockup"><div class="mockup-header"><span class="dot red"></span><span class="dot yellow"></span><span class="dot green"></span></div><div class="mockup-body"><div class="mockup-stat-row"><div class="mockup-stat"><span class="ms-label">Followers</span><span class="ms-value">+340%</span><div class="ms-bar"><div class="ms-fill" style="width:85%"></div></div></div><div class="mockup-stat"><span class="ms-label">Engagement</span><span class="ms-value">+520%</span><div class="ms-bar"><div class="ms-fill" style="width:95%"></div></div></div></div><div class="mockup-stat-row"><div class="mockup-stat"><span class="ms-label">Reach</span><span class="ms-value">+275%</span><div class="ms-bar"><div class="ms-fill" style="width:70%"></div></div></div><div class="mockup-stat"><span class="ms-label">Conversion</span><span class="ms-value">+180%</span><div class="ms-bar"><div class="ms-fill" style="width:60%"></div></div></div></div></div></div></div></div></div></div></section>
<section class="smm-platforms" id="smm-platforms"><div class="container"><div class="reveal"><span class="section-tag">Social Media Platforms</span><h2 class="section-title">Pilihan Platform Media Sosial</h2><p class="section-desc">Kami mengelola berbagai platform media sosial untuk memaksimalkan kehadiran digital bisnis Anda.</p></div><div class="platform-grid reveal">@php $platforms = [['icon' => 'fab fa-instagram', 'name' => 'Instagram', 'badge' => 'Best Seller', 'desc' => 'Kelola akun Instagram Anda secara profesional dan efektif. Dapatkan visibilitas yang maksimal.'],['icon' => 'fab fa-tiktok', 'name' => 'TikTok', 'badge' => 'Trending', 'desc' => 'Manfaatkan kekuatan TikTok yang trending untuk menjangkau generasi muda yang dinamis.'],['icon' => 'fab fa-youtube', 'name' => 'YouTube', 'badge' => 'Top Choice', 'desc' => 'Tingkatkan kehadiran di YouTube dengan konten video berkualitas tinggi yang relevan.'],['icon' => 'fab fa-facebook', 'name' => 'Facebook', 'badge' => '', 'desc' => 'Dominasi pasar Anda di Facebook dengan strategi pengelolaan sesuai tujuan bisnis.'],['icon' => 'fab fa-linkedin', 'name' => 'LinkedIn', 'badge' => '', 'desc' => 'Bangun profile perusahaan yang lebih profesional dan terpercaya dengan strategi terkini.'],['icon' => 'fab fa-twitter', 'name' => 'X (Twitter)', 'badge' => '', 'desc' => 'Bangun hubungan yang lebih dekat dengan pelanggan melalui pengelolaan khusus di X.']]; @endphp @foreach($platforms as $p)<div class="platform-card">@if($p['badge'])<span class="service-badge">{{ $p['badge'] }}</span>@endif<i class="{{ $p['icon'] }} platform-icon"></i><h3>Jasa Kelola {{ $p['name'] }}</h3><p>{{ $p['desc'] }}</p><a href="#" class="platform-link">Selengkapnya →</a></div>@endforeach</div></div></section>
<section class="smm-process"><div class="container"><div class="reveal"><span class="section-tag">How It Works</span><h2 class="section-title">Proses Kami</h2><p class="section-desc">Pendekatan sistematis yang terbukti menghasilkan pertumbuhan digital.</p></div><div class="process-grid reveal"><div class="process-card"><div class="process-number">01</div><h3>Analisis & Strategi</h3><p>Menyusun strategi efektif berdasarkan tujuan bisnis, target audiens, dan tren industri.</p></div><div class="process-connector">→</div><div class="process-card"><div class="process-number">02</div><h3>Manajemen Media Sosial</h3><p>Mengelola pembuatan konten kreatif, iklan, dan mengelola interaksi secara profesional.</p></div><div class="process-connector">→</div><div class="process-card"><div class="process-number">03</div><h3>Evaluasi & Optimalisasi</h3><p>Memberikan insight dengan koordinasi rutin, dan terus mengoptimalkan hasil.</p></div></div></div></section>
<section class="smm-why" id="smm-why"><div class="container"><div class="reveal"><span class="section-tag">Why Choose Us</span><h2 class="section-title">Dikelola Secara <span class="highlight">Profesional</span></h2><p class="section-desc">Kami memberikan layanan terbaik untuk media sosial bisnis Anda.</p></div><div class="why-grid reveal">@php $benefits = [['icon' => 'fas fa-palette', 'title' => 'Konten Up-to-Date', 'desc' => 'Konten dengan desain visual profesional dan trending yang disesuaikan dengan brand Anda.'],['icon' => 'fas fa-box', 'title' => 'Paket Lengkap', 'desc' => 'Kami mengelola semua mulai dari konten, ads, engagement, admin pada media sosial Anda.'],['icon' => 'fas fa-clock', 'title' => 'Hemat Waktu & Biaya', 'desc' => 'Fokus pada pengembangan bisnis inti Anda, serahkan pengelolaan media sosial kepada ahlinya.'],['icon' => 'fas fa-users', 'title' => 'Tim Profesional', 'desc' => 'Proyek Anda akan ditangani secara profesional oleh tim ahli yang berpengalaman di bidangnya.'],['icon' => 'fas fa-comments', 'title' => 'Komunikasi Rutin', 'desc' => 'Dengan timeline pekerjaan yang jelas, tim kami akan berkomunikasi secara rutin untuk koordinasi.'],['icon' => 'fas fa-chart-line', 'title' => 'Laporan & Optimisasi', 'desc' => 'Tidak hanya reporting yang transparan, namun kami juga memberikan strategi optimisasi.']]; @endphp @foreach($benefits as $b)<div class="why-card"><i class="{{ $b['icon'] }} why-icon"></i><h3>{{ $b['title'] }}</h3><p>{{ $b['desc'] }}</p></div>@endforeach</div></div></section>
<section class="smm-why"><div class="container"><div class="reveal"><span class="section-tag">Case Studies</span><h2 class="section-title">Hasil Nyata untuk Klien Kami</h2><p class="section-desc">Hasil yang kami berikan untuk kehadiran media sosial klien kami.</p></div><div class="case-grid reveal">@php $cases = [['client' => 'Fashion Brand', 'result' => '+340% Followers', 'desc' => 'Meningkatkan followers Instagram dari 2K menjadi 8.8K dalam 4 bulan dengan strategi konten yang konsisten dan campaign kreatif.', 'metric1' => 'Engagement Rate', 'val1' => '8.5%', 'metric2' => 'Reach Growth', 'val2' => '+520%'],['client' => 'F&B Restaurant', 'result' => '+275% Engagement', 'desc' => 'Meningkatkan engagement rate dari 1.2% menjadi 4.5% melalui konten interaktif dan strategi community management.', 'metric1' => 'Conversion', 'val1' => '+180%', 'metric2' => 'Brand Awareness', 'val2' => '+300%'],['client' => 'Healthcare Clinic', 'result' => '+450% Reach', 'desc' => 'Meningkatkan jangkauan konten dari 5K menjadi 27.5K per bulan dengan strategi hashtag dan konten edukatif.', 'metric1' => 'New Patients', 'val1' => '+65%', 'metric2' => 'Trust Score', 'val2' => '9.2/10']]; @endphp @foreach($cases as $c)<div class="case-card"><div class="case-header"><span class="case-client">{{ $c['client'] }}</span><span class="case-result">{{ $c['result'] }}</span></div><p class="case-desc">{{ $c['desc'] }}</p><div class="case-metrics"><div class="case-metric"><span class="cm-label">{{ $c['metric1'] }}</span><span class="cm-value">{{ $c['val1'] }}</span></div><div class="case-metric"><span class="cm-label">{{ $c['metric2'] }}</span><span class="cm-value">{{ $c['val2'] }}</span></div></div></div>@endforeach</div></div></section>
<section class="dc-faq" id="smm-faq"><div class="container"><div class="reveal"><span class="section-tag">FAQ</span><h2 class="section-title">Pertanyaan Umum</h2><p class="section-desc">Informasi yang sering ditanyakan tentang layanan social media management.</p></div><div class="faq-grid reveal">@php $faqs = [['q' => 'Apa saja yang termasuk dalam layanan Social Media Management?', 'a' => 'Layanan mencakup strategi konten, pembuatan konten, penjadwalan posting, engagement dengan audiens, laporan performa bulanan, dan optimasi berkelanjutan.'],['q' => 'Berapa kali posting dalam seminggu?', 'a' => 'Frekuensi posting dapat disesuaikan dengan kebutuhan dan budget. Paket standar biasanya 3-5 posting per minggu.'],['q' => 'Apakah termasuk pembuatan konten video?', 'a' => 'Ya, paket kami sudah termasuk pembuatan konten feed, story, dan reels. Untuk video produksi khusus tersedia layanan terpisah.'],['q' => 'Bagaimana sistem pelaporan?', 'a' => 'Kami menyediakan laporan performa bulanan yang mencakup metrik followers, engagement, reach, dan rekomendasi strategi.'],['q' => 'Apakah bisa trial terlebih dahulu?', 'a' => 'Ya, kami menyediakan masa trial 1 bulan dengan harga khusus untuk melihat kesesuaian sebelum commit paket jangka panjang.'],['q' => 'Berapa lama melihat hasil yang signifikan?', 'a' => 'Hasil biasanya mulai terlihat dalam 1-2 bulan pertama, dengan peningkatan signifikan dalam 3-4 bulan implementasi strategi.']]; @endphp @foreach($faqs as $faq)<div class="faq-item"><button class="faq-question" onclick="this.parentElement.classList.toggle('open')"><span>{{ $faq['q'] }}</span><span class="faq-toggle">+</span></button><div class="faq-answer"><p>{{ $faq['a'] }}</p></div></div>@endforeach</div></div></section>
<section class="cta-bottom"><div class="container reveal"><span class="section-tag">Start Now</span><h2 class="section-title">Siap Maksimalkan Social Media Bisnis Anda?</h2><p class="section-desc">Konsultasikan kebutuhan social media management bisnis Anda dengan tim ahli diver.ent. Gratis, tanpa komitmen.</p><div class="hero-ctas" style="justify-content: center;"><a href="https://wa.me/6281234567890" target="_blank" class="btn-primary">Konsultasi Gratis</a><a href="/" class="btn-outline">Kembali ke Home</a></div></div></section>
@include('partials.component.footer')
@include('partials.component.modals')
<script>const reveals=document.querySelectorAll('.reveal');function reveal(){reveals.forEach(el=>{const windowHeight=window.innerHeight;const revealTop=el.getBoundingClientRect().top;const revealPoint=100;if(revealTop<windowHeight-revealPoint){el.classList.add('active');}});}window.addEventListener('scroll',reveal);window.addEventListener('load',reveal);document.querySelectorAll('.faq-item').forEach(item=>{const question=item.querySelector('.faq-question');question.addEventListener('click',()=>{item.classList.toggle('open');});});</script>
@endsection