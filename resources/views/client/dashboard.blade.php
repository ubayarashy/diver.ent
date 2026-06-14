@extends('layouts.app')
@section('content')
@include('partials.client.navbar-sidebar')

<div class="app-main">
    <div class="app-content">
        <div class="welcome-section">
            <div class="welcome-badge">Welcome Back</div>
            <h1>Halo, <span class="highlight">{{ Auth::user()->name ?? 'User' }}</span>!</h1>
            <p>Kelola kerjasama dan pantau progress project Anda di sini.</p>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-handshake"></i></div>
                <div class="stat-value">{{ $totalBriefs ?? 0 }}</div>
                <div class="stat-label">Total Kerjasama</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-clock"></i></div>
                <div class="stat-value">{{ $pendingBriefs ?? 0 }}</div>
                <div class="stat-label">Menunggu Respon</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
                <div class="stat-value">{{ $approvedBriefs ?? 0 }}</div>
                <div class="stat-label">Disetujui</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-chart-line"></i></div>
                <div class="stat-value">{{ ($totalBriefs ?? 0) - ($approvedBriefs ?? 0) }}</div>
                <div class="stat-label">Dalam Proses</div>
            </div>
        </div>

        <div class="quick-action-card">
            <div class="quick-action-content">
                <h3>Mulai Kerjasama Baru</h3>
                <p>Isi brief project Anda, tim kami akan segera menghubungi.</p>
                <a href="{{ route('client.create-project') }}" class="btn-primary">Ayo Kerjasama</a>
            </div>
            <div class="quick-action-icon">
                <i class="fas fa-rocket"></i>
            </div>
        </div>

        <div class="recent-section">
            <div class="section-header">
                <h3>Kerjasama Terbaru</h3>
                <a href="{{ route('client.projects') }}">Lihat Semua</a>
            </div>

            @php
                $recentBriefs = App\Models\Brief::where('user_id', Auth::id())->orderBy('created_at', 'desc')->limit(5)->get();
            @endphp

            @if($recentBriefs->count() > 0)
                <div class="brief-list">
                    @foreach($recentBriefs as $brief)
                    <div class="brief-item">
                        <div class="brief-icon"><i class="fas fa-file-alt"></i></div>
                        <div class="brief-info">
                            <h4>{{ $brief->project_name }}</h4>
                            <p>{{ $brief->created_at->format('d M Y H:i') }}</p>
                            <div class="brief-categories">
                                @foreach($brief->categories as $cat)
                                <span class="cat-tag">{{ $cat }}</span>
                                @endforeach
                            </div>
                        </div>
                        <div class="brief-status">
                            @if($brief->status == 'pending')
                                <span class="status-badge status-pending">Menunggu</span>
                            @elseif($brief->status == 'contacted')
                                <span class="status-badge status-contacted">Akan Dihubungi</span>
                            @elseif($brief->status == 'approved')
                                <span class="status-badge status-approved">Disetujui</span>
                            @else
                                <span class="status-badge status-rejected">Ditolak</span>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-icon"><i class="fas fa-inbox"></i></div>
                    <h4>Belum Ada Kerjasama</h4>
                    <p>Mulai kerjasama pertama Anda dengan diver.ent</p>
                    <a href="{{ route('client.create-project') }}" class="btn-outline">Ayo Kerjasama</a>
                </div>
            @endif
        </div>
    </div>
</div>

<div id="logout-modal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.7); backdrop-filter: blur(8px); z-index: 1000; justify-content: center; align-items: center;">
    <div style="background: var(--surface); border: 1px solid var(--border); border-radius: 20px; padding: 32px; max-width: 400px; width: 90%; text-align: center;">
        <i class="fas fa-question-circle" style="font-size: 48px; color: var(--accent); margin-bottom: 16px;"></i>
        <h3 style="margin-bottom: 8px;">Konfirmasi Keluar</h3>
        <p style="color: var(--text-secondary); margin-bottom: 24px;">Apakah Anda yakin ingin keluar?</p>
        <div style="display: flex; gap: 12px; justify-content: center;">
            <button onclick="closeLogoutModal()" class="btn-outline">Batal</button>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-primary">Keluar</button>
            </form>
        </div>
    </div>
</div>

<style>
.app-main {
    margin-left: 280px;
    min-height: 100vh;
    background: var(--bg);
    padding-top: 10px;
}

.app-content {
    max-width: 1200px;
    margin: 0 auto;
    padding: 40px 48px;
}

.welcome-section {
    margin-bottom: 40px;
}

.welcome-badge {
    display: inline-flex;
    align-items: center;
    background: rgba(59, 130, 255, 0.1);
    padding: 5px 14px;
    border-radius: 30px;
    font-size: 0.7rem;
    font-weight: 600;
    color: var(--accent);
    margin-bottom: 16px;
    letter-spacing: 0.5px;
}

.welcome-section h1 {
    font-family: var(--font-display);
    font-size: 2rem;
    font-weight: 700;
    letter-spacing: -0.02em;
    margin-bottom: 8px;
}

.welcome-section .highlight {
    color: var(--accent);
}

.welcome-section p {
    color: var(--text-secondary);
    font-size: 0.9rem;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin-bottom: 40px;
}

