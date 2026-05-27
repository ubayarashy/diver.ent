{{-- Navbar Khusus Admin untuk Halaman Admin --}}
<nav class="admin-navbar">
    <div class="admin-navbar-container">
        <div class="admin-navbar-left">
            <button class="admin-sidebar-toggle" id="adminSidebarToggle">
                <i class="fas fa-bars"></i>
            </button>
            <a href="{{ route('admin.dashboard') }}" class="admin-logo">
                <img src="{{ asset('img/logo.png') }}" alt="diver.ent">
                <span>diver.<span class="accent">ent</span></span>
                <small>Admin</small>
            </a>
        </div>

        <div class="admin-navbar-center">
            <div class="admin-breadcrumb">
                @if(request()->routeIs('admin.dashboard'))
                    Dashboard
                @elseif(request()->routeIs('admin.briefs*'))
                    Brief Client
                @elseif(request()->routeIs('admin.payments*'))
                    Pembayaran
                @elseif(request()->routeIs('admin.portfolios*'))
                    Portfolio
                @elseif(request()->routeIs('admin.clients*'))
                    Client
                @elseif(request()->routeIs('admin.teams*'))
                    Team
                @elseif(request()->routeIs('admin.tasks*'))
                    Task
                @elseif(request()->routeIs('admin.analytics'))
                    Analytics
                @elseif(request()->routeIs('admin.profile'))
                    Profile
                @else
                    Admin Panel
                @endif
            </div>
        </div>

        <div class="admin-navbar-right">
            <button class="admin-theme-btn" id="adminThemeToggle">
                <i class="fas fa-moon"></i>
                <i class="fas fa-sun" style="display: none;"></i>
            </button>
            <a href="/" class="admin-view-site">
                <i class="fas fa-globe"></i> View Site
            </a>
            <div class="admin-user-dropdown">
                <button class="admin-user-btn" id="adminUserBtn">
                    <div class="admin-user-avatar">
                        @if(Auth::user()->profile_photo)
                            <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Admin">
                        @else
                            {{ substr(Auth::user()->name ?? 'A', 0, 2) }}
                        @endif
                    </div>
                    <span>{{ Auth::user()->name ?? 'Admin' }}</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="admin-dropdown-menu" id="adminDropdownMenu">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                    <a href="{{ route('admin.profile') }}">
                        <i class="fas fa-user-circle"></i> Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-navbar').submit();">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>

<style>
.admin-navbar {
    background: var(--navbar-bg);
    backdrop-filter: blur(20px);
    border-bottom: 1px solid var(--border);
    position: fixed;
    top: 0;
    left: 280px;
    right: 0;
    height: 70px;
    z-index: 999;
}

.admin-navbar-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    height: 100%;
    padding: 0 32px;
}

.admin-navbar-left {
    display: flex;
    align-items: center;
    gap: 20px;
}

.admin-sidebar-toggle {
    background: none;
    border: none;
    color: var(--text);
    font-size: 1.3rem;
    cursor: pointer;
    display: none;
}

.admin-logo {
    display: flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
}

.admin-logo img {
    width: 32px;
    height: 32px;
    border-radius: 50%;
}

.admin-logo span {
    font-family: var(--font-display);
    font-weight: 800;
    font-size: 1.2rem;
    color: var(--text);
}

.admin-logo span .accent {
    color: var(--accent);
}

.admin-logo small {
    background: var(--accent);
    color: #000;
    padding: 2px 8px;
    border-radius: 20px;
    font-size: 0.6rem;
    font-weight: 700;
}

.admin-breadcrumb {
    font-size: 0.85rem;
    color: var(--text-secondary);
}

.admin-navbar-right {
    display: flex;
    align-items: center;
    gap: 16px;
}

.admin-theme-btn {
    background: var(--surface-alt);
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
}

.admin-view-site {
    color: var(--text-secondary);
    text-decoration: none;
    font-size: 0.85rem;
    display: flex;
    align-items: center;
    gap: 6px;
}

.admin-view-site:hover {
    color: var(--accent);
}

.admin-user-dropdown {
    position: relative;
}

.admin-user-btn {
    display: flex;
    align-items: center;
    gap: 10px;
    background: none;
    border: none;
    cursor: pointer;
    padding: 5px 10px;
    border-radius: 40px;
}

.admin-user-btn:hover {
    background: rgba(59, 130, 255, 0.1);
}

.admin-user-avatar {
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

.admin-user-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.admin-user-btn span {
    font-weight: 500;
    font-size: 0.85rem;
    color: var(--text);
}

.admin-user-btn i {
    font-size: 0.7rem;
    color: var(--text-secondary);
}

.admin-dropdown-menu {
    position: absolute;
    top: 50px;
    right: 0;
    width: 200px;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 12px;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: all 0.3s;
    z-index: 100;
}

.admin-user-dropdown:hover .admin-dropdown-menu {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.admin-dropdown-menu a {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 16px;
    color: var(--text-secondary);
    text-decoration: none;
    font-size: 0.85rem;
}

.admin-dropdown-menu a:hover {
    background: rgba(59, 130, 255, 0.08);
    color: var(--accent);
}

.dropdown-divider {
    height: 1px;
    background: var(--border);
    margin: 6px 0;
}

@media (max-width: 768px) {
    .admin-navbar {
        left: 0;
    }
    .admin-sidebar-toggle {
        display: block;
    }
    .admin-navbar-container {
        padding: 0 20px;
    }
    .admin-breadcrumb {
        display: none;
    }
    .admin-view-site span {
        display: none;
    }
}
</style>

<script>
    // Theme toggle untuk admin navbar
    const adminThemeToggle = document.getElementById('adminThemeToggle');
    if (adminThemeToggle) {
        adminThemeToggle.addEventListener('click', () => {
            const html = document.documentElement;
            const currentTheme = html.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            html.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            
            const moonIcon = adminThemeToggle.querySelector('.fa-moon');
            const sunIcon = adminThemeToggle.querySelector('.fa-sun');
            if (newTheme === 'light') {
                moonIcon.style.display = 'none';
                sunIcon.style.display = 'flex';
            } else {
                moonIcon.style.display = 'flex';
                sunIcon.style.display = 'none';
            }
        });
    }
    
    // Sidebar toggle untuk admin
    const adminSidebarToggle = document.getElementById('adminSidebarToggle');
    const adminSidebar = document.getElementById('appSidebar');
    if (adminSidebarToggle && adminSidebar) {
        adminSidebarToggle.addEventListener('click', () => {
            adminSidebar.classList.toggle('open');
        });
    }
</script>