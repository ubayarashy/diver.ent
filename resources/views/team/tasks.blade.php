@extends('layouts.app')

@section('content')
@include('partials.team.navbar')

<div class="team-main">
    <div class="team-content">
        <div class="page-header">
            <h1><i class="fas fa-tasks"></i> My Tasks</h1>
            <p>Daftar semua task yang ditugaskan kepada Anda</p>
        </div>

        <!-- Filter Status -->
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

        <div class="pagination">
            {{ $tasks->links() }}
        </div>
    </div>
</div>

<style>
.team-main {
    margin-left: 280px;
    min-height: 100vh;
    padding-top: 20px;
}

.team-content {
    padding: 24px 32px;
}

.page-header {
    margin-bottom: 24px;
}

.page-header h1 {
    font-family: var(--font-display);
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 6px;
}

.page-header p {
    color: var(--text-secondary);
    font-size: 0.85rem;
}

/* Filter Section */
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
    padding: 6px 16px;
    border-radius: 40px;
    color: var(--text-secondary);
    cursor: pointer;
    transition: all 0.3s;
    font-size: 0.75rem;
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
    padding: 6px 16px;
}

.search-box i {
    color: var(--text-secondary);
    margin-right: 8px;
}

.search-box input {
    background: none;
    border: none;
    color: var(--text);
    outline: none;
    font-size: 0.8rem;
    width: 200px;
}

/* Tasks Table */
.tasks-table {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 16px;
    overflow-x: auto;
}

.data-table {
    width: 100%;
    border-collapse: collapse;
}

.data-table th,
.data-table td {
    padding: 14px 16px;
    text-align: left;
    border-bottom: 1px solid var(--border);
}

.data-table th {
    background: rgba(59, 130, 255, 0.05);
    font-weight: 600;
    font-size: 0.8rem;
}

.data-table tr:hover td {
    background: rgba(59, 130, 255, 0.02);
}

.task-desc {
    display: block;
    font-size: 0.7rem;
    color: var(--text-secondary);
    margin-top: 4px;
}

/* Status Badges */
.badge-pending {
    background: rgba(245, 158, 11, 0.1);
    color: #f59e0b;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.7rem;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 4px;
}

.badge-in_progress {
    background: rgba(59, 130, 255, 0.1);
    color: #3b82f6;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.7rem;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 4px;
}

.badge-review {
    background: rgba(139, 92, 246, 0.1);
    color: #8b5cf6;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.7rem;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 4px;
}

.badge-revision {
    background: rgba(239, 68, 68, 0.1);
    color: #ef4444;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.7rem;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 4px;
}

.badge-completed {
    background: rgba(16, 185, 129, 0.1);
    color: #10b981;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.7rem;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 4px;
}

/* Progress Bar */
.progress-wrapper {
    display: flex;
    align-items: center;
    gap: 8px;
}

.progress-bar {
    width: 80px;
    height: 6px;
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
}

/* Deadline */
.deadline {
    font-size: 0.75rem;
    color: var(--text-secondary);
    display: inline-flex;
    align-items: center;
    gap: 4px;
}

.deadline-overdue {
    color: #ef4444;
}

.overdue-badge {
    background: rgba(239, 68, 68, 0.1);
    color: #ef4444;
    padding: 2px 6px;
    border-radius: 10px;
    font-size: 0.6rem;
    margin-left: 6px;
}

/* Action Buttons */
.action-buttons {
    display: flex;
    gap: 8px;
}

.btn-detail, .btn-start {
    background: rgba(59, 130, 255, 0.1);
    color: var(--accent);
    padding: 6px 10px;
    border-radius: 8px;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: all 0.3s;
}

.btn-detail:hover, .btn-start:hover {
    background: var(--accent);
    color: #000;
}

.btn-start:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

/* Empty State */
.empty-table {
    text-align: center;
    padding: 60px !important;
    color: var(--text-secondary);
}

.empty-table i {
    font-size: 3rem;
    margin-bottom: 12px;
    opacity: 0.5;
}

.empty-table p {
    font-size: 0.85rem;
}

/* Pagination */
.pagination {
    margin-top: 24px;
    display: flex;
    justify-content: center;
}

/* Responsive */
@media (max-width: 768px) {
    .team-main {
        margin-left: 0;
    }
    .team-content {
        padding: 16px 20px;
    }
    .filter-section {
        flex-direction: column;
        align-items: stretch;
    }
    .search-box input {
        width: 100%;
    }
    .data-table th,
    .data-table td {
        padding: 10px 12px;
        font-size: 0.75rem;
    }
    .action-buttons {
        flex-direction: column;
    }
}
</style>

<script>
    // Filter by status
    const filterButtons = document.querySelectorAll('.filter-btn');
    const searchInput = document.getElementById('searchTask');
    const tableRows = document.querySelectorAll('#tasksTableBody tr');
    
    function filterTable() {
        const activeFilter = document.querySelector('.filter-btn.active');
        const status = activeFilter ? activeFilter.dataset.filter : 'all';
        const search = searchInput ? searchInput.value.toLowerCase() : '';
        
        tableRows.forEach(row => {
            if (row.querySelector('td')) {
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
    
    // Update task status via AJAX
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
            position: fixed; bottom: 20px; right: 20px;
            background: ${type === 'success' ? '#10b981' : '#ef4444'};
            color: white; padding: 12px 20px;
            border-radius: 12px; z-index: 9999;
            animation: fadeIn 0.3s ease;
        `;
        toast.innerHTML = message;
        document.body.appendChild(toast);
        setTimeout(() => toast.remove(), 3000);
    }
</script>
@endsection