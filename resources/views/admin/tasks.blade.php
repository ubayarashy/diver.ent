@extends('layouts.app')

@section('content')
@include('admin.sidebar')

<div class="admin-main">
    <div class="admin-content">
        <div class="page-header">
            <div>
                <h1><i class="fas fa-tasks"></i> Manajemen Task</h1>
                <p>Kelola semua task yang telah diassign ke team</p>
            </div>
        </div>

        <!-- Statistik Task -->
        <div class="stats-task">
            <div class="stat-task-card">
                <div class="stat-task-icon"><i class="fas fa-tasks"></i></div>
                <div class="stat-task-info">
                    <span class="stat-task-value">{{ $stats['total'] }}</span>
                    <span class="stat-task-label">Total Task</span>
                </div>
            </div>
            <div class="stat-task-card pending">
                <div class="stat-task-icon"><i class="fas fa-clock"></i></div>
                <div class="stat-task-info">
                    <span class="stat-task-value">{{ $stats['pending'] }}</span>
                    <span class="stat-task-label">Pending</span>
                </div>
            </div>
            <div class="stat-task-card in-progress">
                <div class="stat-task-icon"><i class="fas fa-spinner"></i></div>
                <div class="stat-task-info">
                    <span class="stat-task-value">{{ $stats['in_progress'] }}</span>
                    <span class="stat-task-label">In Progress</span>
                </div>
            </div>
            <div class="stat-task-card review">
                <div class="stat-task-icon"><i class="fas fa-eye"></i></div>
                <div class="stat-task-info">
                    <span class="stat-task-value">{{ $stats['review'] }}</span>
                    <span class="stat-task-label">Need Review</span>
                </div>
            </div>
            <div class="stat-task-card completed">
                <div class="stat-task-icon"><i class="fas fa-check-circle"></i></div>
                <div class="stat-task-info">
                    <span class="stat-task-value">{{ $stats['completed'] }}</span>
                    <span class="stat-task-label">Completed</span>
                </div>
            </div>
        </div>

        <!-- Filter & Search -->
        <div class="filter-section">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="searchInput" placeholder="Cari task...">
            </div>
            <div class="filter-status">
                <select id="statusFilter" class="status-filter">
                    <option value="all">Semua Status</option>
                    <option value="pending">Pending</option>
                    <option value="in_progress">In Progress</option>
                    <option value="review">Need Review</option>
                    <option value="completed">Completed</option>
                </select>
            </div>
        </div>

        <!-- Tabel Task -->
        <div class="task-table-container">
            <table class="task-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Task / Project</th>
                        <th>Team</th>
                        <th>Kategori</th>
                        <th>Progress</th>
                        <th>Status</th>
                        <th>Deadline</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="taskTableBody">
                    @foreach($tasks as $task)
                    <tr data-status="{{ $task->status }}" data-search="{{ $task->title }} {{ $task->brief->project_name ?? '' }} {{ $task->brief->user->name ?? '' }}">
                        <td>#{{ $task->id }}</td>
                        <td>{{ $task->brief->user->name ?? '-' }}</td>
                        <td>
                            <div class="task-info">
                                <strong>{{ $task->title }}</strong>
                                <br>
                                <small class="project-name">{{ $task->brief->project_name ?? '-' }}</small>
                            </div>
                        </td>
                        <td>
                            <span class="team-badge">
                                <i class="fas fa-user"></i> {{ $task->assignedTo->name ?? 'Unassigned' }}
                            </span>
                        </td>
                        <td><span class="category-badge">{{ $task->category ?? '-' }}</span></td>
                        <td>
                            <div class="progress-cell">
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: {{ $task->progress }}%"></div>
                                </div>
                                <span class="progress-text">{{ $task->progress }}%</span>
                            </div>
                        </td>
                        <td>
                            <span class="status-badge status-{{ $task->status }}">
                                @if($task->status == 'pending')
                                    <i class="fas fa-clock"></i> Pending
                                @elseif($task->status == 'in_progress')
                                    <i class="fas fa-spinner"></i> In Progress
                                @elseif($task->status == 'review')
                                    <i class="fas fa-eye"></i> Need Review
                                @elseif($task->status == 'revision')
                                    <i class="fas fa-edit"></i> Revision
                                @else
                                    <i class="fas fa-check-circle"></i> Completed
                                @endif
                            </span>
                        </td>
                        <td class="deadline-cell {{ $task->deadline && $task->deadline < now() ? 'deadline-overdue' : '' }}">
                            @if($task->deadline)
                                {{ $task->deadline->format('d-M-Y') }}
                                @if($task->deadline < now() && $task->status != 'completed')
                                    <br><small class="overdue-text">Overdue!</small>
                                @endif
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-view" onclick="viewTask({{ $task->id }})" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn-assign" onclick="openAssignModal({{ $task->id }}, '{{ $task->title }}')" title="Assign Team">
                                    <i class="fas fa-user-plus"></i>
                                </button>
                                <button class="btn-delete" onclick="deleteTask({{ $task->id }})" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($tasks->hasPages())
        <div class="pagination-container">
            <div class="pagination-info">
                Menampilkan {{ $tasks->firstItem() }} - {{ $tasks->lastItem() }} dari {{ $tasks->total() }} data
            </div>
            <div class="pagination">
                {{ $tasks->links() }}
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Modal Assign Task -->
<div id="assignModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Assign Task ke Team</h3>
            <button class="modal-close" onclick="closeAssignModal()">&times;</button>
        </div>
        <div class="modal-body">
            <p><strong>Task:</strong> <span id="assignTaskTitle"></span></p>
            <div class="form-group">
                <label>Pilih Team</label>
                <select id="assignTeamSelect" class="form-control">
                    <option value="">-- Pilih Team --</option>
                    @foreach($teams as $team)
                    <option value="{{ $team->id }}">{{ $team->name }} ({{ $team->email }})</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn-cancel" onclick="closeAssignModal()">Batal</button>
            <button class="btn-submit" onclick="submitAssign()">Assign Task</button>
        </div>
    </div>
