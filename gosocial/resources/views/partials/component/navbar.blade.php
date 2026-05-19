{{-- Navbar --}}
<nav class="navbar" role="navigation" aria-label="Main Navigation">
    <div class="container">
        <a href="/" class="logo">diver.<span>ent</span></a>
        <ul class="nav-links" id="nav-links">
            <li>
                <a href="/#services">Services ▾</a>
                <div class="mega-menu">
                    <div>
                        <h4>Digital Marketing</h4>
                        <a href="/#services">Social Media Management</a>
                        <a href="/#services">Digital Ads (Meta, Google, TikTok)</a>
                        <a href="/#services">SEO Optimization</a>
                        <a href="/#services">KOL & Affiliate Marketing</a>
                    </div>
                    <div>
                        <h4>Technology</h4>
                        <a href="/#services">Website Development</a>
                        <a href="/#services">Apps Development</a>
                        <a href="/#services">360° Marketing</a>
                    </div>
                    <div>
                        <h4>Branding</h4>
                        <a href="/#services">Logo Design</a>
                        <a href="/#services">Branding & Design</a>
                    </div>
                    <div>
                        <h4>Visual & Audio</h4>
                        <a href="/#services">Video Production</a>
                        <a href="/#services">Foto Produk</a>
                        <a href="/#services">Commercial Photography</a>
                    </div>
                </div>
            </li>
            <li>
                <a href="/#about">Solution ▾</a>
                <div class="mega-menu">
                    <div>
                        <h4>By Industry</h4>
                        <a href="/#about">Enterprise</a>
                        <a href="/#about">Education</a>
                        <a href="/#about">F&B</a>
                        <a href="/#about">Healthcare</a>
                    </div>
                    <div>
                        <h4>By Scale</h4>
                        <a href="/#about">UMKM</a>
                        <a href="/#about">Brand Nasional</a>
                        <a href="/#about">Startup</a>
                    </div>
                </div>
            </li>
            <li>
                <a href="/#about">Company ▾</a>
                <div class="mega-menu">
                    <div>
                        <h4>About Us</h4>
                        <a href="/#about">About diver.ent</a>
                        <a href="/#why-us">How It Works</a>
                        <a href="{{ route('portfolio') }}">Portfolio</a>
                    </div>
                    <div>
                        <h4>Resources</h4>
                        <a href="#">Careers</a>
                        <a href="#">Blog</a>
                        <a href="/#cta-bottom">Contact</a>
                    </div>
                </div>
            </li>
            <li>
                <a href="{{ route('portfolio') }}" @if(request()->routeIs('portfolio')) style="color:var(--accent);" @endif>Portfolio</a>
            </li>
            <li><a href="#" data-modal="login-modal">Sign In</a></li>
        </ul>
        <div style="display:flex;align-items:center;gap:16px;">
            <a href="/#cta-bottom" class="btn-primary" id="nav-cta">Get In Touch</a>
            <button class="hamburger" id="hamburger" aria-label="Toggle menu">
                <span></span><span></span><span></span>
            </button>
        </div>
    </div>
</nav>
