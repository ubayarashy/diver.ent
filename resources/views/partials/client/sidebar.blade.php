<!-- Integrated Sidebar for Client -->
<div class="client-sidebar" id="client-sidebar">
    <div class="sidebar-header">
        <div class="logo">
            <div class="logo-circle-mask">
                <img src="{{ asset('img/logo.png') }}" alt="diver.ent" class="logo-img-circle">
            </div>
            <span class="logo-text">diver.<span class="accent">ent</span></span>
        </div>
        <button class="sidebar-close" id="sidebarClose">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <!-- User Profile Section -->
    <div class="sidebar-profile">
        <div class="sidebar-avatar">
            {{ substr(Auth::user()->name ?? 'U', 0, 2) }}
        </div>
        <div class="sidebar-user-info">
            <h4>{{ Auth::user()->name ?? 'User' }}</h4>
            <p>{{ Auth::user()->email ?? 'user@example.com' }}</p>
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="sidebar-nav">
        <a href="{{ route('client.dashboard') }}" class="nav-item {{ request()->routeIs('client.dashboard') ? 'active' : '' }}">
            <span class="nav-icon"><i class="fas fa-tachometer-alt"></i></span>
            <span class="nav-text">Dashboard</span>
            <span class="nav-arrow"><i class="fas fa-chevron-right"></i></span>
        </a>
        <a href="{{ route('client.create-project') }}" class="nav-item {{ request()->routeIs('client.create-project') ? 'active' : '' }}">
            <span class="nav-icon"><i class="fas fa-handshake"></i></span>
            <span class="nav-text">Ayo Kerjasama</span>
            <span class="nav-arrow"><i class="fas fa-chevron-right"></i></span>
        </a>
        <a href="{{ route('client.projects') }}" class="nav-item {{ request()->routeIs('client.projects') ? 'active' : '' }}">
            <span class="nav-icon"><i class="fas fa-history"></i></span>
            <span class="nav-text">History Kerjasama</span>
            <span class="nav-arrow"><i class="fas fa-chevron-right"></i></span>
        </a>
        <a href="{{ route('client.payments') }}" class="nav-item {{ request()->routeIs('client.payments') ? 'active' : '' }}">
            <span class="nav-icon"><i class="fas fa-money-bill-wave"></i></span>
            <span class="nav-text">Pembayaran</span>
            <span class="nav-arrow"><i class="fas fa-chevron-right"></i></span>
        </a>
        <a href="{{ route('client.profile') }}" class="nav-item {{ request()->routeIs('client.profile') ? 'active' : '' }}">
            <span class="nav-icon"><i class="fas fa-user-circle"></i></span>
            <span class="nav-text">Profil Saya</span>
            <span class="nav-arrow"><i class="fas fa-chevron-right"></i></span>
        </a>
    </nav>

    <!-- Bottom Section -->
    <div class="sidebar-footer">
        <div class="sidebar-theme-toggle" id="themeToggle">
            <i class="fas fa-moon"></i>
            <span>Dark Mode</span>
        </div>
        <div class="sidebar-logout" onclick="openLogoutModal()">
            <i class="fas fa-sign-out-alt"></i>
            <span>Keluar</span>
        </div>
    </div>
</div>

<!-- Mobile Top Bar -->
<div class="mobile-top-bar">
    <button class="mobile-menu-toggle" id="mobileMenuToggle">
        <i class="fas fa-bars"></i>
    </button>
    <div class="mobile-logo">
        <div class="logo-circle-mask-small">
            <img src="{{ asset('img/logo.png') }}" alt="diver.ent" class="logo-img-circle-small">
        </div>
        <span>diver.<span class="accent">ent</span></span>
    </div>
    <div class="mobile-avatar" onclick="window.location.href='{{ route('client.profile') }}'">
        {{ substr(Auth::user()->name ?? 'U', 0, 2) }}
    </div>
</div>

