<div class="admin-sidebar" id="adminSidebar">
    

    <!-- HEADER -->

    <div class="sidebar-header">

        <div class="logo">
            diver.<span class="accent">ent</span>
        </div>

        <button class="sidebar-close" id="sidebarClose">
            <i class="fas fa-times"></i>
        </button>

    </div>

    <!-- PROFILE -->

    <div class="sidebar-profile">

        <div class="sidebar-avatar">

            @if(Auth::user()->profile_photo)

                <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}"
                     alt="Admin">

            @else

                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}

            @endif

        </div>

        <div class="sidebar-user-info">

            <h4>{{ Auth::user()->name ?? 'Admin' }}</h4>

            <p>Administrator</p>

        </div>

    </div>

    <!-- NAVIGATION -->

    <nav class="sidebar-nav">

        <!-- DASHBOARD -->

        <a href="{{ route('admin.dashboard') }}"
           class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">

            <i class="fas fa-tachometer-alt"></i>

            <span>Dashboard</span>

        </a>

        <!-- BRIEF -->

        <a href="{{ route('admin.briefs') }}"
           class="nav-item {{ request()->routeIs('admin.briefs') ? 'active' : '' }}">

            <i class="fas fa-file-alt"></i>

            <span>Brief Client</span>

        </a>

        <!-- CLIENT -->

        <a href="{{ route('admin.clients') }}"
           class="nav-item {{ request()->routeIs('admin.clients') ? 'active' : '' }}">

            <i class="fas fa-users"></i>

            <span>Client</span>

        </a>

        <!-- TEAM DROPDOWN -->

        <div class="nav-group {{ request()->routeIs('admin.teams*') || request()->routeIs('admin.team-create*') || request()->routeIs('admin.team-edit*') ? 'open' : '' }}">

            <div class="nav-group-title">

                <div class="nav-group-left">

                    <i class="fas fa-user-friends"></i>

                    <span>Team</span>

                </div>

                <i class="fas fa-chevron-down"></i>

            </div>

            <div class="nav-group-items">

                <a href="{{ route('admin.teams') }}"
                   class="nav-subitem {{ request()->routeIs('admin.teams') ? 'active' : '' }}">

                    <i class="fas fa-list"></i>

                    <span>Daftar Team</span>

                </a>

                <a href="{{ route('admin.team-create') }}"
                   class="nav-subitem {{ request()->routeIs('admin.team-create') ? 'active' : '' }}">

                    <i class="fas fa-user-plus"></i>

                    <span>Tambah Team</span>

                </a>

            </div>

        </div>

        <!-- PORTFOLIO -->

        <a href="{{ route('admin.portfolio') }}"
           class="nav-item {{ request()->routeIs('admin.portfolio') ? 'active' : '' }}">

            <i class="fas fa-folder-open"></i>

            <span>Portfolio</span>

        </a>

        <!-- ANALYTICS -->

        <a href="{{ route('admin.analytics') }}"
           class="nav-item {{ request()->routeIs('admin.analytics') ? 'active' : '' }}">

            <i class="fas fa-chart-line"></i>

            <span>Analytics</span>

        </a>

        <!-- PROFILE -->

        <a href="{{ route('admin.profile') }}"
           class="nav-item {{ request()->routeIs('admin.profile') ? 'active' : '' }}">

            <i class="fas fa-user-circle"></i>

            <span>Profile</span>

        </a>

        <!-- FOOTER -->

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

    </nav>

</div>

<!-- TOP NAVBAR -->

<div class="admin-top-navbar">

    <button class="menu-toggle" id="menuToggle">
        <i class="fas fa-bars"></i>
    </button>

    <div class="admin-profile-dropdown">

        <div class="admin-avatar" id="adminAvatar">

            @if(Auth::user()->profile_photo)

                <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}"
                     alt="Admin">

            @else

                {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 2)) }}

            @endif

        </div>

        <div class="dropdown-menu" id="adminDropdown">

            <a href="{{ route('admin.profile') }}">

                <i class="fas fa-user"></i>

                Profile

            </a>

            <div class="dropdown-divider"></div>

            <div onclick="openLogoutModal()">

                <i class="fas fa-sign-out-alt"></i>

                Logout

            </div>

        </div>

    </div>

</div>

<!-- LOGOUT MODAL -->

<div class="logout-modal" id="logout-modal">

    <div class="logout-modal-content">

        <div class="logout-icon">

            <i class="fas fa-sign-out-alt"></i>

        </div>

        <h3>Konfirmasi Logout</h3>

        <p>Apakah kamu yakin ingin keluar?</p>

        <div class="logout-actions">

            <button class="cancel-btn"
                    onclick="closeLogoutModal()">

                Batal

            </button>

            <form method="POST"
                  action="{{ route('logout') }}">

                @csrf

                <button type="submit"
                        class="confirm-btn">

                    Logout

                </button>

            </form>

        </div>

    </div>

