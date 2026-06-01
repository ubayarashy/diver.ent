<div class="team-sidebar" id="teamSidebar">
    <div class="sidebar-header">
        <div class="logo">
            <div class="logo-circle">
                <img src="{{ asset('img/logo.png') }}" alt="diver.ent">
            </div>
            <span>diver.<span class="accent">ent</span></span>
        </div>
        <button class="sidebar-close" id="sidebarClose"><i class="fas fa-times"></i></button>
    </div>

    <div class="sidebar-profile">
        <div class="avatar">{{ substr(Auth::user()->name ?? 'T', 0, 2) }}</div>
        <div class="info">
            <h4>{{ Auth::user()->name ?? 'Team User' }}</h4>
            <p>Divisi: {{ Auth::user()->divisi }}</p>
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
        <a href="{{ route('team.notifications') }}" class="nav-item {{ request()->routeIs('team.notifications') ? 'active' : '' }}">
            <i class="fas fa-bell"></i> Notifications
        </a>
        <a href="{{ route('team.profile') }}" class="nav-item {{ request()->routeIs('team.profile') ? 'active' : '' }}">
            <i class="fas fa-user-circle"></i> Profile
        </a>
    </nav>

    <div class="sidebar-footer">
        <form action="{{ route('logout') }}" method="POST" id="logout-form-sidebar">
            @csrf
            <button type="button" class="logout-btn" id="sidebar-logout-btn"><i class="fas fa-sign-out-alt"></i> Keluar</button>
        </form>
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
    display: flex;
    flex-direction: column;
    transition: transform 0.3s;
}
.sidebar-header {
    padding: 24px;
    border-bottom: 1px solid var(--border);
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.logo {
    display: flex;
    align-items: center;
    gap: 8px;
    font-weight: 800;
    font-family: var(--font-display);
    font-size: 1.2rem;
}
.logo-circle {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: var(--accent);
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}
.logo-circle img {
    width: 24px;
    height: 24px;
    object-fit: contain;
}
.logo .accent { color: var(--accent); }
.sidebar-close { display: none; background: none; border: none; color: var(--text-secondary); font-size: 1.2rem; cursor: pointer; }
.sidebar-profile {
    padding: 24px;
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    gap: 12px;
}
.avatar {
    width: 48px;
    height: 48px;
    background: linear-gradient(135deg, var(--accent), var(--accent-hover));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    color: white;
}
.sidebar-profile .info h4 { font-size: 0.9rem; margin-bottom: 4px; }
.sidebar-profile .info p { font-size: 0.7rem; color: var(--text-secondary); }
.sidebar-nav {
    flex: 1;
    padding: 24px 16px;
    display: flex;
    flex-direction: column;
    gap: 8px;
}
.nav-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 16px;
    border-radius: 12px;
    color: var(--text-secondary);
    text-decoration: none;
    transition: all 0.3s;
}
.nav-item i { width: 24px; }
.nav-item:hover, .nav-item.active {
    background: rgba(59,130,255,0.1);
    color: var(--accent);
}
.sidebar-footer {
    padding: 20px;
    border-top: 1px solid var(--border);
}
.logout-btn {
    width: 100%;
    background: none;
    border: 1px solid var(--border);
    padding: 10px;
    border-radius: 12px;
    color: var(--text-secondary);
    display: flex;
    align-items: center;
    gap: 12px;
    cursor: pointer;
    transition: 0.3s;
}
.logout-btn:hover { border-color: var(--danger); color: var(--danger); }
@media (max-width: 768px) {
    .team-sidebar { transform: translateX(-100%); }
    .team-sidebar.open { transform: translateX(0); }
    .sidebar-close { display: block; }
}
</style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const logoutBtn = document.getElementById('sidebar-logout-btn');
        const logoutForm = document.getElementById('logout-form-sidebar');
        if (!logoutBtn || !logoutForm) {
            return;
        }

        const logoutUrl = logoutForm.action;
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content
            || logoutForm.querySelector('input[name="_token"]')?.value;

        logoutBtn.addEventListener('click', function (e) {
            e.preventDefault();

            Swal.fire({
                title: 'Konfirmasi Keluar',
                text: 'Apakah Anda yakin ingin keluar?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3B82FF',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Keluar',
                cancelButtonText: 'Batal',
            }).then(async (result) => {
                if (!result.isConfirmed) {
                    return;
                }

                Swal.fire({
                    title: 'Keluar...',
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading(),
                });

                try {
                    const response = await fetch(logoutUrl, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                        credentials: 'same-origin',
                    });

                    const data = await response.json();

                    if (response.ok && data.success && data.redirect) {
                        window.location.href = data.redirect;
                        return;
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal Keluar',
                        text: data.message || 'Logout gagal. Silakan coba lagi.',
                    });
                } catch {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal Keluar',
                        text: 'Terjadi kesalahan saat logout. Silakan coba lagi.',
                    });
                }
            });
        });
    });
</script>