@extends('team.layouts.app')

@section('content')
@include('team.partials.sidebar')
<div class="team-main">
    @include('team.partials.navbar')
    <div class="team-content">
        <div class="task-header-detail">
            <h1>{{ $task->title }}</h1>
            <span class="status {{ $task->status }}">{{ ucfirst(str_replace('_', ' ', $task->status)) }}</span>
        </div>

        <div class="detail-card">
            <h3><i class="fas fa-info-circle"></i> Informasi Proyek</h3>
            <p><strong>Project:</strong> {{ $task->project->project_name ?? 'N/A' }}</p>
            <p><strong>Client:</strong> {{ $task->project->user->name ?? 'N/A' }}</p>
            <p><strong>Deadline:</strong> {{ $task->deadline->format('d M Y') }}</p>
            <p><strong>Brief Client:</strong> {{ $task->project->description ?? 'Tidak ada deskripsi' }}</p>
            @if($task->project->reference_link)<p><strong>Referensi:</strong> <a href="{{ $task->project->reference_link }}" target="_blank">Link</a></p>@endif
        </div>

        <div class="detail-card">
            <h3><i class="fas fa-chart-line"></i> Update Progress & Status</h3>
            <form action="{{ route('team.task.progress', $task->id) }}" method="POST" class="inline-form">
                @csrf
                <label>Progress: <input type="range" name="progress" min="0" max="100" value="{{ $task->progress }}" oninput="this.nextElementSibling.value=this.value"> <output>{{ $task->progress }}</output>%</label>
                <button type="submit" class="btn-small">Update</button>
            </form>
            <form action="{{ route('team.task.status', $task->id) }}" method="POST" class="inline-form">
                @csrf
                <select name="status">
                    <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="review" {{ $task->status == 'review' ? 'selected' : '' }}>Review</option>
                    <option value="revision" {{ $task->status == 'revision' ? 'selected' : '' }}>Revision</option>
                    <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
                <button type="submit" class="btn-small">Ubah Status</button>
            </form>
        </div>

        <div class="detail-card">
            <h3><i class="fas fa-upload"></i> Upload Hasil Pekerjaan</h3>
            <form action="{{ route('team.task.upload', $task->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Cover / Thumbnail</label>
                    <input type="file" name="thumbnail" accept="image/*">
                    @if($task->result && $task->result->thumbnail)<div class="current-file">File saat ini: <a href="{{ Storage::url($task->result->thumbnail) }}" target="_blank">Lihat</a></div>@endif
                </div>
                <div class="form-group">
                    <label>YouTube Link</label>
                    <input type="url" name="youtube_link" value="{{ $task->result->youtube_link ?? '' }}" placeholder="https://youtube.com/...">
                </div>
                <div class="form-group">
                    <label>Social Media Post Link</label>
                    <input type="url" name="social_link" value="{{ $task->result->social_link ?? '' }}" placeholder="https://instagram.com/...">
                </div>
                <div class="form-group">
                    <label>Google Drive Link</label>
                    <input type="url" name="drive_link" value="{{ $task->result->drive_link ?? '' }}" placeholder="https://drive.google.com/...">
                </div>
                <div class="form-group">
                    <label>Catatan untuk Admin</label>
                    <textarea name="notes" rows="3">{{ $task->result->notes ?? '' }}</textarea>
                </div>
                <button type="submit" class="btn-primary">Simpan Hasil</button>
            </form>
        </div>

        @if(session('success'))<div class="alert success">{{ session('success') }}</div>@endif
    </div>
</div>

<style>
.team-main { margin-left: 280px; }
.team-content { padding: 32px; max-width: 800px; }
.task-header-detail { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; }
.detail-card { background: var(--surface-card); border-radius: 20px; padding: 24px; margin-bottom: 24px; }
.detail-card h3 { margin-bottom: 16px; }
.inline-form { display: flex; align-items: center; gap: 16px; margin-bottom: 16px; flex-wrap: wrap; }
.btn-small { background: var(--accent); border: none; padding: 6px 16px; border-radius: 40px; color: #000; cursor: pointer; }
.form-group { margin-bottom: 20px; }
.form-group label { display: block; margin-bottom: 8px; font-weight: 600; }
.form-group input, .form-group textarea, .form-group select { width: 100%; padding: 12px; background: var(--bg); border: 1px solid var(--border); border-radius: 12px; color: var(--text-primary); }
.btn-primary { background: var(--accent); color: #000; border: none; padding: 12px 24px; border-radius: 40px; font-weight: 600; cursor: pointer; }
.alert.success { background: rgba(0,200,83,0.1); border-left: 4px solid #00c853; padding: 12px; margin-top: 16px; border-radius: 8px; }
@media (max-width: 768px) { .team-main { margin-left: 0; } }
</style>
@endsection