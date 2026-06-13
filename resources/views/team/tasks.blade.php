@extends('layouts.app')
@section('content')
@include('partials.team.navbar')

<div class="team-main">
    <div class="team-content">
        <div class="page-header">
            <h1>My Tasks</h1>
            <p>Daftar semua task yang ditugaskan kepada Anda</p>
        </div>

        <div class="filter-section">
            <div class="filter-buttons">
                <button class="filter-btn active" data-filter="all">Semua</button>
                <button class="filter-btn" data-filter="pending">Pending</button>
                <button class="filter-btn" data-filter="in_progress">In Progress</button>
                <button class="filter-btn" data-filter="review">Review</button>
                <button class="filter-btn" data-filter="completed">Completed</button>
            </div>
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="searchTask" placeholder="Cari task...">
            </div>
        </div>

        <div class="tasks-table">
            <table class="data-table" id="tasksTable">
                <thead>
                    <tr>
                        <th>Task</th>
                        <th>Project</th>
                        <th>Status</th>
                        <th>Progress</th>
                        <th>Deadline</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="tasksTableBody">
                    @forelse($tasks as $task)
                    <tr data-status="{{ $task->status }}">
                        <td>
                            <strong>{{ $task->title }}</strong>
                            @if($task->description)
                            <small class="task-desc">{{ Str::limit($task->description, 50) }}</small>
                            @endif
                        </td>
                        <td>{{ $task->brief->project_name ?? '-' }}</td>
                        <td>
                            <span class="badge-{{ $task->status }}">
                                @if($task->status == 'pending')
                                    <i class="fas fa-clock"></i> Pending
                                @elseif($task->status == 'in_progress')
                                    <i class="fas fa-spinner fa-pulse"></i> In Progress
                                @elseif($task->status == 'review')
                                    <i class="fas fa-eye"></i> Review
                                @elseif($task->status == 'revision')
                                    <i class="fas fa-edit"></i> Revision
                                @else
                                    <i class="fas fa-check-circle"></i> Completed
                                @endif
                            </span>
                        </td>
                        <td>
                            <div class="progress-wrapper">
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: {{ $task->progress }}%"></div>
                                </div>
                                <span class="progress-text">{{ $task->progress }}%</span>
                            </div>
                        </td>
                        <td>
                            @if($task->deadline)
                                @php
                                    $isOverdue = $task->deadline < now() && $task->status != 'completed';
                                @endphp
                                <span class="deadline {{ $isOverdue ? 'deadline-overdue' : '' }}">
                                    <i class="fas fa-calendar-alt"></i> {{ $task->deadline->format('d M Y') }}
                                    @if($isOverdue)
                                        <span class="overdue-badge">Overdue</span>
                                    @endif
                                </span>
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('team.task.detail', $task->id) }}" class="btn-detail" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <button onclick="updateTaskStatus({{ $task->id }}, 'in_progress')" class="btn-start" title="Mulai" {{ $task->status != 'pending' ? 'disabled' : '' }}>
                                    <i class="fas fa-play"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="empty-table">
                            <i class="fas fa-inbox"></i>
                            <p>Belum ada task yang ditugaskan</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($tasks->hasPages())
        <div class="pagination-container">
            <div class="pagination-info">
                Menampilkan {{ $tasks->firstItem() }} - {{ $tasks->lastItem() }} dari {{ $tasks->total() }} data
            </div>
            <div class="pagination">
                @if ($tasks->onFirstPage())
                    <span class="page-link disabled"><i class="fas fa-chevron-left"></i></span>
                @else
                    <a href="{{ $tasks->previousPageUrl() }}" class="page-link"><i class="fas fa-chevron-left"></i></a>
                @endif

                @foreach ($tasks->getUrlRange(1, $tasks->lastPage()) as $page => $url)
                    @if ($page == $tasks->currentPage())
                        <span class="page-link active">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                    @endif
                @endforeach

                @if ($tasks->hasMorePages())
                    <a href="{{ $tasks->nextPageUrl() }}" class="page-link"><i class="fas fa-chevron-right"></i></a>
                @else
                    <span class="page-link disabled"><i class="fas fa-chevron-right"></i></span>
                @endif
            </div>
        </div>
        @endif
    </div>
