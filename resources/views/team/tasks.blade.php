@extends('team.layouts.app')

@section('content')
@include('team.partials.sidebar')
<div class="team-main">
    @include('team.partials.navbar')
    <div class="team-content">
        <div class="page-header">
            <h1><i class="fas fa-tasks"></i> My Tasks</h1>
            <p>Semua tugas yang diberikan kepada Anda.</p>
        </div>

        <div class="filters">
            <a href="{{ route('team.tasks') }}" class="filter-btn {{ request('status') == 'all' || !request('status') ? 'active' : '' }}">All</a>
            <a href="{{ route('team.tasks', ['status' => 'pending']) }}" class="filter-btn">Pending</a>
            <a href="{{ route('team.tasks', ['status' => 'in_progress']) }}" class="filter-btn">In Progress</a>
            <a href="{{ route('team.tasks', ['status' => 'review']) }}" class="filter-btn">Review</a>
            <a href="{{ route('team.tasks', ['status' => 'completed']) }}" class="filter-btn">Completed</a>
        </div>

        @if($tasks->count())
            @foreach($tasks as $task)
            <div class="task-card" onclick="window.location.href='{{ route('team.task.detail', $task->id) }}'">
                <div class="task-header">
                    <h3>{{ $task->title }}</h3>
                    <span class="status {{ $task->status }}">{{ ucfirst(str_replace('_', ' ', $task->status)) }}</span>
                </div>
                <div class="task-info">
                    <span><i class="fas fa-folder"></i> {{ $task->project->project_name ?? 'Project' }}</span>
                    <span><i class="fas fa-calendar-alt"></i> Deadline: {{ $task->deadline->format('d M Y') }}</span>
                </div>
                <div class="progress-section">
                    <span>Progress {{ $task->progress }}%</span>
                    <div class="progress-bar"><div style="width: {{ $task->progress }}%"></div></div>
                </div>
            </div>
            @endforeach
            {{ $tasks->links() }}
        @else
            <div class="empty-state"><i class="fas fa-inbox"></i><p>Tidak ada task.</p></div>
        @endif
    </div>
</div>

<style>
.team-main { margin-left: 280px; }
.team-content { padding: 32px; max-width: 1000px; }
.page-header { margin-bottom: 24px; }
.filters { display: flex; gap: 12px; margin-bottom: 24px; flex-wrap: wrap; }
.filter-btn { padding: 8px 20px; border-radius: 40px; background: transparent; border: 1px solid var(--border); color: var(--text-secondary); text-decoration: none; transition: 0.3s; }
.filter-btn.active, .filter-btn:hover { background: var(--accent); color: #000; border-color: var(--accent); }
.task-card { background: var(--surface-card); border-radius: 20px; padding: 20px; margin-bottom: 16px; cursor: pointer; transition: 0.3s; border: 1px solid var(--border); }
.task-card:hover { transform: translateY(-2px); border-color: var(--accent); }
.task-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; }
.task-info { display: flex; gap: 24px; font-size: 0.8rem; color: var(--text-secondary); margin-bottom: 16px; }
.progress-section { display: flex; align-items: center; gap: 16px; }
.progress-section span { font-size: 0.8rem; min-width: 70px; }
.progress-bar { flex: 1; height: 6px; background: var(--border); border-radius: 3px; overflow: hidden; }
.progress-bar div { height: 100%; background: var(--accent); }
.empty-state { text-align: center; padding: 60px; color: var(--text-secondary); }
.empty-state i { font-size: 4rem; margin-bottom: 16px; display: block; }
@media (max-width: 768px) { .team-main { margin-left: 0; } }
</style>
@endsection