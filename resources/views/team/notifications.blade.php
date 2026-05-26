@extends('layouts.app')

@section('content')
@include('team.partials.sidebar')
<div class="team-main">
    @include('team.partials.navbar')
    <div class="team-content">
        <h1>Notifikasi</h1>
        @forelse($tasks as $task)
            <div class="notif-item">
                <div class="notif-icon"><i class="fas fa-exclamation-circle"></i></div>
                <div class="notif-content">
                    <strong>{{ $task->title }}</strong> - Status: {{ $task->status }}
                </div>
                <a href="{{ route('team.task.detail', $task->id) }}" class="btn-small">Lihat</a>
            </div>
        @empty
            <p>Tidak ada notifikasi.</p>
        @endforelse
    </div>
</div>

<style>
.team-main { margin-left: 280px; }
.team-content { padding: 32px; max-width: 800px; }
.notif-item {
    display: flex;
    align-items: center;
    gap: 16px;
    background: var(--surface-card);
    border-radius: 16px;
    padding: 16px;
    margin-bottom: 12px;
    border-left: 4px solid var(--accent);
}
.notif-icon i { font-size: 1.5rem; color: var(--accent); }
.notif-content { flex: 1; }
.btn-small {
    background: var(--accent);
    color: #000;
    padding: 6px 16px;
    border-radius: 20px;
    text-decoration: none;
    font-size: 0.8rem;
}
@media (max-width: 768px) { .team-main { margin-left: 0; } }
</style>
@endsection