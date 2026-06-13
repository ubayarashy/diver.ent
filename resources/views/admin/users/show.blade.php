@extends('layouts.app')

@section('content')
@include('admin.sidebar')

<div class="admin-main">
    <div class="admin-content">
        <div class="page-header">
            <div class="header-left">
                <h1><i class="fas fa-user-circle"></i> Detail User</h1>
                <p>Informasi lengkap user {{ $user->name }}</p>
            </div>
            <div class="header-right">
                <a href="{{ route('admin.users') }}" class="btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn-primary">
                    <i class="fas fa-edit"></i> Edit User
                </a>
            </div>
        </div>

        <div class="detail-card">
            <div class="detail-header">
                <div class="user-avatar-large">
                    @if($user->profile_photo)
                        <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="{{ $user->name }}">
                    @else
                        {{ strtoupper(substr($user->name, 0, 2)) }}
                    @endif
                </div>
                <div class="user-info">
                    <h2>{{ $user->name }}</h2>
                    <p>{{ $user->email }}</p>
                    <span class="role-badge role-{{ $user->role }}">{{ ucfirst($user->role) }}</span>
                </div>
            </div>

            <div class="detail-body">
                <div class="info-section">
                    <h3>Informasi Kontak</h3>
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">Nomor Telepon:</span>
                            <span class="info-value">{{ $user->phone ?? '-' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Email:</span>
                            <span class="info-value">{{ $user->email }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Member Sejak:</span>
                            <span class="info-value">{{ $user->created_at ? $user->created_at->format('d F Y H:i') : '-' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Terakhir Update:</span>
                            <span class="info-value">{{ $user->updated_at ? $user->updated_at->format('d F Y H:i') : '-' }}</span>
                        </div>
                    </div>
                </div>

                <div class="info-section">
                    <h3>Statistik Proyek</h3>
                    <div class="stats-grid-detail">
                        <div class="stat-item">
                            <div class="stat-number">{{ $stats['total_projects'] }}</div>
                            <div class="stat-label">Total Proyek</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">{{ $stats['completed_projects'] }}</div>
                            <div class="stat-label">Selesai</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">{{ $stats['in_progress_projects'] }}</div>
                            <div class="stat-label">Sedang Berjalan</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">{{ $stats['pending_projects'] }}</div>
                            <div class="stat-label">Pending</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.admin-main {
    margin-left: var(--sidebar-width);
    margin-top: var(--header-height);
    padding: 32px;
    min-height: calc(100vh - var(--header-height));
}

.admin-content {
    max-width: 900px;
    margin: 0 auto;
}

.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 32px;
    flex-wrap: wrap;
    gap: 16px;
}

.page-header h1 {
    font-family: var(--font-display);
    font-size: 1.8rem;
    margin-bottom: 8px;
}

.page-header h1 i {
    color: #2563eb;
    margin-right: 12px;
}

.btn-secondary {
    background: #6b7280;
    color: #fff;
    padding: 10px 20px;
    border-radius: 12px;
    text-decoration: none;
    font-size: 0.85rem;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.btn-primary {
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    color: #fff;
    padding: 10px 20px;
    border-radius: 12px;
    text-decoration: none;
    font-size: 0.85rem;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.detail-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 20px;
    overflow: hidden;
}

.detail-header {
    background: linear-gradient(135deg, rgba(37, 99, 235, 0.1), rgba(37, 99, 235, 0.05));
    padding: 32px;
    display: flex;
    align-items: center;
    gap: 24px;
    flex-wrap: wrap;
    border-bottom: 1px solid var(--border);
}

.user-avatar-large {
    width: 100px;
    height: 100px;
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    font-weight: 700;
    color: #fff;
    overflow: hidden;
}

.user-avatar-large img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.user-info h2 {
    font-size: 1.5rem;
    margin-bottom: 8px;
}

.user-info p {
    color: var(--text-secondary);
    margin-bottom: 12px;
}

.role-badge {
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
}

.role-admin {
    background: rgba(239, 68, 68, 0.1);
    color: #ef4444;
}

.role-team {
    background: rgba(16, 185, 129, 0.1);
    color: #10b981;
}

.role-client {
    background: rgba(37, 99, 235, 0.1);
    color: #2563eb;
}

.detail-body {
    padding: 32px;
}

.info-section {
    margin-bottom: 32px;
}

.info-section h3 {
    font-size: 1.1rem;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid var(--border);
    color: var(--text);
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
}

.info-item {
    display: flex;
    padding: 12px;
    background: var(--bg);
    border-radius: 12px;
}

.info-label {
    width: 130px;
    font-weight: 600;
    color: var(--text-secondary);
}

.info-value {
    color: var(--text);
}

.stats-grid-detail {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
}

.stat-item {
    text-align: center;
    padding: 20px;
    background: var(--bg);
    border-radius: 12px;
}

.stat-number {
    font-size: 1.8rem;
    font-weight: 700;
    color: #2563eb;
}

.stat-label {
    font-size: 0.75rem;
    color: var(--text-secondary);
    margin-top: 8px;
}

@media (max-width: 768px) {
    .admin-main {
        margin-left: 0;
        padding: 20px;
    }
    .detail-header {
        flex-direction: column;
        text-align: center;
    }
    .info-grid {
        grid-template-columns: 1fr;
    }
    .stats-grid-detail {
        grid-template-columns: repeat(2, 1fr);
    }
}
</style>
@endsection