.stat-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 20px;
    padding: 24px;
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-3px);
    border-color: var(--accent);
}

.stat-icon {
    font-size: 1.8rem;
    margin-bottom: 16px;
    color: var(--accent);
}

.stat-value {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 4px;
}

.stat-label {
    color: var(--text-secondary);
    font-size: 0.8rem;
}

.quick-action-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 20px;
    padding: 32px;
    margin-bottom: 40px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 24px;
}

.quick-action-content h3 {
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 8px;
}

.quick-action-content p {
    color: var(--text-secondary);
    font-size: 0.85rem;
    margin-bottom: 20px;
}

.quick-action-icon {
    font-size: 3rem;
    color: var(--accent);
    opacity: 0.4;
}

.recent-section {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 20px;
    padding: 28px;
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
}

.section-header h3 {
    font-size: 1.1rem;
    font-weight: 600;
}

.section-header a {
    color: var(--accent);
    text-decoration: none;
    font-size: 0.8rem;
    transition: opacity 0.2s;
}

.section-header a:hover {
    opacity: 0.7;
}

.brief-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.brief-item {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 16px;
    background: var(--bg);
    border-radius: 16px;
    transition: all 0.3s ease;
    border: 1px solid transparent;
}

.brief-item:hover {
    border-color: var(--accent);
    transform: translateX(5px);
}

.brief-icon {
    width: 44px;
    height: 44px;
    background: rgba(59, 130, 255, 0.08);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    color: var(--accent);
}

.brief-info {
    flex: 1;
}

.brief-info h4 {
    font-weight: 600;
    margin-bottom: 4px;
    font-size: 0.95rem;
}

.brief-info p {
    font-size: 0.65rem;
    color: var(--text-secondary);
    margin-bottom: 6px;
}

.brief-categories {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
}

.cat-tag {
    background: rgba(59, 130, 255, 0.08);
    color: var(--accent);
    padding: 2px 10px;
    border-radius: 30px;
    font-size: 0.6rem;
    font-weight: 500;
}

.status-badge {
    padding: 5px 14px;
    border-radius: 30px;
    font-size: 0.7rem;
    font-weight: 600;
    white-space: nowrap;
}

.status-pending { background: rgba(245, 158, 11, 0.12); color: #f59e0b; }
.status-contacted { background: rgba(59, 130, 255, 0.12); color: var(--accent); }
.status-approved { background: rgba(16, 185, 129, 0.12); color: #10b981; }
.status-rejected { background: rgba(239, 68, 68, 0.12); color: #ef4444; }

.empty-state {
    text-align: center;
    padding: 48px 24px;
}

.empty-icon {
    font-size: 3rem;
    margin-bottom: 16px;
    color: var(--text-secondary);
    opacity: 0.4;
}

.empty-state h4 {
    font-size: 1rem;
    margin-bottom: 6px;
}

.empty-state p {
    color: var(--text-secondary);
    font-size: 0.85rem;
    margin-bottom: 20px;
}

.btn-primary {
    background: var(--accent);
    color: #000;
    padding: 10px 24px;
    border-radius: 40px;
    font-weight: 600;
    font-size: 0.8rem;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    text-decoration: none;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.btn-primary:hover {
    transform: translateY(-2px);
    opacity: 0.9;
}

.btn-outline {
    background: transparent;
    border: 1px solid var(--border);
    color: var(--text);
    padding: 10px 24px;
    border-radius: 40px;
    font-weight: 600;
    font-size: 0.8rem;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    text-decoration: none;
    transition: all 0.3s ease;
    cursor: pointer;
}

.btn-outline:hover {
    border-color: var(--accent);
    color: var(--accent);
}

@media (max-width: 1024px) {
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 992px) {
    .app-main {
        margin-left: 0;
    }
    .app-content {
        padding: 32px 24px;
    }
}

@media (max-width: 768px) {
    .app-content {
        padding: 24px 20px;
    }
    .stats-grid {
        gap: 14px;
    }
    .quick-action-card {
        flex-direction: column;
        text-align: center;
    }
    .brief-item {
        flex-direction: column;
        text-align: center;
    }
    .brief-status {
        width: 100%;
    }
    .brief-categories {
        justify-content: center;
    }
}

.reveal {
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.7s ease, transform 0.7s ease;
}

.reveal.active {
    opacity: 1;
    transform: translateY(0);
}
</style>

<script>
    function openLogoutModal() {
        document.getElementById('logout-modal').style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
    function closeLogoutModal() {
        document.getElementById('logout-modal').style.display = 'none';
        document.body.style.overflow = 'auto';
    }
    window.openLogoutModal = openLogoutModal;
    window.closeLogoutModal = closeLogoutModal;

    const reveals = document.querySelectorAll('.reveal');
    function reveal() {
        reveals.forEach(el => {
            const windowHeight = window.innerHeight;
            const revealTop = el.getBoundingClientRect().top;
            const revealPoint = 100;
            if (revealTop < windowHeight - revealPoint) {
                el.classList.add('active');
            }
        });
    }
    window.addEventListener('scroll', reveal);
    window.addEventListener('load', reveal);
</script>
@endsection