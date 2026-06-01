@extends('layouts.app')

@section('content')
@include('admin.sidebar')

<div class="admin-main">
    <div class="admin-content">
        <div class="page-header">
            <h1><i class="fas fa-edit"></i> Edit Portfolio</h1>
            <p>Edit data portfolio yang sudah ada</p>
        </div>

        <div class="form-container">
            <form action="{{ route('admin.portfolio.update', $portfolio->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label>Judul Portfolio <span class="required">*</span></label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $portfolio->title) }}" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Kategori <span class="required">*</span></label>
                        <select name="category" class="form-control" required>
                            <option value="social" {{ $portfolio->category == 'social' ? 'selected' : '' }}>Social Media</option>
                            <option value="web" {{ $portfolio->category == 'web' ? 'selected' : '' }}>Website & Apps</option>
                            <option value="ads" {{ $portfolio->category == 'ads' ? 'selected' : '' }}>Digital Ads</option>
                            <option value="brand" {{ $portfolio->category == 'brand' ? 'selected' : '' }}>Visual Branding</option>
                            <option value="video" {{ $portfolio->category == 'video' ? 'selected' : '' }}>Photo & Video</option>
                            <option value="seo" {{ $portfolio->category == 'seo' ? 'selected' : '' }}>SEO</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Label <span class="required">*</span></label>
                        <input type="text" name="label" class="form-control" value="{{ old('label', $portfolio->label) }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Deskripsi <span class="required">*</span></label>
                    <textarea name="description" rows="5" class="form-control" required>{{ old('description', $portfolio->description) }}</textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Nama Client</label>
                        <input type="text" name="client_name" class="form-control" value="{{ old('client_name', $portfolio->client_name) }}">
                    </div>
                    <div class="form-group">
                        <label>Tahun</label>
                        <input type="number" name="year" class="form-control" value="{{ old('year', $portfolio->year ?? date('Y')) }}">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Gambar Utama</label>
                        @if($portfolio->image)
                            <div class="current-image">
                                <img src="{{ asset('storage/' . $portfolio->image) }}" width="100">
                                <p>Gambar saat ini</p>
                            </div>
                        @endif
                        <input type="file" name="image" class="form-control" accept="image/*">
                        <small class="form-hint">Ukuran: 800x600px, maks 2MB</small>
                    </div>
                    <div class="form-group">
                        <label>Thumbnail</label>
                        @if($portfolio->thumbnail)
                            <div class="current-image">
                                <img src="{{ asset('storage/' . $portfolio->thumbnail) }}" width="100">
                                <p>Thumbnail saat ini</p>
                            </div>
                        @endif
                        <input type="file" name="thumbnail" class="form-control" accept="image/*">
                        <small class="form-hint">Ukuran: 400x300px, maks 1MB</small>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="published" {{ $portfolio->status == 'published' ? 'selected' : '' }}>Published</option>
                            <option value="draft" {{ $portfolio->status == 'draft' ? 'selected' : '' }}>Draft</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Order</label>
                        <input type="number" name="order" class="form-control" value="{{ old('order', $portfolio->order ?? 0) }}">
                    </div>
                </div>

                <div class="form-group">
                    <label>Hasil / Statistik (JSON format)</label>
                    <textarea name="results" rows="3" class="form-control" placeholder='{"engagement":"+320%","reach":"5M+"}'>{{ is_array($portfolio->results) ? json_encode($portfolio->results) : $portfolio->results }}</textarea>
                    <small class="form-hint">Contoh: {"engagement":"+320%","reach":"5M+"}</small>
                </div>

                <div class="form-actions">
                    <a href="{{ route('admin.portfolios') }}" class="btn-cancel">Batal</a>
                    <button type="submit" class="btn-submit">Update Portfolio</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.admin-main {
    margin-left: 280px;
    min-height: 100vh;
    padding-top: 20px;
}
.admin-content {
    padding: 32px;
    max-width: 800px;
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
.page-header p {
    color: var(--text-secondary);
}
.form-container {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 20px;
    padding: 32px;
}
.form-group {
    margin-bottom: 20px;
}
.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
}
.required {
    color: #ef4444;
}
.form-control {
    width: 100%;
    padding: 12px 16px;
    background: var(--bg);
    border: 1px solid var(--border);
    border-radius: 12px;
    color: var(--text);
    font-size: 0.9rem;
}
.form-control:focus {
    outline: none;
    border-color: var(--accent);
}
.form-hint {
    font-size: 0.7rem;
    color: var(--text-secondary);
    margin-top: 4px;
}
.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}
.current-image {
    margin-bottom: 12px;
}
.current-image img {
    border-radius: 8px;
}
.current-image p {
    font-size: 12px;
    color: var(--text-secondary);
    margin-top: 4px;
}
.form-actions {
    display: flex;
    gap: 16px;
    justify-content: flex-end;
    margin-top: 24px;
}
.btn-cancel {
    background: transparent;
    border: 1px solid var(--border);
    color: var(--text);
    padding: 12px 24px;
    border-radius: 40px;
    text-decoration: none;
    transition: all 0.3s;
}
.btn-cancel:hover {
    border-color: var(--accent);
    color: var(--accent);
}
.btn-submit {
    background: var(--accent);
    color: #000;
    border: none;
    padding: 12px 24px;
    border-radius: 40px;
    cursor: pointer;
    font-weight: 600;
    transition: all 0.3s;
}
.btn-submit:hover {
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
    .form-container {
        padding: 24px;
    }
    .form-row {
        grid-template-columns: 1fr;
        gap: 16px;
    }
}
</style>
@endsection