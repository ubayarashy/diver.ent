<div class="team-sidebar" id="teamSidebar">
    <div class="sidebar-header">
        <div class="logo">diver.<span class="accent">ent</span></div>
        <button class="sidebar-close" id="sidebarClose">✕</button>
    </div>

    <div class="sidebar-profile">
        <div class="sidebar-avatar">
            {{ substr(Auth::user()->name ?? 'T', 0, 2) }}
        </div>
        <div class="sidebar-user-info">
            <h4>{{ Auth::user()->name ?? 'Team' }}</h4>
            <p>Team Member</p>
        </div>
    </div>

    <nav class="sidebar-nav">
        <a href="{{ route('team.dashboard') }}" class="nav-item {{ request()->routeIs('team.dashboard') ? 'active' : '' }}">
            <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>
        <a href="{{ route('team.tasks') }}" class="nav-item {{ request()->routeIs('team.tasks') ? 'active' : '' }}">
            <i class="fas fa-tasks"></i> My Tasks
        </a>
        <a href="{{ route('team.calendar') }}" class="nav-item {{ request()->routeIs('team.calendar') ? 'active' : '' }}">
            <i class="fas fa-calendar-alt"></i> Calendar
        </a>
       
        <a href="{{ route('team.profile') }}" class="nav-item {{ request()->routeIs('team.profile') ? 'active' : '' }}">
            <i class="fas fa-user-circle"></i> Profile
        </a>
    </nav>

    <div class="sidebar-footer">
        <div class="sidebar-logout" onclick="openLogoutModal()">
            <i class="fas fa-sign-out-alt"></i> Logout
        </div>
    </div>
</div>

<style>
.team-sidebar {
    width: 280px;
    background: var(--surface);
    border-right: 1px solid var(--border);
    position: fixed;
    left: 0;
    top: 0;
    bottom: 0;
    z-index: 100;
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

.sidebar-profile {
    padding: 24px;
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    gap: 16px;
}

.sidebar-avatar {
    width: 48px;
    height: 48px;
    background: linear-gradient(135deg, var(--accent), var(--accent-hover));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    color: #fff;
}

.sidebar-user-info h4 {
    font-size: 0.9rem;
    margin-bottom: 4px;
}

.sidebar-user-info p {
    font-size: 0.7rem;
    color: var(--text-secondary);
}

.sidebar-nav {
    padding: 16px;
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.nav-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 16px;
    color: var(--text-secondary);
    text-decoration: none;
    border-radius: 12px;
    transition: all 0.3s;
}

.nav-item:hover, .nav-item.active {
    background: rgba(59, 130, 255, 0.1);
    color: var(--accent);
}

.sidebar-footer {
    padding: 20px;
    border-top: 1px solid var(--border);
    margin-top: auto;
}

.sidebar-logout {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 16px;
    border-radius: 12px;
    cursor: pointer;
    color: #ef4444;
}

.sidebar-logout:hover {
    background: rgba(239, 68, 68, 0.1);
}

@media (max-width: 768px) {
    .team-sidebar {
        transform: translateX(-100%);
    }
    .team-sidebar.open {
        transform: translateX(0);
    }
}
</style>