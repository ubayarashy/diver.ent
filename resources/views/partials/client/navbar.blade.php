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
                        <a href="{{ route('service.smm') }}">Social Media Management</a>
                        <a href="{{ route('service.dc') }}">Digital Ads (Meta, Google, TikTok)</a>
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
                        <a href="{{ route('service.vp') }}">Video Production</a>
                        <a href="{{ route('service.fp') }}">Foto Produk</a>
                        <a href="{{ route('service.cp') }}">Commercial Photography</a>
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
            
            {{-- MENU UNTUK CLIENT YANG SUDAH LOGIN --}}
            @auth
                <li class="client-menu">
                    <a href="#" class="client-menu-trigger">
                        <i class="fas fa-user-circle"></i> {{ Auth::user()->name }} ▾
                    </a>
                    <div class="client-dropdown">
                        <a href="{{ route('client.dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                        <a href="{{ route('client.create-project') }}">
                            <i class="fas fa-handshake"></i> Ayo Kerjasama
                        </a>
                        <a href="{{ route('client.projects') }}">
                            <i class="fas fa-history"></i> History Kerjasama
                        </a>
                        <a href="{{ route('client.payments') }}">
                            <i class="fas fa-money-bill-wave"></i> Pembayaran
                        </a>
                        <a href="{{ route('client.profile') }}">
                            <i class="fas fa-user-circle"></i> Profil Saya
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-navbar').submit();">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </div>
                </li>
            @else
                <li><a href="#" data-modal="login-modal">Sign In</a></li>
            @endauth
        </ul>
        
        <div style="display:flex;align-items:center;gap:16px;">
            <button id="theme-toggle" class="theme-btn" aria-label="Toggle Theme">
                <i class="fas fa-moon"></i>
                <i class="fas fa-sun" style="display:none;"></i>
            </button>
            <a href="/#cta-bottom" class="btn-primary" id="nav-cta">Get In Touch</a>
            <button class="hamburger" id="hamburger" aria-label="Toggle menu">
                <span></span><span></span><span></span>
            </button>
        </div>
    </div>
</nav>

<!-- Form Logout -->
@auth
<form id="logout-form-navbar" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
@endauth

<style>
/* Client Dropdown Menu */
.client-menu {
    position: relative;
}

.client-menu-trigger {
    display: flex;
    align-items: center;
    gap: 8px;
}

.client-dropdown {
    position: absolute;
    top: 100%;
    right: 0;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 12px;
    min-width: 220px;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: all 0.3s ease;
    z-index: 1000;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}

