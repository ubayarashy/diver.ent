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
.mockup-video-placeholder { background: linear-gradient(135deg, #1a1a2e, #16213e); border-radius: 16px; padding: 60px 40px; text-align: center; }
.mockup-video-placeholder i { font-size: 48px; opacity: 0.2; color: var(--accent); margin-bottom: 16px; display: block; }
.mockup-video-placeholder p { opacity: 0.4; font-size: 0.8rem; margin: 0; }
.smm-platforms { padding: 60px 0; background: var(--surface); width: 100%; }
.platform-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 1.5rem; margin-top: 2rem; }
.platform-card { background: var(--bg); border-radius: 20px; padding: 2rem 1.8rem; transition: all 0.3s ease; border: 1px solid var(--border); position: relative; text-align: center; cursor: pointer; }
.platform-card:hover { transform: translateY(-5px); border-color: var(--accent); box-shadow: 0 12px 30px -10px rgba(0,0,0,0.08); }
.platform-icon { font-size: 2.5rem; margin-bottom: 1.2rem; display: inline-block; color: var(--accent); }
.platform-card h3 { font-size: 1.2rem; margin-bottom: 0.75rem; font-weight: 600; }
.platform-card p { color: var(--text-secondary); font-size: 0.85rem; line-height: 1.6; }
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
@media (max-width: 1200px) { .why-grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 992px) { .smm-features-grid { grid-template-columns: 1fr; gap: 2rem; } .process-connector { display: none; } .process-grid { flex-direction: column; } .process-card { width: 100%; } .container { padding: 0 32px; } .why-grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 768px) { .smm-hero { padding: 80px 0 40px; } .smm-hero h1 { font-size: 2rem; } .section-title { font-size: 1.5rem; } .hero-ctas { flex-direction: column; align-items: stretch; } .btn-primary, .btn-outline { justify-content: center; } .stats-row { gap: 1rem; } .container { padding: 0 20px; } .why-grid { grid-template-columns: 1fr; } .platform-grid { grid-template-columns: 1fr; } }
.reveal { opacity: 0; transform: translateY(20px); transition: opacity 0.7s cubic-bezier(0.2, 0.9, 0.4, 1.1), transform 0.7s cubic-bezier(0.2, 0.9, 0.4, 1.1); }
.reveal.active { opacity: 1; transform: translateY(0); }
</style>
<section class="smm-hero"><div class="container"><div class="smm-hero-content reveal"><nav class="breadcrumb-nav"><a href="/">Home</a><span>/</span><a href="/#services">Services</a><span>/</span><span class="active">Video Production</span></nav><span class="hero-tag">Professional Video</span><h1>Jasa <span class="highlight">Video</span> Production</h1><p>Layanan pembuatan video profesional untuk berbagai kebutuhan promosi bisnis. Wujudkan cerita yang hidup melalui video yang mengesankan dan komunikatif.</p><div class="hero-ctas"><a href="#vp-types" class="btn-primary">Jenis Video</a><a href="#vp-process" class="btn-outline">Cara Kerja</a></div></div></div></section>
<div class="smm-stats-bar"><div class="container"><div class="stats-row reveal"><div class="stat-pill"><strong>1000+</strong> Projects</div><div class="stat-divider">•</div><div class="stat-pill"><strong>7+ Tahun</strong> Experience</div><div class="stat-divider">•</div><div class="stat-pill"><strong>Professional</strong> Team</div><div class="stat-divider">•</div><div class="stat-pill"><strong>Advanced</strong> Technology</div></div></div></div>
<section class="smm-features"><div class="container"><div class="smm-features-grid"><div class="smm-features-text reveal"><span class="section-tag">Why Video Production</span><h2 class="section-title">Cerita yang Hidup Melalui <span class="highlight">Video</span></h2><p class="section-desc">Video merupakan media paling efektif untuk campaign, awareness, dan edukasi pasar karena memadukan visual dengan audio sehingga pesan mudah ditangkap oleh audience.</p><div class="smm-checklist"><div class="check-item"><span class="check-icon">—</span><p>Visualisasi produk & layanan lebih <strong>interaktif dan menarik</strong>.</p></div><div class="check-item"><span class="check-icon">—</span><p>Komunikasi brand yang lebih <strong>profesional dan memorable</strong>.</p></div><div class="check-item"><span class="check-icon">—</span><p><strong>Meningkatkan engagement</strong> hingga 10x dibanding konten statis.</p></div></div></div><div class="smm-features-visual reveal"><div class="smm-visual-card"><div class="visual-mockup"><div class="mockup-header"><span class="dot red"></span><span class="dot yellow"></span><span class="dot green"></span></div><div class="mockup-body"><div class="mockup-video-placeholder"><i class="fas fa-video"></i><p>Video Production Showcase</p></div></div></div></div></div></div></div></section>
<section class="smm-platforms" id="vp-types"><div class="container"><div class="reveal"><span class="section-tag">Video Types</span><h2 class="section-title">Pilihan Jenis Video</h2><p class="section-desc">Berbagai jenis video profesional untuk kebutuhan bisnis dan promosi Anda.</p></div><div class="platform-grid reveal">@php $types = [['icon' => 'fas fa-film', 'name' => 'Video Animasi', 'badge' => 'Best Seller', 'desc' => 'Video animasi explainer 2D untuk company profile maupun promosi produk dan layanan.'],['icon' => 'fas fa-hashtag', 'name' => 'Video Konten Sosmed', 'badge' => 'Trending', 'desc' => 'Pembuatan video untuk konten posting maupun promosi di YouTube, TikTok, dan Instagram.'],['icon' => 'fas fa-building', 'name' => 'Video Company Profile', 'badge' => 'Top Choice', 'desc' => 'Video company profile untuk meningkatkan citra perusahaan dan mendukung promosi bisnis.'],['icon' => 'fas fa-chart-line', 'name' => 'Video Promosi', 'badge' => '', 'desc' => 'Video iklan komersial untuk kampanye digital, TV commercial, dan placement di berbagai platform.'],['icon' => 'fas fa-graduation-cap', 'name' => 'Video Edukasi', 'badge' => '', 'desc' => 'Video edukasi dan tutorial untuk pelatihan internal, e-learning, dan konten edukatif.'],['icon' => 'fas fa-calendar-alt', 'name' => 'Video Event', 'badge' => '', 'desc' => 'Dokumentasi video acara perusahaan, seminar, launching product, dan gathering.']]; @endphp @foreach($types as $t)<div class="platform-card">@if($t['badge'])<span class="service-badge">{{ $t['badge'] }}</span>@endif<i class="{{ $t['icon'] }} platform-icon"></i><h3>{{ $t['name'] }}</h3><p>{{ $t['desc'] }}</p></div>@endforeach</div></div></section>
<section class="smm-process" id="vp-process"><div class="container"><div class="reveal"><span class="section-tag">How It Works</span><h2 class="section-title">Proses Produksi Video</h2><p class="section-desc">Proses produksi video yang terstruktur dan profesional.</p></div><div class="process-grid reveal"><div class="process-card"><div class="process-number">01</div><h3>Riset & Strategi</h3><p>Analisis bisnis, audiens, dan tren pasar Anda untuk dasar konsep dan strategi video.</p></div><div class="process-connector">→</div><div class="process-card"><div class="process-number">02</div><h3>Eksekusi & Produksi</h3><p>Menerapkan strategi dengan kreativitas, tim profesional, dan teknologi terkini.</p></div><div class="process-connector">→</div><div class="process-card"><div class="process-number">03</div><h3>Evaluasi & Delivery</h3><p>Review, revisi, finalisasi, dan penyerahan file video berkualitas tinggi siap pakai.</p></div></div></div></section>
<section class="smm-why" id="vp-benefits"><div class="container"><div class="reveal"><span class="section-tag">Features & Benefits</span><h2 class="section-title">Keuntungan Video Production di <span class="highlight">diver.ent</span></h2><p class="section-desc">Kami memberikan layanan video production terbaik untuk brand Anda.</p></div><div class="why-grid reveal">@php $benefits = [['icon' => 'fas fa-users', 'title' => 'Tim Kreatif Profesional', 'desc' => 'Ditangani oleh videografer, editor, dan kreator berpengalaman di berbagai jenis video produksi.'],['icon' => 'fas fa-camera', 'title' => 'Peralatan Canggih', 'desc' => 'Menggunakan kamera cinema-grade, drone, lighting studio, dan audio recording profesional.'],['icon' => 'fas fa-magic', 'title' => 'Post-Production Berkualitas', 'desc' => 'Editing, color grading, motion graphic, sound design, dan visual effects berkualitas tinggi.'],['icon' => 'fas fa-tasks', 'title' => 'Konsep Terstruktur', 'desc' => 'Mulai dari brainstorming, scriptwriting, storyboard, hingga produksi dengan alur yang jelas.'],['icon' => 'fas fa-bolt', 'title' => 'Proses Cepat', 'desc' => 'Timeline produksi yang efisien dengan koordinasi transparan di setiap tahap pengerjaan.'],['icon' => 'fas fa-bullseye', 'title' => 'Orientasi Hasil', 'desc' => 'Video dirancang tidak hanya menarik, tapi juga efektif untuk mencapai tujuan bisnis Anda.']]; @endphp @foreach($benefits as $b)<div class="why-card"><i class="{{ $b['icon'] }} why-icon"></i><h3>{{ $b['title'] }}</h3><p>{{ $b['desc'] }}</p></div>@endforeach</div></div></section>
<section class="dc-faq" id="vp-faq"><div class="container"><div class="reveal"><span class="section-tag">FAQ</span><h2 class="section-title">Pertanyaan Umum</h2><p class="section-desc">Informasi yang sering ditanyakan tentang layanan video production.</p></div><div class="faq-grid reveal">@php $faqs = [['q' => 'Berapa lama proses pembuatan video?', 'a' => 'Tergantung jenis dan kompleksitas video. Video animasi 2D biasanya 2-4 minggu, video shooting 1-3 minggu setelah produksi.'],['q' => 'Apakah bisa revisi setelah video selesai?', 'a' => 'Ya, kami menyediakan revisi gratis sesuai paket yang dipilih. Revisi tambahan dapat didiskusikan lebih lanjut.'],['q' => 'Apakah termasuk scriptwriting dan storyboard?', 'a' => 'Ya, paket kami sudah termasuk brainstorming konsep, penulisan script, dan pembuatan storyboard sebelum produksi.'],['q' => 'Format file apa yang diberikan?', 'a' => 'Video diberikan dalam format MP4 resolusi Full HD atau 4K. Format lain tersedia atas permintaan.'],['q' => 'Apakah bisa shooting di lokasi klien?', 'a' => 'Ya, kami menyediakan layanan shooting on-location di area Jawa. Untuk luar Jawa bisa diatur secara khusus.'],['q' => 'Apa saja yang perlu disiapkan klien?', 'a' => 'Cukup siapkan brief kebutuhan, referensi video, dan akses lokasi. Tim kami akan mengurus sisanya.']]; @endphp @foreach($faqs as $faq)<div class="faq-item"><button class="faq-question" onclick="this.parentElement.classList.toggle('open')"><span>{{ $faq['q'] }}</span><span class="faq-toggle">+</span></button><div class="faq-answer"><p>{{ $faq['a'] }}</p></div></div>@endforeach</div></div></section>
<section class="cta-bottom"><div class="container reveal"><span class="section-tag">Start Now</span><h2 class="section-title">Perlu Diskusi Tentang Video?</h2><p class="section-desc">Tim kreatif kami siap membahas kebutuhan pembuatan video yang sesuai dengan keinginan Anda. Gratis, tanpa komitmen.</p><div class="hero-ctas" style="justify-content: center;"><a href="https://wa.me/6281234567890" target="_blank" class="btn-primary">Konsultasi Gratis</a><a href="{{ route('portfolio') }}" class="btn-outline">Lihat Portfolio</a></div></div></section>
@include('partials.component.footer')
@include('partials.component.modals')
<script>const reveals=document.querySelectorAll('.reveal');function reveal(){reveals.forEach(el=>{const windowHeight=window.innerHeight;const revealTop=el.getBoundingClientRect().top;const revealPoint=100;if(revealTop<windowHeight-revealPoint){el.classList.add('active');}});}window.addEventListener('scroll',reveal);window.addEventListener('load',reveal);document.querySelectorAll('.faq-item').forEach(item=>{const question=item.querySelector('.faq-question');question.addEventListener('click',()=>{item.classList.toggle('open');});});</script>
@endsection