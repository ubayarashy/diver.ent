@extends('layouts.app')

@section('content')
@include('partials.client.navbar-sidebar')

<div class="app-main">
    <div class="app-content">
        <div class="page-header">
            <div class="page-title">
                <h1><i class="fas fa-history"></i> History Kerjasama</h1>
                <p>Daftar brief yang sudah Anda kirimkan ke diver.ent</p>
            </div>
        </div>

        @php
            $briefs = App\Models\Brief::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        @endphp

        @if($briefs->count() > 0)
            <div class="briefs-grid">
                @foreach($briefs as $brief)
                <div class="brief-card">
                    <div class="brief-card-header">
                        <div class="brief-project-name">
                            <i class="fas fa-folder-open"></i> {{ $brief->project_name }}
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
                    <div class="brief-card-body">
                        <div class="brief-meta">
                            <span><i class="fas fa-calendar-alt"></i> {{ $brief->created_at->format('d M Y H:i') }}</span>
                            @if($brief->budget)
                            <span><i class="fas fa-money-bill-wave"></i> Rp {{ number_format($brief->budget, 0, ',', '.') }}</span>
                            @endif
                        </div>
                        <div class="brief-categories">
                            @foreach($brief->categories as $cat)
                            <span class="cat-tag"><i class="fas fa-tag"></i> {{ $cat }}</span>
                            @endforeach
                        </div>
                        @if($brief->description)
                        <div class="brief-description">
                            <i class="fas fa-quote-left"></i> {{ $brief->description }}
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <div class="empty-icon"><i class="fas fa-inbox"></i></div>
                <h3>Belum Ada History</h3>
                <p>Kamu belum mengirimkan brief kerjasama apapun.</p>
                <a href="{{ route('client.create-project') }}" class="btn-primary">
                    <i class="fas fa-handshake"></i> Ayo Kerjasama
                </a>
            </div>
        @endif
    </div>
</div>

<style>
    .client-main {
        flex: 1;
        margin-left: 280px;
        min-height: 100vh;
    }

    .client-content {
        padding: 40px;
        max-width: 1200px;
    }

    .page-header {
        margin-bottom: 32px;
    }

    .page-title h1 {
        font-family: var(--font-display);
        font-size: 2rem;
        font-weight: 800;
        letter-spacing: -1px;
        margin-bottom: 8px;
    }

    .page-title p {
        color: var(--text-secondary);
    }

    .briefs-grid {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .brief-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .brief-card:hover {
        border-color: var(--accent);
        transform: translateY(-2px);
    }

    .brief-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 24px;
        background: rgba(59, 130, 255, 0.03);
        border-bottom: 1px solid var(--border);
        flex-wrap: wrap;
        gap: 12px;
    }

    .brief-project-name {
        font-weight: 700;
        font-size: 1rem;
    }

    .brief-project-name i {
        color: var(--accent);
        margin-right: 8px;
    }

    .status-badge {
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 0.7rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
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

    .brief-card-body {
        padding: 24px;
    }

    .brief-meta {
        display: flex;
        gap: 20px;
        margin-bottom: 16px;
        font-size: 0.75rem;
        color: var(--text-secondary);
    }

    .brief-categories {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 16px;
    }

    .cat-tag {
        background: rgba(59, 130, 255, 0.08);
        color: var(--accent);
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 0.7rem;
        font-weight: 500;
    }

    .brief-description {
        background: var(--bg);
        padding: 16px;
        border-radius: 12px;
        font-size: 0.85rem;
        color: var(--text-secondary);
        line-height: 1.6;
        margin-top: 16px;
    }

    .brief-description i {
        color: var(--accent);
        margin-right: 8px;
        opacity: 0.5;
    }

    .empty-state {
        text-align: center;
        padding: 80px 20px;
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 20px;
    }

    .empty-icon {
        font-size: 4rem;
        margin-bottom: 20px;
        color: var(--text-secondary);
        opacity: 0.5;
    }

    .empty-state h3 {
        font-family: var(--font-display);
        font-size: 1.3rem;
        margin-bottom: 8px;
    }

    .empty-state p {
        color: var(--text-secondary);
        margin-bottom: 24px;
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
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(59, 130, 255, 0.3);
    }

    @media (max-width: 768px) {
        .client-main {
            margin-left: 0;
        }
        .client-content {
            padding: 20px;
        }
        .brief-card-header {
            flex-direction: column;
            align-items: flex-start;
        }
        .brief-meta {
            flex-direction: column;
            gap: 8px;
        }
    }
</style>
@endsection