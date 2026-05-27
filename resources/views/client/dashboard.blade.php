@extends('layouts.app')

@section('content')

@include('partials.client.navbar-sidebar')

<div class="app-main">
    <div class="app-content">
        <!-- Welcome Section -->
        <div class="welcome-section">
            <div class="welcome-badge">
                <i class="fas fa-sparkle"></i> Welcome Back
            </div>
            <h1>Halo, <span class="highlight">{{ Auth::user()->name ?? 'User' }}</span>!</h1>
            <p>Kelola kerjasama dan pantau progress project Anda di sini.</p>
        </div>

        <!-- Stats Grid -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-handshake"></i></div>
                <div class="stat-value">{{ $totalBriefs ?? 0 }}</div>
                <div class="stat-label">Total Kerjasama</div>
                <div class="stat-trend"><i class="fas fa-chart-line"></i> +0%</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-clock"></i></div>
                <div class="stat-value">{{ $pendingBriefs ?? 0 }}</div>
                <div class="stat-label">Menunggu Respon</div>
                <div class="stat-trend pending"><i class="fas fa-hourglass-half"></i> Processing</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
                <div class="stat-value">{{ $approvedBriefs ?? 0 }}</div>
                <div class="stat-label">Disetujui</div>
                <div class="stat-trend approved"><i class="fas fa-check"></i> Completed</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-chart-line"></i></div>
                <div class="stat-value">{{ ($totalBriefs ?? 0) - ($approvedBriefs ?? 0) }}</div>
                <div class="stat-label">Dalam Proses</div>
                <div class="stat-trend progress"><i class="fas fa-spinner fa-pulse"></i> Active</div>
            </div>
        </div>

        <!-- Quick Action -->
        <div class="quick-action-card">
            <div class="quick-action-content">
                <h3>Mulai Kerjasama Baru?</h3>
                <p>Isi brief project Anda, tim kami akan segera menghubungi.</p>
                <a href="{{ route('client.create-project') }}" class="btn-primary">
                    <i class="fas fa-handshake"></i> Ayo Kerjasama
                </a>
            </div>
            <div class="quick-action-icon">
                <i class="fas fa-rocket"></i>
            </div>
        </div>

        <!-- Recent Collaborations -->
        <div class="recent-section">
            <div class="section-header">
                <h3><i class="fas fa-history"></i> Kerjasama Terbaru</h3>
                <a href="{{ route('client.projects') }}">Lihat Semua <i class="fas fa-arrow-right"></i></a>
            </div>

            @php
                $recentBriefs = App\Models\Brief::where('user_id', Auth::id())->orderBy('created_at', 'desc')->limit(5)->get();
            @endphp

            @if($recentBriefs->count() > 0)
                <div class="brief-list">
                    @foreach($recentBriefs as $brief)
                    <div class="brief-item">
                        <div class="brief-icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <div class="brief-info">
                            <h4>{{ $brief->project_name }}</h4>
                            <p><i class="fas fa-calendar-alt"></i> {{ $brief->created_at->format('d M Y H:i') }}</p>
                            <div class="brief-categories">
                                @foreach($brief->categories as $cat)
                                <span class="cat-tag">{{ $cat }}</span>
                                @endforeach
                            </div>
                        </div>
                        <div class="brief-status">
                            @if($brief->status == 'pending')
                                <span class="status-badge status-pending"><i class="fas fa-hourglass-half"></i> Menunggu</span>
                            @elseif($brief->status == 'contacted')
                                <span class="status-badge status-contacted"><i class="fas fa-phone-alt"></i> Akan Dihubungi</span>
                            @elseif($brief->status == 'approved')
                                <span class="status-badge status-approved"><i class="fas fa-check-circle"></i> Disetujui</span>
                            @else
                                <span class="status-badge status-rejected"><i class="fas fa-times-circle"></i> Ditolak</span>
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
                    <a href="{{ route('client.create-project') }}" class="btn-outline">
                        <i class="fas fa-handshake"></i> Ayo Kerjasama
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    /* Hapus style .client-main dan .client-content */
    /* Gunakan style dari navbar-sidebar untuk .app-main dan .app-content */
    
    .app-content {
        max-width: 1400px;
    }

    /* Welcome Section */
    .welcome-section {
        margin-bottom: 40px;
    }

    .welcome-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(59, 130, 255, 0.1);
        padding: 6px 16px;
        border-radius: 50px;
        font-size: 0.75rem;
        color: var(--accent);
        margin-bottom: 16px;
    }

    .welcome-section h1 {
        font-family: var(--font-display);
        font-size: 2.2rem;
        font-weight: 800;
        letter-spacing: -1px;
        margin-bottom: 8px;
    }

    .welcome-section .highlight {
        color: var(--accent);
    }

    .welcome-section p {
        color: var(--text-secondary);
        font-size: 0.95rem;
    }

    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 24px;
        margin-bottom: 40px;
    }

    .stat-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 24px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: linear-gradient(90deg, var(--accent), transparent);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.3s ease;
    }

    .stat-card:hover::before {
        transform: scaleX(1);
    }

    .stat-card:hover {
        transform: translateY(-4px);
        border-color: var(--accent);
    }

    .stat-icon {
        font-size: 2rem;
        margin-bottom: 16px;
        color: var(--accent);
    }

    .stat-value {
        font-family: var(--font-display);
        font-size: 2rem;
        font-weight: 800;
        color: var(--text);
        margin-bottom: 4px;
    }

    .stat-label {
        color: var(--text-secondary);
        font-size: 0.8rem;
        margin-bottom: 8px;
    }

    .stat-trend {
        font-size: 0.7rem;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .stat-trend.pending { color: #f59e0b; }
    .stat-trend.approved { color: #10b981; }
    .stat-trend.progress { color: var(--accent); }

    /* Quick Action Card */
    .quick-action-card {
        background: linear-gradient(135deg, var(--surface), var(--surface-alt));
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 32px;
        margin-bottom: 40px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
    }

    .quick-action-content h3 {
        font-family: var(--font-display);
        font-size: 1.3rem;
        margin-bottom: 8px;
    }

    .quick-action-content p {
        color: var(--text-secondary);
        margin-bottom: 20px;
    }

    .quick-action-icon {
        font-size: 3rem;
        color: var(--accent);
        opacity: 0.5;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--accent), var(--accent-hover));
        color: #fff;
        padding: 12px 28px;
        border-radius: 50px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(59, 130, 255, 0.3);
    }

    .btn-outline {
        background: transparent;
        border: 1px solid var(--border);
        color: var(--text);
        padding: 10px 24px;
        border-radius: 50px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-outline:hover {
        border-color: var(--accent);
        color: var(--accent);
    }

    /* Recent Section */
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
        flex-wrap: wrap;
        gap: 16px;
    }

    .section-header h3 {
        font-family: var(--font-display);
        font-size: 1.2rem;
        font-weight: 700;
    }

    .section-header a {
        color: var(--accent);
        text-decoration: none;
        font-size: 0.85rem;
        transition: opacity 0.3s;
    }

    .section-header a:hover {
        opacity: 0.8;
    }

    .brief-list {
        display: flex;
        flex-direction: column;
        gap: 16px;
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
        transform: translateX(8px);
    }

    .brief-icon {
        width: 48px;
        height: 48px;
        background: rgba(59, 130, 255, 0.1);
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
    }

    .brief-info p {
        font-size: 0.7rem;
        color: var(--text-secondary);
        margin-bottom: 8px;
    }

    .brief-categories {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .cat-tag {
        background: rgba(59, 130, 255, 0.08);
        color: var(--accent);
        padding: 2px 10px;
        border-radius: 50px;
        font-size: 0.65rem;
        font-weight: 500;
    }

    .status-badge {
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 0.7rem;
        font-weight: 600;
        white-space: nowrap;
    }

    .status-pending {
        background: rgba(245, 158, 11, 0.15);
        color: #f59e0b;
    }

    .status-contacted {
        background: rgba(59, 130, 255, 0.15);
        color: var(--accent);
    }

    .status-approved {
        background: rgba(16, 185, 129, 0.15);
        color: #10b981;
    }

    .status-rejected {
        background: rgba(239, 68, 68, 0.15);
        color: #ef4444;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 48px;
    }

    .empty-icon {
        font-size: 3rem;
        margin-bottom: 16px;
        color: var(--text-secondary);
        opacity: 0.5;
    }

    .empty-state h4 {
        font-family: var(--font-display);
        font-size: 1.1rem;
        margin-bottom: 8px;
    }

    .empty-state p {
        color: var(--text-secondary);
        margin-bottom: 20px;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .stats-grid {
            gap: 16px;
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
        .status-badge {
            display: inline-block;
        }
    }
</style>

<!-- Logout Modal -->
<div id="logout-modal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.8); backdrop-filter: blur(8px); z-index: 1000; justify-content: center; align-items: center;">
    <div style="background: var(--surface); border: 1px solid var(--border); border-radius: 24px; padding: 32px; max-width: 400px; width: 90%; text-align: center;">
        <div style="width: 64px; height: 64px; background: rgba(59,130,255,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
            <i class="fas fa-question-circle" style="font-size: 2rem; color: var(--accent);"></i>
        </div>
        <h3 style="margin-bottom: 12px;">Konfirmasi Keluar</h3>
        <p style="color: var(--text-secondary); margin-bottom: 24px;">Apakah Anda yakin ingin keluar dari dashboard?</p>
        <div style="display: flex; gap: 12px; justify-content: center;">
            <button onclick="closeLogoutModal()" class="btn-outline" style="padding: 10px 24px;">Batal</button>
            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="btn-primary" style="padding: 10px 24px;">Keluar</button>
            </form>
        </div>
    </div>
</div>

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
</script>
@endsection