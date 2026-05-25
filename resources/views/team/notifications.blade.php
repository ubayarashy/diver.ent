@extends('team.layouts.app')

@section('content')
@include('team.partials.sidebar')
<div class="team-main">
    @include('team.partials.navbar')
    <div class="team-content">
        <h1><i class="fas fa-bell"></i> Notifikasi</h1>
        @if($tasks->count())
            @foreach($tasks as $task)
            <div class="notif-item">
                <div class="notif-icon"><i class="fas fa-exclamation-circle"></i></div>
                <div class="notif-content">
                    <strong>Task "{{ $task->title }}"</strong> deadline pada <strong>{{ $task->deadline->format('d M Y') }}</strong>.
                    @if($task->deadline <= now()->addDays(3))<span class="urgent"> (Segera!)</span>@endif
                </div>
                <a href="{{ route('team.task.detail', $task->id) }}" class="btn-link">Lihat Task</a>
            </div>
            @endforeach
        @else
            <div class="empty-state">Tidak ada notifikasi baru.</div>
        @endif
    </div>
</div>

<style>
.team-main { margin-left: 280px; }
.team-content { padding: 32px; max-width: 800px; }
.notif-item { display: flex; align-items: center; gap: 16px; background: var(--surface-card); border-radius: 16px; padding: 16px; margin-bottom: 12px; border-left: 4px solid var(--accent); }
.notif-icon i { font-size: 1.5rem; color: var(--accent); }
.notif-content { flex: 1; }
.urgent { color: #ff4444; font-weight: bold; }
.btn-link { background: none; border: none; color: var(--accent); cursor: pointer; text-decoration: underline; }
.empty-state { text-align: center; padding: 60px; color: var(--text-secondary); }
@media (max-width: 768px) { .team-main { margin-left: 0; } }
</style>
@endsection