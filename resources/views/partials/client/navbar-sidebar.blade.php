{{-- Sidebar Kiri --}}
<aside class="app-sidebar" id="appSidebar">
    <div class="sidebar-brand">
        <div class="brand-logo">
            <img src="{{ asset('img/logo.png') }}" alt="diver.ent">
        </div>
        <div class="brand-name">diver.<span class="accent">ent</span></div>
        <div class="brand-badge">Client</div>
    </div>

    <nav class="sidebar-menu">
        <a href="{{ route('client.dashboard') }}" class="menu-item {{ request()->routeIs('client.dashboard') ? 'active' : '' }}">
            <i class="fas fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
        <a href="{{ route('client.create-project') }}" class="menu-item {{ request()->routeIs('client.create-project') ? 'active' : '' }}">
            <i class="fas fa-handshake"></i>
            <span>Ayo Kerjasama</span>
        </a>
        <a href="{{ route('client.projects') }}" class="menu-item {{ request()->routeIs('client.projects') ? 'active' : '' }}">
            <i class="fas fa-history"></i>
            <span>History Kerjasama</span>
        </a>
        <a href="{{ route('client.payments') }}" class="menu-item {{ request()->routeIs('client.payments') ? 'active' : '' }}">
            <i class="fas fa-money-bill-wave"></i>
            <span>Pembayaran</span>
        </a>
        <a href="{{ route('client.profile') }}" class="menu-item {{ request()->routeIs('client.profile') ? 'active' : '' }}">
            <i class="fas fa-user-circle"></i>
            <span>Profil Saya</span>
        </a>
    </nav>

    <div class="sidebar-footer">
        <button class="theme-toggle-sidebar" id="themeToggleSidebar">
            <i class="fas fa-moon"></i>
            <span>Dark Mode</span>
        </button>
        <button type="button" class="logout-btn" id="logoutBtnSidebar" onclick="showLogoutModal()">
            <i class="fas fa-sign-out-alt"></i>
            <span>Keluar</span>
        </button>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</aside>

{{-- Navbar Atas --}}
<header class="app-header">
    <div class="header-left">
        <button class="mobile-toggle" id="mobileToggle">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    <div class="header-center">
        <ul class="nav-menu">
            <li><a href="/#services">Services</a></li>
            <li><a href="/#about">Company</a></li>
            <li><a href="{{ route('portfolio') }}">Portfolio</a></li>
        </ul>
    </div>

    <div class="header-right">
        <button class="theme-btn" id="themeToggleHeader">
            <i class="fas fa-moon"></i>
        </button>
        <a href="/#cta-bottom" class="btn-primary">Get In Touch</a>
        
        @auth
        <div class="user-dropdown">
            <button class="user-btn" id="userDropdownBtn">
                <div class="user-avatar">
                    @if(Auth::user()->profile_photo)
                        <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Client" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                    @else
                        {{ substr(Auth::user()->name ?? 'C', 0, 2) }}
                    @endif
                </div>
                <span>{{ Auth::user()->name ?? 'Client' }}</span>
                <i class="fas fa-chevron-down"></i>
            </button>
            <div class="dropdown-menu" id="userDropdownMenu">
                <a href="{{ route('client.dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
                <a href="{{ route('client.create-project') }}">
                    <i class="fas fa-handshake"></i> Ayo Kerjasama
                </a>
                <a href="{{ route('client.projects') }}">
                    <i class="fas fa-history"></i> History
                </a>
                <a href="{{ route('client.payments') }}">
                    <i class="fas fa-money-bill-wave"></i> Pembayaran
                </a>
                <a href="{{ route('client.profile') }}">
                    <i class="fas fa-user-circle"></i> Profil Saya
                </a>
                <div class="divider"></div>
                <button type="button" class="dropdown-logout-btn" onclick="showLogoutModal()">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </div>
        </div>
        @else
        <a href="#" data-modal="login-modal" class="btn-outline">Sign In</a>
        @endauth
    </div>
</header>

{{-- MODAL KONFIRMASI LOGOUT --}}
<div id="logoutModal" class="modal-overlay" style="display: none;">
    <div class="modal-container">
        <div class="modal-icon">
            <i class="fas fa-sign-out-alt"></i>
        </div>
        <h3 class="modal-title">Konfirmasi Logout</h3>
        <p class="modal-message">Apakah Anda yakin ingin keluar dari akun ini?</p>
        <div class="modal-buttons">
            <button type="button" class="modal-btn modal-btn-cancel" onclick="hideLogoutModal()">
                <i class="fas fa-times"></i> Batal
            </button>
            <button type="button" class="modal-btn modal-btn-confirm" onclick="confirmLogout()">
                <i class="fas fa-check"></i> Ya, Keluar
            </button>
        </div>
    </div>
