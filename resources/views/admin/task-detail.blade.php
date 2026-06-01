@extends('layouts.app')

@section('content')
@include('admin.sidebar')

<div class="admin-main">
    <div class="admin-content">
        <div class="detail-header">
            <a href="{{ route('admin.tasks') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Kembali ke Daftar Task
            </a>
            <h1>{{ $task->title }}</h1>
        </div>

        <div class="detail-grid">
            <!-- Informasi Task -->
            <div class="detail-card">
                <h3><i class="fas fa-info-circle"></i> Informasi Task</h3>
                <div class="detail-item">
                    <span class="label">ID Task</span>
                    <span class="value">#{{ $task->id }}</span>
                </div>
                <div class="detail-item">
                    <span class="label">Status</span>
                    <span class="value status-{{ $task->status }}">
                        {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                    </span>
                </div>
                <div class="detail-item">
                    <span class="label">Progress</span>
                    <div class="progress-wrapper">
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: {{ $task->progress }}%"></div>
                        </div>
                        <span>{{ $task->progress }}%</span>
                    </div>
                </div>
                <div class="detail-item">
                    <span class="label">Deadline</span>
                    <span class="value">{{ $task->deadline ? $task->deadline->format('d-M-Y') : '-' }}</span>
                </div>
                <div class="detail-item">
                    <span class="label">Kategori</span>
                    <span class="value category-badge">{{ $task->category ?? '-' }}</span>
                </div>
                <div class="detail-item">
                    <span class="label">Assigned To</span>
                    <span class="value team-badge">
                        <i class="fas fa-user"></i> {{ $task->assignedTo->name ?? 'Unassigned' }}
                    </span>
                </div>
                <div class="detail-item">
                    <span class="label">Deskripsi</span>
                    <p class="value">{{ $task->description ?? 'Tidak ada deskripsi' }}</p>
                </div>
            </div>

            <!-- Informasi Brief -->
            <div class="detail-card">
                <h3><i class="fas fa-file-alt"></i> Informasi Brief</h3>
                <div class="detail-item">
                    <span class="label">Nama Project</span>
                    <span class="value">{{ $task->brief->project_name ?? '-' }}</span>
                </div>
                <div class="detail-item">
                    <span class="label">Client</span>
                    <span class="value">{{ $task->brief->user->name ?? '-' }}</span>
                </div>
                <div class="detail-item">
                    <span class="label">Email Client</span>
                    <span class="value">{{ $task->brief->user->email ?? '-' }}</span>
                </div>
                <div class="detail-item">
                    <span class="label">Budget (Rp)</span>
                    <span class="value">{{ $task->brief->budget ? number_format($task->brief->budget, 0, ',', '.') : '-' }}</span>
                </div>
                @if($task->brief->description)
                <div class="detail-item">
                    <span class="label">Deskripsi Brief</span>
                    <p class="value">{{ $task->brief->description }}</p>
                </div>
                @endif
            </div>

            <!-- Hasil Upload Team -->
            @if($task->result && !empty($task->result))
            <div class="detail-card full-width">
                <h3><i class="fas fa-upload"></i> Hasil Upload Team</h3>
                @if(isset($task->result['thumbnail']))
                <div class="result-image">
                    <img src="{{ asset('storage/' . $task->result['thumbnail']) }}" alt="Thumbnail">
                </div>
                @endif
                @if(isset($task->result['youtube_link']))
                <div class="result-link">
                    <i class="fab fa-youtube"></i>
                    <a href="{{ $task->result['youtube_link'] }}" target="_blank">YouTube Link</a>
                </div>
                @endif
                @if(isset($task->result['social_link']))
                <div class="result-link">
                    <i class="fab fa-instagram"></i>
                    <a href="{{ $task->result['social_link'] }}" target="_blank">Social Media Link</a>
                </div>
                @endif
                @if(isset($task->result['drive_link']))
                <div class="result-link">
                    <i class="fab fa-google-drive"></i>
                    <a href="{{ $task->result['drive_link'] }}" target="_blank">Google Drive Link</a>
                </div>
                @endif
                @if($task->team_notes)
                <div class="team-notes">
                    <strong>Catatan Team:</strong>
                    <p>{{ $task->team_notes }}</p>
                </div>
                @endif
            </div>
            @endif

            <!-- Update Status -->
            <div class="detail-card">
                <h3><i class="fas fa-edit"></i> Update Status</h3>
                <div class="form-group">
                    <label>Ubah Status</label>
                    <select id="taskStatus" class="form-control">
                        <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                        <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>🔄 In Progress</option>
                        <option value="review" {{ $task->status == 'review' ? 'selected' : '' }}>📋 Need Review</option>
                        <option value="revision" {{ $task->status == 'revision' ? 'selected' : '' }}>✏️ Revision</option>
                        <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>✅ Completed</option>
                    </select>
                </div>
                <button class="btn-update" onclick="updateTaskStatus({{ $task->id }})">Update Status</button>
            </div>
        </div>
    </div>
</div>

<style>
.admin-main {
    margin-left: 280px;
    min-height: 100vh;
    padding-top: 80px;
}

.admin-content {
    padding: 32px;
    max-width: 1200px;
}

.btn-back {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: var(--text-secondary);
    text-decoration: none;
    margin-bottom: 20px;
    transition: color 0.3s;
}

.btn-back:hover {
    color: var(--accent);
}

.detail-header h1 {
    font-family: var(--font-display);
    font-size: 1.8rem;
    font-weight: 800;
    margin-bottom: 32px;
}

.detail-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
}

