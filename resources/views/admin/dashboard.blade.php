@extends('layouts.app')

@section('content')

@include('admin.sidebar')

<div class="admin-main">
    <div class="admin-content">
        <div class="page-header">
            <div class="page-title">
                <h1><i class="fas fa-tachometer-alt"></i> Dashboard Admin</h1>
                <p>Selamat datang, {{ Auth::user()->name }}! Kelola seluruh workflow agency di sini.</p>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-users"></i></div>
                <div class="stat-value">{{ $totalClients ?? 0 }}</div>
                <div class="stat-label">Total Client</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-user-friends"></i></div>
                <div class="stat-value">{{ $totalTeams ?? 0 }}</div>
                <div class="stat-label">Total Team</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-file-alt"></i></div>
                <div class="stat-value">{{ $totalBriefs ?? 0 }}</div>
                <div class="stat-label">Total Brief</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-clock"></i></div>
                <div class="stat-value">{{ $pendingBriefs ?? 0 }}</div>
                <div class="stat-label">Pending Review</div>
            </div>
        </div>

        <!-- Brief Status Chart -->
        <div class="chart-section">
            <div class="section-header">
                <h3><i class="fas fa-chart-pie"></i> Statistik Brief</h3>
            </div>
            <div class="stats-grid-small">
                <div class="stat-card-small">
                    <div class="stat-value-small" style="color: #f59e0b;">{{ $pendingBriefs ?? 0 }}</div>
                    <div class="stat-label-small">Menunggu</div>
                </div>
                <div class="stat-card-small">
                    <div class="stat-value-small" style="color: #3b82f6;">{{ $contactedBriefs ?? 0 }}</div>
                    <div class="stat-label-small">Akan Dihubungi</div>
                </div>
                <div class="stat-card-small">
                    <div class="stat-value-small" style="color: #10b981;">{{ $approvedBriefs ?? 0 }}</div>
                    <div class="stat-label-small">Disetujui</div>
                </div>
            </div>
        </div>

        <!-- Recent Briefs -->
        <div class="recent-section">
            <div class="section-header">
                <h3><i class="fas fa-history"></i> Brief Terbaru</h3>
                <a href="{{ route('admin.briefs') }}">Lihat Semua <i class="fas fa-arrow-right"></i></a>
            </div>

            @if(isset($recentBriefs) && $recentBriefs->count() > 0)
                <div class="brief-list">
                    @foreach($recentBriefs as $brief)
                    <div class="brief-item">
                        <div class="brief-info">
                            <h4>{{ $brief->project_name }}</h4>
                            <p><i class="fas fa-user"></i> {{ $brief->user->name ?? 'Unknown' }} | {{ $brief->created_at->format('d-M-Y H:i') }}</p>
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
                        <div class="brief-action">
                            <a href="{{ route('admin.brief-detail', $brief->id) }}" class="btn-sm">Detail →</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <i class="fas fa-inbox"></i>
                    <p>Belum ada brief</p>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
.admin-main {
    margin-left: 280px;
    min-height: 100vh;
    padding-top:20px;
}

.admin-content {
    padding: 32px;
}

.page-header {
    margin-bottom: 32px;
}

.page-title h1 {
    font-family: var(--font-display);
    font-size: 1.8rem;
    font-weight: 800;
    margin-bottom: 8px;
}

.page-title p {
    color: var(--text-secondary);
}

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
    transition: all 0.3s;
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
    font-size: 2rem;
    font-weight: 800;
    color: var(--accent);
    margin-bottom: 4px;
}

.stat-label {
    color: var(--text-secondary);
    font-size: 0.85rem;
}

.chart-section {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 20px;
    padding: 24px;
    margin-bottom: 40px;
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
}

.section-header h3 {
    font-size: 1.1rem;
    font-weight: 700;
}

.section-header a {
    color: var(--accent);
    text-decoration: none;
    font-size: 0.85rem;
}

.stats-grid-small {
    display: flex;
    gap: 24px;
    justify-content: space-around;
}

.stat-card-small {
    text-align: center;
    flex: 1;
}

.stat-value-small {
    font-size: 2rem;
    font-weight: 800;
}

.stat-label-small {
    color: var(--text-secondary);
    font-size: 0.8rem;
}

.recent-section {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 20px;
    padding: 24px;
}

.brief-list {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.brief-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 16px;
    background: var(--bg);
    border-radius: 12px;
    flex-wrap: wrap;
    gap: 16px;
}

.brief-info {
    flex: 1;
}

.brief-info h4 {
    font-weight: 600;
    margin-bottom: 4px;
}

.brief-info p {
    font-size: 0.75rem;
    color: var(--text-secondary);
}

.status-badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.7rem;
    font-weight: 600;
}

.status-pending { background: rgba(245,158,11,0.15); color: #f59e0b; }
.status-contacted { background: rgba(59,130,255,0.15); color: #3b82f6; }
.status-approved { background: rgba(16,185,129,0.15); color: #10b981; }
.status-rejected { background: rgba(239,68,68,0.15); color: #ef4444; }

.btn-sm {
    background: transparent;
    border: 1px solid var(--border);
    padding: 6px 16px;
    border-radius: 20px;
    color: var(--text-secondary);
    text-decoration: none;
    font-size: 0.75rem;
    transition: all 0.3s;
}

.btn-sm:hover {
    border-color: var(--accent);
    color: var(--accent);
}

.empty-state {
    text-align: center;
    padding: 40px;
    color: var(--text-secondary);
}

.empty-state i {
    font-size: 3rem;
    margin-bottom: 16px;
    opacity: 0.5;
}

@media (max-width: 768px) {
    .admin-main {
        margin-left: 0;
    }
    .admin-content {
        padding: 20px;
    }
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }
    .stats-grid-small {
        flex-direction: column;
        gap: 16px;
    }
    .brief-item {
        flex-direction: column;
        text-align: center;
    }
    .brief-status {
        width: 100%;
    }
}
</style>
@endsection