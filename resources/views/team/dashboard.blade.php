@extends('layouts.app')

@section('content')
@include('team.partials.sidebar')
<div class="team-main">
    @include('team.partials.navbar')
    <div class="team-content">
        <div class="page-header">
            <h1>Dashboard Team</h1>
            <p>Selamat datang, {{ Auth::user()->name }} (Divisi: {{ Auth::user()->divisi }})</p>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-tasks"></i></div>
                <div class="stat-value">{{ $stats['total'] }}</div>
                <div class="stat-label">Total Task</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-spinner"></i></div>
                <div class="stat-value">{{ $stats['pending'] }}</div>
                <div class="stat-label">Pending</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-play-circle"></i></div>
                <div class="stat-value">{{ $stats['in_progress'] }}</div>
                <div class="stat-label">In Progress</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-eye"></i></div>
                <div class="stat-value">{{ $stats['review'] }}</div>
                <div class="stat-label">Review</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
                <div class="stat-value">{{ $stats['completed'] }}</div>
                <div class="stat-label">Completed</div>
            </div>
        </div>

        <div class="recent-tasks">
            <h3>Task Terbaru</h3>
            @forelse($recentTasks as $task)
                <div class="task-item">
                    <div>
                        <strong>{{ $task->title }}</strong>
                        <span class="status-badge status-{{ $task->status }}">{{ ucfirst($task->status) }}</span>
                    </div>
                    <div class="task-action">
                        <a href="{{ route('team.task.detail', $task->id) }}" class="btn-small">Detail</a>
                    </div>
                </div>
            @empty
                <p>Belum ada task yang ditugaskan.</p>
            @endforelse
        </div>
    </div>
</div>

<style>
.team-main {
    margin-left: 280px;
    min-height: 100vh;
}
.team-content {
    padding: 32px;
    max-width: 1200px;
}
.page-header {
    margin-bottom: 32px;
}
.stats-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 20px;
    margin-bottom: 40px;
}
.stat-card {
    background: var(--surface-card);
    border: 1px solid var(--border);
    border-radius: 20px;
    padding: 24px;
    text-align: center;
}
.stat-icon {
    font-size: 2rem;
    margin-bottom: 12px;
    color: var(--accent);
}
.stat-value {
    font-size: 2rem;
    font-weight: 700;
    color: var(--accent);
}
.stat-label {
    font-size: 0.8rem;
    color: var(--text-secondary);
}
.recent-tasks {
    background: var(--surface-card);
    border-radius: 20px;
    padding: 24px;
}
.task-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 16px 0;
    border-bottom: 1px solid var(--border);
}
.status-badge {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.7rem;
    font-weight: 600;
    margin-left: 12px;
}
.status-pending { background: rgba(255,170,0,0.1); color: #f59e0b; }
.status-in_progress { background: rgba(59,130,255,0.1); color: #3b82ff; }
.status-review { background: rgba(33,150,243,0.1); color: #2196f3; }
.status-completed { background: rgba(0,200,83,0.1); color: #00c853; }
.btn-small {
    background: var(--accent);
    color: #000;
    padding: 6px 16px;
    border-radius: 20px;
    text-decoration: none;
    font-size: 0.8rem;
}
@media (max-width: 768px) {
    .team-main { margin-left: 0; }
    .stats-grid { grid-template-columns: repeat(2, 1fr); }
}
</style>
@endsection