</div>

<style>
.team-main {
    margin-left: 280px;
    min-height: 100vh;
    background: var(--bg);
}

.team-content {
    max-width: 1400px;
    margin: 0 auto;
    padding: 32px 40px;
}

.page-header {
    margin-bottom: 28px;
}

.page-header h1 {
    font-family: var(--font-display);
    font-size: 1.6rem;
    font-weight: 700;
    letter-spacing: -0.02em;
    margin-bottom: 6px;
}

.page-header p {
    color: var(--text-secondary);
    font-size: 0.85rem;
}

.filter-section {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
    flex-wrap: wrap;
    gap: 16px;
}

.filter-buttons {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}

.filter-btn {
    background: transparent;
    border: 1px solid var(--border);
    padding: 6px 18px;
    border-radius: 40px;
    color: var(--text-secondary);
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 0.75rem;
    font-weight: 500;
}

.filter-btn:hover, .filter-btn.active {
    background: var(--accent);
    border-color: var(--accent);
    color: #000;
}

.search-box {
    display: flex;
    align-items: center;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 40px;
    padding: 6px 18px;
}

.search-box i {
    color: var(--text-secondary);
    margin-right: 8px;
    font-size: 0.8rem;
}

.search-box input {
    background: none;
    border: none;
    color: var(--text);
    outline: none;
    font-size: 0.8rem;
    width: 220px;
}

.tasks-table {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 16px;
    overflow-x: auto;
}

.data-table {
    width: 100%;
    border-collapse: collapse;
    min-width: 800px;
}

.data-table th,
.data-table td {
    padding: 14px 16px;
    text-align: left;
    border-bottom: 1px solid var(--border);
}

.data-table th {
    background: rgba(59, 130, 255, 0.03);
    font-weight: 600;
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: var(--text-secondary);
}

.data-table tr:hover td {
    background: rgba(59, 130, 255, 0.02);
}

.task-desc {
    display: block;
    font-size: 0.65rem;
    color: var(--text-secondary);
    margin-top: 4px;
}

.badge-pending,
.badge-in_progress,
.badge-review,
.badge-revision,
.badge-completed {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.7rem;
    font-weight: 500;
}

