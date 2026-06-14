@extends('layouts.app')
@section('content')
@include('partials.client.navbar-sidebar')

<div class="app-main">
    <div class="app-content">
        <div class="page-header">
            <h1>History Kerjasama</h1>
            <p>Daftar brief yang sudah Anda kirimkan ke diver.ent</p>
        </div>

        @php
            $briefs = App\Models\Brief::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        @endphp

        @if($briefs->count() > 0)
            <div class="briefs-list">
                @foreach($briefs as $brief)
                <div class="brief-card">
                    <div class="brief-card-header">
                        <div class="brief-title">
                            <span class="brief-icon"><i class="fas fa-file-alt"></i></span>
                            <h3>{{ $brief->project_name }}</h3>
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
                    <div class="brief-card-body">
                        <div class="brief-meta">
                            <span class="meta-date"><i class="fas fa-calendar-alt"></i> {{ $brief->created_at->format('d M Y H:i') }}</span>
                            @if($brief->budget)
                            <span class="meta-budget"><i class="fas fa-money-bill-wave"></i> Rp {{ number_format($brief->budget, 0, ',', '.') }}</span>
                            @endif
                        </div>
                        <div class="brief-categories">
                            @foreach($brief->categories as $cat)
                            <span class="cat-tag">{{ $cat }}</span>
                            @endforeach
                        </div>
                        @if($brief->description)
                        <div class="brief-description">
                            <i class="fas fa-quote-left"></i> {{ Str::limit($brief->description, 200) }}
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
                <a href="{{ route('client.create-project') }}" class="btn-primary">Ayo Kerjasama</a>
            </div>
        @endif
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
    max-width: 1000px;
    margin: 0 auto;
    padding: 40px 48px;
}

.page-header {
    margin-bottom: 32px;
}

.page-header h1 {
    font-family: var(--font-display);
    font-size: 1.8rem;
    font-weight: 700;
    letter-spacing: -0.02em;
    margin-bottom: 8px;
}

.page-header p {
    color: var(--text-secondary);
    font-size: 0.9rem;
}

.briefs-list {
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
    padding: 18px 24px;
    background: rgba(59, 130, 255, 0.02);
    border-bottom: 1px solid var(--border);
    flex-wrap: wrap;
    gap: 12px;
}

.brief-title {
    display: flex;
    align-items: center;
    gap: 10px;
}

.brief-icon {
    width: 36px;
    height: 36px;
    background: rgba(59, 130, 255, 0.08);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--accent);
    font-size: 1rem;
}

.brief-title h3 {
    font-size: 1rem;
    font-weight: 600;
    margin: 0;
}

.brief-card-body {
    padding: 20px 24px;
}

.brief-meta {
    display: flex;
    gap: 20px;
    margin-bottom: 14px;
    font-size: 0.7rem;
    color: var(--text-secondary);
}

.brief-meta i {
    margin-right: 4px;
    width: 14px;
    color: var(--accent);
    opacity: 0.6;
}

.meta-date, .meta-budget {
    display: inline-flex;
    align-items: center;
    gap: 4px;
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
    border-radius: 30px;
    font-size: 0.65rem;
    font-weight: 500;
}

.brief-description {
    background: var(--bg);
    padding: 14px 16px;
    border-radius: 12px;
    font-size: 0.8rem;
    color: var(--text-secondary);
    line-height: 1.6;
    margin-top: 8px;
    border-left: 2px solid var(--accent);
}

.brief-description i {
    color: var(--accent);
    margin-right: 8px;
    font-size: 0.7rem;
    opacity: 0.6;
}

.status-badge {
    padding: 5px 14px;
    border-radius: 30px;
    font-size: 0.7rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.status-pending {
    background: rgba(245, 158, 11, 0.12);
    color: #f59e0b;
}

.status-contacted {
    background: rgba(59, 130, 255, 0.12);
    color: var(--accent);
}

.status-approved {
    background: rgba(16, 185, 129, 0.12);
    color: #10b981;
}

.status-rejected {
    background: rgba(239, 68, 68, 0.12);
    color: #ef4444;
}

.empty-state {
    text-align: center;
    padding: 60px 24px;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 20px;
}

.empty-icon {
    font-size: 3.5rem;
    margin-bottom: 16px;
    color: var(--text-secondary);
    opacity: 0.4;
}

.empty-state h3 {
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 8px;
}

.empty-state p {
    color: var(--text-secondary);
    font-size: 0.85rem;
    margin-bottom: 24px;
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
    .brief-card-header {
        flex-direction: column;
        align-items: flex-start;
    }
    .brief-meta {
        flex-direction: column;
        gap: 8px;
    }
    .brief-title h3 {
        font-size: 0.95rem;
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