</div>

<style>

body {
    background: var(--bg);
    color: var(--text);
    transition: all 0.3s ease;
}

/* ================= SIDEBAR ================= */

.admin-sidebar {
    width: 280px;
    background: var(--surface);
    border-right: 1px solid var(--border);
    position: fixed;
    left: 0;
    top: 0;
    bottom: 0;
    z-index: 1000;
    overflow-y: auto;
    transition: transform 0.3s;
}

.sidebar-header {
    padding: 24px;
    border-bottom: 1px solid var(--border);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.sidebar-header .logo {
    font-family: var(--font-display);
    font-weight: 800;
    font-size: 1.3rem;
}

.sidebar-header .logo .accent {
    color: var(--accent);
}

.sidebar-close {
    background: none;
    border: none;
    color: var(--text-secondary);
    font-size: 1.2rem;
    cursor: pointer;
    display: none;
}

/* ================= PROFILE ================= */

.sidebar-profile {
    padding: 24px;
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    gap: 16px;
}

.sidebar-avatar,
.admin-avatar {

    background: linear-gradient(
        135deg,
        var(--accent),
        var(--accent-hover)
    );

    border-radius: 50%;

    overflow: hidden;

    display: flex;
    align-items: center;
    justify-content: center;

    font-weight: 700;
    color: #fff;

    flex-shrink: 0;
}

.sidebar-avatar {
    width: 48px;
    height: 48px;
}

.admin-avatar {
    width: 44px;
    height: 44px;
    cursor: pointer;
}

.sidebar-avatar img,
.admin-avatar img {

    width: 100%;
    height: 100%;

    object-fit: cover;

    border-radius: 50%;

    display: block;
}

.sidebar-user-info h4 {
    font-weight: 700;
    font-size: 0.9rem;
    margin-bottom: 4px;
}

.sidebar-user-info p {
    font-size: 0.75rem;
    color: var(--text-secondary);
}

/* ================= NAVIGATION ================= */

.sidebar-nav {
    padding: 16px;
    display: flex;
    flex-direction: column;
    height: calc(100% - 180px);
}

.nav-item,
.nav-group-title {

    display: flex;
    align-items: center;
    gap: 14px;

    padding: 12px 16px;

    color: var(--text-secondary);

    text-decoration: none;

    border-radius: 12px;

    margin-bottom: 4px;

    transition: all 0.3s;
}

.nav-item:hover,
.nav-item.active,
.nav-group-title:hover {

    background: rgba(59,130,255,0.1);

    color: var(--accent);
}

.nav-group {
    margin-bottom: 4px;
}

.nav-group-title {
    cursor: pointer;
    justify-content: space-between;
}

.nav-group-left {
    display: flex;
    align-items: center;
    gap: 14px;
}

.nav-group-title i:last-child {
    font-size: 0.8rem;
    transition: transform 0.3s;
}

.nav-group.open .nav-group-title i:last-child {
    transform: rotate(180deg);
}

.nav-group-items {
    padding-left: 32px;
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease;
}

.nav-group.open .nav-group-items {
    max-height: 200px;
}

.nav-subitem {

    display: flex;
    align-items: center;
    gap: 12px;

    padding: 10px 16px;

    color: var(--text-secondary);

    text-decoration: none;

    border-radius: 10px;

    margin-bottom: 2px;

    font-size: 0.85rem;

    transition: all 0.3s;
}

.nav-subitem:hover,
.nav-subitem.active {

    background: rgba(59,130,255,0.08);

    color: var(--accent);
}

/* ================= FOOTER ================= */

.sidebar-footer {
    margin-top: auto;
    padding: 20px 16px;
    border-top: 1px solid var(--border);
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.sidebar-theme-toggle,
.sidebar-logout {

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

.sidebar-theme-toggle:hover,
.sidebar-logout:hover {

    background: rgba(59,130,255,0.08);

    color: var(--accent);

    transform: translateX(6px);
}

/* ================= TOP NAVBAR ================= */

.admin-top-navbar {

    position: fixed;

    top: 0;
    right: 0;
    left: 280px;

    height: 70px;

    background: var(--navbar-bg);

    backdrop-filter: blur(20px);

    border-bottom: 1px solid var(--border);

    display: flex;
    align-items: center;
    justify-content: flex-end;

    padding: 0 32px;

    z-index: 999;
}

.menu-toggle {
    display: none;
    background: none;
    border: none;
    color: var(--text);
    font-size: 1.3rem;
    cursor: pointer;
}

/* ================= DROPDOWN ================= */

.admin-profile-dropdown {
    position: relative;
}

.dropdown-menu {

    position: absolute;

    top: 55px;
    right: 0;

    background: var(--surface);

    border: 1px solid var(--border);

    border-radius: 12px;

    min-width: 180px;

    opacity: 0;
    visibility: hidden;

    transform: translateY(-10px);

    transition: all 0.3s;

    z-index: 100;
}

.dropdown-menu.show {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.dropdown-menu a,
.dropdown-menu div {

    display: flex;
    align-items: center;
    gap: 12px;

    padding: 12px 20px;

    color: var(--text);

    text-decoration: none;

    cursor: pointer;
}

.dropdown-menu a:hover,
.dropdown-menu div:hover {

    background: rgba(59,130,255,0.1);

    color: var(--accent);
}

.dropdown-divider {
    height: 1px;
    background: var(--border);
    margin: 4px 0;
}

/* ================= LOGOUT MODAL ================= */

.logout-modal {

    position: fixed;

    inset: 0;

    background: rgba(0,0,0,0.6);

    backdrop-filter: blur(4px);

    display: none;

    align-items: center;
    justify-content: center;

    z-index: 9999;
}

.logout-modal-content {

    width: 90%;
    max-width: 400px;

    background: var(--surface);

    border: 1px solid var(--border);

    border-radius: 24px;

    padding: 32px;

    text-align: center;
}

.logout-icon {

    width: 70px;
    height: 70px;

    margin: 0 auto 20px;

    background: rgba(239,68,68,0.1);

    color: #ef4444;

    border-radius: 50%;

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 1.8rem;
}

.logout-actions {
    display: flex;
    gap: 12px;
    margin-top: 24px;
}

.logout-actions button {

    flex: 1;

    padding: 12px;

    border-radius: 14px;

    border: none;

    cursor: pointer;

    font-weight: 600;
}

.cancel-btn {
    background: var(--surface-alt);
    color: var(--text);
}

.confirm-btn {
    background: #ef4444;
    color: white;
}

/* ================= RESPONSIVE ================= */

@media (max-width: 768px) {

    .admin-sidebar {
        transform: translateX(-100%);
    }

    .admin-sidebar.open {
        transform: translateX(0);
    }

    .sidebar-close {
        display: block;
    }

    .admin-top-navbar {
        left: 0;
    }

    .menu-toggle {
        display: block;
        margin-right: auto;
    }
}

</style>

<script>

document.addEventListener('DOMContentLoaded', function () {

    // SIDEBAR TOGGLE

    document.getElementById('menuToggle')
        ?.addEventListener('click', () => {

        document.getElementById('adminSidebar')
            ?.classList.toggle('open');

    });

    document.getElementById('sidebarClose')
        ?.addEventListener('click', () => {

        document.getElementById('adminSidebar')
            ?.classList.remove('open');

    });

    // TEAM DROPDOWN

    document.querySelectorAll('.nav-group-title')
        .forEach(title => {

        title.addEventListener('click', () => {

            const group = title.closest('.nav-group');

            group.classList.toggle('open');

        });

    });

    // PROFILE DROPDOWN

    document.getElementById('adminAvatar')
        ?.addEventListener('click', (e) => {

        e.stopPropagation();

        document.getElementById('adminDropdown')
            ?.classList.toggle('show');

    });

    document.addEventListener('click', () => {

        document.getElementById('adminDropdown')
            ?.classList.remove('show');

    });

    // THEME TOGGLE

    const themeToggle = document.getElementById('themeToggle');

    const savedTheme = localStorage.getItem('theme');

    if(savedTheme){

        document.documentElement
            .setAttribute('data-theme', savedTheme);

    }

    if(themeToggle){

        themeToggle.addEventListener('click', function(){

            const html = document.documentElement;

            const currentTheme =
                html.getAttribute('data-theme');

            const newTheme =
                currentTheme === 'dark'
                    ? 'light'
                    : 'dark';

            html.setAttribute('data-theme', newTheme);

            localStorage.setItem('theme', newTheme);

        });
    }

});

// LOGOUT MODAL

window.openLogoutModal = function(){

    const modal =
        document.getElementById('logout-modal');

    if(modal){

        modal.style.display = 'flex';

        document.body.style.overflow = 'hidden';
    }
}

window.closeLogoutModal = function(){

    const modal =
        document.getElementById('logout-modal');

    if(modal){

        modal.style.display = 'none';

        document.body.style.overflow = 'auto';
    }
}

</script>