.badge-pending { background: rgba(245, 158, 11, 0.12); color: #f59e0b; }
.badge-in_progress { background: rgba(59, 130, 255, 0.12); color: var(--accent); }
.badge-review { background: rgba(139, 92, 246, 0.12); color: #8b5cf6; }
.badge-revision { background: rgba(239, 68, 68, 0.12); color: #ef4444; }
.badge-completed { background: rgba(16, 185, 129, 0.12); color: #10b981; }

.progress-wrapper {
    display: flex;
    align-items: center;
    gap: 10px;
}

.progress-bar {
    width: 80px;
    height: 5px;
    background: var(--border);
    border-radius: 3px;
    overflow: hidden;
}

.progress-fill {
    height: 100%;
    background: var(--accent);
    border-radius: 3px;
    transition: width 0.3s;
}

.progress-text {
    font-size: 0.7rem;
    color: var(--text-secondary);
    min-width: 35px;
}

.deadline {
    font-size: 0.75rem;
    color: var(--text-secondary);
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.deadline-overdue {
    color: #ef4444;
}

.overdue-badge {
    background: rgba(239, 68, 68, 0.12);
    color: #ef4444;
    padding: 2px 8px;
    border-radius: 12px;
    font-size: 0.6rem;
    font-weight: 500;
    margin-left: 4px;
}

.action-buttons {
    display: flex;
    gap: 8px;
}

.btn-detail, .btn-start {
    width: 32px;
    height: 32px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: rgba(59, 130, 255, 0.08);
    color: var(--accent);
    border-radius: 8px;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 0.8rem;
}

.btn-detail:hover, .btn-start:hover {
    background: var(--accent);
    color: #000;
}

.btn-start:disabled {
    opacity: 0.4;
    cursor: not-allowed;
    pointer-events: none;
}

.empty-table {
    text-align: center;
    padding: 60px !important;
    color: var(--text-secondary);
}

.empty-table i {
    font-size: 3rem;
    margin-bottom: 12px;
    opacity: 0.4;
}

.empty-table p {
    font-size: 0.85rem;
}

.pagination-container {
    margin-top: 28px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 16px;
}

.pagination-info {
    font-size: 0.75rem;
    color: var(--text-secondary);
}

.pagination {
    display: flex;
    align-items: center;
    gap: 6px;
    flex-wrap: wrap;
}

.page-link {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 36px;
    height: 36px;
    padding: 0 10px;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 10px;
    color: var(--text-secondary);
    text-decoration: none;
    font-size: 0.8rem;
    font-weight: 500;
    transition: all 0.3s ease;
}

.page-link:hover {
    background: var(--accent);
    border-color: var(--accent);
    color: #000;
    transform: translateY(-2px);
}

.page-link.active {
    background: var(--accent);
    border-color: var(--accent);
    color: #000;
}

.page-link.disabled {
    opacity: 0.4;
    cursor: not-allowed;
    pointer-events: none;
    transform: none;
}

@media (max-width: 992px) {
    .team-main {
        margin-left: 0;
    }
    .team-content {
        padding: 24px 28px;
    }
}

@media (max-width: 768px) {
    .team-content {
        padding: 20px;
    }
    .filter-section {
        flex-direction: column;
        align-items: stretch;
    }
    .search-box input {
        width: 100%;
    }
    .pagination-container {
        flex-direction: column;
        align-items: center;
    }
    .data-table th,
    .data-table td {
        padding: 10px 12px;
        font-size: 0.75rem;
    }
    .action-buttons {
        flex-direction: column;
        gap: 4px;
    }
    .btn-detail, .btn-start {
        width: 28px;
        height: 28px;
    }
}
</style>

<script>
    const filterButtons = document.querySelectorAll('.filter-btn');
    const searchInput = document.getElementById('searchTask');
    const tableRows = document.querySelectorAll('#tasksTableBody tr');
    
    function filterTable() {
        const activeFilter = document.querySelector('.filter-btn.active');
        const status = activeFilter ? activeFilter.dataset.filter : 'all';
        const search = searchInput ? searchInput.value.toLowerCase() : '';
        
        tableRows.forEach(row => {
            if (row.querySelector('td') && !row.querySelector('.empty-table')) {
                const rowStatus = row.getAttribute('data-status');
                const taskName = row.querySelector('td:first-child strong')?.innerText.toLowerCase() || '';
                const projectName = row.querySelector('td:nth-child(2)')?.innerText.toLowerCase() || '';
                
                const matchStatus = status === 'all' || rowStatus === status;
                const matchSearch = taskName.includes(search) || projectName.includes(search);
                
                row.style.display = (matchStatus && matchSearch) ? '' : 'none';
            }
        });
    }
    
    filterButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            filterButtons.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            filterTable();
        });
    });
    
    if (searchInput) {
        searchInput.addEventListener('keyup', filterTable);
    }
    
    async function updateTaskStatus(taskId, status) {
        try {
            const response = await fetch(`/team/task/${taskId}/status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ status: status })
            });
            
            const data = await response.json();
            
            if (data.success) {
                showToast(data.message, 'success');
                setTimeout(() => location.reload(), 1000);
            }
        } catch (error) {
            showToast('Gagal mengupdate status', 'error');
        }
    }
    
    function showToast(message, type) {
        const toast = document.createElement('div');
        toast.style.cssText = `
            position: fixed; bottom: 24px; right: 24px;
            background: ${type === 'success' ? '#10b981' : '#ef4444'};
            color: white; padding: 12px 20px;
            border-radius: 12px; z-index: 9999;
            font-size: 0.85rem;
            animation: fadeIn 0.3s ease;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        `;
        toast.innerHTML = message;
        document.body.appendChild(toast);
        setTimeout(() => toast.remove(), 3000);
    }
</script>
@endsection