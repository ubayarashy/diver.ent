@extends('team.layouts.app')

@section('content')
@include('team.partials.sidebar')
<div class="team-main">
    @include('team.partials.navbar')
    <div class="team-content">
        <div class="welcome-card">
            <h1>Halo, {{ Auth::user()->name }}! <i class="fas fa-smile"></i></h1>
            <p>Semangat bekerja! Berikut ringkasan tugas Anda.</p>
        </div>

        <div class="stats-grid">
            <div class="stat-card"><i class="fas fa-tasks"></i><div class="value">{{ $stats['total'] }}</div><div class="label">Total Task</div></div>
            <div class="stat-card"><i class="fas fa-spinner"></i><div class="value">{{ $stats['in_progress'] }}</div><div class="label">In Progress</div></div>
            <div class="stat-card"><i class="fas fa-clock"></i><div class="value">{{ $stats['review'] }}</div><div class="label">Review</div></div>
            <div class="stat-card"><i class="fas fa-check-circle"></i><div class="value">{{ $stats['completed'] }}</div><div class="label">Completed</div></div>
        </div>

        <div class="recent-tasks">
            <div class="section-header"><h3><i class="fas fa-history"></i> Task Terbaru</h3><a href="{{ route('team.tasks') }}">Lihat Semua</a></div>
            @if($recentTasks->count())
                @foreach($recentTasks as $task)
                <div class="task-item">
                    <div><strong>{{ $task->title }}</strong><br><small>{{ $task->project->project_name ?? 'Project' }}</small></div>
                    <div><span class="status {{ $task->status }}">{{ ucfirst(str_replace('_', ' ', $task->status)) }}</span></div>
                    <div class="deadline @if($task->deadline <= now()->addDays(3)) urgent @endif"><i class="fas fa-calendar-alt"></i> {{ $task->deadline->format('d M Y') }}</div>
                    <div class="progress-bar"><div style="width: {{ $task->progress }}%"></div></div>
                </div>
                @endforeach
            @else
                <div class="empty-state">Belum ada task yang diassign.</div>
            @endif
        </div>
    </div>
</div>

<style>
.team-main { margin-left: 280px; min-height: 100vh; }
.team-content { padding: 32px; max-width: 1200px; }
.welcome-card { background: var(--surface-card); border-radius: 24px; padding: 32px; margin-bottom: 32px; }
.welcome-card h1 { font-size: 1.8rem; margin-bottom: 8px; }
.stats-grid { display: grid; grid-template-columns: repeat(4,1fr); gap: 24px; margin-bottom: 32px; }
.stat-card { background: var(--surface-card); border-radius: 20px; padding: 24px; text-align: center; }
.stat-card i { font-size: 2rem; color: var(--accent); margin-bottom: 12px; display: block; }
.stat-card .value { font-size: 2rem; font-weight: 800; }
.stat-card .label { font-size: 0.8rem; color: var(--text-secondary); }
.recent-tasks { background: var(--surface-card); border-radius: 20px; padding: 24px; }
.section-header { display: flex; justify-content: space-between; margin-bottom: 20px; }
.task-item { display: flex; align-items: center; gap: 16px; padding: 16px 0; border-bottom: 1px solid var(--border); flex-wrap: wrap; }
.status { padding: 4px 12px; border-radius: 20px; font-size: 0.7rem; font-weight: 600; }
.status.pending { background: rgba(255,170,0,0.1); color: #f59e0b; }
.status.in_progress { background: rgba(59,130,255,0.1); color: #3b82ff; }
.status.review { background: rgba(33,150,243,0.1); color: #2196f3; }
.status.completed { background: rgba(0,200,83,0.1); color: #00c853; }
.deadline.urgent { color: #ff4444; }
.progress-bar { flex: 1; height: 6px; background: var(--border); border-radius: 3px; overflow: hidden; }
.progress-bar div { height: 100%; background: var(--accent); width: 0; border-radius: 3px; }
@media (max-width: 768px) { .team-main { margin-left: 0; } .stats-grid { grid-template-columns: repeat(2,1fr); } }
</style>
@endsection