</div>

<style>
/* ==================== VARIABLES ==================== */
:root {
    --sidebar-width: 280px;
    --header-height: 70px;
}

/* ==================== SIDEBAR ==================== */
.app-sidebar {
    width: var(--sidebar-width);
    background: var(--surface);
    border-right: 1px solid var(--border);
    position: fixed;
    left: 0;
    top: 0;
    bottom: 0;
    z-index: 1000;
    display: flex;
    flex-direction: column;
    transition: transform 0.3s ease;
}

.sidebar-brand {
    padding: 24px;
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    gap: 12px;
    position: relative;
    height: var(--header-height);
    padding-top: 0;
    padding-bottom: 0;
}

.brand-logo {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    overflow: hidden;
}

.brand-logo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.brand-name {
    font-family: var(--font-display);
    font-weight: 800;
    font-size: 1.3rem;
    letter-spacing: -1px;
    color: var(--text);
}

.brand-name .accent {
    color: var(--accent);
}

.brand-badge {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    right: 20px;
    background: linear-gradient(135deg, #10b981, #059669);
    color: #fff;
    font-size: 0.6rem;
    padding: 2px 8px;
    border-radius: 20px;
    font-weight: 700;
}

.sidebar-menu {
    flex: 1;
    padding: 24px 16px;
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.menu-item {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 12px 16px;
    color: var(--text-secondary);
    text-decoration: none;
    border-radius: 12px;
    transition: all 0.3s;
    font-weight: 500;
}

.menu-item i {
    width: 24px;
    font-size: 1.1rem;
}

.menu-item:hover {
    background: rgba(59, 130, 255, 0.08);
    color: var(--accent);
    transform: translateX(4px);
}

.menu-item.active {
    background: linear-gradient(90deg, rgba(59, 130, 255, 0.15), transparent);
    color: var(--accent);
    border-left: 2px solid var(--accent);
}

.sidebar-footer {
    padding: 20px 16px;
    border-top: 1px solid var(--border);
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.theme-toggle-sidebar, .logout-btn {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 10px 16px;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.3s;
    color: var(--text-secondary);
    font-size: 0.85rem;
    text-decoration: none;
    background: none;
    border: none;
    width: 100%;
}

.theme-toggle-sidebar:hover, .logout-btn:hover {
    background: rgba(59, 130, 255, 0.08);
    color: var(--accent);
    transform: translateX(4px);
}

/* Dropdown Logout Button */
.dropdown-logout-btn {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 16px;
    color: #ef4444;
    text-decoration: none;
    font-size: 0.85rem;
    background: none;
    border: none;
    width: 100%;
    text-align: left;
    cursor: pointer;
    transition: all 0.3s;
}

.dropdown-logout-btn:hover {
    background: rgba(239, 68, 68, 0.1);
    color: #dc2626;
}

.dropdown-logout-btn i {
    width: 20px;
}

/* ==================== HEADER ==================== */
.app-header {
    position: fixed;
    top: 0;
    left: var(--sidebar-width);
    right: 0;
    height: var(--header-height);
    background: var(--navbar-bg);
    backdrop-filter: blur(20px);
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 32px;
    z-index: 999;
}

/* Memastikan garis sejajar */
.app-sidebar {
    border-right: 1px solid var(--border);
}

.app-header {
    border-bottom: 1px solid var(--border);
}

@media (min-width: 769px) {
    .app-header {
        left: var(--sidebar-width);
    }
    
    .app-sidebar,
    .app-header {
        border-radius: 0;
    }
}

.header-left {
    display: flex;
    align-items: center;
}

.mobile-toggle {
    display: none;
    background: none;
    border: none;
    color: var(--text);
    font-size: 1.3rem;
    cursor: pointer;
}

.header-center {
    flex: 1;
    display: flex;
    justify-content: center;
}

.nav-menu {
    display: flex;
    align-items: center;
    gap: 32px;
    list-style: none;
}

.nav-menu li a {
    text-decoration: none;
    color: var(--text-secondary);
    font-weight: 500;
    font-size: 0.9rem;
    transition: color 0.3s;
}

.nav-menu li a:hover {
    color: var(--accent);
}

.header-right {
    display: flex;
    align-items: center;
    gap: 16px;
}

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
    transition: all 0.3s;
}

.theme-btn:hover {
    background: var(--accent);
}

.theme-btn i {
    font-size: 1.2rem;
    color: var(--text);
}

.btn-primary {
    background: linear-gradient(135deg, var(--accent), var(--accent-hover));
    color: #fff;
    padding: 8px 20px;
    border-radius: 40px;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.85rem;
}

.btn-outline {
    background: transparent;
    border: 1px solid var(--border);
    color: var(--text);
    padding: 8px 20px;
    border-radius: 40px;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.85rem;
}

.btn-outline:hover {
    border-color: var(--accent);
    color: var(--accent);
}

.user-dropdown {
    position: relative;
}

.user-btn {
    background: none;
    border: none;
    display: flex;
    align-items: center;
    gap: 10px;
    cursor: pointer;
    padding: 5px 10px;
    border-radius: 40px;
}

.user-btn:hover {
    background: rgba(59, 130, 255, 0.1);
}

.user-avatar {
    width: 36px;
    height: 36px;
    background: linear-gradient(135deg, var(--accent), var(--accent-hover));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    color: #fff;
    overflow: hidden;
}

.user-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.user-btn span {
    font-weight: 500;
    font-size: 0.85rem;
    color: var(--text);
}

.user-btn i {
    font-size: 0.7rem;
    color: var(--text-secondary);
}

.dropdown-menu {
    position: absolute;
    top: 50px;
    right: 0;
    width: 220px;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 12px;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: all 0.3s;
    z-index: 100;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}

.user-dropdown:hover .dropdown-menu {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.dropdown-menu a {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 16px;
    color: var(--text-secondary);
    text-decoration: none;
    font-size: 0.85rem;
}

.dropdown-menu a:hover {
    background: rgba(59, 130, 255, 0.08);
    color: var(--accent);
}

.dropdown-menu .divider {
    height: 1px;
    background: var(--border);
    margin: 6px 0;
}

/* ==================== MODAL LOGOUT ==================== */
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.7);
    backdrop-filter: blur(4px);
    z-index: 2000;
    display: flex;
    align-items: center;
    justify-content: center;
    animation: fadeIn 0.2s ease;
}

.modal-container {
    background: var(--surface);
    border-radius: 24px;
    padding: 32px;
    width: 90%;
    max-width: 400px;
    text-align: center;
    animation: slideUp 0.3s ease;
    border: 1px solid var(--border);
}

.modal-icon {
    width: 70px;
    height: 70px;
    background: rgba(239, 68, 68, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
}

.modal-icon i {
    font-size: 2.5rem;
    color: #ef4444;
}

.modal-title {
    font-family: var(--font-display);
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 12px;
    color: var(--text);
}

.modal-message {
    color: var(--text-secondary);
    margin-bottom: 28px;
    font-size: 0.9rem;
}

.modal-buttons {
    display: flex;
    gap: 12px;
}

.modal-btn {
    flex: 1;
    padding: 12px 20px;
    border-radius: 50px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    font-size: 0.9rem;
}

.modal-btn-cancel {
    background: var(--surface-alt);
    border: 1px solid var(--border);
    color: var(--text-secondary);
}

.modal-btn-cancel:hover {
    background: var(--border);
    transform: translateY(-2px);
}

.modal-btn-confirm {
    background: linear-gradient(135deg, #ef4444, #dc2626);
    border: none;
    color: #fff;
}

.modal-btn-confirm:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(239, 68, 68, 0.4);
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* ==================== MAIN CONTENT ==================== */
.app-main {
    margin-left: var(--sidebar-width);
    margin-top: var(--header-height);
    padding: 32px;
    min-height: calc(100vh - var(--header-height));
}

/* ==================== RESPONSIVE ==================== */
@media (max-width: 992px) {
    .nav-menu {
        gap: 20px;
    }
    
    .user-btn span {
        display: none;
    }
}

@media (max-width: 768px) {
    .app-sidebar {
        transform: translateX(-100%);
    }
    
    .app-sidebar.open {
        transform: translateX(0);
    }
    
    .app-header {
        left: 0;
        padding: 0 20px;
    }
    
    .mobile-toggle {
        display: block;
    }
    
    .nav-menu {
        position: fixed;
        top: var(--header-height);
        left: -100%;
        width: 100%;
        background: var(--surface);
        flex-direction: column;
        padding: 20px;
        gap: 16px;
        transition: left 0.3s;
        border-bottom: 1px solid var(--border);
    }
    
    .nav-menu.open {
        left: 0;
    }
    
    .app-main {
        margin-left: 0;
        margin-top: var(--header-height);
        padding: 20px;
    }
    
    .btn-primary {
        display: none;
    }
    
    .modal-container {
        padding: 24px;
        width: 85%;
    }
    
    .modal-icon {
        width: 55px;
        height: 55px;
    }
    
    .modal-icon i {
        font-size: 2rem;
    }
    
    .modal-title {
        font-size: 1.3rem;
    }
}

@media (max-width: 480px) {
    .header-right {
        gap: 10px;
    }
    
    .user-btn span {
        display: none;
    }
    
    .modal-buttons {
        flex-direction: column;
    }
}

/* ==================== ANIMATIONS ==================== */
@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}
</style>

<script>
    // Theme Toggle
    function initTheme() {
        const savedTheme = localStorage.getItem('theme') || 'dark';
        document.documentElement.setAttribute('data-theme', savedTheme);
        
        const moonIcons = document.querySelectorAll('.fa-moon');
        const sunIcons = document.querySelectorAll('.fa-sun');
        
        if (savedTheme === 'light') {
            moonIcons.forEach(icon => icon.style.display = 'none');
            sunIcons.forEach(icon => icon.style.display = 'flex');
        } else {
            moonIcons.forEach(icon => icon.style.display = 'flex');
            sunIcons.forEach(icon => icon.style.display = 'none');
        }
    }
    
    function toggleTheme() {
        const html = document.documentElement;
        const currentTheme = html.getAttribute('data-theme');
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
        html.setAttribute('data-theme', newTheme);
        localStorage.setItem('theme', newTheme);
        
        const moonIcons = document.querySelectorAll('.fa-moon');
        const sunIcons = document.querySelectorAll('.fa-sun');
        
        if (newTheme === 'light') {
            moonIcons.forEach(icon => icon.style.display = 'none');
            sunIcons.forEach(icon => icon.style.display = 'flex');
        } else {
            moonIcons.forEach(icon => icon.style.display = 'flex');
            sunIcons.forEach(icon => icon.style.display = 'none');
        }
    }
    
    document.getElementById('themeToggleHeader')?.addEventListener('click', toggleTheme);
    document.getElementById('themeToggleSidebar')?.addEventListener('click', toggleTheme);
    
    initTheme();
    
    // Mobile Sidebar Toggle
    const mobileToggle = document.getElementById('mobileToggle');
    const sidebar = document.querySelector('.app-sidebar');
    
    mobileToggle?.addEventListener('click', () => {
        sidebar?.classList.toggle('open');
    });
    
    // Close sidebar on click outside (mobile)
    document.addEventListener('click', (e) => {
        if (window.innerWidth <= 768 && sidebar?.classList.contains('open')) {
            if (!sidebar.contains(e.target) && !mobileToggle.contains(e.target)) {
                sidebar.classList.remove('open');
            }
        }
    });
    
    // User dropdown for mobile
    const userBtn = document.getElementById('userDropdownBtn');
    const userDropdown = document.getElementById('userDropdownMenu');
    
    if (userBtn && userDropdown && window.innerWidth <= 768) {
        userBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            userDropdown.classList.toggle('show');
        });
        
        document.addEventListener('click', () => {
            userDropdown.classList.remove('show');
        });
    }
    
    // ==================== LOGOUT MODAL FUNCTIONS ====================
    function showLogoutModal() {
        const modal = document.getElementById('logoutModal');
        if (modal) {
            modal.style.display = 'flex';
            // Prevent body scroll when modal is open
            document.body.style.overflow = 'hidden';
        }
    }
    
    function hideLogoutModal() {
        const modal = document.getElementById('logoutModal');
        if (modal) {
            modal.style.display = 'none';
            document.body.style.overflow = '';
        }
    }
    
    function confirmLogout() {
        // Submit the logout form
        document.getElementById('logout-form').submit();
    }
    
    // Close modal when clicking outside
    document.addEventListener('click', function(e) {
        const modal = document.getElementById('logoutModal');
        if (modal && modal.style.display === 'flex') {
            if (e.target === modal) {
                hideLogoutModal();
            }
        }
    });
    
    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            hideLogoutModal();
        }
    });
</script>