.client-menu:hover .client-dropdown {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.client-dropdown a {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 20px;
    color: var(--text-secondary);
    text-decoration: none;
    font-size: 0.85rem;
    transition: all 0.3s ease;
}

.client-dropdown a:hover {
    background: rgba(59, 130, 255, 0.08);
    color: var(--accent);
}

.client-dropdown a i {
    width: 20px;
    font-size: 0.9rem;
}

.dropdown-divider {
    height: 1px;
    background: var(--border);
    margin: 6px 0;
}

/* Theme Button */
.theme-btn {
    background: var(--surface-alt);
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.theme-btn:hover {
    background: var(--accent);
}

/* Mega Menu */
.mega-menu {
    position: absolute;
    top: 100%;
    left: 0;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 24px;
    min-width: 600px;
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 24px;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: all 0.3s ease;
    z-index: 1000;
}

.nav-links > li:hover .mega-menu {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.mega-menu h4 {
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: var(--accent);
    margin-bottom: 12px;
}

.mega-menu a {
    display: block;
    padding: 6px 0;
    font-size: 0.85rem;
    color: var(--text-secondary);
    text-decoration: none;
    transition: color 0.3s;
}

.mega-menu a:hover {
    color: var(--accent);
}

/* Navbar Base */
.navbar {
    background: var(--navbar-bg);
    backdrop-filter: blur(20px);
    border-bottom: 1px solid var(--border);
    position: sticky;
    top: 0;
    z-index: 100;
}

.navbar .container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    height: 80px;
}

.logo {
    font-family: var(--font-display);
    font-weight: 800;
    font-size: 1.5rem;
    letter-spacing: -1px;
    text-decoration: none;
    color: var(--text);
}

.logo span {
    color: var(--accent);
}

.nav-links {
    display: flex;
    align-items: center;
    gap: 28px;
}

.nav-links > li {
    list-style: none;
    position: relative;
}

.nav-links > li > a {
    text-decoration: none;
    color: var(--text-secondary);
    font-weight: 500;
    font-size: 0.9rem;
    transition: color 0.3s;
}

.nav-links > li > a:hover {
    color: var(--accent);
}

/* Hamburger Menu */
.hamburger {
    display: none;
    flex-direction: column;
    gap: 5px;
    background: none;
    border: none;
    cursor: pointer;
}

.hamburger span {
    width: 25px;
    height: 2px;
    background: var(--text);
    transition: all 0.3s;
}

/* Responsive */
@media (max-width: 1024px) {
    .mega-menu {
        min-width: 500px;
    }
}

@media (max-width: 768px) {
    .hamburger {
        display: flex;
    }
    
    .nav-links {
        position: fixed;
        top: 80px;
        left: -100%;
        width: 100%;
        height: calc(100vh - 80px);
        background: var(--surface);
        flex-direction: column;
        align-items: flex-start;
        padding: 30px;
        gap: 20px;
        transition: left 0.3s ease;
        overflow-y: auto;
    }
    
    .nav-links.active {
        left: 0;
    }
    
    .mega-menu {
        position: static;
        min-width: auto;
        grid-template-columns: 1fr;
        opacity: 1;
        visibility: visible;
        transform: none;
        display: none;
        margin-top: 10px;
        padding: 20px;
    }
    
    .nav-links > li:hover .mega-menu {
        display: grid;
    }
    
    .client-dropdown {
        position: static;
        opacity: 1;
        visibility: visible;
        transform: none;
        display: none;
        box-shadow: none;
        padding-left: 20px;
    }
    
    .client-menu:hover .client-dropdown {
        display: block;
    }
}
</style>

<script>
    // Theme Toggle
    const themeToggle = document.getElementById('theme-toggle');
    const html = document.documentElement;
    const moonIcon = themeToggle?.querySelector('.fa-moon');
    const sunIcon = themeToggle?.querySelector('.fa-sun');
    
    function updateThemeIcons(theme) {
        if (theme === 'dark') {
            if (moonIcon) moonIcon.style.display = 'flex';
            if (sunIcon) sunIcon.style.display = 'none';
        } else {
            if (moonIcon) moonIcon.style.display = 'none';
            if (sunIcon) sunIcon.style.display = 'flex';
        }
    }
    
    const savedTheme = localStorage.getItem('theme') || 'dark';
    html.setAttribute('data-theme', savedTheme);
    updateThemeIcons(savedTheme);
    
    if (themeToggle) {
        themeToggle.addEventListener('click', () => {
            const currentTheme = html.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            html.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            updateThemeIcons(newTheme);
        });
    }
    
    // Hamburger Menu
    const hamburger = document.getElementById('hamburger');
    const navLinks = document.getElementById('nav-links');
    
    if (hamburger && navLinks) {
        hamburger.addEventListener('click', () => {
            navLinks.classList.toggle('active');
        });
    }
    
    // Modal Login
    const modalTriggers = document.querySelectorAll('[data-modal]');
    modalTriggers.forEach(trigger => {
        trigger.addEventListener('click', (e) => {
            e.preventDefault();
            const modalId = trigger.getAttribute('data-modal');
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.style.display = 'flex';
                document.body.style.overflow = 'hidden';
            }
        });
    });
</script>