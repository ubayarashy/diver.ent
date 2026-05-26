@extends('layouts.app')

@section('content')
@include('team.partials.sidebar')
<div class="team-main">
    @include('team.partials.navbar')
    <div class="team-content">
        <h1>Daftar Task</h1>
        <div class="filters">
            <a href="?status=all" class="filter-btn {{ request('status') == 'all' || !request('status') ? 'active' : '' }}">All</a>
            <a href="?status=pending" class="filter-btn">Pending</a>
            <a href="?status=in_progress" class="filter-btn">In Progress</a>
            <a href="?status=review" class="filter-btn">Review</a>
            <a href="?status=completed" class="filter-btn">Completed</a>
        </div>

        @forelse($tasks as $task)
            <div class="task-card">
                <div class="task-header">
                    <h3>{{ $task->title }}</h3>
                    <span class="status-badge status-{{ $task->status }}">{{ ucfirst($task->status) }}</span>
                </div>
                <div class="task-info">
                    <span><i class="fas fa-briefcase"></i> Project: {{ $task->brief->project_name ?? 'N/A' }}</span>
                </div>
                <div class="task-actions">
                    <a href="{{ route('team.task.detail', $task->id) }}" class="btn-small">Detail</a>
                </div>
            </div>
        @empty
            <p>Belum ada task.</p>
        @endforelse
        {{ $tasks->links() }}
    </div>
</div>

<style>
.team-main { margin-left: 280px; }
.team-content { padding: 32px; max-width: 1000px; }
.filters { display: flex; gap: 12px; margin-bottom: 24px; flex-wrap: wrap; }
.filter-btn {
    padding: 8px 20px;
    border-radius: 40px;
    background: transparent;
    border: 1px solid var(--border);
    color: var(--text-secondary);
    text-decoration: none;
    transition: 0.3s;
}
.filter-btn.active, .filter-btn:hover {
    background: var(--accent);
    color: #000;
    border-color: var(--accent);
}
.task-card {
    background: var(--surface-card);
    border-radius: 20px;
    padding: 20px;
    margin-bottom: 16px;
    border: 1px solid var(--border);
}
.task-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
}
.task-info {
    font-size: 0.8rem;
    color: var(--text-secondary);
    margin-bottom: 16px;
}
.task-actions {
    text-align: right;
}
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