</div>

<style>
.admin-main {
    margin-left: 280px;
    min-height: 100vh;
    padding-top:20px;
}

.admin-content {
    padding: 32px;
}

.page-header {
    margin-bottom: 32px;
}

.page-header h1 {
    font-family: var(--font-display);
    font-size: 1.8rem;
    font-weight: 800;
    margin-bottom: 8px;
}

/* Stats Task */
.stats-task {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 20px;
    margin-bottom: 32px;
}

.stat-task-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 20px;
    display: flex;
    align-items: center;
    gap: 16px;
    transition: all 0.3s;
}

.stat-task-card:hover {
    transform: translateY(-2px);
    border-color: var(--accent);
}

.stat-task-icon {
    width: 48px;
    height: 48px;
    background: rgba(59, 130, 255, 0.1);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.3rem;
    color: var(--accent);
}

.stat-task-card.pending .stat-task-icon { background: rgba(245,158,11,0.1); color: #f59e0b; }
.stat-task-card.in-progress .stat-task-icon { background: rgba(59,130,255,0.1); color: var(--accent); }
.stat-task-card.review .stat-task-icon { background: rgba(139,92,246,0.1); color: #8b5cf6; }
.stat-task-card.completed .stat-task-icon { background: rgba(16,185,129,0.1); color: #10b981; }

.stat-task-info {
    display: flex;
    flex-direction: column;
}

.stat-task-value {
    font-size: 1.5rem;
    font-weight: 800;
    color: var(--text);
}

.stat-task-label {
    font-size: 0.75rem;
    color: var(--text-secondary);
}

/* Filter Section */
.filter-section {
    display: flex;
    gap: 16px;
    margin-bottom: 24px;
    flex-wrap: wrap;
}

.search-box {
    flex: 1;
    display: flex;
    align-items: center;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 40px;
    padding: 10px 18px;
}

.search-box i {
    color: var(--text-secondary);
    margin-right: 10px;
}

.search-box input {
    flex: 1;
    background: none;
    border: none;
    color: var(--text);
    outline: none;
}

.status-filter {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 40px;
    padding: 10px 18px;
    color: var(--text);
    cursor: pointer;
}

/* Tabel Task */
.task-table-container {
    overflow-x: auto;
    border-radius: 16px;
    border: 1px solid var(--border);
    background: var(--surface);
}

.task-table {
    width: 100%;
    border-collapse: collapse;
}

.task-table th,
.task-table td {
    padding: 16px;
    text-align: left;
    border-bottom: 1px solid var(--border);
}

.task-table th {
    background: var(--surface-alt);
    font-weight: 600;
    font-size: 0.85rem;
}

.task-table tr:hover td {
    background: rgba(59, 130, 255, 0.02);
}

.task-info strong {
    font-size: 0.9rem;
}

.project-name {
    font-size: 0.7rem;
    color: var(--text-secondary);
}

.team-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: rgba(59, 130, 255, 0.1);
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
    color: var(--accent);
}

.category-badge {
    background: rgba(16, 185, 129, 0.1);
    color: #10b981;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 0.7rem;
}

.progress-cell {
    display: flex;
    align-items: center;
    gap: 10px;
    min-width: 110px;
}

.progress-bar {
    flex: 1;
    height: 6px;
    background: var(--border);
    border-radius: 3px;
    overflow: hidden;
}

.progress-fill {
    height: 100%;
    background: var(--accent);
    border-radius: 3px;
}

.progress-text {
    font-size: 0.7rem;
    min-width: 35px;
}

.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.7rem;
    font-weight: 600;
}

.status-pending { background: rgba(245,158,11,0.15); color: #f59e0b; }
.status-in_progress { background: rgba(59,130,255,0.15); color: var(--accent); }
.status-review { background: rgba(139,92,246,0.15); color: #8b5cf6; }
.status-completed { background: rgba(16,185,129,0.15); color: #10b981; }

.deadline-cell {
    font-size: 0.75rem;
}

.deadline-overdue {
    color: #ef4444;
}

.overdue-text {
    font-size: 0.65rem;
    color: #ef4444;
}

.action-buttons {
    display: flex;
    gap: 8px;
}

.action-buttons button {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    transition: all 0.3s;
}

.btn-view {
    background: rgba(59, 130, 255, 0.1);
    color: var(--accent);
}

.btn-view:hover {
    background: var(--accent);
    color: #000;
}

.btn-assign {
    background: rgba(16, 185, 129, 0.1);
    color: #10b981;
}

.btn-assign:hover {
    background: #10b981;
    color: #fff;
}

.btn-delete {
    background: rgba(239, 68, 68, 0.1);
    color: #ef4444;
}

.btn-delete:hover {
    background: #ef4444;
    color: #fff;
}

/* Modal */
.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.7);
    backdrop-filter: blur(8px);
    z-index: 1000;
    justify-content: center;
    align-items: center;
}

.modal-content {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 16px;
    width: 450px;
    max-width: 90%;
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 24px;
    border-bottom: 1px solid var(--border);
}

.modal-header h3 {
    font-family: var(--font-display);
    font-size: 1.2rem;
    font-weight: 700;
}

.modal-close {
    background: none;
    border: none;
    font-size: 1.5rem;
    cursor: pointer;
    color: var(--text-secondary);
}

.modal-body {
    padding: 24px;
}

.modal-footer {
    display: flex;
    justify-content: flex-end;
    gap: 12px;
    padding: 16px 24px;
    border-top: 1px solid var(--border);
}

.form-group {
    margin-bottom: 16px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    font-size: 0.85rem;
}

.form-control {
    width: 100%;
    padding: 10px 14px;
    background: var(--bg);
    border: 1px solid var(--border);
    border-radius: 10px;
    color: var(--text);
}

.btn-cancel {
    background: transparent;
    border: 1px solid var(--border);
    padding: 8px 20px;
    border-radius: 40px;
    cursor: pointer;
}

.btn-submit {
    background: var(--accent);
    color: #000;
    border: none;
    padding: 8px 20px;
    border-radius: 40px;
    cursor: pointer;
    font-weight: 600;
}

/* Pagination */
.pagination-container {
    margin-top: 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 16px;
}

.pagination-info {
    font-size: 0.8rem;
    color: var(--text-secondary);
}

.pagination {
    display: flex;
    gap: 8px;
}

/* Responsive */
@media (max-width: 1024px) {
    .stats-task {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (max-width: 768px) {
    .admin-main {
        margin-left: 0;
    }
    .admin-content {
        padding: 20px;
    }
    .stats-task {
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
    }
    .task-table th,
    .task-table td {
        padding: 10px;
        font-size: 0.75rem;
    }
    .action-buttons button {
        width: 28px;
        height: 28px;
    }
    .pagination-container {
        flex-direction: column;
    }
}
</style>

<script>
    let currentTaskId = null;
    
    // Filter by status and search
    const statusFilter = document.getElementById('statusFilter');
    const searchInput = document.getElementById('searchInput');
    const tableRows = document.querySelectorAll('#taskTableBody tr');
    
    function filterTable() {
        const status = statusFilter.value;
        const search = searchInput.value.toLowerCase();
        
        tableRows.forEach(row => {
            const rowStatus = row.getAttribute('data-status');
            const searchText = row.getAttribute('data-search')?.toLowerCase() || '';
            
            const matchStatus = status === 'all' || rowStatus === status;
            const matchSearch = search === '' || searchText.includes(search);
            
            row.style.display = (matchStatus && matchSearch) ? '' : 'none';
        });
    }
    
    statusFilter.addEventListener('change', filterTable);
    searchInput.addEventListener('keyup', filterTable);
    
    // View task detail
    function viewTask(id) {
        window.location.href = `/admin/tasks/${id}`;
    }
    
    // Assign task modal
    function openAssignModal(id, title) {
        currentTaskId = id;
        document.getElementById('assignTaskTitle').innerText = title;
        document.getElementById('assignModal').style.display = 'flex';
    }
    
    function closeAssignModal() {
        document.getElementById('assignModal').style.display = 'none';
        currentTaskId = null;
    }
    
    function submitAssign() {
        const teamId = document.getElementById('assignTeamSelect').value;
        
        if (!teamId) {
            alert('Pilih team terlebih dahulu');
            return;
        }
        
        fetch('{{ route("admin.tasks.assign") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                task_id: currentTaskId,
                assigned_to: teamId
            })
        }).then(response => response.json())
          .then(data => {
              if (data.success) {
                  showToast('Task berhasil diassign', 'success');
                  setTimeout(() => location.reload(), 1000);
              } else {
                  showToast('Gagal mengassign task', 'error');
              }
          });
    }
    
    // Delete task
    function deleteTask(id) {
        if (confirm('Apakah Anda yakin ingin menghapus task ini?')) {
            fetch(`/admin/tasks/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(response => response.json())
              .then(data => {
                  if (data.success) {
                      showToast(data.message, 'success');
                      setTimeout(() => location.reload(), 1000);
                  }
              });
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
    
    // Close modal on backdrop click
    document.getElementById('assignModal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeAssignModal();
        }
    });
</script>
@endsection