@extends('layouts.app')

@section('content')
@include('team.partials.sidebar')
<div class="team-main">
    @include('team.partials.navbar')
    <div class="team-content">
        <h1>{{ $task->title }}</h1>

        <div class="detail-card">
            <h3>Informasi Brief</h3>
            <p><strong>Project:</strong> {{ $task->brief->project_name ?? 'N/A' }}</p>
            <p><strong>Client:</strong> {{ $task->brief->user->name ?? 'N/A' }}</p>
            <p><strong>Deskripsi:</strong> {{ $task->brief->description ?? '-' }}</p>
            @if($task->brief->reference_link)
                <p><strong>Referensi:</strong> <a href="{{ $task->brief->reference_link }}" target="_blank">Link</a></p>
            @endif
        </div>

        <div class="detail-card">
            <h3>Update Status</h3>
            <form action="{{ route('team.task.status', $task->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <select name="status" class="form-control">
                        <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="review" {{ $task->status == 'review' ? 'selected' : '' }}>Review</option>
                        <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>
                <button type="submit" class="btn-primary">Update Status</button>
            </form>
        </div>

        <div class="detail-card">
            <h3>Upload Hasil Pekerjaan</h3>
            <form action="{{ route('team.task.upload', $task->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Thumbnail (Cover) <span class="required">*</span></label>
                    <input type="file" name="thumbnail" accept="image/*" required>
                </div>
                <div class="form-group">
                    <label>Link Hasil Kerja <span class="required">*</span></label>
                    <input type="url" name="work_link" placeholder="https://..." required>
                </div>
                <div class="form-group">
                    <label>Catatan (Opsional)</label>
                    <textarea name="notes" rows="3" class="form-control"></textarea>
                </div>
                <button type="submit" class="btn-primary">Kirim Laporan</button>
            </form>
        </div>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif
    </div>
</div>

<style>
.team-main { margin-left: 280px; }
.team-content { padding: 32px; max-width: 800px; }
.detail-card {
    background: var(--surface-card);
    border-radius: 20px;
    padding: 24px;
    margin-bottom: 24px;
}
.form-group { margin-bottom: 20px; }
.form-group label { display: block; margin-bottom: 8px; font-weight: 600; }
.form-control, input, textarea, select {
    width: 100%;
    padding: 12px;
    background: var(--bg);
    border: 1px solid var(--border);
    border-radius: 12px;
    color: var(--text-primary);
}
.btn-primary {
    background: var(--accent);
    color: #000;
    border: none;
    padding: 12px 24px;
    border-radius: 40px;
    font-weight: 600;
    cursor: pointer;
}
.alert-success {
    background: rgba(0,200,83,0.1);
    border-left: 4px solid #00c853;
    padding: 12px;
    border-radius: 8px;
    margin-top: 16px;
}
.required { color: #ff4444; }
@media (max-width: 768px) { .team-main { margin-left: 0; } }
</style>
@endsection