.detail-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 20px;
    padding: 24px;
}

.detail-card h3 {
    margin-bottom: 20px;
    font-size: 1.1rem;
    font-weight: 700;
}

.detail-item {
    margin-bottom: 16px;
    padding-bottom: 12px;
    border-bottom: 1px solid var(--border);
}

.detail-item:last-child {
    border-bottom: none;
}

.detail-item .label {
    display: block;
    font-size: 0.7rem;
    color: var(--text-secondary);
    margin-bottom: 4px;
}

.detail-item .value {
    font-size: 0.9rem;
    font-weight: 500;
}

.full-width {
    grid-column: span 2;
}

.status-pending { color: #f59e0b; }
.status-in_progress { color: #3b82f6; }
.status-review { color: #8b5cf6; }
.status-completed { color: #10b981; }

.progress-wrapper {
    display: flex;
    align-items: center;
    gap: 12px;
}

.progress-bar {
    flex: 1;
    height: 8px;
    background: var(--border);
    border-radius: 4px;
    overflow: hidden;
}

.progress-fill {
    height: 100%;
    background: var(--accent);
    border-radius: 4px;
}

.category-badge {
    background: rgba(59, 130, 255, 0.1);
    color: var(--accent);
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
}

.team-badge {
    background: rgba(16, 185, 129, 0.1);
    color: #10b981;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
}

.result-image img {
    max-width: 200px;
    border-radius: 12px;
    margin-bottom: 16px;
}

.result-link {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px;
    background: var(--bg);
    border-radius: 10px;
    margin-bottom: 10px;
}

.result-link a {
    color: var(--accent);
    text-decoration: none;
}

.team-notes {
    background: var(--bg);
    padding: 16px;
    border-radius: 12px;
    margin-top: 16px;
}

.form-group {
    margin-bottom: 16px;
}

.form-control {
    width: 100%;
    padding: 12px 16px;
    background: var(--bg);
    border: 1px solid var(--border);
    border-radius: 12px;
    color: var(--text);
}

.btn-update {
    width: 100%;
    background: var(--accent);
    color: #000;
    border: none;
    padding: 12px;
    border-radius: 40px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
}

.btn-update:hover {
    transform: translateY(-2px);
    filter: brightness(0.95);
}

@media (max-width: 768px) {
    .admin-main {
        margin-left: 0;
    }
    .admin-content {
        padding: 20px;
    }
    .detail-grid {
        grid-template-columns: 1fr;
    }
    .full-width {
        grid-column: span 1;
    }
}
</style>

<script>
    function updateTaskStatus(id) {
        const status = document.getElementById('taskStatus').value;
        
        fetch(`/admin/tasks/${id}/status`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ status: status })
        }).then(response => response.json())
          .then(data => {
              if (data.success) {
                  showToast('Status task berhasil diperbarui', 'success');
                  setTimeout(() => location.reload(), 1000);
              }
          });
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