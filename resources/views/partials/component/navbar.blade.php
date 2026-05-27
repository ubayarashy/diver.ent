{{-- Navbar --}}
<nav class="navbar" role="navigation" aria-label="Main Navigation">
    <div class="container">
        <a href="/" class="logo">
            <div class="logo-circle-mask">
                <img src="{{ asset('img/logo.png') }}" alt="diver.ent" class="logo-img-circle">
            </div>
            <span class="logo-text">diver.<span class="accent">ent</span></span>
        </a>
        
        <ul class="nav-links" id="nav-links">
            <!-- Services - 4 Layanan -->
            <li>
                <a href="/#services">Services ▾</a>
                <div class="mega-menu">
                    <div>
                        <h4>Layanan Kami</h4>
                        <a href="{{ route('service.smm') }}"><i class="fab fa-instagram"></i> Social Media Management</a>
                        <a href="{{ route('service.vp') }}"><i class="fas fa-video"></i> Videography</a>
                        <a href="{{ route('service.fp') }}"><i class="fas fa-camera"></i> Fotografi</a>
                        <a href="{{ route('service.dc') }}"><i class="fas fa-chart-line"></i> Digital Ads</a>
                    </div>
                </div>
            </li>
            
            <!-- Company -->
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
                        <a href="/#cta-bottom">Contact</a>
                    </div>
                </div>
            </li>
            
            <!-- Portfolio -->
            <li>
                <a href="{{ route('portfolio') }}" @if(request()->routeIs('portfolio')) style="color:var(--accent);" @endif>Portfolio</a>
            </li>
            
            <!-- Auth Menu - Berdasarkan Role -->
          <!-- Auth Menu - Berdasarkan Role -->
@auth
    @if(Auth::user()->role == 'admin')
        {{-- MENU UNTUK ADMIN --}}
        <li class="client-menu">
            <a href="#" class="client-menu-trigger">
                <i class="fas fa-user-shield"></i> {{ Auth::user()->name }} ▾
            </a>
            <div class="client-dropdown">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i> Admin Dashboard
                </a>
                <a href="{{ route('admin.briefs') }}">
                    <i class="fas fa-file-alt"></i> Brief Client
                </a>
                <a href="{{ route('admin.payments') }}">
                    <i class="fas fa-money-bill-wave"></i> Pembayaran
                </a>
                <a href="{{ route('admin.portfolios') }}">
                    <i class="fas fa-folder-open"></i> Portfolio
                </a>
            
                <div class="dropdown-divider"></div>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-navbar').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </li>
    @elseif(Auth::user()->role == 'team')
        {{-- MENU UNTUK TEAM --}}
        <li class="client-menu">
            <a href="#" class="client-menu-trigger">
                <i class="fas fa-users"></i> {{ Auth::user()->name }} ▾
            </a>
            <div class="client-dropdown">
                <a href="{{ route('team.dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i> Team Dashboard
                </a>
                <a href="{{ route('team.tasks') }}">
                    <i class="fas fa-tasks"></i> My Tasks
                </a>
                <a href="{{ route('team.calendar') }}">
                    <i class="fas fa-calendar-alt"></i> Calendar
                </a>
              
                <div class="dropdown-divider"></div>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-navbar').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </li>
    @else
        {{-- MENU UNTUK CLIENT --}}
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
              
                <div class="dropdown-divider"></div>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-navbar').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </li>
    @endif
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
/* ==================== NAVBAR STYLES ==================== */
.navbar {
    background: var(--navbar-bg);
    backdrop-filter: blur(20px);
    border-bottom: 1px solid var(--border);
    position: sticky;
    top: 0;
    z-index: 1000;
}

.navbar .container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    height: 80px;
    max-width: 1320px;
    margin: 0 auto;
    padding: 0 20px;
}

/* ==================== LOGO ==================== */
.logo {
    display: flex;
    align-items: center;
    gap: 12px;
    text-decoration: none;
}

.logo-circle-mask {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    background: transparent;
}

.logo-img-circle {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
}

.logo-circle-mask:hover {
    transform: scale(1.02);
    transition: transform 0.2s ease;
}

.logo-text {
    font-family: var(--font-display);
    font-weight: 800;
    font-size: 1.4rem;
    letter-spacing: -1px;
    color: var(--text);
}

.logo-text .accent {
    color: var(--accent);
}

/* ==================== NAV LINKS ==================== */
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

/* ==================== MEGA MENU ==================== */
.mega-menu {
    position: absolute;
    top: 100%;
    left: 0;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 24px;
    min-width: 300px;
    display: grid;
    grid-template-columns: 1fr;
    gap: 16px;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: all 0.3s ease;
    z-index: 1001;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
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
    border-bottom: 1px solid var(--border);
    padding-bottom: 6px;
}

.mega-menu a {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 8px 0;
    font-size: 0.85rem;
    color: var(--text-secondary);
    text-decoration: none;
    transition: all 0.3s;
}

.mega-menu a:hover {
    color: var(--accent);
    transform: translateX(6px);
}

.mega-menu a i {
    width: 20px;
    font-size: 0.9rem;
}

/* ==================== CLIENT DROPDOWN ==================== */
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
    z-index: 1001;
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

/* ==================== THEME BUTTON ==================== */
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

.theme-btn i {
    font-size: 1.2rem;
    color: var(--text);
}

/* ==================== HAMBURGER MENU ==================== */
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

/* ==================== RESPONSIVE ==================== */
@media (max-width: 1024px) {
    .mega-menu {
        min-width: 260px;
    }
}

@media (max-width: 768px) {
    .logo-circle-mask {
        width: 36px;
        height: 36px;
    }
    
    .logo-text {
        font-size: 1.1rem;
    }
    
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
        z-index: 999;
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
        box-shadow: none;
    }
    
    .nav-links > li {
        width: 100%;
    }
    
    .nav-links > li > a {
        display: block;
        width: 100%;
    }
    
    .client-dropdown {
        position: static;
        opacity: 1;
        visibility: visible;
        transform: none;
        display: none;
        box-shadow: none;
        padding-left: 20px;
        width: 100%;
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