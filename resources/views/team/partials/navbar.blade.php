<div class="team-navbar">
    <button class="menu-toggle" id="menuToggle"><i class="fas fa-bars"></i></button>
    <div class="navbar-right">
        <div class="notif-icon" onclick="window.location.href='{{ route('team.notifications') }}'">
            <i class="fas fa-bell"></i>
            <span class="badge">0</span>
        </div>
        <div class="user-dropdown">
            <div class="user-avatar" id="userAvatar">{{ substr(Auth::user()->name ?? 'T', 0, 2) }}</div>
            <div class="dropdown-menu" id="dropdownMenu">
                <a href="{{ route('team.profile') }}"><i class="fas fa-user"></i> Profile</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"><i class="fas fa-sign-out-alt"></i> Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
.team-navbar {
    background: var(--navbar-bg);
    backdrop-filter: blur(20px);
    border-bottom: 1px solid var(--border);
    height: 70px;
    display: flex;
    align-items: center;
    justify-content: flex-end;
    padding: 0 24px;
    position: sticky;
    top: 0;
    z-index: 99;
}
.menu-toggle {
    display: none;
    background: none;
    border: none;
    color: var(--text-primary);
    font-size: 1.3rem;
    cursor: pointer;
    margin-right: auto;
}
.navbar-right {
    display: flex;
    align-items: center;
    gap: 24px;
}
.notif-icon {
    position: relative;
    cursor: pointer;
}
.notif-icon .badge {
    position: absolute;
    top: -8px;
    right: -8px;
    background: var(--accent);
    color: #000;
    font-size: 0.7rem;
    padding: 2px 6px;
    border-radius: 20px;
}
.user-dropdown {
    position: relative;
}
.user-avatar {
    width: 42px;
    height: 42px;
    background: linear-gradient(135deg, var(--accent), var(--accent-hover));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    color: white;
    cursor: pointer;
}
.dropdown-menu {
    position: absolute;
    top: 55px;
    right: 0;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 12px;
    width: 180px;
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
.dropdown-menu a, .dropdown-menu button {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 16px;
    width: 100%;
    background: none;
    border: none;
    color: var(--text-primary);
    text-align: left;
    cursor: pointer;
}
.dropdown-menu a:hover, .dropdown-menu button:hover {
    background: rgba(59,130,255,0.1);
}
@media (max-width: 768px) {
    .menu-toggle { display: block; }
}
</style>

<script>
    document.getElementById('userAvatar')?.addEventListener('click', function(e) {
        e.stopPropagation();
        document.getElementById('dropdownMenu').classList.toggle('show');
    });
    document.addEventListener('click', function() {
        document.getElementById('dropdownMenu')?.classList.remove('show');
    });
    document.getElementById('menuToggle')?.addEventListener('click', function() {
        document.getElementById('teamSidebar').classList.toggle('open');
    });
</script>