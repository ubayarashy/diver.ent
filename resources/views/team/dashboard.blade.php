@extends('layouts.app')

@section('content')
@include('partials.team.navbar')


<div class="team-main">
    <div class="team-content">
        <div class="page-header">
            <h1>Halo, {{ Auth::user()->name ?? 'Team' }}! <i class="fas fa-smile"></i></h1>
            <p>Semangat bekerja! Berikut ringkasan tugas Anda.</p>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <i class="fas fa-tasks"></i>
                <div class="value">{{ $totalTasks ?? 0 }}</div>
                <div class="label">Total Task</div>
            </div>
            <div class="stat-card">
                <i class="fas fa-spinner fa-pulse"></i>
                <div class="value">{{ $inProgressTasks ?? 0 }}</div>
                <div class="label">In Progress</div>
            </div>
            <div class="stat-card">
                <i class="fas fa-clock"></i>
                <div class="value">{{ $pendingTasks ?? 0 }}</div>
                <div class="label">Pending</div>
            </div>
            <div class="stat-card">
                <i class="fas fa-check-circle"></i>
                <div class="value">{{ $completedTasks ?? 0 }}</div>
                <div class="label">Completed</div>
            </div>
        </div>

        <div class="recent-tasks">
            <div class="section-header">
                <h3><i class="fas fa-history"></i> Task Terbaru</h3>
                <a href="{{ route('team.tasks') }}">Lihat Semua →</a>
            </div>

            @if(isset($recentTasks) && $recentTasks->count() > 0)
                @foreach($recentTasks as $task)
                <div class="task-item">
                    <div class="task-info">
                        <strong>{{ $task->title ?? 'No Title' }}</strong>
                        <small>{{ $task->brief->project_name ?? 'Project' }}</small>
                    </div>
                    <div class="task-status">
                        <span class="badge-{{ $task->status ?? 'pending' }}">
                            {{ ucfirst(str_replace('_', ' ', $task->status ?? 'Pending')) }}
                        </span>
                    </div>
                </div>
                @endforeach
            @else
                <div class="empty-state">
                    <i class="fas fa-inbox"></i>
                    <p>Belum ada task yang ditugaskan</p>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
.team-main { margin-left: 280px; min-height: 100vh; padding-top: 20px; }
.team-content { padding: 32px; }
.page-header { margin-bottom: 32px; }
.page-header h1 { font-family: var(--font-display); font-size: 1.8rem; font-weight: 800; margin-bottom: 8px; }
.stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; margin-bottom: 32px; }
.stat-card { background: var(--surface); border: 1px solid var(--border); border-radius: 20px; padding: 24px; text-align: center; transition: all 0.3s; }
.stat-card:hover { transform: translateY(-4px); border-color: var(--accent); }
.stat-card i { font-size: 2rem; margin-bottom: 12px; color: var(--accent); }
.stat-card .value { font-size: 2rem; font-weight: 800; color: var(--accent); }
.stat-card .label { color: var(--text-secondary); font-size: 0.85rem; }
.recent-tasks { background: var(--surface); border: 1px solid var(--border); border-radius: 20px; padding: 24px; }
.section-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
.task-item { display: flex; justify-content: space-between; align-items: center; padding: 16px; border-bottom: 1px solid var(--border); }
.task-item:last-child { border-bottom: none; }
.task-info { display: flex; flex-direction: column; gap: 4px; }
.task-info strong { font-weight: 600; }
.task-info small { font-size: 0.7rem; color: var(--text-secondary); }
.badge-pending { background: rgba(245,158,11,0.1); color: #f59e0b; padding: 4px 12px; border-radius: 20px; font-size: 0.7rem; }
.badge-in_progress { background: rgba(59,130,255,0.1); color: #3b82f6; padding: 4px 12px; border-radius: 20px; font-size: 0.7rem; }
.badge-review { background: rgba(139,92,246,0.1); color: #8b5cf6; padding: 4px 12px; border-radius: 20px; font-size: 0.7rem; }
.badge-completed { background: rgba(16,185,129,0.1); color: #10b981; padding: 4px 12px; border-radius: 20px; font-size: 0.7rem; }
.empty-state { text-align: center; padding: 60px; color: var(--text-secondary); }
.empty-state i { font-size: 4rem; margin-bottom: 16px; opacity: 0.5; }
@media (max-width: 768px) { .team-main { margin-left: 0; } .team-content { padding: 20px; } .stats-grid { grid-template-columns: repeat(2, 1fr); gap: 16px; } }
</style>
@endsection