<style>
/* ==================== SIDEBAR STYLES ==================== */
.client-sidebar {
    width: 300px;
    background: linear-gradient(180deg, var(--surface) 0%, var(--surface-alt) 100%);
    border-right: 1px solid var(--border);
    position: fixed;
    left: 0;
    top: 0;
    bottom: 0;
    z-index: 1000;
    overflow-y: auto;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    display: flex;
    flex-direction: column;
}

/* Sidebar Header - Logo Bulat */
.sidebar-header {
    padding: 28px 24px;
    border-bottom: 1px solid var(--border);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.sidebar-header .logo {
    display: flex;
    align-items: center;
    gap: 12px;
}

.logo-circle-mask {
    width: 40px;
    height: 40px;
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

.sidebar-header .logo-text {
    font-family: var(--font-display);
    font-weight: 800;
    font-size: 1.2rem;
    letter-spacing: -1px;
    color: var(--text);
}

.sidebar-header .logo-text .accent {
    color: var(--accent);
}

.sidebar-close {
    background: none;
    border: none;
    color: var(--text-secondary);
    font-size: 1.2rem;
    cursor: pointer;
    display: none;
    transition: color 0.3s;
}

.sidebar-close:hover {
    color: var(--accent);
}

/* Sidebar Profile */
.sidebar-profile {
    padding: 28px 24px;
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    gap: 16px;
}

.sidebar-avatar {
    width: 56px;
    height: 56px;
    background: linear-gradient(135deg, var(--accent), var(--accent-hover));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1.2rem;
    color: #fff;
}

.sidebar-user-info h4 {
    font-weight: 700;
    font-size: 1rem;
    margin-bottom: 4px;
}

.sidebar-user-info p {
    font-size: 0.7rem;
    color: var(--text-secondary);
}

/* Navigation */
.sidebar-nav {
    flex: 1;
    padding: 24px 16px;
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.nav-item {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 14px 18px;
    color: var(--text-secondary);
    text-decoration: none;
    border-radius: 14px;
    transition: all 0.3s ease;
    font-weight: 500;
    position: relative;
    overflow: hidden;
}

.nav-item::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    width: 3px;
    background: var(--accent);
    transform: scaleY(0);
    transition: transform 0.3s ease;
}

.nav-item:hover {
    background: rgba(59, 130, 255, 0.08);
    color: var(--accent);
    transform: translateX(6px);
}

.nav-item.active {
    background: linear-gradient(90deg, rgba(59, 130, 255, 0.15), transparent);
    color: var(--accent);
}

.nav-item.active::before {
    transform: scaleY(1);
}

.nav-icon {
    font-size: 1.2rem;
    width: 28px;
    text-align: center;
}

.nav-text {
    flex: 1;
    font-size: 0.9rem;
}

.nav-arrow {
    opacity: 0;
    transition: opacity 0.3s ease, transform 0.3s ease;
}

.nav-item:hover .nav-arrow {
    opacity: 1;
    transform: translateX(4px);
}

/* Sidebar Footer */
.sidebar-footer {
    padding: 20px 16px;
    border-top: 1px solid var(--border);
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.sidebar-theme-toggle, .sidebar-logout {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 12px 18px;
    border-radius: 14px;
    cursor: pointer;
    transition: all 0.3s ease;
    color: var(--text-secondary);
    font-size: 0.9rem;
}

.sidebar-theme-toggle:hover, .sidebar-logout:hover {
    background: rgba(59, 130, 255, 0.08);
    color: var(--accent);
    transform: translateX(6px);
}

.sidebar-theme-toggle i, .sidebar-logout i {
    width: 28px;
    font-size: 1.1rem;
}

/* Mobile Top Bar */
.mobile-top-bar {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    height: 70px;
    background: var(--navbar-bg);
    backdrop-filter: blur(20px);
    border-bottom: 1px solid var(--border);
    padding: 0 20px;
    align-items: center;
    justify-content: space-between;
    z-index: 999;
}

.mobile-menu-toggle {
    background: none;
    border: none;
    color: var(--text);
    font-size: 1.3rem;
    cursor: pointer;
}

.mobile-logo {
    display: flex;
    align-items: center;
    gap: 8px;
    font-family: var(--font-display);
    font-weight: 800;
    font-size: 1rem;
}

.logo-circle-mask-small {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}

.logo-img-circle-small {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
}

.mobile-logo .accent {
    color: var(--accent);
}

.mobile-avatar {
    width: 42px;
    height: 42px;
    background: linear-gradient(135deg, var(--accent), var(--accent-hover));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    cursor: pointer;
    color: #fff;
}

/* Main Content Adjustment */
.client-main {
    margin-left: 300px;
    min-height: 100vh;
}

/* Responsive */
@media (max-width: 768px) {
    .client-sidebar {
        transform: translateX(-100%);
        width: 280px;
    }
    
    .client-sidebar.open {
        transform: translateX(0);
    }
    
    .sidebar-close {
        display: block;
    }
    
    .mobile-top-bar {
        display: flex;
    }
    
    .client-main {
        margin-left: 0;
        padding-top: 70px;
    }
    
    .sidebar-profile {
        padding: 20px;
    }
    
    .sidebar-avatar {
        width: 48px;
        height: 48px;
        font-size: 1rem;
    }
    
    .sidebar-user-info h4 {
        font-size: 0.9rem;
    }
}

/* Scrollbar Styling */
.client-sidebar::-webkit-scrollbar {
    width: 4px;
}

.client-sidebar::-webkit-scrollbar-track {
    background: var(--border);
}

.client-sidebar::-webkit-scrollbar-thumb {
    background: var(--accent);
    border-radius: 4px;
}
</style>

<script>
    // Mobile menu toggle
    document.addEventListener('DOMContentLoaded', function() {
        const mobileToggle = document.getElementById('mobileMenuToggle');
        const sidebarClose = document.getElementById('sidebarClose');
        const sidebar = document.getElementById('client-sidebar');
        
        if (mobileToggle && sidebar) {
            mobileToggle.addEventListener('click', function() {
                sidebar.classList.add('open');
            });
        }
        
        if (sidebarClose && sidebar) {
            sidebarClose.addEventListener('click', function() {
                sidebar.classList.remove('open');
            });
        }
        
        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(e) {
            if (window.innerWidth <= 768 && sidebar && sidebar.classList.contains('open')) {
                if (!sidebar.contains(e.target) && !mobileToggle.contains(e.target)) {
                    sidebar.classList.remove('open');
                }
            }
        });
        
        // Theme toggle
        const themeToggle = document.getElementById('themeToggle');
        if (themeToggle) {
            themeToggle.addEventListener('click', function() {
                const html = document.documentElement;
                const currentTheme = html.getAttribute('data-theme');
                const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                html.setAttribute('data-theme', newTheme);
                localStorage.setItem('theme', newTheme);
                
                const icon = themeToggle.querySelector('i');
                if (newTheme === 'dark') {
                    icon.className = 'fas fa-sun';
                    themeToggle.querySelector('span').textContent = 'Light Mode';
                } else {
                    icon.className = 'fas fa-moon';
                    themeToggle.querySelector('span').textContent = 'Dark Mode';
                }
            });
        }
        
        // Load saved theme
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme) {
            document.documentElement.setAttribute('data-theme', savedTheme);
            if (themeToggle) {
                const icon = themeToggle.querySelector('i');
                if (savedTheme === 'dark') {
                    icon.className = 'fas fa-sun';
                    themeToggle.querySelector('span').textContent = 'Light Mode';
                } else {
                    icon.className = 'fas fa-moon';
                    themeToggle.querySelector('span').textContent = 'Dark Mode';
                }
            }
        }
    });
    
    // Logout modal function
    window.openLogoutModal = function() {
        const modal = document.getElementById('logout-modal');
        if (modal) {
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }
    }
    
    window.closeLogoutModal = function() {
        const modal = document.getElementById('logout-modal');
        if (modal) {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }
    }
</script>