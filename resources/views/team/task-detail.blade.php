@extends('layouts.app')

@section('content')
@include('partials.team.navbar')



<div class="team-main">
    <div class="team-content">
        <div class="detail-header">
            <a href="{{ route('team.tasks') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <h1>{{ $task->title }}</h1>
            <p>Project: {{ $task->brief->project_name ?? 'N/A' }} | Client: {{ $task->brief->user->name ?? 'N/A' }}</p>
        </div>

        <div class="detail-grid">
            <div class="detail-card">
                <h3><i class="fas fa-info-circle"></i> Informasi Task</h3>
                <div class="detail-item">
                    <span class="label">Status</span>
                    <span class="badge-{{ $task->status }}">{{ ucfirst(str_replace('_', ' ', $task->status)) }}</span>
                </div>
                <div class="detail-item">
                    <span class="label">Progress</span>
                    <div class="progress-wrapper">
                        <input type="range" id="progressSlider" min="0" max="100" value="{{ $task->progress }}" data-id="{{ $task->id }}">
                        <span id="progressValue">{{ $task->progress }}%</span>
                    </div>
                </div>
                <div class="detail-item">
                    <span class="label">Deadline</span>
                    <span>{{ $task->deadline ? $task->deadline->format('d M Y') : '-' }}</span>
                </div>
                <div class="detail-item">
                    <span class="label">Deskripsi</span>
                    <p>{{ $task->description ?? 'Tidak ada deskripsi' }}</p>
                </div>
            </div>

            <div class="detail-card">
                <h3><i class="fas fa-upload"></i> Upload Hasil</h3>
                <form action="{{ route('team.task.upload', $task->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Thumbnail</label>
                        <input type="file" name="thumbnail" accept="image/*">
                    </div>
                    <div class="form-group">
                        <label>YouTube Link</label>
                        <input type="url" name="youtube_link" placeholder="https://youtube.com/...">
                    </div>
                    <div class="form-group">
                        <label>Social Media Link</label>
                        <input type="url" name="social_link" placeholder="https://instagram.com/...">
                    </div>
                    <div class="form-group">
                        <label>Google Drive Link</label>
                        <input type="url" name="drive_link" placeholder="https://drive.google.com/...">
                    </div>
                    <div class="form-group">
                        <label>Catatan Team</label>
                        <textarea name="team_notes" rows="3" placeholder="Catatan untuk admin..."></textarea>
                    </div>
                    <button type="submit" class="btn-submit">Upload Hasil</button>
                </form>
            </div>
        </div>

        @if($task->result && !empty($task->result))
        <div class="result-card">
            <h3><i class="fas fa-image"></i> Hasil Upload Sebelumnya</h3>
            @if(isset($task->result['thumbnail']))
                <img src="{{ asset('storage/' . $task->result['thumbnail']) }}" class="result-image">
            @endif
            @if(isset($task->result['youtube_link']))
                <a href="{{ $task->result['youtube_link'] }}" target="_blank" class="result-link">📺 YouTube Link</a>
            @endif
            @if(isset($task->result['social_link']))
                <a href="{{ $task->result['social_link'] }}" target="_blank" class="result-link">📱 Social Media Link</a>
            @endif
            @if(isset($task->result['drive_link']))
                <a href="{{ $task->result['drive_link'] }}" target="_blank" class="result-link">☁️ Google Drive Link</a>
            @endif
            @if($task->team_notes)
                <div class="team-notes">
                    <strong>Catatan Team:</strong>
                    <p>{{ $task->team_notes }}</p>
                </div>
            @endif
        </div>
        @endif
    </div>
</div>

<style>
.team-main { margin-left: 280px; min-height: 100vh; padding-top: 20px; }
.team-content { padding: 32px; max-width: 1200px; }
.detail-header { margin-bottom: 32px; }
.btn-back { display: inline-flex; align-items: center; gap: 8px; color: var(--text-secondary); text-decoration: none; margin-bottom: 16px; }
.btn-back:hover { color: var(--accent); }
.detail-header h1 { font-family: var(--font-display); font-size: 1.8rem; font-weight: 800; margin-bottom: 8px; }
.detail-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 32px; }
.detail-card { background: var(--surface); border: 1px solid var(--border); border-radius: 20px; padding: 24px; }
.detail-card h3 { margin-bottom: 20px; font-size: 1.1rem; }
.detail-item { margin-bottom: 16px; }
.detail-item .label { display: block; font-size: 0.7rem; color: var(--text-secondary); margin-bottom: 4px; }
.progress-wrapper { display: flex; align-items: center; gap: 16px; }
.progress-wrapper input { flex: 1; }
.form-group { margin-bottom: 16px; }
.form-group label { display: block; font-size: 0.8rem; font-weight: 600; margin-bottom: 6px; }
.form-group input, .form-group textarea { width: 100%; padding: 10px 14px; background: var(--bg); border: 1px solid var(--border); border-radius: 10px; color: var(--text); }
.btn-submit { background: var(--accent); color: #fff; border: none; padding: 12px 24px; border-radius: 40px; cursor: pointer; width: 100%; }
.result-card { background: var(--surface); border: 1px solid var(--border); border-radius: 20px; padding: 24px; }
.result-image { max-width: 200px; border-radius: 10px; margin-bottom: 16px; }
.result-link { display: block; margin-bottom: 8px; color: var(--accent); }
@media (max-width: 768px) { .team-main { margin-left: 0; } .detail-grid { grid-template-columns: 1fr; } }
</style>

<script>
    // Progress slider
    const slider = document.getElementById('progressSlider');
    if (slider) {
        slider.addEventListener('change', async function() {
            const id = this.dataset.id;
            const progress = this.value;
            document.getElementById('progressValue').innerText = progress + '%';
            
            await fetch(`/team/task/${id}/progress`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ progress: progress })
            });
        });
    }
</script>
@endsection